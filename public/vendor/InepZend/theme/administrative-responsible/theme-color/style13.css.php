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
/* #224455 - Cor base */
/* #224455 - Background */
/* #224455 - Fundo da tela de login */
/* #0B031D - Utilizado nos titulos e subtitulos das paginas, hiperlinks, label, botoes, breadcrumb, flexigrid, formulario, bordas de formulario, formulario e caixa de dialogo */
/* #0B031D - Utilizado no texto breadcrumb final */
/* #0B031D - Utilizado na borda do botao info */
/* #0B031D - Bordas e fundos dos botões quando esta com os eventos hover e focus */
/* #0B031D - Cor dos hiperlinks quando esta com os eventos focus e hover */
/* #4d86ad - Fundo do menu e submenu */
/* #4d86ad - Fundo dos botoes */
/* #4d86ad - Itens ativos do menu, cabecalho das tabelas, caixas de dialogos e flexigrid */
/* #4d86ad - Borda da caixa vazada e fieldset */
/* #FFFFFF - Fundo conteudo */
/* #66AFE9 - Bordas dos elementos hmtl de texto, textarea, select, radio e checkbox quando esta com o evento focus */

body {
    background-color: #224455;
}

body.login {
    background-color: #224455;
}

.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > span, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > li > a:hover {
    background-color: #852300;
}

.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    color: #0B031D;
}

body.login h2 {
    color: #FFFFFF;
}

a {
    color: #0B031D;
}

a:focus, a:hover {
    color: #0B031D;
}

a[accesskey]:after, button[accesskey]:after, input[accesskey]:after, label[accesskey]:after, legend[accesskey]:after, textarea[accesskey]:after {
    color: plum /*#8E4585*/;
}

label, .ui-grid-top-panel {
    color: #0B031D;
}

.btn-info {
    background-color: #4d86ad;
    border-color: #0B031D;
    color: #FFFFFF;
}

.btn-info[disabled], .btn-info.active, .btn-info:active, .btn-info:focus, .btn-info:hover, .open > .btn-info.dropdown-toggle {
    background-color: #224455 !important;
    border-color: #0B031D !important;
}

.ui-button {
    border-color: #0B031D !important;
    background: #4d86ad !important;
}

.ui-button:hover {
    background: #224455 !important;
    color: #FFFFFF !important;
}

.breadcrumbNameApplication {
    color: #0B031D;
}

.breadcrumb {
    color: #0B031D;
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
    background-color: #0B031D;
}

.flexigrid div.fbutton div button {
    background-color: #4d86ad;
}

.hDivBox th, .hDivBox th.sorted {
    background-color: #4d86ad !important;
    background: #4d86ad !important;
    color: #FFFFFF !important;
}

.flexigrid div.bDiv tr.trSelected:hover td,
.flexigrid div.bDiv tr.trSelected:hover td.sorted,
.flexigrid div.bDiv tr.trOver.trSelected td.sorted,
.flexigrid div.bDiv tr.trOver.trSelected td,
.flexigrid tr.trSelected td.sorted,
.flexigrid tr.trSelected td {
    color: #FFFFFF;
    background: #4d86ad no-repeat right top !important;
}

.flexigrid div.bDiv tr:hover td,
.flexigrid div.bDiv tr:hover td.sorted,
.flexigrid div.bDiv tr.trOver td.sorted,
.flexigrid div.bDiv tr.trOver td {
    background: #4d86ad !important;
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
    border: 1px solid #4d86ad !important;
}

.flexigrid .pFirst,
.flexigrid .pPrev,
.flexigrid .pNext,
.flexigrid .pLast,
.flexigrid .pReload {
    color: #4d86ad;
    margin-top: 6px;
}

.flexigrid .trSelected a {
    color: #FFFFFF !important;
}

div.colCopy div {
    border-bottom: 1px solid #FFFFFF !important;
    background: #4d86ad !important;
    color: #FFFFFF !important;
}

.gBlock {
    background: #4d86ad !important;
}

