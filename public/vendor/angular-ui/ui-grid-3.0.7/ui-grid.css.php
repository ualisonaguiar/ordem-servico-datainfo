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
 * ui-grid - v3.0.7 - 2015-10-06
 * Copyright (c) 2015 ; License: MIT 
 */
#ui-grid-twbs #ui-grid-twbs .form-horizontal .form-group:before,
#ui-grid-twbs #ui-grid-twbs .form-horizontal .form-group:after,
#ui-grid-twbs #ui-grid-twbs .btn-toolbar:before,
#ui-grid-twbs #ui-grid-twbs .btn-toolbar:after,
#ui-grid-twbs #ui-grid-twbs .btn-group-vertical > .btn-group:before,
#ui-grid-twbs #ui-grid-twbs .btn-group-vertical > .btn-group:after {
  content: " ";
  display: table;
}
#ui-grid-twbs #ui-grid-twbs .form-horizontal .form-group:after,
#ui-grid-twbs #ui-grid-twbs .btn-toolbar:after,
#ui-grid-twbs #ui-grid-twbs .btn-group-vertical > .btn-group:after {
  clear: both;
}
.ui-grid {
  border: 1px solid #d4d4d4;
  box-sizing: content-box;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  -webkit-transform: translateZ(0);
  -moz-transform: translateZ(0);
  -o-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}
