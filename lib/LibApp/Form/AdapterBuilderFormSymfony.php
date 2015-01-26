<?php

namespace LibApp\Form;

use Symfony\Component\Form\Extension\Csrf\CsrfProvider\DefaultCsrfProvider;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\ResolvedFormTypeFactory;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;

/**
 * Description of AdapterBuilderFormSymfony
 *
 * @author mickael
 */
class AdapterBuilderFormSymfony implements IAdapterBuilderForm{
    
    private $_formFactory;
    
    public function __construct($app) {
        if (!class_exists('Locale') && !class_exists('Symfony\Component\Locale\Stub\StubLocale')) {
            throw new \RuntimeException('You must either install the PHP intl extension or the Symfony Locale Component to use the Form extension.');
        }

        if (!class_exists('Locale')) {
            $r = new \ReflectionClass('Symfony\Component\Locale\Stub\StubLocale');
            $path = dirname(dirname($r->getFilename())).'/Resources/stubs';

            require_once $path.'/functions.php';
            require_once $path.'/Collator.php';
            require_once $path.'/IntlDateFormatter.php';
            require_once $path.'/Locale.php';
            require_once $path.'/NumberFormatter.php';
        }
        $this->_formFactory = Forms::createFormFactoryBuilder()
                ->setResolvedTypeFactory($app['form.resolved_type_factory'])
                ->addTypeExtensions($app['form.type.extensions'])
                ->addTypes($app['form.types'])
                ->addTypeGuessers($app['form.type.guessers'])
                ->getFormFactory();
    }
        
    public function createBuildForm($data){
        return $this->_formFactory->createBuilder('form', $data);
    }
    
    public function add($input, $type, $options = array()) {
        return $this->_formFactory->add($input, $type, $options);
    }
    
    public function getForm(){
        return $this->_formFactory->getForm();
    }
}
