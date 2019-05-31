<?php
namespace InepZend\Module\TrocaArquivo\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\TrocaArquivo\Common\Entity\RegraValidacaoRepository")
 * @ORM\Table(name="tb_regra_validacao")
 */
class RegraValidacao extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var int
     */
    protected $id_regra_validacao;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     *
     * @var int
     */
    protected $id_layout;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     *
     * @var int
     */
    protected $id_ilha_dado;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(1)")
     *
     * @var string
     */
    protected $in_existente_ilha_dado;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(600)")
     *
     * @@__toString
     *
     * @var string
     */
    protected $ds_coluna;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(1)")
     *
     * @var string
     */
    protected $in_ativo;

    public function getIdRegraValidacao()
    {
        return $this->id_regra_validacao;
    }

    public function setIdRegraValidacao($intIdRegraValidacao = null)
    {
        $this->id_regra_validacao = (is_numeric($intIdRegraValidacao)) ? (integer) $intIdRegraValidacao : $intIdRegraValidacao;
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

    public function getIdIlhaDado()
    {
        return $this->id_ilha_dado;
    }

    public function setIdIlhaDado($intIdIlhaDado = null)
    {
        $this->id_ilha_dado = (is_numeric($intIdIlhaDado)) ? (integer) $intIdIlhaDado : $intIdIlhaDado;
        return $this;
    }

    public function getInExistenteIlhaDado()
    {
        return $this->in_existente_ilha_dado;
    }

    public function setInExistenteIlhaDado($strInExistenteIlhaDado = null)
    {
        $this->in_existente_ilha_dado = $strInExistenteIlhaDado;
        return $this;
    }

    public function getInExistenteIlhaDadoText()
    {
        return (empty($this->in_existente_ilha_dado)) ? 'Não' : 'Sim';
    }

    public function getDsColuna($booEdited = false)
    {
        $strDsColuna = $this->ds_coluna;
        return ($booEdited) ? explode(',', str_replace(array(' ', ';'), array('', ','), $strDsColuna)) : $strDsColuna;
    }

    public function setDsColuna($strDsColuna = null)
    {
        $this->ds_coluna = $strDsColuna;
        return $this;
    }

    public function getInAtivo()
    {
        return $this->in_ativo;
    }

    public function setInAtivo($strInAtivo = null)
    {
        $this->in_ativo = $strInAtivo;
        return $this;
    }

    public function getInAtivoText()
    {
        return (empty($this->in_ativo)) ? 'Não' : 'Sim';
    }
}
