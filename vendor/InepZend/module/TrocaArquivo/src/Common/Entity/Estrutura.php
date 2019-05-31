<?php

namespace InepZend\Module\TrocaArquivo\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\TrocaArquivo\Common\Entity\EstruturaRepository")
 * @ORM\Table(name="tb_estrutura")
 */
class Estrutura extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_estrutura;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_layout;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(100)")
     * @var string
     * @@__toString
     */
    protected $no_campo;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_tipo;

    /**
     * @var boolean
     * @ORM\Column(name="IN_OBRIGATORIEDADE", type="boolean", nullable=false)
     */
    protected $in_obrigatoriedade;

    /**
     * @var boolean
     * @ORM\Column(name="IN_OCORRENCIA", type="boolean", nullable=false)
     */
    protected $in_ocorrencia;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(20)")
     * @var string
     * @@__toString
     */
    protected $ds_tamanho_max;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(20)")
     * @var string
     * @@__toString
     */
    protected $ds_tamanho_min;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(50)")
     * @var string
     * @@__toString
     */
    protected $ds_validacao;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $nu_ordem;

    /**
     *
     * @return type
     */
    function getIdEstrutura()
    {
        return $this->id_estrutura;
    }

    /**
     *
     * @return type
     */
    function getIdLayout()
    {
        return $this->id_layout;
    }

    /**
     *
     * @return type
     */
    function getNoCampo()
    {
        return $this->no_campo;
    }

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
    function getInObrigatoriedade()
    {
        return $this->in_obrigatoriedade;
    }

    /**
     *
     * @return type
     */
    function getInOcorrencia()
    {
        return $this->in_ocorrencia;
    }

    /**
     *
     * @return type
     */
    function getDsTamanhoMax()
    {
        return $this->ds_tamanho_max;
    }

    /**
     *
     * @return type
     */
    function getDsTamanhoMin()
    {
        return $this->ds_tamanho_min;
    }

    /**
     *
     * @return type
     */
    function getDsValidacao()
    {
        return $this->ds_validacao;
    }

    /**
     *
     * @return type
     */
    function getNuOrdem()
    {
        return $this->nu_ordem;
    }

    /**
     *
     * @param type $id_estrutura
     */
    function setIdEstrutura($id_estrutura)
    {
        $this->id_estrutura = (is_numeric($id_estrutura)) ? (integer) $id_estrutura : $id_estrutura;
        return $this;
    }

    /**
     *
     * @param type $id_layout
     */
    function setIdLayout($id_layout)
    {
        $this->id_layout = (is_numeric($id_layout)) ? (integer) $id_layout : $id_layout;
        return $this;
    }

    /**
     *
     * @param type $no_campo
     */
    function setNoCampo($no_campo)
    {
        $this->no_campo = $no_campo;
        return $this;
    }

    /**
     *
     * @param type $id_tipo
     */
    function setIdTipo($id_tipo)
    {
        $this->id_tipo = (is_numeric($id_tipo)) ? (integer) $id_tipo : $id_tipo;
        return $this;
    }

    /**
     *
     * @param type $in_obrigatoriedade
     */
    function setInObrigatoriedade($in_obrigatoriedade)
    {
        $this->in_obrigatoriedade = $in_obrigatoriedade;
        return $this;
    }

    /**
     *
     * @param type $in_ocorrencia
     */
    function setInOcorrencia($in_ocorrencia)
    {
        $this->in_ocorrencia = $in_ocorrencia;
        return $this;
    }

    /**
     * @param $ds_tamanho_max
     */
    function setDsTamanhoMax($ds_tamanho_max)
    {
        $this->ds_tamanho_max = $ds_tamanho_max;
        return $this;
    }
    
    /**
     * @param $ds_tamanho_min
     */
    function setDsTamanhoMin($ds_tamanho_min)
    {
        $this->ds_tamanho_min = $ds_tamanho_min;
        return $this;
    }

    /**
     *
     * @param type $ds_validacao
     */
    function setDsValidacao($ds_validacao)
    {
        $this->ds_validacao = $ds_validacao;
        return $this;
    }

    /**
     *
     * @param type $ds_validacao
     */
    function setNuOrdem($nu_ordem)
    {
        $this->nu_ordem = $nu_ordem;
        return $this;
    }

}
