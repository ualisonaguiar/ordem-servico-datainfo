<?php

namespace InepZend\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Configurator\Configurator;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="InepZend\Ssi\Entity\UsuarioRepository")
 * @ORM\Table(name="ssi.vw_usuario")
 */
class Usuario extends Entity
{

    public function __construct($mixOptions = null)
    {
        Configurator::configure($this, $mixOptions);
        $this->usuarioSistemaPerfis = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="integer", columnDefinition="NUMBER(10)")
     * @var int
     */
    protected $id_usuario;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", columnDefinition="NUMBER(14)")
     * @var int
     */
    protected $id_usuario_sistema;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(255)")
     * @var string
     */
    protected $no_login;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(11)")
     * @var string
     */
    protected $nu_cpf;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(120)")
     * @var string
     */
    protected $no_usuario;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(1)")
     * @var string
     */
    protected $tp_sexo;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(150)")
     * @var string
     */
    protected $no_mae;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_nascimento;

    /**
     * @ORM\Column(type="integer", columnDefinition="NUMBER(5)")
     * @var int
     */
    protected $id_sistema;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(20)")
     * @var string
     */
    protected $no_sistema;

    /**
     * @ORM\Column(type="integer", columnDefinition="NUMBER(2)")
     * @var int
     */
    protected $id_tipo_situacao_usuario;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(50)")
     * @var string
     */
    protected $no_tipo_situacao_usuario;

    /**
     * @ORM\Column(type="integer", columnDefinition="NUMBER(2)")
     * @var int
     */
    protected $id_tp_situacao_usuario_sistema;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(50)")
     * @var string
     */
    protected $no_tp_situacao_usuario_sistema;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(255)")
     * @var string
     */
    protected $tx_email;

    /**
     * @ORM\Column(type="integer", columnDefinition="NUMBER(2)")
     * @var int
     */
    protected $id_tipo_usuario;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(100)")
     * @var string
     */
    protected $no_tipo_usuario;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_expiracao_usuario;

