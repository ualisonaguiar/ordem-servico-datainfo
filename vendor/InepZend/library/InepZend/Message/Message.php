<?php

namespace InepZend\Message;

use InepZend\Message\FlashMessenger;

class Message
{

    const GENERAL_TYPE = 'General';
    const GENERAL_LEGEND = null;
    const GENERAL_COLOR = null;
    const SUCCESS_TYPE = 'Success';
    const SUCCESS_LEGEND = 'SUCESSO';
    const SUCCESS_COLOR = '#009238';
    const ERROR_TYPE = 'Error';
    const ERROR_LEGEND = 'ERRO';
    const ERROR_COLOR = '#FF0000';
    const WARNING_TYPE = 'Warning';
    const WARNING_LEGEND = 'AVISO';
    const WARNING_COLOR = '#FF6600';
    const NOTICE_TYPE = 'Notice';
    const NOTICE_LEGEND = 'NOTA';
    const NOTICE_COLOR = '#CCCCCC';
    const VALIDATE_TYPE = 'Validate';
    const VALIDATE_LEGEND = 'VALIDAÇÃO';
    const VALIDATE_COLOR = '#DFB200';
    const VALIDATE_GROUP_TYPE = 'Validate Group';
    const VALIDATE_GROUP_LEGEND = 'VALIDAÇÃO';
    const VALIDATE_GROUP_COLOR = '#DFB200';

    private static $flashMessanger;

    public function getFlashMessanger()
    {
        if (@!is_object($this->flashMessanger))
            $this->flashMessanger = new FlashMessenger();
        return $this->flashMessanger;
    }

    public function addMessage($mixMessage)
    {
        $this->addMessageGeneric($mixMessage, self::GENERAL_TYPE);
    }

    public function addMessageSuccess($mixMessage)
    {
        $this->addMessageGeneric($mixMessage, self::SUCCESS_TYPE, self::SUCCESS_LEGEND, self::SUCCESS_COLOR);
    }

    public function addMessageError($mixMessage)
    {
        $this->addMessageGeneric($mixMessage, self::ERROR_TYPE, self::ERROR_LEGEND, self::ERROR_COLOR);
    }

    public function addMessageWarning($mixMessage)
    {
        $this->addMessageGeneric($mixMessage, self::WARNING_TYPE, self::WARNING_LEGEND, self::WARNING_COLOR);
    }

    public function addMessageNotice($mixMessage)
    {
        $this->addMessageGeneric($mixMessage, self::NOTICE_TYPE, self::NOTICE_LEGEND, self::NOTICE_COLOR);
    }

    public function addMessageValidate($mixMessage, $form = null, $booReturn = null)
    {
        $arrValidateMessageGroup = array();
        $arrValidateMessageSingle = array();
        if (is_object($form)) {
            $arrTranslate = array(
                'Value is required and can\'t be empty' => 'Campo obrigatório.',
                'Captcha value is wrong' => 'Valor não confere com a imagem.',
            );
            $arrMessage = $form->getMessages();
            $arrElement = $form->getElements();
            foreach ($arrMessage as $strName => $arrValidate) {
                $element = $arrElement[$strName];
                $strTypeValidateMessage = $element->getAttribute('validate_message');
                if (in_array((string) $strTypeValidateMessage, array('field')))
                    continue;
                $strLabel = $element->getOption('label');
                if (empty($strLabel))
                    $strLabel = str_ireplace(array(' - item(ns) selecionado(s)', ' - item(ns) não selecionado(s)'), '', $element->getAttribute('title'));
                foreach ($arrValidate as $strMessage) {
                    $strValidate = $strMessage;
                    foreach ($arrTranslate as $strFind => $strReplace)
                        $strValidate = str_ireplace($strFind, $strReplace, $strValidate);
                    if (!empty($strLabel))
                        $strValidate = '<b style="color: #9A0000;">' . $strLabel . ':</b> ' . $strValidate;
                    if ($strTypeValidateMessage == 'fieldset_group')
                        $arrValidateMessageGroup[] = $strValidate;
                    else
                        $arrValidateMessageSingle[$strLabel] = $strValidate;
                }
            }
        }
        if ($booReturn === true)
            return array($mixMessage, $arrValidateMessageGroup, $arrValidateMessageSingle);
        $this->addMessageGeneric($mixMessage, self::VALIDATE_TYPE, self::VALIDATE_LEGEND, self::VALIDATE_COLOR);
        if (count($arrValidateMessageGroup) > 0)
            $this->addMessageGeneric($arrValidateMessageGroup, self::VALIDATE_GROUP_TYPE, self::VALIDATE_GROUP_LEGEND, self::VALIDATE_GROUP_COLOR);
        foreach ($arrValidateMessageSingle as $strLabel => $strMessage)
            $this->addMessageGeneric($strMessage, 'Validate ' . $strLabel, self::VALIDATE_LEGEND, self::VALIDATE_COLOR);
    }

    public function getMessageCollection($booCurrent = false)
    {
        $arrMessage = array();
        $strMethodHas = ($booCurrent) ? 'hasCurrentMessages' : 'hasMessages';
        $strMethodGet = ($booCurrent) ? 'getCurrentMessages' : 'getMessages';
        if ($this->getFlashMessanger()->$strMethodHas()) {
            $arrMessage = (array) $this->getFlashMessanger()->$strMethodGet();
            if (isset($arrMessage[0]))
                $arrMessage = $arrMessage[0];
        }
        return $arrMessage;
    }

    public function refreshMessageCollection()
    {
        $arrMessage = $this->getMessageCollection(false);
        if ((is_array($arrMessage)) && (count($arrMessage) > 0)) {
            $arrTypeMessage = array(self::SUCCESS_TYPE, self::ERROR_TYPE, self::WARNING_TYPE, self::NOTICE_TYPE, self::VALIDATE_TYPE);
            foreach ($arrTypeMessage as $strTypeMessage) {
                $strMethodMessage = 'addMessage' . $strTypeMessage;
                if (array_key_exists($strTypeMessage, $arrMessage))
                    $this->$strMethodMessage($arrMessage[$strTypeMessage]['arrMessage']);
            }
            return true;
        }
        return false;
    }

    private function addMessageGeneric($mixMessage, $strType = null, $strLegend = null, $strColor = null)
    {
        if (!is_array($mixMessage))
            $mixMessage = array($mixMessage);
        $arrMessage = $this->getMessageCollection(true);
        $this->getFlashMessanger()->clearCurrentMessages();
        if (empty($strType))
            $strType = self::GENERAL_TYPE;
        $arrMessage[$strType]['strLegend'] = $strLegend;
        $arrMessage[$strType]['strColor'] = $strColor;
        foreach ($mixMessage as $strMessage) {
            if ((@is_array($arrMessage[$strType]['arrMessage'])) && (in_array($strMessage, $arrMessage[$strType]['arrMessage'])))
                continue;
            $arrMessage[$strType]['arrMessage'][] = $strMessage;
        }
        $this->getFlashMessanger()->addMessage($arrMessage);
    }

}
