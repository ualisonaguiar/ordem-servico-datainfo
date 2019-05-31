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
@media screen and (min-width: 768px) {
	.lead {
		font-size: 19.5px
	}
	
	.dl-horizontal dt {
		float: left;
		width: 160px;
		clear: left;
		text-align: right;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap
	}
	
	.dl-horizontal dd {
		margin-left: 180px
	}
	
	.container {
		width: 750px
	}
	
	.col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3,
		.col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9 {
		float: left
	}
	
	.col-sm-1 {
		width: 8.33333%
	}
	
	.col-sm-2 {
		width: 16.66667%
	}
	
	.col-sm-3 {
		width: 25%
	}
	
	.col-sm-4 {
		width: 33.33333%
	}
	
	.col-sm-5 {
		width: 41.66667%
	}
	
	.col-sm-6 {
		width: 50%
	}
	
	.col-sm-7 {
		width: 58.33333%
	}
	
	.col-sm-8 {
		width: 66.66667%
	}
	
	.col-sm-9 {
		width: 75%
	}
	
	.col-sm-10 {
		width: 83.33333%
	}
	
	.col-sm-11 {
		width: 91.66667%
	}
	
	.col-sm-12 {
		width: 100%
	}
	
	.col-sm-pull-0 {
		right: auto
	}
	
	.col-sm-pull-1 {
		right: 8.33333%
	}
	
	.col-sm-pull-2 {
		right: 16.66667%
	}
	
	.col-sm-pull-3 {
		right: 25%
	}
	
	.col-sm-pull-4 {
		right: 33.33333%
	}
	
	.col-sm-pull-5 {
		right: 41.66667%
	}
	
	.col-sm-pull-6 {
		right: 50%
	}
	
	.col-sm-pull-7 {
		right: 58.33333%
	}
	
	.col-sm-pull-8 {
		right: 66.66667%
	}
	
	.col-sm-pull-9 {
		right: 75%
	}
	
	.col-sm-pull-10 {
		right: 83.33333%
	}
	
	.col-sm-pull-11 {
		right: 91.66667%
	}
	
	.col-sm-pull-12 {
		right: 100%
	}
	
	.col-sm-push-0 {
		left: auto
	}
	
	.col-sm-push-1 {
		left: 8.33333%
	}
	
	.col-sm-push-2 {
		left: 16.66667%
	}
	
	.col-sm-push-3 {
		left: 25%
	}
	
	.col-sm-push-4 {
		left: 33.33333%
	}
	
	.col-sm-push-5 {
		left: 41.66667%
	}
	
	.col-sm-push-6 {
		left: 50%
	}
	
	.col-sm-push-7 {
		left: 58.33333%
	}
	
	.col-sm-push-8 {
		left: 66.66667%
	}
	
	.col-sm-push-9 {
		left: 75%
	}
	
	.col-sm-push-10 {
		left: 83.33333%
	}
	
	.col-sm-push-11 {
		left: 91.66667%
	}
	
	.col-sm-push-12 {
		left: 100%
	}
	
	.col-sm-offset-0 {
		margin-left: 0
	}
	
	.col-sm-offset-1 {
		margin-left: 8.33333%
	}
	
	.col-sm-offset-2 {
		margin-left: 16.66667%
	}
	
	.col-sm-offset-3 {
		margin-left: 25%
	}
	
	.col-sm-offset-4 {
		margin-left: 33.33333%
	}
	
	.col-sm-offset-5 {
		margin-left: 41.66667%
	}
	
	.col-sm-offset-6 {
		margin-left: 50%
	}
	
	.col-sm-offset-7 {
		margin-left: 58.33333%
	}
	
	.col-sm-offset-8 {
		margin-left: 66.66667%
	}
	
	.col-sm-offset-9 {
		margin-left: 75%
	}
	
	.col-sm-offset-10 {
		margin-left: 83.33333%
	}
	
	.col-sm-offset-11 {
		margin-left: 91.66667%
	}
	
	.col-sm-offset-12 {
		margin-left: 100%
	}
	
	.col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3,
		.col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9 {
		float: left
	}
	
	.col-md-1 {
		width: 8.33333%
	}
	
	.col-md-2 {
		width: 16.66667%
	}
	
	.col-md-3 {
		width: 25%
	}
	
	.col-md-4 {
		width: 33.33333%
	}
	
	.col-md-5 {
		width: 41.66667%
	}
	
	.col-md-6 {
		width: 50%
	}
	
	.col-md-7 {
		width: 58.33333%
	}
	
	.col-md-8 {
		width: 66.66667%
	}
	
	.col-md-9 {
		width: 75%
	}
	
	.col-md-10 {
		width: 83.33333%
	}
	
	.col-md-11 {
		width: 91.66667%
	}
	
	.col-md-12 {
		width: 100%
	}
	
	.col-md-pull-0 {
		right: auto
	}
	
	.col-md-pull-1 {
		right: 8.33333%
	}
	
	.col-md-pull-2 {
		right: 16.66667%
	}
	
	.col-md-pull-3 {
		right: 25%
	}
	
	.col-md-pull-4 {
		right: 33.33333%
	}
	
	.col-md-pull-5 {
		right: 41.66667%
	}
	
	.col-md-pull-6 {
		right: 50%
	}
	
	.col-md-pull-7 {
		right: 58.33333%
	}
	
	.col-md-pull-8 {
		right: 66.66667%
	}
	
	.col-md-pull-9 {
		right: 75%
	}
	
	.col-md-pull-10 {
		right: 83.33333%
	}
	
	.col-md-pull-11 {
		right: 91.66667%
	}
	
	.col-md-pull-12 {
		right: 100%
	}
	
	.col-md-push-0 {
		left: auto
	}
	
	.col-md-push-1 {
		left: 8.33333%
	}
	
	.col-md-push-2 {
		left: 16.66667%
	}
	
	.col-md-push-3 {
		left: 25%
	}
	
	.col-md-push-4 {
		left: 33.33333%
	}
	
	.col-md-push-5 {
		left: 41.66667%
	}
	
	.col-md-push-6 {
		left: 50%
	}
	
	.col-md-push-7 {
		left: 58.33333%
	}
	
	.col-md-push-8 {
		left: 66.66667%
	}
	
	.col-md-push-9 {
		left: 75%
	}
	
	.col-md-push-10 {
		left: 83.33333%
	}
	
	.col-md-push-11 {
		left: 91.66667%
	}
	
	.col-md-push-12 {
		left: 100%
	}
	
	.col-md-offset-0 {
		margin-left: 0
	}
	
	.col-md-offset-1 {
		margin-left: 8.33333%
	}
	
	.col-md-offset-2 {
		margin-left: 16.66667%
	}
	
	.col-md-offset-3 {
		margin-left: 25%
	}
	
	.col-md-offset-4 {
		margin-left: 33.33333%
	}
	
	.col-md-offset-5 {
		margin-left: 41.66667%
	}
	
	.col-md-offset-6 {
		margin-left: 50%
	}
	
	.col-md-offset-7 {
		margin-left: 58.33333%
	}
	
	.col-md-offset-8 {
		margin-left: 66.66667%
	}
	
	.col-md-offset-9 {
		margin-left: 75%
	}
	
	.col-md-offset-10 {
		margin-left: 83.33333%
	}
	
	.col-md-offset-11 {
		margin-left: 91.66667%
	}
	
	.col-md-offset-12 {
		margin-left: 100%
	}
	
	.form-inline .form-group, .navbar-form .form-group {
		display: inline-block;
		margin-bottom: 0;
		vertical-align: middle
	}
	
	.form-inline .form-control, .navbar-form .form-control {
		display: inline-block;
		width: auto;
		vertical-align: middle
	}
	
	.form-inline .input-group, .navbar-form .input-group {
		display: inline-table;
		vertical-align: middle
	}
	
	.form-inline .input-group .form-control, .form-inline .input-group .input-group-addon,
		.form-inline .input-group .input-group-btn, .navbar-form .input-group .form-control,
		.navbar-form .input-group .input-group-addon, .navbar-form .input-group .input-group-btn {
		width: auto
	}
	
	.form-inline .input-group>.form-control, .navbar-form .input-group>.form-control {
		width: 100%
	}
	
	.form-inline .control-label, .navbar-form .control-label {
		margin-bottom: 0;
		vertical-align: middle
	}
	
	.form-inline .checkbox, .form-inline .radio, .navbar-form .checkbox,
		.navbar-form .radio {
		display: inline-block;
		margin-top: 0;
		margin-bottom: 0;
		vertical-align: middle
	}
	
	.form-inline .checkbox label, .form-inline .radio label, .navbar-form .checkbox label,
		.navbar-form .radio label {
		padding-left: 0
	}
	
	.form-inline .checkbox input[type=checkbox], .form-inline .radio input[type=radio],
		.navbar-form .checkbox input[type=checkbox], .navbar-form .radio input[type=radio] {
		position: relative;
		margin-left: 0
	}
	
	.form-inline .has-feedback .form-control-feedback, .navbar-form .has-feedback .form-control-feedback {
		top: 0
	}
	
	.form-horizontal .control-label {
		text-align: right;
		margin-bottom: 0;
		padding-top: 7px
	}
	
	.form-horizontal .form-group-lg .control-label {
		padding-top: 14.3px
	}
	
	.form-horizontal .form-group-sm .control-label {
		padding-top: 6px
	}
	
	.navbar-right .dropdown-menu {
		right: 0;
		left: auto
	}
	
	.navbar-right .dropdown-menu-left {
		left: 0;
		right: auto
	}
	
	.nav-justified>li, .nav-tabs.nav-justified>li {
		display: table-cell;
		width: 1%
	}
	
	.nav-justified>li>a, .nav-tabs.nav-justified>li>a {
		margin-bottom: 0
	}
	
	.nav-tabs-justified>li>a, .nav-tabs.nav-justified>li>a {
		border-bottom: 1px solid #94d7e4;
		border-radius: 3px 3px 0 0
	}
	
	.nav-tabs-justified>.active>a, .nav-tabs-justified>.active>a:focus,
		.nav-tabs-justified>.active>a:hover, .nav-tabs.nav-justified>.active>a,
		.nav-tabs.nav-justified>.active>a:focus, .nav-tabs.nav-justified>.active>a:hover {
		border-bottom-color: #fff
	}
	
	.navbar {
		border-radius: 3px
	}
	
	.navbar-header {
		float: left
	}
	
	.navbar-collapse {
		width: auto;
		border-top: 0;
		-webkit-box-shadow: none;
		box-shadow: none
	}
	
	.navbar-collapse.collapse {
		display: block !important;
		height: auto !important;
		padding-bottom: 0;
		overflow: visible !important
	}
	
	.navbar-collapse.in {
		overflow-y: visible
	}
	
	.navbar-fixed-bottom .navbar-collapse, .navbar-fixed-top .navbar-collapse,
		.navbar-static-top .navbar-collapse {
		padding-left: 0;
		padding-right: 0
	}
	
	.container-fluid>.navbar-collapse, .container-fluid>.navbar-header,
		.container>.navbar-collapse, .container>.navbar-header {
		margin-right: 0;
		margin-left: 0
	}
	
	.navbar-static-top {
		border-radius: 0
	}
	
	.navbar-fixed-bottom, .navbar-fixed-top {
		border-radius: 0
	}
	
	.navbar>.container .navbar-brand, .navbar>.container-fluid .navbar-brand {
		margin-left: -15px
	}
	
	.navbar-toggle {
		display: none
	}
	
	.navbar-nav {
		float: left;
		margin: 0
	}
	
	.navbar-nav>li {
		float: left
	}
	
	.navbar-nav>li>a, .navbar-nav>li>span {
		padding-top: 6px;
		padding-bottom: 6px
	}
	
	.navbar-nav.navbar-right:last-child {
		margin-right: -15px
	}
	
	.navbar-left {
		float: left !important
	}
	
	.navbar-right {
		float: right !important
	}
	
	.navbar-form {
		width: auto;
		border: 0;
		margin-left: 0;
		margin-right: 0;
		padding-top: 0;
		padding-bottom: 0;
		-webkit-box-shadow: none;
		box-shadow: none
	}
	
	.navbar-form.navbar-right:last-child {
		margin-right: -15px
	}
	
	.navbar-text {
		float: left;
		margin-left: 15px;
		margin-right: 15px
	}
	
	.navbar-text.navbar-right:last-child {
		margin-right: 0
	}
	
	.modal-dialog {
		width: 600px;
		margin: 30px auto
	}
	
	.modal-content {
		-webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
		box-shadow: 0 5px 15px rgba(0, 0, 0, .5)
	}
	
	.modal-sm {
		width: 300px
	}
	
	#menu-administrative-responsible {
	    display: block !important;
	}
	
	.container-fluid ul.m-l {
	    margin-left: 0px;
	}
	
	a[accesskey]:after,
	button[accesskey]:after,
	input[accesskey]:after,
	label[accesskey]:after,
	legend[accesskey]:after,
	textarea[accesskey]:after {
	    margin-left: 5px !important;
	}
	
	.container-menu-responsible {
	    margin-left: 0px;
	}
	
	a.open-menu-administrative-responsible-not-fix {
	    display: block !important;
	}
	
	.navbar-header span.navbar-brand {
	    display: none;
	}
}
	
