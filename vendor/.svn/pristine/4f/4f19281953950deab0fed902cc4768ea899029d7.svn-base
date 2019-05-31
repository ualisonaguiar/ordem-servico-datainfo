<?php

namespace InepZend\Service;

use InepZend\Configurator\Configurator;
use InepZend\Repository\AbstractRepositoryEntityManager;
use InepZend\Paginator\Paginator;
use Doctrine\ORM\EntityManager;
use InepZend\Doctrine\ORM\Mapping\Driver\DatabaseDriver;
use InepZend\Service\AbstractServiceFile;
use InepZend\Util\Server;
use InepZend\Util\String;
use InepZend\Util\ArrayCollection;
use InepZend\Exception\Exception;
use \Exception as ExceptionNative;
use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * Classe abstrata responsavel pelos metodos invocadores do Repository (incluindo
 * a EntityManager) para acionar interacoes com o banco de dados.
 *
 * [-] AbstractServiceCore
 *      [-] AbstractServiceCoreCache
 *          [-] AbstractServiceManager
 *              [+] AbstractServiceRepository
 *                  [-] AbstractService
 *                      [-] AbstractServiceAngular
 *                      [-] AbstractServiceControlCache
 *                          [-] AbstractServiceCache
 *                              [-] AbstractServiceCacheAngular
 *                          [-] AbstractServiceFile
 *                              [-] AbstractServiceFileAngular
 *
 * @package InepZend
 * @subpackage Service
 */
abstract class AbstractServiceRepository extends AbstractServiceManager
{

    /**
     * @var EntityManager
     */
    private $entityManager;
    protected $strService;
    protected $strEntity;
    protected $arrPk;
    protected static $booFlush = true;
    private static $arrRepositoryEntity = array();

    /**
     * Metodo construtor responsavel em setar os atributos da classe.
     *
     * @example new \Path\To\Service($this->getService('InepZend\Doctrine\ORM\EntityManager'), 'Path\To\Service');
     *
     * @param object $entityManager
     * @param string $strService
     * @return void
     */
    public function __construct($entityManager = null, $strService = null)
    {
        $this->setEntityManager($entityManager);
        if (empty($strService))
            $strService = get_class($this);
        if (class_exists($strService))
            $this->strService = $strService;
        $strEntity = str_replace('Service', ((stripos($strService, 'Entity') === false) ? 'Entity' : ''), (string) $strService);
        if ((!class_exists($strEntity)) && (strpos($strEntity, AbstractServiceFile::SUFIX_CLASS_SERVICE_FILE) !== false))
            $strEntity = str_replace('Entity\File\\', 'Entity\\', substr($strEntity, 0, (strlen($strEntity) - strlen(AbstractServiceFile::SUFIX_CLASS_SERVICE_FILE))));
        if (class_exists($strEntity))
            $this->strEntity = $strEntity;
    }

