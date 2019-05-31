<?php

namespace OrdemServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="OrdemServico\Entity\FeriadoRepository")
 * @ORM\Table(name="tb_feriado")
 */
class Feriado extends Entity
{
    const CO_TP_FERIADO_NACIONAL = 1;
    const CO_TP_FERIADO_FACULTATIVO = 2;
    const CO_TP_FERIADO_FACULTATIVO_ATE_14_HORAS = 3;
    const CO_TP_FERIADO_FACULTATIVO_APOS_14_HORAS = 4;
    const CO_TP_FERIADO_DISTRITAL = 5;

    static $arrTipoFeriado = [
        self::CO_TP_FERIADO_NACIONAL => 'Nacional',
        self::CO_TP_FERIADO_FACULTATIVO => 'Facultativo',
        self::CO_TP_FERIADO_FACULTATIVO_ATE_14_HORAS => 'Facultativo até as 14 horas',
        self::CO_TP_FERIADO_FACULTATIVO_APOS_14_HORAS => 'Facultativo após as 14 horas',
        self::CO_TP_FERIADO_DISTRITAL => 'Distrital',
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_feriado;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_feriado;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(500)")
     * @var string
     * @@__toString
     */
    protected $no_feriado;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $tp_feriado;

    /**
     * @return int
     */
    public function getIdFeriado()
    {
        return $this->id_feriado;
    }

    /**
     * @param int $id_feriado
     * @return Feriado
     */
    public function setIdFeriado($id_feriado)
    {
        $this->id_feriado = $id_feriado;
        return $this;
    }

    /**
     * @return string
     */
    public function getDtFeriado()
    {
        return $this->dt_feriado;
    }

    /**
     * @param string $dt_feriado
     * @return Feriado
     */
    public function setDtFeriado($dt_feriado)
    {
        $this->dt_feriado = $dt_feriado;
        return $this;
    }

    /**
     * @return string
     */
    public function getNoFeriado()
    {
        return $this->no_feriado;
    }

    /**
     * @param string $no_feriado
     * @return Feriado
     */
    public function setNoFeriado($no_feriado)
    {
        $this->no_feriado = $no_feriado;
        return $this;
    }

    /**
     * @return int
     */
    public function getTpFeriado()
    {
        return $this->tp_feriado;
    }

    /**
     * @param int $tp_feriado
     * @return Feriado
     */
    public function setTpFeriado($tp_feriado)
    {
        $this->tp_feriado = $tp_feriado;
        return $this;
    }
}
