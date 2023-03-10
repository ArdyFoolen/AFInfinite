<?php

namespace AFInfinite\Core;

class Directory {
    
    public static function ScanRecursive(string $root, array $subDirs, int $index = 0) {
        global $rootPath;
        if ($index >= count($subDirs)) {
            return $root;
        }
        
        $directories = scandir($rootPath . $root);
        foreach ($directories as $dir) {
            if (strtolower($subDirs[$index]) === strtolower($dir)) {
                return self::ScanRecursive($root . "/" . $dir, $subDirs, $index + 1);
            }
        }
        return false;
    }
    
}
