<?php

namespace InepZend\View\Renderer;

use InepZend\Util\AttributeStaticTrait;
use Zend\View\Renderer\PhpRenderer;

class Renderer
{

    use AttributeStaticTrait;

    const FILTER_CONTENT_LEVEL_FULL = 'full';
    const FILTER_CONTENT_LEVEL_BASIC = 'basic';
    const FILTER_CONTENT_LEVEL = self::FILTER_CONTENT_LEVEL_FULL;

    private static $booExecuteFilter = true;

    public static function setExecuteFilter($booExecuteFilter = null)
    {
        return self::setAttributeStatic('booExecuteFilter', $booExecuteFilter);
    }

    public static function getExecuteFilter()
    {
        return self::getAttributeStatic('booExecuteFilter');
    }

    public static function filterContent($strContent)
    {
        switch (self::FILTER_CONTENT_LEVEL) {
            case self::FILTER_CONTENT_LEVEL_FULL: {
                    $arrSearch = array(
                        /* ";\r\n", */ ":\r\n",
                        /* ".\r\n", */ ",\r\n",
                        ">\r\n", "<\r\n",
                        ")\r\n", "(\r\n",
                        "]\r\n", "[\r\n",
                        "}\r\n", "{\r\n",
                        /* ";\n\r", */ ":\n\r",
                        /* ".\n\r", */ ",\n\r",
                        ">\n\r", "<\n\r",
                        ")\n\r", "(\n\r",
                        "]\n\r", "[\n\r",
                        "}\n\r", "{\n\r",
                        /* ";\r", */ ":\r",
                        /* ".\r", */ ",\r",
                        ">\r", "<\r",
                        ")\r", "(\r",
                        "]\r", "[\r",
                        "}\r", "{\r",
                        /* ";\n", */ ":\n",
                        /* ".\n", */ ",\n",
                        ">\n", "<\n",
                        /* ")\n", */ "(\n",
                        "]\n", "[\n",
                        "}\n", "{\n",
                        "\t", "\r",
                        "    ", "   ", "  ",
                    );
                    $arrReplace = array(
                        /* ";", */ ":",
                        /* ".", */ ",",
                        ">", "<",
                        ")", "(",
                        "]", "[",
                        "}", "{",
                        /* ";", */ ":",
                        /* ".", */ ",",
                        ">", "<",
                        ")", "(",
                        "]", "[",
                        "}", "{",
                        /* ";", */ ":",
                        /* ".", */ ",",
                        ">", "<",
                        ")", "(",
                        "]", "[",
                        "}", "{",
                        /* ";", */ ":",
                        /* ".", */ ",",
                        ">", "<",
                        /* ")", */ "(",
                        "]", "[",
                        "}", "{",
                        " ", " ",
                        " ", " ", " ",
                    );
                    preg_match_all('!(&lt;(?:code|pre).*&gt;[^&lt;]+&lt;/(?:code|pre)&gt;)!', (string) $strContent, $arrPre);
                    $strContent = preg_replace('!&lt;(?:code|pre).*&gt;[^&lt;]+&lt;/(?:code|pre)&gt;!', '#pre#', $strContent);
                    $strContent = preg_replace('#&lt;!--[^\[].+--&gt;#', '', $strContent);
                    if (!empty($arrPre[0]))
                        foreach ($arrPre[0] as $strTag)
                            $strContent = preg_replace('!#pre#!', $strTag, $strContent, 1);
                    $strContent = trim(str_replace($arrSearch, $arrReplace, $strContent));
                    break;
                }
            case self::FILTER_CONTENT_LEVEL_BASIC: {
                    $strContent = trim(str_replace(array("\t", "\r", "    ", "   ", "  "), ' ', (string) $strContent));
                    break;
                }
        }
        return $strContent;
    }

    public static function setFilterContentIntoRenderer($renderer)
    {
        if ((self::getExecuteFilter()) && (is_object($renderer)) && ($renderer instanceof PhpRenderer)) {
            $renderer->getFilterChain()->attach(function ($strContent) {
                        return self::filterContent($strContent);
                    }
            );
            return true;
        }
        return false;
    }

}
