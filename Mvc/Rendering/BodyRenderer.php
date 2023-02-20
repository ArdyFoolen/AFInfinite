<?php

namespace AFInfinite\Mvc\Rendering;

class BodyRenderer extends HtmlRenderer {
    
    public function SetRenderer(HtmlRenderer $renderer) : bool {
        if ($renderer instanceof LabelRenderer) {
            $this->Children[] = $renderer;
            return true;
        }
        return $this->SetChild($renderer);
    }
    
    public function Render() {
        echo "<body>";
        if (isset($this->Children)) {
            foreach ($this->Children as $child) {
                $child->Render();
            }
        }
        echo "</body>";
    }
}
