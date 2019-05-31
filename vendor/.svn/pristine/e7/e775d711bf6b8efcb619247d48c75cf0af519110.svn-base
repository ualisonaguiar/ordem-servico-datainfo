<?php

namespace InepZend\Module\TrocaArquivo\EnvioDado\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\TrocaArquivo\EnvioDado\Form\EnvioDadoFilter;

class EnvioDado extends FormGenerator
{

    public function prepareElementsEnvio()
    {
        $this->addHtml('<div class="well"><h3>Dados a Enviar</h3>');
        $this->addSelect(array('name' => 'idConfiguracao', 'label' => 'Janela do Envio', 'value_options' => $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->listConfiguracao(), 'empty_option' => 'Selecione', 'required' => true));
        $this->addFile(array('required' => true));
        $this->addHtml('<font color="red">É recomendado <strong>NÃO</strong> realizar múltiplos envios dos dados de forma <strong>simultânea</strong>.</font>');
        $this->addHtml('</div>');
        $this->addButtonSave(null, false, null, null, null, 'Realizar o Envio dos Dados', null, null, null, null, null, null, true);
        $this->addButtonRoute(array('route' => 'acompanhamentoenvio', 'value' => 'Acompanhamento do Envio'));
        $this->setInputFilter(new EnvioDadoFilter(__FUNCTION__));
        return $this;
    }

}
