<?php

namespace AFInfinite\Mvc;

interface IEventHandler {
    public function BeginRequest(RequestContext $requestContext);
    public function ResolveRequest(RequestContext $requestContext);
    public function EndRequest(RequestContext $requestContext);
}
