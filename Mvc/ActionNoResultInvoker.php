<?php

namespace AFInfinite\Mvc;
use AFInfinite\Core\Directory;

class ActionNoResultInvoker extends ActionInvoker {
    public function __construct(IController $controller, string $action, IParameterBinderProvider $provider) {
        parent::__construct($controller, $action, $provider);
    }

    protected function GetActionResult($returnValue) : IActionResult {
        $result = new NonViewResult();
        $result->SetResult($this->GetFileContents());
        return $result;
    }
    
    private function GetFileContents() : string {
        $fileName = Directory::ScanRecursive("/Views", array($this->Controller->GetName(), $this->Action . ".xml"));
        return file_get_contents($fileName);
    }
}
