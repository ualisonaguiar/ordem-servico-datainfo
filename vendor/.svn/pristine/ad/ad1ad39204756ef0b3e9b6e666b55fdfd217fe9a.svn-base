<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistoricoPfDocumento
 *
 * @ORM\Table(name="CORP.TB_HISTORICO_PF_DOCUMENTO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\HistoricoPfDocumentoRepository")
 */
class HistoricoPfDocumento extends Entity
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
     * @ORM\Column(name="CO_PESSOA_FISICA", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $coPessoaFisica;

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
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtAlteracao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_EMISSAO_CERTIDAO_CIVIL", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtEmissaoCertidaoCivil;

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
     * @ORM\Column(name="ID_CARTORIO", type="integer", nullable=true)
     */
    protected $idCartorio;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=false)
     */
    protected $idUsuarioAlteracao;

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
     * @ORM\Column(name="NU_FOLHA_CERTIDAO_CIVIL", type="string", length=4, nullable=true)
     */
    protected $nuFolhaCertidaoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_LIVRO_CERTIDAO_CIVIL", type="string", length=8, nullable=true)
     */
    protected $nuLivroCertidaoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_MATRICULA_CERTIDAO", type="string", length=33, nullable=true)
     */
    protected $nuMatriculaCertidao;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_NIS", type="string", length=11, nullable=true)
     */
    protected $nuNis;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $nuOperacao;

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
     * @var string
     *
     * @ORM\Column(name="NU_TERMO_CERTIDAO_CIVIL", type="string", length=8, nullable=true)
     */
    protected $nuTermoCertidaoCivil;

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
     * Set coCategoriaCnh
     *
     * @param string $coCategoriaCnh
     *
     * @return HistoricoPfDocumento
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
     * @return HistoricoPfDocumento
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
     * Set coPessoaFisica
     *
     * @param integer $coPessoaFisica
     *
     * @return HistoricoPfDocumento
     */
    public function setCoPessoaFisica($coPessoaFisica)
    {
        $this->coPessoaFisica = $coPessoaFisica;
        return $this;
    }

    /**
     * Get coPessoaFisica
     *
     * @return integer
     */
    public function getCoPessoaFisica()
    {
        return $this->coPessoaFisica;
    }

    /**
     * Set coUfCnh
     *
     * @param integer $coUfCnh
     *
     * @return HistoricoPfDocumento
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
     * @return HistoricoPfDocumento
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
     * @return HistoricoPfDocumento
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
     * @return HistoricoPfDocumento
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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistoricoPfDocumento
     */
    public function setDtAlteracao($dtAlteracao)
    {
        $this->dtAlteracao = $dtAlteracao;
        return $this;
    }

    /**
     * Get dtAlteracao
     *
     * @return \DateTime
     */
    public function getDtAlteracao()
    {
        return Date::convertDate($this->dtAlteracao, "d/m/Y");
    }

    /**
     * Set dtEmissaoCertidaoCivil
     *
     * @param \DateTime $dtEmissaoCertidaoCivil
     *
     * @return HistoricoPfDocumento
     */
    public function setDtEmissaoCertidaoCivil($dtEmissaoCertidaoCivil)
    {
        $this->dtEmissaoCertidaoCivil = $dtEmissaoCertidaoCivil;
        return $this;
    }

    /**
     * Get dtEmissaoCertidaoCivil
     *
     * @return \DateTime
     */
    public function getDtEmissaoCertidaoCivil()
    {
        return Date::convertDate($this->dtEmissaoCertidaoCivil, "d/m/Y");
    }

    /**
     * Set dtEmissaoRg
     *
     * @param \DateTime $dtEmissaoRg
     *
     * @return HistoricoPfDocumento
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
     * @return HistoricoPfDocumento
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
     * Set dtPrimeiraCnh
     *
     * @param \DateTime $dtPrimeiraCnh
     *
     * @return HistoricoPfDocumento
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
     * @return HistoricoPfDocumento
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
     * Set idCartorio
     *
     * @param integer $idCartorio
     *
     * @return HistoricoPfDocumento
     */
    public function setIdCartorio($idCartorio)
    {
        $this->idCartorio = $idCartorio;
        return $this;
    }

    /**
     * Get idCartorio
     *
     * @return integer
     */
    public function getIdCartorio()
    {
        return $this->idCartorio;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistoricoPfDocumento
     */
    public function setIdUsuarioAlteracao($idUsuarioAlteracao)
    {
        $this->idUsuarioAlteracao = $idUsuarioAlteracao;
        return $this;
    }

    /**
     * Get idUsuarioAlteracao
     *
     * @return integer
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->idUsuarioAlteracao;
    }

    /**
     * Set noOrgaoCam
     *
     * @param string $noOrgaoCam
     *
     * @return HistoricoPfDocumento
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
     * @return HistoricoPfDocumento
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
     * @return HistoricoPfDocumento
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
     * @return HistoricoPfDocumento
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
     * Set nuFolhaCertidaoCivil
     *
     * @param string $nuFolhaCertidaoCivil
     *
     * @return HistoricoPfDocumento
     */
    public function setNuFolhaCertidaoCivil($nuFolhaCertidaoCivil)
    {
        $this->nuFolhaCertidaoCivil = $nuFolhaCertidaoCivil;
        return $this;
    }

    /**
     * Get nuFolhaCertidaoCivil
     *
     * @return string
     */
    public function getNuFolhaCertidaoCivil()
    {
        return $this->nuFolhaCertidaoCivil;
    }

    /**
     * Set nuLivroCertidaoCivil
     *
     * @param string $nuLivroCertidaoCivil
     *
     * @return HistoricoPfDocumento
     */
    public function setNuLivroCertidaoCivil($nuLivroCertidaoCivil)
    {
        $this->nuLivroCertidaoCivil = $nuLivroCertidaoCivil;
        return $this;
    }

    /**
     * Get nuLivroCertidaoCivil
     *
     * @return string
     */
    public function getNuLivroCertidaoCivil()
    {
        return $this->nuLivroCertidaoCivil;
    }

    /**
     * Set nuMatriculaCertidao
     *
     * @param string $nuMatriculaCertidao
     *
     * @return HistoricoPfDocumento
     */
    public function setNuMatriculaCertidao($nuMatriculaCertidao)
    {
        $this->nuMatriculaCertidao = $nuMatriculaCertidao;
        return $this;
    }

    /**
     * Get nuMatriculaCertidao
     *
     * @return string
     */
    public function getNuMatriculaCertidao()
    {
        return $this->nuMatriculaCertidao;
    }

    /**
     * Set nuNis
     *
     * @param string $nuNis
     *
     * @return HistoricoPfDocumento
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistoricoPfDocumento
     */
    public function setNuOperacao($nuOperacao)
    {
        $this->nuOperacao = $nuOperacao;
        return $this;
    }

    /**
     * Get nuOperacao
     *
     * @return integer
     */
    public function getNuOperacao()
    {
        return $this->nuOperacao;
    }

    /**
     * Set nuPassaporte
     *
     * @param string $nuPassaporte
     *
     * @return HistoricoPfDocumento
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
     * @return HistoricoPfDocumento
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
     * @return HistoricoPfDocumento
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
     * @return HistoricoPfDocumento
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
     * @return HistoricoPfDocumento
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
     * Set nuTermoCertidaoCivil
     *
     * @param string $nuTermoCertidaoCivil
     *
     * @return HistoricoPfDocumento
     */
    public function setNuTermoCertidaoCivil($nuTermoCertidaoCivil)
    {
        $this->nuTermoCertidaoCivil = $nuTermoCertidaoCivil;
        return $this;
    }

    /**
     * Get nuTermoCertidaoCivil
     *
     * @return string
     */
    public function getNuTermoCertidaoCivil()
    {
        return $this->nuTermoCertidaoCivil;
    }

    /**
     * Set nuTituloEleitoral
     *
     * @param integer $nuTituloEleitoral
     *
     * @return HistoricoPfDocumento
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
     * @return HistoricoPfDocumento
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
}

