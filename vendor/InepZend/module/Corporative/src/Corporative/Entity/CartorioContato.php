<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * CartorioContato
 *
 * @ORM\Table(name="CORP.TC_CARTORIO_CONTATO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\CartorioContatoRepository")
 */
class CartorioContato extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_CONTATO", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_CARTORIO_CONTATO_ID_CONTATO", allocationSize=1, initialValue=1)
     */
    protected $idContato;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    protected $inAtivo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DDD", type="string", length=3, nullable=true)
     */
    protected $nuDdd;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_CONTATO", type="string", length=1, nullable=false)
     */
    protected $tpContato;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_CONTATO", type="string", length=255, nullable=true)
     */
    protected $txContato;

    /**
     * @var \InepZend\Module\Corporative\Entity\Cartorio
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Cartorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_CARTORIO", referencedColumnName="ID_CARTORIO")
     * })
     */
    protected $idCartorio;


    /**
     * Get idContato
     *
     * @return integer 
     */
    public function getIdContato()
    {
        return $this->idContato;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return CartorioContato
     */
    public function setInAtivo($inAtivo)
    {
        $this->inAtivo = $inAtivo;
        return $this;
    }

    /**
     * Get inAtivo
     *
     * @return boolean 
     */
    public function getInAtivo()
    {
        return $this->inAtivo;
    }

    /**
     * Set nuDdd
     *
     * @param string $nuDdd
     *
     * @return CartorioContato
     */
    public function setNuDdd($nuDdd)
    {
        $this->nuDdd = $nuDdd;
        return $this;
    }

    /**
     * Get nuDdd
     *
     * @return string 
     */
    public function getNuDdd()
    {
        return $this->nuDdd;
    }

    /**
     * Set tpContato
     *
     * @param string $tpContato
     *
     * @return CartorioContato
     */
    public function setTpContato($tpContato)
    {
        $this->tpContato = $tpContato;
        return $this;
    }

    /**
     * Get tpContato
     *
     * @return string 
     */
    public function getTpContato()
    {
        return $this->tpContato;
    }

    /**
     * Set txContato
     *
     * @param string $txContato
     *
     * @return CartorioContato
     */
    public function setTxContato($txContato)
    {
        $this->txContato = $txContato;
        return $this;
    }

    /**
     * Get txContato
     *
     * @return string 
     */
    public function getTxContato()
    {
        return $this->txContato;
    }

    /**
     * Set idCartorio
     *
     * @param \InepZend\Module\Corporative\Entity\Cartorio $idCartorio
     *
     * @return CartorioContato
     */
    public function setIdCartorio(\InepZend\Module\Corporative\Entity\Cartorio $idCartorio = null)
    {
        $this->idCartorio = $idCartorio;
        return $this;
    }

    /**
     * Get idCartorio
     *
     * @return \InepZend\Module\Corporative\Entity\Cartorio 
     */
    public function getIdCartorio()
    {
        return $this->idCartorio;
    }
}

