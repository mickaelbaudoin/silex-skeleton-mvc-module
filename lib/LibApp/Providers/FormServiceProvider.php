<?php

namespace LibApp\Providers;

use Silex\ServiceProviderInterface;
use Silex\Application;
use LibApp\Form\FactoryAdapterBuilderForm;

/**
 * Description of FormServiceProvider
 *
 * @author mickael
 */
class FormServiceProvider implements ServiceProviderInterface {

    public function register(Application $app) {
        $app['form'] = $app->share(function () {
            return FactoryAdapterBuilderForm::createBuilder("symfony");
        });
    }
    
    public function boot(Application $app) {
        
    }
}
