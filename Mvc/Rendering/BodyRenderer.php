<?php

namespace AFInfinite\Mvc\Rendering;

class BodyRenderer extends HtmlRenderer {
    
    protected string $TypeName = 'Body';

    public function SetRenderer(HtmlRenderer $renderer) : bool {
        if ($this->AddRenderer($renderer)) {
            return true;
        }
        // if ($renderer instanceof LabelRenderer) {
        //     $this->Children[] = $renderer;
        //     return true;
        // }
        // if ($renderer instanceof FlexContainerRenderer) {
        //     $this->Children['FlexContainer'] = $renderer;
        //     return true;
        // }
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
