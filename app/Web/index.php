<?php
ini_set('display_errors', -1);

require __DIR__ .'/../../vendor/autoload.php';

$app = new \Silex\Application();

//debug
$app['debug'] = true;

//Register providers
$pathViewFront = __DIR__.'/../Module/Front/Views';
$pathViewAdmin = __DIR__.'/../Module/Admin/Views';
$pathLayout = __DIR__."/../Layouts";
$app->register(new Silex\Provider\TwigServiceProvider(), array());
$app['twig.loader.filesystem']->addPath($pathViewFront, "front");
$app['twig.loader.filesystem']->addPath($pathViewAdmin, "admin");
$app['twig.loader.filesystem']->addPath($pathLayout);

//Routes
$controllerFront = $app['controllers_factory'];
$controllerFront ->get('/index', "Flashweb\Module\Front\Controllers\IndexController::index");

$controllerAdmin = $app['controllers_factory'];
$controllerAdmin->get('/index', "Flashweb\Module\Admin\Controllers\IndexController::index");

$app->mount('/', $controllerFront);
$app->mount('/admin', $controllerAdmin);

$app->run();

?>