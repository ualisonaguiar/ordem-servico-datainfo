<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\Util\AttributeStaticTrait;
use InepZend\Authentication\AuthTrait;

trait RestCorpTrait
{

    use AuthTrait,
        AttributeStaticTrait;

    private static $booRestCorp = true;

    public static function setRestCorp($booRestCorp = null)
    {
        return self::setAttributeStatic('booRestCorp', $booRestCorp);
    }

    public static function getRestCorp()
    {
        return self::getAttributeStatic('booRestCorp');
    }

    public static function getInstanceRestCorp()
    {
        return self::getAttributeStaticInstance('InepZend\WebService\Client\Corporative\Inep\RestCorp');
    }

    public static function getInstancePessoaFisica()
    {
        return self::getAttributeStaticInstance('InepZend\WebService\Client\Corporative\ReceitaFederal\PessoaFisica');
    }

    private function getCoUsuarioSistemaDefault($intCoUsuarioSistema = null)
    {
        if (empty($intCoUsuarioSistema)) {
            if ($this->hasIdentity())
                $intCoUsuarioSistema = $this->getUserSystem()->id;
            else {
                $mixResult = $this->getService('InepZend\Module\Ssi\Service\VwUsuarioSistemaPerfil')->findByUserAdminFromSystem(null, true);
                if ((is_array($mixResult)) && (count($mixResult) > 0))
                    $intCoUsuarioSistema = $mixResult[0]->getIdUsuarioSistema();
            }
        }
        return $intCoUsuarioSistema;
    }

}
