<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Instrucao
 *
 * @ORM\Table(name="SQI.TB_INSTRUCAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\InstrucaoRepository")
 */
class Instrucao extends Entity
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
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_INSTRUCAO_ID_INSTRUCAO_seq", allocationSize=1, initialValue=1)
     */
    private $idInstrucao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     */
    private $nuOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_INSTRUCAO", type="string", length=1000, nullable=true)
     */
    private $txInstrucao;

    /**
     * @var \InepZend\Module\Sqi\Entity\
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    private $idUsuarioAlteracao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return Instrucao
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
     * Get idInstrucao
     *
     * @return integer 
     */
    public function getIdInstrucao()
    {
        return $this->idInstrucao;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return Instrucao
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
     * @return Instrucao
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

    /**
     * Set idUsuarioAlteracao
     *
     * @param $idUsuarioAlteracao
     *
     * @return Instrucao
     */
    public function setIdUsuarioAlteracao($idUsuarioAlteracao = null)
    {
        $this->idUsuarioAlteracao = $idUsuarioAlteracao;
        return $this;
    }

    /**
     * Get idUsuarioAlteracao
     *
     * @return \InepZend\Module\Sqi\Entity\ 
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->idUsuarioAlteracao;
    }
}

