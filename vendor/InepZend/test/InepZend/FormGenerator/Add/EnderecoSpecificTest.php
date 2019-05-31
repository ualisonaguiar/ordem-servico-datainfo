<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class EnderecoSpecificTest extends AbstractSpecificTest
{

    public function testAddEndereco()
    {
        $this->assertInstanceOf('InepZend\FormGenerator\FormGenerator', self::getInstanceOf()->addEndereco(array('label' => 'label', 'link_correios' => 'http://www.inep.gov.br', 'ajax_correios_dne' => 'http://www.inep.gov.br')));
    }

}
