<?php

namespace InepZend\Module\Crontab\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Module\Crontab\Common\Service\File\AndamentoFile;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\Crontab\Common\Entity\AndamentoRepository")
 * @ORM\Table(name="inep_skeleton.tb_andamento_crontab")
 */
class Andamento extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="inep_skeleton.seq_andamento_crontab", initialValue=1, allocationSize=1)
     * @var int
     * @@__toString
     */
    protected $id_andamento;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_periodo;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(400)")
     * @var string
     */
    protected $ds_complemento;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(50)")
     * @var string
     */
    protected $tp_andamento;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_andamento;

    public function getIdAndamento()
    {
        return $this->id_andamento;
    }

    public function setIdAndamento($intIdAndamento = null)
    {
        $this->id_andamento = (is_numeric($intIdAndamento)) ? (integer) $intIdAndamento : $intIdAndamento;
        return $this;
    }

    public function getIdPeriodo()
    {
        return $this->id_periodo;
    }

    public function setIdPeriodo($intIdPeriodo = null)
    {
        $this->id_periodo = (is_numeric($intIdPeriodo)) ? (integer) $intIdPeriodo : $intIdPeriodo;
        return $this;
    }

    public function getDsComplemento()
    {
        return $this->ds_complemento;
    }

    public function setDsComplemento($strDsComplemento = null)
    {
        $this->ds_complemento = $strDsComplemento;
        return $this;
    }

    public function getTpAndamento()
    {
        return $this->tp_andamento;
    }

    public function setTpAndamento($strTpAndamento = null)
    {
        $this->tp_andamento = $strTpAndamento;
        return $this;
    }

    public function getTpAndamentoHtml()
    {
        $strStyle = '';
        $strTpAndamento = $this->getTpAndamento();
        switch ($strTpAndamento) {
            case AndamentoFile::COMPLETED:
                $strStyle = 'font-weight: bold; color: green;';
                break;
            case AndamentoFile::FAILURE:
                $strStyle = 'font-weight: bold; color: red;';
                break;
        }
        if (!empty($strStyle))
            $strTpAndamento = '<font style="' . $strStyle . '">' . $strTpAndamento . '</font>';
        return $strTpAndamento;
    }

    public function getDtAndamento()
    {
        return Date::convertDate($this->dt_andamento, 'd/m/Y H:i:s');
    }

    public function setDtAndamento($strDtAndamento = null)
    {
        $this->dt_andamento = $strDtAndamento;
        return $this;
    }

}
