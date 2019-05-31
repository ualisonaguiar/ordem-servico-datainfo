<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogUsuario
 *
 * @ORM\Table(name="SSI.TB_LOG_USUARIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogUsuarioRepository")
 */
class LogUsuario extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    private $dtAlteracao;

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
     * @ORM\Column(name="ID_HISTORICO_ACESSO", type="integer", nullable=false)
     */
    private $idHistoricoAcesso;

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
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
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
     * @ORM\Column(name="NO_LOGIN", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_TENTATIVA_ACESSO", type="integer", nullable=true)
     */
    private $nuTentativaAcesso;

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
     * @var string
     *
     * @ORM\Column(name="TX_SENHA_TEMPORARIA", type="string", length=150, nullable=true)
     */
    private $txSenhaTemporaria;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogUsuario
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
     * Set dtCriacaoUsuario
     *
     * @param \DateTime $dtCriacaoUsuario
     *
     * @return LogUsuario
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
     * @return LogUsuario
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
     * @return LogUsuario
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
     * Set idHistoricoAcesso
     *
     * @param integer $idHistoricoAcesso
     *
     * @return LogUsuario
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
     * Set idPerguntaSecreta
     *
     * @param integer $idPerguntaSecreta
     *
     * @return LogUsuario
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
     * @return LogUsuario
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
     * @return LogUsuario
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
     * @return LogUsuario
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
     * @return LogUsuario
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
     * @return LogUsuario
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
     * @return LogUsuario
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
     * @return LogUsuario
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
     * @return LogUsuario
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return LogUsuario
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
     * Set nuTentativaAcesso
     *
     * @param integer $nuTentativaAcesso
     *
     * @return LogUsuario
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
     * Set tpSexo
     *
     * @param string $tpSexo
     *
     * @return LogUsuario
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
     * @return LogUsuario
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
     * @return LogUsuario
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
     * @return LogUsuario
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
     * Set txSenhaTemporaria
     *
     * @param string $txSenhaTemporaria
     *
     * @return LogUsuario
     */
    public function setTxSenhaTemporaria($txSenhaTemporaria)
    {
        $this->txSenhaTemporaria = $txSenhaTemporaria;
        return $this;
    }

    /**
     * Get txSenhaTemporaria
     *
     * @return string 
     */
    public function getTxSenhaTemporaria()
    {
        return $this->txSenhaTemporaria;
    }
}

