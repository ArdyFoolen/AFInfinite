<?php

namespace AFInfinite\Mvc\Rendering;
use AFInfinite\Core\Reflection;
use AFInfinite\Mvc\RequestContext;
use AFInfinite\Core\Directory;
use AFInfinite\Mvc\IActionResult;

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
        global $rootPath;
//        $fileName = Directory::ScanRecursive($rootPath . "/Views", array($this->ControllerName, "Layout.php"));
        $fileName = Directory::ScanRecursive($rootPath . "/Views", array($this->ControllerName, "Layout.xhtml"));
        if ($fileName === false) {
//            $fileName = Directory::ScanRecursive($rootPath . "/Views", array("Shared", "Layout.php"));
            $fileName = Directory::ScanRecursive($rootPath . "/Views", array("Shared", "Layout.xhtml"));
            if ($fileName === false) {
                throw new Exception();
            }
        }
        $this->LayoutFileName = $fileName;
    }
}
