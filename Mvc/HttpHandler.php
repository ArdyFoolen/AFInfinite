<?php

namespace AFInfinite\Mvc;

class HttpHandler implements IHttpHandler {
    private RequestContext $RequestContext;
    
    public function __construct(RequestContext $requestContext) {
        $this->RequestContext = $requestContext;
    }
    
    public function ProcessRequest() {
        
        (new ControllerBuilder())
                ->UseRendererFactory()
                ->UseControllerFactory()
                ->WithRequestContext($this->RequestContext)
                ->CreateController()
                ->CreateActionInvoker()
                ->Execute();
    }
}
