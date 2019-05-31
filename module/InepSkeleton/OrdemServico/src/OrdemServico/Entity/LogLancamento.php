<?php

namespace OrdemServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * @ORM\Entity(repositoryClass="OrdemServico\Entity\LogLancamentoRepository")
 * @ORM\Table(name="tb_log_lancamento")
 */
class LogLancamento extends Entity
{
    CONST CO_TIPO_OPERACAO_USUARIO = 1;
    CONST CO_TIPO_OPERACAO_CRONTAB = 2;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_log_lancamento;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_demanda;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_catalogo_servico_atividade;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_usuario;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_ponto;

    /**
     * @ORM\Column(type="string", columnDefinition="TIME")
     * @var string
     */
    protected $hr_inicio;

    /**
     * @ORM\Column(type="string", columnDefinition="TIME")
     * @var string
     */
    protected $hr_fim;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var string
     */
    protected $tp_operacao;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var
     */
    protected $dt_operacao;

    /**
     * @return int
     */
    public function getIdLogLancamento()
    {
        return $this->id_log_lancamento;
    }

    /**
     * @param int $id_log_lancamento
     * @return LogLancamento
     */
    public function setIdLogLancamento($id_log_lancamento)
    {
        $this->id_log_lancamento = $id_log_lancamento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdDemanda()
    {
        return $this->id_demanda;
    }

    /**
     * @param mixed $id_demanda
     * @return LogLancamento
     */
    public function setIdDemanda($id_demanda)
    {
        $this->id_demanda = $id_demanda;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdCatalogoServicoAtividade()
    {
        return $this->id_catalogo_servico_atividade;
    }

    /**
     * @param int $id_catalogo_servico_atividade
     * @return LogLancamento
     */
    public function setIdCatalogoServicoAtividade($id_catalogo_servico_atividade)
    {
        $this->id_catalogo_servico_atividade = $id_catalogo_servico_atividade;
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
     * @return LogLancamento
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    /**
     * @return string
     */
    public function getDtPonto()
    {
        return Date::convertDate($this->dt_ponto, 'd/m/Y');
    }

    /**
     * @param string $dt_ponto
     * @return LogLancamento
     */
    public function setDtPonto($dt_ponto)
    {
        $this->dt_ponto = $dt_ponto;
        return $this;
    }

    /**
     * @return string
     */
    public function getHrInicio()
    {
        return $this->hr_inicio;
    }

    /**
     * @param string $hr_inicio
     * @return LogLancamento
     */
    public function setHrInicio($hr_inicio)
    {
        $this->hr_inicio = $hr_inicio;
        return $this;
    }

    /**
     * @return string
     */
    public function getHrFim()
    {
        return $this->hr_fim;
    }

    /**
     * @param string $hr_fim
     * @return LogLancamento
     */
    public function setHrFim($hr_fim)
    {
        $this->hr_fim = $hr_fim;
        return $this;
    }

    /**
     * @return string
     */
    public function getTpOperacao()
    {
        return $this->tp_operacao;
    }

    /**
     * @param string $tp_operacao
     * @return LogLancamento
     */
    public function setTpOperacao($tp_operacao)
    {
        $this->tp_operacao = $tp_operacao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtOperacao()
    {
        return $this->dt_operacao;
    }

    /**
     * @param mixed $dt_operacao
     * @return LogLancamento
     */
    public function setDtOperacao($dt_operacao)
    {
        $this->dt_operacao = $dt_operacao;
        return $this;
    }
}