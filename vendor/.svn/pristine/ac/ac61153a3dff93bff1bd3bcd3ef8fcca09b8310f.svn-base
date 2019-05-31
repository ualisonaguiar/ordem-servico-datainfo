<?php

namespace InepZend\Module\Crontab\AdminCron\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\Crontab\AdminCron\Form\AdminCronFilter;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;
use InepZend\Util\ArrayCollection;

class AdminCron extends FormGenerator
{

    public function prepareElementsFilter()
    {
        $strRoute = 'admincron';
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Filtros da Pesquisa</h3>');
        $this->setAttribute('onsubmit', 'javascript:filterPaginator("/' . $strRoute . '/ajaxPaginator"); return false;');
        $this->addSelect(array('name' => 'in_ativo', 'label' => 'Status', 'value_options' => self::fetchPairsStatus(), 'empty_option' => 'Selecione'));
        $this->addUrl(array('name' => 'ds_url'));
        $this->addButtonSearch('filterPaginator(\'/' . $strRoute . '/ajaxPaginator\');');
        $this->addButtonClear();
        $this->addHtml('</div>');
        $flexigrid = new FlexigridHelper();
        $flexigrid->setRoute($strRoute);
        $flexigrid->setSortName('id_cron');
        $flexigrid->setSortOrder('desc');
        $flexigrid->setShowDelete(false);
        $flexigrid->setColUpdate(true);
        $flexigrid->setCol('no_cron', 'Nome da Cron', 340, 'left', false);
        $flexigrid->setCol('ds_url', 'URL', 600, 'left', false);
        $flexigrid->setCol('in_ativo', 'Status', 130, 'center', false);
        $flexigrid->setCol('dt_cadastro', 'Data do Cadastro', 130, 'left', false);
        $this->addHtml($flexigrid->showGrid());
        $this->setInputFilter(new AdminCronFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElements()
    {
        $this->addHtml('<script type="text/javascript">$(document).ready(function () {include_once("/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js" + strGlobalSufixJsGzip);});</script>');
        $this->addHtml('<div style="overflow: hidden;"><div class="well" style="overflow: hidden;"><h3>Informações da Cron</h3>');
        $this->addHidden(array('name' => 'id_cron'));
        $this->addHidden(array('name' => 'dt_cadastro'));
        $this->addRadio(array('name' => 'in_ativo', 'label' => 'Status', 'value_options' => self::fetchPairsStatus(), 'value' => 1, 'required' => true));
        $this->addText(array('name' => 'no_cron', 'label' => 'Nome da Cron', 'placeholder' => 'Nome da Cron', 'required' => true));
        $this->addUrl(array('name' => 'ds_url', 'required' => true));
        $this->addHtml('</div>');
        $arrElementForm = array(
            'nu_mes' => array(
                'type' => 'Select',
                'label' => 'Mês',
                'value_options' => self::fetchPairsMounth(),
                'empty_option' => 'Selecione',
                'attr_data' => array('domain' => 'periodicidade'),
                'style' => 'float: left;',
                'group_style' => 'width: 15%;',
            ),
            'nu_dia_semana' => array(
                'type' => 'Select',
                'label' => 'Dia da Semana',
                'value_options' => self::fetchPairsWeekday(),
                'empty_option' => 'Selecione',
                'attr_data' => array('domain' => 'periodicidade'),
                'style' => 'float: left;',
                'group_style' => 'width: 15%;',
            ),
            'nu_dia' => array(
                'type' => 'Select',
                'label' => 'Dia',
                'value_options' => self::fetchPairsDay(),
                'empty_option' => 'Selecione',
                'attr_data' => array('domain' => 'periodicidade'),
                'style' => 'float: left;',
                'group_style' => 'width: 15%;',
            ),
            'nu_hora' => array(
                'type' => 'Select',
                'label' => 'Hora',
                'value_options' => self::fetchPairsHour(),
                'empty_option' => 'Selecione',
                'attr_data' => array('domain' => 'periodicidade'),
                'style' => 'float: left;',
                'group_style' => 'width: 15%;',
            ),
            'nu_minuto' => array(
                'type' => 'Select',
                'label' => 'Minuto',
                'value_options' => self::fetchPairsMinute(),
                'empty_option' => 'Selecione',
                'attr_data' => array('domain' => 'periodicidade'),
                'group_style' => 'width: 15%; float: left;',
            ),
        );
        $arrButton = array(
            array(
                'type' => 'Button',
                'title' => 'Adicionar Período',
                'onclick' => 'insertIntoCrud(\'periodicidade\');',
            ),
        );
        $this->addHtml('<div class="well" style="overflow: hidden;"><div style="overflow: hidden;">');
        $this->addFormCrud('Periodicidade', $arrElementForm, $arrButton, array(), '', 'width: 84%; float: left;', 'margin-top: 55px;');
        $this->addHtml('</div>');
        $this->addTable(array('name' => 'periodicidade', 'title' => array('Mês' => array('nu_mes', 'width: 15%;'), 'Dia da Semana' => array('nu_dia_semana', 'width: 15%;'), 'Dia' => array('nu_dia', 'width: 15%;'), 'Hora' => array('nu_hora', 'width: 15%;'), 'Minuto' => array('nu_minuto', 'width: 15%;')), 'icon' => array(array('class' => 'fa fa-trash', 'title' => 'Excluir Período', 'onclick' => 'removeFromCrud(this);'))));
        $this->addHtml('</div>');
        $flexigrid = new FlexigridHelper();
        $flexigrid->setSortName('id_andamento');
        $flexigrid->setSortOrder('desc');
        $flexigrid->setShowInsert(false);
        $flexigrid->setShowUpdate(false);
        $flexigrid->setShowDelete(false);
        $flexigrid->setCol('id_periodo', 'Periodicidade', 540, 'left', false);
        $flexigrid->setCol('tp_andamento', 'Status', 540, 'left', false);
        $flexigrid->setCol('dt_andamento', 'Data', 130, 'left', false);
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Andamento</h3>' . $flexigrid->showGrid() . '</div>');
        $this->addHtml('<script type="text/javascript">
            function setCriteriaAndamento()
            {
                var hiddenIdCron = getObject("id_cron");
                if ((hiddenIdCron != undefined) && (hiddenIdCron.value != "")) {
                    var arrUrlParam = new Array();
                    arrUrlParam["id_cron"] = hiddenIdCron.value;
                    setParamIntoInputHidden(arrUrlParam);
                }
                return reloadFlexigrid("/admincron/ajaxPaginatorAndamento");
            }
            execFunctionOnLoadEvent("setCriteriaAndamento();");
        </script>');
        $this->addButtonSave();
        $this->addButtonBack('admincron');
        $this->addHtml('</div>');
        $this->setInputFilter(new AdminCronFilter(__FUNCTION__));
        return $this;
    }

    private static function fetchPairsStatus()
    {
        return array(
            1 => 'Ativo',
            0 => 'Inativo',
        );
    }

    private static function fetchPairsWeekday()
    {
        return self::fetchPairs(6, 0);
    }

    private static function fetchPairsMounth()
    {
        return self::fetchPairs(12);
    }

    private static function fetchPairsDay()
    {
        return self::fetchPairs(31);
    }

    private static function fetchPairsHour()
    {
        return self::fetchPairs(23, 0);
    }

    private static function fetchPairsMinute()
    {
        return self::fetchPairs(59, 0);
    }

    private static function fetchPairs($intFinish = 0, $intStart = 1)
    {
        $arrFetchPairs = array();
        for ($intCount = $intStart; $intCount <= $intFinish; ++$intCount)
            $arrFetchPairs[$intCount] = $intCount;
        $arrFetchPairs = ArrayCollection::merge(array('*' => '*'), $arrFetchPairs);
        return $arrFetchPairs;
    }

}
