<?php

namespace AFInfinite\Mvc;
use AFInfinite\Mvc\Rendering\HtmlBuilder;

class NonViewResult extends ActionResult {
    
    private $Result;
    
    public function SetResult($result) {
        $this->Result = $result;
    }
    
    protected function RenderBody(HtmlBuilder $builder) {
        $builder->WithXml($this->Result);
    }
}
