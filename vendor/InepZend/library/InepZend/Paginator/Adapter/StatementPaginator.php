<?php

namespace InepZend\Paginator\Adapter;

use Zend\Paginator\Adapter\AdapterInterface;
use InepZend\ModuleConfig\ModuleConfig;
use InepZend\Paginator\Paginator;
use InepZend\Doctrine\DBAL\Logging\FileSQLLogger;
use InepZend\Util\ArrayCollection;
use InepZend\Util\Server;
use InepZend\Exception\Exception;
use Doctrine\ORM\Configuration;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\Mapping\Driver\DriverChain;
use Doctrine\ORM\Mapping\DefaultEntityListenerResolver;
use Doctrine\ORM\Mapping\DefaultNamingStrategy;
use Doctrine\ORM\Mapping\DefaultQuoteStrategy;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Statement;
use Doctrine\Common\Proxy\AbstractProxyFactory;

class StatementPaginator implements AdapterInterface
{

    protected $query;
    protected $count;
    protected $queryOriginal;
    protected $arrQuery;
    public $booSimpleRegister = false;

    public function __construct($query = null)
    {
        if (is_object($query)) {
            $this->queryOriginal = $query;
            $this->query = $this->cloneQuery($query);
        }
    }

    public function count()
    {
        if (!$this->count) {
            $booCount = true;
            if (method_exists($this->queryOriginal->getWrappedStatement(), 'getIterator')) {
                $this->queryOriginal->getWrappedStatement()->getIterator();
                $this->count = $this->queryOriginal->getWrappedStatement()->rowCount();
                if ($this->count > 0) {
                    $booCount = false;
                }
            }
            if ($booCount) {
                $strNewSQL = 'SELECT COUNT(0) FROM ( ' . $this->arrQuery['sql'] . ' ) tcount';
                $query = $this->newQuery($strNewSQL, $this->arrQuery['params'], $this->arrQuery['types']);
                $query->execute();
                $this->bindValueQuery($query, $this->arrQuery['params'], $this->arrQuery['types']);
                $this->count = (int) $query->getWrappedStatement()->fetchColumn(0);
            }
        }
        return $this->count;
    }

    public function getItems($intOffset = 0, $intItemCountPerPage = Paginator::ITENS_PER_PAGE_DEFAULT)
    {
        $arrQuery = $this->convertQueryToArray($this->query, 2);
        if (!array_key_exists('sql', $arrQuery))
            return array();
        $this->query = null;
        $strSQL = $arrQuery['sql'];
        $arrParameter = $arrQuery['params'];
        $arrType = $arrQuery['types'];
        $strDriver = ((array_key_exists('conn', $arrQuery)) && (array_key_exists('_params', (array) $arrQuery['conn'])) && (array_key_exists('driver', (array) $arrQuery['conn']['_params']))) ? $arrQuery['conn']['_params']['driver'] : null;
        if (stripos($strDriver, 'pg') !== false)
            $strNewSQL = 'SELECT table_intern.* FROM ( ' . $strSQL . ' ) table_intern LIMIT ' . $intItemCountPerPage . (($intOffset == 0) ? '' : ' OFFSET  ' . (($intOffset - 1) * $intItemCountPerPage));
        else
            $strNewSQL = 'SELECT * FROM ( SELECT table_intern.* , ROWNUM nu_row FROM ( ' . $strSQL . ' ) table_intern ) WHERE nu_row BETWEEN ' . ($intOffset + 1) . ' AND ' . ($intOffset + $intItemCountPerPage);
        $query = $this->newQuery($strNewSQL, $arrParameter, $arrType);
        $query->execute();
        $this->bindValueQuery($query, $arrParameter, $arrType);
        $this->query = $query;
        return $this->clearAliasFetchAll($query->fetchAll());
    }

    public function clearAliasFetchAll(array $arrResult = array())
    {
        $arrItem = array();
        if (is_array($arrResult)) {
            $strDelete = '';
            foreach ($arrResult as $intRow => $arrRegister) {
                foreach ($arrRegister as $mixKey => $mixValue) {
                    if ($this->booSimpleRegister) {
                        if (is_numeric($mixKey))
                            unset($arrResult[$intRow][$mixKey]);
                        else
                            $arrItem[$intRow][$mixKey] = $mixValue;
                    } else {
                        if (is_numeric($mixKey)) {
                            $strDelete = (string) $mixKey;
                            $mixKeyNew = $mixKey;
                        } else
                            $mixKeyNew = (strrpos($mixKey, $strDelete) === false) ? $mixKey : substr($mixKey, 0, strrpos($mixKey, $strDelete));
                        $arrItem[$intRow][$mixKeyNew] = $mixValue;
                    }
                }
            }
        }
        return $arrItem;
    }

