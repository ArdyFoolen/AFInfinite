<?php

namespace AFInfinite\Mvc;

interface IActionInvoker {
    public function Execute() : IActionResult;
}
