<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * TipoSituacaoUsuario
 *
 * @ORM\Table(name="SSI.TB_TIPO_SITUACAO_USUARIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\TipoSituacaoUsuarioRepository")
 */
class TipoSituacaoUsuario extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_TIPO_SITUACAO_USUARIO", type="string", length=150, nullable=true)
     */
    private $dsTipoSituacaoUsuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    private $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_SITUACAO_USUARIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_TIPO_SITUACAO_USUARIO_ID_TI", allocationSize=1, initialValue=1)
     */
    private $idTipoSituacaoUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_SITUACAO_USUARIO", type="string", length=50, nullable=false)
     */
    private $noTipoSituacaoUsuario;

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
     * Set dsTipoSituacaoUsuario
     *
     * @param string $dsTipoSituacaoUsuario
     *
     * @return TipoSituacaoUsuario
     */
    public function setDsTipoSituacaoUsuario($dsTipoSituacaoUsuario)
    {
        $this->dsTipoSituacaoUsuario = $dsTipoSituacaoUsuario;
        return $this;
    }

    /**
     * Get dsTipoSituacaoUsuario
     *
     * @return string 
     */
    public function getDsTipoSituacaoUsuario()
    {
        return $this->dsTipoSituacaoUsuario;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return TipoSituacaoUsuario
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
     * Get idTipoSituacaoUsuario
     *
     * @return integer 
     */
    public function getIdTipoSituacaoUsuario()
    {
        return $this->idTipoSituacaoUsuario;
    }

    /**
     * Set noTipoSituacaoUsuario
     *
     * @param string $noTipoSituacaoUsuario
     *
     * @return TipoSituacaoUsuario
     */
    public function setNoTipoSituacaoUsuario($noTipoSituacaoUsuario)
    {
        $this->noTipoSituacaoUsuario = $noTipoSituacaoUsuario;
        return $this;
    }

    /**
     * Get noTipoSituacaoUsuario
     *
     * @return string 
     */
    public function getNoTipoSituacaoUsuario()
    {
        return $this->noTipoSituacaoUsuario;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return TipoSituacaoUsuario
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
     * @return TipoSituacaoUsuario
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

