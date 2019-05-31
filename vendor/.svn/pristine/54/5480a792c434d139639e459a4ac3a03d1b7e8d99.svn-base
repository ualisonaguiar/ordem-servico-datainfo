$(document).ready(function(){
    $('.questionario input:radio').click(function() {
        verificaDependenciaRadio($(this));
    });

    $('.questionario input:checkbox').click(function() {
        verificaDependenciaCheck($(this));
    });
    
});

function verificaDependenciaCheck(element) {
    var strId = element.attr('id');
    if (element.is(":checked")) {
        verificaDependencia($("fieldSet[class*=idQuestaoItemPai_item_" + strId + "]"));
        verificaDependencia($("fieldSet[class*='idQuestaoItemPai_" + strId + "']"));
    }
    else {
        verificaDependenciaInvertida($("fieldSet[class*=idQuestaoItemPai_item_" + strId + "]"));
        verificaDependenciaInvertida($("fieldSet[class*='idQuestaoItemPai_" + strId + "']"));
            
    }
}
function verificaDependenciaRadio(element) {
    var strClasse = element.attr('class');
    var strId = element.attr('id');
    strClasse = strClasse.replace(' valid','');
    strClasse = strClasse.replace(' error','');
    verificaDependenciaInvertida($("fieldSet[class*=item_" + strClasse + "]"));
    verificaDependenciaInvertida( $("fieldSet[class*=" + strClasse + "]"));
    verificaDependencia($("fieldSet[class*=idQuestaoItemPai_item_" + strId + "]"));
    verificaDependencia($("fieldSet[class*='idQuestaoItemPai_" + strId + "']"));
}

function verificaVisualizacaoGrupoQuestao(fieldset) {
    var grupo = fieldset.parent('.subgrupoQuestao').parent('.grupoQuestao');
    if (grupo.children("div.subgrupoQuestao:not([style='display: none;'])").length === 0) {
        grupo.hide();
    }
}

function verificaVisualizacaoSubgrupoQuestao(fieldset) {
    var subgrupo = fieldset.parent('.subgrupoQuestao');
    if (subgrupo.children('div.questao').length === 0 && subgrupo.children("fieldset:not([style='display: none;'])").length === 0) {
        subgrupo.hide();
    }
}

function verificaDependencia(arrFieldset) {
    
    arrFieldset.each(function(intIndex) {
        var fieldset = $(this);
        var subgrupo = fieldset.parent('.subgrupoQuestao');
        var grupo = subgrupo.parent('.grupoQuestao');
        if (fieldset.attr('habilitar')) {
           fieldset.removeAttr('disabled');
        } else if(fieldset.attr('exibir')) {
           grupo.show();
           subgrupo.show();
           fieldset.removeAttr('disabled').show();
        } else if(fieldset.attr('desabilitar')) {
            fieldset.attr('disabled','true');
        } else if(fieldset.attr('ocultar')) {
            fieldset.attr('disabled', 'disabled').hide();
            verificaVisualizacaoSubgrupoQuestao(fieldset);
            verificaVisualizacaoGrupoQuestao(fieldset);

        }
    });
}

function verificaDependenciaInvertida(arrFieldset) {
     arrFieldset.each(function(intIndex) {
        var fieldset = $(this);
        var subgrupo = fieldset.parent('.subgrupoQuestao');
        var grupo = subgrupo.parent('.grupoQuestao');

        if (fieldset.attr('habilitar')) {
            fieldset.attr('disabled','disabled');
        } else if(fieldset.attr('exibir')) {
            fieldset.attr('disabled', 'disabled').hide();
            verificaVisualizacaoSubgrupoQuestao(fieldset);
            verificaVisualizacaoGrupoQuestao(fieldset);
        } else if(fieldset.attr('desabilitar')) {
            fieldset.removeAttr('disabled').show();
        } else if(fieldset.attr('ocultar')) {
            grupo.show();
            subgrupo.show();
            fieldset.removeAttr('disabled').show();
        }
     });
}