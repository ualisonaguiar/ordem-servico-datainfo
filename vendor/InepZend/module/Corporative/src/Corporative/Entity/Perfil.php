<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Perfil
 *
 * @ORM\Table(name="CORP.TC_PERFIL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\PerfilRepository")
 */
class Perfil extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PERFIL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_PERFIL_CO_PERFIL_seq", allocationSize=1, initialValue=1)
     */
    protected $coPerfil;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_PERFIL", type="string", length=512, nullable=true)
     */
    protected $dsPerfil;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PERFIL", type="string", length=120, nullable=false)
     */
    protected $noPerfil;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_ROLE_PERFIL", type="string", length=50, nullable=true)
     */
    protected $noRolePerfil;

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
     * @ORM\ManyToMany(targetEntity="InepZend\Module\Corporative\Entity\Acao", mappedBy="coPerfil")
     */
    protected $coAcao;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="InepZend\Module\Corporative\Entity\UsuarioSistema", inversedBy="coPerfil")
     * @ORM\JoinTable(name="tc_usuario_sistema_perfil",
     *   joinColumns={
     *     @ORM\JoinColumn(name="CO_PERFIL", referencedColumnName="CO_PERFIL")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="CO_USUARIO_SISTEMA", referencedColumnName="CO_USUARIO_SISTEMA")
     *   }
     * )
     */
    protected $coUsuarioSistema;


    /**
     * Get coPerfil
     *
     * @return integer 
     */
    public function getCoPerfil()
    {
        return $this->coPerfil;
    }

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
     * Set noRolePerfil
     *
     * @param string $noRolePerfil
     *
     * @return Perfil
     */
    public function setNoRolePerfil($noRolePerfil)
    {
        $this->noRolePerfil = $noRolePerfil;
        return $this;
    }

    /**
     * Get noRolePerfil
     *
     * @return string 
     */
    public function getNoRolePerfil()
    {
        return $this->noRolePerfil;
    }

    /**
     * Set coSistema
     *
     * @param \InepZend\Module\Corporative\Entity\Sistema $coSistema
     *
     * @return Perfil
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
     * Add coAcao
     *
     * @param \InepZend\Module\Corporative\Entity\Acao $coAcao
     *
     * @return Perfil
     */
    public function addCoAcao(\InepZend\Module\Corporative\Entity\Acao $coAcao)
    {
        $this->coAcao[] = $coAcao;
    
        return $this;
    }

    /**
     * Remove coAcao
     *
     * @param \InepZend\Module\Corporative\Entity\Acao $coAcao
     */
    public function removeCoAcao(\InepZend\Module\Corporative\Entity\Acao $coAcao)
    {
        $this->coAcao->removeElement($coAcao);
    }

    /**
     * Get coAcao
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCoAcao()
    {
        return $this->coAcao;
    }

    /**
     * Add coUsuarioSistema
     *
     * @param \InepZend\Module\Corporative\Entity\UsuarioSistema $coUsuarioSistema
     *
     * @return Perfil
     */
    public function addCoUsuarioSistema(\InepZend\Module\Corporative\Entity\UsuarioSistema $coUsuarioSistema)
    {
        $this->coUsuarioSistema[] = $coUsuarioSistema;
    
        return $this;
    }

    /**
     * Remove coUsuarioSistema
     *
     * @param \InepZend\Module\Corporative\Entity\UsuarioSistema $coUsuarioSistema
     */
    public function removeCoUsuarioSistema(\InepZend\Module\Corporative\Entity\UsuarioSistema $coUsuarioSistema)
    {
        $this->coUsuarioSistema->removeElement($coUsuarioSistema);
    }

    /**
     * Get coUsuarioSistema
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCoUsuarioSistema()
    {
        return $this->coUsuarioSistema;
    }
}

