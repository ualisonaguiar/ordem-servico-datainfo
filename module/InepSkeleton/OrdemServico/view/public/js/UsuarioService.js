var UsuarioService = AbstractService.extend(function () {

    var self = this;
    self.arrPk = ['id_usuario'];
    self.strService = 'OrdemServico\\Service\\UsuarioFile';
    self.strForm = 'OrdemServico\\Form\\Usuario';

    self.vincular = function(callback, intIdUsuario, intIdUsuarioVinculo) {
        return self.RestClient.runService(
            self.strService,
            'vincularAction',
            [{
                id_usuario: intIdUsuario,
                id_usuario_vinculo: intIdUsuarioVinculo
            }],
            'WS_RSRC_USUARIO_VINCULO',
            callback
        );
    };
});