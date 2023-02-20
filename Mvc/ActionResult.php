<?php

namespace AFInfinite\Mvc;
use AFInfinite\Core\XmlParser;
use AFInfinite\Core\IProcessingHandler;

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
        $parser = new XmlParser();
        $parser->SetHandler($this);
        $parser->ParseFile($this->LayoutFileName);
    }
    
    public function Process($parser, $target, $code) {
        if ($target === 'php') {
            eval($code);
        }
    }

    protected abstract function RenderBody();
}
