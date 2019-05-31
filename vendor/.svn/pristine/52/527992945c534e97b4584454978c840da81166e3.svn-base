<?php

namespace InepZend\Workflow;

use InepZend\Util\DebugExec;
use InepZend\Util\Reflection;
use InepZend\Util\ArrayCollection;
use InepZend\Dto\InputDto;
use InepZend\Dto\ResultDto;

class Workflow
{

    use DebugExec;

    const DEBUG = false;
    const CONST_KEY_XML_START = 'START';
    const CONST_KEY_XML_FLOW = 'FLOW';
    const CONST_KEY_XML_ID = 'CO_STATUS';
    const CONST_KEY_XML_NEXTFLOW = 'NEXTFLOW';
    const CONST_KEY_XML_CONDITION = 'CONDITION';
    const CONST_KEY_XML_DESCRIPTION = 'DESCRIPTION';
    const CONST_KEY_XML_EVAL = 'EVAL';
    const CONST_KEY_XML_OBJECT = 'status';

    private static $arrMapping = null;
    private static $arrMappingFull = null;
    private static $strPathXml = null;
    private static $arrInfoStatus = null;
    private static $arrInfoFlow = null;

    const CONST_KEY_PARAM_STATUS_CLASS = 'status_class';
    const CONST_KEY_PARAM_STATUS_FIELD_PK = 'status_field_pk';
    const CONST_KEY_PARAM_STATUS_FIELD_DESCRIPTION = 'status_field_description';
    const CONST_KEY_PARAM_STATUS_METHOD_GET = 'status_method_get';
    const CONST_KEY_PARAM_STATUS_OBJECT = 'status_object';
    const CONST_KEY_PARAM_FLOW_CLASS = 'flow_class';
    const CONST_KEY_PARAM_FLOW_FIELD_STATUS = 'flow_field_status';
    const CONST_KEY_PARAM_FLOW_METHOD_LIST = 'flow_method_list';
    const CONST_KEY_PARAM_FLOW_METHOD_SAVE = 'flow_method_save';
    const CONST_KEY_PARAM_FLOW_OBJECTS = 'flow_objects';
    const CONST_KEY_PARAM_ENTITY_FIELD_PK = 'entity_field_pk';

