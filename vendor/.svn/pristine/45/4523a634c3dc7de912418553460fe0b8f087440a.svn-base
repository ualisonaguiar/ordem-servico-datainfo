<?php
namespace InepZend\Util;

use InepZend\Util\PhpIni;
use Zend\Config\Reader\Xml as ZendXml;
use \DOMDocument as DOMDocumentNative;
use \DOMXPath as DOMXPathNative;

/**
 * Classe responsavel no tratamento de operacoes em arquivos/conteudos xml.
 *
 * @package InepZend
 * @subpackage Util
 */
class Xml extends ZendXml
{

    public static function getDomDocument($strXmlPath = null, $strXmlContent = null, $booClearXmlContent = null)
    {
        $domDocument = new DOMDocumentNative();
        if (! empty($strXmlPath))
            $domDocument->load($strXmlPath);
        elseif (! empty($strXmlContent)) {
            if ($booClearXmlContent)
                $strXmlContent = str_ireplace(array(
                    '<saw:',
                    '</saw:',
                    ' xmlns:',
                    '<sawx:',
                    '</sawx:',
                    ' xsi:',
                    ' xs:'
                ), array(
                    '<saw',
                    '</saw',
                    ' xmlns',
                    '<sawx',
                    '</sawx',
                    ' xsi',
                    ' xs'
                ), $strXmlContent);
            $domDocument->loadXML($strXmlContent);
        }
        return $domDocument;
    }

    public static function getDomXPath(DOMDocumentNative $domDocument = null)
    {
        return new DOMXPathNative($domDocument);
    }

    public static function schemaValidate($strXmlPath = null, $strXmlSchemaPath = null, $intMaxError = null, $booPhpIni = true)
    {
        if ((empty($strXmlPath)) || (empty($strXmlSchemaPath)))
            return false;
        if ($booPhpIni) {
            PhpIni::setTimeLimit(0);
            PhpIni::allocatesMemory(-1);
        }
        $domDocument = self::getDomDocument($strXmlPath);
        if (! is_object($domDocument))
            return false;
        $arrError = array();
        libxml_use_internal_errors(true);
        if (! $domDocument->schemaValidate($strXmlSchemaPath))
            $arrError = (!is_numeric($intMaxError)) ? libxml_get_errors() : reset(array_chunk(libxml_get_errors(), $intMaxError, true));
        libxml_clear_errors();
        return (empty($arrError)) ? true : $arrError;
    }

    public static function convertToArray($strPathXml = null, $booPhpIni = true)
    {
        if (empty($strPathXml))
            return false;
        if ($booPhpIni) {
            PhpIni::setTimeLimit(0);
            PhpIni::allocatesMemory(-1);
        }
        return (new ZendXml())->fromFile($strPathXml);
    }

    public static function convertToXsdToArray($strPathXsd = null, $strPathXml = null)
    {
        if (empty($strPathXsd))
            return false;
        if (empty($strPathXml))
            $strPathXml = str_ireplace('.xsd', '.xml', $strPathXsd);
        $domDocument = new DOMDocumentNative();
        $domDocument->preserveWhiteSpace = true;
        $domDocument->load($strPathXsd);
        $domDocument->save($strPathXml);
        $strJson = json_encode(@simplexml_load_string(str_replace($domDocument->lastChild->prefix . ':', '', file_get_contents($strPathXml)), 'SimpleXMLElement', LIBXML_COMPACT));
        unlink($strPathXml);
        return json_decode($strJson, true);
    }
    
}
