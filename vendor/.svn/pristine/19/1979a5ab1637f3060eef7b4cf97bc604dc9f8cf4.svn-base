<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular o Element File.
 */
trait File
{

    /**
     * Metodo responsavel em inserir o Element File com seus respectivos tratamentos.
     *
     * @example $this->addFile($strName, $strId, $strLabel, $booRequired = false, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $strMultiple, $booShowLink);
     *
     * @param string $strName
     * @param string $strId
     * @param string $strLabel
     * @param boolean $booRequired
     * @param string $strTitle
     * @param string $strClass
     * @param string $strStyle
     * @param string $strLabelClass
     * @param string $strLabelStyle
     * @param string $strHelpText
     * @param string $strTypeValidateMessage
     * @param string $strDisabled
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strGroupClass
     * @param string $strGroupStyle
     * @param string $strMultiple
     * @param boolean $booShowLink
     * @return mix
     */
    public function addFile($strName = null, $strId = null, $strLabel = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strMultiple = null, $booShowLink = null)
    {
        $arrParamExtra = array(
            array('multiple', 'strMultiple'),
            array('show_link', 'booShowLink'),
        );
        $arrParam = (array)$this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false, $this->removeParamDefault(array(1, 4)));
        $arrParamValue = array(
            'name' => 'noArquivo',
            'label' => 'Arquivo',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrAttribute = array(
            'type' => array('addGeneric', 'InepZend\FormGenerator\Element\File'),
            'multiple' => array('addAttribute'),
        );
        if (@$arrParam['show_link'] === true)
            $arrAttribute['onchange'] = array('addAttribute', 'getFileFromInputFile(this);');
        return $this->getElementConfigured(array($arrParam), 1, $arrParamExtra, $arrAttribute, $this->addDefault(array($arrParam)));
    }

