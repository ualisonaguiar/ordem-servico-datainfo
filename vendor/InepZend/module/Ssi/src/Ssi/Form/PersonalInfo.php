<?php

namespace InepZend\Module\Ssi\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\Ssi\Form\PersonalInfoFilter;

class PersonalInfo extends FormGenerator
{

    public function prepareElementsEditMyInfo()
    {
        $this->addHtml('<div class="caixaVazada"><h2>Atualizar meus dados</h2>');
        $arrNotShow = array(
            'nu_rg' => true,
            'co_orgao_emissor' => true,
            'co_uf_rg' => true,
            'co_estado_civil' => true,
            'co_cor_raca' => true,
            'tp_nacionalidade' => true,
            'co_pais_origem' => true,
            'co_uf_nascimento' => true,
            'co_municipio_nascimento' => true,
        );
        $arrElement = array(
            'nu_cpf' => true,
            'no_pessoa_fisica' => true,
            'no_mae' => true,
            'dt_nascimento' => true,
            'tp_sexo' => true,
        );
        $this->addDadoPessoal(array(
            'not_show' => $arrNotShow,
            'readonly' => $arrElement,
            'required' => $arrElement,
        ));
        $this->addEmailCrud();
        $this->addPhoneCrud();
        $this->addButtonSave();
        $this->addButton(array('title' => 'Sincronizar com Receita Federal', 'onclick' => 'updateDataPersonal();'));
        $this->addHtml('</div>');
        $this->setInputFilter(new PersonalInfoFilter());
    }

}
