<?php

namespace InepZend\Module\Executor\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * InepZend\Module\Executor\Entity\Query
 *
 * @ORM\Entity(repositoryClass="InepZend\Module\Executor\Entity\QueryRepository")
 * @ORM\Table(name="tb_query")
 */
class Email extends Entity
{
    const SITUACAO_NAO_ENVIADO = 1;

    const SITUACAO_ENVIADO = 2;

    const SITUACAO_FALHA = 3;

    public static $arrSituacao = array(
        self::SITUACAO_NAO_ENVIADO => '<p class="alert-info">Não Enviado</p>',
        self::SITUACAO_ENVIADO => '<p class="alert-success">Enviado</p>',
        self::SITUACAO_FALHA => '<p class="alert-danger">Falha</p>'
    );

    /**
     * @ORM\Id
     * @ORM\Column(name="id_email", type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="executequery.seq_email", initialValue=1, allocationSize=1)
     * @var int
     */
    private $idEmail;

    /**
     * @var text $dsDestinatario
     *
     * @ORM\Column(name="ds_destinatario", type="text", nullable=false)
     */
    private $dsDestinatario;

    /**
     * @var text $dsDestinatarioCopia
     *
     * @ORM\Column(name="ds_destinatario_copia", type="text", nullable=false)
     */
    private $dsDestinatarioCopia;

    /**
     * @var text $dsAssunto
     *
     * @ORM\Column(name="ds_assunto", type="text", nullable=false)
     */
    private $dsAssunto;

    /**
     * @var text $dsTexto
     *
     * @ORM\Column(name="ds_texto", type="text", nullable=false)
     */
    private $dsTexto;

    /**
     * @var datetime $dtEnvio
     *
     * @ORM\Column(name="dt_envio", type="string", nullable=false)
     */
    private $dtEnvio;

    /**
     * @var integer $dsUsuario
     *
     * @ORM\Column(name="ds_usuario", type="string", length=255, nullable=false)
     */
    private $dsUsuario;

    /**
     * @var text $dsPathAnexo
     *
     * @ORM\Column(name="ds_path_anexo", type="text", nullable=false)
     */
    private $dsPathAnexo;

    /**
     * @var boolean $inAtivo
     *
     * @ORM\Column(name="in_ativo", type="boolean", nullable=false)
     */
    private $inAtivo;

    /**
     * Get idEmail
     *
     * @return integer
     */
    public function getIdEmail()
    {
        return $this->idEmail;
    }

    /**
     * Set idEmail
     *
     * @param string $idEmail
     * @return EmailQuery
     */
    public function setIdEmail($idEmail)
    {
        $this->idEmail = $idEmail;
        return $this;
    }

    /**
     * Get dsDestinatario
     *
     * @return string
     */
    public function getDsDestinatario()
    {
        return $this->dsDestinatario;
    }

    /**
     * Set dsDestinatario
     *
     * @param string $dsDestinatario
     * @return EmailQuery
     */
    public function setDsDestinatario($dsDestinatario)
    {
        $this->dsDestinatario = $dsDestinatario;
        return $this;
    }

    /**
     * Get dsDestinatarioCopia
     *
     * @return string
     */
    public function getDsDestinatarioCopia()
    {
        return $this->dsDestinatarioCopia;
    }

    /**
     * Set dsDestinatarioCopia
     *
     * @param string $dsDestinatarioCopia
     * @return EmailQuery
     */
    public function setDsDestinatarioCopia($dsDestinatarioCopia)
    {
        $this->dsDestinatarioCopia = $dsDestinatarioCopia;
        return $this;
    }

    /**
     * Get dsAssunto
     *
     * @return string
     */
    public function getDsAssunto()
    {
        return $this->dsAssunto;
    }

    /**
     * Set dsAssunto
     *
     * @param string dsAssunto
     * @return EmailQuery
     */
    public function setDsAssunto($dsAssunto)
    {
        $this->dsAssunto = $dsAssunto;
        return $this;
    }

    /**
     * Get dsTexto
     *
     * @return string
     */
    public function getDsTexto()
    {
        return $this->dsTexto;
    }

    /**
     * Set dsTexto
     *
     * @param string dsTexto
     * @return EmailQuery
     */
    public function setDsTexto($dsTexto)
    {
        $this->dsTexto = $dsTexto;
        return $this;
    }

    /**
     * Get dtEnvio
     *
     * @return string
     */
    public function getDtEnvio()
    {
        return Date::convertDate($this->dtEnvio, 'd/m/Y H:i:s');
    }

    /**
     * Set dtEnvio
     *
     * @param string dtEnvio
     * @return EmailQuery
     */
    public function setDtEnvio($dtEnvio)
    {
        $this->dtEnvio = $dtEnvio;
        return $this;
    }

    /**
     * Set dsUsuario
     *
     * @param integer $dsUsuario
     * @return EmailQuery
     */
    public function setDsUsuario($dsUsuario)
    {
        $this->dsUsuario = $dsUsuario;
        return $this;
    }

    /**
     * Get dsUsuario
     *
     * @return integer
     */
    public function getDsUsuario()
    {
        return $this->dsUsuario;
    }

    /**
     * Get dsDestinatario
     *
     * @return string
     */
    public function getDsPathAnexo()
    {
        return $this->dsPathAnexo;
    }

    /**
     * Set dsPathAnexo
     *
     * @param string $dsPathAnexo
     * @return EmailQuery
     */
    public function setDsPathAnexo($dsPathAnexo)
    {
        $this->dsPathAnexo = $dsPathAnexo;
        return $this;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     * @return Query
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
}
