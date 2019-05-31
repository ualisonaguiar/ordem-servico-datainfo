<?php

namespace InepZend\WebService\Client\Corporative\Inep;

use InepZend\WebService\Client\Rest;
use InepZend\WebService\Client\Corporative\Inep\Obiee;
use InepZend\Util\ArrayCollection;
use InepZend\Util\PhpIni;
use InepZend\Util\String;
use InepZend\Util\Curl;
use InepZend\Util\Server;

class ObieeReport extends Rest
{

    const URL = 'http://172.29.10.100:8080/ProxyObiee/rest/report/';
    const BRIDGE_URL = '/bridgeobiee/';
    const REPORT_NUMERO_ALUNO_VINCULADO_TURMA_ATIVIDADE_COMPLEMENTAR = 1;
    const REPORT_NUMERO_ALUNO_VINCULADO_TURMA_ATENDIMENTO_EDUCACIONAL_ESPECIALIZADO = 2;
    const REPORT_NUMERO_ALUNO_TRES_NECESSIDADES_ESPECIAIS = 3;
    const REPORT_ALUNO_VINCULADO_TURMA_ATIVIDADE_COMPLEMENTAR = 4;

    private $obiee;
    private $reportParamInstance;
    private $strReportHtml;
    private $strReportXml;
    private static $arrReportPath = array();
    private static $arrColumnReport = array();

    public function __construct($mixNameOrObiee = null, $strPassword = null)
    {
        if (is_object($mixNameOrObiee))
            $this->setObiee($mixNameOrObiee);
        elseif ((is_string($mixNameOrObiee)) && (!empty($mixNameOrObiee)) && (!empty($strPassword)))
            $this->setObiee(new Obiee($mixNameOrObiee, $strPassword));
    }

    public function getDataReport($mixReportPath = null, $arrCriteria = null, $booTitle = null, $booNumericKey = null)
    {
        if (!is_array($mixValidate = self::validateParam($mixReportPath, $this->getObiee())))
            return $mixValidate;
//        if (is_string($mixReportParam = $this->listReportParam($mixValidate[0], $arrCriteria)))
//            return $mixReportParam;
        if (is_string($arrReportXml = $this->listReportXml($mixValidate[0], $arrCriteria)))
            return $arrReportXml;
        if (!is_bool($booTitle))
            $booTitle = false;
        if (!is_bool($booNumericKey))
            $booNumericKey = true;
        $arrResult = array();
        if (($booTitle) && (is_array($arrTitle = $this->listPromptedFilters($mixValidate[0]))))
            $arrResult[] = $arrTitle;
        foreach ($arrReportXml as $arrRegister) {
            $intKey = count($arrResult);
            $arrResult[$intKey] = array();
            foreach ($arrRegister as $mixValue) {
                $mixKey = count($arrResult[$intKey]);
                if ((!$booNumericKey) && (isset($arrTitle)) && (array_key_exists($mixKey, $arrTitle)))
                    $mixKey = self::getColumnReport($mixValidate[0], $arrTitle[$mixKey]);
                $arrResult[$intKey][$mixKey] = $mixValue;
            }
        }
        return $arrResult;
    }

    public function filter($mixReportPath = null, $arrCriteria = null, $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if (!is_array($mixValidate = self::validateParam($mixReportPath, $this->getObiee())))
            return $mixValidate;
        $result = $this->runService(__FUNCTION__, array_merge((array) $arrCriteria, array('reportPath' => $mixValidate[0], 'sessionID' => $mixValidate[1])), $strUrl, $arrHeader, 'POST', $booDebug);
        if (isset($result->filterResponse)) {
            $filterResponse = $result->filterResponse;
            if (isset($filterResponse->reportParam))
                $this->setReportParamInstance($filterResponse->reportParam);
        }
        return $result;
    }

    public function html($mixReportPath = null, $arrCriteria = null, $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if (!is_array($mixValidate = self::validateParam($mixReportPath, $this->getObiee())))
            return $mixValidate;
        $this->getObiee()->setBridge(self::getBridgeUrl());
        $result = $this->runService(__FUNCTION__, array_merge((array) $arrCriteria, array('reportPath' => $mixValidate[0], 'sessionID' => $mixValidate[1], 'bridge' => self::getBridgeUrl())), $strUrl, $arrHeader, 'POST', $booDebug);
        if (isset($result->reportResponse)) {
            $strReportHtml = '';
            $reportResponse = $result->reportResponse;
            if (isset($reportResponse->reportHeaders))
                $strReportHtml .= $reportResponse->reportHeaders;
            if (isset($reportResponse->reportBodyHtml))
                $strReportHtml .= $reportResponse->reportBodyHtml;
            if (isset($reportResponse->reportHtml))
                $strReportHtml .= $reportResponse->reportHtml;
            if (!empty($strReportHtml))
                $this->setReportHtml($strReportHtml);
        }
        return $result;
    }

