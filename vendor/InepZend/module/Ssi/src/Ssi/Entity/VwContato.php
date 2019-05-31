<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Contato
 *
 * @ORM\Table(name="SSI.VW_CONTATO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\VwContatoRepository")
 */
class VwContato extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_CONTATO", type="bigint", nullable=false)
     */
    private $idContato;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SUBTIPO_CONTATO", type="smallint", nullable=true)
     */
    private $idSubtipoContato;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_USUARIO", type="integer", nullable=false)
     */
    private $idUsuario;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SUBTIPO_CONTATO", type="string", length=50, nullable=false)
     */
    private $noSubtipoContato;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DDD", type="string", length=3, nullable=true)
     */
    private $nuDdd;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DDI", type="string", length=3, nullable=true)
     */
    private $nuDdi;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_RAMAL", type="integer", nullable=true)
     */
    private $nuRamal;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_CONTATO", type="string", length=1, nullable=false)
     */
    private $tpContato;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_CONTATO", type="string", length=255, nullable=true)
     */
    private $txContato;


    /**
     * Set idContato
     *
     * @param integer $idContato
     *
     * @return Contato
     */
    public function setIdContato($idContato)
    {
        $this->idContato = $idContato;
        return $this;
    }

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
     * Set idSubtipoContato
     *
     * @param integer $idSubtipoContato
     *
     * @return Contato
     */
    public function setIdSubtipoContato($idSubtipoContato)
    {
        $this->idSubtipoContato = $idSubtipoContato;
        return $this;
    }

    /**
     * Get idSubtipoContato
     *
     * @return integer 
     */
    public function getIdSubtipoContato()
    {
        return $this->idSubtipoContato;
    }

    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     *
     * @return Contato
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return integer 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return Contato
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
     * Set noSubtipoContato
     *
     * @param string $noSubtipoContato
     *
     * @return Contato
     */
    public function setNoSubtipoContato($noSubtipoContato)
    {
        $this->noSubtipoContato = $noSubtipoContato;
        return $this;
    }

    /**
     * Get noSubtipoContato
     *
     * @return string 
     */
    public function getNoSubtipoContato()
    {
        return $this->noSubtipoContato;
    }

    /**
     * Set nuDdd
     *
     * @param string $nuDdd
     *
     * @return Contato
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
     * Set nuDdi
     *
     * @param string $nuDdi
     *
     * @return Contato
     */
    public function setNuDdi($nuDdi)
    {
        $this->nuDdi = $nuDdi;
        return $this;
    }

    /**
     * Get nuDdi
     *
     * @return string 
     */
    public function getNuDdi()
    {
        return $this->nuDdi;
    }

    /**
     * Set nuRamal
     *
     * @param integer $nuRamal
     *
     * @return Contato
     */
    public function setNuRamal($nuRamal)
    {
        $this->nuRamal = $nuRamal;
        return $this;
    }

    /**
     * Get nuRamal
     *
     * @return integer 
     */
    public function getNuRamal()
    {
        return $this->nuRamal;
    }

    /**
     * Set tpContato
     *
     * @param string $tpContato
     *
     * @return Contato
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
     * @return Contato
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
}

