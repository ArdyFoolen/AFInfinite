<?php

namespace AFInfinite\Mvc\Rendering;

class LabelRenderer extends HtmlRenderer {
    
    private string $Label;
    
    public function SetValue(string $value) {
        if (!isset($this->Label)) {
            $this->Label = $value;
        }
        else {
            $this->Label = $this->Label . $value;
        }
    }
    
    public function SetRenderer(HtmlRenderer $renderer) : bool {
        return false;
    }
    
    public function Render() {
        $elem = "<div>$this->Label</div>";
        
        if (isset($this->Attributes)) {
            foreach ($this->Attributes as $attr => $value) {
                switch (strtolower($attr)) {
                    case 'type':
                        switch (strtolower($value)) {
                            case 'header1':
                                $elem = "<h1>$this->Label</h1>";
                                break;
                            case 'header2':
                                $elem = "<h2>$this->Label</h2>";
                                break;
                            case 'header3':
                                $elem = "<h3>$this->Label</h3>";
                                break;
                            case 'header4':
                                $elem = "<h4>$this->Label</h4>";
                                break;
                            case 'header5':
                                $elem = "<h5>$this->Label</h5>";
                                break;
                            case 'header6':
                                $elem = "<h6>$this->Label</h6>";
                                break;
                        }
                        break;
                }
            }
        }
 
        echo $elem;
    }
}
