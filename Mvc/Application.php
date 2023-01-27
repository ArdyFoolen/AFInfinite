<?php

namespace AFInfinite\Mvc;

use AFInfinite\Core\Activator;
use AFInfinite\Mvc\IEventHandler;

abstract class Application {
    
    public const BeginRequest = "BeginRequest";
    public const ResolveRequest = "ResolveRequest";
    public const EndRequest = "EndRequest";
    private array $RequestEvent = [];

    private array $Modules = [];
    public RequestContext $RequestContext;
    
    public function Run() {
        $this->Application_Initialize();
        $this->Application_Start();
        $this->Application_ResolveRequest();
        $this->Application_BeginRequest();
        $this->Application_EndRequest();
    }

    public function Register_Request(string $key, IEventHandler $handler) {
        $this->RequestEvent[$key][] = $handler;
    }

    protected function Application_Initialize() {
        $this->UseModulesIni();
        
        foreach ($this->Modules as $module) {
            $module->Initialize($this);
        }
        
        $this->SetRequestContext();
    }
    
    protected function Application_Start() {
    }
    
    protected function Application_ResolveRequest() {
        foreach ($this->RequestEvent[Application::ResolveRequest] as $event) {
            $event->ResolveRequest($this->RequestContext);
        }
    }
    
    protected function Application_BeginRequest() {
        foreach ($this->RequestEvent[Application::BeginRequest] as $event) {
            $event->BeginRequest($this->RequestContext);
        }
    }

    protected function Application_EndRequest() {
        foreach ($this->RequestEvent[Application::EndRequest] as $event) {
            $event->EndRequest($this->RequestContext);
        }
    }
    
    private function SetRequestContext() {
        $builder = new RequestContextBuilder();
        $this->RequestContext = $builder->WithHttpMethod()
                                 ->WithScheme()
                                 ->WithDomain()
                                 ->WithPort()
                                 ->WithRelativePath()
                                 ->WithQueryString()
                                 ->Build();
    }
    
    private function UseModulesIni() {
        $ini_array = parse_ini_file(__DIR__ . "/../Config/Modules.ini", true);

        foreach ($ini_array['Modules']['Types'] as $value) {
            $this->Modules[] = Activator::CreateInstance($value);
        }
    }

}