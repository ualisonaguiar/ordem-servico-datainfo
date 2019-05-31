<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * AtendimentoEspecial
 *
 * @ORM\Table(name="CORP.TC_ATENDIMENTO_ESPECIAL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\AtendimentoEspecialRepository")
 */
class AtendimentoEspecial extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_ATENDIMENTO_ESPECIAL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_ATENDIMENTO_ESPECIAL_CO_ATE", allocationSize=1, initialValue=1)
     */
    protected $coAtendimentoEspecial;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_ATENDIMENTO", type="string", length=100, nullable=false)
     */
    protected $dsAtendimento;


    /**
     * Get coAtendimentoEspecial
     *
     * @return integer 
     */
    public function getCoAtendimentoEspecial()
    {
        return $this->coAtendimentoEspecial;
    }

    /**
     * Set dsAtendimento
     *
     * @param string $dsAtendimento
     *
     * @return AtendimentoEspecial
     */
    public function setDsAtendimento($dsAtendimento)
    {
        $this->dsAtendimento = $dsAtendimento;
        return $this;
    }

    /**
     * Get dsAtendimento
     *
     * @return string 
     */
    public function getDsAtendimento()
    {
        return $this->dsAtendimento;
    }
}

