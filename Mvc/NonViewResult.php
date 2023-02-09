<?php

namespace AFInfinite\Mvc;

class NonViewResult extends ActionResult {
    
    private $Result;
    
    public function SetResult($result) {
        $this->Result = $result;
    }
    
    public function Render() {
        global $rootPath;
        require $rootPath . "/Views/Shared/Layout.php";
    }
    
    private function RenderBody() {
        echo $this->Result;
    }

}
