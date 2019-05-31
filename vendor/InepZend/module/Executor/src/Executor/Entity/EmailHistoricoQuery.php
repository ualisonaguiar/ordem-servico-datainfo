<?php

namespace InepZend\Module\Executor\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * InepZend\Module\Executor\Entity\Query
 *
 * @ORM\Entity(repositoryClass="InepZend\Module\Executor\Entity\QueryRepository")
 * @ORM\Table(name="tb_email_query")
 */
class EmailHistoricoQuery extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id_email_historico_query", type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="executequery.seq_email_historico_query", initialValue=1, allocationSize=1)
     * @var int
     */
    private $idEmailHistoricoQuery;

    /**
     * @var InepZend\Module\Executor\Entity\Email
     *
     * @ORM\Column(name="id_email", type="integer", nullable=false)
     */
    private $idEmail;

    /**
     * @var InepZend\Module\Executor\Entity\HistoricoExecucao
     *
     * @ORM\Column(name="id_historico_execucao", type="integer", nullable=false)
     */
    private $idHistoricoExecucao;


    /**
     * Get idHistoricoQuery
     *
     * @return integer
     */
    public function getIdEmailHistoricoQuery()
    {
        return $this->idEmailHistoricoQuery;
    }

    /**
     * Set idEmailHistoricoQuery
     *
     * @param string $idEmailHistoricoQuery
     * @return EmailQuery
     */
    public function setIdEmailHistoricoQuery($idEmailHistoricoQuery)
    {
        $this->idEmailHistoricoQuery = $idEmailHistoricoQuery;
        return $this;
    }

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
}
