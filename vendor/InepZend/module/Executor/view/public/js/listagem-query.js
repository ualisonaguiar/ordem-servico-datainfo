function verificarStatusAtivo(registerGrid) {
    return (registerGrid[1] == 'Ativo') ? true : false;
}

function verificarStatusInativo(registerGrid) {
    return (registerGrid[1] == 'Inativo') ? true : false;
}

function verificarStatusExecucao(registerGrid) {
    return (registerGrid[1] == 'Inativo') ? false : true;
}

$(function () {
    $('body').on('click', '.situacao', function () {
        openWaitDialog();
        var strRow = $(this).closest('tr'),
                intIdQuery = strRow.attr('id').replace("row", ""),
                arrParameter = new Array(),
                mixResult;
        arrParameter['idQuery'] = intIdQuery;
        mixResult = JSON.parse(ajaxRequest('query/ajax-change-situation', arrParameter));
        if (mixResult.status == 'ok')
            $('.pReload').trigger('click');
        closeWaitDialog();
        alertDialog(mixResult.messages, 'Aviso');
    }).on('click', '.fa-play-circle', function () {
        var strRow = $(this).closest('tr'),
                intIdQuery = strRow.attr('id').replace("row", ""),
                strUrl = strGlobalBasePath + '/query/execute-query/' + base64Encode(intIdQuery);
        location.href = strUrl;
    }).on('click', '.fa-edit', function () {
        var strRow = $(this).closest('tr'),
                intIdQuery = strRow.attr('id').replace("row", ""),
                strUrl = strGlobalBasePath + '/query/edit/' + intIdQuery;
        location.href = strUrl;
    });
});