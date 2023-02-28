<?php

namespace AFInfinite\Mvc\Routing;
use Exception;

class RouteCollection {
    
    public array $Routes = [];
    
    public function UseRoutingIni() {
        $ini_array = parse_ini_file(__DIR__ . "/../../Config/Routing.ini", true);

        foreach ($ini_array as $key => $value) {
            if ($key === 'Ignores') {
                $this->IgnoreRoutes($value['urls']);
            }
            else {
                $this->MapRoute($key, $value['url'], $value['defaults']);
            }
        }
    }
    
    private function IgnoreRoutes(array $urls) {
        
        foreach ($urls as $url) {
            $this->Routes[] = (new RouteBuilder())
                ->Ignore()
                ->WithUrl($url)
                ->Build();
        }
    }
    
    // Add you custom route handler here with RouteConfig->RegisterRoutes
    public function Add(string $name, IRouteHandler $routeHandler) {
        
        if (array_key_exists($name, $this->Routes)) {
            throw new Exception();
        }
        
        $this->Routes[$name] = (new RouteBuilder())
                ->WithName($name)
                ->WithRouteHandler($routeHandler)
                ->WithUrl($name)
                ->Build();
    }
    
    public function MapRoute(string $name, string $url, array $inidefaults) {
        
        if (array_key_exists($name, $this->Routes)) {
            throw new Exception();
        }
        
        $urlParts = $this->getUrlParts($url);
        $defaults = $this->makeAssociativeDefaults($urlParts, $inidefaults);

        $this->Routes[$name] = (new RouteBuilder())
                ->WithName($name)
                ->WithRouteHandler(RouteHandler::GetDefault())
                ->WithUrl($url)
                ->WithDefaults($defaults)
                ->Build();
    }
    
    private function makeAssociativeDefaults(array $urlParts, array $iniDefaults) : array {
        $defaults = [];
        if (count($urlParts) >= count($iniDefaults)) {
            for ($i = 0; $i < count($iniDefaults); $i++) {
                $defaults[$urlParts[$i]] = $iniDefaults[$i];
            }
        }
        return $defaults;
    }   
    
    private function getUrlParts(string $url) : array {

        $array = [];
        $offset = 0;

        while (strpos($url, "{", $offset) !== false) {
            $offset = strpos($url, "{", $offset) + 1;
            $length = strpos($url, "}", $offset) - $offset;
            $array[] = substr($url, $offset, $length);
        }

        return $array;
    }
}
