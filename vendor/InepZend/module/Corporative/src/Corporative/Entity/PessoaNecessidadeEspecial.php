<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * PessoaNecessidadeEspecial
 *
 * @ORM\Table(name="CORP.TB_PESSOA_NECESSIDADE_ESPECIAL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\PessoaNecessidadeEspecialRepository")
 */
class PessoaNecessidadeEspecial extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     */
    protected $nuOperacao;

    /**
     * @var \InepZend\Module\Corporative\Entity\NecessidadeEspecial
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="InepZend\Module\Corporative\Entity\NecessidadeEspecial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_NECESSIDADE_ESPECIAL", referencedColumnName="ID_NECESSIDADE_ESPECIAL")
     * })
     */
    protected $idNecessidadeEspecial;

    /**
     * @var \InepZend\Module\Corporative\Entity\PessoaFisica
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="InepZend\Module\Corporative\Entity\PessoaFisica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_PESSOA_FISICA", referencedColumnName="CO_PESSOA_FISICA")
     * })
     */
    protected $coPessoaFisica;

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
     * @return PessoaNecessidadeEspecial
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return PessoaNecessidadeEspecial
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
     * Set idNecessidadeEspecial
     *
     * @param \InepZend\Module\Corporative\Entity\NecessidadeEspecial $idNecessidadeEspecial
     *
     * @return PessoaNecessidadeEspecial
     */
    public function setIdNecessidadeEspecial(\InepZend\Module\Corporative\Entity\NecessidadeEspecial $idNecessidadeEspecial)
    {
        $this->idNecessidadeEspecial = $idNecessidadeEspecial;
        return $this;
    }

    /**
     * Get idNecessidadeEspecial
     *
     * @return \InepZend\Module\Corporative\Entity\NecessidadeEspecial 
     */
    public function getIdNecessidadeEspecial()
    {
        return $this->idNecessidadeEspecial;
    }

    /**
     * Set coPessoaFisica
     *
     * @param \InepZend\Module\Corporative\Entity\PessoaFisica $coPessoaFisica
     *
     * @return PessoaNecessidadeEspecial
     */
    public function setCoPessoaFisica(\InepZend\Module\Corporative\Entity\PessoaFisica $coPessoaFisica)
    {
        $this->coPessoaFisica = $coPessoaFisica;
        return $this;
    }

    /**
     * Get coPessoaFisica
     *
     * @return \InepZend\Module\Corporative\Entity\PessoaFisica 
     */
    public function getCoPessoaFisica()
    {
        return $this->coPessoaFisica;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param \InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao
     *
     * @return PessoaNecessidadeEspecial
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

