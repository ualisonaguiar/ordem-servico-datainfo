<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistoricoAcesso
 *
 * @ORM\Table(name="SSI.VW_HISTORICO_ACESSO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\VwHistoricoAcessoRepository")
 */
class VwHistoricoAcesso extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ACESSO", type="string", columnDefinition="DATE", nullable=false)
     */
    private $dtAcesso;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_HISTORICO_ACESSO", type="integer", nullable=false)
     */
    private $idHistoricoAcesso;

    /**
     * @var string
     *
     * @ORM\Column(name="ID_SESSAO", type="string", length=100, nullable=true)
     */
    private $idSessao;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_USUARIO_SISTEMA", type="integer", nullable=false)
     */
    private $idUsuarioSistema;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_METODO", type="string", length=500, nullable=true)
     */
    private $noMetodo;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_NAVEGADOR", type="string", length=500, nullable=true)
     */
    private $noNavegador;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SISTEMA", type="string", length=250, nullable=false)
     */
    private $noSistema;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_USUARIO", type="string", length=120, nullable=false)
     */
    private $noUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_IP", type="string", length=15, nullable=true)
     */
    private $nuIp;


    /**
     * Set dtAcesso
     *
     * @param \DateTime $dtAcesso
     *
     * @return HistoricoAcesso
     */
    public function setDtAcesso($dtAcesso)
    {
        $this->dtAcesso = $dtAcesso;
        return $this;
    }

    /**
     * Get dtAcesso
     *
     * @return \DateTime 
     */
    public function getDtAcesso()
    {
        return Date::convertDate($this->dtAcesso, "d/m/Y");
    }

    /**
     * Set idHistoricoAcesso
     *
     * @param integer $idHistoricoAcesso
     *
     * @return HistoricoAcesso
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
     * Set idSessao
     *
     * @param string $idSessao
     *
     * @return HistoricoAcesso
     */
    public function setIdSessao($idSessao)
    {
        $this->idSessao = $idSessao;
        return $this;
    }

    /**
     * Get idSessao
     *
     * @return string 
     */
    public function getIdSessao()
    {
        return $this->idSessao;
    }

    /**
     * Set idUsuarioSistema
     *
     * @param integer $idUsuarioSistema
     *
     * @return HistoricoAcesso
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
     * Set noMetodo
     *
     * @param string $noMetodo
     *
     * @return HistoricoAcesso
     */
    public function setNoMetodo($noMetodo)
    {
        $this->noMetodo = $noMetodo;
        return $this;
    }

    /**
     * Get noMetodo
     *
     * @return string 
     */
    public function getNoMetodo()
    {
        return $this->noMetodo;
    }

    /**
     * Set noNavegador
     *
     * @param string $noNavegador
     *
     * @return HistoricoAcesso
     */
    public function setNoNavegador($noNavegador)
    {
        $this->noNavegador = $noNavegador;
        return $this;
    }

    /**
     * Get noNavegador
     *
     * @return string 
     */
    public function getNoNavegador()
    {
        return $this->noNavegador;
    }

    /**
     * Set noSistema
     *
     * @param string $noSistema
     *
     * @return HistoricoAcesso
     */
    public function setNoSistema($noSistema)
    {
        $this->noSistema = $noSistema;
        return $this;
    }

    /**
     * Get noSistema
     *
     * @return string 
     */
    public function getNoSistema()
    {
        return $this->noSistema;
    }

    /**
     * Set noUsuario
     *
     * @param string $noUsuario
     *
     * @return HistoricoAcesso
     */
    public function setNoUsuario($noUsuario)
    {
        $this->noUsuario = $noUsuario;
        return $this;
    }

    /**
     * Get noUsuario
     *
     * @return string 
     */
    public function getNoUsuario()
    {
        return $this->noUsuario;
    }

    /**
     * Set nuIp
     *
     * @param string $nuIp
     *
     * @return HistoricoAcesso
     */
    public function setNuIp($nuIp)
    {
        $this->nuIp = $nuIp;
        return $this;
    }

    /**
     * Get nuIp
     *
     * @return string 
     */
    public function getNuIp()
    {
        return $this->nuIp;
    }
}

