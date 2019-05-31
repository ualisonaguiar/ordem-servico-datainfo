<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Ocupacao
 *
 * @ORM\Table(name="CORP.TB_OCUPACAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\OcupacaoRepository")
 */
class Ocupacao extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="CO_CBO", type="string", length=4, nullable=true)
     */
    protected $coCbo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_OCUPACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_OCUPACAO_ID_OCUPACAO_seq", allocationSize=1, initialValue=1)
     */
    protected $idOcupacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
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
     * @ORM\Column(name="NO_CBO", type="string", length=200, nullable=true)
     */
    protected $noCbo;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     */
    protected $nuOperacao;


    /**
     * Set coCbo
     *
     * @param string $coCbo
     *
     * @return Ocupacao
     */
    public function setCoCbo($coCbo)
    {
        $this->coCbo = $coCbo;
        return $this;
    }

    /**
     * Get coCbo
     *
     * @return string 
     */
    public function getCoCbo()
    {
        return $this->coCbo;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return Ocupacao
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
     * Get idOcupacao
     *
     * @return integer 
     */
    public function getIdOcupacao()
    {
        return $this->idOcupacao;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return Ocupacao
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
     * @return Ocupacao
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
     * Set noCbo
     *
     * @param string $noCbo
     *
     * @return Ocupacao
     */
    public function setNoCbo($noCbo)
    {
        $this->noCbo = $noCbo;
        return $this;
    }

    /**
     * Get noCbo
     *
     * @return string 
     */
    public function getNoCbo()
    {
        return $this->noCbo;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return Ocupacao
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

