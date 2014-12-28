<?php

$controllerFront = $app['controllers_factory'];
$controllerFront ->get('/index', "App\Module\Front\Controllers\IndexController::index");

$controllerAdmin = $app['controllers_factory'];
$controllerAdmin->get('/index', "App\Module\Admin\Controllers\IndexController::index");

$app->mount('/', $controllerFront);
$app->mount('/admin', $controllerAdmin);