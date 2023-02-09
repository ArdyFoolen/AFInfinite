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
        $actionInvoker = new ActionInvoker($this, ParameterBinderProvider::UseProviderIni());
        $actionInvoker->Initialize($this->RequestContext);
        return $actionInvoker;
    }
}
