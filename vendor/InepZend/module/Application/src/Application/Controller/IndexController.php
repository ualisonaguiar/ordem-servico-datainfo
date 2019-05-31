<?php

namespace InepZend\Module\Application\Controller;

use InepZend\Controller\AbstractController;
use InepZend\View\View;
use InepZend\Dto\ResultDto;
use InepZend\Util\FileSystem;
use InepZend\Util\ApplicationInfo;
use Zend\Json\Encoder;
use Zend\Barcode\Barcode;

class IndexController extends AbstractController
{

    public function indexAction()
    {
        return new View();
    }

    public function inicialAction($strInitialText = null)
    {
        return new View(array('strInitialText' => $strInitialText));
    }

    /**
     * @auth no
     */
    public function showfileAction()
    {
        $strPathFile = $this->getParamsFromRoute('path');
        if (!empty($strPathFile))
            $strPathFile = base64_decode($strPathFile);
        $strForceDownload = $this->getParamsFromRoute('force_download');
        if (!empty($strForceDownload))
            $strForceDownload = base64_decode($strForceDownload);
        return $this->getViewClearContent(showFile($strPathFile, $strForceDownload));
    }

    /**
     * @auth no
     */
    public function barcodeAction()
    {
        $arrParam = $this->getParamsFromRoute('param');
        if (!empty($arrParam))
            $arrParam = unserialize(base64_decode($arrParam));
        $arrParam = (array) $arrParam;
        Barcode::render(@$arrParam[0], @$arrParam[1], (array) @$arrParam[2], (array) @$arrParam[3]);
        return $this->getViewClearContent();
    }

    /**
     * @auth no
     */
    public function inputfileAction()
    {
        $strPath = $this->getPost('path');
        if (empty($strPath))
            return $this->getViewClearContent('falha');
        $strPath = base64_decode($strPath);
        $strContent = $this->getPost('content');
        if (empty($strContent)) {
            $strContent = FileSystem::getContentFromFile($strPath);
            $strContentType = FileSystem::getMimeContentFromFile($strPath);
        } else {
            $arrContent = explode(';base64,', base64_decode($strContent));
            $strContent = base64_decode($arrContent[1]);
            $strContentType = str_ireplace(array('data:'), '', $arrContent[0]);
        }
        $strFileName = end($arrExplode = explode('\\', $strPath));
        FileSystem::downloadContent($strFileName, $strContent, $strContentType);
        return $this->getViewClearContent();
    }

    /**
     * @auth no
     */
    public function renderscriptAction()
    {
        return $this->getViewClearContent(renderScript($this->getParamsFromRoute('module'), $this->getParamsFromRoute('sub_module'), $this->getParamsFromRoute('type'), $this->getParamsFromRoute('filename')));
    }

    /**
     * @auth no
     */
    public function jsentityconstAction()
    {
        return $this->getScriptJsEntity('const');
    }

    /**
     * @auth no
     */
    public function jsentityattributeAction()
    {
        return $this->getScriptJsEntity('attribute');
    }

    protected function getScriptJsEntity($strType = null, $strModule = null, $strEntity = null)
    {
        if (empty($strModule))
            $strModule = $this->getParamsFromRoute('module');
        if (empty($strEntity))
            $strEntity = $this->getParamsFromRoute('entity');
        return $this->getScriptJsClass($strType, ((!empty($strModule)) && (!empty($strEntity))) ? $strModule . '\\Entity\\' . $strEntity : null);
    }

    /**
     * @auth no
     */
    public function jsmessageAction()
    {
        return $this->getScriptJsMessage();
    }

    protected function getScriptJsMessage($strModule = null)
    {
        if (empty($strModule))
            $strModule = $this->getParamsFromRoute('module');
        return $this->getScriptJsClass('attribute', (!empty($strModule)) ? $strModule . '\\Message\\Message' : null);
    }

    private function getScriptJsClass($strType = null, $strNamespace = null)
    {
        if ((!empty($strType)) && (in_array(strtolower($strType), array('const', 'attribute'))) && (!empty($strNamespace))) {
            if ((class_exists($strNamespace)) || (trait_exists($strNamespace))) {
                header('Content-Type: application/x-javascript');
                $strPrefix = null;
                $reflectionEntity = new \ReflectionClass($strNamespace);
                switch (strtolower($strType)) {
                    case 'const': {
                            $arrInfo = $reflectionEntity->getConstants();
//                            $strPrefix = 'const ';
                            $strPrefix = 'var ';
                            break;
                        }
                    case 'attribute': {
                            $arrInfo = $reflectionEntity->getDefaultProperties();
                            $strPrefix = 'var ';
                            break;
                        }
                }
                $strResult = '';
                foreach ($arrInfo as $strInfo => $strValue) {
                    if (in_array($strInfo, array('DEBUG')))
                        continue;
                    $strResult .= "\t" . $strPrefix . $strInfo . " = '" . $strValue . "';\n";
                }
                return $this->getViewClearContent($strResult);
            }
        }
        return $this->getViewClearContent();
    }

