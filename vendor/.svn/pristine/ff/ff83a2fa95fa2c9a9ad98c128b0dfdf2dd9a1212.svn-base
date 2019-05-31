<?php

namespace InepZend\Module\Sqi\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\Sqi\Entity\VwQuestionarioProjeto;
use InepZend\Module\Sqi\Entity\VwQuestaoItemDependencia;

class Questionario extends FormGenerator
{

    private $arrQuestionarioProjeto = array();
    private $vwQuestaoItemDependenciaService;
    private $intCoProjeto;
    private $intCoEvento;
    private $intIdQuestionarioProjeto;
    private $intIdGrupoQuestao;
    private $intIdTxInsGrupoQuestao;
    private $intIdSubgrupoQuestao;
    private $intIdTxInsSubgrupoQuestao;
    private $intIdQuestao;
    private $booQuestaoDependencia;
    private $booItemDependencia;

    public function __construct($arrQuestionarioProjeto = array(), $intCoProjeto, $intCoEvento, $strName = null)
    {
        parent::__construct((empty($strName) ? $this->generateFormName(__CLASS__) : $strName));
        $this->arrQuestionarioProjeto = $arrQuestionarioProjeto;
        $this->vwQuestaoItemDependenciaService = $this->getService('InepZend\Module\Sqi\Service\VwQuestaoItemDependencia');
        $this->intCoProjeto = $intCoProjeto;
        $this->intCoEvento = $intCoEvento;
    }

    public function prepareElements()
    {
        foreach ($this->arrQuestionarioProjeto as $questionarioProjeto) {
            $this->addQuestionario($questionarioProjeto);
            $this->addQuestao($questionarioProjeto);
            $this->addItem($questionarioProjeto);
        }
        $this->closeDiv();
    }

    private function addQuestionario(VwQuestionarioProjeto $questionarioProjeto)
    {
        if ($this->intIdQuestionarioProjeto !== $questionarioProjeto->getIdQuestionarioProjeto()) {
            if (isset($this->intIdQuestionarioProjeto)) {
                $this->intIdQuestao = null;
                $this->intIdSubgrupoQuestao = null;
                $this->intIdGrupoQuestao = null;
                $this->closeDiv();
            }
            $this->intIdQuestionarioProjeto = $questionarioProjeto->getIdQuestionarioProjeto();
            $this->addHtml("<div id='questionario[{$this->intIdQuestionarioProjeto}]' class='questionario'>", 'openDivQuestionario');
            $this->addHtml("<p id='tituloQuestionario[{$this->intIdQuestionarioProjeto}]' class='tituloQuestionario'>{$questionarioProjeto->getNoQuestionario()}</p>", 'tituloQuestionario');
        }
        $this->addGrupoQuestao($questionarioProjeto);
        $this->addSubgrupoQuestao($questionarioProjeto);
    }

    private function addGrupoQuestao(VwQuestionarioProjeto $questionarioProjeto)
    {
        if ($this->intIdGrupoQuestao !== $questionarioProjeto->getIdGrupoQuestao() || $this->intIdTxInsGrupoQuestao !== $questionarioProjeto->getIdTxInsGrupoQuestao()) {
            if (isset($this->intIdGrupoQuestao)) {
                $this->intIdQuestao = null;
                $this->intIdSubgrupoQuestao = null;
                $this->closeDiv(3);
            }
            $this->intIdGrupoQuestao = $questionarioProjeto->getIdGrupoQuestao();
            $this->intIdTxInsGrupoQuestao = $questionarioProjeto->getIdTxInsGrupoQuestao();
            $this->addHtml("<div id='grupoQuestao[{$this->intIdQuestionarioProjeto}-{$this->intIdGrupoQuestao}]' class='grupoQuestao'>", 'openDivGrupoQuestao');
            if ($questionarioProjeto->getInExibeGrupo())
                $this->addHtml("<p id='tituloGrupoQuestao[{$this->intIdQuestionarioProjeto}-{$this->intIdGrupoQuestao}]' class='tituloGrupoQuestao'>{$questionarioProjeto->getNoGrupoQuestao()}</p>", 'tituloGrupoQuestao');
            if ($questionarioProjeto->getIdTxInsGrupoQuestao())
                $this->addHtml("<p id='instrucaoGrupoQuestao[{$this->intIdQuestionarioProjeto}-{$this->intIdGrupoQuestao}]' class='instrucaoGrupoQuestao tituloGrupoQuestao'>{$questionarioProjeto->getTxInstrucaoGrupoQuestao()}</p>", 'instrucaoGrupoQuestao');
        }
    }

