<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * ServicoSistema
 *
 * @ORM\Table(name="SSI.TB_SERVICO_SISTEMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\ServicoSistemaRepository")
 */
class ServicoSistema extends Entity
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
     * @ORM\Column(name="ID_SERVICO_SISTEMA", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_SERVICO_SISTEMA_ID_SERVICO_", allocationSize=1, initialValue=1)
     */
    private $idServicoSistema;

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
     * @var \InepZend\Module\Ssi\Entity\Servico
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\Servico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_SERVICO", referencedColumnName="ID_SERVICO")
     * })
     */
    private $idServico;

    /**
     * @var \InepZend\Module\Ssi\Entity\Sistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\Sistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_SISTEMA", referencedColumnName="ID_SISTEMA")
     * })
     */
    private $idSistema;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return ServicoSistema
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
     * @return ServicoSistema
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
     * Get idServicoSistema
     *
     * @return integer 
     */
    public function getIdServicoSistema()
    {
        return $this->idServicoSistema;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return ServicoSistema
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
     * @return ServicoSistema
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
     * @return ServicoSistema
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
     * @return ServicoSistema
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
     * Set idServico
     *
     * @param \InepZend\Module\Ssi\Entity\Servico $idServico
     *
     * @return ServicoSistema
     */
    public function setIdServico(\InepZend\Module\Ssi\Entity\Servico $idServico = null)
    {
        $this->idServico = $idServico;
        return $this;
    }

    /**
     * Get idServico
     *
     * @return \InepZend\Module\Ssi\Entity\Servico 
     */
    public function getIdServico()
    {
        return $this->idServico;
    }

    /**
     * Set idSistema
     *
     * @param \InepZend\Module\Ssi\Entity\Sistema $idSistema
     *
     * @return ServicoSistema
     */
    public function setIdSistema(\InepZend\Module\Ssi\Entity\Sistema $idSistema = null)
    {
        $this->idSistema = $idSistema;
        return $this;
    }

    /**
     * Get idSistema
     *
     * @return \InepZend\Module\Ssi\Entity\Sistema 
     */
    public function getIdSistema()
    {
        return $this->idSistema;
    }
}

