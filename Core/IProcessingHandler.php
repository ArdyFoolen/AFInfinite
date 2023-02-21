<?php

namespace AFInfinite\Core;

interface IProcessingHandler {
    public function StartHandler($parser, $tag, $attributes);
    public function EndHandler($parser, $tag);
    public function DataHandler($parser, $cdata);
    public function Process($parser, $target, $code);
}