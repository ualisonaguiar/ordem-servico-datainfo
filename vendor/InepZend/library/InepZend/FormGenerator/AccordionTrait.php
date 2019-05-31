<?php

namespace InepZend\FormGenerator;

/**
 * Trait responsavel pela manipulacao de accordions via Bootstrap.
 *
 * @package InepZend
 * @subpackage FormGenerator
 */
trait AccordionTrait
{

    protected static $booMultiselectable = true;
    
    private function headerAccordion()
    {
        if (!self::$booMultiselectable)
            $this->addHtml('<div class="panel-group" id="accordion" aria-multiselectable="true">');
    }
    
    private function footerAccordion()
    {
        if (!self::$booMultiselectable)
            $this->addHtml('</div>');
    }

    private function openAccordion($strTitle = null, $booOpened = false)
    {
        $strKey = md5($strTitle);
        $strParent = 'accordion';
        if (self::$booMultiselectable) {
            $strParent .= $strKey;
            $this->addHtml('<div class="panel-group" id="' . $strParent . '" aria-multiselectable="true">');
        }
        $this->addHtml('
    <div class="panel panel-default well" style="padding: 0px;">
        <div class="panel-heading" style="background-color: #eeeeee;">
            <h3 class="panel-title h3">
                <div data-toggle="collapse" data-parent="#' . $strParent . '" href="#' . $strKey . '" aria-expanded="true" aria-controls="' . $strKey . '" style="cursor: pointer;">
                    ' . $strTitle . '
                </div>
            </h3>
        </div>
        <div class="panel-collapse collapse' . (($booOpened) ? ' in' : '') . '" id="' . $strKey . '" style="padding-left: 10px; padding-right: 10px; padding-top: 15px; background-color: #f5f5f5; overflow: hidden;">');
    }
    
    private function closeAccordion()
    {
        $this->addHtml('
        </div>
    </div>');
        if (self::$booMultiselectable)
            $this->addHtml('</div>');
    }

}
