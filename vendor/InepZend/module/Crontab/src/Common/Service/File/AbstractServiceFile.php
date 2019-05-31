<?php

namespace InepZend\Module\Crontab\Common\Service\File;

use InepZend\Service\AbstractServiceFile as AbstractServiceFileInepZend;

abstract class AbstractServiceFile extends AbstractServiceFileInepZend
{

    const CONTAINER_PATH = 'data/Crontab/database/';
    
    protected $strContainerPath = self::CONTAINER_PATH;

}
