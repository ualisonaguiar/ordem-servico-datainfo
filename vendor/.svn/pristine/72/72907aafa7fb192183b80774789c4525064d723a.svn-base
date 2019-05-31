<?php

namespace InepZend\Module\Crontab\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\Crontab\Common\Entity\CronRepository")
 * @ORM\Table(name="inep_skeleton.tb_cron")
 */
class Cron extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="inep_skeleton.seq_cron", initialValue=1, allocationSize=1)
     * @var int
     */
    protected $id_cron;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     * @@__toString
     */
    protected $no_cron;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(500)")
     * @var string
     */
    protected $ds_url;

    /**
     * @ORM\Column(type="boolean", columnDefinition="BOOLEAN")
     * @var boolean
     */
    protected $in_ativo;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_cadastro;

    public function getIdCron()
    {
        return $this->id_cron;
    }

    public function setIdCron($intIdCron = null)
    {
        $this->id_cron = (is_numeric($intIdCron)) ? (integer) $intIdCron : $intIdCron;
        return $this;
    }

    public function getNoCron()
    {
        return $this->no_cron;
    }

    public function setNoCron($strNoCron = null)
    {
        $this->no_cron = $strNoCron;
        return $this;
    }

    public function getDsUrl()
    {
        return $this->ds_url;
    }

    public function setDsUrl($strDsUrl = null)
    {
        $this->ds_url = $strDsUrl;
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

    public function getDtCadastro()
    {
        return Date::convertDate($this->dt_cadastro, 'd/m/Y H:i:s');
    }

    public function setDtCadastro($strDtCadastro = null)
    {
        $this->dt_cadastro = $strDtCadastro;
        return $this;
    }

}
