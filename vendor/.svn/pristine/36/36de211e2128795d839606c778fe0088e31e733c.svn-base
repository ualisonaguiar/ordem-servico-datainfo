<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * ProjetoEvento
 *
 * @ORM\Table(name="CORP.VW_PROJETO_EVENTO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwProjetoEventoRepository")
 */
class VwProjetoEvento extends Entity
{

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_ETAPA", type="integer", nullable=false)
     */
    protected $coEtapa;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_EVENTO", type="integer", nullable=false)
     */
    protected $coEvento;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PROGRAMA", type="integer", nullable=false)
     */
    protected $coPrograma;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_PROJETO", type="integer", nullable=false)
     */
    protected $coProjeto;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_PROGRAMA", type="string", length=500, nullable=true)
     */
    protected $dsPrograma;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_PROJETO", type="string", length=500, nullable=false)
     */
    protected $dsProjeto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_FIM_EVENTO", type="string", nullable=false)
     */
    protected $dtFimEvento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_INICIO_EVENTO", type="string", nullable=false)
     */
    protected $dtInicioEvento;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_EVENTO", type="string", length=130, nullable=false)
     */
    protected $noEvento;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PROGRAMA", type="string", length=130, nullable=false)
     */
    protected $noPrograma;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PROJETO", type="string", length=130, nullable=false)
     */
    protected $noProjeto;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_ANO", type="integer", nullable=false)
     */
    protected $nuAno;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_EDICAO", type="integer", nullable=false)
     */
    protected $nuEdicao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=true)
     */
    protected $inAtivo;

    /**
     * Set coEtapa
     *
     * @param integer $coEtapa
     *
     * @return ProjetoEvento
     */
    public function setCoEtapa($coEtapa)
    {
        $this->coEtapa = $coEtapa;
        return $this;
    }

    /**
     * Get coEtapa
     *
     * @return integer
     */
    public function getCoEtapa()
    {
        return $this->coEtapa;
    }

    /**
     * Set coEvento
     *
     * @param integer $coEvento
     *
     * @return ProjetoEvento
     */
    public function setCoEvento($coEvento)
    {
        $this->coEvento = $coEvento;
        return $this;
    }

    /**
     * Get coEvento
     *
     * @return integer
     */
    public function getCoEvento()
    {
        return $this->coEvento;
    }

    /**
     * Set coPrograma
     *
     * @param integer $coPrograma
     *
     * @return ProjetoEvento
     */
    public function setCoPrograma($coPrograma)
    {
        $this->coPrograma = $coPrograma;
        return $this;
    }

    /**
     * Get coPrograma
     *
     * @return integer
     */
    public function getCoPrograma()
    {
        return $this->coPrograma;
    }

    /**
     * Set coProjeto
     *
     * @param integer $coProjeto
     *
     * @return ProjetoEvento
     */
    public function setCoProjeto($coProjeto)
    {
        $this->coProjeto = $coProjeto;
        return $this;
    }

    /**
     * Get coProjeto
     *
     * @return integer
     */
    public function getCoProjeto()
    {
        return $this->coProjeto;
    }

    /**
     * Set dsPrograma
     *
     * @param string $dsPrograma
     *
     * @return ProjetoEvento
     */
    public function setDsPrograma($dsPrograma)
    {
        $this->dsPrograma = $dsPrograma;
        return $this;
    }

    /**
     * Get dsPrograma
     *
     * @return string
     */
    public function getDsPrograma()
    {
        return $this->dsPrograma;
    }

    /**
     * Set dsProjeto
     *
     * @param string $dsProjeto
     *
     * @return ProjetoEvento
     */
    public function setDsProjeto($dsProjeto)
    {
        $this->dsProjeto = $dsProjeto;
        return $this;
    }

    /**
     * Get dsProjeto
     *
     * @return string
     */
    public function getDsProjeto()
    {
        return $this->dsProjeto;
    }

    /**
     * Set dtFimEvento
     *
     * @param \DateTime $dtFimEvento
     *
     * @return ProjetoEvento
     */
    public function setDtFimEvento($dtFimEvento)
    {
        $this->dtFimEvento = $dtFimEvento;
        return $this;
    }

    /**
     * Get dtFimEvento
     *
     * @return \DateTime
     */
    public function getDtFimEvento()
    {
        return \InepZend\Util\Date::convertDate($this->dtFimEvento, "d/m/Y H:i:s");
    }

    /**
     * Set dtInicioEvento
     *
     * @param \DateTime $dtInicioEvento
     *
     * @return ProjetoEvento
     */
    public function setDtInicioEvento($dtInicioEvento)
    {
        $this->dtInicioEvento = $dtInicioEvento;
        return $this;
    }

    /**
     * Get dtInicioEvento
     *
     * @return \DateTime
     */
    public function getDtInicioEvento()
    {
        return \InepZend\Util\Date::convertDate($this->dtInicioEvento, "d/m/Y H:i:s");
    }

    /**
     * Set noEvento
     *
     * @param string $noEvento
     *
     * @return ProjetoEvento
     */
    public function setNoEvento($noEvento)
    {
        $this->noEvento = $noEvento;
        return $this;
    }

    /**
     * Get noEvento
     *
     * @return string
     */
    public function getNoEvento()
    {
        return $this->noEvento;
    }

    /**
     * Set noPrograma
     *
     * @param string $noPrograma
     *
     * @return ProjetoEvento
     */
    public function setNoPrograma($noPrograma)
    {
        $this->noPrograma = $noPrograma;
        return $this;
    }

    /**
     * Get noPrograma
     *
     * @return string
     */
    public function getNoPrograma()
    {
        return $this->noPrograma;
    }

    /**
     * Set noProjeto
     *
     * @param string $noProjeto
     *
     * @return ProjetoEvento
     */
    public function setNoProjeto($noProjeto)
    {
        $this->noProjeto = $noProjeto;
        return $this;
    }

    /**
     * Get noProjeto
     *
     * @return string
     */
    public function getNoProjeto()
    {
        return $this->noProjeto;
    }

    /**
     * Set nuAno
     *
     * @param integer $nuAno
     *
     * @return ProjetoEvento
     */
    public function setNuAno($nuAno)
    {
        $this->nuAno = $nuAno;
        return $this;
    }

    /**
     * Get nuAno
     *
     * @return integer
     */
    public function getNuAno()
    {
        return $this->nuAno;
    }

    /**
     * Set nuEdicao
     *
     * @param integer $nuEdicao
     *
     * @return ProjetoEvento
     */
    public function setNuEdicao($nuEdicao)
    {
        $this->nuEdicao = $nuEdicao;
        return $this;
    }

    /**
     * Get nuEdicao
     *
     * @return integer
     */
    public function getNuEdicao()
    {
        return $this->nuEdicao;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return AgenciaBancaria
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

    public function getNomeEventoDataInicioFim()
    {
        return $this->getNoEvento() . ' - ' . $this->getDtInicioEvento() . ' à ' . $this->getDtFimEvento();
    }

}
