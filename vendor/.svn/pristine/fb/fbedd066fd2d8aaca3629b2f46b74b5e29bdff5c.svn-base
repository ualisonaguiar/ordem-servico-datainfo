<?php

namespace InepZend\Util;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Util\Html;

class HtmlSpecificTest extends AbstractUnitTest
{

    public function testListTagHtml()
    {
        $this->assertEquals(count(Html::listTagHtml()), 128);
    }

    public function testListTagHtml2()
    {
        $booOK = true;
        foreach (Html::listTagHtml() as $arrTag) {
            if (count($arrTag) != 4) {
                $booOK = false;
                break;
            }
        }
        $this->assertEquals($booOK, true);
    }

    public function testListTagHtml3()
    {
        $booOK = true;
        foreach (Html::listTagHtml() as $arrTag) {
            if ((!array_key_exists(0, $arrTag)) || (strpos($arrTag[0], '<') === false) || (strpos($arrTag[0], '>') === false)) {
                $booOK = false;
                break;
            }
        }
        $this->assertEquals($booOK, true);
    }

    public function testListTagHtml4()
    {
        $booOK = true;
        foreach (Html::listTagHtml() as $arrTag) {
            if ((!array_key_exists(1, $arrTag)) || (!in_array($arrTag[1], array('S', 'N')))) {
                $booOK = false;
                break;
            }
        }
        $this->assertEquals($booOK, true);
    }

    public function testListTagHtml5()
    {
        $booOK = true;
        foreach (Html::listTagHtml() as $arrTag) {
            if ((!array_key_exists(2, $arrTag)) || (!in_array($arrTag[2], array(Html::TAG_TYPE_BASIC, Html::TAG_TYPE_LINK, Html::TAG_TYPE_FORMATTING, Html::TAG_TYPE_PROGRAMMING, Html::TAG_TYPE_IMAGE, Html::TAG_TYPE_META_DATA, Html::TAG_TYPE_FORM, Html::TAG_TYPE_TABLE, Html::TAG_TYPE_LIST, Html::TAG_TYPE_STYLE, Html::TAG_TYPE_FRAME)))) {
                $booOK = false;
                break;
            }
        }
        $this->assertEquals($booOK, true);
    }

    public function testListTagHtml6()
    {
        $booOK = true;
        foreach (Html::listTagHtml() as $arrTag) {
            if ((!array_key_exists(3, $arrTag)) || (empty($arrTag[3]))) {
                $booOK = false;
                break;
            }
        }
        $this->assertEquals($booOK, true);
    }

}
