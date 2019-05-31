<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * HistUsuarioSistemaPerfil
 *
 * @ORM\Table(name="SSI.TB_HIST_USUARIO_SISTEMA_PERFIL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\HistUsuarioSistemaPerfilRepository")
 */
class HistUsuarioSistemaPerfil extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_HIST_USUARIO_SISTEMA_PERFIL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_HIST_USUARIO_SISTEMA_PERFIL", allocationSize=1, initialValue=1)
     */
    private $idHistUsuarioSistemaPerfil;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PERFIL", type="integer", nullable=false)
     */
    private $idPerfil;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_SISTEMA", type="integer", nullable=false)
     */
    private $idUsuarioSistema;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_SISTEMA_PERFIL", type="bigint", nullable=true)
     */
    private $idUsuarioSistemaPerfil;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_OPERACAO", type="string", length=1, nullable=false)
     */
    private $tpOperacao;

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
     * Get idHistUsuarioSistemaPerfil
     *
     * @return integer 
     */
    public function getIdHistUsuarioSistemaPerfil()
    {
        return $this->idHistUsuarioSistemaPerfil;
    }

    /**
     * Set idPerfil
     *
     * @param integer $idPerfil
     *
     * @return HistUsuarioSistemaPerfil
     */
    public function setIdPerfil($idPerfil)
    {
        $this->idPerfil = $idPerfil;
        return $this;
    }

    /**
     * Get idPerfil
     *
     * @return integer 
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    /**
     * Set idUsuarioSistema
     *
     * @param integer $idUsuarioSistema
     *
     * @return HistUsuarioSistemaPerfil
     */
    public function setIdUsuarioSistema($idUsuarioSistema)
    {
        $this->idUsuarioSistema = $idUsuarioSistema;
        return $this;
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
     * Set idUsuarioSistemaPerfil
     *
     * @param integer $idUsuarioSistemaPerfil
     *
     * @return HistUsuarioSistemaPerfil
     */
    public function setIdUsuarioSistemaPerfil($idUsuarioSistemaPerfil)
    {
        $this->idUsuarioSistemaPerfil = $idUsuarioSistemaPerfil;
        return $this;
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
     * @return HistUsuarioSistemaPerfil
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
     * Set tpOperacao
     *
     * @param string $tpOperacao
     *
     * @return HistUsuarioSistemaPerfil
     */
    public function setTpOperacao($tpOperacao)
    {
        $this->tpOperacao = $tpOperacao;
        return $this;
    }

    /**
     * Get tpOperacao
     *
     * @return string 
     */
    public function getTpOperacao()
    {
        return $this->tpOperacao;
    }

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return HistUsuarioSistemaPerfil
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

