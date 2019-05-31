<?php

namespace InepZend\Module\Executor\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * InepZend\Module\Executor\Entity\Query
 *
 * @ORM\Entity(repositoryClass="InepZend\Module\Executor\Entity\QueryRepository")
 * @ORM\Table(name="tb_usuario")
 */
class Usuario extends Entity
{

    const SITUACAO_ATIVO = 1;
    const SITUACAO_INATIVO = 0;
    
    const SITUACAO_SIM = 1;
    const SITUACAO_NAO = 0;
    
    public static $arrSituacao = array(
        self::SITUACAO_ATIVO => 'Ativo',
        self::SITUACAO_INATIVO => 'Inativo'
    );
    
    public static $arrProductOwner = array(
        self::SITUACAO_SIM => 'Sim',
        self::SITUACAO_NAO => 'Não'
    );

    /**
     * @ORM\Id
     * @ORM\Column(name="id_usuario", type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="executequery.seq_usuario", initialValue=1, allocationSize=1)
     * @var int
     */
    private $idUsuario;

    /**
     * @var string $dsTitulo
     *
     * @ORM\Column(name="ds_login", type="string", length=255, nullable=false)
     * @@__toString
     */
    private $dsLogin;    

    /**
     * @var string $nuCpf
     *
     * @ORM\Column(name="NU_CPF", type="string", length=11, nullable=true)
     */
    private $nuCpf;

    /**
     * @var boolean $inAtivo
     *
     * @ORM\Column(name="in_ativo", type="boolean", nullable=false)
     */
    private $inAtivo;
    
    /**
     * @var boolean $inAtivo
     *
     * @ORM\Column(name="in_product_owner", type="boolean", nullable=false)
     */
    private $inProductOwner;

    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     * @return Usuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return integer 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set dsLogin
     *
     * @param string dsLogin
     * @return Usuario
     */
    public function setDsLogin($dsLogin)
    {
        $this->dsLogin = $dsLogin;
        return $this;
    }

    /**
     * Get dsLogin
     *
     * @return string 
     */
    public function getDsLogin()
    {
        return $this->dsLogin;
    }    

    /**
     * Set nuCpf
     *
     * @param string $nuCpf
     * @return Usuario
     */
    public function setNuCpf($nuCpf)
    {
        $this->nuCpf = $nuCpf;
        return $this;
    }

    /**
     * Get nuCpf
     *
     * @return string 
     */
    public function getNuCpf()
    {
        return $this->nuCpf;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     * @return Usuario
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
     * Set inProductOwner
     *
     * @param boolean $inProductOwner
     * @return Usuario
     */
    public function setInProductOwner($inProductOwner)
    {
        $this->inProductOwner = $inProductOwner;
        return $this;
    }
    
    /**
     * Get inProductOwner
     *
     * @return boolean
     */
    public function getInProductOwner()
    {
        return $this->inProductOwner;
    }

}
