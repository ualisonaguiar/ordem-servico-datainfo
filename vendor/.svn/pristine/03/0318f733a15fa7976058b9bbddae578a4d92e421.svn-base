$(function () {
    $('body').on('click', '.fa-download', function () {
        openWaitDialog();
        var intIdMassaTest = ($(this).closest("tr").attr('id')).replace('row', '');
        window.location.href = strGlobalBasePath + '/massateste/download/' + intIdMassaTest;
        closeWaitDialog();
    }).on('click', '.fa-share', function () {
        var strUrl = '/massateste/forward',
            arrUrlParam = [],
            strMessage,
            mixExperiencia,
            strMessage;
        arrUrlParam['idMassaTest'] = ($(this).closest("tr").attr('id')).replace('row', '');
        mixExperiencia = ajaxRequest(strUrl, arrUrlParam, undefined, undefined, undefined, 'json', true);
        strMessage = (mixExperiencia.data.status === 'ok') ? 'Arquivo de Massa encaminhado com sucesso para a funcionalidade "Envio de Dados".' : mixExperiencia.data.messages;
        alertDialog(strMessage, 'Alerta', 300, 200);
    }).on('change', '#coProjeto', function () {
        feedSelect($(this).attr('id'), 'coEvento', '/massateste/ajaxListEventoProjeto');
    });
});

function checkStatus(rowTable) {
    return (rowTable[3] === 'Concluído');
}