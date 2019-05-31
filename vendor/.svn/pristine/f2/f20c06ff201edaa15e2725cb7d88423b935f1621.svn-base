<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogServico
 *
 * @ORM\Table(name="SSI.TB_LOG_SERVICO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogServicoRepository")
 */
class LogServico extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_SERVICO", type="string", length=500, nullable=false)
     */
    private $dsServico;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    private $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_HISTORICO_ACESSO", type="integer", nullable=false)
     */
    private $idHistoricoAcesso;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SERVICO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idServico;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SERVICO", type="string", length=120, nullable=false)
     */
    private $noServico;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_SERVICO", type="string", length=50, nullable=false)
     */
    private $sgServico;


    /**
     * Set dsServico
     *
     * @param string $dsServico
     *
     * @return LogServico
     */
    public function setDsServico($dsServico)
    {
        $this->dsServico = $dsServico;
        return $this;
    }

    /**
     * Get dsServico
     *
     * @return string 
     */
    public function getDsServico()
    {
        return $this->dsServico;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogServico
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
     * Set idHistoricoAcesso
     *
     * @param integer $idHistoricoAcesso
     *
     * @return LogServico
     */
    public function setIdHistoricoAcesso($idHistoricoAcesso)
    {
        $this->idHistoricoAcesso = $idHistoricoAcesso;
        return $this;
    }

    /**
     * Get idHistoricoAcesso
     *
     * @return integer 
     */
    public function getIdHistoricoAcesso()
    {
        return $this->idHistoricoAcesso;
    }

    /**
     * Set idServico
     *
     * @param integer $idServico
     *
     * @return LogServico
     */
    public function setIdServico($idServico)
    {
        $this->idServico = $idServico;
        return $this;
    }

    /**
     * Get idServico
     *
     * @return integer 
     */
    public function getIdServico()
    {
        return $this->idServico;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return LogServico
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
     * Set noServico
     *
     * @param string $noServico
     *
     * @return LogServico
     */
    public function setNoServico($noServico)
    {
        $this->noServico = $noServico;
        return $this;
    }

    /**
     * Get noServico
     *
     * @return string 
     */
    public function getNoServico()
    {
        return $this->noServico;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return LogServico
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
     * Set sgServico
     *
     * @param string $sgServico
     *
     * @return LogServico
     */
    public function setSgServico($sgServico)
    {
        $this->sgServico = $sgServico;
        return $this;
    }

    /**
     * Get sgServico
     *
     * @return string 
     */
    public function getSgServico()
    {
        return $this->sgServico;
    }
}