.sidebar {
    background-color: #4d86ad !important;
    font-weight: normal;
}

.sidebar header {
    background-color: #4d86ad;
    font-weight: normal;
}

.h-form {
    background-color: #4d86ad;
    border-bottom: 2px solid #0B031D;
    color: #FFFFFF;
}

.panel-info {
    border-color: #4d86ad;
}

div.caixaVazada {
    border: 1px solid #4d86ad;
}

fieldset {
    border: 1px solid #4d86ad !important;
}

fieldset legend {
    color: #0B031D !important;
}

.panel-info > .panel-heading {
    background-color: #4d86ad;
    border-color: #0B031D;
    color: #FFFFFF;
    font-weight: bold;
}

.list-group-item {
    background-color: #FFFFFF;
    border: 1px solid #4d86ad;
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
    background-color: #4d86ad !important;
    color: #FFFFFF;
}

.tab-content {
    border: 1px solid #4d86ad !important;
}

#nav {
    color: #FFFFFF !important;
}

#menu-administrative-responsible a {
    color: #FFFFFF;
}

#menu-administrative-responsible a:focus, #menu-administrative-responsible a:hover {
    background-color: #224455;
}

.active {
    background-color: #224455;
}

.nav > li.active > a {
    background-color: #224455;
}

.nav > li > a:focus, .nav > li > a:hover {
    background-color: #4d86ad;
}

.nav-tabs > li.active > a {
    border-color: #4d86ad #4d86ad transparent;
}

.nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
    background-color: #FFFFFF;
    border-color: #4d86ad #4d86ad transparent;
}

.nav-tabs p {
    color: #FFFFFF;
}

.nav-tabs p:focus, .nav-tabs p:hover {
    color: #000000;
}

.img-thumbnail {
    border: 1px solid #4d86ad;
}

.table > tbody > tr > td,
.table > tbody > tr > th,
.table > tfoot > tr > td,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > thead > tr > th {
    border-top: 1px solid #4d86ad;
}

.table > thead > tr > th {
    border-bottom: 2px solid #4d86ad;
}

.table > tbody+tbody {
    border-top: 2px solid #4d86ad;
}

.table-bordered,
.table-bordered > tbody > tr > td,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > td,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > thead > tr > th {
    border: 1px solid #4d86ad;
}

.btn-default.active,
.btn-default:active,
.btn-default:focus,
.btn-default:hover,
.open > .btn-default.dropdown-toggle {
    background-color: #0B031D;
    border-color: #0B031D;
}

.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
    background-color: #0B031D;
    border-color: #0B031D;
}

.ui-widget-header {
    background: #4d86ad !important;
    background-color: #4d86ad !important;
    color: #FFFFFF !important;
}

.appVersion {
    color: #955955;
}

.ui-autocomplete a.ui-state-focus {
    color: #FFFFFF;
    background: #224455 !important;
}

.helpText {
    color: #0B031D;
}

.ui-datepicker-month, .ui-datepicker-year {
    color: #0B031D !important;
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
    background-color: #224455 !important;
    color: #FFFFFF !important;
}

/* http://hex2rgba.devoth.com/ */
.google-visualization-table-tr-head .gradient,
.google-visualization-table-tr-head-nonstrict .gradient,
.google-visualization-table-div-page .gradient {
    background: #4d86ad !important;
}

.navbar-default,
.inepzend-rodape,
.navbar-default .navbar-nav > li > a,
.navbar-default .navbar-nav > .open > a {
    color: #FFFFFF;
    background-color: #4d86ad;
    border-color: #4d86ad;
}

.navbar-default .navbar-nav > .active > span,
.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus,
.navbar-default .navbar-nav > .open > a:active,
.navbar-default .navbar-nav > li > a:focus,
.navbar-nav > li > a:hover {
    color: #FFFFFF;
    background-color: #224455;
    border-color: #224455;
}

.dropdown-menu > li > a:focus,
.dropdown-menu > li > a:hover {
    color: #FFFFFF;
    background-color: #224455;
}