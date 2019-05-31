<?php

namespace InepZend\Controller;

use InepZend\Controller\AbstractController;
use InepZend\Paginator\Paginator;
use InepZend\Grid\Flexigrid\Flexigrid;
use InepZend\View\View;
use InepZend\Util\ArrayCollection;
use InepZend\Util\Date;

/**
 * Classe abstrata responsavel pelos metodos relacionados a paginacao.
 * 
 * [-] AbstractControllerCore
 *      [-] AbstractControllerServiceManager
 *          [-] AbstractControllerForm
 *              [-] AbstractControllerRepository
 *                  [-] AbstractController
 *                      [+] AbstractControllerPaginator
 *                          [-] AbstractCrudController
 *                              [-] AbstractControllerAngular
 * [-] AbstractRestfulController
 *
 * @package InepZend
 * @subpackage Controller
 */
abstract class AbstractControllerPaginator extends AbstractController
{

    const PAGE_START = 1;
    const ITENS_PER_PAGE = Paginator::ITENS_PER_PAGE_DEFAULT;

    protected $arrMethodPaging;
    protected $arrMethodPk;

    /**
     * Metodo responsavel em realizar a paginacao dos registros via metodo findByPaged
     * e retornar uma view parametrizada com as informacoes da paginacao.
     * Nao utiliza parametros de filtragem contidos na sessao.
     * 
     * @example $this->indexPaginatorAction(array('campo' => 'valor') , 'nome_do_campo', 'ASC | DESC', 10, 'Path\To\Service');
     * 
     * @param array $arrCriteria
     * @param string $strSortName
     * @param string $strSortOrder
     * @param int $intItemPerPage
     * @param string $strService
     * @param string $strMethodService
     * @return object
     */
    public function indexPaginatorAction(array $arrCriteria = array(), $strSortName = null, $strSortOrder = null, $intItemPerPage = self::ITENS_PER_PAGE, $strService = null, $strMethodService = null)
    {
        $intPage = $this->getParamsFromRoute('page', self::PAGE_START);
        $intItemPerPage = $this->getParamsFromRoute('rp');
        if (is_null($intItemPerPage))
            $intItemPerPage = $this->getParamsFromRoute('item_page', (!empty($intItemPerPage) ? $intItemPerPage : self::ITENS_PER_PAGE));
        if (empty($strMethodService))
            $strMethodService = 'findByPaged';
        $paginator = $this->getService($strService)->$strMethodService($arrCriteria, $strSortName, $strSortOrder, $intPage, $intItemPerPage);
        return new View(array('arrRegister' => $paginator->getRegister(), 'paginator' => $paginator->getZendPaginator(), 'page' => $intPage, 'item_page' => $intItemPerPage, 'rp' => $intItemPerPage));
    }

    /**
     * Metodo responsavel em retornar uma view com o xml especifico para a Flexigrid
     * ou caso nao seja, em retornar o objeto da paginacao dos registros via metodo
     * findByPaged com uso de parametros de filtragem.
     * Acionado via ajax.
     * 
     * @example $this->ajaxPaginatorAction('method_DQL', 'path\to\service', array('name_colum'), array('pk_name'), 10, true, array('name_colum' => 'value_colum'));
     * 
     * @param mix $mixDQLQuery
     * @param string $strService
     * @param array $arrMethodPaging
     * @param array $arrMethodPk
     * @param int $intItemPerPage
     * @param boolean $booFlexigrid
     * @param array $arrCriteria
     * @param string $strMethodService
     * @return mix
     */
    public function ajaxPaginatorAction($mixDQLQuery = null, $strService = null, $arrMethodPaging = null, $arrMethodPk = null, $intItemPerPage = self::ITENS_PER_PAGE, $booFlexigrid = true, $arrCriteria = null, $strMethodService = null)
    {
        if (!is_bool($booFlexigrid))
            $booFlexigrid = true;
        if ($booFlexigrid) {
            $this->getAttributeValue($arrMethodPaging, 'arrMethodPaging');
            if (empty($arrMethodPaging))
                return $this->getViewClearContent();
        }
        $arrCriteria = $this->prepareRequest(false, $arrCriteria);
        $paginator = $this->getPaginator($mixDQLQuery, self::PAGE_START, $intItemPerPage, null, null, $arrCriteria, $strService, $strMethodService);
        if ($booFlexigrid) {
            if (is_object($paginator))
                $paginator->convertRegisterToGrid($arrMethodPaging, $this->getAttributeValue($arrMethodPk, 'arrMethodPk'));
            return $this->getViewClearContent((new Flexigrid($paginator))->getXml());
        }
        return $paginator;
    }

