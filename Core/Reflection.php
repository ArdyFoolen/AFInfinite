<?php

namespace AFInfinite\Core;
use ReflectionClass;

class Reflection {
    
    public static function SetPropertyValue(object $object, string $property, $value) {
        $reflect  = new ReflectionClass($object);
        $reflect->getProperty($property)->setValue($object, $value);
    }
    
    public static function GetProperties(string $typeName) : array {
        $reflect  = new ReflectionClass($typeName);
        return $reflect->getProperties();
    }
    
    public static function Implements($object, string $interface) : bool {
        if (is_object($object) && class_implements($object)) {
            return isset(class_implements($object)[$interface]);
        }
        return false;
    }
}
