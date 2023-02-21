<?php

namespace AFInfinite\Mvc\Rendering;

class LabelRenderer extends HtmlRenderer {
    
    private string $Label;
    
    public function SetValue(string $value) {
        if (!isset($this->Label)) {
            $this->Label = $value;
        }
        else {
            $this->Label = $this->Label . $value;
        }
    }
    
    public function SetRenderer(HtmlRenderer $renderer) : bool {
        return false;
    }
    
    public function Render() {
        echo "<div class='AFLabel'>$this->Label</div>";
    }
}
