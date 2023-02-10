<?php

namespace AFInfinite\Mvc;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionClass;
use AFInfinite\Core\Reflection;
use AFInfinite\Mvc\IController;

class ActionInvokerFactory {
    public function Create(IController $controller, string $action) {
        $method = $this->GetMethod($controller, $action);
        if ($this->ImplementsActionResult($method)) {
            return new ActionResultInvoker($controller, $action, ParameterBinderProvider::UseProviderIni());
        }
        if ($method->hasReturnType()) {
            return new ActionSpecificInvoker($controller, $action, ParameterBinderProvider::UseProviderIni());
        }
        return new ActionNoResultInvoker($controller, $action, ParameterBinderProvider::UseProviderIni());
    }
 
    private function ImplementsActionResult(ReflectionMethod $method) {
        return $method->hasReturnType() ? Reflection::ImplementsClass($method->getReturnType()->getName(), 'AFInfinite\Mvc\IActionResult') : false;
    }

    private function GetMethod(IController $controller, string $action) : ReflectionMethod {
        $className = get_class($controller);
        return new ReflectionMethod($className, $action);
    }
}
