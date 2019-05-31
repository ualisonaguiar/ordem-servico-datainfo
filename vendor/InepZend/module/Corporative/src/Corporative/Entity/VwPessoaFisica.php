<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * PessoaFisica
 *
 * @ORM\Table(name="CORP.VW_PESSOA_FISICA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwPessoaFisicaRepository")
 */
class VwPessoaFisica extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_ESTADO_CIVIL", type="integer", nullable=true)
     */
    protected $coEstadoCivil;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_ETNIA", type="integer", nullable=true)
     */
    protected $coEtnia;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_MUNICIPIO_NASCIMENTO", type="integer", nullable=true)
     */
    protected $coMunicipioNascimento;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PAIS_ORIGEM", type="integer", nullable=true)
     */
    protected $coPaisOrigem;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_PESSOA_FISICA", type="bigint", nullable=false)
     */
    protected $coPessoaFisica;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_NASCIMENTO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtNascimento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_GRUPO_SANGUINEO", type="integer", nullable=true)
     */
    protected $idGrupoSanguineo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_FALECEU", type="boolean", nullable=false)
     */
    protected $inFaleceu;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_ESTADO_CIVIL", type="string", length=50, nullable=true)
     */
    protected $noEstadoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_ETNIA", type="string", length=30, nullable=true)
     */
    protected $noEtnia;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_MAE", type="string", length=150, nullable=true)
     */
    protected $noMae;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_MUNICIPIO_NASCIMENTO", type="string", length=150, nullable=true)
     */
    protected $noMunicipioNascimento;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PAI", type="string", length=150, nullable=true)
     */
    protected $noPai;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PAIS_ORIGEM", type="string", length=80, nullable=true)
     */
    protected $noPaisOrigem;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PESSOA_FISICA", type="string", length=150, nullable=true)
     */
    protected $noPessoaFisica;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_UF_NASCIMENTO", type="string", length=50, nullable=true)
     */
    protected $noUfNascimento;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CPF", type="string", length=11, nullable=true)
     */
    protected $nuCpf;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_GRUPO_SANGUINEO", type="string", length=3, nullable=true)
     */
    protected $sgGrupoSanguineo;

    /**
     * @var integer
     *
     * @ORM\Column(name="TP_NACIONALIDADE", type="integer", nullable=true)
     */
    protected $tpNacionalidade;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_SEXO", type="string", length=1, nullable=true)
     */
    protected $tpSexo;


    /**
     * Set coEstadoCivil
     *
     * @param integer $coEstadoCivil
     *
     * @return PessoaFisica
     */
    public function setCoEstadoCivil($coEstadoCivil)
    {
        $this->coEstadoCivil = $coEstadoCivil;
        return $this;
    }

    /**
     * Get coEstadoCivil
     *
     * @return integer
     */
    public function getCoEstadoCivil()
    {
        return $this->coEstadoCivil;
    }

    /**
     * Set coEtnia
     *
     * @param integer $coEtnia
     *
     * @return PessoaFisica
     */
    public function setCoEtnia($coEtnia)
    {
        $this->coEtnia = $coEtnia;
        return $this;
    }

    /**
     * Get coEtnia
     *
     * @return integer
     */
    public function getCoEtnia()
    {
        return $this->coEtnia;
    }

    /**
     * Set coMunicipioNascimento
     *
     * @param integer $coMunicipioNascimento
     *
     * @return PessoaFisica
     */
    public function setCoMunicipioNascimento($coMunicipioNascimento)
    {
        $this->coMunicipioNascimento = $coMunicipioNascimento;
        return $this;
    }

    /**
     * Get coMunicipioNascimento
     *
     * @return integer
     */
    public function getCoMunicipioNascimento()
    {
        return $this->coMunicipioNascimento;
    }

    /**
     * Set coPaisOrigem
     *
     * @param integer $coPaisOrigem
     *
     * @return PessoaFisica
     */
    public function setCoPaisOrigem($coPaisOrigem)
    {
        $this->coPaisOrigem = $coPaisOrigem;
        return $this;
    }

    /**
     * Get coPaisOrigem
     *
     * @return integer
     */
    public function getCoPaisOrigem()
    {
        return $this->coPaisOrigem;
    }

    /**
     * Set coPessoaFisica
     *
     * @param integer $coPessoaFisica
     *
     * @return PessoaFisica
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
     * Set dtNascimento
     *
     * @param \DateTime $dtNascimento
     *
     * @return PessoaFisica
     */
    public function setDtNascimento($dtNascimento)
    {
        $this->dtNascimento = $dtNascimento;
        return $this;
    }

    /**
     * Get dtNascimento
     *
     * @return \DateTime
     */
    public function getDtNascimento()
    {
        return Date::convertDate($this->dtNascimento, "d/m/Y");
    }

    /**
     * Set idGrupoSanguineo
     *
     * @param integer $idGrupoSanguineo
     *
     * @return PessoaFisica
     */
    public function setIdGrupoSanguineo($idGrupoSanguineo)
    {
        $this->idGrupoSanguineo = $idGrupoSanguineo;
        return $this;
    }

    /**
     * Get idGrupoSanguineo
     *
     * @return integer
     */
    public function getIdGrupoSanguineo()
    {
        return $this->idGrupoSanguineo;
    }

    /**
     * Set inFaleceu
     *
     * @param boolean $inFaleceu
     *
     * @return PessoaFisica
     */
    public function setInFaleceu($inFaleceu)
    {
        $this->inFaleceu = $inFaleceu;
        return $this;
    }

    /**
     * Get inFaleceu
     *
     * @return boolean
     */
    public function getInFaleceu()
    {
        return $this->inFaleceu;
    }

    /**
     * Set noEstadoCivil
     *
     * @param string $noEstadoCivil
     *
     * @return PessoaFisica
     */
    public function setNoEstadoCivil($noEstadoCivil)
    {
        $this->noEstadoCivil = $noEstadoCivil;
        return $this;
    }

    /**
     * Get noEstadoCivil
     *
     * @return string
     */
    public function getNoEstadoCivil()
    {
        return $this->noEstadoCivil;
    }

    /**
     * Set noEtnia
     *
     * @param string $noEtnia
     *
     * @return PessoaFisica
     */
    public function setNoEtnia($noEtnia)
    {
        $this->noEtnia = $noEtnia;
        return $this;
    }

    /**
     * Get noEtnia
     *
     * @return string
     */
    public function getNoEtnia()
    {
        return $this->noEtnia;
    }

    /**
     * Set noMae
     *
     * @param string $noMae
     *
     * @return PessoaFisica
     */
    public function setNoMae($noMae)
    {
        $this->noMae = $noMae;
        return $this;
    }

    /**
     * Get noMae
     *
     * @return string
     */
    public function getNoMae()
    {
        return $this->noMae;
    }

    /**
     * Set noMunicipioNascimento
     *
     * @param string $noMunicipioNascimento
     *
     * @return PessoaFisica
     */
    public function setNoMunicipioNascimento($noMunicipioNascimento)
    {
        $this->noMunicipioNascimento = $noMunicipioNascimento;
        return $this;
    }

    /**
     * Get noMunicipioNascimento
     *
     * @return string
     */
    public function getNoMunicipioNascimento()
    {
        return $this->noMunicipioNascimento;
    }

    /**
     * Set noPai
     *
     * @param string $noPai
     *
     * @return PessoaFisica
     */
    public function setNoPai($noPai)
    {
        $this->noPai = $noPai;
        return $this;
    }

    /**
     * Get noPai
     *
     * @return string
     */
    public function getNoPai()
    {
        return $this->noPai;
    }

    /**
     * Set noPaisOrigem
     *
     * @param string $noPaisOrigem
     *
     * @return PessoaFisica
     */
    public function setNoPaisOrigem($noPaisOrigem)
    {
        $this->noPaisOrigem = $noPaisOrigem;
        return $this;
    }

    /**
     * Get noPaisOrigem
     *
     * @return string
     */
    public function getNoPaisOrigem()
    {
        return $this->noPaisOrigem;
    }

    /**
     * Set noPessoaFisica
     *
     * @param string $noPessoaFisica
     *
     * @return PessoaFisica
     */
    public function setNoPessoaFisica($noPessoaFisica)
    {
        $this->noPessoaFisica = $noPessoaFisica;
        return $this;
    }

    /**
     * Get noPessoaFisica
     *
     * @return string
     */
    public function getNoPessoaFisica()
    {
        return $this->noPessoaFisica;
    }

    /**
     * Set noUfNascimento
     *
     * @param string $noUfNascimento
     *
     * @return PessoaFisica
     */
    public function setNoUfNascimento($noUfNascimento)
    {
        $this->noUfNascimento = $noUfNascimento;
        return $this;
    }

    /**
     * Get noUfNascimento
     *
     * @return string
     */
    public function getNoUfNascimento()
    {
        return $this->noUfNascimento;
    }

    /**
     * Set nuCpf
     *
     * @param string $nuCpf
     *
     * @return PessoaFisica
     */
    public function setNuCpf($nuCpf)
    {
        $this->nuCpf = $nuCpf;
        return $this;
    }

    /**
     * Get nuCpf
     *
     * @return string
     */
    public function getNuCpf()
    {
        return $this->nuCpf;
    }

    /**
     * Set sgGrupoSanguineo
     *
     * @param string $sgGrupoSanguineo
     *
     * @return PessoaFisica
     */
    public function setSgGrupoSanguineo($sgGrupoSanguineo)
    {
        $this->sgGrupoSanguineo = $sgGrupoSanguineo;
        return $this;
    }

    /**
     * Get sgGrupoSanguineo
     *
     * @return string
     */
    public function getSgGrupoSanguineo()
    {
        return $this->sgGrupoSanguineo;
    }

    /**
     * Set tpNacionalidade
     *
     * @param integer $tpNacionalidade
     *
     * @return PessoaFisica
     */
    public function setTpNacionalidade($tpNacionalidade)
    {
        $this->tpNacionalidade = $tpNacionalidade;
        return $this;
    }

    /**
     * Get tpNacionalidade
     *
     * @return integer
     */
    public function getTpNacionalidade()
    {
        return $this->tpNacionalidade;
    }

    /**
     * Set tpSexo
     *
     * @param string $tpSexo
     *
     * @return PessoaFisica
     */
    public function setTpSexo($tpSexo)
    {
        $this->tpSexo = $tpSexo;
        return $this;
    }

    /**
     * Get tpSexo
     *
     * @return string
     */
    public function getTpSexo()
    {
        return $this->tpSexo;
    }
}

