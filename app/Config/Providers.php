<?php
use LibApp\Providers\DoctrineOrmServiceProvider,
    Silex\Provider\DoctrineServiceProvider;


define("PATH_VIEWS_FRONT", __DIR__.'/../Module/Front/Views');
define("PATH_VIEWS_ADMIN", __DIR__.'/../Module/Admin/Views');
define("PATH_LAYOUTS", __DIR__."/../Layouts");
define("PATH_PROXIES", realpath(__DIR__."/../Model/Proxies"));
define("PATH_ENTITIES", realpath(__DIR__."/../Model/Entities"));

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
            'loader' => array('format' => 'yaml', 'class' => new \Symfony\Component\Translation\Loader\YamlFileLoader()),
            'ressource' => array('format' => 'yaml', 'path' => __DIR__ . '/../Locale/')
        )
);

//Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array());
$app['twig.loader.filesystem']->addPath(PATH_VIEWS_FRONT, "front");
$app['twig.loader.filesystem']->addPath(PATH_VIEWS_ADMIN, "admin");
$app['twig.loader.filesystem']->addPath(PATH_LAYOUTS);

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

$app->register(new DoctrineOrmServiceProvider, 
    [
    "orm.proxies_dir" => PATH_PROXIES,
    "orm.auto_generate_proxies" => true,
    "orm.em.options" => array(
        "mappings" => array(
            // Using actual filesystem paths
            array(
                "type" => "annotation",
                "namespace" => "App\\Model\\Entities\\",
                "path" => PATH_ENTITIES,
            ),
        ),
    ),
   ]);

$app->register(new LibApp\Providers\ControllerResolverServiceProvider());




