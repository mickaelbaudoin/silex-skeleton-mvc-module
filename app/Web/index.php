<?php
ini_set('display_errors', -1);

$loader = require __DIR__ .'/../../vendor/autoload.php';

$app = new \Silex\Application();


//debug
$app['debug'] = true;

//Register providers
require __DIR__ . '/../Config/Providers.php';

//Routes
require __DIR__ . '/../Config/Routes.php';
        
$app->run();

