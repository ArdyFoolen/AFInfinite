<?php
    require __DIR__ . "/../Globals.php";
    require __DIR__ . "/../Core/Directory.php";
    require __DIR__ . "/../Core/Activator.php";
    require __DIR__ . "/../Core/Reflection.php";
    require __DIR__ . "/../Core/Bootstrap.php";
    require __DIR__ . "/../Core/XmlParser.php";
    require __DIR__ . "/../Core/IProcessingHandler.php";

    require __DIR__ . "/../Mvc/Routing/IRouteHandler.php";
    require __DIR__ . "/../Mvc/Routing/Route.php";
    require __DIR__ . "/../Mvc/Routing/RouteHandler.php";
    require __DIR__ . "/../Mvc/Routing/RouteTable.php";
    require __DIR__ . "/../Mvc/Routing/UrlParameter.php";

    require __DIR__ . "/../Mvc/Application.php";
    require __DIR__ . "/../Mvc/ControllerBuilder.php";
    require __DIR__ . "/../Mvc/IController.php";
    require __DIR__ . "/../Mvc/Controller.php";
    require __DIR__ . "/../Mvc/IControllerFactory.php";
    require __DIR__ . "/../Mvc/IEventHandler.php";
    require __DIR__ . "/../Mvc/IHttpHandler.php";
    require __DIR__ . "/../Mvc/IHttpModule.php";
    require __DIR__ . "/../Mvc/IActionResult.php";
    require __DIR__ . "/../Mvc/RequestContext.php";
    require __DIR__ . "/../Mvc/RequestContextBuilder.php";
    require __DIR__ . "/../Mvc/Routing/RouteConfig.php";

    require __DIR__ . "/../Mvc/Rendering/RenderingTemplate.php";
    require __DIR__ . "/../Mvc/Rendering/IPageRenderer.php";
    require __DIR__ . "/../Mvc/Rendering/PageRenderer.php";
    require __DIR__ . "/../Mvc/Rendering/IPageRendererFactory.php";
    require __DIR__ . "/../Mvc/Rendering/PageRendererFactory.php";
    require __DIR__ . "/../Mvc/Rendering/HtmlBuilder.php";
    require __DIR__ . "/../Mvc/Rendering/HtmlElementBuilder.php";
    require __DIR__ . "/../Mvc/Rendering/HtmlRenderer.php";
    require __DIR__ . "/../Mvc/Rendering/HeadRenderer.php";
    require __DIR__ . "/../Mvc/Rendering/MetaRenderer.php";
    require __DIR__ . "/../Mvc/Rendering/TitleRenderer.php";
    require __DIR__ . "/../Mvc/Rendering/LinkRenderer.php";
    require __DIR__ . "/../Mvc/Rendering/BodyRenderer.php";
    require __DIR__ . "/../Mvc/Rendering/LabelRenderer.php";
    require __DIR__ . "/../Mvc/Rendering/FlexContainerRenderer.php";
    require __DIR__ . "/../Mvc/Rendering/FlexItemRenderer.php";

    require __DIR__ . "/../Mvc/IParameterBinderProvider.php";
    require __DIR__ . "/../Mvc/ParameterBinderProvider.php";
    require __DIR__ . "/../Mvc/ParameterBinder.php";
    require __DIR__ . "/../Mvc/ModelParameterBinder.php";
    require __DIR__ . "/../Mvc/DefaultParameterBinder.php";
    require __DIR__ . "/../Mvc/IActionInvoker.php";
    require __DIR__ . "/../Mvc/ActionInvoker.php";
    require __DIR__ . "/../Mvc/ActionResultInvoker.php";
    require __DIR__ . "/../Mvc/ActionNoResultInvoker.php";
    require __DIR__ . "/../Mvc/ActionSpecificInvoker.php";

    require __DIR__ . "/../Mvc/Routing/RouteBuilder.php";
    require __DIR__ . "/../Mvc/Routing/RouteCollection.php";
    require __DIR__ . "/../Mvc/Routing/MatchingRouteEntry.php";
    require __DIR__ . "/../Mvc/Routing/RouteModule.php";
    require __DIR__ . "/../Mvc/HttpHandler.php";
    require __DIR__ . "/../Mvc/DefaultControllerFactory.php";
    require __DIR__ . "/../Mvc/AFInfiniteApp.php";

    require __DIR__ . "/../Mvc/ActionResult.php";
    require __DIR__ . "/../Mvc/NonViewResult.php";
    require __DIR__ . "/../Mvc/ViewResult.php";
    require __DIR__ . "/../Mvc/ActionInvokerFactory.php";

    require __DIR__ . "/../Models/TestModel.php";
    require __DIR__ . "/../Controllers/HomeController.php";
