<?php

/*
 * This file is a part of dflydev/doctrine-orm-service-provider.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LibApp\Providers\Dflydev\Silex;

use LibApp\Providers\Dflydev\Doctrine\DoctrineOrmServiceProvider as PimpleDoctrineOrmServiceProvider;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Doctrine ORM Silex Service Provider.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class DoctrineOrmServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {
        $pimpleServiceProvider = new PimpleDoctrineOrmServiceProvider;
        $pimpleServiceProvider->register($app);
    }
}
