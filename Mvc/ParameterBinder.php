<?php

namespace AFInfinite\Mvc;
use ReflectionParameter;

abstract class ParameterBinder {
    public abstract function Bind(array $urlParameters, ReflectionParameter $param, array &$binds);
    
    protected function HasParameter(array $parameters, string $name) : bool {
        return isset($parameters[strtolower($name)]);
    }
    
    protected function GetParameter(array $parameters, string $name) : string {
        return $parameters[strtolower($name)];
    }
}