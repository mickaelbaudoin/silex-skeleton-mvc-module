<?php

//Front
$controllerFront = $app['controllers_factory'];
$controllerFront ->get('/index', "App\Module\Front\Controllers\IndexController::index");

$controllerFrontMail = $app['controllers_factory'];
$controllerFrontMail ->get('/mail', "App\Module\Front\Controllers\IndexController::testMail");

//Admin
$controllerAdmin = $app['controllers_factory'];
$controllerAdmin->get('/index', "App\Module\Admin\Controllers\IndexController::index");

//PrefixFront
$app->mount('/', $controllerFront);
$app->mount('/', $controllerFrontMail);
//PrefixAdmin
$app->mount('/admin', $controllerAdmin);