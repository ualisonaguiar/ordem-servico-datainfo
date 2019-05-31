<?php

namespace InepZend\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="InepZend\Ssi\Entity\UsuarioSistemaPerfilRepository")
 * @ORM\Table(name="ssi.vw_usuario_sistema_perfil")
 */
class UsuarioSistemaPerfil extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", columnDefinition="NUMBER(20)")
     * @var int
     */
    protected $id_usuario_sistema_perfil;

    /**
     * @ORM\Column(type="integer", columnDefinition="NUMBER(1)")
     * @var int
     */
    protected $in_ativo;

    /**
     * @ORM\ManyToOne(targetEntity="InepZend\Ssi\Entity\Usuario", inversedBy="usuarioSistemaPerfis")
     * @ORM\JoinColumn(name="id_usuario_sistema", referencedColumnName="id_usuario_sistema")
     */
    protected $usuario;

//    /**
//     * @ORM\Id
//     * @ORM\Column(type="integer", columnDefinition="NUMBER(14)")
//     * @var int
//     */
//    protected $id_usuario_sistema;

    /**
     * @ORM\ManyToOne(targetEntity="InepZend\Ssi\Entity\Perfil", inversedBy="usuarioSistemaPerfis")
     * @ORM\JoinColumn(name="id_perfil", referencedColumnName="id_perfil")
     */
    protected $perfil;

//    /**
//     * @ORM\Id
//     * @ORM\Column(type="integer", columnDefinition="NUMBER(14)")
//     * @var int
//     */
//    protected $id_perfil;

    public function getIdUsuarioSistemaPerfil()
    {
        return $this->id_usuario_sistema_perfil;
    }

    public function setIdUsuarioSistemaPerfil($id_usuario_sistema_perfil)
    {
        $this->id_usuario_sistema_perfil = (integer) $id_usuario_sistema_perfil;
        return $this;
    }

    public function getInAtivo()
    {
        return $this->in_ativo;
    }

    public function setInAtivo($in_ativo)
    {
        $this->in_ativo = (integer) $in_ativo;
        return $this;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

//    public function getIdUsuarioSistema()
//    {
//        return $this->id_usuario_sistema;
//    }
//
//    public function setIdUsuarioSistema($id_usuario_sistema)
//    {
//        $this->id_usuario_sistema = (integer) $id_usuario_sistema;
//        return $this;
//    }

    public function getPerfil()
    {
        return $this->perfil;
    }

    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
        return $this;
    }

//    public function getIdPerfil()
//    {
//        return $this->id_perfil;
//    }
//
//    public function setIdPerfil($id_perfil)
//    {
//        $this->id_perfil = (integer) $id_perfil;
//        return $this;
//    }

    public function toArray()
    {
        return array(
            'id_usuario_sistema_perfil' => $this->getIdUsuarioSistemaPerfil(),
            'in_ativo' => $this->getInAtivo(),
            'usuario' => $this->getUsuario()->getIdUsuario(),
//            'id_usuario_sistema' => $this->getIdUsuarioSistema(),
            'perfil' => $this->getPerfil()->getIdPerfil(),
//            'id_perfil' => $this->getIdPerfil(),
        );
    }

}
