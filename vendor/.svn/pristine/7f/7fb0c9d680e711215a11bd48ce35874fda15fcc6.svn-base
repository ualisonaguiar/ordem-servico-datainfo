<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogTipoSituacaoUsuario
 *
 * @ORM\Table(name="SSI.TB_LOG_TIPO_SITUACAO_USUARIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogTipoSituacaoUsuarioRepository")
 */
class LogTipoSituacaoUsuario extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_TIPO_SITUACAO_USUARIO", type="string", length=150, nullable=true)
     */
    private $dsTipoSituacaoUsuario;

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
     * @ORM\Column(name="ID_TIPO_SITUACAO_USUARIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idTipoSituacaoUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_SITUACAO_USUARIO", type="string", length=50, nullable=false)
     */
    private $noTipoSituacaoUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;


    /**
     * Set dsTipoSituacaoUsuario
     *
     * @param string $dsTipoSituacaoUsuario
     *
     * @return LogTipoSituacaoUsuario
     */
    public function setDsTipoSituacaoUsuario($dsTipoSituacaoUsuario)
    {
        $this->dsTipoSituacaoUsuario = $dsTipoSituacaoUsuario;
        return $this;
    }

    /**
     * Get dsTipoSituacaoUsuario
     *
     * @return string 
     */
    public function getDsTipoSituacaoUsuario()
    {
        return $this->dsTipoSituacaoUsuario;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogTipoSituacaoUsuario
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
     * @return LogTipoSituacaoUsuario
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
     * Set idTipoSituacaoUsuario
     *
     * @param integer $idTipoSituacaoUsuario
     *
     * @return LogTipoSituacaoUsuario
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
     * Set noTipoSituacaoUsuario
     *
     * @param string $noTipoSituacaoUsuario
     *
     * @return LogTipoSituacaoUsuario
     */
    public function setNoTipoSituacaoUsuario($noTipoSituacaoUsuario)
    {
        $this->noTipoSituacaoUsuario = $noTipoSituacaoUsuario;
        return $this;
    }

    /**
     * Get noTipoSituacaoUsuario
     *
     * @return string 
     */
    public function getNoTipoSituacaoUsuario()
    {
        return $this->noTipoSituacaoUsuario;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return LogTipoSituacaoUsuario
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