    /**
     * Metodo responsavel em retornar os dados da entidade.
     *
     * @example $this->getService('Path\To\Service')->find('value_pk');
     *
     * @param mix $mixPk
     * @return mix
     */
    public function find($mixPk)
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->getRepositoryEntity()->find($mixPk);
    }

    /**
     * Metodo responsavel em retornar os dados da entidade parametrizada.
     *
     * @example $this->getService('Path\To\Service')->findBy(array('name_column' => 'value'), array('name_column' => 'ASC | DESC'), 10, 0);
     *
     * @param array $arrCriteria
     * @param array $arrOrderBy
     * @param integer $intLimit
     * @param integer $intOffset
     * @return mix
     */
    public function findBy(array $arrCriteria = array(), array $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->getRepositoryEntity()->findBy($arrCriteria, $arrOrderBy, $intLimit, $intOffset);
    }

    /**
     * Metodo responsavel em salvar (inserindo ou alterando) ps dadps da entidade.
     *
     * @param array $arrData
     * @param array $arrSetterFk
     * @return mix
     */
    public function save(array $arrData, array $arrSetterFk = array())
    {
        $this->trace(__FUNCTION__, func_get_args());
        $arrPkValue = $this->getPkValue($arrData);
        $strMethod = ((empty($arrPkValue)) || (in_array(null, $arrPkValue))) ? 'insert' : 'update';
        return $this->$strMethod($arrData, $arrSetterFk);
    }

    /**
     * Metodo responsavel em persistir os dados da entidade.
     *
     * @example $this->getService('Path\To\Service')->insert($entityObject()->toArray(), array(array('method', '\Path\To\Entity', 'value')));
     *
     * @param array $arrData
     * @param array $arrSetterFk
     * @return mix
     */
    public function insert(array $arrData, array $arrSetterFk = array())
    {
        $this->trace(__FUNCTION__, func_get_args());
        if ($this->hasDocumentManager())
            ArrayCollection::clearEmptyParam($arrData);
        return $this->persist(new $this->strEntity($arrData), $arrSetterFk);
    }

    /**
     * Metodo responsavel em alterar os dados da entidade.
     *
     * @example $this->getService('Path\To\Service')->update($entityObject()->toArray(), array(array('method', '\Path\To\Entity', 'value')));
     *
     * @param array $arrData
     * @param array $arrSetterFk
     * @return mix
     */
    public function update(array $arrData, array $arrSetterFk = array())
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->persist(Configurator::configure($this->getReferenceEntity($this->getPkValue($arrData)), $arrData), $arrSetterFk);
    }

    /**
     * Metodo responsavel em alterar os dados da entidade utilizando criterio.
     *
     * @example $this->getService('Path\To\Service')->updateBy(array('name_column1' => 'value1', 'name_column2' => 'value2'), array('name_column1' => 'value'));
     *
     * @param array $arrData
     * @param array $arrCriteria
     * @param array $arrNotIn
     * @return mix
     *
     * @TODO asserts
     */
    public function updateBy(array $arrData = array(), array $arrCriteria = array(), array $arrNotIn = array())
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->getRepositoryEntity()->updateBy($arrData, $arrCriteria, $arrNotIn);
    }

    /**
     * Metodo responsavel em deletar os dados da entidade.
     *
     * @example $this->getService('Path\To\Service')->delete($entityObject()->toArray());
     *
     * @param array $arrData
     * @param object $entity
     * @return mix
     */
    public function delete(array $arrData, $entity = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        if (!is_object($entity) && !$this->hasDocumentManager())
            $entity = $this->getReferenceEntity($this->getPkValue($arrData));
        else
            $entity = $this->find($this->getPkValue($arrData));
        if ($entity) {
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
        }
        return $entity;
    }

    /**
     * Metodo responsavel em deletar os dados da entidade utilizando criterio.
     *
     * @example $this->getService('Path\To\Service')->deleteBy(array('name_column' => 'value'));
     *
     * @param array $arrCriteria
     * @param array $arrNotIn
     * @return mix
     */
    public function deleteBy(array $arrCriteria = array(), array $arrNotIn = array())
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->getRepositoryEntity()->deleteBy($arrCriteria, $arrNotIn);
    }

    /**
     * Metodo responsavel em retornar os dados em array contendo chave e valor,
     * podendo ser esses Id e Campo consecutivamente.
     *
     * @example $this->getService('Path\To\Service')->fetchPairs(array('name_column' => 'value'), 'name_column_to_value', 'name_column_to_text', array('name_column' => 'ASC | DESC'), 10, 0);
     *
     * @param array $arrCriteria
     * @param string $strMethodValue
     * @param string $strMethodText
     * @param array $arrOrderBy
     * @param integer $intLimit
     * @param integer $intOffset
     * @return mix
     */
    public function fetchPairs(array $arrCriteria = null, $strMethodValue = null, $strMethodText = null, array $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->getRepositoryEntity()->fetchPairs($strMethodValue, $strMethodText, $arrCriteria, $arrOrderBy, $intLimit, $intOffset);
    }

    /**
     * Metodo responsavel em retornar os dados em array contendo chave e valor,
     * podendo ser esses Id e Campo consecutivamente. O formato de retorno eh em
     * matriz de array.
     *
     * @example $this->getService('Path\To\Service')->fetchPairsToXmlJson(array('name_column' => 'value'), 'name_column_to_value', 'name_column_to_text', array('name_column' => 'ASC | DESC'), 10, 0);
     *
     * @param array $arrCriteria
     * @param string $strMethodValue
     * @param string $strMethodText
     * @param array $arrOrderBy
     * @param integer $intLimit
     * @param integer $intOffset
     * @return mix
     */
    public function fetchPairsToXmlJson(array $arrCriteria = null, $strMethodValue = null, $strMethodText = null, array $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->getRepositoryEntity()->fetchPairsToXmlJson($strMethodValue, $strMethodText, $arrCriteria, $arrOrderBy, $intLimit, $intOffset);
    }

    /**
     * Metodo responsavel em retornar os dados da entidade parametrizada, o mesmo
     * eh utilizado em paginacao, podendo ser tambem utilizado para pesquisas
     * mais refinadas.
     *
     * @example $this->findByPaged(array('name_column' => 'value'), 'name_column_sort_name', 'ASC | DESC', $intPage, $intItemPerPage, $objectEntity->createQuery('select subcategoria from InepZend\Module\UnitTest\Entity\Subcategoria subcategoria where subcategoria = ?1')->setParameter(1, 5))));
     *
     * @param array $arrCriteria
     * @param string $strSortName
     * @param string $strSortOrder
     * @param integer $intPage
     * @param integer $intItemPerPage
     * @param mix $mixDQLQuery
     * @return mix
     */
    public function findByPaged(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQLQuery = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        if ($this->hasDocumentManager())
            $mixResultPaged = $this->findByPagedMongo($arrCriteria, $strSortName, $strSortOrder, $intPage, $intItemPerPage);
        else
            $mixResultPaged = $this->getRepositoryEntity()->findByPaged($arrCriteria, $strSortName, $strSortOrder, $intPage, $intItemPerPage, $mixDQLQuery);
        return $mixResultPaged;
    }

    /**
     * Metodo responsavel em abrir transacao no banco de dados.
     *
     * @example $this->getService('Path\To\Service')->begin();
     *
     * @return mix
     */
    public function begin()
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->getEntityManager()->beginTransaction();
    }

    /**
     * Metodo responsavel em salvar/executar a transacao ja realizada no banco de
     * dados.
     *
     * @example $this->getService('Path\To\Service')->commit();
     *
     * @return mix
     */
    public function commit()
    {
        $this->trace(__FUNCTION__, func_get_args());
        $this->flush();
        self::setFlush(true);
        return $this->getEntityManager()->commit();
    }

    /**
     * Metodo responsavel em desfazer a transacao aberta no banco de dados.
     *
     * @example $this->getService('Path\To\Service')->rollback();
     *
     * @return mix
     */
    public function rollback()
    {
        $this->trace(__FUNCTION__, func_get_args());
        self::setFlush(true);
        return $this->getEntityManager()->rollback();
    }

    /**
     * Metodo responsavel em efetivar a persistencia no banco de dados e sincronizar
     * com a EntityManager.
     *
     * @example $this->getService('Path\To\Service')->flush();
     *
     * @return mix
     */
    public function flush()
    {
        $this->trace(__FUNCTION__, func_get_args());
        return (self::getFlush()) ? $this->getEntityManager()->flush() : false;
    }

    /**
     * Metodo responsavel em executar o pacote corp.pkg_utilitario.prc_set_usuario_sistema.
     *
     * @example $this->getService('Path\To\Service')->setUserSystemDb('value_id_user_system', 'value_ip_user');
     *
     * @param integer $intIdUserSystem
     * @param string $strIpUser
     * @return mix
     */
    public function setUserSystemDb($intIdUserSystem = null, $strIpUser = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        if (empty($intIdUserSystem)) {
            $identity = $this->getIdentity();
            if (is_object($identity))
                $intIdUserSystem = $identity->usuarioSistema->id;
        }
	if (empty($intIdUserSystem))
            return false;
        if (empty($strIpUser))
            $strIpUser = Server::getIp();
        $repository = $this->getRepositoryEntity();
        return (is_object($repository)) ? $repository->setUserSystemDb($intIdUserSystem, $strIpUser) : false;
    }

    /**
     * Metodo responsavel em definir o uso ou nao do metodo flush da EntityManager.
     * O flush efetiva a persistencia no banco de dados e sincroniza com a EntityManager.
     *
     * @example \InepZend\Service\AbstractServiceRepository::setFlush(true | false);
     *
     * @param boolean $booFlush
     */
    public static function setFlush($booFlush = true)
    {
        self::$booFlush = (boolean) $booFlush;
    }

    /**
     * Metodo responsavel em retornar a definicao do uso ou nao do metodo flush
     * da EntityManager.
     * O flush efetiva a persistencia no banco de dados e sincroniza com a EntityManager.
     *
     * @example \InepZend\Service\AbstractServiceRepository::getFlush();
     *
     * @return boolean
     */
    public static function getFlush()
    {
        return self::$booFlush;
    }

    /**
     * Metodo responsavel por realizar a paginacao utilzando o ODM Mongo
     *
     * @param array|null $arrCriteria
     * @param null $strSortName
     * @param null $strSortOrder
     * @param int $intPage
     * @param int $intItemPerPage
     * @return Paginator
     */
    protected function findByPagedMongo(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder($this->getEntityName());
        if ($strSortName && $strSortOrder)
            $queryBuilder->sort($strSortName, $strSortOrder);
        if ($arrCriteria) {
            foreach ($arrCriteria as $strField => $strValue)
                $queryBuilder->addAnd($queryBuilder->expr()->field($strField)->equals($strValue));
        }
        return new Paginator($queryBuilder->getQuery()->execute()->toArray(), $intPage, $intItemPerPage);
    }

    /**
     * Metodo responsavel em setar a referencia da entidade a ser utilizada por
     * uma entidade dependente.
     *
     * @example $this->getService('Path\To\Service')->setFk(new \Path\To\Entity(), array(array('method', '\Path\To\Entity', 'value')));
     *
     * @param object $entity
     * @param array $arrSetterFk
     * @return mix
     */
    protected function setFk($entity, array $arrSetterFk = array())
    {
        $this->trace(__FUNCTION__, func_get_args());
        if (!is_object($entity) || $this->hasDocumentManager())
            return;
        $arrMap = $this->getRepositoryEntity()->getAssociationMappings(str_replace(['DoctrineProxies\__CG__\\', 'DoctrineORMModule\Proxy\__CG__\\'], '', get_class($entity)));
        if ((empty($arrSetterFk)) && (!empty($arrMap))) {
            $arrSetterFk = array();
            $arrRegister = ArrayCollection::objectToArrayRecursive($entity, false, 1);
            foreach ($arrMap as $strAttribute => $arrMapAttribute) {
                $mixValue = @$arrRegister[$strAttribute];
                if (is_null($mixValue))
                    continue;
                $strMethod = 'set' . String::camelize($strAttribute);
                if ((is_array($mixValue)) || (!method_exists($entity, $strMethod)))
                    continue;
                $arrSetterFk[] = array($strMethod, $mixValue);
            }
        }
        if (empty($arrSetterFk))
            return;
        foreach ($arrSetterFk as $arrSet) {
            if ((!is_array($arrSet)) || (count($arrSet) < 2))
                continue;
            $strMethod = $arrSet[0];
            if (count($arrSet) == 2) {
                $mixValue = $arrSet[1];
                $strAttribute = str_replace('-', '_', String::dasherize(substr($strMethod, 3)));
                $arrMapAttribute = @$arrMap[$strAttribute];
                if (empty($arrMapAttribute)) {
                    $strAttribute = lcfirst(String::camelize($strAttribute));
                    $arrMapAttribute = @$arrMap[$strAttribute];
                    if (empty($arrMapAttribute))
                        continue;
                }
                $strEntity = $arrMapAttribute['targetEntity'];
            } else {
                $strEntity = $arrSet[1];
                $mixValue = $arrSet[2];
            }
            $entity->$strMethod((is_object($mixValue)) ? $mixValue : $this->getReferenceEntity((empty($mixValue)) ? 0 : $mixValue, $strEntity));
        }
    }

    /**
     * Metodo responsavel em definir o objeto Entity Manager.
     *
     * @example $this->getService('Path\To\Service')->setEntityManager(new \InepZend\Doctrine\ORM\EntityManager());
     *
     * @param object $entityManager
     * @return object
     */
    protected function setEntityManager($entityManager = null)
    {
        if ((!is_object($entityManager)) || ((is_object($entityManager)) && (!$entityManager->isOpen())))
            $entityManager = $this->createEntityManager();
        elseif (is_object($entityManager))
            $entityManager = AbstractRepositoryEntityManager::configEntityManager($entityManager);
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * Metodo responsavel em retornar o objeto Entity Manager.
     *
     * @example $this->getService('Path\To\Service')->getEntityManager();
     *
     * @return object
     */
    protected function getEntityManager()
    {
        if (!is_object($this->entityManager))
            $this->setEntityManager();
        return $this->entityManager;
    }

    /**
     * Metodo responsavel em criar uma instancia do EntityManager de acordo com
     * as configuracoes definidas para uma conexao.
     *
     * @example $this->getService('Path\To\Service')->createEntityManager(true, 'InepZend\Module\UnitTest\Entity');
     *
     * @param boolean $booSetEntityManager
     * @param string $strEntityNamespace
     * @return object
     */
    public function createEntityManager($booSetEntityManager = true, $strEntityNamespace = null)
    {
        if (!is_object($this->entityManager))
            return;
        $entityManager = EntityManager::create($this->getEntityManager()->getConnection(), $this->getEntityManager()->getConfiguration());
        if (!empty($strEntityNamespace)) {
            $driverImpl = new DatabaseDriver($entityManager->getConnection()->getSchemaManager());
            $driverImpl->setNamespace($strEntityNamespace);
            $entityManager->getConfiguration()->setMetadataDriverImpl($driverImpl);
        }
        if ($booSetEntityManager === true)
            $this->setEntityManager($entityManager);
        return $entityManager;
    }

    /**
     * Metodo responsavel em retornar a RepositoryEntity.
     *
     * @example $this->getService('Path\To\Service')->getRepositoryEntity(new \Path\To\Entity());
     *
     * @param string $strEntity
     * @return mix
     */
    protected function getRepositoryEntity($strEntity = null)
    {
//        $this->trace(__FUNCTION__, func_get_args());
        if (empty($strEntity))
            $strEntity = $this->strEntity;
        if ($strEntity) {
            if (!array_key_exists($strEntity, self::$arrRepositoryEntity))
                self::$arrRepositoryEntity[$strEntity] = $this->getEntityManager()->getRepository($strEntity);
            return self::$arrRepositoryEntity[$strEntity];
        }
        return false;
    }

    /**
     * Metodo responsavel em retornar a referencia da entidade dependente.
     *
     * @example $this->getService('Path\To\Service')->getReferenceEntity(array('name_column' => 'value'), '\Path\To\Entity');
     *
     * @param array $mixPkValue
     * @param string $strEntity
     * @return mix
     */
    protected function getReferenceEntity($mixPkValue, $strEntity = null)
    {
        if (empty($strEntity))
            $strEntity = $this->strEntity;
        if ($this->hasDocumentManager())
            $mixPkValue = $mixPkValue[reset($this->arrPk)];
        return ($strEntity) ? $this->getEntityManager()->getReference($strEntity, $mixPkValue) : false;
    }

    /**
     * Metodo responsavel em retornar o namespace da entidade a ser trabalhada pela
     * service.
     *
     * @example $this->getService('Path\To\Service')->getEntityName();
     *
     * @param string $strEntity
     * @return mix
     */
    protected function getEntityName($strEntity = null)
    {
        if (empty($strEntity))
            $strEntity = $this->strEntity;
        return $strEntity;
    }

    /**
     * Metodo responsavel por verificar se o entity manager esta utilizando Document Manager
     *
     * @return bool
     */
    protected function hasDocumentManager()
    {
        return ($this->getEntityManager() instanceof DocumentManager) ? true : false;
    }

    /**
     * Metodo responsavel em realizar a persistencia dos dados.
     *
     * @example $this->persist(new \Path\To\Entity(), array(array('method', '\Path\To\Entity', 'value')));
     *
     * @param object $entity
     * @param array $arrSetterFk
     * @return object
     */
    private function persist($entity, array $arrSetterFk = array())
    {
        $this->trace(__FUNCTION__, func_get_args());
        try {
            $this->setFk($entity, $arrSetterFk);
            $this->getEntityManager()->persist($entity);
            $this->flush();
            return $entity;
        } catch (ExceptionNative $exception) {
            throw Exception::cloneException($exception);
        }
    }

    /**
     * Metodo responsavel em retornar os valores das PKs da entidade.
     *
     * @param array $arrData
     * @return array
     */
    private function getPkValue($arrData = array())
    {
        $arrPkValue = array();
        foreach ((array) $this->arrPk as $strPk)
            if (array_key_exists($strPk, $arrData))
                $arrPkValue[$strPk] = $arrData[$strPk];
        return $arrPkValue;
    }

    /**
     * Metodo responsavel em retornar uma informacao do doctrine
     * existente em uma estrutura de opcoes.
     *
     * @param array $arrSetting
     * @param string $strType
     * @param string $strConnectionName
     * @param string $strItem
     * @param mix $mixDefaultValue
     * @return mix
     */
    private function getInfoFromSetting($arrSetting = [], $strType = null, $strConnectionName = null, $strItem = null, $mixDefaultValue = null)
    {
        $mixResult = ArrayCollection::getFromIndexPattern($arrSetting, $strType . '\\' . $strConnectionName . '\\' . $strItem);
        if (is_null($mixResult))
            $mixResult = ArrayCollection::getFromIndexPattern($arrSetting, $strType . '\\orm_default\\' . $strItem, $mixDefaultValue);
        return $mixResult;
    }
}
