<?php

namespace InepZend\Service;

use InepZend\Paginator\Paginator;
use InepZend\Configurator\Configurator;
use InepZend\Util\FileSystem;
use InepZend\Util\ArrayCollection;
use InepZend\Util\Reflection;
use InepZend\Util\PhpIni;
use InepZend\Util\Server;
use InepZend\Exception\RuntimeException;

/**
 * Classe abstrata responsavel pelos metodos invocadores do Repository (incluindo
 * o EntityManager) para acionar interacoes com o banco de dados persistido
 * internamente em arquivos de sistema (FileSystem).
 *
 * [-] AbstractServiceCore
 *      [-] AbstractServiceCoreCache
 *          [-] AbstractServiceManager
 *              [-] AbstractServiceRepository
 *                  [-] AbstractService
 *                      [-] AbstractServiceAngular
 *                      [-] AbstractServiceControlCache
 *                          [-] AbstractServiceCache
 *                              [-] AbstractServiceCacheAngular
 *                          [+] AbstractServiceFile
 *                              [-] AbstractServiceFileAngular
 *
 * @package InepZend
 * @subpackage Service
 */
abstract class AbstractServiceFile extends AbstractServiceControlCache
{

    const USE_SERIALIZE = true;
    const REGISTER_WITH_BASE64 = true;
    const CONTAINER_PATH = 'data/database/file/';
    const TYPE_ENTITY = 'entity';
    const TYPE_SEQUENCE = 'sequence';
    const PREFIX_EXTENSION = 'sf';
    const SUFIX_CLASS_SERVICE_FILE = 'File';
    const LAZY_TYPE_OBJECT = 'object';
    const LAZY_TYPE_COLLECTION = 'collection';
    const MODE_CHMOD = 0777;

