<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\View\Helper\RendererTrait;
use InepZend\View\Helper\AbstractHtmlHeadHelper;

class EventCalendarHelper extends AbstractHelper
{

    use RendererTrait;

    private $strId = 'divEventCalendar';
    private $intHeight;
    private $booSelectable = false;
    private $booDroppable = false;
    private $booEditable = false;
    private $strCallbackEvents;
    private $strCallbackClickDay;
    private $strCallbackClickEvent;
    private $strCallbackSelect;
    private $strCallbackUnselect;
    private $strCallbackDrop;
    private static $booInclude = false;

    public function setId($strId = null)
    {
        $this->strId = $strId;
        return $this;
    }

    public function getId()
    {
        return $this->strId;
    }

    public function setHeight($intHeight = null)
    {
        $this->intHeight = $intHeight;
        return $this;
    }

    public function getHeight()
    {
        return $this->intHeight;
    }

    public function setSelectable($booSelectable = false)
    {
        $this->booSelectable = $booSelectable;
        return $this;
    }

    public function getSelectable()
    {
        return $this->booSelectable;
    }

    public function setDroppable($booDroppable = false)
    {
        $this->booDroppable = $booDroppable;
        return $this;
    }

    public function getDroppable()
    {
        return $this->booDroppable;
    }

    public function setEditable($booEditable = null)
    {
        $this->booEditable = $booEditable;
        return $this;
    }

    public function getEditable()
    {
        return $this->booEditable;
    }

    public function setCallbackEvents($strCallbackEvents = null)
    {
        $this->strCallbackEvents = $strCallbackEvents;
        return $this;
    }

    public function getCallbackEvents()
    {
        return $this->strCallbackEvents;
    }

    public function setCallbackClickDay($strCallbackClickDay = null)
    {
        $this->strCallbackClickDay = $strCallbackClickDay;
        return $this;
    }

    public function getCallbackClickDay()
    {
        return $this->strCallbackClickDay;
    }

    public function setCallbackClickEvent($strCallbackClickEvent = null)
    {
        $this->strCallbackClickEvent = $strCallbackClickEvent;
        return $this;
    }

    public function getCallbackClickEvent()
    {
        return $this->strCallbackClickEvent;
    }

    public function setCallbackSelect($strCallbackSelect = null)
    {
        $this->strCallbackSelect = $strCallbackSelect;
        if (!empty($strCallbackSelect))
            $this->setSelectable(true);
        return $this;
    }

    public function getCallbackSelect()
    {
        return $this->strCallbackSelect;
    }

    public function setCallbackUnselect($strCallbackUnselect = null)
    {
        $this->strCallbackUnselect = $strCallbackUnselect;
        if (!empty($strCallbackUnselect))
            $this->setSelectable(true);
        return $this;
    }

    public function getCallbackUnselect()
    {
        return $this->strCallbackUnselect;
    }

    public function setCallbackDrop($strCallbackDrop = null)
    {
        $this->strCallbackDrop = $strCallbackDrop;
        if (!empty($strCallbackDrop))
            $this->setDroppable(true);
        return $this;
    }

    public function getCallbackDrop()
    {
        return $this->strCallbackDrop;
    }

