<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * GrauEscolaridade
 *
 * @ORM\Table(name="CORP.TC_GRAU_ESCOLARIDADE")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\GrauEscolaridadeRepository")
 */
class GrauEscolaridade extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_GRAU_ESCOLARIDADE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_GRAU_ESCOLARIDADE_CO_GRAU_E", allocationSize=1, initialValue=1)
     */
    protected $coGrauEscolaridade;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_GRAU_ESCOLARIDADE", type="string", length=60, nullable=false)
     */
    protected $noGrauEscolaridade;


    /**
     * Get coGrauEscolaridade
     *
     * @return integer 
     */
    public function getCoGrauEscolaridade()
    {
        return $this->coGrauEscolaridade;
    }

    /**
     * Set noGrauEscolaridade
     *
     * @param string $noGrauEscolaridade
     *
     * @return GrauEscolaridade
     */
    public function setNoGrauEscolaridade($noGrauEscolaridade)
    {
        $this->noGrauEscolaridade = $noGrauEscolaridade;
        return $this;
    }

    /**
     * Get noGrauEscolaridade
     *
     * @return string 
     */
    public function getNoGrauEscolaridade()
    {
        return $this->noGrauEscolaridade;
    }
}

