<?php
$loader = require __DIR__ .'/vendor/autoload.php';

use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

$app = new \Silex\Application();

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


$pathProxies = realpath(__DIR__."/app/Model/Proxies");
$pathEntities = realpath(__DIR__."/app/Model/Entities");


$app->register(new DoctrineOrmServiceProvider, 
    [
    "orm.proxies_dir" => $pathProxies,
    "orm.auto_generate_proxies" => true,
    "orm.em.options" => array(
        "mappings" => array(
            // Using actual filesystem paths
            array(
                "type" => "annotation",
                "namespace" => "App\Model\Entities",
                "use_simple_annotation_reader" => false,
                "path" => $pathEntities,
            ),
        ),
    ),
   ]);

//Cli conf

use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain,
    Symfony\Component\Console\Application as CliApplication,
    Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper,
    Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper,
    Doctrine\Common\Annotations\AnnotationRegistry,
    Doctrine\ORM\Mapping\Driver\AnnotationDriver,
    Doctrine\Common\Annotations\AnnotationReader,
    Symfony\Component\Console\Helper\HelperSet,
    Doctrine\ORM\Mapping\Driver\DatabaseDriver,
    Doctrine\ORM\Tools\Console\Command,
    Doctrine\DBAL\Connection,
    Doctrine\DBAL\Version;

/** @var Connection $db The above bootstrap creates the app object for us */
$db = $app['db'];

/** @var Doctrine\ORM\EntityManager $em The entity manager */
$em = $app['orm.em'];

$driver = new DatabaseDriver($db->getSchemaManager());
$driver->setNamespace('App\Model\Entities');
$annotationsFile = __DIR__ . '/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php';
AnnotationRegistry::registerFile($annotationsFile);

$driverChain = new MappingDriverChain();
$driverChain->addDriver(
    new AnnotationDriver(new AnnotationReader(), [$pathEntities]), 'App\Model\Entities'
);
$em->getConfiguration()->setMetadataDriverImpl($driverChain);
/** @var Symfony\Component\Console\Application $cli */
$cli = new CliApplication('Doctrine Command Line Interface', Version::VERSION);
$cli->setCatchExceptions(true);
$cli->setHelperSet(new HelperSet([
    'db' => new ConnectionHelper($em->getConnection()),
    'em' => new EntityManagerHelper($em)
]));
$cli->addCommands([
    new Command\GenerateRepositoriesCommand,
    new Command\GenerateEntitiesCommand,
    new Command\ConvertMappingCommand,
    new Command\ValidateSchemaCommand,
    new Command\SchemaTool\CreateCommand,
    new Command\SchemaTool\UpdateCommand,
    new Command\GenerateProxiesCommand
]);

$cli->run();