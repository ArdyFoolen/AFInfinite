<?php

namespace AFInfinite\Mvc\Rendering;

class TitleRenderer extends HtmlRenderer {

    protected string $TypeName = 'Title';
    private string $Title;
    
    public function SetValue(string $value) {
        $this->Title = $value;
    }
     
    public function Render() {
        echo "<title>$this->Title</title>";
    }
}
