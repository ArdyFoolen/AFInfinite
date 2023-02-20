<?php

namespace AFInfinite\Mvc\Rendering;

class MetaRenderer extends HtmlRenderer {

    private array $Attributes;
    
    public function SetAttributes(array $attributes) {
        $this->Attributes = $attributes;
    }
    
    public function SetRenderer(HtmlRenderer $renderer) : bool {
        return false;
    }
    
    public function Render() {
        $metaElement = "<meta";
        foreach ($this->Attributes as $key => $value) {
            $metaElement = $metaElement . " $key='$value'";
        }
        $metaElement = $metaElement . ">";
        echo $metaElement;
    }
}
