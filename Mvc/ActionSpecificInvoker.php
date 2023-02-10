<?php

namespace AFInfinite\Mvc;

class ActionSpecificInvoker extends ActionInvoker {
    public function __construct(IController $controller, string $action, IParameterBinderProvider $provider) {
        parent::__construct($controller, $action, $provider);
    }

    protected function GetActionResult($returnValue) : IActionResult {
        $result = new NonViewResult();
        $result->SetResult($returnValue);
        return $result;
    }
}
