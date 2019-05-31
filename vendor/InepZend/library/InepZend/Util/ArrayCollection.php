<?php

namespace InepZend\Util;

use Zend\Stdlib\ArrayUtils;
use InepZend\Util\stdClass;
use InepZend\Util\String;
use InepZend\Util\Xml;

/**
 * Classe responsavel em conversoes de dados em array.
 *
 * @package InepZend
 * @subpackage Util
 */
class ArrayCollection extends ArrayUtils
{

    /**
     * Metodo responsavel em converter um objeto em array.
     *
     * @example \InepZend\Util\ArrayCollection::objectToArray(new \InepZend\Util\stdClass())
     *
     * @param object $element
     * @param boolean $booConvertCaracterEspecial
     * @param integer $intMaxDeep
     * @param integer $intDeep
     * @return array
     *
     * @assert (new \InepZend\Util\stdClass()) === array()
     * @assert ((new \InepZend\Util\stdClass(array('chave' => 'valor')))) === array('chave' => 'valor')
     */
    public static function objectToArray($element = null, $booConvertCaracterEspecial = false, $intMaxDeep = null, $intDeep = 0)
    {
        if (!is_bool($booConvertCaracterEspecial))
            $booConvertCaracterEspecial = false;
        ++$intDeep;
        if ((!is_null($intMaxDeep)) && ($intDeep > $intMaxDeep))
            return;
        $strClassName = str_replace('\\', '\\\\', get_class($element));
        $arrObject = (array) $element;
        $newArray = array();
        foreach ($arrObject as $strKey => $mixValue) {
            if (is_object($mixValue))
                $mixValue = self::objectToArray($mixValue, $booConvertCaracterEspecial, $intMaxDeep, $intDeep);
            $strRegexObject = '|' . $strClassName . '.(.*)$|x';
            $strRegexAsterisco = '|\*.(.*)$|x';
            $arrConsertado = array();
            if (@preg_match($strRegexObject, $strKey, $arrConsertado))
                $newArray[$arrConsertado[1]] = (($booConvertCaracterEspecial === true) && (is_string($mixValue))) ? Html::convertAccent($mixValue) : $mixValue;
            elseif (@preg_match($strRegexAsterisco, $strKey, $arrConsertado))
                $newArray[$arrConsertado[1]] = (($booConvertCaracterEspecial === true) && (is_string($mixValue))) ? Html::convertAccent($mixValue) : $mixValue;
            else
                $newArray[$strKey] = (($booConvertCaracterEspecial === true) && (is_string($mixValue))) ? Html::convertAccent($mixValue) : $mixValue;
        }
        return $newArray;
    }

