<?php

namespace AFInfinite\Mvc\Rendering;

class LabelRenderer extends HtmlRenderer {
    
    private string $Label;
    
    public function __construct(string $label) {
        $this->Label = $label;
    }
    
    public function SetRenderer(HtmlRenderer $renderer) : bool {
        return false;
    }
    
    public function Render() {
        echo "<div class='AFLabel'>$this->Label</div>";
    }
}
