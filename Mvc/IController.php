<?php

namespace AFInfinite\Mvc;
use AFInfinite\Mvc\IActionInvoker;

interface IController {
    public function Initialize(RequestContext $requestContext);
    public function CreateActionInvoker() : IActionInvoker;
}
