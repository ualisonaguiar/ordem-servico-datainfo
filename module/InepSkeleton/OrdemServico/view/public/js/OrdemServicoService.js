var OrdemServicoService = AbstractService.extend(function () {

    var self = this;
    self.arrPk = ['id_ordem_servico'];
    self.strService = 'OrdemServico\\Service\\OrdemServicoFile';
    self.strForm = 'OrdemServico\\Form\\OrdemServico';

    self.getEmitirOrdemServico = function (callback, dataOrdemServico) {
        return self.RestClient.runService(self.strService, 'emitirOrdemServicoAction', [dataOrdemServico], 'WS_RSRC_SERVICE_EMITIR_ORDEM_SERVICO', callback);
    };

    self.getImprimirOrdemServico = function (callback, intIdOrdemServico, arrTypePrint) {
        return self.RestClient.runService(self.strService, 'imprimirOrdemServicoAction', [{id_ordem_servico: intIdOrdemServico, type_print: arrTypePrint}], 'WS_RSRC_SERVICE_IMPRIMIR_ORDEM_SERVICO', callback);
    };

    self.getImprimirOrdemServicoHtml = function (callback, intIdOrdemServico) {
        return self.RestClient.runService(self.strService, 'imprimirOrdemServicoAction', [{id_ordem_servico: intIdOrdemServico, type: 'html'}], 'WS_RSRC_SERVICE_IMPRIMIR_ORDEM_SERVICO', callback);
    };

    self.getAnaliseOrdemServico = function (callback, intIdOrdemServico, intTpSituacao) {
        return self.RestClient.runService(self.strService, 'analiseOrdemServicoAction', [{id_ordem_servico: intIdOrdemServico, tp_situacao: intTpSituacao}], 'WS_RSRC_SERVICE_ANALISE_ORDEM_SERVICO', callback);
    };

    self.getConsultarNumeroOs = function (callback, intIdOrdemServico) {
        return self.RestClient.runService(self.strService, 'consultarNumeroOsAction', [
            {id_ordem_servico: intIdOrdemServico}
        ], 'WS_RSRC_SERVICE_CONSULTAR_NUMERO_ORDEM_SERVICO', callback);
    };

    self.getInformacaoAlteracao = function(callback, intIdOrdemServico) {
        return self.RestClient.runService(
            self.strService,
            'getInformacaoAlteracaoAction',
            [{id_ordem_servico: intIdOrdemServico}],
            'WS_RSRC_SERVICE_ORDEM_SERVICO_INFORMACAO_ALTERACAO',
            callback
        );
    };

    self.getNumeroSequencialOrdemServico = function(callback) {
        return self.RestClient.runService(
            self.strService,
            'getNumeroSequencialOrdemServicoAction',
            [],
            'WS_RSRC_SERVICE_ORDEM_SERVICO_SEQUENCIAL',
            callback
        );
    };

    self.imprimirOrdemServicoSelecionado = function(callback, arrOrdemServico) {
        return self.RestClient.runService(
            self.strService,
            'imprimirOrdemServicoSelecionadoAction',
            [arrOrdemServico],
            'WS_RSRC_SERVICE_IMPRIMIR_ORDEM_SERVICO_SELECIONADA',
            callback
        );
    };

    self.alterarSituacaoSuspender = function(callback, intIdOrdemServico, intTpSituacao) {
        return self.RestClient.runService(
            self.strService,
            'suspenderOrdemServicoAction',
            [{
                id_ordem_servico: intIdOrdemServico,
                tp_situacao: intTpSituacao
            }],
            'WS_RSRC_SERVICE_ORDEM_SERVICO_SUSPENDER',
            callback
        );
    };
});