<?php

namespace InepZend\Service;

use InepZend\Paginator\Paginator;
use InepZend\Exception\Exception;
use InepZend\Util\stdClass;
use Zend\Paginator\Adapter\ArrayAdapter;

trait ServiceAngularTrait
{

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_FIND
     */
    public function findAction($mixPk = null)
    {
        return $this->find($mixPk);
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_FIND
     */
    public function findByAction($arrCriteria = null, $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        return $this->findBy(empty($arrCriteria) ? null : $arrCriteria, $arrOrderBy, $intLimit, $intOffset);
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_FIND
     */
    public function findByPagedAction($arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $arrRegister = null)
    {
        $paginator = $this->findByPaged(empty($arrCriteria) ? null : $arrCriteria, $strSortName, $strSortOrder, $intPage, $intItemPerPage, $arrRegister);
        if ($paginator->getZendPaginator()->getAdapter() instanceof ArrayAdapter)
            return $paginator;
        return $paginator->setZendPaginator(new stdClass(array(
            'adapter' => array(
//                'array' => array(
                     'count' => $paginator->getZendPaginator()->getAdapter()->getPaginator()->count()
//                ),
            ),
        )));
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_FIND
     */
    public function fetchPairsAction($arrCriteria = null, $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        return $this->fetchPairs(empty($arrCriteria) ? null : $arrCriteria, $arrOrderBy, $intLimit, $intOffset);
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_SAVE
     */
    protected function saveAction(array $arrData, $arrSetterFk = array(), $mixForm = null)
    {
        array_walk_recursive($arrData, '\InepZend\Util\ArrayCollection::arrayWalkRecursiveParse');
        if (!empty($mixForm)) {
            $form = (is_object($mixForm)) ? $mixForm : new $mixForm();
            $form->setData($arrData);
            if (!$form->isValid())
                throw new Exception(var_export($form->getMessages(), true));
            $arrData = $form->getData();
            if (empty($arrData))
                $arrData = $form->getDataForm();
        }
        return $this->save($arrData);
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_DELETE
     */
    protected function deleteAction(array $arrData, $entity = null)
    {
        return $this->delete($arrData);
    }

}