    public function xml($mixReportPath = null, $arrCriteria = null, $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if (!is_array($mixValidate = self::validateParam($mixReportPath, $this->getObiee())))
            return $mixValidate;
        $result = $this->runService(__FUNCTION__, array_merge((array) $arrCriteria, array('reportPath' => $mixValidate[0], 'sessionID' => $mixValidate[1])), $strUrl, $arrHeader, 'POST', $booDebug);
        if (isset($result->reportResponse)) {
            $strReportXml = '';
            $reportResponse = $result->reportResponse;
            if (isset($reportResponse->reportXmlRowSet))
                $strReportXml .= $reportResponse->reportXmlRowSet;
            if (!empty($strReportXml))
                $this->setReportXml($strReportXml);
        }
        return $result;
    }

    public function folder($arrCriteria = null, $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        $strSessionId = $this->getObiee()->getSessionId();
        if (empty($strSessionId))
            return 'SessionId não informado!';
        $result = $this->runService(__FUNCTION__, array_merge((array) $arrCriteria, array('sessionID' => $strSessionId)), $strUrl, $arrHeader, 'POST', $booDebug);
        if (isset($result->folderResponse)) {
            $folderResponse = $result->folderResponse;
            if ((isset($folderResponse->reportPaths)) && (!empty($folderResponse->reportPaths)))
                self::setReportPath($folderResponse->reportPaths);
        }
        return $result;
    }

    public function runService($strMethod = null, array $arrParam = array(), $strUrl = null, $arrHeader = array(), $strDataMethod = 'POST', $booDebug = null)
    {
        PhpIni::setTimeLimit(0);
        if (count($arrHeader) == 0)
            $arrHeader = array(
                'Content-Type' => 'application/json',
                'Accept-encoding' => 'gzip',
                'Accept' => 'application/json',
            );
        return parent::runService(__CLASS__, $strMethod, json_encode(array_merge(array('usuario' => $this->getObiee()->getName()), $arrParam), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), $strUrl, (array) $arrHeader, $strDataMethod, $booDebug, null, array_merge(Curl::getOptionToHttpClient(), array('timeout' => 5 * 60)), null, true);
    }

    public function getObiee()
    {
        return $this->obiee;
    }

    public function getReportParamInstance()
    {
        return $this->reportParamInstance;
    }

    public function getReportHtml()
    {
        return $this->strReportHtml;
    }

    public function getReportXml()
    {
        return $this->strReportXml;
    }

    public static function getReportPath($mixReportPath = null)
    {
        if (empty($mixReportPath))
            return self::$arrReportPath;
        if (!is_numeric($mixReportPath))
            return $mixReportPath;
        switch ($mixReportPath) {
            case self::REPORT_NUMERO_ALUNO_VINCULADO_TURMA_ATIVIDADE_COMPLEMENTAR:
                $strReportPath = '/shared/Censo Corrente - Educação Básica/Análises/Número de Alunos vinculados somente em turma de Atividade Complementar';
                break;
            case self::REPORT_NUMERO_ALUNO_VINCULADO_TURMA_ATENDIMENTO_EDUCACIONAL_ESPECIALIZADO:
                $strReportPath = '/shared/Censo Corrente - Educação Básica/Análises/Número de Alunos vinculados somente em turma de Atendimento Educacional Especializado';
                break;
            case self::REPORT_NUMERO_ALUNO_TRES_NECESSIDADES_ESPECIAIS:
                $strReportPath = '/shared/Censo Corrente - Educação Básica/Análises/Número de Alunos com mais de três necessidades especiais transtornos globais do desenvolvimento ou altas habilidades / superdotação';
                break;
            case self::REPORT_ALUNO_VINCULADO_TURMA_ATIVIDADE_COMPLEMENTAR:
                $strReportPath = '/shared/Censo Corrente - Educação Básica/Análises/Alunos Vinculados à Turmas de Atividade Complementar';
                break;
            default:
                return false;
                break;
        }
        return $strReportPath;
    }

    public static function validateParam($mixReportPath = null, $obiee = null)
    {
        if (!is_object($obiee))
            return 'Obiee não informado!';
        $strReportPath = self::getReportPath($mixReportPath);
        if (is_bool($strReportPath))
            return 'ReportPath não informado!';
        $strSessionId = $obiee->getSessionId();
        if (empty($strSessionId))
            return 'SessionId não informado!';
        return array($strReportPath, $strSessionId);
    }

