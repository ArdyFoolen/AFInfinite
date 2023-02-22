<?php

namespace AFInfinite\Mvc\Rendering;

class FlexItemRenderer extends HtmlRenderer {
    
    public function SetRenderer(HtmlRenderer $renderer) : bool {
        $this->Children[] = $renderer;
        return true;
    }
    
    public function Render() {
        echo "<div class='child'>";
        if (isset($this->Children)) {
            foreach ($this->Children as $child) {
                $child->Render();
            }
        }
        echo "</div>";
    }
}
