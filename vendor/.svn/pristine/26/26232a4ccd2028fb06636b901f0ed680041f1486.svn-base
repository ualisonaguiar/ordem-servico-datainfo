<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * PessoaFisicaDocumento
 *
 * @ORM\Table(name="CORP.TB_PESSOA_FISICA_DOCUMENTO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\PessoaFisicaDocumentoRepository")
 */
class PessoaFisicaDocumento extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="CO_CATEGORIA_CNH", type="string", length=5, nullable=true)
     */
    protected $coCategoriaCnh;

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
     * @var \InepZend\Module\Corporative\Entity\Cartorio
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Cartorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_CARTORIO", referencedColumnName="ID_CARTORIO")
     * })
     */
    protected $idCartorio;

    /**
     * @var \InepZend\Module\Corporative\Entity\OrgaoEmissor
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\OrgaoEmissor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_ORGAO_EMISSOR", referencedColumnName="CO_ORGAO_EMISSOR")
     * })
     */
    protected $coOrgaoEmissor;

    /**
     * @var \InepZend\Module\Corporative\Entity\PessoaFisica
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="InepZend\Module\Corporative\Entity\PessoaFisica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_PESSOA_FISICA", referencedColumnName="CO_PESSOA_FISICA")
     * })
     */
    protected $coPessoaFisica;

    /**
     * @var \InepZend\Module\Corporative\Entity\Uf
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Uf")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_UF_CNH", referencedColumnName="CO_UF")
     * })
     */
    protected $coUfCnh;

    /**
     * @var \InepZend\Module\Corporative\Entity\Uf
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Uf")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_UF_CTPS", referencedColumnName="CO_UF")
     * })
     */
    protected $coUfCtps;

    /**
     * @var \InepZend\Module\Corporative\Entity\Uf
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Uf")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_UF_RG", referencedColumnName="CO_UF")
     * })
     */
    protected $coUfRg;

    /**
     * @var \InepZend\Module\Corporative\Entity\Uf
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Uf")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_UF_TITULO", referencedColumnName="CO_UF")
     * })
     */
    protected $coUfTitulo;

    /**
     * @var \InepZend\Module\Corporative\Entity\UsuarioSistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\UsuarioSistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_USUARIO_ALTERACAO", referencedColumnName="CO_USUARIO_SISTEMA")
     * })
     */
    protected $idUsuarioAlteracao;


    /**
     * Set coCategoriaCnh
     *
     * @param string $coCategoriaCnh
     *
     * @return PessoaFisicaDocumento
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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * Set noOrgaoCam
     *
     * @param string $noOrgaoCam
     *
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * @return PessoaFisicaDocumento
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
     * Set idCartorio
     *
     * @param \InepZend\Module\Corporative\Entity\Cartorio $idCartorio
     *
     * @return PessoaFisicaDocumento
     */
    public function setIdCartorio(\InepZend\Module\Corporative\Entity\Cartorio $idCartorio = null)
    {
        $this->idCartorio = $idCartorio;
        return $this;
    }

    /**
     * Get idCartorio
     *
     * @return \InepZend\Module\Corporative\Entity\Cartorio 
     */
    public function getIdCartorio()
    {
        return $this->idCartorio;
    }

    /**
     * Set coOrgaoEmissor
     *
     * @param \InepZend\Module\Corporative\Entity\OrgaoEmissor $coOrgaoEmissor
     *
     * @return PessoaFisicaDocumento
     */
    public function setCoOrgaoEmissor(\InepZend\Module\Corporative\Entity\OrgaoEmissor $coOrgaoEmissor = null)
    {
        $this->coOrgaoEmissor = $coOrgaoEmissor;
        return $this;
    }

    /**
     * Get coOrgaoEmissor
     *
     * @return \InepZend\Module\Corporative\Entity\OrgaoEmissor 
     */
    public function getCoOrgaoEmissor()
    {
        return $this->coOrgaoEmissor;
    }

    /**
     * Set coPessoaFisica
     *
     * @param \InepZend\Module\Corporative\Entity\PessoaFisica $coPessoaFisica
     *
     * @return PessoaFisicaDocumento
     */
    public function setCoPessoaFisica(\InepZend\Module\Corporative\Entity\PessoaFisica $coPessoaFisica)
    {
        $this->coPessoaFisica = $coPessoaFisica;
        return $this;
    }

    /**
     * Get coPessoaFisica
     *
     * @return \InepZend\Module\Corporative\Entity\PessoaFisica 
     */
    public function getCoPessoaFisica()
    {
        return $this->coPessoaFisica;
    }

    /**
     * Set coUfCnh
     *
     * @param \InepZend\Module\Corporative\Entity\Uf $coUfCnh
     *
     * @return PessoaFisicaDocumento
     */
    public function setCoUfCnh(\InepZend\Module\Corporative\Entity\Uf $coUfCnh = null)
    {
        $this->coUfCnh = $coUfCnh;
        return $this;
    }

    /**
     * Get coUfCnh
     *
     * @return \InepZend\Module\Corporative\Entity\Uf 
     */
    public function getCoUfCnh()
    {
        return $this->coUfCnh;
    }

    /**
     * Set coUfCtps
     *
     * @param \InepZend\Module\Corporative\Entity\Uf $coUfCtps
     *
     * @return PessoaFisicaDocumento
     */
    public function setCoUfCtps(\InepZend\Module\Corporative\Entity\Uf $coUfCtps = null)
    {
        $this->coUfCtps = $coUfCtps;
        return $this;
    }

    /**
     * Get coUfCtps
     *
     * @return \InepZend\Module\Corporative\Entity\Uf 
     */
    public function getCoUfCtps()
    {
        return $this->coUfCtps;
    }

    /**
     * Set coUfRg
     *
     * @param \InepZend\Module\Corporative\Entity\Uf $coUfRg
     *
     * @return PessoaFisicaDocumento
     */
    public function setCoUfRg(\InepZend\Module\Corporative\Entity\Uf $coUfRg = null)
    {
        $this->coUfRg = $coUfRg;
        return $this;
    }

    /**
     * Get coUfRg
     *
     * @return \InepZend\Module\Corporative\Entity\Uf 
     */
    public function getCoUfRg()
    {
        return $this->coUfRg;
    }

    /**
     * Set coUfTitulo
     *
     * @param \InepZend\Module\Corporative\Entity\Uf $coUfTitulo
     *
     * @return PessoaFisicaDocumento
     */
    public function setCoUfTitulo(\InepZend\Module\Corporative\Entity\Uf $coUfTitulo = null)
    {
        $this->coUfTitulo = $coUfTitulo;
        return $this;
    }

    /**
     * Get coUfTitulo
     *
     * @return \InepZend\Module\Corporative\Entity\Uf 
     */
    public function getCoUfTitulo()
    {
        return $this->coUfTitulo;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param \InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao
     *
     * @return PessoaFisicaDocumento
     */
    public function setIdUsuarioAlteracao(\InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao = null)
    {
        $this->idUsuarioAlteracao = $idUsuarioAlteracao;
        return $this;
    }

    /**
     * Get idUsuarioAlteracao
     *
     * @return \InepZend\Module\Corporative\Entity\UsuarioSistema 
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->idUsuarioAlteracao;
    }
}

