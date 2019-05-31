<?php

namespace InepZend\Module\TrocaArquivo\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\TrocaArquivo\Common\Entity\ResponsavelRepository")
 * @ORM\Table(name="tb_responsavel")
 */
class Responsavel extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     * @@__toString
     */
    protected $id_responsavel;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_usuario_sistema;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $co_projeto;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(2)")
     * @var string
     */
    protected $sg_uf;

    public function getIdResponsavel()
    {
        return $this->id_responsavel;
    }

    public function setIdResponsavel($intIdResponsavel = null)
    {
        $this->id_responsavel = (is_numeric($intIdResponsavel)) ? (integer) $intIdResponsavel : $intIdResponsavel;
        return $this;
    }

    public function getIdUsuarioSistema()
    {
        return $this->id_usuario_sistema;
    }

    public function setIdUsuarioSistema($intIdUsuarioSistema = null)
    {
        $this->id_usuario_sistema = (is_numeric($intIdUsuarioSistema)) ? (integer) $intIdUsuarioSistema : $intIdUsuarioSistema;
        return $this;
    }

    public function getCoProjeto()
    {
        return $this->co_projeto;
    }

    public function setCoProjeto($intCoProjeto = null)
    {
        $this->co_projeto = (is_numeric($intCoProjeto)) ? (integer) $intCoProjeto : $intCoProjeto;
        return $this;
    }

    public function getSgUf()
    {
        return $this->sg_uf;
    }

    public function setSgUf($strSgUf = null)
    {
        $this->sg_uf = $strSgUf;
        return $this;
    }

}
