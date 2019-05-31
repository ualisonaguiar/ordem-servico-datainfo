<?php

namespace InepZend\Module\TrocaArquivo\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\TrocaArquivo\Common\Entity\InterdependenciaRepository")
 * @ORM\Table(name="tb_interdependencia")
 */
class Interdependencia extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     * @@__toString
     */
    protected $id_interdependencia;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_layout;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_layout_dependente;

    public function getIdInterdependencia()
    {
        return $this->id_interdependencia;
    }

    public function setIdInterdependencia($intIdInterdependencia = null)
    {
        $this->id_interdependencia = (is_numeric($intIdInterdependencia)) ? (integer) $intIdInterdependencia : $intIdInterdependencia;
        return $this;
    }

    public function getIdLayout()
    {
        return $this->id_layout;
    }

    public function setIdLayout($intIdLayout = null)
    {
        $this->id_layout = (is_numeric($intIdLayout)) ? (integer) $intIdLayout : $intIdLayout;
        return $this;
    }

    public function getIdLayoutDependente()
    {
        return $this->id_layout_dependente;
    }

    public function setIdLayoutDependente($intIdLayoutDependente = null)
    {
        $this->id_layout_dependente = (is_numeric($intIdLayoutDependente)) ? (integer) $intIdLayoutDependente : $intIdLayoutDependente;
        return $this;
    }

}
