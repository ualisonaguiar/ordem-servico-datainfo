<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistInstrucao
 *
 * @ORM\Table(name="SQI.TB_HIST_INSTRUCAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\HistInstrucaoRepository")
 */
class HistInstrucao extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_INSTRUCAO", type="smallint", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idInstrucao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    private $idUsuarioAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_INSTRUCAO", type="string", length=1000, nullable=true)
     */
    private $txInstrucao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistInstrucao
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
     * Set idInstrucao
     *
     * @param integer $idInstrucao
     *
     * @return HistInstrucao
     */
    public function setIdInstrucao($idInstrucao)
    {
        $this->idInstrucao = $idInstrucao;
        return $this;
    }

    /**
     * Get idInstrucao
     *
     * @return integer 
     */
    public function getIdInstrucao()
    {
        return $this->idInstrucao;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistInstrucao
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistInstrucao
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
     * Set txInstrucao
     *
     * @param string $txInstrucao
     *
     * @return HistInstrucao
     */
    public function setTxInstrucao($txInstrucao)
    {
        $this->txInstrucao = $txInstrucao;
        return $this;
    }

    /**
     * Get txInstrucao
     *
     * @return string 
     */
    public function getTxInstrucao()
    {
        return $this->txInstrucao;
    }
}

