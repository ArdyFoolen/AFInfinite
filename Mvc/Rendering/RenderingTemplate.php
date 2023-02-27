<?php

namespace AFInfinite\Mvc\Rendering;

use SimpleXMLElement;

class RenderingTemplate {

    private SimpleXMLElement $Xml;
    private bool $IsLoaded = false;

    public function Load() {
        if ($this->IsLoaded) {
            return;
        }

        global $rootPath;
        $fileName = $rootPath . '\Mvc\Rendering\RenderingTemplate.xml';
        if (file_exists($fileName)) {
            $this->Xml = simplexml_load_file($fileName);
        } else {
            throw new Exception();
        }

    //     $this->Log($this->Xml);
    //     print_r($this->Xml);
    }

    public function IsChildOf(string $parent, string $child) : bool {
        $name = $this->Xml->getName();
        foreach ($this->Xml as $pKey => $pValue) {
            if (strtolower($pKey) === strtolower($parent)) {
                foreach ($pValue as $cKey => $cValue) {
                    if (strtolower($cKey) === strtolower($child)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    // private function Log(SimpleXMLElement $element) {
    //     foreach ($element as $key => $value) {
    //         $this->Log($value);
    //     }
    // }
}
