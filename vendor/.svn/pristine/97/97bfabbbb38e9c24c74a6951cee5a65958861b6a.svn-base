<?php

namespace InepZend\Message\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\Message\Message;

class MessageHelper extends AbstractHelper
{

    /**
     * 
     * @param boolean $booShowContainer
     * @param boolean $booPrefix
     * @return string
     */
    public function showMessage($booShowContainer = null, $booPrefix = null)
    {
        $arrMessage = (new Message())->getMessageCollection();
        if (self::isThemeAdministrativeResponsible())
            return $this->showMessageAdministrativeResponsible($arrMessage, (!is_bool($booPrefix)) ? false : $booPrefix);
        else
            return $this->showMessageAdministrative($arrMessage, (!is_bool($booShowContainer)) ? true : $booShowContainer);
    }

    /**
     * 
     * @param array $arrMessage
     * @param bool $booShowContainer
     * @return string
     */
    protected function showMessageAdministrative($arrMessage, $booShowContainer = null)
    {
        $strResult = ($booShowContainer) ? '<div id="messageContainer">' : '';
        foreach ($arrMessage as $arrTypeInfo) {
            $strResult .=
                    '<div class="messageBackground caixaVazada">
                    <div class="messageLabel" style="color:' . $arrTypeInfo['strColor'] . '">' . $arrTypeInfo['strLegend'] . '</div>';
            foreach ((array) $arrTypeInfo['arrMessage'] as $strMessage)
                $strResult .= '&raquo;&nbsp;' . $strMessage . '<br />';
            $strResult .= '</div>';
        }
        if ($booShowContainer)
            $strResult .= '</div>';
        return $strResult;
    }

    /**
     * 
     * @param array $arrMessage
     * @return string
     */
    protected function showMessageAdministrativeResponsible($arrMessage, $booPrefix = null)
    {
        $strResult = '';
        foreach ($arrMessage as $strTypeMessage => $arrTypeInfo) {
            $strPrefixMessage = '';
            if ($booPrefix === true) {
                $strHtmlStart = '<p style="font-weight: bold;">';
                $strHtmlEnd = '</p> ';
                switch ($strTypeMessage) {
                    case Message::SUCCESS_TYPE:
                        $strPrefixMessage = $strHtmlStart . 'Bem feito!' . $strHtmlEnd;
                        break;
                    case Message::ERROR_TYPE:
                        $strPrefixMessage = $strHtmlStart . 'Oh não!' . $strHtmlEnd;
                        break;
                    case Message::WARNING_TYPE:
                        $strPrefixMessage = $strHtmlStart . 'Atenção!' . $strHtmlEnd;
                        break;
                    case Message::NOTICE_TYPE:
                        $strPrefixMessage = $strHtmlStart . 'Fique atento!' . $strHtmlEnd;
                        break;
                }
            }
            $strResult .= '<div class="alert alert-' . strtolower($strTypeMessage) . ' alert-dismissible"><button class="close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span><span class="sr-only">Fechar</span></button>' . $strPrefixMessage;
            foreach ((array) $arrTypeInfo['arrMessage'] as $strMessage)
                $strResult .= '<p>' . $strMessage . '</p>';
            $strResult .= '</div>';
        }
        return $strResult;
    }

}
