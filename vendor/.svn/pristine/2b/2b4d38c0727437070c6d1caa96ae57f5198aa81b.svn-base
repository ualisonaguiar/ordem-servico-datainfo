<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * ProjetoEvento
 *
 * @ORM\Table(name="CORP.TB_PROJETO_EVENTO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\ProjetoEventoRepository")
 */
class ProjetoEvento extends Entity
{
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
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    protected $inAtivo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     */
    protected $nuOperacao;

    /**
     * @var \InepZend\Module\Corporative\Entity\Evento
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="InepZend\Module\Corporative\Entity\Evento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_EVENTO", referencedColumnName="CO_EVENTO")
     * })
     */
    protected $coEvento;

    /**
     * @var \InepZend\Module\Corporative\Entity\Projeto
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="InepZend\Module\Corporative\Entity\Projeto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_PROJETO", referencedColumnName="CO_PROJETO")
     * })
     */
    protected $coProjeto;

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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return ProjetoEvento
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
     * @return ProjetoEvento
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
     * @return ProjetoEvento
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
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return ProjetoEvento
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
     * @return ProjetoEvento
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
     * Set coEvento
     *
     * @param \InepZend\Module\Corporative\Entity\Evento $coEvento
     *
     * @return ProjetoEvento
     */
    public function setCoEvento(\InepZend\Module\Corporative\Entity\Evento $coEvento)
    {
        $this->coEvento = $coEvento;
        return $this;
    }

    /**
     * Get coEvento
     *
     * @return \InepZend\Module\Corporative\Entity\Evento 
     */
    public function getCoEvento()
    {
        return $this->coEvento;
    }

    /**
     * Set coProjeto
     *
     * @param \InepZend\Module\Corporative\Entity\Projeto $coProjeto
     *
     * @return ProjetoEvento
     */
    public function setCoProjeto(\InepZend\Module\Corporative\Entity\Projeto $coProjeto)
    {
        $this->coProjeto = $coProjeto;
        return $this;
    }

    /**
     * Get coProjeto
     *
     * @return \InepZend\Module\Corporative\Entity\Projeto 
     */
    public function getCoProjeto()
    {
        return $this->coProjeto;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param \InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao
     *
     * @return ProjetoEvento
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

