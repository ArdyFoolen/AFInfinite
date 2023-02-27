<?php

namespace AFInfinite\Mvc\Rendering;

class TitleRenderer extends HtmlRenderer {

    protected string $TypeName = 'Title';
    private string $Title;
    
    public function SetValue(string $value) {
        $this->Title = $value;
    }
    
    public function SetRenderer(HtmlRenderer $renderer) : bool {
        return false;
    }
    
    public function Render() {
        echo "<title>$this->Title</title>";
    }
}
