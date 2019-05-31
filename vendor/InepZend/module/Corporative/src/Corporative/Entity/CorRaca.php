<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * CorRaca
 *
 * @ORM\Table(name="CORP.TC_COR_RACA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\CorRacaRepository")
 */
class CorRaca extends Entity
{

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_COR_RACA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $coCorRaca;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_COR_RACA", type="string", length=30, nullable=false)
     */
    protected $noCorRaca;

    /**
     * Set coCorRaca
     *
     * @param integer $coCorRaca
     *
     * @return CorRaca
     */
    public function setCoCorRaca($coCorRaca)
    {
        $this->coCorRaca = $coCorRaca;
        return $this;
    }

    /**
     * Get coCorRaca
     *
     * @return boolean 
     */
    public function getCoCorRaca()
    {
        return $this->coCorRaca;
    }

    /**
     * Set noCorRaca
     *
     * @param string $noCorRaca
     *
     * @return CorRaca
     */
    public function setNoCorRaca($noCorRaca)
    {
        $this->noCorRaca = $noCorRaca;
        return $this;
    }

    /**
     * Get noCorRaca
     * @@__toString
     *
     * @return string 
     */
    public function getNoCorRaca()
    {
        return $this->noCorRaca;
    }

}
