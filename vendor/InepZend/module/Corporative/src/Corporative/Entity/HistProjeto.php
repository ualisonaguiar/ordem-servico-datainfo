<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistProjeto
 *
 * @ORM\Table(name="CORP.TB_HIST_PROJETO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\HistProjetoRepository")
 */
class HistProjeto extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PROGRAMA", type="integer", nullable=false)
     */
    protected $coPrograma;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PROJETO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $coProjeto;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_PROJETO", type="string", length=500, nullable=true)
     */
    protected $dsProjeto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=false)
     */
    protected $idUsuarioAlteracao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=true)
     */
    protected $inAtivo;

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
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $nuOperacao;


    /**
     * Set coPrograma
     *
     * @param integer $coPrograma
     *
     * @return HistProjeto
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
     * @return HistProjeto
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
     * Set dsProjeto
     *
     * @param string $dsProjeto
     *
     * @return HistProjeto
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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistProjeto
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
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistProjeto
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
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return HistProjeto
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

    /**
     * Set noProjeto
     *
     * @param string $noProjeto
     *
     * @return HistProjeto
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
     * @return HistProjeto
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
     * @return HistProjeto
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistProjeto
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
}

