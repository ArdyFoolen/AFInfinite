<?php

namespace AFInfinite\Mvc;

abstract class ActionResult implements IActionResult {

    protected RequestContext $RequestContext;
    
    public function SetRequestContext(RequestContext $requestContext) {
        $this->RequestContext = $requestContext;
    }
}
