<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistoricoPfContato
 *
 * @ORM\Table(name="CORP.TB_HISTORICO_PF_CONTATO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\HistoricoPfContatoRepository")
 */
class HistoricoPfContato extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PESSOA_FISICA", type="bigint", nullable=false)
     */
    protected $coPessoaFisica;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_FISICA_CONTATO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $idPessoaFisicaContato;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_CONTATO", type="integer", nullable=true)
     */
    protected $idTipoContato;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=false)
     */
    protected $idUsuarioAlteracao;

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
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $nuOperacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_RAMAL", type="integer", nullable=true)
     */
    protected $nuRamal;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_CONTATO", type="string", length=150, nullable=false)
     */
    protected $txContato;


    /**
     * Set coPessoaFisica
     *
     * @param integer $coPessoaFisica
     *
     * @return HistoricoPfContato
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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistoricoPfContato
     */
    public function setDtAlteracao($dtAlteracao)
    {
        $this->dtAlteracao = $dtAlteracao;
        return $this;
    }

    /**
     * Get dtAlteracao
     *
     * @return \DateTime
     */
    public function getDtAlteracao()
    {
        return Date::convertDate($this->dtAlteracao, "d/m/Y");
    }

    /**
     * Set idPessoaFisicaContato
     *
     * @param integer $idPessoaFisicaContato
     *
     * @return HistoricoPfContato
     */
    public function setIdPessoaFisicaContato($idPessoaFisicaContato)
    {
        $this->idPessoaFisicaContato = $idPessoaFisicaContato;
        return $this;
    }

    /**
     * Get idPessoaFisicaContato
     *
     * @return integer
     */
    public function getIdPessoaFisicaContato()
    {
        return $this->idPessoaFisicaContato;
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
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistoricoPfContato
     */
    public function setIdUsuarioAlteracao($idUsuarioAlteracao)
    {
        $this->idUsuarioAlteracao = $idUsuarioAlteracao;
        return $this;
    }

    /**
     * Get idUsuarioAlteracao
     *
     * @return integer
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->idUsuarioAlteracao;
    }

    /**
     * Set nuDdd
     *
     * @param integer $nuDdd
     *
     * @return HistoricoPfContato
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
     * @return HistoricoPfContato
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistoricoPfContato
     */
    public function setNuOperacao($nuOperacao)
    {
        $this->nuOperacao = $nuOperacao;
        return $this;
    }

    /**
     * Get nuOperacao
     *
     * @return integer
     */
    public function getNuOperacao()
    {
        return $this->nuOperacao;
    }

    /**
     * Set nuRamal
     *
     * @param integer $nuRamal
     *
     * @return HistoricoPfContato
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
     * @return HistoricoPfContato
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

