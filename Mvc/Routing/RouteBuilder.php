<?php

namespace AFInfinite\Mvc\Routing;

class RouteBuilder {
    
    private Route $Route;
    private string $Name;
    private bool $Ignore = false;
    
    private function SetRoute() {
        if (!$this->Ignore && !isset($this->Route) && isset($this->Name)) {
            $this->Route = new Route($this->Name);
        }
    }
    
    public function Ignore() : RouteBuilder {
        $this->Ignore = true;
        $this->Route = new Route('', true);
        return $this;
    }
    
    public function WithName(string $name) : RouteBuilder {
        $this->Name = $name;
        $this->SetRoute();
        return $this;
    }
    
    public function WithRouteHandler(IRouteHandler $routeHandler) : RouteBuilder {
        if (!isset($this->Route)) {
            return $this;
        }

        $this->Route->SetRouteHandler($routeHandler);
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
