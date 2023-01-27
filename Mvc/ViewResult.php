<?php

namespace AFInfinite\Mvc;
use AFInfinite\Core\Reflection;

class ViewResult extends ActionResult {
        
    private object $Model;
    
    public function __construct(object $model) {
        $this->Model = $model;
    }
    
    public function Render() {
        $fileName = __DIR__ . "\\..\\Views\\" . $this->RequestContext->GetController() . "\\" . $this->RequestContext->GetAction() . ".php";
        $contents = file_get_contents($fileName);

        $typeName = Reflection::GetTypeName($this->Model);
        $props = Reflection::GetProperties($typeName);
        foreach ($props as $prop) {
            $propName = $prop->getName();
            $value = Reflection::GetProperty($this->Model, $propName);
            $contents = str_replace("\$model->$propName", $value, $contents);
        }

        echo $contents;
    }
}
