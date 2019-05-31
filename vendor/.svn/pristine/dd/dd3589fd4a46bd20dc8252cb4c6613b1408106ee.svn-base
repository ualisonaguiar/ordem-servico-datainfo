<?php

namespace InepZend\Module\Log\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\Log\Service\LogModule as LogModuleService;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;

/**
 * Formulario responsavel pelas funcionalidades relacionadas aos arquivos de log.
 */
class Log extends FormGenerator
{

    const KEY_RESERVED_VARIABLE = 'ds_reserved_variable';
    const KEY_OPTION = 'tp_option';
    const KEY_NAMESPACE = 'ds_namespace';
    const KEY_USER_SYSTEM = 'ds_user_system';
    const KEY_CPF = 'ds_cpf';

    public function __construct($strName = null)
    {
        parent::__construct((empty($strName) ? $this->generateFormName(__CLASS__) : $strName));
    }

    /**
     * Metodo responsavel por adicionar os elementos ao formulario de filtro.
     */
    public function prepareElementsFilter()
    {
        $this->addHtml('<div class="caixaVazada"><h2>Arquivos de log</h2><div class="caixaVazada"><h3 class="h-form">Filtros</h3>');
        $this->setAttribute('onsubmit', 'javascript:filterPaginator("/log/ajaxFilter", undefined, undefined, false, undefined, "no_file", "desc", false); return false;');
        $this->addDateRange(array('name' => 'dt_create', 'label' => 'Período de Criação', 'placeholder' => 'Entre com o Período de Criação', 'title' => 'Entre com o período de criação dos arquivos de log'));
        $this->addSelect(array('name' => 'tp_level', 'label' => 'Level', 'placeholder' => 'Selecione', 'value_options' => LogModuleService::getTpLevel(), 'empty_option' => 'Selecione'));
        $this->addButtonSearch('filterPaginator(\'/log/ajaxFilter\', undefined, undefined, false, undefined, \'no_file\', \'desc\', false);');
        $this->addButtonClear();
        $this->addHtml('</div>');
        $flexigrid = new FlexigridHelper();
        $flexigrid->setRoute('log');
        $flexigrid->setSortName('no_file');
        $flexigrid->setSortOrder('desc');
        $flexigrid->setShowInsert(false);
        $flexigrid->setShowUpdate(false);
        $flexigrid->setShowDelete(false);
        $flexigrid->setCol('no_file', 'Arquivo', 275);
        $flexigrid->setCol('ds_path', 'Caminho', 385, 'left', false);
        $flexigrid->setCol('ds_size', 'Tamanho', 120, 'center', false);
        $flexigrid->setCol('dt_create', 'Criação', 120, 'center', false);
        $flexigrid->setCol('tp_level', 'Level', 120, 'center', false);
        $flexigrid->setButton('Visualizar', 'update', 'showLog', null, true);
        $flexigrid->setButton('Adicionar à lista de arquivos de log para download', 'add', 'addFileDownload', null, true);
        $this->addHtml($flexigrid->showGrid());
        $this->addHtml('</div>');
        $this->setInputFilter(new LogFilter('filter'));
    }

