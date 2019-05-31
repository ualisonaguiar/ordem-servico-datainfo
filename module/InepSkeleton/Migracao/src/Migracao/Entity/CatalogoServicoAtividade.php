<?php

namespace Migracao\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="Migracao\Entity\CatalogoServicoAtividadeRepository")
 * @ORM\Table(name="tb_catalogo_servico_atividade")
 */
class CatalogoServicoAtividade extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="seq_catalogo_servico_atividade", initialValue=1, allocationSize=1)
     * @var int
     */
    protected $id_catalogo_servico_atividade;


    /**
     * @var \Migracao\Entity\CatalogoServico
     *
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     */
    protected $id_catalogo_servico;


    /**
     * @var \Migracao\Entity\Atividade
     *
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     */
    protected $id_atividade;

    /**
     * Get id_catalogo_servico_atividade
     *
     * @return \Migracao\Entity\CatalogoServicoAtividade
     */
    public function getIdCatalogoServicoAtividade()
    {
        return $this->id_catalogo_servico_atividade;
    }

    /**
     * Set id_catalogo_servico_atividade
     *
     * @param type $intIdCatalogoServicoAtividade
     * @return \Migracao\Entity\CatalogoServicoAtividade
     */
    public function setIdCatalogoServicoAtividade($intIdCatalogoServicoAtividade = null)
    {
        $this->id_catalogo_servico_atividade = (is_numeric($intIdCatalogoServicoAtividade))
                ? (integer) $intIdCatalogoServicoAtividade
                : $intIdCatalogoServicoAtividade;
        return $this;
    }

    /**
     * Get Migracao\Entity\CatalogoServico
     *
     * @return Migracao\Entity\CatalogoServico
     */
    public function getIdCatalogoServico()
    {
        return $this->id_catalogo_servico;
    }

    /**
     * Set id_catalogo_servico
     *
     * @param \Migracao\Entity\CatalogoServico $catalogoServico
     * @return \Migracao\Entity\CatalogoServico
     */
    public function setIdCatalogoServico($catalogoServico = null)
    {
        $this->id_catalogo_servico = $catalogoServico;
        return $this;
    }

    /**
     * Get Migracao\Entity\Atividade
     *
     * @return Migracao\Entity\Atividade
     */
    public function getIdAtividade()
    {
        return $this->id_atividade;
    }

    /**
     * Set id_atividade
     *
     * @param \Migracao\Entity\Atividade $intIdAtividade
     * @return \Migracao\Entity\CatalogoServicoAtividade
     */
    public function setIdAtividade($intIdAtividade = null)
    {
        $this->id_atividade = (is_numeric($intIdAtividade))
                ? (integer) $intIdAtividade
                : $intIdAtividade;
    }
}
