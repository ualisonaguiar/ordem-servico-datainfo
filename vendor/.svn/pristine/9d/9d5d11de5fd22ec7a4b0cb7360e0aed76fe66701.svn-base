<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogErro
 *
 * @ORM\Table(name="SSI.TB_LOG_ERRO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogErroRepository")
 */
class LogErro extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_INCLUSAO", type="string", columnDefinition="DATE", nullable=false)
     */
    private $dtInclusao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_LOG_ERRO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_LOG_ERRO_ID_LOG_ERRO_seq", allocationSize=1, initialValue=1)
     */
    private $idLogErro;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_ARQUIVO_ERRO", type="string", length=500, nullable=false)
     */
    private $noArquivoErro;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_LINHA_ERRO", type="integer", nullable=false)
     */
    private $nuLinhaErro;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_MENSAGEM_ERRO", type="text", nullable=false)
     */
    private $txMensagemErro;

    /**
     * @var \InepZend\Module\Ssi\Entity\UsuarioSistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\UsuarioSistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_USUARIO_INCLUSAO", referencedColumnName="ID_USUARIO_SISTEMA")
     * })
     */
    private $idUsuarioInclusao;


    /**
     * Set dtInclusao
     *
     * @param \DateTime $dtInclusao
     *
     * @return LogErro
     */
    public function setDtInclusao($dtInclusao)
    {
        $this->dtInclusao = $dtInclusao;
        return $this;
    }

    /**
     * Get dtInclusao
     *
     * @return \DateTime 
     */
    public function getDtInclusao()
    {
        return Date::convertDate($this->dtInclusao, "d/m/Y");
    }

    /**
     * Get idLogErro
     *
     * @return integer 
     */
    public function getIdLogErro()
    {
        return $this->idLogErro;
    }

    /**
     * Set noArquivoErro
     *
     * @param string $noArquivoErro
     *
     * @return LogErro
     */
    public function setNoArquivoErro($noArquivoErro)
    {
        $this->noArquivoErro = $noArquivoErro;
        return $this;
    }

    /**
     * Get noArquivoErro
     *
     * @return string 
     */
    public function getNoArquivoErro()
    {
        return $this->noArquivoErro;
    }

    /**
     * Set nuLinhaErro
     *
     * @param integer $nuLinhaErro
     *
     * @return LogErro
     */
    public function setNuLinhaErro($nuLinhaErro)
    {
        $this->nuLinhaErro = $nuLinhaErro;
        return $this;
    }

    /**
     * Get nuLinhaErro
     *
     * @return integer 
     */
    public function getNuLinhaErro()
    {
        return $this->nuLinhaErro;
    }

    /**
     * Set txMensagemErro
     *
     * @param string $txMensagemErro
     *
     * @return LogErro
     */
    public function setTxMensagemErro($txMensagemErro)
    {
        $this->txMensagemErro = $txMensagemErro;
        return $this;
    }

    /**
     * Get txMensagemErro
     *
     * @return string 
     */
    public function getTxMensagemErro()
    {
        return $this->txMensagemErro;
    }

    /**
     * Set idUsuarioInclusao
     *
     * @param \InepZend\Module\Ssi\Entity\UsuarioSistema $idUsuarioInclusao
     *
     * @return LogErro
     */
    public function setIdUsuarioInclusao(\InepZend\Module\Ssi\Entity\UsuarioSistema $idUsuarioInclusao = null)
    {
        $this->idUsuarioInclusao = $idUsuarioInclusao;
        return $this;
    }

    /**
     * Get idUsuarioInclusao
     *
     * @return \InepZend\Module\Ssi\Entity\UsuarioSistema 
     */
    public function getIdUsuarioInclusao()
    {
        return $this->idUsuarioInclusao;
    }
}

