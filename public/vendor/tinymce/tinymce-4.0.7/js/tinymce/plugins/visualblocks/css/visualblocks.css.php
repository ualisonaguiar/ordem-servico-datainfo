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
.mce-visualblocks p {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin-left: 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhCQAJAJEAAAAAAP///7u7u////yH5BAEAAAMALAAAAAAJAAkAAAIQnG+CqCN/mlyvsRUpThG6AgA7);
}

.mce-visualblocks h1 {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin-left: 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhDQAKAIABALu7u////yH5BAEAAAEALAAAAAANAAoAAAIXjI8GybGu1JuxHoAfRNRW3TWXyF2YiRUAOw==);
}

.mce-visualblocks h2 {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin-left: 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhDgAKAIABALu7u////yH5BAEAAAEALAAAAAAOAAoAAAIajI8Hybbx4oOuqgTynJd6bGlWg3DkJzoaUAAAOw==);
}

.mce-visualblocks h3 {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin-left: 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhDgAKAIABALu7u////yH5BAEAAAEALAAAAAAOAAoAAAIZjI8Hybbx4oOuqgTynJf2Ln2NOHpQpmhAAQA7);
}

.mce-visualblocks h4 {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin-left: 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhDgAKAIABALu7u////yH5BAEAAAEALAAAAAAOAAoAAAIajI8HybbxInR0zqeAdhtJlXwV1oCll2HaWgAAOw==);
}

.mce-visualblocks h5 {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin-left: 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhDgAKAIABALu7u////yH5BAEAAAEALAAAAAAOAAoAAAIajI8HybbxIoiuwjane4iq5GlW05GgIkIZUAAAOw==);
}

.mce-visualblocks h6 {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin-left: 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhDgAKAIABALu7u////yH5BAEAAAEALAAAAAAOAAoAAAIajI8HybbxIoiuwjan04jep1iZ1XRlAo5bVgAAOw==);
}

.mce-visualblocks div {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin-left: 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhEgAKAIABALu7u////yH5BAEAAAEALAAAAAASAAoAAAIfjI9poI0cgDywrhuxfbrzDEbQM2Ei5aRjmoySW4pAAQA7);
}

.mce-visualblocks section {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin: 0 0 1em 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhKAAKAIABALu7u////yH5BAEAAAEALAAAAAAoAAoAAAI5jI+pywcNY3sBWHdNrplytD2ellDeSVbp+GmWqaDqDMepc8t17Y4vBsK5hDyJMcI6KkuYU+jpjLoKADs=);
}

.mce-visualblocks article {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin: 0 0 1em 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhKgAKAIABALu7u////yH5BAEAAAEALAAAAAAqAAoAAAI6jI+pywkNY3wG0GBvrsd2tXGYSGnfiF7ikpXemTpOiJScasYoDJJrjsG9gkCJ0ag6KhmaIe3pjDYBBQA7);
}

.mce-visualblocks blockquote {
	padding-top: 10px;
	border: 1px dashed #BBB;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhPgAKAIABALu7u////yH5BAEAAAEALAAAAAA+AAoAAAJPjI+py+0Knpz0xQDyuUhvfoGgIX5iSKZYgq5uNL5q69asZ8s5rrf0yZmpNkJZzFesBTu8TOlDVAabUyatguVhWduud3EyiUk45xhTTgMBBQA7);
}

.mce-visualblocks address {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin: 0 0 1em 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhLQAKAIABALu7u////yH5BAEAAAEALAAAAAAtAAoAAAI/jI+pywwNozSP1gDyyZcjb3UaRpXkWaXmZW4OqKLhBmLs+K263DkJK7OJeifh7FicKD9A1/IpGdKkyFpNmCkAADs=);
}

.mce-visualblocks pre {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin-left: 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhFQAKAIABALu7uwAAACH5BAEAAAEALAAAAAAVAAoAAAIjjI+ZoN0cgDwSmnpz1NCueYERhnibZVKLNnbOq8IvKpJtVQAAOw==);
}

.mce-visualblocks figure {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin: 0 0 1em 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhJAAKAIAAALu7u////yH5BAEAAAEALAAAAAAkAAoAAAI0jI+py+2fwAHUSFvD3RlvG4HIp4nX5JFSpnZUJ6LlrM52OE7uSWosBHScgkSZj7dDKnWAAgA7);
}

.mce-visualblocks hgroup {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin: 0 0 1em 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhJwAKAIABALu7uwAAACH5BAEAAAEALAAAAAAnAAoAAAI3jI+pywYNI3uB0gpsRtt5fFnfNZaVSYJil4Wo03Hv6Z62uOCgiXH1kZIIJ8NiIxRrAZNMZAtQAAA7);
}

.mce-visualblocks aside {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin: 0 0 1em 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhHgAKAIABAKqqqv///yH5BAEAAAEALAAAAAAeAAoAAAItjI+pG8APjZOTzgtqy7I3f1yehmQcFY4WKZbqByutmW4aHUd6vfcVbgudgpYCADs=);
}

.mce-visualblocks figcaption {
	border: 1px dashed #BBB;
}

.mce-visualblocks ul {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin: 0 0 1em 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhDQAKAIAAALu7u////yH5BAEAAAEALAAAAAANAAoAAAIXjI8GybGuYnqUVSjvw26DzzXiqIDlVwAAOw==)
}

.mce-visualblocks ol {
	padding-top: 10px;
	border: 1px dashed #BBB;
	margin: 0 0 1em 3px;
	background: transparent no-repeat url(data:image/gif;base64,R0lGODlhDQAKAIABALu7u////yH5BAEAAAEALAAAAAANAAoAAAIXjI8GybH6HHt0qourxC6CvzXieHyeWQAAOw==);
}
