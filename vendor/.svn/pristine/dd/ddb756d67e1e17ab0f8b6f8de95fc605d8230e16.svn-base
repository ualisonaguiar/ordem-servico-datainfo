<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Contato
 *
 * @ORM\Table(name="SSI.TB_CONTATO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\ContatoRepository")
 */
class Contato extends Entity
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
     * @ORM\Column(name="ID_CONTATO", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_CONTATO_ID_CONTATO_seq", allocationSize=1, initialValue=1)
     */
    private $idContato;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DDD", type="string", length=3, nullable=true)
     */
    private $nuDdd;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DDI", type="string", length=3, nullable=true)
     */
    private $nuDdi;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     */
    private $nuOperacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_RAMAL", type="integer", nullable=true)
     */
    private $nuRamal;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_CONTATO", type="string", length=1, nullable=false)
     */
    private $tpContato;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_CONTATO", type="string", length=255, nullable=true)
     */
    private $txContato;

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
     * @var \InepZend\Module\Ssi\Entity\SubtipoContato
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\SubtipoContato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_SUBTIPO_CONTATO", referencedColumnName="ID_SUBTIPO_CONTATO")
     * })
     */
    private $idSubtipoContato;

    /**
     * @var \InepZend\Module\Ssi\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_USUARIO", referencedColumnName="ID_USUARIO")
     * })
     */
    private $idUsuario;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return Contato
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
     * Get idContato
     *
     * @return integer 
     */
    public function getIdContato()
    {
        return $this->idContato;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return Contato
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
     * Set nuDdd
     *
     * @param string $nuDdd
     *
     * @return Contato
     */
    public function setNuDdd($nuDdd)
    {
        $this->nuDdd = $nuDdd;
        return $this;
    }

    /**
     * Get nuDdd
     *
     * @return string 
     */
    public function getNuDdd()
    {
        return $this->nuDdd;
    }

    /**
     * Set nuDdi
     *
     * @param string $nuDdi
     *
     * @return Contato
     */
    public function setNuDdi($nuDdi)
    {
        $this->nuDdi = $nuDdi;
        return $this;
    }

    /**
     * Get nuDdi
     *
     * @return string 
     */
    public function getNuDdi()
    {
        return $this->nuDdi;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return Contato
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
     * Set nuRamal
     *
     * @param integer $nuRamal
     *
     * @return Contato
     */
    public function setNuRamal($nuRamal)
    {
        $this->nuRamal = $nuRamal;
        return $this;
    }

    /**
     * Get nuRamal
     *
     * @return integer 
     */
    public function getNuRamal()
    {
        return $this->nuRamal;
    }

    /**
     * Set tpContato
     *
     * @param string $tpContato
     *
     * @return Contato
     */
    public function setTpContato($tpContato)
    {
        $this->tpContato = $tpContato;
        return $this;
    }

    /**
     * Get tpContato
     *
     * @return string 
     */
    public function getTpContato()
    {
        return $this->tpContato;
    }

    /**
     * Set txContato
     *
     * @param string $txContato
     *
     * @return Contato
     */
    public function setTxContato($txContato)
    {
        $this->txContato = $txContato;
        return $this;
    }

    /**
     * Get txContato
     *
     * @return string 
     */
    public function getTxContato()
    {
        return $this->txContato;
    }

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return Contato
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
     * Set idSubtipoContato
     *
     * @param \InepZend\Module\Ssi\Entity\SubtipoContato $idSubtipoContato
     *
     * @return Contato
     */
    public function setIdSubtipoContato(\InepZend\Module\Ssi\Entity\SubtipoContato $idSubtipoContato = null)
    {
        $this->idSubtipoContato = $idSubtipoContato;
        return $this;
    }

    /**
     * Get idSubtipoContato
     *
     * @return \InepZend\Module\Ssi\Entity\SubtipoContato 
     */
    public function getIdSubtipoContato()
    {
        return $this->idSubtipoContato;
    }

    /**
     * Set idUsuario
     *
     * @param \InepZend\Module\Ssi\Entity\Usuario $idUsuario
     *
     * @return Contato
     */
    public function setIdUsuario(\InepZend\Module\Ssi\Entity\Usuario $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \InepZend\Module\Ssi\Entity\Usuario 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}

