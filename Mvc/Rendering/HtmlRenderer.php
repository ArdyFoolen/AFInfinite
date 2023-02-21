<?php

namespace AFInfinite\Mvc\Rendering;

class HtmlRenderer {
    
    protected array $Children;
    protected array $Attributes;

    public function SetRenderer(HtmlRenderer $renderer) : bool {
        if ($renderer instanceof HeadRenderer) {
            $this->Children['Head'] = $renderer;
            return true;
        }
        if ($renderer instanceof BodyRenderer) {
            $this->Children['Body'] = $renderer;
            return true;
        }
        return $this->SetChild($renderer);
    }
    
    protected function SetChild(HtmlRenderer $renderer) : bool {
        foreach ($this->Children as $child)  {
            if ($child->SetRenderer($renderer)) {
                return true;
            }
        }
        return false;
    }
    
    public function SetValue(string $value) {

    }
    
    public function SetAttributes(array $attributes) {
        $this->Attributes = $attributes;
    }

    public function Render() {
        echo "<!DOCTYPE html>";
        echo "<html>";

        if (isset($this->Children['Head'])) {
            $this->Children['Head']->Render();
        }

        if (isset($this->Children['Body'])) {
            $this->Children['Body']->Render();
        }
        
        echo "</html>";
    }
}
