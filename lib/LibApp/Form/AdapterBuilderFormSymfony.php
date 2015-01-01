<?php

namespace LibApp\Form;

use Symfony\Component\Form\Extension\Csrf\CsrfProvider\DefaultCsrfProvider;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider;
use Symfony\Component\Form\Forms;

/**
 * Description of AdapterBuilderFormSymfony
 *
 * @author mickael
 */
class AdapterBuilderFormSymfony implements IAdapterBuilderForm{
    private $_builder;
    
    public function __construct() {  
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

        $formSecret = md5(__DIR__);

        $formFactory = Forms::createFormFactoryBuilder()->getFormFactory();

        $app['form.csrf_provider'] = $app->share(function ($app) use($formSecret) {
            if (isset($app['session'])) {
                return new SessionCsrfProvider($app['session'], $formSecret);
            }
            return new DefaultCsrfProvider($formSecret);
        });
        
        $this->_builder = $formFactory;
    }
    
    public function createBuilder($type, $data) {
        $this->_builder->createBuilder($type, $data);
        return $this->_builder->getForm();
    }
    
    public function add($input, $type, $options) {
        return $this->_builder->add($input, $type, $options);
    }
}
