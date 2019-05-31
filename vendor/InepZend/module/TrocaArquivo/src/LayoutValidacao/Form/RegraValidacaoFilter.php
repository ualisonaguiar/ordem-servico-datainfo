<?php
namespace InepZend\Module\TrocaArquivo\LayoutValidacao\Form;

use InepZend\Filter\Filter;

class RegraValidacaoFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElements':
                {
                    $this->addFilter(array(
                        'name' => 'id_regra_validacao'
                    ));
                    $this->addFilter(array(
                        'name' => 'id_layout',
                        'required' => true
                    ));
                    $this->addFilterSelect(array(
                        'name' => 'id_ilha_dado',
                        'required' => true
                    ));
                    $this->addFilter(array(
                        'name' => 'ds_coluna',
                        'required' => true
                    ));
                    break;
                }
        }
    }
}
