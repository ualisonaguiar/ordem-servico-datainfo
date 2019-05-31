<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\View\Helper\AbstractHtmlHeadHelper;
use InepZend\Util\Uri;
use InepZend\Util\FileSystem;
use InepZend\Util\Date;
use InepZend\Util\Server;

class BarraBrasilHelper extends AbstractHelper
{

    const USE_EXTERN = false;
    const USE_SHOW_FILE = true;
    const FORCE_CREATE_FILE = false;
    const JAVASCRIPT_URL_EXTERN = 'http://barra.brasil.gov.br/barra.js';
    const JAVASCRIPT_PATH = 'data/tmp/barra-brasil/js/barra.js';
    const JAVASCRIPT_URL_INTERN = '/vendor/barra-brasil/barra-brasil-2.1.19/barra.js';

    private static $booShowFile;

    public function getHtml($booJavascript = false)
    {
        $strResult = '<div id="barra-brasil"></div>';
        if (self::USE_EXTERN) {
            $booShowFile = $this->managerShowFile();
            if ($booJavascript !== true) {
                if ($booShowFile)
                    $strResult .= $this->getJavascriptResult($this->getBaseUrl() . getShowFileUrl(self::JAVASCRIPT_PATH));
            } else {
                if (!$booShowFile)
                    $strResult .= $this->getJavascriptResult();
            }
        } elseif ($booJavascript !== true) {
            $strResult .= $this->getJavascriptResult(Server::getHost(true) . self::JAVASCRIPT_URL_INTERN . AbstractHtmlHeadHelper::getSufixJsGzip());
            self::setShowFile(true);
        }
        return $strResult;
    }

    public function getShowFile()
    {
        return self::$booShowFile;
    }

    private function getJavascriptResult($strSource = null, $booEditBarraBrasilToInep = true)
    {
        if (empty($strSource))
            $strSource = self::JAVASCRIPT_URL_EXTERN;
        if (!is_bool($booEditBarraBrasilToInep))
            $booEditBarraBrasilToInep = true;
//        $strResult = (AbstractHtmlHeadHelper::hasGulp() === true) ? '' : '<script src="' . (string) $strSource . '" type="text/javascript"></script>';
        $strResult = '<script src="' . (string) self::JAVASCRIPT_URL_EXTERN . '" type="text/javascript"></script>';
        if ($booEditBarraBrasilToInep) {
            $strResult .= '<script language="javascript">
                    function editBarraBrasilToInep() {
                        var divBarraBrasil = getObject("barra-brasil");
                    	if (!isObject(divBarraBrasil)) {
                    		setTimeout(editBarraBrasilToInep, 20);
                    		return false;
                    	}
                        divBarraBrasil.className = "navbar navbar-inverse navbar-fixed-top";
                        divBarraBrasil.style.cssText = divBarraBrasil.style.cssText + "z-index: 1031; height: 32px; min-height: 32px; background: #f1f1f1 none repeat scroll 0 0;";
                        if ((getBrowser().toLowerCase().indexOf("firefox") != -1) || (getBrowser().toLowerCase().indexOf("windows") != -1))
                            setTimeout(clearBeforeUnload, 1000);
                        return;
                    };
                    editBarraBrasilToInep();
                </script>';
        }
        return $strResult;
    }

    private function managerShowFile()
    {
        $booShowFile = (self::USE_SHOW_FILE === false) ? false : $this->getShowFile();
        if (!is_bool($booShowFile)) {
            $strPathFull = Server::getReplacedBasePathApplication('/../../../../../../' . self::JAVASCRIPT_PATH);
            if (self::FORCE_CREATE_FILE === true)
                $booCreateFile = true;
            else {
                $mixModificationTime = FileSystem::getModificationTime($strPathFull);
                $booCreateFile = (is_bool($mixModificationTime));
                if (!$booCreateFile)
                    $booCreateFile = (Date::convertDate($mixModificationTime, 'dmY') != date('dmY'));
            }
            if ($booCreateFile) {
                $strJavascript = $this->getJavascriptFromUrl();
                $booShowFile = (!empty($strJavascript)) ? FileSystem::insertContentIntoFile($strPathFull, $strJavascript, 'w+') : false;
            } else
                $booShowFile = FileSystem::isReadable($strPathFull);
            if (($booShowFile) && ((!($booIsFile = is_file($strPathFull))) || (filesize($strPathFull) == 0) || (strpos(FileSystem::getContentFromFile($strPathFull), 'PROXY_AUTH_REQUIRED') !== false))) {
                $booShowFile = false;
                if ($booIsFile)
                    unlink($strPathFull);
            }
            self::setShowFile($booShowFile);
        }
        return $booShowFile;
    }

