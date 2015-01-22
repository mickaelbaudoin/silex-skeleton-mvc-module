<?php

namespace LibApp\Translator;

/**
 *
 * @author mickael
 */
interface ITranslator {
    
    /**
    * Translates the given message.
    *
    * @param string      $id         The message id (may also be an object that can be cast to string)
    * @param array       $parameters An array of parameters for the message
    * @param string|null $domain     The domain for the message or null to use the default
    * @param string|null $locale     The locale or null to use the default
    * 
    */
    public function trans($id, array $parameters = array(), $domain = null, $locale = null);
    
    public function transChoice($id, $number, array $parameters = array(), $domain = null, $locale = null);
    
    public function setLocale($locale);
    
    public function getlocale();
    
    public function addRessource($format, $resource, $locale);
    
    public function addLoader($format, $loader);
}
