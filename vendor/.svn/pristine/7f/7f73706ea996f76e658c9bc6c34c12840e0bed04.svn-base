<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * UsuarioSistema
 *
 * @ORM\Table(name="CORP.TC_USUARIO_SISTEMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\UsuarioSistemaRepository")
 */
class UsuarioSistema extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_USUARIO_SISTEMA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_USUARIO_SISTEMA_CO_USUARIO_", allocationSize=1, initialValue=1)
     */
    protected $coUsuarioSistema;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_BLOQUEIO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtBloqueio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_EXPIRACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtExpiracao;

    /**
     * @var \InepZend\Module\Corporative\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_USUARIO", referencedColumnName="CO_USUARIO")
     * })
     */
    protected $coUsuario;

    /**
     * @var \InepZend\Module\Corporative\Entity\Sistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Sistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_SISTEMA", referencedColumnName="CO_SISTEMA")
     * })
     */
    protected $coSistema;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="InepZend\Module\Corporative\Entity\Perfil", mappedBy="coUsuarioSistema")
     */
    protected $coPerfil;


    /**
     * Get coUsuarioSistema
     *
     * @return integer 
     */
    public function getCoUsuarioSistema()
    {
        return $this->coUsuarioSistema;
    }

    /**
     * Set dtBloqueio
     *
     * @param \DateTime $dtBloqueio
     *
     * @return UsuarioSistema
     */
    public function setDtBloqueio($dtBloqueio)
    {
        $this->dtBloqueio = $dtBloqueio;
        return $this;
    }

    /**
     * Get dtBloqueio
     *
     * @return \DateTime 
     */
    public function getDtBloqueio()
    {
        return Date::convertDate($this->dtBloqueio, "d/m/Y");
    }

    /**
     * Set dtExpiracao
     *
     * @param \DateTime $dtExpiracao
     *
     * @return UsuarioSistema
     */
    public function setDtExpiracao($dtExpiracao)
    {
        $this->dtExpiracao = $dtExpiracao;
        return $this;
    }

    /**
     * Get dtExpiracao
     *
     * @return \DateTime 
     */
    public function getDtExpiracao()
    {
        return Date::convertDate($this->dtExpiracao, "d/m/Y");
    }

    /**
     * Set coUsuario
     *
     * @param \InepZend\Module\Corporative\Entity\Usuario $coUsuario
     *
     * @return UsuarioSistema
     */
    public function setCoUsuario(\InepZend\Module\Corporative\Entity\Usuario $coUsuario = null)
    {
        $this->coUsuario = $coUsuario;
        return $this;
    }

    /**
     * Get coUsuario
     *
     * @return \InepZend\Module\Corporative\Entity\Usuario 
     */
    public function getCoUsuario()
    {
        return $this->coUsuario;
    }

    /**
     * Set coSistema
     *
     * @param \InepZend\Module\Corporative\Entity\Sistema $coSistema
     *
     * @return UsuarioSistema
     */
    public function setCoSistema(\InepZend\Module\Corporative\Entity\Sistema $coSistema = null)
    {
        $this->coSistema = $coSistema;
        return $this;
    }

    /**
     * Get coSistema
     *
     * @return \InepZend\Module\Corporative\Entity\Sistema 
     */
    public function getCoSistema()
    {
        return $this->coSistema;
    }

    /**
     * Add coPerfil
     *
     * @param \InepZend\Module\Corporative\Entity\Perfil $coPerfil
     *
     * @return UsuarioSistema
     */
    public function addCoPerfil(\InepZend\Module\Corporative\Entity\Perfil $coPerfil)
    {
        $this->coPerfil[] = $coPerfil;
    
        return $this;
    }

    /**
     * Remove coPerfil
     *
     * @param \InepZend\Module\Corporative\Entity\Perfil $coPerfil
     */
    public function removeCoPerfil(\InepZend\Module\Corporative\Entity\Perfil $coPerfil)
    {
        $this->coPerfil->removeElement($coPerfil);
    }

    /**
     * Get coPerfil
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCoPerfil()
    {
        return $this->coPerfil;
    }
}

