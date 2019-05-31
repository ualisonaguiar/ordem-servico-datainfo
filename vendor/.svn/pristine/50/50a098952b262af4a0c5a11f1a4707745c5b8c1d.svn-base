<?php

namespace InepZend\Module\Ssi\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\Ssi\Form\AcaoAclRouteFilter;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;

class AcaoAclRoute extends FormGenerator
{

    public function prepareElements($arrTree = null)
    {
        $this->addHidden(array('name' => 'from'));
        $this->addHtml('
        <div class="caixaVazada">
            <h2>Controle de Acesso > Rotas</h2>
            <div class="caixaVazada">
                <h3 class="h-form">Administração</h3>');
        $this->addSelect(array('name' => 'ds_module', 'label' => 'Módulo do sistema', 'placeholder' => 'Selecione', 'empty_option' => 'Selecione', 'required' => true, 'value_options' => $this->listModule(), 'onchange' => 'feedSelect(\'ds_module\', \'ds_controller\', \'/ssi-acl-route/ajaxFetchPairs\', undefined, true);'));
        $this->addSelect(array('name' => 'ds_controller', 'label' => 'Classes de Controller do módulo do sistema', 'placeholder' => 'Selecione', 'empty_option' => 'Selecione', 'required' => true, 'onchange' => 'feedSelect(\'ds_controller\', \'ds_action\', \'/ssi-acl-route/ajaxFetchPairs\', undefined, true);'));
        $this->addSelect(array('name' => 'ds_action', 'label' => 'Actions da classe de Controller', 'placeholder' => 'Selecione', 'empty_option' => 'Selecione', 'required' => true, 'onchange' => 'renderForm(this, \'ssi-acl-route\');'));
        $arrListProfile = $this->getService('InepZend\Module\Ssi\Service\VwPerfil')->fetchPairs(array('idSistema' => $this->getSystem()->id, 'inAtivoPerfil' => true), 'getNoPerfil', 'getNoPerfil', array('noPerfil' => 'asc'));
        $this->addSelect(array('name' => 'no_perfil', 'label' => 'Perfil do SSI', 'empty_option' => 'Selecione', 'required' => true, 'value_options' => $arrListProfile));
        $this->addHtml('<div id="divRenderForm"></div>');
        $this->addButton(array('name' => 'btnSalvarForm', 'title' => 'Salvar/atualizar as informações e gerar a estrutura formatada do controle de acesso às rotas de navegação do sistema', 'onclick' => 'return saveData(\'Form\');', 'value' => 'Salvar/Atualizar'));
        $this->addButtonRoute(array('name' => 'btnVisualizar', 'title' => 'Visualizar todo o controle de acesso às rotas de navegação registradas no SSI', 'route' => 'ssi-acl-route/show', 'value' => 'Visualizar controles de Rotas no SSI'));
        $this->addHtml('
            </div>
            <div class="caixaVazada" style="margin-top: 10px;">
                <h3 class="h-form">Estrutura formatada</h3>');
        $this->addTextarea(array('name' => 'ds_tree', 'placeholder' => 'Estrutura formatada', 'style' => 'margin-top: -10px; height: 350px;'));
        $this->addButton(array('name' => 'btnSalvarEstrutura', 'title' => 'Salvar/atualizar as informações da estrutura formatada do controle de acesso às rotas de navegação do sistema', 'onclick' => 'return saveData(\'Estrutura\');', 'value' => 'Salvar/Atualizar'));
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
        $flexigrid->setButton('Download do arquivo de controle de acesso às rotas de navegação das funcionalidades dos módulos do sistema', 'fa fa-users', 'downloadConfigureSsiProfile', null, true);
        $this->addHtml($flexigrid->showGrid());
        $this->addHtml('
            </div>
        </div>');
        $this->setInputFilter(new AcaoAclRouteFilter('index'));
        return $this;
    }

    public function prepareElementsShow()
    {
        $this->addHtml('
        <div class="caixaVazada">
            <h2>Controle de acesso às rotas de navegação</h2>
            <div class="caixaVazada">
                <h3 class="h-form">Módulo > Controller > Action > Rota</h3>');
        $this->addButtonBack('ssi-acl-route');
        $this->addHtml($this->getService('InepZend\Module\Ssi\Service\AcaoAclRoute')->renderTree());
        $this->addButtonBack('ssi-acl-route');
        $this->addHtml('
            </div>
        </div>');
        $this->setInputFilter(new AcaoAclRouteFilter('show'));
        return $this;
    }

    private function listModule()
    {
        $arrModule = array();
        $arrTree = $this->getService('InepZend\Module\Ssi\Service\AcaoAclRoute')->getTree();
        foreach ($arrTree as $strModule => $arrController)
            $arrModule[$strModule] = $strModule;
        return $arrModule;
    }

}
