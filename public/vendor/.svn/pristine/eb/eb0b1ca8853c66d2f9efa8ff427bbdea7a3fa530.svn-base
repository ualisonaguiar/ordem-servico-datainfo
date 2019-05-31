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
/* #5D788B - Cor base */
/* #5D788B - Background */
/* #5D788B - Fundo da tela de login */
/* #17364C - Utilizado nos titulos e subtitulos das paginas, hiperlinks, label, botoes, breadcrumb, flexigrid, formulario, bordas de formulario, formulario e caixa de dialogo */
/* #17364C - Utilizado no texto breadcrumb final */
/* #17364C - Utilizado na borda do botao info */
/* #17364C - Bordas e fundos dos botões quando esta com os eventos hover e focus */
/* #17364C - Cor dos hiperlinks quando esta com os eventos focus e hover */
/* #55646F - Fundo do menu e submenu */
/* #55646F - Fundo dos botoes */
/* #55646F - Itens ativos do menu, cabecalho das tabelas, caixas de dialogos e flexigrid */
/* #55646F - Borda da caixa vazada e fieldset */
/* #FFFFFF - Fundo conteudo */
/* #66AFE9 - Bordas dos elementos hmtl de texto, textarea, select, radio e checkbox quando esta com o evento focus */

body {
    background-color: #5D788B;
}

body.login {
    background-color: #5D788B;
}

.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > span, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > li > a:hover {
    background-color: #852300;
}

.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    color: #17364C;
}

body.login h2 {
    color: #FFFFFF;
}

a {
    color: #17364C;
}

a:focus, a:hover {
    color: #17364C;
}

a[accesskey]:after, button[accesskey]:after, input[accesskey]:after, label[accesskey]:after, legend[accesskey]:after, textarea[accesskey]:after {
    color: plum /*#8E4585*/;
}

label, .ui-grid-top-panel {
    color: #17364C;
}

.btn-info {
    background-color: #55646F;
    border-color: #17364C;
    color: #FFFFFF;
}

.btn-info[disabled], .btn-info.active, .btn-info:active, .btn-info:focus, .btn-info:hover, .open > .btn-info.dropdown-toggle {
    background-color: #5D788B !important;
    border-color: #17364C !important;
}

.ui-button {
    border-color: #17364C !important;
    background: #55646F !important;
}

.ui-button:hover {
    background: #5D788B !important;
    color: #FFFFFF !important;
}

.breadcrumbNameApplication {
    color: #17364C;
}

.breadcrumb {
    color: #17364C;
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
    background-color: #17364C;
}

.flexigrid div.fbutton div button {
    background-color: #55646F;
}

.hDivBox th, .hDivBox th.sorted {
    background-color: #55646F !important;
    background: #55646F !important;
    color: #FFFFFF !important;
}

.flexigrid div.bDiv tr.trSelected:hover td,
.flexigrid div.bDiv tr.trSelected:hover td.sorted,
.flexigrid div.bDiv tr.trOver.trSelected td.sorted,
.flexigrid div.bDiv tr.trOver.trSelected td,
.flexigrid tr.trSelected td.sorted,
.flexigrid tr.trSelected td {
    color: #FFFFFF;
    background: #55646F no-repeat right top !important;
}

.flexigrid div.bDiv tr:hover td,
.flexigrid div.bDiv tr:hover td.sorted,
.flexigrid div.bDiv tr.trOver td.sorted,
.flexigrid div.bDiv tr.trOver td {
    background: #55646F !important;
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
    border: 1px solid #55646F !important;
}

.flexigrid .pFirst,
.flexigrid .pPrev,
.flexigrid .pNext,
.flexigrid .pLast,
.flexigrid .pReload {
    color: #55646F;
    margin-top: 6px;
}

.flexigrid .trSelected a {
    color: #FFFFFF !important;
}

div.colCopy div {
    border-bottom: 1px solid #FFFFFF !important;
    background: #55646F !important;
    color: #FFFFFF !important;
}

.gBlock {
    background: #55646F !important;
}

