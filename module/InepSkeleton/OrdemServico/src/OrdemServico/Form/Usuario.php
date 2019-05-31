<?php

namespace OrdemServico\Form;

use InepZend\FormGenerator\FormGenerator;
use OrdemServico\Entity\Usuario as UsuarioEntity;

class Usuario extends FormGenerator
{
    public function prepareElementsFilter()
    {
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Filtros da Pesquisa</h3>');
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate')
            ->setAttribute('data-ng-submit', 'findByPaged();');
        $this->addText(array('name' => 'no_usuario', 'style' => 'width: 500px;', 'label' => 'Nome do Usuário', 'placeholder' => 'Nome do Usuário', 'maxlength' => 300, 'attr_data' => array('ng-model' => 'data.no_usuario')));
        $this->addPisPasep(['name' => 'nu_pis', 'label' => 'PIS', 'placeholder' => 'PIS do Usuário', 'attr_data' => array('ng-model' => 'data.nu_pis')]);
        $this->addSelect(
            array(
                'name' => 'tp_vinculo',
                'label' => 'Tipo Vínculo',
                'value_options' => UsuarioEntity::$arrPerfilUsuario,
                'empty_option' => 'Selecione',
                'attr_data' => array('ng-model' => 'data.tp_vinculo'),
                'style' => 'width: 300px; float: left;',
            )
        );
        $this->addButton(array('name' => 'btnPesquisar', 'style' => 'margin-top: 20px;', 'value' => 'Pesquisar', 'type' => 'submit'));
        $this->addButton(array('name' => 'btnLimpar', 'style' => 'margin-top: 20px;', 'value' => 'Limpar', 'type' => 'button', 'attr_data' => array('ng-click' => 'clearData();')));
        $this->addButton(array('name' => 'btnIncluir', 'style' => 'margin-top: 20px;', 'value' => 'Incluir', 'type' => 'button', 'attr_data' => array('ng-click' => 'locationHref(\'/usuario/add\');')));
        $this->addHtml('</div><div id="gridUsuario" style="display: none;" ui-grid="gripOptions" ui-grid-pagination ui-grid-auto-resize></div>');
        $this->addHtml('<div id="modalVinculo"></div>');
        $this->setInputFilter(new UsuarioFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElements()
    {
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Informações de uma atividade</h3>');
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate')
            ->setAttribute('data-ng-submit', 'save();');
        $this->addHidden(array('name' => 'id_usuario', 'required' => true, 'attr_data' => array('ng-model' => 'data.id_usuario')));
        $this->addText(array('name' => 'no_usuario', 'label' => 'Nome', 'placeholder' => 'Nome do Usuário', 'maxlength' => 300, 'required' => true, 'attr_data' => array('ng-model' => 'data.no_usuario')));
        $this->addPisPasep(['name' => 'nu_pis', 'label' => 'PIS', 'placeholder' => 'PIS do Usuário', 'attr_data' => array('ng-model' => 'data.nu_pis')]);
        $this->addEmail(['name' => 'ds_email', 'label' => 'E-mail', 'placeholder' => 'E-mail do Usuário', 'required' => true, 'attr_data' => array('ng-model' => 'data.ds_email')]);
        $this->addText(array('name' => 'ds_login', 'label' => 'Login', 'placeholder' => 'Login do Usuário', 'maxlength' => 100, 'required' => true, 'attr_data' => array('ng-model' => 'data.ds_login')));
        $this->addPassword([
            'name' => 'ds_senha',
            'label' => 'Senha',
            'placeholder' => 'Senha do Usuário',
            'maxlength' => 32,
            'attr_data' => ['ng-model' => 'data.ds_senha'],
            'required' => false
        ]);
        $this->addRadio(array(
            'name' => 'tp_vinculo',
            'label' => 'Tipo Vínculo',
            'value_options' => UsuarioEntity::$arrPerfilUsuario,
            'value' => UsuarioEntity::CO_PERFIL_FUNCIONARIO,
            'attr_data' => array('ng-model' => 'data.tp_vinculo')
        ));
        $this->addButton(array('name' => 'btnSalvar', 'value' => 'Salvar', 'type' => 'submit'));
        $this->addButton(array('name' => 'btnVoltar', 'value' => 'Voltar', 'type' => 'button', 'attr_data' => array('ng-click' => 'locationHref(\'/usuario\');')));
        $this->addHtml('</div>');
        $this->setInputFilter(new UsuarioFilter(__FUNCTION__));
        return $this;
    }
}
