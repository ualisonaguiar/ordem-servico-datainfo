<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Perfil
 *
 * @ORM\Table(name="SSI.VW_PERFIL_DEPENDENCIA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\VwPerfilDependenciaRepository")
 */
class VwPerfilDependencia extends Entity
{

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="ID_PERFIL_DEPENDENCIA", type="string", length=512, nullable=true)
     */
    private $idPerfilDependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PERFIL_FILHO", type="smallint", nullable=false)
     */
    private $idPerfilFilho;

    /**
     * @var integer
     *
     * @ORM\Column(name="NO_PERFIL_FILHO", type="string", length=120, nullable=false)
     * @@__toString
     */
    private $noPerfilFilho;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PERFIL_PAI", type="smallint", nullable=false)
     */
    private $idPerfilPai;

    /**
     * @var integer
     *
     * @ORM\Column(name="NO_PERFIL_PAI", type="string", length=120, nullable=false)
     */
    private $noPerfilPai;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SISTEMA", type="smallint", nullable=false)
     */
    private $idSistema;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SISTEMA", type="string", length=250, nullable=false)
     */
    private $noSistema;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=true)
     */
    private $inAtivo;

    /**
     * Get idPerfil
     *
     * @return integer 
     */
    public function getIdPerfilDependencia()
    {
        return $this->idPerfilDependencia;
    }

    /**
     * Set idPerfilFilho
     *
     * @param integer $idPerfilFilho
     *
     * @return Perfil
     */
    public function setIdPerfilFilho($idPerfilFilho)
    {
        $this->idPerfilFilho = $idPerfilFilho;
        return $this;
    }

    /**
     * Get idPerfilPai
     *
     * @return integer 
     */
    public function getIdPerfilFilho()
    {
        return $this->idPerfilFilho;
    }

    /**
     * Set noPerfilPai
     *
     * @param integer $noPerfilFilho
     *
     * @return Perfil
     */
    public function setNoPerfilFilho($noPerfilFilho)
    {
        $this->noPerfilFilho = $noPerfilFilho;
        return $this;
    }

    /**
     * Get noPerfilFilho
     *
     * @return integer 
     */
    public function getNoPerfilFilho()
    {
        return $this->noPerfilFilho;
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
     * Set noPerfilPai
     *
     * @param integer $noPerfilPai
     *
     * @return Perfil
     */
    public function setNoPerfilPai($noPerfilPai)
    {
        $this->noPerfilPai = $noPerfilPai;
        return $this;
    }

    /**
     * Get noPerfilPai
     *
     * @return integer 
     */
    public function getNoPerfilPai()
    {
        return $this->noPerfilPai;
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
     * Set noSistema
     *
     * @param string $noSistema
     *
     * @return Sistema
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
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return AgenciaBancaria
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
