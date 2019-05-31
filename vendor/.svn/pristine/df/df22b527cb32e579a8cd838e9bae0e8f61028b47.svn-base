<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistQuestao
 *
 * @ORM\Table(name="SQI.TB_HIST_QUESTAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\HistQuestaoRepository")
 */
class HistQuestao extends Entity
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
     * @ORM\Column(name="ID_QUESTAO", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idQuestao;

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
     * @ORM\Column(name="TX_QUESTAO", type="string", length=2000, nullable=true)
     */
    private $txQuestao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistQuestao
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
     * Set idQuestao
     *
     * @param integer $idQuestao
     *
     * @return HistQuestao
     */
    public function setIdQuestao($idQuestao)
    {
        $this->idQuestao = $idQuestao;
        return $this;
    }

    /**
     * Get idQuestao
     *
     * @return integer 
     */
    public function getIdQuestao()
    {
        return $this->idQuestao;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistQuestao
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
     * @return HistQuestao
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
     * Set txQuestao
     *
     * @param string $txQuestao
     *
     * @return HistQuestao
     */
    public function setTxQuestao($txQuestao)
    {
        $this->txQuestao = $txQuestao;
        return $this;
    }

    /**
     * Get txQuestao
     *
     * @return string 
     */
    public function getTxQuestao()
    {
        return $this->txQuestao;
    }
}

