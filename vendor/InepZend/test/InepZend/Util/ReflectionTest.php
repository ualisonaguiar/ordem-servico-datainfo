<?php

namespace InepZend\Util;

use InepZend\UnitTest\AbstractUnitTest;

class ReflectionTest extends AbstractUnitTest
{

    /**
     * Generated from @assert ('ConsultaPublica\Controller\IndexController') == (new \ReflectionClass('ConsultaPublica\Controller\IndexController')).
     *
     * @covers \InepZend\Util\Reflection::getReflectionClass
     */
    public function testGetReflectionClass()
    {
        $this->assertEquals(
                (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))
                , \InepZend\Util\Reflection::getReflectionClass('ConsultaPublica\Controller\IndexController')
        );
    }

    /**
     * Generated from @assert ('ConsultaPublica\Controller\IndexController', true) == (new \ReflectionClass('ConsultaPublica\Controller\IndexController')).
     *
     * @covers \InepZend\Util\Reflection::getReflectionClass
     */
    public function testGetReflectionClass2()
    {
        $this->assertEquals(
                (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))
                , \InepZend\Util\Reflection::getReflectionClass('ConsultaPublica\Controller\IndexController', true)
        );
    }

    /**
     * Generated from @assert ('ConsultaPublica\Controller\IndexController', false) == (new \ReflectionClass('ConsultaPublica\Controller\IndexController')).
     *
     * @covers \InepZend\Util\Reflection::getReflectionClass
     */
    public function testGetReflectionClass3()
    {
        $this->assertEquals(
                (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))
                , \InepZend\Util\Reflection::getReflectionClass('ConsultaPublica\Controller\IndexController', false)
        );
    }

    /**
     * Generated from @assert (array('ConsultaPublica\Controller\IndexController'), false) !== (new \ReflectionClass('ConsultaPublica\Controller\IndexController')).
     *
     * @covers \InepZend\Util\Reflection::getReflectionClass
     */
    public function testGetReflectionClass4()
    {
        $this->assertNotSame(
                (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))
                , \InepZend\Util\Reflection::getReflectionClass(array('ConsultaPublica\Controller\IndexController'), false)
        );
    }

    /**
     * Generated from @assert (new \ConsultaPublica\Controller\IndexController()) == (new \ReflectionClass('ConsultaPublica\Controller\IndexController')).
     *
     * @covers \InepZend\Util\Reflection::getReflectionClass
     */
    public function testGetReflectionClass5()
    {
        $this->assertEquals(
                (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))
                , \InepZend\Util\Reflection::getReflectionClass(new \ConsultaPublica\Controller\IndexController())
        );
    }

    /**
     * Generated from @assert (array('key')) == false.
     *
     * @covers \InepZend\Util\Reflection::getReflectionClass
     */
    public function testGetReflectionClass6()
    {
        $this->assertEquals(
                false
                , \InepZend\Util\Reflection::getReflectionClass(array('key'))
        );
    }

    /**
     * Generated from @assert ('ConsultaPublica\Controller\IndexController') == (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties().
     *
     * @covers \InepZend\Util\Reflection::listAttributesFromClass
     */
    public function testListAttributesFromClass()
    {
        $this->assertEquals(
                (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties()
                , \InepZend\Util\Reflection::listAttributesFromClass('ConsultaPublica\Controller\IndexController')
        );
    }

    /**
     * Generated from @assert ('ConsultaPublica\Controller\IndexController') == (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties().
     *
     * @covers \InepZend\Util\Reflection::listAttributesFromClass
     */
    public function testListAttributesFromClass2()
    {
        $this->assertEquals(
                (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties()
                , \InepZend\Util\Reflection::listAttributesFromClass('ConsultaPublica\Controller\IndexController')
        );
    }

    /**
     * Generated from @assert ('ConsultaPublica\Controller\IndexController') == (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties().
     *
     * @covers \InepZend\Util\Reflection::listAttributesFromClass
     */
    public function testListAttributesFromClass3()
    {
        $this->assertEquals(
                (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties()
                , \InepZend\Util\Reflection::listAttributesFromClass('ConsultaPublica\Controller\IndexController')
        );
    }

    /**
     * Generated from @assert (array('ConsultaPublica\Controller\IndexController')) !== (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties().
     *
     * @covers \InepZend\Util\Reflection::listAttributesFromClass
     */
    public function testListAttributesFromClass4()
    {
        $this->assertNotSame(
                (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties()
                , \InepZend\Util\Reflection::listAttributesFromClass(array('ConsultaPublica\Controller\IndexController'))
        );
    }

    /**
     * Generated from @assert (new \ConsultaPublica\Controller\IndexController()) == (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties().
     *
     * @covers \InepZend\Util\Reflection::listAttributesFromClass
     */
    public function testListAttributesFromClass5()
    {
        $this->assertEquals(
                (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties()
                , \InepZend\Util\Reflection::listAttributesFromClass(new \ConsultaPublica\Controller\IndexController())
        );
    }

    /**
     * Generated from @assert (array('key' => 'value')) == null.
     *
     * @covers \InepZend\Util\Reflection::listAttributesFromClass
     */
    public function testListAttributesFromClass6()
    {
        $this->assertEquals(
                null
                , \InepZend\Util\Reflection::listAttributesFromClass(array('key' => 'value'))
        );
    }

    /**
     * Generated from @assert ('\InepZend\Util\Date') == array('TYPE_DATE_BASE' => 'base', 'TYPE_DATE_TEMPLATE' => 'template', 'TYPE_DATE_WS' => 'ws').
     *
     * @covers \InepZend\Util\Reflection::listConstantsFromClass
     */
    public function testListConstantsFromClass()
    {
        $this->assertEquals(
                array('TYPE_DATE_BASE' => 'base', 'TYPE_DATE_TEMPLATE' => 'template', 'TYPE_DATE_WS' => 'ws')
                , \InepZend\Util\Reflection::listConstantsFromClass('\InepZend\Util\Date')
        );
    }

    /**
     * Generated from @assert ('\InepZend\Util\Date', 'TYPE_DATE_BASE') == 'base'.
     *
     * @covers \InepZend\Util\Reflection::listConstantsFromClass
     */
    public function testListConstantsFromClass2()
    {
        $this->assertEquals(
                'base'
                , \InepZend\Util\Reflection::listConstantsFromClass('\InepZend\Util\Date', 'TYPE_DATE_BASE')
        );
    }

    /**
     * Generated from @assert (new \InepZend\Util\Date(), 'TYPE_DATE_BASE') == (new \ReflectionClass('\InepZend\Util\Date'))->getConstant('TYPE_DATE_BASE').
     *
     * @covers \InepZend\Util\Reflection::listConstantsFromClass
     */
    public function testListConstantsFromClass3()
    {
        $this->assertEquals(
                (new \ReflectionClass('\InepZend\Util\Date'))->getConstant('TYPE_DATE_BASE')
                , \InepZend\Util\Reflection::listConstantsFromClass(new \InepZend\Util\Date(), 'TYPE_DATE_BASE')
        );
    }

    /**
     * Generated from @assert (new \InepZend\Util\Date()) == (new \ReflectionClass('\InepZend\Util\Date'))->getConstants().
     *
     * @covers \InepZend\Util\Reflection::listConstantsFromClass
     */
    public function testListConstantsFromClass4()
    {
        $this->assertEquals(
                (new \ReflectionClass('\InepZend\Util\Date'))->getConstants()
                , \InepZend\Util\Reflection::listConstantsFromClass(new \InepZend\Util\Date())
        );
    }

    /**
     * Generated from @assert ('\InepZend\Util\Date') == (new \ReflectionClass('\InepZend\Util\Date'))->getMethods().
     *
     * @covers \InepZend\Util\Reflection::listMethods
     */
    public function testListMethods()
    {
        $this->assertEquals(
                (new \ReflectionClass('\InepZend\Util\Date'))->getMethods()
                , \InepZend\Util\Reflection::listMethods('\InepZend\Util\Date')
        );
    }

    /**
     * Generated from @assert (new \InepZend\Util\Date()) == (new \ReflectionClass('\InepZend\Util\Date'))->getMethods().
     *
     * @covers \InepZend\Util\Reflection::listMethods
     */
    public function testListMethods2()
    {
        $this->assertEquals(
                (new \ReflectionClass('\InepZend\Util\Date'))->getMethods()
                , \InepZend\Util\Reflection::listMethods(new \InepZend\Util\Date())
        );
    }

    /**
     * Generated from @assert ('\InepZend\Util\Date', 'isDateBase') == (new \ReflectionClass('\InepZend\Util\Date'))->getMethod('isDateBase').
     *
     * @covers \InepZend\Util\Reflection::listMethods
     */
    public function testListMethods3()
    {
        $this->assertEquals(
                (new \ReflectionClass('\InepZend\Util\Date'))->getMethod('isDateBase')
                , \InepZend\Util\Reflection::listMethods('\InepZend\Util\Date', 'isDateBase')
        );
    }

    /**
     * Generated from @assert (array('key' => 'value')) == false.
     *
     * @covers \InepZend\Util\Reflection::listMethods
     */
    public function testListMethods4()
    {
        $this->assertEquals(
                false
                , \InepZend\Util\Reflection::listMethods(array('key' => 'value'))
        );
    }

    /**
     * Generated from @assert ('\InepZend\Util\ApplicationInfo') == array('getApplicationInfo', 'getNameEdited', 'getServerInstance', 'getInepZendVersion', 'getRevision', 'getInepZendLastVersion', 'getThemeType', 'getTheme', 'getThemeLayout', 'getThemeFromLayout').
     *
     * @covers \InepZend\Util\Reflection::listMethodsFromClass
     */
    public function testListMethodsFromClass()
    {
        $this->assertEquals(
                array('getApplicationInfo', 'getNameEdited', 'getServerInstance', 'getInepZendVersion', 'getRevision', 'getInepZendLastVersion', 'getThemeType', 'getTheme', 'getThemeLayout', 'getThemeFromLayout')
                , \InepZend\Util\Reflection::listMethodsFromClass('\InepZend\Util\ApplicationInfo')
        );
    }

    /**
     * Generated from @assert ('\InepZend\Util\ApplicationInfo', true) == array('getApplicationInfo', 'getNameEdited', 'getServerInstance', 'getInepZendVersion', 'getRevision', 'getInepZendLastVersion', 'getThemeType', 'getTheme', 'getThemeLayout', 'getThemeFromLayout').
     *
     * @covers \InepZend\Util\Reflection::listMethodsFromClass
     */
    public function testListMethodsFromClass2()
    {
        $this->assertEquals(
                array('getApplicationInfo', 'getNameEdited', 'getServerInstance', 'getInepZendVersion', 'getRevision', 'getInepZendLastVersion', 'getThemeType', 'getTheme', 'getThemeLayout', 'getThemeFromLayout')
                , \InepZend\Util\Reflection::listMethodsFromClass('\InepZend\Util\ApplicationInfo', true)
        );
    }

    /**
     * Generated from @assert ('\InepZend\Util\ApplicationInfo', true, 'getApplicationInfo') == (new \ReflectionClass('\InepZend\Util\ApplicationInfo'))->getMethod('getApplicationInfo')->name.
     *
     * @covers \InepZend\Util\Reflection::listMethodsFromClass
     */
    public function testListMethodsFromClass3()
    {
        $this->assertEquals(
                (new \ReflectionClass('\InepZend\Util\ApplicationInfo'))->getMethod('getApplicationInfo')->name
                , \InepZend\Util\Reflection::listMethodsFromClass('\InepZend\Util\ApplicationInfo', true, 'getApplicationInfo')
        );
    }

    /**
     * Generated from @assert ('\InepZend\Util\ApplicationInfo', true, 'getApplicationInfo') == 'getApplicationInfo'.
     *
     * @covers \InepZend\Util\Reflection::listMethodsFromClass
     */
    public function testListMethodsFromClass4()
    {
        $this->assertEquals(
                'getApplicationInfo'
                , \InepZend\Util\Reflection::listMethodsFromClass('\InepZend\Util\ApplicationInfo', true, 'getApplicationInfo')
        );
    }

    /**
     * Generated from @assert () == false.
     *
     * @covers \InepZend\Util\Reflection::listAnnotationsFromMethod
     */
    public function testListAnnotationsFromMethod()
    {
        $this->assertEquals(
                false
                , \InepZend\Util\Reflection::listAnnotationsFromMethod()
        );
    }

    /**
     * Generated from @assert ('ConsultaPublica\Controller\IndexController') == false.
     *
     * @covers \InepZend\Util\Reflection::listAnnotationsFromMethod
     */
    public function testListAnnotationsFromMethod2()
    {
        $this->assertEquals(
                false
                , \InepZend\Util\Reflection::listAnnotationsFromMethod('ConsultaPublica\Controller\IndexController')
        );
    }

    /**
     * Generated from @assert ('ConsultaPublica\Controller\IndexController', 'indexAction') == array('AUTH' => 'no').
     *
     * @covers \InepZend\Util\Reflection::listAnnotationsFromMethod
     */
    public function testListAnnotationsFromMethod3()
    {
        $this->assertEquals(
                array('AUTH' => 'no')
                , \InepZend\Util\Reflection::listAnnotationsFromMethod('ConsultaPublica\Controller\IndexController', 'indexAction')
        );
    }

    /**
     * Generated from @assert ('InepZend\Util\Reflection') == false.
     *
     * @covers \InepZend\Util\Reflection::listAnnotationsFromAttribute
     */
    public function testListAnnotationsFromAttribute()
    {
        $this->assertEquals(
                false
                , \InepZend\Util\Reflection::listAnnotationsFromAttribute('InepZend\Util\Reflection')
        );
    }

    /**
     * Generated from @assert ('InepZend\Util\Reflection', 'arrReflectionClass') == array('VAR' => 'array').
     *
     * @covers \InepZend\Util\Reflection::listAnnotationsFromAttribute
     */
    public function testListAnnotationsFromAttribute2()
    {
        $this->assertEquals(
                array('VAR' => 'array')
                , \InepZend\Util\Reflection::listAnnotationsFromAttribute('InepZend\Util\Reflection', 'arrReflectionClass')
        );
    }

    /**
     * Generated from @assert ('@ORM\SequenceGenerator(sequenceName="inep_skeleton.seq_arquivo", initialValue=1, allocationSize=1)', 'allocationSize') == "1".
     *
     * @covers \InepZend\Util\Reflection::getAttributeValueFromAnnotationValue
     */
    public function testGetAttributeValueFromAnnotationValue()
    {
        $this->assertEquals(
                "1"
                , \InepZend\Util\Reflection::getAttributeValueFromAnnotationValue('@ORM\SequenceGenerator(sequenceName="inep_skeleton.seq_arquivo", initialValue=1, allocationSize=1)', 'allocationSize')
        );
    }

    /**
     * Generated from @assert ('@annotation', null) == false.
     *
     * @covers \InepZend\Util\Reflection::getAttributeValueFromAnnotationValue
     */
    public function testGetAttributeValueFromAnnotationValue2()
    {
        $this->assertEquals(
                false
                , \InepZend\Util\Reflection::getAttributeValueFromAnnotationValue('@annotation', null)
        );
    }

    /**
     * Generated from @assert (null, 'value') == false.
     *
     * @covers \InepZend\Util\Reflection::getAttributeValueFromAnnotationValue
     */
    public function testGetAttributeValueFromAnnotationValue3()
    {
        $this->assertEquals(
                false
                , \InepZend\Util\Reflection::getAttributeValueFromAnnotationValue(null, 'value')
        );
    }

    /**
     * Generated from @assert ('@ORM\GeneratedValue', 'id_arquivo') == "".
     *
     * @covers \InepZend\Util\Reflection::getAttributeValueFromAnnotationValue
     */
    public function testGetAttributeValueFromAnnotationValue4()
    {
        $this->assertEquals(
                ""
                , \InepZend\Util\Reflection::getAttributeValueFromAnnotationValue('@ORM\GeneratedValue', 'id_arquivo')
        );
    }

    /**
     * Generated from @assert ('Publicacao\Controller\ArquivoController', \InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../module/InepSkeleton/Publicacao/src/Publicacao/Controller/ArquivoController.php')) == "Publicacao\Controller\ArquivoController".
     *
     * @covers \InepZend\Util\Reflection::getRealClassNameWithPath
     */
    public function testGetRealClassNameWithPath()
    {
        $this->assertEquals(
                "Publicacao\Controller\ArquivoController"
                , \InepZend\Util\Reflection::getRealClassNameWithPath('Publicacao\Controller\ArquivoController', \InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../module/InepSkeleton/Publicacao/src/Publicacao/Controller/ArquivoController.php'))
        );
    }

    /**
     * Generated from @assert ('ArquivoController.php', \InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../module/InepSkeleton/Publicacao/src/Publicacao/Controller/ArquivoController.php')) == false.
     *
     * @covers \InepZend\Util\Reflection::getRealClassNameWithPath
     */
    public function testGetRealClassNameWithPath2()
    {
        $this->assertEquals(
                false
                , \InepZend\Util\Reflection::getRealClassNameWithPath('ArquivoController.php', \InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../module/InepSkeleton/Publicacao/src/Publicacao/Controller/ArquivoController.php'))
        );
    }

    /**
     * Generated from @assert ('ArquivoController.php', './module/InepSkeleton/Publicacao/src/Publicacao/Controller/ArquivoController') == false.
     *
     * @covers \InepZend\Util\Reflection::getRealClassNameWithPath
     */
    public function testGetRealClassNameWithPath3()
    {
        $this->assertEquals(
                false
                , \InepZend\Util\Reflection::getRealClassNameWithPath('ArquivoController.php', './module/InepSkeleton/Publicacao/src/Publicacao/Controller/ArquivoController')
        );
    }

    /**
     * Generated from @assert ('Publicacao\Controller\ArquivoController', './Publicacao/src/Publicacao/Controller/ArquivoController.php') == false.
     *
     * @covers \InepZend\Util\Reflection::getRealClassNameWithPath
     */
    public function testGetRealClassNameWithPath4()
    {
        $this->assertEquals(
                false
                , \InepZend\Util\Reflection::getRealClassNameWithPath('Publicacao\Controller\ArquivoController', './Publicacao/src/Publicacao/Controller/ArquivoController.php')
        );
    }

    /**
     * Generated from @assert (new \InepZend\Util\Reflection) == 'InepZend\Util'.
     *
     * @covers \InepZend\Util\Reflection::getNamespace
     */
    public function testGetNamespace()
    {
        $this->assertEquals(
                'InepZend\Util'
                , \InepZend\Util\Reflection::getNamespace(new \InepZend\Util\Reflection)
        );
    }

    /**
     * Generated from @assert (new \InepZend\Util\Reflection, true) == array('InepZend', 'Util').
     *
     * @covers \InepZend\Util\Reflection::getNamespace
     */
    public function testGetNamespace2()
    {
        $this->assertEquals(
                array('InepZend', 'Util')
                , \InepZend\Util\Reflection::getNamespace(new \InepZend\Util\Reflection, true)
        );
    }

    /**
     * Generated from @assert ('\InepZend\Util\Reflection') == '\InepZend\Util'.
     *
     * @covers \InepZend\Util\Reflection::getNamespace
     */
    public function testGetNamespace3()
    {
        $this->assertEquals(
                '\InepZend\Util'
                , \InepZend\Util\Reflection::getNamespace('\InepZend\Util\Reflection')
        );
    }

    /**
     * Generated from @assert ('\InepZend\Util\Reflection', true) == array('', 'InepZend', 'Util').
     *
     * @covers \InepZend\Util\Reflection::getNamespace
     */
    public function testGetNamespace4()
    {
        $this->assertEquals(
                array('', 'InepZend', 'Util')
                , \InepZend\Util\Reflection::getNamespace('\InepZend\Util\Reflection', true)
        );
    }

    /**
     * Generated from @assert ('string') == ''.
     *
     * @covers \InepZend\Util\Reflection::getNamespace
     */
    public function testGetNamespace5()
    {
        $this->assertEquals(
                ''
                , \InepZend\Util\Reflection::getNamespace('string')
        );
    }

    /**
     * Generated from @assert ('string', true) == array().
     *
     * @covers \InepZend\Util\Reflection::getNamespace
     */
    public function testGetNamespace6()
    {
        $this->assertEquals(
                array()
                , \InepZend\Util\Reflection::getNamespace('string', true)
        );
    }

    /**
     * Generated from @assert (new \InepZend\Util\Reflection) == dirname((new \ReflectionClass('\InepZend\Util\Reflection'))->getFileName()).
     *
     * @covers \InepZend\Util\Reflection::getFileNameFromClass
     */
    public function testGetFileNameFromClass()
    {
        $this->assertEquals(
                dirname((new \ReflectionClass('\InepZend\Util\Reflection'))->getFileName())
                , \InepZend\Util\Reflection::getFileNameFromClass(new \InepZend\Util\Reflection)
        );
    }

    /**
     * Generated from @assert ('\InepZend\Util\Reflection') == dirname((new \ReflectionClass('\InepZend\Util\Reflection'))->getFileName()).
     *
     * @covers \InepZend\Util\Reflection::getFileNameFromClass
     */
    public function testGetFileNameFromClass2()
    {
        $this->assertEquals(
                dirname((new \ReflectionClass('\InepZend\Util\Reflection'))->getFileName())
                , \InepZend\Util\Reflection::getFileNameFromClass('\InepZend\Util\Reflection')
        );
    }

    /**
     * Generated from @assert ((new \InepZend\Util\stdClass()), 'setAllAttribute', array('param1' => 1, 'param2' => 2)) == true.
     *
     * @covers \InepZend\Util\Reflection::invokeNotAccessibleMethod
     */
    public function testInvokeNotAccessibleMethod()
    {
        $this->assertEquals(
                true
                , \InepZend\Util\Reflection::invokeNotAccessibleMethod((new \InepZend\Util\stdClass()), 'setAllAttribute', array('param1' => 1, 'param2' => 2))
        );
    }

}
