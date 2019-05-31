<?php

namespace InepZend\Entity\Proxy;

use InepZend\Entity\Proxy\AbstractEntityProxy;

class CollectionEntityFile extends AbstractEntityProxy
{

    protected $booCollection = true;

    public function __call($strMethod, $mixArgument)
    {
        if (method_exists($this, $strMethod))
            return;
        $mixResult = $this->getResult();
        if (is_array($mixResult))
            return $mixResult;
        $service = $this->getServiceFromClass();
        $mixResult = (is_object($service)) ? $service->findBy($this->getData()) : array();
        $this->setResult($mixResult);
        return $mixResult;
    }

}
