<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * ConselhoProfissional
 *
 * @ORM\Table(name="CORP.TC_CONSELHO_PROFISSIONAL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\ConselhoProfissionalRepository")
 */
class ConselhoProfissional extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_CONSELHO_PROFISSIONAL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_CONSELHO_PROFISSIONAL_ID_CO", allocationSize=1, initialValue=1)
     */
    protected $idConselhoProfissional;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_CONSELHO_PROFISSIONAL", type="string", length=100, nullable=false)
     */
    protected $noConselhoProfissional;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_CONSELHO_PROFISSIONAL", type="string", length=20, nullable=false)
     */
    protected $sgConselhoProfissional;


    /**
     * Get idConselhoProfissional
     *
     * @return integer 
     */
    public function getIdConselhoProfissional()
    {
        return $this->idConselhoProfissional;
    }

    /**
     * Set noConselhoProfissional
     *
     * @param string $noConselhoProfissional
     *
     * @return ConselhoProfissional
     */
    public function setNoConselhoProfissional($noConselhoProfissional)
    {
        $this->noConselhoProfissional = $noConselhoProfissional;
        return $this;
    }

    /**
     * Get noConselhoProfissional
     *
     * @return string 
     */
    public function getNoConselhoProfissional()
    {
        return $this->noConselhoProfissional;
    }

    /**
     * Set sgConselhoProfissional
     *
     * @param string $sgConselhoProfissional
     *
     * @return ConselhoProfissional
     */
    public function setSgConselhoProfissional($sgConselhoProfissional)
    {
        $this->sgConselhoProfissional = $sgConselhoProfissional;
        return $this;
    }

    /**
     * Get sgConselhoProfissional
     *
     * @return string 
     */
    public function getSgConselhoProfissional()
    {
        return $this->sgConselhoProfissional;
    }
}

