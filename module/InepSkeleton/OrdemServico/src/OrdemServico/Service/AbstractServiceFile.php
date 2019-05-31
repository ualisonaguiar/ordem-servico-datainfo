<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractServiceFileAngular;

abstract class AbstractServiceFile extends AbstractServiceFileAngular
{

    const CONTAINER_PATH = 'data/OrdemServico/database/';

    protected $strContainerPath = self::CONTAINER_PATH;

}
