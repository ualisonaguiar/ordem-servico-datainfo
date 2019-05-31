<?php

namespace OrdemServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * @ORM\Entity(repositoryClass="OrdemServico\Entity\JustificativaPontoRepository")
 * @ORM\Table(name="tb_justificava_ponto")
 */
class JustificativaPonto extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_justificava_ponto;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_usuario;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_justificativa;

    /**
     * @ORM\Column(type="string", columnDefinition="TIME")
     * @var string
     */
    protected $hr_justificada;

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
     * @return int
     */
    public function getIdJustificavaPonto()
    {
        return $this->id_justificava_ponto;
    }

    /**
     * @param int $id_justificava_ponto
     * @return JustificativaPonto
     */
    public function setIdJustificavaPonto($id_justificava_ponto)
    {
        $this->id_justificava_ponto = $id_justificava_ponto;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param int $id_usuario
     * @return JustificativaPonto
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    /**
     * @return string
     */
    public function getDtJustificativa()
    {
        return $this->dt_justificativa;
    }

    /**
     * @param string $dt_justificativa
     * @return JustificativaPonto
     */
    public function setDtJustificativa($dt_justificativa)
    {
        $this->dt_justificativa = $dt_justificativa;
        return $this;
    }

    /**
     * @return string
     */
    public function getHrJustificada()
    {
        return $this->hr_justificada;
    }

    /**
     * @param string $hr_justificada
     * @return JustificativaPonto
     */
    public function setHrJustificada($hr_justificada)
    {
        $this->hr_justificada = $hr_justificada;
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
     * @return JustificativaPonto
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
        return Date::convertDate($this->dt_alteracao, 'd/m/Y H:i:s');
    }

    /**
     * @param string $dt_alteracao
     * @return JustificativaPonto
     */
    public function setDtAlteracao($dt_alteracao)
    {
        $this->dt_alteracao = $dt_alteracao;
        return $this;
    }
}