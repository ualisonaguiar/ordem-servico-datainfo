<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistTipoQuestao
 *
 * @ORM\Table(name="SQI.TB_HIST_TIPO_QUESTAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\HistTipoQuestaoRepository")
 */
class HistTipoQuestao extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_TIPO_QUESTAO", type="string", length=200, nullable=true)
     */
    private $dsTipoQuestao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_QUESTAO", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idTipoQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    private $idUsuarioAlteracao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_IDENTIFICADOR", type="string", length=50, nullable=true)
     */
    private $noIdentificador;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_QUESTAO", type="string", length=100, nullable=true)
     */
    private $noTipoQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;


    /**
     * Set dsTipoQuestao
     *
     * @param string $dsTipoQuestao
     *
     * @return HistTipoQuestao
     */
    public function setDsTipoQuestao($dsTipoQuestao)
    {
        $this->dsTipoQuestao = $dsTipoQuestao;
        return $this;
    }

    /**
     * Get dsTipoQuestao
     *
     * @return string 
     */
    public function getDsTipoQuestao()
    {
        return $this->dsTipoQuestao;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistTipoQuestao
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
     * Set idTipoQuestao
     *
     * @param integer $idTipoQuestao
     *
     * @return HistTipoQuestao
     */
    public function setIdTipoQuestao($idTipoQuestao)
    {
        $this->idTipoQuestao = $idTipoQuestao;
        return $this;
    }

    /**
     * Get idTipoQuestao
     *
     * @return integer 
     */
    public function getIdTipoQuestao()
    {
        return $this->idTipoQuestao;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistTipoQuestao
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
     * Set noIdentificador
     *
     * @param string $noIdentificador
     *
     * @return HistTipoQuestao
     */
    public function setNoIdentificador($noIdentificador)
    {
        $this->noIdentificador = $noIdentificador;
        return $this;
    }

    /**
     * Get noIdentificador
     *
     * @return string 
     */
    public function getNoIdentificador()
    {
        return $this->noIdentificador;
    }

    /**
     * Set noTipoQuestao
     *
     * @param string $noTipoQuestao
     *
     * @return HistTipoQuestao
     */
    public function setNoTipoQuestao($noTipoQuestao)
    {
        $this->noTipoQuestao = $noTipoQuestao;
        return $this;
    }

    /**
     * Get noTipoQuestao
     *
     * @return string 
     */
    public function getNoTipoQuestao()
    {
        return $this->noTipoQuestao;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistTipoQuestao
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
}

