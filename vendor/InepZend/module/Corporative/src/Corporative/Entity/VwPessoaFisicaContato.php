<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * PessoaFisica
 *
 * @ORM\Table(name="CORP.VW_PESSOA_FISICA_CONTATO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwPessoaFisicaContatoRepository")
 */
class VwPessoaFisicaContato extends Entity
{

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_PESSOA_FISICA_CONTATO", type="integer", nullable=false)
     */
    protected $idPessoaFisicaContato;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_PESSOA_FISICA", type="bigint", nullable=false)
     */
    protected $coPessoaFisica;

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
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_CONTATO", type="integer", length=20, nullable=false)
     */
    protected $idTipoContato;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_CONTATO", type="string", length=150, nullable=false)
     */
    protected $txContato;

    /**
     * @var integer
     *
     * @ORM\Column(name="IN_ATIVO", type="integer", nullable=false)
     */
    protected $inAtivo;

    /**
     * Set idPessoaFisicaContato
     *
     * @param integer $idPessoaFisicaContato
     *
     * @return VwPessoaFisicaContato
     */
    public function setIdPessoaFisicaContato($idPessoaFisicaContato)
    {
        $this->idPessoaFisicaContato = $idPessoaFisicaContato;
        return $this;
    }

    /**
     * Get idPerfil
     *
     * @return integer
     */
    public function getIdPessoaFisicaContato()
    {
        return $this->idPessoaFisicaContato;
    }

    /**
     * Set coPessoaFisica
     *
     * @param integer $coPessoaFisica
     *
     * @return PessoaFisica
     */
    public function setCoPessoaFisica($coPessoaFisica)
    {
        $this->coPessoaFisica = $coPessoaFisica;
        return $this;
    }

    /**
     * Get coPessoaFisica
     *
     * @return integer
     */
    public function getCoPessoaFisica()
    {
        return $this->coPessoaFisica;
    }

    /**
     * Set idTipoContato
     *
     * @param integer $idTipoContato
     *
     * @return HistoricoPfContato
     */
    public function setIdTipoContato($idTipoContato)
    {
        $this->idTipoContato = $idTipoContato;
        return $this;
    }

    /**
     * Get idTipoContato
     *
     * @return integer
     */
    public function getIdTipoContato()
    {
        return $this->idTipoContato;
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
     * @return int
     */
    public function getInAtivo()
    {
        return $this->inAtivo;
    }

    /**
     * @param int $inAtivo
     * @return VwPessoaFisicaContato
     */
    public function setInAtivo($inAtivo)
    {
        $this->inAtivo = $inAtivo;
        return $this;
    }
}