    public function newQuery($strSQL = null, array $arrParameter = null, $arrType = [])
    {
        if (empty($strSQL))
            return;
        if (!array_key_exists('doctrine_connection', $GLOBALS))
            throw new Exception('É necessário informar as informações de conexão do Doctrine.');
        $strOrmModule = strtolower(ModuleConfig::getModuleFromTrace());
        if (empty($strOrmModule))
            $strOrmModule = 'default';
        $strOrmModule = 'orm_' . $strOrmModule;
        if (!array_key_exists($strOrmModule, $GLOBALS['doctrine_connection']))
            $strOrmModule = 'orm_default';
        $arrParam = $GLOBALS['doctrine_connection'][$strOrmModule]['params'];
//        $params['driver'] = str_replace(array('doctrine\\dbal\\driver\\', '\\driver', 'pdo', 'pdo_oracle'), array('', '', 'pdo_', 'pdo_oci'), strtolower($GLOBALS['doctrine_connection'][$strOrmModule]['driverClass']));
        $arrParam['driverClass'] = $GLOBALS['doctrine_connection'][$strOrmModule]['driverClass'];
        $arrParam['wrapperClass'] = null;
        $arrParam['pdo'] = null;
        $config = new Configuration();
        $mixAutoGenerate = (array_key_exists('auto_generate', $GLOBALS['doctrine_proxy'])) ? $GLOBALS['doctrine_proxy']['auto_generate'] : AbstractProxyFactory::AUTOGENERATE_FILE_NOT_EXISTS;
        $strProxyDir = (array_key_exists('proxy_dir', $GLOBALS['doctrine_configuration'][$strOrmModule])) ? $GLOBALS['doctrine_configuration'][$strOrmModule]['proxy_dir'] : '/../../../../../../data/DoctrineORMModule/Proxy';
        $config->setAutoGenerateProxyClasses($mixAutoGenerate);
        $config->setProxyDir(Server::getReplacedBasePathApplication($strProxyDir));
        $config->setProxyNamespace('DoctrineORMModule\Proxy');
        $config->setEntityNamespaces(array());
        $config->setMetadataCacheImpl(new ArrayCache());
        $config->setQueryCacheImpl(new ArrayCache());
        $config->setMetadataDriverImpl(new DriverChain());
        $config->setClassMetadataFactoryName('Doctrine\ORM\Mapping\ClassMetadataFactory');
        $config->setEntityListenerResolver(new DefaultEntityListenerResolver());
        $config->setNamingStrategy(new DefaultNamingStrategy());
        $config->setQuoteStrategy(new DefaultQuoteStrategy());
        $conn = DriverManager::getConnection($arrParam, FileSQLLogger::editConfiguration($config));
        $conn->connect();
        $query = new Statement($strSQL, $conn);
        $this->bindValueQuery($query, $arrParameter, $arrType);
        return $query;
    }

    public function cloneQuery($query = null)
    {
        if (empty($query))
            $query = $this->query;
        if (empty($query))
            return;
        $arrQuery = $this->convertQueryToArray($query);
        if (!array_key_exists('sql', $arrQuery))
            return;
        return $this->newQuery($arrQuery['sql'], $arrQuery['params'], $arrQuery['types']);
    }

    public function convertQueryToArray($query = null, $intMaxDeep = 1)
    {
        if (empty($query))
            $query = $this->query;
        if (empty($query))
            return;
        $this->arrQuery = ArrayCollection::objectToArray($query, false, $intMaxDeep);
        return $this->arrQuery;
    }

    private function bindValueQuery($query = null, array $arrParameter = null, $arrType = [])
    {
        if (!empty($arrParameter)) {
            foreach ((array) $arrParameter as $strAttribute => $mixValue) {
                $mixType = (array_key_exists($strAttribute, $arrType)) ? $arrType[$strAttribute] : null;
                $query->bindValue($strAttribute, $mixValue, $mixType);
            }
        }
    }

}