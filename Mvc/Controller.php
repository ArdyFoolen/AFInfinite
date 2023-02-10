<?php

namespace AFInfinite\Mvc;

class Controller implements IController {
    
    private RequestContext $RequestContext;
    
    public function GetName() : string {
        return $this->RequestContext->GetControllerName();
    }

    public function Initialize(RequestContext $requestContext) {
        $this->RequestContext = $requestContext;
    }
    
    public function CreateActionInvoker() : IActionInvoker {
        $factory = new ActionInvokerFactory();
        $invoker = $factory->Create($this, $this->RequestContext->GetAction());
        $invoker->Initialize($this->RequestContext);
        return $invoker;
    }
}