    /**
     * Metodo responsavel em converter um objeto em array de forma recursiva.
     *
     * @example $element = new \InepZend\Util\stdClass(array('atributo' => new \stdClass())); <br /> \InepZend\Util\ArrayCollection::objectToArrayRecursive($element)
     *
     * @param mix $mixElement
     * @param boolean $booConvertCaracterEspecial
     * @param integer $intDeepMax
     * @param integer $intDeep
     * @return array
     *
     * @assert (new \InepZend\Util\stdClass()) === array()
     * @assert ((new \InepZend\Util\stdClass(array('atributo' => new \stdClass())))) === array('atributo' => array())
     */
    public static function objectToArrayRecursive($mixElement = null, $booConvertCaracterEspecial = false, $intDeepMax = null, $intDeep = 0)
    {
        if (!is_bool($booConvertCaracterEspecial))
            $booConvertCaracterEspecial = false;
        $booArray = (is_array($mixElement));
        if (!$booArray)
            $mixElement = array($mixElement);
        if (is_null($intDeep))
            $intDeep = 0;
        if ((is_numeric($intDeepMax)) && ($intDeep >= $intDeepMax))
            return;
        ++$intDeep;
        foreach ($mixElement as $mixKey => $element) {
            if (is_array($element)) {
                $mixElement[$mixKey] = self::objectToArrayRecursive($element, $booConvertCaracterEspecial, $intDeepMax, $intDeep);
                continue;
            }
            if (!is_object($element))
                continue;
            $strClassName = str_replace('\\', '\\\\', get_class($element));
            $arrObject = (array) $element;
            $newArray = array();
            foreach ($arrObject as $strKey => $mixValue) {
                if (is_object($mixValue))
                    $mixValue = self::objectToArrayRecursive($mixValue, $booConvertCaracterEspecial, $intDeepMax, $intDeep);
                elseif ((is_array($mixValue)) && (count($mixValue) > 0) && (array_key_exists(0, $mixValue)) && (@is_object($mixValue[0]))) {
                    $arrValue = array();
                    foreach ($mixValue as $entity)
                        $arrValue[] = self::objectToArrayRecursive($entity, $booConvertCaracterEspecial, $intDeepMax, $intDeep);
                    $mixValue = $arrValue;
                }
                $strRegexObject = '|' . $strClassName . '.(.*)$|x';
                $strRegexAsterisco = '|\*.(.*)$|x';
                $arrConsertado = array();
                if (@preg_match($strRegexObject, $strKey, $arrConsertado)) {
                    if ($arrConsertado[1] == '')
                        $arrConsertado[1] = get_class($element[0]) . '_' . $strKey;
                    else {
                        if (@preg_match($strRegexAsterisco, $strKey, $arrConsertadoAsterisco)) {
                            if ($arrConsertadoAsterisco[1] == '')
                                $arrConsertadoAsterisco[1] = get_class($element[0]) . '_' . $strKey;
                            $arrConsertado[1] = $arrConsertadoAsterisco[1];
                        }
                    }
                    $newArray[$arrConsertado[1]] = (($booConvertCaracterEspecial === true) && (is_string($mixValue))) ? Html::convertAccent($mixValue) : $mixValue;
                } elseif (@preg_match($strRegexAsterisco, $strKey, $arrConsertado)) {
                    if ((is_array($mixValue)) && (count($mixValue) > 0) && (array_key_exists(0, $mixValue)) && (@is_object($mixValue[0])))
                        $mixValue = self::objectToArrayRecursive($mixValue, $booConvertCaracterEspecial, $intDeepMax, $intDeep);
                    $newArray[$arrConsertado[1]] = (($booConvertCaracterEspecial === true) && (is_string($mixValue))) ? Html::convertAccent($mixValue) : $mixValue;
                } else
                    $newArray[$strKey] = (($booConvertCaracterEspecial === true) && (is_string($mixValue))) ? Html::convertAccent($mixValue) : $mixValue;
            }
            $mixElement[$mixKey] = $newArray;
        }
        return (!$booArray) ? $mixElement[0] : $mixElement;
    }

    /**
     * Metodo responsavel em retornar um elemento do array de dados parametrizados
     * randomicamente.
     *
     * @example \InepZend\Util\ArrayCollection::randArray($arrData)
     *
     * @param array $arrData
     * @return mix
     *
     * @assert (array(1, 2, 3, 4)) != array()
     * @assert (array(1)) === 1
     */
    public static function randArray($arrData = null)
    {
        if (empty($arrData))
            return;
        if (!is_array($arrData))
            $arrData = array($arrData);
        return $arrData[rand(0, (count($arrData) - 1))];
    }

    /**
     * Metodo responsavel em decriptar o array com chaves em md5 e valor em base64.
     *
     * @example $arrKeyMd5ValueBase64 = array("e10adc3949ba59abbe56e057f20f883e" => "MQ==")); <br /> $arrValue = array("123456", "1"); <br /> \InepZend\Util\ArrayCollection::decryptArray($arrKeyMd5ValueBase64, $arrValue)
     *
     * @param array $arrToDecrypt
     * @param array $arrKeysToMd5
     * @return array
     *
     * @assert (array("e10adc3949ba59abbe56e057f20f883e" => "MQ==", "caf1a3dfb505ffed0d024130f58c5cfa" => "MzIx"), array("123456")) === array("123456" => "1")
     */
    public static function decryptArray($arrToDecrypt = null, $arrKeysToMd5 = null)
    {
        if ((empty($arrToDecrypt)) || (empty($arrKeysToMd5)))
            return false;
        if (!is_array($arrToDecrypt))
            $arrToDecrypt = array($arrToDecrypt);
        $arrKeysWithMd5 = array();
        foreach ($arrKeysToMd5 as $strKeyNormal)
            $arrKeysWithMd5[] = md5($strKeyNormal);
        $arrReturn = array();
        foreach ($arrToDecrypt as $strKey => $strToDecrypt) {
            $mixSearch = array_search($strKey, $arrKeysWithMd5);
            if ($mixSearch !== false)
                $arrReturn[$arrKeysToMd5[$mixSearch]] = base64_decode($strToDecrypt);
        }
        return $arrReturn;
    }

