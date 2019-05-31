<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Acao
 *
 * @ORM\Table(name="SSI.TB_ACAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\AcaoRepository")
 */
class Acao extends Entity
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
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_ACAO_ID_ACAO_seq", allocationSize=1, initialValue=1)
     */
    private $idAcao;

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
    private $tpAcao = '1';

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
     * @var \InepZend\Module\Ssi\Entity\Sistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\Sistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_SISTEMA", referencedColumnName="ID_SISTEMA")
     * })
     */
    private $idSistema;


    /**
     * Set dsAcao
     *
     * @param string $dsAcao
     *
     * @return Acao
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
     * @return Acao
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
     * Get idAcao
     *
     * @return integer 
     */
    public function getIdAcao()
    {
        return $this->idAcao;
    }

    /**
     * Set in2fator
     *
     * @param boolean $in2fator
     *
     * @return Acao
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
     * @return Acao
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
     * @return Acao
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
     * @return Acao
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
     * @return Acao
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
     * @return Acao
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

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return Acao
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
     * Set idSistema
     *
     * @param \InepZend\Module\Ssi\Entity\Sistema $idSistema
     *
     * @return Acao
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

