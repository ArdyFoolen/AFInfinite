<?php

namespace AFInfinite\Mvc\Rendering;

class FlexContainerRenderer extends HtmlRenderer {
    
    public function SetRenderer(HtmlRenderer $renderer) : bool {
        if ($renderer instanceof FlexItemRenderer) {
            $this->Children['FlexItem'][]= $renderer;
            return true;
        }
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
