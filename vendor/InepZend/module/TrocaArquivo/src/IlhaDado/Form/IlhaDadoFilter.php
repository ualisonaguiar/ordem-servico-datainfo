<?php
namespace InepZend\Module\TrocaArquivo\IlhaDado\Form;

use InepZend\Filter\Filter;

class IlhaDadoFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsFilter':
                {
                    $this->addFilter(array(
                        'name' => 'no_ilha_dado'
                    ));
                    break;
                }
            case 'prepareElements':
                {
                    $this->addFilter(array(
                        'name' => 'id_ilha_dado'
                    ));
                    $this->addFilter(array(
                        'name' => 'no_ilha_dado',
                        'required' => true
                    ));
                    $this->addFilter(array(
                        'name' => 'ds_consulta',
                        'required' => true
                    ));
                    $this->addFilter(array(
                        'name' => 'in_cache'
                    ));
                    break;
                }
        }
    }
}
