<?php

namespace AFInfinite\Mvc\Rendering;
use AFInfinite\Core\Reflection;
use AFInfinite\Mvc\RequestContext;
use AFInfinite\Core\Directory;
use AFInfinite\Mvc\IActionResult;
use Exception;

class PageRenderer implements IPageRenderer {
    
    private string $ControllerName;
    private string $Action;

    private IActionResult $ActionResult;
    
    private string $LayoutFileName;
    
    public function __construct(string $controllerName, string $action, IActionResult $actionResult) {
        $this->ControllerName = $controllerName;
        $this->Action = $action;
        $this->ActionResult = $actionResult;
    }
    
    public function Render(RequestContext $requestContext) {
        $this->GetLayout();
        $this->ActionResult->SetLayout($this->LayoutFileName);
        $this->ActionResult->SetRequestContext($requestContext);
        $this->ActionResult->Render();
    }

    private function GetLayout() {
        $fileName = Directory::ScanRecursive("/Views", array($this->ControllerName, "Layout.xml"));
        if ($fileName === false) {
            $fileName = Directory::ScanRecursive("/Views", array("Shared", "Layout.xml"));
            if ($fileName === false) {
                throw new Exception();
            }
        }
        $this->LayoutFileName = $fileName;
    }
}
