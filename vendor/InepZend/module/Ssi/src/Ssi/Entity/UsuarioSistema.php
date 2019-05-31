<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * UsuarioSistema
 *
 * @ORM\Table(name="SSI.TB_USUARIO_SISTEMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\UsuarioSistemaRepository")
 */
class UsuarioSistema extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    private $dtAlteracao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_EXPIRACAO_USUARIO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtExpiracaoUsuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_SITUACAO_USUARIO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtSituacaoUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_SISTEMA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_USUARIO_SISTEMA_ID_USUARIO_", allocationSize=1, initialValue=1)
     */
    private $idUsuarioSistema;

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
     * @var \InepZend\Module\Ssi\Entity\Sistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\Sistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_SISTEMA", referencedColumnName="ID_SISTEMA")
     * })
     */
    private $idSistema;

    /**
     * @var \InepZend\Module\Ssi\Entity\TipoSituacaoUsuario
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\TipoSituacaoUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_TIPO_SITUACAO_USUARIO", referencedColumnName="ID_TIPO_SITUACAO_USUARIO")
     * })
     */
    private $idTipoSituacaoUsuario;

    /**
     * @var \InepZend\Module\Ssi\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_USUARIO", referencedColumnName="ID_USUARIO")
     * })
     */
    private $idUsuario;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return UsuarioSistema
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
     * Set dtExpiracaoUsuario
     *
     * @param \DateTime $dtExpiracaoUsuario
     *
     * @return UsuarioSistema
     */
    public function setDtExpiracaoUsuario($dtExpiracaoUsuario)
    {
        $this->dtExpiracaoUsuario = $dtExpiracaoUsuario;
        return $this;
    }

    /**
     * Get dtExpiracaoUsuario
     *
     * @return \DateTime 
     */
    public function getDtExpiracaoUsuario()
    {
        return Date::convertDate($this->dtExpiracaoUsuario, "d/m/Y");
    }

    /**
     * Set dtSituacaoUsuario
     *
     * @param \DateTime $dtSituacaoUsuario
     *
     * @return UsuarioSistema
     */
    public function setDtSituacaoUsuario($dtSituacaoUsuario)
    {
        $this->dtSituacaoUsuario = $dtSituacaoUsuario;
        return $this;
    }

    /**
     * Get dtSituacaoUsuario
     *
     * @return \DateTime 
     */
    public function getDtSituacaoUsuario()
    {
        return Date::convertDate($this->dtSituacaoUsuario, "d/m/Y");
    }

    /**
     * Get idUsuarioSistema
     *
     * @return integer 
     */
    public function getIdUsuarioSistema()
    {
        return $this->idUsuarioSistema;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return UsuarioSistema
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
     * @return UsuarioSistema
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
     * Set idSistema
     *
     * @param \InepZend\Module\Ssi\Entity\Sistema $idSistema
     *
     * @return UsuarioSistema
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

    /**
     * Set idTipoSituacaoUsuario
     *
     * @param \InepZend\Module\Ssi\Entity\TipoSituacaoUsuario $idTipoSituacaoUsuario
     *
     * @return UsuarioSistema
     */
    public function setIdTipoSituacaoUsuario(\InepZend\Module\Ssi\Entity\TipoSituacaoUsuario $idTipoSituacaoUsuario = null)
    {
        $this->idTipoSituacaoUsuario = $idTipoSituacaoUsuario;
        return $this;
    }

    /**
     * Get idTipoSituacaoUsuario
     *
     * @return \InepZend\Module\Ssi\Entity\TipoSituacaoUsuario 
     */
    public function getIdTipoSituacaoUsuario()
    {
        return $this->idTipoSituacaoUsuario;
    }

    /**
     * Set idUsuario
     *
     * @param \InepZend\Module\Ssi\Entity\Usuario $idUsuario
     *
     * @return UsuarioSistema
     */
    public function setIdUsuario(\InepZend\Module\Ssi\Entity\Usuario $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \InepZend\Module\Ssi\Entity\Usuario 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}

