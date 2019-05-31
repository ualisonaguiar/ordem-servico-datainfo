<?php

namespace OrdemServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * @ORM\Entity(repositoryClass="OrdemServico\Entity\VwDemandaVinculadaOrdemServicoRepository")
 * @ORM\Table(name="vw_demanda_vinculada_ordem_servico")
 */
class VwDemandaVinculadaOrdemServico extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_ordem_servico;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_demanda;

    /**
     * @var \OrdemServico\Entity\Atividade
     *
     * @ORM\Id
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     */
    protected $id_atividade;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     */
    protected $nu_ordem_servico;

    /**
     * @ORM\Column(type="string", columnDefinition="string")
     * @var string
     */
    protected $descricao_os;

    /**
     * @ORM\Column(type="string", columnDefinition="string")
     * @var string
     */
    protected $dt_emissao;

    /**
     * @ORM\Column(type="string", columnDefinition="string")
     * @var string
     */
    protected $dt_prazo;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $no_catalogo_servico;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(4)")
     * @var string
     */
    protected $co_atividade;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(500)")
     * @var string
     */
    protected $no_atividade;

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
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_abertura;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $no_executor;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(500)")
     * @var string
     */
    protected $no_demanda;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $tp_situacao;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_usuario;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_catalogo_servico_atividade;

    /**
     * @return int
     */
    public function getIdOrdemServico()
    {
        return $this->id_ordem_servico;
    }

    /**
     * @param int $id_ordem_servico
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setIdOrdemServico($id_ordem_servico)
    {
        $this->id_ordem_servico = $id_ordem_servico;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdDemanda()
    {
        return $this->id_demanda;
    }

    /**
     * @param int $id_demanda
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setIdDemanda($id_demanda)
    {
        $this->id_demanda = $id_demanda;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNuOrdemServico()
    {
        return $this->nu_ordem_servico;
    }

    /**
     * @param mixed $nu_ordem_servico
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setNuOrdemServico($nu_ordem_servico)
    {
        $this->nu_ordem_servico = $nu_ordem_servico;
        return $this;
    }

    /**
     * @return string
     */
    public function getDtEmissao()
    {
        return Date::convertDate($this->dt_emissao, 'd/m/Y H:i:s');
    }

    /**
     * @param string $dt_emissao
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setDtEmissao($dt_emissao)
    {
        $this->dt_emissao = $dt_emissao;
        return $this;
    }

    /**
     * @return string
     */
    public function getDtPrazo()
    {
        return Date::convertDate($this->dt_prazo, 'd/m/Y H:i:s');
    }

    /**
     * @param string $dt_prazo
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setDtPrazo($dt_prazo)
    {
        $this->dt_prazo = $dt_prazo;
        return $this;
    }

    /**
     * @return string
     */
    public function getNoCatalogoServico()
    {
        return $this->no_catalogo_servico;
    }

    /**
     * @param string $no_catalogo_servico
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setNoCatalogoServico($no_catalogo_servico)
    {
        $this->no_catalogo_servico = $no_catalogo_servico;
        return $this;
    }

    /**
     * @return string
     */
    public function getCoAtividade()
    {
        return $this->co_atividade;
    }

    /**
     * @param string $co_atividade
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setCoAtividade($co_atividade)
    {
        $this->co_atividade = $co_atividade;
        return $this;
    }

    /**
     * @return string
     */
    public function getNoAtividade()
    {
        return $this->no_atividade;
    }

    /**
     * @param string $no_atividade
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setNoAtividade($no_atividade)
    {
        $this->no_atividade = $no_atividade;
        return $this;
    }

    /**
     * @return string
     */
    public function getVlComplexidade()
    {
        return $this->vl_complexidade;
    }

    /**
     * @param string $vl_complexidade
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setVlComplexidade($vl_complexidade)
    {
        $this->vl_complexidade = $vl_complexidade;
        return $this;
    }

    /**
     * @return string
     */
    public function getVlImpacto()
    {
        return $this->vl_impacto;
    }

    /**
     * @param string $vl_impacto
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setVlImpacto($vl_impacto)
    {
        $this->vl_impacto = $vl_impacto;
        return $this;
    }

    /**
     * @return string
     */
    public function getVlCriticidade()
    {
        return $this->vl_criticidade;
    }

    /**
     * @param string $vl_criticidade
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setVlCriticidade($vl_criticidade)
    {
        $this->vl_criticidade = $vl_criticidade;
        return $this;
    }

    /**
     * @return string
     */
    public function getVlFatorPonderacao()
    {
        return $this->vl_fator_ponderacao;
    }

    /**
     * @param string $vl_fator_ponderacao
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setVlFatorPonderacao($vl_fator_ponderacao)
    {
        $this->vl_fator_ponderacao = $vl_fator_ponderacao;
        return $this;
    }

    /**
     * @return string
     */
    public function getVlFacim()
    {
        return $this->vl_facim;
    }

    /**
     * @param string $vl_facim
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setVlFacim($vl_facim)
    {
        $this->vl_facim = $vl_facim;
        return $this;
    }

    /**
     * @return string
     */
    public function getVlQma()
    {
        return $this->vl_qma;
    }

    /**
     * @param string $vl_qma
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setVlQma($vl_qma)
    {
        $this->vl_qma = $vl_qma;
        return $this;
    }

    /**
     * @return string
     */
    public function getDtAbertura()
    {
        return Date::convertDate($this->dt_abertura, 'd/m/Y');
    }

    /**
     * @param string $dt_abertura
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setDtAbertura($dt_abertura)
    {
        $this->dt_abertura = $dt_abertura;
        return $this;
    }

    /**
     * @return string
     */
    public function getNoExecutor()
    {
        return $this->no_executor;
    }

    /**
     * @param string $no_executor
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setNoExecutor($no_executor)
    {
        $this->no_executor = $no_executor;
        return $this;
    }

    /**
     * @return string
     */
    public function getNoDemanda()
    {
        return $this->no_demanda;
    }

    /**
     * @param string $no_demanda
     */
    public function setNoDemanda($no_demanda)
    {
        $this->no_demanda = $no_demanda;
    }

    /**
     * @return Atividade
     */
    public function getIdAtividade()
    {
        return $this->id_atividade;
    }

    /**
     * @param Atividade $id_atividade
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setIdAtividade($id_atividade)
    {
        $this->id_atividade = $id_atividade;
        return $this;
    }

    /**
     * @return int
     */
    public function getTpSituacao()
    {
        return $this->tp_situacao;
    }

    /**
     * @param int $tp_situacao
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setTpSituacao($tp_situacao)
    {
        $this->tp_situacao = $tp_situacao;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescricaoOs()
    {
        return $this->descricao_os;
    }

    /**
     * @param string $descricao_os
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setDescricaoOs($descricao_os)
    {
        $this->descricao_os = $descricao_os;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param int $id_usuario
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    public function getCodigoNomeAtividade()
    {
        return $this->getCoAtividade() . ' - ' . $this->getNoAtividade();
    }

    /**
     * @return int
     */
    public function getIdCatalogoServicoAtividade()
    {
        return $this->id_catalogo_servico_atividade;
    }

    /**
     * @param int $id_catalogo_servico_atividade
     * @return VwDemandaVinculadaOrdemServico
     */
    public function setIdCatalogoServicoAtividade($id_catalogo_servico_atividade)
    {
        $this->id_catalogo_servico_atividade = $id_catalogo_servico_atividade;
        return $this;
    }

    public function getNumeroDescricaoOrdemServico()
    {
        return 'OS' . $this->getNuOrdemServico() . '-' . $this->getDescricaoOs();
    }
}