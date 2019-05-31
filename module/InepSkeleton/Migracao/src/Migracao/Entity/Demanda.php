<?php

namespace Migracao\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * @ORM\Entity(repositoryClass="Migracao\Entity\DemandaRepository")
 * @ORM\Table(name="tb_demanda")
 */
class Demanda extends Entity
{
    const NOME_SISTEMA = 'INEPSKELETON';
    const SITUACAO_ATIVO = 1;
    const SITUACAO_INATIVO = 2;
    const SITUACAO_VINCULADA = 3;
    const SITUACAO_DEMANDA_VINCULADA = 'Demanda Vínculada';

    static $arrSituacao = array(
        self::SITUACAO_ATIVO => 'Ativo',
        self::SITUACAO_VINCULADA => self::SITUACAO_DEMANDA_VINCULADA
    );

    static $arrGrauDemanda = array(
        'B' => 'BAIXO',
        'M' => 'MÉDIO',
        'A' => 'ALTO'
    );

    static $arrGrauCriticidade = array(
        'N' => 'NORMAL',
        'C' => 'CRITICO',
    );

    static $arrTypeFatorConhecimento = array(
        'D' => 'D',
        'PD' => 'PD',
        'I' => 'I',
    );

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id_demanda;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_abertura;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(500)")
     * @var string
     * @@__toString
     */
    protected $no_demanda;

    /**
     * @ORM\Column(type="string", columnDefinition="TEXT")
     * @var string
     */
    protected $ds_descricao;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $no_projeto;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $ds_ambiente;

    /**
     * @ORM\Column(type="string", columnDefinition="TEXT")
     * @var string
     */
    protected $ds_solucao;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_atividade;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_demanda_superior;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(2)")
     * @var string
     */
    protected $vl_complexidade;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(2)")
     * @var string
     */
    protected $vl_impacto;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(2)")
     * @var string
     */
    protected $vl_criticidade;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(2)")
     * @var string
     */
    protected $vl_fator_ponderacao;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(2)")
     * @var string
     */
    protected $vl_facim;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(5)")
     * @var string
     */
    protected $vl_qma;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $no_executor;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $tp_situacao;


    public function getIdDemanda()
    {
        return $this->id_demanda;
    }

    public function setIdDemanda($intIdDemanda = null)
    {
        $this->id_demanda = (is_numeric($intIdDemanda)) ? (integer) $intIdDemanda : $intIdDemanda;
        return $this;
    }

    public function getDtAbertura()
    {
        return Date::convertDate($this->dt_abertura, 'd/m/Y');
    }

    public function setDtAbertura($strDtAbertura = null)
    {
        $this->dt_abertura = $strDtAbertura;
        return $this;
    }

    public function getNoDemanda()
    {
        return $this->no_demanda;
    }

    public function setNoDemanda($strNoDemanda = null)
    {
        $this->no_demanda = $strNoDemanda;
        return $this;
    }

    public function getDsDescricao()
    {
        return $this->ds_descricao;
    }

    public function setDsDescricao($strDsDescricao = null)
    {
        $this->ds_descricao = $strDsDescricao;
        return $this;
    }

    public function getDsSolucao()
    {
        return $this->ds_solucao;
    }

    public function setDsSolucao($strDsSolucao = null)
    {
        $this->ds_solucao = $strDsSolucao;
        return $this;
    }

    public function getIdAtividade()
    {
        return $this->id_atividade;
    }

    public function setIdAtividade($intIdAtividade = null)
    {
        $this->id_atividade = (is_numeric($intIdAtividade)) ? (integer) $intIdAtividade : $intIdAtividade;
        return $this;
    }


    public function getIdDemandaSuperior()
    {
        return $this->id_demanda_superior;
    }

    public function setIdDemandaSuperior($intIdDemandaSuperior = null)
    {
        $this->id_demanda_superior = (is_numeric($intIdDemandaSuperior)) ? (integer) $intIdDemandaSuperior : $intIdDemandaSuperior;
        return $this;
    }

    public function getVlComplexidade()
    {
        return $this->vl_complexidade;
    }

    public function setVlComplexidade($strInComplexidade = null)
    {
        $this->vl_complexidade = $strInComplexidade;
        return $this;
    }

    public function getVlImpacto()
    {
        return $this->vl_impacto;
    }

    public function setVlImpacto($strInImpacto = null)
    {
        $this->vl_impacto = $strInImpacto;
        return $this;
    }

    public function getVlCriticidade()
    {
        return $this->vl_criticidade;
    }

    public function setVlCriticidade($strInCriticidade = null)
    {
        $this->vl_criticidade = $strInCriticidade;
        return $this;
    }

    public function getVlFatorPonderacao()
    {
        return $this->vl_fator_ponderacao;
    }

    public function setVlFatorPonderacao($strFatorPonderacao = null)
    {
        $this->vl_fator_ponderacao = $strFatorPonderacao;
        return $this;
    }

    public function getVlQma()
    {
        return $this->vl_qma;
    }

    public function setVlQma($strVlQma = null)
    {
        $this->vl_qma = $strVlQma;
        return $this;
    }

    public function getVlFacim()
    {
        return $this->vl_facim;
    }

    public function setVlFacim($strInFacim = null)
    {
        $this->vl_facim = $strInFacim;
        return $this;
    }

    public function getNoExecutor()
    {
        return $this->no_executor;
    }

    public function setNoExecutor($strNoExecutor = null)
    {
        $this->no_executor = $strNoExecutor;
        return $this;
    }

    public function getTpSituacao()
    {
        return $this->tp_situacao;
    }

    public function setTpSituacao($intTpSituacao = null)
    {
        $this->tp_situacao = (is_numeric($intTpSituacao)) ? (integer) $intTpSituacao : $intTpSituacao;
        return $this;
    }

    public function getNoProjeto()
    {
        return $this->no_projeto;
    }

    public function setNoProjeto($strNoProjeto = null)
    {
        $this->no_projeto = $strNoProjeto;
        return $this;
    }

    public function getDsAmbiente()
    {
        return $this->ds_ambiente;
    }

    public function setDsAmbiente($strDsAmbiente = null)
    {
        $this->ds_ambiente = $strDsAmbiente;
        return $this;
    }

    public function getSituacao()
    {
        return self::$arrSituacao[$this->getTpSituacao()];
    }
}
