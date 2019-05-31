<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;
use InepZend\Util\Reflection;

class CaptchaSpecificTest extends AbstractSpecificTest
{

    public function testAddCaptcha()
    {
        $this->assertEquals('InepZend\FormGenerator\Element\Captcha', self::getInstanceOf()->addCaptcha('Captcha')['type']);
    }

    public function testAddCaptcha2()
    {
        $this->assertEquals($this->getStringCaptcha(), self::getInstanceOf()->addCaptcha('Captcha', 'strId', 'strLabel', true, 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 1, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 1)['attributes']);
    }

    public function testGetOptionAdapterCaptcha()
    {
        $this->assertEquals($this->getOptionCaptha(), Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getOptionAdapterCaptcha', null));
    }

    public function testGetOptionAdapterCaptcha2()
    {
        $this->assertEquals($this->getOptionCaptha(9), Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getOptionAdapterCaptcha', 9));
    }

    private function getStringCaptcha()
    {
        return array(
            'id' => 'Captcha',
            'required' => 'required',
            'title' => 'strLabel',
            'validate_message' => 'strTypeValidateMessage',
            'label_class' => 'strLabelClass',
            'label_style' => 'strLabelStyle',
            'help_text' => 'strHelpText',
            'disabled' => 'strDisabled',
            'tabindex' => 1,
            'data-0' => 'strName',
            'data-1' => 'strId',
            'group_class' => 'strGroupClass',
            'group_style' => 'strGroupStyle',
        );
    }

    private function getOptionCaptha($intWordLen = 7)
    {
        return array(
            'imgDir' => './data/captcha',
            'imgUrl' => '/data/captcha',
            'font' => './vendor/InepZend/data/fonts/arial.ttf',
            'width' => 250,
            'height' => 100,
            'dotNoiseLevel' => 40,
            'lineNoiseLevel' => 3,
            'wordlen' => $intWordLen,
            'messages' => array(
                'missingValue' => 'O valor do Captcha está vazio.',
                'badCaptcha' => 'O valor do Captcha está errado.')
        );
    }

}