    /**
     * Metodo responsavel por adicionar os elementos ao formulario de configuracao.
     */
    public function prepareElementsConfig()
    {
        $this->addHtml('<div class="caixaVazada"><h2 class="h-form">Configuração</h2><div class="caixaVazada"><h3>Opções para auditoria</h3><div class="caixaVazada" style="margin-bottom: 10px;">');
        $this->addTransfer(array('name' => self::KEY_RESERVED_VARIABLE, 'label' => 'Variáveis reservadas do PHP', 'placeholder' => 'Selecione', 'value_options' => LogModuleService::getReservedVariable(), 'help_text' => $this->getHelpTextReservedVariable()));
        $this->addHtml('</div><div class="caixaVazada" style="margin-top: 10px; margin-bottom: 10px;">');
        $this->addLabel(array('label' => 'Opções de Ativação'));
        $this->addHtml('<div class="caixaVazada" style="width: 500px; margin-bottom: 10px;">');
        foreach (LogModuleService::getOptionAudit() as $strValue => $strLabel) {
            $strMethod = 'getHelpText' . ucfirst($strValue);
            $this->addCheckbox(array('name' => self::KEY_OPTION . '[' . $strValue . ']', 'label' => $strLabel, 'label_class' => 'labelCheckbox', 'label_style' => 'width: 455px; font-weight: normal;', 'help_text' => $this->$strMethod()));
        }
        $this->addHtml('</div></div><div class="caixaVazada" style="margin-bottom: 10px;">');
        foreach (LogModuleService::getNamespaceType() as $strNamespaceType)
            $this->addTextarea(array('name' => self::KEY_NAMESPACE . '[' . $strNamespaceType . ']', 'label' => 'Namespaces de <i>' . $strNamespaceType . '</i>', 'title' => 'Namespaces de ' . $strNamespaceType, 'placeholder' => 'Insira os namespaces (ou parte) de ' . $strNamespaceType, 'style' => 'width: 500px; height: 100px;', 'help_text' => $this->getHelpTextAuditToTextarea('somente alguns namespaces ou a parte inicial de namespaces da camada ' . $strNamespaceType . ' da aplicação')));
        $this->addHtml('</div><div class="caixaVazada" style="margin-bottom: 10px; padding-right: 10px;">');
        $this->addTextarea(array('name' => self::KEY_CPF, 'label' => 'CPFs de usuário', 'placeholder' => 'Insira os CPFs do usuário', 'style' => 'width: 500px; height: 100px;', 'help_text' => $this->getHelpTextAuditToTextarea('somente alguns números de CPFs de usuários do SSI com acesso ao sistema')));
        $this->addTextarea(array('name' => self::KEY_USER_SYSTEM, 'label' => 'IDs de usuário no sistema no SSI', 'placeholder' => 'Insira os IDs do usuário no sistema no SSI', 'style' => 'width: 500px; height: 100px;', 'help_text' => $this->getHelpTextAuditToTextarea('somente alguns IDs do SSI de usuários vinculados ao sistema')));
        $this->addHtml('<div style="overflow: hidden; width: 100%;">');
        $this->addButtonSave($this->getAttribute('name'), false);
        $this->addHtml('</div></div><h3>Histórico de alterações</h3>');
        $flexigrid = new FlexigridHelper();
        $flexigrid->setSortName('dt_ocorrencia');
        $flexigrid->setSortOrder('asc');
        $flexigrid->setHeight(200);
        $flexigrid->setCol('no_autor', 'Autor(a)', 500);
        $flexigrid->setCol('no_file', 'Arquivo', 300);
        $flexigrid->setCol('dt_ocorrencia', 'Ocorrência', 160, 'center');
        $flexigrid->setReloadOnLoad(true, '/log-config/ajaxHistoryPaginator');
        $this->addHtml($flexigrid->showGrid());
        $this->addHtml('</div></div>');
        $this->setInputFilter(new LogFilter('config'));
    }

    private function getHelpTextReservedVariable()
    {
        return 'As variáveis reservadas do PHP que estão presentes no lado DIREITO estarão selecionadas para auditoria. Seguem suas descrições:
            
.: $HTTP_RAW_POST_DATA - Informação não-tratada do POST;
.: $_COOKIE - $HTTP_COOKIE_VARS [obsoleta] - HTTP Cookies;
.: $_ENV - $HTTP_ENV_VARS [obsoleta] - Variáveis de ambiente;
.: $_FILES - $HTTP_POST_FILES [obsoleta] - HTTP File Upload variáveis;
.: $_GET - $HTTP_GET_VARS [obsoleta] - HTTP GET variáveis;
.: $_POST - $HTTP_POST_VARS [obsoleta] - HTTP POST variáveis;
.: $_REQUEST - Variáveis de requisição HTTP;
.: $_SERVER - $HTTP_SERVER_VARS [obsoleta] - Informação do servidor e ambiente de execução;
.: $_SERVER[\'REQUEST_URI\'] - A URL completa fornecida para acessar a página;
.: $_SESSION - $HTTP_SESSION_VARS [obsoleta] - Variáveis de sessão;
.: $argc - O número de argumentos passados para o script;
.: $argv - Array de argumentos passados para o script;
.: $http_response_header - Cabeçalhos de resposta HTTP;
.: $php_errormsg - A mensagem de erro anterior.';
    }

    private function getHelpTextTrace()
    {
        return 'Caso esteja marcada, as rotas/passos de execução de requisições acionadas por usuários estarão selecionadas para auditoria.';
    }

    private function getHelpTextPersistence()
    {
        return 'Caso esteja marcada, as operações em banco de dados, inclusive com tempo de resposta, estarão selecionadas para auditoria.';
    }

    private function getHelpTextErrorHandler()
    {
        return 'Caso esteja marcado, os erros de PHP subdividos pelo level em notice, warning e fatal, e as exceptions geradas por erros de PHP ou comandos throw, estarão selecionados para auditoria. Seguem as descrições de cada level de erros de PHP:
            
.: Notice - Curtas notificações em tempo de execução, indicando que o script encontrou alguma coisa que pode indicar um erro, mas que também possa acontecer no curso normal de execução de um script - menor gravidade;
.: Warning - Avisos de atenção em tempo de execução, indicando que existem erros não fatais no script, tendo a execução do código continuada - média gravidade;
.: Fatal - Erros que impedem a continuidade da execução do script - alta gravidade.';
    }

    private function getHelpTextShow()
    {
        return 'Caso esteja marcado, todo o conteúdo auditado será visível na tela do sistema.';
    }

    private function getHelpTextAuditToTextarea($strAuditTo = null)
    {
        return (empty($strAuditTo)) ? false : 'Para auditar ' . $strAuditTo . ', é necessário descrevê-los separando por quebra de linha, espaço ( ), vírgula (,) ou ponto e vírgula (;).';
    }

}
