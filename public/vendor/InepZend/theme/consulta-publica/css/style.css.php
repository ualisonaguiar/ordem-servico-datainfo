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
body {
    background-color: #319E93;
    color: #FFF;
    font-weight: bold;
    text-align: left;
}

select, textarea, input[type="text"] {
    border-radius: 0px;
    width: 100%;
}

input[type="text"] {
    border-radius: 0px;
    width: 95%;
}

table {
    overflow:hidden;
    border:1px solid #d3d3d3;
    background:#fefefe;
    width:80%;
    border-radius:5px;
    -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
    -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);    
}

td {
    padding:8px 18px 8px; 
    text-shadow: 1px 1px 1px #fff; 
    background:#E6E6E6;
    border:1px solid #FFF;
}

th {
    padding:8px 18px 8px; 
    text-shadow: 1px 1px 1px #fff; 
    background:#e8eaeb;
    border:1px solid #FFF;
}

.btn {
    width: 90%;
    color: #005299;
}

.panel-heading {
    padding: 0px 0px 0px 0px;
    border-radius: 0px;
}

.panel-default {
    border: 0 none;
}

.disposition {
    margin-left: 18%;
}

#navbarInep {
    background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEYAAAAUCAYAAAAwaEt4AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAwNi8xMS8xNOanadcAAAAedEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzUuMasfSOsAAAKaSURBVFiF1de/i5RHGAfwz3u3e+cZ0agk2EqKlOmWpLg0FiH/gYUJdqaIRBGDkCYBWy0sAknKNGkUREggFhaLCVwRiIWEgJ0QEX9wIp6nZ54UM6PL6+66t+9u9vzCywzMzHee5/s+88wzYjC+iAgRcXLInFfhn4g4mHl6v3cj4nYD3l6cyJxXGnDcj4jPo8fGOdPFPvyAc1ia8l5N8CbO4Ee8Ba0hk6PWjosdOIoFfNbD2ZS3YFJ2LuBQ5vl0WMS0a21THMHHuT+PxQnxFvsWJsT3CY63cKvP4CLWcn8ND/BIUrMaY7PANkmYX7CB23iS++Nwko5nsfNe/tYb8Mlrj1UR8XZtICT17+VNF6Uz+NTLwrwh/f06NiQheznb2ehVzGFXbv8d05Fi5yoeY0+2tYnQz3lbUg6oD7TxUBJmD96R/m45x3O5/6fkbB1LeM+LXBKSgOu4lvv7s2PPGjjSwl+SMEv5a8In29quIuJOn8F5fIVvcRKn84a9eIaP8Fuf9R/ikuR4EbPCTXyAnehKojdJmnM4jJ/wM96XIrAJ5kmK7x0woSTHSv/EtmGwUyH9vXriLkKV8W2j2zsQJTp2YfcE+OCbYbdSUX6Q8xuvIO83XsK8GmH9qCh2Pp0Q34WVavnraRd4/wea5JM6VnC8E92hBd7rgnJcx81Vgeu4iLO4y/DKdxZ4iC/xN7aPML+F31eqZZ3oDoqcP3BKymllThGxJQlxDffrxFsJ6/gVNzazqBPdeYOP1B1c3qwhW02YnfhOqopHeXRux/cr1fL5TnQHXdOL0hVcLzeGYqsJ08aBTa652onuecNzzKYT9CxupUm9qgtWczvJ22kmwlRS7dG0Qi2YStTPSpg16X2zZTGrAi9MLmKmgv8AgrOa5AEeafwAAAAASUVORK5CYII=) 2% 75% no-repeat;
    *background: transparent url(../images/logo-inep.png) 2% 75% no-repeat;
    background-color: #D64931; 
    height: 10px !important;
    z-index: 999;
    margin-top: 15px;
}

#footerBackground {
    background-color: #424242;
    line-height: 32px;
    text-align: center;
    color: #fff;
    position: fixed;
    bottom: 0;
    width: 100%;
}

#contentBackground {
    background-color:  #319E93;
}

#contentContainer {
    min-height: 400px;
    padding: 6px; 
    padding-left: 0px; 
    padding-right: 0px;
    width: 100%;
}

.divRender {
    position:relative; 
    width: 20%; 
    left:40%; 
    height: 100%;
}

.divRenderContainer {
    position: static; 
    background-color: #FFF; 
    width: 100%; 
    min-height: 100px;
    color: #2E2E2E;
    font-weight: normal;
    font-size: 14px;
}

.divRenderContainerComBarra {
    position: static; 
    background-color: #FFF; 
    width: 100%; 
    min-height: 100px;
    color: #2E2E2E;
    font-weight: normal;
    font-size: 14px;
    border-bottom: solid #D64931;
    border-top: solid #D64931;
}

.divRenderContainer h1 {
    color: #19597d;
}

.divRenderContainer hr {
    color: #E6E6E6;
    width: 80%;
}

.divLogoRenderBig {
    text-align: center; 
    height: 180px
}

.divLogoRenderSmall {    
    text-align: left; 
    height: 60px;
}

.btnDefault {
    float: none;
    border-radius: 0px;
    width: 100%;
}

#buttonControlFontSize {
    width: 60px; 
    margin-top: 23px; 
    float: right;
}

.appVersion {
    color: #FFF !important;
    margin-top: -10px;
}