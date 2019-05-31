<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * OrgaoEmissor
 *
 * @ORM\Table(name="CORP.VW_ORGAO_EMISSOR")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwOrgaoEmissorRepository")
 */
class VwOrgaoEmissor extends Entity
{

    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(name="CO_ORGAO_EMISSOR", type="integer", nullable=false)
     */
    protected $coOrgaoEmissor;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_ORGAO_EMISSOR", type="string", length=100, nullable=false)
     */
    protected $noOrgaoEmissor;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_ORGAO_EMISSOR", type="string", length=10, nullable=false)
     */
    protected $sgOrgaoEmissor;

    /**
     * Set coOrgaoEmissor
     *
     * @param integer $coOrgaoEmissor
     *
     * @return OrgaoEmissor
     */
    public function setCoOrgaoEmissor($coOrgaoEmissor)
    {
        $this->coOrgaoEmissor = $coOrgaoEmissor;
        return $this;
    }

    /**
     * Get coOrgaoEmissor
     *
     * @return integer 
     */
    public function getCoOrgaoEmissor()
    {
        return $this->coOrgaoEmissor;
    }

    /**
     * Set noOrgaoEmissor
     *
     * @param string $noOrgaoEmissor
     *
     * @return OrgaoEmissor
     */
    public function setNoOrgaoEmissor($noOrgaoEmissor)
    {
        $this->noOrgaoEmissor = $noOrgaoEmissor;
        return $this;
    }

    /**
     * Get noOrgaoEmissor
     *
     * @return string 
     */
    public function getNoOrgaoEmissor()
    {
        return $this->noOrgaoEmissor;
    }

    /**
     * Set sgOrgaoEmissor
     *
     * @param string $sgOrgaoEmissor
     *
     * @return OrgaoEmissor
     */
    public function setSgOrgaoEmissor($sgOrgaoEmissor)
    {
        $this->sgOrgaoEmissor = $sgOrgaoEmissor;
        return $this;
    }

    /**
     * Get sgOrgaoEmissor
     *
     * @return string 
     */
    public function getSgOrgaoEmissor()
    {
        return $this->sgOrgaoEmissor;
    }

    public function getNoSgOrgaoEmissor()
    {
        return $this->getNoOrgaoEmissor() . '/' . $this->getSgOrgaoEmissor();
    }

}
