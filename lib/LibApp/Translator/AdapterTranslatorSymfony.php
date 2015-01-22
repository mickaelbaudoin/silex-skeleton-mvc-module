<?php

namespace LibApp\Translator;
use \Symfony\Component\Translation\TranslatorInterface;

/**
 * Description of AdapterTranslatorSymfony
 *
 * @author mickael
 */
class AdapterTranslatorSymfony implements ITranslator, TranslatorInterface{
    /**
     * @var \Symfony\Component\Translation\Translator $_translator
     */
    private $_translator;
    
    public function __construct(\Symfony\Component\Translation\Translator $translator) {
        $this->_translator = $translator;
    }
    
    public function addLoader($format, $loader) {
        $this->_translator->addLoader($format, $loader);
    }

    public function addRessource($format, $resource, $locale) {
        $this->_translator->addResource($format, $resource, $locale);
    }

    public function getlocale() {
        return $this->_translator->getLocale();
    }

    public function setLocale($locale) {
        $this->_translator->setLocale($locale);
    }

    public function transChoice($id, $number, array $parameters = array(), $domain = null, $locale = null) {
        return $this->_translator->transChoice($id, $number, $parameters, $domain, $locale);
    }

    public function trans($id, array $parameters = array(), $domain = null, $locale = null) {
        return $this->_translator->trans($id, $parameters, $domain, $locale);
    }

}
