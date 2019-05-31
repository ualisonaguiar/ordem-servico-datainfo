<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * ServicoAmbienteSistema
 *
 * @ORM\Table(name="SSI.TB_SERVICO_AMBIENTE_SISTEMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\ServicoAmbienteSistemaRepository")
 */
class ServicoAmbienteSistema extends Entity
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
     * @ORM\Column(name="ID_SERVICO_AMBIENTE_SISTEMA", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_SERVICO_AMBIENTE_SISTEMA_ID", allocationSize=1, initialValue=1)
     */
    private $idServicoAmbienteSistema;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo;

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
     * @var \InepZend\Module\Ssi\Entity\ServicoAmbiente
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\ServicoAmbiente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_SERVICO_AMBIENTE", referencedColumnName="ID_SERVICO_AMBIENTE")
     * })
     */
    private $idServicoAmbiente;

    /**
     * @var \InepZend\Module\Ssi\Entity\Sistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\Sistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_SISTEMA", referencedColumnName="ID_SISTEMA")
     * })
     */
    private $idSistema;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return ServicoAmbienteSistema
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
     * Get idServicoAmbienteSistema
     *
     * @return integer 
     */
    public function getIdServicoAmbienteSistema()
    {
        return $this->idServicoAmbienteSistema;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return ServicoAmbienteSistema
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return ServicoAmbienteSistema
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
     * @return ServicoAmbienteSistema
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

    /**
     * Set idServicoAmbiente
     *
     * @param \InepZend\Module\Ssi\Entity\ServicoAmbiente $idServicoAmbiente
     *
     * @return ServicoAmbienteSistema
     */
    public function setIdServicoAmbiente(\InepZend\Module\Ssi\Entity\ServicoAmbiente $idServicoAmbiente = null)
    {
        $this->idServicoAmbiente = $idServicoAmbiente;
        return $this;
    }

    /**
     * Get idServicoAmbiente
     *
     * @return \InepZend\Module\Ssi\Entity\ServicoAmbiente 
     */
    public function getIdServicoAmbiente()
    {
        return $this->idServicoAmbiente;
    }

    /**
     * Set idSistema
     *
     * @param \InepZend\Module\Ssi\Entity\Sistema $idSistema
     *
     * @return ServicoAmbienteSistema
     */
    public function setIdSistema(\InepZend\Module\Ssi\Entity\Sistema $idSistema = null)
    {
        $this->idSistema = $idSistema;
        return $this;
    }

    /**
     * Get idSistema
     *
     * @return \InepZend\Module\Ssi\Entity\Sistema 
     */
    public function getIdSistema()
    {
        return $this->idSistema;
    }
}

