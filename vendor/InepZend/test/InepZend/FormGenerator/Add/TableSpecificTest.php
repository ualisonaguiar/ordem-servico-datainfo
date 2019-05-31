<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class TableSpecificTest extends AbstractSpecificTest
{

    /**
     * Object
     */
    public function testAddTable()
    {
        $arrData = array('name' => 'nu_telefone');
        $arrTitle = array('title' => array('Tipo' => array('nomeSubTipoContato', 'width: 30%;')));
        $arrIcon = array('icon' => array(array('class' => 'fa fa-trash', 'title' => 'Excluir Telefone', 'onclick' => 'removeFromCrud(this);')));
        $arrOption = array('Telefone' => array(array('txContatoFormated', 'txContato')));
        $strName = 'nu_telefone';
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Table', self::getInstanceOf()->addTable(self::getInstanceOf()->addTable($arrData, $arrTitle, $arrIcon, $arrOption, $strName))->getElements()["nu_telefone"]);
    }
    
    /**
     * Element
     */
    public function testAddTable2()
    {
        $arrData = array('name' => 'nu_telefone');
        $arrTitle = array('title' => array('Tipo' => array('nomeSubTipoContato', 'width: 30%;')));
        $arrIcon = array('icon' => array(array('class' => 'fa fa-trash', 'title' => 'Excluir Telefone', 'onclick' => 'removeFromCrud(this);')));
        $arrOption = array('Telefone' => array(array('txContatoFormated', 'txContato')));
        $strName = 'nu_telefone';
        $this->assertInternalType('array', self::getInstanceOf()->addTable(self::getInstanceOf()->addTable($arrData, $arrTitle, $arrIcon, $arrOption, $strName))->getElements()["nu_telefone"]->getOptions());
    }
    
    /**
     * String
     */
    public function testAddTable3()
    {
        $arrData = array('name' => 'nu_telefone');
        $arrTitle = array('title' => array('Tipo' => array('nomeSubTipoContato', 'width: 30%;')));
        $arrIcon = array('icon' => array(array('class' => 'fa fa-trash', 'title' => 'Excluir Telefone', 'onclick' => 'removeFromCrud(this);')));
        $arrOption = array('Telefone' => array(array('txContatoFormated', 'txContato')));
        $strName = 'nu_telefone';
        $this->assertSame('txContatoFormated', self::getInstanceOf()->addTable(self::getInstanceOf()->addTable($arrData, $arrTitle, $arrIcon, $arrOption, $strName))->getElements()["nu_telefone"]->getOptions()['option']["Telefone"][0][0]);
    }

}
