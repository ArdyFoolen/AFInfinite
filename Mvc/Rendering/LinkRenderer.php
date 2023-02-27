<?php

namespace AFInfinite\Mvc\Rendering;

class LinkRenderer extends HtmlRenderer {
    
    protected string $TypeName = 'Link';
    private string $RelativeUrl;
    
    public function SetValue(string $value) {
        $this->RelativeUrl = $value;
    }
    
    public function SetRenderer(HtmlRenderer $renderer) : bool {
        return false;
    }
    
    public function Render() {
        global $baseUrl;
        $attribute = "";
        if (isset($this->Attributes)) {
            foreach ($this->Attributes as $attr => $value) {
                $attribute = $attribute . $attr . '="' . $value . '"';
            }
        }
        echo "<link rel='stylesheet' href='$baseUrl$this->RelativeUrl'$attribute>";
    }
}