    private function addSubgrupoQuestao(VwQuestionarioProjeto $questionarioProjeto)
    {
        if ($this->intIdSubgrupoQuestao !== $questionarioProjeto->getIdSubgrupoQuestao() || $this->intIdTxInsSubgrupoQuestao !== $questionarioProjeto->getIdTxInsSubgrupoQuestao()) {
            if (isset($this->intIdSubgrupoQuestao)) {
                $this->intIdQuestao = null;
                $this->closeDiv(2);
            }
            $this->intIdSubgrupoQuestao = $questionarioProjeto->getIdSubgrupoQuestao();
            $this->intIdTxInsSubgrupoQuestao = $questionarioProjeto->getIdTxInsSubgrupoQuestao();
            $this->addHtml("<div id='subgrupoQuestao[{$this->intIdQuestionarioProjeto}-{$this->intIdGrupoQuestao}-{$this->intIdSubgrupoQuestao}]' class='subgrupoQuestao'>", 'openDivSubgrupoQuestao');
            if ($questionarioProjeto->getInExibeSubgrupo())
                $this->addHtml("<p id='tituloSubgrupoQuestao[{$this->intIdQuestionarioProjeto}-{$this->intIdGrupoQuestao}-{$this->intIdSubgrupoQuestao}]' class='tituloSubgrupoQuestao'>{$questionarioProjeto->getNoSubgrupoQuestao()}</p>", 'tituloSubgrupoQuestao');
            if ($questionarioProjeto->getIdTxInsSubgrupoQuestao())
                $this->addHtml("<p id='instrucaoSubgrupoQuestao[{$this->intIdQuestionarioProjeto}-{$this->intIdGrupoQuestao}-{$this->intIdSubgrupoQuestao}]' class='instrucaoSubgrupoQuestao tituloSubgrupoQuestao'>{$questionarioProjeto->getTxInstrucaoSubgrupoQuestao()}</p>", 'instrucaoSubgrupoQuestao');
        }
    }

    private function addQuestao(VwQuestionarioProjeto $questionarioProjeto)
    {
         if ($this->intIdQuestao !== $questionarioProjeto->getIdQuestao()) {
            if (isset($this->intIdQuestao))
                $this->closeDiv(1);
            
            $this->intIdQuestao = $questionarioProjeto->getIdQuestao();
            if ($arrQuestaoDependencia = $this->vwQuestaoItemDependenciaService->findBy(array('idQuestaoItemConfiguracao' => $questionarioProjeto->getIdQuestaoItemConfiguracao(), 'coProjeto' => $this->intCoProjeto, 'coEvento' => $this->intCoEvento, 'tpDependencia' => VwQuestaoItemDependencia::TIPO_DEPENDENCIA_QUESTAO)))
                $this->addDependencia($arrQuestaoDependencia);
            
            $this->addHtml("<div id='questao[{$this->intIdQuestionarioProjeto}-{$this->intIdGrupoQuestao}-{$this->intIdSubgrupoQuestao}-{$this->intIdQuestao}]' class='questao'>", 'openDivQuestao');
            $this->addHtml("<p id='tituloQuestao[{$this->intIdQuestionarioProjeto}-{$this->intIdGrupoQuestao}-{$this->intIdSubgrupoQuestao}-{$this->intIdQuestao}]' class='tituloQuestao' title='{$questionarioProjeto->getTxLegendaQuestao()}'> <span class='numeracaoQuestao'>{$questionarioProjeto->getNuOrdemGrupo()}.{$questionarioProjeto->getNuOrdemSubgrupo()}.{$questionarioProjeto->getNuOrdemQuestao()}</span> - {$questionarioProjeto->getTxQuestao()}</p>", 'tituloQuestao');
        }
    }

