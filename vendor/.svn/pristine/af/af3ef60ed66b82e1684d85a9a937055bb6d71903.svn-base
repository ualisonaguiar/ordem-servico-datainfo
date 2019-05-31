<?php

namespace InepZend\Module\Crontab\AdminCron\Form;

use InepZend\Filter\Filter;

class AdminCronFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsFilter': {
                    $this->addFilterSelect(array('name' => 'in_ativo'));
                    $this->addFilter(array('name' => 'ds_url'));
                    break;
                }
            case 'prepareElements': {
                    $this->addFilter(array('name' => 'id_cron'));
                    $this->addFilter(array('name' => 'dt_cadastro'));
                    $this->addFilter(array('name' => 'no_cron', 'required' => true));
                    $this->addFilter(array('name' => 'ds_url', 'required' => true));
                    $this->addFilter(array('name' => 'nu_mes'));
                    $this->addFilter(array('name' => 'nu_dia_semana'));
                    $this->addFilter(array('name' => 'nu_dia'));
                    $this->addFilter(array('name' => 'nu_hora'));
                    $this->addFilter(array('name' => 'nu_minuto'));
                    break;
                }
        }
    }

}
