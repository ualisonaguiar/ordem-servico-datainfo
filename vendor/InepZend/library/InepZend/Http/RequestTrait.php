<?php

namespace InepZend\Http;

use InepZend\Parameter\Parameter;
use InepZend\Util\AttributeStaticInstance;
use InepZend\WebService\Client\Rest;
use InepZend\Util\Curl;
use InepZend\ModuleConfig\ModuleInit;
use InepZend\Controller\AbstractControllerCore;
use Zend\Mvc\Controller\Plugin\Params;

/**
 * Trait responsavel por tratar as requisicoes HTTP.
 * A mesma eh chamada na classe \InepZend\Util\Request().
 *
 * @package InepZend
 * @subpackage Http
 */
trait RequestTrait
{

    private static $eventOriginal;
    private static $params;

    /**
     * Metodo responsavel em retornar os dados recebidos via $_POST.
     *
     * @example $request = new \InepZend\Util\Request(); <br /> $request->getPost();
     * 
     * @param string $strName
     * @param mix $mixValueDefault
     * @param boolean $booArray
     * @param boolean $booPrepareRequest
     * @param boolean $booTemplateFormat
     * @return mix
     */
    public function getPost($strName = null, $mixValueDefault = null, $booArray = null, $booPrepareRequest = null, $booTemplateFormat = null)
    {
        if (!is_bool($booArray))
            $booArray = true;
        if (!is_bool($booPrepareRequest))
            $booPrepareRequest = false;
        if (!is_bool($booTemplateFormat))
            $booTemplateFormat = false;
        if (($booPrepareRequest) && (method_exists($this, 'prepareRequest')))
            $this->prepareRequest($booTemplateFormat);
        $post = $this->getSingleRequest()->getPost($strName, $mixValueDefault);
        return (($booArray) && (is_object($post))) ? $post->toArray() : $post;
    }

    /**
     * Metodo responsavel em recuperar os dados passados pela query string.
     *
     * @example $this->getParamsFromQuery($strName, $mixValueDefault);
     * 
     * @param string $strName
     * @param mix $mixValueDefault
     * @return mix
     */
    public function getParamsFromQuery($strName = null, $mixValueDefault = null)
    {
        return (is_object($this->getParamsInstance())) ? $this->getParamsInstance()->fromQuery($strName, $mixValueDefault) : false;
    }

    /**
     * Metodo responsavel em recuperar os dados passados pela rota.
     *
     * @example $this->getParamsFromRoute($strName, $mixValueDefault);
     * 
     * @param string $strName
     * @param mix $mixValueDefault
     * @return mix
     */
    public function getParamsFromRoute($strName = null, $mixValueDefault = null)
    {
        return (is_object($this->getParamsInstance())) ? $this->getParamsInstance()->fromRoute($strName, $mixValueDefault) : false;
    }

    /**
     * Metodo responsavel em recupear os arquivos passados via $_POST.
     *
     * @example $this->getFiles($strName, $mixValueDefault, $booArray);
     * 
     * @param string $strName
     * @param mix $mixValueDefault
     * @param boolean $booArray
     * @return mix
     */
    public function getFiles($strName = null, $mixValueDefault = null, $booArray = null)
    {
        if (!is_bool($booArray))
            $booArray = true;
        $files = $this->getSingleRequest()->getFiles($strName, $mixValueDefault);
        return ($booArray) ? $files->toArray() : $files;
    }

    /**
     * Metodo responsavel em verificar os dados contidos no $_HEADER.
     *
     * @example $this->getHeader($strName, $mixValueDefault);
     * 
     * @param string $strName
     * @param mix $mixValueDefault
     * @return mix
     */
    public function getHeader($strName = null, $mixValueDefault = false)
    {
        return $this->getSingleRequest()->getHeader($strName, $mixValueDefault);
    }

    /**
     * Metodo responsavel em recuperar os dados do COOKIE.
     *
     * @example $this->getCookie();
     * 
     * @return object
     */
    public function getCookie()
    {
        return $this->getSingleRequest()->getCookie();
    }

    /**
     * Metodo responsavel em verificar se a passagem de parametro he via $_POST.
     *
     * @example $this->isPost();
     * 
     * @return boolean
     */
    public function isPost()
    {
        return $this->getSingleRequest()->isPost();
    }

    /**
     * Metodo responsavel em verificar se a passagem de parametro he via $_GET.
     *
     * @example $this->isGet();
     * 
     * @return boolean
     */
    public function isGet()
    {
        return $this->getSingleRequest()->isGet();
    }

    /**
     * Metodo responsavel em verificar se os dados sao $_HEADER.
     *
     * @example $this->isHead();
     * 
     * @return boolean
     */
    public function isHead()
    {
        return $this->getSingleRequest()->isHead();
    }

    /**
     * Metodo responsavel em recuperar os dados do Content.
     *
     * @example $this->getRequestContent();
     * 
     * @return object
     */
    public function getRequestContent()
    {
        return $this->getSingleRequest()->getContent();
    }

    /**
     * Metodo responsavel em recuperar o URI da aplicacao.
     *
     * @example $this->getRequestUri();
     * 
     * @return string
     */
    public function getRequestUri()
    {
        return $this->getSingleRequest()->getRequestUri();
    }

