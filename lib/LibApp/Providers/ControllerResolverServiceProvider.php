<?php

/*
 * This file is part of the Silex framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
                      
            //Logger
            if(isset($app['logger'])){
                $logger = $app['logger'];
            }else{
                $logger = null;
            }
            
            $resolver = new ControllerResolver($logger);
            
            return new DecoratorControllerResolverSymfony($resolver, $app, $logger);
        });
    }

    public function boot(Application $app)
    {
    }
}
