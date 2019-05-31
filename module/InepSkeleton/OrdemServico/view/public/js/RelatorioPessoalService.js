var RelatorioPessoalService = AbstractService.extend(function () {

    var self = this;
    self.strService = 'OrdemServico\\Service\\RelatorioDesempenho';

    self.getGerarRelatorio = function (callback, arrIdOrdemServico) {
        return self.RestClient.runService(
            self.strService,
            'gerarRelatorioPessoalAction',
            [arrIdOrdemServico],
            'WS_RSRC_SERVICE_GERAR_RELATORIO',
            callback
        );
    };
});