    private function getJavascriptFromUrl()
    {
        $strJavascript = trim(Uri::getBinaryContent(self::JAVASCRIPT_URL_EXTERN));
        while (($intPosJs = strripos($strJavascript, '.js')) !== false) {
            $strJavascriptPart = substr($strJavascript, 0, $intPosJs + 3);
            $arrPos = array(
                strripos($strJavascriptPart, 'http://'),
                strripos($strJavascriptPart, 'https://'),
                strripos($strJavascriptPart, '//coletajavascript'),
            );
            $intPosJsStart = null;
            foreach ($arrPos as $intPos) {
                if (($intPos === false) || ($intPos > $intPosJs))
                    continue;
                if ($intPos > (integer) $intPosJsStart)
                    $intPosJsStart = $intPos;
            }
            if (!is_null($intPosJsStart)) {
                $strJavascriptFile = substr($strJavascriptPart, $intPosJsStart);
                $strJavascriptPart2 = substr($strJavascriptPart, 0, strpos($strJavascriptPart, $strJavascriptFile));
                if (($intPosNodeValue = strripos($strJavascriptPart2, '.nodeValue')) !== false) {
                    $strJavascriptPart3 = substr($strJavascriptPart2, 0, $intPosNodeValue);
                    $mixPosStartPlus = $this->getPosStartPlus($strJavascriptPart3);
                    if (is_array($mixPosStartPlus)) {
                        $strJavascriptPart4 = substr($strJavascriptPart3, $mixPosStartPlus[0] + $mixPosStartPlus[1]);
                        $strSetAttributeNode = '.setAttributeNode(' . $strJavascriptPart4 . ')';
                        if (($intPosSetAttributeNode = stripos($strJavascript, $strSetAttributeNode)) !== false) {
                            $strJavascriptPart5 = substr($strJavascript, 0, $intPosSetAttributeNode + strlen($strSetAttributeNode));
                            $mixPosStartPlus = $this->getPosStartPlus($strJavascriptPart5);
                            if (is_array($mixPosStartPlus)) {
                                $strJavascriptPart6 = substr($strJavascriptPart5, $mixPosStartPlus[0] + $mixPosStartPlus[1]);
                                $strJavascript = str_replace($strJavascriptFile, '', str_replace($strJavascriptPart6, $strJavascriptPart6 . ',' . str_replace('setAttributeNode', 'removeAttributeNode', $strJavascriptPart6), $strJavascript));
                            }
                        }
                    }
                }
            }
        }
        if (!empty($strJavascript))
            $strJavascript = 'try { ' . $strJavascript . ' } catch (exception) {}';
        return $strJavascript;
    }

    private function getPosStartPlus($strJavascript)
    {
        $intPosVirgula = false;
        $intPosPontoVirgula = false;
        $intPosEspaco = false;
        $intPosLinha = false;
        if ((($intPosVirgula = strrpos($strJavascript, ',')) !== false) || (($intPosPontoVirgula = strrpos($strJavascript, ';')) !== false) || (($intPosEspaco = strrpos($strJavascript, ' ')) !== false) || (($intPosLinha = strrpos($strJavascript, "\n")) !== false)) {
            $intPostStart = 0;
            $intPlus = 1;
            if (($intPosVirgula !== false) && ($intPosVirgula >= $intPostStart))
                $intPostStart = $intPosVirgula;
            if (($intPosPontoVirgula !== false) && ($intPosPontoVirgula >= $intPostStart))
                $intPostStart = $intPosPontoVirgula;
            if (($intPosEspaco !== false) && ($intPosEspaco >= $intPostStart))
                $intPostStart = $intPosEspaco;
            if (($intPosLinha !== false) && ($intPosLinha >= $intPostStart)) {
                $intPostStart = $intPosLinha;
                $intPlus = 0;
            }
            return array($intPostStart, $intPlus);
        }
        return false;
    }

    private static function setShowFile($booShowFile)
    {
        return (self::$booShowFile = (bool) $booShowFile);
    }

    public function getHtmlV3()
    {
        return '<link href="' . $this->getBaseUrl() . '/vendor/barra-brasil/barra-brasil-3/css/barra-brasil.css' . AbstractHtmlHeadHelper::getSufixCssGzip() . '" media="screen" rel="stylesheet" type="text/css">
        <div id="barra-brasil-v3">
            <div>
                <div class="imagemGov">
                    <a href="http://www.brasil.gov.br" target="_blank" class="brasilgov" title="Portal Brasil - Abre em uma nova janela"></a>
                    <a href="http://www.acessoainformacao.gov.br/acessoainformacaogov" target="_blank" class="brasilgovAI" title="Acesso à Informação - Abre em uma nova janela"></a>
                </div>
            </div>
        </div>';
    }

}
