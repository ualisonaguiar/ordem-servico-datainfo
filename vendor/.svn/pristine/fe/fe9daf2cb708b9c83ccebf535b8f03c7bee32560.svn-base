<?php
namespace InepZend\Module\TrocaArquivo\LayoutValidacao\Service;

use InepZend\Module\TrocaArquivo\Common\Service\AbstractService;
use InepZend\Util\ArrayCollection;
use InepZend\Util\Format;
use InepZend\Exception\DomainException;

class RegraValidacao extends AbstractService
{

    protected function getDataFromLayout($intIdLayout = null)
    {
        if (empty($intIdLayout))
            throw new DomainException('Layout inexistente.');
        $arrData = array();
        $arrDataComplement = array();
        $arrData['layout'] = array(
            $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->find((integer) $intIdLayout)
        );
        $arrDataLayout = array();
        foreach ((array) $arrData['layout'] as $layout)
            $arrDataLayout['layout'][] = array(
                'no_status_layout' => Format::convertToStatus($layout->getInStatus())
            );
        $arrDataComplement = ArrayCollection::merge($arrDataComplement, $arrDataLayout, true);
        unset($arrDataLayout);
        return ArrayCollection::merge(ArrayCollection::objectToArrayRecursive($arrData), $arrDataComplement, true);
    }
}
