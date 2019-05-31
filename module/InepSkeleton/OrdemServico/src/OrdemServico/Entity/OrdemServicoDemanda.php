<?php

namespace OrdemServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="OrdemServico\Entity\OrdemServicoDemandaRepository")
 * @ORM\Table(name="tb_ordem_servico_demanda")
 */
class OrdemServicoDemanda extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
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

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_usuario_alteracao;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_alteracao;

    public function getIdOrdemServicoDemanda()
    {
        return $this->id_ordem_servico_demanda;
    }

    public function setIdOrdemServicoDemanda($intIdOrdemServicoDemanda = null)
    {
        $this->id_ordem_servico_demanda = (is_numeric($intIdOrdemServicoDemanda)) ? (integer)$intIdOrdemServicoDemanda : $intIdOrdemServicoDemanda;
        return $this;
    }

    public function getIdOrdemServico()
    {
        return $this->id_ordem_servico;
    }

    public function setIdOrdemServico($intIdOrdemServico = null)
    {
        $this->id_ordem_servico = (is_numeric($intIdOrdemServico)) ? (integer)$intIdOrdemServico : $intIdOrdemServico;
        return $this;
    }

    public function getIdDemanda()
    {
        return $this->id_demanda;
    }

    public function setIdDemanda($intIdDemanda = null)
    {
        $this->id_demanda = (is_numeric($intIdDemanda)) ? (integer)$intIdDemanda : $intIdDemanda;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->id_usuario_alteracao;
    }

    /**
     * @param int $id_usuario_alteracao
     * @return OrdemServicoDemanda
     */
    public function setIdUsuarioAlteracao($id_usuario_alteracao)
    {
        $this->id_usuario_alteracao = $id_usuario_alteracao;
        return $this;
    }

    /**
     * @return string
     */
    public function getDtAlteracao()
    {
        return $this->dt_alteracao;
    }

    /**
     * @param string $dt_alteracao
     * @return OrdemServicoDemanda
     */
    public function setDtAlteracao($dt_alteracao)
    {
        $this->dt_alteracao = $dt_alteracao;
        return $this;
    }
}
