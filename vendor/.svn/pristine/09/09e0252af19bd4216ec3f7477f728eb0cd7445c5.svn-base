<?php

namespace InepZend\Controller;

use InepZend\ModuleConfig\ModuleConfig;

/**
 * Classe abstrata responsavel pelos metodos relacionado ao Repository (incluindo
 * o EntityManager) para acionar interacoes com o banco de dados.
 *
 * [-] AbstractControllerCore
 *      [-] AbstractControllerServiceManager
 *          [-] AbstractControllerForm
 *              [+] AbstractControllerRepository
 *                  [-] AbstractController
 *                      [-] AbstractControllerPaginator
 *                          [-] AbstractCrudController
 *                              [-] AbstractControllerAngular
 * [-] AbstractRestfulController
 *
 * @package InepZend
 * @subpackage Controller
 */
abstract class AbstractControllerRepository extends AbstractControllerForm
{

    protected $arrPk;
    protected $entityManager;

    /**
     * Metodo responsavel em retornar os dados em array contendo chave e valor, 
     * podendo ser esses Id e Campo consecutivamente.
     * 
     * @example $this->fetchPairs(array('name_column' => 'value'), 'serviceName');
     * 
     * @param array $arrPairs
     * @param string $strService
     * @param string $strMethodService
     * @param array $arrCriteriaMethodService
     * @return mix
     */
    protected function ajaxFetchPairsAction(array $arrPairs = array(), $strService = null, $strMethodService = null, $arrCriteriaMethodService = null)
    {
        if (empty($arrPairs)) {
            if (empty($strMethodService))
                $strMethodService = 'fetchPairsToXmlJson';
            $arrPairs = $this->getService($strService)->$strMethodService($arrCriteriaMethodService);
        }
        return $this->getViewClearContent(json_encode($arrPairs));
    }

    /**
     * Metodo responsavel em retornar os dados das chaves primarias das entidades
     * parametrizadas na rota (querystring).
     * 
     * @example $this->getPkFromRoute();
     * 
     * @param array $arrPk
     * @return mix
     */
    protected function getPkFromRoute($arrPk = null)
    {
        $this->getAttributeValue($arrPk, 'arrPk');
        $arrPkValue = array();
        foreach ($arrPk as $strAttributePk)
            $arrPkValue[$strAttributePk] = $this->getParamsFromRoute($strAttributePk, 0);
        $mixPkValue = (count($arrPkValue) == 0) ? 0 : $arrPkValue;
        if ((is_array($mixPkValue)) && (count($mixPkValue) == 1))
            $mixPkValue = reset($mixPkValue);
        if (is_numeric($mixPkValue))
            $mixPkValue = (integer) $mixPkValue;
        return $mixPkValue;
    }

    /**
     * Metodo responsavel em retornar o objeto EntityManager.
     * 
     * @example $this->getEntityManager('Path\To\Service');
     * 
     * @return object
     */
    protected function getEntityManager($strServiceEntityManager = null)
    {
        if (is_null($this->entityManager))
            $this->entityManager = (new ModuleConfig())->getEntityManagerPublic($this->getServiceLocator(), $strServiceEntityManager);
        return $this->entityManager;
    }

    /**
     * Metodo responsavel em retornar a RepositoryEntity.
     * 
     * @example $this->getRepositoryEntity('\Path\To\Entity');
     * 
     * @param string $strEntity
     * @return mix
     */
    private function getRepositoryEntity($strEntity = null)
    {
        $this->getAttributeValue($strEntity, 'strEntity');
        return ($strEntity) ? $this->getEntityManager()->getRepository($strEntity) : false;
    }

}
