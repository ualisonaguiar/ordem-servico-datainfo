function verificarStatusAtivo(registerGrid) {
    return (registerGrid[1] == 'Ativo') ? true : false;
}

function verificarStatusInativo(registerGrid) {
    return (registerGrid[1] == 'Inativo') ? true : false;
}

$(function () {
    $('body').on('click', '.situacao', function () {
        openWaitDialog();
        var strRow = $(this).closest('tr'),
            intIdUsuario = strRow.attr('id').replace("row", ""),
            arrParameter = new Array(),
            mixResult;
        arrParameter['idUsuario'] = intIdUsuario;
        mixResult = JSON.parse(ajaxRequest('usuario/ajax-change-situation', arrParameter));
        if (mixResult.status == 'ok')
            $('.pReload').trigger('click');
        closeWaitDialog();
        alertDialog(mixResult.messages, 'Aviso');
    }).on('click', '.fa-edit', function () {
        var strRow = $(this).closest('tr'),
            intIdUsuario = strRow.attr('id').replace("row", ""),
            strUrl = strGlobalBasePath + '/usuario/edit/' + intIdUsuario;
        location.href = strUrl;
    });
});