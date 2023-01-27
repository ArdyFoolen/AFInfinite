<?php

namespace AFInfinite\Mvc;
use AFInfinite\Mvc\Application;

interface IHttpModule {
    public function Initialize(Application $application);
}
