<?php

namespace LibApp\Providers;

use Silex\Application;
use Silex\ServiceProviderInterface;
use LibApp\Controllers\DecoratorControllerResolverSymfony;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;


class ControllerResolverServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['resolver'] = $app->share(function () use ($app) {
                      
            //test
            if(isset($app['logger'])){
                $logger = $app['logger'];
            }else{
                $logger = null;
            }
            
            $defaultResolver = new ControllerResolver($logger);
            
            return new DecoratorControllerResolverSymfony($defaultResolver, $app, $logger);
        });
    }

    public function boot(Application $app)
    {
    }
}
