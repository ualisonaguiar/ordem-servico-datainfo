var CatalogoService = AbstractService.extend(function () {

    var self = this;
    self.arrPk = ['id_catalogo_servico'];
    self.strService = 'OrdemServico\\Service\\CatalogoServicoFile';
    self.strForm = 'OrdemServico\\Form\\CatalogoServico';

    self.removeVinculo = function (callback, intIdCatalogoServicoAtividade) {
        return self.RestClient.runService(
            self.strService,
            'removeVinculoAction',
            [{id_catalogo_servico_atividade: intIdCatalogoServicoAtividade}],
            'WS_RSRC_SERVICE_CATALOGO_REMOVE_VINCULO',
            callback
        );
    };
});