<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;
use InepZend\Util\Reflection;

class ButtonSpecificTest extends AbstractSpecificTest
{

    public function testAddButton()
    {
        $this->assertEquals($this->getStringButton('Button', 'Default', 'onclick="window.location.href=strGlobalBasePath + \'Default\';"'), self::getInstanceOf()->addButton('Button')->getValue());
    }

    public function testAddButton2()
    {
        $arrElementTest = self::getInstanceOf()->addButton('ButtonUnitTest', 'idButtonUnitTest', 'ButtonUnitTest', 'btn', 'font-size: 16em', 'RSRC_LOG_CONFIG', 'hidden', '1', array('strName', 'strId'), 'k', './data/img/gif.gif', 'alert(\'Function\')', true, 'button', 'ValueUnitTest');
        $arrElement = $this->getArrayButton('ButtonUnitTest', 'alert(\'Function\')', null, "./data/img/gif.gif");
        $this->assertEquals($arrElementTest, $arrElement);
    }

    public function testAddButtonBack()
    {
        $this->assertEquals($this->getStringButton('Voltar', null, 'onclick="window.location.href=strGlobalBasePath + \'/ButtonBackRout\';"', 'Voltar'), self::getInstanceOf()->addButtonBack('ButtonBackRout')->getValue());
    }

    public function testAddButtonBack2()
    {
        $arrElementTest = self::getInstanceOf()->addButtonBack('router', true, 'btn', 'font-size: 16em', 'button', 'Voltar', 'RSRC_LOG_CONFIG', 'hidden', '1', array('strName', 'strId'), 'k');
        $arrElement = $this->getArrayButton('Voltar', "window.location.href=strGlobalBasePath + '/router';", 'btn', null);
        $this->assertEquals($arrElementTest, $arrElement);
    }

    public function testAddButtonSave()
    {
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Html', self::getInstanceOf()->addButtonSave('ButtonSaveRout'));
    }

    public function testAddButtonClear()
    {
        $this->assertEquals($this->getStringButton('Limpar', null, 'onclick="clearValuesFromFieldsForm();"', 'Limpar'), self::getInstanceOf()->addButtonClear()->getValue());
    }

    public function testAddButtonClear2()
    {
        $arrElementTest = self::getInstanceOf()->addButtonClear('alert(\'testAddButtonClear2\')', true, 'btn-info', 'font-size: 16em', 'button', 'Limpar', 'RSRC_LOG_CONFIG', 'hidden', '1', array('strName', 'strId'), 'k');
        $arrElement = array(
            'name' => "btnLimpar",
            'attributes' => array(
                'id' => "btnLimpar",
                'title' => "Limpar",
                'class' => "btnDefault btn-info",
                'style' => "font-size: 16em",
                'validate_message' => "fieldset_group",
                'tabindex' => "1",
                'data-0' => "strName",
                'data-1' => "strId",
                'src' => "/vendor/InepZend/images/botoes/azul_claro/limpar.jpg",
                'accesskey' => "k",
                'onclick' => "alert('testAddButtonClear2')"),
            'type' => "InepZend\FormGenerator\Element\Image");
        $this->assertEquals($arrElementTest, $arrElement);
    }

    public function testAddButtonSearch()
    {
        $this->assertEquals($this->getStringButton('Pesquisar', null, 'onclick="filterPaginator();"', 'Pesquisar'), self::getInstanceOf()->addButtonSearch()->getValue());
    }

    public function testAddButtonSearch2()
    {
        $arrElementTest = self::getInstanceOf()->addButtonSearch('alert(\'testAddButtonSearch2\')', true, 'btn-info', 'font-size: 16em', 'button', 'Pesquisar', 'RSRC_LOG_CONFIG', 'hidden', '1', array('strName', 'strId'), 'k');
        $arrElement = array(
            'name' => "btnPesquisar",
            'attributes' => array(
                'id' => "btnPesquisar",
                'title' => "Pesquisar",
                'class' => "btnDefault btn-info",
                'style' => "font-size: 16em",
                'validate_message' => "fieldset_group",
                'tabindex' => "1",
                'data-0' => "strName",
                'data-1' => "strId",
                'src' => "/vendor/InepZend/images/botoes/azul_claro/pesquisar.jpg",
                'accesskey' => "k",
                'onclick' => "alert('testAddButtonSearch2')"),
            'type' => "InepZend\FormGenerator\Element\Image");
        $this->assertEquals($arrElementTest, $arrElement);
    }

    public function testAddButtonSpecific()
    {
        $this->assertNull(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'addButtonSpecific', null));
    }

    public function testAddButtonSpecific2()
    {
        $this->assertEquals($this->getStringButton('SpecificButtonUnitTest', null, 'onclick="void(0);"'), Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'addButtonSpecific', 'SpecificButtonUnitTest')->getValue());
    }

    public function testAddButtonSpecific3()
    {
        $arrElementTest = Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'addButtonSpecific', 'SpecificButtonUnitTest', 'alert(\'testAddButtonSpecific3\')', true, 'btn-info', 'font-size: 16em', 'button', 'SpecificButtonUnitTest', 'RSRC_LOG_CONFIG', 'hidden', '1', array('strName', 'strId'), 'k');
        $arrElement = array(
            'name' => "btnSpecificButtonUnitTest",
            'attributes' => array(
                'id' => "btnSpecificButtonUnitTest",
                'title' => "SpecificButtonUnitTest",
                'class' => "btnDefault btn-info",
                'style' => "font-size: 16em",
                'validate_message' => "fieldset_group",
                'tabindex' => "1",
                'data-0' => "strName",
                'data-1' => "strId",
                'src' => "/vendor/InepZend/images/botoes/azul_claro/specificbuttonunittest.jpg",
                'accesskey' => "k",
                'onclick' => "alert('testAddButtonSpecific3')"),
            'type' => "InepZend\FormGenerator\Element\Image");
        $this->assertEquals($arrElementTest, $arrElement);
    }

    public function testGetHelperInstance()
    {
        $this->assertInstanceOf('InepZend\View\Helper\ButtonHelper', self::getInstanceOf()->getHelperInstance());
    }

    private function getStringButton($strName, $strType = null, $strOnClick, $strNameButton = '')
    {
        if (!is_null($strType))
            return '<button name="' . $strName . '" id="Button" class="btnDefault" type="button" onclick="void(0);" title=""></button>';
        $strClass = ' btn-inep';
        if ($strName == 'SpecificButtonUnitTest')
            $strClass = '';
        return '<button type="button" id="btn' . $strName . '" name="btn' . $strName . '" class="btnDefault btn' . $strName . '' . $strClass . '" style="" title="' . $strName . '" ' . $strOnClick . ' tabindex="" accesskey="">' . $strNameButton . '</button>';
    }

    private function getArrayButton($strName, $strOnClick, $strType = null, $strSrc = null)
    {
        return array(
            'name' => is_null($strType) ? "{$strName}" : "btn{$strName}",
            'attributes' => array(
                'id' => is_null($strType) ? "id{$strName}" : "btn{$strName}",
                'title' => "{$strName}",
                'class' => "btnDefault btn",
                'style' => "font-size: 16em",
                'validate_message' => "fieldset_group",
                'tabindex' => "1",
                'data-0' => "strName",
                'data-1' => "strId",
                'src' => !is_null($strSrc) ? $strSrc : "/vendor/InepZend/images/botoes/azul_claro/" . strtolower($strName) . ".jpg",
                'accesskey' => "k",
                'onclick' => "{$strOnClick}"),
            'type' => "InepZend\FormGenerator\Element\Image");
    }

}
