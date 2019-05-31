<?php

namespace InepZend\Module\UnitTest\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Configurator\Configurator;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\UnitTest\Entity\SubcategoriaRepository")
 * @ORM\Table(name="inep_skeleton.tb_subcategoria")
 */
class Subcategoria extends Entity
{

    public function __construct($mixOptions = null)
    {
        Configurator::configure($this, $mixOptions);
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $co_subcategoria;

    /**
     * @ORM\ManyToOne(targetEntity="InepZend\Module\UnitTest\Entity\Categoria", inversedBy="subcategorias")
     * @ORM\JoinColumn(name="co_categoria", referencedColumnName="co_categoria")
     */
    protected $categoria;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     * @@__toString
     */
    protected $no_subcategoria;

    public function getCoSubcategoria()
    {
        return $this->co_subcategoria;
    }

    public function setCoSubcategoria($co_subcategoria)
    {
        if (is_numeric($co_subcategoria))
            $this->co_subcategoria = (integer) $co_subcategoria;
        return $this;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
        return $this;
    }

    public function getNoSubcategoria()
    {
        return $this->no_subcategoria;
    }

    public function setNoSubcategoria($no_subcategoria)
    {
        $this->no_subcategoria = $no_subcategoria;
        return $this;
    }

    public function toArray()
    {
        return array(
            'co_subcategoria' => $this->getCoSubcategoria(),
            'co_categoria' => $this->getCategoria(),
            'no_subcategoria' => $this->getNoSubcategoria(),
        );
    }

}