    /**
     * Metodo responsavel em aplicar recursivamente a funcao stripslashes em um
     * array.
     *
     * @example <br /> \InepZend\Util\ArrayCollection::stripslashesArray(array("Seu nome e O\'reilly!", "Tudo e d\'Ele?", "Copo d\'agua."));
     *
     * @param array $arrData
     * @return mix
     *
     * @assert (array("Seu nome e O\'reilly!", "Tudo e d\'Ele?")) === array("Seu nome e O'reilly!", "Tudo e d'Ele?")
     */
    public static function stripslashesArray($arrData = null)
    {
        if (!is_array($arrData))
            return $arrData;
        foreach ($arrData as &$mixValue)
            $mixValue = (is_array($mixValue)) ? self::stripslashesArray($mixValue) : stripslashes($mixValue);
        return $arrData;
    }

    /**
     * Metodo responsavel em remover recursivamente as palavras existentes na
     * "black list" em um array.
     *
     * @example \InepZend\Util\ArrayCollection::removeBadWordArray(array("Seu passwd e O\'reilly!", "SomeCustomInjectedHeader e d\'Ele?", "Copo d\'água."));
     *
     * @param array $arrData
     * @return mix
     *
     * @assert (array("Seu response.write e O\'reilly!", "SomeCustomInjectedHeader e passwd?", "Nao removido")) == array(0 => null, 1 => null, 2 => "Nao removido")
     */
    public static function removeBadWordArray($arrData = null)
    {
        $arrBlackList = array(
            'response.write',
            'passwd',
            'SomeCustomInjectedHeader',
            'waitfor delay',
            'sleep(',
            '|cat',
            '&cat',
            'acunetix',
            '¿',
            'ð',
            '¥',
            '‰',
            '†',
            '÷',
            'Ø',
            'Æ',
            '@@',
            '$!@$',
            '()&%',
            "\"()",
            "'()",
            '${',
            'WEB-INF\web.xml',
            '1 or ',
            'passthru'
        );
        if (!is_array($arrData)) {
            foreach ($arrBlackList as $strBadWord) {
                if (stripos((string) $arrData, $strBadWord) !== false)
                    return;
            }
            return $arrData;
        }
        foreach ($arrData as &$mixValue) {
            if (!is_array($mixValue)) {
                foreach ($arrBlackList as $strBadWord) {
                    if (stripos($mixValue, $strBadWord) !== false) {
                        $mixValue = null;
                        continue (2);
                    }
                }
            } else
                $mixValue = self::removeBadWordArray($mixValue);
        }
        return $arrData;
    }

    /**
     * Metodo responsavel em converter acentos em caracteres especiais no padrao
     * HTML, em um array.
     *
     * @example $arrCaractersList = array("á à é è í ì ó ò ú ù"); <br /> $strCaractersList = "á à é è í ì ó ò ú ù"; <br /> \InepZend\Util\ArrayCollection::convertAccentIntoArray($arrCaractersList); <br /> \InepZend\Util\ArrayCollection::convertAccentIntoArray($strCaractersList);
     *
     * @param mix $mixElement
     * @return mix
     *
     * @assert ('Testé') === 'Test&eacute;'
     * @assert (array("Testé")) === array("Test&eacute;")
     * @assert (array(array("Testé"))) === array(array("Test&eacute;"))
     */
    public static function convertAccentIntoArray($mixElement = null)
    {
        if (!is_array($mixElement))
            return (is_string($mixElement)) ? Html::convertAccent($mixElement) : $mixElement;
        $arrElementNew = array();
        foreach ($mixElement as $mixKey => $mixValue) {
            if (is_array($mixValue))
                $mixValue = self::convertAccentIntoArray($mixValue);
            elseif (is_string($mixValue))
                $mixValue = Html::convertAccent($mixValue);
            $arrElementNew[$mixKey] = $mixValue;
        }
        return $arrElementNew;
    }

