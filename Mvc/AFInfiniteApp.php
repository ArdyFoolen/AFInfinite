<?php

namespace AFInfinite\Mvc;
use AFInfinite\Mvc\Application;
use AFInfinite\Mvc\Routing\RouteConfig;
use AFInfinite\Mvc\Routing\RouteTable;

class AFInfiniteApp extends Application {

    protected function Application_Start() {
        RouteConfig::RegisterRoutes(RouteTable::$Routes);
    }
}
