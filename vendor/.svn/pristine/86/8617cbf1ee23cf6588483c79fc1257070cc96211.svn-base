<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * UsuarioSistemaPerfilLog
 *
 * @ORM\Table(name="SSI.TB_USUARIO_SISTEMA_PERFIL_LOG")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\UsuarioSistemaPerfilLogRepository")
 */
class UsuarioSistemaPerfilLog extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PERFIL", type="integer", nullable=false)
     * @ORM\Id
     */
    private $idPerfil;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_SISTEMA", type="integer", nullable=false)
     * @ORM\Id
     */
    private $idUsuarioSistema;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_SISTEMA_PERFIL", type="bigint", nullable=true)
     */
    private $idUsuarioSistemaPerfil;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=true)
     */
    private $inAtivo;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_OPERACAO", type="string", length=1, nullable=true)
     */
    private $tpOperacao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return UsuarioSistemaPerfilLog
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
     * Set idPerfil
     *
     * @param integer $idPerfil
     *
     * @return UsuarioSistemaPerfilLog
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
     * @return UsuarioSistemaPerfilLog
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
     * @return UsuarioSistemaPerfilLog
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
     * @return UsuarioSistemaPerfilLog
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
     * Set tpOperacao
     *
     * @param string $tpOperacao
     *
     * @return UsuarioSistemaPerfilLog
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
}

