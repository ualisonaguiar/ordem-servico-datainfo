<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;
use InepZend\Util\Reflection;

class DateTimeSpecificTest extends AbstractSpecificTest
{

    public function testAddDate()
    {
        $this->assertEquals($this->getStringDate('simple', 'Date', '140', '99/99/9999', 'Data'), self::getInstanceOf()->addDate('Date'));
    }

    public function testAddDate2()
    {
        $this->assertEquals($this->getStringDate('full', 'Date', '140', '99/99/9999'), self::getInstanceOf()->addDate('Date', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'readonly'));
    }

    public function testAddDateTime()
    {
        $this->assertEquals($this->getStringDate('simple', 'DateTime', '220', '99/99/9999 99:99', 'Data/Hora'), self::getInstanceOf()->addDateTime('DateTime'));
    }

    public function testAddDateTime2()
    {
        $this->assertEquals($this->getStringDate('full', 'DateTime', '220', '99/99/9999 99:99'), self::getInstanceOf()->addDateTime('DateTime', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'readonly'));
    }

    public function testAddTime()
    {
        $this->assertEquals($this->getStringDate('simple', 'Time', '140', '99:99', 'Hora'), self::getInstanceOf()->addTime('Time'));
    }

    public function testAddTime2()
    {
        $this->assertEquals($this->getStringDate('full', 'Time', '140', '99:99'), self::getInstanceOf()->addTime('Time', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'readonly'));
    }

    public function testAddDateRange()
    {
        $this->assertInstanceOf('InepZend\FormGenerator\FormGenerator', self::getInstanceOf()->addDateRange('DateRange', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', date('d/m/Y'), date('d/m/Y', strtotime('+5 year')), 'DataInicial', 'DataFinal', date('d/m/Y', strtotime('+2 year')), 'readonly'));
    }

    public function testGetRangeParam()
    {
        $this->assertEquals(array('name' => "DateRangestrValue", 'value' => "strValue"), Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getRangeParam', array('name' => 'DateRange', 'value_end' => 'strValue', 'sufix_end' => 'strValue'), 'end'));
    }

    public function testGetRangeParam2()
    {
        try {
            Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getRangeParam', array('DateRange', 'strValue', 'strValue'), 'end');
        } catch (\RuntimeException $runtimeException) {
            $this->assertEquals('Os parâmetros editados não estão no formato esperado.', $runtimeException->getMessage());
        }
    }

    public function testSetNameRange()
    {
        $this->assertEquals(array("DateRangeInicial", "DateRangeFinal"), Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'setNameRange', 'DateRange', 'DateRangeInicial', 'DateRangeFinal'));
    }

    public function testSetNameRange2()
    {
        $this->assertFalse(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'setNameRange', null));
    }

    public function testGetNameRange()
    {
        $this->assertArrayHasKey('DateRange', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getNameRange', null));
    }

    private function getStringDate($strType = 'simple', $strDateTime = null, $intSize = '140', $strMask = null, $strLabel = null)
    {
        if ($strType == 'simple') {
            $arrResult = array(
                'name' => $strDateTime,
                'attributes' => array(
                    'id' => $strDateTime,
                    'placeholder' => 'Entre com a ' . $strLabel,
                    'title' => $strLabel,
                    'validate_message' => 'fieldset_group',
                    'style' => 'width: ' . $intSize . 'px; '),
                'options' => array(
                    'label' => $strLabel,
                    'type' => 'text',
                    'mask' => $strMask)
            );
            if (in_array($strLabel, array('Data', 'Hora')))
                unset($arrResult['attributes']['title'], $arrResult['options']['label']);
            return $arrResult;
        }
        return array(
            'name' => $strDateTime,
            'attributes' => array(
                'id' => $strDateTime,
                'validate_message' => 'strTypeValidateMessage',
                'style' => 'width: ' . $intSize . 'px; strStyle',
                'value' => 'strValue',
                'placeholder' => 'strPlaceHolder',
                'required' => 'required',
                'title' => 'strTitle',
                'class' => 'strClass',
                'label_class' => 'strLabelClass',
                'label_style' => 'strLabelStyle',
                'help_text' => 'strHelpText',
                'disabled' => 'strDisabled',
                'tabindex' => 10,
                'data-0' => 'strName',
                'data-1' => 'strId',
                'group_class' => 'strGroupClass',
                'group_style' => 'strGroupStyle',
                'readonly' => 'readonly'),
            'options' => array(
                'type' => 'text',
                'mask' => $strMask,
                'label' => 'strLabel')
        );
    }

}