    /**
     * @ORM\OneToMany(targetEntity="InepZend\Ssi\Entity\UsuarioSistemaPerfil", mappedBy="usuario")
     */
    protected $usuarioSistemaPerfis;

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = (integer) $id_usuario;
        return $this;
    }

    public function getIdUsuarioSistema()
    {
        return $this->id_usuario_sistema;
    }

    public function setIdUsuarioSistema($id_usuario_sistema)
    {
        $this->id_usuario_sistema = (integer) $id_usuario_sistema;
        return $this;
    }

    public function getNoLogin()
    {
        return $this->no_login;
    }

    public function setNoLogin($no_login)
    {
        $this->no_login = $no_login;
        return $this;
    }

    public function getNuCpf()
    {
        return $this->nu_cpf;
    }

    public function setNuCpf($nu_cpf)
    {
        $this->nu_cpf = $nu_cpf;
        return $this;
    }

    public function getNoUsuario()
    {
        return $this->no_usuario;
    }

    public function setNoUsuario($no_usuario)
    {
        $this->no_usuario = $no_usuario;
        return $this;
    }

    public function getTpSexo()
    {
        return $this->tp_sexo;
    }

    public function setTpSexo($tp_sexo)
    {
        $this->tp_sexo = $tp_sexo;
        return $this;
    }

    public function getNoMae()
    {
        return $this->no_mae;
    }

    public function setNoMae($no_mae)
    {
        $this->no_mae = $no_mae;
        return $this;
    }

    public function getDtNascimento()
    {
        $library = new \InepZend\Util\Library();
        return $library->convertDate($this->dt_nascimento, 'd/m/Y');
    }

    public function setDtNascimento($dt_nascimento)
    {
        $this->dt_nascimento = $dt_nascimento;
        return $this;
    }

    public function getIdSistema()
    {
        return $this->id_sistema;
    }

    public function setIdSistema($id_sistema)
    {
        $this->id_sistema = (integer) $id_sistema;
        return $this;
    }

    public function getNoSistema()
    {
        return $this->no_sistema;
    }

    public function setNoSistema($no_sistema)
    {
        $this->no_sistema = $no_sistema;
        return $this;
    }

    public function getIdTipoSituacaoUsuario()
    {
        return $this->id_tipo_situacao_usuario;
    }

    public function setIdTipoSituacaoUsuario($id_tipo_situacao_usuario)
    {
        $this->id_tipo_situacao_usuario = (integer) $id_tipo_situacao_usuario;
        return $this;
    }

    public function getNoTipoSituacaoUsuario()
    {
        return $this->no_tipo_situacao_usuario;
    }

    public function setNoTipoSituacaoUsuario($no_tipo_situacao_usuario)
    {
        $this->no_tipo_situacao_usuario = $no_tipo_situacao_usuario;
        return $this;
    }

    public function getIdTpSituacaoUsuarioSistema()
    {
        return $this->id_tp_situacao_usuario_sistema;
    }

    public function setIdTpSituacaoUsuarioSistema($id_tp_situacao_usuario_sistema)
    {
        $this->id_tp_situacao_usuario_sistema = (integer) $id_tp_situacao_usuario_sistema;
        return $this;
    }

    public function getNoTpSituacaoUsuarioSistema()
    {
        return $this->no_tp_situacao_usuario_sistema;
    }

    public function setNoTpSituacaoUsuarioSistema($no_tp_situacao_usuario_sistema)
    {
        $this->no_tp_situacao_usuario_sistema = $no_tp_situacao_usuario_sistema;
        return $this;
    }

    public function getTxEmail()
    {
        return $this->tx_email;
    }

    public function setTxEmail($tx_email)
    {
        $this->tx_email = $tx_email;
        return $this;
    }

    public function getIdTipoUsuario()
    {
        return $this->id_tipo_usuario;
    }

    public function setIdTipoUsuario($id_tipo_usuario)
    {
        $this->id_tipo_usuario = (integer) $id_tipo_usuario;
        return $this;
    }

    public function getNoTipoUsuario()
    {
        return $this->no_tipo_usuario;
    }

    public function setNoTipoUsuario($no_tipo_usuario)
    {
        $this->no_tipo_usuario = $no_tipo_usuario;
        return $this;
    }

    public function getDtExpiracaoUsuario()
    {
        $library = new \InepZend\Util\Library();
        return $library->convertDate($this->dt_expiracao_usuario, 'd/m/Y');
    }

    public function getUsuarioSistemaPerfis()
    {
        return (empty($this->usuarioSistemaPerfis)) ? $this->usuarioSistemaPerfis : $this->usuarioSistemaPerfis->toArray();
    }

    public function setUsuarioSistemaPerfis($usuarioSistemaPerfis)
    {
        $this->usuarioSistemaPerfis = $usuarioSistemaPerfis;
        return $this;
    }

    public function __toString()
    {
        return $this->no_usuario;
    }

    public function toArray()
    {
        return array(
            'id_usuario' => $this->getIdUsuario(),
            'id_usuario_sistema' => $this->getIdUsuarioSistema(),
            'no_login' => $this->getNoLogin(),
            'nu_cpf' => $this->getNuCpf(),
            'no_usuario' => $this->getNoUsuario(),
            'tp_sexo' => $this->getTpSexo(),
            'no_mae' => $this->getNoMae(),
            'dt_nascimento' => $this->getDtNascimento(),
            'id_sistema' => $this->getIdSistema(),
            'no_sistema' => $this->getNoSistema(),
            'id_tipo_situacao_usuario' => $this->getIdTipoSituacaoUsuario(),
            'no_tipo_situacao_usuario' => $this->getNoTipoSituacaoUsuario(),
            'id_tp_situacao_usuario_sistema' => $this->getIdTpSituacaoUsuarioSistema(),
            'no_tp_situacao_usuario_sistema' => $this->getIdTpSituacaoUsuarioSistema(),
            'tx_email' => $this->getTxEmail(),
            'id_tipo_usuario' => $this->getIdTipoUsuario(),
            'no_tipo_usuario' => $this->getNoTipoUsuario(),
            'dt_expiracao_usuario' => $this->getDtExpiracaoUsuario(),
        );
    }

}
