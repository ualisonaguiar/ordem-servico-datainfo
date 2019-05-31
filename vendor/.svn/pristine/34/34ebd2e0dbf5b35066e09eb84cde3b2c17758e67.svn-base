<?php
namespace InepZend\Module\TrocaArquivo\Cliente\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\TrocaArquivo\Cliente\Form\ClienteFilter;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;

class Cliente extends FormGenerator
{

    public function prepareElementsPreprocessamento()
    {
        $this->addHtml('<script type="text/javascript">$(document).ready(function () {include_once("/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js" + strGlobalSufixJsGzip);});</script>');
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Dados a preprocessar</h3>');
        $this->addSelect(array(
            'name' => 'idLayout',
            'label' => 'Layout',
            'value_options' => $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')
                ->listLayout(),
            'empty_option' => 'Selecione',
            'required' => true
        ));
        $this->addFile(array(
            'required' => true
        ));
        $this->addButtonSave(null, false, null, null, null, 'Realizar o Preprocessamento', null, null, null, null, null, null, true);
        $this->addHtml('<font color="red">É recomendado <strong>NÃO</strong> realizar múltiplos preprocessamentos de forma <strong>simultânea</strong>.</font>');
        $this->addHtml('</div><div class="well"><h3>Arquivos enviados para preprocessamento</h3>');
        $this->addButton(array(
            'name' => 'btnReloadArquivo',
            'value' => 'Atualizar Arquivos',
            'onclick' => 'reloadFlexigrid(undefined, undefined, \'#tableDataArquivo\');',
            'style' => 'margin-top: -40px;'
        ));
        $this->addHtml('<div style=\'overflow: hidden; width: 100%;\'>');
        $flexigrid = new FlexigridHelper();
        $flexigrid->setId('tableDataArquivo');
        $flexigrid->setSortName('ds_path');
        $flexigrid->setSortOrder('desc');
        $flexigrid->setCol('ds_path', 'Caminho', 550, 'left', false);
        $flexigrid->setCol('ds_flow', 'Andamento Atual', 250, 'left', false);
        $flexigrid->setCol('ds_size', 'Tamanho', 120, 'center', false);
        $flexigrid->setCol('dt_create', 'Criação', 150, 'center', false);
        $flexigrid->setReloadOnLoad(true, '/cliente/ajaxArquivoPaginator');
        $this->addHtml($flexigrid->showGrid());
        $this->addHtml('</div></div><div class="well"><h3>Erros ocorridos durante o preprocessamento</h3>');
        $this->addButton(array(
            'name' => 'btnReloadErro',
            'value' => 'Atualizar Erros',
            'onclick' => 'reloadFlexigrid(undefined, undefined, \'#tableDataErro\');',
            'style' => 'margin-top: -40px;'
        ));
        $this->addHtml('<script type="text/javascript">
            function ajaxErroAccordion(arrParam)
            {
                var strUrl = "/cliente/ajaxErroAccordion";
                var arrUrlParam = new Array();
                arrUrlParam["id_erro"] = arrParam[0];
                return ajaxRequest(strUrl, arrUrlParam);
            }
        </script>');
        $this->addHtml('<div style=\'overflow: hidden; width: 100%;\'>');
        $flexigrid = new FlexigridHelper();
        $flexigrid->setId('tableDataErro');
        $flexigrid->setSortName('id_erro');
        $flexigrid->setSortOrder('desc');
        $flexigrid->setCol('id_erro', 'Número', 90, 'left', false);
        $flexigrid->setCol('dt_ocorrencia', 'Ocorrência', 930, 'center', false);
        $flexigrid->setReloadOnLoad(true, '/cliente/ajaxErroPaginator');
        $flexigrid->setJsFunctionAccordion('ajaxErroAccordion');
        $this->addHtml($flexigrid->showGrid());
        $this->addHtml('</div></div>');
        $this->setInputFilter(new ClienteFilter(__FUNCTION__));
        return $this;
    }
}
