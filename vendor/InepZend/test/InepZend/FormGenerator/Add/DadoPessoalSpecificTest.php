<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class DadoPessoalSpecificTest extends AbstractSpecificTest
{

    public function testAddDadoPessoal()
    {
        $strLabel = 'DadoPessoal';
        $strTypeValidateMessage = 'default';
        $strActionToResourceNotAllowed = 'hidden';
        $arrDisabled = array();
        $arrReadonly = array();
        $arrNotShow = array();
        $arrRequired = array('nu_cpf' => true, 'nu_rg' => true);
        $arrResource = null;
        $this->assertInstanceOf('InepZend\FormGenerator\FormGenerator', self::getInstanceOf()->addDadoPessoal(self::getInstanceOf()->addDadoPessoal($strLabel, $arrRequired, $strTypeValidateMessage, $arrDisabled, $arrResource, $strActionToResourceNotAllowed, $arrReadonly, $arrNotShow)));
    }

    public function testEditGroupDadoPessoal()
    {
       $arrParam = array(
            "nu_telefone_fixo" =>
            array(
                "type" => "Phone",
                "label" => "Telefone Fixo",
                "placeholder" => "Entre com o Telefone Fixo",
                "ddd" => (true)
            ),
            "nu_telefone_movel" => array(
                "type" => "Phone",
                "label" => "Celular",
                "placeholder" => "Entre com o Celular",
                "ddd" => (true)
            ),
           'suggestion' => array('1','2','3')
        );
       
        $arrElement = array(
            "nu_telefone_fixo" =>
            array(
                "type" => "Phone",
                "label" => "Telefone Fixo",
                "placeholder" => "Entre com o Telefone Fixo",
                "ddd" => (true)
            ),
            "nu_telefone_movel" => array(
                "type" => "Phone",
                "label" => "Celular",
                "placeholder" => "Entre com o Celular",
                "ddd" => (true)
            )
        );
        $this->assertNotNull(self::getInstanceOf()->editGroupDadoPessoal($arrParam, $arrElement));
    }

}
