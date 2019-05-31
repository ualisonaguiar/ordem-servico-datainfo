<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * DocumentoPessoaFisica
 *
 * @ORM\Table(name="CORP.TC_DOCUMENTO_PESSOA_FISICA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\DocumentoPessoaFisicaRepository")
 */
class DocumentoPessoaFisica extends Entity
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
     * @var integer
     *
     * @ORM\Column(name="NU_REG_CONSELHO_PROFISSIONAL", type="integer", nullable=true)
     */
    protected $nuRegConselhoProfissional;

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
     * @var \InepZend\Module\Corporative\Entity\ConselhoProfissional
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\ConselhoProfissional")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_CONSELHO_PROFISSIONAL", referencedColumnName="ID_CONSELHO_PROFISSIONAL")
     * })
     */
    protected $idConselhoProfissional;

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
     *   @ORM\JoinColumn(name="ID_PESSOA_FISICA", referencedColumnName="ID_PESSOA_FISICA")
     * })
     */
    protected $idPessoaFisica;

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
     *   @ORM\JoinColumn(name="CO_UF_REG_CONSELHO_PROFISS", referencedColumnName="CO_UF")
     * })
     */
    protected $coUfRegConselhoProfiss;

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
     * Set coCategoriaCnh
     *
     * @param string $coCategoriaCnh
     *
     * @return DocumentoPessoaFisica
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
     * Set dtEmissaoRg
     *
     * @param \DateTime $dtEmissaoRg
     *
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * Set nuRegConselhoProfissional
     *
     * @param integer $nuRegConselhoProfissional
     *
     * @return DocumentoPessoaFisica
     */
    public function setNuRegConselhoProfissional($nuRegConselhoProfissional)
    {
        $this->nuRegConselhoProfissional = $nuRegConselhoProfissional;
        return $this;
    }

    /**
     * Get nuRegConselhoProfissional
     *
     * @return integer 
     */
    public function getNuRegConselhoProfissional()
    {
        return $this->nuRegConselhoProfissional;
    }

    /**
     * Set nuRg
     *
     * @param string $nuRg
     *
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * Set idConselhoProfissional
     *
     * @param \InepZend\Module\Corporative\Entity\ConselhoProfissional $idConselhoProfissional
     *
     * @return DocumentoPessoaFisica
     */
    public function setIdConselhoProfissional(\InepZend\Module\Corporative\Entity\ConselhoProfissional $idConselhoProfissional = null)
    {
        $this->idConselhoProfissional = $idConselhoProfissional;
        return $this;
    }

    /**
     * Get idConselhoProfissional
     *
     * @return \InepZend\Module\Corporative\Entity\ConselhoProfissional 
     */
    public function getIdConselhoProfissional()
    {
        return $this->idConselhoProfissional;
    }

    /**
     * Set coOrgaoEmissor
     *
     * @param \InepZend\Module\Corporative\Entity\OrgaoEmissor $coOrgaoEmissor
     *
     * @return DocumentoPessoaFisica
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
     * Set idPessoaFisica
     *
     * @param \InepZend\Module\Corporative\Entity\PessoaFisica $idPessoaFisica
     *
     * @return DocumentoPessoaFisica
     */
    public function setIdPessoaFisica(\InepZend\Module\Corporative\Entity\PessoaFisica $idPessoaFisica)
    {
        $this->idPessoaFisica = $idPessoaFisica;
        return $this;
    }

    /**
     * Get idPessoaFisica
     *
     * @return \InepZend\Module\Corporative\Entity\PessoaFisica 
     */
    public function getIdPessoaFisica()
    {
        return $this->idPessoaFisica;
    }

    /**
     * Set coUfCnh
     *
     * @param \InepZend\Module\Corporative\Entity\Uf $coUfCnh
     *
     * @return DocumentoPessoaFisica
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
     * Set coUfRegConselhoProfiss
     *
     * @param \InepZend\Module\Corporative\Entity\Uf $coUfRegConselhoProfiss
     *
     * @return DocumentoPessoaFisica
     */
    public function setCoUfRegConselhoProfiss(\InepZend\Module\Corporative\Entity\Uf $coUfRegConselhoProfiss = null)
    {
        $this->coUfRegConselhoProfiss = $coUfRegConselhoProfiss;
        return $this;
    }

    /**
     * Get coUfRegConselhoProfiss
     *
     * @return \InepZend\Module\Corporative\Entity\Uf 
     */
    public function getCoUfRegConselhoProfiss()
    {
        return $this->coUfRegConselhoProfiss;
    }

    /**
     * Set coUfCtps
     *
     * @param \InepZend\Module\Corporative\Entity\Uf $coUfCtps
     *
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
     * @return DocumentoPessoaFisica
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
}

