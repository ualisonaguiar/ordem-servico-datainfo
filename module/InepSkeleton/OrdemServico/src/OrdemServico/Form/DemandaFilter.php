<?php

namespace OrdemServico\Form;

use InepZend\Filter\Filter;

class DemandaFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsFilter': {
                    $this->addFilterDate(array('dt_abertura'));
                    $this->addFilter(array('id_catalogo_servico'));
                    $this->addFilterSelect(array('id_usuario'));
                    $this->addFilterSelect(array('no_demanda'));
                    $this->addFilterSelect(array('in_situacao'));
                    break;
                }
            case 'prepareElements': {
                    $this->addFilter(array('name' => 'id_atividade'));
                    $this->addFilter(array('name' => 'id_demanda'));
                    $this->addFilter(array('name' => 'id_ordem_servico'));
                    $this->addFilter(array('name' => 'id_ordem_servico_encerrada'));
                    $this->addFilterDate(array('dt_abertura', 'required' => true));
                    $this->addFilter(array('no_demanda', 'required' => true));
                    $this->addFilterSelect(array('id_catalogo_servico_atividade'));
                    $this->addFilterSelect(array('id_usuario', 'required' => true));
                    $this->addFilter(array('ds_descricao', 'required' => true));
                    $this->addFilter(array('no_projeto'));
                    $this->addFilter(array('ds_ambiente'));
                    $this->addFilterEditor(array('ds_descricao', 'required' => true));
                    $this->addFilterEditor(array('ds_solucao'));
                    $this->addFilterSelect(array('vl_complexidade'));
                    break;
                }
        }
    }

}
