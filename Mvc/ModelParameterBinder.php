<?php

namespace AFInfinite\Mvc;
use ReflectionParameter;
use AFInfinite\Core\Activator;
use AFInfinite\Core\Reflection;
use Exception;

class ModelParameterBinder extends ParameterBinder {
    public function Bind(array $urlParameters, ReflectionParameter $param, array &$binds) {
        $name = $param->getName();
        $typeName = $param->getType()->getName();
        if (class_exists($typeName)) {
            $model = Activator::CreateInstance($typeName);
            $binds[$name] = $model;

            $props = Reflection::GetProperties($typeName);
            foreach ($props as $prop) {
                $propName = $prop->getName();
                if ($this->HasParameter($urlParameters, $propName)) {
                    Reflection::SetPropertyValue($model, $prop->getName(), $this->GetParameter($urlParameters, $propName));
                }
            }
            
            return $model;
        }
        else {
            throw new Exception();
        }
    }
}
