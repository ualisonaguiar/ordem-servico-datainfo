<?php

namespace InepZend\Module\Ssi\Service;

use InepZend\Service\AbstractService as AbstractServiceInepZend;

class VwPerfilAcao extends AbstractServiceInepZend
{

    public function getDQLCustom(array $arrCriteria = null)
    {
        return $this->getRepositoryEntity()->getDQLCustom($arrCriteria);
    }

    public function getPerfilAcaoUsuario()
    {
        return $this->getRepositoryEntity()->getPerfilAcaoUsuario();
    }

    public function toArray()
    {
        return $this->getRepositoryEntity()->toArray();
    }

}
