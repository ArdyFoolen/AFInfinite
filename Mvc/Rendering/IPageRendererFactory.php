<?php

namespace AFInfinite\Mvc\Rendering;
use AFInfinite\Mvc\IActionResult;

interface IPageRendererFactory {
    public function Create(string $controllerName, string $action, IActionResult $actionResult) : IPageRenderer;
}