    public function render()
    {
        $strResult = '';
        if (!self::$booInclude) {
            $this->includeFile();
            self::$booInclude = true;
        }
        $strId = $this->getId();
        $intHeight = $this->getHeight();
        $booSelectable = $this->getSelectable();
        $booDroppable = $this->getDroppable();
        $booEditable = $this->getEditable();
        $strCallbackEvents = $this->getCallbackEvents();
        $strCallbackClickDay = $this->getCallbackClickDay();
        $strCallbackClickEvent = $this->getCallbackClickEvent();
        $strCallbackSelect = $this->getCallbackSelect();
        $strCallbackUnselect = $this->getCallbackUnselect();
        $strCallbackDrop = $this->getCallbackDrop();
        if (!empty($strCallbackDrop))
            $strResult .= '<script type="text/javascript" src="' . $this->getBaseUrl() . '/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js' . AbstractHtmlHeadHelper::getSufixJsGzip() . '"></script>';
        $strResult .= '<script type="text/javascript">
$(document).ready(function() {
    $("#' . $strId . '").fullCalendar({
        header: {
            left: "prev,next today",
            center: "title",
            right: "month,basicWeek,basicDay"
        }
        , lang: "pt-br"
        , theme: true
        , weekNumbers: true
        , eventLimit: true
        ' . ((!empty($intHeight)) ? ', height: ' . $intHeight : '') . '
        ' . ((is_bool($booSelectable)) ? ', selectable: ' . (($booSelectable) ? 'true' : 'false') : '') . '
        ' . ((is_bool($booDroppable)) ? ', droppable: ' . (($booDroppable) ? 'true' : 'false') : '') . '
        ' . ((is_bool($booEditable)) ? ', editable: ' . (($booEditable) ? 'true' : 'false') : '') . '
        ' . ((!empty($strCallbackClickDay)) ? ', dayClick: function(date, jsEvent, view) { eval("' . $strCallbackClickDay . '(date, jsEvent, view);"); }' : '') . '
        ' . ((!empty($strCallbackClickEvent)) ? ', eventClick: function(calEvent, jsEvent, view) { eval("' . $strCallbackClickEvent . '(calEvent, jsEvent, view);"); }' : '') . '
        ' . ((!empty($strCallbackSelect)) ? ', select: function(start, end, jsEvent, view) { eval("' . $strCallbackSelect . '(start, end, jsEvent, view);"); }' : '') . '
        ' . ((!empty($strCallbackUnselect)) ? ', unselect: function(jsEvent, view) { eval("' . $strCallbackUnselect . '(jsEvent, view);"); }' : '') . '
        ' . ((!empty($strCallbackDrop)) ? ', drop: function(date, jsEvent, ui) { eval("' . $strCallbackDrop . '(date, jsEvent, ui);"); }' : '') . '
        ' . ((!empty($strCallbackEvents)) ? ', events: ' . $strCallbackEvents . '()' : '') . '
    });
});
//function listEvent()
//{
//    // Array
//    var mixEvent = [
//        {
//            title: "All Day Event",
//            start: "2015-02-01"
//        },
//        {
//            title: "Long Event",
//            start: "2015-02-07",
//            end: "2015-02-10"
//        },
//        {
//            id: 999,
//            title: "Repeating Event",
//            start: "2015-02-09T16:00:00"
//        },
//        {
//            id: 999,
//            title: "Repeating Event",
//            start: "2015-02-16T16:00:00"
//        },
//        {
//            title: "Conference",
//            start: "2015-02-11",
//            end: "2015-02-13"
//        },
//        {
//            title: "Meeting",
//            start: "2015-02-12T10:30:00",
//            end: "2015-02-12T12:30:00"
//        },
//        {
//            title: "Click for Google",
//            url: "http://google.com/",
//            start: "2015-02-28"
//        }
//    ];
//    // OU
//    // Object
////    var mixEvent = {
////        url: strGlobalBasePath + "/list-events.php",
////        cache: false
////    };
//    return mixEvent;
//}
</script><div class="divEventCalendar" id="' . $strId . '"></div>';
        return $strResult;
    }

    private function includeFile()
    {
        self::getRenderer()->headLink()->appendStylesheet($this->getBaseUrl() . '/vendor/fullcalendar/fullcalendar-2.3.1/fullcalendar.min.css' . AbstractHtmlHeadHelper::getSufixCssGzip());
        self::getRenderer()->headLink()->appendStylesheet($this->getBaseUrl() . '/vendor/fullcalendar/fullcalendar-2.3.1/fullcalendar.print.css' . AbstractHtmlHeadHelper::getSufixCssGzip(), 'print');
        self::getRenderer()->headScript()->appendFile($this->getBaseUrl() . '/vendor/fullcalendar/fullcalendar-2.3.1/lib/moment.min.js' . AbstractHtmlHeadHelper::getSufixJsGzip());
        self::getRenderer()->headScript()->appendFile($this->getBaseUrl() . '/vendor/fullcalendar/fullcalendar-2.3.1/fullcalendar.min.js' . AbstractHtmlHeadHelper::getSufixJsGzip());
        self::getRenderer()->headScript()->appendFile($this->getBaseUrl() . '/vendor/fullcalendar/fullcalendar-2.3.1/lang/pt-br.js' . AbstractHtmlHeadHelper::getSufixJsGzip());
    }

}
