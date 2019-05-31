<?php

namespace OrdemServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @package OrdemServico\Entity
 * @ORM\Entity(repositoryClass="OrdemServico\Entity\ArquivoPontoUsuarioRepository")
 * @ORM\Table(name="tb_arquivo_ponto_usuario")
 */
class ArquivoPontoUsuario extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_arquivo_ponto_usuario;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_arquivo_ponto;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_usuario;

    /**
     * @ORM\Column(type="string", columnDefinition="DATE")
     * @var string
     */
    protected $dt_ponto;

    /**
     * @ORM\Column(type="string", columnDefinition="TIME")
     * @var string
     */
    protected $hr_ponto;

    /**
     * @return int
     */
    public function getIdArquivoPontoUsuario()
    {
        return $this->id_arquivo_ponto_usuario;
    }

    /**
     * @param int $id_arquivo_ponto_usuario
     * @return ArquivoPontoUsuario
     */
    public function setIdArquivoPontoUsuario($id_arquivo_ponto_usuario)
    {
        $this->id_arquivo_ponto_usuario = $id_arquivo_ponto_usuario;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdArquivoPonto()
    {
        return $this->id_arquivo_ponto;
    }

    /**
     * @param int $id_arquivo_ponto
     * @return ArquivoPontoUsuario
     */
    public function setIdArquivoPonto($id_arquivo_ponto)
    {
        $this->id_arquivo_ponto = $id_arquivo_ponto;
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
     * @return ArquivoPontoUsuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    /**
     * @return string
     */
    public function getDtPonto()
    {
        return $this->dt_ponto;
    }

    /**
     * @param string $dt_ponto
     * @return ArquivoPontoUsuario
     */
    public function setDtPonto($dt_ponto)
    {
        $this->dt_ponto = $dt_ponto;
        return $this;
    }

    /**
     * @return string
     */
    public function getHrPonto()
    {
        return $this->hr_ponto;
    }

    /**
     * @param string $hr_ponto
     * @return ArquivoPontoUsuario
     */
    public function setHrPonto($hr_ponto)
    {
        $this->hr_ponto = $hr_ponto;
        return $this;
    }
}
