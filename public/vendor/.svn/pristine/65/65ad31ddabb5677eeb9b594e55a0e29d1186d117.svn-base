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
.icoFontSize{height:15px;width:15px;cursor:pointer;float:left;margin-top:4px;margin-left:1px}.icoFontSizeNormal{background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEgAACxIB0t1+/AAAAAd0SU1FB9wJGxIJIjggSagAAAD2SURBVCjP3ZCxLgQBEIa/vXXH6TZIRCSi0V0kJyqJSqG54hQKhVdQ8SR4AUQknkOlJaIUJaI4bLP3KUwhm9tFa6rJP/PN/2fgf5Q6pm6rp2rnr3BX/fCrTtS5qt1GCWwDW8BESGvA0q9gIAN2gGvgDFgEOmr6U9xE3Yi4x+qq+qheqbNqU21UwS31Un1V+6FdxLF1daou9gzQB56BvCiK+egBdoFBXeyDcBmqt+qN+hTaQF0oM8k3+AGYBs6BFyAF3oAesAzsAYdJkgzLrpvhcJfneaq21cmY7avv6r3arIt8NGKWxddVW6PgcbWnZhX/WFG7Zf0TEafjCvK1qBAAAAAASUVORK5CYII=);*background:url(../images/a_normal.png)}.icoFontSizePlus{background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAACV0RVh0U29mdHdhcmUATWFjcm9tZWRpYSBGaXJld29ya3MgTVggMjAwNId2rM8AAAAWdEVYdENyZWF0aW9uIFRpbWUAMDQvMjcvMTFjmal9AAAA3ElEQVR4nJ2S0RGCQAxEH47/0oF0IB1IB1ICJWgH2AElWAJ2QAmUYAl0sH4YMXcc42hmMhNym2Q3IZPEv7b5AVsCzbfiEhiALsrXcfE2UdwDe+AIjNaoMM+BynADkrzXCq2XNGhpkyTi4t4eWwcs7K21RjPea86Bk8UdcLc40BmY63R2VL2Eh30XjgUx7dHAjctNlqsjeUiat10CBxe3Fk/Azqj3a7RviY3GFlCWRKbX7/mecLHbervZ3a+O0Ty58bdLeBctLjhVbn2Wmj5nw+EWmitJ+cpkJJUpzU/jl3dV6hQKOgAAAABJRU5ErkJggg==);*background:url(../images/a_mais.png)}.icoFontSizeMinus{background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAACV0RVh0U29mdHdhcmUATWFjcm9tZWRpYSBGaXJld29ya3MgTVggMjAwNId2rM8AAAAWdEVYdENyZWF0aW9uIFRpbWUAMDQvMjcvMTFjmal9AAAAoUlEQVR4nM2T0Q3CMAxEXxEDdAMySkdghIzACGxAR2CEjgAblA0YIUxwfOAiY4WC+gMnWUocP+tsKY0klmq1mPw7eAcMQLJ7D8jFOBWuA5iAg50LkK347GqeMJJ89HpokFQkteH9JWKiGLi1JvlbOAegSLrOwX5h2c3a2WwbO9dlXZLe6/jJ9rSoLhSMlq8uztu+AKdgbA/cgLbmuvnZx7gDqI8KkJf9ulEAAAAASUVORK5CYII=);*background:url(../images/a_menos.png)}