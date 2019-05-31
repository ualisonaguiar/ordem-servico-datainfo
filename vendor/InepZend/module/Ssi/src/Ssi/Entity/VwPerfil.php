<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Perfil
 *
 * @ORM\Table(name="SSI.VW_PERFIL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\VwPerfilRepository")
 */
class VwPerfil extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_PERFIL", type="string", length=512, nullable=true)
     */
    private $dsPerfil;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_PERFIL", type="integer", nullable=false)
     */
    private $idPerfil;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PERFIL_PAI", type="integer", nullable=true)
     */
    private $idPerfilPai;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SISTEMA", type="smallint", nullable=false)
     */
    private $idSistema;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO_PERFIL", type="boolean", nullable=false)
     */
    private $inAtivoPerfil;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO_SISTEMA", type="boolean", nullable=false)
     */
    private $inAtivoSistema;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PERFIL", type="string", length=120, nullable=false)
     */
    private $noPerfil;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SISTEMA", type="string", length=250, nullable=false)
     */
    private $noSistema;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_PERFIL", type="string", length=50, nullable=true)
     */
    private $noTipoPerfil;


    /**
     * Set dsPerfil
     *
     * @param string $dsPerfil
     *
     * @return Perfil
     */
    public function setDsPerfil($dsPerfil)
    {
        $this->dsPerfil = $dsPerfil;
        return $this;
    }

    /**
     * Get dsPerfil
     *
     * @return string 
     */
    public function getDsPerfil()
    {
        return $this->dsPerfil;
    }

    /**
     * Set idPerfil
     *
     * @param integer $idPerfil
     *
     * @return Perfil
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
     * Set idPerfilPai
     *
     * @param integer $idPerfilPai
     *
     * @return Perfil
     */
    public function setIdPerfilPai($idPerfilPai)
    {
        $this->idPerfilPai = $idPerfilPai;
        return $this;
    }

    /**
     * Get idPerfilPai
     *
     * @return integer 
     */
    public function getIdPerfilPai()
    {
        return $this->idPerfilPai;
    }

    /**
     * Set idSistema
     *
     * @param integer $idSistema
     *
     * @return Perfil
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
     * Set inAtivoPerfil
     *
     * @param boolean $inAtivoPerfil
     *
     * @return Perfil
     */
    public function setInAtivoPerfil($inAtivoPerfil)
    {
        $this->inAtivoPerfil = $inAtivoPerfil;
        return $this;
    }

    /**
     * Get inAtivoPerfil
     *
     * @return boolean 
     */
    public function getInAtivoPerfil()
    {
        return $this->inAtivoPerfil;
    }

    /**
     * Set inAtivoSistema
     *
     * @param boolean $inAtivoSistema
     *
     * @return Perfil
     */
    public function setInAtivoSistema($inAtivoSistema)
    {
        $this->inAtivoSistema = $inAtivoSistema;
        return $this;
    }

    /**
     * Get inAtivoSistema
     *
     * @return boolean 
     */
    public function getInAtivoSistema()
    {
        return $this->inAtivoSistema;
    }

    /**
     * Set noPerfil
     *
     * @param string $noPerfil
     *
     * @return Perfil
     */
    public function setNoPerfil($noPerfil)
    {
        $this->noPerfil = $noPerfil;
        return $this;
    }

    /**
     * Get noPerfil
     *
     * @return string 
     */
    public function getNoPerfil()
    {
        return $this->noPerfil;
    }

    /**
     * Set noSistema
     *
     * @param string $noSistema
     *
     * @return Perfil
     */
    public function setNoSistema($noSistema)
    {
        $this->noSistema = $noSistema;
        return $this;
    }

    /**
     * Get noSistema
     *
     * @return string 
     */
    public function getNoSistema()
    {
        return $this->noSistema;
    }

    /**
     * Set noTipoPerfil
     *
     * @param string $noTipoPerfil
     *
     * @return Perfil
     */
    public function setNoTipoPerfil($noTipoPerfil)
    {
        $this->noTipoPerfil = $noTipoPerfil;
        return $this;
    }

    /**
     * Get noTipoPerfil
     *
     * @return string 
     */
    public function getNoTipoPerfil()
    {
        return $this->noTipoPerfil;
    }
}

