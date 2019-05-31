<?php

namespace InepZend\Controller;

use InepZend\Exception\RuntimeException;
use InepZend\Service\AbstractServiceManager;
use \Exception as ExceptionNative;

trait ControllerServiceManagerTrait
{

    private static $arrService = array();

    /**
     * Metodo responsavel em retornar o servico a ser utilizado.
     * Caso o caminho do servico esteja mapeado em um atributo, 
     * dentro do escopo do controlador, o mesmo eh pego via referencia atraves 
     * do metodo getAttributeValue(). O atributo tem que ser definido com a
     * nomenclatura 'strService'.
     * 
     * @example $this->getService('Path\To\Service');
     * 
     * @param string $strService
     * @param boolean $booTrace
     * @return mix
     */
    protected function getService($strService = null, $booTrace = false)
    {
        $this->getAttributeValue($strService, 'strService');
        if (empty($strService)) {
            $strService = str_replace(array('\Controller\\', 'Controller'), array('\Service\\', ''), get_class($this));
            if (!class_exists($strService))
                return false;
        }
        if ($booTrace)
            $this->traceMessage(array('get_service' => $strService));
        if (array_key_exists($strService, self::$arrService))
            return self::$arrService[$strService];
        if (!is_object($this->getServiceLocator()))
            $this->setServiceLocator(AbstractServiceManager::getServiceManager());
        if ((is_object($this->getServiceLocator())) && ($this->getServiceLocator()->has($strService))) {
            try {
                $service = $this->getServiceLocator()->get($strService);
            } catch (ExceptionNative $exception) {
                throw RuntimeException::cloneException($exception);
            }
            self::$arrService[$strService] = $service;
            return $service;
        }
        return (class_exists($strService)) ? new $strService() : false;
    }

    /**
     * Metodo responsavel em retornar o servico Message.
     * 
     * @example $this->getServiceMessage();
     * 
     * @return object
     */
    protected function getServiceMessage()
    {
        return $this->getService('InepZend\Message\Message');
    }

    /**
     * Metodo responsavel em retornar o servico do formulario a ser utilizado
     * no escopo da controller.
     * Caso tenha definido o atributo $strForm, dentro do escopo do controlador, 
     * nao eh necessario passar a string do caminho do Form, pois sera pego via 
     * referencia pelo metodo getAttributeValue().
     * 
     * @example $this->getForm('\Path\To\Form');
     * 
     * @param string
     * @return mix
     */
    protected function getForm($strForm = null)
    {
        $strForm = $this->getAttributeValue($strForm, 'strForm');
        if (empty($strForm))
            $strForm = str_replace(array('\Controller', '\Service', 'Controller', 'Service'), array('\Form', '\Form', '', ''), get_class($this));
        return $this->getService($this->getAttributeValue($strForm, 'strForm'));
    }

    protected function getPostOauth($strName = null, $booUseRequest = false)
    {
        static $arrPost;
        if (empty($arrPost)) {
            try {
                $ssiService = $this->getService('InepZend\Module\Oauth\Service\SsiService');
                $arrPost = $ssiService->getLastPostFromSession();
            } catch (ExceptionNative $exception) {
                $arrPost = array();
            }
            if (($this->isPost()) || (!empty($arrPost))) {
                if ($this->isPost()) {
                    $arrPost = $this->getPost();
                    if (($booUseRequest === true) && (empty($arrPost)))
                        $arrPost = $_REQUEST;
                }
                $arrPost = $this->prepareRequest(true, $arrPost);
            }
        }
        return ((!empty($strName)) && (is_array($arrPost))) ? @$arrPost[$strName] : $arrPost;
    }

}
