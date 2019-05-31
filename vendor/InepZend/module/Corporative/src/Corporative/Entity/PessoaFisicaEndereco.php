<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * PessoaFisicaEndereco
 *
 * @ORM\Table(name="CORP.TB_PESSOA_FISICA_ENDERECO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\PessoaFisicaEnderecoRepository")
 */
class PessoaFisicaEndereco extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_COMPLEMENTO", type="string", length=100, nullable=true)
     */
    protected $dsComplemento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_FISICA_ENDERECO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CORP.SEQ_PESSOA_ENDERECO", allocationSize=1, initialValue=1)
     */
    protected $idPessoaFisicaEndereco;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_BAIRRO", type="string", length=100, nullable=true)
     */
    protected $noBairro;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_LOGRADOURO", type="string", length=100, nullable=false)
     */
    protected $noLogradouro;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_ENDERECO", type="string", length=20, nullable=false)
     */
    protected $nuEndereco;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     */
    protected $nuOperacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="TP_ZONA_ENDERECO", type="integer", nullable=true)
     */
    protected $tpZonaEndereco;

    /**
     * @var \InepZend\Module\Corporative\Entity\Cep
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Cep")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_CEP", referencedColumnName="CO_CEP")
     * })
     */
    protected $coCep;

    /**
     * @var \InepZend\Module\Corporative\Entity\Pais
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Pais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_PAIS", referencedColumnName="CO_PAIS")
     * })
     */
    protected $coPais;

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
     * @var \InepZend\Module\Corporative\Entity\TipoEndereco
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\TipoEndereco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_TIPO_ENDERECO", referencedColumnName="ID_TIPO_ENDERECO")
     * })
     */
    protected $idTipoEndereco;

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
     * Set dsComplemento
     *
     * @param string $dsComplemento
     *
     * @return PessoaFisicaEndereco
     */
    public function setDsComplemento($dsComplemento)
    {
        $this->dsComplemento = $dsComplemento;
        return $this;
    }

    /**
     * Get dsComplemento
     *
     * @return string 
     */
    public function getDsComplemento()
    {
        return $this->dsComplemento;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return PessoaFisicaEndereco
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
     * Get idPessoaFisicaEndereco
     *
     * @return integer 
     */
    public function getIdPessoaFisicaEndereco()
    {
        return $this->idPessoaFisicaEndereco;
    }

    /**
     * Set noBairro
     *
     * @param string $noBairro
     *
     * @return PessoaFisicaEndereco
     */
    public function setNoBairro($noBairro)
    {
        $this->noBairro = $noBairro;
        return $this;
    }

    /**
     * Get noBairro
     *
     * @return string 
     */
    public function getNoBairro()
    {
        return $this->noBairro;
    }

    /**
     * Set noLogradouro
     *
     * @param string $noLogradouro
     *
     * @return PessoaFisicaEndereco
     */
    public function setNoLogradouro($noLogradouro)
    {
        $this->noLogradouro = $noLogradouro;
        return $this;
    }

    /**
     * Get noLogradouro
     *
     * @return string 
     */
    public function getNoLogradouro()
    {
        return $this->noLogradouro;
    }

    /**
     * Set nuEndereco
     *
     * @param string $nuEndereco
     *
     * @return PessoaFisicaEndereco
     */
    public function setNuEndereco($nuEndereco)
    {
        $this->nuEndereco = $nuEndereco;
        return $this;
    }

    /**
     * Get nuEndereco
     *
     * @return string 
     */
    public function getNuEndereco()
    {
        return $this->nuEndereco;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return PessoaFisicaEndereco
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
     * Set tpZonaEndereco
     *
     * @param integer $tpZonaEndereco
     *
     * @return PessoaFisicaEndereco
     */
    public function setTpZonaEndereco($tpZonaEndereco)
    {
        $this->tpZonaEndereco = $tpZonaEndereco;
        return $this;
    }

    /**
     * Get tpZonaEndereco
     *
     * @return integer 
     */
    public function getTpZonaEndereco()
    {
        return $this->tpZonaEndereco;
    }

    /**
     * Set coCep
     *
     * @param \InepZend\Module\Corporative\Entity\Cep $coCep
     *
     * @return PessoaFisicaEndereco
     */
    public function setCoCep(\InepZend\Module\Corporative\Entity\Cep $coCep = null)
    {
        $this->coCep = $coCep;
        return $this;
    }

    /**
     * Get coCep
     *
     * @return \InepZend\Module\Corporative\Entity\Cep 
     */
    public function getCoCep()
    {
        return $this->coCep;
    }

    /**
     * Set coPais
     *
     * @param \InepZend\Module\Corporative\Entity\Pais $coPais
     *
     * @return PessoaFisicaEndereco
     */
    public function setCoPais(\InepZend\Module\Corporative\Entity\Pais $coPais = null)
    {
        $this->coPais = $coPais;
        return $this;
    }

    /**
     * Get coPais
     *
     * @return \InepZend\Module\Corporative\Entity\Pais 
     */
    public function getCoPais()
    {
        return $this->coPais;
    }

    /**
     * Set coPessoaFisica
     *
     * @param \InepZend\Module\Corporative\Entity\PessoaFisica $coPessoaFisica
     *
     * @return PessoaFisicaEndereco
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
     * Set idTipoEndereco
     *
     * @param \InepZend\Module\Corporative\Entity\TipoEndereco $idTipoEndereco
     *
     * @return PessoaFisicaEndereco
     */
    public function setIdTipoEndereco(\InepZend\Module\Corporative\Entity\TipoEndereco $idTipoEndereco = null)
    {
        $this->idTipoEndereco = $idTipoEndereco;
        return $this;
    }

    /**
     * Get idTipoEndereco
     *
     * @return \InepZend\Module\Corporative\Entity\TipoEndereco 
     */
    public function getIdTipoEndereco()
    {
        return $this->idTipoEndereco;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param \InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao
     *
     * @return PessoaFisicaEndereco
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
}

