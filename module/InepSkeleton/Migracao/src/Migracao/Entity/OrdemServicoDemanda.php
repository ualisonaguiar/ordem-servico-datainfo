<?php

namespace Migracao\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="Migracao\Entity\OrdemServicoDemandaRepository")
 * @ORM\Table(name="tb_ordem_servico_demanda")
 */
class OrdemServicoDemanda extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @var int
     * @@__toString
     */
    protected $id_ordem_servico_demanda;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_ordem_servico;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_demanda;

    public function getIdOrdemServicoDemanda()
    {
        return $this->id_ordem_servico_demanda;
    }

    public function setIdOrdemServicoDemanda($intIdMigracaoDemanda = null)
    {
        $this->id_ordem_servico_demanda = $intIdMigracaoDemanda;
        return $this;
    }

    public function getIdOrdemServico()
    {
        return $this->id_ordem_servico;
    }

    public function setIdOrdemServico($intIdMigracao = null)
    {
        $this->id_ordem_servico = $intIdMigracao;
        return $this;
    }

    public function getIdDemanda()
    {
        return $this->id_demanda;
    }

    public function setIdDemanda($intIdDemanda = null)
    {
        $this->id_demanda = $intIdDemanda;
        return $this;
    }

}
