<?php

namespace InepZend\Module\Executor\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * InepZend\Module\Executor\Entity\HistoricoExecucao
 *
 * @ORM\Table(name="tb_historico_execucao")
 * @ORM\Entity
 */
class HistoricoExecucao extends Entity
{

    const SITUACAO_EXECUCAO_SUCESSO = 1;
    const SITUACAO_EXECUCAO_ERROR = 2;

    public static $arrSituacao = array(
        self::SITUACAO_EXECUCAO_SUCESSO => '<p class="alert-success">Sucesso</p>',
        self::SITUACAO_EXECUCAO_ERROR => '<p class="alert-danger">Error</p>',
    );

    /**
     * @var integer $idHistoricoExecucao
     *
     * @ORM\Column(name="id_historico_execucao", columnDefinition="INTEGER")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="executequery.seq_historico_execucao", initialValue=1, allocationSize=1)
     */
    private $idHistoricoExecucao;

    /**
     * @var text $dsQuery
     *
     * @ORM\Column(name="ds_query", type="text", nullable=false)
     */
    private $dsQuery;

    /**
     * @var text $dsResultado
     *
     * @ORM\Column(name="ds_resultado", type="text", nullable=false)
     */
    private $dsResultado;

    /**
     * @var text $dsParametro
     *
     * @ORM\Column(name="ds_parametro", type="text", nullable=false)
     */
    private $dsParametro;

    /**
     * @var datetime $dtExecucao
     *
     * @ORM\Column(name="dt_execucao", type="string", nullable=false)
     */
    private $dtExecucao;

    /**
     * @var integer $dsUsuarioExecucao
     *
     * @ORM\Column(name="ds_usuario_execucao", type="string", length=255, nullable=false)
     */
    private $dsUsuarioExecucao;

    /**
     * @var InepZend\Module\Executor\Entity\Query
     *
     * @ORM\Column(name="id_query", type="integer", nullable=false)
     */
    private $idQuery;

    /**
     * @var boolean $inAtivo
     *
     * @ORM\Column(name="co_situacao", type="boolean", nullable=false)
     */
    private $coSituacao;

    /**
     * Get idHistoricoExecucao
     *
     * @return integer
     */
    public function getIdHistoricoExecucao()
    {
        return $this->idHistoricoExecucao;
    }

    /**
     * Set $idHistoricoExecucao
     *
     * @param int $idHistoricoExecucao
     * @return HistoricoExecucao
     */
    public function setIdHistoricoExecucao($idHistoricoExecucao)
    {
        $this->idHistoricoExecucao = $idHistoricoExecucao;
        return $this;
    }

    /**
     * Set dsQuery
     *
     * @param text $dsQuery
     * @return HistoricoExecucao
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
     * Set dsResultado
     *
     * @param text $dsResultado
     * @return HistoricoExecucao
     */
    public function setDsResultado($dsResultado)
    {
        $this->dsResultado = $dsResultado;
        return $this;
    }

    /**
     * Get dsResultado
     *
     * @return text
     */
    public function getDsResultado()
    {
        return $this->dsResultado;
    }

    /**
     * Set dsParametro
     *
     * @param text $dsParametro
     * @return HistoricoExecucao
     */
    public function setDsParametro($dsParametro)
    {
        $this->dsParametro = $dsParametro;
        return $this;
    }

    /**
     * Get dsParametro
     *
     * @return text
     */
    public function getDsParametro()
    {
        return $this->dsParametro;
    }

    /**
     * Set dtExecucao
     *
     * @param datetime $dtExecucao
     * @return HistoricoExecucao
     */
    public function setDtExecucao($dtExecucao)
    {
        $this->dtExecucao = $dtExecucao;
        return $this;
    }

    /**
     * Get dtExecucao
     *
     * @return datetime
     */
    public function getDtExecucao()
    {
        return Date::convertDate($this->dtExecucao, "d/m/Y H:i:s");
    }

    /**
     * Set dsUsuarioExecucao
     *
     * @param integer $dsUsuarioExecucao
     * @return HistoricoExecucao
     */
    public function setDsUsuarioExecucao($dsUsuarioExecucao)
    {
        $this->dsUsuarioExecucao = $dsUsuarioExecucao;
        return $this;
    }

    /**
     * Get dsUsuarioExecucao
     *
     * @return integer
     */
    public function getDsUsuarioExecucao()
    {
        return $this->dsUsuarioExecucao;
    }

    /**
     * Set idQuery
     *
     * @param InepZend\Module\Executor\Entity\Query $idQuery
     * @return HistoricoExecucao
     */
    public function setIdQuery($idQuery = null)
    {
        $this->idQuery = $idQuery;
        return $this;
    }

    /**
     * Get idQuery
     *
     * @return InepZend\Module\Executor\Entity\Query
     */
    public function getIdQuery()
    {
        return $this->idQuery;
    }

    /**
     * Set coSituacao
     *
     * @param boolean $coSituacao
     * @return Query
     */
    public function setCoSituacao($coSituacao)
    {
        $this->coSituacao = $coSituacao;
        return $this;
    }

    /**
     * Get coSituacao
     *
     * @return boolean
     */
    public function getCoSituacao()
    {
        return $this->coSituacao;
    }

}
