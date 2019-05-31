<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * TipoQuestao
 *
 * @ORM\Table(name="SQI.TB_TIPO_QUESTAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\TipoQuestaoRepository")
 */
class TipoQuestao extends Entity
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
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_TIPO_QUESTAO_ID_TIPO_QUESTA", allocationSize=1, initialValue=1)
     */
    private $idTipoQuestao;

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
     */
    private $nuOperacao;

    /**
     * @var \InepZend\Module\Sqi\Entity\
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    private $idUsuarioAlteracao;


    /**
     * Set dsTipoQuestao
     *
     * @param string $dsTipoQuestao
     *
     * @return TipoQuestao
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
     * @return TipoQuestao
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
     * Get idTipoQuestao
     *
     * @return integer 
     */
    public function getIdTipoQuestao()
    {
        return $this->idTipoQuestao;
    }

    /**
     * Set noIdentificador
     *
     * @param string $noIdentificador
     *
     * @return TipoQuestao
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
     * @return TipoQuestao
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
     * @return TipoQuestao
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
     * Set idUsuarioAlteracao
     *
     * @param $idUsuarioAlteracao
     *
     * @return TipoQuestao
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

