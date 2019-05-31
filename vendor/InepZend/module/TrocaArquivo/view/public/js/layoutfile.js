function redirecionarConfiguracao(strOperation, grid)
{
    var arrTrSelected = $('.trSelected', grid);
    var trSelected = arrTrSelected[0];
    var strPk = trSelected.id.replace('row', '');
    window.location.href = strGlobalBasePath + '/configenvio/add/' + strPk;
}

function redirecionarEstrutural(strOperation, grid)
{
    var arrTrSelected = $('.trSelected', grid);
    var trSelected = arrTrSelected[0];
    var strPk = trSelected.id.replace('row', '');
    window.location.href = strGlobalBasePath + '/layoutestrutural/index/' + strPk;
}

function redirecionarRegraValidacao(strOperation, grid)
{
    var arrTrSelected = $('.trSelected', grid);
    var trSelected = arrTrSelected[0];
    var strPk = trSelected.id.replace('row', '');
    window.location.href = strGlobalBasePath + '/regravalidacao/index/' + strPk;
}

function condicao(arrRecord)
{
    return (arrRecord.getInStatus == 'Ativo') ? true : false;
}

function condicao2(arrRecord)
{
    return (arrRecord.getInStatus == 'Inativo') ? true : false;
}

function changeStatus(strOperation, grid)
{
    var arrTrSelected = $('.trSelected', grid);
    var trSelected = arrTrSelected[0];
    var strPk = trSelected.id.replace('row', '');
    $.post('layoutfile/ajax-status', {'id_layout': strPk}, function (data) {
        alert(data.message);
        filterPaginator('/layoutfile/ajaxFilter', 'frm');
    });
}