<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistoricoPfEndereco
 *
 * @ORM\Table(name="CORP.TB_HISTORICO_PF_ENDERECO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\HistoricoPfEnderecoRepository")
 */
class HistoricoPfEndereco extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="CO_CEP", type="string", length=8, nullable=true)
     */
    protected $coCep;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PAIS", type="integer", nullable=true)
     */
    protected $coPais;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PESSOA_FISICA", type="bigint", nullable=false)
     */
    protected $coPessoaFisica;

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
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $idPessoaFisicaEndereco;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_ENDERECO", type="integer", nullable=true)
     */
    protected $idTipoEndereco;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=false)
     */
    protected $idUsuarioAlteracao;

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
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $nuOperacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="TP_ZONA_ENDERECO", type="integer", nullable=true)
     */
    protected $tpZonaEndereco;


    /**
     * Set coCep
     *
     * @param string $coCep
     *
     * @return HistoricoPfEndereco
     */
    public function setCoCep($coCep)
    {
        $this->coCep = $coCep;
        return $this;
    }

    /**
     * Get coCep
     *
     * @return string
     */
    public function getCoCep()
    {
        return $this->coCep;
    }

    /**
     * Set coPais
     *
     * @param integer $coPais
     *
     * @return HistoricoPfEndereco
     */
    public function setCoPais($coPais)
    {
        $this->coPais = $coPais;
        return $this;
    }

    /**
     * Get coPais
     *
     * @return integer
     */
    public function getCoPais()
    {
        return $this->coPais;
    }

    /**
     * Set coPessoaFisica
     *
     * @param integer $coPessoaFisica
     *
     * @return HistoricoPfEndereco
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
     * Set dsComplemento
     *
     * @param string $dsComplemento
     *
     * @return HistoricoPfEndereco
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
     * @return HistoricoPfEndereco
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
     * Set idPessoaFisicaEndereco
     *
     * @param integer $idPessoaFisicaEndereco
     *
     * @return HistoricoPfEndereco
     */
    public function setIdPessoaFisicaEndereco($idPessoaFisicaEndereco)
    {
        $this->idPessoaFisicaEndereco = $idPessoaFisicaEndereco;
        return $this;
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
     * Set idTipoEndereco
     *
     * @param integer $idTipoEndereco
     *
     * @return HistoricoPfEndereco
     */
    public function setIdTipoEndereco($idTipoEndereco)
    {
        $this->idTipoEndereco = $idTipoEndereco;
        return $this;
    }

    /**
     * Get idTipoEndereco
     *
     * @return integer
     */
    public function getIdTipoEndereco()
    {
        return $this->idTipoEndereco;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistoricoPfEndereco
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
     * Set noBairro
     *
     * @param string $noBairro
     *
     * @return HistoricoPfEndereco
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
     * @return HistoricoPfEndereco
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
     * @return HistoricoPfEndereco
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
     * @return HistoricoPfEndereco
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
     * @return HistoricoPfEndereco
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
}

