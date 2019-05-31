var strAcronymHigher = '',
    strNameFunctionCallbackEdit = 'editLineTree',
    strNameFunctionCallbackInsert = 'insertLineTree';
var hanKeepAction = {
    openModal: function (strTitle, strAcronymSsi, intLevel, strFunctionCallBack) {
        openDialog('frmModal', strTitle, 900, 630, undefined, undefined, undefined, undefined, undefined, 'formKeepAction');
        clearValuesFromFieldsForm('frmModal');
        $('.ui-widget-header .ui-dialog-title').html(strTitle);
        $('#function_callback').val(strFunctionCallBack);
        if (strAcronymSsi)
            $('.ui-dialog #sg_acao').val(strAcronymSsi + '_');
        $('.ui-dialog #level_tree').val(intLevel);
        $('.ui-dialog-content #modal-keep-action').removeClass('hide');
    },
    getInformation: function (arrParam) {
        return JSON.parse(ajaxRequest('/ssi-menu/information-acronym-ssi', arrParam));
    },
    getInformationAcronym: function (element) {
        var arrParam = [];
        arrParam['acronymSsi'] = element.parent().parent().find('input:hidden').val();
        return this.getInformation(arrParam);
    },
    getIndexTreeItem: function (element) {
        return element.parent().parent().index();
    },
    getUpdateDivAction: function (strAcronym, elementDiv) {
        var intWidth = 42;
        if (strAcronym.indexOf('__') != -1) {
            elementDiv.find('.fa-plus-circle').remove();
            intWidth = 30;
        }
        else if (!elementDiv.find('.fa-plus-circle').length) {
            if (elementDiv.html())
                elementDiv.append((elementDiv.html().match(/&nbsp;/g).length == 1) ? '&nbsp;' : '');
            elementDiv.append('<i title="Inserir Ação Filho" class="fa fa fa-plus-circle"></i>');
        }
        elementDiv.attr('style', 'width: ' + intWidth + 'px; height:19px;');
        return elementDiv;
    },
    insertTreeRoot: function (strName, strAcronym, strDescription, intLevel) {
        var strHtml = '<div class="divTreeItem divTreeItem' + intLevel + '" title="' + strDescription + '" data-level="' + intLevel + '" data-acronym="' + strAcronym + '">';
        strHtml += strName;
        strHtml += '<input type="hidden" name="acao[]">';
        strHtml += '<div class="pull-right" style="width: 50px; height:19px;">';
        strHtml += '<i title="Editar item" class="fa fa-pencil-square-o"></i>&nbsp;';
        strHtml += '<i title="Excluir item" class="fa fa-trash-o"></i>&nbsp;';
        strHtml += '</div></div>';
        $('.divTree').append(strHtml);
        var elementTreeItem = $('.divTreeItem:last');
        var arrParamResult = this.saveLineTreeItem(strName, strAcronym, strDescription, elementTreeItem);
        elementTreeItem
                .append(arrParamResult['input_hidden'])
                .append(arrParamResult['button_action']);
    },
    insertLineTree: function (strName, strAcronym, strDescription, intLevel) {
        var elementTreeItem = $('.divTreeItem').eq(intLevel).clone();
        var arrParamResult = this.saveLineTreeItem(strName, strAcronym, strDescription, elementTreeItem);
        var intLevelAcronym = $('.divTreeItem').eq(intLevel).attr('data-level');
        elementTreeItem.removeClass('divTreeItem' + intLevelAcronym)
                .addClass('divTreeItem' + (parseInt(intLevelAcronym) + 1))
                .attr('data-acronym', strAcronym)
                .attr('title', strDescription)
                .attr('data-level', (parseInt(intLevelAcronym) + 1))
                .text(strName)
                .append(arrParamResult['input_hidden'])
                .append(arrParamResult['button_action']);
        $('.divTreeItem').eq(intLevel).after(elementTreeItem);
    },
    editLineTree: function (strName, strAcronym, strDescription, intLevel) {
        var elementTreeItem = $('.divTreeItem').eq(intLevel);
        var strAcronymOld = elementTreeItem.attr('data-acronym');
        var arrParamResult = this.saveLineTreeItem(strName, strAcronym, strDescription, elementTreeItem);
        elementTreeItem
                .attr('data-acronym', strAcronym)
                .attr('title', strDescription)
                .text(strName);
        elementTreeItem
                .append(arrParamResult['input_hidden'])
                .append(arrParamResult['button_action']);
        if (strAcronymOld != strAcronym) {
            if ($(".divTree div[data-acronym*='" + strAcronym + "']").next().length) {
                var elementTree = $(".divTree div[data-acronym*='" + strAcronymOld + "']");
                if (elementTreeItem.attr('data-level') != '0')
                    elementTree.remove();
                else
                    elementTree.next().remove();
            }
        }
    },
    saveLineTreeItem: function (strName, strAcronym, strDescription, elementTreeItem) {
        var arrParam = [];
        var arrParamResult = [];
        arrParam['no_acao'] = trim(strName);
        arrParam['sg_acao'] = trim(strAcronym);
        arrParam['ds_acao'] = trim(strDescription);
        arrParam['no_route'] = trim(strDescription);
        var resultInformationAcronym = this.getInformation(arrParam);
        arrParamResult['input_hidden'] = elementTreeItem.find('input:hidden').val(resultInformationAcronym.acronymSsi);
        arrParamResult['button_action'] = this.getUpdateDivAction(strAcronym, elementTreeItem.find('.pull-right'));
        return arrParamResult;
    },
    addAction: function (element) {
        var informationAction = this.getInformationAcronym(element);
        this.openModal('Nova Ação do SSI', informationAction.sg_acao, this.getIndexTreeItem(element), strNameFunctionCallbackInsert);
    },
    editAction: function (element) {
        hanKeepAction.openModal('Editar Ação do SSI', undefined, this.getIndexTreeItem(element), strNameFunctionCallbackEdit);
        var informationAction = this.getInformationAcronym(element);
        $('.ui-dialog #no_acao:last').val(informationAction.no_acao);
        $('.span-sg_acao').val($('.ui-dialog #sg_acao:last').val());
        if (informationAction.sg_acao.indexOf('__') != -1)
            $('.ui-dialog #no_route:last').val(informationAction.sg_acao.substr(informationAction.sg_acao.indexOf('__') + 2));
        $('.ui-dialog #sg_acao:last').val(informationAction.sg_acao);
        $('.ui-dialog #ds_acao:last').val(informationAction.ds_acao);
        $('.ui-dialog #level_tree:last').val(this.getIndexTreeItem(element));
    },
    removeAction: function (intLevel) {
        $(".divTree div[data-acronym*='" + $('.divTreeItem').eq(intLevel).attr('data-acronym') + "']").remove();
    },
    getAcronymHigher: function (intPositionElement) {
        for (var intPosition = intPositionElement; --intPosition >= 0; ) {
            if (parseInt($(".divTreeItem").eq(intPosition).attr('data-level')) == parseInt($(".divTreeItem").eq(intPositionElement).attr('data-level') - 1)) {
                strAcronymHigher = $(".divTreeItem").eq(intPosition).attr('data-acronym');
                break;
            }
        }
        return strAcronymHigher;
    },
    convertDefaulAcronym: function (strValue) {
        strValue = replaceAll(replaceAll(strValue, 'ç', 'c'), 'Ç', 'C');
        return strValue.replace(/[^a-zA-Z0-9_]/g, '').toUpperCase();
    },
    generateAcronymToRoute: function (strValueRoute) {
        return '__' + this.convertDefaulAcronym(strValueRoute);
    },
    removeVowels: function (strValue) {
        return strValue.replace(/[AEIOU]/g, '');
    },
    mixAcronymName: function (strValue, strType) {
        var strAcronymHigher = '',
            strAcronym,
            arrAcronym;
        if ($('#function_callback').val() != strNameFunctionCallbackEdit)
            strAcronymHigher = ($('#function_callback').val() == strNameFunctionCallbackInsert) ? $('.span-sg_acao').val() : '';
        else
            strAcronymHigher = hanKeepAction.getAcronymHigher($('.ui-dialog #level_tree').val());
        if ($('.ui-dialog #no_acao:last').val()) {
            var strAcronymNew = this.convertDefaulAcronym(strValue);
            if ($('#function_callback').val() != strNameFunctionCallbackEdit) {
                if (strType == 'nome') {
                    strAcronymHigher = strAcronymHigher + this.removeVowels(strAcronymNew);
                    if ($('.ui-dialog #no_route:last').val())
                        strAcronymHigher += this.generateAcronymToRoute($('.ui-dialog #no_route:last').val());
                } else {
                    strAcronymHigher = strAcronymHigher + this.removeVowels(this.convertDefaulAcronym($('.ui-dialog #no_acao:last').val()));                    
                    if (strAcronymNew)
                        strAcronymHigher += '__' + strAcronymNew;
                }
            } else {
                strAcronym = $('.ui-dialog #sg_acao:last').val();
                if (strAcronymHigher)
                    strAcronymHigher += '_';
                strAcronymHigher += this.removeVowels(strAcronymNew);
                if (strType == 'nome') {
                    if ($('.ui-dialog #no_route:last').val())
                        strAcronymHigher += this.generateAcronymToRoute($('.ui-dialog #no_route:last').val());
                    
                } else {
                    arrAcronym = strAcronym.split('__');
                    if (this.convertDefaulAcronym($('.ui-dialog #no_route:last').val()))
                        strAcronymHigher = arrAcronym[0] + '__' + this.convertDefaulAcronym($('.ui-dialog #no_route:last').val());
                    else
                        strAcronymHigher = arrAcronym[0];
                }
            }
        }
        return strAcronymHigher;
    }
};

