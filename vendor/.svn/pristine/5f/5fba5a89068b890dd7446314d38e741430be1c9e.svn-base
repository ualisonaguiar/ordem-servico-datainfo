<?php

namespace InepZend\Module\TrocaArquivo\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\TrocaArquivo\Common\Entity\LayoutRepository")
 * @ORM\Table(name="tb_layout")
 */
class Layout extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_layout;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(100)")
     * @var string
     * @@__toString
     */
    protected $no_layout;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(400)")
     * @var string
     */
    protected $ds_caminho;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(200)")
     * @var string
     */
    protected $ds_url;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(20)")
     * @var string
     */
    protected $ds_encode;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(3)")
     * @var string
     */
    protected $ds_separador_coluna;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(3)")
     * @var string
     */
    protected $ds_separador_linha;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(200)")
     * @var string
     */
    protected $ds_procedure;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(200)")
     * @var string
     */
    protected $ds_table;

    /**
     * @ORM\Column(type="boolean", columnDefinition="BOOLEAN")
     * @var boolean
     */
    protected $in_status;

    public function getIdLayout()
    {
        return $this->id_layout;
    }

    public function setIdLayout($intIdLayout = null)
    {
        $this->id_layout = (is_numeric($intIdLayout)) ? (integer) $intIdLayout : $intIdLayout;
        return $this;
    }

    public function getNoLayout()
    {
        return $this->no_layout;
    }

    public function setNoLayout($strNoLayout = null)
    {
        $this->no_layout = $strNoLayout;
        return $this;
    }

    public function getDsCaminho()
    {
        return $this->ds_caminho;
    }

    public function setDsCaminho($strDsCaminho = null)
    {
        $this->ds_caminho = $strDsCaminho;
        return $this;
    }

    public function getDsUrl()
    {
        return $this->ds_url;
    }

    public function setDsUrl($strDsUrl = null)
    {
        $this->ds_url = $strDsUrl;
        return $this;
    }

    public function getDsEncode()
    {
        return $this->ds_encode;
    }

    public function setDsEncode($strDsEncode = null)
    {
        $this->ds_encode = $strDsEncode;
        return $this;
    }

    public function getDsSeparadorColuna()
    {
        return $this->ds_separador_coluna;
    }

    public function setDsSeparadorColuna($strDsSeparadorColuna = null)
    {
        $this->ds_separador_coluna = $strDsSeparadorColuna;
        return $this;
    }

    public function getDsSeparadorLinha()
    {
        return $this->ds_separador_linha;
    }

    public function setDsSeparadorLinha($strDsSeparadorLinha = null)
    {
        $this->ds_separador_linha = $strDsSeparadorLinha;
        return $this;
    }

    public function getDsProcedure()
    {
        return $this->ds_procedure;
    }

    public function setDsProcedure($strDsProcedure = null)
    {
        $this->ds_procedure = $strDsProcedure;
        return $this;
    }

    public function getDsTable()
    {
        return $this->ds_table;
    }

    public function setDsTable($strDsTable = null)
    {
        $this->ds_table = $strDsTable;
        return $this;
    }

    public function getInStatus()
    {
        return $this->in_status;
    }

    public function setInStatus($booInStatus = null)
    {
        $this->in_status = $booInStatus;
        return $this;
    }

}