    /**
     * Para utilizacao do crop devera possuir a extensao: imagick.
     *
     * @staticvar boolean $booFileImage
     * @param string $strName
     * @param string $strId
     * @param string $strLabel
     * @param boolean $booRequired
     * @param string $strTitle
     * @param string $strClass
     * @param string $strStyle
     * @param string $strLabelClass
     * @param string $strLabelStyle
     * @param string $strHelpText
     * @param string $strTypeValidateMessage
     * @param string $strDisabled
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strGroupClass
     * @param string $strGroupStyle
     * @param string $strMultiple
     * @param boolean $booShowLink
     * @param integer $intWidth
     * @param integer $intHeight
     * @param boolean $booProportion
     * @param boolean $booCrop
     * @return mix
     */
    public function addFileImage($strName = null, $strId = null, $strLabel = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strMultiple = null, $booShowLink = null, $intWidth = null, $intHeight = null, $booProportion = null, $booCrop = null)
    {
        static $booFileImage;
        $strPrefixFileName = 'file_';
        $strPrefixImgName = 'img_';
        $arrParamExtra = array(
            array('multiple', 'strMultiple'),
            array('show_link', 'booShowLink'),
            array('width', 'intWidth'),
            array('height', 'intHeight'),
            array('proportion', 'booProportion'),
            array('crop', 'booCrop'),
        );
        $arrParam = $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'noImagem',
            'label' => 'Imagem',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrParamUpload = array(
            'required' => @$arrParam['required'],
            'width' => @$arrParam['width'],
            'height' => @$arrParam['height'],
            'proportion' => @$arrParam['proportion'],
            'permited' => array('jpg', 'jpeg', 'gif', 'png', 'bmp'),
        );
        $arrParamFile = array_merge($arrParam, array('name' => $strPrefixFileName . $arrParam['name']));
        $this->addHtml('<div class="well fileImage" style="overflow: hidden; overflow: auto"><h3>' . $arrParamFile['label'] . '</h3>');
        $arrParamFile['label'] = 'Upload';
        $this->addFile($arrParamFile);
        $this->addHidden(array('name' => $arrParam['name'] . '[name]'));
        $this->addHidden(array('name' => $arrParam['name'] . '[tmp_name]'));
//        $this->addText(array('name' => $arrParam['name'] . '[name]'));
//        $this->addText(array('name' => $arrParam['name'] . '[tmp_name]'));
        $this->addHtml('<div>');
        $this->addImage(array('name' => $strPrefixImgName . $arrParam['name'], 'title' => $arrParam['label'], 'src' => '#', 'id' => $strPrefixImgName . $arrParam['name']));
        $this->addHtml('</div>');
        $this->addButton(array('name' => 'btn_incluir_' . $arrParam['name'], 'value' => 'Adicionar Imagem', 'onclick' => 'ajaxUpload(\'' . $strPrefixFileName . $arrParam['name'] . '\', \'uploadManagerFileImage\', [\'' . $arrParam['name'] . '\'], \'/ajaxuploadfile/' . base64_encode(json_encode($arrParamUpload)) . '\');'));
        $this->addButton(array('name' => 'btn_excluir_' . $arrParam['name'], 'value' => 'Excluir Imagem', 'onclick' => "excluirImagem('" . $arrParam['name'] . "')"));
        if ($arrParam['crop'])
            $this->addButton(array('name' => 'btn_crop_' . $arrParam['name'], 'value' => 'Recorta Imagem', 'class' => 'hide', 'onclick' => "managerImageCrop('" . $arrParam['name'] . "', 'btn_crop_" . $arrParam['name'] . "')"));
        $this->addHtml('</div>');
        if ($booFileImage !== true) {
            $booFileImage = true;
            if ($arrParam['crop'])
                $this->addHtml('
                    <link rel="stylesheet" type="text/css" href="/vendor/jcrop/jcrop-0.9.12/css/jquery.Jcrop.min.css" + strGlobalSufixCssGzip>
                    <script type="text/javascript">
                    include_once("/vendor/jcrop/jcrop-0.9.12/js/jquery.Jcrop.min.js" + strGlobalSufixJsGzip);
                    include_once("/vendor/InepZend/theme/administrative-responsible/js/crop.js" + strGlobalSufixJsGzip);
                    </script>');
            $this->addHtml('<script type="text/javascript">include_once("/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js" + strGlobalSufixJsGzip);
    var booImageCrop = ' . (array_key_exists('crop', $arrParam) ? 'true' : 'false') . ';
    function managerFileImage(strFileName, strSource)
    {
        var file = getObject("' . $strPrefixFileName . '" + strFileName);
        var hidden_file = getObject(strFileName + "[name]");
        var hidden_source = getObject(strFileName + "[tmp_name]");
        var image_file = getObject("' . $strPrefixImgName . '" + strFileName);
        var button_incluir = getObject("btn_incluir_" + strFileName);
        var button_excluir = getObject("btn_excluir_" + strFileName);
        var booHasImage = (((file != undefined) && ($(file).val() != "")) || ((hidden_source != undefined) && ($(hidden_source).val() != "")));
        if ((booHasImage) && (strSource == undefined))
            strSource = $(hidden_source).val();
        var booSource = (!((strSource == undefined) || (strSource == "")));
        if (file != undefined)
            $(file).attr("disabled", (!((!booHasImage) || (!booSource))));
        if (hidden_file != undefined) {
            if ((!booHasImage) || (!booSource))
                hidden_file.value = "";
            else if ($(file).val() != "") {
                var arrValue = explode("/", $(file).val().replace(/\\\\/g, "/"));
                hidden_file.value = (arrValue.length > 0) ? arrValue[(arrValue.length - 1)] : $(file).val();
            }
        }
        if (hidden_source != undefined)
            hidden_source.value = ((!booHasImage) || (!booSource)) ? "" : strSource;
        if (image_file != undefined) {
            image_file.parentNode.style.display = (booHasImage) ? "" : "none";
            if (!booSource) {
                if (!document.all)
                    image_file.removeAttribute("src");
                image_file.parentNode.style.display = "none";
            } else
                image_file.setAttribute("src", strGlobalBasePath + strGlobalShowFileUrl + "?path=" + base64Encode(strSource));
        }
        if (button_incluir != undefined) {
            button_incluir.style.display = ((!booHasImage) || (!booSource)) ? "" : "none";
            image_file.setAttribute("style", "");
        }
        if (button_excluir != undefined)
            button_excluir.style.display = ((!booHasImage) || (!booSource)) ? "none" : "";
        return true;
    }
    function uploadManagerFileImage(jqXHR, arrParam)
    {
        var json = getJsonObject(jqXHR.responseText);
        if (json.status != "ok") {
            var strMessage = json.message;
            if ((strMessage == undefined) || (strMessage == ""))
                strMessage = json.messages;
            if ((strMessage == undefined) || (strMessage == ""))
                strMessage = "Ocorreu um erro e a operação não pôde ser realizada!";
            alertDialog(strMessage, "Erro", 350, 160);
        } else {
            managerFileImage(arrParam[0], json.file);
            if (booImageCrop)
                enableButtonCrop("' . $arrParam['name'] . '");
        }
    }
    function removeFileImage(strFileName)
    {
        var hidden_file = getObject(strFileName + "[name]");
        var hidden_source = getObject(strFileName + "[tmp_name]");
        if ((hidden_file == undefined) || (hidden_source == undefined) || ($(hidden_source).val() == ""))
            return false;
        var arrUrlParam = new Array();
        arrUrlParam["file"] = hidden_source.value;
        return ajaxRequest("/ajaxremovefile", arrUrlParam, "removeFileImageAfterAjax", [strFileName], undefined, undefined, true);
    }
    function removeFileImageAfterAjax(mixData, arrParam)
    {
        if (mixData == "ok") {
            var strFileName = arrParam[0];
            var file = getObject("' . $strPrefixFileName . '" + strFileName);
            if (file != undefined) {
                if (document.all)
                    $(file).replaceWith($(file).clone(true));
                else
                    $(file).val(""); 
            }
            var hidden_source = getObject(strFileName + "[tmp_name]");
            if (hidden_source != undefined)
                $(hidden_source).val("");
            managerFileImage(strFileName);
            if (booImageCrop)
                destroyCrop("' . $arrParam['name'] . '");
        } else
            alertDialog("Ocorreu um erro e a operação não pôde ser realizada!", "Erro", 350, 150);
    }
    function destroyCrop(strIdFiled)
    {
        var jcrop_api = $.Jcrop("#img_" + strIdFiled, {
            onChange: exibePreview,
            onSelect: exibePreview,
        });
        jcrop_api.destroy();
        updateButton(strIdFiled, strIdFiled, "Recorte Imagem", "managerImageCrop");
        $("#btn_crop_" + strIdFiled).addClass("hide");
        $(\'.jcrop-holder img\').parent().remove();
    }
    
    function excluirImagem(strFileName) {
        $(\'#img_\' + strFileName).Jcrop({
            onChange: exibePreview,
            onSelect: exibePreview,
        }, function () {
            jcrop_api = this;
        });
        $(\'#img_\' + strFileName).attr(\'style\', \'height: auto; width:auto\');
        jcrop_api.destroy();
        confirmDialog(
            \'Deseja realmente realizar a operação de EXCLUSÃO desta imagem?\',
            \'Operação de EXCLUSÃO\',
            300,
            200,
            \'removeFileImage("\' + strFileName +\'")\',
            \'cancelarAcaoExcluir("\' + strFileName +\'")\'
        );
    }
    
    function cancelarAcaoExcluir(strIdFiled) {
        $(\'#img_\' + strIdFiled).Jcrop({
            onChange: exibePreview,
            onSelect: exibePreview,
        }, function () {
            jcrop_api = this;
        });
        updateButton(strIdFiled, \'btn_crop_\' + strIdFiled, \'Recorte Imagem\', \'managerImageCrop\');
    }
    
    function cropImagem(strFileName, strIdButton) {
        var arrParam = [];
        arrParam[\'tmp_name\'] = getObject(strFileName + \'[tmp_name]\').value;
        arrParam[\'coordinate\'] = $(\'#coord_image_crop\').val();
        var result = JSON.parse(ajaxRequest("/ajaxuploadfilecrop", arrParam, null, null, null, null, true));
        jcrop_api.disable();
        jcrop_api.release();
        if (result.status == "ok") {
            jcrop_api.setImage(strGlobalBasePath + result.file);
            $(\'#img_\' + strFileName).attr(\'src\', strGlobalBasePath + result.file);
            updateButton(strFileName, strIdButton, \'Recorte Imagem\', \'managerImageCrop\');
        } else
            alertDialog(result.messages, \'Erro\', 500, 300);
    }    
    ');
        }
        $this->addHtml('managerFileImage("' . $arrParam['name'] . '");</script>');
        return $this;
    }

    /**
     * @param string $strLabel
     * @param array $arrPlaceHolder
     * @param array $arrRequired
     * @param string $strTypeValidateMessage
     * @param array $arrDisabled
     * @param array $arrResource
     * @param string $strActionToResourceNotAllowed
     * @param array $arrReadonly
     * @param array $arrNotShow
     * @param array $arrSuggestion
     * @param array $arrExtensionPermited
     */
    public function addFileCrud($strLabel = null, $arrPlaceHolder = null, $arrRequired = null, $strTypeValidateMessage = null, $arrDisabled = null, $arrResource = null, $strActionToResourceNotAllowed = null, $arrReadonly = null, $arrNotShow = null, $arrSuggestion = null, $arrExtensionPermited = null)
    {
        $arrParamExtra = array(
            array('readonly', 'strReadonly'),
            array('not_show', 'arrNotShow'),
            array('suggestion', 'arrSuggestion'),
            array('permited', 'arrExtensionPermited'),
        );
        $arrParam = $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false, $this->removeParamDefault(array(0, 1, 2, 6, 7, 8, 9, 10, 11, 16, 17, 18, 19)));
        $strLabel = @$arrParam['label'];
        if (empty($strLabel))
            $strLabel = 'Arquivo(s)';
        $this->addHtml('<script type="text/javascript">$(document).ready(function () {include_once("/vendor/InepZend/js/form-generator.js" + strGlobalSufixJsGzip);});</script>');
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>' . $strLabel . '</h3><div style="overflow: hidden;">');
        $this->addFile(array('style' => 'float: left;', 'group_style' => 'width: 78%;', 'label' => 'Upload', 'attr_data' => array('domain' => 'no_arquivo')));
        $this->addButton(array('title' => 'Adicionar Arquivo', 'onclick' => 'insertIntoCrud(\'no_arquivo\', \'' . base64_encode(json_encode(array('permited' => (array)@$arrParam['permited']))) . '\');'));
        $this->addHtml('</div><script type="text/javascript">
    function removeFile(icon)
    {
        var json = getJsonObject($(icon.parentNode).children("input").val());
        var strFileName = json["noArquivo[tmp_name]"];
        if (strFileName == undefined)
            return false;
        var arrUrlParam = new Array();
        arrUrlParam["file"] = strFileName;
        return ajaxRequest("/ajaxremovefile", arrUrlParam, "removeFileAfterAjax", [icon], undefined, undefined, true);
    }
    function removeFileAfterAjax(mixData, arrParam)
    {
        if (mixData == "ok")
            removeFromCrudAfterConfirm();
        else
            alertDialog("Ocorreu um erro e a operação não pôde ser realizada!", "Erro", 350, 150);
    }
        </script>');
        $this->addTable(array('name' => 'no_arquivo', 'title' => array('Arquivo' => array(array('noArquivo[link]', 'noArquivo[name]'))), 'sort' => 'event', 'icon' => array(array('class' => 'fa fa-trash', 'title' => 'Excluir Arquivo', 'onclick' => 'iconGlobal = this; confirmDialog(\'Deseja realmente realizar a operação de EXCLUSÃO deste registro?\', \'Operação de EXCLUSÃO\', 300, 200, \'removeFile(iconGlobal);\');'))));
        $this->addHtml('</div>');
        return $this;
    }

}
