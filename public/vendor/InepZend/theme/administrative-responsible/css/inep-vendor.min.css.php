<?php 
$intLastModifiedTime = filemtime(__FILE__);
$strETag = md5_file(__FILE__);
header("Last-Modified: " . gmdate("D, d M Y H:i:s", $intLastModifiedTime) . " GMT");
header("Etag: " . $strETag);
header("Content-Type: text/css");
header("Cache-Control: max-age=604800, public, must-revalidate");
header("Pragma: max-age=604800, public, must-revalidate");
if ((is_null($mixZlib = ini_get("zlib.output_compression"))) || ($mixZlib == ""))
    ini_set("zlib.output_compression", true);
header("Accept-Encoding: gzip");
if ((@strtotime($_SERVER["HTTP_IF_MODIFIED_SINCE"]) == $intLastModifiedTime) || (trim(@$_SERVER["HTTP_IF_NONE_MATCH"]) == $strETag)) {
    header("HTTP/1.1 304 Not Modified");
    exit;
}
?>
@media
screen{body.contrast .col-xs-6,
body.contrast .col-sm-9,
body.contrast .panel-info{background-color:#000}body.contrast
#nav{color:#FFF !important}body.contrast #menu-administrative-responsible
a{color:#FFF}body.contrast #menu-administrative-responsible a:focus,
body.contrast #menu-administrative-responsible a:hover{background-color:#333;color:#F0AD4E}body.contrast
footer{background-color:#222 !important}body.contrast .caixaVazada,
body.contrast
.well{background:none;border:1px
solid #222}body.contrast h1,
body.contrast
.h1{border-bottom:1px solid #EEE !important}body.contrast .h-form,
body.contrast table
th{background-color:#333 !important;border-bottom:1px solid #444}body.contrast .dropdown-menu > li > a:focus,
body.contrast .dropdown-menu > li > a:hover,
body.contrast .multi-level > a:focus,
body.contrast .multi-level>a:hover{background-color:#333 !important;color:#F0AD4E;border-radius:3px}body.contrast .dropdown-menu > .active > a,
body.contrast .dropdown-menu > .active > a:focus,
body.contrast .dropdown-menu>.active>a:hover{background-color:#333 !important;color:#F0AD4E !important}body.contrast .nav .open > a,
body.contrast .nav .open > a:focus,
body.contrast .nav .open>a:hover{background-color:#333;border-color:#333}body.contrast .sidebar,
body.contrast .breadcrumb,
body.contrast .dropdown-menu{background-color:#111 !important;color:#FFF}body.contrast .google-visualization-table-table
*{background-color:#111;background-image: -moz-linear-gradient(top, #111111, #111111);background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#111111), to(#111111));background-image: -webkit-linear-gradient(top, #111111, #111111);background-image: -o-linear-gradient(top, #111111, #111111);background-image:linear-gradient(to bottom, #111111, #111111);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#111111', endColorstr='#111111', GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled=false)}body.contrast .ui-widget-content,
body.contrast .ui-widget-header,
body.contrast .ui-resizable-e,
body.contrast .ui-resizable-s,
body.contrast .ui-resizable-w{background:#111 !important;background-color:#111 !important;color:#FFF !important}body.contrast ui-resizable-n{background-color:#333 !important}body.contrast .ui-button{border-color:#444 !important;background:#333 !important;color:#FFF !important}body.contrast .ui-button:hover{background:#444 !important}body.contrast .google-visualization-table-tr-over,
body.contrast .google-visualization-table-tr-over td,
body.contrast .google-visualization-table-tr-over-nonstrict{background-color:#333 !important;color:#F0AD4E !important;background:#444 !important}body.contrast .xdebug-error th,
body.contrast .xdebug-error
td{background-color:#333 !important}body.contrast .pcontrol input,
body.contrast .pGroup
select{color:#555 !important}body.contrast div.colCopy
div{border-bottom:1px solid #FFF !important;background:#333 !important;color:#FFF !important;font-size:13px;font-weight:bold;height:23px}body.contrast .flexigrid div.hDiv th.thMove
div{background:#333 !important;color:#FFF !important}body.contrast
.active{background-color:#333 !important}body.contrast .active>a{color:#F0AD4E !important}body.contrast .ui-datepicker-header
select{color:#F0AD4E !important}body.contrast .ui-datepicker-header
span{color:#FFF !important}body.contrast div.error,
body.contrast table th
span{color:#FFF !important}body.contrast.login{background-color:#000}body.contrast .ui-widget-content,
body.contrast .ui-widget-header{border:1px
solid #333 !important}body.contrast .ui-autocomplete
a{color:#000}body.contrast .ui-autocomplete .ui-state-focus{color:#F0AD4E;background:#333 !important}body.contrast
.helpText{color:#FFF}body.contrast a[accesskey]:after,
body.contrast button[accesskey]:after,
body.contrast input[accesskey]:after,
body.contrast label[accesskey]:after,
body.contrast legend[accesskey]:after,
body.contrast textarea[accesskey]:after{color:#FFF}body.contrast .btn-info:active,
body.contrast .btn-info:focus,
body.contrast .btn-info:hover{background-color:#444 !important;border-color:#444 !important}body.contrast .navbar-brand,
body.contrast .navbar-right{background-color:#111}body.contrast .ui-dialog-content,
body.contrast .ui-dialog-content,
body.contrast .ui-dialog-buttonpane{color:#FFF !important;background-color:#111 !important;font-weight:bold !important}body.contrast .ui-grid-top-panel{background:none !important;background-color:#333 !important}body.contrast .ui-grid,
body.contrast .ui-grid-header-cell,
body.contrast .ui-grid-header{border-color:#444}body.contrast .ui-grid-cell{background-color:#111 !important;border-right:1px solid #444;border-bottom:1px solid #444}body.contrast .google-visualization-table-tr-head .gradient,
body.contrast .google-visualization-table-tr-head-nonstrict .gradient,
body.contrast .google-visualization-table-div-page
.gradient{background:linear-gradient(to bottom, rgba(51, 51, 51, 1), rgba(51, 51, 51, 1), rgba(51, 51, 51, 1), rgba(51, 51, 51, 1)) repeat scroll 0 0 rgba(0, 0, 0, 0) !important}body.contrast .navbar-default,
body.contrast .inepzend-rodape,
body.contrast .navbar-default .navbar-nav>li>a{color:#FFF;background-color:#222;border-color:#222}body.contrast .navbar-default .navbar-nav > .active > span,
body.contrast .navbar-default .navbar-nav > li > a:hover,
body.contrast .navbar-default .navbar-nav > .open > a,
body.contrast .navbar-default .navbar-nav > .open > a:hover,
body.contrast .navbar-default .navbar-nav>.open>a:focus{color:#FFF;background-color:#686868;border-color:#686868}}@media
screen{.flexigrid .tDiv2 .add,
.flexigrid .tDiv2 .show,
.flexigrid .tDiv2 .update,
.flexigrid .tDiv2 .delete,
.flexigrid .pFirst,
.flexigrid .pPrev,
.flexigrid .pNext,
.flexigrid .pLast,
.flexigrid .pReload,
.flexigrid .flexigridColButtonAction .add,
.flexigrid .flexigridColButtonAction .show,
.flexigrid .flexigridColButtonAction .update,
.flexigrid .flexigridColButtonAction
.delete{background-image:none !important}.flexigrid .fbutton
button{padding-left:10px !important}}@media
screen{body.contrast
.bDiv{background:#000 !important;border-left:1px solid #222 !important;border-right:1px solid #222 !important;border-bottom:transparent !important}body.contrast .flexigrid tr
td.sorted{background:#111 !important;border-style:none;border-color:#444 #444 !important}body.contrast .flexigrid div.hDiv,
body.contrast .flexigrid
div.hDivBox{background:#000 !important;border-style:none !important}body.contrast .navbar-header button,
body.contrast .navbar-header button:hover,
body.contrast .navbar-default .navbar-collapse,
body.contrast .navbar-default .navbar-form{border-color:#111 !important;background-color:#111 !important;border-color:#FFF !important;border-bottom-color:#FFF !important}body.contrast .flexigrid div.fbutton div
button{background-color:#333;border:1px
solid #444 !important}body.contrast .flexigrid div.fbutton div button:hover,
body.contrast .flexigrid
div.fbutton.fbOver{background-color:#444;text-decoration:none !important}body.contrast .flexigrid div.bDiv tr:hover td,
body.contrast .flexigrid div.bDiv tr:hover td.sorted,
body.contrast .flexigrid div.bDiv tr.trOver td.sorted,
body.contrast .flexigrid div.bDiv tr.trOver
td{color:#f0ad4e;background:#333 no-repeat right top !important;border-bottom:1px solid #444 !important}body.contrast .flexigrid div.bDiv tr:hover td .fa,
body.contrast .flexigrid div.bDiv tr:hover td.sorted .fa,
body.contrast .flexigrid div.bDiv tr.trOver td.sorted .fa,
body.contrast .flexigrid div.bDiv tr.trOver td
.fa{color:#f0ad4e}body.contrast .flexigrid div.bDiv tr.erow:hover{border-bottom:1px solid #444 !important;color:#f0ad4e;background:#333 no-repeat right top !important}body.contrast .flexigrid div.hDiv th,
body.contrast .flexigrid div.bDiv
td{border:1px
solid #444 !important}body.contrast .hDivBox table
*{background-color:#333 !important;color:#fff !important}body.contrast .bDiv table,
body.contrast .nDiv table,
body.contrast .pDiv table,
body.contrast
.vGrip{background:#111;color:#fff;border-bottom:1px solid #fff}body.contrast .flexigrid td,
body.contrast .flexigrid tr.erow
td{background:none repeat scroll 0 0 #111!important;border-color:#444 !important}body.contrast .flexigrid div.hDiv th
div.sdesc{background:url(../images/dn.png) no-repeat center top!important}body.contrast .flexigrid div.hDiv th
div.sasc{background:url(../images/up.png) no-repeat center top!important}body.contrast .flexigrid
div.pDiv{color:#FFF !important}body.contrast .flexigrid .tDiv,
body.contrast .flexigrid .pDiv,
body.contrast .flexigrid
div.hDivBox{border-color:#222 !important;border-bottom:#222}body.contrast .flexigrid div.bDiv tr.trSelected:hover td,
body.contrast .flexigrid div.bDiv tr.trSelected:hover td.sorted,
body.contrast .flexigrid div.bDiv tr.trOver.trSelected td.sorted,
body.contrast .flexigrid div.bDiv tr.trOver.trSelected td,
body.contrast .flexigrid tr.trSelected td.sorted,
body.contrast .flexigrid tr.trSelected
td{color:#f0ad4e;background:#333 no-repeat right top !important}body.contrast
.gBlock{background:#333 !important}body.contrast
.pDiv{border-top:#333 !important}body.contrast .flexigrid div.pDiv div.pButton:hover span,
body.contrast .flexigrid div.pDiv div.pButton.pBtnOver
span{border:1px
solid #333 !important}body.contrast .flexigrid
div.bDiv{border-left:transparent !important;border-right:transparent !important}body.contrast .flexigrid
div.pDiv{border:1px
solid #222 !important}body.contrast
.flexigrid{border:1px
solid #222 !important}body.contrast .flexigrid .pFirst,
body.contrast .flexigrid .pPrev,
body.contrast .flexigrid .pNext,
body.contrast .flexigrid .pLast,
body.contrast .flexigrid
.pReload{color:#FFF}}@media
screen{.flexigrid{font-family:"Open Sans",Helvetica,Arial,sans-serif;font-size:13px !important;margin-top:10px}.flexigrid
div.tDiv{background:none !important;padding-right:0px !important;margin-right:0px !important;border-radius:3px;border-width:0px !important}.flexigrid
div.tDiv2{float:right !important;padding-right:0px !important;margin-right:0px !important}.flexigrid
div.fbutton{margin:0px
!important;padding:0px
!important}.flexigrid div.fbutton
div{margin:0px
!important;padding:0px
!important}.flexigrid div.fbutton div
button{margin:10px
10px 10px 0px !important;font-weight:bold;font-family:"Open Sans",Helvetica}.flexigrid div.tDiv:hover{text-decoration:none !important}.flexigrid div.tDiv2:hover{text-decoration:none !important}.flexigrid div.fbutton:hover{border:0px
!important;text-decoration:none !important}.flexigrid div.fbutton div:hover{border:0px
!important;text-decoration:none !important}.flexigrid div.fbutton div button:hover,
.flexigrid
div.fbutton.fbOver{text-decoration:none !important}.tDiv2
div.btnseparator{border-left:0px !important;border-right:0px !important}.hDivBox th,
.hDivBox
th.sorted{font-weight:bold !important}.flexigrid div.pDiv div.pButton:hover,
.flexigrid div.pDiv
div.pButton.pBtnOver{width:22px!important;height:22px!important;border:0px
!important}.flexigrid tr td,
.flexigrid tr
td.sorted{background:none repeat scroll 0 0 #fff !important}.flexigrid div.bDiv tr:hover td,
.flexigrid div.bDiv tr:hover td.sorted,
.flexigrid div.bDiv tr.trOver td.sorted,
.flexigrid div.bDiv tr.trOver
td{cursor:pointer}.flexigrid tr td,
.flexigrid tr.erow
td{border-bottom:0px solid black}.flexigrid div.hDiv th,
.flexigrid div.bDiv
td{border-bottom:1px solid #ddd !important;border-right:1px solid #ddd !important}.flexigrid div.hDiv,
.flexigrid
div.hDivBox{border-style:none !important}.flexigrid
div.hDiv{border-top:0px !important}.flexigrid
div.pDiv{background:none !important;background-color:rgba(0, 0, 0, 0.1) !important}.flexigrid div.hDiv th.thMove
div{color:#0e377d !important}div.colCopy
div{font-size:13px;font-weight:bold;height:23px}.flexigrid
div.nBtn{margin-top:1px !important}.flexigrid
div.bDiv{border-width:0px !important}.flexigrid
div.vGrip{border-width:0px !important}.flexigrid div.bDiv
table{border-right:1px solid #ccc !important}.flexigrid div.hDiv th,
.flexigrid div.bDiv
td{border-left:1px solid #ddd !important}.flexigrid .flexigridColButtonAction
.fa{margin-top:3px;height:17px !important}}@media
screen{.header-banner{margin-top:45px}select{padding-top:2px !important;padding-bottom:2px !important}a{text-decoration:none}div.error{color:#a94442 !important}.alert-error{background-color:#f2dede;border-color:#ebccd1;color:#a94442}.alert-notice{background-color:#d9edf7;border-color:#bce8f1;color:#31708f}.alert-validate{background-color:#fcf8e3;border-color:#faebcc;color:#8a6d3b}.selectPaginationControl{font-size:12px;height:18px;width:50px;padding:0px;vertical-align:baseline;margin:0px}.appVersion{font-size:10px;text-align:center}.helpText{cursor:help;float:left;margin-top:6px;height:18px;margin-left:3px;margin-top:4px;width:15px;font-size:15px}.tercoTela{margin-left:33%;margin-right:33%;overflow:visible}.meiaTela{margin-left:25%;margin-right:25%;overflow:visible}.parcialTela20{margin-left:20%;margin-right:20%;overflow:visible}div.caixaVazada{border-radius:2px;display:block;padding-bottom:10px;overflow:hidden}div.caixaVazada>*{padding-left:10px;padding-right:10px}div.caixaVazada>div{margin-left:10px;margin-right:10px}div.caixaVazada>button,fieldset>button{margin-right:10px}fieldset{margin:10px
0px 0px 0px !important;padding:40px
10px 10px 10px !important;position:relative !important;width:100%}fieldset
legend{margin:0px
15px 0px 10px !important;position:absolute !important;top:0px !important;left:0px !important;padding:9px
0px 0px 0px !important;font-size:16px !important;font-family:inherit!important;font-weight:700 !important;line-height:1.1 !important}form>button,form>div>button{margin-left:10px !important}div.caixaVazada > h1,
div.caixaVazada > h2,
div.caixaVazada > h3,
div.caixaVazada > h4,
div.caixaVazada > h5,
div.caixaVazada > h6,
div.caixaVazada > div.form-group,
div.caixaVazada > div.flexigrid,
div.caixaVazada
iframe{margin-left:0px;margin-right:0px}div.caixaVazada
div.caixaVazada{padding:0px;padding-bottom:10px}div.caixaVazada>div.caixaVazada>*{padding-left:10px;padding-right:10px}div.caixaVazada>div.caixaVazada>div{padding-left:0px;padding-right:0px}div.caixaVazada>div.caixaVazada>div.form-group{padding-left:10px;padding-right:10px}div.caixaVazada>div.caixaVazada>div.caixaVazada{padding-bottom:0px;padding-left:0px;padding-right:0px}div.caixaVazada>div.caixaVazada>div.caixaVazada>*{padding-left:0px;padding-right:0px}div.caixaVazada > div.caixaVazada
button{margin-right:10px}div.caixaVazada > div.caixaVazada .divTransferButton
button{margin-right:0px}.padding10{padding:10px}.caixaVazadaComplemento{text-align:justify;margin-bottom:5px;min-height:425px;*min-height:460px}.caixaVazadaMetade{width:48%;float:left;margin-right:5px}.no-screen{display:none}.red{border:1px
solid red}.breadcrumbNameApplication{font-weight:bold}.divPassValidation{padding:3px;padding-left:10px;font-weight:bold;width:350px;margin-bottom:2px}.obs{border-radius:4px 4px 4px 4px;display:block;font-size:12px;line-height:20px;margin:0
0 10px;padding:9.5px;text-align:justify;overflow:hidden}.paginatorValueCol{width:16px;min-height:20px;margin:0px;float:left}.paginatorLabel{font-weight:normal;font-size:12px}.divHeightRow{height:87px;overflow:hidden;padding-top:5px;padding-left:10px}.divTransferButton
.btnDefault{float:none !important}.btnDefault{margin-top:5px;margin-left:0px;float:right !important}.icoFontSize{height:15px;width:15px;cursor:pointer;float:left}.icoFontSizeNormal{background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEgAACxIB0t1+/AAAAAd0SU1FB9wJGxIJIjggSagAAAD2SURBVCjP3ZCxLgQBEIa/vXXH6TZIRCSi0V0kJyqJSqG54hQKhVdQ8SR4AUQknkOlJaIUJaI4bLP3KUwhm9tFa6rJP/PN/2fgf5Q6pm6rp2rnr3BX/fCrTtS5qt1GCWwDW8BESGvA0q9gIAN2gGvgDFgEOmr6U9xE3Yi4x+qq+qheqbNqU21UwS31Un1V+6FdxLF1daou9gzQB56BvCiK+egBdoFBXeyDcBmqt+qN+hTaQF0oM8k3+AGYBs6BFyAF3oAesAzsAYdJkgzLrpvhcJfneaq21cmY7avv6r3arIt8NGKWxddVW6PgcbWnZhX/WFG7Zf0TEafjCvK1qBAAAAAASUVORK5CYII=);*background:url(../../../images/a_normal.png)}.icoFontSizePlus{background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAACV0RVh0U29mdHdhcmUATWFjcm9tZWRpYSBGaXJld29ya3MgTVggMjAwNId2rM8AAAAWdEVYdENyZWF0aW9uIFRpbWUAMDQvMjcvMTFjmal9AAAA3ElEQVR4nJ2S0RGCQAxEH47/0oF0IB1IB1ICJWgH2AElWAJ2QAmUYAl0sH4YMXcc42hmMhNym2Q3IZPEv7b5AVsCzbfiEhiALsrXcfE2UdwDe+AIjNaoMM+BynADkrzXCq2XNGhpkyTi4t4eWwcs7K21RjPea86Bk8UdcLc40BmY63R2VL2Eh30XjgUx7dHAjctNlqsjeUiat10CBxe3Fk/Azqj3a7RviY3GFlCWRKbX7/mecLHbervZ3a+O0Ty58bdLeBctLjhVbn2Wmj5nw+EWmitJ+cpkJJUpzU/jl3dV6hQKOgAAAABJRU5ErkJggg==);*background:url(../../../images/a_mais.png)}.icoFontSizeMinus{background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAACV0RVh0U29mdHdhcmUATWFjcm9tZWRpYSBGaXJld29ya3MgTVggMjAwNId2rM8AAAAWdEVYdENyZWF0aW9uIFRpbWUAMDQvMjcvMTFjmal9AAAAoUlEQVR4nM2T0Q3CMAxEXxEDdAMySkdghIzACGxAR2CEjgAblA0YIUxwfOAiY4WC+gMnWUocP+tsKY0klmq1mPw7eAcMQLJ7D8jFOBWuA5iAg50LkK347GqeMJJ89HpokFQkteH9JWKiGLi1JvlbOAegSLrOwX5h2c3a2WwbO9dlXZLe6/jJ9rSoLhSMlq8uztu+AKdgbA/cgLbmuvnZx7gDqI8KkJf9ulEAAAAASUVORK5CYII=);*background:url(../../../images/a_menos.png)}.ui-widget{font-size:1em !important}.ui-widget-header{text-decoration:none !important}.ui-button-text{font-size:13px;font-weight:bold}.ui-state-focus{background:#0e377d !important}.ui-autocomplete{max-height:200px;overflow-y:scroll;overflow-x:hidden}.ui-autocomplete a.ui-state-focus{font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}.btnUi[accesskey]:after{font-size:13px !important;font-weight:bold}.h1,h1{font-size:23px !important;padding-bottom:9px;border-bottom:1px solid #eee}.h2,h2{font-size:17px !important}.h3,h3{font-size:16px !important}.h4,h4{font-size:14px !important}.h-form{padding:7px
11px;margin-top:0px;margin-bottom:10px}.navbar-default .navbar-toggle{border-color:transparent}.navbar-toggle.left{left:0}.navbar-brand{margin-left:110px}#navbar-toggle-info-usuario{right:0px}#menu-administrative-responsible
h2{border-bottom:none}.form-group{overflow:hidden;min-height:77px;margin-bottom:2px !important}.paddingBreakLabel{padding:0px
!important}.counterCharacters{text-align:right}.phoneDdd{position:relative;width:210px;overflow:hidden;border:0px;min-height:77px;margin-bottom:2px;padding-top:24px}input[type="file"].form-control{padding:0px
12px !important}.form-control.error:focus,input.form-control.error:focus,textarea.form-control.error:focus,select.form-control.error:focus{outline:0px
none}.divBetweenText{float:left;padding-top:29px;text-align:center;height:60px;padding-right:13px}.divFormGroupWithoutLabel{position:relative;width:193px;overflow:hidden;border:0px;padding-top:24px;padding-left:0px;height:60px}div.divTransferBlock{width:37%;float:left}body>footer{line-height:20px !important;background-color:#852300}.breadcrumb
i.fa{padding-right:5px}.divEventCalendar .ui-state-default,
.divEventCalendar .ui-widget-content .ui-state-default,
.divEventCalendar .ui-widget-header .ui-state-default{color:#FFF}.google-visualization-table{padding:0px
!important;width:100%}.google-visualization-table-table{width:100%}.ui-grid-pager-panel{position:relative !important;left:auto !important;bottom:auto !important;padding-top:0 !important;padding-bottom:0 !important;overflow:hidden !important;margin-top: -40px !important}.ui-grid-pager-container,.ui-grid-pager-count-container{margin-top:10px !important}.ui-grid{height:383px}.noPrint{display:block}.yesPrint{display:block !important}}@media
print{.noPrint{display:none}.yesPrint{display:block !important}}@media
screen{.nav-sidebar
ul{list-style:none}#menu-administrative-responsible{overflow:visible}#menu-administrative-responsible .fa-caret-down,
#menu-administrative-responsible .fa-caret-right{border-left:5px solid transparent}#menu-administrative-responsible .nav-sidebar
i{font-size:18px;min-width:24px;text-align:center;vertical-align:middle}#menu-administrative-responsible .nav-sidebar > li
ul{background-color:rgba(0, 0, 0, 0.1) !important;list-style:none outside none;padding-left:0px}#menu-administrative-responsible .nav-sidebar > li ul li
a{display:block;padding:10px;padding-left:30px}#menu-administrative-responsible .nav-sidebar > li ul li ul li
a{padding-left:45px}#menu-administrative-responsible a:focus,
#menu-administrative-responsible a:hover{text-decoration:none;background-color:#94d7e4}.container-menu-responsible{margin-left:210px}}@media
screen{div.error{color:red;font-weight:normal;margin-top:auto}}@media
screen{.icoHelper{background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAwMi8wMi8xMU1XPxUAAAAldEVYdFNvZnR3YXJlAE1hY3JvbWVkaWEgRmlyZXdvcmtzIE1YIDIwMDSHdqzPAAACKUlEQVR4nG2Tz0tUURTHP/MrRrQGB0JTG5Igi8KkwnDh5v0H0yZwF5nD7GxTRESP2rQ0EERbthX68Qe4axMFqallUurMyHN8o6O9Gcd33723xai8xnfhLO7h+/2cc+89N6S1pnHNmLE0MAL0H6Y+A1OGKd41akN+wIwZ6wSepm7fy7b1pmlKdAFQ2y1gzX8g/+XtpPIOXhqmKBx5on5aOBp/djX9OpO8cB3tbaPFHwDiLU10Dw7T2j2YWXz/MAI8OPb4qg+d672Tae3sQFVn0W4OPBs8G+3mUNVZEm1J2nvTwzNmbOgEAMi2X+lHVudQwg4MWZ2j7dINgGwQoC8S+oEWJSItt9ByDy226iEdIs030WKLCEsAfUEAKSvLyP3fCHua6OlBtOegZYVIywDCnkbWcnjOEoAMusSvle2yceash5RllPWG+PnnEI5TW32MVn9BK5ySc/SsJzqYyC+soaRESw/lllCiiBYllNip56SksLgOMHECYJhi2rFL4/n5VdDqMDSgj/f572s4tj3uH6j/5gB4ZK0UIuFoKNtxuatuBrRWWMsbWL/yE8ATv8F/BAxT7AMvNlc261Wpd6A8j42fGwCvDFM4fk9jB3zq+WYlix9xiz1cbO6iaG8xv3CXXG1Axa7dXzca9OFGAEA4miCZ6CSkY8TCcTz3FHsVFawNSrquy+7uHgA75TIHB7UgGdDwG/1rdHR00rKsEdd1SaVSU2NjY5kg3T8+aiUh/cgIpwAAAABJRU5ErkJggg==) no-repeat;*background:url(../images/icons-inep/ajuda.png) no-repeat}}