<?php

namespace AFInfinite\Mvc\Rendering;

class FlexContainerRenderer extends HtmlRenderer {
    
    protected string $TypeName = 'FlexContainer';
    protected static $IsArray = true;

    public function SetRenderer(HtmlRenderer $renderer) : bool {
        if ($this->AddRenderer($renderer)) {
            return true;
        }
        // if ($renderer instanceof FlexItemRenderer) {
        //     $this->Children['FlexItem'][]= $renderer;
        //     return true;
        // }
        return $this->SetChild($renderer);
    }
    
    public function Render() {
        echo "<div class='flexcontainer'>";
        if (isset($this->Children)) {
            foreach ($this->Children['FlexItem'] as $child) {
                $child->Render();
            }
        }
        echo "</div>";
    }
}
