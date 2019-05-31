<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class DadoBancarioSpecificTest extends AbstractSpecificTest
{

    public function testAddDadoBancario()
    {
        $strLabel = 'Dado Bancario';
        $strTypeValidateMessage = 'default';
        $strActionToResourceNotAllowed = 'hidden';
        $arrDisabled = array();
        $arrReadonly = array();
        $arrNotShow = array();
        $arrRequired = array('co_banco' => true, 'nu_agencia' => true);
        $arrResource = null;
        $this->assertInstanceOf('InepZend\FormGenerator\FormGenerator', self::getInstanceOf()->addDadoBancario(self::getInstanceOf()->addDadoBancario($strLabel, $arrRequired, $strTypeValidateMessage, $arrDisabled, $arrResource, $strActionToResourceNotAllowed, $arrReadonly, $arrNotShow)));
    }

    public function testAddDadoBancario2()
    {
        $strLabel = 'Dado Bancario';
        $strTypeValidateMessage = 'default';
        $strActionToResourceNotAllowed = 'hidden';
        $arrDisabled = array();
        $arrReadonly = array();
        $arrNotShow = array();
        $arrRequired = array('co_banco' => true, 'nu_agencia' => true);
        $arrResource = null;
        $this->assertInternalType('array', self::getInstanceOf()->addDadoBancario($strLabel, $arrRequired, $strTypeValidateMessage, $arrDisabled, $arrResource, $strActionToResourceNotAllowed, $arrReadonly, $arrNotShow)->getElementToDadoPessoal());
    }

}
