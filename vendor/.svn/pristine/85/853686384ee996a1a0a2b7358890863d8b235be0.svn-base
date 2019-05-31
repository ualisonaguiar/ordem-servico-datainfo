<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * PerfilAcao
 *
 * @ORM\Table(name="SSI.TB_PERFIL_ACAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\PerfilAcaoRepository")
 */
class PerfilAcao extends Entity
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
     * @ORM\Column(name="ID_PERFIL_ACAO", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_PERFIL_ACAO_ID_PERFIL_ACAO_", allocationSize=1, initialValue=1)
     */
    private $idPerfilAcao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     */
    private $nuOperacao;

    /**
     * @var \InepZend\Module\Ssi\Entity\Acao
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\Acao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_ACAO", referencedColumnName="ID_ACAO")
     * })
     */
    private $idAcao;

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
     * @var \InepZend\Module\Ssi\Entity\Perfil
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\Perfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_PERFIL", referencedColumnName="ID_PERFIL")
     * })
     */
    private $idPerfil;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return PerfilAcao
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
     * Get idPerfilAcao
     *
     * @return integer 
     */
    public function getIdPerfilAcao()
    {
        return $this->idPerfilAcao;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return PerfilAcao
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
     * @return PerfilAcao
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
     * Set idAcao
     *
     * @param \InepZend\Module\Ssi\Entity\Acao $idAcao
     *
     * @return PerfilAcao
     */
    public function setIdAcao(\InepZend\Module\Ssi\Entity\Acao $idAcao = null)
    {
        $this->idAcao = $idAcao;
        return $this;
    }

    /**
     * Get idAcao
     *
     * @return \InepZend\Module\Ssi\Entity\Acao 
     */
    public function getIdAcao()
    {
        return $this->idAcao;
    }

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return PerfilAcao
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
     * Set idPerfil
     *
     * @param \InepZend\Module\Ssi\Entity\Perfil $idPerfil
     *
     * @return PerfilAcao
     */
    public function setIdPerfil(\InepZend\Module\Ssi\Entity\Perfil $idPerfil = null)
    {
        $this->idPerfil = $idPerfil;
        return $this;
    }

    /**
     * Get idPerfil
     *
     * @return \InepZend\Module\Ssi\Entity\Perfil 
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }
}

