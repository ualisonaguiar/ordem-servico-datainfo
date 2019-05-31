include_once('/vendor/codepress/codepress-0.9.6/codepress.js');
$(function () {
    $('.counterCharacters_dsQuery').hide();
    setTimeout("dsQuery.edit('', 'sql');", 1000);
    
    $('#btnSalvar').click(function () {
        var strCode = dsQuery.getCode();
        dsQuery.toggleEditor();
        $('#dsQuery').val(strCode);
    });
});