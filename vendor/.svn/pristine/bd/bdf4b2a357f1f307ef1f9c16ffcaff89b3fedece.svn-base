<?php

namespace InepZend\Module\Log\Form;

use InepZend\Filter\Filter;
use InepZend\Module\Log\Form\Log;
use InepZend\Module\Log\Service\LogModule;

class LogFilter extends Filter
{

    public function __construct($strShortNameForm = null)
    {
        parent::__construct($strShortNameForm);
        switch (strtolower($strShortNameForm)) {
            case 'filter':
                $this->addFilterDateRange(array('name' => 'dt_create', 'max_diff' => 31));
                $this->addFilterSelect(array('name' => 'tp_level'));
                break;
            case 'config':
                $this->addFilterTransfer(array('name' => Log::KEY_RESERVED_VARIABLE));
                foreach (LogModule::getOptionAudit() as $strValue => $strLabel)
                    $this->addFilter(array('name' => Log::KEY_OPTION . '[' . $strValue . ']'));
                foreach (LogModule::getNamespaceType() as $strNamespaceType)
                    $this->addFilter(array('name' => Log::KEY_NAMESPACE . '[' . $strNamespaceType . ']'));
                $this->addFilter(array('name' => Log::KEY_CPF));
                $this->addFilter(array('name' => Log::KEY_USER_SYSTEM));
                break;
        }
    }

}
