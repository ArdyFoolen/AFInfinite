<?php

namespace AFInfinite\Core;
use ReflectionClass;
use ReflectionException;

class Reflection {
    
    public static function GetTypeName(object $object) : string {
        return get_class($object);
    }
    
    public static function SetPropertyValue(object $object, string $property, $value) {
        $reflect  = new ReflectionClass($object);
        $reflect->getProperty($property)->setValue($object, $value);
    }
    
    public static function HasProperty(object $object, string $property) : bool {
        $reflect = new ReflectionClass($object);
        return $reflect->getProperty($property) !== null;
    }
    public static function GetProperty(object $object, string $property) {
        $reflect = new ReflectionClass($object);
        return $reflect->getProperty($property)->getValue($object);
    }
    
    public static function GetProperties(string $typeName) : array {
        $reflect  = new ReflectionClass($typeName);
        return $reflect->getProperties();
    }
    
    public static function Implements($object, string $interface) {
        if (is_object($object) && class_implements($object)) {
            return isset(class_implements($object)[$interface]);
        }
        return false;
    }

    public static function ImplementsClass($className, string $interface) : bool {
        try
        {
            $reflection = new ReflectionClass($className);
            return $reflection->implementsInterface($interface);
        } catch (ReflectionException $ex) {
            return false;
        }
    }
}
