<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * UsuarioSistemaPerfil
 *
 * @ORM\Table(name="SSI.TB_USUARIO_SISTEMA_PERFIL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\UsuarioSistemaPerfilRepository")
 */
class UsuarioSistemaPerfil extends Entity
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
     * @ORM\Column(name="ID_USUARIO_SISTEMA_PERFIL", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_USUARIO_SISTEMA_PERFIL_ID_U", allocationSize=1, initialValue=1)
     */
    private $idUsuarioSistemaPerfil;

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
     * @var \InepZend\Module\Ssi\Entity\UsuarioSistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\UsuarioSistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_USUARIO_SISTEMA", referencedColumnName="ID_USUARIO_SISTEMA")
     * })
     */
    private $idUsuarioSistema;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return UsuarioSistemaPerfil
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
     * Get idUsuarioSistemaPerfil
     *
     * @return integer 
     */
    public function getIdUsuarioSistemaPerfil()
    {
        return $this->idUsuarioSistemaPerfil;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return UsuarioSistemaPerfil
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
     * @return UsuarioSistemaPerfil
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
     * @return UsuarioSistemaPerfil
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
     * @return UsuarioSistemaPerfil
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

    /**
     * Set idUsuarioSistema
     *
     * @param \InepZend\Module\Ssi\Entity\UsuarioSistema $idUsuarioSistema
     *
     * @return UsuarioSistemaPerfil
     */
    public function setIdUsuarioSistema(\InepZend\Module\Ssi\Entity\UsuarioSistema $idUsuarioSistema = null)
    {
        $this->idUsuarioSistema = $idUsuarioSistema;
        return $this;
    }

    /**
     * Get idUsuarioSistema
     *
     * @return \InepZend\Module\Ssi\Entity\UsuarioSistema 
     */
    public function getIdUsuarioSistema()
    {
        return $this->idUsuarioSistema;
    }
}

