<?php
use LibApp\Providers\DoctrineOrmServiceProvider,
Silex\Provider\DoctrineServiceProvider,
Symfony\Component\Translation\Loader\YamlFileLoader;

//Session
$app->register(new Silex\Provider\SessionServiceProvider());

//Mailer
$app->register(new \LibApp\Providers\MailerServiceProvider());

//Form
$app->register(new \LibApp\Providers\FormServiceProvider());

//Translator
$app->register(new \LibApp\Providers\TranslatorServiceProvider(), 
        array(
            'locale' => 'fr',
            'loader' => array('format' => 'yaml', 'class' => new YamlFileLoader()),
            'ressource' => array('format' => 'yaml', 'path' => __DIR__ . '/../Locale/')
        )
);

//Twig
$pathViewFront = __DIR__.'/../Module/Front/Views';
$pathViewAdmin = __DIR__.'/../Module/Admin/Views';
$pathLayout = __DIR__."/../Layouts";
$app->register(new Silex\Provider\TwigServiceProvider(), array());
$app['twig.loader.filesystem']->addPath($pathViewFront, "front");
$app['twig.loader.filesystem']->addPath($pathViewAdmin, "admin");
$app['twig.loader.filesystem']->addPath($pathLayout);

//Doctrine ORM


$app->register(new DoctrineServiceProvider, array(
    "db.options" => array(
        "driver" 	=> "pdo_mysql",
        "dbname" 	=> "silex",
        "host"		=> "localhost",
        "user"		=> "root",
        "password"	=> "root",
        "charset"	=> "utf8"
    ),
));


$pathProxies = realpath(__DIR__."/../Model/Proxies");
$pathEntities = realpath(__DIR__."/../Model/Entities");

$app->register(new DoctrineOrmServiceProvider, 
    [
    "orm.proxies_dir" => $pathProxies,
    "orm.auto_generate_proxies" => true,
    "orm.em.options" => array(
        "mappings" => array(
            // Using actual filesystem paths
            array(
                "type" => "annotation",
                "namespace" => "App\\Model\\Entities\\",
                "path" => $pathEntities,
            ),
        ),
    ),
   ]);

//Resolver (Injection $app in constructor controllers)
$app->register(new LibApp\Providers\ControllerResolverServiceProvider());




