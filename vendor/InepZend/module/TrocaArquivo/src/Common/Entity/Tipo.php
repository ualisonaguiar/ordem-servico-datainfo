<?php

namespace InepZend\Module\TrocaArquivo\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\TrocaArquivo\Common\Entity\TipoRepository")
 * @ORM\Table(name="tb_tipo")
 */
class Tipo extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_tipo;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(100)")
     * @var string
     * @@__toString
     */
    protected $no_tipo;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(100)")
     * @var string
     * @@__toString
     */
    protected $no_tipo_banco;

    /**
     * 
     * @return type
     */
    function getIdTipo()
    {
        return $this->id_tipo;
    }

    /**
     * 
     * @return type
     */
    function getNoTipo()
    {
        return $this->no_tipo;
    }

    /**
     * 
     * @return type
     */
    function getNoTipoBanco()
    {
        return $this->no_tipo_banco;
    }

    /**
     * 
     * @param type $id_tipo
     */
    function setIdTipo($id_tipo)
    {
        $this->id_tipo = $id_tipo;
    }

    /**
     * 
     * @param type $no_tipo
     */
    function setNoTipo($no_tipo)
    {
        $this->no_tipo = $no_tipo;
    }

    /**
     * 
     * @param type $no_tipo_banco
     */
    function setNoTipoBanco($no_tipo_banco)
    {
        $this->no_tipo_banco = $no_tipo_banco;
    }

}
