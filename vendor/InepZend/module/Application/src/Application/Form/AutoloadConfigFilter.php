<?php

namespace InepZend\Module\Application\Form;

use InepZend\Filter\Filter;
use InepZend\Module\Application\Service\AutoloadConfig as AutoloadConfigService;

class AutoloadConfigFilter extends Filter
{

    public function __construct()
    {
        $this->addFilterEditor(array('name' => AutoloadConfigService::ATTRIBUTE, 'required' => true));
    }

}
