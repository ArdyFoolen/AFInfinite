<?php

namespace AFInfinite\Mvc;
use ReflectionParameter;

interface IParameterBinderProvider {
    public function SetBinder(string $typeName, ParameterBinder $binder);
    public function GetBinder(ReflectionParameter $param) : ParameterBinder;
}