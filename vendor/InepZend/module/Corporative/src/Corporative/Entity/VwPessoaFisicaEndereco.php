<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * PessoaFisica
 *
 * @ORM\Table(name="CORP.VW_PESSOA_FISICA_ENDERECO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwPessoaFisicaEnderecoRepository")
 */
class VwPessoaFisicaEndereco extends Entity
{

    CONST CO_TP_ZONE_ENDERECO_URBANA = 1;
    CONST CO_TP_ZONE_ENDERECO_RURAL = 2;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_PESSOA_FISICA_ENDERECO", type="integer", nullable=false)
     */
    protected $idPessoaFisicaEndereco;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_PESSOA_FISICA", type="bigint", nullable=false)
     */
    protected $coPessoaFisica;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_LOGRADOURO", type="string", length=100, nullable=true)
     */
    protected $noLogradouro;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_ENDERECO", type="string", length=20, nullable=true)
     */
    protected $nuEndereco;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_COMPLEMENTO", type="string", length=100, nullable=true)
     */
    protected $dsComplemento;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_BAIRRO", type="string", length=100, nullable=true)
     */
    protected $noBairro;

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
     * @ORM\Column(name="ID_TIPO_ENDERECO", type="integer", nullable=true)
     */
    protected $idTipoEndereco;

    /**
     * @var integer
     *
     * @ORM\Column(name="TP_ZONA_ENDERECO", type="integer", nullable=true)
     */
    protected $tpZonaEndereco;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtAlteracao;

    /**
     * Set idPessoaFisicaEndereco
     *
     * @param integer $idPessoaFisicaEndereco
     *
     * @return VwPessoaFisicaEndereco
     */
    public function setIdPessoaFisicaEndereco($idPessoaFisicaEndereco)
    {
        $this->idPessoaFisicaEndereco = $idPessoaFisicaEndereco;
        return $this;
    }

    /**
     * Get idPerfil
     *
     * @return integer
     */
    public function getIdPessoaFisicaEndereco()
    {
        return $this->idPessoaFisicaEndereco;
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
     * Set noLogradouro
     *
     * @param string $noLogradouro
     *
     * @return CartorioEndereco
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
     * @return CartorioEndereco
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
     * Set dsComplemento
     *
     * @param string $dsComplemento
     *
     * @return CartorioEndereco
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
     * Set noBairro
     *
     * @param string $noBairro
     *
     * @return CartorioEndereco
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
     * Set coCep
     *
     * @param string $coCep
     *
     * @return CartorioEndereco
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

}
