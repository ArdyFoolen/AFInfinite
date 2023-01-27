<?php

namespace AFInfinite\Mvc;
use AFInfinite\Core\Reflection;
use AFInfinite\Core\Directory;

class ViewResult extends ActionResult {
        
    private object $Model;
    
    public function __construct(object $model) {
        $this->Model = $model;
    }
    
    public function Render() {
        global $rootPath;
        $fileName = Directory::ScanRecursive($rootPath . "/Views/", array($this->RequestContext->GetController(), $this->RequestContext->GetAction() . ".php"));
        $contents = file_get_contents($fileName);

        $typeName = Reflection::GetTypeName($this->Model);
        $props = Reflection::GetProperties($typeName);
        foreach ($props as $prop) {
            $propName = $prop->getName();
            if (Reflection::HasProperty($this->Model, $propName)) {
                $value = Reflection::GetProperty($this->Model, $propName);
                $contents = str_replace("\$model->$propName", $value, $contents);
            }
            else {
                $contents = str_replace("\$model->$propName", '', $contents);
            }
        }

        echo $contents;
    }
}
