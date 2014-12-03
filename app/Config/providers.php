<?php

$pathViewFront = __DIR__.'/../Module/Front/Views';
$pathViewAdmin = __DIR__.'/../Module/Admin/Views';
$pathLayout = __DIR__."/../Layouts";
$app->register(new Silex\Provider\TwigServiceProvider(), array());
$app['twig.loader.filesystem']->addPath($pathViewFront, "front");
$app['twig.loader.filesystem']->addPath($pathViewAdmin, "admin");
$app['twig.loader.filesystem']->addPath($pathLayout);