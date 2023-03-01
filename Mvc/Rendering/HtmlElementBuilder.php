<?php

namespace AFInfinite\Mvc\Rendering;

class HtmlElementBuilder {

    private string $Element;
    private string $Value;
    private string $Result;
    private array $Classes;
    private array $Styles;

    public function StartElement(string $element) : HtmlElementBuilder {
        $this->Element = $element;
        $this->Result = '<' . $element;

        return $this;
    }

    public function AddStyle(string $style) : HtmlElementBuilder {
        $this->Styles[] = $style;

        return $this;
    }

    public function AddClass(string $class) : HtmlElementBuilder {
        $this->Classes[] = $class;

        return $this;
    }

    public function WithValue(string $value) : HtmlElementBuilder {
        $this->Value = $value;

        return $this;
    }

    public function BuildValue() : HtmlElementBuilder {
        if (!isset($this->Value)) {
            return $this;
        }
        $this->Result = $this->Result . $this->Value;

        return $this;
    }

    private function BuildClasses() : HtmlElementBuilder {
        if (!isset($this->Classes)) {
            return $this;
        }

        $last = array_key_last($this->Classes);

        $this->Result = $this->Result . " class='";
        foreach ($this->Classes as $key => $class) {
            $this->Result = $this->Result . $class;
            if ($key !== $last) {
                $this->Result = $this->Result . ' ';
            }
        }
        $this->Result = $this->Result . "'";

        return $this;
    }

    private function BuildStyles() : HtmlElementBuilder {
        if (!isset($this->Styles)) {
            return $this;
        }

        $last = array_key_last($this->Classes);

        $this->Result = $this->Result . " style='";
        foreach ($this->Styles as $key => $style) {
            $this->Result = $this->Result . $style;

            if (!strpos($style, ";")) {
                $this->Result = $this->Result . ";";
            }

            if ($key !== $last) {
                $this->Result = $this->Result . ' ';
            }
        }
        $this->Result = $this->Result . "'";

        return $this;
    }

    private function CloseStart() : HtmlElementBuilder {
        $this->Result = $this->Result . '>';

        return $this;
    }

    private function EndElement() : HtmlElementBuilder {
        $this->Result = $this->Result . '</' . $this->Element . '>';

        return $this;
    }

    public function Build() : string {
        $this->BuildClasses()
                ->BuildStyles()
                ->CloseStart()
                ->BuildValue()
                ->EndElement();
        return $this->Result;
    }
}
