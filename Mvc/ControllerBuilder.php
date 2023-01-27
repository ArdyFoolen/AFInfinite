<?php

namespace AFInfinite\Mvc;

class ControllerBuilder {
    
    private static IControllerFactory $Current;
    
    public static function SetCurrent(IControllerFactory $factory) {
        self::$Current = $factory;
    }
    
    public static function GetCurrent() : IControllerFactory {
        
        if (isset(self::$Current)) {
            return self::$Current;
        }
        
        return new DefaultControllerFactory();
    }
}
