<?php

namespace InepZend\Message;

use Zend\Mvc\Controller\Plugin\FlashMessenger as FlashMessengerZend;
use InepZend\Session\Session as Container;

class FlashMessenger extends FlashMessengerZend
{

    public function getContainer()
    {
        if ($this->container instanceof Container) {
            return $this->container;
        }
        $manager = $this->getSessionManager();
        $this->container = new Container('flashMessenger', $manager);
        return $this->container;
    }

}
