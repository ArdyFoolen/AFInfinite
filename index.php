<?php
    require __DIR__ . '/References/Requires.php';
    use AFInfinite\Mvc\Routing\RouteTable;
    use AFInfinite\Mvc\AFInfiniteApp;

    $rootPath = __DIR__;
    $app = new AFInfiniteApp();
    $app->Run();
