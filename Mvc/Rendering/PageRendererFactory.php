<?php

namespace AFInfinite\Mvc\Rendering;
use AFInfinite\Mvc\Rendering\IPageRenderer;
use AFInfinite\Mvc\Rendering\PageRenderer;
use AFInfinite\Mvc\IActionResult;

class PageRendererFactory implements IPageRendererFactory {
    public function Create(string $controllerName, string $action, IActionResult $actionResult) : IPageRenderer {
        return new PageRenderer($controllerName, $action, $actionResult);
    }
}