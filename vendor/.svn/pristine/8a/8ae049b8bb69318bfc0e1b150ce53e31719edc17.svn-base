<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * TipoAtribuicaoCartorio
 *
 * @ORM\Table(name="CORP.TB_TIPO_ATRIBUICAO_CARTORIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\TipoAtribuicaoCartorioRepository")
 */
class TipoAtribuicaoCartorio extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_TIPO_ATRIBUICAO_CARTORIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_TIPO_ATRIBUICAO_CARTORIO_CO", allocationSize=1, initialValue=1)
     */
    protected $coTipoAtribuicaoCartorio;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_ATRIBUICAO_CARTORIO", type="string", length=80, nullable=false)
     */
    protected $noTipoAtribuicaoCartorio;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="InepZend\Module\Corporative\Entity\Cartorio", inversedBy="coTipoAtribuicaoCartorio")
     * @ORM\JoinTable(name="tb_cartorio_atribuicao",
     *   joinColumns={
     *     @ORM\JoinColumn(name="CO_TIPO_ATRIBUICAO_CARTORIO", referencedColumnName="CO_TIPO_ATRIBUICAO_CARTORIO")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ID_CARTORIO", referencedColumnName="ID_CARTORIO")
     *   }
     * )
     */
    protected $idCartorio;


    /**
     * Get coTipoAtribuicaoCartorio
     *
     * @return integer 
     */
    public function getCoTipoAtribuicaoCartorio()
    {
        return $this->coTipoAtribuicaoCartorio;
    }

    /**
     * Set noTipoAtribuicaoCartorio
     *
     * @param string $noTipoAtribuicaoCartorio
     *
     * @return TipoAtribuicaoCartorio
     */
    public function setNoTipoAtribuicaoCartorio($noTipoAtribuicaoCartorio)
    {
        $this->noTipoAtribuicaoCartorio = $noTipoAtribuicaoCartorio;
        return $this;
    }

    /**
     * Get noTipoAtribuicaoCartorio
     *
     * @return string 
     */
    public function getNoTipoAtribuicaoCartorio()
    {
        return $this->noTipoAtribuicaoCartorio;
    }

    /**
     * Add idCartorio
     *
     * @param \InepZend\Module\Corporative\Entity\Cartorio $idCartorio
     *
     * @return TipoAtribuicaoCartorio
     */
    public function addIdCartorio(\InepZend\Module\Corporative\Entity\Cartorio $idCartorio)
    {
        $this->idCartorio[] = $idCartorio;
    
        return $this;
    }

    /**
     * Remove idCartorio
     *
     * @param \InepZend\Module\Corporative\Entity\Cartorio $idCartorio
     */
    public function removeIdCartorio(\InepZend\Module\Corporative\Entity\Cartorio $idCartorio)
    {
        $this->idCartorio->removeElement($idCartorio);
    }

    /**
     * Get idCartorio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdCartorio()
    {
        return $this->idCartorio;
    }
}

