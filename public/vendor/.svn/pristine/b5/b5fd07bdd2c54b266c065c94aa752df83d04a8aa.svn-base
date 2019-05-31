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
    padding-top: 60px;
    padding-bottom: 40px;
}

.zf-green {
    color: #68b604;
}

.btn-success {
    background-color: #57a900;
    background-image: -moz-linear-gradient(top, #70d900, #57a900);
    background-image: -ms-linear-gradient(top, #70d900, #57a900);
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#70d900), to(#57a900));
    background-image: -webkit-linear-gradient(top, #70d900, #57a900);
    background-image: -o-linear-gradient(top, #70d900, #57a900);
    background-image: linear-gradient(top, #70d900, #57a900);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#70d900', endColorstr='#57a900', GradientType=0);
}

.btn-success:hover,
.btn-success:active,
.btn-success.active,
.btn-success.disabled,
.btn-success[disabled] {
    background-color: #57a900;
}

.btn-success:active, .btn-success.active {
    background-color: #57a900;
}

div.container a.brand {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAPCAYAAAAceBSiAAAAAXNSR0IArs4c6QAAAAZiS0dEAH8A9wAAMkqpNAAAAAlwSFlzAAAuIwAALiMBeKU/dgAAAAd0SU1FB9wCCwIWGuaXOlYAAAJiSURBVDjLldS/i1xVFAfwz8leJxF/FdFUNjayhYpCkBATxEIwb0D/ADFpIjMgCDGQQtBCIWVAY/EmIGKbRpt9q6CFplIL8UfvL2SLqBBRUHzDsdi3O7Ozb7KbA493udz7Pff7Pd9zYtyUkumrCI/YfxzARvJgcDeeT54Mbs/cP0iBCNEB7i/SNMNxPIBPcCRu4eURMwaS2DNd908Ir0yq9sfgTRxZBN7jyw7xh4KpdA73LGaL8Lf0MoZia8tnddW+PVorgWdvQa0tipFsYHhTxqO18miEr3N29Y9J1R6GcVMCr+PfbfhZgl1Kd/9ppm8nw/ZjbiL3aK0U4TtptZMqUNVVu754drxWHhKOZjoYsYvwivTBZNhu9BpuSVzGagcWeK8v8agpDU7NG6nHYNdsSt0rxyLr0xHen6vUF3XVHtvFuClv4LUdFd0dv9ZVe/+4KSdxEY/hF5wvPYnvjXAps2OS/slwtudcZHphrlX7uyM9060v4Wi3XsWV0iPFhzgcIaXo2ur7Jb16Q/qyx9it9DMuT4bbd1/FIfyEb7ASC2zeifBSpuzYvFtX7dmlpmzKwKZC/9VVm/NmjTCd35sr1Sk0OBdzQI8H13BbpojwZ2ek6zmTcUud63XV3uic/pRwAceSg8Gh5L5J1f7ek/g41nG1rtoXS5d4Jfg0GUSHntwhNRELTtp8yQVcGTflOVyVBjk79NuSxA/jI3yOEZRuUq3jztgebGBF7Jx6He2MNOgecl4YzE0/OLOkSm/hLgwxHTfFgeB08PQe7bLTxrHpdpzoBn5E+gtn6qptllx9YnHjf9NI2tXkjbmCAAAAAElFTkSuQmCC) no-repeat scroll 0 10px transparent;
    *background: url("../images/zf2-logo.png") no-repeat scroll 0 10px transparent;
    margin-left: 0;
    padding: 8px 20px 12px 40px;
}
