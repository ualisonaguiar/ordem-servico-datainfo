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
/* # - Cor base */
/* #FFFFFF - Background */
/* #C0E9E3 - Fundo da tela de login */
/* #0E377D - Utilizado nos titulos e subtitulos das paginas, hiperlinks, label, botoes, breadcrumb, flexigrid, formulario, bordas de formulario, formulario e caixa de dialogo */
/* #369369 - Utilizado no texto breadcrumb final */
/* #80CFDF - Utilizado na borda do botao info */
/* #0E377D - Bordas e fundos dos botões quando esta com os eventos hover e focus */
/* #061938 - Cor dos hiperlinks quando esta com os eventos focus e hover */
/* #F3F3F3 - Fundo do menu e submenu */
/* #94D7E4 - Fundo dos botoes */
/* #94D7E4 - Itens ativos do menu, cabecalho das tabelas, caixas de dialogos e flexigrid */
/* #BCE8F1 - Borda da caixa vazada e fieldset */
/* #FFFFFF - Fundo conteudo */
/* #66AFE9 - Bordas dos elementos hmtl de texto, textarea, select, radio e checkbox quando esta com o evento focus */

body {
    background-color: #FFFFFF;
}

body.login {
    background-color: #C0E9E3;
}

.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > span, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > li > a:hover {
    background-color: #852300;
}

.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    color: #0E377D;
}

body.login h2 {
    color: #0E377D;
}

a {
    color: #0E377D;
}

a:focus, a:hover {
    color: #061938;
}

a[accesskey]:after, button[accesskey]:after, input[accesskey]:after, label[accesskey]:after, legend[accesskey]:after, textarea[accesskey]:after {
    color: plum /*#8E4585*/;
}

label, .ui-grid-top-panel {
    color: #0E377D;
}

.btn-info {
    background-color: #94D7E4;
    border-color: #80CFDF;
    color: #0E377D;
}

.btn-info[disabled], .btn-info.active, .btn-info:active, .btn-info:focus, .btn-info:hover, .open > .btn-info.dropdown-toggle {
    background-color: #0E377D !important;
    border-color: #0E377D !important;
}

.ui-button {
    border-color: #21ADB8 !important;
    background: #94D7E4 !important;
}

.ui-button:hover {
    background: #0E377D !important;
    color: #FFFFFF !important;
}

.breadcrumbNameApplication {
    color: #0e377d;
}

.breadcrumb {
    color: #0E377D;
}

.divPassValidation {
    color: #FFFFFF;
    border: 1px solid #DDDDDD;
}

.obs {
    background-color: #F5F5F5;
    border: 1px solid #d0d0d0;
}

.flexigrid div.fbutton div button:hover, .flexigrid div.fbutton.fbOver {
    background-color: #0E377D;
}

.flexigrid div.fbutton div button {
    background-color: #94D7E4;
}

.hDivBox th, .hDivBox th.sorted {
    background-color: #94D7E4 !important;
    background: #94D7E4 !important;
    color: #0E377D !important;
}

.flexigrid div.bDiv tr.trSelected:hover td,
.flexigrid div.bDiv tr.trSelected:hover td.sorted,
.flexigrid div.bDiv tr.trOver.trSelected td.sorted,
.flexigrid div.bDiv tr.trOver.trSelected td,
.flexigrid tr.trSelected td.sorted,
.flexigrid tr.trSelected td {
    color: #000000;
    background: #94D7E4 no-repeat right top !important;
}

.flexigrid div.bDiv tr:hover td,
.flexigrid div.bDiv tr:hover td.sorted,
.flexigrid div.bDiv tr.trOver td.sorted,
.flexigrid div.bDiv tr.trOver td {
    background: #94D7E4 !important;
    border-bottom: 1px solid #FFFFFF !important;
    color: #000000;
}

.flexigrid div.bDiv tr:hover td a,
.flexigrid div.bDiv tr:hover td.sorted a {
    color: #0E377D;
}

.flexigrid div.hDiv, .flexigrid div.hDivBox {
    background: #FFFFFF !important;
}

.flexigrid div.bDiv tr:hover td,
.flexigrid div.bDiv tr:hover td.sorted,
.flexigrid div.bDiv tr.trOver td.sorted,
.flexigrid div.bDiv tr.trOver td {
    color: #000000;
}

.flexigrid {
    border: 1px solid #94D7E4 !important;
}

.flexigrid .pFirst,
.flexigrid .pPrev,
.flexigrid .pNext,
.flexigrid .pLast,
.flexigrid .pReload {
    color: #0E377D;
    margin-top: 6px;
}

.flexigrid .trSelected a {
    color: #0e377d !important;
}

