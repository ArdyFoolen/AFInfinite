<?php

namespace AFInfinite\Mvc\Rendering;

class HtmlRenderer {

    protected RenderingTemplate $Template;
    protected string $TypeName = 'Html';
    protected array $Children;
    protected array $Attributes;
    protected static $IsArray = false;

	public static function GetIsArray()
	{
		return static::$IsArray;
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
            if ($this->GetIsArray()) {
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
        foreach ($this->Children as $child)  {
            if (!is_array($child) && $child->SetRenderer($renderer)) {
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
