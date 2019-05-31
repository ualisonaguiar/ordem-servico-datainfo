<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class FileSpecificTest extends AbstractSpecificTest
{

    public function testAddFile()
    {
        $this->assertEquals($this->getStringFile(), self::getInstanceOf()->addFile('File'));
    }

    public function testAddFile2()
    {
        $this->assertEquals($this->getStringFile('full'), self::getInstanceOf()->addFile('File', 'strId', 'strLabel', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 1, array('name', 'id'), 10, 'strGroupStyle', 'strMultiple', true));
    }

    private function getStringFile($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'File',
                'attributes' => array(
                    'id' => 'File',
                    'title' => 'Arquivo',
                    'validate_message' => 'fieldset_group',
                ),
                'options' => array(
                    'label' => 'Arquivo',
                ),
                'type' => 'InepZend\FormGenerator\Element\File',
            );
        return array(
            'name' => 'File',
            'attributes' => array(
                'id' => 'File',
                'validate_message' => 'strTypeValidateMessage',
                'style' => 'strStyle',
                'title' => 'strTitle',
                'class' => 'strClass',
                'label_class' => 'strLabelClass',
                'label_style' => 'strLabelStyle',
                'help_text' => 'strHelpText',
                'disabled' => 'strDisabled',
                'tabindex' => 1,
                'group_class' => 10,
                'group_style' => 'strGroupStyle',
                'required' => 'required',
                'data-0' => 'name',
                'data-1' => 'id',
                'multiple' => 'strMultiple',
                'onchange' => 'getFileFromInputFile(this);',
            ),
            'options' => array(
                'label' => 'strLabel',
            ),
            'type' => 'InepZend\FormGenerator\Element\File'
        );
    }

}
