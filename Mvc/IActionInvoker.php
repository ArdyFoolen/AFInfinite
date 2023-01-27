<?php

namespace AFInfinite\Mvc;

interface IActionInvoker {
    public function HasResult() : bool;
    public function GetActionResult() : IActionResult;
    public function Execute();
}
