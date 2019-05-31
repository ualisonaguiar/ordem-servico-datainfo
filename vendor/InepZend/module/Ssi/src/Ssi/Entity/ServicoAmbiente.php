<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * ServicoAmbiente
 *
 * @ORM\Table(name="SSI.TB_SERVICO_AMBIENTE")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\ServicoAmbienteRepository")
 */
class ServicoAmbiente extends Entity
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
     * @ORM\Column(name="ID_SERVICO_AMBIENTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_SERVICO_AMBIENTE_ID_SERVICO", allocationSize=1, initialValue=1)
     */
    private $idServicoAmbiente;

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
     * @ORM\Column(name="TX_URL_SERVICO_AMBIENTE", type="string", length=100, nullable=false)
     */
    private $txUrlServicoAmbiente;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_VERSAO", type="string", length=10, nullable=false)
     */
    private $txVersao;

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
     * @var \InepZend\Module\Ssi\Entity\ServicoSistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\ServicoSistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_SERVICO_SISTEMA", referencedColumnName="ID_SERVICO_SISTEMA")
     * })
     */
    private $idServicoSistema;

    /**
     * @var \InepZend\Module\Ssi\Entity\TipoAmbiente
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\TipoAmbiente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_TIPO_AMBIENTE", referencedColumnName="ID_TIPO_AMBIENTE")
     * })
     */
    private $idTipoAmbiente;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return ServicoAmbiente
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
     * Get idServicoAmbiente
     *
     * @return integer 
     */
    public function getIdServicoAmbiente()
    {
        return $this->idServicoAmbiente;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return ServicoAmbiente
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
     * @return ServicoAmbiente
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
     * Set txUrlServicoAmbiente
     *
     * @param string $txUrlServicoAmbiente
     *
     * @return ServicoAmbiente
     */
    public function setTxUrlServicoAmbiente($txUrlServicoAmbiente)
    {
        $this->txUrlServicoAmbiente = $txUrlServicoAmbiente;
        return $this;
    }

    /**
     * Get txUrlServicoAmbiente
     *
     * @return string 
     */
    public function getTxUrlServicoAmbiente()
    {
        return $this->txUrlServicoAmbiente;
    }

    /**
     * Set txVersao
     *
     * @param string $txVersao
     *
     * @return ServicoAmbiente
     */
    public function setTxVersao($txVersao)
    {
        $this->txVersao = $txVersao;
        return $this;
    }

    /**
     * Get txVersao
     *
     * @return string 
     */
    public function getTxVersao()
    {
        return $this->txVersao;
    }

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return ServicoAmbiente
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

    /**
     * Set idServicoSistema
     *
     * @param \InepZend\Module\Ssi\Entity\ServicoSistema $idServicoSistema
     *
     * @return ServicoAmbiente
     */
    public function setIdServicoSistema(\InepZend\Module\Ssi\Entity\ServicoSistema $idServicoSistema = null)
    {
        $this->idServicoSistema = $idServicoSistema;
        return $this;
    }

    /**
     * Get idServicoSistema
     *
     * @return \InepZend\Module\Ssi\Entity\ServicoSistema 
     */
    public function getIdServicoSistema()
    {
        return $this->idServicoSistema;
    }

    /**
     * Set idTipoAmbiente
     *
     * @param \InepZend\Module\Ssi\Entity\TipoAmbiente $idTipoAmbiente
     *
     * @return ServicoAmbiente
     */
    public function setIdTipoAmbiente(\InepZend\Module\Ssi\Entity\TipoAmbiente $idTipoAmbiente = null)
    {
        $this->idTipoAmbiente = $idTipoAmbiente;
        return $this;
    }

    /**
     * Get idTipoAmbiente
     *
     * @return \InepZend\Module\Ssi\Entity\TipoAmbiente 
     */
    public function getIdTipoAmbiente()
    {
        return $this->idTipoAmbiente;
    }
}

