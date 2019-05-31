<?php

namespace InepZend\Module\TrocaArquivo\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\TrocaArquivo\Common\Entity\ConfiguracaoRepository")
 * @ORM\Table(name="tb_configuracao")
 */
class Configuracao extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     * @@__toString
     */
    protected $id_configuracao;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_layout;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $co_projeto;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $co_evento;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(2)")
     * @var string
     */
    protected $sg_uf;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $ds_destino;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(4)")
     * @var string
     */
    protected $ds_prioridade;

    /**
     * @ORM\Column(type="boolean", columnDefinition="BOOLEAN")
     * @var boolean
     */
    protected $in_validacao_impeditiva;

    public function getIdConfiguracao()
    {
        return $this->id_configuracao;
    }

    public function setIdConfiguracao($intIdConfiguracao = null)
    {
        $this->id_configuracao = (is_numeric($intIdConfiguracao)) ? (integer) $intIdConfiguracao : $intIdConfiguracao;
        return $this;
    }

    public function getIdLayout()
    {
        return $this->id_layout;
    }

    public function setIdLayout($intIdLayout = null)
    {
        $this->id_layout = (is_numeric($intIdLayout)) ? (integer) $intIdLayout : $intIdLayout;
        return $this;
    }

    public function getCoProjeto()
    {
        return $this->co_projeto;
    }

    public function setCoProjeto($intCoProjeto = null)
    {
        $this->co_projeto = (is_numeric($intCoProjeto)) ? (integer) $intCoProjeto : $intCoProjeto;
        return $this;
    }

    public function getCoEvento()
    {
        return $this->co_evento;
    }

    public function setCoEvento($intCoEvento = null)
    {
        $this->co_evento = (is_numeric($intCoEvento)) ? (integer) $intCoEvento : $intCoEvento;
        return $this;
    }

    public function getSgUf()
    {
        return $this->sg_uf;
    }

    public function setSgUf($strSgUf = null)
    {
        $this->sg_uf = $strSgUf;
        return $this;
    }

    public function getDsDestino()
    {
        return $this->ds_destino;
    }

    public function setDsDestino($strDsDestino = null)
    {
        $this->ds_destino = $strDsDestino;
        return $this;
    }

    public function getDsPrioridade()
    {
        return $this->ds_prioridade;
    }

    public function setDsPrioridade($strDsPrioridade = null)
    {
        $this->ds_prioridade = $strDsPrioridade;
        return $this;
    }

    public function getInValidacaoImpeditiva()
    {
        return $this->convertToIndicator($this->in_validacao_impeditiva);
    }

    public function setInValidacaoImpeditiva($booInValidacaoImpeditiva = true)
    {
        $this->in_validacao_impeditiva = $booInValidacaoImpeditiva;
        return $this;
    }

    public function getDsValidacaoImpeditiva()
    {
        return ($this->getInValidacaoImpeditiva() == 1) ? 'Sim' : 'Não';
    }

}