    /**
     * @auth no
     */
    public function messageAction()
    {
        $arrPost = $this->getPost();
        $arrMessage = (array_key_exists('message', $arrPost)) ? $arrPost['message'] : array();
        $strMethod = (array_key_exists('method', $arrPost)) ? $arrPost['method'] : null;
        if ((!empty($arrMessage)) && (!empty($strMethod)))
            $this->getServiceMessage()->$strMethod($arrMessage);
        return $this->getViewClearContent();
    }

    /**
     * @auth no
     */
    public function ajaxWebServiceAction()
    {
        $strResult = '';
        $arrPost = $this->getPost();
        $arrParam = (array_key_exists('param', $arrPost)) ? $arrPost['param'] : array();
        $strClass = (array_key_exists('class', $arrPost)) ? $arrPost['class'] : null;
        $strMethod = (array_key_exists('method', $arrPost)) ? $arrPost['method'] : null;
        if ((!empty($arrParam)) && (!empty($strClass)) && (!empty($strMethod))) {
            $wsClient = ($this->getServiceLocator()->has($strClass)) ? $this->getService($strClass) : new $strClass();
            if (is_object($wsClient)) {
                $arrArgument = array();
                foreach ((array) $arrParam as $intKey => $strParam)
                    $arrArgument[] = '$arrParam[' . $intKey . ']';
                eval('$mixResult = $wsClient->' . $strMethod . '(' . implode(', ', $arrArgument) . ');');
                $intCoLogradouro = @$mixResult['RESPOSTA']['NODELIST']['co_logradouro'];
                if ((!empty($intCoLogradouro)) && (is_array($mixResult)))
                    array_walk_recursive($mixResult, '\InepZend\Util\ArrayCollection::arrayWalkRecursiveUtf8Encode');
                $strResult = Encoder::encode($mixResult);
            }
        }
        return $this->getViewClearContent($strResult);
    }

    /**
     * @auth no
     */
    public function ajaxUploadFileAction()
    {
        $arrContent = array(
            'status' => ResultDto::STATUS_OK,
            'messages' => null,
            'file' => null,
        );
        $arrParam = $this->getParamsFromRoute('param');
        if (!empty($arrParam))
            $arrParam = (array) json_decode(base64_decode($arrParam));
        if (($this->isPost()) && (array_key_exists('coord_image_crop', $this->getPost())))
            $arrParam['coord_image_crop'] = $this->getPost('coord_image_crop');
        $arrParam['required'] = true;
        $mixResult = $this->getService('InepZend\Module\Application\Service\Application')->uploadFile($arrParam);
        if (is_array($mixResult)) {
            $arrContent['status'] = $mixResult[0];
            $arrContent['messages'] = implode('<br />', $mixResult[1]);
        } else
            $arrContent['file'] = $mixResult;
        return $this->getViewClearContent(json_encode($arrContent));
    }

    /**
     * @auth no
     */
    public function ajaxUploadFileCropAction()
    {
        $arrContent = array(
            'status' => ResultDto::STATUS_ERROR,
            'messages' => null,
            'file' => null,
        );
        if ($this->isPost()) {
            $mixResult = $this->getService('InepZend\Module\Application\Service\Application')->cropImageFile($this->getPost());
            if (is_array($mixResult)) {
                $arrContent['status'] = $mixResult[0];
                $arrContent['messages'] = implode('<br />', $mixResult[1]);
            } else {
                $arrContent['file'] = getShowFileUrl($mixResult) . '&' . microtime();
                $arrContent['status'] = ResultDto::STATUS_OK;
            }
        }
        return $this->getViewClearContent(json_encode($arrContent));
    }

    /**
     * @auth no
     */
    public function ajaxRemoveFileAction()
    {
        return $this->getViewClearContent(($this->getService('InepZend\Module\Application\Service\Application')->removeFile($this->getPost('file'))) ? ResultDto::STATUS_OK : ResultDto::STATUS_FAIL);
    }

    /**
     * @auth no
     */
    public function appInfoAction()
    {
        $arrRevision = ApplicationInfo::getRevision();
        $arrContent = array(
            'version' => $arrRevision['VERSION'],
            'server' => $arrRevision['SERVER_INSTANCE'],
        );
        return $this->getViewClearContent(json_encode($arrContent));
    }

}
