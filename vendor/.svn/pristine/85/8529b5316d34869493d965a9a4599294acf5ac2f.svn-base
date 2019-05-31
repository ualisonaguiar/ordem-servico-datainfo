<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistoricoUsuario
 *
 * @ORM\Table(name="SSI.TB_HISTORICO_USUARIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\HistoricoUsuarioRepository")
 */
class HistoricoUsuario extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_CRIACAO_USUARIO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtCriacaoUsuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_NASCIMENTO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtNascimento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_SITUACAO_USUARIO", type="string", columnDefinition="DATE", nullable=false)
     */
    private $dtSituacaoUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_HISTORICO_USUARIO", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_HISTORICO_USUARIO_ID_HISTOR", allocationSize=1, initialValue=1)
     */
    private $idHistoricoUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PERGUNTA_SECRETA", type="integer", nullable=true)
     */
    private $idPerguntaSecreta;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_SITUACAO_USUARIO", type="integer", nullable=false)
     */
    private $idTipoSituacaoUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_USUARIO", type="integer", nullable=false)
     */
    private $idTipoUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO", type="integer", nullable=false)
     */
    private $idUsuario;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_POSSUI_TOKEN", type="boolean", nullable=false)
     */
    private $inPossuiToken;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_LOGIN", type="string", length=20, nullable=true)
     */
    private $noLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_MAE", type="string", length=150, nullable=true)
     */
    private $noMae;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_USUARIO", type="string", length=120, nullable=false)
     */
    private $noUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CPF", type="string", length=11, nullable=true)
     */
    private $nuCpf;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_TENTATIVA_ACESSO", type="integer", nullable=true)
     */
    private $nuTentativaAcesso;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_OPERACAO", type="string", length=1, nullable=false)
     */
    private $tpOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_SEXO", type="string", length=1, nullable=false)
     */
    private $tpSexo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="TP_USUARIO", type="boolean", nullable=true)
     */
    private $tpUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_RESPOSTA_SECRETA", type="string", length=100, nullable=true)
     */
    private $txRespostaSecreta;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_SENHA", type="string", length=100, nullable=false)
     */
    private $txSenha;

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
     * Set dtCriacaoUsuario
     *
     * @param \DateTime $dtCriacaoUsuario
     *
     * @return HistoricoUsuario
     */
    public function setDtCriacaoUsuario($dtCriacaoUsuario)
    {
        $this->dtCriacaoUsuario = $dtCriacaoUsuario;
        return $this;
    }

    /**
     * Get dtCriacaoUsuario
     *
     * @return \DateTime 
     */
    public function getDtCriacaoUsuario()
    {
        return Date::convertDate($this->dtCriacaoUsuario, "d/m/Y");
    }

    /**
     * Set dtNascimento
     *
     * @param \DateTime $dtNascimento
     *
     * @return HistoricoUsuario
     */
    public function setDtNascimento($dtNascimento)
    {
        $this->dtNascimento = $dtNascimento;
        return $this;
    }

    /**
     * Get dtNascimento
     *
     * @return \DateTime 
     */
    public function getDtNascimento()
    {
        return Date::convertDate($this->dtNascimento, "d/m/Y");
    }

    /**
     * Set dtSituacaoUsuario
     *
     * @param \DateTime $dtSituacaoUsuario
     *
     * @return HistoricoUsuario
     */
    public function setDtSituacaoUsuario($dtSituacaoUsuario)
    {
        $this->dtSituacaoUsuario = $dtSituacaoUsuario;
        return $this;
    }

    /**
     * Get dtSituacaoUsuario
     *
     * @return \DateTime 
     */
    public function getDtSituacaoUsuario()
    {
        return Date::convertDate($this->dtSituacaoUsuario, "d/m/Y");
    }

    /**
     * Get idHistoricoUsuario
     *
     * @return integer 
     */
    public function getIdHistoricoUsuario()
    {
        return $this->idHistoricoUsuario;
    }

    /**
     * Set idPerguntaSecreta
     *
     * @param integer $idPerguntaSecreta
     *
     * @return HistoricoUsuario
     */
    public function setIdPerguntaSecreta($idPerguntaSecreta)
    {
        $this->idPerguntaSecreta = $idPerguntaSecreta;
        return $this;
    }

    /**
     * Get idPerguntaSecreta
     *
     * @return integer 
     */
    public function getIdPerguntaSecreta()
    {
        return $this->idPerguntaSecreta;
    }

    /**
     * Set idTipoSituacaoUsuario
     *
     * @param integer $idTipoSituacaoUsuario
     *
     * @return HistoricoUsuario
     */
    public function setIdTipoSituacaoUsuario($idTipoSituacaoUsuario)
    {
        $this->idTipoSituacaoUsuario = $idTipoSituacaoUsuario;
        return $this;
    }

    /**
     * Get idTipoSituacaoUsuario
     *
     * @return integer 
     */
    public function getIdTipoSituacaoUsuario()
    {
        return $this->idTipoSituacaoUsuario;
    }

    /**
     * Set idTipoUsuario
     *
     * @param integer $idTipoUsuario
     *
     * @return HistoricoUsuario
     */
    public function setIdTipoUsuario($idTipoUsuario)
    {
        $this->idTipoUsuario = $idTipoUsuario;
        return $this;
    }

    /**
     * Get idTipoUsuario
     *
     * @return integer 
     */
    public function getIdTipoUsuario()
    {
        return $this->idTipoUsuario;
    }

    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     *
     * @return HistoricoUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return integer 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set inPossuiToken
     *
     * @param boolean $inPossuiToken
     *
     * @return HistoricoUsuario
     */
    public function setInPossuiToken($inPossuiToken)
    {
        $this->inPossuiToken = $inPossuiToken;
        return $this;
    }

    /**
     * Get inPossuiToken
     *
     * @return boolean 
     */
    public function getInPossuiToken()
    {
        return $this->inPossuiToken;
    }

    /**
     * Set noLogin
     *
     * @param string $noLogin
     *
     * @return HistoricoUsuario
     */
    public function setNoLogin($noLogin)
    {
        $this->noLogin = $noLogin;
        return $this;
    }

    /**
     * Get noLogin
     *
     * @return string 
     */
    public function getNoLogin()
    {
        return $this->noLogin;
    }

    /**
     * Set noMae
     *
     * @param string $noMae
     *
     * @return HistoricoUsuario
     */
    public function setNoMae($noMae)
    {
        $this->noMae = $noMae;
        return $this;
    }

    /**
     * Get noMae
     *
     * @return string 
     */
    public function getNoMae()
    {
        return $this->noMae;
    }

    /**
     * Set noUsuario
     *
     * @param string $noUsuario
     *
     * @return HistoricoUsuario
     */
    public function setNoUsuario($noUsuario)
    {
        $this->noUsuario = $noUsuario;
        return $this;
    }

    /**
     * Get noUsuario
     *
     * @return string 
     */
    public function getNoUsuario()
    {
        return $this->noUsuario;
    }

    /**
     * Set nuCpf
     *
     * @param string $nuCpf
     *
     * @return HistoricoUsuario
     */
    public function setNuCpf($nuCpf)
    {
        $this->nuCpf = $nuCpf;
        return $this;
    }

    /**
     * Get nuCpf
     *
     * @return string 
     */
    public function getNuCpf()
    {
        return $this->nuCpf;
    }

    /**
     * Set nuTentativaAcesso
     *
     * @param integer $nuTentativaAcesso
     *
     * @return HistoricoUsuario
     */
    public function setNuTentativaAcesso($nuTentativaAcesso)
    {
        $this->nuTentativaAcesso = $nuTentativaAcesso;
        return $this;
    }

    /**
     * Get nuTentativaAcesso
     *
     * @return integer 
     */
    public function getNuTentativaAcesso()
    {
        return $this->nuTentativaAcesso;
    }

    /**
     * Set tpOperacao
     *
     * @param string $tpOperacao
     *
     * @return HistoricoUsuario
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
     * Set tpSexo
     *
     * @param string $tpSexo
     *
     * @return HistoricoUsuario
     */
    public function setTpSexo($tpSexo)
    {
        $this->tpSexo = $tpSexo;
        return $this;
    }

    /**
     * Get tpSexo
     *
     * @return string 
     */
    public function getTpSexo()
    {
        return $this->tpSexo;
    }

    /**
     * Set tpUsuario
     *
     * @param boolean $tpUsuario
     *
     * @return HistoricoUsuario
     */
    public function setTpUsuario($tpUsuario)
    {
        $this->tpUsuario = $tpUsuario;
        return $this;
    }

    /**
     * Get tpUsuario
     *
     * @return boolean 
     */
    public function getTpUsuario()
    {
        return $this->tpUsuario;
    }

    /**
     * Set txRespostaSecreta
     *
     * @param string $txRespostaSecreta
     *
     * @return HistoricoUsuario
     */
    public function setTxRespostaSecreta($txRespostaSecreta)
    {
        $this->txRespostaSecreta = $txRespostaSecreta;
        return $this;
    }

    /**
     * Get txRespostaSecreta
     *
     * @return string 
     */
    public function getTxRespostaSecreta()
    {
        return $this->txRespostaSecreta;
    }

    /**
     * Set txSenha
     *
     * @param string $txSenha
     *
     * @return HistoricoUsuario
     */
    public function setTxSenha($txSenha)
    {
        $this->txSenha = $txSenha;
        return $this;
    }

    /**
     * Get txSenha
     *
     * @return string 
     */
    public function getTxSenha()
    {
        return $this->txSenha;
    }

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return HistoricoUsuario
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

