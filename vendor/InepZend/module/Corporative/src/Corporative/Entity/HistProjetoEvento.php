<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistProjetoEvento
 *
 * @ORM\Table(name="CORP.TB_HIST_PROJETO_EVENTO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\HistProjetoEventoRepository")
 */
class HistProjetoEvento extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_EVENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $coEvento;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PROJETO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $coProjeto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtAlteracao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_FIM_EVENTO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtFimEvento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_INICIO_EVENTO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtInicioEvento;

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
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $nuOperacao;


    /**
     * Set coEvento
     *
     * @param integer $coEvento
     *
     * @return HistProjetoEvento
     */
    public function setCoEvento($coEvento)
    {
        $this->coEvento = $coEvento;
        return $this;
    }

    /**
     * Get coEvento
     *
     * @return integer 
     */
    public function getCoEvento()
    {
        return $this->coEvento;
    }

    /**
     * Set coProjeto
     *
     * @param integer $coProjeto
     *
     * @return HistProjetoEvento
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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistProjetoEvento
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
     * Set dtFimEvento
     *
     * @param \DateTime $dtFimEvento
     *
     * @return HistProjetoEvento
     */
    public function setDtFimEvento($dtFimEvento)
    {
        $this->dtFimEvento = $dtFimEvento;
        return $this;
    }

    /**
     * Get dtFimEvento
     *
     * @return \DateTime 
     */
    public function getDtFimEvento()
    {
        return Date::convertDate($this->dtFimEvento, "d/m/Y");
    }

    /**
     * Set dtInicioEvento
     *
     * @param \DateTime $dtInicioEvento
     *
     * @return HistProjetoEvento
     */
    public function setDtInicioEvento($dtInicioEvento)
    {
        $this->dtInicioEvento = $dtInicioEvento;
        return $this;
    }

    /**
     * Get dtInicioEvento
     *
     * @return \DateTime 
     */
    public function getDtInicioEvento()
    {
        return Date::convertDate($this->dtInicioEvento, "d/m/Y");
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistProjetoEvento
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
     * @return HistProjetoEvento
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistProjetoEvento
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

