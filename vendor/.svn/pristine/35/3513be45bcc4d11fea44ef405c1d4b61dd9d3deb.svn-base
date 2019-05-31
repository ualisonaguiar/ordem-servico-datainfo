<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistoricoPessoaFisica
 *
 * @ORM\Table(name="CORP.TB_HISTORICO_PESSOA_FISICA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\HistoricoPessoaFisicaRepository")
 */
class HistoricoPessoaFisica extends Entity
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
     * @ORM\Column(name="CO_PESSOA_FISICA", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
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
     * @ORM\Column(name="DT_NASCIMENTO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtNascimento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_GRUPO_SANGUINEO", type="integer", nullable=true)
     */
    protected $idGrupoSanguineo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=false)
     */
    protected $idUsuarioAlteracao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_FALECEU", type="boolean", nullable=false)
     */
    protected $inFaleceu = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="NO_MAE", type="string", length=150, nullable=false)
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
     * @ORM\Column(name="NO_PESSOA_FISICA", type="string", length=150, nullable=false)
     */
    protected $noPessoaFisica;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CPF", type="string", length=11, nullable=false)
     */
    protected $nuCpf;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
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
     * @ORM\Column(name="TP_SEXO", type="string", length=1, nullable=false)
     */
    protected $tpSexo;


    /**
     * Set coEstadoCivil
     *
     * @param integer $coEstadoCivil
     *
     * @return HistoricoPessoaFisica
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
     * @return HistoricoPessoaFisica
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
     * @return HistoricoPessoaFisica
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
     * @return HistoricoPessoaFisica
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
     * @return HistoricoPessoaFisica
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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistoricoPessoaFisica
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
     * @return HistoricoPessoaFisica
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
     * @return HistoricoPessoaFisica
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
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistoricoPessoaFisica
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
     * Set inFaleceu
     *
     * @param boolean $inFaleceu
     *
     * @return HistoricoPessoaFisica
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
     * @return HistoricoPessoaFisica
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
     * @return HistoricoPessoaFisica
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
     * @return HistoricoPessoaFisica
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
     * @return HistoricoPessoaFisica
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
     * @return HistoricoPessoaFisica
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
     * @return HistoricoPessoaFisica
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
     * @return HistoricoPessoaFisica
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

