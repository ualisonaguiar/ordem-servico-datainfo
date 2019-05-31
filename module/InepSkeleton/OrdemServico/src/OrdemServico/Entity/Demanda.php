<?php

namespace OrdemServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;
use InepZend\Util\String;

/**
 * @ORM\Entity(repositoryClass="OrdemServico\Entity\DemandaRepository")
 * @ORM\Table(name="tb_demanda")
 */
class Demanda extends Entity
{
    const NOME_SISTEMA = 'INEPSKELETON';
    const SITUACAO_ATIVO = 1;
    const SITUACAO_INATIVO = 2;
    const SITUACAO_VINCULADA = 3;
    const SITUACAO_DEMANDA_VINCULADA = 'Demanda Vínculada';

    static $arrSituacao = array(
        self::SITUACAO_ATIVO => 'Demanda sem vínculo',
        self::SITUACAO_VINCULADA => self::SITUACAO_DEMANDA_VINCULADA
    );

    static $arrGrauDemanda = array(
        'B' => 'B',
        'M' => 'M',
        'A' => 'A'
    );

    static $arrGrauCriticidade = array(
        'N' => 'NORMAL',
        'C' => 'CRITICO',
    );

    static $arrTypeFatorConhecimento = array(
        'D' => 'D',
        'PD' => 'PD',
        'I' => 'I',
    );

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_demanda;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_abertura;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(500)")
     * @var string
     * @@__toString
     */
    protected $no_demanda;

    /**
     * @ORM\Column(type="string", columnDefinition="TEXT")
     * @var string
     */
    protected $ds_descricao;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $no_projeto;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $ds_ambiente;

    /**
     * @ORM\Column(type="string", columnDefinition="TEXT")
     * @var string
     */
    protected $ds_solucao;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_atividade;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_demanda_superior;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $no_executor;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $tp_situacao;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_usuario_alteracao;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_usuario;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_alteracao;

    public function getIdDemanda()
    {
        return $this->id_demanda;
    }

    public function setIdDemanda($intIdDemanda = null)
    {
        $this->id_demanda = $intIdDemanda;
        return $this;
    }

    public function getDtAbertura()
    {
        return Date::convertDate($this->dt_abertura, 'd/m/Y');
    }

    public function setDtAbertura($strDtAbertura = null)
    {
        $strDtAbertura = str_replace([',', '.'], '', $strDtAbertura);
        $data = new \DateTime($strDtAbertura);
        $this->dt_abertura = $data->format('Y-m-d');
        return $this;
    }

    public function getNoDemanda()
    {
        return $this->no_demanda;
    }

    public function setNoDemanda($strNoDemanda = null)
    {
        $this->no_demanda = $strNoDemanda;
        return $this;
    }

    public function getDsDescricao()
    {
        return $this->ds_descricao;
    }

    public function setDsDescricao($strDsDescricao = null)
    {
        $this->ds_descricao = $strDsDescricao;
        return $this;
    }

    public function getDsSolucao()
    {
        return $this->ds_solucao;
    }

    public function setDsSolucao($strDsSolucao = null)
    {
        $this->ds_solucao = $strDsSolucao;
        return $this;
    }

    public function getIdAtividade()
    {
        return $this->id_atividade;
    }

    public function setIdAtividade($intIdAtividade = null)
    {
        $this->id_atividade = $intIdAtividade;
        return $this;
    }


    public function getIdDemandaSuperior()
    {
        return $this->id_demanda_superior;
    }

    public function setIdDemandaSuperior($intIdDemandaSuperior = null)
    {
        $this->id_demanda_superior = $intIdDemandaSuperior;
        return $this;
    }

    public function getNoExecutor()
    {
        return String::beautifulProperName($this->no_executor);
    }

    public function setNoExecutor($strNoExecutor = null)
    {
        $this->no_executor = $strNoExecutor;
        return $this;
    }

    public function getTpSituacao()
    {
        return $this->tp_situacao;
    }

    public function setTpSituacao($intTpSituacao = null)
    {
        $this->tp_situacao = $intTpSituacao;
        return $this;
    }

    public function getNoProjeto()
    {
        return $this->no_projeto;
    }

    public function setNoProjeto($strNoProjeto = null)
    {
        $this->no_projeto = $strNoProjeto;
        return $this;
    }

    public function getDsAmbiente()
    {
        return $this->ds_ambiente;
    }

    public function setDsAmbiente($strDsAmbiente = null)
    {
        $this->ds_ambiente = $strDsAmbiente;
        return $this;
    }

    public function getSituacao()
    {
        return self::$arrSituacao[$this->getTpSituacao()];
    }

    /**
     * @return int
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->id_usuario_alteracao;
    }

    /**
     * @param int $id_usuario_alteracao
     * @return DemandaServico
     */
    public function setIdUsuarioAlteracao($id_usuario_alteracao)
    {
        $this->id_usuario_alteracao = $id_usuario_alteracao;
        return $this;
    }

    /**
     * @return string
     */
    public function getDtAlteracao()
    {
        return Date::convertDate($this->dt_alteracao, 'd/m/Y H:i:s');
    }

    /**
     * @param string $dt_alteracao
     * @return DemandaServico
     */
    public function setDtAlteracao($dt_alteracao)
    {
        $this->dt_alteracao = $dt_alteracao;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param int $id_usuario
     * @return Demanda
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

}
