function removeItem(intIdHistoricoExecucao)
{
    var arrParametroHistorico = new Array(),
        mixResult;
    arrParametroHistorico['idHistoricoParametro'] = intIdHistoricoExecucao;
    mixResult = JSON.parse(ajaxRequest('/envio-operacao/ajax-remover', arrParametroHistorico));
    alertDialog(mixResult.messages, 'Aviso');
    $('.pReload').trigger('click');
}

$(function () {
    $('#btnSalvar').html('Enviar');
    $('body').on('click', '.fa-info-circle', function () {
        var strRow = $(this).closest('tr'),
                intIdHistorico = strRow.attr('id').replace("row", ""),
                strUrl = '/query/ajax-history-param/' + intIdHistorico,
                arrParametroHistorico = new Array(),
                strRenderResult;
        arrParametroHistorico['idHistoricoParametro'] = intIdHistorico;
        strRenderResult = ajaxRequest(strUrl, arrParametroHistorico);
        openDialog(strRenderResult, 'Histórico de Execução', 900, 500);
    }).on('click', '.ui-dialog-titlebar-close', function () {
        $('.ui-dialog').remove();
    }).on('click', '.enviar-operacao', function () {
        var strRow = $(this).closest('tr'),
            intIdHistorico = strRow.attr('id').replace("row", ""),
            arrParametroHistorico = new Array(),
            mixResult;
        arrParametroHistorico['idHistoricoParametro'] = intIdHistorico;
        mixResult = JSON.parse(ajaxRequest('/query/ajax-insere-query-email', arrParametroHistorico));
        
        alertDialog(mixResult.messages, 'Aviso');
        if (mixResult.result) {
            $('.send-email-query .fa-envelope-o').attr('style', 'color: #d64931');
            $('.send-email-query .label').html(mixResult.result);
        }
    }).on('click', '.remove-operacao-mail', function() {
        var strRow = $(this).closest('tr'),
            intIdHistorico = strRow.attr('id').replace("row", "");
        confirmDialog('Deseja realmente remover este item no envio do e-mail?', 'Confirmação', 300, 150, "removeItem('" + intIdHistorico + "')");
    }).on('click', '.btnReenvio', function() {
        openWaitDialog();
        var strUrl = '/historico-envio-operacao/reenviar-email',
            arrParametro = new Array(),
            mixResult;
        arrParametro['idEmail'] = $('#idEmail').val();
        mixResult = JSON.parse(ajaxRequest(strUrl, arrParametro));
        closeWaitDialog();
        alertDialog(mixResult.messages, 'Aviso');        
    });

    $('form').submit(function () {
        if ($(this).valid())
            openWaitDialog();
    });
});