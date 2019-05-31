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
@media screen {
	.header-banner {
	    margin-top: 45px;
	}
	
	select {
	    padding-top: 2px !important;
	    padding-bottom: 2px !important;
	}
	
	a {
	    text-decoration: none;
	}
	
	div.error {
	    color: #a94442 !important;
	}
	
	.alert-error {
	    background-color: #f2dede;
	    border-color: #ebccd1;
	    color: #a94442;    
	}
	
	.alert-notice {
	    background-color: #d9edf7;
	    border-color: #bce8f1;
	    color: #31708f;
	}
	
	.alert-validate {
	    /*background-color: #DFB200;*/
	    background-color: #fcf8e3;
	    border-color: #faebcc;
	    color: #8a6d3b;
	}
	
	.selectPaginationControl {
	    font-size: 12px;
	    height: 18px;
	    width: 50px;
	    padding: 0px;
	    vertical-align: baseline;
	    margin: 0px;
	}
	
	.appVersion {
	    font-size: 10px;
	    text-align: center;
	}
	
	.helpText {
	    cursor: help;
	    float: left;
	    margin-top: 6px;
	    height: 18px;
	    margin-left: 3px;
	    margin-top: 4px;
	    width: 15px;
	    font-size: 15px;
	}
	
	.tercoTela {
	    margin-left: 33%;
	    margin-right: 33%;
	    overflow: visible;
	}
	
	.meiaTela {
	    margin-left: 25%;
	    margin-right: 25%;
	    overflow: visible;
	}
	
	.parcialTela20 {
	    margin-left: 20%;
	    margin-right: 20%;
	    overflow: visible;
	}
	
	div.caixaVazada {
	    border-radius: 2px;
	    display: block;
	    padding-bottom: 10px;
	    overflow: hidden;
	}
	
	div.caixaVazada > * {
	    padding-left: 10px;
	    padding-right: 10px;
	}
	
	div.caixaVazada > div {
	    margin-left: 10px;
	    margin-right: 10px;
	}
	
	div.caixaVazada > button,
	fieldset > button {
	    margin-right: 10px;
	}
	
	fieldset {
	    margin: 10px 0px 0px 0px !important;
	    padding: 40px 10px 10px 10px !important;
	    position: relative !important;
	    width: 100%;
	}
	
	fieldset legend {
	    margin: 0px 15px 0px 10px !important;
	    position: absolute !important;
	    top: 0px !important;
	    left: 0px !important;
	    padding: 9px 0px 0px 0px !important;
	    font-size: 16px !important;
	    font-family: inherit !important;
	    font-weight: 700 !important;
	    line-height: 1.1 !important;
	}
	
	form > button,
	form > div > button {
	    margin-left: 10px !important;
	}
	
	div.caixaVazada > h1,
	div.caixaVazada > h2,
	div.caixaVazada > h3,
	div.caixaVazada > h4,
	div.caixaVazada > h5,
	div.caixaVazada > h6,
	div.caixaVazada > div.form-group,
	div.caixaVazada > div.flexigrid,
	div.caixaVazada iframe {
	    margin-left: 0px;
	    margin-right: 0px;
	}
	
	div.caixaVazada div.caixaVazada {
	    padding: 0px;
	    padding-bottom: 10px;
	}
	
	div.caixaVazada > div.caixaVazada > * {
	    padding-left: 10px;
	    padding-right: 10px;
	}
	
	div.caixaVazada > div.caixaVazada > div {
	    padding-left: 0px;
	    padding-right: 0px;
	}
	
	div.caixaVazada > div.caixaVazada > div.form-group {
	    padding-left: 10px;
	    padding-right: 10px;
	}
	
	div.caixaVazada > div.caixaVazada > div.caixaVazada {
	    padding-bottom: 0px;
	    padding-left: 0px;
	    padding-right: 0px;
	}
	
	div.caixaVazada > div.caixaVazada > div.caixaVazada > * {
	    padding-left: 0px;
	    padding-right: 0px;
	}
	
	div.caixaVazada > div.caixaVazada button {
	    margin-right: 10px;
	}
	
	div.caixaVazada > div.caixaVazada .divTransferButton button {
	    margin-right: 0px;
	}
	
	.padding10 {
	    padding: 10px;
	}
	
	.caixaVazadaComplemento {
	    text-align: justify; 
	    margin-bottom: 5px; 
	    min-height: 425px; 
	    *min-height: 460px;
	}
	
	.caixaVazadaMetade {
	    width: 48%; 
	    float: left; 
	    margin-right: 5px;
	}
	
	.no-screen {
	    display: none;
	}
	
	.red {
	    border: 1px solid red;
	}
	
	.breadcrumbNameApplication {
	    font-weight: bold;
	}
	
	.divPassValidation {
	    padding: 3px; 
	    padding-left: 10px; 
	    font-weight: bold; 
	    width: 350px;
	    margin-bottom: 2px;
	}
	
	.obs {
	    border-radius: 4px 4px 4px 4px;
	    display: block;
	    font-size: 12px;
	    line-height: 20px;
	    margin: 0 0 10px;
	    padding: 9.5px;
	    /*white-space: pre-wrap;
	    word-break: normal;
	    word-wrap: break-word;*/
	    text-align: justify;
	    overflow: hidden;
	}
	
	.paginatorValueCol {
	    width: 16px; 
	    min-height: 20px; 
	    margin: 0px;
	    float: left;
	}
	
	.paginatorLabel {
	    font-weight: normal;
	    font-size: 12px;
	}
	
	.divHeightRow {
	    height: 87px; 
	    overflow: hidden;
	    padding-top: 5px; 
	    padding-left: 10px;
	}
	
	.divTransferButton .btnDefault {
	    float: none !important;
	}
	
	.btnDefault {
	    margin-top: 5px;
	    margin-left: 0px;
	    float: right !important;
	}
	
	.icoFontSize {
	    height: 15px;
	    width: 15px;
	    cursor: pointer;
	    float: left;
	}
	
	.icoFontSizeNormal {
	    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEgAACxIB0t1+/AAAAAd0SU1FB9wJGxIJIjggSagAAAD2SURBVCjP3ZCxLgQBEIa/vXXH6TZIRCSi0V0kJyqJSqG54hQKhVdQ8SR4AUQknkOlJaIUJaI4bLP3KUwhm9tFa6rJP/PN/2fgf5Q6pm6rp2rnr3BX/fCrTtS5qt1GCWwDW8BESGvA0q9gIAN2gGvgDFgEOmr6U9xE3Yi4x+qq+qheqbNqU21UwS31Un1V+6FdxLF1daou9gzQB56BvCiK+egBdoFBXeyDcBmqt+qN+hTaQF0oM8k3+AGYBs6BFyAF3oAesAzsAYdJkgzLrpvhcJfneaq21cmY7avv6r3arIt8NGKWxddVW6PgcbWnZhX/WFG7Zf0TEafjCvK1qBAAAAAASUVORK5CYII=);
	    *background: url(../../../images/a_normal.png);
	}
	
	.icoFontSizePlus {
	    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAACV0RVh0U29mdHdhcmUATWFjcm9tZWRpYSBGaXJld29ya3MgTVggMjAwNId2rM8AAAAWdEVYdENyZWF0aW9uIFRpbWUAMDQvMjcvMTFjmal9AAAA3ElEQVR4nJ2S0RGCQAxEH47/0oF0IB1IB1ICJWgH2AElWAJ2QAmUYAl0sH4YMXcc42hmMhNym2Q3IZPEv7b5AVsCzbfiEhiALsrXcfE2UdwDe+AIjNaoMM+BynADkrzXCq2XNGhpkyTi4t4eWwcs7K21RjPea86Bk8UdcLc40BmY63R2VL2Eh30XjgUx7dHAjctNlqsjeUiat10CBxe3Fk/Azqj3a7RviY3GFlCWRKbX7/mecLHbervZ3a+O0Ty58bdLeBctLjhVbn2Wmj5nw+EWmitJ+cpkJJUpzU/jl3dV6hQKOgAAAABJRU5ErkJggg==);
	    *background: url(../../../images/a_mais.png);
	}
	
	.icoFontSizeMinus {
	    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAACV0RVh0U29mdHdhcmUATWFjcm9tZWRpYSBGaXJld29ya3MgTVggMjAwNId2rM8AAAAWdEVYdENyZWF0aW9uIFRpbWUAMDQvMjcvMTFjmal9AAAAoUlEQVR4nM2T0Q3CMAxEXxEDdAMySkdghIzACGxAR2CEjgAblA0YIUxwfOAiY4WC+gMnWUocP+tsKY0klmq1mPw7eAcMQLJ7D8jFOBWuA5iAg50LkK347GqeMJJ89HpokFQkteH9JWKiGLi1JvlbOAegSLrOwX5h2c3a2WwbO9dlXZLe6/jJ9rSoLhSMlq8uztu+AKdgbA/cgLbmuvnZx7gDqI8KkJf9ulEAAAAASUVORK5CYII=);
	    *background: url(../../../images/a_menos.png);
	}
	
	/*.ui-dialog,
	.ui-front {
	    z-index: 9999 !important;
	}*/
	
	.ui-widget {
	    font-size: 1em !important;
	}
	
	.ui-widget-header {
	    text-decoration: none !important;
	}
	
	.ui-button-text {
	    font-size: 13px;
	    font-weight: bold;
	}
	
	.ui-state-focus {
	    background: #0e377d !important;
	}
	
	.ui-autocomplete {
	    max-height: 200px; 
	    overflow-y: scroll; 
	    overflow-x: hidden;
	}
	
	.ui-autocomplete a.ui-state-focus {
	    font-family: sans-serif;
	    -ms-text-size-adjust: 100%;
	    -webkit-text-size-adjust: 100%;
	}
	
	.btnUi[accesskey]:after {
	    font-size: 13px !important;
	    font-weight: bold;
	}
	
	.h1, h1 {
	    /*font-size: 33px;*/
	    font-size: 23px !important;
	    padding-bottom: 9px;
	    border-bottom: 1px solid #eeeeee;
	}
	
	.h2, h2 {
	    /*font-size: 27px;*/
	    font-size: 17px !important;
	}
	
	.h3, h3 {
	    /*font-size: 23px;*/
	    font-size: 16px !important;
	}
	
	.h4, h4 {
	    /*font-size: 17px;*/
	    font-size: 14px !important;
	}
	
	.h-form {
	    padding: 7px 11px;
	    margin-top: 0px;
	    margin-bottom: 10px;
	}
	
	.navbar-default .navbar-toggle {
	    border-color: transparent;
	}
	
	.navbar-toggle.left {
	    left: 0;
	}
	
	.navbar-brand {
	    margin-left: 110px;
	}
	
	#navbar-toggle-info-usuario {
	    right: 0px;
	}
	
	#menu-administrative-responsible h2 {
	    border-bottom: none;
	}
	
	.form-group {
	    overflow: hidden;
	    min-height: 77px;
	    margin-bottom: 2px !important;
	}
	
	.paddingBreakLabel {
	    padding: 0px !important;
	}
	
	.counterCharacters {
	    text-align: right;
	}
	
	.phoneDdd {
	    position: relative; 
	    width: 210px; 
	    overflow: hidden; 
	    border: 0px; 
	    min-height: 77px; 
	    margin-bottom: 2px; 
	    padding-top: 24px;
	}
	
	input[type="file"].form-control {
	    padding: 0px 12px !important;
	}
	
	.form-control.error:focus,
	input.form-control.error:focus,
	textarea.form-control.error:focus,
	select.form-control.error:focus {
	    outline: 0px none;
	}
	
	.divBetweenText {
	    float: left; 
	    padding-top: 29px; 
	    text-align: center;
	    height: 60px;
	    padding-right: 13px;
	}
	
	.divFormGroupWithoutLabel {
	    position: relative; 
	    width: 193px; 
	    overflow: hidden; 
	    border: 0px; 
	    padding-top: 24px; 
	    padding-left: 0px;
	    height: 60px; 
	}
	
	div.divTransferBlock {
	    width: 37%; 
	    float: left;
	}
	
	body > footer {
	    line-height: 20px !important;
	    background-color: #852300;
	}
	
	.breadcrumb i.fa {
	    padding-right: 5px;
	}
	
	.divEventCalendar .ui-state-default, 
	.divEventCalendar .ui-widget-content .ui-state-default, 
	.divEventCalendar .ui-widget-header .ui-state-default {
	    color: #FFFFFF;
	}
	
	.google-visualization-table {
	    padding: 0px !important;
	    width: 100%;
	}
	
	.google-visualization-table-table {
	    width: 100%;
	}
	
	.ui-grid-pager-panel {
	   	position: relative !important;
	   	left: auto !important;
	   	bottom: auto !important;
	   	padding-top: 0 !important;
	   	padding-bottom: 0 !important;
		overflow: hidden !important;
	    margin-top: -40px !important;
	}
	
	.ui-grid-pager-container, .ui-grid-pager-count-container {
	 	margin-top: 10px !important;
	}
	
	.ui-grid {
		height: 383px;
	}

    .noPrint { 
        display: block; 
    }

    .yesPrint{ 
        display: block !important; 
    }
}

@media print {
    .noPrint { 
        display: none; 
    }

    .yesPrint{ 
        display: block !important; 
    }
}