<?php

namespace AFInfinite\Mvc\Routing;
use AFInfinite\Mvc\IHttpModule;
use AFInfinite\Mvc\Routing\RouteCollection;
use AFInfinite\Mvc\Application;
use AFInfinite\Mvc\RequestContext;
use AFInfinite\Mvc\IEventHandler;
use AFInfinite\Core\Directory;

class RouteModule implements IHttpModule, IEventHandler {
    
    public RouteCollection $Routes;
    
    public function __construct() {
        $this->Routes = new RouteCollection();
        RouteTable::$Routes = $this->Routes;
    }
    
    public function Initialize(Application $application) {
        $application->Register_Request(Application::ResolveRequest, $this);
        $application->Register_Request(Application::BeginRequest, $this);
        $application->Register_Request(Application::EndRequest, $this);
    }
    
    // Matches the HTTP request to a route, 
    // retrieves the handler for that route, 
    // and sets the handler as the HTTP handler for the current request.
    public function ResolveRequest(RequestContext $requestContext) {
        $this->MatchRequestToRoute($requestContext);
    }
    
    public function BeginRequest(RequestContext $requestContext) {
        $handler = $requestContext->GetRoute()->GetRouteHandler()->GetHttpHandler($requestContext);
        $handler->ProcessRequest();
    }
    
    public function EndRequest(RequestContext $requestContext) {
        $requestContext->GetPageRenderer()->Render($requestContext);
    }
    
    private function MatchRequestToRoute(RequestContext $requestContext) {
        $matchEntry = new MatchingRouteEntry();
        $matchEntry->Match($requestContext);
    }
}