@media screen and (min-width: 768px) {
	.jumbotron {
		padding-top: 48px;
		padding-bottom: 48px
	}
	
	.container .jumbotron {
		padding-right: 60px;
		padding-left: 60px
	}
	
	.jumbotron .h1, .jumbotron h1 {
		font-size: 63px
	}
	
	.carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right,
		.carousel-control .icon-next, .carousel-control .icon-prev {
		width: 30px;
		height: 30px;
		margin-top: -15px;
		font-size: 30px
	}
	
	.carousel-control .glyphicon-chevron-left, .carousel-control .icon-prev {
		margin-left: -15px
	}
	
	.carousel-control .glyphicon-chevron-right, .carousel-control .icon-next {
		margin-right: -15px
	}
	
	.carousel-caption {
		right: 20%;
		left: 20%;
		padding-bottom: 30px
	}
	
	.carousel-indicators {
		bottom: 20px
	}
}

@media screen and (min-width: 768px) and (max-width: 991px) {
	.visible-sm {
		display: block !important
	}
	
	table.visible-sm {
		display: table
	}
	
	tr.visible-sm {
		display: table-row !important
	}
	
	td.visible-sm, th.visible-sm {
		display: table-cell !important
	}
	
	.visible-sm-block {
		display: block !important
	}
	
	.visible-sm-inline {
		display: inline !important
	}
	
	.visible-sm-inline-block {
		display: inline-block !important
	}
	
	.hidden-sm {
		display: none !important
	}
}

