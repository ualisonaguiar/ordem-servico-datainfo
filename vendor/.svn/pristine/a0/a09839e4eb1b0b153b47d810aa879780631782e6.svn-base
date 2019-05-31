<?php
namespace InepZend\Module\TrocaArquivo\IlhaDado\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\TrocaArquivo\IlhaDado\Form\IlhaDadoFilter;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;

class IlhaDado extends FormGenerator
{

    public function prepareElementsFilter()
    {
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Filtros da Pesquisa</h3>');
        $this->setAttribute('onsubmit', 'javascript:filterPaginator("/ilhadado/ajaxPaginator"); return false;');
        $this->addText(array(
            'name' => 'no_ilha_dado',
            'label' => 'Nome'
        ));
        $this->addButtonSearch('filterPaginator(\'/ilhadado/ajaxPaginator\');');
        $this->addButtonClear();
        $this->addHtml('</div>');
        $flexigrid = new FlexigridHelper();
        $flexigrid->setRoute('ilhadado');
        $flexigrid->setSortName('id_ilha_dado');
        $flexigrid->setSortOrder('desc');
        $flexigrid->setShowDelete(false);
        $flexigrid->setColUpdate(true);
        $flexigrid->setCol('no_ilha_dado', 'Nome', 400, 'left', false);
        $flexigrid->setCol('in_cache', 'Resultado Estático', 200, 'left', false);
        $this->addHtml($flexigrid->showGrid());
        $this->setInputFilter(new IlhaDadoFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElements()
    {
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Informações de uma ilha de dados</h3>');
        $this->addHidden(array(
            'name' => 'id_ilha_dado'
        ));
        $this->addText(array(
            'name' => 'no_ilha_dado',
            'label' => 'Nome',
            'required' => true
        ));
        $this->addTextarea(array(
            'name' => 'ds_consulta',
            'label' => 'Consulta',
            'style' => 'height: 300px;',
            'required' => true
        ));
        $this->addCheckbox(array(
            'name' => 'in_cache',
            'label' => 'Resultado Estático',
            'checked_value' => '1',
            'unchecked_value' => '0'
        ));
        $this->addButtonSave();
        $this->addButtonBack('ilhadado');
        $this->addHtml('</div>');
        $this->setInputFilter(new IlhaDadoFilter(__FUNCTION__));
        return $this;
    }
}
