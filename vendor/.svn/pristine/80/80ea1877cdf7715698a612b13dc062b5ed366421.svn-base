<?php

namespace InepZend\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Configurator\Configurator;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="InepZend\Ssi\Entity\PerfilRepository")
 * @ORM\Table(name="ssi.vw_perfil")
 */
class Perfil extends Entity
{

    public function __construct($mixOptions = null)
    {
        Configurator::configure($this, $mixOptions);
        $this->perfisAcao = new ArrayCollection();
        $this->usuarioSistemaPerfis = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", columnDefinition="NUMBER(14)")
     * @var int
     */
    protected $id_perfil;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(120)")
     * @var string
     */
    protected $no_perfil;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(512)")
     * @var string
     */
    protected $ds_perfil;

    /**
     * @ORM\Column(type="integer", columnDefinition="NUMBER(5)")
     * @var int
     */
    protected $id_sistema;

    /**
     * @ORM\Column(type="integer", columnDefinition="NUMBER(14)")
     * @var int
     */
    protected $id_perfil_pai;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(50)")
     * @var string
     */
    protected $no_tipo_perfil;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(20)")
     * @var string
     */
    protected $no_sistema;

    /**
     * @ORM\OneToMany(targetEntity="InepZend\Ssi\Entity\PerfilAcao", mappedBy="perfil")
     */
    protected $perfisAcao;

    /**
     * @ORM\OneToMany(targetEntity="InepZend\Ssi\Entity\UsuarioSistemaPerfil", mappedBy="perfil")
     */
    protected $usuarioSistemaPerfis;

    public function getIdPerfil()
    {
        return $this->id_perfil;
    }

    public function setIdPerfil($id_perfil)
    {
        $this->id_perfil = (integer) $id_perfil;
        return $this;
    }

    public function getNoPerfil()
    {
        return $this->no_perfil;
    }

    public function setNoPerfil($no_perfil)
    {
        $this->no_perfil = $no_perfil;
        return $this;
    }

    public function getDsPerfil()
    {
        return $this->ds_perfil;
    }

    public function setDsPerfil($ds_perfil)
    {
        $this->ds_perfil = $ds_perfil;
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

    public function getIdPerfilPai()
    {
        return $this->id_perfil_pai;
    }

    public function setIdPerfilPai($id_perfil_pai)
    {
        $this->id_perfil_pai = (integer) $id_perfil_pai;
        return $this;
    }

    public function getNoTipoPerfil()
    {
        return $this->no_tipo_perfil;
    }

    public function setNoTipoPerfil($no_tipo_perfil)
    {
        $this->no_tipo_perfil = $no_tipo_perfil;
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

    public function getPerfisAcao()
    {
        return (empty($this->perfisAcao)) ? $this->perfisAcao : $this->perfisAcao->toArray();
    }

    public function setPerfisAcao($perfisAcao)
    {
        $this->perfisAcao = $perfisAcao;
        return $this;
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
        return $this->no_perfil;
    }

    public function toArray()
    {
        return array(
            'id_perfil' => $this->getIdPerfil(),
            'no_perfil' => $this->getNoPerfil(),
            'ds_perfil' => $this->getDsPerfil(),
            'id_sistema' => $this->getIdSistema(),
            'id_perfil_pai' => $this->getIdPerfilPai(),
            'no_tipo_perfil' => $this->getNoTipoPerfil(),
            'no_sistema' => $this->getNoSistema(),
        );
    }

}
