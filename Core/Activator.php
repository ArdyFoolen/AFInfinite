<?php

namespace AFInfinite\Core;
use ReflectionClass;

class Activator {
    
    public static function CreateInstance(string $className) {
        $reflect  = new ReflectionClass($className);
        $instance = $reflect->newInstance();
        return $instance;
    }
    
    public static function CreateInstanceArgs(string $className, array $args) {
        $reflect  = new ReflectionClass($className);
        $instance = $reflect->newInstanceArgs($args);
        return $instance;
    }
}
