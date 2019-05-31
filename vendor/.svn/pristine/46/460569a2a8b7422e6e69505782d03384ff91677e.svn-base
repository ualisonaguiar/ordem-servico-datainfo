<?php

namespace InepZend\Module\UnitTest\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Configurator\Configurator;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\UnitTest\Entity\CategoriaRepository")
 * @ORM\Table(name="inep_skeleton.tb_categoria")
 */
class Categoria extends Entity
{

    public function __construct($mixOptions = null)
    {
        Configurator::configure($this, $mixOptions);
        $this->subcategorias = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $co_categoria;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     * @@__toString
     */
    protected $no_categoria;

    /**
     * @ORM\OneToMany(targetEntity="InepZend\Module\UnitTest\Entity\Subcategoria", mappedBy="categoria")
     */
    protected $subcategorias;

    public function getCoCategoria()
    {
        return $this->co_categoria;
    }

    public function setCoCategoria($co_categoria)
    {
        if (is_numeric($co_categoria))
            $this->co_categoria = (integer) $co_categoria;
        return $this;
    }

    public function getNoCategoria()
    {
        return $this->no_categoria;
    }

    public function setNoCategoria($no_categoria)
    {
        $this->no_categoria = $no_categoria;
        return $this;
    }

    public function getSubcategorias()
    {
        return (empty($this->subcategorias)) ? $this->subcategorias : $this->subcategorias->toArray();
    }

    public function setSubcategorias($subcategorias)
    {
        $this->subcategorias = $subcategorias;
        return $this;
    }

}
