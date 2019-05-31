function teste(arrParam)
{
    var arrParameter = new Array(),
        strUrl = '/historico-envio-operacao/ajax-operacao-vinculada/' + arrParam[4],
        strHtml;
    strHtml = ajaxRequest(strUrl, arrParameter);
    $('.flexigrid tr[data-parent="row' + arrParam[4] + '"]').html(strHtml);
    $('.flexigrid tr[data-parent="row' + arrParam[4] + '"]').attr('colspan', 5);
}

$(function () {
    $('body').on('click', '.fa-arrow-circle-o-down', function () {
        var strRow = $(this).closest('tr'),
                intIdEmail = strRow.attr('id').replace("row", ""),
                strUrl = strGlobalBasePath + '/historico-envio-operacao/download/' + intIdEmail;
        window.open(strUrl, '_blank');
    }).on('click', '.fa-reply', function () {
        var strRow = $(this).closest('tr'),
                intIdEmail = strRow.attr('id').replace("row", ""),
                strUrl = '/historico-envio-operacao/reenviar-email',
                arrParametro = new Array(),
                mixResult;
        arrParametro['idEmail'] = intIdEmail;
        mixResult = JSON.parse(ajaxRequest(strUrl, arrParametro));
        alertDialog(mixResult.messages, 'Aviso');
        $('.pReload').trigger('click');
    }).on('click', '.info-envio', function () {
        var strRow = $(this).closest('tr'),
                intIdEmail = strRow.attr('id').replace("row", "");
        strUrl = strGlobalBasePath + '/envio-operacao/index/' + intIdEmail;
        location.href = strUrl;
    }).on('click', '.fa-plus-square', function() {
        
    });
});