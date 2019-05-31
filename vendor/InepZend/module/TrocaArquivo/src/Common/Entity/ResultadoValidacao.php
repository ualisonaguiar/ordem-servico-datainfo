<?php

namespace InepZend\Module\TrocaArquivo\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\TrocaArquivo\Common\Entity\ResultadoValidacaoRepository")
 * @ORM\Table(name="tb_resultado_validacao")
 */
class ResultadoValidacao extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_resultado;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_arquivo;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(50)")
     * @var string
     */
    protected $tp_validacao;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(400)")
     * @var string
     * @@__toString
     */
    protected $ds_caminho;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(20)")
     * @var string
     */
    protected $no_status;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_inicio;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_fim;

    public function getIdResultado()
    {
        return $this->id_resultado;
    }

    public function setIdResultado($intIdResultado = null)
    {
        $this->id_resultado = (is_numeric($intIdResultado)) ? (integer) $intIdResultado : $intIdResultado;
        return $this;
    }

    public function getIdArquivo()
    {
        return $this->id_arquivo;
    }

    public function setIdArquivo($intIdArquivo = null)
    {
        $this->id_arquivo = (is_numeric($intIdArquivo)) ? (integer) $intIdArquivo : $intIdArquivo;
        return $this;
    }

    public function getTpValidacao()
    {
        return $this->tp_validacao;
    }

    public function setTpValidacao($strTpValidacao = null)
    {
        $this->tp_validacao = $strTpValidacao;
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

    public function getNoArquivo()
    {
        return end(explode('/', str_replace('\\', '/', $this->ds_caminho)));
    }

    public function getNoStatus()
    {
        return $this->no_status;
    }

    public function setNoStatus($strNoStatus = null)
    {
        $this->no_status = $strNoStatus;
        return $this;
    }

    public function getNoStatusHtml()
    {
        $strStyle = '';
        $strNoStatus = $this->getNoStatus();
        if ($strNoStatus == 'completed')
            $strStyle = 'font-weight: bold; color: green;';
        if ($strNoStatus == 'failure')
            $strStyle = 'font-weight: bold; color: red;';
        if (!empty($strStyle))
            $strNoStatus = '<font style="' . $strStyle . '">' . $strNoStatus . '</font>';
        return $strNoStatus;
    }

    public function getDtInicio()
    {
        return Date::convertDate($this->dt_inicio, 'd/m/Y H:i:s');
    }

    public function setDtInicio($strDtInicio = null)
    {
        $this->dt_inicio = $strDtInicio;
        return $this;
    }

    public function getDtFim()
    {
        return Date::convertDate($this->dt_fim, 'd/m/Y H:i:s');
    }

    public function setDtFim($strDtFim = null)
    {
        $this->dt_fim = $strDtFim;
        return $this;
    }

}
