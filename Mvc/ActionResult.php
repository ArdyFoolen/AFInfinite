<?php

namespace AFInfinite\Mvc;
use AFInfinite\Core\XmlParser;
use AFInfinite\Core\IProcessingHandler;
use AFInfinite\Mvc\Rendering\HtmlBuilder;

abstract class ActionResult implements IActionResult, IProcessingHandler {
    
    protected RequestContext $RequestContext;
    protected string $LayoutFileName;
    
    public function SetLayout(string $fileName) {
        $this->LayoutFileName = $fileName;
    }

    public function SetRequestContext(RequestContext $requestContext) {
        $this->RequestContext = $requestContext;
    }
    
    public function Render() {
        $builder = new HtmlBuilder();
        $builder->WithXmlFile($this->LayoutFileName);
        $this->RenderBody($builder);
        $htmlRenderer = $builder->Build();
        $htmlRenderer->Render();

        // $parser = new XmlParser();
        // $parser->SetHandler(XmlParser::ProcessEvent, $this);
        // $parser->ParseFile($this->LayoutFileName);
        // $this->RenderBody();
    }

    public function StartHandler($parser, $tag, $attributes) {}
    public function EndHandler($parser, $tag) {}
    public function DataHandler($parser, $cdata) {}
    public function Process($parser, $target, $code) {
        if ($target === 'php') {
            eval($code);
        }
    }

    protected abstract function RenderBody(HtmlBuilder $builder);
}
