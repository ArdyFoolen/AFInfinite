<?php

namespace AFInfinite\Mvc;

abstract class ActionResult implements IActionResult {

    protected RequestContext $RequestContext;
    protected string $LayoutFileName;
    
    public function SetLayout(string $fileName) {
        $this->LayoutFileName = $fileName;
    }

    public function SetRequestContext(RequestContext $requestContext) {
        $this->RequestContext = $requestContext;
    }
    
    public function Render() {
        require $this->LayoutFileName;
    }

    protected abstract function RenderBody();
}
