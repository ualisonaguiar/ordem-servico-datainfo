<?php

namespace InepZend\Module\TrocaArquivo\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\FileSystem;
use InepZend\Util\Date;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\TrocaArquivo\Common\Entity\ArquivoRepository")
 * @ORM\Table(name="tb_arquivo")
 */
class Arquivo extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_arquivo;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_configuracao;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     * @@__toString
     */
    protected $no_arquivo;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(400)")
     * @var string
     */
    protected $ds_caminho;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(32)")
     * @var string
     */
    protected $ds_integridade;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_responsavel;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_envio;

    public function getIdArquivo()
    {
        return $this->id_arquivo;
    }

    public function setIdArquivo($intIdArquivo = null)
    {
        $this->id_arquivo = (is_numeric($intIdArquivo)) ? (integer) $intIdArquivo : $intIdArquivo;
        return $this;
    }

    public function getIdConfiguracao()
    {
        return $this->id_configuracao;
    }

    public function setIdConfiguracao($intIdConfiguracao = null)
    {
        $this->id_configuracao = (is_numeric($intIdConfiguracao)) ? (integer) $intIdConfiguracao : $intIdConfiguracao;
        return $this;
    }

    public function getNoArquivo()
    {
        return $this->no_arquivo;
    }

    public function setNoArquivo($strNoArquivo = null)
    {
        $this->no_arquivo = $strNoArquivo;
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

    public function getDsFilesize()
    {
        return (is_file($this->getDsCaminho())) ? FileSystem::filesizeFormated($this->getDsCaminho()) : null;
    }

    public function getDsIntegridade()
    {
        return $this->ds_integridade;
    }

    public function setDsIntegridade($strDsIntegridade = null)
    {
        $this->ds_integridade = $strDsIntegridade;
        return $this;
    }

    public function getIdResponsavel()
    {
        return $this->id_responsavel;
    }

    public function setIdResponsavel($intIdResponsavel = null)
    {
        $this->id_responsavel = (is_numeric($intIdResponsavel)) ? (integer) $intIdResponsavel : $intIdResponsavel;
        return $this;
    }

    public function getDtEnvio()
    {
        return Date::convertDate($this->dt_envio, 'd/m/Y H:i:s');
    }

    public function setDtEnvio($strDtEnvio = null)
    {
        $this->dt_envio = $strDtEnvio;
        return $this;
    }

}
