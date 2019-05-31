<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Usuario
 *
 * @ORM\Table(name="SSI.TB_USUARIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\UsuarioRepository")
 */
class Usuario extends Entity
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
     * @ORM\Column(name="ID_USUARIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_USUARIO_ID_USUARIO_seq", allocationSize=1, initialValue=1)
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
     * @var \InepZend\Module\Ssi\Entity\HistoricoAcesso
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\HistoricoAcesso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_HISTORICO_ACESSO", referencedColumnName="ID_HISTORICO_ACESSO")
     * })
     */
    private $idHistoricoAcesso;

    /**
     * @var \InepZend\Module\Ssi\Entity\PerguntaSecreta
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\PerguntaSecreta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_PERGUNTA_SECRETA", referencedColumnName="ID_PERGUNTA_SECRETA")
     * })
     */
    private $idPerguntaSecreta;

    /**
     * @var \InepZend\Module\Ssi\Entity\TipoUsuario
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\TipoUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_TIPO_USUARIO", referencedColumnName="ID_TIPO_USUARIO")
     * })
     */
    private $idTipoUsuario;

    /**
     * @var \InepZend\Module\Ssi\Entity\TipoSituacaoUsuario
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\TipoSituacaoUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_TIPO_SITUACAO_USUARIO", referencedColumnName="ID_TIPO_SITUACAO_USUARIO")
     * })
     */
    private $idTipoSituacaoUsuario;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return Usuario
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
     * @return Usuario
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
     * @return Usuario
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
     * @return Usuario
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
     * @return Usuario
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
     * @return Usuario
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
     * @return Usuario
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
     * @return Usuario
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
     * @return Usuario
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
     * @return Usuario
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
     * @return Usuario
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
     * @return Usuario
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
     * @return Usuario
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
     * @return Usuario
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
     * @return Usuario
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
     * @return Usuario
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

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return Usuario
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
     * Set idPerguntaSecreta
     *
     * @param \InepZend\Module\Ssi\Entity\PerguntaSecreta $idPerguntaSecreta
     *
     * @return Usuario
     */
    public function setIdPerguntaSecreta(\InepZend\Module\Ssi\Entity\PerguntaSecreta $idPerguntaSecreta = null)
    {
        $this->idPerguntaSecreta = $idPerguntaSecreta;
        return $this;
    }

    /**
     * Get idPerguntaSecreta
     *
     * @return \InepZend\Module\Ssi\Entity\PerguntaSecreta 
     */
    public function getIdPerguntaSecreta()
    {
        return $this->idPerguntaSecreta;
    }

    /**
     * Set idTipoUsuario
     *
     * @param \InepZend\Module\Ssi\Entity\TipoUsuario $idTipoUsuario
     *
     * @return Usuario
     */
    public function setIdTipoUsuario(\InepZend\Module\Ssi\Entity\TipoUsuario $idTipoUsuario = null)
    {
        $this->idTipoUsuario = $idTipoUsuario;
        return $this;
    }

    /**
     * Get idTipoUsuario
     *
     * @return \InepZend\Module\Ssi\Entity\TipoUsuario 
     */
    public function getIdTipoUsuario()
    {
        return $this->idTipoUsuario;
    }

    /**
     * Set idTipoSituacaoUsuario
     *
     * @param \InepZend\Module\Ssi\Entity\TipoSituacaoUsuario $idTipoSituacaoUsuario
     *
     * @return Usuario
     */
    public function setIdTipoSituacaoUsuario(\InepZend\Module\Ssi\Entity\TipoSituacaoUsuario $idTipoSituacaoUsuario = null)
    {
        $this->idTipoSituacaoUsuario = $idTipoSituacaoUsuario;
        return $this;
    }

    /**
     * Get idTipoSituacaoUsuario
     *
     * @return \InepZend\Module\Ssi\Entity\TipoSituacaoUsuario 
     */
    public function getIdTipoSituacaoUsuario()
    {
        return $this->idTipoSituacaoUsuario;
    }
}

