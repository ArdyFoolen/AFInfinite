<?php

namespace AFInfinite\Mvc;
use ReflectionMethod;
use ReflectionParameter;
use AFInfinite\Core\Activator;
use AFInfinite\Core\Reflection;

abstract class ActionInvoker implements IActionInvoker {
    
    private IParameterBinderProvider $Provider;
    protected IController $Controller;
    protected string $Action;
    private array $Parameters;

    public function __construct(IController $controller, string $action, IParameterBinderProvider $provider) {
        $this->Controller = $controller;
        $this->Action = $action;
        $this->Provider = $provider;
    }
    
    public function Initialize(RequestContext $requestContext) {
        $this->Parameters = array_change_key_case(array_merge($requestContext->GetParameters(), $requestContext->GetQueryString()), CASE_LOWER);
    }

    protected abstract function GetActionResult($returnValue) : IActionResult;
    
    public function Execute() : IActionResult {
        $method = $this->GetMethod();
        $values = $this->BindParameters($method);
        $returnValue = $method->invokeArgs($this->Controller, $values);
        return $this->GetActionResult($returnValue);
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
