<?php

namespace InepZend\Module\TrocaArquivo\ResponsavelEnvio\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\TrocaArquivo\ResponsavelEnvio\Form\ResponsavelEnvioFilter;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;
use InepZend\Module\TrocaArquivo\Common\Form\CommonTrait;

class ResponsavelEnvio extends FormGenerator
{

    use CommonTrait;

    public function prepareElementsFilter()
    {
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Filtros da Pesquisa</h3>');
        $this->setAttribute('onsubmit', 'javascript:filterPaginator("/responsavelenvio/ajaxPaginator"); return false;');
        $this->addSelect(array('name' => 'co_projeto', 'label' => 'Projeto', 'value_options' => $this->getListProjeto(), 'empty_option' => 'Selecione'));
        $this->addUf(array('name' => 'sg_uf', 'method_value' => 'getSgUf', 'method_text' => 'getSgUf', 'br' => true));
        $this->addButtonSearch('filterPaginator(\'/responsavelenvio/ajaxPaginator\');');
        $this->addButtonClear();
        $this->addHtml('</div>');
        $flexigrid = new FlexigridHelper();
        $flexigrid->setRoute('responsavelenvio');
        $flexigrid->setSortName('id_responsavel');
        $flexigrid->setSortOrder('desc');
        $flexigrid->setShowDelete(false);
        $flexigrid->setColUpdate(true);
        $flexigrid->setCol('id_usuario_sistema', 'Usuário Sistema', 400, 'left', false);
        $flexigrid->setCol('co_projeto', 'Projeto', 200, 'left', false);
        $flexigrid->setCol('sg_uf', 'UF', 200, 'left', false);
        $this->addHtml($flexigrid->showGrid());
        $this->setInputFilter(new ResponsavelEnvioFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElements()
    {
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Informações de um responsável pelo envio dos dados</h3>');
        $this->addHidden(array('name' => 'id_responsavel'));
        $this->addSelect(array('name' => 'id_usuario_sistema', 'label' => 'Usuário Sistema', 'value_options' => $this->listUsuarioSistema(), 'empty_option' => 'Selecione', 'required' => true));
        $this->addSelect(array('name' => 'co_projeto', 'label' => 'Projeto', 'value_options' => $this->getListProjeto(), 'empty_option' => 'Selecione', 'required' => true));
        $this->addUf(array('name' => 'sg_uf', 'method_value' => 'getSgUf', 'method_text' => 'getSgUf', 'br' => true, 'required' => true));
        $this->addHtml('</div>');
        $this->addButtonSave();
        $this->addButtonBack('responsavelenvio');
        $this->setInputFilter(new ResponsavelEnvioFilter(__FUNCTION__));
        return $this;
    }

    private function listUsuarioSistema()
    {
        return $this->getService('InepZend\Module\Ssi\Service\VwUsuario')->fetchPairs(array('idSistema' => $this->getSystem()->id));
    }

}
