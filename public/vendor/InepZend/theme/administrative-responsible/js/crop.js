var jcrop_api;

/**
 *
 * @param {type} strFileName
 * @param {type} strIdButton
 * @returns {undefined}
 */
function managerImageCrop(strFileName, strIdButton)
{
    $('#img_' + strFileName).Jcrop({
        onChange: exibePreview,
        onSelect: exibePreview,
    }, function () {
        jcrop_api = this;
    });
    jcrop_api.enable();
    updateButton(strFileName, strIdButton, 'Salvar Recorte', 'cropImagem');
}

/**
 *
 * @param {type} coordinateImage
 * @returns {undefined}
 */
function exibePreview(coordinateImage)
{
    var strCoordinate = coordinateImage.w + '|' + coordinateImage.h + '|' + coordinateImage.x + '|' + coordinateImage.y;
    if (!$('#coord_image_crop').length)
        createHiddenIntoRepository('formAjaxUpload', 'coord_image_crop', 'coord_image_crop', null);
    $('#coord_image_crop').val(strCoordinate);
}

/**
 *
 * @param {type} strFileName
 * @param {type} strIdButton
 * @param {type} strLabel
 * @param {type} strFunction
 * @returns {undefined}
 */
function updateButton(strFileName, strIdButton, strLabel, strFunction)
{
    var buttonImagem = $('#' + strIdButton);
    buttonImagem.attr('title', strLabel).attr('value', strLabel).data('type-action', 'salve').attr('onclick', strFunction + "('" + strFileName + "', '" + strIdButton + "');");
    buttonImagem.html(strLabel);
    buttonImagem.focus();
}

/**
 *
 * @param {type} strIdButton
 * @returns {undefined}
 */
function enableButtonCrop(strIdButton)
{
    $('#btn_crop_' + strIdButton).removeClass('hide');
}
