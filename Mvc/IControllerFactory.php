<?php

namespace AFInfinite\Mvc;
//require "IController.php";

interface IControllerFactory {
    
    public function CreateController(RequestContext $requestContext, string $controllerName) : IController;
}
