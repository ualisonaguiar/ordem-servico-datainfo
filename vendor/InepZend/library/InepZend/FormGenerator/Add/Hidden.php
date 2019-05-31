<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular o Element do tipo Hidden.
 */
trait Hidden
{

    /**
     * Metodo responsável em inserir o Element Hidden.
     * 
     * @example $this->addHidden($strName, $strValue, $strId, $arrAttributeData);
     * 
     * @param string $strName
     * @param string $strValue
     * @param string $strId
     * @param array $arrAttributeData
     * @return mix
     */
    public function addHidden($strName, $strValue = null, $strId = null, $arrAttributeData = null)
    {
        $arrAttribute = array(
            'type' => array('addAttribute', 'hidden'),
        );
        return $this->getElementConfigured(func_get_args(), func_num_args(), null, $arrAttribute, $this->addDefault(func_get_args(), $this->removeParamDefault(array(3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 18, 19))));
    }

}
