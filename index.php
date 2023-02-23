<?php
    // debug first time start browser with the query string XDEBUG_SESSION_START=netbeans-xdebug
    // https://localhost:4443/AFInfinite/home/index?XDEBUG_SESSION_START=netbeans-xdebug

    require __DIR__ . '/References/Requires.php';
    use AFInfinite\Mvc\AFInfiniteApp;
    
    $app = new AFInfiniteApp();
    $app->Run();
