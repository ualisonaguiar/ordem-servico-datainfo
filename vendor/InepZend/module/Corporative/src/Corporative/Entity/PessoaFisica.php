<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * PessoaFisica
 *
 * @ORM\Table(name="CORP.TB_PESSOA_FISICA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\PessoaFisicaRepository")
 */
class PessoaFisica extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PESSOA_FISICA", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CORP.SEQ_PESSOA_FISICA", allocationSize=1, initialValue=1)
     */
    protected $coPessoaFisica;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtAlteracao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_NASCIMENTO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtNascimento;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_FALECEU", type="boolean", nullable=false)
     */
    protected $inFaleceu = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="NO_MAE", type="string", length=150, nullable=true)
     */
    protected $noMae;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PAI", type="string", length=150, nullable=true)
     */
    protected $noPai;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PESSOA_FISICA", type="string", length=150, nullable=true)
     */
    protected $noPessoaFisica;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CPF", type="string", length=11, nullable=true)
     */
    protected $nuCpf;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     */
    protected $nuOperacao;

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
     * @var \InepZend\Module\Corporative\Entity\EstadoCivil
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\EstadoCivil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_ESTADO_CIVIL", referencedColumnName="CO_ESTADO_CIVIL")
     * })
     */
    protected $coEstadoCivil;

    /**
     * @var \InepZend\Module\Corporative\Entity\Etnia
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Etnia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_ETNIA", referencedColumnName="CO_ETNIA")
     * })
     */
    protected $coEtnia;

    /**
     * @var \InepZend\Module\Corporative\Entity\Municipio
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Municipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_MUNICIPIO_NASCIMENTO", referencedColumnName="CO_MUNICIPIO")
     * })
     */
    protected $coMunicipioNascimento;

    /**
     * @var \InepZend\Module\Corporative\Entity\Pais
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Pais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_PAIS_ORIGEM", referencedColumnName="CO_PAIS")
     * })
     */
    protected $coPaisOrigem;

    /**
     * @var \InepZend\Module\Corporative\Entity\GrupoSanguineo
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\GrupoSanguineo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_GRUPO_SANGUINEO", referencedColumnName="ID_GRUPO_SANGUINEO")
     * })
     */
    protected $idGrupoSanguineo;

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
     * Get coPessoaFisica
     *
     * @return integer
     */
    public function getCoPessoaFisica()
    {
        return $this->coPessoaFisica;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return PessoaFisica
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return PessoaFisica
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

    /**
     * Set coEstadoCivil
     *
     * @param \InepZend\Module\Corporative\Entity\EstadoCivil $coEstadoCivil
     *
     * @return PessoaFisica
     */
    public function setCoEstadoCivil(\InepZend\Module\Corporative\Entity\EstadoCivil $coEstadoCivil = null)
    {
        $this->coEstadoCivil = $coEstadoCivil;
        return $this;
    }

    /**
     * Get coEstadoCivil
     *
     * @return \InepZend\Module\Corporative\Entity\EstadoCivil
     */
    public function getCoEstadoCivil()
    {
        return $this->coEstadoCivil;
    }

    /**
     * Set coEtnia
     *
     * @param \InepZend\Module\Corporative\Entity\Etnia $coEtnia
     *
     * @return PessoaFisica
     */
    public function setCoEtnia(\InepZend\Module\Corporative\Entity\Etnia $coEtnia = null)
    {
        $this->coEtnia = $coEtnia;
        return $this;
    }

    /**
     * Get coEtnia
     *
     * @return \InepZend\Module\Corporative\Entity\Etnia
     */
    public function getCoEtnia()
    {
        return $this->coEtnia;
    }

    /**
     * Set coMunicipioNascimento
     *
     * @param \InepZend\Module\Corporative\Entity\Municipio $coMunicipioNascimento
     *
     * @return PessoaFisica
     */
    public function setCoMunicipioNascimento(\InepZend\Module\Corporative\Entity\Municipio $coMunicipioNascimento = null)
    {
        $this->coMunicipioNascimento = $coMunicipioNascimento;
        return $this;
    }

    /**
     * Get coMunicipioNascimento
     *
     * @return \InepZend\Module\Corporative\Entity\Municipio
     */
    public function getCoMunicipioNascimento()
    {
        return $this->coMunicipioNascimento;
    }

    /**
     * Set coPaisOrigem
     *
     * @param \InepZend\Module\Corporative\Entity\Pais $coPaisOrigem
     *
     * @return PessoaFisica
     */
    public function setCoPaisOrigem(\InepZend\Module\Corporative\Entity\Pais $coPaisOrigem = null)
    {
        $this->coPaisOrigem = $coPaisOrigem;
        return $this;
    }

    /**
     * Get coPaisOrigem
     *
     * @return \InepZend\Module\Corporative\Entity\Pais
     */
    public function getCoPaisOrigem()
    {
        return $this->coPaisOrigem;
    }

    /**
     * Set idGrupoSanguineo
     *
     * @param \InepZend\Module\Corporative\Entity\GrupoSanguineo $idGrupoSanguineo
     *
     * @return PessoaFisica
     */
    public function setIdGrupoSanguineo(\InepZend\Module\Corporative\Entity\GrupoSanguineo $idGrupoSanguineo = null)
    {
        $this->idGrupoSanguineo = $idGrupoSanguineo;
        return $this;
    }

    /**
     * Get idGrupoSanguineo
     *
     * @return \InepZend\Module\Corporative\Entity\GrupoSanguineo
     */
    public function getIdGrupoSanguineo()
    {
        return $this->idGrupoSanguineo;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param \InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao
     *
     * @return PessoaFisica
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