    /**
     * Metodo responsavel em procurar por um valor dentro de um array multivalorado.
     *
     * @example \InepZend\Util\ArrayCollection::arraySearchMultiarray("e", array("a", "e", 2));
     *
     * @param mix $mixFind
     * @param array $arrData
     * @return boolean
     *
     * @assert ("e", array("a", "e", 2)) === true
     */
    public static function arraySearchMultiarray($mixFind = null, $arrData = null)
    {
        foreach ($arrData as $arrValue) {
            for ($intCount = 0; $intCount < count($arrValue); ++$intCount) {
                if ($arrValue[$intCount] === $mixFind)
                    return true;
            }
        }
        return false;
    }

    /**
     * Metodo responsavel em procurar recursivamente por um valor dentro de um
     * array de array.
     *
     * @example Retorna um booleano <br /> \InepZend\Util\ArrayCollection::arraySearchMultiarray("e", array(array("a", "e", "i", "o", "u"))); <br /> Retorna um array <br /> \InepZend\Util\ArrayCollection::arraySearchMultiarray("e", array("a", "e", "i", "o", "u"));
     *
     * @param mix $mixFind
     * @param array $arrData
     * @param array $arrNodes
     * @return mix
     *
     * @assert ("search", array("a", "e", "i", 'search')) === array(array('a'), array(3 => 'search'))
     * @assert ("searchOne", array(array("a", "e", 2, array("searchTwo", "searchOne")))) === true
     * @assert ("searchTree", array(array("a", "e", 2, array("searchTwo", "searchOne")))) === false
     */
    public static function arraySearchRecursive($mixFind = null, $arrData = null, $arrNodes = array())
    {
        foreach ($arrData as $mixKey => $mixValue) {
            if (is_array($mixValue))
                $arrNodes = self::arraySearchMultiarray($mixFind, $mixValue);
            elseif (($mixKey == $mixFind) || ($mixValue == $mixFind))
                $arrNodes[] = array($mixKey => $mixValue);
        }
        return $arrNodes;
    }

    /**
     * Procura uma chave dentro de um array e a renomeia.
     * Caso seja passa um array o retorno he um array, mas caso seja passado um
     * array de array o retorno sera boolean.
     *
     * @example $arrRename = array("keyOriginal" => "valueOne", "name" => "valueTwo"); <br /> \InepZend\Util\ArrayCollection::arrayRenameKey($arrRename, "keyOriginal", "keyUpdated");
     *
     * @param array $arrData
     * @param string $strOriginalKey
     * @param string $strRenameKey
     * @return mix
     *
     * @assert (array("keyOriginal" => "valueOne", "name" => "valueTwo"), "keyOriginal", "keyUpdated") === array("keyUpdated" => "valueOne", "name" => "valueTwo")
     */
    public static function arrayRenameKey($arrData = null, $strOriginalKey = null, $strRenameKey = null)
    {
        if ((empty($arrData)) || (empty($strOriginalKey)) || (empty($strRenameKey)))
            return array();
        if (!is_array($arrData))
            $arrData = array($arrData);
        $arrReturn = array();
        foreach ($arrData as $strKey => $mixValue) {
            $strKeyIntern = ($strKey === $strOriginalKey) ? $strRenameKey : $strKey;
            $arrReturn[$strKeyIntern] = $mixValue;
        }
        return $arrReturn;
    }

    public static function arrayDasherize($arrData = null, $strSymbol = null)
    {
        if (is_null($arrData))
            return array();
        if (!is_array($arrData))
            $arrData = array($arrData);
        $arrReturn = array();
        foreach ($arrData as $strKey => $mixValue)
            $arrReturn[String::dasherize($strKey, $strSymbol)] = $mixValue;
        return $arrReturn;
    }

