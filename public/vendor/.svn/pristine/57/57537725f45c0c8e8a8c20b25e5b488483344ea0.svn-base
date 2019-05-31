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
body{background-color:#0D0225}body.login{background-color:#0D0225}.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > span, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav>li>a:hover{background-color:#852300}.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6{color:#0B031D}body.login
h2{color:#FFF}a{color:#0B031D}a:focus,a:hover{color:#0B031D}a[accesskey]:after,button[accesskey]:after,input[accesskey]:after,label[accesskey]:after,legend[accesskey]:after,textarea[accesskey]:after{color:plum }label,.ui-grid-top-panel{color:#0B031D}.btn-info{background-color:#4E4464;border-color:#0B031D;color:#FFF}.btn-info[disabled],.btn-info.active,.btn-info:active,.btn-info:focus,.btn-info:hover,.open>.btn-info.dropdown-toggle{background-color:#0D0225 !important;border-color:#0B031D !important}.ui-button{border-color:#0B031D !important;background:#4E4464 !important}.ui-button:hover{background:#0D0225 !important;color:#FFF !important}.breadcrumbNameApplication{color:#0B031D}.breadcrumb{color:#0B031D}.divPassValidation{color:#FFF;border:1px
solid #DDD}.obs{background-color:#F5F5F5;border:1px
solid #D0D0D0}.flexigrid div.fbutton div button:hover, .flexigrid
div.fbutton.fbOver{background-color:#0B031D}.flexigrid div.fbutton div
button{background-color:#4E4464}.hDivBox th, .hDivBox
th.sorted{background-color:#4E4464 !important;background:#4E4464 !important;color:#FFF !important}.flexigrid div.bDiv tr.trSelected:hover td,
.flexigrid div.bDiv tr.trSelected:hover td.sorted,
.flexigrid div.bDiv tr.trOver.trSelected td.sorted,
.flexigrid div.bDiv tr.trOver.trSelected td,
.flexigrid tr.trSelected td.sorted,
.flexigrid tr.trSelected
td{color:#FFF;background:#4E4464 no-repeat right top !important}.flexigrid div.bDiv tr:hover td,
.flexigrid div.bDiv tr:hover td.sorted,
.flexigrid div.bDiv tr.trOver td.sorted,
.flexigrid div.bDiv tr.trOver
td{background:#4E4464 !important;border-bottom:1px solid #FFF !important;color:#000}.flexigrid div.bDiv tr:hover td a,
.flexigrid div.bDiv tr:hover td.sorted
a{color:#FFF}.flexigrid div.hDiv, .flexigrid
div.hDivBox{background:#FFF !important}.flexigrid div.bDiv tr:hover td,
.flexigrid div.bDiv tr:hover td.sorted,
.flexigrid div.bDiv tr.trOver td.sorted,
.flexigrid div.bDiv tr.trOver
td{color:#FFF}.flexigrid{border:1px
solid #4E4464 !important}.flexigrid .pFirst,
.flexigrid .pPrev,
.flexigrid .pNext,
.flexigrid .pLast,
.flexigrid
.pReload{color:#4E4464;margin-top:6px}.flexigrid .trSelected
a{color:#FFF !important}div.colCopy
div{border-bottom:1px solid #FFF !important;background:#4E4464 !important;color:#FFF !important}.gBlock{background:#4E4464 !important}.sidebar{background-color:#4E4464 !important;font-weight:normal}.sidebar
header{background-color:#4E4464;font-weight:normal}.h-form{background-color:#4E4464;border-bottom:2px solid #0B031D;color:#FFF}.panel-info{border-color:#4E4464}div.caixaVazada{border:1px
solid #4E4464}fieldset{border:1px
solid #4E4464 !important}fieldset
legend{color:#0B031D !important}.panel-info>.panel-heading{background-color:#4E4464;border-color:#0B031D;color:#FFF;font-weight:bold}.list-group-item{background-color:#FFF;border:1px
solid #4E4464}.form-control:focus{border-color:#66AFE9}.form-control.error:focus,input.form-control.error:focus,textarea.form-control.error:focus,select.form-control.error:focus{border-color:#A94442 !important;box-shadow:0px 0px 6px #A94442}table
th{background-color:#4E4464 !important;color:#FFF}.tab-content{border:1px
solid #4E4464 !important}#nav{color:#FFF !important}#menu-administrative-responsible
a{color:#FFF}#menu-administrative-responsible a:focus, #menu-administrative-responsible a:hover{background-color:#0D0225}.active{background-color:#0D0225}.nav>li.active>a{background-color:#0D0225}.nav>li>a:focus,.nav>li>a:hover{background-color:#4E4464}.nav-tabs>li.active>a{border-color:#4E4464 #4E4464 transparent}.nav-tabs>li.active>a:focus,.nav-tabs>li.active>a:hover{background-color:#FFF;border-color:#4E4464 #4E4464 transparent}.nav-tabs
p{color:#FFF}.nav-tabs p:focus, .nav-tabs p:hover{color:#000}.img-thumbnail{border:1px
solid #4E4464}.table>tbody>tr>td,.table>tbody>tr>th,.table>tfoot>tr>td,.table>tfoot>tr>th,.table>thead>tr>td,.table>thead>tr>th{border-top:1px solid #4E4464}.table>thead>tr>th{border-bottom:2px solid #4E4464}.table>tbody+tbody{border-top:2px solid #4E4464}.table-bordered,.table-bordered>tbody>tr>td,.table-bordered>tbody>tr>th,.table-bordered>tfoot>tr>td,.table-bordered>tfoot>tr>th,.table-bordered>thead>tr>td,.table-bordered>thead>tr>th{border:1px
solid #4E4464}.btn-default.active,.btn-default:active,.btn-default:focus,.btn-default:hover,.open>.btn-default.dropdown-toggle{background-color:#0B031D;border-color:#0B031D}.list-group-item.active,.list-group-item.active:focus,.list-group-item.active:hover{background-color:#0B031D;border-color:#0B031D}.ui-widget-header{background:#4E4464 !important;background-color:#4E4464 !important;color:#FFF !important}.appVersion{color:#955955}.ui-autocomplete a.ui-state-focus{color:#FFF;background:#0D0225 !important}.helpText{color:#0B031D}.ui-datepicker-month,.ui-datepicker-year{color:#0B031D !important}span.ui-datepicker-month, span.ui-datepicker-year,
.ui-datepicker-calendar th
span{color:#FFF !important}.panel-heading
h2{color:#FFF}.panel{background-color:#FFF}.ui-state-focus{background-color:#0D0225 !important;color:#FFF !important}.google-visualization-table-tr-head .gradient,
.google-visualization-table-tr-head-nonstrict .gradient,
.google-visualization-table-div-page
.gradient{background:linear-gradient(to bottom, rgba(78, 68, 100, 1), rgba(78, 68, 100, 1), rgba(78, 68, 100, 1), rgba(78, 68, 100, 1)) repeat scroll 0 0 rgba(0, 0, 0, 0) !important}.navbar-default,
.inepzend-rodape,
.navbar-default .navbar-nav > li > a,
.navbar-default .navbar-nav>.open>a{color:#FFF;background-color:#4E4464;border-color:#4E4464}.navbar-default .navbar-nav > .active > span,
.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus,
.navbar-default .navbar-nav > .open > a:active,
.navbar-default .navbar-nav>li>a:focus,.navbar-nav>li>a:hover{color:#FFF;background-color:#0D0225;border-color:#0D0225}.dropdown-menu>li>a:focus,.dropdown-menu>li>a:hover{color:#FFF;background-color:#0D0225}