.sidebar {
    background-color: #55646F !important;
    font-weight: normal;
}

.sidebar header {
    background-color: #55646F;
    font-weight: normal;
}

.h-form {
    background-color: #55646F;
    border-bottom: 2px solid #17364C;
    color: #FFFFFF;
}

.panel-info {
    border-color: #55646F;
}

div.caixaVazada {
    border: 1px solid #55646F;
}

fieldset {
    border: 1px solid #55646F !important;
}

fieldset legend {
    color: #17364C !important;
}

.panel-info > .panel-heading {
    background-color: #55646F;
    border-color: #17364C;
    color: #FFFFFF;
    font-weight: bold;
}

.list-group-item {
    background-color: #FFFFFF;
    border: 1px solid #55646F;
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
    background-color: #55646F !important;
    color: #FFFFFF;
}

.tab-content {
    border: 1px solid #55646F !important;
}

#nav {
    color: #FFFFFF !important;
}

#menu-administrative-responsible a {
    color: #FFFFFF;
}

#menu-administrative-responsible a:focus, #menu-administrative-responsible a:hover {
    background-color: #5D788B;
}

.active {
    background-color: #5D788B;
}

.nav > li.active > a {
    background-color: #5D788B;
}

.nav > li > a:focus, .nav > li > a:hover {
    background-color: #55646F;
}

.nav-tabs > li.active > a {
    border-color: #55646F #55646F transparent;
}

.nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
    background-color: #FFFFFF;
    border-color: #55646F #55646F transparent;
}

.nav-tabs p {
    color: #FFFFFF;
}

.nav-tabs p:focus, .nav-tabs p:hover {
    color: #000000;
}

.img-thumbnail {
    border: 1px solid #55646F;
}

.table > tbody > tr > td,
.table > tbody > tr > th,
.table > tfoot > tr > td,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > thead > tr > th {
    border-top: 1px solid #55646F;
}

.table > thead > tr > th {
    border-bottom: 2px solid #55646F;
}

.table > tbody+tbody {
    border-top: 2px solid #55646F;
}

.table-bordered,
.table-bordered > tbody > tr > td,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > td,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > thead > tr > th {
    border: 1px solid #55646F;
}

.btn-default.active,
.btn-default:active,
.btn-default:focus,
.btn-default:hover,
.open > .btn-default.dropdown-toggle {
    background-color: #17364C;
    border-color: #17364C;
}

.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
    background-color: #17364C;
    border-color: #17364C;
}

.ui-widget-header {
    background: #55646F !important;
    background-color: #55646F !important;
    color: #FFFFFF !important;
}

.appVersion {
    color: #955955;
}

.ui-autocomplete a.ui-state-focus {
    color: #FFFFFF;
    background: #5D788B !important;
}

.helpText {
    color: #17364C;
}

.ui-datepicker-month, .ui-datepicker-year {
    color: #17364C !important;
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
    background-color: #5D788B !important;
    color: #FFFFFF !important;
}

/* http://hex2rgba.devoth.com/ */
.google-visualization-table-tr-head .gradient,
.google-visualization-table-tr-head-nonstrict .gradient,
.google-visualization-table-div-page .gradient {
    background: linear-gradient(to bottom, rgba(85, 100, 111, 1), rgba(85, 100, 111, 1), rgba(85, 100, 111, 1), rgba(85, 100, 111, 1)) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
}

.navbar-default,
.inepzend-rodape,
.navbar-default .navbar-nav > li > a,
.navbar-default .navbar-nav > .open > a {
    color: #FFFFFF;
    background-color: #55646F;
    border-color: #55646F;
}

.navbar-default .navbar-nav > .active > span,
.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus,
.navbar-default .navbar-nav > .open > a:active,
.navbar-default .navbar-nav > li > a:focus,
.navbar-nav > li > a:hover {
    color: #FFFFFF;
    background-color: #5D788B;
    border-color: #5D788B;
}

.dropdown-menu > li > a:focus,
.dropdown-menu > li > a:hover {
    color: #FFFFFF;
    background-color: #5D788B;
}