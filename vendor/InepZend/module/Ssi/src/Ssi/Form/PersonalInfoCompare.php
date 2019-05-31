<?php

namespace InepZend\Module\Ssi\Form;

use InepZend\FormGenerator\FormGenerator;

class PersonalInfoCompare extends FormGenerator
{

    public function __construct()
    {
        parent::__construct($this->generateFormName(__CLASS__));
    }

    public function prepareElementsCompareInfo()
    {
        $arrColumns = array('' => 'no Sistema', 'receita' => 'na Receita Federal');
        $this->addHtml('<div class="row">');
        foreach ($arrColumns as $strNameColumn => $strColumn) {
            $this->addHtml('<div class="col-md-5">', 'col-md-5');
            $this->addHtml('<div class="span6">', 'span6');
            $this->addHtml('<fieldset style="border:0 none !important; margin-bottom: 15px; !important"><legend>Dados ' . $strColumn . '</legend></fieldset>');
            # Nome
            $this->addText(array('name' => 'no_pessoa_fisica' . $strNameColumn, 'label' => 'Nome:', 'disabled' => true));
            $this->addHtml('<br>');
            # Nome da mae
            $this->addText(array('name' => 'no_mae' . $strNameColumn, 'label' => 'Nome da mãe:', 'disabled' => true));
            $this->addHtml('<br>');
            # Sexo
            $this->addSexo(array('name' => 'tp_sexo' . $strNameColumn, 'disabled' => true));
            $this->addHtml('<br>');
            # Data de nascimento
            $this->addDate(array('name' => 'dt_nascimento' . $strNameColumn, 'label' => 'Data de nascimento:', 'disabled' => true));
            $this->addHtml('</div>', 'span6');
            $this->addHtml('</div>', 'col-md-5');
        }
        $this->addHtml('</div>');
        $this->addHtml('<div class="pull-right">');
        $this->addButton(array('name' => 'btnAtualizar', 'title' => 'Atualizar', 'value' => 'Atualizar', 'style' => 'margin-left: 10px;'));
        $this->addButton(array('name' => 'btnCancelar', 'title' => 'Cancelar', 'value' => 'Cancelar'));
        $this->addHtml('</div>');
    }

}
