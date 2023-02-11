<?php

namespace AFInfinite\Mvc;
use AFInfinite\Mvc\Rendering\IPageRenderer;
use AFInfinite\Mvc\Rendering\IPageRendererFactory;
use AFInfinite\Mvc\Rendering\PageRendererFactory;
use AFInfinite\Core\Bootstrap;

class ControllerBuilder {
    
    private static IControllerFactory $Default;
    private IControllerFactory $Current;
    private RequestContext $RequestContext;
    private IPageRendererFactory $RendererFactory;
    
    public static function SetDefault(IControllerFactory $factory) {
        self::$Default = $factory;
    }
    
    public function UseRendererFactory() : ControllerBuilder {
        $this->RendererFactory = Bootstrap::GetInstance("AFInfinite\Mvc\Rendering\IPageRendererFactory");
        return $this;
    }
    
    public function UseControllerFactory() : ControllerBuilder {
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
        $actionResult = $actionInvoker->Execute();
        $renderer = $this->RendererFactory->Create($this->RequestContext->GetController()->GetName(), $this->RequestContext->GetAction(), $actionResult);
        $this->RequestContext->SetPageRenderer($renderer);
    }
}
