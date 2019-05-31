<?php

namespace InepZend\Module\WebService\Server\Rest\Controller;

use InepZend\Controller\AbstractRestfulController;
use InepZend\Module\WebService\Server\Rest\Service\RestServer;
use InepZend\Util\Reflection;
use InepZend\Util\ArrayCollection;
use Zend\Json\Encoder;
use InepZend\Exception\RuntimeException;

class RestController extends AbstractRestfulController
{

    /**
     * @auth no
     */
    public function indexAction()
    {
        $restServer = $this->getService('InepZend\Module\WebService\Server\Rest\Service\RestServer');
        $mixResult = $restServer->checkMethodOptions();
        if (is_array($mixResult))
            exit(Encoder::encode($mixResult));
        $strSecretKey = $this->getSecretKey();
        $arrClassService = $this->getClassService();
        $strClass = $arrClassService[RestServer::REQUEST_KEY_CLASS];
        $strService = $arrClassService[RestServer::REQUEST_KEY_SERVICE];
        $service = $this->getService($strClass);
        $arrAnnotation = Reflection::listAnnotationsFromMethod($service, $strService);
        $arrPost = $this->getPost();
        if ((!empty($arrPost)) && (!is_object($this->getIdentity())))
            $restServer->checkAuthentication($arrAnnotation, $strService, $strClass);
        $restServer->checkAnnotationRest($arrAnnotation, $strService, $strClass);
        $restServer->checkSecurityIp($strService, $strClass);
        $restServer->checkAnnotationResource($arrAnnotation, $strService, $strClass, $this->getResource());
        $strResultType = $restServer->getResultType($arrAnnotation);
        $arrResult = $restServer->callService($service, $strService, $this->getParams());
        if ((array_key_exists('result', $arrResult)) && (is_object($arrResult['result'])) && (method_exists($arrResult['result'], 'toArray')))
            $arrResult['result'] = $arrResult['result']->toArray();
        return $this->getViewClearContent(($strResultType == RestServer::RESPONSE_TYPE_JSON) ? str_replace("%0D%0A", '', json_encode(ArrayCollection::objectToArrayRecursive($arrResult, null, 6), JSON_UNESCAPED_UNICODE)) : ArrayCollection::convertArrayToXml($arrResult));
    }

    private function getSecretKey()
    {
        $strSecretKey = $this->getPostOauth(RestServer::REQUEST_KEY_SECRET_KEY, true);
        if (empty($strSecretKey))
            throw new RuntimeException('É necessário informar a chave de segurança.');
        elseif (!$this->getService('InepZend\Module\WebService\Server\Rest\Service\RestServer')->checkSecretKey($strSecretKey))
            throw new RuntimeException('A chave de segurança se encontra expirada.');
        return $strSecretKey;
    }

    private function getClassService()
    {
        $strClass = $this->getPostOauth(RestServer::REQUEST_KEY_CLASS, true);
        $strService = $this->getPostOauth(RestServer::REQUEST_KEY_SERVICE, true);
        $booEmptyClass = empty($strClass);
        $booEmptyService = empty($strService);
        if ((!$booEmptyClass) && (!$booEmptyService)) {
            if (!class_exists($strClass))
                throw new RuntimeException('A classe ' . $strClass . ' não existe na aplicação.');
            else {
                $service = $this->getService($strClass);
                if (!is_object($service))
                    throw new RuntimeException('A classe ' . $strClass . ' não é um serviço.');
                elseif (!method_exists($service, $strService))
                    throw new RuntimeException('O serviço ' . $strService . ' não existe na classe ' . $strClass);
            }
        } else {
            $arrParamRequired = array();
            if ($booEmptyClass)
                $arrParamRequired[] = RestServer::REQUEST_KEY_CLASS;
            if ($booEmptyService)
                $arrParamRequired[] = RestServer::REQUEST_KEY_SERVICE;
            throw new RuntimeException('É necessário parametrizar a(s) seguinte(s) informação(ões): ' . implode(', ', $arrParamRequired));
        }
        return array(RestServer::REQUEST_KEY_CLASS => $strClass, RestServer::REQUEST_KEY_SERVICE => $strService);
    }

    private function getParams()
    {
        return $this->getPostOauth(RestServer::REQUEST_KEY_PARAMS, true);
    }

    private function getResource()
    {
        return $this->getPostOauth(RestServer::REQUEST_KEY_RESOURCE, true);
    }

}
