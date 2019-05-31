var DemandaService = AbstractService.extend(function () {

    var self = this;
    self.arrPk = ['id_demanda'];
    self.strService = 'OrdemServico\\Service\\DemandaFile';
    self.strForm = 'OrdemServico\\Form\\Demanda';

    self.hasEditDemanda = function(callback, intIdDemanda) {
        return self.RestClient.runService(
            self.strService,
            'hasSituacaoDemandaVinculadaAction',
            [{id_demanda: intIdDemanda}],
            'WS_RSRC_SERVICE_SITUACAO_DEMANDA_VINCULADA',
            callback
        );
    };

    self.getAtividadesFormulario = function(callback, intIdCatalogoServicoAtividade) {
        return self.RestClient.runService(
            'OrdemServico\\Service\\CatalogoServicoAtividadeFile',
            'getAtividadesFormularioAction',
            [{id_catalogo_servico: intIdCatalogoServicoAtividade}],
            'WS_RSRC_DEMANDA_ATIVIDADE_SERVICO_FORMULARIO', callback
        );
    };

    self.getAtividadesVinculadaAssessoria = function(callback, strAssessoria) {
        var arrCatalogoServico = sessionStorage.getItem('catalogo-servico-' + strAssessoria);
        if (!empty(arrCatalogoServico))
            return callback(JSON.parse(arrCatalogoServico));
        return self.RestClient.runService(
            'OrdemServico\\Service\\CatalogoServicoAtividadeFile',
            'getAtividadesVinculadaAssessoriaAction',
            [{co_area_assessoria: strAssessoria}],
            'WS_RSRC_SERVICE_CATALOGO_SERVICO_ATIVIDADE_ASSESSORIA',
            function(mixResult) {
                sessionStorage.setItem('catalogo-servico-' + strAssessoria, JSON.stringify(mixResult));
                return callback(mixResult);
            }
        );
    };

    self.getValorServicoAcessoria = function(callback, intIdDemanda) {
        return self.RestClient.runService(
            'OrdemServico\\Service\\DemandaServicoFile',
            'getValorAssesoriaServicoAction',
            [{id_demanda: intIdDemanda}],
            'WS_RSRC_SERVICE_VALOR_ASSESSORIA_SERVICO',
            callback
        );
    };

    self.getInformacaoAlteracaoDemanda = function(callback, intIdDemanda) {
        return self.RestClient.runService(
            'OrdemServico\\Service\\DemandaServicoFile',
            'getInformacaoAlteracaoDemandaAction',
            [{id_demanda: intIdDemanda}],
            'WS_RSRC_SERVICE_DEMANDA_INFORMACAO_ALTERACAO',
            callback
        );
    };


    self.getValorFatorPonderacao = function(callback) {
        var arrFator = sessionStorage.getItem('fator-ponderecao');
        if (!empty(arrFator))
            return callback(JSON.parse(arrFator));
        return self.RestClient.runService(
            self.strService,
            'valorFatorPonderacaoAction',
            undefined,
            'WS_RSRC_SERVICE_DEMANDA_VALOR_FATOR_PONDERACAO',
            function(mixResult) {
                sessionStorage.setItem('fator-ponderecao', JSON.stringify(mixResult));
                return callback(mixResult);
            }
        );
    };
});