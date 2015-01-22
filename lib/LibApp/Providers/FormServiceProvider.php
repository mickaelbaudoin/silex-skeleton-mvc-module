<?php

namespace LibApp\Providers;

use Silex\ServiceProviderInterface;
use Silex\Application;
use LibApp\Form\FactoryAdapterBuilderForm;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\DefaultCsrfProvider;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider;
use Symfony\Component\Form\Extension\HttpFoundation\Type\FormTypeHttpFoundationExtension;
use Symfony\Component\Form\ResolvedFormTypeFactory;

/**
 * Description of FormServiceProvider
 *
 * @author mickael
 */
class FormServiceProvider implements ServiceProviderInterface {

    public function register(Application $app) {
        $formSecret = md5(__DIR__);

        $app['form.csrf_provider'] = $app->share(function ($app) use($formSecret) {
            if (isset($app['session'])) {
                return new SessionCsrfProvider($app['session'], $formSecret);
            }
            return new DefaultCsrfProvider($formSecret);
        });
        
        $app['form.type.extensions'] = $app->share(function ($app) {
            return array(new FormTypeHttpFoundationExtension());
        });
        
        $app['form.extensions'] = $app->share(function ($app) {
            $extensions = array(
                $app['form.extension.csrf'],
                new HttpFoundationExtension(),
            );

            if (isset($app['validator'])) {
                $extensions[] = new FormValidatorExtension($app['validator']);

                if (isset($app['translator'])) {
                    $r = new \ReflectionClass('Symfony\Component\Form\Form');
                    $app['translator']->addResource('xliff', dirname($r->getFilename()).'/Resources/translations/validators.'.$app['locale'].'.xlf', $app['locale'], 'validators');
                }
            }

            return $extensions;
        });
        
        $app['form.type.guessers'] = $app->share(function ($app) {
            return array();
        });
        
        $app['form.types'] = $app->share(function ($app) {
            return array();
        });
        
        $app['form.resolved_type_factory'] = $app->share(function ($app) {
            return new ResolvedFormTypeFactory();
        });
        
        $app['form.factory'] = $app->share(function ($app) {
            return FactoryAdapterBuilderForm::createBuilder("symfony", $app);
        });
        
    }
    
    public function boot(Application $app) {
        
    }
}
