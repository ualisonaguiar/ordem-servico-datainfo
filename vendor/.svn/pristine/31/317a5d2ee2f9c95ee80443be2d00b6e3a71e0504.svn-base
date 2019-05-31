<?php

namespace InepZend\Filter\Add;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Util\Format;
use InepZend\Exception\RuntimeException;

trait Phone
{

    public function addFilterPhone(
            $strName,
            $booRequired = false,
            $arrFilters = array(),
            $arrValidators = array(),
            $strMessageRequired = null)
    {
        $arrParamPhone = $this->getParamEdited(func_get_args(), func_num_args());
        $booDdd = FormGenerator::getDddPhone($arrParamPhone['name']);
        if (!is_bool($booDdd))
            return false;
        $strMessageException = 'Não foi possível filtrar os elementos de telefone no formulário.';
        $arrFilter = $this->addFilter($arrParamPhone);
        if (!is_array($arrFilter))
            throw new RuntimeException($strMessageException);
        if ($booDdd) {
            $arrParamPhone['name'] = FormGenerator::getPrefixDdd() . $arrParamPhone['name'];
            $arrFilter = $this->addFilter($arrParamPhone);
            if (!is_array($arrFilter))
                throw new RuntimeException($strMessageException);
//            $arrOption = null;
//            if (!array_key_exists('Callback', $arrValidators)) {
//                $arrOption = array(
//                    'messages' => array(
//                        'callbackValue' => 'O telefone está com formato diferente do exigido pelo respectivo DDD',
//                    ),
//                    'callback' => function($mixValue, $arrContext = array(), $arrOptionCallback) {
//                        $intDdd = $arrContext[$arrOptionCallback[0]];
//                        $intPhone = $arrContext[$arrOptionCallback[1]];
//                        $intDigit = (in_array((integer) $intDdd, Format::listDdd(true))) ? 9 : 8;
//                        return (strlen($intPhone) == $intDigit);
//                    },
//                    'callbackOptions' => array(
//                        array($arrParamPhone['name'], str_replace(FormGenerator::getPrefixDdd(), '', $arrParamPhone['name']))
//                    ),
//                );
//            }
//            if (!empty($arrOption)) {
//                $this->addValidators($arrFilter, 'Callback', $arrOption);
//                $this->setFilter($arrFilter);
//            }
        }
        return true;
    }

    public function addFilterPhoneCrud()
    {
        $this->addFilter(array('name' => 'coTipoTelefone'));
        $this->addFilterPhone(array('name' => 'nuTelefone'));
    }

}
