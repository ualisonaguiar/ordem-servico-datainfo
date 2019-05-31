<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Banco
 *
 * @ORM\Table(name="CORP.VW_BANCO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwBancoRepository")
 */
class VwBanco extends Entity
{

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_BANCO", type="integer", nullable=false)
     */
    protected $coBanco;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_BANCO", type="string", length=100, nullable=false)
     */
    protected $dsBanco;

    /**
     * @var string
     *
     * @ORM\Column(name="ST_ATIVO", type="string", length=1, nullable=false)
     */
    protected $stAtivo;

    /**
     * Set coBanco
     *
     * @param integer $coBanco
     *
     * @return Banco
     */
    public function setCoBanco($coBanco)
    {
        $this->coBanco = $coBanco;
        return $this;
    }

    /**
     * Get coBanco
     *
     * @return integer 
     */
    public function getCoBanco()
    {
        return $this->coBanco;
    }

    /**
     * Set dsBanco
     *
     * @param string $dsBanco
     *
     * @return Banco
     */
    public function setDsBanco($dsBanco)
    {
        $this->dsBanco = $dsBanco;
        return $this;
    }

    /**
     * Get dsBanco
     *
     * @return string 
     */
    public function getDsBanco()
    {
        return $this->dsBanco;
    }

    /**
     * Set stAtivo
     *
     * @param string $stAtivo
     *
     * @return Banco
     */
    public function setStAtivo($stAtivo)
    {
        $this->stAtivo = $stAtivo;
        return $this;
    }

    /**
     * Get stAtivo
     *
     * @return string
     */
    public function getStAtivo()
    {
        return $this->stAtivo;
    }

}