@media screen and (min-width: 992px) {
	.container {
		width: 970px
	}
	
	.modal-lg {
		width: 900px
	}
}

@media screen and (min-width: 992px) and (max-width: 1199px) {
	.visible-md {
		display: block !important
	}
	
	table.visible-md {
		display: table
	}
	
	tr.visible-md {
		display: table-row !important
	}
	
	td.visible-md, th.visible-md {
		display: table-cell !important
	}
	
	.visible-md-block {
		display: block !important
	}
	
	.visible-md-inline {
		display: inline !important
	}
	
	.visible-md-inline-block {
		display: inline-block !important
	}
	
	.hidden-md {
		display: none !important
	}
}

@media screen and (min-width: 1200px) {
	.container {
		width: 1170px
	}
	
	.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3,
		.col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9 {
		float: left
	}
	
	.col-lg-1 {
		width: 8.33333%
	}
	
	.col-lg-2 {
		width: 16.66667%
	}
	
	.col-lg-3 {
		width: 25%
	}
	
	.col-lg-4 {
		width: 33.33333%
	}
	
	.col-lg-5 {
		width: 41.66667%
	}
	
	.col-lg-6 {
		width: 50%
	}
	
	.col-lg-7 {
		width: 58.33333%
	}
	
	.col-lg-8 {
		width: 66.66667%
	}
	
	.col-lg-9 {
		width: 75%
	}
	
	.col-lg-10 {
		width: 83.33333%
	}
	
	.col-lg-11 {
		width: 91.66667%
	}
	
	.col-lg-12 {
		width: 100%
	}
	
	.col-lg-pull-0 {
		right: auto
	}
	
	.col-lg-pull-1 {
		right: 8.33333%
	}
	
	.col-lg-pull-2 {
		right: 16.66667%
	}
	
	.col-lg-pull-3 {
		right: 25%
	}
	
	.col-lg-pull-4 {
		right: 33.33333%
	}
	
	.col-lg-pull-5 {
		right: 41.66667%
	}
	
	.col-lg-pull-6 {
		right: 50%
	}
	
	.col-lg-pull-7 {
		right: 58.33333%
	}
	
	.col-lg-pull-8 {
		right: 66.66667%
	}
	
	.col-lg-pull-9 {
		right: 75%
	}
	
	.col-lg-pull-10 {
		right: 83.33333%
	}
	
	.col-lg-pull-11 {
		right: 91.66667%
	}
	
	.col-lg-pull-12 {
		right: 100%
	}
	
	.col-lg-push-0 {
		left: auto
	}
	
	.col-lg-push-1 {
		left: 8.33333%
	}
	
	.col-lg-push-2 {
		left: 16.66667%
	}
	
	.col-lg-push-3 {
		left: 25%
	}
	
	.col-lg-push-4 {
		left: 33.33333%
	}
	
	.col-lg-push-5 {
		left: 41.66667%
	}
	
	.col-lg-push-6 {
		left: 50%
	}
	
	.col-lg-push-7 {
		left: 58.33333%
	}
	
	.col-lg-push-8 {
		left: 66.66667%
	}
	
	.col-lg-push-9 {
		left: 75%
	}
	
	.col-lg-push-10 {
		left: 83.33333%
	}
	
	.col-lg-push-11 {
		left: 91.66667%
	}
	
	.col-lg-push-12 {
		left: 100%
	}
	
	.col-lg-offset-0 {
		margin-left: 0
	}
	
	.col-lg-offset-1 {
		margin-left: 8.33333%
	}
	
	.col-lg-offset-2 {
		margin-left: 16.66667%
	}
	
	.col-lg-offset-3 {
		margin-left: 25%
	}
	
	.col-lg-offset-4 {
		margin-left: 33.33333%
	}
	
	.col-lg-offset-5 {
		margin-left: 41.66667%
	}
	
	.col-lg-offset-6 {
		margin-left: 50%
	}
	
	.col-lg-offset-7 {
		margin-left: 58.33333%
	}
	
	.col-lg-offset-8 {
		margin-left: 66.66667%
	}
	
	.col-lg-offset-9 {
		margin-left: 75%
	}
	
	.col-lg-offset-10 {
		margin-left: 83.33333%
	}
	
	.col-lg-offset-11 {
		margin-left: 91.66667%
	}
	
	.col-lg-offset-12 {
		margin-left: 100%
	}
	
	.visible-lg {
		display: block !important
	}
	
	table.visible-lg {
		display: table
	}
	
	tr.visible-lg {
		display: table-row !important
	}
	
	td.visible-lg, th.visible-lg {
		display: table-cell !important
	}
	
	.visible-lg-block {
		display: block !important
	}
	
	.visible-lg-inline {
		display: inline !important
	}
	
	.visible-lg-inline-block {
		display: inline-block !important
	}
	
	.hidden-lg {
		display: none !important
	}
}