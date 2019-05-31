<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Sistema
 *
 * @ORM\Table(name="SSI.TB_SISTEMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\SistemaRepository")
 */
class Sistema extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="CO_CLIENTE", type="string", length=100, nullable=true)
     */
    private $coCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="CO_SECRETO", type="string", length=100, nullable=true)
     */
    private $coSecreto;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_SISTEMA", type="string", length=500, nullable=true)
     */
    private $dsSistema;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    private $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SISTEMA", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_SISTEMA_ID_SISTEMA_seq", allocationSize=1, initialValue=1)
     */
    private $idSistema;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_2FATOR", type="boolean", nullable=false)
     */
    private $in2fator = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SISTEMA", type="string", length=250, nullable=false)
     */
    private $noSistema;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     */
    private $nuOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_SISTEMA", type="string", length=20, nullable=true)
     */
    private $sgSistema;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_SVN_DOCUMENTO", type="string", length=100, nullable=true)
     */
    private $txSvnDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_SVN_FONTE", type="string", length=100, nullable=true)
     */
    private $txSvnFonte;

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
     * @var \InepZend\Module\Ssi\Entity\
     *
     * @ORM\Column(name="ID_SERVIDOR_GERENTE", type="integer", nullable=true)
     */
    private $idServidorGerente;

    /**
     * @var \InepZend\Module\Ssi\Entity\
     *
     * @ORM\Column(name="ID_SERVIDOR_GESTOR", type="integer", nullable=true)
     */
    private $idServidorGestor;


    /**
     * Set coCliente
     *
     * @param string $coCliente
     *
     * @return Sistema
     */
    public function setCoCliente($coCliente)
    {
        $this->coCliente = $coCliente;
        return $this;
    }

    /**
     * Get coCliente
     *
     * @return string 
     */
    public function getCoCliente()
    {
        return $this->coCliente;
    }

    /**
     * Set coSecreto
     *
     * @param string $coSecreto
     *
     * @return Sistema
     */
    public function setCoSecreto($coSecreto)
    {
        $this->coSecreto = $coSecreto;
        return $this;
    }

    /**
     * Get coSecreto
     *
     * @return string 
     */
    public function getCoSecreto()
    {
        return $this->coSecreto;
    }

    /**
     * Set dsSistema
     *
     * @param string $dsSistema
     *
     * @return Sistema
     */
    public function setDsSistema($dsSistema)
    {
        $this->dsSistema = $dsSistema;
        return $this;
    }

    /**
     * Get dsSistema
     *
     * @return string 
     */
    public function getDsSistema()
    {
        return $this->dsSistema;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return Sistema
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
     * Get idSistema
     *
     * @return integer 
     */
    public function getIdSistema()
    {
        return $this->idSistema;
    }

    /**
     * Set in2fator
     *
     * @param boolean $in2fator
     *
     * @return Sistema
     */
    public function setIn2fator($in2fator)
    {
        $this->in2fator = $in2fator;
        return $this;
    }

    /**
     * Get in2fator
     *
     * @return boolean 
     */
    public function getIn2fator()
    {
        return $this->in2fator;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return Sistema
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
     * Set noSistema
     *
     * @param string $noSistema
     *
     * @return Sistema
     */
    public function setNoSistema($noSistema)
    {
        $this->noSistema = $noSistema;
        return $this;
    }

    /**
     * Get noSistema
     *
     * @return string 
     */
    public function getNoSistema()
    {
        return $this->noSistema;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return Sistema
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
     * Set sgSistema
     *
     * @param string $sgSistema
     *
     * @return Sistema
     */
    public function setSgSistema($sgSistema)
    {
        $this->sgSistema = $sgSistema;
        return $this;
    }

    /**
     * Get sgSistema
     *
     * @return string 
     */
    public function getSgSistema()
    {
        return $this->sgSistema;
    }

    /**
     * Set txSvnDocumento
     *
     * @param string $txSvnDocumento
     *
     * @return Sistema
     */
    public function setTxSvnDocumento($txSvnDocumento)
    {
        $this->txSvnDocumento = $txSvnDocumento;
        return $this;
    }

    /**
     * Get txSvnDocumento
     *
     * @return string 
     */
    public function getTxSvnDocumento()
    {
        return $this->txSvnDocumento;
    }

    /**
     * Set txSvnFonte
     *
     * @param string $txSvnFonte
     *
     * @return Sistema
     */
    public function setTxSvnFonte($txSvnFonte)
    {
        $this->txSvnFonte = $txSvnFonte;
        return $this;
    }

    /**
     * Get txSvnFonte
     *
     * @return string 
     */
    public function getTxSvnFonte()
    {
        return $this->txSvnFonte;
    }

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return Sistema
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
     * Set idServidorGerente
     *
     * @param $idServidorGerente
     *
     * @return Sistema
     */
    public function setIdServidorGerente($idServidorGerente = null)
    {
        $this->idServidorGerente = $idServidorGerente;
        return $this;
    }

    /**
     * Get idServidorGerente
     *
     * @return \InepZend\Module\Ssi\Entity\ 
     */
    public function getIdServidorGerente()
    {
        return $this->idServidorGerente;
    }

    /**
     * Set idServidorGestor
     *
     * @param \InepZend\Module\Ssi\Entity\ $idServidorGestor
     *
     * @return Sistema
     */
    public function setIdServidorGestor($idServidorGestor = null)
    {
        $this->idServidorGestor = $idServidorGestor;
        return $this;
    }

    /**
     * Get idServidorGestor
     *
     * @return \InepZend\Module\Ssi\Entity\ 
     */
    public function getIdServidorGestor()
    {
        return $this->idServidorGestor;
    }
}

