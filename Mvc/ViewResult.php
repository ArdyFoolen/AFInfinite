<?php

namespace AFInfinite\Mvc;
use AFInfinite\Core\Reflection;
use AFInfinite\Core\Directory;
use AFInfinite\Mvc\Rendering\HtmlBuilder;

class ViewResult extends ActionResult {
        
    private object $Model;
    
    public function __construct(object $model) {
        $this->Model = $model;
    }
    
    protected function RenderBody(HtmlBuilder $builder) {
        $fileName = Directory::ScanRecursive("/Views", array($this->RequestContext->GetControllerName(), $this->RequestContext->GetAction() . ".xml"));
        // require $fileName;
        $builder->WithModel($this->Model)
                ->WithXmlFile($fileName);
    }
}