    /**
     * Metodo responsavel em recuperar a URL base da aplicacao.
     *
     * @example $this->getBaseUrl();
     * 
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->getSingleRequest()->getBaseUrl();
    }

    /**
     * Metodo responsavel em recuperar o caminho (path) base da aplicacao.
     *
     * @example $this->getBasePath();
     * 
     * @return string
     */
    public function getBasePath()
    {
        return $this->getSingleRequest()->getBasePath();
    }

    /**
     * Metodo responsavel em recuperar o metodo da requisicao.
     *
     * @example $this->getMethod();
     * 
     * @return string
     */
    public function getMethod()
    {
        return $this->getSingleRequest()->getMethod();
    }

    /**
     * Metodo responsavel em setar o metodo para a requisicao.
     *
     * @example $this->setMethod($strMethod);
     * 
     * @param string $strMethod
     * @return string
     */
    public function setMethod($strMethod)
    {
        return $this->getSingleRequest()->setMethod($strMethod);
    }

    /**
     * Metodo responsavel em recuperar a rota.
     *
     * @example $this->getRoute($booFromEvent);
     * 
     * @param boolean $booFromEvent
     * @return string
     */
    public function getRoute($booFromEvent = true)
    {
        $strRoute = (($booFromEvent === true) && (array_key_exists('route', $GLOBALS))) ? $GLOBALS['route'] : null;
        if (is_null($strRoute)) {
            $strUri = str_replace($this->getBaseUrl(), '', $this->getRequestUri());
            if (!empty($strUri)) {
                if ($strUri{0} == '/')
                    $strUri = substr($strUri, 1);
                $strRoute = reset($arrExplode = explode('/', $strUri));
            }
        }
        return $strRoute;
    }

    /**
     * Metodo responsavel em setar o evento.
     *
     * @example $this->setMethod($strMethod);
     * 
     * @param object $eventOriginal
     * @return boolean
     */
    public static function setEventOriginal($eventOriginal)
    {
        return (self::$eventOriginal = $eventOriginal);
    }

    /**
     * Metodo responsavel em retornar requisicoes.
     *
     * @example $this->getSingleRequest($strRequestClass);
     * 
     * @param string $strRequestClass
     * @return mix
     */
    protected function getSingleRequest($strRequestClass = null)
    {
        if (method_exists($this, 'getRequest'))
            return $this->getRequest();
        return AttributeStaticInstance::getAttributeStaticInstance((empty($strRequestClass)) ? 'Zend\Http\PhpEnvironment\Request' : $strRequestClass);
    }

    /**
     * Metodo responsavel em atribuir dados ao $_POST.
     *
     * @example $this->setPost($arrData);
     * 
     * @param array $arrData
     * @return mix
     */
    protected function setPost($arrData = null)
    {
        if (is_null($arrData))
            $arrData = array();
        elseif (!is_array($arrData))
            $arrData = array($arrData);
        return $this->getSingleRequest()->setPost(new Parameter((array) $arrData));
    }

    /**
     * Metodo responsavel em atribuir arquivos ao $_FILE.
     *
     * @example $this->setFiles($arrFile);
     * 
     * @param array $arrFile
     * @return mix
     */
    protected function setFiles($arrFile = null)
    {
        if (!is_array($arrFile))
            return false;
        return $this->getSingleRequest()->setFiles(new Parameter($arrFile));
    }

    /**
     * Metodo responsavel em enviar solicitacao/requisicao a servicos Rest.
     *
     * @example $this->forwardRequest($strRedirectUrl, $intTimeout);
     * 
     * @param string $strRedirectUrl
     * @param integer $intTimeout
     * @return mix
     */
    protected function forwardRequest($strRedirectUrl = null, $intTimeout = null)
    {
        $rest = new Rest();
        $arrHeader = $this->getHeader()->toArray();
        unset($arrHeader['Connection'], $arrHeader['Server'], $arrHeader['Transfer-Encoding'], $arrHeader['Content-Length']);
        $arrCookie = (array) $this->getCookie();
        unset($arrCookie['PHPSESSID'], $arrCookie['ZDEDebuggerPresent'], $arrCookie['nova_visita_mes'], $arrCookie['nova_visita_ano']);
        return $rest->runService('InepZend\WebService\Client\Rest', null, $this->getPost(), (empty($strRedirectUrl)) ? $this->getParamsFromQuery('RedirectURL') : $strRedirectUrl, $arrHeader, $this->getMethod(), null, null, array_merge(Curl::getOptionToHttpClient(), array('timeout' => (is_null($intTimeout)) ? 5 * 60 : $intTimeout)), $arrCookie, true);
    }

    /**
     * Metodo responsavel em retorna  o Event.
     *
     * @example $this->getEventOriginal();
     * 
     * @return object
     */
    private static function getEventOriginal()
    {
        return self::$eventOriginal;
    }

    /**
     * Metodo responsavel em retorna os parametros contidos na requisicao.
     *
     * @example $this->getParamsInstance();
     * 
     * @return object
     */
    private function getParamsInstance()
    {
        if ($this instanceof AbstractControllerCore)
            $params = $this->params();
        elseif (!is_object($params = self::$params)) {
            if (is_null($eventOriginal = self::getEventOriginal()))
                return;
            eval('$controller = new \\' . ModuleInit::getController($eventOriginal) . '();');
            $controller->setEvent($eventOriginal);
            $params = new Params();
            $params->setController($controller);
            self::$params = $params;
        }
        return $params;
    }

}
