<?php

namespace InepZend\Module\Executor\Form;

use InepZend\Filter\Filter;

class EnvioEmailFilter extends Filter
{
    public function __construct()
    {
        parent::__construct(__FUNCTION__);
        $this->addFilter('idEmail');
        $this->addFilter('dsSituacao');
        $this->addFilter('dsDestinatario', true);
        $this->addFilter('dsDestinatarioCopia');
        $this->addFilter('dsAssunto', true);
        $this->addFilterEditor('dsTexto', true);
    }
}
