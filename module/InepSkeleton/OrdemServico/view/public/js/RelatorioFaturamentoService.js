var RelatorioFaturamentoService = AbstractService.extend(function() {

    var self = this;
    self.strService = 'OrdemServico\\Service\\RelatorioFaturamento';

    self.getGerarRelatorio = function(callback, arrIdOrdemServico) {
        return self.RestClient.runService(self.strService, 'gerarRelatorioAction', [arrIdOrdemServico], 'WS_RSRC_SERVICE_GERAR_RELATORIO', callback);
    };

    self.pesquisarOrdemServico = function (callback, arrData) {
        return self.RestClient.runService(self.strService, 'getListaOrdemServicoAction', [arrData], 'WS_RSRC_SERVICE_RELATORIO_LISTA_ORDEM_SERVICO', callback);
    };
});