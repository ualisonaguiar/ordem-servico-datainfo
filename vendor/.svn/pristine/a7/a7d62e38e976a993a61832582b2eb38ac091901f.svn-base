<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class LinkSpecificTest extends AbstractSpecificTest
{

    public function testAddLink()
    {
        $this->assertNull(self::getInstanceOf()->addLink('name'));
    }

    public function testAddLink2()
    {
        $this->assertEquals('<a href="strLink" title="strTitle" class="strClass" style="strStyle" tabindex="intTabindex" name="nameLink" id="strId" target="strTarget">linkLabel</a>',self::getInstanceOf()->addLink('nameLink','strId', 'linkLabel', 'strTitle', 'strClass', 'strStyle', 'strResource', 'strActionToResourceNotAllowed', 'intTabindex', 'arrAttributeData', 'strLink', 'strTarget')->getValue());
    }

}
