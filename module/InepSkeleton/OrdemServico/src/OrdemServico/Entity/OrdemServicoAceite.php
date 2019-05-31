<?php

namespace OrdemServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="OrdemServico\Entity\OrdemServicoAceiteRepository")
 * @ORM\Table(name="tb_ordem_servico_aceite")
 */
class OrdemServicoAceite extends Entity
{
    const CO_ACEITE_PREPOSTO = 1;
    const CO_ACEITE_FISCAL_REQUISITANTE = 2;
    const CO_ACEITE_FISCAL_TECNICO = 3;
    const CO_ACEITE_GESTOR_CONTRATO = 4;
    const CO_NIVEL_ACEITE_INICIAL = 1;
    const CO_NIVEL_ACEITE_FINAL = 2;

    public static $arrGestao = [
        self::CO_ACEITE_PREPOSTO => 'Preposto',
        self::CO_ACEITE_FISCAL_REQUISITANTE => 'Fiscal Requisitante',
        self::CO_ACEITE_FISCAL_TECNICO => 'Fiscal Técnico',
        self::CO_ACEITE_GESTOR_CONTRATO => 'Gestor do Contrato',
    ];

    public static $arrNivelAceite = [
        self::CO_NIVEL_ACEITE_INICIAL => 'Inicial',
        self::CO_NIVEL_ACEITE_FINAL => 'Final',
    ];

    /**
     * @ORM\Id
     * @ORM\Column(name="id_ordem_servico", type="integer", columnDefinition="INTEGER")
     * @var int
     */
    private $idOrdemServico;

    /**
     * @ORM\Id
     * @ORM\Column(name="id_usuario_gestao", type="integer", columnDefinition="INTEGER")
     */
    private $idUsuarioGestao;

    /**
     * @ORM\Id
     * @ORM\Column(name="in_gestao", type="integer", columnDefinition="INTEGER")
     */
    private $inGestao;

    /**
     * @ORM\Id
     * @ORM\Column(name="in_situacao", type="integer", columnDefinition="INTEGER")
     */
    private $inSituacao;

    /**
     * @ORM\Column(name="id_usuario_alteracao", type="integer", columnDefinition="INTEGER")
     */
    private $idUsuarioAlteracao;

    /**
     * @var \DateTime $dtAlteracao
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", nullable=false)
     */
    private $dtAlteracao;

    /**
     * @return string
     */
    public function getIdOrdemServico()
    {
        return $this->idOrdemServico;
    }

    /**
     * @param int $idOrdemServico
     * @return OrdemServicoAceite
     */
    public function setIdOrdemServico($idOrdemServico)
    {
        $this->idOrdemServico = $idOrdemServico;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdUsuarioGestao()
    {
        return $this->idUsuarioGestao;
    }

    /**
     * @param int $idUsuarioGestao
     * @return OrdemServicoAceite
     */
    public function setIdUsuarioGestao($idUsuarioGestao)
    {
        $this->idUsuarioGestao = $idUsuarioGestao;
        return $this;
    }

    /**
     * @return string
     */
    public function getInGestao()
    {
        return $this->inGestao;
    }

    /**
     * @param string $inGestao
     * @return OrdemServicoAceite
     */
    public function setInGestao($inGestao)
    {
        $this->inGestao = $inGestao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInSituacao()
    {
        return $this->inSituacao;
    }

    /**
     * @param mixed $inSituacao
     * @return OrdemServicoAceite
     */
    public function setInSituacao($inSituacao)
    {
        $this->inSituacao = $inSituacao;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->idUsuarioAlteracao;
    }

    /**
     * @param int $idUsuarioAlteracao
     * @return OrdemServicoAceite
     */
    public function setIdUsuarioAlteracao($idUsuarioAlteracao)
    {
        $this->idUsuarioAlteracao = $idUsuarioAlteracao;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDtAlteracao()
    {
        return $this->dtAlteracao;
    }

    /**
     * @param \DateTime $dt_alteracao
     * @return OrdemServicoAceite
     */
    public function setDtAlteracao($dt_alteracao)
    {
        $this->dtAlteracao = $dt_alteracao;
        return $this;
    }
}
