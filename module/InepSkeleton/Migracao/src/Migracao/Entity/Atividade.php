<?php

namespace Migracao\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="Migracao\Entity\AtividadeRepository")
 * @ORM\Table(name="tb_atividade")
 */
class Atividade extends Entity
{
    const CO_ASSESSORIA_ARQUITETURA = 'arquitetura';
    const CO_ASSESSORIA_NEGOCIO = 'negocio';
    const CO_ASSESSORIA_NEGOCIO_ARQUITETURA = 'arquitetura/negocio';

    static $arrAreaAssesoria = array(
        self::CO_ASSESSORIA_ARQUITETURA => 'ANÁLISE DE ARQUITETURA DE SISTEMAS E BI',
        self::CO_ASSESSORIA_NEGOCIO => 'ANÁLISE DE NEGÓCIO PARA SISTEMAS',
        self::CO_ASSESSORIA_NEGOCIO_ARQUITETURA => 'ANÁLISE DE ARQUITETURA DE SISTEMAS E BI E NEGÓCIO',
    );

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id_atividade;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(4)")
     * @var string
     */
    protected $co_atividade;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(500)")
     * @var string
     * @@__toString
     */
    protected $no_atividade;

    /**
     * @ORM\Column(type="string", columnDefinition="TEXT")
     * @var string
     */
    protected $ds_descricao;

    /**
     * @ORM\Column(type="integer", columnDefinition="FLOAT")
     * @var int
     */
    protected $vl_baixo_definido;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $ds_area_assessoria;

    public function getIdAtividade()
    {
        return $this->id_atividade;
    }

    public function setIdAtividade($intIdAtividade = null)
    {
        $this->id_atividade = (is_numeric($intIdAtividade)) ? (integer) $intIdAtividade : $intIdAtividade;
        return $this;
    }

    public function getCoAtividade()
    {
        return $this->co_atividade;
    }

    public function setCoAtividade($strCoAtividade = null)
    {
        $this->co_atividade = $strCoAtividade;
        return $this;
    }

    public function getNoAtividade()
    {
        return $this->no_atividade;
    }

    public function setNoAtividade($strNoAtividade = null)
    {
        $this->no_atividade = $strNoAtividade;
        return $this;
    }

    public function getDsDescricao()
    {
        return $this->ds_descricao;
    }

    public function setDsDescricao($strDsDescricao = null)
    {
        $this->ds_descricao = $strDsDescricao;
        return $this;
    }

    public function getVlBaixoDefinido()
    {
        return $this->vl_baixo_definido;
    }

    public function setVlBaixoDefinido($floVlBaixoDefinido = null)
    {
        $this->vl_baixo_definido = (is_numeric($floVlBaixoDefinido)) ? (float) $floVlBaixoDefinido : $floVlBaixoDefinido;
        return $this;
    }

    public function getDsAreaAssessoria()
    {
        return $this->ds_area_assessoria;
    }

    public function setDsAreaAssessoria($strDsAreaAssessoria = null)
    {
        $this->ds_area_assessoria = $strDsAreaAssessoria;
        return $this;
    }

    public function getCodigoAtividadeDescricao()
    {
        return $this->getCoAtividade() . ' - ' . $this->getNoAtividade();
    }
}
