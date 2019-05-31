<?php

namespace InepZend\Module\Application\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\Application\Service\AutoloadConfig as AutoloadConfigService;

class AutoloadConfig extends FormGenerator
{

    public function prepareElementsFilter()
    {
        $strWidth = (self::isThemeAdministrativeResponsible()) ? '100%' : '1120px';
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Edição</h3><div class="row-fluid"><div class="span12">');
        $this->addTextarea(array(
            'name' => AutoloadConfigService::ATTRIBUTE,
            'required' => true,
            'label' => 'Conteúdo do Arquivo de Configuração:',
            'style' => 'width: ' . $strWidth . '; height: 438px; float: right; margin-top: 2px; padding-top: 4px; overflow: auto;',
        ));
        $this->addHtml('</div></div>');
        $this->addButtonSave($this->getAttribute('name'), false);
        $this->addButtonClear();
        $this->addHtml('</div>');
        $this->setInputFilter(new AutoloadConfigFilter());
    }

}