    /**
     * Metodo responsavel em definir na sessao algumas informacoes providas de um
     * formulario de filtragem (para serem utilizadas na paginacao) e retornar uma
     * view parametrizada com status da operacao.
     * Acionado via ajax.
     * 
     * @example $this->ajaxFilterAction('method_DQL', true | false, 'method_form');
     * 
     * @param mix $mixDQLQuery
     * @param boolean $booAllowEmptyFilter
     * @param mix $mixForm
     * @return object
     */
    public function ajaxFilterAction($mixDQLQuery = null, $booAllowEmptyFilter = true, $mixForm = null)
    {
        $strContent = 'ok';
        $arrFilter = $this->getPost();
        $arrFilterClear = $arrFilter;
        ArrayCollection::clearEmptyParam($arrFilterClear);
        if (($booAllowEmptyFilter === false) && (count($arrFilterClear) == 0))
            $strContent = 'Informe pelo menos um filtro para pesquisa.';
        else {
            $form = null;
            if (is_object($mixForm))
                $form = $mixForm;
            elseif ((empty($mixForm)) && (method_exists($this, 'getFormFilter')))
                $form = $this->getFormFilter();
            if (is_object($form)) {
                $arrFilter = $this->prepareRequest(false, $arrFilter);
                $form->setData($arrFilter);
                if (!$form->isValid()) {
                    $strResult = '';
                    $arrResult = $this->getServiceMessage()->addMessageValidate(null, $form, true);
                    if ((array_key_exists(1, $arrResult)) && (!empty($arrResult[1])))
                        $strResult .= implode('<br />', $arrResult[1]);
                    $strContent = (empty($strResult)) ? 'Ocorreu alguma validaÃ§Ã£o que impede a continuidade da operaÃ§Ã£o.' : $strResult;
                }
            }
            if ($strContent == 'ok')
                $this->setInfoAjaxFilter($arrFilterClear, $mixDQLQuery);
        }
        return $this->getViewClearContent($strContent);
    }

    /**
     * Metodo responsavel em realizar a paginacao dos registros via metodo findByPaged
     * com uso/exclusao dos parametros de filtragem.
     * 
     * @example $this->getPaginator($mixDQLQuery, 1, 10, 'name_colum', 'ASC | DESC', array('name_colum' => 'value'), 'path\to\service');
     * 
     * @param mix $mixDQLQuery
     * @param integer $intPage
     * @param integer $intItemPerPage
     * @param string $strSortName
     * @param string $strSortOrder
     * @param array $arrCriteria
     * @param string $strService
     * @param string $strMethodService
     * @return object
     */
    public function getPaginator($mixDQLQuery = null, $intPage = self::PAGE_START, $intItemPerPage = self::ITENS_PER_PAGE, $strSortName = null, $strSortOrder = null, $arrCriteria = null, $strService = null, $strMethodService = null)
    {
        $intPage = $this->getInfoAjaxPaginator('intPage', null, $intPage);
        $intItemPerPage = $this->getInfoAjaxPaginator('intItemPerPage', null, $intItemPerPage);
        $strSortName = $this->getInfoAjaxPaginator('strSortName', null, $strSortName);
        $strSortOrder = $this->getInfoAjaxPaginator('strSortOrder', null, $strSortOrder);
        $strSearchValue = $this->getInfoAjaxPaginator('strSearchValue', null, false);
        $strSearchField = $this->getInfoAjaxPaginator('strSearchField', null, false);
        $arrCriteriaFinal = array();
        $arrCriteriaPost = $this->getInfoAjaxPaginator('arrCriteria');
        if ((!empty($strSearchValue)) && (!empty($strSearchField)))
            $arrCriteriaFinal = array($strSearchField => $strSearchValue);
        elseif (count($arrCriteriaPost) > 0)
            $arrCriteriaFinal = $arrCriteriaPost;
        if (is_array($arrCriteria))
            $arrCriteriaFinal = array_merge($arrCriteriaFinal, $arrCriteria);
        $arrCriteria = $arrCriteriaFinal;
        unset($arrCriteriaFinal);
        $mixDQLQuerySession = $this->getInfoAjaxFilter('DQLQuery');
        if (!empty($mixDQLQuerySession)) {
            $mixDQLQuery = $mixDQLQuerySession;
            $this->clearInfoAjaxFilter('DQLQuery');
        }
        $this->setInfoAjaxPaginator($intPage, $intItemPerPage, $strSortName, $strSortOrder, $arrCriteria, null, $strService);
        if (empty($strMethodService))
            $strMethodService = 'findByPaged';
        return $this->getService($strService)->$strMethodService($arrCriteria, $strSortName, $strSortOrder, $intPage, $intItemPerPage, $mixDQLQuery);
    }

