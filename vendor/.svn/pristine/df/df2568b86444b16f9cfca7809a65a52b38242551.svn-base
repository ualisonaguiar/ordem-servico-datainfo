<?php
namespace InepZend\Module\TrocaArquivo\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\TrocaArquivo\Common\Entity\IlhaDadoRepository")
 * @ORM\Table(name="tb_ilha_dado")
 */
class IlhaDado extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var int
     */
    protected $id_ilha_dado;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(400)")
     *
     * @@__toString
     * 
     * @var string
     */
    protected $no_ilha_dado;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(4000)")
     *
     * @var string
     */
    protected $ds_consulta;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(1)")
     *
     * @var string
     */
    protected $in_cache;

    public function getIdIlhaDado()
    {
        return $this->id_ilha_dado;
    }

    public function setIdIlhaDado($intIdIlhaDado = null)
    {
        $this->id_ilha_dado = (is_numeric($intIdIlhaDado)) ? (integer) $intIdIlhaDado : $intIdIlhaDado;
        return $this;
    }

    public function getNoIlhaDado()
    {
        return $this->no_ilha_dado;
    }

    public function setNoIlhaDado($strNoIlhaDado = null)
    {
        $this->no_ilha_dado = $strNoIlhaDado;
        return $this;
    }

    public function getDsConsulta()
    {
        return $this->ds_consulta;
    }

    public function setDsConsulta($strDsConsulta = null)
    {
        $this->ds_consulta = $strDsConsulta;
        return $this;
    }

    public function getInCache()
    {
        return $this->in_cache;
    }

    public function setInCache($strInCache = null)
    {
        $this->in_cache = $strInCache;
        return $this;
    }
    
    public function getInCacheText()
    {
        return (empty($this->in_cache)) ? 'Não' : 'Sim';
    }
}
