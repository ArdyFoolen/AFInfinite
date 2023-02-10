<?php

namespace AFInfinite\Mvc;

class ActionResultInvoker extends ActionInvoker {
    public function __construct(IController $controller, string $action, IParameterBinderProvider $provider) {
        parent::__construct($controller, $action, $provider);
    }

    protected function GetActionResult($returnValue) : IActionResult {
        return $returnValue;
    }
}