    /**
     * Metodo responsavel em retornar as informacoes providas de um formulario de
     * filtragem na sessao.
     * 
     * @example $this->getInfoAjaxFilter($strInfo);
     * 
     * @param string $strInfo
     * @return mix
     */
    protected function getInfoAjaxFilter($strInfo = null)
    {
        $session = self::getSessionInstance('ajaxFilter');
        return (!empty($strInfo)) ? $session->offsetGet($strInfo) : $session;
    }

    /**
     * Metodo responsavel em inserir as informacoes tratadas e providas de um formulario
     * de filtragem na sessao.
     * 
     * @example $this->setInfoAjaxFilter($arrFilter, $mixDQLQuery);
     * 
     * @param array $arrFilter
     * @param mix $mixDQLQuery
     * @return boolean
     */
    protected function setInfoAjaxFilter(array $arrFilter = null, $mixDQLQuery = null)
    {
        if (empty($arrFilter)) {
            $arrFilter = $this->getPost();
            ArrayCollection::clearEmptyParam($arrFilter);
        }
        $session = self::getSessionInstance('ajaxFilter');
        $arrFilter = $this->prepareRequest(false, $arrFilter);
        $session->offsetSet('filter', $arrFilter);
        $session->offsetSet('DQLQuery', $mixDQLQuery);
        return true;
    }

    /**
     * Metodo responsavel em limpar as informacoes providas de um formulario de
     * filtragem da sessao.
     * 
     * @param string $strInfo
     * @return true
     */
    protected function clearInfoAjaxFilter($strInfo = null)
    {
        $session = self::getSessionInstance('ajaxFilter');
        if (!empty($strInfo))
            $session->offsetUnset($strInfo);
        else {
            $session->offsetUnset('filter');
            $session->offsetUnset('DQLQuery');
        }
        return true;
    }

    /**
     * Metodo responsavel em retornar informacoes de paginacao contidas na sessao
     * de uma determinada entidade ou em uma requisicao de method POST.
     * 
     * $this->getInfoAjaxPaginator($strInfo, 'path\to\entity');
     * 
     * @param string $strInfo
     * @param string $strEntity
     * @param mix $mixValueDefault
     * @return mix
     */
    protected function getInfoAjaxPaginator($strInfo = null, $strEntity = null, $mixValueDefault = null)
    {
        if ($this->isPost()) {
            $strKey = null;
            switch ($strInfo) {
                case 'arrCriteria':
                    return $this->getCriteriaPost();
                case 'intPage':
                    $strKey = 'page';
                    break;
                case 'intItemPerPage':
                    $strKey = 'rp';
                    break;
                case 'strSortName':
                    $strKey = 'sortname';
                    break;
                case 'strSortOrder':
                    $strKey = 'sortorder';
                    break;
                case 'strSearchValue':
                    if (is_null($mixValueDefault))
                        $mixValueDefault = false;
                    $strKey = 'query';
                    break;
                case 'strSearchField':
                    if (is_null($mixValueDefault))
                        $mixValueDefault = false;
                    $strKey = 'qtype';
                    break;
            }
            if (!empty($strKey))
                return $this->getPost($strKey, $mixValueDefault);
        }
        $session = self::getSessionInstance('ajaxPaginator');
        $arrInfoAjaxPaginator = $session->offsetGet('infoAjaxPaginator');
        $this->getAttributeValue($strEntity, 'strEntity');
        if ((!is_array($arrInfoAjaxPaginator)) || (!array_key_exists($strEntity, $arrInfoAjaxPaginator)))
            return $mixValueDefault;
        return (!empty($strInfo)) ? @$arrInfoAjaxPaginator[$strEntity][$strInfo] : @$arrInfoAjaxPaginator[$strEntity];
    }

