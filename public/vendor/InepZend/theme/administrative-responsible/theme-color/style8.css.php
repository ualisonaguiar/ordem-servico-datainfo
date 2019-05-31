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
/* #CCCCCC - Cor base */
/* #CCCCCC - Background */
/* #CCCCCC - Fundo da tela de login */
/* #474747 - Utilizado nos titulos e subtitulos das paginas, hiperlinks, label, botoes, breadcrumb, flexigrid, formulario, bordas de formulario, formulario e caixa de dialogo */
/* #474747 - Utilizado no texto breadcrumb final */
/* #474747 - Utilizado na borda do botao info */
/* #474747 - Bordas e fundos dos botões quando esta com os eventos hover e focus */
/* #474747 - Cor dos hiperlinks quando esta com os eventos focus e hover */
/* #909090 - Fundo do menu e submenu */
/* #909090 - Fundo dos botoes */
/* #909090 - Itens ativos do menu, cabecalho das tabelas, caixas de dialogos e flexigrid */
/* #909090 - Borda da caixa vazada e fieldset */
/* #FFFFFF - Fundo conteudo */
/* #66AFE9 - Bordas dos elementos hmtl de texto, textarea, select, radio e checkbox quando esta com o evento focus */

body {
    background-color: #CCCCCC;
}

body.login {
    background-color: #CCCCCC;
}

.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > span, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > li > a:hover {
    background-color: #852300;
}

.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    color: #474747;
}

body.login h2 {
    color: #FFFFFF;
}

a {
    color: #474747;
}

a:focus, a:hover {
    color: #474747;
}

a[accesskey]:after, button[accesskey]:after, input[accesskey]:after, label[accesskey]:after, legend[accesskey]:after, textarea[accesskey]:after {
    color: plum /*#8E4585*/;
}

label, .ui-grid-top-panel {
    color: #474747;
}

.btn-info {
    background-color: #909090;
    border-color: #474747;
    color: #FFFFFF;
}

.btn-info[disabled], .btn-info.active, .btn-info:active, .btn-info:focus, .btn-info:hover, .open > .btn-info.dropdown-toggle {
    background-color: #CCCCCC !important;
    border-color: #474747 !important;
}

.ui-button {
    border-color: #474747 !important;
    background: #909090 !important;
}

.ui-button:hover {
    background: #CCCCCC !important;
    color: #FFFFFF !important;
}

.breadcrumbNameApplication {
    color: #474747;
}

.breadcrumb {
    color: #474747;
}

.divPassValidation {
    color: #FFFFFF; 
    border: 1px solid #DDDDDD;
}

.obs {
    background-color: #F5F5F5;
    border: 1px solid #D0D0D0;
}

.flexigrid div.fbutton div button:hover, .flexigrid div.fbutton.fbOver {
    background-color: #474747;
}

.flexigrid div.fbutton div button {
    background-color: #909090;
}

.hDivBox th, .hDivBox th.sorted {
    background-color: #909090 !important;
    background: #909090 !important;
    color: #FFFFFF !important;
}

.flexigrid div.bDiv tr.trSelected:hover td,
.flexigrid div.bDiv tr.trSelected:hover td.sorted,
.flexigrid div.bDiv tr.trOver.trSelected td.sorted,
.flexigrid div.bDiv tr.trOver.trSelected td,
.flexigrid tr.trSelected td.sorted,
.flexigrid tr.trSelected td {
    color: #FFFFFF;
    background: #909090 no-repeat right top !important;
}

.flexigrid div.bDiv tr:hover td,
.flexigrid div.bDiv tr:hover td.sorted,
.flexigrid div.bDiv tr.trOver td.sorted,
.flexigrid div.bDiv tr.trOver td {
    background: #909090 !important;
    border-bottom: 1px solid #FFFFFF !important;
    color: #000000;
}

.flexigrid div.bDiv tr:hover td a,
.flexigrid div.bDiv tr:hover td.sorted a {
    color: #FFFFFF;
}

.flexigrid div.hDiv, .flexigrid div.hDivBox {
    background: #FFFFFF !important;
}

.flexigrid div.bDiv tr:hover td,
.flexigrid div.bDiv tr:hover td.sorted,
.flexigrid div.bDiv tr.trOver td.sorted,
.flexigrid div.bDiv tr.trOver td {
    color: #FFFFFF;
}

.flexigrid {
    border: 1px solid #909090 !important;
}

.flexigrid .pFirst,
.flexigrid .pPrev,
.flexigrid .pNext,
.flexigrid .pLast,
.flexigrid .pReload {
    color: #474747;
    margin-top: 6px;
}

.flexigrid .trSelected a {
    color: #FFFFFF !important;
}