div.colCopy div {
    border-bottom: 1px solid #FFFFFF !important;
    background: #94D7E4 !important;
    color: #0E377D !important;
}

.gBlock {
    background: #94D7E4 !important;
}

.sidebar {
    background-color: #F3F3F3 !important;
    font-weight: normal;
}

.sidebar header {
    background-color: #94D7E4;
    font-weight: normal;
}

.h-form {
    background-color: #94D7E4;
    border-bottom: 2px solid #0E377D;
    color: #0E377D;
}

.panel-info {
    border-color: #94D7E4;
}

div.caixaVazada {
    border: 1px solid #BCE8F1;
}

fieldset {
    border: 1px solid #BCE8F1 !important;
}

fieldset legend {
    color: #0E377D !important;
}

.panel-info > .panel-heading {
    background-color: #94D7E4;
    border-color: #0E377D;
    color: #FFFFFF;
    font-weight: bold;
}

.list-group-item {
    background-color: #FFFFFF;
    border: 1px solid #94D7E4;
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
    background-color: #94D7E4 !important;
    color: #0E377D;
}

.tab-content {
    border: 1px solid #94D7E4 !important;
}

#nav {
    color: #0E377D !important;
}

#menu-administrative-responsible a {
    color: #0E377D;
}

#menu-administrative-responsible a:focus, #menu-administrative-responsible a:hover {
    background-color: #94D7E4;
}

.active {
    background-color: #94D7E4;
}

.nav > li.active > a {
    background-color: #94D7E4;
}

.nav > li > a:focus, .nav > li > a:hover {
    background-color: #94D7E4;
}

.nav-tabs > li.active > a {
    border-color: #94D7E4 #94D7E4 transparent;
}

.nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
    background-color: #FFFFFF;
    border-color: #94D7E4 #94D7E4 transparent;
}

.nav-tabs p {
    color: #000000;
}

.nav-tabs p:focus, .nav-tabs p:hover {
    color: #000000;
}

.img-thumbnail {
    border: 1px solid #94D7E4;
}

.table > tbody > tr > td,
.table > tbody > tr > th,
.table > tfoot > tr > td,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > thead > tr > th {
    border-top: 1px solid #94D7E4;
}

.table > thead > tr > th {
    border-bottom: 2px solid #94D7E4;
}

.table > tbody + tbody {
    border-top: 2px solid #94D7E4;
}

.table-bordered,
.table-bordered > tbody > tr > td,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > td,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > thead > tr > th {
    border: 1px solid #94D7E4;
}

.btn-default.active,
.btn-default:active,
.btn-default:focus,
.btn-default:hover,
.open > .btn-default.dropdown-toggle {
    background-color: #0E377D;
    border-color: #0E377D;
}

.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
    background-color: #0E377D;
    border-color: #0E377D;
}

.ui-widget-header {
    background: #94D7E4 !important;
    background-color: #94D7E4 !important;
    color: #0E377D !important;
}

.appVersion {
    color: #955955;
}

.ui-autocomplete a.ui-state-focus {
    color: #FFFFFF;
    background: #94D7E4 !important;
}

.helpText {
    color: #0E377D;
}

.ui-datepicker-month, .ui-datepicker-year {
    color: #0e377d !important;
}

span.ui-datepicker-month, span.ui-datepicker-year,
.ui-datepicker-calendar th span {
    color: #0e377d !important;
}

.panel-heading h2 {
    color: #FFFFFF;
}

.panel {
    background-color: #FFFFFF;
}

.ui-state-focus {
    background-color: #94D7E4 !important;
    color: #0E377D !important;
}

/* http://hex2rgba.devoth.com/ */
.google-visualization-table-tr-head .gradient,
.google-visualization-table-tr-head-nonstrict .gradient,
.google-visualization-table-div-page .gradient {
    background: linear-gradient(to bottom, rgba(148, 215, 228, 1), rgba(148, 215, 228, 1), rgba(148, 215, 228, 1), rgba(148, 215, 228, 1)) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
}

.navbar-default,
.inepzend-rodape,
.navbar-default .navbar-nav > li > a,
.navbar-default .navbar-nav > .open > a {
    color: #FFFFFF;
    background-color: #94D7E4;
    border-color: #94D7E4;
}

.navbar-default .navbar-nav > .active > span,
.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus,
.navbar-default .navbar-nav > .open > a:active,
.navbar-default .navbar-nav > li > a:focus,
.navbar-nav > li > a:hover {
    color: #FFFFFF;
    background-color: #0E377D;
    border-color: #0E377D;
}

.dropdown-menu > li > a:focus,
.dropdown-menu > li > a:hover {
    color: #0E377D;
    background-color: #94D7E4;
}