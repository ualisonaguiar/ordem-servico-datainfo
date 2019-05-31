<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * DocumentoPessoaFisicaLog
 *
 * @ORM\Table(name="CORP.TC_DOCUMENTO_PESSOA_FISICA_LOG")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\DocumentoPessoaFisicaLogRepository")
 */
class DocumentoPessoaFisicaLog extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="CO_CATEGORIA_CNH", type="string", length=5, nullable=true)
     */
    protected $coCategoriaCnh;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_ORGAO_EMISSOR", type="integer", nullable=true)
     */
    protected $coOrgaoEmissor;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_UF_CNH", type="integer", nullable=true)
     */
    protected $coUfCnh;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_UF_CTPS", type="integer", nullable=true)
     */
    protected $coUfCtps;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_UF_RG", type="integer", nullable=true)
     */
    protected $coUfRg;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_UF_TITULO", type="integer", nullable=true)
     */
    protected $coUfTitulo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_EMISSAO_RG", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtEmissaoRg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_EXPEDICAO_CNH", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtExpedicaoCnh;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_OPERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtOperacao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_PRIMEIRA_CNH", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtPrimeiraCnh;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_VALIDADE_CNH", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtValidadeCnh;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_FISICA", type="integer", nullable=false)
     * @ORM\Id
     */
    protected $idPessoaFisica;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_SISTEMA_OPERACAO", type="integer", nullable=true)
     */
    protected $idUsuarioSistemaOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_ORGAO_CAM", type="string", length=50, nullable=true)
     */
    protected $noOrgaoCam;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CAM", type="string", length=20, nullable=true)
     */
    protected $nuCam;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CNH", type="string", length=11, nullable=true)
     */
    protected $nuCnh;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CTPS", type="string", length=10, nullable=true)
     */
    protected $nuCtps;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_NIS", type="string", length=11, nullable=true)
     */
    protected $nuNis;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_PASSAPORTE", type="string", length=10, nullable=true)
     */
    protected $nuPassaporte;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_RG", type="string", length=20, nullable=true)
     */
    protected $nuRg;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_SECAO_TITULO", type="string", length=3, nullable=true)
     */
    protected $nuSecaoTitulo;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_SERIE_CAM", type="string", length=10, nullable=true)
     */
    protected $nuSerieCam;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_SERIE_CTPS", type="integer", nullable=true)
     */
    protected $nuSerieCtps;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_TITULO_ELEITORAL", type="integer", nullable=true)
     */
    protected $nuTituloEleitoral;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_ZONA_TITULO", type="string", length=3, nullable=true)
     */
    protected $nuZonaTitulo;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_USUARIO_BD", type="string", length=30, nullable=true)
     */
    protected $sgUsuarioBd;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_OPERACAO", type="string", length=1, nullable=false)
     */
    protected $tpOperacao;


    /**
     * Set coCategoriaCnh
     *
     * @param string $coCategoriaCnh
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setCoCategoriaCnh($coCategoriaCnh)
    {
        $this->coCategoriaCnh = $coCategoriaCnh;
        return $this;
    }

    /**
     * Get coCategoriaCnh
     *
     * @return string 
     */
    public function getCoCategoriaCnh()
    {
        return $this->coCategoriaCnh;
    }

    /**
     * Set coOrgaoEmissor
     *
     * @param integer $coOrgaoEmissor
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setCoOrgaoEmissor($coOrgaoEmissor)
    {
        $this->coOrgaoEmissor = $coOrgaoEmissor;
        return $this;
    }

    /**
     * Get coOrgaoEmissor
     *
     * @return integer 
     */
    public function getCoOrgaoEmissor()
    {
        return $this->coOrgaoEmissor;
    }

    /**
     * Set coUfCnh
     *
     * @param integer $coUfCnh
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setCoUfCnh($coUfCnh)
    {
        $this->coUfCnh = $coUfCnh;
        return $this;
    }

    /**
     * Get coUfCnh
     *
     * @return integer 
     */
    public function getCoUfCnh()
    {
        return $this->coUfCnh;
    }

    /**
     * Set coUfCtps
     *
     * @param integer $coUfCtps
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setCoUfCtps($coUfCtps)
    {
        $this->coUfCtps = $coUfCtps;
        return $this;
    }

    /**
     * Get coUfCtps
     *
     * @return integer 
     */
    public function getCoUfCtps()
    {
        return $this->coUfCtps;
    }

    /**
     * Set coUfRg
     *
     * @param integer $coUfRg
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setCoUfRg($coUfRg)
    {
        $this->coUfRg = $coUfRg;
        return $this;
    }

    /**
     * Get coUfRg
     *
     * @return integer 
     */
    public function getCoUfRg()
    {
        return $this->coUfRg;
    }

    /**
     * Set coUfTitulo
     *
     * @param integer $coUfTitulo
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setCoUfTitulo($coUfTitulo)
    {
        $this->coUfTitulo = $coUfTitulo;
        return $this;
    }

    /**
     * Get coUfTitulo
     *
     * @return integer 
     */
    public function getCoUfTitulo()
    {
        return $this->coUfTitulo;
    }

    /**
     * Set dtEmissaoRg
     *
     * @param \DateTime $dtEmissaoRg
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setDtEmissaoRg($dtEmissaoRg)
    {
        $this->dtEmissaoRg = $dtEmissaoRg;
        return $this;
    }

    /**
     * Get dtEmissaoRg
     *
     * @return \DateTime 
     */
    public function getDtEmissaoRg()
    {
        return Date::convertDate($this->dtEmissaoRg, "d/m/Y");
    }

    /**
     * Set dtExpedicaoCnh
     *
     * @param \DateTime $dtExpedicaoCnh
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setDtExpedicaoCnh($dtExpedicaoCnh)
    {
        $this->dtExpedicaoCnh = $dtExpedicaoCnh;
        return $this;
    }

    /**
     * Get dtExpedicaoCnh
     *
     * @return \DateTime 
     */
    public function getDtExpedicaoCnh()
    {
        return Date::convertDate($this->dtExpedicaoCnh, "d/m/Y");
    }

    /**
     * Set dtOperacao
     *
     * @param \DateTime $dtOperacao
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setDtOperacao($dtOperacao)
    {
        $this->dtOperacao = $dtOperacao;
        return $this;
    }

    /**
     * Get dtOperacao
     *
     * @return \DateTime 
     */
    public function getDtOperacao()
    {
        return Date::convertDate($this->dtOperacao, "d/m/Y");
    }

    /**
     * Set dtPrimeiraCnh
     *
     * @param \DateTime $dtPrimeiraCnh
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setDtPrimeiraCnh($dtPrimeiraCnh)
    {
        $this->dtPrimeiraCnh = $dtPrimeiraCnh;
        return $this;
    }

    /**
     * Get dtPrimeiraCnh
     *
     * @return \DateTime 
     */
    public function getDtPrimeiraCnh()
    {
        return Date::convertDate($this->dtPrimeiraCnh, "d/m/Y");
    }

    /**
     * Set dtValidadeCnh
     *
     * @param \DateTime $dtValidadeCnh
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setDtValidadeCnh($dtValidadeCnh)
    {
        $this->dtValidadeCnh = $dtValidadeCnh;
        return $this;
    }

    /**
     * Get dtValidadeCnh
     *
     * @return \DateTime 
     */
    public function getDtValidadeCnh()
    {
        return Date::convertDate($this->dtValidadeCnh, "d/m/Y");
    }

    /**
     * Set idPessoaFisica
     *
     * @param integer $idPessoaFisica
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setIdPessoaFisica($idPessoaFisica)
    {
        $this->idPessoaFisica = $idPessoaFisica;
        return $this;
    }

    /**
     * Get idPessoaFisica
     *
     * @return integer 
     */
    public function getIdPessoaFisica()
    {
        return $this->idPessoaFisica;
    }

    /**
     * Set idUsuarioSistemaOperacao
     *
     * @param integer $idUsuarioSistemaOperacao
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setIdUsuarioSistemaOperacao($idUsuarioSistemaOperacao)
    {
        $this->idUsuarioSistemaOperacao = $idUsuarioSistemaOperacao;
        return $this;
    }

    /**
     * Get idUsuarioSistemaOperacao
     *
     * @return integer 
     */
    public function getIdUsuarioSistemaOperacao()
    {
        return $this->idUsuarioSistemaOperacao;
    }

    /**
     * Set noOrgaoCam
     *
     * @param string $noOrgaoCam
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setNoOrgaoCam($noOrgaoCam)
    {
        $this->noOrgaoCam = $noOrgaoCam;
        return $this;
    }

    /**
     * Get noOrgaoCam
     *
     * @return string 
     */
    public function getNoOrgaoCam()
    {
        return $this->noOrgaoCam;
    }

    /**
     * Set nuCam
     *
     * @param string $nuCam
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setNuCam($nuCam)
    {
        $this->nuCam = $nuCam;
        return $this;
    }

    /**
     * Get nuCam
     *
     * @return string 
     */
    public function getNuCam()
    {
        return $this->nuCam;
    }

    /**
     * Set nuCnh
     *
     * @param string $nuCnh
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setNuCnh($nuCnh)
    {
        $this->nuCnh = $nuCnh;
        return $this;
    }

    /**
     * Get nuCnh
     *
     * @return string 
     */
    public function getNuCnh()
    {
        return $this->nuCnh;
    }

    /**
     * Set nuCtps
     *
     * @param string $nuCtps
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setNuCtps($nuCtps)
    {
        $this->nuCtps = $nuCtps;
        return $this;
    }

    /**
     * Get nuCtps
     *
     * @return string 
     */
    public function getNuCtps()
    {
        return $this->nuCtps;
    }

    /**
     * Set nuNis
     *
     * @param string $nuNis
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setNuNis($nuNis)
    {
        $this->nuNis = $nuNis;
        return $this;
    }

    /**
     * Get nuNis
     *
     * @return string 
     */
    public function getNuNis()
    {
        return $this->nuNis;
    }

    /**
     * Set nuPassaporte
     *
     * @param string $nuPassaporte
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setNuPassaporte($nuPassaporte)
    {
        $this->nuPassaporte = $nuPassaporte;
        return $this;
    }

    /**
     * Get nuPassaporte
     *
     * @return string 
     */
    public function getNuPassaporte()
    {
        return $this->nuPassaporte;
    }

    /**
     * Set nuRg
     *
     * @param string $nuRg
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setNuRg($nuRg)
    {
        $this->nuRg = $nuRg;
        return $this;
    }

    /**
     * Get nuRg
     *
     * @return string 
     */
    public function getNuRg()
    {
        return $this->nuRg;
    }

    /**
     * Set nuSecaoTitulo
     *
     * @param string $nuSecaoTitulo
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setNuSecaoTitulo($nuSecaoTitulo)
    {
        $this->nuSecaoTitulo = $nuSecaoTitulo;
        return $this;
    }

    /**
     * Get nuSecaoTitulo
     *
     * @return string 
     */
    public function getNuSecaoTitulo()
    {
        return $this->nuSecaoTitulo;
    }

    /**
     * Set nuSerieCam
     *
     * @param string $nuSerieCam
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setNuSerieCam($nuSerieCam)
    {
        $this->nuSerieCam = $nuSerieCam;
        return $this;
    }

    /**
     * Get nuSerieCam
     *
     * @return string 
     */
    public function getNuSerieCam()
    {
        return $this->nuSerieCam;
    }

    /**
     * Set nuSerieCtps
     *
     * @param integer $nuSerieCtps
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setNuSerieCtps($nuSerieCtps)
    {
        $this->nuSerieCtps = $nuSerieCtps;
        return $this;
    }

    /**
     * Get nuSerieCtps
     *
     * @return integer 
     */
    public function getNuSerieCtps()
    {
        return $this->nuSerieCtps;
    }

    /**
     * Set nuTituloEleitoral
     *
     * @param integer $nuTituloEleitoral
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setNuTituloEleitoral($nuTituloEleitoral)
    {
        $this->nuTituloEleitoral = $nuTituloEleitoral;
        return $this;
    }

    /**
     * Get nuTituloEleitoral
     *
     * @return integer 
     */
    public function getNuTituloEleitoral()
    {
        return $this->nuTituloEleitoral;
    }

    /**
     * Set nuZonaTitulo
     *
     * @param string $nuZonaTitulo
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setNuZonaTitulo($nuZonaTitulo)
    {
        $this->nuZonaTitulo = $nuZonaTitulo;
        return $this;
    }

    /**
     * Get nuZonaTitulo
     *
     * @return string 
     */
    public function getNuZonaTitulo()
    {
        return $this->nuZonaTitulo;
    }

    /**
     * Set sgUsuarioBd
     *
     * @param string $sgUsuarioBd
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setSgUsuarioBd($sgUsuarioBd)
    {
        $this->sgUsuarioBd = $sgUsuarioBd;
        return $this;
    }

    /**
     * Get sgUsuarioBd
     *
     * @return string 
     */
    public function getSgUsuarioBd()
    {
        return $this->sgUsuarioBd;
    }

    /**
     * Set tpOperacao
     *
     * @param string $tpOperacao
     *
     * @return DocumentoPessoaFisicaLog
     */
    public function setTpOperacao($tpOperacao)
    {
        $this->tpOperacao = $tpOperacao;
        return $this;
    }

    /**
     * Get tpOperacao
     *
     * @return string 
     */
    public function getTpOperacao()
    {
        return $this->tpOperacao;
    }
}

