<?php

namespace OrdemServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * @ORM\Entity(repositoryClass="OrdemServico\Entity\DemandaServicoRepository")
 * @ORM\Table(name="tb_demanda_servico")
 */
class DemandaServico extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_demanda;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_catalogo_servico_atividade;

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
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_usuario_alteracao;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_alteracao;

    /**
     * Get id_demanda
     *
     * @return id_demanda
     */
    public function getIdDemanda()
    {
        return $this->id_demanda;
    }

    /**
     * Set id_catalogo_servico_atividade
     *
     * @param type $intIdDemanda
     * @return \OrdemServico\Entity\Demanda
     */
    public function setIdDemanda($intIdDemanda = null)
    {
        $this->id_demanda = (is_numeric($intIdDemanda)) ? (integer)$intIdDemanda : $intIdDemanda;
        return $this;
    }

    /**
     * Get id_catalogo_servico_atividade
     *
     * @return id_catalogo_servico_atividade
     */
    public function getIdCatalogoServicoAtividade()
    {
        return $this->id_catalogo_servico_atividade;
    }

    /**
     * Set id_catalogo_servico_atividade
     *
     * @param type $intIdCatalogoServicoAtividade
     * @return \OrdemServico\Entity\DemandaServico
     */
    public function setIdCatalogoServicoAtividade($intIdCatalogoServicoAtividade = null)
    {
        $this->id_catalogo_servico_atividade = (is_numeric($intIdCatalogoServicoAtividade)) ? (integer)$intIdCatalogoServicoAtividade : $intIdCatalogoServicoAtividade;
        return $this;
    }

    /**
     * Get vl_complexidade
     *
     * @return vl_complexidade
     */
    public function getVlComplexidade()
    {
        return $this->vl_complexidade;
    }

    /**
     * Set vl_complexidade
     *
     * @param type $strInComplexidade
     * @return \OrdemServico\Entity\DemandaServico
     */
    public function setVlComplexidade($strInComplexidade = null)
    {
        $this->vl_complexidade = $strInComplexidade;
        return $this;
    }

    /**
     * Get vl_impacto
     *
     * @return vl_impacto
     */
    public function getVlImpacto()
    {
        return $this->vl_impacto;
    }

    /**
     * Set vl_impacto
     *
     * @param type $strInImpacto
     * @return \OrdemServico\Entity\DemandaServico
     */
    public function setVlImpacto($strInImpacto = null)
    {
        $this->vl_impacto = $strInImpacto;
        return $this;
    }

    /**
     * Get vl_criticidade
     *
     * @return type
     */
    public function getVlCriticidade()
    {
        return $this->vl_criticidade;
    }

    /**
     * Set vl_criticidade
     *
     * @param type $strInCriticidade
     * @return \OrdemServico\Entity\DemandaServico
     */
    public function setVlCriticidade($strInCriticidade = null)
    {
        $this->vl_criticidade = $strInCriticidade;
        return $this;
    }

    /**
     * Get vl_fator_ponderacao
     *
     * @return type
     */
    public function getVlFatorPonderacao()
    {
        return $this->vl_fator_ponderacao;
    }

    /**
     * Set vl_fator_ponderacao
     *
     * @param type $strFatorPonderacao
     * @return \OrdemServico\Entity\DemandaServico
     */
    public function setVlFatorPonderacao($strFatorPonderacao = null)
    {
        $this->vl_fator_ponderacao = $strFatorPonderacao;
        return $this;
    }

    /**
     * Get vl_qma
     *
     * @return type
     */
    public function getVlQma()
    {
        return $this->vl_qma;
    }

    /**
     * Set vl_qma
     *
     * @param type $strVlQma
     * @return \OrdemServico\Entity\DemandaServico
     */
    public function setVlQma($strVlQma = null)
    {
        $this->vl_qma = $strVlQma;
        return $this;
    }

    /**
     * Get vl_facim
     *
     * @return type
     */
    public function getVlFacim()
    {
        return $this->vl_facim;
    }

    /**
     * Set vl_facim
     *
     * @param type $strInFacim
     * @return \OrdemServico\Entity\DemandaServico
     */
    public function setVlFacim($strInFacim = null)
    {
        $this->vl_facim = $strInFacim;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->id_usuario_alteracao;
    }

    /**
     * @param int $id_usuario_alteracao
     * @return DemandaServico
     */
    public function setIdUsuarioAlteracao($id_usuario_alteracao)
    {
        $this->id_usuario_alteracao = $id_usuario_alteracao;
        return $this;
    }

    /**
     * @return string
     */
    public function getDtAlteracao()
    {
        return Date::convertDate($this->dt_alteracao, 'd/m/Y H:i:s');
    }

    /**
     * @param string $dt_alteracao
     * @return DemandaServico
     */
    public function setDtAlteracao($dt_alteracao)
    {
        $this->dt_alteracao = $dt_alteracao;
        return $this;
    }

}
