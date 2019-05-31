<?php

namespace OrdemServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @package OrdemServico\Entity
 * @ORM\Entity(repositoryClass="OrdemServico\Entity\LogVerificacaoDadosRepository")
 * @ORM\Table(name="tb_log_verificacao_dados")
 */
class LogVerificacaoDados extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_log_verificacao_dados;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_incio;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_fim;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $nu_quantidade_demandas;

    /**
     * @ORM\Column(type="string", columnDefinition="INTEGER")
     * @var int
     */
    protected $ds_demanda_corrigidas;

    /**
     * @return int
     */
    public function getIdLogVerificacaoDados()
    {
        return $this->id_log_verificacao_dados;
    }

    /**
     * @param int $id_log_verificacao_dados
     * @return LogVerificacaoDados
     */
    public function setIdLogVerificacaoDados($id_log_verificacao_dados)
    {
        $this->id_log_verificacao_dados = $id_log_verificacao_dados;
        return $this;
    }

    /**
     * @return string
     */
    public function getDtIncio()
    {
        return $this->dt_incio;
    }

    /**
     * @param string $dt_incio
     * @return LogVerificacaoDados
     */
    public function setDtIncio($dt_incio)
    {
        $this->dt_incio = $dt_incio;
        return $this;
    }

    /**
     * @return string
     */
    public function getDtFim()
    {
        return $this->dt_fim;
    }

    /**
     * @param string $dt_fim
     * @return LogVerificacaoDados
     */
    public function setDtFim($dt_fim)
    {
        $this->dt_fim = $dt_fim;
        return $this;
    }

    /**
     * @return int
     */
    public function getNuQuantidadeDemandas()
    {
        return $this->nu_quantidade_demandas;
    }

    /**
     * @param int $nu_quantidade_demandas
     * @return LogVerificacaoDados
     */
    public function setNuQuantidadeDemandas($nu_quantidade_demandas)
    {
        $this->nu_quantidade_demandas = $nu_quantidade_demandas;
        return $this;
    }

    /**
     * @return int
     */
    public function getDsDemandaCorrigidas()
    {
        return $this->ds_demanda_corrigidas;
    }

    /**
     * @param int $ds_demanda_corrigidas
     * @return LogVerificacaoDados
     */
    public function setDsDemandaCorrigidas($ds_demanda_corrigidas)
    {
        $this->ds_demanda_corrigidas = $ds_demanda_corrigidas;
        return $this;
    }
}
