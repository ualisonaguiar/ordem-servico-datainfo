<?php

namespace InepZend;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\DisconnectedClassMetadataFactory;
use Doctrine\Common\Cache\ArrayCache;
use InepZend\Doctrine\ORM\Mapping\Driver\DatabaseDriver;
use InepZend\Generator\Generator;
use Zend\Loader\StandardAutoloader;
use InepZend\Util\Server;

try {
    error_reporting(E_ERROR | E_WARNING | E_PARSE);

    if (!is_array($argv) || !array_key_exists(1, $argv)) {
        throw new \Exception("Informe pelo menos um modulo. ex :  module=[Ex1, Ex2] schema=[nome do schema]");
    }
    $strUserSchema = '';
    echo "Iniciando ...... \n";

    parse_str($argv[1]);
    $arrModule = explode(',', $module);

    if (array_key_exists(2, $argv)) {
        parse_str($argv[2]);
        $strUserSchema = $schema;
    }

    # Setup autoloading
    require '../../autoload.php';

    $standardAutoloader = (new StandardAutoloader())->registerNamespace('InepZend', '../library/InepZend')->register();

    $arrConfigLocal = include Server::getReplacedBasePathApplication('/../../../config/autoload/doctrine_orm.local.php');
    $arrConfigGlobal = include Server::getReplacedBasePathApplication('/../../../config/autoload/doctrine_orm.global.php');

    if ($strDriver = $arrConfigGlobal['doctrine']['connection']['orm_default']['driverClass']) {
        $arrConfigLocal['doctrine']['connection']['orm_default']['params']['driverClass'] = $strDriver;
    } else {
        $arrConfigLocal['doctrine']['connection']['orm_default']['params']['driver'] = 'oci8';
    }
    $generator = new Generator();
    foreach ($arrModule as $strModule) {

        $strDir = Server::getReplacedBasePathApplication("/../../../module/{$strModule}");
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . $strDir . "/src/{$strModule}/Entity"), true, null, new ArrayCache());

        # Obtendo uma instância do Entity Manager 
        $entityManager = EntityManager::create($arrConfigLocal['doctrine']['connection']['orm_default']['params'], $config);
        # Reverse Engineering
        $driverImpl = new DatabaseDriver(
                $entityManager->getConnection()->getSchemaManager()
        );
        $driverImpl->setNamespace($strModule . "\\Entity\\");
        $entityManager->getConfiguration()->setMetadataDriverImpl($driverImpl);

        $classMetFactory = new DisconnectedClassMetadataFactory();
        $classMetFactory->setEntityManager($entityManager);
        $arrMetadatas = $classMetFactory->getAllMetadata();

        $generator->setMetadata($arrMetadatas)
                ->setDir($strDir)
                ->generate($strUserSchema);

        echo "Entidades, Repositorios e Services gerados para o Modulo : {$strModule} \n";
    }
    echo "\n Finalizado com sucesso. \n";
} catch (\Exception $exeption) {
    echo sprintf($exeption->getMessage(), $arrConfigLocal['doctrine']['connection']['orm_default']['params']['user']) . "\n";
}



