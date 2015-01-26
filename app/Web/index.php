<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;
use Silex\Application;

ini_set('display_errors', -1);

define('PATH_CONFIG', __DIR__ . "/../Config/");

$loader = require __DIR__ .'/../../vendor/autoload.php';

$app = new Application();

//debug
$app['debug'] = true;

//Register providers
require __DIR__ . '/../Config/Providers.php';

//Routes
$app['routes'] = $app->extend('routes', function (RouteCollection $routes, Application $app) {
        $loader     = new YamlFileLoader(new FileLocator(PATH_CONFIG));
        $collection = $loader->load('Routes.yml');
        $routes->addCollection($collection);
 
        return $routes;
    }
);

$app->run();

