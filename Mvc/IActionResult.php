<?php

namespace AFInfinite\Mvc;

interface IActionResult {
    
    public function SetLayout(string $fileName);
    public function Render();
}
