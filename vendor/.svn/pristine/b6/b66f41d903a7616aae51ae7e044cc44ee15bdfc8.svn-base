<?php

namespace InepZend\Module\Ssi\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\Ssi\Form\AcaoAclFormElementFilter;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;

class AcaoAclFormElement extends FormGenerator
{

    public function prepareElements($arrTree = null)
    {
        $this->addHidden(array('name' => 'from'));
        $this->addHtml('
        <div class="caixaVazada">
            <h2>Controle de Acesso > Elementos de Formulário</h2>
            <div class="caixaVazada">
                <h3 class="h-form">Administração</h3>');
        $this->addSelect(array('name' => 'ds_module', 'label' => 'Módulo do sistema', 'placeholder' => 'Selecione', 'empty_option' => 'Selecione', 'required' => true, 'value_options' => $this->listModule(), 'onchange' => 'feedSelect(\'ds_module\', \'ds_form\', \'/ssi-acl-form-element/ajaxFetchPairs\', undefined, true);'));
        $this->addSelect(array('name' => 'ds_form', 'label' => 'Classes de Formulário do módulo do sistema', 'placeholder' => 'Selecione', 'empty_option' => 'Selecione', 'required' => true, 'onchange' => 'feedSelect(\'ds_form\', \'ds_prepare_elements\', \'/ssi-acl-form-element/ajaxFetchPairs\', undefined, true);'));
        $this->addSelect(array('name' => 'ds_prepare_elements', 'label' => 'Método prepareElements da classe de Formulário', 'placeholder' => 'Selecione', 'empty_option' => 'Selecione', 'required' => true, 'onchange' => 'renderForm(this, \'ssi-acl-form-element\');'));
        $this->addHtml('<div id="divRenderForm"></div>');
        $this->addButton(array('name' => 'btnSalvarForm', 'title' => 'Salvar/atualizar as informações e gerar a estrutura formatada do controle de acesso aos elementos de formulário', 'onclick' => 'return saveData(\'Form\');', 'value' => 'Salvar/Atualizar'));
        $this->addButtonRoute(array('name' => 'btnVisualizar', 'title' => 'Visualizar todo o controle de acesso aos elementos de formulário registrados no SSI', 'route' => 'ssi-acl-form-element/show', 'value' => 'Visualizar controles de Elementos de Formulário no SSI'));
        $this->addHtml('
            </div>
            <div class="caixaVazada" style="margin-top: 10px;">
                <h3 class="h-form">Estrutura formatada</h3>');
        $this->addTextarea(array('name' => 'ds_tree', 'placeholder' => 'Estrutura formatada', 'style' => 'margin-top: -10px; height: 350px;'));
        $this->addButton(array('name' => 'btnSalvarEstrutura', 'title' => 'Salvar/atualizar as informações da estrutura formatada do controle de acesso aos elementos de formulário do sistema', 'onclick' => 'return saveData(\'Estrutura\');', 'value' => 'Salvar/Atualizar'));
        $this->addHtml('
            </div>
            <div class="caixaVazada" style="margin-top: 10px;">
                <h3 class="h-form">Histórico de alterações</h3>');
        $flexigrid = new FlexigridHelper();
        $flexigrid->setSortName('no_file');
        $flexigrid->setSortOrder('desc');
        $flexigrid->setHeight(200);
        $flexigrid->setCol('no_file', 'Arquivo', 275);
        $flexigrid->setCol('ds_path', 'Caminho', 400, 'left', false);
        $flexigrid->setCol('ds_size', 'Tamanho', 120, 'center', false);
        $flexigrid->setCol('dt_create', 'Criação', 160, 'center', false);
        $this->addHtml($flexigrid->showGrid());
        $this->addHtml('
            </div>
        </div>');
        $this->setInputFilter(new AcaoAclFormElementFilter('index'));
        return $this;
    }

    public function prepareElementsShow()
    {
        $this->addHtml('
        <div class="caixaVazada">
            <h2>Controle de acesso aos elementos de formulário</h2>
            <div class="caixaVazada">
                <h3 class="h-form">Módulo > Formulário > Método (prepareElements) > Elemento</h3>');
        $this->addButtonBack('ssi-acl-form-element');
        $this->addHtml($this->getService('InepZend\Module\Ssi\Service\AcaoAclFormElement')->renderTree());
        $this->addButtonBack('ssi-acl-form-element');
        $this->addHtml('
            </div>
        </div>');
        $this->setInputFilter(new AcaoAclFormElementFilter('show'));
        return $this;
    }

    private function listModule()
    {
        $arrModule = array();
        $arrTree = $this->getService('InepZend\Module\Ssi\Service\AcaoAclFormElement')->getTree();
        foreach ($arrTree as $strModule => $arrForm)
            $arrModule[$strModule] = $strModule;
        return $arrModule;
    }

}
