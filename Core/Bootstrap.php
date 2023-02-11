<?php

namespace AFInfinite\Core;
use AFInfinite\Core\Activator;

class Bootstrap {

    private static array $Ini_Array;

    public static function GetInstance(string $interface) {
        self::UseBootstrapIni();
        if (!isset(self::$Ini_Array["Register"]) || !isset(self::$Ini_Array["Register"][$interface])) {
            return;
        }
        
        return Activator::CreateInstance(self::$Ini_Array["Register"][$interface]);
    }
    
    private static function UseBootstrapIni() {
        if (isset(self::$Ini_Array)) {
            return;
        }
        self::$Ini_Array = parse_ini_file(__DIR__ . "/../Config/Bootstrap.ini", true);
    }

}
