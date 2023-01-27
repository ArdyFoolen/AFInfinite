<?php

namespace AFInfinite\Mvc;
use AFInfinite\Mvc\Routing\MatchingRouteEntry;
use AFInfinite\Mvc\Routing\Route;

class RequestContext {
    
    private string $HttpMethod = "";
    private string $Scheme = "";
    private string $Domain = "";
    private string $Port = "";
    private string $RelativePath = "";
    private array $QueryString = array();
    
    private Route $Route;
    private string $Controller;
    private string $Action;
    private array $Parameters = [];

    private IActionResult $ActionResult;
    
    public function GetHttpMethod() : string {
        return $this->HttpMethod;
    }
    public function SetHttpMethod(string $httpMethod) {
        $this->HttpMethod = $httpMethod;
    }

    public function GetScheme() : string {
        return $this->Scheme;
    }
    public function SetScheme(string $scheme) {
        $this->Scheme = $scheme;
    }

    public function GetDomain() : string {
        return $this->Domain;
    }
    public function SetDomain(string $domain) {
        $this->Domain = $domain;
    }

    public function GetPort() : string {
        return $this->Port;
    }
    public function SetPort(string $port) {
        $this->Port = $port;
    }

    public function GetRelativePath() : string {
        return $this->RelativePath;
    }
    public function SetRelativePath(string $relativePath) {
        $this->RelativePath = $relativePath;
    }

    public function GetQueryString() : array {
        return $this->QueryString;
    }
    public function SetQueryString(array $queryString) {
        $this->QueryString = $queryString;
    }
    
    public function SetMatchingRoute(MatchingRouteEntry $matchingRoute) {
        $this->Route = $matchingRoute->GetRoute();
        $this->Controller = $matchingRoute->GetController();
        $this->Action = $matchingRoute->GetAction();
        $this->Parameters = $matchingRoute->GetParameters();
    }

    public function GetRoute() : Route {
        return $this->Route;
    }

    public function GetController() : string {
        return $this->Controller;
    }

    public function GetAction() : string {
        return $this->Action;
    }

    public function GetParameters() : array {
        return $this->Parameters;
    }
    
    public function HasResult() : bool {
        return isset($this->ActionResult);
    }
    
    public function SetActionResult(IActionResult $actionResult) {
        if (isset($actionResult)) {
            $this->ActionResult = $actionResult;
        }
    }

    public function GetActionResult() : IActionResult {
        if ($this->HasResult()) {
            return $this->ActionResult;
        }
    }
}
