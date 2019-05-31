<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Programa
 *
 * @ORM\Table(name="CORP.TB_PROGRAMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\ProgramaRepository")
 */
class Programa extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PROGRAMA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_PROGRAMA_CO_PROGRAMA_seq", allocationSize=1, initialValue=1)
     */
    protected $coPrograma;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_PROGRAMA", type="string", length=500, nullable=true)
     */
    protected $dsPrograma;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtAlteracao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    protected $inAtivo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PROGRAMA", type="string", length=130, nullable=false)
     */
    protected $noPrograma;

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
     * Get coPrograma
     *
     * @return integer 
     */
    public function getCoPrograma()
    {
        return $this->coPrograma;
    }

    /**
     * Set dsPrograma
     *
     * @param string $dsPrograma
     *
     * @return Programa
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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return Programa
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
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return Programa
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
     * Set noPrograma
     *
     * @param string $noPrograma
     *
     * @return Programa
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return Programa
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
     * @return Programa
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

