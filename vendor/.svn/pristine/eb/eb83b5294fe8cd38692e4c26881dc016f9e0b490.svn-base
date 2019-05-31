<?php

namespace InepZend\Controller;

use InepZend\View\View;

/**
 * Classe abstrata responsavel pelos metodos basicos para um CRUD completo e 
 * com paginacao.
 * 
 * [-] AbstractControllerCore
 *      [-] AbstractControllerServiceManager
 *          [-] AbstractControllerForm
 *              [-] AbstractControllerRepository
 *                  [-] AbstractController
 *                      [-] AbstractControllerPaginator
 *                          [+] AbstractCrudController
 *                              [-] AbstractControllerAngular
 * [-] AbstractRestfulController
 *
 * @package InepZend
 * @subpackage Controller
 */
abstract class AbstractCrudController extends AbstractControllerPaginator
{

    const CONST_MESSAGE_SUCCESS = self::MESSAGE_SUCCESS;
    const CONST_MESSAGE_ERROR = self::MESSAGE_ERROR;
    const CONST_MESSAGE_WARNING = self::MESSAGE_WARNING;
    const CONST_MESSAGE_NOTICE = self::MESSAGE_NOTICE;
    const CONST_MESSAGE_VALIDATE = self::MESSAGE_VALIDATE;

    public $strController;
    protected $strService;
    protected $strEntity;
    protected $strForm;
    protected $strRoute;
    protected $arrVariableMerge = array();

    public function __construct($strController = null, $arrVariableMerge = null)
    {
        if (empty($strController))
            $strController = get_class($this);
        $this->strController = $strController;
        $this->strService = $this->getNamespaceClass('Service');
        if (!class_exists($this->strService))
            $this->strService .= 'File';
        $this->strEntity = $this->getNamespaceClass('Entity');
        $this->strForm = $this->getNamespaceClass('Form');
        $this->strRoute = $this->getRouteClass();
        if (!empty($arrVariableMerge))
            $this->arrVariableMerge = $arrVariableMerge;
    }

    /**
     * Metodo responsavel em executar o metodo "clearInfoAjaxPaginator" caso o mesmo
     * esteja em seu escopo. 
     * Apos a execucao da chamada o metodo indexAction
     * fica responsavel em limpar as informacoes de paginacao de uma determinada
     * entidade na sessao. 
     * Tambem eh possivel limpar as informacoes providas de um formulario de 
     * filtragem da sessao.
     * 
     * @param min $mixForm
     * @return mix
     */
    public function indexAction($mixForm = null)
    {
        if (method_exists($this, 'clearInfoAjaxPaginator'))
            $this->clearInfoAjaxPaginator();
        return $this->getViewVariable((is_object($mixForm)) ? array('form' => $mixForm) : array());
    }

    /**
     * Metodo responsavel em inserir as informações enviadas pelo formulario
     * no banco de dados.
     * Na classe controladora que herda da "AbstractCrudController" devera ser
     * passados os dados para esse metodo, com isso o mesmo ficara responsavel
     * pela persistencia dos dados.
     * 
     * @example $this->addAction($this->getForm('\Path\To\Form'), array(data), '\Path\To\Entity', 'router', '\Path\To\Service');
     * 
     * @param mix $mixForm
     * @param array $arrDataMerge
     * @param string $strEntity
     * @param string $strRoute
     * @param string $strService
     * @param string $strMessageSuccess
     * @param array $arrRouteParam
     * @return mix
     */
    public function addAction($mixForm = null, $arrDataMerge = null, $strEntity = null, $strRoute = null, $strService = null, $strMessageSuccess = null, $arrRouteParam = array())
    {
        return $this->addEditAction('insert', $mixForm, $arrDataMerge, $strEntity, $strRoute, $strService, null, $strMessageSuccess, $arrRouteParam);
    }

    /**
     * Metodo responsavel em alterar as informações enviadas pelo formulario
     * no banco de dados.
     * Na classe controladora que herda da "AbstractCrudController" devera ser
     * passados os dados para esse metodo, com isso o mesmo ficara responsavel
     * pela persistencia dos dados.
     * 
     * @example $this->editAction($this->getForm('\Path\To\Form'), array(data), '\Path\To\Entity', 'router', '\Path\To\Service', array('name_pk'));
     * 
     * @param mix $mixForm
     * @param array $arrDataMerge
     * @param string $strEntity
     * @param string $strRoute
     * @param string $strService
     * @param array $arrPk
     * @param string $strMessageSuccess
     * @param array $arrRouteParam
     * @return myx
     */
    public function editAction($mixForm = null, $arrDataMerge = null, $strEntity = null, $strRoute = null, $strService = null, $arrPk = null, $strMessageSuccess = null, $arrRouteParam = array())
    {
        return $this->addEditAction('update', $mixForm, $arrDataMerge, $strEntity, $strRoute, $strService, $this->getAttributeValue($arrPk, 'arrPk'), $strMessageSuccess, $arrRouteParam);
    }

