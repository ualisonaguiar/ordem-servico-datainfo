<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogSubtipoContato
 *
 * @ORM\Table(name="SSI.TB_LOG_SUBTIPO_CONTATO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogSubtipoContatoRepository")
 */
class LogSubtipoContato extends Entity
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
     * @ORM\Column(name="ID_SUBTIPO_CONTATO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idSubtipoContato;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SUBTIPO_CONTATO", type="string", length=50, nullable=false)
     */
    private $noSubtipoContato;

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
     * @ORM\Column(name="TP_CONTATO", type="string", length=1, nullable=false)
     */
    private $tpContato;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogSubtipoContato
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
     * @return LogSubtipoContato
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
     * Set idSubtipoContato
     *
     * @param integer $idSubtipoContato
     *
     * @return LogSubtipoContato
     */
    public function setIdSubtipoContato($idSubtipoContato)
    {
        $this->idSubtipoContato = $idSubtipoContato;
        return $this;
    }

    /**
     * Get idSubtipoContato
     *
     * @return integer 
     */
    public function getIdSubtipoContato()
    {
        return $this->idSubtipoContato;
    }

    /**
     * Set noSubtipoContato
     *
     * @param string $noSubtipoContato
     *
     * @return LogSubtipoContato
     */
    public function setNoSubtipoContato($noSubtipoContato)
    {
        $this->noSubtipoContato = $noSubtipoContato;
        return $this;
    }

    /**
     * Get noSubtipoContato
     *
     * @return string 
     */
    public function getNoSubtipoContato()
    {
        return $this->noSubtipoContato;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return LogSubtipoContato
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
     * Set tpContato
     *
     * @param string $tpContato
     *
     * @return LogSubtipoContato
     */
    public function setTpContato($tpContato)
    {
        $this->tpContato = $tpContato;
        return $this;
    }

    /**
     * Get tpContato
     *
     * @return string 
     */
    public function getTpContato()
    {
        return $this->tpContato;
    }
}

