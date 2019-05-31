var OrdemServicoAceiteService = AbstractService.extend(function () {

    var self = this;
    self.arrPk = ['idOrdemServico'];
    self.strService = 'OrdemServico\\Service\\OrdemServicoAceiteFile';
    self.strForm = 'OrdemServico\\Form\\OrdemServicoAceite';

    self.inserir = function(callback, intTpGestao, intIdOrdemServico) {
        return self.RestClient.runService(
            self.strService,
            'inserirAction',
            [{
                tp_gestao: intTpGestao,
                id_ordem_servico: intIdOrdemServico
            }],
            'WS_RSRC_ACEITE_INSERIR',
            callback
        );
    };

    self.remover = function(callback, intTpGestao, intIdOrdemServico) {
        return self.RestClient.runService(
            self.strService,
            'removerAceiteAction',
            [{
                tp_gestao: intTpGestao,
                id_ordem_servico: intIdOrdemServico
            }],
            'WS_RSRC_ACEITE_REMOVE',
            callback
        );
    };

    self.getListaAceiteGestao = function(callback, intIdOrdemServico) {
        return self.RestClient.runService(
            self.strService,
            'getListaAceiteGestaoAction',
            [{
                id_ordem_servico: intIdOrdemServico
            }],
            'WS_RSRC_ACEITE_LISTAGEM_ACEITE_GESTAO',
            callback
        );
    };

    self.aceiteLote = function(callback, arrOrdemServico, arrGesta) {
        return self.RestClient.runService(
            self.strService,
            'aceiteLoteAction',
            [{
                ordem_servico: arrOrdemServico,
                gestao: arrGesta
            }],
            'WS_RSRC_ACEITE_LOTE',
            callback
        );
    };
});