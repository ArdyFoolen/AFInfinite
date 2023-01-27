<?php

namespace AFInfinite\Mvc\Routing;

class RouteConfig {
    public static function RegisterRoutes(RouteCollection $routes) {
        $routes->UseRoutingIni();
    }
}