<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistEvento
 *
 * @ORM\Table(name="CORP.TB_HIST_EVENTO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\HistEventoRepository")
 */
class HistEvento extends Entity
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
     * @ORM\Column(name="NO_EVENTO", type="string", length=130, nullable=false)
     */
    protected $noEvento;

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
     * @return HistEvento
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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistEvento
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
     * @return HistEvento
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
     * @return HistEvento
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
     * Set noEvento
     *
     * @param string $noEvento
     *
     * @return HistEvento
     */
    public function setNoEvento($noEvento)
    {
        $this->noEvento = $noEvento;
        return $this;
    }

    /**
     * Get noEvento
     *
     * @return string 
     */
    public function getNoEvento()
    {
        return $this->noEvento;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistEvento
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

