<?php

namespace InepZend\Module\Executor\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;
use InepZend\Module\Executor\Entity\Query as QueryEntity;
use InepZend\Module\Executor\Service\QueryTrait;

class Executor extends FormGenerator
{
    use QueryTrait;

    public function prepareElementsSearch()
    {
        $strRoute = 'query';
        $arrInput = array(
            'dsTitulo' => array(
                'type' => 'text',
                'label' => 'Operação',
            ),
            'inAtivo' => array(
                'type' => 'Select',
                'label' => 'Situação',
                'value_options' => QueryEntity::$arrSituacao,
                'empty_option' => 'Selecione',
            ),
        );
        $arrButons = array(
            'btnPesquisar' => array(
                'type' => 'Button',
                'onclick' => 'filterPaginator(\'/' . $strRoute . '/ajaxFilter\', \'frm\');',
                'value' => 'Pesquisar'
            ),
            'btnClearForm' => array(
                'type' => 'ButtonClear',
            )
        );
        $serviceUser = $this->getService('InepZend\Module\Executor\Service\Usuario');
        $this->addFormCrud('Filtros da Pesquisa', $arrInput, $arrButons);
        $this->addHtml('<br /><br />');
        $flexigrid = new FlexigridHelper();
        $flexigrid->setRoute($strRoute);
        $flexigrid->setShowInsert($serviceUser->hasAdministrador() && !$serviceUser->hasProductOwner());
        $flexigrid->setShowUpdate(false);
        $flexigrid->setShowDelete(false);
        $flexigrid->setCol('idQuery', 'ID', 40, 'left', false);
        $flexigrid->setCol('dsTitulo', 'Título', 400, 'left', false);
        $flexigrid->setCol('inAtivo', 'Situação', 100, 'left', false);
        $flexigrid->setCol('dtCadastro', 'Cadastro', 150, 'left', false);
        $flexigrid->setCol('dtExecucao', 'Último atendimento', 200, 'left', false);
        if ($serviceUser->hasAdministrador()) {
            $flexigrid->setButton('Editar', 'fa fa-edit', null, null, true);
            if (!$serviceUser->hasProductOwner()) {
                $flexigrid->setButton('Ativo', 'fa fa-minus-circle situacao', null, null, true, 'verificarStatusAtivo');
                $flexigrid->setButton('Inativo', 'fa fa-plus-circle situacao', null, null, true, 'verificarStatusInativo');
            }
        }
        $flexigrid->setButton('Executar operação', 'fa fa-play-circle', null, null, true, 'verificarStatusExecucao');
        $this->addHtml($flexigrid->showGrid());
        $this->setInputFilter(new ExecutorFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElementsQuery($strTitle, $inProductOwner = null)
    {
        $arrInput = array(
            'idQuery' => array(
                'type' => 'hidden',
            ),
            'dsTitulo' => array(
                'type' => 'text',
                'label' => 'Titulo',
            ),
            'dsDescricao' => array(
                'type' => 'textarea',
                'label' => 'Descrição',
            ),
            'inAtivo' => array(
                'type' => 'Select',
                'label' => 'Situação',
                'value_options' => QueryEntity::$arrSituacao,
                'empty_option' => 'Selecione',
                'value' => QueryEntity::SITUACAO_ATIVO
            ),
            'dsQuery' => ($inProductOwner) ?
            array(
                'type' => 'textarea',
                'label' => 'Operação',
                'style' => 'height: 500px;'
            ) :
            array(
                'type' => 'textarea',
                'label' => 'Operação',
                'style' => 'height: 500px;',
                'class' => 'codepress sql linenumbers-off'
            ),
        );
        $arrButons = array(
            'btnSalvar' => array(
                'type' => 'ButtonSave',
                'value' => 'Salvar'
            ),
            'btnVoltar' => array(
                'type' => 'Button',
                'class' => 'btn-inep btn-comum',
                'title' => 'Voltar',
                'onclick' => 'window.location.href=strGlobalBasePath + \'/query\';'
            ),
        );
        $arrParam = array(
            'required' => array(
                'dsTitulo' => true,
                'inAtivo' => true
            ),
            'disabled' => array(
                'dsQuery' => true
            )
        );
        $this->setInputFilter(new ExecutorFilter(__FUNCTION__));
        $this->addFormCrud($strTitle, $arrInput, $arrButons, $arrParam);
    }

    public function prepareElementExecute($intIdQuery, $arrDataResult = array())
    {
        $dataQuery = $this->getService('InepZend\Module\Executor\Service\Query')->find((int) $intIdQuery);
        # 1 quadrado
        $this->addHtml('<div id="div_informacao_query" class="well">');
        $this->addHtml('<h3>Informação da operação</h3>');
        # titulo
        $this->addText(
                array(
                    'name' => 'dsTitulo',
                    'label' => 'Titulo:',
                    'class' => 'form-control',
                    'value' => $dataQuery->getDsTiTulo(),
                    'disabled' => true
                )
        );
        # textarea
        $this->addTextarea(
                array(
                    'name' => 'dsDescricao',
                    'label' => 'Descrição:',
                    'class' => 'form-control',
                    'value' => $dataQuery->getDsDescricao(),
                    'disabled' => true
                )
        );
        $this->addHtml('</div>');
        # 2 quadrado
        $this->addHtml('<div id="div_informacao_parametro" class="well" style="padding-bottom: 50px">');
        $this->addHtml('<h3>Informações de parâmetro</h3>');
        $this->addHidden(array('name' => 'idQuery'));
        $arrParameterQuery = $this->getBindFromSql($dataQuery->getDsQuery());
        if ($arrParameterQuery) {
            $serviceUsuario = $this->getService('InepZend\Module\Executor\Service\Usuario');
            foreach ($arrParameterQuery as $strParameter) {
                $this->addText(
                    array(
                        'name' => 'parameter[' . $strParameter . ']',
                        'label' => $strParameter,
                        'class' => 'form-control',
                        'required' => true,
                        'disabled' => ($strParameter == 'cpfUsuarioLogado' && !$serviceUsuario->hasAdministrador()) ? true : false,
                        'value' => ($strParameter == 'cpfUsuarioLogado') ? $serviceUsuario->getCpfUsuarioLogado() : null
                    )
                );
            }
        }
        # botao de execucao
        $this->addButton(
                array(
                    'id' => 'btnExecute',
                    'type' => 'submit',
                    'value' => 'Executar Operação',
                    'title' => 'Executar Operação'
                )
        );
        # botao de voltar
        $this->addButtonBack('query');
        $this->addHtml('</div>');
        # 3 quadrado
        $this->getTableResult($arrDataResult);
        # 4 quadrado
        $this->addHtml('<div id="div_informacao_historico" class="well">');
        $this->addHtml('<h3>Histórico de Execução</h3>');
        $this->addHtml('<br /><br />');
        $serviceUser = $this->getService('InepZend\Module\Executor\Service\Usuario');
        $flexigrid = new FlexigridHelper();
        $flexigrid->setUrlPaging('/query/ajax-history-execute/' . $intIdQuery);
        $flexigrid->setShowInsert(true);
        $flexigrid->setShowUpdate(false);
        $flexigrid->setShowDelete(false);
        $flexigrid->setCol('ID_HISTORICO_EXECUCAO', 'ID', 50, 'left', false);
        $flexigrid->setCol('DS_USUARIO', 'Usuário', 350, 'left', false);
        $flexigrid->setCol('DT_EXECUCAO', 'Data', 150, 'left', false);
        $flexigrid->setCol('TP_SITUACAO', 'Situação', 200, 'left', false);
        $flexigrid->setButton('Parâmetros Utilizados na Operação', 'fa fa-info-circle', null, null, true);
        if ($serviceUser->hasAdministrador()) {
            $flexigrid->setButton('Envia por E-mail a operação', 'fa fa-envelope-o enviar-operacao', null, null, true);
        }
        $this->addHtml($flexigrid->showGrid());
        $this->addHtml('</div>');
        $this->setInputFilter(new ExecutorFilter(__FUNCTION__));
        return $this;
    }

    /**
     * Metodo responsavel por montar a tabela de resultado.
     *
     * @param array $arrDataResult
     * @param array $strIdResult
     * @return \InepZend\Module\Executor\Form\Executor
     */
    public function getTableResult($arrDataResult)
    {
        if ($arrDataResult['data']) {
            $this->addHtml('<div id="div_informacao_query" class="well">');
            $this->addHtml('<h3>Resultado</h3>');
            $booDataExport = false;
            if (is_array($arrDataResult['data'])) {
                if (array_key_exists('error', $arrDataResult['data']))
                    $this->addHtml('<p class="alert-danger">' .  nl2br($arrDataResult['data']['error']) . '</p>');
                else {
                    $arrFields = array_keys($arrDataResult['data'][0]);
                    $arrColumn = array();
                    foreach ($arrFields as $strField)
                        $arrColumn[$strField] = $strField;
                    $this->addTable(
                        array(
                            'name' => 'data_result_' . $arrDataResult['idHistoricoExecucao'],
                            'title' => $arrColumn,
                            'option' => array(
                                array('height', ((count($arrDataResult['data']) > 5) ? '500px' : 'auto'))
                            )
                        )
                    );
                    $booDataExport = true;
                }
            } else {
                $this->addHtml('<p class="alert-success">' .  nl2br($arrDataResult['data']) . '</p>');
            }
            $this->addHtml('<hr>');
            $this->addHtml('<div class="text-right alert-info">' . $arrDataResult['time'] .'</div>');
            if ($booDataExport) {
                $this->addHtml('<br />');
                $intIdHistoricoExecucao = $arrDataResult['idHistoricoExecucao'];
                $this->addButton(
                    array(
                        'name' => 'btnExportar',
                        'value' => 'Exportar',
                        'onclick' => "window.location.href=strGlobalBasePath + '/query/exportar/$intIdHistoricoExecucao'; target='_blank'"
                    )
                );
                $this->addHtml('<br /><br />');
            }
            $this->addHtml('</div>');
        }
        return $this;
    }
}
