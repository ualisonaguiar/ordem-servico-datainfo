<?php

namespace InepZend\Module\Executor\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Executor
 *
 * @ORM\Entity(repositoryClass="InepZend\Module\Executor\Entity\ExecutorRepository")
 */
class Executor extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_executor", type="integer", nullable=false)
     * @ORM\Id
     */
    private $idExecutor;

    /**
     * Get idExecutor
     *
     * @return integer
     */
    public function getIdExecutor()
    {
        return $this->idExecutor;
    }

    public function setIdExecutor($intIdExecutor)
    {
        $this->idExecutor = $intIdExecutor;
        return $this;
    }
}
