/**
 * 
 * @param STRING strOperation
 * @param OBJECT grid
 * @return BOOLEAN
 */
function showLog(strOperation, grid)
{
    var strUrl = '/log/show/';
    var arrTrSelected = $('.trSelected', grid);
    if (arrTrSelected.length !== 0) {
        setTimeout('openWaitDialog();', 100);
        var trSelected = arrTrSelected[0];
        var strPk = trSelected.id.replace('row', '');
        window.location.href = strGlobalBasePath + strUrl + base64Encode(strPk);
        return true;
    }
    alertDialog('É necessário selecionar algum registro para realizar a operação de ' + strOperation.toUpperCase() + '!', 'Operação de ' + strOperation.toUpperCase(), 300, 200);
    return false;
}

/**
 * 
 * @param STRING strOperation
 * @param OBJECT grid
 * @return BOOLEAN
 */
function addFileDownload(strOperation, grid)
{
    var arrTrSelected = $('.trSelected', grid);
    var trSelected = arrTrSelected[0];
    var strPathFile = base64Encode(trSelected.id.replace('row', ''));
    var strNameFile = returnDataLine(arrTrSelected, 0);
    var strDateCreate = returnDataLine(arrTrSelected, 3);
    var strLevel = returnDataLine(arrTrSelected, 4);
    if ($("#listFileDownload input:hidden[value='" + strPathFile + "']").length) {
        alertDialog('Esse item já foi adicionado na tabela "Arquivos para download".', 'Operação de ' + strOperation, 350, 150);
        return false;
    }
    $('#listFileDownload tbody').append(
            '<tr>' +
            '<td>' +
            strNameFile +
            '<input type="hidden" name="fileDownload[]" value=' + strPathFile + '>' +
            '</td>' +
            '<td>' + strDateCreate + '</td>' +
            '<td>' + strLevel + '</td>' +
            '<td><div class="removeRegistro icoDelete" title="Remover item da lista"></div></td>' +
            '</tr>'
            );
    $('#listFileDownload').removeClass('hide');
    $('#btnDownload').removeClass('hide');
}

/**
 * 
 * @param OBJECT trSelected
 * @param INTEGER intPosicao
 * @return STRING
 */
function returnDataLine(trSelected, intPosicao)
{
    return trSelected.children('td:eq(' + intPosicao + ')').children('div').text();
}

/**
 * 
 * @param STRING strPathArquivo
 * @return VOID
 */
function removeItemFileDownload(strPathArquivo)
{
    var trLineRemove = $("#listFileDownload input:hidden[value='" + strPathArquivo + "']").parent().parent().remove();
    if ($("#listFileDownload tbody tr").length === 0) {
        $("#listFileDownload").addClass('hide');
        $('#btnDownload').addClass('hide');
    }
}

$(document).ready(function() {
    $('body').on('click', '.removeRegistro', function() {
        var strPathFile = $(this).parent().parent().find('input:hidden').val();
        confirmDialog('Deseja realmente remover este item da lista?', 'Confirmação', 300, 150, "removeItemFileDownload('" + strPathFile + "')");
    });
    $('#btnDownload').click(function() {
        $('#formDownload').submit();
    });
    $('body').on('click', '.paginatorRoute', function() {
        setTimeout('openWaitDialog();', 100);
    });
});