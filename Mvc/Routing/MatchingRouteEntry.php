<?php

namespace AFInfinite\Mvc\Routing;
use AFInfinite\Mvc\RequestContext;

class MatchingRouteEntry {
    
    private Route $Route;
    private string $ControllerName;
    private string $Action;
    private array $Parameters = [];

    public function GetRoute() : Route {
        if (!isset($this->Route)) {
            throw new Exception();
        }
        return $this->Route;
    }

    public function GetControllerName() : string {
        if (!isset($this->ControllerName)) {
            return $this->Route->GetDefaults()[Route::Controller];
        }
        return $this->ControllerName;
    }
    private function SetControllerName(string $controllerName) {
        $this->ControllerName = $controllerName;
    }

    public function GetAction() : string {
        if (!isset($this->Action)) {
            return $this->Route->GetDefaults()[Route::Action];
        }
        return $this->Action;
    }
    private function SetAction(string $action) {
        $this->Action = $action;
    }
    
    public function GetParameters() : array {
        return $this->Parameters;
    }
    
    public function Match(RequestContext $requestContext) : bool {
        foreach (RouteTable::$Routes->Routes as $route) {
            $this->Route = $route;
            $requestData = array_filter($this->GetRequestData($requestContext));
            $routeData = explode("/", $route->GetUrl());

            if (!$this->IgnoreRoute($route, $routeData, $requestData)) {
                if ($this->IsMatch($routeData, $requestData)) {
                    $requestContext->SetMatchingRoute($this);
                    return true;
                }
            }
            else {
                return false;
            }
        }

        return false;
    }

    private function IgnoreRoute(Route $route, array $routeData, array $requestData) : bool {
        if ($route->Ignore() && count($routeData) === count($requestData)) {
            for ($index = 0; $index < count($requestData); $index += 1) {
                $match = preg_match('/(?i)(' . $routeData[$index] . ')/', $requestData[$index]);
                if ($match !== 1) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }
    
    private function IsMatch(array $routeData, array $requestData) : bool {
        for ($index = 0; $index < count($requestData); $index += 1) {
            if ($index > count($routeData)) {
                return false;
            }
            if ($this->IfControllerSet($routeData[$index], $requestData[$index])) {
                continue;
            }
            if ($this->IfActionSet($routeData[$index], $requestData[$index])) {
                continue;
            }
            if ($this->IfRouteParameterSet($routeData[$index], $requestData[$index])) {
                continue;
            }
            if ($requestData[$index] === $routeData[$index]) {
                continue;
            }
            return false;
        }

        for ($index = count($requestData); $index < count($routeData); $index += 1) {
            if ($this->IfDefaultControllerSet($routeData[$index])) {
                continue;
            }
            if ($this->IfDefaultActionSet($routeData[$index])) {
                continue;
            }
            if ($this->IsOptionalParameter($routeData[$index])) {
                continue;
            }

            return false;
        }
        
        return true;
    }
    
    private function IfControllerSet(string $routeParm, string $requestParm) : bool {
        if ($routeParm === "{" . Route::Controller . "}") {
            $this->SetControllerName($requestParm);
            return true;
        }
        return false;
    }
    
    private function IfDefaultControllerSet(string $routeParm) : bool {
        if ($routeParm === "{" . Route::Controller . "}") {
            $this->SetControllerName($this->Route->GetDefaults()[Route::Controller]);
            return true;
        }
        return false;
    }
    
    private function IfActionSet(string $routeParm, string $requestParm) : bool {
        if ($routeParm === "{" . Route::Action . "}") {
            $this->SetAction($requestParm);
            return true;
        }
        return false;
    }
    
    private function IfDefaultActionSet(string $routeParm) : bool {
        if ($routeParm === "{" . Route::Action . "}") {
            $this->SetAction($this->Route->GetDefaults()[Route::Action]);
            return true;
        }
        return false;
    }
    
    private function IsRouteParameter(string $routeParm) : bool {
        return strpos($routeParm, "{") === 0 && strpos($routeParm, "}") === (strlen($routeParm) - 1);
    }
    
    private function GetRouteParameter(string $routeParm) : string {
        return substr($routeParm, 1, strlen($routeParm) - 2);
    }
    
    private function IfRouteParameterSet(string $routeParm, string $requestParm) : bool {
        if ($this->IsRouteParameter($routeParm)) {
            $this->Parameters[$this->GetRouteParameter($routeParm)] = $requestParm;
            return true;
        }
        return false;
    }
    
    private function IsOptionalParameter(string $routeParm) : bool {
        if ($this->IsRouteParameter($routeParm)) {
            $key = $this->GetRouteParameter($routeParm);
            if (isset($this->Route->GetDefaults()[$key]) && $this->Route->GetDefaults()[$key] === UrlParameter::$Optional) {
                return true;
            }
        }
        return false;
    }
    
    private function GetRequestData(RequestContext $requestContext) : array {
        $requestData = explode("/", $requestContext->GetRelativePath());
        if ($requestData[0] === '') {
            unset($requestData[0]);
            $requestData = array_values($requestData);
        }
        return $requestData;
    }
}