    public static function getCurrentFlow($mixCoEntity = 0, $booReturnWithObject = false)
    {
        $arrInfoFlow = self::getArrInfoFlow();
        $arrFlowReturn = array();
        $inputDtoLastFlow = new InputDto();
        $inputDtoLastFlow->addData('limit', 1);
        if ((is_array($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK])) && (is_array($mixCoEntity))) {
            foreach ($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK] as $intKey => $strPkFieldName)
                $inputDtoLastFlow->addData($strPkFieldName, $mixCoEntity[$intKey]);
        } elseif ((is_array($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK])) && (!is_array($mixCoEntity)))
            $inputDtoLastFlow->addData($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK][0], $mixCoEntity);
        elseif ((!is_array($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK])) && (is_array($mixCoEntity)))
            $inputDtoLastFlow->addData($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK], $mixCoEntity[0]);
        else
            $inputDtoLastFlow->addData($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK], $mixCoEntity);
        eval('$resultDtoLastFlow = ' . $arrInfoFlow[self::CONST_KEY_PARAM_FLOW_CLASS] . '::' . $arrInfoFlow[self::CONST_KEY_PARAM_FLOW_METHOD_LIST] . '($inputDtoLastFlow);');
        if ($resultDtoLastFlow->getStatus() == 'ok') {
            $arrFlow = $resultDtoLastFlow->getData($arrInfoFlow[self::CONST_KEY_PARAM_FLOW_OBJECTS]);
            $intCoStatus = (count($arrFlow) == 1) ? $arrFlow[0]->getAtributo($arrInfoFlow[self::CONST_KEY_PARAM_FLOW_FIELD_STATUS]) : null;
            $arrFlowReturn = self::getFlowFromStatus($intCoStatus, $booReturnWithObject);
        }
        return $arrFlowReturn;
    }

    public static function simulateAllFlow($mixCoEntity = 0, $inputDto = null)
    {
        return self::checkFlow($mixCoEntity, $inputDto, true, true);
    }

    public static function simulateFlow($mixCoEntity = 0, $inputDto = null)
    {
        return self::checkFlow($mixCoEntity, $inputDto, true, false);
    }

    public static function checkFlow($mixCoEntity = 0, $inputDto = null, $booSimulate = false, $booSimulateAll = false)
    {
        $arrCheckFlow = array();
        $mixCheckFlow = false;
        $arrFlowInfo = self::getCurrentFlow($mixCoEntity, false);
        self::debugExec($arrFlowInfo);
        if (count($arrFlowInfo) > 0) {
            if ((isset($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION])) && (is_array($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION]))) {
                $arrFiles = array();
                $arrClassSpecial = array();
                foreach ($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION] as $intCondition => $mixFlowInfoCondition) {
                    $strDescription = ((is_array($mixFlowInfoCondition)) && (isset($mixFlowInfoCondition[self::CONST_KEY_XML_DESCRIPTION])) && (!empty($mixFlowInfoCondition[self::CONST_KEY_XML_DESCRIPTION]))) ? $mixFlowInfoCondition[self::CONST_KEY_XML_DESCRIPTION] : $mixFlowInfoCondition;
                    $booContinue = false;
                    if ((!is_array($mixFlowInfoCondition)) && ($intCondition == self::CONST_KEY_XML_DESCRIPTION))
                        $booContinue = true;
                    elseif ((is_array($mixFlowInfoCondition)) && (isset($mixFlowInfoCondition[self::CONST_KEY_XML_DESCRIPTION])) && (!empty($mixFlowInfoCondition[self::CONST_KEY_XML_DESCRIPTION])))
                        $booContinue = true;
                    if (($booContinue) && (!empty($strDescription)) && (stripos($strDescription, '::') !== false) && (stripos($strDescription, '(') !== false) && (stripos($strDescription, ')') !== false)) {
                        $arrDescription = explode('::', $strDescription);
                        $strClassName = $arrDescription[0];
                        $arrClassMethodName = explode('(', $arrDescription[1]);
                        $strClassMethodName = $arrClassMethodName[0];
                        foreach ($arrFiles as $strClassPath) {
                            foreach ($arrClassSpecial as $strClassSpecial) {
                                if (stripos($strClassPath, $strClassSpecial . '.php') !== false)
                                    continue(2);
                            }
                            $strRealClassName = Reflection::getRealClassNameWithPath($strClassName, $strClassPath);
                            if (!is_null($strRealClassName)) {
                                $strMethodIntern = Reflection::listMethodsFromClass($strRealClassName, true, $strClassMethodName);
                                $arrFlowInfoCondition = (!is_array($mixFlowInfoCondition)) ? $arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION] : $mixFlowInfoCondition;
                                if (!is_null($strMethodIntern))
                                    $mixCheckFlow = self::execFlowCondition($mixCoEntity, $arrFlowInfoCondition, $inputDto, $booSimulate);
                                if (($mixCheckFlow === true) || (is_integer($mixCheckFlow))) {
                                    if ($booSimulateAll === false)
                                        break (2);
                                    elseif (is_integer($mixCheckFlow))
                                        $arrCheckFlow[] = $mixCheckFlow;
                                }
                                break;
                            }
                        }
                    }
                }
            } elseif (($booSimulate === false) && (isset($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_ID])) && (!empty($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_ID])))
                $mixCheckFlow = self::goToNextFlow($mixCoEntity, $arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_ID], $inputDto);
        }
        if ($booSimulateAll === true)
            $mixCheckFlow = $arrCheckFlow;
        self::debugExec($mixCheckFlow);
        return $mixCheckFlow;
    }

    public static function goToNextFlow($mixCoEntity = 0, $intCoStatus = 0, $inputDto = null)
    {
        $arrInfoFlow = self::getArrInfoFlow();
        $arrDataFlow = array(
            $arrInfoFlow[self::CONST_KEY_PARAM_FLOW_FIELD_STATUS] => $intCoStatus,
//            'dt_andamento' => date('Y-m-d H:i:s')
        );
        if ((is_array($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK])) && (is_array($mixCoEntity))) {
            foreach ($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK] as $intKey => $strPkFieldName)
                $arrDataFlow[$strPkFieldName] = $mixCoEntity[$intKey];
        } elseif ((is_array($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK])) && (!is_array($mixCoEntity)))
            $arrDataFlow[$arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK][0]] = $mixCoEntity;
        elseif ((!is_array($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK])) && (is_array($mixCoEntity)))
            $arrDataFlow[$arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK]] = $mixCoEntity[0];
        else
            $arrDataFlow[$arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK]] = $mixCoEntity;
        $strDtPrazoEncerramento = ($inputDto instanceof InputDto) ? $inputDto->getData('dt_prazo_encerramento') : null;
        $strDsJustificativa = ($inputDto instanceof InputDto) ? $inputDto->getData('ds_justificativa') : null;
        $strDtAndamento = ($inputDto instanceof InputDto) ? $inputDto->getData('dt_andamento') : null;
        if (!empty($strDtPrazoEncerramento))
            $arrDataFlow['dt_prazo_encerramento'] = $strDtPrazoEncerramento;
        if (!empty($strDsJustificativa))
            $arrDataFlow['ds_justificativa'] = $strDsJustificativa;
        if (!empty($strDtAndamento))
            $arrDataFlow['dt_andamento'] = $strDtAndamento;
        self::debugExec($arrDataFlow);
        $arrFlowInfo = self::getCurrentFlow($mixCoEntity);
        if ((isset($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_EVAL])) && (!empty($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_EVAL])))
            $strEval = $arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_EVAL];
        if ((isset($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_EVAL])) && (!empty($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_EVAL]))) {
            if ((isset($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_ID])) && ($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_ID] == $intCoStatus))
                $strEval = $arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_EVAL];
        } elseif ((isset($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION])) && (is_array($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION]))) {
            foreach ($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION] as $intCondition => $arrFlowInfoCondition) {
                if ((isset($arrFlowInfoCondition[self::CONST_KEY_XML_EVAL])) && (!empty($arrFlowInfoCondition[self::CONST_KEY_XML_EVAL]))) {
                    if ((isset($arrFlowInfoCondition[self::CONST_KEY_XML_ID])) && ($arrFlowInfoCondition[self::CONST_KEY_XML_ID] == $intCoStatus)) {
                        $strEval = $arrFlowInfoCondition[self::CONST_KEY_XML_EVAL];
                        break;
                    }
                }
            }
        }
        $inputDtoFlow = new InputDto();
        $inputDtoFlow->addData('arrDataForm', $arrDataFlow);
        eval('$resultDtoFlow = ' . $arrInfoFlow[self::CONST_KEY_PARAM_FLOW_CLASS] . '::' . $arrInfoFlow[self::CONST_KEY_PARAM_FLOW_METHOD_SAVE] . '($inputDtoFlow);');
        self::debugExec($resultDtoFlow);
        $booReturn = ($resultDtoFlow->getStatus() == 'ok') ? true : false;
        if (($booReturn === true) && (isset($strEval))) {
            $strEval = str_ireplace(array('()', '()'), '($inputDtoFlow)', $strEval);
            self::debugExec($strEval);
            eval($strEval);
        }
        return $booReturn;
    }

    public static function setStrPathXml($strPathXml = null)
    {
        if (!empty($strPathXml))
            self::$strPathXml = $strPathXml;
    }

    public static function getStrPathXml()
    {
        if (empty(self::$strPathXml))
            self::setStrPathXml('config/config.flow.xml');
        return (string) self::$strPathXml;
    }

    public static function setArrInfoStatus($arrInfoStatus)
    {
        if (is_array($arrInfoStatus)) {
            if ((!empty($arrInfoStatus[self::CONST_KEY_PARAM_STATUS_CLASS])) && (!empty($arrInfoStatus[self::CONST_KEY_PARAM_STATUS_FIELD_PK])) && (!empty($arrInfoStatus[self::CONST_KEY_PARAM_STATUS_FIELD_DESCRIPTION]))) {
                if (empty($arrInfoStatus[self::CONST_KEY_PARAM_STATUS_METHOD_GET]))
                    $arrInfoStatus[self::CONST_KEY_PARAM_STATUS_METHOD_GET] = 'find';
                if (empty($arrInfoStatus[self::CONST_KEY_PARAM_STATUS_OBJECT]))
                    $arrInfoStatus[self::CONST_KEY_PARAM_STATUS_OBJECT] = $arrInfoStatus[self::CONST_KEY_PARAM_STATUS_CLASS];
                self::$arrInfoStatus = $arrInfoStatus;
            }
        }
    }

    public static function getArrInfoStatus()
    {
        if ((empty(self::$arrInfoStatus)) || ((is_array(self::$arrInfoStatus)) && (count(self::$arrInfoStatus) == 0)))
            self::setArrInfoStatus(array(self::CONST_KEY_PARAM_STATUS_CLASS => 'Gen', self::CONST_KEY_PARAM_STATUS_FIELD_PK => 'co_generica', self::CONST_KEY_PARAM_STATUS_FIELD_DESCRIPTION => 'ds_generica'));
        return (array) self::$arrInfoStatus;
    }

    public static function setArrInfoFlow($arrInfoFlow)
    {
        if (is_array($arrInfoFlow)) {
            if
            (
                    (!empty($arrInfoFlow[self::CONST_KEY_PARAM_FLOW_CLASS])) &&
                    (!empty($arrInfoFlow[self::CONST_KEY_PARAM_FLOW_FIELD_STATUS])) &&
                    (
                    ((is_array($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK])) && (count($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK]) > 0)) ||
                    ((!is_array($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK])) && (!empty($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK])))
                    )
            ) {
                if (empty($arrInfoFlow[self::CONST_KEY_PARAM_FLOW_METHOD_LIST]))
                    $arrInfoFlow[self::CONST_KEY_PARAM_FLOW_METHOD_LIST] = 'findBy';
                if (empty($arrInfoFlow[self::CONST_KEY_PARAM_FLOW_METHOD_SAVE]))
                    $arrInfoFlow[self::CONST_KEY_PARAM_FLOW_METHOD_SAVE] = 'save';
                if (empty($arrInfoFlow[self::CONST_KEY_PARAM_FLOW_OBJECTS]))
                    $arrInfoFlow[self::CONST_KEY_PARAM_FLOW_OBJECTS] = 'arr' . $arrInfoFlow[self::CONST_KEY_PARAM_FLOW_CLASS];
                self::$arrInfoFlow = $arrInfoFlow;
            }
        }
    }

    public static function getArrInfoFlow()
    {
        if ((empty(self::$arrInfoFlow)) || ((is_array(self::$arrInfoFlow)) && (count(self::$arrInfoFlow) == 0)))
            self::setArrInfoFlow(array(self::CONST_KEY_PARAM_FLOW_CLASS => 'Andamento', self::CONST_KEY_PARAM_FLOW_FIELD_STATUS => 'co_status', self::CONST_KEY_PARAM_ENTITY_FIELD_PK => 'co_entidade'));
        return (array) self::$arrInfoFlow;
    }

    public static function goToNextFlowValid($mixCoEntity = 0, $intCoStatus = 0, $inputDtoSimulate = null, $inputDtoGoToNextFlow = null)
    {
        $resultDto = new ResultDto();
        if (($mixCoEntity == 0) || ($intCoStatus == 0)) {
            $resultDto->setStatus('Validação');
            $resultDto->addError('&Eacute; necess&aacute;rio informar todos os par&acirc;metros para que a opera&ccedil;&atilde;o seja realizada!');
        } else {
            $arrInfoStatus = self::getArrInfoStatus();
            $arrFlowReturn = self::getCurrentFlow($mixCoEntity, true);
            $currentFlow = $arrFlowReturn[self::CONST_KEY_XML_OBJECT];
            $strCurrentFlow = (is_object($currentFlow)) ? ' de "' . $currentFlow->getAtributo($arrInfoStatus[self::CONST_KEY_PARAM_STATUS_FIELD_DESCRIPTION]) . '"' : '';
            if ((isset($arrFlowReturn[self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_ID])) && ($arrFlowReturn[self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_ID] == $intCoStatus))
                $nextFlow = $arrFlowReturn[self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_OBJECT];
            if ((isset($arrFlowReturn[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_ID])) && ($arrFlowReturn[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_ID] == $intCoStatus))
                $nextFlow = $arrFlowReturn[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_OBJECT];
            if ((isset($arrFlowReturn[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_ID])) && ($arrFlowReturn[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_ID] == $intCoStatus))
                $nextFlow = $arrFlowReturn[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_OBJECT];
            elseif ((isset($arrFlowReturn[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION])) && (is_array($arrFlowReturn[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION]))) {
                foreach ($arrFlowReturn[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION] as $intCondition => $arrFlowReturnCondition) {
                    if ((!is_object($arrFlowReturnCondition)) && (isset($arrFlowReturnCondition[self::CONST_KEY_XML_ID])) && ($arrFlowReturnCondition[self::CONST_KEY_XML_ID] == $intCoStatus)) {
                        $nextFlow = $arrFlowReturn[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION][$intCondition][self::CONST_KEY_XML_OBJECT];
                        break;
                    }
                }
            }
            if (!isset($nextFlow)) {
                $status = new $arrInfoStatus[self::CONST_KEY_PARAM_STATUS_CLASS]();
                $status->setAtributo($arrInfoStatus[self::CONST_KEY_PARAM_STATUS_FIELD_PK], $intCoStatus);
                $resultDtoStatus = $status->$arrInfoStatus[self::CONST_KEY_PARAM_STATUS_METHOD_GET]();
                if ($resultDtoStatus->getStatus() == 'Inexistência') {
                    $resultDto->setStatus('Inexistência');
                    $resultDto->addError('O andamento' . $strCurrentFlow . ' n&atilde;o permite ser encaminhado para um pr&oacute;ximo andamento inexistente!');
                } else {
                    $resultDto->setStatus('Falha');
                    $resultDto->addError('N&atilde;o &eacute; poss&iacute;vel encaminhar o andamento' . $strCurrentFlow . ' para "' . $status->getAtributo($arrInfoStatus[self::CONST_KEY_PARAM_STATUS_FIELD_DESCRIPTION]) . '"!');
                }
            } else {
                $mixResultSimulateAllFlow = self::simulateAllFlow($mixCoEntity, $inputDtoSimulate);
                if (in_array($intCoStatus, $mixResultSimulateAllFlow)) {
                    $booGoToNextFlow = self::goToNextFlow($mixCoEntity, $intCoStatus, $inputDtoGoToNextFlow);
                    if ($booGoToNextFlow === false) {
                        $resultDto->setStatus('Erro');
                        $resultDto->addError('Ocorreu alguma falha durante o encaminhamento do andamento' . $strCurrentFlow . ' para "' . $nextFlow->getAtributo($arrInfoStatus[self::CONST_KEY_PARAM_STATUS_FIELD_DESCRIPTION]) . '"!');
                    } else {
                        $resultDto->setStatus('ok');
                        $resultDto->addError('O andamento' . $strCurrentFlow . ' para "' . $nextFlow->getAtributo($arrInfoStatus[self::CONST_KEY_PARAM_STATUS_FIELD_DESCRIPTION]) . '" foi encaminhado com sucesso!');
                    }
                } else {
                    $resultDto->setStatus('Falha');
                    $resultDto->addError('N&atilde;o &eacute; poss&iacute;vel encaminhar o andamento' . $strCurrentFlow . ' para "' . $nextFlow->getAtributo($arrInfoStatus[self::CONST_KEY_PARAM_STATUS_FIELD_DESCRIPTION]) . '"!');
                }
            }
        }
        return $resultDto;
    }

    public static function clearArrMapping()
    {
        self::$arrMapping = null;
    }

    public static function clearArrMappingFull()
    {
        self::$arrMappingFull = null;
    }

    public static function clearStrPathXml()
    {
        self::$strPathXml = null;
    }

    public static function clearArrInfoStatus()
    {
        self::$arrInfoStatus = null;
    }

    public static function clearArrInfoFlow()
    {
        self::$arrInfoFlow = null;
    }

    public static function clearInfo()
    {
        self::clearArrMapping();
        self::clearArrMappingFull();
        self::clearStrPathXml();
        self::clearArrInfoStatus();
        self::clearArrInfoFlow();
    }

    private static function getArrMappingFromFile()
    {
        $strFileName = self::getStrPathXml();
        $hanFile = fopen($strFileName, 'r');
        $strXml = fread($hanFile, filesize($strFileName));
        fclose($hanFile);
        $arrMapping = ArrayCollection::convertXmlToArray('/WORKFLOW/*', $strXml);
        if (!is_array($arrMapping))
            $arrMapping = array();
        return $arrMapping;
    }

    private static function getArrMapping()
    {
        $arrMapping = self::$arrMapping;
        if (is_null(self::$arrMapping)) {
            $arrMapping = self::getArrMappingFromFile();
            self::$arrMapping = $arrMapping;
        }
        return $arrMapping;
    }

    private static function getArrMappingFull()
    {
        $arrMapping = self::$arrMappingFull;
        if (is_null(self::$arrMappingFull)) {
            $arrMapping = self::getArrMapping();
            foreach ($arrMapping as $arrFlow) {
                foreach ($arrFlow as $intFlow => $arrFlowInfo) {
                    if ((isset($arrFlowInfo[self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_ID])) && (!empty($arrFlowInfo[self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_ID])))
                        self::setStatusIntoArrMapping($arrFlowInfo[self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_ID], $arrMapping[self::CONST_KEY_XML_START][$intFlow][self::CONST_KEY_XML_CONDITION]);
                    if ((isset($arrFlowInfo[self::CONST_KEY_XML_ID])) && (!empty($arrFlowInfo[self::CONST_KEY_XML_ID])))
                        self::setStatusIntoArrMapping($arrFlowInfo[self::CONST_KEY_XML_ID], $arrMapping[self::CONST_KEY_XML_FLOW][$intFlow]);
                    if ((isset($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_ID])) && (!empty($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_ID])))
                        self::setStatusIntoArrMapping($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_ID], $arrMapping[self::CONST_KEY_XML_FLOW][$intFlow][self::CONST_KEY_XML_NEXTFLOW]);
                    if ((isset($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_ID])) && (!empty($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_ID])))
                        self::setStatusIntoArrMapping($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION][self::CONST_KEY_XML_ID], $arrMapping[self::CONST_KEY_XML_FLOW][$intFlow][self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION]);
                    elseif ((isset($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION])) && (is_array($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION]))) {
                        foreach ($arrFlowInfo[self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION] as $intCondition => $arrFlowInfoCondition) {
                            if ((isset($arrFlowInfoCondition[self::CONST_KEY_XML_ID])) && (!empty($arrFlowInfoCondition[self::CONST_KEY_XML_ID])))
                                self::setStatusIntoArrMapping($arrFlowInfoCondition[self::CONST_KEY_XML_ID], $arrMapping[self::CONST_KEY_XML_FLOW][$intFlow][self::CONST_KEY_XML_NEXTFLOW][self::CONST_KEY_XML_CONDITION][$intCondition]);
                        }
                    }
                }
            }
            if (!is_array($arrMapping))
                $arrMapping = array();
            self::$arrMappingFull = $arrMapping;
        }
        return $arrMapping;
    }

    private static function setStatusIntoArrMapping($intCoStatus, &$mixRepository)
    {
        $arrInfoStatus = self::getArrInfoStatus();
        $inputDtoStatus = new InputDto();
        $inputDtoStatus->addData($arrInfoStatus[self::CONST_KEY_PARAM_STATUS_FIELD_PK], $intCoStatus);
        eval('$resultDtoStatus = ' . $arrInfoStatus[self::CONST_KEY_PARAM_STATUS_CLASS] . '::' . $arrInfoStatus[self::CONST_KEY_PARAM_STATUS_METHOD_GET] . '($inputDtoStatus);');
        if ($resultDtoStatus->getStatus() == 'ok')
            $mixRepository[self::CONST_KEY_XML_OBJECT] = $resultDtoStatus->getData($arrInfoStatus[self::CONST_KEY_PARAM_STATUS_OBJECT]);
    }

    private static function getFlowFromStatus($intCoStatus = 0, $booReturnWithObject = false)
    {
        $arrFlowReturn = array();
        $strMethodGetArrMappgin = ($booReturnWithObject === true) ? 'getArrMappingFull' : 'getArrMapping';
        $arrMapping = self::$strMethodGetArrMappgin();
        foreach ($arrMapping as $strKey => $arrFlow) {
            if ($strKey == self::CONST_KEY_XML_FLOW) {
                foreach ($arrFlow as $arrFlowInfo) {
                    if ((isset($arrFlowInfo[self::CONST_KEY_XML_ID])) && (!empty($arrFlowInfo[self::CONST_KEY_XML_ID]))) {
                        if ($arrFlowInfo[self::CONST_KEY_XML_ID] == $intCoStatus) {
                            $arrFlowReturn = $arrFlowInfo;
                            break (2);
                        }
                    }
                }
            }
        }
        if (count($arrFlowReturn) == 0)
            $arrFlowReturn = $arrMapping[self::CONST_KEY_XML_START];
        if (!is_array($arrFlowReturn))
            $arrFlowReturn = array();
        return $arrFlowReturn;
    }

    private static function execFlowCondition($mixCoEntity = 0, $arrFlowInfoCondition = array(), $inputDto = null, $booSimulate = false)
    {
        $arrInfoFlow = self::getArrInfoFlow();
        $booGoToNextFlow = false;
        $strEval = '$mixResult = ' . $arrFlowInfoCondition[self::CONST_KEY_XML_DESCRIPTION];
        if ((stripos($strEval, '(') === false) || (stripos($strEval, ')') === false))
            return $booGoToNextFlow;
        $arrEval = explode('(', $strEval);
        if (!$inputDto instanceof InputDto)
            $inputDto = new InputDto();
        if ((is_array($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK])) && (is_array($mixCoEntity))) {
            foreach ($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK] as $intKey => $strPkFieldName)
                $inputDto->addData($strPkFieldName, $mixCoEntity[$intKey]);
        } elseif ((is_array($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK])) && (!is_array($mixCoEntity)))
            $inputDto->addData($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK][0], $mixCoEntity);
        elseif ((!is_array($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK])) && (is_array($mixCoEntity)))
            $inputDto->addData($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK], $mixCoEntity[0]);
        else
            $inputDto->addData($arrInfoFlow[self::CONST_KEY_PARAM_ENTITY_FIELD_PK], $mixCoEntity);
        $strParam = '';
        if (strlen(trim($arrEval[1])) > 1) {
            $arrEvalParam = explode(')', trim($arrEval[1]));
            $strParam = trim($arrEvalParam[0]);
            if (!empty($strParam))
                $strParam = ' , ' . $strParam;
        }
        $inputDto->addData('booSimulate', $booSimulate);
        $strEval = $arrEval[0] . '($inputDto' . $strParam . ')';
        if (stripos($strEval, ';') === false)
            $strEval .= ';';
        self::debugExec($strEval);
        self::debugExec($inputDto);
        eval($strEval);
        self::debugExec($mixResult);
        $booConditionOk = false;
        if ($mixResult instanceof ResultDto) {
            if ($mixResult->getStatus() == 'ok')
                $booConditionOk = true;
        }
        elseif (is_bool($mixResult))
            $booConditionOk = $mixResult;
        if ($booConditionOk === true) {
            if ($booSimulate === false)
                $booGoToNextFlow = self::goToNextFlow($mixCoEntity, $arrFlowInfoCondition[self::CONST_KEY_XML_ID], $inputDto);
            else {
                $booGoToNextFlow = true;
                return (integer) $arrFlowInfoCondition[self::CONST_KEY_XML_ID];
            }
        }
        return $booGoToNextFlow;
    }

}
