<?php

namespace AFInfinite\Mvc;

class NonViewResult extends ActionResult {
    
    private $Result;
    
    public function SetResult($result) {
        $this->Result = $result;
    }
    
    protected function RenderBody() {
        echo $this->Result;
    }

}