    protected $strContainerPath = self::CONTAINER_PATH;

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        if (!class_exists($this->strEntity))
            $this->strEntity = str_replace(array('Service\\', 'File', '\\\\'), array('Entity\\', '', '\\'), get_class($this));
    }

    /**
     * Metodo responsavel em retornar os dados da entidade, utiliza manipulacao
     * de arquivos.
     *
     * @example $this->getService('Path\To\Service')->find('value_pk');
     *
     * @param mix $mixPk
     * @return mix
     */
    public function find($mixPkValue = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        if (empty($mixPkValue))
            throw new RuntimeException('Valor(es) da(s) PK(s) não informado(s).');
        $arrPkValue = (array) $this->getPkValue($mixPkValue);
        if (in_array(null, $arrPkValue))
            return null;
        if (empty($arrPkValue))
            throw new RuntimeException('Valor(es) da(s) PK(s) incorreto(s).');
        $arrEntity = $this->findBy($arrPkValue, null, 1);
        return ((is_array($arrEntity)) && (count($arrEntity) > 0)) ? $arrEntity[0] : null;
    }

    /**
     * Metodo responsavel em retornar os dados da entidade parametrizada, utiliza
     * a manipulacao de arquivos.
     *
     * @example $this->getService('Path\To\Service')->findBy(array('name_column' => 'value'), array('name_column' => 'ASC | DESC'), 10, 0);
     *
     * @param array $arrCriteria
     * @param array $arrOrderBy
     * @param integer $intLimit
     * @param integer $intOffset
     * @return mix
     */
    public function findBy($arrCriteria = null, $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        $arrEntity = $this->findAll();
        $arrEntity = $this->applyCriteria($arrEntity, (array) $arrCriteria);
        $arrEntity = $this->applyOrderBy($arrEntity, (array) $arrOrderBy);
        $arrEntity = $this->applyOffset($arrEntity, $intOffset);
        $arrEntity = $this->applyLimit($arrEntity, $intLimit);
        return $arrEntity;
    }

    /**
     * Metodo responsavel em retornar TODOS os dados de uma entidade.
     *
     * @return mix
     */
    public function findAll()
    {
        $this->trace(__FUNCTION__, func_get_args());
        $mixContent = $this->getContentFromEntityFile();
        if (is_bool($mixContent))
            throw new RuntimeException('Ocorreu uma falha ao ler o conteúdo do arquivo de dados da entidade.');
        if (!self::USE_SERIALIZE) {
            $arrEntity = array();
            $arrContent = explode("\n", $mixContent);
            foreach ($arrContent as $strRegister) {
                if (empty($strRegister))
                    continue;
                $entity = $this->decodeRegister($strRegister);
                if (!is_object($entity))
                    continue;
                $arrEntity[] = $this->getInstanceEntity(null, null, $entity);
            }
        } else {
            $arrEntity = @unserialize($mixContent);
            if (!is_array($arrEntity))
                $arrEntity = array();
        }
        return $arrEntity;
    }

    /**
     * Metodos responsavel em retornar os dados de uma entidade baseado no
     * array passado como parametro.
     *
     * @param array $arrData
     * @param boolean $booCheckFind
     * @return mix
     */
    public function findFromData(array $arrData, $booCheckFind = true)
    {
        $this->trace(__FUNCTION__, func_get_args());
        if (empty($arrData))
            throw new RuntimeException('Dados com o(s) valor(es) da(s) PK(s) não informados.');
        $entity = $this->find($arrData);
        if (($booCheckFind) && (!is_object($entity)))
            throw new RuntimeException('Entidade não encontrada.');
        return $entity;
    }

    /**
     * Metodo responsavel em persistir os dados da entidade, utilizando a manipulacao
     * de arquivos.
     *
     * @example $this->getService('Path\To\Service')->insert($entityObject()->toArray(), array(array('method', '\Path\To\Entity', 'value')));
     *
     * @param array $arrCriteria
     * @param array $arrSetterFk
     * @return mix
     */
    public function insert(array $arrData, array $arrSetterFk = array(), $strEntity = null, $booCheckSequence = false)
    {
        $this->trace(__FUNCTION__, func_get_args());
        $this->nextVal($arrData, $strEntity, $booCheckSequence);
        $this->debugExec($arrData);
        $entity = $this->getInstanceEntity($arrData, $strEntity);
        $this->debugExec($entity);
        $entityClone = clone $entity;
        $this->insertEntityIntoFile($entity);
        return $entityClone;
    }

    /**
     * Metodo responsavel em alterar os dados da entidade, utilizando a manipulacao
     * de arquivos.
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
        $this->debugExec($arrData);
        $entityCurrent = $this->findFromData((array) $arrData, false);
        if (!is_object($entityCurrent))
            return $this->insert($arrData, $arrSetterFk);
        $entity = $this->getInstanceEntity(array_merge((array) $this->entityToArray($entityCurrent), $arrData));
        $this->debugExec($entity);
        $entityClone = clone $entity;
        $this->manipulateEntityIntoFile($entityCurrent, null, $entity);
        return $entityClone;
    }

    /**
     * Metodo responsavel em deletar os dados da entidade, utilizando a manipulacao
     * de arquivos.
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
        if (!is_object($entity)) {
            $arrDataFind = array();
            foreach ((array) $arrData as $mixKey => $mixValue) {
                $strAttribute = $mixKey;
                if (is_numeric($mixKey))
                    $strAttribute = $this->arrPk[$mixKey];
                $arrDataFind[$strAttribute] = $mixValue;
            }
            $entity = $this->findFromData($arrDataFind);
            $this->debugExec($arrData);
        }
        $this->manipulateEntityIntoFile($entity);
        return true;
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
        if ((empty($strMethodValue)) || (empty($strMethodText)))
            return;
        $arrEntity = $this->findBy((array) $arrCriteria, (array) $arrOrderBy, $intLimit, $intOffset);
        $arrResult = array();
        foreach ($arrEntity as $entity)
            $arrResult[$entity->$strMethodValue()] = $entity->$strMethodText();
        return $arrResult;
    }

    /**
     * Metodo responsavel em retornar os dados em array contendo chave e valor,
     * podendo ser esses Id e Campo consecutivamente. O formato de retorno he em
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
        $arrRegister = $this->fetchPairs((array) $arrCriteria, $strMethodValue, $strMethodText, (array) $arrOrderBy, $intLimit, $intOffset);
        $this->trace(__FUNCTION__, func_get_args());
        $arrResult = array();
        foreach ($arrRegister as $mixValue => $mixText)
            $arrResult[] = array('value' => $mixValue, 'text' => $mixText);
        return $arrResult;
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
     * @param array $arrRegister
     * @return mix
     */
    public function findByPaged(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $arrRegister = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        $arrOrderBy = null;
        if (!empty($strSortName))
            $arrOrderBy = array($strSortName => ((strtolower($strSortOrder) == 'desc') ? 'desc' : 'asc'));
        return new Paginator((is_array($arrRegister)) ? $arrRegister : $this->findBy((array) $arrCriteria, (array) $arrOrderBy), $intPage, $intItemPerPage);
    }

    /**
     * Metodo responsavel em popular os dados de um objeto em arquivo.
     *
     * @param string $strService
     * @param integer $intDeep
     * @return type
     */
    public function populate($strService = null, $intDeep = 0)
    {
        PhpIni::setMaxExecutionTime(0);
        PhpIni::setMemoryLimit(3072);
        if (empty($strService)) {
            $strService = $this->strService;
            if (strpos($strService, self::SUFIX_CLASS_SERVICE_FILE) !== false) {
                $strServiceEdited = substr($strService, 0, (strlen($strService) - strlen(self::SUFIX_CLASS_SERVICE_FILE)));
                if (class_exists($strServiceEdited))
                    $strService = $strServiceEdited;
            }
        }
        if (!class_exists($strService))
            return array();
        $service = $this->getService($strService);
        if (!is_object($service))
            return array();
        $arrEntity = $service->findBy();
//        $arrEntity = $service->findBy(array(), array(), 500);
//        if ($intDeep == 0)
//            $arrEntity = $service->findBy(array('id_publicacao' => 4294));
//        else {
////            return array();
//            $arrEntity = $service->findBy();
//        }
        if (!is_array($arrEntity))
            return array();
        if (!is_numeric($intDeep))
            $intDeep = 0;
        if ($intDeep == 0)
            $this->clearContainer();
        $arrResult = array();
        $strDoctrineProxy = 'DoctrineORMModule\Proxy\__CG__\\';
        $arrEntityValue = null;
        foreach ($arrEntity as $entity) {
            $strEntity = get_class($entity);
            if (($intPos = strpos($strEntity, $strDoctrineProxy)) !== false)
                $strEntity = substr($strEntity, $intPos + strlen($strDoctrineProxy));
            $arrEntityValue = $this->entityToArray($entity);
            self::insert($arrEntityValue, array(), $strEntity, false);
        }
        if (is_array($arrEntityValue)) {
            $arrResult[$strEntity] = count($arrEntity);
            foreach ($arrEntityValue as $strAttribute => $mixValue) {
                $arrAnnotation = Reflection::listAnnotationsFromAttribute($entity, $strAttribute);
                if (is_array($arrAnnotation)) {
                    foreach ($arrAnnotation as $strAnnotation => $strAnnotationValue) {
                        if ((strpos($strAnnotation, 'ORM\MANYTOONE') === 0) || (strpos($strAnnotation, 'ORM\ONETOMANY') === 0) || (strpos($strAnnotation, 'ORM\MANYTOMANY') === 0)) {
                            $strEntity = $this->getTargetEntity($strAnnotationValue);
                            $strContent = $this->getContentFromEntityFile($strEntity);
                            if (empty($strContent))
                                $arrResult = array_merge($arrResult, $this->populate(str_replace('\Entity\\', '\Service\\', $strEntity), ++$intDeep));
                        }
                    }
                }
            }
        }
        return $arrResult;
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
        $arrEntity = $this->findBy($arrCriteria);
        foreach ((array) $arrEntity as $entity) {
            $mixResult = $this->delete($this->getPkValue(ArrayCollection::objectToArray($entity)));
            if (!$mixResult)
                return false;
        }
        return true;
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
        # sobrescrevendo...
        return false;
    }

    /**
     * Metodo responsavel em salvar/executar a transacao ja realizada no banco
     * de dados.
     *
     * @example $this->getService('Path\To\Service')->commit();
     *
     * @return mix
     */
    public function commit()
    {
        # sobrescrevendo...
        return false;
    }

    /**
     * Metodo responsavel em desfazer a transacao ja realizada no banco de dados.
     *
     * @example $this->getService('Path\To\Service')->rollback();
     *
     * @return mix
     */
    public function rollback()
    {
        # sobrescrevendo...
        return false;
    }

    /**
     * Metodo responsavel em salvar e finalizar a transacao ja realizada no
     * banco de dados.
     *
     * @example $this->getService('Path\To\Service')->flush();
     *
     * @return mix
     */
    public function flush()
    {
        # sobrescrevendo...
        return false;
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
        # sobrescrevendo...
        return false;
    }

    /**
     * Metodo responsavel em setar o flush.
     *
     * @example \InepZend\Service\AbstractServiceRepository::setFlush(true | false);
     *
     * @param boolean $booFlush
     */
    public static function setFlush($booFlush = true)
    {
        # sobrescrevendo...
        return false;
    }

    /**
     * Metodo responsavel em retornar o flush.
     *
     * @example \InepZend\Service\AbstractServiceRepository::getFlush();
     *
     * @return boolean
     */
    public static function getFlush()
    {
        # sobrescrevendo...
        return false;
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
        if (!is_object($entity))
            return;
        foreach ($arrSetterFk as $arrSet) {
            if ((!is_array($arrSet)) || (count($arrSet) != 3))
                continue;
            $entity->$arrSet[0]($this->getReferenceEntity($arrSet[2], $arrSet[1]));
        }
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
        # sobrescrevendo...
        return false;
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
        # sobrescrevendo...
        return false;
    }

    /**
     * Metodo responsavel em retornar a referencia da entidade dependente.
     *
     * @example $this->getService('Path\To\Service')->getReferenceEntity(array('name_column' => 'value'), '\Path\To\Entity');
     *
     * @param array $arrPkValue
     * @param string $strEntity
     * @return mix
     */
    protected function getReferenceEntity($arrPkValue = null, $strEntity = null, $booCollection = false)
    {
        $strEntity = $this->getClassNameEntity($strEntity);
        if ((!is_array($arrPkValue)) && (!empty($arrPkValue))) {
            $arrPk = $this->getPkEntity($strEntity);
            if ((is_array($arrPk)) && (count($arrPk) > 0)) {
                if (count($arrPk) == 1) {
                    $arrPkValueNew = array($arrPk[0] => $arrPkValue);
                    $arrPkValue = $arrPkValueNew;
                }
            }
        }
        $strClass = '\InepZend\Entity\Proxy\\';
        $strClass .= ($booCollection === true) ? 'CollectionEntityFile' : 'EntityFile';
        return ($strEntity) ? new $strClass($strEntity, $arrPkValue) : false;
    }

    /**
     * Metodo responsavel em realizar a persistencia dos dados.
     *
     * @example $this->persist(new \Path\To\Entity(), array(array('method', '\Path\To\Entity', 'value')));
     *
     * @param object $entity
     * @param array $arrSetterFk
     * @return object
     * @deprecated O emerge realiza este papel (de setar as FKs) via ORM
     */
    private function persist($entity, array $arrSetterFk = array())
    {
        $this->trace(__FUNCTION__, func_get_args());
        $this->setFk($entity, $arrSetterFk);
        return $entity;
    }

    /**
     * Metodo responsavel em retornar a instancia de uma entidade.
     *
     * @param array $arrData
     * @param string $strEntity
     * @param object $entity
     * @param boolean $booClearAttributeWithTargetEntity
     * @param boolean $booEmerge
     * @return mix
     */
    private function getInstanceEntity($arrData, $strEntity = null, $entity = null, $booClearAttributeWithTargetEntity = false, $booEmerge = true)
    {
        if (!is_object($entity)) {
            $strEntity = $this->getClassNameEntity($strEntity);
            $entity = new $strEntity($arrData);
        }
        if (!is_bool($booEmerge))
            $booEmerge = true;
        return ($booEmerge) ? $this->emerge($entity, $booClearAttributeWithTargetEntity) : $entity;
    }

    /**
     * Metodo responsavel em retornar o nome da entidade.
     *
     * @param string $strEntity
     * @return mix
     */
    private function getClassNameEntity($strEntity = null)
    {
        if (empty($strEntity)) {
            $this->checkAttributeEntity();
            $strEntity = $this->strEntity;
        }
        return $strEntity;
    }

    /**
     * Metodo responsavel em verificar se existe atributos em uma entidade.
     *
     */
    private function checkAttributeEntity()
    {
        if (empty($this->strEntity))
            throw new RuntimeException('É necessária que a entidade seja definida.');
    }

    /**
     * Metodo responsavel em retornar a chave da entidade em uma colecao de dados.
     *
     * @param object $entity
     * @param array $arrEntity
     * @return mix
     */
    private function getKeyEntityFromCollection($entity = null, $arrEntity = null)
    {
        if (!is_object($entity))
            throw new RuntimeException('Entidade não informada.');
        if (empty($arrEntity))
            $arrEntity = $this->findAll();
        if (empty($arrEntity))
            return null;
        foreach ($arrEntity as $intKey => $entityIntern) {
            if ($entityIntern == $entity)
                return $intKey;
        }
        return null;
    }

    /**
     * Metodo responsavel em manipular os dados de uma entidade em uma arquivo.
     *
     * @param object $entityCurrent
     * @param array $arrEntity
     * @param object $entityNew
     * @param boolean $booInsert
     * @return boolean
     */
    private function manipulateEntityIntoFile($entityCurrent = null, $arrEntity = null, $entityNew = null, $booInsert = false)
    {
        if (!is_object($entityCurrent))
            throw new RuntimeException('Entidade atual não informada.');
        if (empty($arrEntity))
            $arrEntity = $this->findAll();
        $intKey = $this->getKeyEntityFromCollection($entityCurrent, $arrEntity);
        $this->debugExec($intKey);
        if ((!is_null($intKey)) || ($booInsert === true)) {
            if (is_null($intKey))
                $intKey = count((array) $arrEntity);
            if (!is_object($entityNew))
                unset($arrEntity[$intKey]);
            else
                $arrEntity[$intKey] = $entityNew;
            $this->insertAllEntityIntoFile($arrEntity);
        }
        return true;
    }

    /**
     * Metodo responsavel em retornar o conteudode uma entidade contido em um arquivo.
     *
     * @param string $strEntity
     * @return mix
     */
    private function getContentFromEntityFile($strEntity = null)
    {
        return $this->getContentFromFile(self::TYPE_ENTITY, $strEntity);
    }

    /**
     * Metodo responsavel em retornar o conteudode uma sequence contido em um arquivo.
     *
     * @param string $strEntity
     * @return mix
     */
    private function getContentFromSequenceFile($strEntity = null)
    {
        return $this->getContentFromFile(self::TYPE_SEQUENCE, $strEntity);
    }

    /**
     * Metodo responsavel em retornar o conteudode de um arquivo.
     *
     * @param string $strType
     * @param string $strEntity
     * @return string
     */
    private function getContentFromFile($strType = null, $strEntity = null)
    {
        return trim(FileSystem::getContentFromFile($this->getFilePath($strType, $strEntity)));
    }

    /**
     * Metodo responsavel em inserir dados de uma entidade em um arquivo.
     *
     * @param object $entity
     * @return mix
     */
    private function insertEntityIntoFile($entity = null)
    {
        if (!is_object($entity))
            return false;
        if (!self::USE_SERIALIZE)
            return $this->insertContentIntoFile($this->encodeEntity($this->getInstanceEntity(null, null, $entity, true)) . "\n", 'a+', self::TYPE_ENTITY, get_class($entity));
        $arrEntity = $this->findAll();
        if (!$arrEntity)
            $arrEntity = array();
        $arrEntity[] = $entity;
        return $this->insertAllEntityIntoFile($arrEntity);
    }

    /**
     * Metodo responsavel em inserir todos os dados de uma entidade em um arquivo.
     *
     * @param array $arrEntity
     * @return boolean
     */
    private function insertAllEntityIntoFile($arrEntity = null)
    {
        if (!is_array($arrEntity))
            return false;
        $arrEntity = array_values($arrEntity);
        if (!self::USE_SERIALIZE) {
            $this->insertContentIntoFile(null, 'w+', self::TYPE_ENTITY, ((count($arrEntity) > 0) ? get_class($arrEntity[0]) : null));
            foreach ($arrEntity as $entity)
                $this->insertEntityIntoFile($entity);
        } else
            $this->insertContentIntoFile(serialize($arrEntity), 'w+', self::TYPE_ENTITY, ((count($arrEntity) > 0) ? get_class($arrEntity[0]) : null));
        return true;
    }

    /**
     * Metodo responsavel em inserir dados de uma sequence em um arquivo.
     *
     * @param interger $intSequence
     * @param string $strEntity
     * @return mix
     */
    private function insertSequenceIntoFile($intSequence = 0, $strEntity = null)
    {
        if (empty($intSequence))
            $intSequence = 0;
        return $this->insertContentIntoFile((integer) $intSequence, 'w+', self::TYPE_SEQUENCE, $strEntity);
    }

    /**
     * Metodo responsavel em inserir conteudo em um arquivo.
     *
     * @param mix $mixContent
     * @param string $strMode
     * @param string $strType
     * @param string $strEntity
     * @return mix
     */
    private function insertContentIntoFile($mixContent = null, $strMode = 'w+', $strType = null, $strEntity = null)
    {
        return FileSystem::insertContentIntoFile($this->getFilePath($strType, $strEntity), $mixContent, $strMode);
    }

    /**
     * Metodo responsavel em definir o path do container.
     *
     * @param string $strContainerPath
     * @return object
     */
    protected function setContainerPath($strContainerPath = null)
    {
        $this->strContainerPath = $strContainerPath;
        return $this;
    }

    /**
     * Metodo responsavel em retornar o path do container.
     *
     * @return string
     */
    private function getContainerPath()
    {
        return Server::getReplacedBasePathApplication('/../../../../../' . $this->strContainerPath);
    }

    /**
     * Metodo responsavel em limpar um container.
     *
     * @return mix
     */
    private function clearContainer()
    {
        return FileSystem::undir($this->getContainerPath());
    }

    /**
     * Metodo responsavel em retornar o caminho de um arquivo.
     *
     * @param string $strType
     * @param string $strEntity
     * @return string
     */
    private function getFilePath($strType = null, $strEntity = null)
    {
        if (empty($strType))
            $strType = self::TYPE_ENTITY;
        $strPath = $this->getPath(strtolower($strType . '/'));
        $strEntity = $this->getClassNameEntity($strEntity);
        $strFilePath = $strPath . strtolower(str_replace(array('\\', '/', ' '), array('-', '-', ''), trim($strEntity)) . '.' . self::PREFIX_EXTENSION . substr($strType, 0, 3));
        if ((is_file($strFilePath)) && (!FileSystem::isWritable($strFilePath)))
            chmod($strFilePath, self::MODE_CHMOD);
        return $strFilePath;
    }

    /**
     * Metodo responsavel em retorar o caminho de um diretorio.
     *
     * @param string $strComplementPath
     * @return string
     */
    private function getPath($strComplementPath = null)
    {
        $strPath = $this->getContainerPath() . (string) $strComplementPath;
        if (!is_dir($strPath))
            mkdir($strPath, self::MODE_CHMOD, true);
        elseif (!FileSystem::isWritable($strPath))
            chmod($strPath, self::MODE_CHMOD);
        return $strPath;
    }

    /**
     * Metodo responsavel em retornar o nome da chave primaria (PK) de uma entidade.
     *
     * @param string $strEntity
     * @return array
     */
    private function getPkEntity($strEntity = null)
    {
        if (!empty($strEntity)) {
            $arrPk = array();
            $entity = $this->getInstanceEntity(null, $strEntity, null, false, false);
            $arrEntityValue = $this->entityToArray($entity);
            foreach ($arrEntityValue as $strAttribute => $mixValue) {
                if (is_array($mixValue))
                    continue;
                $arrAnnotation = Reflection::listAnnotationsFromAttribute($entity, $strAttribute);
                if (is_array($arrAnnotation)) {
                    foreach ($arrAnnotation as $strAnnotation => $strAnnotationValue) {
                        if (strpos($strAnnotation, 'ORM\ID') === 0)
                            $arrPk[] = $strAttribute;
                    }
                }
            }
        } else
            $arrPk = $this->arrPk;
        return $arrPk;
    }

    /**
     * Metodo responsavel em retornar o proximo valor de uma sequence.
     *
     * @param array $arrData
     * @param string $strEntity
     * @param boolean $booCheckSequence
     * @return mix
     */
    protected function nextVal(array &$arrData, $strEntity = null, $booCheckSequence = true)
    {
        $intSequenceNew = null;
        $arrPk = $this->getPkEntity($strEntity);
        if ((is_array($arrPk)) && (count($arrPk) > 0)) {
            if (count($arrPk) == 1) {
                $strPk = $arrPk[0];
                $this->debugExec($strPk);
                $intSequenceCurrent = (integer) $this->getContentFromSequenceFile($strEntity);
                if (empty($intSequenceCurrent))
                    $intSequenceCurrent = 0;
                $this->debugExec($intSequenceCurrent);
                if (!is_bool($booCheckSequence))
                    $booCheckSequence = true;
                if (($booCheckSequence) && (!is_null($arrData[$strPk])) && ($intSequenceCurrent >= (integer) $arrData[$strPk]))
                    throw new RuntimeException('É necessário informar o valor da PK maior que a sequence da entidade.');
                $intSequenceNew = 0;
                if (empty($arrData[$strPk])) {
                    $intSequenceNew = ($intSequenceCurrent + 1);
                    $arrData[$strPk] = $intSequenceNew;
                } else
                    $intSequenceNew = $arrData[$strPk];
                if ($intSequenceNew >= $intSequenceCurrent)
                    $this->insertSequenceIntoFile($intSequenceNew, $strEntity);
            } else {
                foreach ($arrPk as $strPk) {
                    if (empty($arrData[$strPk]))
                        throw new RuntimeException('É necessário que todas as PKs estejam com valor informado.');
                }
            }
        }
        $this->debugExec($intSequenceNew);
        return $intSequenceNew;
    }

    /**
     * Metodo responsavel em retornar o valor de uma chave primaria (PK) de uma
     * entidade.
     *
     * @param mix $mixPk
     * @param string $strEntity
     * @return array
     */
    private function getPkValue($mixPk = null, $strEntity = null)
    {
        if (empty($mixPk))
            throw new RuntimeException('É necessário definir o(s) valor(es) da(s) PK(s) da entidade.');
        $arrPk = $this->getPkEntity($strEntity);
        if ((is_array($arrPk)) && (count($arrPk) > 0)) {
            if (!is_array($mixPk))
                $arrPkValue = array($arrPk[0] => $mixPk);
            else {
                $arrPkValue = array();
                foreach ($arrPk as $strPk) {
                    if (!array_key_exists($strPk, $mixPk))
                        throw new RuntimeException('É necessário definir TODO(S) o(s) valor(es) da(s) PK(s) da entidade.');
                    $arrPkValue[$strPk] = $mixPk[$strPk];
                }
            }
        } else
            throw new RuntimeException('É necessário definir a(s) PK(s) da entidade.');
        return $arrPkValue;
    }

    /**
     * Metodo responsavel em aplicar criterio na pesquisa.
     *
     * @param array $arrEntity
     * @param array $arrCriteria
     * @return array
     */
    private function applyCriteria($arrEntity = null, array $arrCriteria = array())
    {
        if (!is_array($arrEntity))
            return $arrEntity;
        if (count($arrCriteria) > 0) {
            $arrEntityResult = array();
            foreach ($arrEntity as $entity) {
                $arrEntityValue = $this->entityToArray($entity);
                $booOk = true;
                foreach ($arrCriteria as $strAttribute => $mixValue) {
                    if ((is_array($mixValue)) || (is_numeric($strAttribute)))
                        continue;
                    if (!array_key_exists($strAttribute, $arrEntityValue))
                        throw new RuntimeException('O atributo do filtro não existe na entidade.');
                    if ($arrEntityValue[$strAttribute] != $mixValue) {
                        $booOk = false;
                        break;
                    }
                }
                if ($booOk)
                    $arrEntityResult[] = $entity;
            }
            $arrEntity = $arrEntityResult;
        }
        return $arrEntity;
    }

    /**
     * Metodo responsavel em aplicar a ordenacao em uma pesquisa.
     *
     * @param array $arrEntity
     * @param array $arrOrderBy
     * @return array
     */
    private function applyOrderBy($arrEntity = null, array $arrOrderBy = null)
    {
        if (!is_array($arrEntity))
            return $arrEntity;
        if (count($arrOrderBy) > 0) {
            foreach ($arrOrderBy as $strAttribute => $strSortOrder)
                $arrEntity = $this->applyOrderByAttribute($arrEntity, $strAttribute, $strSortOrder);
        }
        return $arrEntity;
    }

    /**
     * Metodo responsavel em aplicar ordenacao da pesquisa utilizando array de
     * atributos.
     *
     * @param array $arrEntity
     * @param string $strAttribute
     * @param string $strSortOrder
     * @return array
     */
    private function applyOrderByAttribute($arrEntity = null, $strAttribute = null, $strSortOrder = 'asc')
    {
        if (!is_array($arrEntity))
            return $arrEntity;
        $arrEntityResult = array();
        foreach ($arrEntity as $intKey => $entity) {
            $arrEntityValue = $this->entityToArray($entity);
            if (!array_key_exists($strAttribute, $arrEntityValue))
                throw new RuntimeException('O atributo da ordenação não existe na entidade.');
            $arrEntityResult[$arrEntityValue[$strAttribute] . str_pad($intKey, 7, '0', STR_PAD_LEFT)] = $entity;
        }
        if (strtolower($strSortOrder) == 'desc')
            krsort($arrEntityResult);
        else
            ksort($arrEntityResult);
        $arrEntity = array_values($arrEntityResult);
        return $arrEntity;
    }

    /**
     * Metodo responsavel em aplicar OFFSET no filtro da pesquisa.
     *
     * @param array $arrEntity
     * @param interger $intOffset
     * @return array
     */
    private function applyOffset($arrEntity = null, $intOffset = null)
    {
        if (!is_array($arrEntity))
            return $arrEntity;
        if (!is_null($intOffset)) {
            $arrEntityResult = array();
            foreach ($arrEntity as $intKey => $entity) {
                if ($intKey < $intOffset)
                    continue;
                $arrEntityResult[] = $entity;
            }
            $arrEntity = $arrEntityResult;
        }
        return $arrEntity;
    }

    /**
     * Metodo responsavel em aplicar o LIMIT no filtro da pesquisa.
     *
     * @param array $arrEntity
     * @param interger $intLimit
     * @return array
     */
    private function applyLimit($arrEntity = null, $intLimit = null)
    {
        if (!is_array($arrEntity))
            return $arrEntity;
        if (!is_null($intLimit)) {
            $arrEntityResult = array();
            foreach ($arrEntity as $intKey => $entity) {
                if (($intKey + 1) > $intLimit)
                    break;
                $arrEntityResult[] = $entity;
            }
            $arrEntity = $arrEntityResult;
        }
        return $arrEntity;
    }

    /**
     * Metodo responsavel em decodificar que utilizam base 64.
     *
     * @param string $strRegister
     * @return mix
     */
    private function decodeRegister($strRegister = null)
    {
        if (empty($strRegister))
            return false;
        if (self::REGISTER_WITH_BASE64)
            $strRegister = base64_decode((string) $strRegister);
        return unserialize($strRegister);
    }

    /**
     * Metodo responsavel em codificar objeto em base 64.
     *
     * @param object $entity
     * @return mix
     */
    private function encodeEntity($entity = null)
    {
        if (!is_object($entity))
            return false;
        $strRegister = serialize($entity);
        if (self::REGISTER_WITH_BASE64)
            $strRegister = base64_encode($strRegister);
        return $strRegister;
    }

    /**
     * Metodo responsavel em converter objeto em array.
     *
     * @param object $entity
     * @return mix
     */
    private function entityToArray($entity = null)
    {
        if (!is_object($entity))
            return false;
        $arrEntityValue = ArrayCollection::objectToArray($entity, false, 2);
        foreach ($arrEntityValue as $strAttribute => $mixValue) {
            if (is_array($mixValue)) {
                $intCount = 0;
                $arrValueIntern = array();
                foreach ($mixValue as $strKey => $mixValueIntern) {
                    if (in_array($strKey, array('__initializer__', '__cloner__', '__isInitialized__')))
                        continue;
                    if ((in_array($strKey, array('initialized', '_elements', 'booCollection'))) || (strpos($strKey, 'Doctrine\ORM\PersistentCollection') !== false)) {
                        $arrEntityValue[$strAttribute] = null;
                        break;
                    }
                    if ((strpos($strKey, 'InepZend\Entity\Proxy\AbstractEntityProxy') !== false) && (strpos($strKey, 'arrData') !== false)) {
                        $arrEntityValue[$strAttribute] = ((is_array($mixValueIntern)) && (count($mixValueIntern) == 1)) ? reset($mixValueIntern) : $mixValueIntern;
                        break;
                    }
                    ++$intCount;
                    if ((empty($mixValueIntern)) || (!is_numeric($mixValueIntern)))
                        continue;
                    if ((array_key_exists('__isInitialized__', $mixValue)) && (!$mixValue['__isInitialized__']))
                        $arrValueIntern[] = $mixValueIntern;
                    else {
                        if (strpos($strKey, 'id_') === 0) {
                            if (($intCountValueIntern = count($arrValueIntern)) == 0)
                                $arrValueIntern[] = $mixValueIntern;
                            elseif ($intCount == ($intCountValueIntern + 1))
                                $arrValueIntern[] = $mixValueIntern;
                            else
                                break;
                        }
                    }
                }
                if (array_key_exists('__isInitialized__', $mixValue))
                    $arrEntityValue[$strAttribute] = (count($arrValueIntern) == 1) ? reset($arrValueIntern) : $arrValueIntern;
                elseif ((!is_null($arrEntityValue[$strAttribute])) && (count($arrValueIntern) == 1))
                    $arrEntityValue[$strAttribute] = reset($arrValueIntern);
            }
        }
        return $arrEntityValue;
    }

    /**
     * Metodo responsavel em realizar a insercao dos dados em arquivo.
     *
     * @param object $entity
     * @param boolean $booClearAttributeWithTargetEntity
     * @return mix
     */
    private function emerge($entity = null, $booClearAttributeWithTargetEntity = false)
    {
        if (!is_object($entity))
            return false;
        $booChanged = false;
        $arrPkValueEntity = null;
        $arrEntityValue = $this->entityToArray($entity);
        foreach ($arrEntityValue as $strAttribute => $mixValue) {
            if (is_array($mixValue))
                continue;
            $arrAnnotation = Reflection::listAnnotationsFromAttribute($entity, $strAttribute);
            if (is_array($arrAnnotation)) {
                foreach ($arrAnnotation as $strAnnotation => $strAnnotationValue) {
                    $strLazyType = null;
                    $arrPkValue = array();
                    if (strpos($strAnnotation, 'ORM\MANYTOONE') === 0) {
                        $strLazyType = self::LAZY_TYPE_OBJECT;
                        $strAttributeReferenced = $strAttribute;
                        if (array_key_exists('ORM\JOINCOLUMN', $arrAnnotation))
                            $strAttributeReferenced = $this->getReferencedColumnName($arrAnnotation['ORM\JOINCOLUMN']);
                        $arrPkValue = array($strAttributeReferenced => $mixValue);
                    } elseif ((strpos($strAnnotation, 'ORM\ONETOMANY') === 0) || (strpos($strAnnotation, 'ORM\MANYTOMANY') === 0)) {
                        $strLazyType = self::LAZY_TYPE_COLLECTION;
                        if (is_null($arrPkValueEntity))
                            $arrPkValueEntity = (array) $this->getPkValue($arrEntityValue, get_class($entity));
                        $strMappedBy = $this->getMappedBy($strAnnotationValue);
                        if ((!empty($strMappedBy)) && (count($arrPkValueEntity) > 0))
                            $arrPkValueEntity[$strMappedBy] = array_shift($arrPkValueEntity);
                        $arrPkValue = $arrPkValueEntity;
                    }
                    if ((!empty($strLazyType)) && (count($arrPkValue) > 0)) {
                        $strEntity = $this->getTargetEntity($strAnnotationValue);
                        if (!empty($strEntity)) {
                            if ($booClearAttributeWithTargetEntity === true)
                                $mixValueNew = (($strLazyType === self::LAZY_TYPE_OBJECT) && (is_numeric($mixValue))) ? $mixValue : null;
                            else
                                $mixValueNew = $this->getReferenceEntity($arrPkValue, $strEntity, ($strLazyType === self::LAZY_TYPE_COLLECTION));
                            $arrEntityValue[$strAttribute] = $mixValueNew;
                            $booChanged = true;
                        }
                    }
                }
            }
        }
        if ($booChanged)
            Configurator::configure($entity, $arrEntityValue);
        return $entity;
    }

    /**
     * Metodo responsavel em retornar
     *
     * @param string $strAnnotationValue
     * @return mix
     */
    private function getTargetEntity($strAnnotationValue = null)
    {
        return Reflection::getAttributeValueFromAnnotationValue($strAnnotationValue, 'targetEntity');
    }

    /**
     * Metodo responsavel em retornar a referencia de uma coluna na base de dados.
     *
     * @param string $strAnnotationValue
     * @return mix
     */
    private function getReferencedColumnName($strAnnotationValue = null)
    {
        return Reflection::getAttributeValueFromAnnotationValue($strAnnotationValue, 'referencedColumnName');
    }

    /**
     * Metodo responsavel em retornar o mapeamento de um entidade.
     *
     * @param string $strAnnotationValue
     * @return mix
     */
    private function getMappedBy($strAnnotationValue = null)
    {
        return Reflection::getAttributeValueFromAnnotationValue($strAnnotationValue, 'mappedBy');
    }

}
