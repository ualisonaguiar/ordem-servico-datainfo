<?php

namespace InepZend\Entity\Proxy;

use InepZend\Entity\Proxy\AbstractEntityProxy;
use InepZend\Util\MethodArgumentTrait;

class EntityFile extends AbstractEntityProxy
{

    use MethodArgumentTrait;

    public function __call($strMethod, $mixArgument)
    {
        if (method_exists($this, $strMethod))
            return;
        $entity = $this->getResult();
        if (!is_object($entity)) {
            $strClass = $this->getClass();
            $arrData = $this->getData();
            $service = $this->getServiceFromClass();
            if (is_object($service))
                $entity = $service->find($arrData);
            if ((!is_object($entity)) && (class_exists($strClass)))
                $entity = new $strClass($arrData);
            $this->setResult($entity);
        }
        if ((!empty($mixArgument)) && (!is_array($mixArgument)))
            $mixArgument = array($mixArgument);
        eval($this->getEvalString('$entity->', $strMethod, $mixArgument));
        return $mixResult;
    }

}
