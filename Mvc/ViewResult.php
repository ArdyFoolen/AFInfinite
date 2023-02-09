<?php

namespace AFInfinite\Mvc;
use AFInfinite\Core\Reflection;
use AFInfinite\Core\Directory;

class ViewResult extends ActionResult {
        
    private object $Model;
    
    public function __construct(object $model) {
        $this->Model = $model;
    }
    
    protected function RenderBody() {
        global $rootPath;
        $fileName = Directory::ScanRecursive($rootPath . "/Views/", array($this->RequestContext->GetControllerName(), $this->RequestContext->GetAction() . ".php"));
        require $fileName;
    }
}
