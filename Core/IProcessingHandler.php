<?php

namespace AFInfinite\Core;

interface IProcessingHandler {
    public function Process($parser, $target, $code);
}