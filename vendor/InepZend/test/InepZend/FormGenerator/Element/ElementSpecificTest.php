<?php

namespace InepZend\Form;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\FormGenerator\Element\Button,
    InepZend\FormGenerator\Element\Captcha,
    InepZend\FormGenerator\Element\Checkbox,
    InepZend\FormGenerator\Element\Date,
    InepZend\FormGenerator\Element\Email,
    InepZend\FormGenerator\Element\File,
    InepZend\FormGenerator\Element\Html,
    InepZend\FormGenerator\Element\Image,
    InepZend\FormGenerator\Element\Number,
    InepZend\FormGenerator\Element\Password,
    InepZend\FormGenerator\Element\Radio,
    InepZend\FormGenerator\Element\Select,
    InepZend\FormGenerator\Element\Submit,
    InepZend\FormGenerator\Element\Text,
    InepZend\FormGenerator\Element\Textarea,
    InepZend\FormGenerator\Element\Url;

class ElementSpecificTest extends AbstractUnitTest
{

    protected function setUp()
    {
        parent::setUp();
    }

    public function testInstanceButtonOf()
    {
        self::setInstanceOf(new Button());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Button', self::getInstanceOf());
    }

    public function testInstanceCaptchaOf()
    {
        self::setInstanceOf(new Captcha());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Captcha', self::getInstanceOf());
    }

    public function testInstanceCheckboxOf()
    {
        self::setInstanceOf(new Checkbox());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Checkbox', self::getInstanceOf());
    }

    public function testInstanceDateOf()
    {
        self::setInstanceOf(new Date());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Date', self::getInstanceOf());
    }

    public function testInstanceEmailOf()
    {
        self::setInstanceOf(new Email());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Email', self::getInstanceOf());
    }

    public function testInstanceFileOf()
    {
        self::setInstanceOf(new File());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\File', self::getInstanceOf());
    }

    /**
     * @depends testInstanceFileOf
     */
    public function testInstanceFileOf2()
    {
        $this->assertEquals('InepZend\Filter\FileInput', self::getInstanceOf()->getInputSpecification()['type']);
    }

    public function testInstanceHtmlOf()
    {
        self::setInstanceOf(new Html('HtmlInstanceUnitTest', 'ValueParamsUnitTest', array('label' => 'OptionAdd')));
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Html', self::getInstanceOf());
    }

    /**
     * @depends testInstanceHtmlOf
     */
    public function testInstanceHtmlOf2()
    {
        $this->assertEquals('HtmlInstanceUnitTest', self::getInstanceOf()->getAttribute('name'));
    }

    /**
     * @depends testInstanceHtmlOf
     */
    public function testInstanceHtmlOf3()
    {
        $this->assertEquals('ValueParamsUnitTest', self::getInstanceOf()->getValue());
    }

    /**
     * @depends testInstanceHtmlOf
     */
    public function testInstanceHtmlOf4()
    {
        $this->assertEquals('OptionAdd', self::getInstanceOf()->getOption('label'));
    }

    /**
     * @depends testInstanceHtmlOf
     */
    public function testInstanceHtmlOf5()
    {
        $this->assertEquals('ValueParamsUnitTest', self::getInstanceOf()->__toString());
    }

    public function testInstanceImageOf()
    {
        self::setInstanceOf(new Image());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Image', self::getInstanceOf());
    }

    public function testInstanceNumberOf()
    {
        self::setInstanceOf(new Number());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Number', self::getInstanceOf());
    }

    public function testInstancePasswordOf()
    {
        self::setInstanceOf(new Password());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Password', self::getInstanceOf());
    }

    public function testInstanceRadioOf()
    {
        self::setInstanceOf(new Radio());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Radio', self::getInstanceOf());
    }

    public function testInstanceSelectOf()
    {
        self::setInstanceOf(new Select());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Select', self::getInstanceOf());
    }

    public function testInstanceSubmitOf()
    {
        self::setInstanceOf(new Submit());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Submit', self::getInstanceOf());
    }

    public function testInstanceTextOf()
    {
        self::setInstanceOf(new Text());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Text', self::getInstanceOf());
    }

    public function testInstanceTextareaOf()
    {
        self::setInstanceOf(new Textarea());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Textarea', self::getInstanceOf());
    }

    public function testInstanceUrlOf()
    {
        self::setInstanceOf(new Url());
        $this->assertInstanceOf('InepZend\FormGenerator\Element\Url', self::getInstanceOf());
    }

}
