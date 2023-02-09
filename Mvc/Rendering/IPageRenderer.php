<?php

namespace AFInfinite\Mvc\Rendering;
use AFInfinite\Mvc\RequestContext;

interface IPageRenderer {
    public function Render(RequestContext $requestContext);
}
