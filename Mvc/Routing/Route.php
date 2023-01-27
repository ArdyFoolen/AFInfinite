<?php

namespace AFInfinite\Mvc\Routing;

class Route {
    
    public const Controller = "controller";
    public const Action = "action";
    
    private IRouteHandler $RouteHandler;
    private string $Name = "";
    private string $Url = "";
    private array $Defaults = array();
    private bool $Ignore = false;
    
    public function __construct(string $name, bool $ignore = false) {
        $this->Name = $name;
        $this->Ignore = $ignore;
    }
    
    public function GetUrl() : string {
        return $this->Url;
    }
    public function SetUrl(string $url) {
        $this->Url = $url;
    }
    
    public function GetDefaults() : array {
        return $this->Defaults;
    }
    public function SetDefaults(array $defaults) {
        $this->Defaults = $defaults;
    }
    
    public function GetRouteHandler() : IRouteHandler {
        return $this->RouteHandler;
    }
    public function SetRouteHandler(IRouteHandler $routeHandler) {
        $this->RouteHandler = $routeHandler;
    }
    
    public function Ignore() : bool {
        return $this->Ignore;
    }
}
