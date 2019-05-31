<?php

namespace InepZend\Repository;

use InepZend\Repository\AbstractRepositoryCore;
use InepZend\Doctrine\DBAL\Event\Listeners\OracleSessionInit;
use InepZend\Doctrine\ORM\Mapping\DefaultQuoteStrategy;
use InepZend\Doctrine\DBAL\Logging\FileSQLLogger;
use InepZend\Util\Reflection;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\DBAL\Platforms\OraclePlatform;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Proxy\AbstractProxyFactory;
use Doctrine\ORM\EntityManager;

/**
 * Classe abstrata responsavel por metodos relacionados a instancias do EntityManager.
 * 
 * [-] AbstractRepositoryCore
 *      [+] AbstractRepositoryEntityManager
 *          [-] AbstractRepositoryQuery
 *              [-] AbstractRepositoryCommand
 *                  [-] AbstractRepository
 *
 * @package InepZend
 * @subpackage Repository
 */
abstract class AbstractRepositoryEntityManager extends AbstractRepositoryCore
{

    private static $arrConfigEntityManager = array();

    /**
     * Metodo construtor responsavel em definir e configurar o entityManager para
     * uso nos metodos da classe.
     * 
     * @param object $entityManager
     * @param object $class
     * @return void
     */
    public function __construct($entityManager, ClassMetadata $class)
    {
        parent::__construct($entityManager, $class);
        self::configEntityManager($entityManager, true);
    }

    /**
     * Metodo responsavel em configurar o entityManager para uso nos metodos da 
     * classe.
     * 
     * @example self::configEntityManager($entityManager, $booForce);
     * 
     * @param object $entityManager
     * @param boolean $booForce
     * @return mix
     */
    public static function configEntityManager($entityManager = null, $booForce = false)
    {
        if (!is_object($entityManager))
            return false;
        if (($booForce == false) && (self::getConfigEntityManager($entityManager)))
            return $entityManager;
        self::configEntityManagerInstance($entityManager);
        self::setConfigEntityManager($entityManager);
        return $entityManager;
    }

    /**
     * Metodo responsavel em definir se o entityManager foi configurado ou nao.
     * 
     * @example self::setConfigEntityManager($entityManager, $booConfigEntityManager);
     * 
     * @param object $entityManager
     * @param boolean $booConfigEntityManager
     * @return boolean
     */
    public static function setConfigEntityManager($entityManager = null, $booConfigEntityManager = true)
    {
        if (is_bool($strKey = self::getKeyEntityManager($entityManager)))
            return false;
        return self::$arrConfigEntityManager[$strKey] = (bool) $booConfigEntityManager;
    }

    /**
     * Metodo responsavel em retornar a definicao se o entityManager foi configurado
     * ou nao.
     * 
     * @example self::getConfigEntityManager($entityManager);
     * 
     * @param object $entityManager
     * @return boolean
     */
    public static function getConfigEntityManager($entityManager = null)
    {
        if ((is_bool($strKey = self::getKeyEntityManager($entityManager))) || (!array_key_exists($strKey, self::$arrConfigEntityManager)))
            return false;
        return self::$arrConfigEntityManager[$strKey];
    }

    /**
     * Metodo que retorna a chave de uma instancia do entityManager.
     * 
     * @param object $entityManager
     * @return mix
     */
    private static function getKeyEntityManager($entityManager = null)
    {
        return (!is_object($entityManager)) ? false : md5(get_class($entityManager) . Reflection::getInstanceId($entityManager));
    }

    /**
     * Metodo responsavel em configurar uma instancia do entityManager referenciado.
     * 
     * @param object $entityManager
     * @return void
     */
    private static function configEntityManagerInstance($entityManager = null)
    {
        if ($entityManager instanceof EntityManager) {
            $entityManager->getConfiguration()->addCustomStringFunction('TRANSLATE', 'InepZend\Doctrine\ORM\Query\AST\Functions\TranslateFunction');
            $entityManager->getConfiguration()->addCustomStringFunction('REPLACE', 'InepZend\Doctrine\ORM\Query\AST\Functions\ReplaceFunction');
            $entityManager->getConfiguration()->addCustomStringFunction('TO_CHAR', 'InepZend\Doctrine\ORM\Query\AST\Functions\ToCharFunction');
            if ($entityManager->getConnection()->getDatabasePlatform() instanceof OraclePlatform) { //Doctrine\DBAL\Platforms\OraclePlatform | Doctrine\DBAL\Platforms\PostgreSqlPlatform
                $entityManager->getEventManager()->addEventSubscriber(new OracleSessionInit());
                $entityManager->getConfiguration()->setQuoteStrategy(new DefaultQuoteStrategy());
            }
            if (!Type::hasType('utf8string'))
                Type::addType('utf8string', 'InepZend\Doctrine\DBAL\Types\Utf8String');
            $entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('Utf8String', 'utf8string');
            $entityManager->getConfiguration()->setAutoGenerateProxyClasses(((array_key_exists('doctrine_proxy', $GLOBALS)) && (array_key_exists('auto_generate', $GLOBALS['doctrine_proxy']))) ? $GLOBALS['doctrine_proxy']['auto_generate'] : AbstractProxyFactory::AUTOGENERATE_FILE_NOT_EXISTS);
            FileSQLLogger::editConfiguration($entityManager->getConfiguration());
        }
    }

    public function getAssociationMappings($strEntity = null)
    {
        return (!is_object($ormMapping = $this->getOrmMapping($strEntity))) ? array() : $ormMapping->associationMappings;
    }

    protected function getFieldNames($strEntity = null)
    {
        return (!is_object($ormMapping = $this->getOrmMapping($strEntity))) ? array() : $ormMapping->fieldNames;
    }

    protected function getOrmMapping($strEntity = null)
    {
        if (empty($strEntity))
            $strEntity = str_replace('Repository', '', get_class($this));
        $strEntity = str_replace('DoctrineORMModule\Proxy\__CG__\\', '', $strEntity);
        if (!class_exists($strEntity))
            return false;
        $ormMapping = $this->getEntityManager()->getClassMetadata($strEntity);
        if (!is_object($ormMapping))
            $ormMapping = $this->getEntityManager()->getMetadataFactory()->getLoadedMetadata()[$strEntity];
        return $ormMapping;
    }

}