    /**
     * Metodo responsavel em remover a entidade do banco de dados recebendo como
     * parametro somente o array de PK.
     * 
     * @example $this->deleteAction(array('name_pk'));
     * 
     * @param array $arrPk
     * @param string $strMessageSuccess
     * @param string $strRoute
     * @param array $arrRouteParam
     * @param string $strService
     * @return mix
     */
    public function deleteAction($arrPk = null, $strMessageSuccess = null, $strRoute = null, $arrRouteParam = array(), $strService = null)
    {
        if ($this->getService($strService)->delete($this->getPkFromRoute($arrPk))) {
            $this->getServiceMessage()->addMessageSuccess((empty($strMessageSuccess)) ? self::CONST_MESSAGE_SUCCESS : $strMessageSuccess);
            return $this->redirect()->toRoute($this->getAttributeValue($strRoute, 'strRoute', 'inicial'), $arrRouteParam);
        }
    }

    /**
     * Metodo responsavel em realizar a chamada da service passando os dados a
     * serem persistidos realizando tratamentos como:
     *  - Realizacao do bind (objeto para o form);
     *  - Retirar as tags HTML;
     *  - Verificar se o ID ja existe na base em caso de update;
     * 
     * @example $this->addEditAction('insert | update', $this->getForm('\Path\To\Form'), array(data), '\Path\To\Entity', 'router', '\Path\To\Service', array('name_pk' => 'value'));
     * 
     * @param string $strMethod
     * @param mix $mixForm
     * @param array $arrDataMerge
     * @param string $strEntity
     * @param string $strRoute
     * @param string $strService
     * @param array $arrPk
     * @param string $strMessageSuccess
     * @param array $arrRouteParam
     * @return mix
     */
    protected function addEditAction($strMethod = null, $mixForm = null, $arrDataMerge = null, $strEntity = null, $strRoute = null, $strService = null, $arrPk = null, $strMessageSuccess = null, $arrRouteParam = array())
    {
        $form = $this->getFormEdited($mixForm, $strEntity);
        $entity = ((is_array($arrPk)) && (count($arrPk) > 0)) ? $this->getEntityToForm($arrPk, $strService, $strRoute, $arrRouteParam) : null;
        $arrDataStart = (is_object($entity)) ? ((!$this->existsFieldset($form)) ? $entity->toArray() : array(get_class($form->getBaseFieldset()) => $entity->toArray())) : array();
        return $this->controlAfterSubmit($form, (array) $this->getDataToForm($arrDataStart, $arrDataMerge, $this->getAttributeValue($arrPk, 'arrPk')), $strMethod, $strService, $strRoute, null, $strMessageSuccess, $arrRouteParam);
    }
    
    protected function getViewVariable(array $arrVariable = array())
    {
        return new View(array_merge((array) $this->arrVariableMerge, (array) $arrVariable));
    }
    
    protected function getViewForm($mixForm = null, $strMethodPrepare = null)
    {
        if (empty($mixForm))
            $mixForm = $this->getFormPreprared($strMethodPrepare);
        return $this->getViewVariable((is_object($mixForm)) ? array('form' => $mixForm) : array());
    }

    /**
     * Metodo responsavel em retornar a posicao da barra "\" ou "/" da controller,
     * podendo ser essa passada por referencia ou por parametro.
     * 
     * @example $ths->getBar($this->strController);
     * 
     * @param string $strController
     * @return string
     */
    private function getBar($strController = null)
    {
        return (strpos($this->getAttributeValue($strController, 'strController'), '/') !== false) ? '/' : '\\';
    }

    /**
     * Metodo responsavel em retornar o namespace das classes conforme o namespace
     * da classe controller. Caso nao seja passado a controller como parametro 
     * o valor a ser atribuido sera a classe da controller via referencia.
     * 
     * @example $this->getNamespaceClass('Service | Form | Entity', '\Path\To\Controller');
     * 
     * @param string $strClass
     * @param string $strController
     * @return string
     */
    private function getNamespaceClass($strClass, $strController = null)
    {
        $strBar = $this->getBar();
        return str_replace('Controller', '', str_replace($strBar . 'Controller' . $strBar, $strBar . $strClass . $strBar, $this->getAttributeValue($strController, 'strController')));
    }

    /**
     * Metodo responsavel em retorna a rota conforme a classe controller. 
     * Caso nao seja passado a controller o valor a ser atribuido sera a classe 
     * da controller via referencia.
     * 
     * @example $this->getRouteClass($this->strController);
     * 
     * @param string $strController
     * @return string
     */
    private function getRouteClass($strController = null)
    {
        return strtolower(str_replace('Controller', '', end($arrExplode = explode($this->getBar(), $this->getAttributeValue($strController, 'strController')))));
    }

}
