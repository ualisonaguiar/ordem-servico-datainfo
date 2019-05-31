<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * UsuarioSistemaPerfil
 *
 * @ORM\Table(name="SSI.VW_USUARIO_SISTEMA_PERFIL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\VwUsuarioSistemaPerfilRepository")
 */
class VwUsuarioSistemaPerfil extends Entity
{
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
     * @ORM\Id
     * @ORM\Column(name="ID_USUARIO_SISTEMA_PERFIL", type="bigint", nullable=false)
     */
    private $idUsuarioSistemaPerfil;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo;


    /**
     * Set idPerfil
     *
     * @param integer $idPerfil
     *
     * @return UsuarioSistemaPerfil
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
     * @return UsuarioSistemaPerfil
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
     * @return UsuarioSistemaPerfil
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
     * @return UsuarioSistemaPerfil
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
}

