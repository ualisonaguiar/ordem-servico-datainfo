<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogServicoSistema
 *
 * @ORM\Table(name="SSI.TB_LOG_SERVICO_SISTEMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogServicoSistemaRepository")
 */
class LogServicoSistema extends Entity
{
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
     */
    private $idServico;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SERVICO_SISTEMA", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idServicoSistema;

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
    private $inAtivo;

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
     * @ORM\Column(name="TX_URL_REPOSITORIO_SERVICO", type="string", length=100, nullable=false)
     */
    private $txUrlRepositorioServico;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_URL_SERVICO", type="string", length=100, nullable=false)
     */
    private $txUrlServico;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogServicoSistema
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
     * @return LogServicoSistema
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
     * @return LogServicoSistema
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
     * Set idServicoSistema
     *
     * @param integer $idServicoSistema
     *
     * @return LogServicoSistema
     */
    public function setIdServicoSistema($idServicoSistema)
    {
        $this->idServicoSistema = $idServicoSistema;
        return $this;
    }

    /**
     * Get idServicoSistema
     *
     * @return integer 
     */
    public function getIdServicoSistema()
    {
        return $this->idServicoSistema;
    }

    /**
     * Set idSistema
     *
     * @param integer $idSistema
     *
     * @return LogServicoSistema
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
     * @return LogServicoSistema
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
     * @return LogServicoSistema
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
     * Set txUrlRepositorioServico
     *
     * @param string $txUrlRepositorioServico
     *
     * @return LogServicoSistema
     */
    public function setTxUrlRepositorioServico($txUrlRepositorioServico)
    {
        $this->txUrlRepositorioServico = $txUrlRepositorioServico;
        return $this;
    }

    /**
     * Get txUrlRepositorioServico
     *
     * @return string 
     */
    public function getTxUrlRepositorioServico()
    {
        return $this->txUrlRepositorioServico;
    }

    /**
     * Set txUrlServico
     *
     * @param string $txUrlServico
     *
     * @return LogServicoSistema
     */
    public function setTxUrlServico($txUrlServico)
    {
        $this->txUrlServico = $txUrlServico;
        return $this;
    }

    /**
     * Get txUrlServico
     *
     * @return string 
     */
    public function getTxUrlServico()
    {
        return $this->txUrlServico;
    }
}

