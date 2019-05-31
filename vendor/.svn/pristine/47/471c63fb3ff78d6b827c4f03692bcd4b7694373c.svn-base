<?php
namespace InepZend\Module\TrocaArquivo\LayoutValidacao\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\TrocaArquivo\LayoutValidacao\Form\RegraValidacaoFilter;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;
use InepZend\Exception\DomainException;

class RegraValidacao extends FormGenerator
{

    public function prepareElementsFilter($intIdLayout = null)
    {
        $this->addTable(array(
            'name' => 'layout',
            'label' => 'Layout de Validação',
            'title' => array(
                'Nome do Layout' => array(
                    'no_layout',
                    'width: 10%;'
                ),
                'Caminho' => array(
                    'ds_caminho',
                    'width: 25%;'
                ),
                'URL' => array(
                    'ds_url',
                    'width: 25%;'
                ),
                'Encode' => array(
                    'ds_encode',
                    'width: 10%;'
                ),
                'Table' => 'ds_table',
                'Status' => array(
                    'no_status_layout',
                    'width: 11%;'
                )
            ),
            'show_no_register' => true
        ));
        $this->addHtml('<div style="overflow: hidden; padding-bottom: 20px;">');
        $this->addButtonBack('layoutfile');
        $this->addHtml('</div>');
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Regra(s) de validação existente(s)</h3>');
        $flexigrid = new FlexigridHelper();
        $flexigrid->setUrlPaging('/regravalidacao/ajaxPaginator/' . $intIdLayout);
        $flexigrid->setUrlInsert('/regravalidacao/add/' . $intIdLayout);
        $flexigrid->setUrlUpdate('/regravalidacao/edit/' . $intIdLayout);
        $flexigrid->setSortName('id_regra_validacao');
        $flexigrid->setSortOrder('desc');
        $flexigrid->setColUpdate(true);
        $flexigrid->setCol('no_ilha_dado', 'Nome da Ilha de Dados', 350, 'left', false);
        $flexigrid->setCol('ds_coluna', 'Coluna(s)', 600, 'left', false);
        $flexigrid->setCol('in_existente_ilha_dado', 'Existente na Ilha', 140, 'center', false);
        $flexigrid->setCol('in_ativo', 'Ativo', 70, 'center', false);
        $this->addHtml($flexigrid->showGrid());
        $this->addHtml('</div>');
        return $this;
    }

    public function prepareElements($intIdLayout = null, $intIdRegraValidacao = null)
    {
        $this->setAttribute('action', $this->getBaseUrl() . '/regravalidacao/' . ((empty($intIdRegraValidacao)) ? 'add' : 'edit') . '/' . $intIdLayout . ((empty($intIdRegraValidacao)) ? '' : '/' . $intIdRegraValidacao));
        $this->addTable(array(
            'name' => 'layout',
            'label' => 'Layout de Validação',
            'title' => array(
                'Nome do Layout' => array(
                    'no_layout',
                    'width: 10%;'
                ),
                'Caminho' => array(
                    'ds_caminho',
                    'width: 25%;'
                ),
                'URL' => array(
                    'ds_url',
                    'width: 25%;'
                ),
                'Encode' => array(
                    'ds_encode',
                    'width: 10%;'
                ),
                'Table' => 'ds_table',
                'Status' => array(
                    'no_status_layout',
                    'width: 11%;'
                )
            ),
            'show_no_register' => true
        ));
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Informações de uma regra de validação</h3>');
        $this->addHidden(array(
            'name' => 'id_regra_validacao'
        ));
        $this->addHidden(array(
            'name' => 'id_layout',
            'value' => $intIdLayout
        ));
        $this->addSelect(array(
            'name' => 'id_ilha_dado',
            'label' => 'Ilha de Dados em Cache',
            'required' => true,
            'empty_option' => 'Selecione',
            'value_options' => $this->listIlhaDado(),
            'group_style' => 'float: left; width: 80%;'
        ));
        $this->addCheckbox(array(
            'name' => 'in_existente_ilha_dado',
            'label' => 'Existente na Ilha de Dados',
            'value' => '1',
            'checked_value' => '1',
            'unchecked_value' => '0',
            'group_style' => 'height: 79px;'
        ));
        $this->addTextarea(array(
            'name' => 'ds_coluna',
            'label' => 'Colunas separadas por vírgula',
            'required' => true
        ));
        $this->addCheckbox(array(
            'name' => 'in_ativo',
            'label' => 'Ativo',
            'value' => '1',
            'checked_value' => '1',
            'unchecked_value' => '0'
        ));
        $this->addButtonSave();
        $this->addButtonBack('/regravalidacao/index/' . $intIdLayout);
        $this->addHtml('</div>');
        $this->setInputFilter(new RegraValidacaoFilter(__FUNCTION__));
        return $this;
    }

    private function listIlhaDado()
    {
        $arrIlhaDado = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\IlhaDadoFile')->fetchPairs(array(), 'getIdIlhaDado', 'getNoIlhaDado');
        if (empty($arrIlhaDado))
            throw new DomainException('Não existe alguma Ilha de Dados cadastrada.');
        return $arrIlhaDado;
    }
}
