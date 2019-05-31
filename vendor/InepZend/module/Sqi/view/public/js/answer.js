$(document).ready(function(){
    $.each(respostas,function(intIndex, strValue){
        if (intIndex.indexOf('respostaRadio') !== -1) {
            $('#' + strValue).click();
        } else {
            if ($('#' + intIndex).attr('type') == 'checkbox') {
                $('#' + intIndex).attr('checked','checked');
                verificaDependenciaCheck($('#' + intIndex));
            } else {
                $('#' + intIndex).val(strValue);
            }
        }
    });
});
