<?php

namespace AFInfinite\Mvc\Rendering;

class LabelRenderer extends HtmlRenderer {
    
    protected string $TypeName = 'Label';
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
        $builder = new HtmlElementBuilder();
        if (isset($this->Attributes['TYPE'])) {
            switch ($this->Attributes['TYPE']) {
                case 'header1':
                    $builder->StartElement("h1");
                    break;
                case 'header2':
                    $builder->StartElement("h2");
                    break;
                case 'header3':
                    $builder->StartElement("h3");
                    break;
                case 'header4':
                    $builder->StartElement("h4");
                    break;
                case 'header5':
                    $builder->StartElement("h5");
                    break;
                case 'header6':
                    $builder->StartElement("h6");
                    break;
                default:
                    $builder->StartElement("div");
                    break;
            }
        }
        else {
            $builder->StartElement("div");
        }

        if (isset($this->Attributes['TEXT-ALIGN'])) {
            $builder->AddStyle("text-align:" . $this->Attributes['TEXT-ALIGN']);
        }
 
        echo $builder->AddClass("label")
                     ->WithValue($this->Label)
                     ->Build();
    }
}