    /**
     * Metodo responsavel em converter a string equivalente a um XML para array,
     * ignorando os atributos dos nodos caso existam.
     *
     * @example \InepZend\Util\ArrayCollection::convertXmlToArray($strPathXml, $strXml) <br />
     *
     * Exemplo da string XML: <br />
     * <root> <br />
     *   <usuario> <br />
     *     <nome>Victor</nome> <br />
     *     <sobrenome>Vitorino</sobrenome> <br />
     *     <formacao>Computacao</formacao> <br />
     *     <formacao>Engenharia</formacao> <br />
     *   </usuario> <br />
     * </root> <br /><br />
     *
     * Exemplo do resultado em array: <br />
     * [root][usuario][nome] => Victor <br />
     * [root][usuario][sobrenome] => Vitorino <br />
     * [root][usuario][formacao][0] => Computacao <br />
     * [root][usuario][formacao][1] => Engenharia <br /><br />
     *
     * Forma de chamar o metodo: <br />
     * $strPathXml = '/SYSTEM/*'; <br />
     * $strXml = FileSystem::getContentFromFile('./file.xml') <br />
     * \InepZend\Util\ArrayCollection::convertXmlToArray($strPathXml, $strXml)
     *
     * @param string $strPathXml
     * @param string $strXml
     * @param object $domNode
     * @return array
     *
     * @assert ('/SYSTEM/*', \InepZend\Util\FileSystem::getContentFromFile(\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../config/complement/application.info.xml'))) === \InepZend\Util\ApplicationInfo::getApplicationInfo()
     */
    public static function convertXmlToArray($strPathXml = '/*', $strXml = '', $domNode = null)
    {
        static $domDocument;
        static $domXPath;
        if (!preg_match('/\*$/', $strPathXml))
            $strPathXml = preg_replace('/\/*$/', '', $strPathXml) . '/*';
        $arrReturn = array();
        if ($strXml) {
            $domDocument = Xml::getDomDocument(null, $strXml, true);
            if (!is_object($domDocument))
                return $arrReturn;
            $domXPath = Xml::getDomXPath($domDocument);
        }
        if (!is_object($domXPath))
            return $arrReturn;
        $arrNode = ($domNode) ? $domXPath->query($strPathXml, $domNode) : $domXPath->query($strPathXml);
        $arrOcorrencia = array();
        foreach ($arrNode as $node) {
            $DOMNamedNodeMap = $node->attributes;
            while ($DOMNamedNodeMap->length)
                $node->removeAttribute($DOMNamedNodeMap->item(0)->name);
            $strName = ($node->tagName) ? $node->tagName : $node->nodeName;
            $arrOcorrencia[$strName] = (isset($arrOcorrencia[$strName])) ? ($arrOcorrencia[$strName] + 1) : 0;
            $strNodeName = String::isUTF8($strName) ? utf8_decode($strName) : $strName;
            $strNodeValue = String::isUTF8($node->nodeValue) ? utf8_decode($node->nodeValue) : $node->nodeValue;
            if ($domXPath->evaluate('count(./*)', $node) > 0) {
                if ($domXPath->evaluate('count(' . $strName . ')', $node->parentNode) > 1)
                    $arrReturn[$strNodeName][$arrOcorrencia[$strName]] = self::convertXmlToArray($strName . '[' . ($arrOcorrencia[$strName] + 1) . ']', '', $node->parentNode);
                else
                    $arrReturn[$strNodeName] = self::convertXmlToArray($strName, '', $node->parentNode);
            } else {
                if ($domXPath->evaluate('count(' . $strName . ')', $node->parentNode) > 1)
                    $arrReturn[$strNodeName][$arrOcorrencia[$strName]] = $strNodeValue;
                else
                    $arrReturn[$strNodeName] = $strNodeValue;
            }
        }
        return $arrReturn;
    }

