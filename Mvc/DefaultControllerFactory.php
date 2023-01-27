<?php

namespace AFInfinite\Mvc;
use AFInfinite\Core\Activator;

class DefaultControllerFactory implements IControllerFactory {
    
    public function CreateController(RequestContext $requestContext, string $controllerName) : IController {
        $className = "AFInfinite\\Controllers\\" . ucfirst(strtolower($controllerName)) . "Controller";
        $controller = Activator::CreateInstance($className);
        $controller->Initialize($requestContext);
        return $controller;
    }
}
