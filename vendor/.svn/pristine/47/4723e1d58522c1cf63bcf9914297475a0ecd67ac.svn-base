<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogPerguntaSecreta
 *
 * @ORM\Table(name="SSI.TB_LOG_PERGUNTA_SECRETA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogPerguntaSecretaRepository")
 */
class LogPerguntaSecreta extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    private $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_HISTORICO_ACESSO", type="integer", nullable=false)
     */
    private $idHistoricoAcesso;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PERGUNTA_SECRETA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idPerguntaSecreta;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_PERGUNTA_SECRETA", type="string", length=100, nullable=false)
     */
    private $txPerguntaSecreta;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogPerguntaSecreta
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
     * Set idHistoricoAcesso
     *
     * @param integer $idHistoricoAcesso
     *
     * @return LogPerguntaSecreta
     */
    public function setIdHistoricoAcesso($idHistoricoAcesso)
    {
        $this->idHistoricoAcesso = $idHistoricoAcesso;
        return $this;
    }

    /**
     * Get idHistoricoAcesso
     *
     * @return integer 
     */
    public function getIdHistoricoAcesso()
    {
        return $this->idHistoricoAcesso;
    }

    /**
     * Set idPerguntaSecreta
     *
     * @param integer $idPerguntaSecreta
     *
     * @return LogPerguntaSecreta
     */
    public function setIdPerguntaSecreta($idPerguntaSecreta)
    {
        $this->idPerguntaSecreta = $idPerguntaSecreta;
        return $this;
    }

    /**
     * Get idPerguntaSecreta
     *
     * @return integer 
     */
    public function getIdPerguntaSecreta()
    {
        return $this->idPerguntaSecreta;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return LogPerguntaSecreta
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
     * Set txPerguntaSecreta
     *
     * @param string $txPerguntaSecreta
     *
     * @return LogPerguntaSecreta
     */
    public function setTxPerguntaSecreta($txPerguntaSecreta)
    {
        $this->txPerguntaSecreta = $txPerguntaSecreta;
        return $this;
    }

    /**
     * Get txPerguntaSecreta
     *
     * @return string 
     */
    public function getTxPerguntaSecreta()
    {
        return $this->txPerguntaSecreta;
    }
}

