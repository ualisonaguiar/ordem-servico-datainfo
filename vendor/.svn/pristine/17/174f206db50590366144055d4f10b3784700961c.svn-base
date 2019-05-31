<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class ImageSpecificTest extends AbstractSpecificTest
{

    public function testAddImage()
    {
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Html', self::getInstanceOf()->addImage('strValue', 'ImageNew', null, null, null, null, null, null, null, 'strSource'));
    }

    public function testAddImage2()
    {
        $this->assertEquals('<img src="strSource" name="strValue" id="ImageNew" />', self::getInstanceOf()->addImage('strValue', 'ImageNew', null, null, null, null, null, null, null, 'strSource')->getValue());
    }

    public function testAddImage3()
    {
        $this->assertEquals('<img src="strSource" name="strName" id="strId" title="strTitle" class="strClass" style="strStyle" onclick="strOnClick" />', self::getInstanceOf()->addImage('strName', 'strId', 'strTitle', 'strClass', 'strStyle', 'strResource', 'strActionToResourceNotAllowed', 10, array(), 'strSource', 'strOnClick')->getValue());
    }

}
