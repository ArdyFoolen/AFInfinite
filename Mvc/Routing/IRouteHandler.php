<?php

namespace AFInfinite\Mvc\Routing;
use AFInfinite\Mvc\RequestContext;
use AFInfinite\Mvc\IHttpHandler;

interface IRouteHandler {
    public function GetHttpHandler(RequestContext $requestContext) : IHttpHandler;
}
