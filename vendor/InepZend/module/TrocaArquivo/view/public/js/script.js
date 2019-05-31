function saveData(strFrom)
{
    var from = getObject('from');
    if (!empty(from))
        from.value = strFrom;
    var form = getObject('frm');
    return (!empty(form)) ? form.submit() : true;
}
