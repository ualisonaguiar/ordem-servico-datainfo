<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * PessoaFisicaContato
 *
 * @ORM\Table(name="CORP.TB_PESSOA_FISICA_CONTATO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\PessoaFisicaContatoRepository")
 */
class PessoaFisicaContato extends Entity
{
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
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CORP.SEQ_PESSOA_CONTATO", allocationSize=1, initialValue=1)
     */
    protected $idPessoaFisicaContato;

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
     * @var \InepZend\Module\Corporative\Entity\PessoaFisica
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\PessoaFisica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_PESSOA_FISICA", referencedColumnName="CO_PESSOA_FISICA")
     * })
     */
    protected $coPessoaFisica;

    /**
     * @var \InepZend\Module\Corporative\Entity\TipoContato
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\TipoContato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_TIPO_CONTATO", referencedColumnName="ID_TIPO_CONTATO")
     * })
     */
    protected $idTipoContato;

    /**
     * @var \InepZend\Module\Corporative\Entity\UsuarioSistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\UsuarioSistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_USUARIO_ALTERACAO", referencedColumnName="CO_USUARIO_SISTEMA")
     * })
     */
    protected $idUsuarioAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="IN_ATIVO", type="integer", nullable=false)
     */
    protected $inAtivo;

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return PessoaFisicaContato
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
     * Get idPessoaFisicaContato
     *
     * @return integer 
     */
    public function getIdPessoaFisicaContato()
    {
        return $this->idPessoaFisicaContato;
    }

    /**
     * Set nuDdd
     *
     * @param integer $nuDdd
     *
     * @return PessoaFisicaContato
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
     * @return PessoaFisicaContato
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
     * @return PessoaFisicaContato
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
     * @return PessoaFisicaContato
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
     * @return PessoaFisicaContato
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
     * Set coPessoaFisica
     *
     * @param \InepZend\Module\Corporative\Entity\PessoaFisica $coPessoaFisica
     *
     * @return PessoaFisicaContato
     */
    public function setCoPessoaFisica(\InepZend\Module\Corporative\Entity\PessoaFisica $coPessoaFisica = null)
    {
        $this->coPessoaFisica = $coPessoaFisica;
        return $this;
    }

    /**
     * Get coPessoaFisica
     *
     * @return \InepZend\Module\Corporative\Entity\PessoaFisica 
     */
    public function getCoPessoaFisica()
    {
        return $this->coPessoaFisica;
    }

    /**
     * Set idTipoContato
     *
     * @param \InepZend\Module\Corporative\Entity\TipoContato $idTipoContato
     *
     * @return PessoaFisicaContato
     */
    public function setIdTipoContato(\InepZend\Module\Corporative\Entity\TipoContato $idTipoContato = null)
    {
        $this->idTipoContato = $idTipoContato;
        return $this;
    }

    /**
     * Get idTipoContato
     *
     * @return \InepZend\Module\Corporative\Entity\TipoContato 
     */
    public function getIdTipoContato()
    {
        return $this->idTipoContato;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param \InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao
     *
     * @return PessoaFisicaContato
     */
    public function setIdUsuarioAlteracao(\InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao = null)
    {
        $this->idUsuarioAlteracao = $idUsuarioAlteracao;
        return $this;
    }

    /**
     * Get idUsuarioAlteracao
     *
     * @return \InepZend\Module\Corporative\Entity\UsuarioSistema 
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->idUsuarioAlteracao;
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

