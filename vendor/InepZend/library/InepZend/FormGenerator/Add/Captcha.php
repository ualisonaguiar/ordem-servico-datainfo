<?php

namespace InepZend\FormGenerator\Add;

use Zend\Captcha\Image;

/**
 * Trait responsavel em manipular o Element Captcha.
 */
trait Captcha
{

    /**
     * Metodo responsavel em adicionar o Element Captcha.
     * $strActionToResourceNotAllowed eh o parametro que ao ser passado ele
     * bloqueia o captha de acordo com a ACL definida no SSI na qual contem um 
     * Resource ($strSource).
     * 
     * @example $this->addCaptcha($strName, $strId, $strLabel, $booRequired, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $intWordLen);
     * 
     * @param string $strName
     * @param string $strId
     * @param string $strLabel
     * @param boolean $booRequired
     * @param string $strLabelClass
     * @param string $strLabelStyle
     * @param string $strHelpText
     * @param string $strTypeValidateMessage
     * @param string $strDisabled
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strGroupClass
     * @param string $strGroupStyle
     * @param integer $intWordLen
     * @return mix
     */
    public function addCaptcha($strName = null, $strId = null, $strLabel = null, $booRequired = false, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $intWordLen = null)
    {
        $arrParamExtra = array(
            array('word_len', 'intWordLen'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false, $this->removeParamDefault(array(1, 4, 6, 7, 8)));
        $arrParamValue = array(
            'name' => 'captcha',
            'label' => 'Captcha',
            'required' => true,
            'word_len' => 4,
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrAttribute = array(
            'type' => array('addGeneric', 'InepZend\FormGenerator\Element\Captcha'),
            'captcha' => array('addOption', new Image(self::getOptionAdapterCaptcha(@$arrParam['word_len']))),
        );
        return $this->getElementConfigured(array($arrParam), 1, $arrParamExtra, $arrAttribute, $this->addDefault(array($arrParam)));
    }

    /**
     * Metodo responsavel em retornar os options para o element Captcha na qual
     * exibe a imagens com seus devicos caracteres.
     * 
     * @example self::getOptionAdapterCaptcha($intWordLen);
     * 
     * @param integer $intWordLen
     * @return mix
     */
    private static function getOptionAdapterCaptcha($intWordLen = null)
    {
        $arrOptionAdapter = array(
            'imgDir' => './data/captcha',
            'imgUrl' => '/data/captcha',
            'font' => './vendor/InepZend/data/fonts/arial.ttf',
            'width' => 250,
            'height' => 100,
            'dotNoiseLevel' => 40,
            'lineNoiseLevel' => 3,
            'wordlen' => (empty($intWordLen)) ? 7 : $intWordLen,
            'messages' => array(
                'missingValue' => 'O valor do Captcha está vazio.',
                'badCaptcha' => 'O valor do Captcha está errado.',
            ),
        );
        if (!is_dir($arrOptionAdapter['imgDir']))
            mkdir($arrOptionAdapter['imgDir'], 0777, true);
        return $arrOptionAdapter;
    }

}
