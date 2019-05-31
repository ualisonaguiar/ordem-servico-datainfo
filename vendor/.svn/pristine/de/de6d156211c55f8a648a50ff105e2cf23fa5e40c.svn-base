<?php

namespace InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Form\MonitoramentoEnvioFilter;
use InepZend\Module\TrocaArquivo\Common\Service\AbstractServiceFileFlow;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;

class MonitoramentoEnvio extends FormGenerator
{

    public function prepareElementsFilter($strRoute = null, $arrParamButtonRoute = null, $booPersonalInfo = false)
    {
        if (empty($strRoute))
            $strRoute = 'monitoramentoenvio';
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Filtros da Pesquisa</h3>');
        $this->setAttribute('onsubmit', 'javascript:filterPaginator("/' . $strRoute . '/ajaxPaginator"); return false;');
        $this->addSelect(array('name' => 'id_configuracao', 'label' => 'Janela do Envio', 'value_options' => $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->listConfiguracao(false, $booPersonalInfo), 'empty_option' => 'Selecione'));
        $this->addText(array('name' => 'no_arquivo', 'label' => 'Nome do Arquivo', 'placeholder' => 'Nome do Arquivo'));
        $this->addButtonSearch('filterPaginator(\'/' . $strRoute . '/ajaxPaginator\');');
        $this->addButtonClear();
        if (!empty($arrParamButtonRoute))
            $this->addButtonRoute($arrParamButtonRoute);
        $this->addHtml('</div>');
        $this->addHtml('<script type="text/javascript">
    function showFileFlow(strOperation, grid)
    {
        return flexRedirect("/' . $strRoute . '/show", grid);
    }
</script>');
        $flexigrid = new FlexigridHelper();
        $flexigrid->setRoute($strRoute);
        $flexigrid->setSortName('id_arquivo');
        $flexigrid->setSortOrder('desc');
        $flexigrid->setShowInsert(false);
        $flexigrid->setShowUpdate(false);
        $flexigrid->setShowDelete(false);
        $flexigrid->setCol('no_arquivo', 'Nome do Arquivo', 280, 'left', false);
        $flexigrid->setCol('ds_caminho', 'Caminho', 450, 'left', false);
        $flexigrid->setCol('no_configuracao', 'Janela do Envio', 340, 'left', false);
        $flexigrid->setCol('dt_envio', 'Data do Envio', 130, 'left', false);
        $flexigrid->setButton('Visualizar os andamentos deste envio dos dados', 'update', 'showFileFlow', null, true);
        $this->addHtml($flexigrid->showGrid());
        $this->setInputFilter(new MonitoramentoEnvioFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElementsShow($intIdArquivo = null, $arrData = null, $strRoute = null, $arrParamButtonRoute = null)
    {
        if (is_null($intIdArquivo))
            $intIdArquivo = (is_array(@$arrData['arquivo'][0])) ? $arrData['arquivo'][0]['id_arquivo'] : 0;
        if (empty($strRoute))
            $strRoute = 'monitoramentoenvio';
        $this->addHtml('<div style="overflow: hidden;">');
        $this->addTable(array('name' => 'arquivo', 'label' => 'Arquivo Enviado', 'title' => array('Nome do Arquivo' => array('no_arquivo', 'width: 25%;'), 'Caminho' => 'ds_caminho', 'Data do Envio' => array('dt_envio', 'width: 11%;'), 'Tamanho' => array('ds_filesize', 'width: 11%;')), 'show_no_register' => true));
        $this->addTable(array('name' => 'configuracao', 'label' => 'Janela do Envio', 'title' => array('Projeto' => array('no_projeto', 'width: 15%;'), 'Evento' => array('no_configuracao', 'width: 25%;'), 'UF' => array('sg_uf', 'width: 5%;'), 'Destino' => 'ds_destino', 'Validação Impeditiva' => array('ds_validacao_impeditiva', 'width: 11%;'), 'Prioridade' => array('ds_prioridade', 'width: 11%;')), 'show_no_register' => true));
        $this->addTable(array('name' => 'layout', 'label' => 'Layout de Validação', 'title' => array('Nome do Layout' => array('no_layout', 'width: 10%;'), 'Caminho' => array('ds_caminho', 'width: 25%;'), 'URL' => array('ds_url', 'width: 25%;'), 'Encode' => array('ds_encode', 'width: 10%;'), 'Table' => 'ds_table', 'Status' => array('no_status_layout', 'width: 11%;')), 'show_no_register' => true));
        $this->addTable(array('name' => 'interdependencia', 'label' => 'Interdependência de Layout', 'title' => array('Nome do Layout' => 'no_layout', 'Status' => array('no_status_layout', 'width: 11%;')), 'show_no_register' => true));
        $this->addTable(array('name' => 'responsavel', 'label' => 'Responsável pelo Envio', 'title' => array('Usuário Sistema' => 'no_usuario'), 'show_no_register' => true));
        $this->addTable(array('name' => 'andamento', 'label' => 'Andamento(s) do Arquivo', 'title' => array('Status' => 'tp_andamento_html', 'Data' => array('dt_andamento', 'width: 11%;')), 'show_no_register' => true));
        $this->addTable(array('name' => 'arquivoProcesso', 'label' => 'Arquivos(s) do Processo', 'title' => array('Arquivo' => 'ds_arquivo'), 'show_no_register' => true));
        $this->addTable(array('name' => 'resultadoValidacao', 'label' => 'Resultado(s) da Validação', 'title' => array('Caminho' => 'no_arquivo', 'Tipo de Validação' => array('tp_validacao', 'width: 9%;'), 'Status' => array('no_status_html', 'width: 9%;'), 'Início' => array('dt_inicio', 'width: 11%;'), 'Fim' => array('dt_fim', 'width: 11%;')), 'show_no_register' => true));
        $this->addTable(array('name' => 'erro', 'label' => 'Erro(s) Ocorrido(s)', 'title' => array('Resultado' => 'ds_resultado_html'), 'show_no_register' => true));
        $this->addTable(array('name' => 'configuracaoContato', 'label' => 'Contato(s) do(s) Envolvido(s)', 'title' => array('e-Mail' => 'ds_email'), 'show_no_register' => true));
        $this->prepareElementsButtonRoute($arrParamButtonRoute);
        $this->prepareElementsButtonFlow($strRoute, $arrData);
        $this->addButton(array('name' => 'btnRefresh', 'value' => 'Refresh', 'type' => 'button', 'attr_data' => array('ng-click' => 'locationHref(\'' . $_SERVER['REQUEST_URI'] . '\');')));
        $this->addButtonBack($strRoute);
        $this->addHtml('</div>');
        $this->setInputFilter(new MonitoramentoEnvioFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElementsButtonRoute($arrParamButtonRoute = null)
    {
        return $this->prepareElementsButton($arrParamButtonRoute, 'addButtonRoute');
    }

    public function prepareElementsButtonFlow($strRoute = null, $arrData = null)
    {
        if ((empty($strRoute)) || (!is_array($arrData)))
            return;
        $arrArquivo = end($arrArquivo = (array) @$arrData['arquivo']);
        $arrAndamento = end($arrAndamento = (array) @$arrData['andamento']);
        $arrLayout = end($arrLayout = (array) @$arrData['layout']);
        if ((!is_array($arrArquivo)) || (!is_array($arrAndamento)) || (stripos($arrAndamento['tp_andamento'], AbstractServiceFileFlow::RUNNING) === false) || (!is_array($arrLayout)) || ((integer) @$arrLayout['in_status'] == 0))
            return;
        $arrParamButtonFlow = array();
        $strFlow = reset(explode('-', $arrAndamento['tp_andamento']));
        switch ($strFlow) {
            case AbstractServiceFileFlow::PREPROCESS:
            case AbstractServiceFileFlow::PROCESS:
                $booButton = false;
                $arrResultadoValidacao = (array) @$arrData['resultadoValidacao'];
                foreach ($arrResultadoValidacao as $arrInfo) {
                    if (is_null($arrInfo['dt_fim'])) {
                        $booButton = true;
                        break;
                    }
                }
                if ($booButton) {
                    if (is_null($strTpValidacao = @$arrInfo['tp_validacao']))
                        $strTpValidacao = 'estrutural';
                    $this->addHtml('<script type="text/javascript">
    function restartFlow(strRoute, intIdConfiguracao, strPathZip, strNoArquivo, intIdArquivo)
    {
        var strUrl = "/" + strRoute + "/ajaxFileFlow";
        var arrUrlParam = new Array();
        arrUrlParam["id_configuracao"] = intIdConfiguracao;
        arrUrlParam["ds_caminho"] = strPathZip;
        arrUrlParam["no_arquivo"] = strNoArquivo;
        arrUrlParam["id_arquivo"] = intIdArquivo;
        arrUrlParam["tp_validacao"] = "' . $strTpValidacao . '";
        var mixResult = ajaxRequest(strUrl, arrUrlParam, "restartFlowAfterAjax", new Array(), undefined, undefined, true);
    }
    
    function restartFlowAfterAjax(mixData, arrParam)
    {
        if (mixData.toLowerCase() == "ok")
            alertDialog("Solicitação do reinício do andamento enviado com sucesso!", "Operação de Reiniciar Andamento", undefined, undefined, "refreshWindow();");
        else
            alertDialog("Ocorreu um erro e a operação não pôde ser realizada!", "Erro", 350, 150);
    }
</script>');
                    $arrParamButtonFlow[] = array('name' => 'btnRestartFlow', 'title' => 'Reiniciar Andamento', 'class' => 'btnDefault btnRestartFlow btn-inep', 'onclick' => 'confirmDialog(\'Deseja realmente reiniciar o andamento deste arquivo?\', \'Operação de Reiniciar Andamento\', 400, 200, \'restartFlow(\\\'' . $strRoute . '\\\', ' . $arrArquivo['id_configuracao'] . ', \\\'' . $arrArquivo['ds_caminho'] . '\\\', \\\'' . $arrArquivo['no_arquivo'] . '\\\', ' . $arrArquivo['id_arquivo'] . ');\');', 'value' => 'Reiniciar Andamento');
                }
                break;
        }
        if (!empty($arrParamButtonFlow)) {
            $this->addHtml('<script type="text/javascript">$(document).ready(function () {include_once("/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js" + strGlobalSufixJsGzip);});</script>');
            $this->prepareElementsButton($arrParamButtonFlow);
        }
    }

    private function prepareElementsButton($arrParamButton = null, $strMethod = null)
    {
        if (!is_array($arrParamButton))
            return;
        if (empty($strMethod))
            $strMethod = 'addButton';
        if (!array_key_exists(0, $arrParamButton))
            $arrParamButton = array($arrParamButton);
        foreach ($arrParamButton as $arrParam)
            $this->$strMethod($arrParam);
    }

}
