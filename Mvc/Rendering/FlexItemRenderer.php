<?php

namespace AFInfinite\Mvc\Rendering;

class FlexItemRenderer extends HtmlRenderer {
  
    protected string $TypeName = 'FlexItem';

    public function SetRenderer(HtmlRenderer $renderer) : bool {
        if ($this->AddRenderer($renderer)) {
            return true;
        }

        $this->Children[] = $renderer;
        return true;
    }
    
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