    /**
     * Metodo responsavel em inserir todas as informacoes de paginacao de uma determinada
     * entidade na sessao.
     * 
     * @example $this->setInfoAjaxPaginator(1, 10, 'nome_colum', 'ASC | DESC', array('name_colum' => 'value'), 'path\to\entity', 'path\to\service');
     * 
     * @param integer $intPage
     * @param integer $intItemPerPage
     * @param string $strSortName
     * @param string $strSortOrder
     * @param array $arrCriteria
     * @param string $strEntity
     * @param string $strService
     * @return boolean
     */
    protected function setInfoAjaxPaginator($intPage = self::PAGE_START, $intItemPerPage = self::ITENS_PER_PAGE, $strSortName = null, $strSortOrder = null, &$arrCriteria = array(), $strEntity = null, $strService = null)
    {
        $this->getAttributeValue($strEntity, 'strEntity');
        if (empty($strEntity))
            $strEntity = $strService;
        $session = self::getSessionInstance('ajaxPaginator');
        unset($arrCriteria['page'], $arrCriteria['rp'], $arrCriteria['sortname'], $arrCriteria['sortorder'], $arrCriteria['query'], $arrCriteria['qtype'], $arrCriteria['criteria'], $arrCriteria['page_grid']);
        $arrInfoAjaxPaginator = array(
            $strEntity => array(
                'intPage' => $intPage,
                'intItemPerPage' => $intItemPerPage,
                'strSortName' => $strSortName,
                'strSortOrder' => $strSortOrder,
                'arrCriteria' => $arrCriteria,
            )
        );
        $session->offsetSet('infoAjaxPaginator', $arrInfoAjaxPaginator);
        return true;
    }

    /**
     * Metodo responsavel em limpar as informacoes de paginacao de uma determinada
     * entidade na sessao. Tambem eh possivel limpar as informacoes providas de
     * um formulario de filtragem da sessao.
     * 
     * @param boolean $booClearInfoAjaxFilter
     * @return boolean
     */
    protected function clearInfoAjaxPaginator($booClearInfoAjaxFilter = null)
    {
        $session = self::getSessionInstance('ajaxPaginator');
        $session->offsetUnset('infoAjaxPaginator');
        if ($booClearInfoAjaxFilter === true)
            $this->clearInfoAjaxFilter();
        return true;
    }

    /**
     * Metodo responsavel em retornar os criterios de filtro inseridos no POST.
     * 
     * @return array
     */
    protected function getCriteriaPost()
    {
        $strCriteria = $this->getPost('criteria', '');
        $arrCriteria = array();
        $arrCriteriaPost = array();
        if (!empty($strCriteria)) {
            foreach ((array) json_decode($strCriteria) as $strCriteriaItem) {
                $arrCriteriaItem = (array) json_decode($strCriteriaItem);
                if (count($arrCriteriaItem) != 2)
                    continue;
                if ((is_array($arrCriteriaItem[1])) && (count($arrCriteriaItem[1]) == 1))
                    $arrCriteriaItem[1] = reset($arrCriteriaItem[1]);
                if ($booIsTemplate = Date::isDateTemplate($arrCriteriaItem[1]))
                    $arrCriteria[$arrCriteriaItem[0]] = Date::convertDate($arrCriteriaItem[1], 'Y-m-d');
                else
                    $arrCriteria[$arrCriteriaItem[0]] = $arrCriteriaItem[1];
                if ((empty($arrCriteria[$arrCriteriaItem[0]])) && ($arrCriteria[$arrCriteriaItem[0]] != '0'))
                    unset($arrCriteria[$arrCriteriaItem[0]]);
                elseif (is_array($arrCriteria[$arrCriteriaItem[0]])) {
                    foreach ($arrCriteria[$arrCriteriaItem[0]] as $intKey => $mixValue)
                        $arrCriteriaPost[] = json_encode(array(str_replace(array('[', ']'), '', $arrCriteriaItem[0]) . $intKey, $mixValue));
                } else
                    $arrCriteriaPost[] = json_encode(array($arrCriteriaItem[0], $arrCriteria[$arrCriteriaItem[0]]));
            }
            $_POST['criteria'] = json_encode($arrCriteriaPost);
            $this->setPost($_POST);
        }
        return $arrCriteria;
    }

}
