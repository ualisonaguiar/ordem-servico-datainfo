$(function () {
    include_once('/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js' + strGlobalSufixJsGzip);
    $(".divTree").sortable();
    $(".divTree").disableSelection();
    $("#btnSalvarArvore").click(function () {
        $("#frm").submit();
    });
    $("#id_tipo").change(function () {
        alterDsConfiguracao($("#id_tipo :selected"));
    });
});

function alterDsConfiguracao(element)
{
    var strValor = '';
    switch (element.text()) {
        case 'CPF':
            strValor = "\\d{3}.\\d{3}.\\d{3}-\\d{2}";
            break;
        case 'Data':
            strValor = "\\d{4}-\\d{2}-\\d{2}";
            break;
        case 'CEP':
            strValor = "\\d{2}.\\d{3}-\\d{3}";
            break;
        case 'Hora':
            strValor = "\\d{2}:\\d{2}:\\d{2}";
            break;
        case 'Data Hora':
            strValor = "\\d{4}-\\d{2}-\\d{2} \\d{2}:\\d{2}:\\d{2}";
            break;
    }

    $("#ds_validacao").val();
    $("#ds_validacao").val(strValor);

}