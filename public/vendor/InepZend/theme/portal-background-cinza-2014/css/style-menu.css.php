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
.menuVerticalSize {
    width: 210px;
    display: table-cell;
    vertical-align: top;
}

.menuList{
    width: 100%;
    margin: 0;
    padding: 0;
    list-style: none;
}
.menuList li a{
    min-height: 19px;
    display: block;
    cursor: pointer;
    position: relative;
    margin-top: 2px;
    padding: 0.5em 0.5em 0.5em 0.7em;
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAAAbCAYAAAA58sAfAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAACV0RVh0U29mdHdhcmUATWFjcm9tZWRpYSBGaXJld29ya3MgTVggMjAwNId2rM8AAAAWdEVYdENyZWF0aW9uIFRpbWUAMDgvMzEvMTDLNYXzAAAA9UlEQVR4nO3csW3CQBhH8efDUlKkcJeCIhskK8AGCAbAG0Q0qanTJCOQARAj4BXIBmzgDS4FiZSGr72TeL/S1b950rn5mpwz36tVB2yBNdAh3a4R+AK2z/v92P5+PACzYpOkenTAK/ACzJvTcrkGdkUnSXXqE9CXXiFVqk/4tJKumaXSC6SaGYgUMBApYCBSwECkgIFIAQORAgYiBdrJ/V3pDVK12ofpY+kNUrV8YkkBA5ECBiIFDEQKGIgUMBApYCBSwECkQAKG0iOkSg0JL5pI1+yanDPnt80RjzdI/w1P7x/zv3+QBfDJ5aqcdMtGLi0sAH4AMWUe1mXsfhAAAAAASUVORK5CYII=) no-repeat scroll 0 0 transparent;
    *background: url("../../../images/back_menu_semseta.png") no-repeat scroll 0 0 transparent;
}

.menuList li a:link,
.menuList li a:active,
.menuList li a:visited {
    padding: 4px 6px;
    border: none;
    margin: 5px 5px 0px 5px;
    font-family: Verdana;
    font-size: 13px;
    font-weight: normal;
    text-decoration: none;
    color:#FFF;
    border-bottom: 1px solid #FFF;
}
.menuList .ui-accordion a.ui-state-active {
    background-position: 0 -27px !important;
}

/* Inicio do SubMenu */

.menuList li ul{
    width: 190px;
    padding:1px 0 7px 0 !important;
    margin: auto !important;
    height: auto;
}

.menuList li ul li{
    padding: 0!important;
}

.menuList li ul li a {
    display: block;
    margin: 0px;
    padding-right: 15px;
    color:rgb(51,51,51);
    border-top:1px solid #fdf4f5!important;
    border-bottom:1px solid #F7DCDB;
}

.menuList li ul li a:link, .menuList li ul li a:active, .menuList li ul li a:visited {
    background: none!important;
    color: #333;
    border-top: 1px solid #fdf4f5!important;
    margin: 0px !important;
    font-family: Verdana!important;
    padding: 4px 12px 4px 5px;
    border-bottom: 1px solid #e1c6c5;
    color: #333;
}

.menuList li ul li a:hover {
    color: white;
    background: none repeat scroll 0% 0% rgb(239, 132, 127) !important;
    border-top:1px solid #e07570;
    border-bottom:1px solid #fe938e;    
}

.menuList .level-1 > li:first-child a {
    margin-top: 0;
}

.menuList li:first-child > a {
    border-top: 1px solid rgba(0, 0, 0, 0);
}

.menuList li ul {
    margin: auto;
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMAAAAACCAYAAAAO/NO4AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNXG14zYAAAAWdEVYdENyZWF0aW9uIFRpbWUAMjMuMDMuMTHbJ+0rAAAA7klEQVQ4jZ1TQRKDQAgLM706/f9X2nf4HnoQ2ZBld8Z6UFkgCUHt/HwdAOCAAzAD3K8nrsydhiFuEXjk7/MSY4ApbtYxx53H0DHxGwUYfdkl9SQheg0e5O2cjE+QBrpEA5UWH0zn7/CnoatHSw/EMwjciIPwjx0kCM/JRqhnD3dgxafGyO4bYyoiWO/AIiE7IO2v93Ggu3TWQtC8N9ijvzE9Mb3GiUfnqckBt5mHa/IsDQ9eq7q0f/fkeuaA5KbaAFjN2eHuOFTbbp6pn/1kLeKpUT3Ea8gMqx1kTD+xW813mp/soPwQWPhKBKsd/AC/Qa95jQuBggAAAABJRU5ErkJggg==) repeat-x scroll 0px 0px, url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMAAAAADCAYAAADFoAAdAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNXG14zYAAAAWdEVYdENyZWF0aW9uIFRpbWUAMjMuMDMuMTHbJ+0rAAAAUklEQVRIie3OwQ2AIAxA0U8TeiCcYP/dWEBPSEyMxSmUg30TvHC2Nq13nPsbyRmJpRJUV1+c+1RQJZZKuPsxMePaN2wMMFt9c+49IkhKxFJBhAeX0RUPMKnWcQAAAABJRU5ErkJggg==) no-repeat scroll left bottom rgb(246, 212, 212)!important;
    *background: url("../../../images/sombra_menu.png") repeat-x scroll 0px 0px, url("../../../images/last_child_submenu_level2.png") no-repeat scroll left bottom rgb(246, 212, 212)!important;
    border:none;
    height: auto;
}

