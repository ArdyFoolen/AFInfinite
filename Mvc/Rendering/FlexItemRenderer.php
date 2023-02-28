<?php

namespace AFInfinite\Mvc\Rendering;

class FlexItemRenderer extends HtmlRenderer {
  
    protected string $TypeName = 'FlexItem';
    
    public function Render() {
        echo "<div class='flexitem'>";
        if (isset($this->Children)) {
            foreach ($this->Children as $child) {
                $child->Render();
            }
        }
        echo "</div>";
    }
}