    private function addDependencia($arrQuestaoDependencia, $intTpDependencia = VwQuestaoItemDependencia::TIPO_DEPENDENCIA_QUESTAO)
    {
        if ($intTpDependencia == VwQuestaoItemDependencia::TIPO_DEPENDENCIA_QUESTAO) {
            $this->booQuestaoDependencia = true;
            $strPrefixClass = 'questao_';
            $strPrefixId = 'idQuestaoItemPai_';
        } elseif ($intTpDependencia == VwQuestaoItemDependencia::TIPO_DEPENDENCIA_ITEM) {
            $this->booItemDependencia = true;
            $strPrefixClass = 'item_questao_';
            $strPrefixId = 'idQuestaoItemPai_item_';
        }
        
        foreach ($arrQuestaoDependencia as $questaoItemDependencia) {
            $questaoItemConfigPai = $this->getService('InepZend\Module\Sqi\Service\VwQuestionarioProjeto')->findBy(array('idQuestaoItemConfiguracao' => $questaoItemDependencia->getIdQuestaoItemConfigPai(), 'coProjeto' => $this->intCoProjeto, 'coEvento' => $this->intCoEvento))[0];
            $arrIdQuestao[] = $strPrefixClass .$questaoItemConfigPai->getIdQuestao();
            $arrIdQuestaoItemConfigPai[] = $strPrefixId . $questaoItemConfigPai->getIdQuestionarioQuestaoItem();
        }
        $strClass = implode(' ', array_unique($arrIdQuestao)) .' '.  implode(' ', array_unique($arrIdQuestaoItemConfigPai));
        $questaoItemDependencia = $arrQuestaoDependencia[0];
        $strAbreFieldset = "<fieldset class='{$strClass}' ";
        switch ($questaoItemDependencia->getTpAcao()) {
            case VwQuestaoItemDependencia::TIPO_ACAO_HABILITAR:
                $this->addHtml($strAbreFieldset . "habilitar='true' disabled='true'>", 'abreFieldset');
                break;
            case VwQuestaoItemDependencia::TIPO_ACAO_DESABILITAR:
                $this->addHtml($strAbreFieldset . "desabilitar='true'>", 'abreFieldset');
                break;
            case VwQuestaoItemDependencia::TIPO_ACAO_EXIBIR:
               $this->addHtml($strAbreFieldset . "exibir='true' disabled='true' style='display: none;'>", 'abreFieldset');
               break;
            case VwQuestaoItemDependencia::TIPO_ACAO_OCULTAR:
                $this->addHtml($strAbreFieldset . "ocultar='true'>", 'abreFieldset');
                break;
        }
    }

