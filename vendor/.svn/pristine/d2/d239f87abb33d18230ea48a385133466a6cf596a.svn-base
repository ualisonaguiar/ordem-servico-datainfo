<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Projeto
 *
 * @ORM\Table(name="CORP.TB_PROJETO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\ProjetoRepository")
 */
class Projeto extends Entity
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
     * @ORM\Column(name="CO_PROJETO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_PROJETO_CO_PROJETO_seq", allocationSize=1, initialValue=1)
     */
    protected $coProjeto;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_PROJETO", type="string", length=500, nullable=false)
     */
    protected $dsProjeto;

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
     */
    protected $nuOperacao;

    /**
     * @var \InepZend\Module\Corporative\Entity\Programa
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Programa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_PROGRAMA", referencedColumnName="CO_PROGRAMA")
     * })
     */
    protected $coPrograma;

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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return Projeto
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
     * @return Projeto
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return Projeto
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
     * Set coPrograma
     *
     * @param \InepZend\Module\Corporative\Entity\Programa $coPrograma
     *
     * @return Projeto
     */
    public function setCoPrograma(\InepZend\Module\Corporative\Entity\Programa $coPrograma = null)
    {
        $this->coPrograma = $coPrograma;
        return $this;
    }

    /**
     * Get coPrograma
     *
     * @return \InepZend\Module\Corporative\Entity\Programa 
     */
    public function getCoPrograma()
    {
        return $this->coPrograma;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param \InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao
     *
     * @return Projeto
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

