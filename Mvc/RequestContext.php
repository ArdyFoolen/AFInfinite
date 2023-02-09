<?php

namespace AFInfinite\Mvc;
use AFInfinite\Mvc\Routing\MatchingRouteEntry;
use AFInfinite\Mvc\Routing\Route;
use AFInfinite\Mvc\Rendering\IPageRenderer;

class RequestContext {
    
    private string $HttpMethod = "";
    private string $Scheme = "";
    private string $Domain = "";
    private string $Port = "";
    private string $RelativePath = "";
    private array $QueryString = array();
    
    private Route $Route;
    private string $ControllerName;
    private string $Action;
    private array $Parameters = [];

    private IController $Controller;
    private IActionInvoker $ActionInvoker;
    private IPageRenderer $PageRenderer;
    
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
        $this->ControllerName = $matchingRoute->GetControllerName();
        $this->Action = $matchingRoute->GetAction();
        $this->Parameters = $matchingRoute->GetParameters();
    }

    public function GetRoute() : Route {
        return $this->Route;
    }

    public function GetControllerName() : string {
        return $this->ControllerName;
    }

    public function GetAction() : string {
        return $this->Action;
    }

    public function GetParameters() : array {
        return $this->Parameters;
    }

    public function SetPageRenderer(IPageRenderer $pageRenderer) {
        if (isset($pageRenderer)) {
            $this->PageRenderer = $pageRenderer;
        }
    }

    public function GetPageRenderer() : IPageRenderer {
        if (isset($this->PageRenderer)) {
            return $this->PageRenderer;
        }
    }
    
    public function GetController() : IController {
        if (isset($this->Controller)) {
            return $this->Controller;
        }
        throw new Exception();
    }
    public function SetController(IController $controller) {
        $this->Controller = $controller;
    }
    
    public function GetActionInvoker() : IActionInvoker {
        if (isset($this->ActionInvoker)) {
            return $this->ActionInvoker;
        }
        throw new Exception();
    }
    public function SetActionInvoker(IActionInvoker $actionInvoker) {
        $this->ActionInvoker = $actionInvoker;
    }
}
