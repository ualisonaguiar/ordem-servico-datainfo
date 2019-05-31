<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * HistoricoPerfilAcao
 *
 * @ORM\Table(name="SSI.TB_HISTORICO_PERFIL_ACAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\HistoricoPerfilAcaoRepository")
 */
class HistoricoPerfilAcao extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_ACAO", type="integer", nullable=false)
     */
    private $idAcao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_HISTORICO_PERFIL_ACAO", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_HISTORICO_PERFIL_ACAO_ID_HI", allocationSize=1, initialValue=1)
     */
    private $idHistoricoPerfilAcao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PERFIL", type="integer", nullable=false)
     */
    private $idPerfil;

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
     * Set idAcao
     *
     * @param integer $idAcao
     *
     * @return HistoricoPerfilAcao
     */
    public function setIdAcao($idAcao)
    {
        $this->idAcao = $idAcao;
        return $this;
    }

    /**
     * Get idAcao
     *
     * @return integer 
     */
    public function getIdAcao()
    {
        return $this->idAcao;
    }

    /**
     * Get idHistoricoPerfilAcao
     *
     * @return integer 
     */
    public function getIdHistoricoPerfilAcao()
    {
        return $this->idHistoricoPerfilAcao;
    }

    /**
     * Set idPerfil
     *
     * @param integer $idPerfil
     *
     * @return HistoricoPerfilAcao
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
     * Set tpOperacao
     *
     * @param string $tpOperacao
     *
     * @return HistoricoPerfilAcao
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
     * @return HistoricoPerfilAcao
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

