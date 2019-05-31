<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Questao
 *
 * @ORM\Table(name="SQI.TB_QUESTAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\QuestaoRepository")
 */
class Questao extends Entity
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
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_QUESTAO_ID_QUESTAO_seq", allocationSize=1, initialValue=1)
     */
    private $idQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     */
    private $nuOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_QUESTAO", type="string", length=2000, nullable=true)
     */
    private $txQuestao;

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
     * @return Questao
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
     * Get idQuestao
     *
     * @return integer 
     */
    public function getIdQuestao()
    {
        return $this->idQuestao;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return Questao
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
     * @return Questao
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

    /**
     * Set idUsuarioAlteracao
     *
     * @param $idUsuarioAlteracao
     *
     * @return Questao
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

