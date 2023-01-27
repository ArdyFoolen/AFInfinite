<?php

namespace AFInfinite\Controllers;
use AFInfinite\Mvc\Controller;
use AFInfinite\Models\TestModel;

class HomeController extends Controller {
    
    public function Index(int $id = 0) {
        
    }
    
    public function Test(TestModel $model) {
        
    }
    
    public function Return(int $id = 0) : string {
        return "This is a NonViewResult of " . $id;
    }
}
