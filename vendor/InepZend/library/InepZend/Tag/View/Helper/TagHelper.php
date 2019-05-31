<?php

namespace InepZend\Tag\View\Helper;

use InepZend\Tag\Tag;
use InepZend\View\Helper\AbstractHelper;
use InepZend\Util\Server;

class TagHelper extends AbstractHelper
{

    public function getLastVersion()
    {
        $tag = new Tag(Server::getReplacedBasePathApplication('/../../../../../../config/complement/application.tag.xml'));
        return $tag->getLastVersion();
    }

}
