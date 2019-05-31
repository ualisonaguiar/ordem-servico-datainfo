<?php

namespace InepZend\Module\TrocaArquivo\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;
use InepZend\Util\Debug;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\TrocaArquivo\Common\Entity\ErroRepository")
 * @ORM\Table(name="tb_erro")
 */
class Erro extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     * @@__toString
     */
    protected $id_erro;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_arquivo;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $no_classe;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(70)")
     * @var string
     */
    protected $no_metodo;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $nu_linha;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(4000)")
     * @var string
     */
    protected $ds_param;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(20)")
     * @var string
     */
    protected $no_status;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(4000)")
     * @var string
     */
    protected $ds_mensagem;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(4000)")
     * @var string
     */
    protected $ds_resultado;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_ocorrencia;

    public function getIdErro()
    {
        return $this->id_erro;
    }

    public function setIdErro($intIdErro = null)
    {
        $this->id_erro = (is_numeric($intIdErro)) ? (integer) $intIdErro : $intIdErro;
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

    public function getNoClasse()
    {
        return $this->no_classe;
    }

    public function setNoClasse($strNoClasse = null)
    {
        $this->no_classe = $strNoClasse;
        return $this;
    }

    public function getNoMetodo()
    {
        return $this->no_metodo;
    }

    public function setNoMetodo($strNoMetodo = null)
    {
        $this->no_metodo = $strNoMetodo;
        return $this;
    }

    public function getNuLinha()
    {
        return $this->nu_linha;
    }

    public function setNuLinha($intNuLinha = null)
    {
        $this->nu_linha = (is_numeric($intNuLinha)) ? (integer) $intNuLinha : $intNuLinha;
        return $this;
    }

    public function getDsParam()
    {
        return $this->ds_param;
    }

    public function setDsParam($strDsParam = null)
    {
        $this->ds_param = $strDsParam;
        return $this;
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
        if ($strNoStatus == 'ok')
            $strStyle = 'font-weight: bold; color: green;';
        if (in_array($strNoStatus, array('error', 'fail', 'validate')))
            $strStyle = 'font-weight: bold; color: red;';
        if (!empty($strStyle))
            $strNoStatus = '<font style="' . $strStyle . '">' . $strNoStatus . '</font>';
        return $strNoStatus;
    }

    public function getDsMensagem()
    {
        return $this->ds_mensagem;
    }

    public function setDsMensagem($strDsMensagem = null)
    {
        $this->ds_mensagem = $strDsMensagem;
        return $this;
    }

    public function getDsResultado()
    {
        return $this->ds_resultado;
    }

    public function setDsResultado($strDsResultado = null)
    {
        $this->ds_resultado = $strDsResultado;
        return $this;
    }

    public function getDsResultadoHtml($strStyle = null)
    {
        $strNoStatus = $this->getNoStatusHtml();
        if (!empty($strNoStatus))
            $strNoStatus = '<div style="padding: 5px;"><strong>Status:</strong> ' . $strNoStatus . '</div>';
        $strRootpath = 'file:///' . reset(explode('/vendor/', str_replace(array('\\', ' '), array('/', '%20'), __DIR__))) . '/';
        return '<div>' . $strNoStatus . '<pre style="' . $strStyle .'">' . str_replace($strRootpath, '', Debug::varDumpExport($this->getDsResultado(), false)) . '</pre></div>';
    }

    public function getDtOcorrencia()
    {
        return Date::convertDate($this->dt_ocorrencia, 'd/m/Y H:i:s');
    }

    public function setDtOcorrencia($strDtOcorrencia = null)
    {
        $this->dt_ocorrencia = $strDtOcorrencia;
        return $this;
    }

}
