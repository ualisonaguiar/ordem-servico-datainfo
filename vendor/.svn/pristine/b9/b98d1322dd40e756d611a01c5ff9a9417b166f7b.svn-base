<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistSubgrupoQuestao
 *
 * @ORM\Table(name="SQI.TB_HIST_SUBGRUPO_QUESTAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\HistSubgrupoQuestaoRepository")
 */
class HistSubgrupoQuestao extends Entity
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
     * @ORM\Column(name="ID_SUBGRUPO_QUESTAO", type="smallint", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idSubgrupoQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    private $idUsuarioAlteracao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SUBGRUPO_QUESTAO", type="string", length=100, nullable=true)
     */
    private $noSubgrupoQuestao;

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
     * @ORM\Column(name="TX_SUBGRUPO_QUESTAO", type="string", length=1000, nullable=true)
     */
    private $txSubgrupoQuestao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistSubgrupoQuestao
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
     * Set idSubgrupoQuestao
     *
     * @param integer $idSubgrupoQuestao
     *
     * @return HistSubgrupoQuestao
     */
    public function setIdSubgrupoQuestao($idSubgrupoQuestao)
    {
        $this->idSubgrupoQuestao = $idSubgrupoQuestao;
        return $this;
    }

    /**
     * Get idSubgrupoQuestao
     *
     * @return integer 
     */
    public function getIdSubgrupoQuestao()
    {
        return $this->idSubgrupoQuestao;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistSubgrupoQuestao
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
     * Set noSubgrupoQuestao
     *
     * @param string $noSubgrupoQuestao
     *
     * @return HistSubgrupoQuestao
     */
    public function setNoSubgrupoQuestao($noSubgrupoQuestao)
    {
        $this->noSubgrupoQuestao = $noSubgrupoQuestao;
        return $this;
    }

    /**
     * Get noSubgrupoQuestao
     *
     * @return string 
     */
    public function getNoSubgrupoQuestao()
    {
        return $this->noSubgrupoQuestao;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistSubgrupoQuestao
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
     * Set txSubgrupoQuestao
     *
     * @param string $txSubgrupoQuestao
     *
     * @return HistSubgrupoQuestao
     */
    public function setTxSubgrupoQuestao($txSubgrupoQuestao)
    {
        $this->txSubgrupoQuestao = $txSubgrupoQuestao;
        return $this;
    }

    /**
     * Get txSubgrupoQuestao
     *
     * @return string 
     */
    public function getTxSubgrupoQuestao()
    {
        return $this->txSubgrupoQuestao;
    }
}

