<?php

namespace Migracao\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * @ORM\Entity(repositoryClass="Migracao\Entity\OrdemServicoRepository")
 * @ORM\Table(name="tb_ordem_servico")
 */
class OrdemServico extends Entity
{
    const CO_SITUACAO_ABERTA = 1;

    const CO_SITUACAO_FINALIZADA = 2;

    const CO_SITUACAO_ANALISE = 3;

    static $arrSituacaoDemanda = array(
        self::CO_SITUACAO_ABERTA => 'Aberta',
        self::CO_SITUACAO_ANALISE => 'Em Análise',
        self::CO_SITUACAO_FINALIZADA => 'Finalizada',
    );

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id_ordem_servico;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     * @@__toString
     */
    protected $nu_ordem_servico;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(20)")
     * @var string
     */
    protected $ds_contrato;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $ds_nome;

    /**
     * @ORM\Column(type="string", columnDefinition="TEXT")
     * @var string
     */
    protected $ds_justificativa;

    /**
     * @ORM\Column(type="string", columnDefinition="string")
     * @var string
     */
    protected $dt_prazo;

    /**
     * @ORM\Column(type="string", columnDefinition="TEXT")
     * @var string
     */
    protected $ds_impedimento_execucao;

    /**
     * @ORM\Column(type="string", columnDefinition="TEXT")
     * @var string
     */
    protected $ds_sugestao_melhoria;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $no_fiscal_requisitante;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $no_fiscal_tecnico;

    /**
     * @ORM\Column(type="string", columnDefinition="string")
     * @var string
     */
    protected $dt_emissao;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $no_gestor_contrato;

    /**
     * @ORM\Column(type="string", columnDefinition="string")
     * @var string
     */
    protected $dt_recepcao;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $no_preposto;

    /**
     * @ORM\Column(type="string", columnDefinition="TEXT")
     * @var string
     */
    protected $ds_svn;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $tp_situacao;


    /**
     * @ORM\Column(type="string", columnDefinition="TEXT")
     * @var string
     */
    protected $ds_descricao;

    /**
     *
     * @return type
     */
    public function getIdOrdemServico()
    {
        return $this->id_ordem_servico;
    }

    /**
     *
     * @param type $intIdOrdemServico
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setIdOrdemServico($intIdOrdemServico = null)
    {
        $this->id_ordem_servico = $intIdOrdemServico;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getNuOrdemServico()
    {
        return $this->nu_ordem_servico;
    }

    /**
     *
     * @param type $intNuOrdemServico
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setNuOrdemServico($intNuOrdemServico = null)
    {
        $this->nu_ordem_servico = $intNuOrdemServico;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getDsContrato()
    {
        return $this->ds_contrato;
    }

    /**
     *
     * @param type $strDsContrato
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setDsContrato($strDsContrato = null)
    {
        $this->ds_contrato = $strDsContrato;
        return $this;
    }

    public function getDsNome()
    {
        return $this->ds_nome;
    }

    /**
     *
     * @param type $strDsNome
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setDsNome($strDsNome = null)
    {
        $this->ds_nome = $strDsNome;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getDsJustificativa()
    {
        return $this->ds_justificativa;
    }

    /**
     *
     * @param type $strDsJustificativa
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setDsJustificativa($strDsJustificativa = null)
    {
        $this->ds_justificativa = $strDsJustificativa;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getDtPrazo()
    {
        return Date::convertDate($this->dt_prazo, 'd/m/Y H:i:s');
    }

    /**
     *
     * @param type $strDtPrazo
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setDtPrazo($strDtPrazo = null)
    {
        $this->dt_prazo = $strDtPrazo;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getNoFiscalRequisitante()
    {
        return $this->no_fiscal_requisitante;
    }

    /**
     *
     * @param type $strNoFiscalRequisitante
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setNoFiscalRequisitante($strNoFiscalRequisitante = null)
    {
        $this->no_fiscal_requisitante = $strNoFiscalRequisitante;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getNoFiscalTecnico()
    {
        return $this->no_fiscal_tecnico;
    }

    /**
     *
     * @param type $strNoFiscalTecnico
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setNoFiscalTecnico($strNoFiscalTecnico = null)
    {
        $this->no_fiscal_tecnico = $strNoFiscalTecnico;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getDtEmissao()
    {
        return Date::convertDate($this->dt_emissao, 'd/m/Y H:i:s');
    }

    /**
     *
     * @param type $strDtEmissao
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setDtEmissao($strDtEmissao = null)
    {
        $this->dt_emissao = $strDtEmissao;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getNoGestorContrato()
    {
        return $this->no_gestor_contrato;
    }

    /**
     *
     * @param type $strNoGestorContrato
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setNoGestorContrato($strNoGestorContrato = null)
    {
        $this->no_gestor_contrato = $strNoGestorContrato;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getDtRecepcao()
    {
        return Date::convertDate($this->dt_recepcao, 'd/m/Y H:i:s');
    }

    /**
     *
     * @param type $strDtRecepcao
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setDtRecepcao($strDtRecepcao = null)
    {
        $this->dt_recepcao = $strDtRecepcao;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getNoPreposto()
    {
        return $this->no_preposto;
    }

    /**
     *
     * @param type $strNoPreposto
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setNoPreposto($strNoPreposto = null)
    {
        $this->no_preposto = $strNoPreposto;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getDsSvn()
    {
        return $this->ds_svn;
    }

    /**
     *
     * @param type $strDsSvn
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setDsSvn($strDsSvn = null)
    {
        $this->ds_svn = $strDsSvn;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getTpSituacao()
    {
        return $this->tp_situacao;
    }

    /**
     *
     * @param type $intTpSituacao
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setTpSituacao($intTpSituacao = null)
    {
        $this->tp_situacao = $intTpSituacao;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getDsImpedimentoExecucao()
    {
        return $this->ds_impedimento_execucao;
    }

    /**
     *
     * @param type $ds_impedimento_execucao
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setDsImpedimentoExecucao($ds_impedimento_execucao = null)
    {
        $this->ds_impedimento_execucao = $ds_impedimento_execucao;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getDsSugestaoMelhoria()
    {
        return $this->ds_sugestao_melhoria;
    }

    /**
     *
     * @param type $ds_sugestao_melhoria
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setDsSugestaoMelhoria($ds_sugestao_melhoria = null)
    {
        $this->ds_sugestao_melhoria = $ds_sugestao_melhoria;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getDsDescricao()
    {
        return $this->ds_descricao;
    }

    /**
     *
     * @param type $ds_descricao
     * @return \OrdemServico\Entity\OrdemServico
     */
    public function setDsDescricao($ds_descricao = null)
    {
        $this->ds_descricao = $ds_descricao;
        return $this;
    }

}
