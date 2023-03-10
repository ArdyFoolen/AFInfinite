<?php

namespace AFInfinite\Controllers;
use AFInfinite\Mvc\Controller;
use AFInfinite\Models\TestModel;
use AFInfinite\Mvc\ViewResult;
use AFInfinite\Mvc\IActionResult;
use AFInfinite\Mvc\ActionResult;

class HomeController extends Controller {
    
    public function Index(int $id = 0) {
        
    }
    
    public function Test(TestModel $model) : ActionResult {
        return new ViewResult($model);
    }
    
    public function Return(int $id = 0) : string {
        return "This is a NonViewResult of " . $id;
    }
    
    public function ReturnInt(int $id = 0) : int {
        return $id;
    }
    
    public function NoParameters() : string {
        return "This is a NonViewResult with NO parameters";
    }
}
