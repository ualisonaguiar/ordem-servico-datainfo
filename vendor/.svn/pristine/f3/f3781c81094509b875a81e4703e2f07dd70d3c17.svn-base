<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * TipoAmbiente
 *
 * @ORM\Table(name="SSI.TB_TIPO_AMBIENTE")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\TipoAmbienteRepository")
 */
class TipoAmbiente extends Entity
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
     * @ORM\Column(name="ID_TIPO_AMBIENTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_TIPO_AMBIENTE_ID_TIPO_AMBIE", allocationSize=1, initialValue=1)
     */
    private $idTipoAmbiente;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_AMBIENTE", type="string", length=20, nullable=false)
     */
    private $noTipoAmbiente;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     */
    private $nuOperacao;

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
     * @return TipoAmbiente
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
     * Get idTipoAmbiente
     *
     * @return integer 
     */
    public function getIdTipoAmbiente()
    {
        return $this->idTipoAmbiente;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return TipoAmbiente
     */
    public function setInAtivo($inAtivo)
    {
        $this->inAtivo = $inAtivo;
        return $this;
    }

    /**
     * Get inAtivo
     *
     * @return boolean 
     */
    public function getInAtivo()
    {
        return $this->inAtivo;
    }

    /**
     * Set noTipoAmbiente
     *
     * @param string $noTipoAmbiente
     *
     * @return TipoAmbiente
     */
    public function setNoTipoAmbiente($noTipoAmbiente)
    {
        $this->noTipoAmbiente = $noTipoAmbiente;
        return $this;
    }

    /**
     * Get noTipoAmbiente
     *
     * @return string 
     */
    public function getNoTipoAmbiente()
    {
        return $this->noTipoAmbiente;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return TipoAmbiente
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
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return TipoAmbiente
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