    /**
     * Metodo responsavel em converter array em XML.
     *
     * @example $arrValueAndKey = array("array" => array("a" => 0, "e" => 1, "i" => 2)); <br /> \InepZend\Util\ArrayCollection::convertArrayToXml($arrValueAndKey);
     *
     * @param array $arrNode
     * @param boolean $booHeader
     * @return string
     *
     * @assert (array("node" => "a")) === "<?xml version=\"1.0\"?>\n<root>\n<node>a</node>\n</root>"
     */
    public static function convertArrayToXml($arrNode = array(), $booHeader = true)
    {
        $strXml = ($booHeader === true) ? "<?xml version=\"1.0\"?>\n<root>" : '';
        foreach ($arrNode as $mixKey => $mixValue) {
            if (is_array($mixValue))
                $mixValue = self::convertArrayToXml($mixValue, false);
            if (is_numeric($mixKey))
                $mixKey = 'node' . $mixKey;
            $strXml .= "\n<" . $mixKey . '>' . $mixValue . '</' . $mixKey . '>';
        }
        $strXml .= "\n";
        if ($booHeader === true)
            $strXml .= '</root>';
        return $strXml;
    }

    /**
     * Metodo responsavel em converter array em objeto stdClass.
     *
     * @example $arrValueAndKey = array("arrayToObject" => array("atributOne" => 0, "atributTwo" => 1, "atributTree" => 2)); <br /> \InepZend\Util\ArrayCollection::arrayToObject($arrValueAndKey);
     *
     * @param array $arrData
     * @return object
     *
     * @assert (array()) == (new \InepZend\Util\stdClass())
     */
    public static function arrayToObject(array $arrData = array())
    {
        return new stdClass($arrData);
    }

    /**
     * Metodo responsavel em aplicar recursivamente a funcao nativa "strip_tags", em um array.
     *
     * @example Caso seja passado array o retorno sera array, caso seja passado string o retorno sera string. <br /> $mixValueOrStringWithHtml = array('<p>Test paragraph.</p><!-- Comment --> <a href="#fragment">Other text</a>'); <br /> \InepZend\Util\ArrayCollection::stripTagsArray($mixValueOrStringWithHtml);
     *
     * @param mix $mixData
     * @param string $strAllowableTags
     * @param boolean $booStripTag
     * @param integer $intDeep
     * @return mix
     *
     * @assert ('<p>Test paragraph.</p><!-- Comment --> <a href="#fragment">Other text</a>') === 'Test paragraph. Other text'
     * @assert (array('<p>Test paragraph.</p><!-- Comment --> <a href="#fragment">Other text</a>')) === array('Test paragraph. Other text')
     */
    public static function stripTagsArray($mixData, $strAllowableTags = null, $booStripTag = false, $intDeep = 0)
    {
        if (empty($mixData))
            return $mixData;
        if (!is_bool($booStripTag))
            $booStripTag = false;
        if (is_null($intDeep))
            $intDeep = 0;
        if (($booStripTag === true) && ($intDeep == 0)) {
            $arrTagHtml = Html::listTagHtml();
            foreach ($arrTagHtml as $arrTagHtmlIntern) {
                if (strtoupper($arrTagHtmlIntern[1]) == 'N')
                    continue;
                $strAllowableTags .= $arrTagHtmlIntern[0];
            }
        }
        if (!is_array($mixData))
            return strip_tags((string) $mixData, $strAllowableTags);
        foreach ($mixData as &$mixValue)
            $mixValue = (is_array($mixValue)) ? self::stripTagsArray($mixValue, $strAllowableTags, $booStripTag, ++$intDeep) : strip_tags((string) $mixValue, $strAllowableTags);
        return $mixData;
    }

