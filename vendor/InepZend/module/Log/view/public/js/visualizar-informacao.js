$(function () {
    $('.tree li:has(ul)').addClass('parent_li').find(' > span');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).find(' > i').addClass('glyphicon-plus-sign').removeClass('glyphicon-minus-sign');
        } else {
            children.show('fast');
            $(this).find(' > i').addClass('glyphicon-minus-sign').removeClass('glyphicon-plus-sign');
        }
        e.stopPropagation();
    });
});


/**
 *
 * @param {type} field
 * @param {type} strClass
 * @returns {undefined}
 */
function mostrarLog(field, strClass)
{
    field.removeClass(field.attr('class'));
    field.addClass(strClass);
}

/**
 * Metodo responsavel para buscar as informacoes do log referente ao usuario e a data.
 *
 * @param string strIdentificationLog
 * @returns void
 */
function loadInformationLog(strIdentificationLog)
{
    var strUrl = '/log/ajax-information-log';
    var arrUrlParam = [];
    arrUrlParam['strIdentificationLog'] = strIdentificationLog;
    var strHtmlInformationLog = ajaxRequest(strUrl, arrUrlParam, undefined, undefined, undefined, undefined, true);
    return strHtmlInformationLog;
}

$(document).ready(function() {
    $('body').on('click', '.visualizar-log-usuario', function() {
        if ($(this).hasClass('glyphicon-plus-sign')) {
            mostrarLog($(this), 'visualizar-log-usuario icon-minus-sign');
            $(this).parent().children('ul').show();
        } else {
            mostrarLog($(this), 'visualizar-log-usuario icon-plus-sign');
            $(this).parent().children('ul').hide();
            //Ocultando as informacoes do log
            var visualizarLog = $(this).parent().find('ul').find('i');
            visualizarLog.each(function() {
                var divInformacaoLog = $(this).parent().children('div');
                if (!divInformacaoLog.hasClass('hide')) {
                    $(this).trigger('click');
                }
            });
        }
    });
    $('body').on('click', '.visualizar-log', function() {
        var divInformacaoLog = $(this).parent().children('div');
        $(this).focus();
        if (divInformacaoLog.hasClass('hide')) {
            divInformacaoLog.show();
            divInformacaoLog.removeClass('hide');
            mostrarLog($(this), 'visualizar-log glyphicon glyphicon-minus-sign');
            if (empty(divInformacaoLog.attr('ref'))) {
                var strHtmlInformationLog = loadInformationLog($(this).attr('ref'));
                divInformacaoLog.html(strHtmlInformationLog);
                divInformacaoLog.attr('ref', $(this).attr('ref'));
            }
        } else {
            divInformacaoLog.hide();
            divInformacaoLog.addClass('hide');
            mostrarLog($(this), 'visualizar-log glyphicon glyphicon-plus-sign');
        }
    });
});