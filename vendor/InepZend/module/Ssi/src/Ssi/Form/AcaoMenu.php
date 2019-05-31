<?php

namespace InepZend\Module\Ssi\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\Ssi\Form\AcaoMenuFilter;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;

class AcaoMenu extends FormGenerator
{

    public function prepareElements($arrTree = null)
    {
        $this->addHidden(array('name' => 'from'));
        $this->addHtml('
        <div class="caixaVazada">
            <h2>Árvore(s) de Menu</h2>
            <div class="caixaVazada">
                <h3 class="h-form">Árvore</h3>');
        $this->addHtml($this->getService('InepZend\Module\Ssi\Service\AcaoMenu')->renderTree($arrTree));
        $this->addButton(array('name' => 'btnSalvarArvore', 'title' => 'Salvar/atualizar as informações e gerar a estrutura formatada do menu a partir da árvore de itens', 'onclick' => 'return saveData(\'Arvore\');', 'value' => 'Salvar/Atualizar'));
        $this->addButtonRoute(array('name' => 'btnVisualizarPorPerfil', 'title' => 'Visualizar o menu registrado no SSI por perfil de usuário', 'route' => 'ssi-menu/show', 'value' => 'Visualizar por Perfil no SSI'));
        $this->addButton(array('name' => 'btnInsertAction', 'title' => 'Inserção de novas ações do menu principal da árvore de itens', 'value' => 'Inserir Ação'));
        $this->addHtml('
            </div>
            <div class="caixaVazada" style="margin-top: 10px;">
                <h3 class="h-form">Estrutura formatada</h3>');
        $this->addTextarea(array('name' => 'ds_tree', 'placeholder' => 'Estrutura formatada do menu', 'style' => 'margin-top: -10px; height: 350px;'));
        $this->addButton(array('name' => 'btnSalvarEstrutura', 'title' => 'Salvar/atualizar as informações e gerar a árvore de itens a partir da estrutura formatada do menu', 'onclick' => 'return saveData(\'Estrutura\');', 'value' => 'Salvar/Atualizar'));
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
        $flexigrid->setButton('Download do arquivo das ações criadas no formato do SSI-Web', 'fa fa-cloud-download', 'downloadConfigureSsiAcronym', null, true);
        $this->addHtml($flexigrid->showGrid());
        $this->addHtml('
            </div>
        </div>');
        $this->setInputFilter(new AcaoMenuFilter('index'));
        return $this;
    }

    public function prepareElementsShow()
    {
        $this->addHtml('
        <div class="caixaVazada">
            <h2>Árvore de Menu por Perfil</h2>
            <div class="caixaVazada">
                <h3 class="h-form">Escolha do Perfil</h3>');
        $this->addSelect(array('name' => 'id_perfil', 'label' => 'Perfil', 'placeholder' => 'Selecione', 'value_options' => $this->listPerfil(), 'empty_option' => 'Selecione', 'onchange' => 'renderTree(this, \'ssi-menu\');'));
        $this->addHtml('<div id="divTree"></div>');
        $this->addButtonBack('ssi-menu');
        $this->addHtml('
            </div>
        </div>');
        $this->setInputFilter(new AcaoMenuFilter('show'));
        return $this;
    }

    public function prepareElementsModal()
    {
        $this->setAttributes(array('name', 'frmModal', 'id' => 'frmModal'));
        $this->setViewValidate(true);
        $this->addHtml('
            <p>A definição de siglas nas ações de itens de menu do <b>SSI</b> deverá seguir os seguintes padrões:</p>
            <p>É definido na junção entre o prefixo do <b>"Nome"</b>, constituído por apenas consoantes em maiúsculos, agregado com o <b>"Nome da Rota"</b>.</p>
            <p><div class="caixaVazada" style="padding: 5px;"><b>Exemplo</b><br />(Nome Menu) + (Nome Rota01) = <b>NMMN__nomerota01</b></div></p>
            <p>Caso seja necessário ter subitens/submenu, deve-se informar, após a criação 
            do Menu <b>SEM</b>, o valor referente à Rota, onde será agregado no subitem o 
            prefixo do <b>"Nome Principal"</b> somado ao prefixo do <b>"Nome Secundário"</b> do 
            subitem e o <b>"Nome da Rota"</b>.</p>
            <p><div class="caixaVazada" style="padding: 5px;"><b>Exemplo</b><br />(Nome Principal) + (Nome Secundário) + (Nome Rota01) = <b>NMPRNCPL_NMSCNDR__nomerota01</b></div></p>');
        $this->addHidden(array('name' => 'level_tree'));
        $this->addHidden(array('name' => 'function_callback', 'required' => true));
        $this->addText(array('name' => 'no_acao', 'placeholder' => 'Nome', 'label' => 'Nome', 'maxlength' => 200, 'required' => true));
        $this->addText(array('name' => 'no_route', 'placeholder' => 'Rota', 'label' => 'Rota', 'maxlength' => 80));
        $this->addText(array('name' => 'sg_acao', 'placeholder' => 'Sigla', 'label' => 'Sigla', 'maxlength' => 80, 'disabled' => true));
        $this->addText(array('name' => 'ds_acao', 'placeholder' => 'Descrição', 'label' => 'Descrição', 'maxlength' => 80, 'required' => true));
        $this->addHtml('<div class="hide"><span class="span-nome"></span><span class="span-sg_acao"><span class="span-route"></span></div>');
        $this->addButton(array('name' => 'btnSalvar', 'class' => 'btn-inep', 'title' => 'Salvar'));
        $this->addButton(array('name' => 'btnCancelar', 'class' => 'btn-inep', 'title' => 'Cancelar'));
        $this->setInputFilter(new AcaoMenuFilter('keep-action'));
        return $this;
    }

    private function listPerfil()
    {
        return $this->listEntity('InepZend\Module\Ssi\Service\AcaoMenu', array(), null, null, array('no_perfil' => 'ASC'), null, null, 'fetchPairsPerfil');
    }

}
