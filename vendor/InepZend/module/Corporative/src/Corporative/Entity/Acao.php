<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Acao
 *
 * @ORM\Table(name="CORP.TC_ACAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\AcaoRepository")
 */
class Acao extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_ACAO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_ACAO_CO_ACAO_seq", allocationSize=1, initialValue=1)
     */
    protected $coAcao;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_ACAO", type="string", length=512, nullable=true)
     */
    protected $dsAcao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_ACAO", type="string", length=120, nullable=false)
     */
    protected $noAcao;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_ACAO", type="string", length=50, nullable=false)
     */
    protected $sgAcao;

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
     * @ORM\ManyToMany(targetEntity="InepZend\Module\Corporative\Entity\Perfil", inversedBy="coAcao")
     * @ORM\JoinTable(name="tc_perfil_acao",
     *   joinColumns={
     *     @ORM\JoinColumn(name="CO_ACAO", referencedColumnName="CO_ACAO")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="CO_PERFIL", referencedColumnName="CO_PERFIL")
     *   }
     * )
     */
    protected $coPerfil;


    /**
     * Get coAcao
     *
     * @return integer 
     */
    public function getCoAcao()
    {
        return $this->coAcao;
    }

    /**
     * Set dsAcao
     *
     * @param string $dsAcao
     *
     * @return Acao
     */
    public function setDsAcao($dsAcao)
    {
        $this->dsAcao = $dsAcao;
        return $this;
    }

    /**
     * Get dsAcao
     *
     * @return string 
     */
    public function getDsAcao()
    {
        return $this->dsAcao;
    }

    /**
     * Set noAcao
     *
     * @param string $noAcao
     *
     * @return Acao
     */
    public function setNoAcao($noAcao)
    {
        $this->noAcao = $noAcao;
        return $this;
    }

    /**
     * Get noAcao
     *
     * @return string 
     */
    public function getNoAcao()
    {
        return $this->noAcao;
    }

    /**
     * Set sgAcao
     *
     * @param string $sgAcao
     *
     * @return Acao
     */
    public function setSgAcao($sgAcao)
    {
        $this->sgAcao = $sgAcao;
        return $this;
    }

    /**
     * Get sgAcao
     *
     * @return string 
     */
    public function getSgAcao()
    {
        return $this->sgAcao;
    }

    /**
     * Set coSistema
     *
     * @param \InepZend\Module\Corporative\Entity\Sistema $coSistema
     *
     * @return Acao
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
     * @return Acao
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