.ui-grid-vertical-bar {
  position: absolute;
  right: 0;
  width: 0;
}
.ui-grid-header-cell:not(:last-child) .ui-grid-vertical-bar,
.ui-grid-cell:not(:last-child) .ui-grid-vertical-bar {
  width: 1px;
}
.ui-grid-scrollbar-placeholder {
  background-color: transparent;
}
.ui-grid-header-cell:not(:last-child) .ui-grid-vertical-bar {
  background-color: #d4d4d4;
}
.ui-grid-cell:not(:last-child) .ui-grid-vertical-bar {
  background-color: #d4d4d4;
}
.ui-grid-header-cell:last-child .ui-grid-vertical-bar {
  right: -1px;
  width: 1px;
  background-color: #d4d4d4;
}
.ui-grid-clearfix:before,
.ui-grid-clearfix:after {
  content: "";
  display: table;
}
.ui-grid-clearfix:after {
  clear: both;
}
.ui-grid-invisible {
  visibility: hidden;
}
.ui-grid-contents-wrapper {
  position: relative;
  height: 100%;
  width: 100%;
}
.ui-grid-sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  margin: -1px;
  padding: 0;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  border: 0;
}
.ui-grid-top-panel-background {
  background: #f3f3f3;
  background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #eeeeee), color-stop(1, #ffffff));
  background: -ms-linear-gradient(bottom, #eeeeee, #ffffff);
  background: -moz-linear-gradient(center bottom, #eeeeee 0%, #ffffff 100%);
  background: -o-linear-gradient(#ffffff, #eeeeee);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#eeeeee', GradientType=0);
}
.ui-grid-header {
  border-bottom: 1px solid #d4d4d4;
  box-sizing: border-box;
}
.ui-grid-top-panel {
  position: relative;
  overflow: hidden;
  font-weight: bold;
  background: #f3f3f3;
  background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #eeeeee), color-stop(1, #ffffff));
  background: -ms-linear-gradient(bottom, #eeeeee, #ffffff);
  background: -moz-linear-gradient(center bottom, #eeeeee 0%, #ffffff 100%);
  background: -o-linear-gradient(#ffffff, #eeeeee);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#eeeeee', GradientType=0);
  -webkit-border-top-right-radius: -1px;
  -webkit-border-bottom-right-radius: 0;
  -webkit-border-bottom-left-radius: 0;
  -webkit-border-top-left-radius: -1px;
  -moz-border-radius-topright: -1px;
  -moz-border-radius-bottomright: 0;
  -moz-border-radius-bottomleft: 0;
  -moz-border-radius-topleft: -1px;
  border-top-right-radius: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
  border-top-left-radius: -1px;
  -moz-background-clip: padding-box;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
}
.ui-grid-header-viewport {
  overflow: hidden;
}
.ui-grid-header-canvas:before,
.ui-grid-header-canvas:after {
  content: "";
  display: table;
  line-height: 0;
}
.ui-grid-header-canvas:after {
  clear: both;
}
.ui-grid-header-cell-wrapper {
  position: relative;
  display: table;
  box-sizing: border-box;
  height: 100%;
}
.ui-grid-header-cell-row {
  display: table-row;
  position: relative;
}
.ui-grid-header-cell {
  position: relative;
  box-sizing: border-box;
  background-color: inherit;
  border-right: 1px solid;
  border-color: #d4d4d4;
  display: table-cell;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  width: 0;
}
.ui-grid-header-cell:last-child {
  border-right: 0;
}
.ui-grid-header-cell .sortable {
  cursor: pointer;
}
.ui-grid-header-cell .ui-grid-sort-priority-number {
  margin-left: -8px;
}
.ui-grid-header .ui-grid-vertical-bar {
  top: 0;
  bottom: 0;
}
.ui-grid-column-menu-button {
  position: absolute;
  right: 1px;
  top: 0;
}
.ui-grid-column-menu-button .ui-grid-icon-angle-down {
  vertical-align: sub;
}
.ui-grid-column-menu-button-last-col {
  margin-right: 25px;
}
.ui-grid-column-menu {
  position: absolute;
}
/* Slide up/down animations */
.ui-grid-column-menu .ui-grid-menu .ui-grid-menu-mid.ng-hide-add,
.ui-grid-column-menu .ui-grid-menu .ui-grid-menu-mid.ng-hide-remove {
  -webkit-transition: all 0.05s linear;
  -moz-transition: all 0.05s linear;
  -o-transition: all 0.05s linear;
  transition: all 0.05s linear;
  display: block !important;
}
.ui-grid-column-menu .ui-grid-menu .ui-grid-menu-mid.ng-hide-add.ng-hide-add-active,
.ui-grid-column-menu .ui-grid-menu .ui-grid-menu-mid.ng-hide-remove {
  -webkit-transform: translateY(-100%);
  -moz-transform: translateY(-100%);
  -o-transform: translateY(-100%);
  -ms-transform: translateY(-100%);
  transform: translateY(-100%);
}
.ui-grid-column-menu .ui-grid-menu .ui-grid-menu-mid.ng-hide-add,
.ui-grid-column-menu .ui-grid-menu .ui-grid-menu-mid.ng-hide-remove.ng-hide-remove-active {
  -webkit-transform: translateY(0);
  -moz-transform: translateY(0);
  -o-transform: translateY(0);
  -ms-transform: translateY(0);
  transform: translateY(0);
}
/* Slide up/down animations */
.ui-grid-menu-button .ui-grid-menu .ui-grid-menu-mid.ng-hide-add,
.ui-grid-menu-button .ui-grid-menu .ui-grid-menu-mid.ng-hide-remove {
  -webkit-transition: all 0.05s linear;
  -moz-transition: all 0.05s linear;
  -o-transition: all 0.05s linear;
  transition: all 0.05s linear;
  display: block !important;
}
.ui-grid-menu-button .ui-grid-menu .ui-grid-menu-mid.ng-hide-add.ng-hide-add-active,
.ui-grid-menu-button .ui-grid-menu .ui-grid-menu-mid.ng-hide-remove {
  -webkit-transform: translateY(-100%);
  -moz-transform: translateY(-100%);
  -o-transform: translateY(-100%);
  -ms-transform: translateY(-100%);
  transform: translateY(-100%);
}
.ui-grid-menu-button .ui-grid-menu .ui-grid-menu-mid.ng-hide-add,
.ui-grid-menu-button .ui-grid-menu .ui-grid-menu-mid.ng-hide-remove.ng-hide-remove-active {
  -webkit-transform: translateY(0);
  -moz-transform: translateY(0);
  -o-transform: translateY(0);
  -ms-transform: translateY(0);
  transform: translateY(0);
}
.ui-grid-filter-container {
  padding: 4px 10px;
  position: relative;
}
.ui-grid-filter-container .ui-grid-filter-button {
  position: absolute;
  top: 0;
  bottom: 0;
  right: 0;
}
.ui-grid-filter-container .ui-grid-filter-button [class^="ui-grid-icon"] {
  position: absolute;
  top: 50%;
  line-height: 32px;
  margin-top: -16px;
  right: 10px;
  opacity: 0.66;
}
.ui-grid-filter-container .ui-grid-filter-button [class^="ui-grid-icon"]:hover {
  opacity: 1;
}
.ui-grid-filter-container .ui-grid-filter-button-select {
  position: absolute;
  top: 0;
  bottom: 0;
  right: 0;
}
.ui-grid-filter-container .ui-grid-filter-button-select [class^="ui-grid-icon"] {
  position: absolute;
  top: 50%;
  line-height: 32px;
  margin-top: -16px;
  right: 0px;
  opacity: 0.66;
}
.ui-grid-filter-container .ui-grid-filter-button-select [class^="ui-grid-icon"]:hover {
  opacity: 1;
}
input[type="text"].ui-grid-filter-input {
  padding: 0;
  margin: 0;
  border: 0;
  width: 100%;
  border: 1px solid #d4d4d4;
  -webkit-border-top-right-radius: 0px;
  -webkit-border-bottom-right-radius: 0;
  -webkit-border-bottom-left-radius: 0;
  -webkit-border-top-left-radius: 0;
  -moz-border-radius-topright: 0px;
  -moz-border-radius-bottomright: 0;
  -moz-border-radius-bottomleft: 0;
  -moz-border-radius-topleft: 0;
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
  -moz-background-clip: padding-box;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
}
input[type="text"].ui-grid-filter-input:hover {
  border: 1px solid #d4d4d4;
}
select.ui-grid-filter-select {
  padding: 0;
  margin: 0;
  border: 0;
  width: 90%;
  border: 1px solid #d4d4d4;
  -webkit-border-top-right-radius: 0px;
  -webkit-border-bottom-right-radius: 0;
  -webkit-border-bottom-left-radius: 0;
  -webkit-border-top-left-radius: 0;
  -moz-border-radius-topright: 0px;
  -moz-border-radius-bottomright: 0;
  -moz-border-radius-bottomleft: 0;
  -moz-border-radius-topleft: 0;
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
  -moz-background-clip: padding-box;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
}
select.ui-grid-filter-select:hover {
  border: 1px solid #d4d4d4;
}
.ui-grid-filter-cancel-button-hidden select.ui-grid-filter-select {
  width: 100%;
}
.ui-grid-render-container {
  position: inherit;
  -webkit-border-top-right-radius: 0;
  -webkit-border-bottom-right-radius: 0px;
  -webkit-border-bottom-left-radius: 0px;
  -webkit-border-top-left-radius: 0;
  -moz-border-radius-topright: 0;
  -moz-border-radius-bottomright: 0px;
  -moz-border-radius-bottomleft: 0px;
  -moz-border-radius-topleft: 0;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0px;
  border-bottom-left-radius: 0px;
  border-top-left-radius: 0;
  -moz-background-clip: padding-box;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
}
.ui-grid-render-container:focus {
  outline: none;
}
.ui-grid-viewport {
  min-height: 20px;
  position: relative;
  overflow-y: scroll;
  -webkit-overflow-scrolling: touch;
}
.ui-grid-viewport:focus {
  outline: none !important;
}
.ui-grid-canvas {
  position: relative;
  padding-top: 1px;
}
.ui-grid-row:nth-child(odd) .ui-grid-cell {
  background-color: #fdfdfd;
}
.ui-grid-row:nth-child(even) .ui-grid-cell {
  background-color: #f3f3f3;
}
.ui-grid-row:last-child .ui-grid-cell {
  border-bottom-color: #d4d4d4;
  border-bottom-style: solid;
}
.ui-grid-no-row-overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: 10%;
  background: #f3f3f3;
  background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #eeeeee), color-stop(1, #ffffff));
  background: -ms-linear-gradient(bottom, #eeeeee, #ffffff);
  background: -moz-linear-gradient(center bottom, #eeeeee 0%, #ffffff 100%);
  background: -o-linear-gradient(#ffffff, #eeeeee);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#eeeeee', GradientType=0);
  -webkit-border-top-right-radius: 0px;
  -webkit-border-bottom-right-radius: 0;
  -webkit-border-bottom-left-radius: 0;
  -webkit-border-top-left-radius: 0;
  -moz-border-radius-topright: 0px;
  -moz-border-radius-bottomright: 0;
  -moz-border-radius-bottomleft: 0;
  -moz-border-radius-topleft: 0;
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
  -moz-background-clip: padding-box;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  border: 1px solid #d4d4d4;
  font-size: 2em;
  text-align: center;
}
.ui-grid-no-row-overlay > * {
  position: absolute;
  display: table;
  margin: auto 0;
  width: 100%;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  opacity: 0.66;
}
.ui-grid-cell {
  overflow: hidden;
  float: left;
  background-color: inherit;
  border-right: 1px solid;
  border-color: #d4d4d4;
  box-sizing: border-box;
}
.ui-grid-cell:last-child {
  border-right: 0;
}
.ui-grid-cell-contents {
  padding: 5px;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  white-space: nowrap;
  -ms-text-overflow: ellipsis;
  -o-text-overflow: ellipsis;
  text-overflow: ellipsis;
  overflow: hidden;
  height: 100%;
}
.ui-grid-cell-contents-hidden {
  visibility: hidden;
  width: 0;
  height: 0;
  display: none;
}
.ui-grid-row .ui-grid-cell.ui-grid-row-header-cell {
  background-color: #f0f0ee;
  border-bottom: solid 1px #d4d4d4;
}
.ui-grid-footer-panel-background {
  background: #f3f3f3;
  background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #eeeeee), color-stop(1, #ffffff));
  background: -ms-linear-gradient(bottom, #eeeeee, #ffffff);
  background: -moz-linear-gradient(center bottom, #eeeeee 0%, #ffffff 100%);
  background: -o-linear-gradient(#ffffff, #eeeeee);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#eeeeee', GradientType=0);
}
.ui-grid-footer-panel {
  position: relative;
  border-bottom: 1px solid #d4d4d4;
  border-top: 1px solid #d4d4d4;
  overflow: hidden;
  font-weight: bold;
  background: #f3f3f3;
  background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #eeeeee), color-stop(1, #ffffff));
  background: -ms-linear-gradient(bottom, #eeeeee, #ffffff);
  background: -moz-linear-gradient(center bottom, #eeeeee 0%, #ffffff 100%);
  background: -o-linear-gradient(#ffffff, #eeeeee);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#eeeeee', GradientType=0);
  -webkit-border-top-right-radius: -1px;
  -webkit-border-bottom-right-radius: 0;
  -webkit-border-bottom-left-radius: 0;
  -webkit-border-top-left-radius: -1px;
  -moz-border-radius-topright: -1px;
  -moz-border-radius-bottomright: 0;
  -moz-border-radius-bottomleft: 0;
  -moz-border-radius-topleft: -1px;
  border-top-right-radius: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
  border-top-left-radius: -1px;
  -moz-background-clip: padding-box;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
}
.ui-grid-grid-footer {
  float: left;
  width: 100%;
}
.ui-grid-footer-viewport {
  overflow: hidden;
}
.ui-grid-footer-canvas {
  position: relative;
}
.ui-grid-footer-canvas:before,
.ui-grid-footer-canvas:after {
  content: "";
  display: table;
  line-height: 0;
}
.ui-grid-footer-canvas:after {
  clear: both;
}
.ui-grid-footer-cell-wrapper {
  position: relative;
  display: table;
  box-sizing: border-box;
  height: 100%;
}
.ui-grid-footer-cell-row {
  display: table-row;
}
.ui-grid-footer-cell {
  overflow: hidden;
  background-color: inherit;
  border-right: 1px solid;
  border-color: #d4d4d4;
  box-sizing: border-box;
  display: table-cell;
}
.ui-grid-footer-cell:last-child {
  border-right: 0;
}
input[type="text"].ui-grid-filter-input {
  padding: 0;
  margin: 0;
  border: 0;
  width: 100%;
  border: 1px solid #d4d4d4;
  -webkit-border-top-right-radius: 0px;
  -webkit-border-bottom-right-radius: 0;
  -webkit-border-bottom-left-radius: 0;
  -webkit-border-top-left-radius: 0;
  -moz-border-radius-topright: 0px;
  -moz-border-radius-bottomright: 0;
  -moz-border-radius-bottomleft: 0;
  -moz-border-radius-topleft: 0;
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
  -moz-background-clip: padding-box;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
}
input[type="text"].ui-grid-filter-input:hover {
  border: 1px solid #d4d4d4;
}
.ui-grid-menu-button {
  z-index: 2;
  position: absolute;
  right: 0;
  top: 0;
  background: #f3f3f3;
  border: 1px solid #d4d4d4;
  cursor: pointer;
  height: 31px;
  font-weight: normal;
}
.ui-grid-menu-button .ui-grid-icon-container {
  margin-top: 3px;
}
.ui-grid-menu-button .ui-grid-menu {
  right: 0;
}
.ui-grid-menu-button .ui-grid-menu .ui-grid-menu-mid {
  overflow: scroll;
  max-height: 300px;
  border: 1px solid #d4d4d4;
}
.ui-grid-menu {
  z-index: 2;
  position: absolute;
  padding: 0 10px 20px 10px;
  cursor: pointer;
  box-sizing: border-box;
}
.ui-grid-menu .ui-grid-menu-inner {
  background: #f3f3f3;
  border: 1px solid #d4d4d4;
  position: relative;
  white-space: nowrap;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  -webkit-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2), inset 0 12px 12px -14px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2), inset 0 12px 12px -14px rgba(0, 0, 0, 0.2);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2), inset 0 12px 12px -14px rgba(0, 0, 0, 0.2);
}
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button {
  position: absolute;
  right: 0px;
  top: 0px;
  display: inline-block;
  margin-bottom: 0;
  font-weight: normal;
  text-align: center;
  vertical-align: middle;
  touch-action: manipulation;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  white-space: nowrap;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  border-radius: 4px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  padding: 1px 1px;
  font-size: 10px;
  line-height: 1;
  border-radius: 2px;
  color: transparent;
  background-color: transparent;
  border-color: transparent;
}
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:focus,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:active:focus,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.active:focus,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.focus,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:active.focus,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.active.focus {
  outline: thin dotted;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:hover,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:focus,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.focus {
  color: #333333;
  text-decoration: none;
}
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:active,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.active {
  outline: 0;
  background-image: none;
  -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.disabled,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button[disabled],
fieldset[disabled] .ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button {
  cursor: not-allowed;
  opacity: 0.65;
  filter: alpha(opacity=65);
  -webkit-box-shadow: none;
  box-shadow: none;
}
a.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.disabled,
fieldset[disabled] a.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button {
  pointer-events: none;
}
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:focus,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.focus {
  color: transparent;
  background-color: rgba(0, 0, 0, 0);
  border-color: rgba(0, 0, 0, 0);
}
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:hover {
  color: transparent;
  background-color: rgba(0, 0, 0, 0);
  border-color: rgba(0, 0, 0, 0);
}
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:active,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.active,
.open > .dropdown-toggle.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button {
  color: transparent;
  background-color: rgba(0, 0, 0, 0);
  border-color: rgba(0, 0, 0, 0);
}
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:active:hover,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.active:hover,
.open > .dropdown-toggle.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:hover,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:active:focus,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.active:focus,
.open > .dropdown-toggle.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:focus,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:active.focus,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.active.focus,
.open > .dropdown-toggle.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.focus {
  color: transparent;
  background-color: rgba(0, 0, 0, 0);
  border-color: rgba(0, 0, 0, 0);
}
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:active,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.active,
.open > .dropdown-toggle.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button {
  background-image: none;
}
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.disabled,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button[disabled],
fieldset[disabled] .ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.disabled:hover,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button[disabled]:hover,
fieldset[disabled] .ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:hover,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.disabled:focus,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button[disabled]:focus,
fieldset[disabled] .ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:focus,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.disabled.focus,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button[disabled].focus,
fieldset[disabled] .ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.focus,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.disabled:active,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button[disabled]:active,
fieldset[disabled] .ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button:active,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.disabled.active,
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button[disabled].active,
fieldset[disabled] .ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button.active {
  background-color: transparent;
  border-color: transparent;
}
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button .badge {
  color: transparent;
  background-color: transparent;
}
.ui-grid-menu .ui-grid-menu-inner .ui-grid-menu-close-button > i {
  opacity: 0.75;
  color: black;
}
.ui-grid-menu .ui-grid-menu-inner ul {
  margin: 0;
  padding: 0;
  list-style-type: none;
}
.ui-grid-menu .ui-grid-menu-inner ul li {
  padding: 0px;
}
.ui-grid-menu .ui-grid-menu-inner ul li button {
  min-width: 100%;
  padding: 8px;
  text-align: left;
  background: transparent;
  border: none;
}
.ui-grid-menu .ui-grid-menu-inner ul li button:hover,
.ui-grid-menu .ui-grid-menu-inner ul li button:focus {
  -webkit-box-shadow: inset 0 0 14px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: inset 0 0 14px rgba(0, 0, 0, 0.2);
  box-shadow: inset 0 0 14px rgba(0, 0, 0, 0.2);
}
.ui-grid-menu .ui-grid-menu-inner ul li button.ui-grid-menu-item-active {
  -webkit-box-shadow: inset 0 0 14px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: inset 0 0 14px rgba(0, 0, 0, 0.2);
  box-shadow: inset 0 0 14px rgba(0, 0, 0, 0.2);
  background-color: #cecece;
}
.ui-grid-menu .ui-grid-menu-inner ul li:not(:last-child) > button {
  border-bottom: 1px solid #d4d4d4;
}
.ui-grid-sortarrow {
  right: 5px;
  position: absolute;
  width: 20px;
  top: 0;
  bottom: 0;
  background-position: center;
}
.ui-grid-sortarrow.down {
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  transform: rotate(180deg);
}
@font-face {
  font-family: 'ui-grid';
  src: url('ui-grid.eot');
  src: url('ui-grid.eot#iefix') format('embedded-opentype'), url('ui-grid.woff') format('woff'), url('ui-grid.ttf') format('truetype'), url('ui-grid.svg?#ui-grid') format('svg');
  font-weight: normal;
  font-style: normal;
}
/* Chrome hack: SVG is rendered more smooth in Windozze. 100% magic, uncomment if you need it. */
/* Note, that will break hinting! In other OS-es font will be not as sharp as it could be */
/*
@media screen and (-webkit-min-device-pixel-ratio:0) {
  @font-face {
    font-family: 'ui-grid';
    src: url('../font/ui-grid.svg?12312827#ui-grid') format('svg');
  }
}
*/
[class^="ui-grid-icon"]:before,
[class*=" ui-grid-icon"]:before {
  font-family: "ui-grid";
  font-style: normal;
  font-weight: normal;
  speak: none;
  display: inline-block;
  text-decoration: inherit;
  width: 1em;
  margin-right: .2em;
  text-align: center;
  /* opacity: .8; */
  /* For safety - reset parent styles, that can break glyph codes*/
  font-variant: normal;
  text-transform: none;
  /* fix buttons height, for twitter bootstrap */
  line-height: 1em;
  /* Animation center compensation - margins should be symmetric */
  /* remove if not needed */
  margin-left: .2em;
  /* you can be more comfortable with increased icons size */
  /* font-size: 120%; */
  /* Uncomment for 3D effect */
  /* text-shadow: 1px 1px 1px rgba(127, 127, 127, 0.3); */
}
.ui-grid-icon-blank::before {
  width: 1em;
  content: ' ';
}
/*
* RTL Styles
*/
.ui-grid[dir=rtl] .ui-grid-header-cell,
.ui-grid[dir=rtl] .ui-grid-footer-cell,
.ui-grid[dir=rtl] .ui-grid-cell {
  float: right !important;
}
.ui-grid[dir=rtl] .ui-grid-column-menu-button {
  position: absolute;
  left: 1px;
  top: 0;
  right: inherit;
}
.ui-grid[dir=rtl] .ui-grid-cell:first-child,
.ui-grid[dir=rtl] .ui-grid-header-cell:first-child,
.ui-grid[dir=rtl] .ui-grid-footer-cell:first-child {
  border-right: 0;
}
.ui-grid[dir=rtl] .ui-grid-cell:last-child,
.ui-grid[dir=rtl] .ui-grid-header-cell:last-child {
  border-right: 1px solid #d4d4d4;
  border-left: 0;
}
.ui-grid[dir=rtl] .ui-grid-header-cell:first-child .ui-grid-vertical-bar,
.ui-grid[dir=rtl] .ui-grid-footer-cell:first-child .ui-grid-vertical-bar,
.ui-grid[dir=rtl] .ui-grid-cell:first-child .ui-grid-vertical-bar {
  width: 0;
}
.ui-grid[dir=rtl] .ui-grid-menu-button {
  z-index: 2;
  position: absolute;
  left: 0;
  right: auto;
  background: #f3f3f3;
  border: 1px solid #d4d4d4;
  cursor: pointer;
  min-height: 27px;
  font-weight: normal;
}
.ui-grid[dir=rtl] .ui-grid-menu-button .ui-grid-menu {
  left: 0;
  right: auto;
}
.ui-grid[dir=rtl] .ui-grid-filter-container .ui-grid-filter-button {
  right: initial;
  left: 0;
}
.ui-grid[dir=rtl] .ui-grid-filter-container .ui-grid-filter-button [class^="ui-grid-icon"] {
  right: initial;
  left: 10px;
}
/*
   Animation example, for spinners
*/
.ui-grid-animate-spin {
  -moz-animation: ui-grid-spin 2s infinite linear;
  -o-animation: ui-grid-spin 2s infinite linear;
  -webkit-animation: ui-grid-spin 2s infinite linear;
  animation: ui-grid-spin 2s infinite linear;
  display: inline-block;
}
@-moz-keyframes ui-grid-spin {
  0% {
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -moz-transform: rotate(359deg);
    -o-transform: rotate(359deg);
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg);
  }
}
@-webkit-keyframes ui-grid-spin {
  0% {
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -moz-transform: rotate(359deg);
    -o-transform: rotate(359deg);
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg);
  }
}
@-o-keyframes ui-grid-spin {
  0% {
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -moz-transform: rotate(359deg);
    -o-transform: rotate(359deg);
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg);
  }
}
@-ms-keyframes ui-grid-spin {
  0% {
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -moz-transform: rotate(359deg);
    -o-transform: rotate(359deg);
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg);
  }
}
@keyframes ui-grid-spin {
  0% {
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -moz-transform: rotate(359deg);
    -o-transform: rotate(359deg);
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg);
  }
}
/*---------------------------------------------------
    LESS Elements 0.9
  ---------------------------------------------------
    A set of useful LESS mixins
    More info at: http://lesselements.com
  ---------------------------------------------------*/
/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/

/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
#ui-grid-twbs #ui-grid-twbs .form-horizontal .form-group:before,
#ui-grid-twbs #ui-grid-twbs .form-horizontal .form-group:after,
#ui-grid-twbs #ui-grid-twbs .btn-toolbar:before,
#ui-grid-twbs #ui-grid-twbs .btn-toolbar:after,
#ui-grid-twbs #ui-grid-twbs .btn-group-vertical > .btn-group:before,
#ui-grid-twbs #ui-grid-twbs .btn-group-vertical > .btn-group:after {
  content: " ";
  display: table;
}
#ui-grid-twbs #ui-grid-twbs .form-horizontal .form-group:after,
#ui-grid-twbs #ui-grid-twbs .btn-toolbar:after,
#ui-grid-twbs #ui-grid-twbs .btn-group-vertical > .btn-group:after {
  clear: both;
}
.ui-grid-cell-focus {
  outline: 0;
  background-color: #b3c4c7;
}
.ui-grid-focuser {
  position: absolute;
  left: 0px;
  top: 0px;
  z-index: -1;
  width: 100%;
  height: 100%;
}
.ui-grid-focuser:focus {
  border-color: #66afe9;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
}
.ui-grid-offscreen {
  display: block;
  position: absolute;
  left: -10000px;
  top: -10000px;
  clip: rect(0px, 0px, 0px, 0px);
}

/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
div.ui-grid-cell input {
  border-radius: inherit;
  padding: 0;
  width: 100%;
  color: inherit;
  height: auto;
  font: inherit;
  outline: none;
}
div.ui-grid-cell input:focus {
  color: inherit;
  outline: none;
}
div.ui-grid-cell input[type="checkbox"] {
  margin: 9px 0 0 6px;
  width: auto;
}
div.ui-grid-cell input.ng-invalid {
  border: 1px solid #fc8f8f;
}
div.ui-grid-cell input.ng-valid {
  border: 1px solid #d4d4d4;
}

/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
.expandableRow .ui-grid-row:nth-child(odd) .ui-grid-cell {
  background-color: #fdfdfd;
}
.expandableRow .ui-grid-row:nth-child(even) .ui-grid-cell {
  background-color: #f3f3f3;
}
.ui-grid-cell.ui-grid-disable-selection.ui-grid-row-header-cell {
  pointer-events: none;
}
.ui-grid-expandable-buttons-cell i {
  pointer-events: all;
}
.scrollFiller {
  float: left;
  border: 1px solid #d4d4d4;
}

/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/

/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
.ui-grid-tree-header-row {
  font-weight: bold !important;
}

/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/

/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
.movingColumn {
  position: absolute;
  top: 0;
  border: 1px solid #d4d4d4;
  box-shadow: inset 0 0 14px rgba(0, 0, 0, 0.2);
}
.movingColumn .ui-grid-icon-angle-down {
  display: none;
}

/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/*---------------------------------------------------
    LESS Elements 0.9
  ---------------------------------------------------
    A set of useful LESS mixins
    More info at: http://lesselements.com
  ---------------------------------------------------*/
#ui-grid-twbs #ui-grid-twbs .form-horizontal .form-group:before,
#ui-grid-twbs #ui-grid-twbs .form-horizontal .form-group:after,
#ui-grid-twbs #ui-grid-twbs .btn-toolbar:before,
#ui-grid-twbs #ui-grid-twbs .btn-toolbar:after,
#ui-grid-twbs #ui-grid-twbs .btn-group-vertical > .btn-group:before,
#ui-grid-twbs #ui-grid-twbs .btn-group-vertical > .btn-group:after {
  content: " ";
  display: table;
}
#ui-grid-twbs #ui-grid-twbs .form-horizontal .form-group:after,
#ui-grid-twbs #ui-grid-twbs .btn-toolbar:after,
#ui-grid-twbs #ui-grid-twbs .btn-group-vertical > .btn-group:after {
  clear: both;
}
.ui-grid-pager-panel {
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  padding-top: 3px;
  padding-bottom: 3px;
}
.ui-grid-pager-container {
  float: left;
}
.ui-grid-pager-control {
  margin-right: 10px;
  margin-left: 10px;
  min-width: 135px;
  float: left;
}
.ui-grid-pager-control button {
  height: 25px;
  min-width: 26px;
  display: inline-block;
  margin-bottom: 0;
  font-weight: normal;
  text-align: center;
  vertical-align: middle;
  touch-action: manipulation;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  white-space: nowrap;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  border-radius: 4px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  color: #eeeeee;
  background-color: #f3f3f3;
  border-color: #cccccc;
}
.ui-grid-pager-control button:focus,
.ui-grid-pager-control button:active:focus,
.ui-grid-pager-control button.active:focus,
.ui-grid-pager-control button.focus,
.ui-grid-pager-control button:active.focus,
.ui-grid-pager-control button.active.focus {
  outline: thin dotted;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}
.ui-grid-pager-control button:hover,
.ui-grid-pager-control button:focus,
.ui-grid-pager-control button.focus {
  color: #333333;
  text-decoration: none;
}
.ui-grid-pager-control button:active,
.ui-grid-pager-control button.active {
  outline: 0;
  background-image: none;
  -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
.ui-grid-pager-control button.disabled,
.ui-grid-pager-control button[disabled],
fieldset[disabled] .ui-grid-pager-control button {
  cursor: not-allowed;
  opacity: 0.65;
  filter: alpha(opacity=65);
  -webkit-box-shadow: none;
  box-shadow: none;
}
a.ui-grid-pager-control button.disabled,
fieldset[disabled] a.ui-grid-pager-control button {
  pointer-events: none;
}
.ui-grid-pager-control button:focus,
.ui-grid-pager-control button.focus {
  color: #eeeeee;
  background-color: #dadada;
  border-color: #8c8c8c;
}
.ui-grid-pager-control button:hover {
  color: #eeeeee;
  background-color: #dadada;
  border-color: #adadad;
}
.ui-grid-pager-control button:active,
.ui-grid-pager-control button.active,
.open > .dropdown-toggle.ui-grid-pager-control button {
  color: #eeeeee;
  background-color: #dadada;
  border-color: #adadad;
}
.ui-grid-pager-control button:active:hover,
.ui-grid-pager-control button.active:hover,
.open > .dropdown-toggle.ui-grid-pager-control button:hover,
.ui-grid-pager-control button:active:focus,
.ui-grid-pager-control button.active:focus,
.open > .dropdown-toggle.ui-grid-pager-control button:focus,
.ui-grid-pager-control button:active.focus,
.ui-grid-pager-control button.active.focus,
.open > .dropdown-toggle.ui-grid-pager-control button.focus {
  color: #eeeeee;
  background-color: #c8c8c8;
  border-color: #8c8c8c;
}
.ui-grid-pager-control button:active,
.ui-grid-pager-control button.active,
.open > .dropdown-toggle.ui-grid-pager-control button {
  background-image: none;
}
.ui-grid-pager-control button.disabled,
.ui-grid-pager-control button[disabled],
fieldset[disabled] .ui-grid-pager-control button,
.ui-grid-pager-control button.disabled:hover,
.ui-grid-pager-control button[disabled]:hover,
fieldset[disabled] .ui-grid-pager-control button:hover,
.ui-grid-pager-control button.disabled:focus,
.ui-grid-pager-control button[disabled]:focus,
fieldset[disabled] .ui-grid-pager-control button:focus,
.ui-grid-pager-control button.disabled.focus,
.ui-grid-pager-control button[disabled].focus,
fieldset[disabled] .ui-grid-pager-control button.focus,
.ui-grid-pager-control button.disabled:active,
.ui-grid-pager-control button[disabled]:active,
fieldset[disabled] .ui-grid-pager-control button:active,
.ui-grid-pager-control button.disabled.active,
.ui-grid-pager-control button[disabled].active,
fieldset[disabled] .ui-grid-pager-control button.active {
  background-color: #f3f3f3;
  border-color: #cccccc;
}
.ui-grid-pager-control button .badge {
  color: #f3f3f3;
  background-color: #eeeeee;
}
.ui-grid-pager-control input {
  display: block;
  width: 100%;
  height: 34px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555555;
  background-color: #ffffff;
  background-image: none;
  border: 1px solid #cccccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  height: 30px;
  padding: 5px 10px;
  font-size: 12px;
  line-height: 1.5;
  border-radius: 3px;
  display: inline;
  height: 26px;
  width: 50px;
  vertical-align: top;
}
.ui-grid-pager-control input:focus {
  border-color: #66afe9;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
}
.ui-grid-pager-control input::-moz-placeholder {
  color: #999999;
  opacity: 1;
}
.ui-grid-pager-control input:-ms-input-placeholder {
  color: #999999;
}
.ui-grid-pager-control input::-webkit-input-placeholder {
  color: #999999;
}
.ui-grid-pager-control input[disabled],
.ui-grid-pager-control input[readonly],
fieldset[disabled] .ui-grid-pager-control input {
  background-color: #eeeeee;
  opacity: 1;
}
.ui-grid-pager-control input[disabled],
fieldset[disabled] .ui-grid-pager-control input {
  cursor: not-allowed;
}
textarea.ui-grid-pager-control input {
  height: auto;
}
select.ui-grid-pager-control input {
  height: 30px;
  line-height: 30px;
}
textarea.ui-grid-pager-control input,
select[multiple].ui-grid-pager-control input {
  height: auto;
}
.ui-grid-pager-control .ui-grid-pager-max-pages-number {
  vertical-align: bottom;
}
.ui-grid-pager-control .ui-grid-pager-max-pages-number > * {
  vertical-align: middle;
}
.ui-grid-pager-control .first-bar {
  width: 10px;
  border-left: 2px solid #4d4d4d;
  margin-top: -6px;
  height: 12px;
  margin-left: -3px;
}
.ui-grid-pager-control .first-triangle {
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 5px 8.7px 5px 0;
  border-color: transparent #4d4d4d transparent transparent;
  margin-left: 2px;
}
.ui-grid-pager-control .next-triangle {
  margin-left: 1px;
}
.ui-grid-pager-control .prev-triangle {
  margin-left: 0;
}
.ui-grid-pager-control .last-triangle {
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 5px 0 5px 8.7px;
  border-color: transparent transparent transparent #4d4d4d;
  margin-left: -1px;
}
.ui-grid-pager-control .last-bar {
  width: 10px;
  border-left: 2px solid #4d4d4d;
  margin-top: -6px;
  height: 12px;
  margin-left: 1px;
}
.ui-grid-pager-row-count-picker {
  float: left;
}
.ui-grid-pager-row-count-picker select {
  display: block;
  width: 100%;
  height: 34px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555555;
  background-color: #ffffff;
  background-image: none;
  border: 1px solid #cccccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  height: 30px;
  padding: 5px 10px;
  font-size: 12px;
  line-height: 1.5;
  border-radius: 3px;
  height: 26px;
  width: 67px;
  display: inline;
}
.ui-grid-pager-row-count-picker select:focus {
  border-color: #66afe9;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
}
.ui-grid-pager-row-count-picker select::-moz-placeholder {
  color: #999999;
  opacity: 1;
}
.ui-grid-pager-row-count-picker select:-ms-input-placeholder {
  color: #999999;
}
.ui-grid-pager-row-count-picker select::-webkit-input-placeholder {
  color: #999999;
}
.ui-grid-pager-row-count-picker select[disabled],
.ui-grid-pager-row-count-picker select[readonly],
fieldset[disabled] .ui-grid-pager-row-count-picker select {
  background-color: #eeeeee;
  opacity: 1;
}
.ui-grid-pager-row-count-picker select[disabled],
fieldset[disabled] .ui-grid-pager-row-count-picker select {
  cursor: not-allowed;
}
textarea.ui-grid-pager-row-count-picker select {
  height: auto;
}
select.ui-grid-pager-row-count-picker select {
  height: 30px;
  line-height: 30px;
}
textarea.ui-grid-pager-row-count-picker select,
select[multiple].ui-grid-pager-row-count-picker select {
  height: auto;
}
.ui-grid-pager-row-count-picker .ui-grid-pager-row-count-label {
  margin-top: 3px;
}
.ui-grid-pager-count-container {
  float: right;
  margin-top: 4px;
  min-width: 50px;
}
.ui-grid-pager-count-container .ui-grid-pager-count {
  margin-right: 10px;
  margin-left: 10px;
  float: right;
}

/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
.ui-grid-pinned-container {
  position: absolute;
  display: inline;
  top: 0;
}
.ui-grid-pinned-container.ui-grid-pinned-container-left {
  float: left;
  left: 0;
}
.ui-grid-pinned-container.ui-grid-pinned-container-right {
  float: right;
  right: 0;
}
.ui-grid-pinned-container.ui-grid-pinned-container-left .ui-grid-header-cell:last-child {
  box-sizing: border-box;
  border-right: 1px solid;
  border-width: 1px;
  border-right-color: #aeaeae;
}
.ui-grid-pinned-container.ui-grid-pinned-container-left .ui-grid-cell:last-child {
  box-sizing: border-box;
  border-right: 1px solid;
  border-width: 1px;
  border-right-color: #aeaeae;
}
.ui-grid-pinned-container.ui-grid-pinned-container-left .ui-grid-header-cell:not(:last-child) .ui-grid-vertical-bar,
.ui-grid-pinned-container .ui-grid-cell:not(:last-child) .ui-grid-vertical-bar {
  width: 1px;
}
.ui-grid-pinned-container.ui-grid-pinned-container-left .ui-grid-header-cell:not(:last-child) .ui-grid-vertical-bar {
  background-color: #d4d4d4;
}
.ui-grid-pinned-container.ui-grid-pinned-container-left .ui-grid-cell:not(:last-child) .ui-grid-vertical-bar {
  background-color: #aeaeae;
}
.ui-grid-pinned-container.ui-grid-pinned-container-left .ui-grid-header-cell:last-child .ui-grid-vertical-bar {
  right: -1px;
  width: 1px;
  background-color: #aeaeae;
}
.ui-grid-pinned-container.ui-grid-pinned-container-right .ui-grid-header-cell:first-child {
  box-sizing: border-box;
  border-left: 1px solid;
  border-width: 1px;
  border-left-color: #aeaeae;
}
.ui-grid-pinned-container.ui-grid-pinned-container-right .ui-grid-cell:first-child {
  box-sizing: border-box;
  border-left: 1px solid;
  border-width: 1px;
  border-left-color: #aeaeae;
}
.ui-grid-pinned-container.ui-grid-pinned-container-right .ui-grid-header-cell:not(:first-child) .ui-grid-vertical-bar,
.ui-grid-pinned-container .ui-grid-cell:not(:first-child) .ui-grid-vertical-bar {
  width: 1px;
}
.ui-grid-pinned-container.ui-grid-pinned-container-right .ui-grid-header-cell:not(:first-child) .ui-grid-vertical-bar {
  background-color: #d4d4d4;
}
.ui-grid-pinned-container.ui-grid-pinned-container-right .ui-grid-cell:not(:last-child) .ui-grid-vertical-bar {
  background-color: #aeaeae;
}
.ui-grid-pinned-container.ui-grid-pinned-container-first .ui-grid-header-cell:first-child .ui-grid-vertical-bar {
  left: -1px;
  width: 1px;
  background-color: #aeaeae;
}

/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
.ui-grid-column-resizer {
  top: 0;
  bottom: 0;
  width: 5px;
  position: absolute;
  cursor: col-resize;
}
.ui-grid-column-resizer.left {
  left: 0;
}
.ui-grid-column-resizer.right {
  right: 0;
}
.ui-grid-header-cell:last-child .ui-grid-column-resizer.right {
  border-right: 1px solid #d4d4d4;
}
.ui-grid[dir=rtl] .ui-grid-header-cell:last-child .ui-grid-column-resizer.right {
  border-right: 0;
}
.ui-grid[dir=rtl] .ui-grid-header-cell:last-child .ui-grid-column-resizer.left {
  border-left: 1px solid #d4d4d4;
}
.ui-grid.column-resizing {
  cursor: col-resize;
}
.ui-grid.column-resizing .ui-grid-resize-overlay {
  position: absolute;
  top: 0;
  height: 100%;
  width: 1px;
  background-color: #aeaeae;
}

/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
.ui-grid-row-saving .ui-grid-cell {
  color: #848484 !important;
}
.ui-grid-row-dirty .ui-grid-cell {
  color: #610b38;
}
.ui-grid-row-error .ui-grid-cell {
  color: #ff0000 !important;
}

/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
.ui-grid-row.ui-grid-row-selected > [ui-grid-row] > .ui-grid-cell {
  background-color: #c9dde1;
}
.ui-grid-disable-selection {
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  cursor: default;
}
.ui-grid-selection-row-header-buttons {
  cursor: pointer;
  opacity: 0.1;
}
.ui-grid-selection-row-header-buttons.ui-grid-row-selected {
  opacity: 1;
}
.ui-grid-selection-row-header-buttons.ui-grid-all-selected {
  opacity: 1;
}

/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
.ui-grid-tree-row-header-buttons.ui-grid-tree-header {
  cursor: pointer;
  opacity: 1;
}

/* This file contains variable declarations (do not remove this line) */
/*-- VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
/**
* @section Grid styles
*/
/**
* @section Header styles
*/
/** @description Colors for header gradient */
/**
* @section Grid body styles
*/
/** @description Colors used for row alternation */
/**
* @section Sort arrow colors
*/
/**
* @section Scrollbar styles
*/
/**
* @section font library path
*/
/*-- END VARIABLES (DO NOT REMOVE THESE COMMENTS) --*/
.ui-grid-tree-header-row {
  font-weight: bold !important;
}

.ui-grid-icon-plus-squared:before {
  content: '\c350';
}
/* '썐' */
.ui-grid-icon-minus-squared:before {
  content: '\c351';
}
/* '썑' */
.ui-grid-icon-search:before {
  content: '\c352';
}
/* '썒' */
.ui-grid-icon-cancel:before {
  content: '\c353';
}
/* '썓' */
.ui-grid-icon-info-circled:before {
  content: '\c354';
}
/* '썔' */
.ui-grid-icon-lock:before {
  content: '\c355';
}
/* '썕' */
.ui-grid-icon-lock-open:before {
  content: '\c356';
}
/* '썖' */
.ui-grid-icon-pencil:before {
  content: '\c357';
}
/* '썗' */
.ui-grid-icon-down-dir:before {
  content: '\c358';
}
/* '썘' */
.ui-grid-icon-up-dir:before {
  content: '\c359';
}
/* '썙' */
.ui-grid-icon-left-dir:before {
  content: '\c35a';
}
/* '썚' */
.ui-grid-icon-right-dir:before {
  content: '\c35b';
}
/* '썛' */
.ui-grid-icon-left-open:before {
  content: '\c35c';
}
/* '썜' */
.ui-grid-icon-right-open:before {
  content: '\c35d';
}
/* '썝' */
.ui-grid-icon-angle-down:before {
  content: '\c35e';
}
/* '썞' */
.ui-grid-icon-filter:before {
  content: '\c35f';
}
/* '썟' */
.ui-grid-icon-sort-alt-up:before {
  content: '\c360';
}
/* '썠' */
.ui-grid-icon-sort-alt-down:before {
  content: '\c361';
}
/* '썡' */
.ui-grid-icon-ok:before {
  content: '\c362';
}
/* '썢' */
.ui-grid-icon-menu:before {
  content: '\c363';
}
/* '썣' */
.ui-grid-icon-indent-left:before {
  content: '\e800';
}
/* '' */
.ui-grid-icon-indent-right:before {
  content: '\e801';
}
/* '' */
.ui-grid-icon-spin5:before {
  content: '\ea61';
}
/* '' */
