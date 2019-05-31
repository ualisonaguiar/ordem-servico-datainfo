<?php

namespace InepZend\FormGenerator\Add;

use InepZend\View\Helper\ButtonHelper;

/**
 * Trait responsavel em manipular o Element Button.
 */
trait Button
{

    /**
     * Metodo responsavel em adicionar o Element Button.
     * $strActionToResourceNotAllowed eh o parametro que ao ser passado ele
     * bloqueia o botao de acordo com a ACL definida no SSI na qual contem um 
     * Resource ($strSource).
     * $strOnClick eh o parametro que recebe uma JS.
     * $strAccessKey eh o parametro responsavel em definir um Access Key para o
     * botao.
     * 
     * @example $this->addButton($strName, $strId, $strTitle, $strClass, $strStyle, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strAccessKey, $strSource, $strOnClick, $booInputImage, $strType, $strValue);
     * 
     * @param string $strName
     * @param string $strId
     * @param string $strTitle
     * @param string $strClass
     * @param string $strStyle
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strAccessKey
     * @param string $strSource
     * @param string $strOnClick
     * @param boolean $booInputImage
     * @param string $strType
     * @param string $strValue
     * @return mix
     */
    public function addButton($strName = null, $strId = null, $strTitle = null, $strClass = null, $strStyle = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strAccessKey = null, $strSource = null, $strOnClick = null, $booInputImage = false, $strType = null, $strValue = null)
    {
        $arrParamExtra = array(
            array('accesskey', 'strAccessKey'),
            array('src', 'strSource'),
            array('onclick', 'strOnClick'),
            array('input_image', 'booInputImage'),
            array('type', 'strType'),
            array('value', 'strValue'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false, $this->removeParamDefault(array(1, 3, 4, 5, 9, 10, 11, 12, 13, 18, 19)));
        $arrParamValue = array(
            'name' => 'btn',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        if ($this->controllResource(@$arrParam['resource'], @$arrParam['action_to_resource_not_allowed']) === false)
            return false;
        if (@empty($arrParam['id']))
            $arrParam['id'] = $arrParam['name'];
        $strClass = @$arrParam['class'];
        $strClassButton = self::getHelperInstance()->getClassButton($strClass);
        if (@$arrParam['input_image'] === true) {
            $arrParam['class'] = $strClassButton;
            if (@empty($arrParam['onclick']))
                $arrParam['onclick'] = 'void(0);';
            unset($arrParam['input_image'], $arrParam['value'], $arrParam['type']);
            return $this->addInputImage($arrParam);
        }
        $strValue = @$arrParam['value'];
        $strTitle = @$arrParam['title'];
        if (!empty($strValue))
            $strClassButton = self::getHelperInstance()->getClassButton($strClass, null, true);
        elseif (((strpos($strClassButton, 'btn-inep') !== false) || (self::isThemeAdministrativeResponsible())) && (!empty($strTitle)))
            $strValue = $strTitle;
        if ($strClassButton == @$arrParam['style'])
            $arrParam['style'] = '';
        self::getHelperInstance()->editClassButton($strClassButton);
        $arrParam['class'] = $strClassButton;
        unset($arrParam['input_image'], $arrParam['value'], $arrParam['resource'], $arrParam['action_to_resource_not_allowed'], $arrParam['source']);
        return $this->addHtml(self::getHelperInstance()->render($strValue, $arrParam), null, false);
    }

    public function addButtonRoute($strName = null, $strId = null, $strTitle = null, $strClass = null, $strStyle = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strAccessKey = null, $strSource = null, $strRoute = null, $booInputImage = false, $strType = null, $strValue = null)
    {
        $arrParamExtra = array(
            array('accesskey', 'strAccessKey'),
            array('src', 'strSource'),
            array('route', 'strRoute'),
            array('input_image', 'booInputImage'),
            array('type', 'strType'),
            array('value', 'strValue'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false, $this->removeParamDefault(array(1, 3, 4, 5, 9, 10, 11, 12, 13, 18, 19)));
        $arrParam['onclick'] = $this->getJsLocation(@$arrParam['route']);
        unset($arrParam['route']);
        return $this->addButton($arrParam);
    }

    /**
     * Metodo responsavel em adicionar o Element Button responsavel em realizar
     * o retorno para uma rota.
     * 
     * @example $this->addButtonBack($strRoute, $booInputImage, $strClass, $strStyle, $strType, $strValue, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strAccessKey);
     * 
     * @param string $strRoute
     * @param boolean $booInputImage
     * @param string $strClass
     * @param string $strStyle
     * @param string $strType
     * @param string $strValue
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strAccessKey
     * @return mix
     */
    public function addButtonBack($strRoute = null, $booInputImage = false, $strClass = null, $strStyle = null, $strType = null, $strValue = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strAccessKey = null)
    {
        if (empty($strRoute))
            return;
        return $this->addButtonSpecific('Voltar', $this->getJsLocation($strRoute), $booInputImage, $strClass, $strStyle, $strType, $strValue, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strAccessKey);
    }

    /**
     * Metodo responsavel em adicionar o Element Button responsavel em submeter
     * o formulario.
     * 
     * $this->addButtonSave($strFormId, $booInputImage, $strClass, $strStyle, $strType, $strValue, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strAccessKey, $strOnClickExtra);
     * 
     * @param string $strFormId
     * @param boolean $booInputImage
     * @param string $strClass
     * @param string $strStyle
     * @param string $strType
     * @param string $strValue
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strAccessKey
     * @param string $strOnClickExtra
     * @param boolean $booWait
     * @return mix
     */
    public function addButtonSave($strFormId = null, $booInputImage = false, $strClass = null, $strStyle = null, $strType = null, $strValue = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strAccessKey = null, $strOnClickExtra = null, $booWait = null)
    {
        if (empty($strFormId))
            $strFormId = 'frm';
        if (empty($strType))
            $strType = 'submit';
        if ($booWait === true)
            $strOnClickExtra = 'if ($(getObject(\'' . $strFormId . '\')).valid()) {setTimeout(\'openWaitDialog();\', 100);} ' . $strOnClickExtra;
        return $this->addButtonSpecific('Salvar', $strOnClickExtra, $booInputImage, $strClass, $strStyle, $strType, $strValue, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strAccessKey);
    }

    /**
     * Metodo responsavel em adicionar o Element Button responsavel em limpar
     * os dados preenchidos no formulario.
     * 
     * @example $this->addButtonClear($strOnClick, $booInputImage, $strClass, $strStyle, $strType, $strValue, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strAccessKey);
     * 
     * @param string $strOnClick
     * @param boolean $booInputImage
     * @param string $strClass
     * @param string $strStyle
     * @param string $strType
     * @param string $strValue
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strAccessKey
     * @return mix
     */
    public function addButtonClear($strOnClick = null, $booInputImage = false, $strClass = null, $strStyle = null, $strType = null, $strValue = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strAccessKey = null)
    {
        if (empty($strOnClick))
            $strOnClick = 'clearValuesFromFieldsForm();';
        return $this->addButtonSpecific('Limpar', $strOnClick, $booInputImage, $strClass, $strStyle, $strType, $strValue, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strAccessKey);
    }

    /**
     * Metodo responsavel em adicionar o Element Button responsavel em pesquisar.
     * 
     * @example $this->addButtonSearch($strOnClick, $booInputImage, $strClass, $strStyle, $strType, $strValue, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strAccessKey);
     * 
     * @param string $strOnClick
     * @param boolean $booInputImage
     * @param string $strClass
     * @param string $strStyle
     * @param string $strType
     * @param string $strValue
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strAccessKey
     * @return mix
     */
    public function addButtonSearch($strOnClick = null, $booInputImage = false, $strClass = null, $strStyle = null, $strType = null, $strValue = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strAccessKey = null)
    {
        if (empty($strOnClick))
            $strOnClick = 'filterPaginator();';
        return $this->addButtonSpecific('Pesquisar', $strOnClick, $booInputImage, $strClass, $strStyle, $strType, $strValue, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strAccessKey);
    }

    /**
     * Metodo responsavel em adicionar o Element Button especifico para um form,
     * podendo ser esse customizado conforme o primeiro parametro ($strButtonSpecific).
     * 
     * @example addButtonSpecific($strButtonSpecific, $strOnClick, $booInputImage, $strClass, $strStyle, $strType, $strValue, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strAccessKey);
     * 
     * @param string $strButtonSpecific
     * @param string $strOnClick
     * @param type $booInputImage
     * @param string $strClass
     * @param string $strStyle
     * @param string $strType
     * @param string $strValue
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strAccessKey
     * @return mix
     */
    private function addButtonSpecific($strButtonSpecific = null, $strOnClick = null, $booInputImage = false, $strClass = null, $strStyle = null, $strType = null, $strValue = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strAccessKey = null)
    {
        if (empty($strButtonSpecific))
            return null;
        if (empty($strOnClick))
            $strOnClick = 'void(0);';
        if ($this->controllResource($strResource, $strActionToResourceNotAllowed) === false)
            return false;
        $strTitle = (!empty($strValue)) ? $strValue : $strButtonSpecific;
        $strClassButton = self::getHelperInstance()->getClassButton($strClass, 'btn' . $strButtonSpecific);
        if ($booInputImage === true)
            return $this->addInputImage(array('name' => 'btn' . $strButtonSpecific, 'title' => $strTitle, 'class' => $strClassButton, 'style' => $strStyle, 'src' => $this->getBaseUrl() . '/vendor/InepZend/images/botoes/azul_claro/' . strtolower($strButtonSpecific) . '.jpg', 'onclick' => $strOnClick, 'resource' => $strResource, 'action_to_resource_not_allowed' => $strActionToResourceNotAllowed, 'tabindex' => $intTabindex, 'attr_data' => $arrAttributeData, 'accesskey' => $strAccessKey));
        if (empty($strType))
            $strType = 'button';
        if (!empty($strValue))
            $strClassButton = self::getHelperInstance()->getClassButton($strClass, null, true);
        elseif (in_array(strtolower($strButtonSpecific), array('voltar', 'salvar', 'limpar', 'pesquisar'))) {
            $strClassDefault = 'btn' . $strButtonSpecific;
            if (strpos($strClassDefault, 'btn-inep') === false)
                $strClassDefault .= ' btn-inep';
            $strClassButton = self::getHelperInstance()->getClassButton($strClass, trim($strClassDefault));
            $strValue = $strButtonSpecific;
        }
        self::getHelperInstance()->editClassButton($strClassButton);
        $strName = 'btn' . $strButtonSpecific;
        $strId = $strName;
        return $this->addHtml(self::getHelperInstance()->render($strValue, array('type' => $strType, 'id' => $strId, 'name' => $strName, 'class' => $strClassButton, 'style' => $strStyle, 'title' => $strTitle, 'onclick' => $strOnClick, 'tabindex' => $intTabindex, 'attr_data' => $arrAttributeData, 'accesskey' => $strAccessKey)), $strName, false);
    }

    /**
     * Metodo responsavel em retornar ButtonHelper.
     * 
     * @example self::getHelperInstance();
     * 
     * @return object
     */
    public static function getHelperInstance()
    {
        if (is_object($mixAttributeStaticValue = self::getAttributeStatic('singleHelperInstance')))
            return $mixAttributeStaticValue;
        $singleInstance = new ButtonHelper();
        self::setAttributeStatic('singleHelperInstance', $singleInstance);
        return $singleInstance;
    }

    private function getJsLocation($strRoute = null)
    {
        if (empty($strRoute))
            $strRoute = '#';
        if ($strRoute{0} == '/')
            $strRoute = substr($strRoute, 1);
        return 'window.location.href=strGlobalBasePath + \'/' . $strRoute . '\';';
    }

}
