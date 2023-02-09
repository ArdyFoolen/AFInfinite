<?php

namespace AFInfinite\Mvc;

abstract class ActionResult implements IActionResult {

    protected RequestContext $RequestContext;
    
    public function SetRequestContext(RequestContext $requestContext) {
        $this->RequestContext = $requestContext;
    }
    
    public function Render() {
        global $rootPath;
        require $rootPath . "/Views/Shared/Layout.php";
    }

    protected abstract function RenderBody();
}
