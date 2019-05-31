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
@media screen and (max-width: 480px) and (orientation: landscape) {
	.navbar-fixed-bottom .navbar-collapse, .navbar-fixed-top .navbar-collapse {
		max-height: 200px
	}
}

@media screen and (max-width: 767px) {
	.table-responsive {
		width: 100%;
		margin-bottom: 13.5px;
		overflow-y: hidden;
		overflow-x: auto;
		-ms-overflow-style: -ms-autohiding-scrollbar;
		border: 1px solid #94d7e4;
		-webkit-overflow-scrolling: touch
	}
	
	.table-responsive>.table {
		margin-bottom: 0
	}
	
	.table-responsive>.table>tbody>tr>td, .table-responsive>.table>tbody>tr>th,
		.table-responsive>.table>tfoot>tr>td, .table-responsive>.table>tfoot>tr>th,
		.table-responsive>.table>thead>tr>td, .table-responsive>.table>thead>tr>th {
		white-space: nowrap
	}
	
	.table-responsive>.table-bordered {
		border: 0
	}
	
	.table-responsive>.table-bordered>tbody>tr>td:first-child,
		.table-responsive>.table-bordered>tbody>tr>th:first-child,
		.table-responsive>.table-bordered>tfoot>tr>td:first-child,
		.table-responsive>.table-bordered>tfoot>tr>th:first-child,
		.table-responsive>.table-bordered>thead>tr>td:first-child,
		.table-responsive>.table-bordered>thead>tr>th:first-child {
		border-left: 0
	}
	
	.table-responsive>.table-bordered>tbody>tr>td:last-child,
		.table-responsive>.table-bordered>tbody>tr>th:last-child,
		.table-responsive>.table-bordered>tfoot>tr>td:last-child,
		.table-responsive>.table-bordered>tfoot>tr>th:last-child,
		.table-responsive>.table-bordered>thead>tr>td:last-child,
		.table-responsive>.table-bordered>thead>tr>th:last-child {
		border-right: 0
	}
	
	.table-responsive>.table-bordered>tbody>tr:last-child>td,
		.table-responsive>.table-bordered>tbody>tr:last-child>th,
		.table-responsive>.table-bordered>tfoot>tr:last-child>td,
		.table-responsive>.table-bordered>tfoot>tr:last-child>th {
		border-bottom: 0
	}
	
	.row-offcanvas {
		position: relative;
		-webkit-transition: all .25s ease-out;
		transition: all .25s ease-out
	}
	
	.row-offcanvas-right {
		right: 0
	}
	
	.row-offcanvas-left {
		left: 0
	}
	
	.row-offcanvas-right .sidebar-offcanvas {
		right: -50%
	}
	
	.row-offcanvas-right.active {
		right: 50%
	}
	
	.row-offcanvas-left.active {
		left: 50%
	}
	
	.sidebar-offcanvas {
		position: absolute;
		width: 50%
	}
}

@media screen and (max-width: 767px) {
	.navbar-nav .open .dropdown-menu {
		position: static;
		float: none;
		width: auto;
		margin-top: 0;
		background-color: transparent;
		border: 0;
		-webkit-box-shadow: none;
		box-shadow: none
	}
	
	.navbar-nav .open .dropdown-menu .dropdown-header, .navbar-nav .open .dropdown-menu>li>a {
		padding: 5px 15px 5px 25px
	}
	
	.navbar-nav .open .dropdown-menu>li>a {
		line-height: 18px
	}
	
	.navbar-nav .open .dropdown-menu>li>a:focus, .navbar-nav .open .dropdown-menu>li>a:hover {
		background-image: none
	}
	
	.navbar-form .form-group {
		margin-bottom: 5px
	}
	
	.navbar-default .navbar-nav .open .dropdown-menu>li>a {
		color: #fff
	}
	
	.navbar-default .navbar-nav .open .dropdown-menu>.active>a,
		.navbar-default .navbar-nav .open .dropdown-menu>.active>a:focus,
		.navbar-default .navbar-nav .open .dropdown-menu>.active>a:hover,
		.navbar-default .navbar-nav .open .dropdown-menu>li>a:focus,
		.navbar-default .navbar-nav .open .dropdown-menu>li>a:hover {
		color: #fff;
		background-color: #852300
	}
	
	.navbar-default .navbar-nav .open .dropdown-menu>.disabled>a,
		.navbar-default .navbar-nav .open .dropdown-menu>.disabled>a:focus,
		.navbar-default .navbar-nav .open .dropdown-menu>.disabled>a:hover {
		color: #ccc;
		background-color: transparent
	}
	
	.navbar-inverse .navbar-nav .open .dropdown-menu>.dropdown-header {
		border-color: #090909
	}
	
	.navbar-inverse .navbar-nav .open .dropdown-menu .divider {
		background-color: #090909
	}
	
	.navbar-inverse .navbar-nav .open .dropdown-menu>li>a {
		color: #777
	}
	
	.navbar-inverse .navbar-nav .open .dropdown-menu>li>a:focus,
		.navbar-inverse .navbar-nav .open .dropdown-menu>li>a:hover {
		color: #fff;
		background-color: transparent
	}
	
	.navbar-inverse .navbar-nav .open .dropdown-menu>.active>a,
		.navbar-inverse .navbar-nav .open .dropdown-menu>.active>a:focus,
		.navbar-inverse .navbar-nav .open .dropdown-menu>.active>a:hover {
		color: #fff;
		background-color: #090909
	}
	
	.navbar-inverse .navbar-nav .open .dropdown-menu>.disabled>a,
		.navbar-inverse .navbar-nav .open .dropdown-menu>.disabled>a:focus,
		.navbar-inverse .navbar-nav .open .dropdown-menu>.disabled>a:hover {
		color: #444;
		background-color: transparent
	}
	
	.visible-xs {
		display: block !important
	}
	
	table.visible-xs {
		display: table
	}
	
	tr.visible-xs {
		display: table-row !important
	}
	
	td.visible-xs, th.visible-xs {
		display: table-cell !important
	}
	
	.visible-xs-block {
		display: block !important
	}
	
	.visible-xs-inline {
		display: inline !important
	}
	
	.visible-xs-inline-block {
		display: inline-block !important
	}
	
	.hidden-xs {
		display: none !important
	}
	
	body>footer .text-center {
		text-align: center
	}
	
	a.open-menu-administrative-responsible-not-fix {
	    display: none !important;
	}     
	
	.divTransferButton {
	    width: 20% !important;
	}
	
	textarea.form-control, .counterCharacters {
	    width: 100% !important;
	}
	
	div.form-group label, div.divTransferBlock label {
	    white-space: nowrap;
	}
	
	.labelCheckbox {
	    width: 48% !important;
	}
	
	.sidebar {
	    width: 100%;
	}
	
	#menu-administrative-responsible {
	    display: block;
	}
	
	.breadcrumb {
	    margin-top: 15px;
	}
	
	.pDiv, .divTableGoogle {
	    overflow: auto !important;
	}
	
	.form-group {
	    float: none !important;
	    width: 100% !important;
	}
	
	#imagem-logo-inep {
	    padding-left: 0px !important;
	    margin-left: 40px !important;
	}
	
	.navbar-header span.navbar-brand {
	    display: block;
	    margin-left: 0px;
	    font-size: 1.5em;
	}
	
	.linkCorreios {
	    float: right;
	    height: 17px;
	    margin: -79px 0 0;
	    padding: 0px;
	    text-align: right;
	    width: 50%;
	}
	
	.phoneDdd {
	    margin: -2px 0 0;
	    padding: 0px;
	    min-height: 55px;
	}
}