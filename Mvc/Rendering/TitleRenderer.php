<?php

namespace AFInfinite\Mvc\Rendering;

class TitleRenderer extends HtmlRenderer {

    private string $Title;
    
    public function __construct(string $title) {
        $this->Title = $title;
    }
    
    public function SetRenderer(HtmlRenderer $renderer) : bool {
        return false;
    }
    
    public function Render() {
        echo "<title>$this->Title</title>";
    }
}
