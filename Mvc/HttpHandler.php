<?php

namespace AFInfinite\Mvc;

class HttpHandler implements IHttpHandler {
    private RequestContext $RequestContext;
    
    public function __construct(RequestContext $requestContext) {
        $this->RequestContext = $requestContext;
    }
    
    public function ProcessRequest() {
        
        $factory = ControllerBuilder::GetCurrent();
        $controller = $factory->CreateController($this->RequestContext, $this->RequestContext->GetControllerName());
        $actionInvoker = $controller->CreateActionInvoker();
        $actionInvoker->Execute();
        if ($actionInvoker->HasResult()) {
            $this->RequestContext->SetActionResult($actionInvoker->GetActionResult());
        }
    }
}
