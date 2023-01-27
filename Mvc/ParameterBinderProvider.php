<?php

namespace AFInfinite\Mvc;
use ReflectionParameter;
use AFInfinite\Core\Activator;

class ParameterBinderProvider implements IParameterBinderProvider {

    const ModelBinder = "ModelBinder";
    const DefaultBinder = "DefaultBinder";

    public static function UseProviderIni() : IParameterBinderProvider {
        $ini_array = parse_ini_file(__DIR__ . "/../Config/ParameterBinderProvider.ini", true);

        $provider = Activator::CreateInstance($ini_array['Provider']);

        if (isset($ini_array['Binders'])) {
            foreach ($ini_array['Binders'] as $key => $binder) {
                $provider->SetBinder($key, Activator::CreateInstance($binder));
            }
        }
        
        return $provider;
    }
    
    private array $Binders = [];
    
    public function SetBinder(string $typeName, ParameterBinder $binder) {
        $this->Binders[$typeName] = $binder;
    }
    
    public function GetBinder(ReflectionParameter $param) : ParameterBinder {
        $name = $param->getName();

        $typeName = $param->getType()->getName();
        if (class_exists($typeName)) {
            if (isset($this->Binders[$typeName])) {
                return $this->Binders[$typeName];
            }
            else {
                return $this->GetModelBinder();
            }
        }
        else {
            return $this->GetDefaultBinder();
        }
    }
    
    private function GetModelBinder() : ParameterBinder {
        if (isset($this->Binders[self::ModelBinder])) {
            return $this->Binders[self::ModelBinder];
        }
        $this->Binders[self::ModelBinder] = new ModelParameterBinder();
        return $this->Binders[self::ModelBinder];
    }
    
    private function GetDefaultBinder() : ParameterBinder {
        if (isset($this->Binders[self::DefaultBinder])) {
            return $this->Binders[self::DefaultBinder];
        }
        $this->Binders[self::DefaultBinder] = new DefaultParameterBinder();
        return $this->Binders[self::DefaultBinder];
    }
}
