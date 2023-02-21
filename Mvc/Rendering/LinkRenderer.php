<?php

namespace AFInfinite\Mvc\Rendering;

class LinkRenderer extends HtmlRenderer {
    
    private string $RelativeUrl;
    
    public function SetValue(string $value) {
        $this->RelativeUrl = $value;
    }
    
    public function SetRenderer(HtmlRenderer $renderer) : bool {
        return false;
    }
    
    public function Render() {
        global $baseUrl;
        echo "<link rel='stylesheet' href='$baseUrl$this->RelativeUrl'>";
    }
}
