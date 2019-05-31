<?php

namespace OrdemServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @package OrdemServico\Entity
 * @ORM\Entity(repositoryClass="OrdemServico\Entity\ArquivoPontoRepository")
 * @ORM\Table(name="tb_arquivo_ponto")
 */
class ArquivoPonto extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_arquivo_ponto;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $in_linha;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(600)", nullable=true)
     * @var string
     */
    protected $ds_linha;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_usuario_alteracao;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_alteracao;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var string
     */
    protected $tp_migracao;

    /**
     * @return int
     */
    public function getIdArquivoPonto()
    {
        return $this->id_arquivo_ponto;
    }

    /**
     * @param int $id_arquivo_ponto
     * @return ArquivoPonto
     */
    public function setIdArquivoPonto($id_arquivo_ponto)
    {
        $this->id_arquivo_ponto = $id_arquivo_ponto;
        return $this;
    }

    /**
     * @return int
     */
    public function getInLinha()
    {
        return $this->in_linha;
    }

    /**
     * @param int $in_linha
     * @return ArquivoPonto
     */
    public function setInLinha($in_linha)
    {
        $this->in_linha = $in_linha;
        return $this;
    }

    /**
     * @return string
     */
    public function getDsLinha()
    {
        return $this->ds_linha;
    }

    /**
     * @param string $ds_linha
     * @return ArquivoPonto
     */
    public function setDsLinha($ds_linha)
    {
        $this->ds_linha = $ds_linha;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->id_usuario_alteracao;
    }

    /**
     * @param int $id_usuario_alteracao
     * @return ArquivoPonto
     */
    public function setIdUsuarioAlteracao($id_usuario_alteracao)
    {
        $this->id_usuario_alteracao = $id_usuario_alteracao;
        return $this;
    }

    /**
     * @return string
     */
    public function getDtAlteracao()
    {
        return $this->dt_alteracao;
    }

    /**
     * @param string $dt_alteracao
     * @return ArquivoPonto
     */
    public function setDtAlteracao($dt_alteracao)
    {
        $this->dt_alteracao = $dt_alteracao;
        return $this;
    }

    /**
     * @return string
     */
    public function getTpMigracao()
    {
        return $this->tp_migracao;
    }

    /**
     * @param string $tp_migracao
     * @return ArquivoPonto
     */
    public function setTpMigracao($tp_migracao)
    {
        $this->tp_migracao = $tp_migracao;
        return $this;
    }

}
