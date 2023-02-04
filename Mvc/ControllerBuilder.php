<?php

namespace AFInfinite\Mvc;

class ControllerBuilder {
    
    private static IControllerFactory $Default;
    private IControllerFactory $Current;
    private REquestContext $RequestContext;
    
    public static function SetDefault(IControllerFactory $factory) {
        self::$Default = $factory;
    }
    
    public function UseFactory() : ControllerBuilder {
        if (isset(self::$Default)) {
            $this->Current = self::$Default;
        }
        else {
            $this->Current = new DefaultControllerFactory();
        }

        return $this;
    }
    
    public function WithRequestContext(RequestContext $requestContext) : ControllerBuilder {
        $this->RequestContext = $requestContext;
        
        return $this;
    }
    
    public function CreateController() : ControllerBuilder {
        $this->RequestContext->SetController($this->Current->CreateController($this->RequestContext, $this->RequestContext->GetControllerName()));
        
        return $this;
    }
    
    public function CreateActionInvoker() : ControllerBuilder {
        $this->RequestContext->SetActionInvoker($this->RequestContext->GetController()->CreateActionInvoker());
        
        return $this;
    }
    
    public function Execute() {
        $actionInvoker = $this->RequestContext->GetActionInvoker();
        $actionInvoker->Execute();
        if ($actionInvoker->HasResult()) {
            $this->RequestContext->SetActionResult($actionInvoker->GetActionResult());
        }
    }
}