div.colCopy div {
    border-bottom: 1px solid #FFFFFF !important;
    background: #909090 !important;
    color: #FFFFFF !important;
}

.gBlock {
    background: #909090 !important;
}

.sidebar {
    background-color: #909090 !important;
    font-weight: normal;
}

.sidebar header {
    background-color: #909090;
    font-weight: normal;
}

.h-form {
    background-color: #909090;
    border-bottom: 2px solid #474747;
    color: #FFFFFF;
}

.panel-info {
    border-color: #909090;
}

div.caixaVazada {
    border: 1px solid #909090;
}

fieldset {
    border: 1px solid #909090 !important;
}

fieldset legend {
    color: #474747 !important;
}

.panel-info > .panel-heading {
    background-color: #909090;
    border-color: #474747;
    color: #FFFFFF;
    font-weight: bold;
}

.list-group-item {
    background-color: #FFFFFF;
    border: 1px solid #909090;
}

.form-control:focus {
    border-color: #66AFE9;
}

.form-control.error:focus,
input.form-control.error:focus,
textarea.form-control.error:focus,
select.form-control.error:focus {
    border-color: #A94442 !important;
    box-shadow: 0px 0px 6px #A94442;
}

table th {
    background-color: #909090 !important;
    color: #FFFFFF;
}

.tab-content {
    border: 1px solid #909090 !important;
}

#nav {
    color: #FFFFFF !important;
}

#menu-administrative-responsible a {
    color: #FFFFFF;
}

#menu-administrative-responsible a:focus, #menu-administrative-responsible a:hover {
    background-color: #CCCCCC;
}

.active {
    background-color: #CCCCCC;
}

.nav > li.active > a {
    background-color: #CCC;
}

.nav > li > a:focus, .nav > li > a:hover {
    background-color: #909090;
}

.nav-tabs > li.active > a {
    border-color: #909090 #909090 transparent;
}

.nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
    background-color: #FFFFFF;
    border-color: #909090 #909090 transparent;
}

.nav-tabs p {
    color: #FFFFFF;
}

.nav-tabs p:focus, .nav-tabs p:hover {
    color: #000000;
}

.img-thumbnail {
    border: 1px solid #909090;
}

.table > tbody > tr > td,
.table > tbody > tr > th,
.table > tfoot > tr > td,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > thead > tr > th {
    border-top: 1px solid #909090;
}

.table > thead > tr > th {
    border-bottom: 2px solid #909090;
}

.table > tbody+tbody {
    border-top: 2px solid #909090;
}

.table-bordered,
.table-bordered > tbody > tr > td,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > td,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > thead > tr > th {
    border: 1px solid #909090;
}

.btn-default.active,
.btn-default:active,
.btn-default:focus,
.btn-default:hover,
.open > .btn-default.dropdown-toggle {
    background-color: #474747;
    border-color: #474747;
}

.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
    background-color: #474747;
    border-color: #474747;
}

.ui-widget-header {
    background: #909090 !important;
    background-color: #909090 !important;
    color: #FFFFFF !important;
}

.appVersion {
    color: #955955;
}

.ui-autocomplete a.ui-state-focus {
    color: #FFFFFF;
    background: #CCCCCC !important;
}

.helpText {
    color: #474747;
}

.ui-datepicker-month, .ui-datepicker-year {
    color: #474747 !important;
}

span.ui-datepicker-month, span.ui-datepicker-year,
.ui-datepicker-calendar th span {
    color: #FFFFFF !important;
}

.panel-heading h2 {
    color: #FFFFFF;
}

.panel {
    background-color: #FFFFFF;
}

.ui-state-focus {
    background-color: #CCCCCC !important;
    color: #FFFFFF !important;
}

/* http://hex2rgba.devoth.com/ */
.google-visualization-table-tr-head .gradient,
.google-visualization-table-tr-head-nonstrict .gradient,
.google-visualization-table-div-page .gradient {
    background: linear-gradient(to bottom, rgba(144, 144, 144, 1), rgba(144, 144, 144, 1), rgba(144, 144, 144, 1), rgba(144, 144, 144, 1)) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
}

.navbar-default,
.inepzend-rodape,
.navbar-default .navbar-nav > li > a,
.navbar-default .navbar-nav > .open > a {
    color: #FFFFFF;
    background-color: #909090;
    border-color: #909090;
}

.navbar-default .navbar-nav > .active > span,
.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus,
.navbar-default .navbar-nav > .open > a:active,
.navbar-default .navbar-nav > li > a:focus,
.navbar-nav > li > a:hover {
    color: #FFFFFF;
    background-color: #CCCCCC;
    border-color: #CCCCCC;
}

.dropdown-menu > li > a:focus,
.dropdown-menu > li > a:hover {
    color: #FFFFFF;
    background-color: #CCCCCC;
}