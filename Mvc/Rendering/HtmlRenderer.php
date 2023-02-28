<?php

namespace AFInfinite\Mvc\Rendering;

class HtmlRenderer {

    protected RenderingTemplate $Template;
    protected string $TypeName = 'Html';
    protected array $Children;
    protected array $Attributes;

	public function GetIsArray() : bool {
        return $this->Template->IsArray($this->GetTypeName());
	}

    public function GetIsSingle() {
        return $this->Template->IsSingle($this->GetTypeName());
	}

    public function SetTemplate(RenderingTemplate $template) {
        $this->Template = $template;
    }

    public function GetTypeName() : string {
        return $this->TypeName;
    }

    public function SetRenderer(HtmlRenderer $renderer) : bool {
        if ($this->AddRenderer($renderer)) {
            return true;
        }

        return $this->SetChild($renderer);
    }
    
    protected function AddRenderer(HtmlRenderer $renderer) : bool {
        $current = $this->GetTypeName();
        $child = $renderer->GetTypeName();
        if ($this->Template->IsChildOf($current, $child)) {
            if ($this->GetIsArray() && !$renderer->GetIsSingle()) {
                $this->Children[$child][] = $renderer;
            }
            else {
                $this->Children[$child] = $renderer;
            }
            return true;
        }
        return false;
    }

    protected function SetChild(HtmlRenderer $renderer) : bool {
        if (isset($this->Children) && is_array($this->Children)) {
            foreach ($this->Children as $child)  {
                if (!is_array($child) && $child->SetRenderer($renderer)) {
                    return true;
                }
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
