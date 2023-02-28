<?php

namespace AFInfinite\Mvc\Rendering;

class MetaRenderer extends HtmlRenderer {
    
    protected string $TypeName = 'Meta';
    
    public function Render() {
        $metaElement = "<meta";
        if (isset($this->attributes)) {
            foreach ($this->Attributes as $key => $value) {
                $metaElement = $metaElement . " $key='$value'";
            }
        }
        $metaElement = $metaElement . ">";
        echo $metaElement;
    }
}
