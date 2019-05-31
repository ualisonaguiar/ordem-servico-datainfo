<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class ContatoSpecificTest extends AbstractSpecificTest
{

    public function testAddContato()
    {
        $strLabel = 'Contato';
        $strTypeValidateMessage = 'default';
        $strActionToResourceNotAllowed = 'hidden';
        $arrDisabled = array();
        $arrReadonly = array();
        $arrNotShow = array();
        $arrRequired = array('ds_email' => true, 'ds_email_confirmacao' => true);
        $arrResource = null;
        $this->assertInstanceOf('InepZend\FormGenerator\FormGenerator', self::getInstanceOf()->addContato(self::getInstanceOf()->addContato($strLabel, $arrRequired, $strTypeValidateMessage, $arrDisabled, $arrResource, $strActionToResourceNotAllowed, $arrReadonly, $arrNotShow)));
    }

}
