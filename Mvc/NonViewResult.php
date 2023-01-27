<?php

namespace AFInfinite\Mvc;

class NonViewResult implements IActionResult {
    
    private $Result;
    
    public function SetResult($result) {
        $this->Result = $result;
    }
    
    public function Render() {
        echo $this->Result;
    }
}
