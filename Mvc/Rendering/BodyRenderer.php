<?php

namespace AFInfinite\Mvc\Rendering;

class BodyRenderer extends HtmlRenderer {
    
    protected string $TypeName = 'Body';
    
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