$(function () {
    include_once('/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js' + strGlobalSufixJsGzip);
    $(".divTree").sortable({
        connectWith: 'ul',
        dropOnEmpty: false,
        change: function (event, element) {
            hanKeepAction.getAcronymHigher(element.helper.index());
        },
        update: function (event, element) {
            if (strAcronymHigher) {
                strAcronymHigherOld = strAcronymHigher;
                hanKeepAction.getAcronymHigher(element.item.index());
                if (!$(".divTree div[data-acronym='" + strAcronymHigher + "'] i.fa-plus-circle").length)
                    return false;
                hanKeepAction.editLineTree(
                    element.item.text(),
                    replaceAll(element.item.attr('data-acronym'), strAcronymHigherOld + '_', strAcronymHigher + '_'),
                    element.item.attr('title'),
                    element.item.index()
                );
            } else
                return false;
        }
    });
    $('body').on('click', '#btnInsertAction', function () {
        hanKeepAction.openModal('Nova Ação do SSI', undefined, 0, 'insertTreeRoot');
    }).on('click', '.fa-plus-circle', function () {
        var informationAction = hanKeepAction.getInformationAcronym($(this));
        hanKeepAction.openModal('Nova Ação do SSI', informationAction.sg_acao, hanKeepAction.getIndexTreeItem($(this)), strNameFunctionCallbackInsert);
        $('.span-sg_acao').val($('.ui-dialog #sg_acao:last').val());
    }).on('click', '.fa-trash-o', function () {
        confirmDialog('Deseja realmente excluir esta ação?', 'Confirmar', 306, 180, "hanKeepAction.removeAction('" + hanKeepAction.getIndexTreeItem($(this)) + "')");
    }).on('click', '.fa-pencil-square-o', function () {
        hanKeepAction.editAction($(this));
        $('.span-sg_acao').val($('.ui-dialog #sg_acao:last').val());
    }).on('click', '.ui-dialog-titlebar-close, #btnCancelar', function () {
        closeDialog('formKeepAction');
    }).on('click', '#btnSalvar', function () {
        if ($('#frmModal').valid()) {
            var strMethod = $('#function_callback').val();
            eval("hanKeepAction." + strMethod + "($('.ui-dialog #no_acao:last').val(), $('.ui-dialog #sg_acao:last').val(), $('.ui-dialog #ds_acao:last').val(), $('.ui-dialog #level_tree:last').val())");
            $('.ui-dialog-titlebar-close').trigger('click');
        }
    }).on('keyup', '.ui-dialog #no_acao:last', function () {
        $('.ui-dialog #sg_acao:last').val(hanKeepAction.mixAcronymName($(this).val(), 'nome'));
    }).on('keyup', '.ui-dialog #no_route:last', function () {
        $('.ui-dialog #sg_acao:last').val(hanKeepAction.mixAcronymName($(this).val(), 'rota'));
    });
});