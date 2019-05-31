<?php

namespace InepZend\Module\Crontab\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\Crontab\Common\Entity\PeriodoRepository")
 * @ORM\Table(name="inep_skeleton.tb_periodo")
 */
class Periodo extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="inep_skeleton.seq_periodo", initialValue=1, allocationSize=1)
     * @var int
     * @@__toString
     */
    protected $id_periodo;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_cron;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(2)")
     * @var int
     */
    protected $nu_mes;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(1)")
     * @var int
     */
    protected $nu_dia_semana;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(2)")
     * @var int
     */
    protected $nu_dia;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(2)")
     * @var int
     */
    protected $nu_hora;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(2)")
     * @var int
     */
    protected $nu_minuto;

    /**
     * @ORM\Column(type="boolean", columnDefinition="BOOLEAN")
     * @var boolean
     */
    protected $in_ativo;

    public function getIdPeriodo()
    {
        return $this->id_periodo;
    }

    public function setIdPeriodo($intIdPeriodo = null)
    {
        $this->id_periodo = (is_numeric($intIdPeriodo)) ? (integer) $intIdPeriodo : $intIdPeriodo;
        return $this;
    }

    public function getIdCron()
    {
        return $this->id_cron;
    }

    public function setIdCron($intIdCron = null)
    {
        $this->id_cron = (is_numeric($intIdCron)) ? (integer) $intIdCron : $intIdCron;
        return $this;
    }

    public function getNuMes()
    {
        return $this->nu_mes;
    }

    public function setNuMes($intNuMes = null)
    {
        $this->nu_mes = $intNuMes;
        return $this;
    }

    public function getNuDiaSemana()
    {
        return $this->nu_dia_semana;
    }

    public function setNuDiaSemana($intNuDiaSemana = null)
    {
        $this->nu_dia_semana = $intNuDiaSemana;
        return $this;
    }

    public function getNuDia()
    {
        return $this->nu_dia;
    }

    public function setNuDia($intNuDia = null)
    {
        $this->nu_dia = $intNuDia;
        return $this;
    }

    public function getNuHora()
    {
        return $this->nu_hora;
    }

    public function setNuHora($intNuHora = null)
    {
        $this->nu_hora = $intNuHora;
        return $this;
    }

    public function getNuMinuto()
    {
        return $this->nu_minuto;
    }

    public function setNuMinuto($intNuMinuto = null)
    {
        $this->nu_minuto = $intNuMinuto;
        return $this;
    }

    public function getInAtivo()
    {
        return $this->in_ativo;
    }

    public function setInAtivo($booInAtivo = true)
    {
        $this->in_ativo = $booInAtivo;
        return $this;
    }

    public function getNoPeriodo()
    {
        return $this->getNuMes() . ' ' . $this->getNuDiaSemana() . ' ' . $this->getNuDia() . ' ' . $this->getNuHora() . ' ' . $this->getNuMinuto();
    }

}
