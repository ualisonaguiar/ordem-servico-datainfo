<?php

namespace Migracao\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="Migracao\Entity\DemandaServicoRepository")
 * @ORM\Table(name="tb_demanda_servico")
 */
class DemandaServico extends Entity
{
    /**
     * Criacao deste atributo refere-se a existencia de dados.
     *
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_demanda;

    /**
     * Criacao deste atributo refere-se a existencia de dados.
     *
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
     * @return \Migracao\Entity\Demanda
     */
    public function setIdDemanda($intIdDemanda = null)
    {
        $this->id_demanda = (is_numeric($intIdDemanda)) ? (integer) $intIdDemanda : $intIdDemanda;
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
     * @return \Migracao\Entity\DemandaServico
     */
    public function setIdCatalogoServicoAtividade($intIdCatalogoServicoAtividade = null)
    {
        $this->id_catalogo_servico_atividade = (is_numeric($intIdCatalogoServicoAtividade)) ? (integer) $intIdCatalogoServicoAtividade : $intIdCatalogoServicoAtividade;
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
     * @return \Migracao\Entity\DemandaServico
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
     * @return \Migracao\Entity\DemandaServico
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
     * @return \Migracao\Entity\DemandaServico
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
     * @return \Migracao\Entity\DemandaServico
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
     * @return \Migracao\Entity\DemandaServico
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
     * @return \Migracao\Entity\DemandaServico
     */
    public function setVlFacim($strInFacim = null)
    {
        $this->vl_facim = $strInFacim;
        return $this;
    }
}
