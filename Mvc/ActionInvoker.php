<?php

namespace AFInfinite\Mvc;
use ReflectionMethod;
use ReflectionParameter;
use AFInfinite\Core\Activator;
use AFInfinite\Core\Reflection;

class ActionInvoker implements IActionInvoker {
    
    private IParameterBinderProvider $Provider;
    private IController $Controller;
    private string $Action;
    private array $Parameters;
    
    private IActionResult $ActionResult;

    public function __construct(IController $controller, IParameterBinderProvider $provider) {
        $this->Provider = $provider;
        $this->Controller = $controller;
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
    
    public function Execute() {
        $method = $this->GetMethod();
        $values = $this->BindParameters($method);
        if ($method->hasReturnType()) {
            $returnValue = $method->invokeArgs($this->Controller, $values);
            
            if (Reflection::Implements($returnValue, 'AFInfinite\Mvc\IActionResult')) {
                $this->ActionResult = $returnValue;
            }
            else {
                $result = new NonViewResult();
                $result->SetResult($returnValue);
                $this->ActionResult = $result;
            }
        }
        else {
            $method->invokeArgs($this->Controller, $values);
        }
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
