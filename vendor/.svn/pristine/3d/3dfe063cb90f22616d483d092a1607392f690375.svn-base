<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * HistServico
 *
 * @ORM\Table(name="SSI.TB_HIST_SERVICO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\HistServicoRepository")
 */
class HistServico extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_SERVICO", type="string", length=500, nullable=false)
     */
    private $dsServico;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_HIST_SERVICO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_HIST_SERVICO_ID_HIST_SERVIC", allocationSize=1, initialValue=1)
     */
    private $idHistServico;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SERVICO", type="smallint", nullable=false)
     */
    private $idServico;

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
     * @var string
     *
     * @ORM\Column(name="NO_SERVICO", type="string", length=120, nullable=false)
     */
    private $noServico;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_SERVICO", type="string", length=50, nullable=false)
     */
    private $sgServico;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_OPERACAO", type="string", length=1, nullable=false)
     */
    private $tpOperacao;

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
     * @var \InepZend\Module\Ssi\Entity\HistoricoAcesso
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\HistoricoAcesso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_HISTORICO_ACESSO", referencedColumnName="ID_HISTORICO_ACESSO")
     * })
     */
    private $idHistoricoAcesso;


    /**
     * Set dsServico
     *
     * @param string $dsServico
     *
     * @return HistServico
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
     * Get idHistServico
     *
     * @return integer 
     */
    public function getIdHistServico()
    {
        return $this->idHistServico;
    }

    /**
     * Set idServico
     *
     * @param integer $idServico
     *
     * @return HistServico
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
     * Set idSistema
     *
     * @param integer $idSistema
     *
     * @return HistServico
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
     * @return HistServico
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
     * @return HistServico
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
     * Set sgServico
     *
     * @param string $sgServico
     *
     * @return HistServico
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

    /**
     * Set tpOperacao
     *
     * @param string $tpOperacao
     *
     * @return HistServico
     */
    public function setTpOperacao($tpOperacao)
    {
        $this->tpOperacao = $tpOperacao;
        return $this;
    }

    /**
     * Get tpOperacao
     *
     * @return string 
     */
    public function getTpOperacao()
    {
        return $this->tpOperacao;
    }

    /**
     * Set txUrlRepositorioServico
     *
     * @param string $txUrlRepositorioServico
     *
     * @return HistServico
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
     * @return HistServico
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

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return HistServico
     */
    public function setIdHistoricoAcesso(\InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso = null)
    {
        $this->idHistoricoAcesso = $idHistoricoAcesso;
        return $this;
    }

    /**
     * Get idHistoricoAcesso
     *
     * @return \InepZend\Module\Ssi\Entity\HistoricoAcesso 
     */
    public function getIdHistoricoAcesso()
    {
        return $this->idHistoricoAcesso;
    }
}

