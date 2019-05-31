<?php

namespace InepZend\Controller;

use InepZend\View\View;
use InepZend\Util\Format;
use \Exception as ExceptionNative;

/**
 * Classe abstrata responsavel pelos metodos relacionados a formularios e dados
 * oriundos de formularios.
 * 
 * [-] AbstractControllerCore
 *      [-] AbstractControllerServiceManager
 *          [+] AbstractControllerForm
 *              [-] AbstractControllerRepository
 *                  [-] AbstractController
 *                      [-] AbstractControllerPaginator
 *                          [-] AbstractCrudController
 *                              [-] AbstractControllerAngular
 * [-] AbstractRestfulController
 *
 * @package InepZend
 * @subpackage Controller
 */
abstract class AbstractControllerForm extends AbstractControllerServiceManager
{

    /**
     * Metodo responsavel em inserir os dados em um objeto Form, realizando um
     * merge dos arrays via $_POST e $_FILE, caso existam.
     * 
     * @example $this->getDataToForm($this->getForm('\Path\To\Form'), array(data));
     * 
     * @param aray $arrDataStart
     * @param array $arrDataMerge
     * @param array $arrPk
     * @return mix
     */
    protected function getDataToForm($arrDataStart = null, $arrDataMerge = null, $arrPk = null)
    {
        $arrData = (is_array($arrDataStart)) ? $arrDataStart : array();
        if (is_array($arrDataMerge))
            $arrData = array_merge($arrData, $arrDataMerge);
        if ($this->isPost()) {
            $this->prepareRequest();
            $arrData = array_merge($arrData, $this->getPost(), $this->getFiles());
        }
        foreach ($arrData as $strAttribute => $mixValue) {
            if (is_array($mixValue)) {
                foreach ($mixValue as $strAttributeIntern => $mixValueIntern) {
                    $arrData[$strAttribute . '[' . $strAttributeIntern . ']'] = $mixValueIntern;
                }
            } elseif ((is_array($arrPk)) && (in_array($strAttribute, $arrPk)) && (is_numeric($mixValue))) {
                $arrData[$strAttribute] = (integer) $mixValue;
            }
        }
        return $arrData;
    }

    /**
     * Metodo responsavel em realizar a chamada da service passando os dados do
     * form juntamente com os dados a serem persistidos.
     * O metodo realiza:
     *  - Verifica se os dados vem via post;
     *  - Passa os valores para o seu respectivo form, bind;
     *  - Valida se os campos obrigatorio foram preenchidos e se sao validos, isValid;
     *  - Pode realizar um redirecionamento de rota ou retornar uma View para
     *    terem os dados manipulados pelo usuario.
     * 
     * @example $this->controlAfterSubmit($this->getForm('path\to\form'), array(data), 'insert | update', '\Path\To\Service', 'router')
     * 
     * @param object $form
     * @param array $arrData
     * @param string $strMethod
     * @param string $strService
     * @param mix $mixRoute
     * @param array $arrViewParam
     * @param string $strMessageSuccess
     * @param array $arrRouteParam
     * @return object
     */
    protected function controlAfterSubmit($form = null, array $arrData = array(), $strMethod = null, $strService = null, $mixRoute = null, $arrViewParam = null, $strMessageSuccess = null, $arrRouteParam = array())
    {
        if (!is_object($form))
            return;
        if (count($arrData) != 0)
            $form->setData($arrData);
        if ($this->isPost()) {
            if ($form->isValid()) {
                try {
//                    $this->getService($strService)->$strMethod((!$booFieldset) ? $this->getPost() : reset($this->getPost()));
                    $arrDataForm = (property_exists($this, 'arrPk')) ? $form->getDataEdited($this->arrPk) : $form->getData();
                    $mixResult = $this->getService($strService)->$strMethod($arrDataForm);
                    $booSuccess = true;
                    if ((is_array($mixResult)) && (array_key_exists('status', $mixResult)) && (strtolower($mixResult['status']) != 'ok')) {
                        $booSuccess = false;
                        $this->getServiceMessage()->addMessageError((empty($mixResult['messages'])) ? self::MESSAGE_ERROR : $mixResult['messages']);
                    }
                    if ($booSuccess) {
                        $this->getServiceMessage()->addMessageSuccess((empty($strMessageSuccess)) ? self::MESSAGE_SUCCESS : $strMessageSuccess);
                        if (!is_bool($mixRoute))
                            return $this->redirect()->toRoute($this->getAttributeValue($mixRoute, 'strRoute', 'inicial'), $arrRouteParam);
                    }
                } catch (ExceptionNative $exception) {
//                    $this->getServiceMessage()->addMessageError($exception->getMessage());
                    throw $exception;
                }
            } else
                $this->getServiceMessage()->addMessageValidate(self::MESSAGE_VALIDATE, $form);
            if (count($arrData) != 0) {
                $arrData = $this->prepareRequest(true, $arrData);
                foreach ($arrData as $strAttribute => &$mixValue) {
                    if ((is_array($mixValue)) && (Format::isJson(@$mixValue[0]))) {
                        foreach ($mixValue as &$strJson)
                            $strJson = json_decode($strJson);
                    }
                }
                $form->setData($arrData);
            }
        }
        $arrViewParam = (array) $arrViewParam;
        if (property_exists($this, 'arrVariableMerge'))
            $arrViewParam = array_merge($this->arrVariableMerge, $arrViewParam);
        return new View(array_merge($arrViewParam, array('form' => $form)));
    }