    /**
     * Metodo responsavel em criar elemento(s) vazio(s) ('') em um array de
     * parametros, caso o(s) mesmo(s) ainda nao exista(m).
     *
     * @example $arrOne = array(1, 2, 3); <br /> $arrTwo = array(4, 5, 6); <br /> \InepZend\Util\ArrayCollection::createEmptyParam($arrOne, $arrTwo);
     *
     * @param array $arrEmpty
     * @param array $arrParam
     * @return boolean
     */
    public static function createEmptyParam($arrEmpty = null, &$arrParam = null)
    {
        if ((empty($arrEmpty)) || (!is_array($arrParam)))
            return false;
        if (!is_array($arrEmpty))
            $arrEmpty = array($arrEmpty);
        foreach ($arrEmpty as $strEmpty) {
            if (!array_key_exists($strEmpty, $arrParam))
                $arrParam[$strEmpty] = '';
        }
        return true;
    }

    /**
     * Remove valores(s) vazio(s) ('') ou nulos em um array.
     * Aplicando o metodo em uma array passa a ter somente os indices que tem
     * valores, mesmo que o indice seja nulo ou vazio.
     *
     * @example $arrWithElementEmpytAndNull = array(1 => 1, 'eliminadEmpty' => '', 3, 'eliminedNull' => null, null => 5); <br /> \InepZend\Util\ArrayCollection::clearEmptyParam($arrWithElementEmpytAndNull);
     *
     * @param array $arrParam
     * @param boolean $booReconstructKey
     * @param boolean $booNil
     * @param boolean $booRecursive
     * @return boolean
     */
    public static function clearEmptyParam(&$arrParam = array(), $booReconstructKey = false, $booNil = false, $booRecursive = false)
    {
        if (is_array($arrParam)) {
            $arrResult = array();
            foreach ($arrParam as $mixKey => $mixValue) {
                if (((empty($mixValue)) && ($mixValue !== 0) && ($mixValue !== '0') && ($mixValue !== false) && (!is_array($mixValue))) || (($booNil) && (is_array($mixValue)) && (@$mixValue['nil'] == 'true')))
                    continue;
                if (($booRecursive) && (is_array($mixValue)))
                    self::clearEmptyParam($mixValue, $booReconstructKey, $booNil, $booRecursive);
                $mixKeyNew = ($booReconstructKey === true) ? count($arrResult) : $mixKey;
                $arrResult[$mixKeyNew] = $mixValue;
            }
            $arrParam = $arrResult;
        }
        return true;
    }

    /**
     * Metodo responsavel em excluir chaves(s) em um array de parametros,
     * caso o(s) mesmo(s) exista(m).
     *
     * @example Passando array <br /> $arrKeyUnset = array(1, 2); <br /> Passando string <br /> $strKeyUnset = '1'; <br /> $arrKey = array(1, 2, 3, 4); <br /> \InepZend\Util\ArrayCollection::unsetParam($arrKeyUnset, $arrKey);
     *
     * @param mix $mixUnset
     * @param array $arrParam
     * @return boolean
     */
    public static function unsetParam($mixUnset = null, &$arrParam = null)
    {
        if ((empty($mixUnset)) || (!is_array($arrParam)))
            return false;
        if (!is_array($mixUnset))
            $mixUnset = array($mixUnset);
        foreach ($mixUnset as $strUnset) {
            if (array_key_exists($strUnset, $arrParam))
                unset($arrParam[$strUnset]);
        }
        return true;
    }

    /**
     * 
     * @param array $arrParam
     * @param string $arrParamDefaultValue
     * @return boolean
     */
    public static function setDefaultParam(&$arrParam = array(), $arrParamDefaultValue = null)
    {
        if (!is_array($arrParamDefaultValue))
            return false;
        foreach ($arrParamDefaultValue as $strParam => $mixValue) {
            if (!@empty($arrParam[$strParam]))
                continue;
            $arrParam[$strParam] = $mixValue;
        }
        return true;
    }

    /**
     * Metodo responsavel em aplicar o utf8_decode nos valores e chaves de um array.
     *
     * @example $arrItem = array(1, 2 => utf8_encode("arrItem")); <br /> array_walk_recursive($arrItem, '\InepZend\Util\ArrayCollection::arrayWalkRecursiveUtf8Decode');
     *
     * @param mix $mixItem
     * @param mix $mixKey
     * @return void
     */
    public static function arrayWalkRecursiveUtf8Decode(&$mixItem, &$mixKey)
    {
        $mixItem = String::utf8Decode($mixItem);
        $mixKey = String::utf8Decode($mixKey);
    }

