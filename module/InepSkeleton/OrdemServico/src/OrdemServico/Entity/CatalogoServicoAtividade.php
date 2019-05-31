<?php

namespace OrdemServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="OrdemServico\Entity\CatalogoServicoAtividadeRepository")
 * @ORM\Table(name="tb_catalogo_servico_atividade")
 */
class CatalogoServicoAtividade extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_catalogo_servico_atividade;


    /**
     * @var \OrdemServico\Entity\CatalogoServico
     *
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     */
    protected $id_catalogo_servico;

    /**
     * @var \OrdemServico\Entity\Atividade
     *
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     */
    protected $id_atividade;

    /**
     * Get id_catalogo_servico_atividade
     *
     * @return \OrdemServico\Entity\CatalogoServicoAtividade
     */
    public function getIdCatalogoServicoAtividade()
    {
        return $this->id_catalogo_servico_atividade;
    }

    /**
     * Set id_catalogo_servico_atividade
     *
     * @param type $intIdCatalogoServicoAtividade
     * @return \OrdemServico\Entity\CatalogoServicoAtividade
     */
    public function setIdCatalogoServicoAtividade($intIdCatalogoServicoAtividade = null)
    {
        $this->id_catalogo_servico_atividade = $intIdCatalogoServicoAtividade;
        return $this;
    }

    /**
     * Get OrdemServico\Entity\CatalogoServico
     *
     * @return OrdemServico\Entity\CatalogoServico
     */
    public function getIdCatalogoServico()
    {
        return $this->id_catalogo_servico;
    }

    /**
     * Set id_catalogo_servico
     *
     * @param \OrdemServico\Entity\CatalogoServico $catalogoServico
     * @return \OrdemServico\Entity\CatalogoServico
     */
    public function setIdCatalogoServico($catalogoServico = null)
    {
        $this->id_catalogo_servico = $catalogoServico;
        return $this;
    }

    /**
     * Get OrdemServico\Entity\Atividade
     *
     * @return OrdemServico\Entity\Atividade
     */
    public function getIdAtividade()
    {
        return $this->id_atividade;
    }

    /**
     * Set id_atividade
     *
     * @param \OrdemServico\Entity\Atividade $intIdAtividade
     * @return \OrdemServico\Entity\CatalogoServicoAtividade
     */
    public function setIdAtividade($intIdAtividade = null)
    {
        $this->id_atividade = $intIdAtividade;
    }
}
