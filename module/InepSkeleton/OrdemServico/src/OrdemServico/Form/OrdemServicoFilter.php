<?php

namespace OrdemServico\Form;

use InepZend\Filter\Filter;

class OrdemServicoFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsFilter': {
                    $this->addFilter(array('name' => 'nu_ordem_servico'));
                    $this->addFilterSelect(array('name' => 'tp_situacao'));
                    $this->addFilter(array('name' => 'tp_impressao', 'required' => true));
                    $this->addFilter(array('name' => 'idOrdemServicoImpressao', 'required' => true));
                    $this->addFilter(array('name' => 'ds_nome', 'required' => false));
                    break;
                }
            case 'prepareElements': {
                    $this->addFilter(array('name' => 'id_ordem_servico'));
                    $this->addFilter(array('name' => 'ds_descricao'));
                    $this->addFilter(array('name' => 'id_demanda_vinculada'));
                    $this->addFilter(array('name' => 'ds_contrato', 'required' => true));
                    $this->addFilter(array('name' => 'nu_ordem_servico', 'required' => true));
                    $this->addFilter(array('name' => 'ds_nome', 'required' => true));
                    $this->addFilterDateTime(array('name' => 'dt_prazo', 'required' => true));
                    $this->addFilterDateTime(array('name' => 'dt_emissao', 'required' => true));
                    $this->addFilterDateTime(array('name' => 'dt_recepcao', 'required' => true));
                    $this->addFilterSelect(array('name' => 'demanda_vinculada'));
                    $this->addFilter(array('name' => 'ds_justificativa'));
                    $this->addFilterSelect(array('name' => 'no_fiscal_requisitante', 'required' => true));
                    $this->addFilterSelect(array('name' => 'no_fiscal_tecnico', 'required' => true));
                    $this->addFilterSelect(array('name' => 'no_gestor_contrato', 'required' => true));
                    $this->addFilterSelect(array('name' => 'no_preposto', 'required' => true));
                    $this->addFilter(array('name' => 'ds_svn'));
                    break;
                }
        }
    }

}
