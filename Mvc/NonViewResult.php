<?php

namespace AFInfinite\Mvc;

class NonViewResult extends ActionResult {
    
    private $Result;
    
    public function SetResult($result) {
        $this->Result = $result;
    }
    
    public function Render() {
        echo $this->Result;
    }
}
