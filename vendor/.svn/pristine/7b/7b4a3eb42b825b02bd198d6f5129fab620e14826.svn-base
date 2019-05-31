<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Projeto
 *
 * @ORM\Table(name="CORP.VW_PROJETO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwProjetoRepository")
 */
class VwProjeto extends Entity
{

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_ETAPA", type="integer", nullable=false)
     */
    protected $coEtapa;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PROGRAMA", type="integer", nullable=false)
     */
    protected $coPrograma;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_PROJETO", type="integer", nullable=false)
     */
    protected $coProjeto;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PROJETO_ANTERIOR", type="integer", nullable=false)
     */
    protected $coProjetoAnterior;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_PROGRAMA", type="string", length=500, nullable=true)
     */
    protected $dsPrograma;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_PROJETO", type="string", length=500, nullable=false)
     */
    protected $dsProjeto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_FIM_PROJETO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtFimProjeto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_INICIO_PROJETO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtInicioProjeto;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PROGRAMA", type="string", length=130, nullable=false)
     */
    protected $noPrograma;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PROJETO", type="string", length=130, nullable=false)
     */
    protected $noProjeto;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_ANO", type="integer", nullable=false)
     */
    protected $nuAno;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_EDICAO", type="integer", nullable=false)
     */
    protected $nuEdicao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=true)
     */
    protected $inAtivo;

    /**
     * Set coEtapa
     *
     * @param integer $coEtapa
     *
     * @return Projeto
     */
    public function setCoEtapa($coEtapa)
    {
        $this->coEtapa = $coEtapa;
        return $this;
    }

    /**
     * Get coEtapa
     *
     * @return integer
     */
    public function getCoEtapa()
    {
        return $this->coEtapa;
    }

    /**
     * Set coPrograma
     *
     * @param integer $coPrograma
     *
     * @return Projeto
     */
    public function setCoPrograma($coPrograma)
    {
        $this->coPrograma = $coPrograma;
        return $this;
    }

    /**
     * Get coPrograma
     *
     * @return integer
     */
    public function getCoPrograma()
    {
        return $this->coPrograma;
    }

    /**
     * Set coProjeto
     *
     * @param integer $coProjeto
     *
     * @return Projeto
     */
    public function setCoProjeto($coProjeto)
    {
        $this->coProjeto = $coProjeto;
        return $this;
    }

    /**
     * Get coProjeto
     *
     * @return integer
     */
    public function getCoProjeto()
    {
        return $this->coProjeto;
    }


    /**
     * Set coProjeto
     *
     * @param integer $coProjetoAnterior
     *
     * @return Projeto
     */
    public function setCoProjetoAnterior($coProjetoAnterior)
    {
        $this->coProjetoAnterior = $coProjetoAnterior;
        return $this;
    }

    /**
     * Get coProjeto
     *
     * @return integer
     */
    public function getCoProjetoAnterior()
    {
        return $this->coProjetoAnterior;
    }

    /**
     * Set dsPrograma
     *
     * @param string $dsPrograma
     *
     * @return Projeto
     */
    public function setDsPrograma($dsPrograma)
    {
        $this->dsPrograma = $dsPrograma;
        return $this;
    }

    /**
     * Get dsPrograma
     *
     * @return string
     */
    public function getDsPrograma()
    {
        return $this->dsPrograma;
    }

    /**
     * Set dsProjeto
     *
     * @param string $dsProjeto
     *
     * @return Projeto
     */
    public function setDsProjeto($dsProjeto)
    {
        $this->dsProjeto = $dsProjeto;
        return $this;
    }

    /**
     * Get dsProjeto
     *
     * @return string
     */
    public function getDsProjeto()
    {
        return $this->dsProjeto;
    }

    /**
     * Set dtFimProjeto
     *
     * @param \DateTime $dtFimProjeto
     *
     * @return Projeto
     */
    public function setDtFimProjeto($dtFimProjeto)
    {
        $this->dtFimProjeto = $dtFimProjeto;
        return $this;
    }

    /**
     * Get dtFimProjeto
     *
     * @return \DateTime
     */
    public function getDtFimProjeto()
    {
        return Date::convertDate($this->dtFimProjeto, "d/m/Y");
    }

    /**
     * Set dtFimProjeto
     *
     * @param \DateTime $dtInicioProjeto
     *
     * @return Projeto
     */
    public function setDtInicioProjeto($dtInicioProjeto)
    {
        $this->dtInicioProjeto = $dtInicioProjeto;
        return $this;
    }

    /**
     * Get dtInicioProjeto
     *
     * @return \DateTime
     */
    public function getDtInicioProjeto()
    {
        return Date::convertDate($this->dtInicioProjeto, "d/m/Y");
    }

    /**
     * Set noPrograma
     *
     * @param string $noPrograma
     *
     * @return Projeto
     */
    public function setNoPrograma($noPrograma)
    {
        $this->noPrograma = $noPrograma;
        return $this;
    }

    /**
     * Get noPrograma
     *
     * @return string
     */
    public function getNoPrograma()
    {
        return $this->noPrograma;
    }

    /**
     * Set noProjeto
     *
     * @param string $noProjeto
     *
     * @return Projeto
     */
    public function setNoProjeto($noProjeto)
    {
        $this->noProjeto = $noProjeto;
        return $this;
    }

    /**
     * Get noProjeto
     *
     * @return string
     */
    public function getNoProjeto()
    {
        return $this->noProjeto;
    }

    /**
     * Set nuAno
     *
     * @param integer $nuAno
     *
     * @return Projeto
     */
    public function setNuAno($nuAno)
    {
        $this->nuAno = $nuAno;
        return $this;
    }

    /**
     * Get nuAno
     *
     * @return integer
     */
    public function getNuAno()
    {
        return $this->nuAno;
    }

    /**
     * Set nuEdicao
     *
     * @param integer $nuEdicao
     *
     * @return Projeto
     */
    public function setNuEdicao($nuEdicao)
    {
        $this->nuEdicao = $nuEdicao;
        return $this;
    }

    /**
     * Get nuEdicao
     *
     * @return integer
     */
    public function getNuEdicao()
    {
        return $this->nuEdicao;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return AgenciaBancaria
     */
    public function setInAtivo($inAtivo)
    {
        $this->inAtivo = $inAtivo;
        return $this;
    }

    /**
     * Get inAtivo
     *
     * @return boolean
     */
    public function getInAtivo()
    {
        return $this->inAtivo;
    }

}
