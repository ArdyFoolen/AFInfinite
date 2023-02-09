<?php

namespace AFInfinite\Mvc;
use AFInfinite\Mvc\IActionInvoker;

interface IController {
    public function GetName() : string;
    public function Initialize(RequestContext $requestContext);
    public function CreateActionInvoker() : IActionInvoker;
}