    /**
     * Metodo responsavel em retornar o formulario com os dados passados.
     * Caso nao seja passado o form o mesmo eh recuperado conforme mapeado no 
     * atributo definido na controller $this->strForm.
     * 
     * @example $this->getFormEdited($form, '\Path\To\Entity');
     * 
     * @param mix $mixForm
     * @param string $strEntity
     * @return mix
     */
    protected function getFormEdited($mixForm = null, $strEntity = null)
    {
        $form = (is_object($mixForm)) ? $mixForm : $this->getForm($mixForm);
        $booFieldset = $this->existsFieldset($form);
        if ($booFieldset) {
            $this->getAttributeValue($strEntity, 'strEntity');
            $form->bind(new $strEntity(array()));
        }
        return $form;
    }

    /**
     * Metodo responsavel em retornar os dados referente ao form que esteja sendo
     * persistidos caso exista na base de dados.
     * 
     * @example $this->getEntityToForm(array('name_pk' => 'value'), '\Path\To\Service', 'router');
     * 
     * @param array $arrPk
     * @param string $strService
     * @param string $strRoute
     * @param array $arrRouteParam
     * @return mix
     */
    protected function getEntityToForm($arrPk = null, $strService = null, $strRoute = null, $arrRouteParam = array())
    {
        $mixPk = $this->getPkFromRoute($arrPk);
        if (is_numeric($mixPk))
            $mixPk = (integer) $mixPk;
        $entity = $this->getService($strService)->find($mixPk);
        if (!is_object($entity)) {
            $this->getServiceMessage()->addMessageError(self::MESSAGE_ERROR);
            return $this->redirect()->toRoute($this->getAttributeValue($strRoute, 'strRoute', 'inicial'), $arrRouteParam);
        }
        return $entity;
    }

    /**
     * Metodo responsavel em verificar se ha fildset no formulario que esta sendo
     * passado para ser persistido.
     * 
     * @example $this->existsFieldset($form);
     * 
     * @param mix $mixForm
     * @return boolean
     */
    protected function existsFieldset($mixForm = null)
    {
        $form = (is_object($mixForm)) ? $mixForm : $this->getForm($mixForm);
        if (!is_object($form))
            return false;
        return (!((is_null($form->getBaseFieldset())) || (stripos($form->getBaseFieldset()->getName(), 'fieldset') === false)));
    }
    
    protected function getFormPreprared($strMethodPrepare = null)
    {
        try {
            if (empty($strMethodPrepare))
                $strMethodPrepare = 'prepareElements';
            return $this->getForm()->$strMethodPrepare();
        } catch (ExceptionNative $exception) {
            $this->getServiceMessage()->addMessageError($exception->getMessage());
            return $this->redirect()->toRoute((@$GLOBALS['authServiceAdapter']['callback']['route']) ? $GLOBALS['authServiceAdapter']['callback']['route'] : 'inicial');
        }
    }

}
