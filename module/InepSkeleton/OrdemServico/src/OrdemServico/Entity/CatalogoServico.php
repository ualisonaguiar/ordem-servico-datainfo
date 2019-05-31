<?php

namespace OrdemServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="OrdemServico\Entity\CatalogoServicoRepository")
 * @ORM\Table(name="tb_catalogo_servico")
 */
class CatalogoServico extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_catalogo_servico;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     * @@__toString
     */
    protected $no_catalogo_servico;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     * @@__toString
     */
    protected $area_assessoria;

    /**
     * Get id_catalogo_servico
     *
     * @return \OrdemServico\Entity\CatalogoServico
     */
    public function getIdCatalogoServico()
    {
        return $this->id_catalogo_servico;
    }

    /**
     * Set id_catalogo_servico_atividade
     *
     * @param type $intIdCatalogoServico
     * @return \OrdemServico\Entity\CatalogoServicoAtividade
     */
    public function setIdCatalogoServico($intIdCatalogoServico = null)
    {
        $this->id_catalogo_servico = $intIdCatalogoServico;
        return $this;
    }

    /**
     * Get no_catalogo_servico
     *
     * @return type
     */
    public function getNoCatalogoServico()
    {
        return $this->no_catalogo_servico;
    }

    /**
     * Set no_catalogo_servico
     *
     * @param type $strNoCatalogoServico
     * @return \OrdemServico\Entity\CatalogoServico
     */
    public function setNoCatalogoServico($strNoCatalogoServico = null)
    {
        $this->no_catalogo_servico = $strNoCatalogoServico;
        return $this;
    }

    /**
     * Get area_assessoria
     *
     * @return type
     */
    public function getAreaAssessoria()
    {
        return $this->area_assessoria;
    }

    /**
     * Set area_assessoria
     *
     * @param type $strAreaAssessoria
     * @return \OrdemServico\Entity\CatalogoServico
     */
    public function setAreaAssessoria($strAreaAssessoria = null)
    {
        $this->area_assessoria = $strAreaAssessoria;
        return $this;
    }
}
