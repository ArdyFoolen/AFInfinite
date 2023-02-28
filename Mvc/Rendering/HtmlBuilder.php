<?php

namespace AFInfinite\Mvc\Rendering;
use AFInfinite\Mvc\Rendering\HtmlRenderer;
use AFInfinite\Mvc\Rendering\HeadRenderer;
use AFInfinite\Mvc\Rendering\MetaRenderer;
use AFInfinite\Mvc\Rendering\TitleRenderer;
use AFInfinite\Mvc\Rendering\LinkRenderer;
use AFInfinite\Mvc\Rendering\BodyRenderer;
use AFInfinite\Mvc\Rendering\FlexContainerRenderer;
use AFInfinite\Mvc\Rendering\FlexItemRenderer;
use AFInfinite\Mvc\Rendering\LabelRenderer;

use AFInfinite\Core\XmlParser;
use AFInfinite\Core\IProcessingHandler;

use Exception;

class HtmlBuilder implements IProcessingHandler {
    
    private RenderingTemplate $Template;
    private HtmlRenderer $HtmlRenderer;
    private array $CurrentRenderer;
    private object $Model;

    private function SetRenderer() {
        if (isset($this->HtmlRenderer)) {
            return;
        }

        $this->Template = new RenderingTemplate();
        $this->Template->Load();
        $this->HtmlRenderer = new HtmlRenderer();
        $this->HtmlRenderer->SetTemplate($this->Template);
        $this->CurrentRenderer[] = $this->HtmlRenderer;
    }

    private function CreateParser() : XmlParser {
        $parser = new XmlParser();
        $parser->SetHandler(XmlParser::StartEvent, $this);
        $parser->SetHandler(XmlParser::EndEvent, $this);
        $parser->SetHandler(XmlParser::DataEvent, $this);
        if (isset($this->Model)) {
            $parser->SetHandler(XmlParser::ProcessEvent, $this);
        }
        return $parser;
    }

    public function WithModel(object $model) : HtmlBuilder {
        $this->Model = $model;

        return $this;
    }

    public function WithXmlFile($fileName) : HtmlBuilder {
        global $rootPath;
        $this->SetRenderer();
        $this->CreateParser()->ParseFile($rootPath . $fileName);

        return $this;
    }

    public function WithXml($xmlData) : HtmlBuilder {
        $this->SetRenderer();
        $this->CreateParser()->Parse($xmlData);

        return $this;
    }

    public function WithBody() : HtmlBuilder {
        $this->SetRenderer();

        $this->CurrentRenderer[] = new BodyRenderer();
        $this->HtmlRenderer->SetRenderer($this->CurrentRenderer[array_key_last($this->CurrentRenderer)]);

        return $this;
    }

    public function Build() : HtmlRenderer {
        $this->SetRenderer();
        return $this->HtmlRenderer;
    }

    public function StartHandler($parser, $tag, $attributes)
    {
        switch (strtolower($tag)) {
            case "head" :
                $this->CurrentRenderer[] = new HeadRenderer();
                $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetTemplate($this->Template);
                $this->HtmlRenderer->SetRenderer($this->CurrentRenderer[array_key_last($this->CurrentRenderer)]);
                break;
            case "meta" :
                $this->CurrentRenderer[] = new MetaRenderer();
                $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetTemplate($this->Template);
                $this->HtmlRenderer->SetRenderer($this->CurrentRenderer[array_key_last($this->CurrentRenderer)]);
                $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetAttributes($attributes);
                break;
            case "title" :
                $this->CurrentRenderer[] = new TitleRenderer();
                $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetTemplate($this->Template);
                $this->HtmlRenderer->SetRenderer($this->CurrentRenderer[array_key_last($this->CurrentRenderer)]);
                break;
            case "link" :
                $this->CurrentRenderer[] = new LinkRenderer();
                $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetTemplate($this->Template);
                $this->HtmlRenderer->SetRenderer($this->CurrentRenderer[array_key_last($this->CurrentRenderer)]);
                $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetAttributes($attributes);
                break;
            case "body" :
                $this->CurrentRenderer[] = new BodyRenderer();
                $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetTemplate($this->Template);
                $this->HtmlRenderer->SetRenderer($this->CurrentRenderer[array_key_last($this->CurrentRenderer)]);
                break;
            case "flexcontainer" :
                $this->CurrentRenderer[] = new FlexContainerRenderer();
                $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetTemplate($this->Template);
                $this->HtmlRenderer->SetRenderer($this->CurrentRenderer[array_key_last($this->CurrentRenderer)]);
                $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetAttributes($attributes);
                break;
            case "flexitem" :
                $this->CurrentRenderer[] = new FlexItemRenderer();
                $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetTemplate($this->Template);
                $this->HtmlRenderer->SetRenderer($this->CurrentRenderer[array_key_last($this->CurrentRenderer)]);
                $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetAttributes($attributes);
                break;
            case "label" :
                $labelRenderer = new LabelRenderer();
                $labelRenderer->SetTemplate($this->Template);
                $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetRenderer($labelRenderer);
                $this->CurrentRenderer[] = $labelRenderer;
                $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetAttributes($attributes);
                break;
        }
    }

    public function EndHandler($parser, $tag) {
        array_pop($this->CurrentRenderer);
    }
    public function DataHandler($parser, $cdata) {
        if (strlen(trim($cdata)) == 0) {
            return;
        }
        $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetValue($cdata);
    }
    public function Process($parser, $target, $code) {
        if (strtolower($target) === 'php') {
            try {
                $value = eval("return $code");
                if (isset($value)) {
                    $this->CurrentRenderer[array_key_last($this->CurrentRenderer)]->SetValue($value);
                }
            }
            catch (Exception $ex) {}
        }
    }
}
