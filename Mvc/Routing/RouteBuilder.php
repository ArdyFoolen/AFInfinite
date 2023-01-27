<?php

namespace AFInfinite\Mvc\Routing;

class RouteBuilder {
    
    private Route $Route;
    private IRouteHandler $RouteHandler;
    private string $Name;
    
    private function SetRoute() {
        if (!isset($this->Route) && isset($this->Name) && isset($this->RouteHandler)) {
            $this->Route = new Route($this->RouteHandler, $this->Name, );
        }
    }
    
    public function WithName(string $name) : RouteBuilder {
        $this->Name = $name;
        $this->SetRoute();
        return $this;
    }
    
    public function WithRouteHandler(IRouteHandler $routeHandler) : RouteBuilder {
        $this->RouteHandler = $routeHandler;
        $this->SetRoute();
        return $this;
    }
    
    public function WithUrl(string $url) : RouteBuilder {
        if (!isset($this->Route)) {
            return $this;
        }

        $this->Route->SetUrl($url);
        return $this;
    }
    
    public function WithDefaults(array $defaults) : RouteBuilder {
        if (!isset($this->Route)) {
            return $this;
        }

        $this->Route->SetDefaults($defaults);
        return $this;
    }

    public function Build() : Route {
        $this->SetRoute();
        return $this->Route;
    }
}
