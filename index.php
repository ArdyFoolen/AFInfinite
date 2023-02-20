<?php
    require __DIR__ . '/References/Requires.php';
    use AFInfinite\Mvc\Routing\RouteTable;
    use AFInfinite\Mvc\AFInfiniteApp;

    $rootPath = __DIR__;

    $hostName = $_SERVER['HTTP_HOST'];
    $splits = explode("htdocs", str_replace("\\", "/", $rootPath));
    $baseUrl = "https://" . $hostName . $splits[1];

//    use AFInfinite\Core\XmlParser;
//    $parser = new XmlParser();
//    $parser->Parse("<A ID='hallo'>PHP</A>");
//    $parser = new XmlParser();
//    $parser->Parse("<BOOKS><BOOK CATALOG='Humor'>Book 1</BOOK><BOOK CATALOG='Horror'>Book 2</BOOK></BOOKS>");
//    $parser = new XmlParser();
//    $parser->Parse("<BOOK CATALOG='Action'>Book 3</BOOK><BOOK CATALOG='Thriller'>Book 4</BOOK>");
//    $parser = new XmlParser();
//    $parser->Parse("<BOOK CATALOG='Action'>Book 5</BOOK>");
//    $parser = new XmlParser();
//    $parser->Parse("<BOOK CATALOG='Thriller'>Book 6</BOOK>");
//    $parser = new XmlParser();
//    $parser->ParseFile($rootPath . '\Views\Shared\Layout.xhtml');
    
    use AFInfinite\Mvc\Rendering\HtmlRenderer;
    use AFInfinite\Mvc\Rendering\HeadRenderer;
    use AFInfinite\Mvc\Rendering\MetaRenderer;
    use AFInfinite\Mvc\Rendering\TitleRenderer;
    use AFInfinite\Mvc\Rendering\LinkRenderer;
    use AFInfinite\Mvc\Rendering\BodyRenderer;
    use AFInfinite\Mvc\Rendering\LabelRenderer;
    $htmlRenderer = new HtmlRenderer();
    $headRenderer = new HeadRenderer();
    $metaRenderer = new MetaRenderer();
    $metaRenderer->SetAttributes(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0', 'charset' => 'UTF-8'));
    $titleRenderer = new TitleRenderer("Test Title");
    $linkRenderer = new LinkRenderer("/Css/Body.css");

    $bodyRenderer = new BodyRenderer();
    $labelRenderer = new LabelRenderer("Test Label");
    $bodyRenderer->SetRenderer($labelRenderer);

    $htmlRenderer->SetRenderer($headRenderer);
    $htmlRenderer->SetRenderer($metaRenderer);
    $htmlRenderer->SetRenderer($titleRenderer);
    $htmlRenderer->SetRenderer($linkRenderer);
    $htmlRenderer->SetRenderer($bodyRenderer);
    $htmlRenderer->Render();
    
    $app = new AFInfiniteApp();
    $app->Run();
