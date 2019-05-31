<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * NecessidadeEspecial
 *
 * @ORM\Table(name="CORP.TB_NECESSIDADE_ESPECIAL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\NecessidadeEspecialRepository")
 */
class NecessidadeEspecial extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_NECESSIDADE_ESPECIAL", type="string", length=500, nullable=true)
     */
    protected $dsNecessidadeEspecial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_NECESSIDADE_ESPECIAL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_NECESSIDADE_ESPECIAL_ID_NEC", allocationSize=1, initialValue=1)
     */
    protected $idNecessidadeEspecial;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    protected $inAtivo;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_NECESSIDADE_ESPECIAL", type="string", length=130, nullable=false)
     */
    protected $noNecessidadeEspecial;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     */
    protected $nuOperacao;

    /**
     * @var \InepZend\Module\Corporative\Entity\UsuarioSistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\UsuarioSistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_USUARIO_ALTERACAO", referencedColumnName="CO_USUARIO_SISTEMA")
     * })
     */
    protected $idUsuarioAlteracao;


    /**
     * Set dsNecessidadeEspecial
     *
     * @param string $dsNecessidadeEspecial
     *
     * @return NecessidadeEspecial
     */
    public function setDsNecessidadeEspecial($dsNecessidadeEspecial)
    {
        $this->dsNecessidadeEspecial = $dsNecessidadeEspecial;
        return $this;
    }

    /**
     * Get dsNecessidadeEspecial
     *
     * @return string 
     */
    public function getDsNecessidadeEspecial()
    {
        return $this->dsNecessidadeEspecial;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return NecessidadeEspecial
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
     * Get idNecessidadeEspecial
     *
     * @return integer 
     */
    public function getIdNecessidadeEspecial()
    {
        return $this->idNecessidadeEspecial;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return NecessidadeEspecial
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
     * Set noNecessidadeEspecial
     *
     * @param string $noNecessidadeEspecial
     *
     * @return NecessidadeEspecial
     */
    public function setNoNecessidadeEspecial($noNecessidadeEspecial)
    {
        $this->noNecessidadeEspecial = $noNecessidadeEspecial;
        return $this;
    }

    /**
     * Get noNecessidadeEspecial
     *
     * @return string 
     */
    public function getNoNecessidadeEspecial()
    {
        return $this->noNecessidadeEspecial;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return NecessidadeEspecial
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

    /**
     * Set idUsuarioAlteracao
     *
     * @param \InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao
     *
     * @return NecessidadeEspecial
     */
    public function setIdUsuarioAlteracao(\InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao = null)
    {
        $this->idUsuarioAlteracao = $idUsuarioAlteracao;
        return $this;
    }

    /**
     * Get idUsuarioAlteracao
     *
     * @return \InepZend\Module\Corporative\Entity\UsuarioSistema 
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->idUsuarioAlteracao;
    }
}