    /**
     * Metodo responsavel em aplicar o utf8_encode nos valores e chaves de um array.
     *
     * @example $arrItem = array(1, 2 => utf8_decode("arrItem")); <br /> array_walk_recursive($arrItem, '\InepZend\Util\ArrayCollection::arrayWalkRecursiveUtf8Encode');
     *
     * @param mix $mixItem
     * @param mix $mixKey
     * @return void
     */
    public static function arrayWalkRecursiveUtf8Encode(&$mixItem, &$mixKey)
    {
        $mixItem = String::utf8Encode($mixItem, false);
        $mixKey = String::utf8Encode($mixKey);
    }

    /**
     * Metodo responsavel em adicionar aspas simples caso o valor do array seja
     * uma string.
     *
     * @example $arrString = array(1 => "alter", "alterTwo", 3, 4); <br /> array_walk_recursive($arrString, '\InepZend\Util\ArrayCollection::arrayWalkRecursiveAddSingleQuotes');
     *
     * @param array $mixItem
     * @return void
     */
    public static function arrayWalkRecursiveAddSingleQuotes(&$mixItem)
    {
        if (is_string($mixItem))
            $mixItem = "'" . $mixItem . "'";
    }

    /**
     * Metodo responsavel em aplicar o dasherize nas chaves de um array.
     *
     * @param mix $mixItem
     * @param mix $mixKey
     * @return void
     */
    public static function arrayWalkRecursiveDasherize(&$mixItem, &$mixKey)
    {
        $mixItem = String::dasherize($mixItem);
    }

    public static function arrayWalkRecursiveParse(&$mixItem, &$mixKey)
    {
        if ((is_numeric($mixItem)) && (stripos($mixKey, 'cpf') === false) && (stripos($mixKey, 'cnpj') === false) && (stripos($mixKey, 'cep') === false))
            $mixItem = (strpos($mixItem, '.') !== false) ? (float) $mixItem : (integer) $mixItem;
    }

    /**
     * Realiza o implode de um array de attributos com chaves alfanumericas, com
     * possibilidade de parametrizacao de strings para a concatenacao.
     *
     * @example \InepZend\Util\ArrayCollection::implodeToAttribute(array('attribute' => 2), '=', ';')
     *
     * @param type $arrWithAttribute
     * @param string $strSymbolEqual
     * @param string $strSymbolDivisor
     * @return mix
     *
     * @TODO implementar asserts
     */
    public static function implodeToAttribute($arrWithAttribute = null, $strSymbolEqual = null, $strSymbolDivisor = null)
    {
        if (!is_array($arrWithAttribute))
            return false;
        if (empty($strSymbolEqual))
            $strSymbolEqual = '=';
        if (empty($strSymbolDivisor))
            $strSymbolDivisor = ' ';
        $strResult = '';
        foreach ($arrWithAttribute as $strAttribte => $mixValue) {
            if (!empty($strResult))
                $strResult .= $strSymbolDivisor;
            $strResult .= $strAttribte . $strSymbolEqual . ((is_numeric($mixValue)) ? $mixValue : '"' . (string) $mixValue . '"');
        }
        return $strResult;
    }
    
    /**
     * 
     * @param array $arrDataValue
     * @param string $strIndexPattern
     * @param string $mixDefaultValue
     * @return mix
     */
    public static function getFromIndexPattern(array $arrDataValue = [], $strIndexPattern = '', $mixDefaultValue = null)
    {
        $mixResult = $mixDefaultValue;
        if (!empty($strIndexPattern)) {
            $mixResult = $arrDataValue;
            $arrIndexPattern = explode('\\', str_replace('/', '\\', $strIndexPattern));
            foreach ($arrIndexPattern as $strIndex) {
                if ((!is_array($mixResult)) || (!array_key_exists($strIndex, $mixResult))) {
                    $mixResult = $mixDefaultValue;
                    break;
                }
                $mixResult = $mixResult[$strIndex];
            }
        }
        return $mixResult;
    }

}
