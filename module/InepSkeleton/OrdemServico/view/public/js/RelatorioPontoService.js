var RelatorioPontoService = AbstractService.extend(function () {

    var self = this;
    self.strService = 'OrdemServico\\Service\\RelatorioPonto';

    self.pesquisarPonto = function (callback, arrDataPost) {
        return self.RestClient.runService(
            self.strService,
            'pesquisarPontoAction',
            arrDataPost,
            'WS_RSRC_SERVICE_PONTO_PESQUISA',
            callback
        );
    };

    self.getGerarRelatorio = function (callback) {
        return self.RestClient.runService(
            self.strService,
            'getInformationArquivoAction',
            [],
            'WS_RSRC_SERVICE_PONTO_INFORMACAO_ARQUIVO',
            callback
        );
    };

    self.enviarArquivo = function(callback, arrDataPost) {
        return self.RestClient.runService(
            self.strService,
            'uploadArquivoAction',
            arrDataPost,
            'WS_RSRC_SERVICE_PONTO_UPLOAD',
            callback
        );
    };

    self.justificarPonto = function(callback, arrDataPost) {
        return self.RestClient.runService(
            'OrdemServico\\Service\\RelatorioPonto',
            'justificarPontoAction',
            arrDataPost,
            'WS_RSRC_SERVICE_PONTO_JUSTIFICAR',
            callback
        );
    };

    self.enviarInformacaoApex = function(callback, arrDataPost) {
        return self.RestClient.runService(
            'OrdemServico\\Service\\RelatorioPonto',
            'enviarInformacaoApexAction',
            arrDataPost,
            'WS_RSRC_SERVICE_PONTO_ENVIAR_APEX',
            callback
        );
    };

    self.lancamentoFeria = function(callback, arrDataPost) {
        return self.RestClient.runService(
            'OrdemServico\\Service\\RelatorioPonto',
            'lancarFeriaAction',
            arrDataPost,
            'WS_RSRC_SERVICE_PONTO_LACAR_FERIAS',
            callback
        );
    };
    
    self.lancamentoPonto = function(callback, arrDataPost) {
        return self.RestClient.runService(
            'OrdemServico\\Service\\RelatorioPonto',
            'lancarPontoAction',
            arrDataPost,
            'WS_RSRC_SERVICE_PONTO_LANCAR',
            callback
        );
    };
});