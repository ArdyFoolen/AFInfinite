<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
//            function exceptions_error_handler($severity, $message, $filename, $lineno) {
//                throw new ErrorException($message, 0, $severity, $filename, $lineno);
//            }
//            set_error_handler('exceptions_error_handler');
            use AFInfinite\Mvc\Routing\RouteTable;
            
            //throw new Exception();
            $var = __DIR__ . '/References/Requires.php';
            echo "<p>$var</p>";
            require __DIR__ . '/References/Requires.php';
            echo "<p>$var</p>";
            use AFInfinite\Mvc\AFInfiniteApp;

            $app = new AFInfiniteApp();
            $app->Run();
            echo "<p>Return response</p>";
            
            $routes = RouteTable::$Routes;
            $context = $app->RequestContext;

//----------------------------------------------
            $request = $_SERVER['REQUEST_URI'];
            echo "<p>$request</p>";
            $request_arr = explode ("?", $request);
            echo "<p>$request_arr[0]</p>";
            if (array_key_exists(1, $request_arr)) {
                echo "<p>$request_arr[1]</p>";
            }
            
            switch ($request_arr[0]) {

                case '':
                case '/':
                case '/index.php':
                case '/AFInfinite':
                case '/AFInfinite/':
                case '/AFInfinite/index.php':
                    require __DIR__ . '/Views/index.php';
                    break;

                case '/home':
                case '/home/':
                case '/AFInfinite/home':
                case '/AFInfinite/home/':
                    require __DIR__ . '/Views/home.php';
                    break;

                case '/403':
                case '/AFInfinite/403':
                    http_response_code(403);
                    require __DIR__ . '/Views/403.php';
                    break;

                case '/404':
                case '/AFInfinite/404':
                    http_response_code(404);
                    require __DIR__ . '/Views/404.php';
                    break;
                
                default:
                    http_response_code(500);
                    require __DIR__ . '/Views/500.php';
                    break;
            }
        ?>
    </body>
</html>
