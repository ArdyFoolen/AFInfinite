<?php

namespace AFInfinite\Mvc\Rendering;

class FlexContainerRenderer extends HtmlRenderer {
    
    protected string $TypeName = 'FlexContainer';
    
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
