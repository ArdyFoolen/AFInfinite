<?php

namespace AFInfinite\Mvc\Rendering;

class LinkRenderer extends HtmlRenderer {
    
    private string $RelativeUrl;
    
    public function __construct(string $relativeUrl) {
        $this->RelativeUrl = $relativeUrl;
    }
    
    public function SetRenderer(HtmlRenderer $renderer) : bool {
        return false;
    }
    
    public function Render() {
        global $baseUrl;
        echo "<link rel='stylesheet' href='$baseUrl$this->RelativeUrl'>";
    }
}
