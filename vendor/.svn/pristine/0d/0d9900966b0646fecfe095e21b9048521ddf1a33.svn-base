<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * SubtipoContato
 *
 * @ORM\Table(name="SSI.TB_SUBTIPO_CONTATO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\SubtipoContatoRepository")
 */
class SubtipoContato extends Entity
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
     * @ORM\Column(name="ID_SUBTIPO_CONTATO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_SUBTIPO_CONTATO_ID_SUBTIPO_", allocationSize=1, initialValue=1)
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
     */
    private $nuOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_CONTATO", type="string", length=1, nullable=false)
     */
    private $tpContato;

    /**
     * @var \InepZend\Module\Ssi\Entity\HistoricoAcesso
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\HistoricoAcesso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_HISTORICO_ACESSO", referencedColumnName="ID_HISTORICO_ACESSO")
     * })
     */
    private $idHistoricoAcesso;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return SubtipoContato
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
     * @return SubtipoContato
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
     * @return SubtipoContato
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
     * @return SubtipoContato
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

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return SubtipoContato
     */
    public function setIdHistoricoAcesso(\InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso = null)
    {
        $this->idHistoricoAcesso = $idHistoricoAcesso;
        return $this;
    }

    /**
     * Get idHistoricoAcesso
     *
     * @return \InepZend\Module\Ssi\Entity\HistoricoAcesso 
     */
    public function getIdHistoricoAcesso()
    {
        return $this->idHistoricoAcesso;
    }
}

