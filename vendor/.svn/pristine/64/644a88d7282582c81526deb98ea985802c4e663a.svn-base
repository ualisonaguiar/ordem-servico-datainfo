<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogAcao
 *
 * @ORM\Table(name="SSI.TB_LOG_ACAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogAcaoRepository")
 */
class LogAcao extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_ACAO", type="string", length=512, nullable=true)
     */
    private $dsAcao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    private $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_ACAO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idAcao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_HISTORICO_ACESSO", type="integer", nullable=false)
     */
    private $idHistoricoAcesso;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SISTEMA", type="smallint", nullable=false)
     */
    private $idSistema;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="NO_ACAO", type="string", length=120, nullable=false)
     */
    private $noAcao;

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
     * @ORM\Column(name="SG_ACAO", type="string", length=50, nullable=false)
     */
    private $sgAcao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="TP_ACAO", type="boolean", nullable=false)
     */
    private $tpAcao;


    /**
     * Set dsAcao
     *
     * @param string $dsAcao
     *
     * @return LogAcao
     */
    public function setDsAcao($dsAcao)
    {
        $this->dsAcao = $dsAcao;
        return $this;
    }

    /**
     * Get dsAcao
     *
     * @return string 
     */
    public function getDsAcao()
    {
        return $this->dsAcao;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogAcao
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
     * Set idAcao
     *
     * @param integer $idAcao
     *
     * @return LogAcao
     */
    public function setIdAcao($idAcao)
    {
        $this->idAcao = $idAcao;
        return $this;
    }

    /**
     * Get idAcao
     *
     * @return integer 
     */
    public function getIdAcao()
    {
        return $this->idAcao;
    }

    /**
     * Set idHistoricoAcesso
     *
     * @param integer $idHistoricoAcesso
     *
     * @return LogAcao
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
     * Set idSistema
     *
     * @param integer $idSistema
     *
     * @return LogAcao
     */
    public function setIdSistema($idSistema)
    {
        $this->idSistema = $idSistema;
        return $this;
    }

    /**
     * Get idSistema
     *
     * @return integer 
     */
    public function getIdSistema()
    {
        return $this->idSistema;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return LogAcao
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
     * Set noAcao
     *
     * @param string $noAcao
     *
     * @return LogAcao
     */
    public function setNoAcao($noAcao)
    {
        $this->noAcao = $noAcao;
        return $this;
    }

    /**
     * Get noAcao
     *
     * @return string 
     */
    public function getNoAcao()
    {
        return $this->noAcao;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return LogAcao
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
     * Set sgAcao
     *
     * @param string $sgAcao
     *
     * @return LogAcao
     */
    public function setSgAcao($sgAcao)
    {
        $this->sgAcao = $sgAcao;
        return $this;
    }

    /**
     * Get sgAcao
     *
     * @return string 
     */
    public function getSgAcao()
    {
        return $this->sgAcao;
    }

    /**
     * Set tpAcao
     *
     * @param boolean $tpAcao
     *
     * @return LogAcao
     */
    public function setTpAcao($tpAcao)
    {
        $this->tpAcao = $tpAcao;
        return $this;
    }

    /**
     * Get tpAcao
     *
     * @return boolean 
     */
    public function getTpAcao()
    {
        return $this->tpAcao;
    }
}

