var OrdemServicoDemandaService = AbstractService.extend(function () {

    var self = this;
    self.arrPk = ['id_ordem_servico_demanda'];
    self.strService = 'OrdemServico\\Service\\OrdemServicoDemandaFile';
    self.strForm = 'OrdemServico\\Form\\OrdemServicoDemanda';

    self.listDemandaSemOrdemServico = function (callback, arrCriteria) {
        return self.RestClient.runService('OrdemServico\\Service\\DemandaFile', 'listDemandaSemOrdemServicoAction', [arrCriteria], 'WS_RSRC_SERVICE_DEMANDA_SEM_ORDEM_SERVICO', callback);
    };

    self.getAtividadeRequerida = function (callback, intIdDemanda) {
        return self.RestClient.runService('OrdemServico\\Service\\DemandaFile', 'getInforDemandaAtividadeAction', [{id_demanda: intIdDemanda}], 'WS_RSRC_SERVICE_DEMANDA_INFORMACAO', callback);
    };

    self.getListDemandaVinculada = function (callback, intIdOrdemServico) {
        return self.RestClient.runService('OrdemServico\\Service\\OrdemServicoDemandaFile', 'listaDemandaVinculadaAction', [{id_ordem_servico: intIdOrdemServico}], 'WS_RSRC_SERVICE_LISTA_DEMANDA_VINCULADA', callback);
    };

    self.getInformacaoGrupo = function (callback, intIdDemanda) {
        return self.RestClient.runService('OrdemServico\\Service\\DemandaFile', 'getInformationGrupoAction', [{id_demanda: intIdDemanda}], 'WS_RSRC_SERVICE_DEMANDA_INFORMACAO_GRUPO', callback);
    };

    self.saveAtividadeVinculada = function (callback, arrParam) {
        return self.RestClient.runService('OrdemServico\\Service\\DemandaFile', 'saveAtividadeVinculadaAction', [arrParam], 'WS_RSRC_SERVICE_SAVE_ATIVIDADE_VINCULADA', callback);
    };

    self.removeVinculoDemanda = function (callback, arrParam) {
        return self.RestClient.runService('OrdemServico\\Service\\OrdemServicoDemandaFile', 'removeVinculoDemandaAction', [arrParam], 'WS_RSRC_SERVICE_ORDEM_DEMANDA_REMOVE_VINCULO', callback);
    };

    self.organizarAtividadeVinculada = function ($scope) {
        var arrSequenciaDemandaVinculo = {};
        var intPosicao = 1;

        $scope.gripOptions.data.sort(function (demandaFist, demandaSecond) {
            return demandaFist.id_demanda - demandaSecond.id_demanda;
        });

        var arrDemandaVinculada = [];
        angular.forEach($scope.gripOptions.data, function (demandaVinculada, intPosicaoGrid) {
            var intPosicaoAssociacao = undefined;
            if (demandaVinculada.id_servico != undefined) {
                intPosicaoAssociacao = demandaVinculada.id_demanda + '_' + demandaVinculada.id_servico;
            } else if (demandaVinculada.id_demanda_superior != undefined && demandaVinculada.id_demanda_superior != 0) {
                intPosicaoAssociacao = demandaVinculada.id_demanda_superior;
            }
            if (intPosicaoAssociacao != undefined) {
                if (arrDemandaVinculada[intPosicaoAssociacao] == undefined)
                    arrDemandaVinculada[intPosicaoAssociacao] = 0;
                arrDemandaVinculada[intPosicaoAssociacao]++;
            }
        });

        angular.forEach($scope.gripOptions.data, function (demandaVinculada, intPosicaoGrid) {
            var intPosicaoAssociacao = 0;
            var intSequenciaDemandaVinculada = 1;
            var booSequencia = false;
            if (demandaVinculada.id_servico != undefined) {
                intPosicaoAssociacao = demandaVinculada.id_demanda + '_' + demandaVinculada.id_servico;
                if (arrDemandaVinculada[intPosicaoAssociacao] > 1)
                    booSequencia = true;
            } else if (demandaVinculada.id_demanda_superior != undefined && demandaVinculada.id_demanda_superior != 0) {
                intPosicaoAssociacao = demandaVinculada.id_demanda_superior;
                booSequencia = true;
            } else
                intPosicaoAssociacao = demandaVinculada.id_demanda;
            if (arrSequenciaDemandaVinculo[intPosicaoAssociacao] === undefined) {
                arrSequenciaDemandaVinculo[intPosicaoAssociacao] = {posicao: intPosicao};
                if (booSequencia === true)
                    arrSequenciaDemandaVinculo[intPosicaoAssociacao].sequencia = intSequenciaDemandaVinculada;
                intPosicao += 1;
            }
            $scope.gripOptions.data[intPosicaoGrid].co_sequencia = arrSequenciaDemandaVinculo[intPosicaoAssociacao].posicao;
            if (booSequencia === true) {
                $scope.gripOptions.data[intPosicaoGrid].co_sequencia += '.' + arrSequenciaDemandaVinculo[intPosicaoAssociacao].sequencia;
                arrSequenciaDemandaVinculo[intPosicaoAssociacao].sequencia += 1;
            }
        });
        $scope.gripOptions.data.sort(function (demandaFist, demandaSecond) {
            return demandaFist.co_sequencia - demandaSecond.co_sequencia;
        });
    };
});