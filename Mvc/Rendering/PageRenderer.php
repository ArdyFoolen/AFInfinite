<?php

namespace AFInfinite\Mvc\Rendering;
use AFInfinite\Core\Reflection;
use AFInfinite\Mvc\RequestContext;
use AFInfinite\Core\Directory;
use AFInfinite\Mvc\NonViewResult;

class PageRenderer implements IPageRenderer {
    
    private string $ControllerName;
    private string $Action;
    
    private $ActionReturnValue;
    private bool $ActionHasReturnType;
    
    public function __construct(string $controllerName, string $action, $actionReturnValue, bool $actionHasReturnType) {
        $this->ControllerName = $controllerName;
        $this->Action = $action;
        $this->ActionReturnValue = $actionReturnValue;
        $this->ActionHasReturnType = $actionHasReturnType;
    }
    
    public function Render(RequestContext $requestContext) {
        if ($this->ActionHasReturnType) {
            $this->RenderActionWithReturnType($requestContext);
        }
        else {
            $this->RenderActionWithoutReturnType();
        }
    }

    private function RenderActionWithReturnType(RequestContext $requestContext) {
        if (Reflection::Implements($this->ActionReturnValue, 'AFInfinite\Mvc\IActionResult')) {
            $this->RenderActionResult($requestContext);
        }
        else {
            $this->RenderNonViewResult($this->ActionReturnValue);
        }
    }
    
    private function RenderActionWithoutReturnType() {
        global $rootPath;
        $fileName = Directory::ScanRecursive($rootPath . "/Views/", array($this->ControllerName, $this->Action . ".php"));
        $this->RenderNonViewResult(file_get_contents($fileName));
    }
    
    private function RenderActionResult(RequestContext $requestContext) {
        $this->ActionReturnValue->SetRequestContext($requestContext);
        $this->ActionReturnValue->Render();
    }
    
    private function RenderNonViewResult(string $content) {
        $result = new NonViewResult();
        $result->SetResult($content);
        $result->Render();
    }
}
