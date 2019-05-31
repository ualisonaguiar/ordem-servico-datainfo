<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogUsuarioSistema
 *
 * @ORM\Table(name="SSI.TB_LOG_USUARIO_SISTEMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogUsuarioSistemaRepository")
 */
class LogUsuarioSistema extends Entity
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
     * @ORM\Column(name="DT_EXPIRACAO_USUARIO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtExpiracaoUsuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_SITUACAO_USUARIO", type="string", columnDefinition="DATE", nullable=true)
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
     * @ORM\Column(name="ID_SISTEMA", type="smallint", nullable=false)
     */
    private $idSistema;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_SITUACAO_USUARIO", type="integer", nullable=false)
     */
    private $idTipoSituacaoUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO", type="integer", nullable=false)
     */
    private $idUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_SISTEMA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idUsuarioSistema;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogUsuarioSistema
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
     * Set dtExpiracaoUsuario
     *
     * @param \DateTime $dtExpiracaoUsuario
     *
     * @return LogUsuarioSistema
     */
    public function setDtExpiracaoUsuario($dtExpiracaoUsuario)
    {
        $this->dtExpiracaoUsuario = $dtExpiracaoUsuario;
        return $this;
    }

    /**
     * Get dtExpiracaoUsuario
     *
     * @return \DateTime 
     */
    public function getDtExpiracaoUsuario()
    {
        return Date::convertDate($this->dtExpiracaoUsuario, "d/m/Y");
    }

    /**
     * Set dtSituacaoUsuario
     *
     * @param \DateTime $dtSituacaoUsuario
     *
     * @return LogUsuarioSistema
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
     * @return LogUsuarioSistema
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
     * Set idSistema
     *
     * @param integer $idSistema
     *
     * @return LogUsuarioSistema
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
     * Set idTipoSituacaoUsuario
     *
     * @param integer $idTipoSituacaoUsuario
     *
     * @return LogUsuarioSistema
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
     * Set idUsuario
     *
     * @param integer $idUsuario
     *
     * @return LogUsuarioSistema
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
     * Set idUsuarioSistema
     *
     * @param integer $idUsuarioSistema
     *
     * @return LogUsuarioSistema
     */
    public function setIdUsuarioSistema($idUsuarioSistema)
    {
        $this->idUsuarioSistema = $idUsuarioSistema;
        return $this;
    }

    /**
     * Get idUsuarioSistema
     *
     * @return integer 
     */
    public function getIdUsuarioSistema()
    {
        return $this->idUsuarioSistema;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return LogUsuarioSistema
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
}

