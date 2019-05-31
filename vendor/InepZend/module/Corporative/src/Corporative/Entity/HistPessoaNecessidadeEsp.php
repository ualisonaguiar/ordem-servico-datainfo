<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistPessoaNecessidadeEsp
 *
 * @ORM\Table(name="CORP.TB_HIST_PESSOA_NECESSIDADE_ESP")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\HistPessoaNecessidadeEspRepository")
 */
class HistPessoaNecessidadeEsp extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PESSOA_FISICA", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $coPessoaFisica;

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
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $idNecessidadeEspecial;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=false)
     */
    protected $idUsuarioAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $nuOperacao;


    /**
     * Set coPessoaFisica
     *
     * @param integer $coPessoaFisica
     *
     * @return HistPessoaNecessidadeEsp
     */
    public function setCoPessoaFisica($coPessoaFisica)
    {
        $this->coPessoaFisica = $coPessoaFisica;
        return $this;
    }

    /**
     * Get coPessoaFisica
     *
     * @return integer
     */
    public function getCoPessoaFisica()
    {
        return $this->coPessoaFisica;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistPessoaNecessidadeEsp
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
     * Set idNecessidadeEspecial
     *
     * @param integer $idNecessidadeEspecial
     *
     * @return HistPessoaNecessidadeEsp
     */
    public function setIdNecessidadeEspecial($idNecessidadeEspecial)
    {
        $this->idNecessidadeEspecial = $idNecessidadeEspecial;
        return $this;
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
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistPessoaNecessidadeEsp
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistPessoaNecessidadeEsp
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

