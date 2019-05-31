<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogUsuarioSistemaPerfil
 *
 * @ORM\Table(name="SSI.TB_LOG_USUARIO_SISTEMA_PERFIL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogUsuarioSistemaPerfilRepository")
 */
class LogUsuarioSistemaPerfil extends Entity
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
     * @ORM\Column(name="ID_HISTORICO_ACESSO", type="integer", nullable=false)
     */
    private $idHistoricoAcesso;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PERFIL", type="integer", nullable=false)
     */
    private $idPerfil;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_SISTEMA", type="integer", nullable=false)
     */
    private $idUsuarioSistema;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_SISTEMA_PERFIL", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idUsuarioSistemaPerfil;

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
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogUsuarioSistemaPerfil
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
     * @return LogUsuarioSistemaPerfil
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
     * Set idPerfil
     *
     * @param integer $idPerfil
     *
     * @return LogUsuarioSistemaPerfil
     */
    public function setIdPerfil($idPerfil)
    {
        $this->idPerfil = $idPerfil;
        return $this;
    }

    /**
     * Get idPerfil
     *
     * @return integer 
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    /**
     * Set idUsuarioSistema
     *
     * @param integer $idUsuarioSistema
     *
     * @return LogUsuarioSistemaPerfil
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
     * Set idUsuarioSistemaPerfil
     *
     * @param integer $idUsuarioSistemaPerfil
     *
     * @return LogUsuarioSistemaPerfil
     */
    public function setIdUsuarioSistemaPerfil($idUsuarioSistemaPerfil)
    {
        $this->idUsuarioSistemaPerfil = $idUsuarioSistemaPerfil;
        return $this;
    }

    /**
     * Get idUsuarioSistemaPerfil
     *
     * @return integer 
     */
    public function getIdUsuarioSistemaPerfil()
    {
        return $this->idUsuarioSistemaPerfil;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return LogUsuarioSistemaPerfil
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
     * @return LogUsuarioSistemaPerfil
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

