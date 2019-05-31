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
@charset "UTF-8";

@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 300;
  src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v13/DXI1ORHCpsQm3Vp6mXoaTegdm0LZdjqr5-oayXSOefg.woff2) format('woff2');
}

@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 400;
  src: local('Open Sans'), local('OpenSans'), url(https://fonts.gstatic.com/s/opensans/v13/cJZKeOuBrn4kERxqtaUH3VtXRa8TVwTICgirnJhmVJw.woff2) format('woff2');
}

@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 600;
  src: local('Open Sans Semibold'), local('OpenSans-Semibold'), url(https://fonts.gstatic.com/s/opensans/v13/MTP_ySUJH_bn48VBG8sNSugdm0LZdjqr5-oayXSOefg.woff2) format('woff2');
}

@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 700;
  src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v13/k3k702ZOKiLJc3WVjuplzOgdm0LZdjqr5-oayXSOefg.woff2) format('woff2');
}

@font-face {
  font-family: 'Open Sans';
  font-style: italic;
  font-weight: 400;
  src: local('Open Sans Italic'), local('OpenSans-Italic'), url(https://fonts.gstatic.com/s/opensans/v13/xjAJXh38I15wypJXxuGMBo4P5ICox8Kq3LLUNMylGO4.woff2) format('woff2');
}

@font-face {
	font-family: 'Glyphicons Halflings';
	src: url(../fonts/glyphicons-halflings-regular.eot);
	src: url(../fonts/glyphicons-halflings-regular.eot?#iefix)
		format('embedded-opentype'),
		url(../fonts/glyphicons-halflings-regular.woff) format('woff'),
		url(../fonts/glyphicons-halflings-regular.ttf) format('truetype'),
		url(../fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular)
		format('svg')
}

@media screen {
	*, :after, :before {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box
	}
	
	html {
		font-size: 10px;
		-webkit-tap-highlight-color: transparent;
		font-family: sans-serif;
		-webkit-text-size-adjust: 100%;
		-ms-text-size-adjust: 100%
	}
	
	body {
		font-family: "Open Sans", Helvetica, Arial, sans-serif;
		font-size: 13px;
		line-height: 1.42857;
		color: #333;
		background-color: #fff;
		margin: 0
	}
	
	a {
		color: #0e377d;
		text-decoration: none;
		background: 0 0
	}
	
	a:focus, a:hover {
		color: #061938;
		text-decoration: underline
	}
	
	a:focus {
		outline: dotted thin;
		outline: -webkit-focus-ring-color auto 5px;
		outline-offset: -2px
	}
	
	a:active, a:hover {
		outline: 0
	}
	
	figure {
		margin: 0
	}
	
	img {
		vertical-align: middle;
		border: 0
	}
	
	svg:not(:root) {
		overflow: hidden
	}
	
	article, aside, details, figcaption, figure, footer, header, hgroup,
		main, nav, section, summary {
		display: block
	}
	
	audio, canvas, progress, video {
		display: inline-block;
		vertical-align: baseline
	}
	
	audio:not([controls]) {
		display: none;
		height: 0
	}
	
	[hidden], template {
		display: none
	}
	
	b, strong {
		font-weight: 700
	}
	
	dfn {
		font-style: italic
	}
	
	h1 {
		margin: .67em 0
	}
	
	mark {
		color: #000;
		background: #ff0
	}
	
	sub, sup {
		position: relative;
		font-size: 75%;
		line-height: 0;
		vertical-align: baseline
	}
	
	sup {
		top: -.5em
	}
	
	sub {
		bottom: -.25em
	}
	
	hr {
		height: 0;
		-webkit-box-sizing: content-box;
		-moz-box-sizing: content-box;
		box-sizing: content-box
		margin-top: 20px;
		margin-bottom: 20px;
		border: 0;
		border-top: 1px solid #eee
	}
	
	pre {
		overflow: auto
	}
	
	code, kbd, pre, samp {
		font-size: 1em
	}
	
	button, input, select, textarea {
		font-family: inherit;
		font-size: inherit;
		line-height: inherit
	}
	
	button, input, optgroup, select, textarea {
		margin: 0;
		font: inherit;
		color: inherit
	}
	
	button {
		overflow: visible
	}
	
	button, select {
		text-transform: none
	}
	
	button, html input[type=button], input[type=reset], input[type=submit] {
		-webkit-appearance: button;
		cursor: pointer
	}
	
	button[disabled], html input[disabled] {
		cursor: default
	}
	
	button:-moz-focus-inner, input:-moz-focus-inner {
		padding: 0;
		border: 0
	}
	
	input[type=checkbox], input[type=radio] {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		padding: 0
	}
	
	input[type=number]:-webkit-inner-spin-button, input[type=number]:-webkit-outer-spin-button {
		height: auto
	}
	
	input[type=search]:-webkit-search-cancel-button, input[type=search]:-webkit-search-decoration {
		-webkit-appearance: none
	}
	
	textarea {
		overflow: auto;
		resize: vertical
	}
	
	optgroup {
		font-weight: 700
	}
	
	table {
		border-spacing: 0;
		border-collapse: collapse
	}
	
	td, th {
		padding: 0
	}
	
	.img-responsive {
		display: block;
		max-width: 100%;
		height: auto
	}
	
	.img-rounded {
		border-radius: 4px
	}
	
	.img-thumbnail {
		padding: 4px;
		line-height: 1.42857143;
		background-color: #fff;
		border: 1px solid #ddd;
		border-radius: 4px;
		-webkit-transition: all .2s ease-in-out;
		transition: all .2s ease-in-out;
		display: inline-block;
		max-width: 100%;
		height: auto
	}
	
	.img-circle {
		border-radius: 50%
	}
	
	.carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive,
		.thumbnail a>img, .thumbnail>img {
		display: block;
		max-width: 100%;
		height: auto
	}
	
	.glyphicon {
		position: relative;
		top: 1px;
		display: inline-block;
		font-family: 'Glyphicons Halflings';
		font-style: normal;
		font-weight: 400;
		line-height: 1;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale
	}
	
	.glyphicon-asterisk:before {
		content: "\2a"
	}
	
	.glyphicon-plus:before {
		content: "\2b"
	}
	
	.glyphicon-euro:before {
		content: "\20ac"
	}
	
	.glyphicon-minus:before {
		content: "\2212"
	}
	
	.glyphicon-cloud:before {
		content: "\2601"
	}
	
	.glyphicon-envelope:before {
		content: "\2709"
	}
	
	.glyphicon-pencil:before {
		content: "\270f"
	}
	
	.glyphicon-glass:before {
		content: "\e001"
	}
	
	.glyphicon-music:before {
		content: "\e002"
	}
	
	.glyphicon-search:before {
		content: "\e003"
	}
	
	.glyphicon-heart:before {
		content: "\e005"
	}
	
	.glyphicon-star:before {
		content: "\e006"
	}
	
	.glyphicon-star-empty:before {
		content: "\e007"
	}
	
	.glyphicon-user:before {
		content: "\e008"
	}
	
	.glyphicon-film:before {
		content: "\e009"
	}
	
	.glyphicon-th-large:before {
		content: "\e010"
	}
	
	.glyphicon-th:before {
		content: "\e011"
	}
	
	.glyphicon-th-list:before {
		content: "\e012"
	}
	
	.glyphicon-ok:before {
		content: "\e013"
	}
	
	.glyphicon-remove:before {
		content: "\e014"
	}
	
	.glyphicon-zoom-in:before {
		content: "\e015"
	}
	
	.glyphicon-zoom-out:before {
		content: "\e016"
	}
	
	.glyphicon-off:before {
		content: "\e017"
	}
	
	.glyphicon-signal:before {
		content: "\e018"
	}
	
	.glyphicon-cog:before {
		content: "\e019"
	}
	
	.glyphicon-trash:before {
		content: "\e020"
	}
	
	.glyphicon-home:before {
		content: "\e021"
	}
	
	.glyphicon-file:before {
		content: "\e022"
	}
	
	.glyphicon-time:before {
		content: "\e023"
	}
	
	.glyphicon-road:before {
		content: "\e024"
	}
	
	.glyphicon-download-alt:before {
		content: "\e025"
	}
	
	.glyphicon-download:before {
		content: "\e026"
	}
	
	.glyphicon-upload:before {
		content: "\e027"
	}
	
	.glyphicon-inbox:before {
		content: "\e028"
	}
	
	.glyphicon-play-circle:before {
		content: "\e029"
	}
	
	.glyphicon-repeat:before {
		content: "\e030"
	}
	
	.glyphicon-refresh:before {
		content: "\e031"
	}
	
	.glyphicon-list-alt:before {
		content: "\e032"
	}
	
	.glyphicon-lock:before {
		content: "\e033"
	}
	
	.glyphicon-flag:before {
		content: "\e034"
	}
	
	.glyphicon-headphones:before {
		content: "\e035"
	}
	
	.glyphicon-volume-off:before {
		content: "\e036"
	}
	
	.glyphicon-volume-down:before {
		content: "\e037"
	}
	
	.glyphicon-volume-up:before {
		content: "\e038"
	}
	
	.glyphicon-qrcode:before {
		content: "\e039"
	}
	
	.glyphicon-barcode:before {
		content: "\e040"
	}
	
	.glyphicon-tag:before {
		content: "\e041"
	}
	
	.glyphicon-tags:before {
		content: "\e042"
	}
	
	.glyphicon-book:before {
		content: "\e043"
	}
	
	.glyphicon-bookmark:before {
		content: "\e044"
	}
	
	.glyphicon-print:before {
		content: "\e045"
	}
	
	.glyphicon-camera:before {
		content: "\e046"
	}
	
	.glyphicon-font:before {
		content: "\e047"
	}
	
	.glyphicon-bold:before {
		content: "\e048"
	}
	
	.glyphicon-italic:before {
		content: "\e049"
	}
	
	.glyphicon-text-height:before {
		content: "\e050"
	}
	
	.glyphicon-text-width:before {
		content: "\e051"
	}
	
	.glyphicon-align-left:before {
		content: "\e052"
	}
	
	.glyphicon-align-center:before {
		content: "\e053"
	}
	
	.glyphicon-align-right:before {
		content: "\e054"
	}
	
	.glyphicon-align-justify:before {
		content: "\e055"
	}
	
	.glyphicon-list:before {
		content: "\e056"
	}
	
	.glyphicon-indent-left:before {
		content: "\e057"
	}
	
	.glyphicon-indent-right:before {
		content: "\e058"
	}
	
	.glyphicon-facetime-video:before {
		content: "\e059"
	}
	
	.glyphicon-picture:before {
		content: "\e060"
	}
	
	.glyphicon-map-marker:before {
		content: "\e062"
	}
	
	.glyphicon-adjust:before {
		content: "\e063"
	}
	
	.glyphicon-tint:before {
		content: "\e064"
	}
	
	.glyphicon-edit:before {
		content: "\e065"
	}
	
	.glyphicon-share:before {
		content: "\e066"
	}
	
	.glyphicon-check:before {
		content: "\e067"
	}
	
	.glyphicon-move:before {
		content: "\e068"
	}
	
	.glyphicon-step-backward:before {
		content: "\e069"
	}
	
	.glyphicon-fast-backward:before {
		content: "\e070"
	}
	
	.glyphicon-backward:before {
		content: "\e071"
	}
	
	.glyphicon-play:before {
		content: "\e072"
	}
	
	.glyphicon-pause:before {
		content: "\e073"
	}
	
	.glyphicon-stop:before {
		content: "\e074"
	}
	
	.glyphicon-forward:before {
		content: "\e075"
	}
	
	.glyphicon-fast-forward:before {
		content: "\e076"
	}
	
	.glyphicon-step-forward:before {
		content: "\e077"
	}
	
	.glyphicon-eject:before {
		content: "\e078"
	}
	
	.glyphicon-chevron-left:before {
		content: "\e079"
	}
	
	.glyphicon-chevron-right:before {
		content: "\e080"
	}
	
	.glyphicon-plus-sign:before {
		content: "\e081"
	}
	
	.glyphicon-minus-sign:before {
		content: "\e082"
	}
	
	.glyphicon-remove-sign:before {
		content: "\e083"
	}
	
	.glyphicon-ok-sign:before {
		content: "\e084"
	}
	
	.glyphicon-question-sign:before {
		content: "\e085"
	}
	
	.glyphicon-info-sign:before {
		content: "\e086"
	}
	
	.glyphicon-screenshot:before {
		content: "\e087"
	}
	
	.glyphicon-remove-circle:before {
		content: "\e088"
	}
	
	.glyphicon-ok-circle:before {
		content: "\e089"
	}
	
	.glyphicon-ban-circle:before {
		content: "\e090"
	}
	
	.glyphicon-arrow-left:before {
		content: "\e091"
	}
	
	.glyphicon-arrow-right:before {
		content: "\e092"
	}
	
	.glyphicon-arrow-up:before {
		content: "\e093"
	}
	
	.glyphicon-arrow-down:before {
		content: "\e094"
	}
	
	.glyphicon-share-alt:before {
		content: "\e095"
	}
	
	.glyphicon-resize-full:before {
		content: "\e096"
	}
	
	.glyphicon-resize-small:before {
		content: "\e097"
	}
	
	.glyphicon-exclamation-sign:before {
		content: "\e101"
	}
	
	.glyphicon-gift:before {
		content: "\e102"
	}
	
	.glyphicon-leaf:before {
		content: "\e103"
	}
	
	.glyphicon-fire:before {
		content: "\e104"
	}
	
	.glyphicon-eye-open:before {
		content: "\e105"
	}
	
	.glyphicon-eye-close:before {
		content: "\e106"
	}
	
	.glyphicon-warning-sign:before {
		content: "\e107"
	}
	
	.glyphicon-plane:before {
		content: "\e108"
	}
	
	.glyphicon-calendar:before {
		content: "\e109"
	}
	
	.glyphicon-random:before {
		content: "\e110"
	}
	
	.glyphicon-comment:before {
		content: "\e111"
	}
	
	.glyphicon-magnet:before {
		content: "\e112"
	}
	
	.glyphicon-chevron-up:before {
		content: "\e113"
	}
	
	.glyphicon-chevron-down:before {
		content: "\e114"
	}
	
	.glyphicon-retweet:before {
		content: "\e115"
	}
	
	.glyphicon-shopping-cart:before {
		content: "\e116"
	}
	
	.glyphicon-folder-close:before {
		content: "\e117"
	}
	
	.glyphicon-folder-open:before {
		content: "\e118"
	}
	
	.glyphicon-resize-vertical:before {
		content: "\e119"
	}
	
	.glyphicon-resize-horizontal:before {
		content: "\e120"
	}
	
	.glyphicon-hdd:before {
		content: "\e121"
	}
	
	.glyphicon-bullhorn:before {
		content: "\e122"
	}
	
	.glyphicon-bell:before {
		content: "\e123"
	}
	
	.glyphicon-certificate:before {
		content: "\e124"
	}
	
	.glyphicon-thumbs-up:before {
		content: "\e125"
	}
	
	.glyphicon-thumbs-down:before {
		content: "\e126"
	}
	
	.glyphicon-hand-right:before {
		content: "\e127"
	}
	
	.glyphicon-hand-left:before {
		content: "\e128"
	}
	
	.glyphicon-hand-up:before {
		content: "\e129"
	}
	
	.glyphicon-hand-down:before {
		content: "\e130"
	}
	
	.glyphicon-circle-arrow-right:before {
		content: "\e131"
	}
	
	.glyphicon-circle-arrow-left:before {
		content: "\e132"
	}
	
	.glyphicon-circle-arrow-up:before {
		content: "\e133"
	}
	
	.glyphicon-circle-arrow-down:before {
		content: "\e134"
	}
	
	.glyphicon-globe:before {
		content: "\e135"
	}
	
	.glyphicon-wrench:before {
		content: "\e136"
	}
	
	.glyphicon-tasks:before {
		content: "\e137"
	}
	
	.glyphicon-filter:before {
		content: "\e138"
	}
	
	.glyphicon-briefcase:before {
		content: "\e139"
	}
	
	.glyphicon-fullscreen:before {
		content: "\e140"
	}
	
	.glyphicon-dashboard:before {
		content: "\e141"
	}
	
	.glyphicon-paperclip:before {
		content: "\e142"
	}
	
	.glyphicon-heart-empty:before {
		content: "\e143"
	}
	
	.glyphicon-link:before {
		content: "\e144"
	}
	
	.glyphicon-phone:before {
		content: "\e145"
	}
	
	.glyphicon-pushpin:before {
		content: "\e146"
	}
	
	.glyphicon-usd:before {
		content: "\e148"
	}
	
	.glyphicon-gbp:before {
		content: "\e149"
	}
	
	.glyphicon-sort:before {
		content: "\e150"
	}
	
	.glyphicon-sort-by-alphabet:before {
		content: "\e151"
	}
	
	.glyphicon-sort-by-alphabet-alt:before {
		content: "\e152"
	}
	
	.glyphicon-sort-by-order:before {
		content: "\e153"
	}
	
	.glyphicon-sort-by-order-alt:before {
		content: "\e154"
	}
	
	.glyphicon-sort-by-attributes:before {
		content: "\e155"
	}
	
	.glyphicon-sort-by-attributes-alt:before {
		content: "\e156"
	}
	
	.glyphicon-unchecked:before {
		content: "\e157"
	}
	
	.glyphicon-expand:before {
		content: "\e158"
	}
	
	.glyphicon-collapse-down:before {
		content: "\e159"
	}
	
	.glyphicon-collapse-up:before {
		content: "\e160"
	}
	
	.glyphicon-log-in:before {
		content: "\e161"
	}
	
	.glyphicon-flash:before {
		content: "\e162"
	}
	
	.glyphicon-log-out:before {
		content: "\e163"
	}
	
	.glyphicon-new-window:before {
		content: "\e164"
	}
	
	.glyphicon-record:before {
		content: "\e165"
	}
	
	.glyphicon-save:before {
		content: "\e166"
	}
	
	.glyphicon-open:before {
		content: "\e167"
	}
	
	.glyphicon-saved:before {
		content: "\e168"
	}
	
	.glyphicon-import:before {
		content: "\e169"
	}
	
	.glyphicon-export:before {
		content: "\e170"
	}
	
	.glyphicon-send:before {
		content: "\e171"
	}
	
	.glyphicon-floppy-disk:before {
		content: "\e172"
	}
	
	.glyphicon-floppy-saved:before {
		content: "\e173"
	}
	
	.glyphicon-floppy-remove:before {
		content: "\e174"
	}
	
	.glyphicon-floppy-save:before {
		content: "\e175"
	}
	
	.glyphicon-floppy-open:before {
		content: "\e176"
	}
	
	.glyphicon-credit-card:before {
		content: "\e177"
	}
	
	.glyphicon-transfer:before {
		content: "\e178"
	}
	
	.glyphicon-cutlery:before {
		content: "\e179"
	}
	
	.glyphicon-header:before {
		content: "\e180"
	}
	
	.glyphicon-compressed:before {
		content: "\e181"
	}
	
	.glyphicon-earphone:before {
		content: "\e182"
	}
	
	.glyphicon-phone-alt:before {
		content: "\e183"
	}
	
	.glyphicon-tower:before {
		content: "\e184"
	}
	
	.glyphicon-stats:before {
		content: "\e185"
	}
	
	.glyphicon-sd-video:before {
		content: "\e186"
	}
	
	.glyphicon-hd-video:before {
		content: "\e187"
	}
	
	.glyphicon-subtitles:before {
		content: "\e188"
	}
	
	.glyphicon-sound-stereo:before {
		content: "\e189"
	}
	
	.glyphicon-sound-dolby:before {
		content: "\e190"
	}
	
	.glyphicon-sound-5-1:before {
		content: "\e191"
	}
	
	.glyphicon-sound-6-1:before {
		content: "\e192"
	}
	
	.glyphicon-sound-7-1:before {
		content: "\e193"
	}
	
	.glyphicon-copyright-mark:before {
		content: "\e194"
	}
	
	.glyphicon-registration-mark:before {
		content: "\e195"
	}
	
	.glyphicon-cloud-download:before {
		content: "\e197"
	}
	
	.glyphicon-cloud-upload:before {
		content: "\e198"
	}
	
	.glyphicon-tree-conifer:before {
		content: "\e199"
	}
	
	.glyphicon-tree-deciduous:before {
		content: "\e200"
	}
	
	.sr-only {
		position: absolute;
		width: 1px;
		height: 1px;
		margin: -1px;
		padding: 0;
		overflow: hidden;
		clip: rect(0, 0, 0, 0);
		border: 0
	}
	
	.sr-only-focusable:active, .sr-only-focusable:focus {
		position: static;
		width: auto;
		height: auto;
		margin: 0;
		overflow: visible;
		clip: auto
	}
	
	.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
		font-family: inherit;
		font-weight: 700;
		line-height: 1.1;
		color: #0e377d
	}
	
	.h1 .small, .h1 small, .h2 .small, .h2 small, .h3 .small, .h3 small, .h4 .small,
		.h4 small, .h5 .small, .h5 small, .h6 .small, .h6 small, h1 .small, h1 small,
		h2 .small, h2 small, h3 .small, h3 small, h4 .small, h4 small, h5 .small,
		h5 small, h6 .small, h6 small {
		font-weight: 400;
		line-height: 1;
		color: #777
	}
	
	.h1, .h2, .h3, h1, h2, h3 {
		margin-top: 9px;
		margin-bottom: 18px
	}
	
	.h1 .small, .h1 small, .h2 .small, .h2 small, .h3 .small, .h3 small, h1 .small,
		h1 small, h2 .small, h2 small, h3 .small, h3 small {
		font-size: 65%
	}
	
	.h4, .h5, .h6, h4, h5, h6 {
		margin-bottom: 9px;
		margin-bottom: 10px
	}
	
	.h4 .small, .h4 small, .h5 .small, .h5 small, .h6 .small, .h6 small, h4 .small,
		h4 small, h5 .small, h5 small, h6 .small, h6 small {
		font-size: 75%
	}
	
	.h1, h1 {
		font-size: 33px
	}
	
	.h2, h2 {
		font-size: 27px
	}
	
	.h3, h3 {
		font-size: 23px
	}
	
	.h4, h4 {
		font-size: 17px
	}
	
	.h5, h5 {
		font-size: 13px
	}
	
	.h6, h6 {
		font-size: 12px
	}
	
	p {
		margin: 0 0 9px
	}
	
	.lead {
		margin-bottom: 18px;
		font-size: 14px;
		font-weight: 300;
		line-height: 1.4
	}
	
	.small, small {
		font-size: 92%
	}
	
	cite {
		font-style: normal
	}
	
	.mark, mark {
		background-color: #fcf8e3;
		padding: .2em
	}
	
	.text-left {
		text-align: left
	}
	
	.text-right {
		text-align: right
	}
	
	.text-center {
		text-align: center
	}
	
	.text-justify {
		text-align: justify
	}
	
	.text-nowrap {
		white-space: nowrap
	}
	
	.text-lowercase {
		text-transform: lowercase
	}
	
	.text-uppercase {
		text-transform: uppercase
	}
	
	.text-capitalize {
		text-transform: capitalize
	}
	
	.text-muted {
		color: #555
	}
	
	.text-primary {
		color: #0e377d
	}
	
	a.text-primary:hover {
		color: #09234f
	}
	
	.text-success {
		color: #5cb85c
	}
	
	a.text-success:hover {
		color: #449d44
	}
	
	.text-info {
		color: #94d7e4
	}
	
	a.text-info:hover {
		color: #6bc8da
	}
	
	.text-warning {
		color: #f0ad4e
	}
	
	a.text-warning:hover {
		color: #ec971f
	}
	
	.text-danger {
		color: #a62c00
	}
	
	a.text-danger:hover {
		color: #731e00
	}
	
	.text-dark {
		color: #333
	}
	
	a.text-dark:hover {
		color: #1a1a1a
	}
	
	.text-white {
		color: #fff
	}
	
	a.text-white:hover {
		color: #e6e6e6
	}
	
	.bg-primary {
		color: #fff;
		background-color: #0e377d
	}
	
	a.bg-primary:hover {
		background-color: #09234f
	}
	
	.bg-success {
		background-color: #5cb85c
	}
	
	a.bg-success:hover {
		background-color: #449d44
	}
	
	.bg-info {
		background-color: #94d7e4
	}
	
	a.bg-info:hover {
		background-color: #6bc8da
	}
	
	.bg-warning {
		background-color: #f0ad4e
	}
	
	a.bg-warning:hover {
		background-color: #ec971f
	}
	
	.bg-danger {
		background-color: #a62c00
	}
	
	a.bg-danger:hover {
		background-color: #731e00
	}
	
	.bg-light {
		background-color: #f5f5f5
	}
	
	a.bg-light:hover {
		background-color: #dcdcdc
	}
	
	.bg-white {
		background-color: #fff
	}
	
	a.bg-white:hover {
		background-color: #e6e6e6
	}
	
	.page-header {
		margin-bottom: 18px;
		border-bottom: 1px solid #eee
	}
	
	.page-header h1, .page-header h2, .page-header h3 {
		margin-top: 0;
		margin-bottom: 10px
	}
	
	ol, ul {
		margin-top: 0;
		margin-bottom: 9px
	}
	
	ol ol, ol ul, ul ol, ul ul {
		margin-bottom: 0
	}
	
	.list-inline, .list-unstyled {
		padding-left: 0;
		list-style: none
	}
	
	.list-inline {
		margin-left: -5px
	}
	
	.list-inline>li {
		display: inline-block;
		padding-left: 5px;
		padding-right: 5px
	}
	
	dl {
		margin-top: 0;
		margin-bottom: 18px
	}
	
	dd, dt {
		line-height: 1.42857
	}
	
	dt {
		font-weight: 700
	}
	
	dd {
		margin-left: 0
	}
	
	.dl-horizontal dd:after, .dl-horizontal dd:before {
		content: " ";
		display: table
	}
	
	.dl-horizontal dd:after {
		clear: both
	}
	
	abbr[data-original-title], abbr[title] {
		cursor: help;
		border-bottom: 1px dotted #777
	}
	
	.initialism {
		font-size: 90%;
		text-transform: uppercase
	}
	
	blockquote {
		padding: 9px 18px;
		margin: 0 0 18px;
		font-size: 16.25px;
		border-left: 5px solid #eee
	}
	
	blockquote ol:last-child, blockquote p:last-child, blockquote ul:last-child {
		margin-bottom: 0
	}
	
	blockquote .small, blockquote footer, blockquote small {
		display: block;
		font-size: 80%;
		line-height: 1.42857;
		color: #777
	}
	
	blockquote .small:before, blockquote footer:before, blockquote small:before {
		content: '\2014 \00A0'
	}
	
	.blockquote-reverse, blockquote.pull-right {
		padding-right: 15px;
		padding-left: 0;
		border-right: 5px solid #eee;
		border-left: 0;
		text-align: right
	}
	
	.blockquote-reverse .small:before, .blockquote-reverse footer:before,
		.blockquote-reverse small:before, blockquote.pull-right .small:before,
		blockquote.pull-right footer:before, blockquote.pull-right small:before {
		content: ''
	}
	
	.blockquote-reverse .small:after, .blockquote-reverse footer:after,
		.blockquote-reverse small:after, blockquote.pull-right .small:after,
		blockquote.pull-right footer:after, blockquote.pull-right small:after {
		content: '\00A0 \2014'
	}
	
	blockquote:after, blockquote:before {
		content: ""
	}
	
	address {
		margin-bottom: 18px;
		font-style: normal;
		line-height: 1.42857
	}
	
	code, kbd, pre, samp {
		font-family: Menlo, Monaco, Consolas, "Courier New", monospace
	}
	
	code {
		padding: 2px 4px;
		font-size: 90%;
		color: #c7254e;
		background-color: #f9f2f4;
		border-radius: 3px
	}
	
	kbd {
		padding: 2px 4px;
		font-size: 90%;
		color: #fff;
		background-color: #333;
		border-radius: 2px;
		-webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .25);
		box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .25)
	}
	
	kbd kbd {
		padding: 0;
		font-size: 100%;
		-webkit-box-shadow: none;
		box-shadow: none
	}
	
	pre {
		display: block;
		padding: 8.5px;
		margin: 0 0 9px;
		font-size: 12px;
		line-height: 1.42857;
		word-break: break-all;
		word-wrap: break-word;
		color: #333;
		background-color: #f5f5f5;
		border: 1px solid #ccc;
		border-radius: 3px
	}
	
	pre code {
		padding: 0;
		font-size: inherit;
		color: inherit;
		white-space: pre-wrap;
		background-color: transparent;
		border-radius: 0
	}
	
	.pre-scrollable {
		max-height: 340px;
		overflow-y: scroll
	}
	
	.container {
		margin-right: auto;
		margin-left: auto;
		padding-left: 15px;
		padding-right: 15px
	}
	
	.container:after, .container:before {
		content: " ";
		display: table
	}
	
	.container:after {
		clear: both
	}
	
	.container-fluid {
		margin-right: auto;
		margin-left: auto;
		padding-left: 15px;
		padding-right: 15px
	}
	
	.container-fluid:after, .container-fluid:before {
		content: " ";
		display: table
	}
	
	.container-fluid:after {
		clear: both
	}
	
	.row {
		margin-left: -15px;
		margin-right: -15px
	}
	
	.row:after, .row:before {
		content: " ";
		display: table
	}
	
	.row:after {
		clear: both
	}
	
	.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3,
		.col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9,
		.col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3,
		.col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9,
		.col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3,
		.col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9,
		.col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3,
		.col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
		position: relative;
		min-height: 1px;
		padding-left: 15px;
		padding-right: 15px
	}
	
	.col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3,
		.col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
		float: left
	}
	
	.col-xs-1 {
		width: 8.33333%
	}
	
	.col-xs-2 {
		width: 16.66667%
	}
	
	.col-xs-3 {
		width: 25%
	}
	
	.col-xs-4 {
		width: 33.33333%
	}
	
	.col-xs-5 {
		width: 41.66667%
	}
	
	.col-xs-6 {
		width: 50%
	}
	
	.col-xs-7 {
		width: 58.33333%
	}
	
	.col-xs-8 {
		width: 66.66667%
	}
	
	.col-xs-9 {
		width: 75%
	}
	
	.col-xs-10 {
		width: 83.33333%
	}
	
	.col-xs-11 {
		width: 91.66667%
	}
	
	.col-xs-12 {
		width: 100%
	}
	
	.col-xs-pull-0 {
		right: auto
	}
	
	.col-xs-pull-1 {
		right: 8.33333%
	}
	
	.col-xs-pull-2 {
		right: 16.66667%
	}
	
	.col-xs-pull-3 {
		right: 25%
	}
	
	.col-xs-pull-4 {
		right: 33.33333%
	}
	
	.col-xs-pull-5 {
		right: 41.66667%
	}
	
	.col-xs-pull-6 {
		right: 50%
	}
	
	.col-xs-pull-7 {
		right: 58.33333%
	}
	
	.col-xs-pull-8 {
		right: 66.66667%
	}
	
	.col-xs-pull-9 {
		right: 75%
	}
	
	.col-xs-pull-10 {
		right: 83.33333%
	}
	
	.col-xs-pull-11 {
		right: 91.66667%
	}
	
	.col-xs-pull-12 {
		right: 100%
	}
	
	.col-xs-push-0 {
		left: auto
	}
	
	.col-xs-push-1 {
		left: 8.33333%
	}
	
	.col-xs-push-2 {
		left: 16.66667%
	}
	
	.col-xs-push-3 {
		left: 25%
	}
	
	.col-xs-push-4 {
		left: 33.33333%
	}
	
	.col-xs-push-5 {
		left: 41.66667%
	}
	
	.col-xs-push-6 {
		left: 50%
	}
	
	.col-xs-push-7 {
		left: 58.33333%
	}
	
	.col-xs-push-8 {
		left: 66.66667%
	}
	
	.col-xs-push-9 {
		left: 75%
	}
	
	.col-xs-push-10 {
		left: 83.33333%
	}
	
	.col-xs-push-11 {
		left: 91.66667%
	}
	
	.col-xs-push-12 {
		left: 100%
	}
	
	.col-xs-offset-0 {
		margin-left: 0
	}
	
	.col-xs-offset-1 {
		margin-left: 8.33333%
	}
	
	.col-xs-offset-2 {
		margin-left: 16.66667%
	}
	
	.col-xs-offset-3 {
		margin-left: 25%
	}
	
	.col-xs-offset-4 {
		margin-left: 33.33333%
	}
	
	.col-xs-offset-5 {
		margin-left: 41.66667%
	}
	
	.col-xs-offset-6 {
		margin-left: 50%
	}
	
	.col-xs-offset-7 {
		margin-left: 58.33333%
	}
	
	.col-xs-offset-8 {
		margin-left: 66.66667%
	}
	
	.col-xs-offset-9 {
		margin-left: 75%
	}
	
	.col-xs-offset-10 {
		margin-left: 83.33333%
	}
	
	.col-xs-offset-11 {
		margin-left: 91.66667%
	}
	
	.col-xs-offset-12 {
		margin-left: 100%
	}
	
	table {
		background-color: transparent
	}
	
	th {
		text-align: left
	}
	
	.table {
		width: 100%;
		max-width: 100%;
		margin-bottom: 18px
	}
	
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th,
		.table>thead>tr>td, .table>thead>tr>th {
		padding: 8px;
		line-height: 1.42857;
		vertical-align: top;
		border-top: 1px solid #94d7e4
	}
	
	.table>thead>tr>th {
		vertical-align: bottom;
		border-bottom: 2px solid #94d7e4
	}
	
	.table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th,
		.table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th,
		.table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
		border-top: 0
	}
	
	.table>tbody+tbody {
		border-top: 2px solid #94d7e4
	}
	
	.table .table {
		background-color: #fff
	}
	
	.table-condensed>tbody>tr>td, .table-condensed>tbody>tr>th,
		.table-condensed>tfoot>tr>td, .table-condensed>tfoot>tr>th,
		.table-condensed>thead>tr>td, .table-condensed>thead>tr>th {
		padding: 5px
	}
	
	.table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th,
		.table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th,
		.table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
		border: 1px solid #94d7e4
	}
	
	.table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
		border-bottom-width: 2px
	}
	
	.table-striped>tbody>tr:nth-child(odd)>td, .table-striped>tbody>tr:nth-child(odd)>th {
		background-color: #f9f9f9
	}
	
	.table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {
		background-color: #f5f5f5
	}
	
	table col[class*=col-] {
		position: static;
		float: none;
		display: table-column
	}
	
	table td[class*=col-], table th[class*=col-] {
		position: static;
		float: none;
		display: table-cell
	}
	
	.table>tbody>tr.active>td, .table>tbody>tr.active>th, .table>tbody>tr>td.active,
		.table>tbody>tr>th.active, .table>tfoot>tr.active>td, .table>tfoot>tr.active>th,
		.table>tfoot>tr>td.active, .table>tfoot>tr>th.active, .table>thead>tr.active>td,
		.table>thead>tr.active>th, .table>thead>tr>td.active, .table>thead>tr>th.active {
		background-color: #f5f5f5
	}
	
	.table-hover>tbody>tr.active:hover>td, .table-hover>tbody>tr.active:hover>th,
		.table-hover>tbody>tr:hover>.active, .table-hover>tbody>tr>td.active:hover,
		.table-hover>tbody>tr>th.active:hover {
		background-color: #e8e8e8
	}
	
	.table>tbody>tr.success>td, .table>tbody>tr.success>th, .table>tbody>tr>td.success,
		.table>tbody>tr>th.success, .table>tfoot>tr.success>td, .table>tfoot>tr.success>th,
		.table>tfoot>tr>td.success, .table>tfoot>tr>th.success, .table>thead>tr.success>td,
		.table>thead>tr.success>th, .table>thead>tr>td.success, .table>thead>tr>th.success {
		background-color: #dff0d8
	}
	
	.table-hover>tbody>tr.success:hover>td, .table-hover>tbody>tr.success:hover>th,
		.table-hover>tbody>tr:hover>.success, .table-hover>tbody>tr>td.success:hover,
		.table-hover>tbody>tr>th.success:hover {
		background-color: #d0e9c6
	}
	
	.table>tbody>tr.info>td, .table>tbody>tr.info>th, .table>tbody>tr>td.info,
		.table>tbody>tr>th.info, .table>tfoot>tr.info>td, .table>tfoot>tr.info>th,
		.table>tfoot>tr>td.info, .table>tfoot>tr>th.info, .table>thead>tr.info>td,
		.table>thead>tr.info>th, .table>thead>tr>td.info, .table>thead>tr>th.info {
		background-color: #d9edf7
	}
	
	.table-hover>tbody>tr.info:hover>td, .table-hover>tbody>tr.info:hover>th,
		.table-hover>tbody>tr:hover>.info, .table-hover>tbody>tr>td.info:hover,
		.table-hover>tbody>tr>th.info:hover {
		background-color: #c4e3f3
	}
	
	.table>tbody>tr.warning>td, .table>tbody>tr.warning>th, .table>tbody>tr>td.warning,
		.table>tbody>tr>th.warning, .table>tfoot>tr.warning>td, .table>tfoot>tr.warning>th,
		.table>tfoot>tr>td.warning, .table>tfoot>tr>th.warning, .table>thead>tr.warning>td,
		.table>thead>tr.warning>th, .table>thead>tr>td.warning, .table>thead>tr>th.warning {
		background-color: #fcf8e3
	}
	
	.table-hover>tbody>tr.warning:hover>td, .table-hover>tbody>tr.warning:hover>th,
		.table-hover>tbody>tr:hover>.warning, .table-hover>tbody>tr>td.warning:hover,
		.table-hover>tbody>tr>th.warning:hover {
		background-color: #faf2cc
	}
	
	.table>tbody>tr.danger>td, .table>tbody>tr.danger>th, .table>tbody>tr>td.danger,
		.table>tbody>tr>th.danger, .table>tfoot>tr.danger>td, .table>tfoot>tr.danger>th,
		.table>tfoot>tr>td.danger, .table>tfoot>tr>th.danger, .table>thead>tr.danger>td,
		.table>thead>tr.danger>th, .table>thead>tr>td.danger, .table>thead>tr>th.danger {
		background-color: #f2dede
	}
	
	.table-hover>tbody>tr.danger:hover>td, .table-hover>tbody>tr.danger:hover>th,
		.table-hover>tbody>tr:hover>.danger, .table-hover>tbody>tr>td.danger:hover,
		.table-hover>tbody>tr>th.danger:hover {
		background-color: #ebcccc
	}
	
	fieldset {
		padding: 0;
		margin: 0;
		border: 0;
		min-width: 0
	}
	
	legend {
		display: block;
		width: 100%;
		padding: 0;
		margin-bottom: 18px;
		font-size: 19.5px;
		line-height: inherit;
		color: #333;
		border: 0;
		border-bottom: 1px solid #e5e5e5
	}
	
	label {
		display: inline-block;
		max-width: 100%;
		margin-bottom: 5px;
		font-weight: 700;
		color: #0e377d
	}
	
	input[type=search] {
	    -webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box
	}
	
	input[type=checkbox], input[type=radio] {
		margin: 4px 0 0;
		line-height: normal
	}
	
	input[type=file] {
		display: block
	}
	
	input[type=range] {
		display: block;
		width: 100%
	}
	
	select[multiple], select[size] {
		height: auto
	}
	
	input[type=checkbox]:focus, input[type=file]:focus, input[type=radio]:focus {
		outline: dotted thin;
		outline: -webkit-focus-ring-color auto 5px;
		outline-offset: -2px
	}
	
	output {
		display: block;
		padding-top: 7px;
		font-size: 13px;
		line-height: 1.42857;
		color: #555
	}
	
	.form-control {
		display: block;
		width: 100%;
		height: 32px;
		padding: 6px 12px;
		font-size: 13px;
		line-height: 1.42857;
		color: #555;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		border-radius: 3px;
	    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
		-webkit-transition: border-color ease-in-out .15s, box-shadow
			ease-in-out .15s;
	    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out
			.15s;
		transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s
	}
	
	.form-control:focus {
		border-color: #66afe9;
		outline: 0;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px
			rgba(102, 175, 233, .6);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px
			rgba(102, 175, 233, .6)
	}
	
	.form-control:-moz-placeholder {
		color: #777;
		opacity: 1
	}
	
	.form-control:-ms-input-placeholder {
		color: #777
	}
	
	.form-control:-webkit-input-placeholder {
		color: #777
	}
	
	.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
		cursor: not-allowed;
		background-color: #eee;
		opacity: 1
	}
	
	textarea.form-control {
		height: auto
	}
	
	input[type=search] {
		-webkit-appearance: none
	}
	
	input[type=date], input[type=datetime-local], input[type=month], input[type=time] {
		line-height: 32px;
		line-height: 1.42857 \0
	}
	
	.form-horizontal .form-group-sm input[type=date].form-control,
		.form-horizontal .form-group-sm input[type=datetime-local].form-control,
		.form-horizontal .form-group-sm input[type=month].form-control,
		.form-horizontal .form-group-sm input[type=time].form-control,
		.input-group-sm>.input-group-btn>input[type=date].btn, .input-group-sm>.input-group-btn>input[type=datetime-local].btn,
		.input-group-sm>.input-group-btn>input[type=month].btn, .input-group-sm>.input-group-btn>input[type=time].btn,
		.input-group-sm>input[type=date].form-control, .input-group-sm>input[type=date].input-group-addon,
		.input-group-sm>input[type=datetime-local].form-control,
		.input-group-sm>input[type=datetime-local].input-group-addon,
		.input-group-sm>input[type=month].form-control, .input-group-sm>input[type=month].input-group-addon,
		.input-group-sm>input[type=time].form-control, .input-group-sm>input[type=time].input-group-addon,
		input[type=date].input-sm, input[type=datetime-local].input-sm, input[type=month].input-sm,
		input[type=time].input-sm {
		line-height: 30px
	}
	
	.form-horizontal .form-group-lg input[type=date].form-control,
		.form-horizontal .form-group-lg input[type=datetime-local].form-control,
		.form-horizontal .form-group-lg input[type=month].form-control,
		.form-horizontal .form-group-lg input[type=time].form-control,
		.input-group-lg>.input-group-btn>input[type=date].btn, .input-group-lg>.input-group-btn>input[type=datetime-local].btn,
		.input-group-lg>.input-group-btn>input[type=month].btn, .input-group-lg>.input-group-btn>input[type=time].btn,
		.input-group-lg>input[type=date].form-control, .input-group-lg>input[type=date].input-group-addon,
		.input-group-lg>input[type=datetime-local].form-control,
		.input-group-lg>input[type=datetime-local].input-group-addon,
		.input-group-lg>input[type=month].form-control, .input-group-lg>input[type=month].input-group-addon,
		.input-group-lg>input[type=time].form-control, .input-group-lg>input[type=time].input-group-addon,
		input[type=date].input-lg, input[type=datetime-local].input-lg, input[type=month].input-lg,
		input[type=time].input-lg {
		line-height: 45px
	}
	
	.form-group {
		margin-bottom: 10px
	}
	
	.checkbox, .radio {
		position: relative;
		display: block;
		min-height: 18px;
		margin-top: 10px;
		margin-bottom: 10px
	}
	
	.checkbox label, .radio label {
		padding-left: 20px;
		margin-bottom: 0;
		font-weight: 400;
		cursor: pointer
	}
	
	.checkbox input[type=checkbox], .checkbox-inline input[type=checkbox],
		.radio input[type=radio], .radio-inline input[type=radio] {
		position: absolute;
		margin-left: -20px
	}
	
	.checkbox+.checkbox, .radio+.radio {
		margin-top: -5px
	}
	
	.checkbox-inline, .radio-inline {
		display: inline-block;
		padding-left: 20px;
		margin-bottom: 0;
		vertical-align: middle;
		font-weight: 400;
		cursor: pointer
	}
	
	.checkbox-inline+.checkbox-inline, .radio-inline+.radio-inline {
		margin-top: 0;
		margin-left: 10px
	}
	
	.checkbox-inline.disabled, .checkbox.disabled label, .radio-inline.disabled,
		.radio.disabled label, fieldset[disabled] .checkbox label, fieldset[disabled] .checkbox-inline,
		fieldset[disabled] .radio label, fieldset[disabled] .radio-inline,
		fieldset[disabled] input[type=checkbox], fieldset[disabled] input[type=radio],
		input[type=checkbox].disabled, input[type=checkbox][disabled], input[type=radio].disabled,
		input[type=radio][disabled] {
		cursor: not-allowed
	}
	
	.form-control-static {
		padding-top: 7px;
		padding-bottom: 7px;
		margin-bottom: 0
	}
	
	.form-control-static.input-lg, .form-control-static.input-sm,
		.form-horizontal .form-group-lg .form-control-static.form-control,
		.form-horizontal .form-group-sm .form-control-static.form-control,
		.input-group-lg>.form-control-static.form-control, .input-group-lg>.form-control-static.input-group-addon,
		.input-group-lg>.input-group-btn>.form-control-static.btn,
		.input-group-sm>.form-control-static.form-control, .input-group-sm>.form-control-static.input-group-addon,
		.input-group-sm>.input-group-btn>.form-control-static.btn {
		padding-left: 0;
		padding-right: 0
	}
	
	.form-horizontal .form-group-sm .form-control, .input-group-sm>.form-control,
		.input-group-sm>.input-group-addon, .input-group-sm>.input-group-btn>.btn,
		.input-sm {
		height: 30px;
		padding: 5px 10px;
		font-size: 12px;
		line-height: 1.5;
		border-radius: 2px
	}
	
	.form-horizontal .form-group-sm select.form-control, .input-group-sm>.input-group-btn>select.btn,
		.input-group-sm>select.form-control, .input-group-sm>select.input-group-addon,
		select.input-sm {
		height: 30px;
		line-height: 30px
	}
	
	.form-horizontal .form-group-sm select[multiple].form-control,
		.form-horizontal .form-group-sm textarea.form-control, .input-group-sm>.input-group-btn>select[multiple].btn,
		.input-group-sm>.input-group-btn>textarea.btn, .input-group-sm>select[multiple].form-control,
		.input-group-sm>select[multiple].input-group-addon, .input-group-sm>textarea.form-control,
		.input-group-sm>textarea.input-group-addon, select[multiple].input-sm,
		textarea.input-sm {
		height: auto
	}
	
	.form-horizontal .form-group-lg .form-control, .input-group-lg>.form-control,
		.input-group-lg>.input-group-addon, .input-group-lg>.input-group-btn>.btn,
		.input-lg {
		height: 45px;
		padding: 10px 16px;
		font-size: 17px;
		line-height: 1.33;
		border-radius: 4px
	}
	
	.form-horizontal .form-group-lg select.form-control, .input-group-lg>.input-group-btn>select.btn,
		.input-group-lg>select.form-control, .input-group-lg>select.input-group-addon,
		select.input-lg {
		height: 45px;
		line-height: 45px
	}
	
	.form-horizontal .form-group-lg select[multiple].form-control,
		.form-horizontal .form-group-lg textarea.form-control, .input-group-lg>.input-group-btn>select[multiple].btn,
		.input-group-lg>.input-group-btn>textarea.btn, .input-group-lg>select[multiple].form-control,
		.input-group-lg>select[multiple].input-group-addon, .input-group-lg>textarea.form-control,
		.input-group-lg>textarea.input-group-addon, select[multiple].input-lg,
		textarea.input-lg {
		height: auto
	}
	
	.has-feedback {
		position: relative
	}
	
	.has-feedback .form-control {
		padding-right: 40px
	}
	
	.form-control-feedback {
		position: absolute;
		top: 23px;
		right: 0;
		z-index: 2;
		display: block;
		width: 32px;
		height: 32px;
		line-height: 32px;
		text-align: center
	}
	
	.form-horizontal .form-group-lg .form-control+.form-control-feedback,
		.input-group-lg>.form-control+.form-control-feedback, .input-group-lg>.input-group-addon+.form-control-feedback,
		.input-group-lg>.input-group-btn>.btn+.form-control-feedback, .input-lg+.form-control-feedback {
		width: 45px;
		height: 45px;
		line-height: 45px
	}
	
	.form-horizontal .form-group-sm .form-control+.form-control-feedback,
		.input-group-sm>.form-control+.form-control-feedback, .input-group-sm>.input-group-addon+.form-control-feedback,
		.input-group-sm>.input-group-btn>.btn+.form-control-feedback, .input-sm+.form-control-feedback {
		width: 30px;
		height: 30px;
		line-height: 30px
	}
	
	.has-success .checkbox, .has-success .checkbox-inline, .has-success .control-label,
		.has-success .help-block, .has-success .radio, .has-success .radio-inline {
		color: #3c763d
	}
	
	.has-success .form-control {
		border-color: #3c763d;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075)
	}
	
	.has-success .form-control:focus {
		border-color: #2b542c;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #67b168;
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #67b168
	}
	
	.has-success .input-group-addon {
		color: #3c763d;
		border-color: #3c763d;
		background-color: #dff0d8
	}
	
	.has-success .form-control-feedback {
		color: #3c763d
	}
	
	.has-warning .checkbox, .has-warning .checkbox-inline, .has-warning .control-label,
		.has-warning .help-block, .has-warning .radio, .has-warning .radio-inline {
		color: #8a6d3b
	}
	
	.has-warning .form-control {
		border-color: #8a6d3b;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075)
	}
	
	.has-warning .form-control:focus {
		border-color: #66512c;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #c0a16b;
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #c0a16b
	}
	
	.has-warning .input-group-addon {
		color: #8a6d3b;
		border-color: #8a6d3b;
		background-color: #fcf8e3
	}
	
	.has-warning .form-control-feedback {
		color: #8a6d3b
	}
	
	.has-error .checkbox, .has-error .checkbox-inline, .has-error .control-label,
		.has-error .help-block, .has-error .radio, .has-error .radio-inline {
		color: #a94442
	}
	
	.has-error .form-control {
		border-color: #a94442;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075)
	}
	
	.has-error .form-control:focus {
		border-color: #843534;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483;
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483
	}
	
	.has-error .input-group-addon {
		color: #a94442;
		border-color: #a94442;
		background-color: #f2dede
	}
	
	.has-error .form-control-feedback {
		color: #a94442
	}
	
	.has-feedback label.sr-only ~.form-control-feedback {
		top: 0
	}
	
	.help-block {
		display: block;
		margin-top: 5px;
		margin-bottom: 10px;
		color: #737373
	}
	
	.form-horizontal .checkbox, .form-horizontal .checkbox-inline,
		.form-horizontal .radio, .form-horizontal .radio-inline {
		margin-top: 0;
		margin-bottom: 0;
		padding-top: 7px
	}
	
	.form-horizontal .checkbox, .form-horizontal .radio {
		min-height: 25px
	}
	
	.form-horizontal .form-group {
		margin-left: -15px;
		margin-right: -15px
	}
	
	.form-horizontal .form-group:after, .form-horizontal .form-group:before {
		content: " ";
		display: table
	}
	
	.form-horizontal .form-group:after {
		clear: both
	}
	
	.form-horizontal .has-feedback .form-control-feedback {
		top: 0;
		right: 15px
	}
	
	small.required {
		background-color: #a62c00;
		color: #fff;
		width: 12px;
		height: 15px;
		display: inline-block;
		text-align: center;
		border-radius: 15px
	}
	
	.btn {
		display: inline-block;
		margin-bottom: 0;
		font-weight: 700;
		text-align: center;
		vertical-align: middle;
		cursor: pointer;
		background-image: none;
		border: 1px solid transparent;
		white-space: nowrap;
		padding: 6px 12px;
		font-size: 13px;
		line-height: 1.42857;
		border-radius: 3px;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none
	}
	
	.btn.active:focus, .btn:active:focus, .btn:focus {
		outline: dotted thin;
		outline: -webkit-focus-ring-color auto 5px;
		outline-offset: -2px
	}
	
	.btn:focus, .btn:hover {
		color: #333;
		text-decoration: none
	}
	
	.btn.active, .btn:active {
		outline: 0;
		background-image: none;
		-webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
		box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125)
	}
	
	.btn.disabled, .btn[disabled], fieldset[disabled] .btn {
		cursor: not-allowed;
		pointer-events: none;
		opacity: .65;
		filter: alpha(opacity = 65);
		-webkit-box-shadow: none;
		box-shadow: none
	}
	
	.btn-default {
		color: #333;
		background-color: #fff;
		border-color: #ccc
	}
	
	.btn-default.active, .btn-default:active, .btn-default:focus,
		.btn-default:hover, .open>.dropdown-toggle.btn-default, .open>.btn-default.dropdown-toggle {
		color: #fff;
		background-color: #0e377d;
		border-color: #0e377d
	}
	
	.btn-default.active, .btn-default:active, .open>.dropdown-toggle.btn-default, .open>.btn-default.dropdown-toggle {
		background-image: none
	}
	
	.btn-default.disabled, .btn-default.disabled.active, .btn-default.disabled:active,
		.btn-default.disabled:focus, .btn-default.disabled:hover, .btn-default[disabled],
		.btn-default[disabled].active, .btn-default[disabled]:active,
		.btn-default[disabled]:focus, .btn-default[disabled]:hover, fieldset[disabled] .btn-default,
		fieldset[disabled] .btn-default.active, fieldset[disabled] .btn-default:active,
		fieldset[disabled] .btn-default:focus, fieldset[disabled] .btn-default:hover {
		background-color: #fff;
		border-color: #ccc
	}
	
	.btn-default .badge {
		color: #fff;
		background-color: #333
	}
	
	.btn-primary {
		color: #fff;
		background-color: #0e377d;
		border-color: #0b2d66
	}
	
	.btn-primary.active, .btn-primary:active, .btn-primary:focus,
		.btn-primary:hover, .open>.dropdown-toggle.btn-primary, .open>.btn-primary.dropdown-toggle {
		color: #fff;
		background-color: #0e377d;
		border-color: #0e377d
	}
	
	.btn-primary.active, .btn-primary:active, .open>.dropdown-toggle.btn-primary, .open>.btn-primary.dropdown-toggle {
		background-image: none
	}
	
	.btn-primary.disabled, .btn-primary.disabled.active, .btn-primary.disabled:active,
		.btn-primary.disabled:focus, .btn-primary.disabled:hover, .btn-primary[disabled],
		.btn-primary[disabled].active, .btn-primary[disabled]:active,
		.btn-primary[disabled]:focus, .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary,
		fieldset[disabled] .btn-primary.active, fieldset[disabled] .btn-primary:active,
		fieldset[disabled] .btn-primary:focus, fieldset[disabled] .btn-primary:hover {
		background-color: #0e377d;
		border-color: #0b2d66
	}
	
	.btn-primary .badge {
		color: #0e377d;
		background-color: #fff
	}
	
	.btn-success {
		color: #fff;
		background-color: #5cb85c;
		border-color: #4cae4c
	}
	
	.btn-success.active, .btn-success:active, .btn-success:focus,
		.btn-success:hover, .open>.dropdown-toggle.btn-success, .open>.btn-success.dropdown-toggle {
		color: #fff;
		background-color: #0e377d;
		border-color: #0e377d
	}
	
	.btn-success.active, .btn-success:active, .open>.dropdown-toggle.btn-success, .open>.btn-success.dropdown-toggle {
		background-image: none
	}
	
	.btn-success.disabled, .btn-success.disabled.active, .btn-success.disabled:active,
		.btn-success.disabled:focus, .btn-success.disabled:hover, .btn-success[disabled],
		.btn-success[disabled].active, .btn-success[disabled]:active,
		.btn-success[disabled]:focus, .btn-success[disabled]:hover, fieldset[disabled] .btn-success,
		fieldset[disabled] .btn-success.active, fieldset[disabled] .btn-success:active,
		fieldset[disabled] .btn-success:focus, fieldset[disabled] .btn-success:hover {
		background-color: #5cb85c;
		border-color: #4cae4c
	}
	
	.btn-success .badge {
		color: #5cb85c;
		background-color: #fff
	}
	
	.btn-info {
		color: #0e377d;
		background-color: #94d7e4;
		border-color: #80cfdf
	}
	
	.btn-info.active, .btn-info:active, .btn-info:focus, .btn-info:hover,
		.open>.dropdown-toggle.btn-info, .open>.btn-info.dropdown-toggle {
		color: #fff;
		background-color: #0e377d;
		border-color: #0e377d
	}
	
	.btn-info.active, .btn-info:active, .open>.dropdown-toggle.btn-info, .open>.btn-info.dropdown-toggle {
		background-image: none
	}
	
	.btn-info.disabled, .btn-info.disabled.active, .btn-info.disabled:active,
		.btn-info.disabled:focus, .btn-info.disabled:hover, .btn-info[disabled],
		.btn-info[disabled].active, .btn-info[disabled]:active, .btn-info[disabled]:focus,
		.btn-info[disabled]:hover, fieldset[disabled] .btn-info, fieldset[disabled] .btn-info.active,
		fieldset[disabled] .btn-info:active, fieldset[disabled] .btn-info:focus,
		fieldset[disabled] .btn-info:hover {
		background-color: #94d7e4;
		border-color: #80cfdf
	}
	
	.btn-info .badge {
		color: #94d7e4;
		background-color: #0e377d
	}
	
	.btn-warning {
		color: #fff;
		background-color: #f0ad4e;
		border-color: #eea236
	}
	
	.btn-warning.active, .btn-warning:active, .btn-warning:focus,
		.btn-warning:hover, .open>.dropdown-toggle.btn-warning, .open>.btn-warning.dropdown-toggle {
		color: #fff;
		background-color: #0e377d;
		border-color: #0e377d
	}
	
	.btn-warning.active, .btn-warning:active, .open>.dropdown-toggle.btn-warning, .open>.btn-warning.dropdown-toggle {
		background-image: none
	}
	
	.btn-warning.disabled, .btn-warning.disabled.active, .btn-warning.disabled:active,
		.btn-warning.disabled:focus, .btn-warning.disabled:hover, .btn-warning[disabled],
		.btn-warning[disabled].active, .btn-warning[disabled]:active,
		.btn-warning[disabled]:focus, .btn-warning[disabled]:hover, fieldset[disabled] .btn-warning,
		fieldset[disabled] .btn-warning.active, fieldset[disabled] .btn-warning:active,
		fieldset[disabled] .btn-warning:focus, fieldset[disabled] .btn-warning:hover {
		background-color: #f0ad4e;
		border-color: #eea236
	}
	
	.btn-warning .badge {
		color: #f0ad4e;
		background-color: #fff
	}
	
	.btn-danger {
		color: #fff;
		background-color: #a62c00;
		border-color: #8c2500
	}
	
	.btn-danger.active, .btn-danger:active, .btn-danger:focus, .btn-danger:hover,
		.open>.btn-danger.dropdown-toggle {
		color: #fff;
		background-color: #0e377d;
		border-color: #0e377d
	}
	
	.btn-danger.active, .btn-danger:active, .open>.dropdown-toggle.btn-danger, .open>.btn-danger.dropdown-toggle {
		background-image: none
	}
	
	.btn-danger.disabled, .btn-danger.disabled.active, .btn-danger.disabled:active,
		.btn-danger.disabled:focus, .btn-danger.disabled:hover, .btn-danger[disabled],
		.btn-danger[disabled].active, .btn-danger[disabled]:active, .btn-danger[disabled]:focus,
		.btn-danger[disabled]:hover, fieldset[disabled] .btn-danger, fieldset[disabled] .btn-danger.active,
		fieldset[disabled] .btn-danger:active, fieldset[disabled] .btn-danger:focus,
		fieldset[disabled] .btn-danger:hover {
		background-color: #a62c00;
		border-color: #8c2500
	}
	
	.btn-danger .badge {
		color: #a62c00;
		background-color: #fff
	}
	
	.btn-link {
		color: #0e377d;
		font-weight: 400;
		cursor: pointer;
		border-radius: 0
	}
	
	.btn-link, .btn-link:active, .btn-link[disabled], fieldset[disabled] .btn-link {
		background-color: transparent;
		-webkit-box-shadow: none;
		box-shadow: none
	}
	
	.btn-link, .btn-link:active, .btn-link:focus, .btn-link:hover {
		border-color: transparent
	}
	
	.btn-link:focus, .btn-link:hover {
		color: #061938;
		text-decoration: underline;
		background-color: transparent
	}
	
	.btn-link[disabled]:focus, .btn-link[disabled]:hover, fieldset[disabled] .btn-link:focus,
		fieldset[disabled] .btn-link:hover {
		color: #777;
		text-decoration: none
	}
	
	.btn-group-lg>.btn, .btn-lg {
		padding: 10px 16px;
		font-size: 17px;
		line-height: 1.33;
		border-radius: 4px
	}
	
	.btn-group-sm>.btn, .btn-sm {
		padding: 5px 10px;
		font-size: 12px;
		line-height: 1.5;
		border-radius: 2px
	}
	
	.btn-group-xs>.btn, .btn-xs {
		padding: 1px 5px;
		font-size: 12px;
		line-height: 1.5;
		border-radius: 2px
	}
	
	.btn-block {
		display: block;
		width: 100%
	}
	
	.btn-block+.btn-block {
		margin-top: 5px
	}
	
	input[type=button].btn-block, input[type=reset].btn-block, input[type=submit].btn-block {
		width: 100%
	}
	
	.fade {
		opacity: 0;
		-webkit-transition: opacity .15s linear;
		-o-transition: opacity .15s linear;
		transition: opacity .15s linear
	}
	
	.fade.in {
		opacity: 1
	}
	
	.collapse {
		display: none
	}
	
	.collapse.in {
		display: block
	}
	
	tr.collapse.in {
		display: table-row
	}
	
	tbody.collapse.in {
		display: table-row-group
	}
	
	.collapsing {
		position: relative;
		height: 0;
		overflow: hidden;
		-webkit-transition: height .35s ease;
		-o-transition: height .35s ease;
		transition: height .35s ease
	}
	
	.caret {
		display: inline-block;
		width: 0;
		height: 0;
		margin-left: 2px;
		vertical-align: middle;
		border-top: 4px solid;
		border-right: 4px solid transparent;
		border-left: 4px solid transparent
	}
	
	.dropdown {
		position: relative
	}
	
	.dropdown-toggle:focus {
		outline: 0
	}
	
	.dropdown-menu {
		position: absolute;
		top: 100%;
		left: 0;
		z-index: 1000;
		display: none;
		float: left;
		min-width: 160px;
		padding: 5px 0;
		margin: 2px 0 0;
		list-style: none;
		font-size: 13px;
		text-align: left;
		background-color: #fff;
		border: 1px solid #ccc;
		border: 1px solid rgba(0, 0, 0, .15);
		border-radius: 3px;
	    -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
		box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
	    -webkit-background-clip: padding-box;
		background-clip: padding-box
	}
	
	.dropdown-menu.pull-right {
		right: 0;
		left: auto
	}
	
	.dropdown-menu .divider {
		height: 1px;
		margin: 8px 0;
		overflow: hidden;
		background-color: #e5e5e5
	}
	
	.dropdown-menu>li>a {
		display: block;
		padding: 3px 20px;
		clear: both;
		font-weight: 400;
		line-height: 1.42857;
		color: #333;
		white-space: nowrap
	}
	
	.dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
		text-decoration: none;
		color: #262626;
		background-color: #f5f5f5
	}
	
	.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
		color: #fff;
		text-decoration: none;
		outline: 0;
		background-color: #0e377d
	}
	
	.dropdown-menu>.disabled>a, .dropdown-menu>.disabled>a:focus,
		.dropdown-menu>.disabled>a:hover {
		color: #777
	}
	
	.dropdown-menu>.disabled>a:focus, .dropdown-menu>.disabled>a:hover {
		text-decoration: none;
		background-color: transparent;
		background-image: none;
		filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
		cursor: not-allowed
	}
	
	.open>.dropdown-menu {
		display: block
	}
	
	.open>a {
		outline: 0
	}
	
	.dropdown-menu-right {
		left: auto;
		right: 0
	}
	
	.dropdown-menu-left {
		left: 0;
		right: auto
	}
	
	.dropdown-header {
		display: block;
		padding: 3px 20px;
		font-size: 12px;
		line-height: 1.42857;
		color: #777;
		white-space: nowrap
	}
	
	.dropdown-backdrop {
		position: fixed;
		left: 0;
		right: 0;
		bottom: 0;
		top: 0;
		z-index: 990
	}
	
	.pull-right>.dropdown-menu {
		right: 0;
		left: auto
	}
	
	.dropup .caret, .navbar-fixed-bottom .dropdown .caret {
		border-top: 0;
		border-bottom: 4px solid;
		content: ""
	}
	
	.dropup .dropdown-menu, .navbar-fixed-bottom .dropdown .dropdown-menu {
		top: auto;
		bottom: 100%;
		margin-bottom: 1px
	}
	
	.btn-group, .btn-group-vertical {
		position: relative;
		display: inline-block;
		vertical-align: middle
	}
	
	.btn-group-vertical>.btn, .btn-group>.btn {
		position: relative;
		float: left
	}
	
	.btn-group-vertical>.btn.active, .btn-group-vertical>.btn:active,
		.btn-group-vertical>.btn:focus, .btn-group-vertical>.btn:hover,
		.btn-group>.btn.active, .btn-group>.btn:active, .btn-group>.btn:focus,
		.btn-group>.btn:hover {
		z-index: 2
	}
	
	.btn-group-vertical>.btn:focus, .btn-group>.btn:focus {
		outline: 0
	}
	
	.btn-group .btn+.btn, .btn-group .btn+.btn-group, .btn-group .btn-group+.btn,
		.btn-group .btn-group+.btn-group {
		margin-left: -1px
	}
	
	.btn-toolbar {
		margin-left: -5px
	}
	
	.btn-toolbar:after, .btn-toolbar:before {
		content: " ";
		display: table
	}
	
	.btn-toolbar:after {
		clear: both
	}
	
	.btn-toolbar .btn-group, .btn-toolbar .input-group {
		float: left
	}
	
	.btn-toolbar>.btn, .btn-toolbar>.btn-group, .btn-toolbar>.input-group {
		margin-left: 5px
	}
	
	.btn-group>.btn:not(:first-child):not(:last-child):not(.dropdown-toggle) {
		border-radius: 0
	}
	
	.btn-group>.btn:first-child {
		margin-left: 0
	}
	
	.btn-group>.btn:first-child:not(:last-child):not(.dropdown-toggle) {
		border-bottom-right-radius: 0;
		border-top-right-radius: 0
	}
	
	.btn-group>.btn:last-child:not(:first-child), .btn-group>.dropdown-toggle:not(:first-child) {
		border-bottom-left-radius: 0;
		border-top-left-radius: 0
	}
	
	.btn-group>.btn-group {
		float: left
	}
	
	.btn-group>.btn-group:not (:first-child ):not (:last-child )>.btn {
		border-radius: 0
	}
	
	.btn-group>.btn-group:first-child>.btn:last-child, .btn-group>.btn-group:first-child>.dropdown-toggle {
		border-bottom-right-radius: 0;
		border-top-right-radius: 0
	}
	
	.btn-group>.btn-group:last-child>.btn:first-child {
		border-bottom-left-radius: 0;
		border-top-left-radius: 0
	}
	
	.btn-group .dropdown-toggle:active, .btn-group.open .dropdown-toggle {
		outline: 0
	}
	
	.btn-group>.btn+.dropdown-toggle {
		padding-left: 8px;
		padding-right: 8px
	}
	
	.btn-group-lg.btn-group>.btn+.dropdown-toggle, .btn-group>.btn-lg+.dropdown-toggle {
		padding-left: 12px;
		padding-right: 12px
	}
	
	.btn-group.open .dropdown-toggle {
		-webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
		box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125)
	}
	
	.btn-group.open .dropdown-toggle.btn-link {
		-webkit-box-shadow: none;
		box-shadow: none
	}
	
	.btn .caret {
		margin-left: 0
	}
	
	.btn-group-lg>.btn .caret, .btn-lg .caret {
		border-width: 5px 5px 0
	}
	
	.dropup .btn-group-lg>.btn .caret, .dropup .btn-lg .caret {
		border-width: 0 5px 5px
	}
	
	.btn-group-vertical>.btn, .btn-group-vertical>.btn-group,
		.btn-group-vertical>.btn-group>.btn {
		display: block;
		float: none;
		width: 100%;
		max-width: 100%
	}
	
	.btn-group-vertical>.btn-group:after, .btn-group-vertical>.btn-group:before {
		content: " ";
		display: table
	}
	
	.btn-group-vertical>.btn-group:after {
		clear: both
	}
	
	.btn-group-vertical>.btn-group>.btn {
		float: none
	}
	
	.btn-group-vertical>.btn+.btn, .btn-group-vertical>.btn+.btn-group,
		.btn-group-vertical>.btn-group+.btn, .btn-group-vertical>.btn-group+.btn-group {
		margin-top: -1px;
		margin-left: 0
	}
	
	.btn-group-vertical>.btn:not(:first-child):not(:last-child) {
		border-radius: 0
	}
	
	.btn-group-vertical>.btn:first-child:not(:last-child) {
		border-top-right-radius: 3px;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0
	}
	
	.btn-group-vertical>.btn:last-child:not(:first-child) {
		border-bottom-left-radius: 3px;
		border-top-right-radius: 0;
		border-top-left-radius: 0
	}
	
	.btn-group-vertical>.btn-group:not (:first-child ):not (:last-child )>.btn {
		border-radius: 0
	}
	
	.btn-group-vertical>.btn-group:first-child:not (:last-child )>.btn:last-child,
		.btn-group-vertical>.btn-group:first-child:not (:last-child )>.dropdown-toggle {
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0
	}
	
	.btn-group-vertical>.btn-group:last-child:not (:first-child )>.btn:first-child {
		border-top-right-radius: 0;
		border-top-left-radius: 0
	}
	
	.btn-group-justified {
		display: table;
		width: 100%;
		table-layout: fixed;
		border-collapse: separate
	}
	
	.btn-group-justified>.btn, .btn-group-justified>.btn-group {
		float: none;
		display: table-cell;
		width: 1%
	}
	
	.btn-group-justified>.btn-group .btn {
		width: 100%
	}
	
	.btn-group-justified>.btn-group .dropdown-menu {
		left: auto
	}
	
	[data-toggle=buttons]>.btn>input[type=checkbox], [data-toggle=buttons]>.btn>input[type=radio] {
		position: absolute;
		z-index: -1;
		opacity: 0;
		filter: alpha(opacity = 0)
	}
	
	.input-group {
		position: relative;
		display: table;
		border-collapse: separate
	}
	
	.input-group[class*=col-] {
		float: none;
		padding-left: 0;
		padding-right: 0
	}
	
	.input-group .form-control {
		position: relative;
		z-index: 2;
		float: left;
		width: 100%;
		margin-bottom: 0
	}
	
	.input-group-lg>.form-control, .input-group-lg>.input-group-addon,
		.input-group-lg>.input-group-btn>.btn {
		height: 46px;
		padding: 10px 16px;
		font-size: 18px;
		line-height: 1.33;
		border-radius: 6px
	}
	
	select.input-group-lg>.form-control, select.input-group-lg>.input-group-addon,
		select.input-group-lg>.input-group-btn>.btn {
		height: 46px;
		line-height: 46px
	}
	
	select[multiple].input-group-lg>.form-control, select[multiple].input-group-lg>.input-group-addon,
		select[multiple].input-group-lg>.input-group-btn>.btn, textarea.input-group-lg>.form-control,
		textarea.input-group-lg>.input-group-addon, textarea.input-group-lg>.input-group-btn>.btn {
		height: auto
	}
	
	.input-group-sm>.form-control, .input-group-sm>.input-group-addon,
		.input-group-sm>.input-group-btn>.btn {
		height: 30px;
		padding: 5px 10px;
		font-size: 12px;
		line-height: 1.5;
		border-radius: 3px
	}
	
	select.input-group-sm>.form-control, select.input-group-sm>.input-group-addon,
		select.input-group-sm>.input-group-btn>.btn {
		height: 30px;
		line-height: 30px
	}
	
	select[multiple].input-group-sm>.form-control, select[multiple].input-group-sm>.input-group-addon,
		select[multiple].input-group-sm>.input-group-btn>.btn, textarea.input-group-sm>.form-control,
		textarea.input-group-sm>.input-group-addon, textarea.input-group-sm>.input-group-btn>.btn {
		height: auto
	}
	
	.input-group .form-control, .input-group-addon, .input-group-btn {
		display: table-cell
	}
	
	.input-group .form-control:not(:first-child):not(:last-child), 
		.input-group-addon:not(:first-child):not(:last-child),
		.input-group-btn:not(:first-child):not(:last-child) {
		border-radius: 0
	}
	
	.input-group-addon, .input-group-btn {
		width: 1%;
		white-space: nowrap;
		vertical-align: middle
	}
	
	.input-group-addon {
		padding: 6px 12px;
		font-size: 13px;
		font-weight: 400;
		line-height: 1;
		color: #555;
		text-align: center;
		background-color: #eee;
		border: 1px solid #ccc;
		border-radius: 3px
	}
	
	.form-horizontal .form-group-sm .input-group-addon.form-control,
		.input-group-addon.input-sm, .input-group-sm>.input-group-addon,
		.input-group-sm>.input-group-btn>.input-group-addon.btn {
		padding: 5px 10px;
		font-size: 12px;
		border-radius: 2px
	}
	
	.form-horizontal .form-group-lg .input-group-addon.form-control,
		.input-group-addon.input-lg, .input-group-lg>.input-group-addon,
		.input-group-lg>.input-group-btn>.input-group-addon.btn {
		padding: 10px 16px;
		font-size: 17px;
		border-radius: 4px
	}
	
	.input-group-addon input[type=checkbox], .input-group-addon input[type=radio] {
		margin-top: 0
	}
	
	.input-group .form-control:first-child, .input-group-addon:first-child,
		.input-group-btn:first-child>.btn, .input-group-btn:first-child>.btn-group>.btn,
		.input-group-btn:first-child>.dropdown-toggle, .input-group-btn:last-child>.btn-group:not(:last-child)>.btn,
		.input-group-btn:last-child>.btn:not(:last-child):not(.dropdown-toggle) {
		border-bottom-right-radius: 0;
		border-top-right-radius: 0
	}
	
	.input-group-addon:first-child {
		border-right: 0
	}
	
	.input-group .form-control:last-child, .input-group-addon:last-child,
		.input-group-btn:first-child>.btn-group:not (:first-child )>.btn,
		.input-group-btn:first-child>.btn:not (:first-child ),.input-group-btn:last-child>.btn,
		.input-group-btn:last-child>.btn-group>.btn, .input-group-btn:last-child>.dropdown-toggle {
		border-bottom-left-radius: 0;
		border-top-left-radius: 0
	}
	
	.input-group-addon:last-child {
		border-left: 0
	}
	
	.input-group-btn {
		position: relative;
		font-size: 0;
		white-space: nowrap
	}
	
	.input-group-btn>.btn {
		position: relative
	}
	
	.input-group-btn>.btn+.btn {
		margin-left: -1px
	}
	
	.input-group-btn>.btn:active, .input-group-btn>.btn:focus,
		.input-group-btn>.btn:hover {
		z-index: 2
	}
	
	.input-group-btn:first-child>.btn, .input-group-btn:first-child>.btn-group {
		margin-right: -1px
	}
	
	.input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group {
		margin-left: -1px
	}
	
	.nav {
		margin-bottom: 0;
		padding-left: 0;
		list-style: none
	}
	
	.nav:after, .nav:before {
		content: " ";
		display: table
	}
	
	.nav:after {
		clear: both
	}
	
	.nav>li {
		position: relative;
		display: block
	}
	
	.nav>li>a, .nav>li>span {
		position: relative;
		display: block;
		padding: 10px 15px
	}
	
	.nav>li.active>a {
		background-color: #94d7e4
	}
	
	.nav>li>a:focus, .nav>li>a:hover {
		text-decoration: none;
		background-color: #94d7e4
	}
	
	.nav>li.disabled>a {
		color: #777
	}
	
	.nav>li.disabled>a:focus, .nav>li.disabled>a:hover {
		color: #777;
		text-decoration: none;
		background-color: transparent;
		cursor: not-allowed
	}
	
	.nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
		background-color: #94d7e4;
		border-color: #0e377d
	}
	
	.nav .nav-divider {
		height: 1px;
		margin: 8px 0;
		overflow: hidden;
		background-color: #e5e5e5
	}
	
	.nav>li>a>img {
		max-width: none
	}
	
	.nav-tabs {
		border-bottom: 1px solid #94d7e4
	}
	
	.nav-tabs>li {
		float: left;
		margin-bottom: -1px
	}
	
	.nav-tabs>li>a {
		margin-right: 2px;
		line-height: 1.42857;
		border: 1px solid transparent;
		border-radius: 3px 3px 0 0
	}
	
	.nav-tabs>li>a:hover {
		border-color: #eee #eee #94d7e4
	}
	
	.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
		color: #555;
		background-color: #fff;
		border: 1px solid #94d7e4;
		border-bottom-color: transparent;
		cursor: default
	}
	
	.nav-tabs.nav-justified>.dropdown .dropdown-menu {
		top: auto;
		left: auto
	}
	
	.nav-pills>li {
		float: left
	}
	
	.nav-pills>li>a {
		border-radius: 3px
	}
	
	.nav-pills>li+li {
		margin-left: 2px
	}
	
	.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
		color: #fff;
		background-color: #0e377d
	}
	
	.nav-stacked>li {
		float: none
	}
	
	.nav-stacked>li+li {
		margin-top: 2px;
		margin-left: 0
	}
	
	.nav-justified, .nav-tabs.nav-justified {
		width: 100%
	}
	
	.nav-justified>li, .nav-tabs.nav-justified>li {
		float: none
	}
	
	.nav-justified>li>a, .nav-tabs.nav-justified>li>a {
		text-align: center;
		margin-bottom: 5px
	}
	
	.nav-justified>.dropdown .dropdown-menu {
		top: auto;
		left: auto
	}
	
	.nav-tabs-justified, .nav-tabs.nav-justified {
		border-bottom: 0
	}
	
	.nav-tabs-justified>li>a, .nav-tabs.nav-justified>li>a {
		margin-right: 0;
		border-radius: 3px
	}
	
	.nav-tabs-justified>.active>a, .nav-tabs-justified>.active>a:focus,
		.nav-tabs-justified>.active>a:hover, .nav-tabs.nav-justified>.active>a,
		.nav-tabs.nav-justified>.active>a:focus, .nav-tabs.nav-justified>.active>a:hover {
		border: 1px solid #94d7e4
	}
	
	.tab-content>.tab-pane {
		display: none
	}
	
	.tab-content>.active {
		display: block
	}
	
	.nav-tabs .dropdown-menu {
		margin-top: -1px;
		border-top-right-radius: 0;
		border-top-left-radius: 0
	}
	
	.nav-sidebar {
		margin-right: -15px;
		margin-bottom: 15px;
		margin-left: -15px
	}
	
	.nav-sidebar>li>a {
		padding-right: 15px;
		padding-left: 15px
	}
	
	.navbar {
		position: relative;
		min-height: 30px;
		margin-bottom: 18px;
		border: 1px solid transparent
	}
	
	.navbar:after, .navbar:before {
		content: " ";
		display: table
	}
	
	.navbar:after {
		clear: both
	}
	
	.navbar-header:after, .navbar-header:before {
		content: " ";
		display: table
	}
	
	.navbar-header:after {
		clear: both
	}
	
	.navbar-collapse {
		overflow-x: visible;
		padding-right: 15px;
		padding-left: 15px;
		border-top: 1px solid transparent;
	    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
		box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
		-webkit-overflow-scrolling: touch
	}
	
	.navbar-collapse:after, .navbar-collapse:before {
		content: " ";
		display: table
	}
	
	.navbar-collapse:after {
		clear: both
	}
	
	.navbar-collapse.in {
		overflow-y: auto
	}
	
	.navbar-fixed-bottom .navbar-collapse, .navbar-fixed-top .navbar-collapse {
		max-height: 340px
	}
	
	.container-fluid>.navbar-collapse, .container-fluid>.navbar-header,
		.container>.navbar-collapse, .container>.navbar-header {
		margin-right: -15px;
		margin-left: -15px
	}
	
	.navbar-static-top {
		z-index: 1000;
		border-width: 0 0 1px
	}
	
	.navbar-fixed-bottom, .navbar-fixed-top {
		position: fixed;
		right: 0;
		left: 0;
		z-index: 1030;
		-webkit-transform: translate3d(0, 0, 0);
		-o-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0)
	}
	
	.navbar-fixed-top {
		top: 0;
		border-width: 0 0 1px
	}
	
	.navbar-fixed-bottom {
		bottom: 0;
		margin-bottom: 0;
		border-width: 1px 0 0
	}
	
	.navbar-brand {
		float: left;
		padding: 0 15px;
		font-size: 18px;
		line-height: 30px;
		height: 30px
	}
	
	.navbar-brand:focus, .navbar-brand:hover {
		text-decoration: none
	}
	
	.navbar-brand img {
		margin-top: -3px
	}
	
	.navbar-toggle {
		position: absolute;
	    float: right;
	    padding: 4px 5px;
	    margin-top: 3px;
		margin-right: 15px;
		margin-bottom: 3px;
		background-color: transparent;
		background-image: none;
		border: 1px solid transparent;
		border-radius: 3px
	}
	
	.navbar-toggle:focus {
		outline: 0
	}
	
	.navbar-toggle .icon-bar {
		display: block;
		width: 22px;
		height: 2px;
		border-radius: 1px
	}
	
	.navbar-toggle .icon-bar+.icon-bar {
		margin-top: 4px
	}
	
	.navbar-nav {
		margin: 3px -15px
	}
	
	.navbar-nav>li>a, .navbar-nav>li>span {
		padding-top: 10px;
		padding-bottom: 10px;
		line-height: 18px
	}
	
	.navbar-form {
		margin: -1px -15px;
		padding: 10px 15px;
		border-top: 1px solid transparent;
		border-bottom: 1px solid transparent;
		-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1), 0 1px 0
			rgba(255, 255, 255, .1);
		box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1), 0 1px 0
			rgba(255, 255, 255, .1)
	}
	
	.navbar-nav>li>.dropdown-menu {
		margin-top: 0;
		border-top-right-radius: 0;
		border-top-left-radius: 0
	}
	
	.navbar-fixed-bottom .navbar-nav>li>.dropdown-menu {
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0
	}
	
	.navbar-btn {
		margin-top: -1px;
		margin-bottom: -1px
	}
	
	.btn-group-sm>.navbar-btn.btn, .navbar-btn.btn-sm {
		margin-top: 0;
		margin-bottom: 0
	}
	
	.btn-group-xs>.navbar-btn.btn, .navbar-btn.btn-xs {
		margin-top: 4px;
		margin-bottom: 4px
	}
	
	.navbar-text {
		margin-top: 6px;
		margin-bottom: 6px
	}
	
	.navbar-default {
		background-color: #a62c00;
		border-color: #852300
	}
	
	.navbar-default .navbar-brand {
		color: #fff;
		display: inline-block;
		height: 30px;
		line-height: 30px;
		padding: 0 15px
	}
	
	.navbar-default .navbar-brand:focus, .navbar-default .navbar-brand:hover {
		color: #e6e6e6;
		background-color: transparent
	}
	
	.navbar-default .navbar-nav>li>a, .navbar-default .navbar-nav>li>span,
		.navbar-default .navbar-text {
		color: #fff
	}
	
	.navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
		color: #333;
		background-color: transparent
	}
	
	.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus,
		.navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>span,
		.navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
		color: #fff;
		background-color: #852300
	}
	
	.navbar-default .navbar-nav>.disabled>a, .navbar-default .navbar-nav>.disabled>a:focus,
		.navbar-default .navbar-nav>.disabled>a:hover {
		color: #ccc;
		background-color: transparent
	}
	
	.navbar-default .navbar-toggle {
		border-color: #ddd
	}
	
	.navbar-default .navbar-toggle:focus, .navbar-default .navbar-toggle:hover {
		border-color: #822300;
		background-color: #8c2500
	}
	
	.navbar-default .navbar-toggle .icon-bar {
		background-color: #fff
	}
	
	.navbar-default .navbar-collapse, .navbar-default .navbar-form {
		border-color: #852300
	}
	
	.navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus,
		.navbar-default .navbar-nav>.open>a:hover {
		background-color: #852300;
		color: #fff
	}
	
	.navbar-default .btn-link, .navbar-default .btn-link:focus,
		.navbar-default .btn-link:hover, .navbar-default .navbar-link,
		.navbar-default .navbar-link:hover {
		color: #fff
	}
	
	.navbar-default .btn-link[disabled]:focus, .navbar-default .btn-link[disabled]:hover,
		fieldset[disabled] .navbar-default .btn-link:focus, fieldset[disabled] .navbar-default .btn-link:hover {
		color: #ccc
	}
	
	.navbar-inverse {
		background-color: #222;
		border-color: #090909
	}
	
	.navbar-inverse .navbar-brand {
		color: #777
	}
	
	.navbar-inverse .navbar-brand:focus, .navbar-inverse .navbar-brand:hover {
		color: #fff;
		background-color: transparent
	}
	
	.navbar-inverse .navbar-nav>li>a, .navbar-inverse .navbar-text {
		color: #777
	}
	
	.navbar-inverse .navbar-nav>li>a:focus, .navbar-inverse .navbar-nav>li>a:hover {
		color: #fff;
		background-color: transparent
	}
	
	.navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:focus,
		.navbar-inverse .navbar-nav>.active>a:hover {
		color: #fff;
		background-color: #090909
	}
	
	.navbar-inverse .navbar-nav>.disabled>a, .navbar-inverse .navbar-nav>.disabled>a:focus,
		.navbar-inverse .navbar-nav>.disabled>a:hover {
		color: #444;
		background-color: transparent
	}
	
	.navbar-inverse .navbar-toggle {
		border-color: #333
	}
	
	.navbar-inverse .navbar-toggle:focus, .navbar-inverse .navbar-toggle:hover {
		background-color: #333
	}
	
	.navbar-inverse .navbar-toggle .icon-bar {
		background-color: #fff
	}
	
	.navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form {
		border-color: #101010
	}
	
	.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus,
		.navbar-inverse .navbar-nav>.open>a:hover {
		background-color: #090909;
		color: #fff
	}
	
	.navbar-inverse .navbar-link {
		color: #777
	}
	
	.navbar-inverse .navbar-link:hover {
		color: #fff
	}
	
	.navbar-inverse .btn-link {
		color: #777
	}
	
	.navbar-inverse .btn-link:focus, .navbar-inverse .btn-link:hover {
		color: #fff
	}
	
	.navbar-inverse .btn-link[disabled]:focus, .navbar-inverse .btn-link[disabled]:hover,
		fieldset[disabled] .navbar-inverse .btn-link:focus, fieldset[disabled] .navbar-inverse .btn-link:hover {
		color: #444
	}
	
	.navbar-top {
		margin-bottom: 0;
		border-radius: 0;
		border-width: 1px 0
	}
	
	.breadcrumb {
		padding: 8px 15px;
		margin-bottom: 18px;
		list-style: none;
		background-color: #f5f5f5;
		border-radius: 3px
	}
	
	.breadcrumb>li {
		display: inline-block
	}
	
	.breadcrumb>li+li:before {
		content: "/ ";
		padding: 0 5px;
		color: #ccc
	}
	
	.breadcrumb>.active {
		color: #777
	}
	
	.pagination {
		display: inline-block;
		padding-left: 0;
		margin: 18px 0;
		border-radius: 3px
	}
	
	.pagination>li {
		display: inline
	}
	
	.pagination>li>a, .pagination>li>span {
		position: relative;
		float: left;
		padding: 6px 12px;
		line-height: 1.42857;
		text-decoration: none;
		color: #0e377d;
		background-color: #fff;
		border: 1px solid #94d7e4;
		margin-left: -1px
	}
	
	.pagination>li:first-child>a, .pagination>li:first-child>span {
		margin-left: 0;
		border-bottom-left-radius: 3px;
		border-top-left-radius: 3px
	}
	
	.pagination>li:last-child>a, .pagination>li:last-child>span {
		border-bottom-right-radius: 3px;
		border-top-right-radius: 3px
	}
	
	.pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus,
		.pagination>li>span:hover {
		color: #061938;
		background-color: #eee;
		border-color: #94d7e4
	}
	
	.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover,
		.pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
		z-index: 2;
		color: #fff;
		background-color: #0e377d;
		border-color: #0e377d;
		cursor: default
	}
	
	.pagination>.disabled>a, .pagination>.disabled>a:focus, .pagination>.disabled>a:hover,
		.pagination>.disabled>span, .pagination>.disabled>span:focus,
		.pagination>.disabled>span:hover {
		color: #777;
		background-color: #fff;
		border-color: #94d7e4;
		cursor: not-allowed
	}
	
	.pagination-lg>li>a, .pagination-lg>li>span {
		padding: 10px 16px;
		font-size: 17px
	}
	
	.pagination-lg>li:first-child>a, .pagination-lg>li:first-child>span {
		border-bottom-left-radius: 4px;
		border-top-left-radius: 4px
	}
	
	.pagination-lg>li:last-child>a, .pagination-lg>li:last-child>span {
		border-bottom-right-radius: 4px;
		border-top-right-radius: 4px
	}
	
	.pagination-sm>li>a, .pagination-sm>li>span {
		padding: 5px 10px;
		font-size: 12px
	}
	
	.pagination-sm>li:first-child>a, .pagination-sm>li:first-child>span {
		border-bottom-left-radius: 2px;
		border-top-left-radius: 2px
	}
	
	.pagination-sm>li:last-child>a, .pagination-sm>li:last-child>span {
		border-bottom-right-radius: 2px;
		border-top-right-radius: 2px
	}
	
	.pager {
		padding-left: 0;
		margin: 18px 0;
		list-style: none;
		text-align: center
	}
	
	.pager:after, .pager:before {
		content: " ";
		display: table
	}
	
	.pager:after {
		clear: both
	}
	
	.pager li {
		display: inline
	}
	
	.pager li>a, .pager li>span {
		display: inline-block;
		padding: 5px 14px;
		background-color: #fff;
		border: 1px solid #94d7e4;
		border-radius: 15px
	}
	
	.pager li>a:focus, .pager li>a:hover {
		text-decoration: none;
		background-color: #eee
	}
	
	.pager .next>a, .pager .next>span {
		float: right
	}
	
	.pager .previous>a, .pager .previous>span {
		float: left
	}
	
	.pager .disabled>a, .pager .disabled>a:focus, .pager .disabled>a:hover,
		.pager .disabled>span {
		color: #777;
		background-color: #fff;
		cursor: not-allowed
	}
	
	.label {
		display: inline;
		padding: .2em .6em .3em;
		font-size: 75%;
		font-weight: 700;
		line-height: 1;
		color: #fff;
		text-align: center;
		white-space: nowrap;
		vertical-align: baseline;
		border-radius: .25em
	}
	
	a.label:focus, a.label:hover {
		color: #fff;
		text-decoration: none;
		cursor: pointer
	}
	
	.label:empty {
		display: none
	}
	
	.btn .label {
		position: relative;
		top: -1px
	}
	
	.label-default {
		background-color: #777
	}
	
	.label-default[href]:focus, .label-default[href]:hover {
		background-color: #5e5e5e
	}
	
	.label-primary {
		background-color: #0e377d
	}
	
	.label-primary[href]:focus, .label-primary[href]:hover {
		background-color: #09234f
	}
	
	.label-success {
		background-color: #5cb85c
	}
	
	.label-success[href]:focus, .label-success[href]:hover {
		background-color: #449d44
	}
	
	.label-info {
		background-color: #94d7e4
	}
	
	.label-info[href]:focus, .label-info[href]:hover {
		background-color: #6bc8da
	}
	
	.label-warning {
		background-color: #f0ad4e
	}
	
	.label-warning[href]:focus, .label-warning[href]:hover {
		background-color: #ec971f
	}
	
	.label-danger {
		background-color: #a62c00
	}
	
	.label-danger[href]:focus, .label-danger[href]:hover {
		background-color: #731e00
	}
	
	.badge {
		display: inline-block;
		min-width: 10px;
		padding: 3px 7px;
		font-size: 12px;
		font-weight: 700;
		color: #fff;
		line-height: 1;
		vertical-align: baseline;
		white-space: nowrap;
		text-align: center;
		background-color: #777;
		border-radius: 10px
	}
	
	.badge:empty {
		display: none
	}
	
	.btn .badge {
		position: relative;
		top: -1px
	}
	
	.btn-group-xs>.btn .badge, .btn-xs .badge {
		top: 0;
		padding: 1px 5px
	}
	
	a.badge:focus, a.badge:hover {
		color: #fff;
		text-decoration: none;
		cursor: pointer
	}
	
	.nav-pills>.active>a>.badge, a.list-group-item.active>.badge {
		color: #0e377d;
		background-color: #fff
	}
	
	.nav-pills>li>a>.badge {
		margin-left: 3px
	}
	
	.jumbotron {
		padding: 30px;
		margin-bottom: 30px;
		color: inherit;
		background-color: #eee
	}
	
	.jumbotron .h1, .jumbotron h1 {
		color: inherit
	}
	
	.jumbotron p {
		margin-bottom: 15px;
		font-size: 21px;
		font-weight: 200
	}
	
	.jumbotron>hr {
		border-top-color: #d5d5d5
	}
	
	.container .jumbotron {
		border-radius: 6px
	}
	
	.jumbotron .container {
		max-width: 100%
	}
	
	.thumbnail {
		display: block;
		padding: 4px;
		margin-bottom: 18px;
		line-height: 1.42857;
		background-color: #fff;
		border: 1px solid #94d7e4;
		border-radius: 3px;
		-webkit-transition: all .2s ease-in-out;
		-o-transition: all .2s ease-in-out;
		transition: all .2s ease-in-out
	}
	
	.thumbnail a>img, .thumbnail>img {
		display: block;
		max-width: 100%;
		height: auto;
		margin-left: auto;
		margin-right: auto
	}
	
	.thumbnail .caption {
		padding: 9px;
		color: #333
	}
	
	a.thumbnail.active, a.thumbnail:focus, a.thumbnail:hover {
		border-color: #0e377d
	}
	
	.alert {
		padding: 15px;
		margin-bottom: 18px;
		border: 1px solid transparent;
		border-radius: 3px
	}
	
	.alert h4 {
		margin-top: 0;
		color: inherit
	}
	
	.alert .alert-link {
		font-weight: 700
	}
	
	.alert>p, .alert>ul {
		margin-bottom: 0
	}
	
	.alert>p+p {
		margin-top: 5px
	}
	
	.alert-dismissable, .alert-dismissible {
		padding-right: 35px
	}
	
	.alert-dismissable .close, .alert-dismissible .close {
		position: relative;
		top: -2px;
		right: -21px;
		color: inherit
	}
	
	.alert-success {
		background-color: #dff0d8;
		border-color: #d6e9c6;
		color: #3c763d
	}
	
	.alert-success hr {
		border-top-color: #c9e2b3
	}
	
	.alert-success .alert-link {
		color: #2b542c
	}
	
	.alert-info {
		background-color: #d9edf7;
		border-color: #bce8f1;
		color: #31708f
	}
	
	.alert-info hr {
		border-top-color: #a6e1ec
	}
	
	.alert-info .alert-link {
		color: #245269
	}
	
	.alert-warning {
		background-color: #fcf8e3;
		border-color: #faebcc;
		color: #8a6d3b
	}
	
	.alert-warning hr {
		border-top-color: #f7e1b5
	}
	
	.alert-warning .alert-link {
		color: #66512c
	}
	
	.alert-danger {
		background-color: #f2dede;
		border-color: #ebccd1;
		color: #a94442
	}
	
	.alert-danger hr {
		border-top-color: #e4b9c0
	}
	
	.alert-danger .alert-link {
		color: #843534
	}
	
	@-webkit-keyframes progress-bar-stripes {
		from {
			background-position: 40px 0
		}
		to {
			background-position: 0 0
		}
	}
	
	@keyframes progress-bar-stripes {
		from {
			background-position: 40px 0
		}
		to {
			background-position: 0 0
		}
	}
	
	@-o-keyframes progress-bar-stripes {
		from {
			background-position: 40px 0
		}
		to {
			background-position: 0 0
		}
	}
	
	.progress {
		overflow: hidden;
		height: 18px;
		margin-bottom: 18px;
		background-color: #f5f5f5;
		border-radius: 3px;
		-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
		box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1)
	}
	
	.progress-bar {
		float: left;
		width: 0;
		height: 100%;
		font-size: 12px;
		line-height: 18px;
		color: #fff;
		text-align: center;
		background-color: #0e377d;
		-webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
		box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
		-webkit-transition: width .6s ease;
		-o-transition: width .6s ease;
		transition: width .6s ease
	}
	
	.progress-bar-striped, .progress-striped .progress-bar {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15)
			25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%,
			transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%,
			transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		-webkit-background-size: 40px 40px;
		background-size: 40px 40px
	}
	
	.progress-bar.active, .progress.active .progress-bar {
		-webkit-animation: progress-bar-stripes 2s linear infinite;
		-o-animation: progress-bar-stripes 2s linear infinite;
		animation: progress-bar-stripes 2s linear infinite
	}
	
	.progress-bar[aria-valuenow="1"], .progress-bar[aria-valuenow="2"] {
		min-width: 30px
	}
	
	.progress-bar[aria-valuenow="0"] {
		color: #777;
		min-width: 30px;
		background-color: transparent;
		background-image: none;
		-webkit-box-shadow: none;
		box-shadow: none
	}
	
	.progress-bar-success {
		background-color: #5cb85c
	}
	
	.progress-striped .progress-bar-success {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15)
			25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%,
			transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%,
			transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent)
	}
	
	.progress-bar-info {
		background-color: #94d7e4
	}
	
	.progress-striped .progress-bar-info {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15)
			25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%,
			transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%,
			transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent)
	}
	
	.progress-bar-warning {
		background-color: #f0ad4e
	}
	
	.progress-striped .progress-bar-warning {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15)
			25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%,
			transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%,
			transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent)
	}
	
	.progress-bar-danger {
		background-color: #a62c00
	}
	
	.progress-striped .progress-bar-danger {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15)
			25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%,
			transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%,
			transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%,
			rgba(255, 255, 255, .15) 75%, transparent 75%, transparent)
	}
	
	.media, .media-body {
		overflow: hidden;
		zoom: 1
	}
	
	.media, .media .media {
		margin-top: 15px
	}
	
	.media:first-child {
		margin-top: 0
	}
	
	.media-object {
		display: block
	}
	
	.media-heading {
		margin: 0 0 5px
	}
	
	.media>.pull-left {
		margin-right: 10px
	}
	
	.media>.pull-right {
		margin-left: 10px
	}
	
	.media-list {
		padding-left: 0;
		list-style: none
	}
	
	.list-group {
		margin-bottom: 20px;
		padding-left: 0
	}
	
	.list-group-item {
		position: relative;
		display: block;
		padding: 7px 15px;
		margin-bottom: -1px;
		background-color: #fff;
		border: 1px solid #94d7e4
	}
	
	.list-group-item:first-child {
		border-top-right-radius: 3px;
		border-top-left-radius: 3px
	}
	
	.list-group-item:last-child {
		margin-bottom: 0;
		border-bottom-right-radius: 3px;
		border-bottom-left-radius: 3px
	}
	
	.list-group-item>.badge {
		float: right
	}
	
	.list-group-item>.badge+.badge {
		margin-right: 5px
	}
	
	a.list-group-item {
		color: #555
	}
	
	a.list-group-item .list-group-item-heading {
		color: #333
	}
	
	a.list-group-item:focus, a.list-group-item:hover {
		text-decoration: none;
		color: #555;
		background-color: #f5f5f5
	}
	
	.list-group-item.disabled, .list-group-item.disabled:focus,
		.list-group-item.disabled:hover {
		background-color: #eee;
		color: #777
	}
	
	.list-group-item.disabled .list-group-item-heading, .list-group-item.disabled:focus .list-group-item-heading,
		.list-group-item.disabled:hover .list-group-item-heading {
		color: inherit
	}
	
	.list-group-item.disabled .list-group-item-text, .list-group-item.disabled:focus .list-group-item-text,
		.list-group-item.disabled:hover .list-group-item-text {
		color: #777
	}
	
	.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
		z-index: 2;
		color: #fff;
		background-color: #0e377d;
		border-color: #0e377d
	}
	
	.list-group-item.active .list-group-item-heading, .list-group-item.active .list-group-item-heading>.small,
		.list-group-item.active .list-group-item-heading>small,
		.list-group-item.active:focus .list-group-item-heading,
		.list-group-item.active:focus .list-group-item-heading>.small,
		.list-group-item.active:focus .list-group-item-heading>small,
		.list-group-item.active:hover .list-group-item-heading,
		.list-group-item.active:hover .list-group-item-heading>.small,
		.list-group-item.active:hover .list-group-item-heading>small {
		color: inherit
	}
	
	.list-group-item.active .list-group-item-text, .list-group-item.active:focus .list-group-item-text,
		.list-group-item.active:hover .list-group-item-text {
		color: #699aee
	}
	
	.list-group-item-success {
		color: #3c763d;
		background-color: #dff0d8
	}
	
	a.list-group-item-success {
		color: #3c763d
	}
	
	a.list-group-item-success .list-group-item-heading {
		color: inherit
	}
	
	a.list-group-item-success:focus, a.list-group-item-success:hover {
		color: #3c763d;
		background-color: #d0e9c6
	}
	
	a.list-group-item-success.active, a.list-group-item-success.active:focus,
		a.list-group-item-success.active:hover {
		color: #fff;
		background-color: #3c763d;
		border-color: #3c763d
	}
	
	.list-group-item-info {
		color: #31708f;
		background-color: #d9edf7
	}
	
	a.list-group-item-info {
		color: #31708f
	}
	
	a.list-group-item-info .list-group-item-heading {
		color: inherit
	}
	
	a.list-group-item-info:focus, a.list-group-item-info:hover {
		color: #31708f;
		background-color: #c4e3f3
	}
	
	a.list-group-item-info.active, a.list-group-item-info.active:focus, a.list-group-item-info.active:hover {
		color: #fff;
		background-color: #31708f;
		border-color: #31708f
	}
	
	.list-group-item-warning {
		color: #8a6d3b;
		background-color: #fcf8e3
	}
	
	a.list-group-item-warning {
		color: #8a6d3b
	}
	
	a.list-group-item-warning .list-group-item-heading {
		color: inherit
	}
	
	a.list-group-item-warning:focus, a.list-group-item-warning:hover {
		color: #8a6d3b;
		background-color: #faf2cc
	}
	
	a.list-group-item-warning.active, a.list-group-item-warning.active:focus,
		a.list-group-item-warning.active:hover {
		color: #fff;
		background-color: #8a6d3b;
		border-color: #8a6d3b
	}
	
	.list-group-item-danger {
		color: #a94442;
		background-color: #f2dede
	}
	
	a.list-group-item-danger {
		color: #a94442
	}
	
	a.list-group-item-danger .list-group-item-heading {
		color: inherit
	}
	
	a.list-group-item-danger:focus, a.list-group-item-danger:hover {
		color: #a94442;
		background-color: #ebcccc
	}
	
	a.list-group-item-danger.active, a.list-group-item-danger.active:focus,
		a.list-group-item-danger.active:hover {
		color: #fff;
		background-color: #a94442;
		border-color: #a94442
	}
	
	.list-group-item-heading {
		margin-top: 0;
		margin-bottom: 5px
	}
	
	.list-group-item-text {
		margin-bottom: 0;
		line-height: 1.3
	}
	
	.panel {
		margin-bottom: 18px;
		background-color: #fff;
		border: 1px solid transparent;
		border-radius: 3px;
		-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
		box-shadow: 0 1px 1px rgba(0, 0, 0, .05)
	}
	
	.panel-body {
		padding: 10px 15px 0
	}
	
	.panel-body:after, .panel-body:before {
		content: " ";
		display: table
	}
	
	.panel-body:after {
		clear: both
	}
	
	.panel-heading {
		padding: 7px 15px;
		border-bottom: 2px solid #0e377d;
		border-top-right-radius: 2px;
		border-top-left-radius: 2px
	}
	
	.panel-heading>.dropdown .dropdown-toggle {
		color: inherit
	}
	
	.panel-title {
		margin-top: 0;
		margin-bottom: 0;
		font-size: 16px;
		color: inherit
	}
	
	.panel-title>a {
		color: inherit
	}
	
	.panel-footer {
		padding: 7px 15px;
		background-color: #f5f5f5;
		border-top: 1px solid #94d7e4;
		border-bottom-right-radius: 2px;
		border-bottom-left-radius: 2px
	}
	
	.panel>.list-group {
		margin-bottom: 0
	}
	
	.panel>.list-group .list-group-item {
		border-width: 1px 0;
		border-radius: 0
	}
	
	.panel>.list-group:first-child .list-group-item:first-child {
		border-top: 0;
		border-top-right-radius: 2px;
		border-top-left-radius: 2px
	}
	
	.panel>.list-group:last-child .list-group-item:last-child {
		border-bottom: 0;
		border-bottom-right-radius: 2px;
		border-bottom-left-radius: 2px
	}
	
	.list-group+.panel-footer, .panel-heading+.list-group .list-group-item:first-child {
		border-top-width: 0
	}
	
	.panel>.panel-collapse>.table, .panel>.table, .panel>.table-responsive>.table {
		margin-bottom: 0
	}
	
	.panel>.table-responsive:first-child>.table:first-child, .panel>.table:first-child {
		border-top-right-radius: 2px;
		border-top-left-radius: 2px
	}
	
	.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child td:first-child,
		.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child th:first-child,
		.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child td:first-child,
		.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child th:first-child,
		.panel>.table:first-child>tbody:first-child>tr:first-child td:first-child,
		.panel>.table:first-child>tbody:first-child>tr:first-child th:first-child,
		.panel>.table:first-child>thead:first-child>tr:first-child td:first-child,
		.panel>.table:first-child>thead:first-child>tr:first-child th:first-child {
		border-top-left-radius: 2px
	}
	
	.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child td:last-child,
		.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child th:last-child,
		.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child td:last-child,
		.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child th:last-child,
		.panel>.table:first-child>tbody:first-child>tr:first-child td:last-child,
		.panel>.table:first-child>tbody:first-child>tr:first-child th:last-child,
		.panel>.table:first-child>thead:first-child>tr:first-child td:last-child,
		.panel>.table:first-child>thead:first-child>tr:first-child th:last-child {
		border-top-right-radius: 2px
	}
	
	.panel>.table-responsive:last-child>.table:last-child, .panel>.table:last-child {
		border-bottom-right-radius: 2px;
		border-bottom-left-radius: 2px
	}
	
	.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child td:first-child,
		.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child th:first-child,
		.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child td:first-child,
		.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child th:first-child,
		.panel>.table:last-child>tbody:last-child>tr:last-child td:first-child,
		.panel>.table:last-child>tbody:last-child>tr:last-child th:first-child,
		.panel>.table:last-child>tfoot:last-child>tr:last-child td:first-child,
		.panel>.table:last-child>tfoot:last-child>tr:last-child th:first-child {
		border-bottom-left-radius: 2px
	}
	
	.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child td:last-child,
		.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child th:last-child,
		.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child td:last-child,
		.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child th:last-child,
		.panel>.table:last-child>tbody:last-child>tr:last-child td:last-child,
		.panel>.table:last-child>tbody:last-child>tr:last-child th:last-child,
		.panel>.table:last-child>tfoot:last-child>tr:last-child td:last-child,
		.panel>.table:last-child>tfoot:last-child>tr:last-child th:last-child {
		border-bottom-right-radius: 2px
	}
	
	.panel>.panel-body+.table, .panel>.panel-body+.table-responsive {
		border-top: 1px solid #94d7e4
	}
	
	.panel>.table>tbody:first-child>tr:first-child td, .panel>.table>tbody:first-child>tr:first-child th {
		border-top: 0
	}
	
	.panel>.table-bordered, .panel>.table-responsive>.table-bordered {
		border: 0
	}
	
	.panel>.table-bordered>tbody>tr>td:first-child, .panel>.table-bordered>tbody>tr>th:first-child,
		.panel>.table-bordered>tfoot>tr>td:first-child, .panel>.table-bordered>tfoot>tr>th:first-child,
		.panel>.table-bordered>thead>tr>td:first-child, .panel>.table-bordered>thead>tr>th:first-child,
		.panel>.table-responsive>.table-bordered>tbody>tr>td:first-child,
		.panel>.table-responsive>.table-bordered>tbody>tr>th:first-child,
		.panel>.table-responsive>.table-bordered>tfoot>tr>td:first-child,
		.panel>.table-responsive>.table-bordered>tfoot>tr>th:first-child,
		.panel>.table-responsive>.table-bordered>thead>tr>td:first-child,
		.panel>.table-responsive>.table-bordered>thead>tr>th:first-child {
		border-left: 0
	}
	
	.panel>.table-bordered>tbody>tr>td:last-child, .panel>.table-bordered>tbody>tr>th:last-child,
		.panel>.table-bordered>tfoot>tr>td:last-child, .panel>.table-bordered>tfoot>tr>th:last-child,
		.panel>.table-bordered>thead>tr>td:last-child, .panel>.table-bordered>thead>tr>th:last-child,
		.panel>.table-responsive>.table-bordered>tbody>tr>td:last-child, .panel>.table-responsive>.table-bordered>tbody>tr>th:last-child,
		.panel>.table-responsive>.table-bordered>tfoot>tr>td:last-child, .panel>.table-responsive>.table-bordered>tfoot>tr>th:last-child,
		.panel>.table-responsive>.table-bordered>thead>tr>td:last-child, .panel>.table-responsive>.table-bordered>thead>tr>th:last-child {
		border-right: 0
	}
	
	.panel>.table-bordered>tbody>tr:first-child>td, .panel>.table-bordered>tbody>tr:first-child>th,
		.panel>.table-bordered>tbody>tr:last-child>td, .panel>.table-bordered>tbody>tr:last-child>th,
		.panel>.table-bordered>tfoot>tr:last-child>td, .panel>.table-bordered>tfoot>tr:last-child>th,
		.panel>.table-bordered>thead>tr:first-child>td, .panel>.table-bordered>thead>tr:first-child>th,
		.panel>.table-responsive>.table-bordered>tbody>tr:first-child>td,
		.panel>.table-responsive>.table-bordered>tbody>tr:first-child>th,
		.panel>.table-responsive>.table-bordered>tbody>tr:last-child>td, .panel>.table-responsive>.table-bordered>tbody>tr:last-child>th,
		.panel>.table-responsive>.table-bordered>tfoot>tr:last-child>td, .panel>.table-responsive>.table-bordered>tfoot>tr:last-child>th,
		.panel>.table-responsive>.table-bordered>thead>tr:first-child>td,
		.panel>.table-responsive>.table-bordered>thead>tr:first-child>th {
		border-bottom: 0
	}
	
	.panel>.table-responsive {
		border: 0;
		margin-bottom: 0
	}
	
	.panel-group {
		margin-bottom: 18px
	}
	
	.panel-group .panel {
		margin-bottom: 0;
		border-radius: 3px
	}
	
	.panel-group .panel+.panel {
		margin-top: 5px
	}
	
	.panel-group .panel-heading {
		border-bottom: 0
	}
	
	.panel-group .panel-heading+.panel-collapse>.panel-body {
		border-top: 1px solid #94d7e4
	}
	
	.panel-group .panel-footer {
		border-top: 0
	}
	
	.panel-group .panel-footer+.panel-collapse .panel-body {
		border-bottom: 1px solid #94d7e4
	}
	
	.panel-default {
		border-color: #94d7e4
	}
	
	.panel-default>.panel-heading {
		color: #333;
		background-color: #f5f5f5;
		border-color: #94d7e4
	}
	
	.panel-default>.panel-heading+.panel-collapse>.panel-body {
		border-top-color: #94d7e4
	}
	
	.panel-default>.panel-heading .badge {
		color: #f5f5f5;
		background-color: #333
	}
	
	.panel-default>.panel-footer+.panel-collapse>.panel-body {
		border-bottom-color: #94d7e4
	}
	
	.panel-primary {
		border-color: #94d7e4
	}
	
	.panel-primary>.panel-heading {
		color: #fff;
		background-color: #0e377d;
		border-color: #94d7e4
	}
	
	.panel-primary>.panel-heading+.panel-collapse>.panel-body {
		border-top-color: #94d7e4
	}
	
	.panel-primary>.panel-heading .badge {
		color: #0e377d;
		background-color: #fff
	}
	
	.panel-primary>.panel-footer+.panel-collapse>.panel-body {
		border-bottom-color: #94d7e4
	}
	
	.panel-success {
		border-color: #94d7e4
	}
	
	.panel-success>.panel-heading {
		color: #fff;
		background-color: #5cb85c;
		border-color: #94d7e4
	}
	
	.panel-success>.panel-heading+.panel-collapse>.panel-body {
		border-top-color: #94d7e4
	}
	
	.panel-success>.panel-heading .badge {
		color: #5cb85c;
		background-color: #fff
	}
	
	.panel-success>.panel-footer+.panel-collapse>.panel-body {
		border-bottom-color: #94d7e4
	}
	
	.panel-info {
		border-color: #94d7e4
	}
	
	.panel-info>.panel-heading {
		color: #fff;
		background-color: #94d7e4;
		border-color: #0e377d
	}
	
	.panel-info>.panel-heading+.panel-collapse>.panel-body {
		border-top-color: #94d7e4
	}
	
	.panel-info>.panel-heading .badge {
		color: #94d7e4;
		background-color: #fff
	}
	
	.panel-info>.panel-footer+.panel-collapse>.panel-body {
		border-bottom-color: #94d7e4
	}
	
	.panel-warning {
		border-color: #94d7e4
	}
	
	.panel-warning>.panel-heading {
		color: #fff;
		background-color: #f0ad4e;
		border-color: #94d7e4
	}
	
	.panel-warning>.panel-heading+.panel-collapse>.panel-body {
		border-top-color: #94d7e4
	}
	
	.panel-warning>.panel-heading .badge {
		color: #f0ad4e;
		background-color: #fff
	}
	
	.panel-warning>.panel-footer+.panel-collapse>.panel-body {
		border-bottom-color: #94d7e4
	}
	
	.panel-danger {
		border-color: #94d7e4
	}
	
	.panel-danger>.panel-heading {
		color: #fff;
		background-color: #a62c00;
		border-color: #94d7e4
	}
	
	.panel-danger>.panel-heading+.panel-collapse>.panel-body {
		border-top-color: #94d7e4
	}
	
	.panel-danger>.panel-heading .badge {
		color: #a62c00;
		background-color: #fff
	}
	
	.panel-danger>.panel-footer+.panel-collapse>.panel-body {
		border-bottom-color: #94d7e4
	}
	
	.embed-responsive {
		position: relative;
		display: block;
		height: 0;
		padding: 0;
		overflow: hidden
	}
	
	.embed-responsive .embed-responsive-item, .embed-responsive embed,
		.embed-responsive iframe, .embed-responsive object {
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		height: 100%;
		width: 100%;
		border: 0
	}
	
	.embed-responsive.embed-responsive-16by9 {
		padding-bottom: 56.25%
	}
	
	.embed-responsive.embed-responsive-4by3 {
		padding-bottom: 75%
	}
	
	.well {
		min-height: 20px;
		padding: 19px;
		margin-bottom: 20px;
		background-color: #f5f5f5;
		border: 1px solid #e3e3e3;
		border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05)
	}
	
	.well blockquote {
		border-color: #ddd;
		border-color: rgba(0, 0, 0, .15)
	}
	
	.well-lg {
		padding: 24px;
		border-radius: 6px
	}
	
	.well-sm {
		padding: 9px;
		border-radius: 3px
	}
	
	.close {
		float: right;
		font-size: 19.5px;
		font-weight: 700;
		line-height: 1;
		color: #000;
		text-shadow: 0 1px 0 #fff;
		opacity: .2;
		filter: alpha(opacity = 20)
	}
	
	.close:focus, .close:hover {
		color: #000;
		text-decoration: none;
		cursor: pointer;
		opacity: .5;
		filter: alpha(opacity = 50)
	}
	
	button.close {
		padding: 0;
		cursor: pointer;
		background: 0;
		border: 0;
		-webkit-appearance: none
	}
	
	.modal-open {
		overflow: hidden
	}
	
	.modal {
		display: none;
		overflow: hidden;
		position: fixed;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		z-index: 1050;
		-webkit-overflow-scrolling: touch;
		outline: 0
	}
	
	.modal.fade .modal-dialog {
		-webkit-transform: translate3d(0, -25%, 0);
	    -o-transform: translate3d(0, -25%, 0);
		transform: translate3d(0, -25%, 0);
		-webkit-transition: -webkit-transform .3s ease-out;
	    -o-transition: -o-transform .3s ease-out;
		transition: transform .3s ease-out
	}
	
	.modal.in .modal-dialog {
		-webkit-transform: translate3d(0, 0, 0);
		-o-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0)
	}
	
	.modal-open .modal {
		overflow-x: hidden;
		overflow-y: auto
	}
	
	.modal-dialog {
		position: relative;
		width: auto;
		margin: 10px
	}
	
	.modal-content {
		position: relative;
		background-color: #fff;
		border: 1px solid #999;
		border: 1px solid rgba(0, 0, 0, .2);
		border-radius: 4px;
	    -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
		box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
	    -webkit-background-clip: padding-box;
		background-clip: padding-box;
		outline: 0
	}
	
	.modal-backdrop {
		position: fixed;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		z-index: 1040;
		background-color: #000
	}
	
	.modal-backdrop.fade {
		opacity: 0;
		filter: alpha(opacity = 0)
	}
	
	.modal-backdrop.in {
		opacity: .5;
		filter: alpha(opacity = 50)
	}
	
	.modal-header {
		padding: 15px;
		border-bottom: 1px solid #e5e5e5;
		min-height: 16.43px
	}
	
	.modal-header .close {
		margin-top: -2px
	}
	
	.modal-title {
		margin: 0;
		line-height: 1.42857
	}
	
	.modal-body {
		position: relative;
		padding: 15px
	}
	
	.modal-footer {
		padding: 15px;
		text-align: right;
		border-top: 1px solid #e5e5e5
	}
	
	.modal-footer:after, .modal-footer:before {
		content: " ";
		display: table
	}
	
	.modal-footer:after {
		clear: both
	}
	
	.modal-footer .btn+.btn {
		margin-left: 5px;
		margin-bottom: 0
	}
	
	.modal-footer .btn-group .btn+.btn {
		margin-left: -1px
	}
	
	.modal-footer .btn-block+.btn-block {
		margin-left: 0
	}
	
	.modal-scrollbar-measure {
		position: absolute;
		top: -9999px;
		width: 50px;
		height: 50px;
		overflow: scroll
	}
	
	.tooltip {
		position: absolute;
		z-index: 1070;
		display: block;
		visibility: visible;
		font-size: 12px;
		line-height: 1.4;
		opacity: 0;
		filter: alpha(opacity = 0)
	}
	
	.tooltip.in {
		opacity: .9;
		filter: alpha(opacity = 90)
	}
	
	.tooltip.top {
		margin-top: -3px;
		padding: 5px 0
	}
	
	.tooltip.right {
		margin-left: 3px;
		padding: 0 5px
	}
	
	.tooltip.bottom {
		margin-top: 3px;
		padding: 5px 0
	}
	
	.tooltip.left {
		margin-left: -3px;
		padding: 0 5px
	}
	
	.tooltip-inner {
		max-width: 200px;
		padding: 3px 8px;
		color: #fff;
		text-align: center;
		text-decoration: none;
		background-color: #000;
		border-radius: 3px
	}
	
	.tooltip-arrow {
		position: absolute;
		width: 0;
		height: 0;
		border-color: transparent;
		border-style: solid
	}
	
	.tooltip.top .tooltip-arrow {
		bottom: 0;
		left: 50%;
		margin-left: -5px;
		border-width: 5px 5px 0;
		border-top-color: #000
	}
	
	.tooltip.top-left .tooltip-arrow {
		bottom: 0;
		left: 5px;
		border-width: 5px 5px 0;
		border-top-color: #000
	}
	
	.tooltip.top-right .tooltip-arrow {
		bottom: 0;
		right: 5px;
		border-width: 5px 5px 0;
		border-top-color: #000
	}
	
	.tooltip.right .tooltip-arrow {
		top: 50%;
		left: 0;
		margin-top: -5px;
		border-width: 5px 5px 5px 0;
		border-right-color: #000
	}
	
	.tooltip.left .tooltip-arrow {
		top: 50%;
		right: 0;
		margin-top: -5px;
		border-width: 5px 0 5px 5px;
		border-left-color: #000
	}
	
	.tooltip.bottom .tooltip-arrow {
		top: 0;
		left: 50%;
		margin-left: -5px;
		border-width: 0 5px 5px;
		border-bottom-color: #000
	}
	
	.tooltip.bottom-left .tooltip-arrow {
		top: 0;
		left: 5px;
		border-width: 0 5px 5px;
		border-bottom-color: #000
	}
	
	.tooltip.bottom-right .tooltip-arrow {
		top: 0;
		right: 5px;
		border-width: 0 5px 5px;
		border-bottom-color: #000
	}
	
	.popover {
		position: absolute;
		top: 0;
		left: 0;
		z-index: 1060;
		display: none;
		max-width: 276px;
		padding: 1px;
		text-align: left;
		background-color: #fff;
		-webkit-background-clip: padding-box;
		background-clip: padding-box;
		border: 1px solid #ccc;
		border: 1px solid rgba(0, 0, 0, .2);
		border-radius: 4px;
	    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
		box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
		white-space: normal
	}
	
	.popover.top {
		margin-top: -10px
	}
	
	.popover.right {
		margin-left: 10px
	}
	
	.popover.bottom {
		margin-top: 10px
	}
	
	.popover.left {
		margin-left: -10px
	}
	
	.popover-title {
		margin: 0;
		padding: 8px 14px;
		font-size: 13px;
		font-weight: 400;
		line-height: 18px;
		background-color: #f7f7f7;
		border-bottom: 1px solid #ebebeb;
		border-radius: 3px 3px 0 0
	}
	
	.popover-content {
		padding: 9px 14px
	}
	
	.popover>.arrow, .popover>.arrow:after {
		position: absolute;
		display: block;
		width: 0;
		height: 0;
		border-color: transparent;
		border-style: solid
	}
	
	.popover>.arrow {
		border-width: 11px
	}
	
	.popover>.arrow:after {
		border-width: 10px;
		content: ""
	}
	
	.popover.top>.arrow {
		left: 50%;
		margin-left: -11px;
		border-bottom-width: 0;
		border-top-color: #999;
		border-top-color: rgba(0, 0, 0, .25);
		bottom: -11px
	}
	
	.popover.top>.arrow:after {
		content: " ";
		bottom: 1px;
		margin-left: -10px;
		border-bottom-width: 0;
		border-top-color: #fff
	}
	
	.popover.right>.arrow {
		top: 50%;
		left: -11px;
		margin-top: -11px;
		border-left-width: 0;
		border-right-color: #999;
		border-right-color: rgba(0, 0, 0, .25)
	}
	
	.popover.right>.arrow:after {
		content: " ";
		left: 1px;
		bottom: -10px;
		border-left-width: 0;
		border-right-color: #fff
	}
	
	.popover.bottom>.arrow {
		left: 50%;
		margin-left: -11px;
		border-top-width: 0;
		border-bottom-color: #999;
		border-bottom-color: rgba(0, 0, 0, .25);
		top: -11px
	}
	
	.popover.bottom>.arrow:after {
		content: " ";
		top: 1px;
		margin-left: -10px;
		border-top-width: 0;
		border-bottom-color: #fff
	}
	
	.popover.left>.arrow {
		top: 50%;
		right: -11px;
		margin-top: -11px;
		border-right-width: 0;
		border-left-color: #999;
		border-left-color: rgba(0, 0, 0, .25)
	}
	
	.popover.left>.arrow:after {
		content: " ";
		right: 1px;
		border-right-width: 0;
		border-left-color: #fff;
		bottom: -10px
	}
	
	.carousel {
		position: relative
	}
	
	.carousel-inner {
		position: relative;
		width: 100%;
		overflow: hidden
	}
	
	.carousel-inner>.item {
		position: relative;
		display: none;
		-webkit-transition: .6s ease-in-out left;
		-o-transition: .6s ease-in-out left;
		transition: .6s ease-in-out left
	}
	
	.carousel-inner>.item>a>img, .carousel-inner>.item>img {
		line-height: 1
	}
	
	.carousel-inner>.active, .carousel-inner>.next, .carousel-inner>.prev {
		display: block
	}
	
	.carousel-inner>.active {
		left: 0
	}
	
	.carousel-inner>.next, .carousel-inner>.prev {
		position: absolute;
		top: 0;
		width: 100%
	}
	
	.carousel-inner>.next {
		left: 100%
	}
	
	.carousel-inner>.prev {
		left: -100%
	}
	
	.carousel-inner>.next.left, .carousel-inner>.prev.right {
		left: 0
	}
	
	.carousel-inner>.active.left {
		left: -100%
	}
	
	.carousel-inner>.active.right {
		left: 100%
	}
	
	.carousel-control {
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		width: 15%;
		font-size: 20px;
		color: #fff;
		text-align: center;
		text-shadow: 0 1px 2px rgba(0, 0, 0, .6);
		filter: alpha(opacity = 50);
		opacity: .5
	}
	
	.carousel-control.left {
		background-image: -webkit-linear-gradient(left, rgba(0, 0, 0, .5) 0,
			rgba(0, 0, 0, .0001) 100%);
		background-image: -o-linear-gradient(left, rgba(0, 0, 0, .5) 0,
			rgba(0, 0, 0, .0001) 100%);
		background-image: -webkit-gradient(linear, left top, right top, from(rgba(0, 0, 0, .5)),
			to(rgba(0, 0, 0, .0001)));
		background-image: linear-gradient(to right, rgba(0, 0, 0, .5) 0,
			rgba(0, 0, 0, .0001) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80000000',
			endColorstr='#00000000', GradientType=1);
		background-repeat: repeat-x
	}
	
	.carousel-control.right {
		right: 0;
		left: auto;
		background-image: -webkit-linear-gradient(left, rgba(0, 0, 0, .0001) 0,
			rgba(0, 0, 0, .5) 100%);
		background-image: -o-linear-gradient(left, rgba(0, 0, 0, .0001) 0,
			rgba(0, 0, 0, .5) 100%);
		background-image: -webkit-gradient(linear, left top, right top, from(rgba(0, 0, 0, .0001)),
			to(rgba(0, 0, 0, .5)));
		background-image: linear-gradient(to right, rgba(0, 0, 0, .0001) 0,
			rgba(0, 0, 0, .5) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000',
			endColorstr='#80000000', GradientType=1);
		background-repeat: repeat-x
	}
	
	.carousel-control:focus, .carousel-control:hover {
		color: #fff;
		text-decoration: none;
		filter: alpha(opacity = 90);
		outline: 0;
		opacity: .9
	}
	
	.carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right,
		.carousel-control .icon-next, .carousel-control .icon-prev {
		position: absolute;
		top: 50%;
		z-index: 5;
		display: inline-block
	}
	
	.carousel-control .glyphicon-chevron-left, .carousel-control .icon-prev {
		left: 50%;
		margin-left: -10px
	}
	
	.carousel-control .glyphicon-chevron-right, .carousel-control .icon-next {
		right: 50%;
		margin-right: -10px
	}
	
	.carousel-control .icon-next, .carousel-control .icon-prev {
		width: 20px;
		height: 20px;
		margin-top: -10px;
		font-family: serif
	}
	
	.carousel-control .icon-prev:before {
		content: '\2039'
	}
	
	.carousel-control .icon-next:before {
		content: '\203a'
	}
	
	.carousel-indicators {
		position: absolute;
		bottom: 10px;
		left: 50%;
		z-index: 15;
		width: 60%;
		padding-left: 0;
		margin-left: -30%;
		text-align: center;
		list-style: none
	}
	
	.carousel-indicators li {
		display: inline-block;
		width: 10px;
		height: 10px;
		margin: 1px;
		text-indent: -999px;
		cursor: pointer;
		background-color: transparent;
		border: 1px solid #fff;
		border-radius: 10px
	}
	
	.carousel-indicators .active {
		width: 12px;
		height: 12px;
		margin: 0;
		background-color: #fff
	}
	
	.carousel-caption {
		position: absolute;
		right: 15%;
		bottom: 20px;
		left: 15%;
		z-index: 10;
		padding-top: 20px;
		padding-bottom: 20px;
		color: #fff;
		text-align: center;
		text-shadow: 0 1px 2px rgba(0, 0, 0, .6)
	}
	
	.carousel-caption .btn {
		text-shadow: none
	}
	
	.btn-group-vertical>.btn-group:after, .btn-group-vertical>.btn-group:before,
		.btn-toolbar:after, .btn-toolbar:before, .clearfix:after, .clearfix:before,
		.container-fluid:after, .container-fluid:before, .container:after,
		.container:before, .dl-horizontal dd:after, .dl-horizontal dd:before,
		.form-horizontal .form-group:after, .form-horizontal .form-group:before,
		.modal-footer:after, .modal-footer:before, .nav:after, .nav:before,
		.navbar-collapse:after, .navbar-collapse:before, .navbar-header:after,
		.navbar-header:before, .navbar:after, .navbar:before, .pager:after,
		.pager:before, .panel-body:after, .panel-body:before, .row:after, .row:before {
		display: table;
		content: " "
	}
	
	.btn-group-vertical>.btn-group:after, .btn-toolbar:after, .clearfix:after,
		.container-fluid:after, .container:after, .dl-horizontal dd:after,
		.form-horizontal .form-group:after, .modal-footer:after, .nav:after,
		.navbar-collapse:after, .navbar-header:after, .navbar:after, .pager:after,
		.panel-body:after, .row:after {
		clear: both
	}
	
	.center-block {
		display: block;
		margin-left: auto;
		margin-right: auto
	}
	
	.pull-right {
		float: right !important
	}
	
	.pull-left {
		float: left !important
	}
	
	.hide {
		display: none !important
	}
	
	.filled, .show {
		display: block !important
	}
	
	.invisible {
		visibility: hidden
	}
	
	.text-hide {
		font: 0/0 a;
		color: transparent;
		text-shadow: none;
		background-color: transparent;
		border: 0
	}
	
	.block {
		display: block
	}
	
	.inline {
		display: inline
	}
	
	.hidden {
		display: none !important;
		visibility: hidden !important
	}
	
	.affix {
		position: fixed;
		-webkit-transform: translate3d(0, 0, 0);
		-o-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0)
	}
	
	@-ms-viewport {
		width: device-width
	}
	
	.b {
		border: 1px solid #94d7e4
	}
	
	.b-t {
		border-top: 1px solid #94d7e4
	}
	
	.b-r {
		border-right: 1px solid #94d7e4
	}
	
	.b-b {
		border-bottom: 1px solid #94d7e4
	}
	
	.b-l {
		border-left: 1px solid #94d7e4
	}
	
	.b-tr {
		border-color: transparent
	}
	
	.m {
		margin: 10px 15px
	}
	
	.m-h, .m-t {
		margin-top: 10px
	}
	
	.m-r, .m-v {
		margin-right: 15px
	}
	
	.m-b, .m-h {
		margin-bottom: 10px
	}
	
	.m-l, .m-v {
		margin-left: 15px
	}
	
	.m-n {
		margin: 0
	}
	
	.p {
		padding: 10px 15px
	}
	
	.p-t {
		padding-top: 10px
	}
	
	.p-r {
		padding-right: 15px
	}
	
	.p-b {
		padding-bottom: 10px
	}
	
	.p-l {
		padding-left: 15px
	}
	
	.p-n {
		padding: 0
	}
	
	.valign {
		vertical-align: middle !important
	}
	
	.pfix, .pfix-b {
		position: fixed;
		z-index: 10
	}
	
	.pfix-b {
		bottom: 0;
		width: 100%
	}
	
	.font-300 {
		font-weight: 300
	}
	
	.font-700 {
		font-weight: 700
	}
	
	a[accesskey]:after, button[accesskey]:after, input[accesskey]:after,
		label[accesskey]:after, legend[accesskey]:after, textarea[accesskey]:after {
		margin-left: .3em;
		color: plum;
		content: "[" attr(accesskey) "]"
	}
	
	.parsley-error {
		border-color: #a62c00
	}
	
	body #barra-brasil .brasil-flag {
		height: 31px !important
	}
	
	.visible-lg, .visible-lg-block, .visible-lg-inline,
		.visible-lg-inline-block, .visible-md, .visible-md-block,
		.visible-md-inline, .visible-md-inline-block, .visible-print,
		.visible-print-block, .visible-print-inline,
		.visible-print-inline-block, .visible-sm, .visible-sm-block,
		.visible-sm-inline, .visible-sm-inline-block, .visible-xs,
		.visible-xs-block, .visible-xs-inline, .visible-xs-inline-block {
		display: none !important
	}
	
	.browsehappy {
		background-color: #f0ad4e;
		margin-bottom: 0;
		line-height: 30px;
		text-align: center
	}
	
	.browsehappy a {
		color: inherit;
		text-decoration: underline
	}
	
	.sidebar {
		background-color: #d5d5d5;
		display: block;
		padding: 0 15px 15px;
		overflow-x: hidden;
		overflow-y: auto;
		position: fixed !important;
		left: 0;
		top: 64px;
		bottom: 0;
		z-index: 10
	}
	
	.sidebar header {
		background-color: #94d7e4;
		margin-left: -15px;
		margin-right: -15px;
		padding: 10px
	}
	
	.content {
		padding: 80px 15px 50px
	}
	
	body>footer {
		line-height: 30px
	}
	
	section.login {
		padding: 10px 0 30px
	}
	
	section.login textarea.form-control {
		height: 54px
	}
	
	body.contrast {
		background-color: #000;
		color: #fff
	}
	
	body.contrast a {
		color: #f0ad4e
	}
	
	body.contrast .h1, body.contrast .h1 small, body.contrast .h2, body.contrast .h2 small,
		body.contrast .h3, body.contrast .h3 small, body.contrast .h4, body.contrast .h4 small,
		body.contrast .h5, body.contrast .h5 small, body.contrast .h6, body.contrast .h6 small,
		body.contrast .text-dark, body.contrast h1, body.contrast h1 small,
		body.contrast h2, body.contrast h2 small, body.contrast h3, body.contrast h3 small,
		body.contrast h4, body.contrast h4 small, body.contrast h5, body.contrast h5 small,
		body.contrast h6, body.contrast h6 small, body.contrast label {
		color: #fff
	}
	
	body.contrast .help-block {
		color: #f5f5f5
	}
	
	body.contrast .form-control {
		border-color: transparent
	}
	
	body.contrast small.required {
		color: #f0ad4e
	}
	
	body.contrast .form-control[disabled], body.contrast .form-control[readonly],
		body.contrast fieldset[disabled] .form-control {
		background-color: #555;
		color: #999
	}
	
	body.contrast .btn-info {
		background-color: #333;
		color: #fff;
		border-color: #444
	}
	
	body.contrast .btn-info:focus, body.contrast .btn-info:hover {
		background-color: #444
	}
	
	body.contrast .text-primary {
		color: #fff
	}
	
	body.contrast .bg-danger, body.contrast .bg-info {
		background-color: #333
	}
	
	body.contrast .navbar-default {
		background-color: #222;
		border-color: #333
	}
	
	body.contrast .navbar-default .navbar-nav>.active>span, body.contrast .navbar-default .navbar-nav>li>a:focus,
		body.contrast .navbar-default .navbar-nav>li>a:hover {
		background-color: #333
	}
	
	body.contrast .navbar-default .btn-link .text-dark {
		color: #111
	}
	
	body.contrast .nav>li.active>a, body.contrast .nav>li>a:focus, body.contrast .nav>li>a:hover {
		background-color: #333
	}
	
	body.contrast .panel {
		background-color: #111
	}
	
	body.contrast .panel-default, body.contrast .panel-info {
		border-color: #222
	}
	
	body.contrast .panel-default>.panel-heading, body.contrast .panel-info>.panel-heading {
		background-color: #222;
		border-color: #222;
		color: inherit
	}
	
	body.contrast .panel-footer {
		background-color: #222;
		border-color: #222
	}
	
	body.contrast .list-group-item {
		background-color: #111;
		border-color: #222
	}
	
	body.contrast .table-bordered>tbody>tr>td, body.contrast .table-bordered>tbody>tr>th,
		body.contrast .table-bordered>tfoot>tr>td, body.contrast .table-bordered>tfoot>tr>th,
		body.contrast .table-bordered>thead>tr>td, body.contrast .table-bordered>thead>tr>th {
		border-color: #444
	}
	
	body.contrast>footer {
		background-color: #222;
		border-color: #333
	}
	
	body.contrast .sidebar, body.contrast .sidebar header {
		background-color: #111
	}
	
	body.contrast .pagination>li>a, body.contrast .pagination>li>span {
		background-color: #333;
		border-color: #444
	}
	
	body.contrast .pagination>li>a:focus, body.contrast .pagination>li>a:hover,
		body.contrast .pagination>li>span:focus, body.contrast .pagination>li>span:hover {
		background-color: #444;
		color: #f0ad4e
	}
	
	body.contrast .pagination>.active>a, body.contrast .pagination>.active>a:focus,
		body.contrast .pagination>.active>a:hover, body.contrast .pagination>.active>span,
		body.contrast .pagination>.active>span:focus, body.contrast .pagination>.active>span:hover {
		background-color: #555;
		border-color: #666;
		color: #fff
	}
	
	body.contrast .page-row footer, body.contrast .pagination>.disabled>a,
		body.contrast .pagination>.disabled>a:focus, body.contrast .pagination>.disabled>a:hover,
		body.contrast .pagination>.disabled>span, body.contrast .pagination>.disabled>span:focus,
		body.contrast .pagination>.disabled>span:hover {
		background-color: #222;
		border-color: #333
	}
	
	body.contrast .b-b, body.contrast .b-l, body.contrast .b-r, body.contrast .b-t {
		border-color: #333
	}
}