    private function addItem(VwQuestionarioProjeto $questionarioProjeto)
    {
        if ($arrQuestaoItemDependencia = $this->vwQuestaoItemDependenciaService->findBy(array('idQuestaoItemConfiguracao' => $questionarioProjeto->getIdQuestaoItemConfiguracao(), 'coProjeto' => $this->intCoProjeto, 'coEvento' => $this->intCoEvento, 'tpDependencia' => VwQuestaoItemDependencia::TIPO_DEPENDENCIA_ITEM))) {
            $this->addDependencia($arrQuestaoItemDependencia, VwQuestaoItemDependencia::TIPO_DEPENDENCIA_ITEM);
        }
        $strTxItem = ($questionarioProjeto->getIdItem() ? $questionarioProjeto->getTxItem() : ' ');
        switch ($questionarioProjeto->getNoIdentificador()) {
            case VwQuestionarioProjeto::TIPO_QUESTAO_ITEM_TETX:
//                $this->addText(array('name' => $questionarioProjeto->getIdQuestaoItemConfiguracao(), 'class' => 'item', 'label' => $strTxItem, 'title' => $questionarioProjeto->getTxLegendaItem()));
                $this->addText(array('name' => $questionarioProjeto->getIdQuestionarioQuestaoItem(), 'class' => 'item', 'label' => $strTxItem, 'title' => $questionarioProjeto->getTxLegendaItem()));
                break;
            case VwQuestionarioProjeto::TIPO_QUESTAO_ITEM_TEXTAREA:
//                $this->addTextarea(array('name' => $questionarioProjeto->getIdQuestaoItemConfiguracao(), 'class' => 'item', 'label' => $strTxItem, 'title' => $questionarioProjeto->getTxLegendaItem()));
                $this->addTextarea(array('name' => $questionarioProjeto->getIdQuestionarioQuestaoItem(), 'class' => 'item', 'label' => $strTxItem, 'title' => $questionarioProjeto->getTxLegendaItem()));
                break;
            case VwQuestionarioProjeto::TIPO_QUESTAO_ITEM_RADIOBUTTON:
//                $this->addHtml("<input type='radio' name='respostaRadio[{$questionarioProjeto->getIdQuestao()}]' id='{$questionarioProjeto->getIdQuestaoItemConfiguracao()}' class='questao_{$questionarioProjeto->getIdQuestao()}' value='{$questionarioProjeto->getIdQuestaoItemConfiguracao()}' title='{$questionarioProjeto->getTxLegendaItem()}'>");
//                $this->addHtml("<label class='lblCheck' for='{$questionarioProjeto->getIdQuestaoItemConfiguracao()}' title='{$questionarioProjeto->getTxLegendaItem()}'>" . $questionarioProjeto->getTxItem() . "</label>");
                $this->addHtml("<input type='radio' name='respostaRadio[{$questionarioProjeto->getIdQuestao()}]' id='{$questionarioProjeto->getIdQuestionarioQuestaoItem()}' class='questao_{$questionarioProjeto->getIdQuestao()}' value='{$questionarioProjeto->getIdQuestionarioQuestaoItem()}' title='{$questionarioProjeto->getTxLegendaItem()}'>");
                $this->addHtml("<label class='lblCheck' for='{$questionarioProjeto->getIdQuestionarioQuestaoItem()}' title='{$questionarioProjeto->getTxLegendaItem()}'>" . $questionarioProjeto->getTxItem() . "</label>");
                $this->addHtml('<br />');
                break;
            case VwQuestionarioProjeto::TIPO_QUESTAO_ITEM_CHECKBOX:
//                $this->addCheckbox(array('name' => $questionarioProjeto->getIdQuestaoItemConfiguracao(), 'class' => 'item', 'use_hidden_element' => false, 'title' => $questionarioProjeto->getTxLegendaItem(), 'value' => $questionarioProjeto->getIdQuestaoItemConfiguracao()));
//                $this->addHtml("<label for='{$questionarioProjeto->getIdQuestaoItemConfiguracao()}' class = 'lblCheck' title='{$questionarioProjeto->getTxLegendaItem()}'>" . $questionarioProjeto->getTxItem() . "</label>");
                $this->addCheckbox(array('name' => $questionarioProjeto->getIdQuestionarioQuestaoItem(), 'class' => 'item', 'use_hidden_element' => false, 'title' => $questionarioProjeto->getTxLegendaItem(), 'checked_value' => $questionarioProjeto->getIdQuestionarioQuestaoItem()));
                $this->addHtml("<label for='{$questionarioProjeto->getIdQuestionarioQuestaoItem()}' class = 'lblCheck' title='{$questionarioProjeto->getTxLegendaItem()}'>" . $questionarioProjeto->getTxItem() . "</label>");
                $this->addHtml('<br />');
                break;
            default:
                break;
        }
        if ($this->booItemDependencia) {
            $this->addHtml('</fieldset>', 'fechaFieldset');
            $this->booItemDependencia = null;
        }
    }

    private function closeDiv($intDeep = 4)
    {
        $arrDivName = array('closeDivQuestao', 'closeDivSubgrupoQuestao', 'closeDivGrupoQuestao', 'closeDivQuestionario');
        foreach ($arrDivName as $intKey => $strDivName) {
            if ($intDeep >= ($intKey + 1)) {
                $this->addHtml('</div>', $strDivName);
                if ($strDivName == 'closeDivQuestao' && $this->booQuestaoDependencia) {
                    $this->booQuestaoDependencia = null;
                    $this->addHtml('</fieldset>', 'closeFildsetDependencia');
                }
            }
                
        }
    }

}
