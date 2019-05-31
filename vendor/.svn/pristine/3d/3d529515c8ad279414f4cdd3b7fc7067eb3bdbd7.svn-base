function updateDataPersonal()
{
    openWaitDialog();
    var result = JSON.parse(ajaxRequest('/ssi-personal-info/ajaxGetDataReceitaFederal', []));
    closeWaitDialog();
    showMessageError(result);
    var formComparacaoReceita = getObject('frm[PersonalInfoCompare]');
    formComparacaoReceita.no_pessoa_fisicareceita.value = result.data.nome;
    formComparacaoReceita.no_maereceita.value = result.data.nomeMae;
    formComparacaoReceita.tp_sexoreceita.value = result.data.tipoSexo;
    formComparacaoReceita.dt_nascimentoreceita.value = result.data.dataNascimento;
    $('.ui-dialog .col-md-5:first label').removeClass('alert-danger');
    openDialog('frm[PersonalInfoCompare]', 'Comparação dados do Sistema com a Receita Federal', 1230, 550, null, null, null, null, null, 'formComparacaoDadosReceita');
    $('.ui-dialog .col-md-5:first input:text, .ui-dialog .col-md-5:first input:radio:checked').each(function () {
        var strDataElementSystem = $(this).val(),
                strDataElementReceita = $('.ui-dialog .col-md-5 input[name="' + $(this).attr('name') + 'receita"]').val();
        if ($(this).attr('type') == 'radio')
            strDataElementReceita = $('.ui-dialog .col-md-5 input[name="' + $(this).attr('name') + 'receita"]:checked').val()
        if (strDataElementSystem !== strDataElementReceita) {
            if ($(this).attr('type') == 'text')
                $('.ui-dialog .col-md-5:first label[for="' + $(this).attr('id') + '"]').addClass('alert-danger');
            else
                $(this).parent().parent().children('label').addClass('alert-danger');
        }
    });
}

function showMessageError(result)
{
    if (!result.data) {
        closeDialog('formComparacaoDadosReceita');
        alertDialog(result.message, 'Aviso', 350, 160);
        return false;
    }
}

$(function () {
    $('body').on('click', '.ui-dialog #btnCancelar', function () {
        $('.ui-dialog-titlebar-close').trigger('click');
    }).on('click', '.ui-dialog #btnAtualizar', function () {
        openWaitDialog();
        var result = JSON.parse(ajaxRequest('/ssi-personal-info/ajaxSaveData', []));
        closeWaitDialog();
        showMessageError(result);
        $('.ui-dialog #btnCancelar').trigger('click');
        var formDataPersonal = getObject('frm');
        formDataPersonal.nu_cpf.value = result.data.cpf;
        formDataPersonal.no_pessoa_fisica.value = result.data.nome;
        formDataPersonal.no_mae.value = result.data.nomeMae;
        formDataPersonal.dt_nascimento.value = result.data.dataNascimento;
        formDataPersonal.tp_sexo.value = result.data.tipoSexo;

        alertDialog('Dados pessoais atualizado com sucesso.', 'Aviso', 350, 160);
    });
});