    private function listReportParam($mixReportPath = null, $arrCriteria = null)
    {
        $this->setReportParamInstance(null);
        $this->filter($mixReportPath, $arrCriteria);
        $reportParamInstance = $this->getReportParamInstance();
        if (is_object($reportParamInstance)) {
            # @TODO Implementar o filtro
        }
    }

    private function listReportXml($mixReportPath = null, $arrCriteria = null)
    {
        $this->setReportHtml(null);
        $this->setReportXml(null);
        $this->xml($mixReportPath, $arrCriteria);
        $strReportXml = $this->getReportXml();
        if (empty($strReportXml))
            return 'XML não carregado!';
        $arrReportXml = ArrayCollection::convertXmlToArray('/*', str_replace('<rowset xmlns="urn:schemas-microsoft-com:xml-analysis:rowset">', '<rowset>', $strReportXml));
        if ((!is_array($arrReportXml)) || (!array_key_exists('rowset', $arrReportXml)) || (!array_key_exists('Row', $arrReportXml['rowset'])))
            return 'XML sem a estrutura definida!';
        return array_values($arrReportXml['rowset']['Row']);
    }

    private function listPromptedFilters($mixReportPath = null)
    {
        $this->getObiee()->getPromptedFilters($mixReportPath);
        $strPromptedFilter = $this->getObiee()->getPromptedFilter();
        if (!empty($strPromptedFilter)) {
            $arrPromptedFilter = ArrayCollection::convertXmlToArray('/*', str_replace('', '', $strPromptedFilter));
            if ((is_array($arrPromptedFilter)) && (array_key_exists('sawfilter', $arrPromptedFilter)) && (array_key_exists('sawxexpr', $arrPromptedFilter['sawfilter']))) {
                $arrTitle = array();
                foreach ($arrPromptedFilter['sawfilter']['sawxexpr'] as $arrInfoTitle) {
                    if ((!array_key_exists('sawxexpr', $arrInfoTitle)) || (!array_key_exists(0, $arrInfoTitle['sawxexpr'])))
                        continue;
                    $arrTitle[] = str_replace('"', '', end($arrExplode = explode('"."', $arrInfoTitle['sawxexpr'][0])));
                }
                return $arrTitle;
            }
        }
        return 'Título(s) não carregado(s)!';
    }

    private static function getColumnReport($strReportPath = null, $strTitle = null)
    {
        if ((!array_key_exists($strReportPath, self::$arrColumnReport)) || (!array_key_exists($strTitle, self::$arrColumnReport[$strReportPath])))
            self::$arrColumnReport[$strReportPath][$strTitle] = strtoupper(String::clearWord(str_replace(' ', '_', $strTitle)));
        return self::$arrColumnReport[$strReportPath][$strTitle];
    }

    private function setObiee($obiee = null)
    {
        $this->obiee = $obiee;
        return $this;
    }

    private function setReportParamInstance($reportParamInstance = null)
    {
        $this->reportParamInstance = $reportParamInstance;
        return $this;
    }

    private function setReportHtml($strReportHtml = null)
    {
        $this->strReportHtml = $strReportHtml;
        return $this;
    }

    private function setReportXml($strReportXml = null)
    {
        $this->strReportXml = $strReportXml;
        return $this;
    }

    private static function setReportPath($arrReportPath = array())
    {
        self::$arrReportPath = $arrReportPath;
        return $this;
    }

    private static function getBridgeUrl($booHost = null)
    {
        $strBridgeUrl = self::BRIDGE_URL;
        if (($booHost !== false) && (strpos($strBridgeUrl, $strNeedle = '://') === false)) {
            $strBridgeUrl = Server::getHost() . $strBridgeUrl;
            $arrBridgeUrl = explode($strNeedle, $strBridgeUrl);
            $strBridgeUrl = $arrBridgeUrl[0];
            if (count($arrBridgeUrl) > 1)
                $strBridgeUrl .= $strNeedle . str_replace('//', '/', $arrBridgeUrl[1]);
        }
        return $strBridgeUrl;
    }

    private function getArgumentToReport($mixReportPath = null, $arrCriteria = null)
    {
        $strArgument = (!empty($mixReportPath)) ? '$mixReportPath' : '';
        if (is_array($arrCriteria)) {
            $arrArgument = array();
            foreach ($arrCriteria as $strCriteriaName => $mixCriteriaValue)
                $arrArgument[] = '$arrCriteria["' . $strCriteriaName . '"]';
            if (count($arrArgument) > 0)
                $strArgument .= ((!empty($mixReportPath)) ? ', ' : '') . implode(', ', $arrArgument);
        }
        return $strArgument;
    }

}
