<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular o Element Text para Form.
 */
trait FormCrud
{

    /**
     * Metodo responsavel em adicionar um Form para CRUD.
     * 
     * @example $this->addFormCrud('teste', $this->inputs(), $this->buttons());
     * 
     * @param string $strLabel
     * @param array $arrElementForm
     * @param array $arrButton
     * @param string $strGroupClass
     * @param string $strGroupStyle
     * @param string $strButtonStyle
     * @return mix
     */
    public function addFormCrud($strLabel = null, array $arrElementForm, array $arrButton = null, $arrParam = array(), $strGroupClass = null, $strGroupStyle = null, $strButtonStyle = null)
    {
        if (is_null($strGroupClass))
            $strGroupClass = 'well';
        $this->addHtml('<script type="text/javascript">$(document).ready(function () {include_once("/vendor/InepZend/js/form-generator.js" + strGlobalSufixJsGzip);});</script>');
        $this->addGroup($arrParam, $arrElementForm, $strLabel, $strGroupClass, $strGroupStyle);
        $this->addHtml('<div style="overflow: hidden; margin-bottom: 20px; min-height: 20px; padding-right: 10px;' . $strButtonStyle . '">');
        foreach ($arrButton as $arrDataButton) {
            $strMethod = 'add' . $arrDataButton['type'];
            unset($arrDataButton['type']);
            $this->$strMethod($arrDataButton);
        }
        $this->addHtml('</div>');
        return $this;
    }

}
