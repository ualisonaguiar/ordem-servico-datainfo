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
/*! 
 * angular-loading-bar v0.8.0
 * https://chieffancypants.github.io/angular-loading-bar
 * Copyright (c) 2015 Wes Cruver
 * License: MIT
 */

/* Make clicks pass-through */
#loading-bar,
#loading-bar-spinner {
  pointer-events: none;
  -webkit-pointer-events: none;
  -webkit-transition: 350ms linear all;
  -moz-transition: 350ms linear all;
  -o-transition: 350ms linear all;
  transition: 350ms linear all;
}

#loading-bar.ng-enter,
#loading-bar.ng-leave.ng-leave-active,
#loading-bar-spinner.ng-enter,
#loading-bar-spinner.ng-leave.ng-leave-active {
  opacity: 0;
}

#loading-bar.ng-enter.ng-enter-active,
#loading-bar.ng-leave,
#loading-bar-spinner.ng-enter.ng-enter-active,
#loading-bar-spinner.ng-leave {
  opacity: 1;
}

#loading-bar .bar {
  -webkit-transition: width 350ms;
  -moz-transition: width 350ms;
  -o-transition: width 350ms;
  transition: width 350ms;

  background: #29d;
  position: fixed;
  z-index: 10002;
  top: 0;
  left: 0;
  width: 100%;
  height: 2px;
  border-bottom-right-radius: 1px;
  border-top-right-radius: 1px;
}

/* Fancy blur effect */
#loading-bar .peg {
  position: absolute;
  width: 70px;
  right: 0;
  top: 0;
  height: 2px;
  opacity: .45;
  -moz-box-shadow: #29d 1px 0 6px 1px;
  -ms-box-shadow: #29d 1px 0 6px 1px;
  -webkit-box-shadow: #29d 1px 0 6px 1px;
  box-shadow: #29d 1px 0 6px 1px;
  -moz-border-radius: 100%;
  -webkit-border-radius: 100%;
  border-radius: 100%;
}

#loading-bar-spinner {
  display: block;
  position: fixed;
  z-index: 10002;
  top: 10px;
  left: 10px;
}

#loading-bar-spinner .spinner-icon {
  width: 14px;
  height: 14px;

  border:  solid 2px transparent;
  border-top-color:  #29d;
  border-left-color: #29d;
  border-radius: 50%;

  -webkit-animation: loading-bar-spinner 400ms linear infinite;
  -moz-animation:    loading-bar-spinner 400ms linear infinite;
  -ms-animation:     loading-bar-spinner 400ms linear infinite;
  -o-animation:      loading-bar-spinner 400ms linear infinite;
  animation:         loading-bar-spinner 400ms linear infinite;
}

@-webkit-keyframes loading-bar-spinner {
  0%   { -webkit-transform: rotate(0deg);   transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
}
@-moz-keyframes loading-bar-spinner {
  0%   { -moz-transform: rotate(0deg);   transform: rotate(0deg); }
  100% { -moz-transform: rotate(360deg); transform: rotate(360deg); }
}
@-o-keyframes loading-bar-spinner {
  0%   { -o-transform: rotate(0deg);   transform: rotate(0deg); }
  100% { -o-transform: rotate(360deg); transform: rotate(360deg); }
}
@-ms-keyframes loading-bar-spinner {
  0%   { -ms-transform: rotate(0deg);   transform: rotate(0deg); }
  100% { -ms-transform: rotate(360deg); transform: rotate(360deg); }
}
@keyframes loading-bar-spinner {
  0%   { transform: rotate(0deg);   transform: rotate(0deg); }
  100% { transform: rotate(360deg); transform: rotate(360deg); }
}
