<?php

namespace LibApp\Translator;

/**
 * Description of FactoryAdapterTranslator
 *
 * @author mickael
 */
class FactoryAdapterTranslator {
    
    public static function createTranslator($name, $locale = 'fr'){
        switch ($name){
            case "symfony":
                return new AdapterTranslatorSymfony(new \Symfony\Component\Translation\Translator($locale));
        }
    }
}
