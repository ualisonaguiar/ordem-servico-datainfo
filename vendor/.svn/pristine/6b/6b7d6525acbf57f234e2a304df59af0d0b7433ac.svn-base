<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Sistema
 *
 * @ORM\Table(name="CORP.TC_SISTEMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\SistemaRepository")
 */
class Sistema extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_SISTEMA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_SISTEMA_CO_SISTEMA_seq", allocationSize=1, initialValue=1)
     */
    protected $coSistema;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_SISTEMA", type="string", length=500, nullable=true)
     */
    protected $dsSistema;

    /**
     * @var boolean
     *
     * @ORM\Column(name="FL_ATIVO", type="boolean", nullable=true)
     */
    protected $flAtivo;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SISTEMA", type="string", length=20, nullable=false)
     */
    protected $noSistema;


    /**
     * Get coSistema
     *
     * @return integer 
     */
    public function getCoSistema()
    {
        return $this->coSistema;
    }

    /**
     * Set dsSistema
     *
     * @param string $dsSistema
     *
     * @return Sistema
     */
    public function setDsSistema($dsSistema)
    {
        $this->dsSistema = $dsSistema;
        return $this;
    }

    /**
     * Get dsSistema
     *
     * @return string 
     */
    public function getDsSistema()
    {
        return $this->dsSistema;
    }

    /**
     * Set flAtivo
     *
     * @param boolean $flAtivo
     *
     * @return Sistema
     */
    public function setFlAtivo($flAtivo)
    {
        $this->flAtivo = $flAtivo;
        return $this;
    }

    /**
     * Get flAtivo
     *
     * @return boolean 
     */
    public function getFlAtivo()
    {
        return $this->flAtivo;
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
}

