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
body{background-color:#020F23}body.login{background-color:#020F23}.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > span, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav>li>a:hover{background-color:#852300}.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6{color:#030C1C}body.login
h2{color:#FFF}a{color:#030C1C}a:focus,a:hover{color:#030C1C}a[accesskey]:after,button[accesskey]:after,input[accesskey]:after,label[accesskey]:after,legend[accesskey]:after,textarea[accesskey]:after{color:plum }label,.ui-grid-top-panel{color:#030C1C}.btn-info{background-color:#031F4C;border-color:#030C1C;color:#FFF}.btn-info[disabled],.btn-info.active,.btn-info:active,.btn-info:focus,.btn-info:hover,.open>.btn-info.dropdown-toggle{background-color:#020F23 !important;border-color:#030C1C !important}.ui-button{border-color:#030C1C !important;background:#031F4C !important}.ui-button:hover{background:#020F23 !important;color:#FFF !important}.breadcrumbNameApplication{color:#030C1C}.breadcrumb{color:#030C1C}.divPassValidation{color:#FFF;border:1px
solid #DDD}.obs{background-color:#F5F5F5;border:1px
solid #D0D0D0}.flexigrid div.fbutton div button:hover, .flexigrid
div.fbutton.fbOver{background-color:#030C1C}.flexigrid div.fbutton div
button{background-color:#031F4C}.hDivBox th, .hDivBox
th.sorted{background-color:#031F4C !important;background:#031F4C !important;color:#FFF !important}.flexigrid div.bDiv tr.trSelected:hover td,
.flexigrid div.bDiv tr.trSelected:hover td.sorted,
.flexigrid div.bDiv tr.trOver.trSelected td.sorted,
.flexigrid div.bDiv tr.trOver.trSelected td,
.flexigrid tr.trSelected td.sorted,
.flexigrid tr.trSelected
td{color:#FFF;background:#031F4C no-repeat right top !important}.flexigrid div.bDiv tr:hover td,
.flexigrid div.bDiv tr:hover td.sorted,
.flexigrid div.bDiv tr.trOver td.sorted,
.flexigrid div.bDiv tr.trOver
td{background:#031F4C !important;border-bottom:1px solid #FFF !important;color:#000}.flexigrid div.bDiv tr:hover td a,
.flexigrid div.bDiv tr:hover td.sorted
a{color:#FFF}.flexigrid div.hDiv, .flexigrid
div.hDivBox{background:#FFF !important}.flexigrid div.bDiv tr:hover td,
.flexigrid div.bDiv tr:hover td.sorted,
.flexigrid div.bDiv tr.trOver td.sorted,
.flexigrid div.bDiv tr.trOver
td{color:#FFF}.flexigrid{border:1px
solid #031F4C !important}.flexigrid .pFirst,
.flexigrid .pPrev,
.flexigrid .pNext,
.flexigrid .pLast,
.flexigrid
.pReload{color:#031F4C;margin-top:6px}.flexigrid .trSelected
a{color:#FFF !important}div.colCopy
div{border-bottom:1px solid #FFF !important;background:#031F4C !important;color:#FFF !important}.gBlock{background:#031F4C !important}.sidebar{background-color:#031F4C !important;font-weight:normal}.sidebar
header{background-color:#031F4C;font-weight:normal}.h-form{background-color:#031F4C;border-bottom:2px solid #030C1C;color:#FFF}.panel-info{border-color:#031F4C}div.caixaVazada{border:1px
solid #031F4C}fieldset{border:1px
solid #031F4C !important}fieldset
legend{color:#030C1C !important}.panel-info>.panel-heading{background-color:#031F4C;border-color:#030C1C;color:#FFF;font-weight:bold}.list-group-item{background-color:#FFF;border:1px
solid #031F4C}.form-control:focus{border-color:#66AFE9}.form-control.error:focus,input.form-control.error:focus,textarea.form-control.error:focus,select.form-control.error:focus{border-color:#A94442 !important;box-shadow:0px 0px 6px #A94442}table
th{background-color:#031F4C !important;color:#FFF}.tab-content{border:1px
solid #031F4C !important}#nav{color:#FFF !important}#menu-administrative-responsible
a{color:#FFF}#menu-administrative-responsible a:focus, #menu-administrative-responsible a:hover{background-color:#020F23}.active{background-color:#020F23}.nav>li.active>a{background-color:#020F23}.nav>li>a:focus,.nav>li>a:hover{background-color:#031F4C}.nav-tabs>li.active>a{border-color:#031F4C #031F4C transparent}.nav-tabs>li.active>a:focus,.nav-tabs>li.active>a:hover{background-color:#FFF;border-color:#031F4C #031F4C transparent}.nav-tabs
p{color:#FFF}.nav-tabs p:focus, .nav-tabs p:hover{color:#000}.img-thumbnail{border:1px
solid #031F4C}.table>tbody>tr>td,.table>tbody>tr>th,.table>tfoot>tr>td,.table>tfoot>tr>th,.table>thead>tr>td,.table>thead>tr>th{border-top:1px solid #031F4C}.table>thead>tr>th{border-bottom:2px solid #031F4C}.table>tbody+tbody{border-top:2px solid #031F4C}.table-bordered,.table-bordered>tbody>tr>td,.table-bordered>tbody>tr>th,.table-bordered>tfoot>tr>td,.table-bordered>tfoot>tr>th,.table-bordered>thead>tr>td,.table-bordered>thead>tr>th{border:1px
solid #031F4C}.btn-default.active,.btn-default:active,.btn-default:focus,.btn-default:hover,.open>.btn-default.dropdown-toggle{background-color:#030C1C;border-color:#030C1C}.list-group-item.active,.list-group-item.active:focus,.list-group-item.active:hover{background-color:#030C1C;border-color:#030C1C}.ui-widget-header{background:#031F4C !important;background-color:#031F4C !important;color:#FFF !important}.appVersion{color:#955955}.ui-autocomplete a.ui-state-focus{color:#FFF;background:#020F23 !important}.helpText{color:#030C1C}.ui-datepicker-month,.ui-datepicker-year{color:#030C1C !important}span.ui-datepicker-month, span.ui-datepicker-year,
.ui-datepicker-calendar th
span{color:#FFF !important}.panel-heading
h2{color:#FFF}.panel{background-color:#FFF}.ui-state-focus{background-color:#020F23 !important;color:#FFF !important}.google-visualization-table-tr-head .gradient,
.google-visualization-table-tr-head-nonstrict .gradient,
.google-visualization-table-div-page
.gradient{background:linear-gradient(to bottom, rgba(3, 31, 76, 1), rgba(3, 31, 76, 1), rgba(3, 31, 76, 1), rgba(3, 31, 76, 1)) repeat scroll 0 0 rgba(0, 0, 0, 0) !important}.navbar-default,
.inepzend-rodape,
.navbar-default .navbar-nav > li > a,
.navbar-default .navbar-nav>.open>a{color:#FFF;background-color:#031F4C;border-color:#031F4C}.navbar-default .navbar-nav > .active > span,
.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus,
.navbar-default .navbar-nav > .open > a:active,
.navbar-default .navbar-nav>li>a:focus,.navbar-nav>li>a:hover{color:#FFF;background-color:#020F23;border-color:#020F23}.dropdown-menu>li>a:focus,.dropdown-menu>li>a:hover{color:#FFF;background-color:#020F23}