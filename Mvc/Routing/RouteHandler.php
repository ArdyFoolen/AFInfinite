<?php

namespace AFInfinite\Mvc\Routing;
use AFInfinite\Mvc\RequestContext;
use AFInfinite\Mvc\IHttpHandler;
use AFInfinite\Mvc\HttpHandler;

class RouteHandler implements IRouteHandler {
    private static IRouteHandler $Default;
    public static function GetDefault() : IRouteHandler {
        if (!isset(self::$Default)) {
            self::$Default = new RouteHandler();
        }
        
        return self::$Default;
    }
    
    public function GetHttpHandler(RequestContext $requestContext) : IHttpHandler {
        return new HttpHandler($requestContext);
    }
}
