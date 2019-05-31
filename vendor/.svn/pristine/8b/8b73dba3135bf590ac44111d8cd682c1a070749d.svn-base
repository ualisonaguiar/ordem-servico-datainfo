<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * PessoaContato
 *
 * @ORM\Table(name="CORP.TC_PESSOA_CONTATO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\PessoaContatoRepository")
 */
class PessoaContato extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_CONTATO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CORP.SEQ_PESSOA_CONTATO", allocationSize=1, initialValue=1)
     */
    protected $idPessoaContato;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_DDD", type="integer", nullable=true)
     */
    protected $nuDdd;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_DDI", type="integer", nullable=true)
     */
    protected $nuDdi;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_RAMAL", type="integer", nullable=true)
     */
    protected $nuRamal;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_CONTATO", type="string", length=20, nullable=false)
     */
    protected $tpContato;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_CONTATO", type="string", length=150, nullable=false)
     */
    protected $txContato;

    /**
     * @var \InepZend\Module\Corporative\Entity\PessoaFisica
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\PessoaFisica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_PESSOA_FISICA", referencedColumnName="ID_PESSOA_FISICA")
     * })
     */
    protected $idPessoaFisica;


    /**
     * Get idPessoaContato
     *
     * @return integer 
     */
    public function getIdPessoaContato()
    {
        return $this->idPessoaContato;
    }

    /**
     * Set nuDdd
     *
     * @param integer $nuDdd
     *
     * @return PessoaContato
     */
    public function setNuDdd($nuDdd)
    {
        $this->nuDdd = $nuDdd;
        return $this;
    }

    /**
     * Get nuDdd
     *
     * @return integer 
     */
    public function getNuDdd()
    {
        return $this->nuDdd;
    }

    /**
     * Set nuDdi
     *
     * @param integer $nuDdi
     *
     * @return PessoaContato
     */
    public function setNuDdi($nuDdi)
    {
        $this->nuDdi = $nuDdi;
        return $this;
    }

    /**
     * Get nuDdi
     *
     * @return integer 
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
     * @return PessoaContato
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
     * @return PessoaContato
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
     * @return PessoaContato
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
     * Set idPessoaFisica
     *
     * @param \InepZend\Module\Corporative\Entity\PessoaFisica $idPessoaFisica
     *
     * @return PessoaContato
     */
    public function setIdPessoaFisica(\InepZend\Module\Corporative\Entity\PessoaFisica $idPessoaFisica = null)
    {
        $this->idPessoaFisica = $idPessoaFisica;
        return $this;
    }

    /**
     * Get idPessoaFisica
     *
     * @return \InepZend\Module\Corporative\Entity\PessoaFisica 
     */
    public function getIdPessoaFisica()
    {
        return $this->idPessoaFisica;
    }
}

