<?php

namespace AFInfinite\Mvc;
use ReflectionParameter;

class DefaultParameterBinder extends ParameterBinder {
    public function Bind(array $urlParameters, ReflectionParameter $param, array &$binds) {
        $name = $param->getName();
        if ($this->HasParameter($urlParameters, $name)) {
            $binds[$name] = $this->GetParameter($urlParameters, $name);
        }
        else if ($param->isOptional()) {
            $binds[$name] = $param->getDefaultValue();
        }
        else {
            throw new Exception();
        }
    }
}
