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
class Query extends Entity
{

    const SITUACAO_ATIVO = 1;
    const SITUACAO_INATIVO = 0;

    public static $arrSituacao = array(
        self::SITUACAO_ATIVO => 'Ativo',
        self::SITUACAO_INATIVO => 'Inativo'
    );

    /**
     * @ORM\Id
     * @ORM\Column(name="id_query", type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="executequery.seq_query", initialValue=1, allocationSize=1)
     * @var int
     */
    private $idQuery;

    /**
     * @var string $dsTitulo
     *
     * @ORM\Column(name="ds_titulo", type="string", length=255, nullable=false)
     * @@__toString
     */
    protected $dsTitulo;

    /**
     * @var text $dsDescricao
     *
     * @ORM\Column(name="ds_descricao", type="text", nullable=true)
     * @@__toString
     */
    protected $dsDescricao;

    /**
     * @var text $dsQuery
     *
     * @ORM\Column(name="ds_query", type="text", nullable=false)
     */
    private $dsQuery;

    /**
     * @var boolean $inAtivo
     *
     * @ORM\Column(name="in_ativo", type="boolean", nullable=false)
     */
    private $inAtivo;

    /**
     * @var datetime $dtAlteracao
     *
     * @ORM\Column(name="dt_alteracao", type="string", nullable=false)
     */
    private $dtAlteracao;

    /**
     * @var datetime $dtCadastro
     *
     * @ORM\Column(name="dt_cadastro", type="string", nullable=false)
     */
    private $dtCadastro;

    /**
     * @var integer $idUsuarioAlteracao
     *
     * @ORM\Column(name="ds_usuario", type="string", length=255, nullable=false)
     */
    private $dsUsuario;

    /**
     * Set idQuery
     *
     * @param integer $idQuery
     * @return Query
     */
    public function setIdQuery($idQuery)
    {
        $this->idQuery = $idQuery;
        return $this;
    }

    /**
     * Get idQuery
     *
     * @return integer 
     */
    public function getIdQuery()
    {
        return $this->idQuery;
    }

    /**
     * Set dsTitulo
     *
     * @param string $dsTitulo
     * @return Query
     */
    public function setDsTitulo($dsTitulo)
    {
        $this->dsTitulo = $dsTitulo;
        return $this;
    }

    /**
     * Get dsTitulo
     *
     * @return string 
     */
    public function getDsTitulo()
    {
        return $this->dsTitulo;
    }

    /**
     * Set dsDescricao
     *
     * @param text $dsDescricao
     * @return Query
     */
    public function setDsDescricao($dsDescricao)
    {
        $this->dsDescricao = $dsDescricao;
        return $this;
    }

    /**
     * Get dsDescricao
     *
     * @return text 
     */
    public function getDsDescricao()
    {
        return $this->dsDescricao;
    }

    /**
     * Set dsQuery
     *
     * @param text $dsQuery
     * @return Query
     */
    public function setDsQuery($dsQuery)
    {
        $this->dsQuery = $dsQuery;
        return $this;
    }

    /**
     * Get dsQuery
     *
     * @return text 
     */
    public function getDsQuery()
    {
        return $this->dsQuery;
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

    /**
     * Set dtAlteracao
     *
     * @param datetime $dtAlteracao
     * @return Query
     */
    public function setDtAlteracao($dtAlteracao)
    {
        $this->dtAlteracao = $dtAlteracao;
        return $this;
    }

    /**
     * Get dtCadastro
     *
     * @return datetime 
     */
    public function getDtCadastro()
    {
        return Date::convertDate($this->dtCadastro, 'd/m/Y');
    }

    /**
     * Set dtCadastro
     *
     * @param datetime $dtCadastro
     * @return Query
     */
    public function setDtCadastro($dtCadastro)
    {
        $this->dtCadastro = $dtCadastro;
        return $this;
    }

    /**
     * Get dtAlteracao
     *
     * @return datetime 
     */
    public function getDtAlteracao()
    {
        return Date::convertDate($this->dtAlteracao, 'd/m/Y');
    }

    /**
     * Set dsUsuario
     *
     * @param string dsUsuario
     * @return Query
     */
    public function setDsUsuario($dsUsuario)
    {
        $this->dsUsuario = $dsUsuario;
        return $this;
    }

    /**
     * Get dsUsuario
     *
     * @return string 
     */
    public function getDsUsuario()
    {
        return $this->dsUsuario;
    }

}
