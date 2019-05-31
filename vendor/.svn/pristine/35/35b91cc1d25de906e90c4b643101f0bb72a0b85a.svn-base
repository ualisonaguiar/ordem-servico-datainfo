function saveData(strFrom)
{
    var from = getObject('from');
    if (!empty(from))
        from.value = strFrom;
    var form = getObject('frm');
    return (!empty(form)) ? form.submit() : true;
}

function renderTree(selectPerfil, strRoute)
{
    var divTree = getObject('divTree');
    if ((empty(selectPerfil)) || (empty(strRoute)) || (empty(divTree)))
        return false;
    if (empty(selectPerfil.value)) {
        divTree.innerHTML = '';
        return true;
    }
    var arrUrlParam = [];
    arrUrlParam['id_perfil'] = selectPerfil.value;
    var strResult = ajaxRequest('/' + strRoute + '/ajaxRenderTree', arrUrlParam, undefined, undefined, undefined, undefined, true);
    divTree.innerHTML = (strResult == '<div class="divTree"></div>') ? '<font style="color: red;">Árvore não encontrada</font>' : strResult;
    return true;
}

function renderForm(mixInvoker, strRoute)
{
    if (empty(mixInvoker))
        return false;
    var divRenderForm = getObject('divRenderForm');
    var invoker = getObject(mixInvoker);
    var textareaTree = getObject('ds_tree');
    if ((empty(strRoute)) || (empty(divRenderForm)) || (empty(invoker)) || (empty(textareaTree)))
        return false;
    if (empty(invoker.value)) {
        divRenderForm.innerHTML = '';
        return true;
    }
    var arrUrlParam = [];
    arrUrlParam[invoker.getAttribute('name')] = invoker.value;
    arrUrlParam['ds_tree'] = textareaTree.value;
    var strResult = ajaxRequest('/' + strRoute + '/ajaxRenderForm', arrUrlParam, undefined, undefined, undefined, undefined, true);
    divRenderForm.innerHTML = strResult;
    return true;
}

function reloadHistory(strRoute)
{
    if (empty(strRoute))
        return false;
    reloadFlexigrid('/' + strRoute + '/ajaxHistoryPaginator');
    return true;
}

function downloadConfigureSsiAcronym(strOperation, grid)
{
    downloadConfigureSsi(strOperation, grid, 'ssi-menu/download-acronym');
}

function downloadConfigureSsiProfile(strOperation, grid)
{
    downloadConfigureSsi(strOperation, grid, 'ssi-acl-route/download-acronym-profile');
}

function downloadConfigureSsi(strOperation, grid, strBaseUrl)
{
    var arrTrSelected = $(".trSelected", grid);
    if (arrTrSelected.length !== 0) {
        var trSelected = arrTrSelected[0];
        window.location.href = strGlobalBasePath + '/' + strBaseUrl + '/' + base64Encode(trSelected.id.replace('row', ''));
    }
}