.menuList li:first-child > a {
    border-top: 1px solid transparent;
}

.ui-accordion a:link {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAAA2CAYAAACCwNb3AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAK8AAACvABQqw0mAAAACV0RVh0U29mdHdhcmUATWFjcm9tZWRpYSBGaXJld29ya3MgTVggMjAwNId2rM8AAARCSURBVHic7dzPbhNXHMXx79y5M/ZMTHGgQgos2kXCsi2ooO6avgEiajetVPoELYuyLd120z4ClciGCPURmu4qUQmVZcgiLAJqBTQFE+zYc28Xjg3544kd7CTjno8URfKMf5qRfDTX1swJvPfcm5urAteBrxH5f1sDfgauv3f79prdfPFX4IPDOyaRI6NK+0LxPvBJ8Ofly18CNw71kESOpisWuHLYRyGyH945nHO4LAPv8d73/d4gCAiMITAGs/l/F5csMDuk4xU5EN57XJaRNZtYG5CmESYMB57jsoxGvUmz4bHR5owgeH2X2V1jI3KUuSyj1WiQJBHJRHlf4QAwYUgyUSZJIjYajfaVaKuqAiKF4p2jtbGBMR4b273f0AcbW0LjaTWbeOe2bFNApFCcc7QaDdJKMtS5cSmi2WjgFBApMpdl7SvIPpdVvcTlEq2NDV1BpNi892Q7vysMhcsyBUQKzvv23yhGO7fjp2IFRAonLx6rS8usLi0PvK3XXAVExsrsnbvM3rm7IwirS8vdbYOwNi0P8/hERirDEcZRz+33P/+UmfkFZu/cZfHCOc6cne6Go7O9lzCOCJMSr2ciWPn2m9Es6ERGoP68xtrDR1TTUu5+M/MLACxeONdXOADW1htUT09RPlbpvqYlloylThj6DUcvCoiMrU4o9hsOUEBkzL1JOEABkaIJINh7r/2NDnYOV0CkUDrPcbSazaHObdTr7edDtt7uroBIsQTGEEYRtWe1oc6tPath4whjtt7jpYBIoZgwJErK1FsZ9fX1ocz898k/ZCYkShKM3RqQ4dxQL3JAQmuJ05TKyRM8Xn1IyT6jcvwYSWVi4Fkvay9Ye/wUH0VUT08Rp8n2u4TXLLCIHruVggiMISqXSCcnAXjx5Cl/PfqbZr3efTZ97yEBxlriJCE5/haVkydIq1VsqbT92fRFS7vRZHboZyIyIsZaShMpJgyJJ1IqL+tkzSbe9Vfc0Pmib+OIKEmI0wRbKhHaHQuqnwLvPQ+uXf0FuDSKkxEZFe8crpWRZa1Xt6r3c+NU0A6JMSHGhpgw3K3V5MY7P/z4VdBJ3INrV7+jXQH07jBPQqRgVmiH43vY/JK+WT06icIhUgUm783NVVU9KrKTqkdF+qTqUSkuVY+K7ELVoyI5VD0q0oOqR0VyqHpUJIeqR0VyqHpUJI+qR0XyDRKPmfmF7T/dDjRXAZGxNTO/AN4zc/NW3yHZTtWjUih7VY92dJsVL57n49//YObmLe5/8Vnu8my36lE7MXXqzY9a5ICEz2tstHIaTYKgfcWAbjfvbx992FdISpPHSU+9repRGV+vwnGeM2enAboh6S63BqDSBhkrixfOAXTD0XHm7DSLF8/vui2PAiJjJe/DP0gwOrTEkmJR9ahIb6oeFcmh6lGRHKoeFcmh6lGRHKoeFdmDqkdF+qDqUZGDt8Jr1aP/AW0mIOViK5zfAAAAAElFTkSuQmCC) no-repeat scroll 0 0 transparent!important;
    *background: url("../../../images/back_menu.png") no-repeat scroll 0 0 transparent!important;
    font-weight: normal;
}

.ui-accordion-header {
    min-height: 20px !important;
}