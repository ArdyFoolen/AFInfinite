<?php
    require __DIR__ . '/References/Requires.php';
    use AFInfinite\Mvc\Routing\RouteTable;
    use AFInfinite\Mvc\AFInfiniteApp;

    $rootPath = __DIR__;

    $hostName = $_SERVER['HTTP_HOST'];
    $splits = explode("htdocs", str_replace("\\", "/", $rootPath));
    $baseUrl = "https://" . $hostName . $splits[1];
    
    // use AFInfinite\Mvc\Rendering\HtmlBuilder;
    // $builder = new HtmlBuilder();
    // $htmlRenderer = $builder->WithXmlFile('\Views\Shared\Layout.xml')
    //                         ->WithXmlFile('\Views\Home\Index.xml')
    //                         ->Build();
    // $htmlRenderer->Render();
    
    $app = new AFInfiniteApp();
    $app->Run();
