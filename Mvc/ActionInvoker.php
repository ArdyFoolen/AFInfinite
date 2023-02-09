<?php

namespace AFInfinite\Mvc;
use ReflectionMethod;
use ReflectionParameter;
use AFInfinite\Core\Activator;
use AFInfinite\Core\Reflection;
use AFInfinite\Mvc\Rendering\IPageRenderer;
use AFInfinite\Mvc\Rendering\PageRenderer;

class ActionInvoker implements IActionInvoker {
    
    private IParameterBinderProvider $Provider;
    private IController $Controller;
    private string $Action;
    private array $Parameters;

    private bool $HasReturnType = false;
    private $ReturnValue = null;
    
    private IActionResult $ActionResult;

    public function __construct(IController $controller, IParameterBinderProvider $provider) {
        $this->Provider = $provider;
        $this->Controller = $controller;
    }

    public function GetHasReturnType() : bool {
        return $this->HasReturnType;
    }
    public function GetReturnValue() {
        return $this->ReturnValue;
    }
    
    public function Initialize(RequestContext $requestContext) {
        $this->Action = $requestContext->GetAction();
        $this->Parameters = array_change_key_case(array_merge($requestContext->GetParameters(), $requestContext->GetQueryString()), CASE_LOWER);
    }
    
    public function HasResult() : bool {
        return isset($this->ActionResult);
    }

    public function GetActionResult() : IActionResult {
        return $this->ActionResult;
    }
    
    public function Execute() : IPageRenderer {
        $method = $this->GetMethod();
        $values = $this->BindParameters($method);
        $this->ReturnValue = $method->invokeArgs($this->Controller, $values);
        $this->HasReturnType = $method->hasReturnType();
        return new PageRenderer($this->Controller->GetName(), $this->Action, $this->ReturnValue, $this->HasReturnType);
    }

    private function GetMethod() : ReflectionMethod {
        $className = get_class($this->Controller);
        return new ReflectionMethod($className, $this->Action);
    }
    
    private function BindParameters(ReflectionMethod $method) : array {
        $values = [];
        
        $params = $method->getParameters();
        foreach ($params as $param) {
            $binder = $this->Provider->GetBinder($param);
            $binder->Bind($this->Parameters, $param, $values);
        }

        return $values;
    }
}
