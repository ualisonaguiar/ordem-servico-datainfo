<?php

namespace InepZend\Util;

class Library
{

    /**
     * Metodo responsavel em retornar as
     * informacao da Aplicacao retornado em formato de array
     * na qual esta no arquivo XML (application.info.xml).
     *
     * @example \InepZend\Util\Library::getApplicationInfo()
     *
     * @return array
     * @deprecated
     */
    public static function getApplicationInfo()
    {
        return ApplicationInfo::getApplicationInfo();
    }

    /**
     * Metodo responsavel em retornar o nome da aplicacao de forma editada.
     *
     * @example \InepZend\Util\Library::getNameEdited()
     *
     * @return string
     * @deprecated
     */
    public static function getNameEdited()
    {
        return ApplicationInfo::getNameEdited();
    }

    /**
     * Metodo responsavel em retornar a instancia do servidor.
     *
     * @example \InepZend\Util\Library::getServerInstance()
     *
     * @return string
     * @deprecated
     */
    public static function getServerInstance()
    {
        return ApplicationInfo::getServerInstance();
    }

    /**
     * Metodo responsavel em retornar a versao do InepZend.
     *
     * @example \InepZend\Util\Library::getInepZendVersion()
     *
     * @return array
     * @deprecated
     */
    public static function getInepZendVersion()
    {
        return ApplicationInfo::getInepZendVersion();
    }

    /**
     * Metodo responsavel em retornar as informacoes de revisao da aplicacao.
     *
     * @example \InepZend\Util\Library::getNameEdited()
     *
     * @param boolean $booInepZendLastVersion
     * @return array
     * @deprecated
     */
    public static function getRevision($booInepZendLastVersion = false)
    {
        return ApplicationInfo::getRevision($booInepZendLastVersion);
    }

    /**
     * Metodo responsavel em retornar a ultima versao do InepZend.
     *
     * @example \InepZend\Util\Library::getInepZendLastVersion()
     *
     * @return string
     * @deprecated
     */
    public static function getInepZendLastVersion()
    {
        return ApplicationInfo::getInepZendLastVersion();
    }

    /**
     * Metodo responsavel em retornar o tipo de theme do modulo da rota atual.
     *
     * @example \InepZend\Util\ApplicationInfo::getThemeType($strNamespace)
     *
     * @param string $strNamespace
     * @return string
     * @deprecated
     */
    public static function getThemeType($strNamespace = null)
    {
        return ApplicationInfo::getThemeType($strNamespace);
    }

    /**
     * Metodo responsavel em retornar os themes por tipo de layout.
     *
     * @example \InepZend\Util\Library::getTheme()
     *
     * @param string $strType
     * @param string $strNamespace
     * @return mix
     * @deprecated
     */
    public static function getTheme($strType = null, $strNamespace = null)
    {
        return ApplicationInfo::getTheme($strType, $strNamespace);
    }

    /**
     * Metodo responsavel em retornar o layout padrao de determinado theme.
     *
     * @example \InepZend\Util\ApplicationInfo::Library('AdministrativeResponsible')
     *
     * @param string $strTheme
     * @return string
     * @deprecated
     */
    public static function getThemeLayout($strTheme = null)
    {
        return ApplicationInfo::getThemeLayout($strTheme);
    }

    /**
     * Metodo responsavel em retornar o theme a partir do layout.
     *
     * @example \InepZend\Util\ApplicationInfo::Library('layout/layout-administrative')
     *
     * @param string $strLayout
     * @return string
     * @deprecated
     */
    public static function getThemeFromLayout($strLayout = null)
    {
        return ApplicationInfo::getThemeLayout($strLayout);
    }

    /**
     * Metodo responsavel por retornar valor do application de acordo com a propriedade informada.
     *
     * @param null $strProperty
     * @param null $strPath
     * @return array|int]
     * @deprecated
     */
    public static function get($strProperty = null, $strPath = null)
    {
        return ApplicationProperties::get($strProperty, $strPath);
    }

    /**
     * Metodo que carrega as informacoes presentes no application propertes
     *
     * @param null $strPath
     * @return array
     * @deprecated
     */
    public static function getAutoloadConfig($strPath = null)
    {
        return ApplicationProperties::getAutoloadConfig($strPath);
    }

    /**
     * Metodo responsavel em converter um objeto em array.
     *
     * @example \InepZend\Util\Library::objectToArray(new \InepZend\Util\stdClass())
     *
     * @param object $element
     * @param boolean $booConvertCaracterEspecial
     * @param integer $intMaxDeep
     * @param integer $intDeep
     * @return array
     * @deprecated
     */
    public static function objectToArray($element, $booConvertCaracterEspecial = false, $intMaxDeep = null, $intDeep = 0)
    {
        return ArrayCollection::objectToArray($element, $booConvertCaracterEspecial, $intMaxDeep, $intDeep);
    }

    /**
     * Metodo responsavel em converter um objeto em array de forma recursiva.
     *
     * @example $element = new \InepZend\Util\stdClass(array('atributo' => new \stdClass())); <br /> \InepZend\Util\Library::objectToArrayRecursive($element)
     *
     * @param mix $element
     * @param boolean $booConvertCaracterEspecial
     * @return array
     * @deprecated
     */
    public static function objectToArrayRecursive($element, $booConvertCaracterEspecial = false)
    {
        return ArrayCollection::objectToArrayRecursive($element, $booConvertCaracterEspecial);
    }

    /**
     * Metodo responsavel em retornar um elemento do array de dados parametrizados 
     * randomicamente.
     *
     * @example \InepZend\Util\Library::randArray($arrData)
     *
     * @param array $arrData
     * @return mix
     * @deprecated
     */
    public static function randArray($arrData)
    {
        return ArrayCollection::randArray($arrData);
    }

    /**
     * Metodo responsavel em decriptar o array com chaves em md5 e valor em base64.
     *
     * @example $arrKeyMd5ValueBase64 = array("e10adc3949ba59abbe56e057f20f883e" => "MQ==")); <br /> $arrValue = array("123456", "1"); <br /> \InepZend\Util\Library::decryptArray($arrKeyMd5ValueBase64, $arrValue)
     *
     * @param array $arrToDecrypt
     * @param array $arrKeysToMd5
     * @return array
     * @deprecated
     */
    public static function decryptArray($arrToDecrypt, $arrKeysToMd5)
    {
        return ArrayCollection::decryptArray($arrToDecrypt, $arrKeysToMd5);
    }

    /**
     * Metodo responsavel em aplicar recursivamente a funcao stripslashes em um 
     * array.
     *
     * @example <br /> \InepZend\Util\Library::stripslashesArray(array("Seu nome e O\'reilly!", "Tudo e d\'Ele?", "Copo d\'agua."));
     *
     * @param array $arrData
     * @return mix
     * @deprecated
     */
    public static function stripslashesArray($arrData)
    {
        return ArrayCollection::stripslashesArray($arrData);
    }

    /**
     * Metodo responsavel em remover recursivamente as palavras existentes na 
     * "black list" em um array.
     *
     * @example \InepZend\Util\Library::removeBadWordArray(array("Seu passwd e O\'reilly!", "SomeCustomInjectedHeader e d\'Ele?", "Copo d\'água."));
     *
     * @param array $arrData
     * @return mix
     * @deprecated
     */
    public static function removeBadWordArray($arrData)
    {
        return ArrayCollection::removeBadWordArray($arrData);
    }

    /**
     * Metodo responsavel em converter acentos em caracteres especiais no padrao 
     * HTML, em um array.
     *
     * @example $arrCaractersList = array("á à é è í ì ó ò ú ù"); <br /> $strCaractersList = "á à é è í ì ó ò ú ù"; <br /> \InepZend\Util\Library::convertAccentIntoArray($arrCaractersList); <br /> \InepZend\Util\Library::convertAccentIntoArray($strCaractersList);
     *
     * @param mix $mixElement
     * @return mix
     * @deprecated
     */
    public static function converteAcentoIntoArray($mixElement)
    {
        return ArrayCollection::convertAccentIntoArray($mixElement);
    }

    /**
     * Metodo responsavel em procurar por um valor dentro de um array multivalorado.
     *
     * @example \InepZend\Util\Library::arraySearchMultiarray("e", array("a", "e", 2));
     *
     * @param mix $mixFind
     * @param array $arrData
     * @return boolean
     * @deprecated
     */
    public static function array_search_multiarray($mixFind, $arrData)
    {
        return ArrayCollection::arraySearchMultiarray($mixFind, $arrData);
    }

    /**
     * Metodo responsavel em procurar recursivamente por um valor dentro de um 
     * array de array.
     *
     * @example Retorna um booleano <br /> \InepZend\Util\Library::arraySearchMultiarray("e", array(array("a", "e", "i", "o", "u"))); <br /> Retorna um array <br /> \InepZend\Util\ArrayCollection::arraySearchMultiarray("e", array("a", "e", "i", "o", "u"));
     *
     * @param mix $mixFind
     * @param array $arrData
     * @param array $arrNodes
     * @return mix
     * @deprecated
     */
    public static function array_search_recursive($mixFind, $arrData, $arrNodes = array())
    {
        return ArrayCollection::arraySearchRecursive($mixFind, $arrData, $arrNodes);
    }

    /**
     * Procura uma chave dentro de um array e a renomeia.
     * Caso seja passa um array o retorno he um array,
     * mas caso seja passado um array de array o retorno sera boolean.
     *
     * @example $arrRename = array("keyOriginal" => "valueOne", "name" => "valueTwo"); <br /> \InepZend\Util\Library::arrayRenameKey($arrRename, "keyOriginal", "keyUpdated");
     *
     * @param array $arrData
     * @param string $strOriginalKey
     * @param string $strRenameKey
     * @return mix
     * @deprecated
     */
    public static function array_rename_key($arrData = null, $strOriginalKey = null, $strRenameKey = null)
    {
        return ArrayCollection::arrayRenameKey($arrData, $strOriginalKey, $strRenameKey);
    }

    /**
     * @param null $arrData
     * @param null $strSymbol
     * @return array
     * @deprecated
     */
    public static function arrayDasherize($arrData = null, $strSymbol = null)
    {
        return ArrayCollection::arrayDasherize($arrData, $strSymbol);
    }

    /**
     * Metodo responsavel em converter a string equivalente a um XML para array, 
     * ignorando os atributos dos nodos caso existam.
     *
     * @example \InepZend\Util\Library::convertXmlToArray($strPathXml, $strXml) <br />
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
     * \InepZend\Util\Library::convertXmlToArray($strPathXml, $strXml)
     *
     * @param string $strPathXml
     * @param string $strXml
     * @param object $DOMNode
     * @return array
     * @deprecated
     */
    public static function convertXmlToArray($strPathXml = '/*', $strXml = '', $DOMNode = null)
    {
        return ArrayCollection::convertXmlToArray($strPathXml, $strXml, $DOMNode);
    }

    /**
     * Metodo responsavel em converter array em XML.
     *
     * @example $arrValueAndKey = array("array" => array("a" => 0, "e" => 1, "i" => 2)); <br /> \InepZend\Util\Library::convertArrayToXml($arrValueAndKey);
     *
     * @param array $arrNode
     * @param boolean $booHeader
     * @return string
     * @deprecated
     */
    public static function convertArrayToXml($arrNode = array(), $booHeader = true)
    {
        return ArrayCollection::convertArrayToXml($arrNode, $booHeader);
    }

    /**
     * Metodo responsavel em converter array em objeto stdClass.
     *
     * @example $arrValueAndKey = array("arrayToObject" => array("atributOne" => 0, "atributTwo" => 1, "atributTree" => 2)); <br /> \InepZend\Util\Library::arrayToObject($arrValueAndKey);
     *
     * @param array $arrData
     * @return object
     * @deprecated
     */
    public static function arrayToObject(array $arrData)
    {
        return ArrayCollection::arrayToObject($arrData);
    }

    /**
     * Metodo responsavel em aplicar recursivamente a funcao nativa "strip_tags", 
     * em um array.
     *
     * @example Caso seja passado array o retorno sera array, caso seja passado string o retorno sera string. <br /> $mixValueOrStringWithHtml = array('<p>Test paragraph.</p><!-- Comment --> <a href="#fragment">Other text</a>'); <br /> \InepZend\Util\Library::stripTagsArray($mixValueOrStringWithHtml);
     *
     * @param array $arrData
     * @param string $strAllowableTags
     * @param boolean $booStripTag
     * @param integer $intDeep
     * @return mix
     * @deprecated
     */
    public static function strip_tagsArray($arrData, $strAllowableTags = null, $booStripTag = false, $intDeep = 0)
    {
        return ArrayCollection::stripTagsArray($arrData, $strAllowableTags, $booStripTag, $intDeep);
    }

    /**
     * Metodo responsavel em criar elemento(s) vazio(s) ('') em um array de 
     * parametros, caso o(s) mesmo(s) ainda nao exista(m).
     *
     * @example $arrOne = array(1, 2, 3); <br /> $arrTwo = array(4, 5, 6); <br /> \InepZend\Util\Library::createEmptyParam($arrOne, $arrTwo);
     *
     * @param array $arrEmpty
     * @param array $arrParam
     * @return boolean
     * @deprecated
     */
    public static function createEmptyParam($arrEmpty = null, &$arrParam = null)
    {
        return ArrayCollection::createEmptyParam($arrEmpty, $arrParam);
    }

    /**
     * Remove valores(s) vazio(s) ('') ou nulos em um array.
     * Aplicando o metodo em uma array passa a ter somente os indices
     * que tem valores, mesmo que o indice seja nulo ou vazio.
     *
     * @example $arrWithElementEmpytAndNull = array(1 => 1, 'eliminadEmpty' => '', 3, 'eliminedNull' => null, null => 5); <br /> \InepZend\Util\Library::clearEmptyParam($arrWithElementEmpytAndNull);
     *
     * @param array $arrParam
     * @param boolean $booReconstructKey
     * @param boolean $booNil
     * @return boolean
     * @deprecated
     */
    public static function clearEmptyParam(&$arrParam = array(), $booReconstructKey = false, $booNil = false)
    {
        return ArrayCollection::clearEmptyParam($arrParam, $booReconstructKey, $booNil);
    }

    /**
     * Metodo responsavel em excluir chaves(s) em um array de parametros, 
     * caso o(s) mesmo(s) exista(m).
     *
     * @example Passando array <br /> $arrKeyUnset = array(1, 2); <br /> Passando string <br /> $strKeyUnset = '1'; <br /> $arrKey = array(1, 2, 3, 4); <br /> \InepZend\Util\Library::unsetParam($arrKeyUnset, $arrKey);
     *
     * @param array $arrUnset
     * @param array $arrParam
     * @return boolean
     * @deprecated
     */
    public static function unsetParam($arrUnset = null, &$arrParam = null)
    {
        return ArrayCollection::unsetParam($arrUnset, $arrParam);
    }

    /**
     * @param array $arrParam
     * @param null $arrParamDefaultValue
     * @return bool
     * @deprecated
     */
    public static function setDefaultParam(&$arrParam = array(), $arrParamDefaultValue = null)
    {
        return ArrayCollection::setDefaultParam($arrParam, $arrParamDefaultValue);
    }

    /**
     * Metodo responsavel em aplicar o utf8_decode nos valores e chaves de um 
     * array.
     *
     * @example $arrItem = array(1, 2 => utf8_encode("arrItem")); <br /> array_walk_recursive($arrItem, '\InepZend\Util\Library::arrayWalkRecursiveUtf8Decode');
     *
     * @param mix $mixItem
     * @param mix $mixKey
     * @return void
     * @deprecated
     */
    public static function arrayWalkRecursiveUtf8Decode(&$mixItem, &$mixKey)
    {
        return ArrayCollection::arrayWalkRecursiveUtf8Decode($mixItem, $mixKey);
    }

    /**
     * Metodo responsavel em aplicar o utf8_encode nos valores e chaves de um 
     * array.
     *
     * @example $arrItem = array(1, 2 => utf8_decode("arrItem")); <br /> array_walk_recursive($arrItem, '\InepZend\Util\Library::arrayWalkRecursiveUtf8Encode');
     *
     * @param mix $mixItem
     * @param mix $mixKey
     * @return void
     * @deprecated
     */
    public static function arrayWalkRecursiveUtf8Encode(&$mixItem, &$mixKey)
    {
        return ArrayCollection::arrayWalkRecursiveUtf8Encode($mixItem, $mixKey);
    }

    /**
     * Metodo responsavel em adicionar aspas simples caso o valor do array seja 
     * uma string.
     *
     * @example $arrString = array(1 => "alter", "alterTwo", 3, 4); <br /> array_walk_recursive($arrString, '\InepZend\Util\Library::arrayWalkRecursiveAddSingleQuotes');
     *
     * @param array $mixItem
     * @return void
     * @deprecated
     */
    public static function arrayWalkRecursiveAddSingleQuotes(&$mixItem, &$mixKey)
    {
        return ArrayCollection::arrayWalkRecursiveAddSingleQuotes($mixItem, $mixKey);
    }

    /**
     * Metodo responsavel em aplicar o dasherize nas chaves de um array.
     *
     * @param mix $mixItem
     * @param mix $mixKey
     * @return void
     * @deprecated
     */
    public static function arrayWalkRecursiveDasherize(&$mixItem, &$mixKey)
    {
        return ArrayCollection::arrayWalkRecursiveDasherize($mixItem, $mixKey);
    }

    /**
     * @param $mixItem
     * @param $mixKey
     * @deprecated
     */
    public static function arrayWalkRecursiveParse(&$mixItem, &$mixKey)
    {
        return ArrayCollection::arrayWalkRecursiveParse($mixItem, $mixKey);
    }

    /**
     * Realiza o implode de um array de attributos com chaves alfanumericas, com
     * possibilidade de parametrizacao de strings para a concatenacao.
     * 
     * @example \InepZend\Util\Library::implodeToAttribute(array('attribute' => 2), '=', ';')
     * 
     * @param type $arrWithAttribute
     * @param string $strSymbolEqual
     * @param string $strSymbolDivisor
     * @return mix
     * @deprecated
     */
    public static function implodeToAttribute($arrWithAttribute = null, $strSymbolEqual = null, $strSymbolDivisor = null)
    {
        return ArrayCollection::implodeToAttribute($arrWithAttribute, $strSymbolEqual, $strSymbolDivisor);
    }

    /**
     * Metodo responsavel em enviar requisicoes utilizando a biblioteca cUrl.
     *
     * @example \InepZend\Util\Library::getCurl($strUrl, $mixParam, $strMethod, $arrCurlOption, $booExec, $strAcceptHttpHeader, $arrConfig, $arrHeader, $arrCookie);
     *
     * @param string $strUrl
     * @param mix $mixParam
     * @param string $strMethod
     * @param array $arrCurlOption
     * @param boolean $booExec
     * @param string $strAcceptHttpHeader
     * @param array $arrConfig
     * @param array $arrHeader
     * @param array $arrCookie
     * @return mix
     * @deprecated
     */
    public static function getCurl($strUrl = null, $mixParam = null, $strMethod = null, $arrCurlOption = null, $booExec = null, $strAcceptHttpHeader = null, $arrConfig = null)
    {
        return Curl::getCurl($strUrl, $mixParam, $strMethod, $arrCurlOption, $booExec, $strAcceptHttpHeader, $arrConfig);
    }

    /**
     * Metodo responsavel em setar o objeto HttpClient referente ao \Zend\Http\Client.
     *
     * @example \InepZend\Util\Library::setAdapter(new HttpClient(), array('timeout'));
     *
     * @param object $httpClient
     * @param array $arrConfigMerge
     * @return boolean
     * @deprecated
     */
    public static function setAdapter($client = null)
    {
        return Curl::setAdapter($client);
    }

    /**
     * Metodo responsavel em retornar as opcoes do HttpCliente.
     *
     * @example \InepZend\Util\Library::getOptionToHttpClient($arrConfig, $arrConfigMerge);
     *
     * @param array $arrConfig
     * @param array $arrConfigMerge
     * @return array
     * @deprecated
     */
    public static function getOptionToHttpClient($arrConfig = null)
    {
        return Curl::getOptionToHttpClient($arrConfig);
    }

    /**
     * Metodo responsavel em verificar se a data passada como parametro esta na 
     * string dd/mm/aaaa.
     *
     * @example \InepZend\Util\Library::isDateTemplate('18/07/2014')
     *
     * @param string $strValue
     * @return boolean
     * @deprecated
     */
    public static function isDateTemplate($strValue)
    {
        return Date::isDateTemplate($strValue);
    }

    /**
     * Metodo responsavel em verificar se a data passada como parametro esta na 
     * string aaaa-mm-dd.
     *
     * @example \InepZend\Util\Library::isDateBase('2014-07-18')
     *
     * @param string $strValue
     * @return boolean
     * @deprecated
     */
    public static function isDateBase($strValue)
    {
        return Date::isDateBase($strValue);
    }

    /**
     * Metodo responsavel em verificar se a data passada como parametro esta na 
     * string aaaammdd.
     *
     * @example \InepZend\Util\Library::isDateWs('20140718')
     *
     * @param string $strValue
     * @return boolean
     * @deprecated
     */
    public static function isDateWs($strValue)
    {
        return Date::isDateWs($strValue);
    }

    /**
     * Verifica se a data passada como parametro esta no formato aaaa-mm-dd 
     * ou dd/mm/aaaa.
     *
     * @example \InepZend\Util\Library::isDate('18/07/2014', 'template') <br /> \InepZend\Util\Library::isDate('2014-07-18', 'base') <br /> \InepZend\Util\Library::isDate('20140718', 'ws')
     *
     * @param string $strValue
     * @param string $strTypeDate
     * @return boolean
     * @deprecated
     */
    public static function isDate($strValue, $strTypeDate = null)
    {
        return Date::isDate($strValue, $strTypeDate);
    }

    /**
     * Metodo responsavel em capturar algumas informacoes da data.
     *
     * @example \InepZend\Util\Library::getInfoDate('18/07/2014', 'template') <br /> \InepZend\Util\Library::getInfoDate('18/07/2014 18:36:15', 'template') <br /> \InepZend\Util\Library::getInfoDate('2014-07-18', 'base') <br /> \InepZend\Util\Library::getInfoDate('20140718', 'ws')
     *
     * @param string $strValue
     * @param string $strTypeDate
     * @return array
     * @deprecated
     */
    public static function getInfoDate($strValue, $strTypeDate = null)
    {
        return Date::getInfoDate($strValue, $strTypeDate);
    }

    /**
     * Metodo responsavel pela informacoes detalhada sobre a data.
     *
     * @example \InepZend\Util\Library::getDateParse('18/07/2014', 'template') <br /> \InepZend\Util\Library::getDateParse('2014-07-18', 'base') <br /> \InepZend\Util\Library::getDateParse('20140718', 'ws')
     *
     * @param string $strValue
     * @param string $strTypeDate
     * @return array
     * @deprecated
     */
    public static function getDateParse($strValue, $strTypeDate = null)
    {
        return Date::getDateParse($strValue, $strTypeDate);
    }

    /**
     * Metodo responsavel pela formatacao da data.
     *
     * @example \InepZend\Util\Library::getDateFormat('18/07/2014', 'template') <br /> \InepZend\Util\Library::getDateFormat('2014-07-18', 'base') <br /> \InepZend\Util\Library::getDateFormat('20140718', 'ws')
     *
     * @param string $strValue
     * @param string $strTypeDate
     * @return array
     * @deprecated
     */
    public static function getDateFormat($strValue, $strTypeDate = null)
    {
        return Date::getDateFormat($strValue, $strTypeDate);
    }

    /**
     * Metodo responsavel em delegar qual funcao de conversao da data para 
     * timestamp deve ser acionada.
     *
     * @example \InepZend\Util\Library::convertDateToTimestamp('18/07/2014', 'template') <br /> \InepZend\Util\Library::convertDateToTimestamp('18/07/2014 18:02:15', 'template') <br /> \InepZend\Util\Library::convertDateToTimestamp('2014-07-18', 'base') <br /> \InepZend\Util\Library::convertDateToTimestamp('2014-07-18 18:02:15', 'base') <br /> \InepZend\Util\Library::convertDateToTimestamp('20140718', 'ws') <br /> \InepZend\Util\Library::convertDateToTimestamp('20140718 18:02:15', 'ws')
     *
     * @param string $strValue
     * @return integer
     * @deprecated
     */
    public static function convertDateToTimestamp($strValue)
    {
        return Date::convertDateToTimestamp($strValue);
    }

    /**
     * Metodo responsavel em converter a data na string dd/mm/aaaa para timestamp.
     *
     * @example \InepZend\Util\Library::convertDateTemplateToTimestamp('18/07/2014') <br /> \InepZend\Util\Library::convertDateTemplateToTimestamp('18/07/2014 18:45:10')
     *
     * @param string $strValue
     * @return string
     * @deprecated
     */
    public static function convertDateTemplateToTimestamp($strValue)
    {
        return Date::convertDateTemplateToTimestamp($strValue);
    }

    /**
     * Metodo responsavel em converter a data na string aaaa-mm-dd para timestamp.
     *
     * @example \InepZend\Util\Library::convertDateBaseToTimestamp('2014-07-18') <br /> \InepZend\Util\Library::convertDateBaseToTimestamp('2014-07-18 18:45:10')
     *
     * @param string $strValue
     * @return string
     * @deprecated
     */
    public static function convertDateBaseToTimestamp($strValue)
    {
        return Date::convertDateBaseToTimestamp($strValue);
    }

    /**
     * Metodo responsavel em converter a data na string aaaammdd para timestamp.
     *
     * @example \InepZend\Util\Library::convertDateWsToTimestamp('20140718') <br /> \InepZend\Util\Library::convertDateWsToTimestamp('20140718 18:45:10')
     *
     * @param string $strValue
     * @return string
     * @deprecated
     */
    public static function convertDateWsToTimestamp($strValue)
    {
        return Date::convertDateWsToTimestamp($strValue);
    }

    /**
     * Metodo responsavel em realizar as operacoes para a convercao da data para 
     * timestamp.
     *
     * @example \InepZend\Util\Library::convertDateToTimestampAction('18/07/2014') <br /> \InepZend\Util\Library::convertDateToTimestampAction('18/07/2014 18:45:10') <br /> \InepZend\Util\Library::convertDateToTimestampAction('2014-07-18') <br /> \InepZend\Util\Library::convertDateToTimestampAction('2014-07-18 18:45:10') <br /> \InepZend\Util\Library::convertDateToTimestampAction('20140718') <br /> \InepZend\Util\Library::convertDateToTimestampAction('20140718 18:45:10')
     *
     * @param string $strValue
     * @param string $strTypeDate
     * @return string
     * @deprecated
     */
    public static function convertDateToTimestampAction($strValue, $strTypeDate = null)
    {
        return Date::convertDateToTimestampAction($strValue, $strTypeDate);
    }

    /**
     * Metodo responsavel em delegar qual funcao de conversao da data deve ser 
     * acionada, de acordo com o formato utilizado.
     *
     * @example \InepZend\Util\Library::convertDate('18/07/2014', 'Y-m-d') <br /> \InepZend\Util\Library::convertDate('18/07/2014 18:45:10', 'Y-m-d H:i:s') <br /> \InepZend\Util\Library::convertDate('2014-07-18', 'Y-m-d') <br /> \InepZend\Util\Library::convertDate('2014-07-18 18:45:10', 'Y-m-d H:i:s') <br /> \InepZend\Util\Library::convertDate('20140718', 'Y-m-d') <br /> \InepZend\Util\Library::convertDate('20140718 18:45:10', 'Y-m-d H:i:s')
     *
     * @param string $strValue
     * @param string $strFormat
     * @return string
     * @deprecated
     */
    public static function convertDate($strValue, $strFormat = 'Y-m-d')
    {
        return Date::convertDate($strValue, $strFormat);
    }

    /**
     * Metodo responsavel em converter a data na string dd/mm/aaaa para qualquer 
     * formato de data.
     *
     * @example \InepZend\Util\Library::convertDateTemplate('18/07/2014') <br /> \InepZend\Util\Library::convertDateTemplate('18/07/2014', 'd/m/Y') <br /> \InepZend\Util\Library::convertDateTemplate('18/07/2014 18:45:10', 'd/m/Y H:i:s')
     *
     * @param string $strValue
     * @param string $strFormat
     * @return string
     * @deprecated
     */
    public static function convertDateTemplate($strValue, $strFormat = 'Y-m-d')
    {
        return Date::convertDateTemplate($strValue, $strFormat);
    }

    /**
     * Metodo responsavel em converter a data na string aaaa-mm-dd para qualquer 
     * formato de data.
     *
     * @example \InepZend\Util\Library::convertDateBase('2014-07-18') <br /> \InepZend\Util\Library::convertDateBase('2014-07-18', 'd/m/Y') <br /> \InepZend\Util\Library::convertDateBase('2014-07-18 18:45:10', 'd/m/Y H:i:s')
     *
     * @param string $strValue
     * @param string $strFormat
     * @return string
     * @deprecated
     */
    public static function convertDateBase($strValue, $strFormat = 'd/m/Y')
    {
        return Date::convertDateBase($strValue, $strFormat);
    }

    /**
     * Metodo responsavel em converter a data na string aaaammdd para qualquer 
     * formato de data.
     *
     * @example \InepZend\Util\Library::convertDateWs('2014-07-18') <br /> \InepZend\Util\Library::convertDateWs('2014-07-18', 'd/m/Y') <br /> \InepZend\Util\Library::convertDateWs('2014-07-18 18:45:10', 'd/m/Y H:i:s')
     *
     * @param string $strValue
     * @param string $strFormat
     * @return string
     * @deprecated
     */
    public static function convertDateWs($strValue, $strFormat = 'd/m/Y')
    {
        return Date::convertDateWs($strValue, $strFormat);
    }

    /**
     * Metodo responsavel em realizar as operacoes para a convercao da data para 
     * qualquer formato de data.
     *
     * @example \InepZend\Util\Library::convertDateAction('15/07/2014') <br /> \InepZend\Util\Library::convertDateAction('15/07/2014', 'd/m/Y') <br /> \InepZend\Util\Library::convertDateAction('15/07/2014', 'template' ,'d/m/Y') <br /> \InepZend\Util\Library::convertDateAction('15/07/2014 15:50:12', 'template', 'd/m/Y H:i:s') <br /> \InepZend\Util\Library::convertDateAction('2014-07-15') <br /> \InepZend\Util\Library::convertDateAction('2014-07-15', 'd/m/Y') <br /> \InepZend\Util\Library::convertDateAction('2014-07-15', 'base' ,'d/m/Y') <br /> \InepZend\Util\Library::convertDateAction('2014-07-15 15:50:12', 'base' ,'d/m/Y H:i:s') <br /> \InepZend\Util\Library::convertDateAction('20140715') <br /> \InepZend\Util\Library::convertDateAction('20140715', 'd/m/Y') <br /> \InepZend\Util\Library::convertDateAction('20140715', 'ws' ,'d/m/Y') <br /> \InepZend\Util\Library::convertDateAction('20140715 15:50:12', 'ws' ,'d/m/Y H:i:s')
     *
     * @param string $strValue
     * @param string $strTypeDate
     * @param string $strFormat
     * @return string
     * @deprecated
     */
    public static function convertDateAction($strValue, $strTypeDate = null, $strFormat = 'Y-m-d')
    {
        return Date::convertDateAction($strValue, $strTypeDate, $strFormat);
    }

    /**
     * Metodo responsavel em adicionar ou retira dia(s) a uma data.
     *
     * @example \InepZend\Util\Library::addDayToDate('15/07/2014', 2) <br /> \InepZend\Util\Library::addDayToDate('15/07/2014', 2, '-') <br /> \InepZend\Util\Library::addDayToDate('2014-07-15', 2) <br /> \InepZend\Util\Library::addDayToDate('2014-07-15', 2, '-') <br /> \InepZend\Util\Library::addDayToDate('20140715', 2) <br /> \InepZend\Util\Library::addDayToDate('20140715', 2, '-')
     *
     * @param string $strValue
     * @param integer $intDayToAdd
     * @param string $strSymbolOperation
     * @return string
     * @deprecated
     */
    public static function addDayToDate($strValue, $intDayToAdd = null, $strSymbolOperation = '+')
    {
        return Date::addDayToDate($strValue, $intDayToAdd, $strSymbolOperation);
    }

    /**
     * Metodo responsavel em adicionar ou retira hora(s) de uma hora informada.
     *
     * @example \InepZend\Util\Library::addHourToDate('17/07/2014 19:05:12', 2) <br /> \InepZend\Util\Library::addHourToDate('17/07/2014 19:05:12', 2, '-') <br /> \InepZend\Util\Library::addHourToDate('2014-07-15 19:05:12', 2) <br /> \InepZend\Util\Library::addHourToDate('2014-07-15 19:05:12', 2, '-') <br /> \InepZend\Util\Library::addHourToDate('20140715 19:05:12', 2) <br /> \InepZend\Util\Library::addHourToDate('20140715 19:05:12', 2, '-')
     *
     * @param string $strValue
     * @param integer $intHourToAdd
     * @param string $strSymbolOperation
     * @return string
     * @deprecated
     */
    public static function addHourToDate($strValue, $intHourToAdd = null, $strSymbolOperation = '+')
    {
        return Date::addHourToDate($strValue, $intHourToAdd, $strSymbolOperation);
    }

    /**
     * Metodo responsavel em adicionar ou retirar minutos(s) de uma data.
     *
     * @example \InepZend\Util\Library::addMinuteToDate('17/07/2014 19:05:12', 2) <br /> \InepZend\Util\Library::addMinuteToDate('17/07/2014 19:05:12', 2, '-') <br /> \InepZend\Util\Library::addMinuteToDate('2014-07-15 19:05:12', 2) <br /> \InepZend\Util\Library::addMinuteToDate('2014-07-15 19:05:12', 2, '-') <br /> \InepZend\Util\Library::addMinuteToDate('20140715 19:05:12', 2) <br /> \InepZend\Util\Library::addMinuteToDate('20140715 19:05:12', 2, '-')
     *
     * @param string $strValue
     * @param integer $intMinuteToAdd
     * @param string $strSymbolOperation
     * @return string
     * @deprecated
     */
    public static function addMinuteToDate($strValue, $intMinuteToAdd = null, $strSymbolOperation = '+')
    {
        return Date::addMinuteToDate($strValue, $intMinuteToAdd, $strSymbolOperation);
    }

    /**
     * Metodo responsavel em adicionar ou retirar hora(s)/minutos(s) de uma data.
     *
     * @example \InepZend\Util\Library::alterDate('18/07/2014', 1) <br /> \InepZend\Util\Library::alterDate('18/07/2014', 1, '-') <br /> \InepZend\Util\Library::alterDate('18/07/2014 11:08:10', 1, null, 'hour') <br /> \InepZend\Util\Library::alterDate('18/07/2014 11:08:10', 1, '-', 'hour')
     *
     * @param string $strValue
     * @param integer $intToAlter
     * @param string $strSymbolOperation
     * @param string $strDateElement
     * @return string
     * @deprecated
     */
    public static function alterDate($strValue, $intToAlter = null, $strSymbolOperation = '+', $strDateElement = 'day')
    {
        return Date::alterDate($strValue, $intToAlter, $strSymbolOperation, $strDateElement);
    }

    /**
     * Metodo responsavel em retornar a diferenca que existe entre duas datas no 
     * formato DD/MM/YYYY, YYYY-MM-DD ou YYYYMMDD em dias.
     *
     * @example \InepZend\Util\Library::dateDiff('23/07/2014', '25/07/2014')
     *
     * @param string strDate1
     * @param string strDate2
     * @param boolean $booRound
     * @param boolean $booDiffDay
     * @return integer
     * @deprecated
     */
    public static function dateDiff($strDate1 = null, $strDate2 = null, $booRound = true, $booDiffDay = true)
    {
        return Date::dateDiff($strDate1, $strDate2, $booRound, $booDiffDay);
    }

    /**
     * Metodo responsavel em verificar se a data final he maior que a data final.
     *
     * @example \InepZend\Util\Library::compareDates('23/07/2014', '25/07/2014') <br /> \InepZend\Util\Library::compareDates('23/07/2014 14:25:26', '25/07/2014 14:25:27')
     *
     * @param string $strInicialDate
     * @param string $strFinalDate
     * @return boolean
     * @deprecated
     */
    public static function compareDates($strInicialDate = null, $strFinalDate = null)
    {
        return Date::compareDates($strInicialDate, $strFinalDate);
    }

    /**
     * Metodo responsavel em retornar o proxima dia da semana que nao seja final 
     * de semana.
     *
     * @example \InepZend\Util\Library::nextDayNotWeekend('26/07/2014') <br /> \InepZend\Util\Library::nextDayNotWeekend('2014-07-26') <br /> \InepZend\Util\Library::nextDayNotWeekend('20140726')
     *
     * @param string strDate
     * @param string strSimbolMath
     * @return string
     * @deprecated
     */
    public static function nextDayNotWeekend($strDate = null, $strSimbolMath = '+')
    {
        return Date::nextDayNotWeekend($strDate, $strSimbolMath);
    }

    /**
     * Metodo responsavel em retornar o dia da semana abreviado ou nao.
     *
     * @example \InepZend\Util\Library::getWeekday(1) <br /> \InepZend\Util\Library::getWeekday(1, true)
     *
     * @param integer $intDiaSemana
     * @param boolean $booAbreviatura
     * @return string
     * @deprecated
     */
    public static function getWeekday($intDiaSemana, $booAbreviatura = false)
    {
        return Date::getWeekday($intDiaSemana, $booAbreviatura);
    }

    /**
     * Metodo responsavel em retorna o nome do mes em portugues ou ingles.
     *
     * @example \InepZend\Util\Library::getPortugueseMonth(1) <br /> \InepZend\Util\Library::getPortugueseMonth(1, true)
     *
     * @param integer $intMonth
     * @param string $strLanguage
     * @return string
     * @deprecated
     */
    public static function getPortugueseMonth($intMonth, $strLanguage = 'br')
    {
        return Date::getPortugueseMonth($intMonth, $strLanguage);
    }

    /**
     * Metodo responsavel em retornar um array de datas (no formato das datas 
     * parametrizadas) de um periodo por dia.
     *
     * @example \InepZend\Util\Library::listDatesOfPeriod('18/07/2014', '25/07/2014')
     *
     * @param string strDate1
     * @param string strDate2
     * @return array
     * @deprecated
     */
    public static function listDatesOfPeriod($strDate1, $strDate2, $arrReturn = array())
    {
        return Date::listDatesOfPeriod($strDate1, $strDate2, $arrReturn);
    }

    /**
     * Metodo responsavel em exibr informacoes relacionadas a expressao. 
     * Se o segundo parametro for true a execucao e interrompida (utiliza o 
     * var_export e nao o var_dump).
     *
     * @example \InepZend\Util\Library::simpleDebug('PHPUnit') <br /> \InepZend\Util\Library::simpleDebug('PHPUnit', 1) <br /> \InepZend\Util\Library::simpleDebug('PHPUnit', false, 5)
     *
     * @param mix $mixVar
     * @param boolean $booExit
     * @param integer $intBacktrace
     * @return string
     * @deprecated
     */
    public static function simpleDebug($mixVar, $booExit = false, $intBacktrace = 0)
    {
        \InepZend\Util\Debug::simpleDebug($mixVar, $booExit, (($intBacktrace < 2) ? 2 : $intBacktrace));
    }

    /**
     * Metodo responsavel em exibr informacoes relacionadas a expressao. Se o 
     * segundo parametro for true a execucao e interrompida.
     *
     * @example \InepZend\Util\Library::debug('PHPUnit') <br /> \InepZend\Util\Library::debug('PHPUnit', 1) <br /> \InepZend\Util\Library::debug('PHPUnit', 1 , true) <br /> \InepZend\Util\Library::debug('PHPUnit', 1 , false) <br /> \InepZend\Util\Library::debug('PHPUnit', 1, true, false, 5)
     *
     * @param mix $mixVar
     * @param boolean $booExit
     * @param boolean $booStartCount
     * @param boolean $booVarExport
     * @param integer $intBacktrace
     * @return string
     * @deprecated
     */
    public static function debug($mixVar, $booExit = false, $booStartCount = null, $booVarExport = false, $intBacktrace = 0)
    {
        Debug::debug($mixVar, $booExit, $booStartCount, $booVarExport, (($intBacktrace === 0) ? 1 : $intBacktrace));
    }

    /**
     * Metodo responsavel em escrever informacoes de debug em um arquivo. 
     * Util para debug em WebServices.
     *
     * @example \InepZend\Util\Library::debugWS('PHPUnit') <br /> \InepZend\Util\Library::debugWS('PHPUnit', 1) <br /> \InepZend\Util\Library::debugWS('PHPUnit', 1, true) <br /> \InepZend\Util\Library::debugWS('PHPUnit', 1 , true, true) <br /> \InepZend\Util\Library::debugWS('PHPUnit', 1 , true, true, 'data\teste\debug.html') <br /> \InepZend\Util\Library::debugWS('PHPUnit', 1 , true, true, 'data\teste\debug.html', 5)
     *
     * @param mix $mixVar
     * @param boolean $booExit
     * @param boolean $booClear
     * @param boolean $booStartCount
     * @param string $strPathFile
     * @param integer $intBacktrace
     * @param boolean $booVarExport
     * @param boolean $booHtmlEntities
     * @return void
     * @deprecated
     */
    public static function debugWS($mixVar, $booExit = false, $booClear = false, $booStartCount = null, $strPathFile = null, $intBacktrace = 0, $booVarExport = true, $booHtmlEntities = true)
    {
        Debug::debugWS($mixVar, $booExit, $booClear, $booStartCount, $strPathFile, (($intBacktrace === 0) ? 1 : $intBacktrace), $booVarExport, $booHtmlEntities);
    }

    /**
     * Metodo responsavel em calcular o tempo de execucao de um determinado 
     * trecho de codigo, setando o momento inicial.
     *
     * @example \InepZend\Util\Library::startCount() <br /> \InepZend\Util\Library::startCount(true)
     *
     * @param boolean $booKeep
     * @return void
     * @deprecated
     */
    public static function startCount($booKeep = false)
    {
        Debug::startCount($booKeep);
    }

    /**
     * Metodo responsavel em calcular o tempo de execucao de um determinado 
     * trecho de codigo, calculando o momento atual menos o inicial.
     *
     * @example \InepZend\Util\Library::finishCount() <br /> \InepZend\Util\Library::finishCount(true)
     *
     * @param boolean $booExit
     * @param boolean $booShow
     * @return float
     * @deprecated
     */
    public static function finishCount($booExit = false, $booShow = true)
    {
        return Debug::finishCount($booExit, $booShow);
    }

    /**
     * @param null $mixVar
     * @param null $booVarExport
     * @return bool|mixed|string
     * @deprecated
     */
    public static function varDumpExport($mixVar = null, $booVarExport = null)
    {
        return Debug::varDumpExport($mixVar, $booVarExport);
    }

    /**
     * Metodo responsavel em inserir conteudo em arquivo.
     *
     * @example \InepZend\Util\Library::insertContentIntoFile('./path/') <br /> \InepZend\Util\Library::insertContentIntoFile('./path/', 'content') <br /> \InepZend\Util\Library::insertContentIntoFile('./path/', 'content', 'mode')
     *
     * @param string $strPathFile
     * @param string $strContent
     * @param string $strMode
     * @return boolean
     * @deprecated
     */
    public static function insertContentIntoFile($strPathFile = null, $strContent = '', $strMode = 'w+')
    {
        return FileSystem::insertContentIntoFile($strPathFile, $strContent, $strMode);
    }

    /**
     * Metodo responsavel em capturar o conteudo de um arquivo.
     *
     * @example \InepZend\Util\Library::getContentFromFile('./path_arquivo.php');
     *
     * @param string $strPathFile
     * @param boolean $booPhpIni
     * @return mix
     * @deprecated
     */
    public static function getContentFromFile($strPathFile = null, $booPhpIni = true)
    {
        return FileSystem::getContentFromFile($strPathFile, $booPhpIni);
    }

    /**
     * @param null $strPathFile
     * @param int $intLimit
     * @param int $intOffset
     * @param bool|true $booPhpIni
     * @return string
     * @deprecated
     */
    public static function getContentFromFileChunk($strPathFile = null, $intLimit = 1, $intOffset = 0, $booPhpIni = true)
    {
        return FileSystem::getContentFromFileChunk($strPathFile, $intLimit, $intOffset, $booPhpIni);
    }

    /**
     * @param null $strPathFile
     * @param bool|true $booPhpIni
     * @return bool|int
     * @deprecated
     */
    public static function getLineCountFromFile($strPathFile = null, $booPhpIni = true)
    {
        return FileSystem::getLineCountFromFile($strPathFile, $booPhpIni);
    }

    /**
     * Metodo responsavel em realizar o download de um conteudo em determinado 
     * formato (tipo) de arquivo.
     *
     * @example \InepZend\Util\Library::downloadContent('file.txt') <br /> \InepZend\Util\Library::downloadContent('file.txt', 'content') <br /> \InepZend\Util\Library::downloadContent('file.txt', 'content', 'type')
     *
     * @param string $strFileName
     * @param string $strContent
     * @param string $strContentType
     * @return void
     * @deprecated
     */
    public static function downloadContent($strFileName = null, $strContent = '', $strContentType = null)
    {
        FileSystem::downloadContent($strFileName, $strContent, $strContentType);
    }

    /**
     * @param null $strFileName
     * @param string $strContent
     * @param null $strContentType
     * @deprecated
     */
    public static function showContent($strFileName = null, $strContent = '', $strContentType = null)
    {
        FileSystem::showContent($strFileName, $strContent, $strContentType);
    }

    /**
     * @param null $strFileName
     * @param string $strContent
     * @param null $strContentType
     * @param null $strContentDisposition
     * @param null $arrValidateContentType
     * @deprecated
     */
    public static function headerContent($strFileName = null, $strContent = '', $strContentType = null, $strContentDisposition = null, $arrValidateContentType = null)
    {
        FileSystem::headerContent($strFileName, $strContent, $strContentType, $strContentDisposition, $arrValidateContentType);
    }

    /**
     * Metodo responsavel em retornar a estrutura de tipos MIME mapeados no metodo.
     *
     * @example Retorna todos mapeados. <br /> \InepZend\Util\Library::getMimeContentStructure(); <br /> Retorna um tipo especifico. <br /> \InepZend\Util\Library::getMimeContentStructure()["html"];
     *
     * @return array
     * @deprecated
     */
    public static function getMimeContentStructure()
    {
        return FileSystem::getMimeContentStructure();
    }

    /**
     * Metodo responsavel em capturar o tipo MIME a partir de uma determinada 
     * extensao de arquivo mapeado no metodo getMimeContentStructure.
     *
     * @example \InepZend\Util\Library::getMimeContentFromExtension("html");
     *
     * @param string $strExtension
     * @return mix
     * @deprecated
     */
    public static function getMimeContentFromExtension($strExtension)
    {
        return FileSystem::getMimeContentFromExtension($strExtension);
    }

    /**
     * Metodo responsavel em capturar o tipo MIME do conteudo do arquivo.
     *
     * @example \InepZend\Util\Library::getMimeContentFromFile("./path_arquivo.php");
     *
     * @param string $strPathFile
     * @return mix
     * @deprecated
     */
    public static function getMimeContentFromFile($strPathFile = null)
    {
        return FileSystem::getMimeContentFromFile($strPathFile);
    }

    /**
     * Metodo responsavel em capturar a(s) extensao(oes) a partir de um 
     * determinado tipo MIME mapeado no metodo getMimeContentStructure.
     *
     * @example \InepZend\Util\Library::getExtensionFromMimeContent("text/plain");
     *
     * @param string $strMimeContent
     * @return mix
     * @deprecated
     */
    public static function getExtensionFromMimeContent($strMimeContent)
    {
        return FileSystem::getExtensionFromMimeContent($strMimeContent);
    }

    /**
     * Metodo responsavel pelo retorno da extensao do arquivo.
     *
     * @example \InepZend\Util\Library::getExtensionFromFileName('test.txt')
     *
     * @param string $strFileName
     * @return string
     * @deprecated
     */
    public static function getExtensionFromFileName($strFileName = null)
    {
        return FileSystem::getExtensionFromFileName($strFileName);
    }

    /**
     * Metodo responsavel em deletar em cascata todos os arquivos de um 
     * diretorio e ele proprio tambem.
     *
     * @example \InepZend\Util\Library::undir('./path/file.php')
     *
     * @param string $strPath
     * @return void
     * @deprecated
     */
    public static function undir($strPath = null)
    {
        FileSystem::undir($strPath);
    }

    /**
     * Metodo responsavel em realizar a copia completa e recursiva.
     * 
     * @param string $strSource
     * @param string $strDest
     * @return void
     */
    public static function recurse_copy($strSource = null, $strDest = null)
    {
        FileSystem::recurse_copy($strSource, $strDest);
    }

    /**
     * Metodo responsavel em utilizar a funcao nativa glob recursivamente.
     *
     * @example \InepZend\Util\Library::globRecursive('./path/to/dir') <br /> \InepZend\Util\Library::globRecursive('./path/to/dir', 'extension') <br /> \InepZend\Util\Library::globRecursive('./path/to/dir', 'extension', array('DirOne','DirTwo')) <br /> \InepZend\Util\Library::globRecursive('./path/to/dir', 'extension', array('DirOne','DirTwo'), true/false, true/false)
     *
     * @param string $strPath
     * @param mix $mixExtension
     * @param array $arrPathRestrict
     * @param boolean $booShowDir
     * @param boolean $booShowOnlyDir
     * @return array
     * @deprecated
     */
    public static function globRecursive($strPath, $mixExtension = null, $arrPathRestrict = array(), $booShowDir = false, $booShowOnlyDir = false)
    {
        return FileSystem::globRecursive($strPath, $mixExtension, $arrPathRestrict, $booShowDir, $booShowOnlyDir);
    }

    /**
     * Metodo responsavel em utilizar a funcao nativa scandir recursivamente.
     *
     * @example \InepZend\Util\Library::scandirRecursive('./path/to/dir') <br /> \InepZend\Util\Library::scandirRecursive('./path/to/dir', 'extension') <br /> \InepZend\Util\Library::scandirRecursive('./path/to/dir', 'extension', array('DirOne','DirTwo')) <br /> \InepZend\Util\Library::scandirRecursive('./path/to/dir', 'extension', array('DirOne','DirTwo'), true/false, true/false)
     *
     * @param string $strPath
     * @param mix $mixExtension
     * @param array $arrPathRestrict
     * @param boolean $booShowDir
     * @param boolean $booShowOnlyDir
     * @return array
     * @deprecated
     */
    public static function scandirRecursive($strPath, $mixExtension = null, $arrPathRestrict = array(), $booShowDir = false, $booShowOnlyDir = false)
    {
        return FileSystem::scandirRecursive($strPath, $mixExtension, $arrPathRestrict, $booShowDir, $booShowOnlyDir);
    }

    /**
     * Metodo responsavel em utilizar funcoes nativas recursivamente para listar 
     * arquivos e diretorios.
     *
     * @example \InepZend\Util\Library::listFileFolderRecursive('glob/scandir', './path/to/dir') <br /> \InepZend\Util\Library::listFileFolderRecursive('glob/scandir', './path/to/dir', 'extension') <br /> \InepZend\Util\Library::listFileFolderRecursive('glob/scandir', './path/to/dir', 'extension', array('pathRestrict')) <br /> \InepZend\Util\Library::listFileFolderRecursive('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false) <br /> \InepZend\Util\Library::listFileFolderRecursive('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false, true/false) <br /> \InepZend\Util\Library::listFileFolderRecursive('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false, true/false, array('nameFiles.php')) <br /> \InepZend\Util\Library::listFileFolderRecursive('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false, true/false, array('nameFiles.php'), 100)
     *
     * @param string $strMethod
     * @param string $strPath
     * @param mix $mixExtension
     * @param array $arrPathRestrict
     * @param boolean $booShowDir
     * @param boolean $booShowOnlyDir
     * @param array $arrFiles
     * @param integer $intDepth
     * @return array
     * @deprecated
     */
    public static function listFileFolderRecursive($strMethod = 'glob', $strPath = null, $mixExtension = null, $arrPathRestrict = array(), $booShowDir = false, $booShowOnlyDir = false, $arrFiles = array(), $intDepth = 0)
    {
        return FileSystem::listFileFolderRecursive($strMethod, $strPath, $mixExtension, $arrPathRestrict, $booShowDir, $booShowOnlyDir, $arrFiles, $intDepth);
    }

    /**
     * Metodo responsavel em listar a arvore de diretorios de um determinado 
     * caminho.
     *
     * @example \InepZend\Util\Library::listTreePath('/path/to/dir/') <br /> \InepZend\Util\Library::listTreePath('/path/to/dir/', 1) <br /> \InepZend\Util\Library::listTreePath('/path/to/dir/', 2, 1)
     *
     * @param string $strPath
     * @param integer $intDepthMax
     * @param integer $intDepthCount
     * @return mix
     * @deprecated
     */
    public static function listTreePath($strPath = '/', $intDepthMax = 0, $intDepthCount = 0)
    {
        return FileSystem::listTreePath($strPath, $intDepthMax, $intDepthCount);
    }

    /**
     * Metodo responsavel em utilizar a funcao nativa glob recursivamente, 
     * apartir de parte do nome do diretorio.
     *
     * @example \InepZend\Util\Library::globRecursivePartPath('./path/to/dir') <br /> \InepZend\Util\Library::globRecursivePartPath('./path/to/dir', 'extension') <br /> \InepZend\Util\Library::globRecursivePartPath('./path/to/dir', 'extension', array('DirOne','DirTwo')) <br /> \InepZend\Util\Library::globRecursivePartPath('./path/to/dir', 'extension', array('DirOne','DirTwo'), true/false, true/false)
     *
     * @param string $strPath
     * @param mix $mixExtension
     * @param array $arrPathRestrict
     * @param boolean $booShowDir
     * @param boolean $booShowOnlyDir
     * @return array
     * @deprecated
     */
    public static function globRecursivePartPath($strPath, $mixExtension = null, $arrPathRestrict = array(), $booShowDir = false, $booShowOnlyDir = false)
    {
        return FileSystem::globRecursivePartPath($strPath, $mixExtension, $arrPathRestrict, $booShowDir, $booShowOnlyDir);
    }

    /**
     * Metodo responsavel em utilizar a funcao nativa scandir recursivamente, 
     * apartir de parte do nome do diretorio.
     *
     * @example \InepZend\Util\Library::scandirRecursivePartPath('./path/to/dir') <br /> \InepZend\Util\Library::scandirRecursivePartPath('./path/to/dir', 'extension') <br /> \InepZend\Util\Library::scandirRecursivePartPath('./path/to/dir', 'extension', array('DirOne','DirTwo')) <br /> \InepZend\Util\Library::scandirRecursivePartPath('./path/to/dir', 'extension', array('DirOne','DirTwo'), true/false, true/false)
     *
     * @param string $strPath
     * @param mix $mixExtension
     * @param array $arrPathRestrict
     * @param boolean $booShowDir
     * @param boolean $booShowOnlyDir
     * @return array
     * @deprecated
     */
    public static function scandirRecursivePartPath($strPath, $mixExtension = null, $arrPathRestrict = array(), $booShowDir = false, $booShowOnlyDir = false)
    {
        return FileSystem::scandirRecursivePartPath($strPath, $mixExtension, $arrPathRestrict, $booShowDir, $booShowOnlyDir);
    }

    /**
     * Metodo responsavel em utilizar funcoes nativas recursivamente para listar 
     * arquivos e diretorios, apartir de parte do nome do diretorio.
     *
     * @example \InepZend\Util\Library::listFileFolderRecursivePartPath('glob/scandir', './path/to/dir') <br /> \InepZend\Util\Library::listFileFolderRecursivePartPath('glob/scandir', './path/to/dir', 'extension') <br /> \InepZend\Util\Library::listFileFolderRecursivePartPath('glob/scandir', './path/to/dir', 'extension', array('pathRestrict')) <br /> \InepZend\Util\Library::listFileFolderRecursivePartPath('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false) <br /> \InepZend\Util\Library::listFileFolderRecursivePartPath('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false, true/false) <br /> \InepZend\Util\Library::listFileFolderRecursivePartPath('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false, true/false, array('nameFiles.php')) <br /> \InepZend\Util\Library::listFileFolderRecursivePartPath('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false, true/false, array('nameFiles.php'), 100)
     *
     * @param string $strMethod
     * @param string $strPath
     * @param mix $mixExtension
     * @param array $arrPathRestrict
     * @param boolean $booShowDir
     * @param boolean $booShowOnlyDir
     * @return array
     * @deprecated
     */
    public static function listFileFolderRecursivePartPath($strMethod = 'glob', $strPath = null, $mixExtension = null, $arrPathRestrict = array(), $booShowDir = false, $booShowOnlyDir = false)
    {
        return FileSystem::listFileFolderRecursivePartPath($strMethod, $strPath, $mixExtension, $arrPathRestrict, $booShowDir, $booShowOnlyDir);
    }

    /**
     * Metodo responsavel em retornar a data da ultima modificacao de um arquivo 
     * ou diretorio.
     *
     * @example \InepZend\Util\Library::getModificationTime('./pathOrFile/')
     *
     * @param string $strPath
     * @return mix
     * @deprecated
     */
    public static function getModificationTime($strPath)
    {
        return FileSystem::getModificationTime($strPath);
    }

    /**
     * Metodo responsavel em retornar o tamanho do diretorio ou arquivo caso exista.
     *
     * @example \InepZend\Util\Library::filesize('./pathOrFile/') <br /> \InepZend\Util\Library::filesize('./pathOrFile/', 'megabyte') <br /> \InepZend\Util\Library::filesize(null, null, 123456) <br /> \InepZend\Util\Library::filesize(null, 'megabyte', 123456)
     *
     * @param string $strPath
     * @param string $strUnitOfMeasure
     * @param integer $intByte
     * @return mix
     * @deprecated
     */
    public static function filesize($strPath = null, $strUnitOfMeasure = null, $intByte = null)
    {
        return FileSystem::filesize($strPath, $strUnitOfMeasure, $intByte);
    }

    /**
     * Metodo responsavel em retornar o tamanho do diretorio ou arquivo 
     * formatado, caso exista.
     *
     * @param string $strPath
     * @param integer $intByte
     * @param integer $booSigla
     * @return string
     * @deprecated
     */
    public static function filesizeFormated($strPath = null, $intByte = null, $booSigla = true)
    {
        return FileSystem::filesizeFormated($strPath, $intByte, $booSigla);
    }

    /**
     * Metodo responsavel em retornar o nome do arquivo.
     *
     * @example \InepZend\Util\Library::getFileNameFromPath('./path/file.txt')
     *
     * @param string $strPath
     * @return string
     * @deprecated
     */
    public static function getFileNameFromPath($strPath)
    {
        return FileSystem::getFileNameFromPath($strPath);
    }

    /**
     * Metodo responsavel em verificar se o parametro eh um CPF com mascara.
     *
     * @example \InepZend\Util\Library::isCpf('173.575.278-91');
     *
     * @param string $strNuCpf
     * @return boolean
     * @deprecated
     */
    public static function isCpf($strNuCpf)
    {
        return Format::isCpf($strNuCpf);
    }

    /**
     * Metodo responsavel em verificar se o parametro eh um CNPJ com ou sem 
     * mascara.
     *
     * @example \InepZend\Util\Library::isCnpj('56.167.101/0001-06');
     *
     * @param string $strNuCnpj
     * @return boolean
     * @deprecated
     */
    public static function isCnpj($strNuCnpj)
    {
        return Format::isCnpj($strNuCnpj);
    }

    /**
     * Metodo responsavel em formatar uma string nas mascaras de CPF ou CNPJ.
     *
     * @example \InepZend\Util\Library::formatCpfCnpj('17357527891'); <br /> \InepZend\Util\Library::formatCpfCnpj('56167101000106');
     *
     * @param string $strValue
     * @return string
     * @deprecated
     */
    public static function formatCpfCnpj($strValue)
    {
        return Format::formatCpfCnpj($strValue);
    }

    /**
     * Metodo responsavel em retirar as mascaras de CPF ou CNPJ uma string.
     *
     * @example \InepZend\Util\Library::clearCpfCnpj('173.575.278-91'); <br /> \InepZend\Util\Library::clearCpfCnpj('56.167.101/0001-06');
     *
     * @param string $strValue
     * @return string
     * @deprecated
     */
    public static function clearCpfCnpj($strValue)
    {
        return Format::clearCpfCnpj($strValue);
    }

    /**
     * Metodo responsavel em Formatar uma string nas mascaras de PIS/PASEP.
     *
     * @example \InepZend\Util\Library::formatPisPasep('12532227364');
     *
     * @param string $strValue
     * @return string
     * @deprecated
     */
    public static function formatPisPasep($strValue)
    {
        return Format::formatPisPasep($strValue);
    }

    /**
     * Metodo responsavel em formatar uma string nas mascaras de CEP.
     *
     * @example \InepZend\Util\Library::formatCep('70610404');
     *
     * @param string $strCep
     * @return string
     * @deprecated
     */
    public static function formatCep($strCep)
    {
        return Format::formatCep($strCep);
    }

    /**
     * Metodo responsavel em formatar uma string nas mascaras de PERCENTUAL.
     *
     * @example \InepZend\Util\Library::formatPercent('28'); <br /> \InepZend\Util\Library::formatPercent('28', 3); <br /> \InepZend\Util\Library::formatPercent('2.58'); <br /> \InepZend\Util\Library::formatPercent('2.58', 3); <br /> \InepZend\Util\Library::formatPercent('99.958');
     *
     * @param string $strPercent
     * @param integer $intMaxDecimal
     * @return string
     * @deprecated
     */
    public static function formatPercent($strPercent, $intMaxDecimal = 2)
    {
        return Format::formatPercent($strPercent, $intMaxDecimal);
    }

    /**
     * Metodo responsavel em formatar uma string nas mascaras de HORA.
     *
     * @example \InepZend\Util\Library::formatTime('15:22:50');
     *
     * @param string $strTime
     * @param integer $strFormat
     * @return string
     * @deprecated
     */
    public static function formatTime($strTime, $strFormat = 'H:i:s')
    {
        return Format::formatTime($strTime, $strFormat);
    }

    /**
     * Metodo responsavel em formatar uma string nas mascaras de TELEFONE.
     *
     * @example \InepZend\Util\Library::formatPhone('1111111111'); <br /> \InepZend\Util\Library::formatPhone('22222222'); <br /> \InepZend\Util\Library::formatPhone('12345123');
     *
     * @param string $strValue
     * @return string
     * @deprecated
     */
    public static function formatPhone($strValue)
    {
        return Format::formatPhone($strValue);
    }

    /**
     * Metodo responsavel em connverter do formato de DINHEIRO para double.
     *
     * @example \InepZend\Util\Library::moneyToFloat('R$ 1.234,56');
     *
     * @param string $strMoneyValue
     * @return float
     * @deprecated
     */
    public static function moneyToFloat($strMoneyValue)
    {
        return Format::moneyToFloat($strMoneyValue);
    }

    /**
     * Metodo responsavel em converter o numero double para o formato de DINHEIRO.
     *
     * @example \InepZend\Util\Library::moneyToFloat('1234.56');
     *
     * @param float $floValue
     * @param boolean $booCifrao
     * @return string
     * @deprecated
     */
    public static function floatToMoney($floValue, $booCifrao = true)
    {
        return Format::floatToMoney($floValue, $booCifrao);
    }

    /**
     * Metodo responsavel em colocar qualquer mascara.
     *
     * @example \InepZend\Util\Library::setMask('12345678911', '999.999.999-99');
     *
     * @param string $strValue
     * @param string $strMask
     * @return string
     * @deprecated
     */
    public static function setMask($strValue, $strMask)
    {
        return Format::setMask($strValue, $strMask);
    }

    /**
     * Metodo responsavel em retirar qualquer mascara.
     *
     * @example \InepZend\Util\Library::clearMask('999.999.999-99');
     *
     * @param string $strValue
     * @return string
     * @deprecated
     */
    public static function clearMask($strValue)
    {
        return Format::clearMask($strValue);
    }

    /**
     * Metodo responsavel em realizar a conversao de um valor informado para 
     * indicador.
     *
     * @example \InepZend\Util\Library::convertToIndicator('sim'); <br /> \InepZend\Util\Library::convertToIndicator(true); <br /> \InepZend\Util\Library::convertToIndicator('nao'); <br /> \InepZend\Util\Library::convertToIndicator(false);
     *
     * @param mix $mixValue
     * @return integer
     * @deprecated
     */
    public static function convertToIndicator($mixValue = null)
    {
        return Format::convertToIndicator($mixValue);
    }

    /**
     * Metodo responsavel em listar os DDDs do Brasil e os DDDs que possuem 9 
     * digitos.
     *
     * @example \InepZend\Util\Library::listDdd(); <br /> \InepZend\Util\Library::listDdd(true);
     *
     * @param boolean $boo9Digit
     * @return integer
     * @deprecated
     */
    public static function listDdd($boo9Digit = false)
    {
        return Format::listDdd($boo9Digit);
    }

    /**
     * Metodo responsavel em verificar se um valor parametrizado possui ou nao 
     * um caracter (string).
     *
     * @example \InepZend\Util\Library::hasString('1a')
     *
     * @param mix $mixValue
     * @return boolean
     * @deprecated
     */
    public static function hasString($mixValue = null)
    {
        return Format::hasString($mixValue);
    }

    /**
     * Metodo responsavel em verificar se uma string esta no formato de encode json.
     *
     * @example \InepZend\Util\Library::isJson('{}')
     * 
     * @param mix $mixValue
     * @return boolean
     * @deprecated
     */
    public static function isJson($mixValue = null)
    {
        return Format::isJson($mixValue);
    }

    /**
     * @param string $strText
     * @return string
     * @deprecated
     */
    public static function convertBadUnicode($strText = '')
    {
        return Format::convertBadUnicode($strText);
    }

    /**
     * @param string $strJson
     * @return mixed|string
     * @deprecated
     */
    public static function convertBadUnicodeForJson($strJson = '')
    {
        return Format::convertBadUnicodeForJson($strJson);
    }

    /**
     * Metodo responsavel em realizar algumas conversoes dos caracteres 
     * (inclusive dos especiais) de strings.
     *
     * @example \InepZend\Util\Library::convertCharacter('<©ç', false, false)
     *
     * @param string $strText
     * @param boolean $booManual
     * @param boolean $booInvert
     * @return string
     * @deprecated
     */
    public static function converteCaracter($strText, $booManual = false, $booInvert = false)
    {
        return Html::convertCharacter($strText, $booManual, $booInvert);
    }

    /**
     * Metodo responsavel em converter todos os caracteres aplicaveis em 
     * caracteres especiais (entidades html).
     *
     * @example \InepZend\Util\Library::convertAccent('<©ç')
     *
     * @param string $strText
     * @return string
     * @deprecated
     */
    public static function converteAcento($strText)
    {
        return Html::convertAccent($strText);
    }

    /**
     * Funcao que converte todos os metacaracteres para seu equivalente em HTML 
     * (ex.: &amp; => &).
     *
     * @param string $strText
     * @return string
     * @deprecated
     */
    public static function convertHtmlToText($strText)
    {
        return Html::convertHtmlToText($strText);
    }

    /**
     * Metodo responsavel em listar a grande maioria das tags html, inclusive 
     * aquelas deprecated.
     *
     * @example \InepZend\Util\Library::listTagHtml()
     *
     * @return array
     * @deprecated
     */
    public static function listTagHtml()
    {
        return Html::listTagHtml();
    }

    /**
     * Metodo responsavel em converter todos os caracteres aplicaveis em 
     * caracteres especiais (entidades html).
     *
     * @example \InepZend\Util\Library::convertAccent('<©ç')
     *
     * @param string $strText
     * @return string
     * @deprecated
     */
    public static function getCssTextArray($strCssText = null, array $arrDefault = array())
    {
        return Html::getCssTextArray($strCssText, $arrDefault);
    }

    /**
     * Metodo responsavel em converter todos os caracteres aplicaveis em 
     * caracteres especiais (entidades html).
     *
     * @example \InepZend\Util\Library::hasAttributeStyle('display: block; float: left;', 'float') <br /> \InepZend\Util\Library::hasAttributeStyle('display: block; float: left;', 'float:left')
     *
     * @param string $strStyle
     * @param string $strAttribute
     * @return mix
     * @deprecated
     */
    public static function hasAttributeStyle($strStyle = null, $strAttribute = null)
    {
        return Html::hasAttributeStyle($strStyle, $strAttribute);
    }

    /**
     * @param null $arrAttributeData
     * @return string
     * @deprecated
     */
    public static function getHtmlAttributeData($arrAttributeData = null)
    {
        return Html::getHtmlAttributeData($arrAttributeData);
    }

    /**
     * Realiza uma operacao matematica dentro de uma estrutura de repeticao.
     *
     * @example \InepZend\Util\Library::loopOperation(80, '+', 3, 2)
     *
     * @param string $strEvalInicialValue
     * @param string $strOperator
     * @param string $strEvalOperatorValue
     * @param integer $intLoop
     * @return mix
     * @deprecated
     */
    public static function loopOperation($strEvalInicialValue = null, $strOperator = null, $strEvalOperatorValue = null, $intLoop = null)
    {
        return Math::loopOperation($strEvalInicialValue, $strOperator, $strEvalOperatorValue, $intLoop);
    }

    /**
     * Calcula o percentual de um determinado valor em relacao ao total.
     *
     * @example \InepZend\Util\Library::getPercent(100, 30)
     *
     * @param mix $mixValueTotal
     * @param mix $mixValue
     * @param integer $intPrecision
     * @return mix
     * @deprecated
     */
    public static function getPercent($mixValueTotal = null, $mixValue = null, $intPrecision = null)
    {
        return Math::getPercent($mixValueTotal, $mixValue, $intPrecision);
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a quantidade maxima de memoria
     * que um script esta permitido alocar.
     * Isto ajuda a previnir que scripts mal escritos consumam toda memoria disponivel
     * no servidor.
     * Para nao ter limite de memoria, defina esta diretiva para -1.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::allocatesMemory(128, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::allocatesMemory('128M', \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intMegabyte ex.: 34M ou 34
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function allocatesMemory($intMegabyte = 128, $strOperation = null)
    {
        return PhpIni::allocatesMemory($intMegabyte, $strOperation);
    }

    /**
     * Retorna a quantidade maxima de memoria que um script esta permitido alocar.
     *
     * @example \InepZend\Util\Library::getMemoryAllocated()
     *
     * @return mix
     * @deprecated
     */
    public static function getMemoryAllocated()
    {
        return PhpIni::getMemoryAllocated();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o tempo maximo em segundos que
     * eh permitido para executar antes de ser finalizado pelo interpretador.
     * Isso ajuda a evitar que scripts mal escritos de prender o servidor.
     * Para nao ter limite de tempo, defina esta diretiva para 0.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setTimeLimit(30, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setTimeLimit(40, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intSecond
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setTimeLimit($intSecond = 30, $strOperation = null)
    {
        return PhpIni::setTimeLimit($intSecond, $strOperation);
    }

    /**
     * Retorna o tempo maximo em segundos que eh permitido para executar antes de
     * ser finalizado pelo interpretador.
     *
     * @example \InepZend\Util\Library::getTimeLimit()
     *
     * @return mix
     * @deprecated
     */
    public static function getTimeLimit()
    {
        return PhpIni::getTimeLimit();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que permite o uso de URL em funcoes como
     * include, include_once, require, require_once.
     *
     * @example \InepZend\Util\Library::setAllowUrlInclude(true) <br /> \InepZend\Util\Library::setAllowUrlInclude(false)
     *
     * @param boolean $booAllow
     * @return mix
     * @deprecated
     */
    public static function setAllowUrlInclude($booAllow = false)
    {
        return PhpIni::setAllowUrlInclude($booAllow);
    }

    /**
     * Retorna a permissao do uso de URL em funcoes como include, include_once,
     * require, require_once.
     *
     * @example \InepZend\Util\Library::getAllowUrlInclude()
     *
     * @return mix
     * @deprecated
     */
    public static function getAllowUrlInclude()
    {
        return PhpIni::getAllowUrlInclude();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a latitude padrao do sistema.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setDateDefaultLatitude(32.7667, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setDateDefaultLatitude(1.0000, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param float $floLatitude
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setDateDefaultLatitude($floLatitude = 0.0000, $strOperation = null)
    {
        return PhpIni::setDateDefaultLatitude($floLatitude, $strOperation);
    }

    /**
     * Retorna a latitude padrao do sistema.
     *
     * @example \InepZend\Util\Library::getDateDefaultLatitude()
     *
     * @return mix
     * @deprecated
     */
    public static function getDateDefaultLatitude()
    {
        return PhpIni::getDateDefaultLatitude();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a longitude padrao do sistema.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setDateDefaultLongitude(36.2333, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setDateDefaultLongitude(1.0000, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param float $floLongitude
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setDateDefaultLongitude($floLongitude = 0.0000, $strOperation = null)
    {
        return PhpIni::setDateDefaultLongitude($floLongitude, $strOperation);
    }

    /**
     * Retorna a longitude padrao do sistema.
     *
     * @example \InepZend\Util\Library::getDateDefaultLongitude()
     *
     * @return mix
     * @deprecated
     */
    public static function getDateDefaultLongitude()
    {
        return PhpIni::getDateDefaultLongitude();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a zona horaria padrao usada 
     * por todas as funcoes de data/hora.
     *
     * @example \InepZend\Util\Library::setDateTimezone('America/Sao_Paulo')
     *
     * @param string $strTimezone
     * @return mix
     * @deprecated
     */
    public static function setDateTimezone($strTimezone = '')
    {
        return PhpIni::setDateTimezone($strTimezone);
    }

    /**
     * Retorna a zona horaria padrao usada por todas as funcoes de data/hora.
     *
     * @example \InepZend\Util\Library::getDateTimezone()
     *
     * @return mix
     * @deprecated
     */
    public static function getDateTimezone()
    {
        return PhpIni::getDateTimezone();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que envia uma codificacao de caracteres
     * por padrao no Content-type: header.
     * Para nao ter o envio do codigo, defina esta diretiva para vazio.
     *
     * @example \InepZend\Util\Library::setDefaultCharset('UTF-8') <br /> \InepZend\Util\Library::setDefaultCharset('')
     *
     * @param string $strCharset
     * @return mix
     * @deprecated
     */
    public static function setDefaultCharset($strCharset = 'UTF-8')
    {
        return PhpIni::setDefaultCharset($strCharset);
    }

    /**
     * Retorna a codificacao de caracteres por padrao no Content-type: header.
     *
     * @example \InepZend\Util\Library::getDefaultCharset()
     *
     * @return mix
     * @deprecated
     */
    public static function getDefaultCharset()
    {
        return PhpIni::getDefaultCharset();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o padrao de classificacao dos
     * tipos de arquivos na Internet.
     *
     * @example \InepZend\Util\Library::setDefaultMimetype('text/html') <br /> \InepZend\Util\Library::setDefaultMimetype('text/plain') <br /> \InepZend\Util\Library::setDefaultMimetype('image/gif')
     *
     * @param string $strMimetype
     * @return mix
     * @deprecated
     */
    public static function setDefaultMimetype($strMimetype = 'text/html')
    {
        return PhpIni::setDefaultMimetype($strMimetype);
    }

    /**
     * Retorna o padrao de classificacao dos tipos de arquivos na Internet.
     *
     * @example \InepZend\Util\Library::getDefaultMimetype()
     *
     * @return mix
     * @deprecated
     */
    public static function getDefaultMimetype()
    {
        return PhpIni::getDefaultMimetype();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o timeout padrao (em segundos)
     * para streams baseados em socket.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setDefaultSocketTimeout(60, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setDefaultSocketTimeout(10, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intSecond
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setDefaultSocketTimeout($intSecond = 60, $strOperation = null)
    {
        return PhpIni::setDefaultSocketTimeout($intSecond, $strOperation);
    }

    /**
     * Retorna o timeout padrao (em segundos) para streams baseados em socket.
     *
     * @example \InepZend\Util\Library::getDefaultSocketTimeout()
     *
     * @return mix
     * @deprecated
     */
    public static function getDefaultSocketTimeout()
    {
        return PhpIni::getDefaultSocketTimeout();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que determina se os erros devem ser
     * impressos na tela como parte da saida ou se devem ser escondidos do usuario.
     * Valor "stderr" envia os erros para stderr em vez de stdout.
     * Em versões anteriores a 5.2.4, esta diretiva era do tipo boolean.
     *
     * @example \InepZend\Util\Library::setDisplayErrors(1) <br /> \InepZend\Util\Library::setDisplayErrors(0) <br /> \InepZend\Util\Library::setDisplayErrors('stderr')
     *
     * @param mix $mixDisplay
     * @return mix
     * @deprecated
     */
    public static function setDisplayErrors($mixDisplay = 1)
    {
        return PhpIni::setDisplayErrors($mixDisplay);
    }

    /**
     * Retorna a determinacao se os erros devem ser impressos na tela como parte
     * da saida ou se devem ser escondidos do usuario.
     *
     * @example \InepZend\Util\Library::getDisplayErrors()
     *
     * @return mix
     * @deprecated
     */
    public static function getDisplayErrors()
    {
        return PhpIni::getDisplayErrors();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define se os erros que ocorrem durante
     * a inicializacao do PHP serao mostrados mesmo quando display_errors esta ligado.
     * Eh fortemente recomendado manter display_startup_errors off, exceto para debug.
     *
     * @example \InepZend\Util\Library::setDisplayStartupErrors(false) <br /> \InepZend\Util\Library::setDisplayStartupErrors(true)
     *
     * @param boolean $booDisplay
     * @return mix
     * @deprecated
     */
    public static function setDisplayStartupErrors($booDisplay = false)
    {
        return PhpIni::setDisplayStartupErrors($booDisplay);
    }

    /**
     * Retorna a definicao se os erros que ocorrem durante a inicializacao do PHP
     * serao mostrados mesmo quando display_errors esta ligado.
     *
     * @example \InepZend\Util\Library::getDisplayStartupErrors()
     *
     * @return mix
     * @deprecated
     */
    public static function getDisplayStartupErrors()
    {
        return PhpIni::getDisplayStartupErrors();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define uma string para saida apos uma
     * mensagem de erro.
     *
     * @example \InepZend\Util\Library::setErrorAppendString('End')
     *
     * @param string $strErrorAppend
     * @return mix
     * @deprecated
     */
    public static function setErrorAppendString($strErrorAppend = null)
    {
        return PhpIni::setErrorAppendString($strErrorAppend);
    }

    /**
     * Retorna a definicao da string para saida apos uma mensagem de erro.
     *
     * @example \InepZend\Util\Library::getErrorAppendString()
     *
     * @return mix
     * @deprecated
     */
    public static function getErrorAppendString()
    {
        return PhpIni::getErrorAppendString();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nome do arquivo onde os erros
     * do script serao logados.
     * Se o valor especial syslog eh usado, os erros sao enviados para o log do
     * sistema.
     *
     * @example \InepZend\Util\Library::setErrorLog('error') <br /> \InepZend\Util\Library::setErrorLog('syslog')
     *
     * @param string $strErrorLog
     * @return mix
     * @deprecated
     */
    public static function setErrorLog($strErrorLog = null)
    {
        return PhpIni::setErrorLog($strErrorLog);
    }

    /**
     * Retorna a definicao do nome do arquivo onde os erros do script serao logados.
     *
     * @example \InepZend\Util\Library::getErrorLog()
     *
     * @return mix
     * @deprecated
     */
    public static function getErrorLog()
    {
        return PhpIni::getErrorLog();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define uma string para saida antes 
     * de uma mensagem de erro.
     *
     * @example \InepZend\Util\Library::setErrorPrependString('Error: ')
     *
     * @param string $strErrorPrepend
     * @return mix
     * @deprecated
     */
    public static function setErrorPrependString($strErrorPrepend = null)
    {
        return PhpIni::setErrorPrependString($strErrorPrepend);
    }

    /**
     * Retorna a definicao da string para saida antes de uma mensagem de erro.
     *
     * @example \InepZend\Util\Library::getErrorPrependString()
     *
     * @return mix
     * @deprecated
     */
    public static function getErrorPrependString()
    {
        return PhpIni::getErrorPrependString();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nivel de relatorio de erros.
     * O parametro eh um inteiro que representa um campo de bits, ou uma constante.
     * Para definir em tempo de execucao, use a funcao error_reporting().
     *
     * @example \InepZend\Util\Library::setErrorReporting(E_ALL) <br /> \InepZend\Util\Library::setErrorReporting(E_ALL & ~E_NOTICE) <br /> \InepZend\Util\Library::setErrorReporting(E_ALL | E_STRICT)
     *
     * @param string $intErrorReporting
     * @return mix
     * @deprecated
     */
    public static function setErrorReporting($intErrorReporting = null)
    {
        return PhpIni::setErrorReporting($intErrorReporting);
    }

    /**
     * Retorna a definicao do nivel de relatorio de erros.
     *
     * @example \InepZend\Util\Library::getErrorReporting()
     *
     * @return mix
     * @deprecated
     */
    public static function getErrorReporting()
    {
        return PhpIni::getErrorReporting();
    }

    /**
     * Metodo com permissao PHP_INI_SYSTEM que define se deve ou nao permitir o
     * upload de arquivos HTTP.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     *
     * @example \InepZend\Util\Library::setFileUploads(true) <br /> \InepZend\Util\Library::setFileUploads(false)
     *
     * @param boolean $booEnable
     * @return mix
     * @deprecated
     */
    public static function setFileUploads($booEnable = true)
    {
        return PhpIni::setFileUploads($booEnable);
    }

    /**
     * Retorna a definicao se deve ou nao permitir o upload de arquivos HTTP.
     *
     * @example \InepZend\Util\Library::getFileUploads()
     *
     * @return mix
     * @deprecated
     */
    public static function getFileUploads()
    {
        return PhpIni::getFileUploads();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o endereco de e-mail do 
     * remetente.
     *
     * @example \InepZend\Util\Library::setFrom('test')
     *
     * @param string $strFrom
     * @return mix
     * @deprecated
     */
    public static function setFrom($strFrom = '')
    {
        return PhpIni::setFrom($strFrom);
    }

    /**
     * Retorna a definicao do endereco de e-mail do remetente.
     *
     * @example \InepZend\Util\Library::getFrom()
     *
     * @return mix
     * @deprecated
     */
    public static function getFrom()
    {
        return PhpIni::getFrom();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que desliga tags HTML em mensagens de erro.
     * O novo formato de erro em HTML produz mensagens clicaveis ​​que direcionam
     * o usuario para uma pagina descrevendo o erro ou a funcao que causou o erro.
     * Essas referencias sao afetados por docref_root e docref_ext.
     *
     * @example \InepZend\Util\Library::setHtmlErrors(true) <br /> \InepZend\Util\Library::setHtmlErrors(false)
     *
     * @param boolean $booEnable
     * @return mix
     * @deprecated
     */
    public static function setHtmlErrors($booEnable = true)
    {
        return PhpIni::setHtmlErrors($booEnable);
    }

    /**
     * Retorna a identificacao se as tags HTML em mensagens de erro estao desligadas.
     *
     * @example \InepZend\Util\Library::getHtmlErrors()
     *
     * @return mix
     * @deprecated
     */
    public static function getHtmlErrors()
    {
        return PhpIni::getHtmlErrors();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que nao loga mensagens repetidas.
     * Erros repetidos devem acontecer no mesmo arquivo na mesma linha enquanto
     * ignore_repeated_source estiver ativo.
     *
     * @example \InepZend\Util\Library::setIgnoreRepeatedErrors(true) <br /> \InepZend\Util\Library::setIgnoreRepeatedErrors(false)
     *
     * @param boolean $booIgnore
     * @return mix
     * @deprecated
     */
    public static function setIgnoreRepeatedErrors($booIgnore = false)
    {
        return PhpIni::setIgnoreRepeatedErrors($booIgnore);
    }

    /**
     * Retorna a identificacao se nao loga mensagens repetidas.
     *
     * @example \InepZend\Util\Library::getIgnoreRepeatedErrors()
     *
     * @return mix
     * @deprecated
     */
    public static function getIgnoreRepeatedErrors()
    {
        return PhpIni::getIgnoreRepeatedErrors();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que ignora a fonte da mensagem quando estiver
     * ignorando mensagens repetidas.
     * Quando esta diretiva estiver ativa, nao ira registrar erros com mensagens
     * repetidas de arquivos diferentes ou linhas.
     *
     * @example \InepZend\Util\Library::setIgnoreRepeatedSource(false) <br /> \InepZend\Util\Library::setIgnoreRepeatedSource(true)
     *
     * @param boolean $booIgnore
     * @return mix
     * @deprecated
     */
    public static function setIgnoreRepeatedSource($booIgnore = false)
    {
        return PhpIni::setIgnoreRepeatedSource($booIgnore);
    }

    /**
     * Retorna a identificacao se ignora a fonte da mensagem quando estiver 
     * ignorando mensagens repetidas.
     *
     * @example \InepZend\Util\Library::getIgnoreRepeatedSource()
     *
     * @return mix
     * @deprecated
     */
    public static function getIgnoreRepeatedSource()
    {
        return PhpIni::getIgnoreRepeatedSource();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que termina os scripts assim que o 
     * cliente abortar sua conexao.
     *
     * @example \InepZend\Util\Library::setIgnoreUserAbort(false) <br /> \InepZend\Util\Library::setIgnoreUserAbort(true)
     *
     * @param boolean $booIgnore
     * @return mix
     * @deprecated
     */
    public static function setIgnoreUserAbort($booIgnore = false)
    {
        return PhpIni::setIgnoreUserAbort($booIgnore);
    }

    /**
     * Retorna a identificacao se termina os scripts assim que o cliente abortar
     * sua conexao.
     *
     * @example \InepZend\Util\Library::getIgnoreUserAbort()
     *
     * @return mix
     * @deprecated
     */
    public static function getIgnoreUserAbort()
    {
        return PhpIni::getIgnoreUserAbort();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o descarregamento automatico
     * a cada bloco de saida.
     * Isto eh equivalente a utilizar a funcao do PHP flush() a cada print ou echo
     * e a cada bloco de HTML.
     * Quando estiver usando o PHP em um ambiente web, ativando esta opcao tem uma
     * seria implicacao na performance e geralmente eh recomendada apenas para debug.
     *
     * @example \InepZend\Util\Library::setImplicitFlush(false) <br /> \InepZend\Util\Library::setImplicitFlush(true)
     *
     * @param boolean $booEnable
     * @return mix
     * @deprecated
     */
    public static function setImplicitFlush($booEnable = false)
    {
        return PhpIni::setImplicitFlush($booEnable);
    }

    /**
     * Retorna a definicao do descarregamento automatico a cada bloco de saida.
     *
     * @example \InepZend\Util\Library::getImplicitFlush()
     *
     * @return mix
     * @deprecated
     */
    public static function getImplicitFlush()
    {
        return PhpIni::getImplicitFlush();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica uma lista de diretorios que
     * podem ser utilizados por funcoes que procuram por arquivos, como fopen(),
     * file(), readfile() e file_get_contents().
     * A lista de diretorios eh uma string separada por dois pontos no Unix ou ponto
     * e virgula no Windows (usar a constante PATH_SEPARATOR).
     * A ordem das partes influencia na procura dos arquivos.
     *
     * @example \InepZend\Util\Library::setIncludePath('.;') <br /> \InepZend\Util\Library::setIncludePath('.;c:\;')
     *
     * @param string $strPath
     * @return mix
     * @deprecated
     */
    public static function setIncludePath($strPath = '.;')
    {
        return PhpIni::setIncludePath($strPath);
    }

    /**
     * Retorna uma lista de diretorios que podem ser utilizados por funcoes que
     * procuram por arquivos, como fopen(), file(), readfile() e file_get_contents().
     *
     * @example \InepZend\Util\Library::getIncludePath()
     *
     * @return mix
     * @deprecated
     */
    public static function getIncludePath()
    {
        return PhpIni::getIncludePath();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que indica se as mensagens de erro devem
     * ser registradas no log de erro do servidor ou error_log.
     *
     * @example \InepZend\Util\Library::setLogErrors(false) <br /> \InepZend\Util\Library::setLogErrors(true)
     *
     * @param boolean $booEnable
     * @return mix
     * @deprecated
     */
    public static function setLogErrors($booEnable = false)
    {
        return PhpIni::setLogErrors($booEnable);
    }

    /**
     * Retorna a indicacao se as mensagens de erro devem ser registradas no log
     * de erro do servidor ou error_log.
     *
     * @example \InepZend\Util\Library::getLogErrors()
     *
     * @return mix
     * @deprecated
     */
    public static function getLogErrors()
    {
        return PhpIni::getLogErrors();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o comprimento maximo de log_errors
     * em bytes.
     * Para nao ter o comprimento maximo de log_errors, defina esta diretiva para
     * zero.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setLogErrorsMaxLen(1024, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setLogErrorsMaxLen(10, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intLength
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setLogErrorsMaxLen($intLength = 1024, $strOperation = null)
    {
        return PhpIni::setLogErrorsMaxLen($intLength, $strOperation);
    }

    /**
     * Retorna a definicao do comprimento maximo de log_errors em bytes.
     *
     * @example \InepZend\Util\Library::getLogErrorsMaxLen()
     *
     * @return mix
     * @deprecated
     */
    public static function getLogErrorsMaxLen()
    {
        return PhpIni::getLogErrorsMaxLen();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o tempo maximo em segundos
     * que eh permitido para executar antes de ser finalizado pelo interpretador.
     * Isso ajuda a evitar que scripts mal escritos de prender o servidor.
     * Para nao ter limite de tempo, defina esta diretiva para 0.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setMaxExecutionTime(30, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setMaxExecutionTime(40, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intSecond
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setMaxExecutionTime($intSecond = 30, $strOperation = null)
    {
        return PhpIni::setMaxExecutionTime($intSecond, $strOperation);
    }

    /**
     * Retorna o tempo maximo em segundos que eh permitido para executar antes de
     * ser finalizado pelo interpretador.
     *
     * @example \InepZend\Util\Library::getMaxExecutionTime()
     *
     * @return mix
     * @deprecated
     */
    public static function getMaxExecutionTime()
    {
        return PhpIni::getMaxExecutionTime();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que deixa os erros do memcached transparentes
     * a outros servidores.
     *
     * @example \InepZend\Util\Library::setMemcacheAllowFailover(true) <br /> \InepZend\Util\Library::setMemcacheAllowFailover(false)
     *
     * @param boolean $booAllow
     * @return mix
     * @deprecated
     */
    public static function setMemcacheAllowFailover($booAllow = true)
    {
        return PhpIni::setMemcacheAllowFailover($booAllow);
    }

    /**
     * Retorna a definicao que deixa os erros do memcached transparentes a outros
     * servidores.
     *
     * @example \InepZend\Util\Library::getMemcacheAllowFailover()
     *
     * @return mix
     * @deprecated
     */
    public static function getMemcacheAllowFailover()
    {
        return PhpIni::getMemcacheAllowFailover();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o tamanho dos blocos a serem
     * transferidos pelo memcached.
     * A definicao de valor mais baixo requer mais rede.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setMemcacheChunkSize(33000, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setMemcacheChunkSize(24576, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intSize
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setMemcacheChunkSize($intSize = 8192, $strOperation = null)
    {
        return PhpIni::setMemcacheChunkSize($intSize, $strOperation);
    }

    /**
     * Retorna o tamanho dos blocos a serem transferidos pelo memcached.
     *
     * @example \InepZend\Util\Library::getMemcacheChunkSize()
     *
     * @return mix
     * @deprecated
     */
    public static function getMemcacheChunkSize()
    {
        return PhpIni::getMemcacheChunkSize();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a porta TCP padrao para conectar
     * ao servidor de memcached se nenhuma outra porta for especificada.
     *
     * @example \InepZend\Util\Library::setMemcacheDefaultPort(11211)
     *
     * @param integer $intPort
     * @return mix
     * @deprecated
     */
    public static function setMemcacheDefaultPort($intPort = 11211)
    {
        return PhpIni::setMemcacheDefaultPort($intPort);
    }

    /**
     * Retorna a porta TCP padrao para conectar ao servidor de memcached se nenhuma
     * outra porta for especificada.
     *
     * @example \InepZend\Util\Library::getMemcacheDefaultPort()
     *
     * @return mix
     * @deprecated
     */
    public static function getMemcacheDefaultPort()
    {
        return PhpIni::getMemcacheDefaultPort();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que controla qual funcao hash deve ser 
     * aplicada ao mapear chaves em servidores de memcached.
     *
     * @example \InepZend\Util\Library::setMemcacheHashFunction('crc32')
     *
     * @param string $strFunction
     * @return mix
     * @deprecated
     */
    public static function setMemcacheHashFunction($strFunction = 'crc32')
    {
        return PhpIni::setMemcacheHashFunction($strFunction);
    }

    /**
     * Retorna qual funcao hash deve ser aplicada ao mapear chaves em servidores
     * de memcached.
     *
     * @example \InepZend\Util\Library::getMemcacheHashFunction()
     *
     * @return mix
     * @deprecated
     */
    public static function getMemcacheHashFunction()
    {
        return PhpIni::getMemcacheHashFunction();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que controla qual estrategia deve ser 
     * utilizada ao mapear chaves para servidores de memcached.
     *
     * @example \InepZend\Util\Library::setMemcacheHashStrategy('standard')
     *
     * @param string $strStrategy
     * @return mix
     * @deprecated
     */
    public static function setMemcacheHashStrategy($strStrategy = 'standard')
    {
        return PhpIni::setMemcacheHashStrategy($strStrategy);
    }

    /**
     * Retorna qual estrategia deve ser utilizada ao mapear chaves para servidores
     * de memcached.
     *
     * @example \InepZend\Util\Library::getMemcacheHashStrategy()
     *
     * @return mix
     * @deprecated
     */
    public static function getMemcacheHashStrategy()
    {
        return PhpIni::getMemcacheHashStrategy();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define quantos servidores memcached
     * serao utilizados para inserir e extrair dados.
     * Usado apenas em conjunto com memcache.allow_failover.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setMemcacheMaxFailoverAttempts(128, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setMemcacheMaxFailoverAttempts('128M', \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intAttempt
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setMemcacheMaxFailoverAttempts($intAttempt = 20, $strOperation = null)
    {
        return PhpIni::setMemcacheMaxFailoverAttempts($intAttempt, $strOperation);
    }

    /**
     * Retorna quantos servidores memcached serao utilizados para inserir e 
     * extrair dados.
     *
     * @example \InepZend\Util\Library::getMemcacheMaxFailoverAttempts()
     *
     * @return mix
     * @deprecated
     */
    public static function getMemcacheMaxFailoverAttempts()
    {
        return PhpIni::getMemcacheMaxFailoverAttempts();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a quantidade maxima de memoria
     * que um script esta permitido alocar.
     * Isto ajuda a previnir que scripts mal escritos consumam toda memoria disponivel
     * no servidor.
     * Para nao ter limite de memoria, defina esta diretiva para -1.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setMemoryLimit(128, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setMemoryLimit('128M', \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intMegabyte ex.: 34M ou 34
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setMemoryLimit($intMegabyte = 128, $strOperation = null)
    {
        return PhpIni::setMemoryLimit($intMegabyte, $strOperation);
    }

    /**
     * Retorna a quantidade maxima de memoria que um script esta permitido alocar.
     *
     * @example \InepZend\Util\Library::getMemoryLimit()
     *
     * @return mix
     * @deprecated
     */
    public static function getMemoryLimit()
    {
        return PhpIni::getMemoryLimit();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que limita os arquivos que podem ser abertos
     * pelo PHP para uma lista de diretorios especificados, incluindo o arquivo
     * em si.
     * A lista de diretorios eh uma string separada por dois pontos no Unix ou ponto
     * e virgula no Windows (usar a constante PATH_SEPARATOR).
     * A ordem das partes influencia na procura dos arquivos.
     *
     * @example \InepZend\Util\Library::setOpenBasedir('/www/') <br /> \InepZend\Util\Library::setOpenBasedir('/www/;/dir/include;')
     *
     * @param string $strBasedir
     * @return mix
     * @deprecated
     */
    public static function setOpenBasedir($strBasedir = null)
    {
        return PhpIni::setOpenBasedir($strBasedir);
    }

    /**
     * Retorna uma lista de diretorios especificados, incluindo o arquivo em si,
     * que limita os arquivos que podem ser abertos pelo PHP.
     *
     * @example \InepZend\Util\Library::getOpenBasedir()
     *
     * @return mix
     * @deprecated
     */
    public static function getOpenBasedir()
    {
        return PhpIni::getOpenBasedir();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define uma lista de arquivos phar para
     * a localizacao de seus arquivos PHP extraidos.
     * O formato do parametro eh alias=pharFile, alias2=pharFile2.
     * Isso geralmente eh feito por motivos de desempenho, ou para ajudar na depuracao
     * de um phar.
     *
     * @example \InepZend\Util\Library::setPharExtractList('') <br /> \InepZend\Util\Library::setPharExtractList('archive=/full/path/to/archive/,arch2=/full/path/to/arch2')
     *
     * @param string $strExtractList
     * @return mix
     * @deprecated
     */
    public static function setPharExtractList($strExtractList = '')
    {
        return PhpIni::setPharExtractList($strExtractList);
    }

    /**
     * Retorna a definicao da lista de arquivos phar para a localizacao de seus
     * arquivos PHP extraidos.
     *
     * @example \InepZend\Util\Library::getPharExtractList()
     *
     * @return mix
     * @deprecated
     */
    public static function getPharExtractList()
    {
        return PhpIni::getPharExtractList();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que desabilita a criacao ou modificacao
     * de arquivos phar utilizando o fluxo de phar ou suporte de gravacao de objeto
     * Phar.
     *
     * @example \InepZend\Util\Library::setPharReadOnly(true) <br /> \InepZend\Util\Library::setPharReadOnly(false)
     *
     * @param boolean $booEnable
     * @return mix
     * @deprecated
     */
    public static function setPharReadOnly($booEnable = true)
    {
        return PhpIni::setPharReadOnly($booEnable);
    }

    /**
     * Retorna a identificacao se desabilita a criacao ou modificacao de arquivos
     * phar utilizando o fluxo de phar ou suporte de gravacao de objeto Phar.
     *
     * @example \InepZend\Util\Library::getPharReadOnly()
     *
     * @return mix
     * @deprecated
     */
    public static function getPharReadOnly()
    {
        return PhpIni::getPharReadOnly();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que forca todos os arquivos phar abertos
     * para conter algum tipo de assinatura (atualmente MD5, SHA1, SHA256 e SHA512
     * sao suportados), e se recusa a processar qualquer arquivo phar que nao contem
     * uma assinatura.
     *
     * @example \InepZend\Util\Library::setPharRequireHash(true) <br /> \InepZend\Util\Library::setPharRequireHash(false)
     *
     * @param boolean $booEnable
     * @return mix
     * @deprecated
     */
    public static function setPharRequireHash($booEnable = true)
    {
        return PhpIni::setPharRequireHash($booEnable);
    }

    /**
     * Retorna a identificacao se forca todos os arquivos phar abertos para conter
     * algum tipo de assinatura (atualmente MD5, SHA1, SHA256 e SHA512 sao suportados),
     * e se recusa a processar qualquer arquivo phar que nao contem uma assinatura.
     *
     * @example \InepZend\Util\Library::getPharRequireHash()
     *
     * @return mix
     * @deprecated
     */
    public static function getPharRequireHash()
    {
        return PhpIni::getPharRequireHash();
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define o tamanho maximo dos dados
     * postados.
     * Essa configuracao tambem afeta o upload de arquivos. Para enviar arquivos
     * grandes, esse valor deve ser maior que upload_max_filesize.
     * Se o limite de memoria eh ativada por seu script de configuracao, memory_limit
     * tambem afeta o upload de arquivos.
     * De um modo geral, memory_limit deve ser maior que post_max_size.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     *
     * @example \InepZend\Util\Library::setPostMaxSize(8, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setPostMaxSize(12, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intMegabyte
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setPostMaxSize($intMegabyte = 8, $strOperation = null)
    {
        return PhpIni::setPostMaxSize($intMegabyte, $strOperation);
    }

    /**
     * Retorna a definicao do tamanho maximo dos dados postados.
     *
     * @example \InepZend\Util\Library::getPostMaxSize()
     *
     * @return mix
     * @deprecated
     */
    public static function getPostMaxSize()
    {
        return PhpIni::getPostMaxSize();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o endereco de e-mail do remetente
     * no Windows.
     * Esta diretiva tambem define o "Return-Path:" no header.
     *
     * @example \InepZend\Util\Library::setSendmailFrom('test')
     *
     * @param string $strFrom
     * @return mix
     * @deprecated
     */
    public static function setSendmailFrom($strFrom = null)
    {
        return PhpIni::setSendmailFrom($strFrom);
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o endereco de e-mail do remetente
     * no Windows.
     * Esta diretiva tambem define o "Return-Path:" no header.
     *
     * @example \InepZend\Util\Library::setSendmailFrom('test')
     *
     * @param string $strFrom
     * @return mix
     * @deprecated
     */
    public static function getSendmailFrom()
    {
        return PhpIni::getSendmailFrom();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica o tempo de vida para paginas
     * de sessao, em minutos.
     * Nao tem efeito na limitacao de nocache.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setSessionCacheExpire(180, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setSessionCacheExpire(20, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intSecond
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setSessionCacheExpire($intSecond = 180, $strOperation = null)
    {
        return PhpIni::setSessionCacheExpire($intSecond, $strOperation);
    }

    /**
     * Retorna o tempo de vida para paginas de sessao, em minutos.
     *
     * @example \InepZend\Util\Library::getSessionCacheExpire()
     *
     * @return mix
     * @deprecated
     */
    public static function getSessionCacheExpire()
    {
        return PhpIni::getSessionCacheExpire();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica o metodo de controle do cache
     * para usar em paginas de sessao.
     * Pode ter um dos valores: nocache, private, private_no_expire ou public.
     *
     * @example \InepZend\Util\Library::setSessionCacheLimiter('nocache') <br /> \InepZend\Util\Library::setSessionCacheLimiter('private')
     *
     * @param string $strLimiter
     * @return mix
     * @deprecated
     */
    public static function setSessionCacheLimiter($strLimiter = 'nocache')
    {
        return PhpIni::setSessionCacheLimiter($strLimiter);
    }

    /**
     * Retorna o metodo de controle do cache para usar em paginas de sessao.
     *
     * @example \InepZend\Util\Library::getSessionCacheLimiter()
     *
     * @return mix
     * @deprecated
     */
    public static function getSessionCacheLimiter()
    {
        return PhpIni::getSessionCacheLimiter();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica o algoritimo de hash usado
     * para gerar os IDs de sessao.
     * Utiliza a chave dos algoritmos listados em hash_algos(), como '0' para MD5
     * (128 bits) e '1' para SHA-1 (160 bits).
     *
     * @example \InepZend\Util\Library::setSessionHashFunction(0) <br /> \InepZend\Util\Library::setSessionHashFunction(1)
     *
     * @param integer $intKeyHashAlgos
     * @return mix
     * @deprecated
     */
    public static function setSessionHashFunction($intKeyHashAlgos = 0)
    {
        return PhpIni::setSessionHashFunction($intKeyHashAlgos);
    }

    /**
     * Retorna a especificacao do algoritimo de hash usado para gerar os IDs de
     * sessao.
     *
     * @example \InepZend\Util\Library::getSessionHashFunction()
     *
     * @return mix
     * @deprecated
     */
    public static function getSessionHashFunction()
    {
        return PhpIni::getSessionHashFunction();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica o nome da sessao que eh usada
     * como um nome de cookie.
     * Deve conter apenas caracteres alfanumericos.
     *
     * @example \InepZend\Util\Library::setSessionName('PHPSESSID') <br /> \InepZend\Util\Library::setSessionName('PHPSESSIONID')
     *
     * @param string $strName
     * @return mix
     * @deprecated
     */
    public static function setSessionName($strName = 'PHPSESSID')
    {
        return PhpIni::setSessionName($strName);
    }

    /**
     * Retorna o nome da sessao que eh usada como um nome de cookie.
     *
     * @example \InepZend\Util\Library::getSessionName()
     *
     * @return mix
     * @deprecated
     */
    public static function getSessionName()
    {
        return PhpIni::getSessionName();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nome do manipulador que sera
     * utilizado para armazenar e recuperar dados associados a sessao.
     *
     * @example \InepZend\Util\Library::setSessionSaveHandler('files')
     *
     * @param string $strHandler
     * @return mix
     * @deprecated
     */
    public static function setSessionSaveHandler($strHandler = 'files')
    {
        return PhpIni::setSessionSaveHandler($strHandler);
    }

    /**
     * Retorna o nome do manipulador que sera utilizado para armazenar e recuperar
     * dados associados a sessao.
     *
     * @example \InepZend\Util\Library::getSessionSaveHandler()
     *
     * @return mix
     * @deprecated
     */
    public static function getSessionSaveHandler()
    {
        return PhpIni::getSessionSaveHandler();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o argumento que eh passado para
     * o manipulador de gravacao.
     * Se escolher o manipulador files, este eh o caminho onde os arquivos serao
     * criados.
     *
     * @example \InepZend\Util\Library::setSessionSavePath('/tmp')
     *
     * @param string $strPath
     * @return mix
     * @deprecated
     */
    public static function setSessionSavePath($strPath = '')
    {
        return PhpIni::setSessionSavePath($strPath);
    }

    /**
     * Retorna o argumento que eh passado para o manipulador de gravacao.
     * Se escolher o manipulador files, este eh o caminho onde os arquivos serao
     * criados.
     *
     * @example \InepZend\Util\Library::getSessionSavePath()
     *
     * @return mix
     * @deprecated
     */
    public static function getSessionSavePath()
    {
        return PhpIni::getSessionSavePath();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nome do manipulador que eh
     * usado para serializar/desserializar dados.
     * Disponibilizado o formato interno do PHP (nome php ou php_binary) e WDDX
     * (nome wddx).
     *
     * @example \InepZend\Util\Library::setSessionSerializeHandler('php') <br /> \InepZend\Util\Library::setSessionSerializeHandler('wddx')
     *
     * @param string $strHandler
     * @return mix
     * @deprecated
     */
    public static function setSessionSerializeHandler($strHandler = 'php')
    {
        return PhpIni::setSessionSerializeHandler($strHandler);
    }

    /**
     * Retorna o nome do manipulador que eh usado para serializar/desserializar
     * dados.
     *
     * @example \InepZend\Util\Library::getSessionSerializeHandler()
     *
     * @return mix
     * @deprecated
     */
    public static function getSessionSerializeHandler()
    {
        return PhpIni::getSessionSerializeHandler();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica o uso do modo estrito do
     * ID da sessao.
     * Se este modo estiver ativado, nao se aceita nao inicializar o ID da sessao.
     * Se o ID da sessao nao inicializado for enviado a partir do navegador, o novo
     * ID de sessao eh enviado para o navegador.
     *
     * @example \InepZend\Util\Library::setSessionUseStrictMode(false) <br /> \InepZend\Util\Library::setSessionUseStrictMode(true)
     *
     * @param boolean $booUse
     * @return mix
     * @deprecated
     */
    public static function setSessionUseStrictMode($booUse = false)
    {
        return PhpIni::setSessionUseStrictMode($booUse);
    }

    /**
     * Retorna o uso do modo estrito do ID da sessao.
     *
     * @example \InepZend\Util\Library::getSessionUseStrictMode()
     *
     * @return mix
     * @deprecated
     */
    public static function getSessionUseStrictMode()
    {
        return PhpIni::getSessionUseStrictMode();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica se usara cookies para guardar
     * o ID no lado do cliente.
     *
     * @example \InepZend\Util\Library::setSessionUseCookies(true) <br /> \InepZend\Util\Library::setSessionUseCookies(false)
     *
     * @param boolean $booUse
     * @return mix
     * @deprecated
     */
    public static function setSessionUseCookies($booUse = true)
    {
        return PhpIni::setSessionUseCookies($booUse);
    }

    /**
     * Retorna a identificacao se usara cookies para guardar o ID no lado do cliente.
     *
     * @example \InepZend\Util\Library::getSessionUseCookies()
     *
     * @return mix
     * @deprecated
     */
    public static function getSessionUseCookies()
    {
        return PhpIni::getSessionUseCookies();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica se usara somente cookies
     * para guardar o ID no lado do cliente.
     * Habilitando esta configuracao previne ataques envolvendo passagem de ids
     * de sessao nas URLs.
     *
     * @example \InepZend\Util\Library::setSessionUseOnlyCookies(true) <br /> \InepZend\Util\Library::setSessionUseOnlyCookies(false)
     *
     * @param boolean $booUse
     * @return mix
     * @deprecated
     */
    public static function setSessionUseOnlyCookies($booUse = true)
    {
        return PhpIni::setSessionUseOnlyCookies($booUse);
    }

    /**
     * Retorna a identificacao se usara somente cookies para guardar o ID no lado
     * do cliente.
     *
     * @example \InepZend\Util\Library::getSessionUseOnlyCookies()
     *
     * @return mix
     * @deprecated
     */
    public static function getSessionUseOnlyCookies()
    {
        return PhpIni::getSessionUseOnlyCookies();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define se o suporte a sid transparente
     * esta habilitado ou nao.
     *
     * @example \InepZend\Util\Library::setSessionUseTransSid(false) <br /> \InepZend\Util\Library::setSessionUseTransSid(true)
     *
     * @param boolean $booUse
     * @return mix
     * @deprecated
     */
    public static function setSessionUseTransSid($booUse = false)
    {
        return PhpIni::setSessionUseTransSid($booUse);
    }

    /**
     * Retorna a definecao se o suporte a sid transparente esta habilitado ou nao.
     *
     * @example \InepZend\Util\Library::getSessionUseTransSid()
     *
     * @return mix
     * @deprecated
     */
    public static function getSessionUseTransSid()
    {
        return PhpIni::getSessionUseTransSid();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nome do host ou endereco IP
     * do servidor SMTP a ser usado em emails enviados com a funcao mail().
     * Usado apenas sob o Windows.
     *
     * @example \InepZend\Util\Library::setSmtp('localhost') <br /> \InepZend\Util\Library::setSmtp('172.29.0.42')
     *
     * @param string $strSmtp
     * @return mix
     * @deprecated
     */
    public static function setSmtp($strSmtp = 'localhost')
    {
        return PhpIni::setSmtp($strSmtp);
    }

    /**
     * Retorna o nome do host ou endereco IP do servidor SMTP a ser usado em emails
     * enviados com a funcao mail().
     * Usado apenas sob o Windows.
     *
     * @example \InepZend\Util\Library::getSmtp()
     *
     * @return mix
     * @deprecated
     */
    public static function getSmtp()
    {
        return PhpIni::getSmtp();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a porta de conexao com o servidor
     * especificado na diretiva SMTP a ser usado em emails enviados com a funcao
     * mail().
     * Usado apenas sob o Windows.
     *
     * @example \InepZend\Util\Library::setSmtpPort(25)
     *
     * @param integer $intPort
     * @return mix
     * @deprecated
     */
    public static function setSmtpPort($intPort = 25)
    {
        return PhpIni::setSmtpPort($intPort);
    }

    /**
     * Retorna a porta de conexao com o servidor especificado na diretiva SMTP a
     * ser usado em emails enviados com a funcao mail().
     *
     * @example \InepZend\Util\Library::getSmtpPort()
     *
     * @return mix
     * @deprecated
     */
    public static function getSmtpPort()
    {
        return PhpIni::getSmtpPort();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que determina o tipo de cache, se soap.wsdl_cache_enabled
     * estiver ligado.
     * Ele pode ser qualquer um de: WSDL_CACHE_NONE (0), WSDL_CACHE_DISK (1),
     * WSDL_CACHE_MEMORY (2) ou WSDL_CACHE_BOTH (3).
     *
     * @example \InepZend\Util\Library::setSoapWsdlCache(0) <br /> \InepZend\Util\Library::setSoapWsdlCache(1) <br /> \InepZend\Util\Library::setSoapWsdlCache(2)
     *
     * @param integer $intType
     * @return mix
     * @deprecated
     */
    public static function setSoapWsdlCache($intType = 1)
    {
        return PhpIni::setSoapWsdlCache($intType);
    }

    /**
     * Retorna o tipo de cache, se soap.wsdl_cache_enabled estiver ligado.
     *
     * @example \InepZend\Util\Library::getSoapWsdlCache()
     *
     * @return mix
     * @deprecated
     */
    public static function getSoapWsdlCache()
    {
        return PhpIni::getSoapWsdlCache();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nome do diretorio onde a extensao
     * SOAP ira colocar os arquivos de cache.
     *
     * @example \InepZend\Util\Library::setSoapWsdlCacheDir('/tmp')
     *
     * @param string $strDir
     * @return mix
     * @deprecated
     */
    public static function setSoapWsdlCacheDir($strDir = '/tmp')
    {
        return PhpIni::setSoapWsdlCacheDir($strDir);
    }

    /**
     * Retorna o nome do diretorio onde a extensao SOAP ira colocar os arquivos
     * de cache.
     *
     * @example \InepZend\Util\Library::getSoapWsdlCacheDir()
     *
     * @return mix
     * @deprecated
     */
    public static function getSoapWsdlCacheDir()
    {
        return PhpIni::getSoapWsdlCacheDir();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que ativa ou desativa o recurso de cache de WSDL.
     *
     * @example \InepZend\Util\Library::setSoapWsdlCacheEnabled(true) <br /> \InepZend\Util\Library::setSoapWsdlCacheEnabled(false)
     *
     * @param boolean $booEnable
     * @return mix
     * @deprecated
     */
    public static function setSoapWsdlCacheEnabled($booEnable = true)
    {
        return PhpIni::setSoapWsdlCacheEnabled($booEnable);
    }

    /**
     * Metodo com permissao PHP_INI_ALL que ativa ou desativa o recurso de cache de WSDL.
     *
     * @example \InepZend\Util\Library::setSoapWsdlCacheEnabled(true) <br /> \InepZend\Util\Library::setSoapWsdlCacheEnabled(false)
     *
     * @param boolean $booEnable
     * @return mix
     * @deprecated
     */
    public static function getSoapWsdlCacheEnabled()
    {
        return PhpIni::getSoapWsdlCacheEnabled();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o numero maximo de arquivos WSDL
     * em cache.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setSoapWsdlCacheLimit(5, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setSoapWsdlCacheLimit(1, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intMaxFile
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setSoapWsdlCacheLimit($intMaxFile = 5, $strOperation = null)
    {
        return PhpIni::setSoapWsdlCacheLimit($intMaxFile, $strOperation);
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o numero maximo de arquivos WSDL
     * em cache.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setSoapWsdlCacheLimit(5, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setSoapWsdlCacheLimit(1, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intMaxFile
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function getSoapWsdlCacheLimit()
    {
        return PhpIni::getSoapWsdlCacheLimit();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o numero de segundos (tempo de
     * vida) que o cache de arquivos sera usado em vez dos originais.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setSoapWsdlCacheTtl(86400, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setSoapWsdlCacheTtl(600, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intSecond
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setSoapWsdlCacheTtl($intSecond = 86400, $strOperation = null)
    {
        return PhpIni::setSoapWsdlCacheTtl($intSecond, $strOperation);
    }

    /**
     * Retorna o numero de segundos (tempo de vida) que o cache de arquivos sera
     * usado em vez dos originais.
     *
     * @example \InepZend\Util\Library::getSoapWsdlCacheTtl()
     *
     * @return mix
     * @deprecated
     */
    public static function getSoapWsdlCacheTtl()
    {
        return PhpIni::getSoapWsdlCacheTtl();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define se a ultima mensagem de erro
     * sempre estara presente na variavel $php_errormsg.
     *
     * @example \InepZend\Util\Library::setTrackErrors(false) <br /> \InepZend\Util\Library::setTrackErrors(true)
     *
     * @param boolean $booEnable
     * @return mix
     * @deprecated
     */
    public static function setTrackErrors($booEnable = false)
    {
        return PhpIni::setTrackErrors($booEnable);
    }

    /**
     * Retorna a definicao se a ultima mensagem de erro sempre estara presente na
     * variavel $php_errormsg.
     *
     * @example \InepZend\Util\Library::getTrackErrors()
     *
     * @return mix
     * @deprecated
     */
    public static function getTrackErrors()
    {
        return PhpIni::getTrackErrors();
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define o tamanho maximo de um arquivo
     * enviado.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     *
     * @example \InepZend\Util\Library::setUploadMaxFilesize(2, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setUploadMaxFilesize(1, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intMegabyte
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setUploadMaxFilesize($intMegabyte = 2, $strOperation = null)
    {
        return PhpIni::setUploadMaxFilesize($intMegabyte, $strOperation);
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define o tamanho maximo de um arquivo
     * enviado.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     *
     * @example \InepZend\Util\Library::setUploadMaxFilesize(2, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setUploadMaxFilesize(1, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intMegabyte
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function getUploadMaxFilesize()
    {
        return PhpIni::getUploadMaxFilesize();
    }

    /**
     * Metodo com permissao PHP_INI_SYSTEM que define o numero maximo de arquivos que
     * pode ser enviado simultaneamente.
     * Campos de upload deixado em branco nao contam para este limite.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setMaxFileUploads(20, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setMaxFileUploads(2, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intMaxFile
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setMaxFileUploads($intMaxFile = 20, $strOperation = null)
    {
        return PhpIni::setMaxFileUploads($intMaxFile, $strOperation);
    }

    /**
     * Metodo com permissao PHP_INI_SYSTEM que define o numero maximo de arquivos que
     * pode ser enviado simultaneamente.
     * Campos de upload deixado em branco nao contam para este limite.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setMaxFileUploads(20, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setMaxFileUploads(2, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intMaxFile
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function getMaxFileUploads()
    {
        return PhpIni::getMaxFileUploads();
    }

    /**
     * Metodo com permissao PHP_INI_SYSTEM que define o diretorio temporario usado
     * para armazenar arquivos durante o upload.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     *
     * @example \InepZend\Util\Library::setUploadTmpDir('/tmp')
     *
     * @param string $strDir
     * @return mix
     * @deprecated
     */
    public static function setUploadTmpDir($strDir = null)
    {
        return PhpIni::setUploadTmpDir($strDir);
    }

    /**
     * Metodo com permissao PHP_INI_SYSTEM que define o diretorio temporario usado
     * para armazenar arquivos durante o upload.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     *
     * @example \InepZend\Util\Library::setUploadTmpDir('/tmp')
     *
     * @param string $strDir
     * @return mix
     * @deprecated
     */
    public static function getUploadTmpDir()
    {
        return PhpIni::getUploadTmpDir();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o user agent que o PHP ira enviar.
     *
     * @example \InepZend\Util\Library::setUserAgent('Mozilla/5.0 Gecko/20071025 Firefox/2.0.0.9')
     *
     * @param string $strAgent
     * @return mix
     * @deprecated
     */
    public static function setUserAgent($strAgent = null)
    {
        return PhpIni::setUserAgent($strAgent);
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o user agent que o PHP ira enviar.
     *
     * @example \InepZend\Util\Library::setUserAgent('Mozilla/5.0 Gecko/20071025 Firefox/2.0.0.9')
     *
     * @param string $strAgent
     * @return mix
     * @deprecated
     */
    public static function getUserAgent()
    {
        return PhpIni::getUserAgent();
    }

    /**
     * Metodo com permissao PHP_INI_SYSTEM que define o nome base do diretorio usado
     * na home do usuario para arquivos PHP.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     *
     * @example \InepZend\Util\Library::setUserDir('/public')
     *
     * @param string $strDir
     * @return mix
     * @deprecated
     */
    public static function setUserDir($strDir = null)
    {
        return PhpIni::setUserDir($strDir);
    }

    /**
     * Metodo com permissao PHP_INI_SYSTEM que define o nome base do diretorio usado
     * na home do usuario para arquivos PHP.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     *
     * @example \InepZend\Util\Library::setUserDir('/public')
     *
     * @param string $strDir
     * @return mix
     * @deprecated
     */
    public static function getUserDir()
    {
        return PhpIni::getUserDir();
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define a ordem de interpretacao das
     * variaveis EGPCS (Environment, Get, Post, Cookie, e Server).
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     *
     * @example \InepZend\Util\Library::setVariablesOrder('EGPCS') <br /> \InepZend\Util\Library::setVariablesOrder('GEPSC')
     *
     * @param string $strOrder
     * @return mix
     * @deprecated
     */
    public static function setVariablesOrder($strOrder = 'EGPCS')
    {
        return PhpIni::setVariablesOrder($strOrder);
    }

    /**
     * Retorna a ordem de interpretacao das variaveis EGPCS (Environment, Get, Post,
     * Cookie, e Server).
     *
     * @example \InepZend\Util\Library::getVariablesOrder()
     *
     * @return mix
     * @deprecated
     */
    public static function getVariablesOrder()
    {
        return PhpIni::getVariablesOrder();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nivel maximo de funcoes aninhadas
     * que sao permitidos antes que o script seja abortado.
     * Controla o mecanismo de protecao para a recursao infinita.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     *
     * @example \InepZend\Util\Library::setXdebugMaxNestingLevel(100, \InepZend\Util\Library::OPERATION_EXACT) <br /> \InepZend\Util\Library::setXdebugMaxNestingLevel(50, \InepZend\Util\Library::OPERATION_PLUS)
     *
     * @param integer $intMaxNestingLevel
     * @param string $strOperation ex.: \InepZend\Util\Library::OPERATION_EXACT ou \InepZend\Util\Library::OPERATION_PLUS
     * @return mix
     * @deprecated
     */
    public static function setXdebugMaxNestingLevel($intMaxNestingLevel = 100, $strOperation = null)
    {
        return PhpIni::setXdebugMaxNestingLevel($intMaxNestingLevel, $strOperation);
    }

    /**
     * Retorna o nivel maximo de funcoes aninhadas que sao permitidos antes que
     * o script seja abortado.
     *
     * @example \InepZend\Util\Library::getXdebugMaxNestingLevel()
     *
     * @return mix
     * @deprecated
     */
    public static function getXdebugMaxNestingLevel()
    {
        return PhpIni::getXdebugMaxNestingLevel();
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define se deve ou nao permitir o
     * xdebug de escrever os arquivos no diretorio de saida.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     *
     * @example \InepZend\Util\Library::setXdebugProfilerEnable(false) <br /> \InepZend\Util\Library::setXdebugProfilerEnable(true)
     *
     * @param boolean $booEnable
     * @return mix
     * @deprecated
     */
    public static function setXdebugProfilerEnable($booEnable = false)
    {
        return PhpIni::setXdebugProfilerEnable($booEnable);
    }

    /**
     * Retorna a definicao se deve ou nao permitir o xdebug de escrever os arquivos
     * no diretorio de saida.
     *
     * @example \InepZend\Util\Library::getXdebugProfilerEnable()
     *
     * @return mix
     * @deprecated
     */
    public static function getXdebugProfilerEnable()
    {
        return PhpIni::getXdebugProfilerEnable();
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define se deve ou nao permitir o
     * xdebug de acionar a geracao de arquivos usando a XDEBUG_PROFILE como parametro
     * GET/POST, ou definir um cookie com o nome XDEBUG_PROFILE.
     * Deve-se inativar o xdebug.profiler_enable.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     *
     * @example \InepZend\Util\Library::setXdebugProfilerEnableTrigger(false) <br /> \InepZend\Util\Library::setXdebugProfilerEnableTrigger(true)
     *
     * @param boolean $booEnable
     * @return mix
     * @deprecated
     */
    public static function setXdebugProfilerEnableTrigger($booEnable = false)
    {
        return PhpIni::setXdebugProfilerEnableTrigger($booEnable);
    }

    /**
     * Retorna a definicao se deve ou nao permitir o xdebug de acionar a geracao
     * de arquivos usando a XDEBUG_PROFILE como parametro GET/POST, ou definir um
     * cookie com o nome XDEBUG_PROFILE.
     *
     * @example \InepZend\Util\Library::getXdebugProfilerEnableTrigger()
     *
     * @return mix
     * @deprecated
     */
    public static function getXdebugProfilerEnableTrigger()
    {
        return PhpIni::getXdebugProfilerEnableTrigger();
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define o diretorio de saida onde
     * os arquivos serao escritos.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     *
     * @example \InepZend\Util\Library::setXdebugProfilerOutputDir('/tmp')
     *
     * @param string $strDir
     * @return mix
     * @deprecated
     */
    public static function setXdebugProfilerOutputDir($strDir = '/tmp')
    {
        return PhpIni::setXdebugProfilerOutputDir($strDir);
    }

    /**
     * Retorna o diretorio de saida onde os arquivos serao escritos.
     *
     * @example \InepZend\Util\Library::getXdebugProfilerOutputDir()
     *
     * @return mix
     * @deprecated
     */
    public static function getXdebugProfilerOutputDir()
    {
        return PhpIni::getXdebugProfilerOutputDir();
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define o formato do nome do arquivo
     * gerado pelo xdebug.
     * Trabalha com especificadores de formato muito semelhante ao sprintf() e strftime().
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     *
     * @example \InepZend\Util\Library::setXdebugProfilerOutputName('cachegrind.out.%p')
     *
     * @param string $strName
     * @return mix
     * @deprecated
     */
    public static function setXdebugProfilerOutputName($strName = 'cachegrind.out.%p')
    {
        return PhpIni::setXdebugProfilerOutputName($strName);
    }

    /**
     * Retorna o formato do nome do arquivo gerado pelo xdebug.
     *
     * @example \InepZend\Util\Library::getXdebugProfilerOutputName()
     *
     * @return mix
     * @deprecated
     */
    public static function getXdebugProfilerOutputName()
    {
        return PhpIni::getXdebugProfilerOutputName();
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define se deve ou nao tentar entrar
     * em contato com um cliente de depuracao que esta escutando no host e porta
     * definidos em xdebug.remote_host e xdebug.remote_port.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     *
     * @example \InepZend\Util\Library::setXdebugRemoteEnable(false) <br /> \InepZend\Util\Library::setXdebugRemoteEnable(true)
     *
     * @param boolean $booEnable
     * @return mix
     * @deprecated
     */
    public static function setXdebugRemoteEnable($booEnable = false)
    {
        return PhpIni::setXdebugRemoteEnable($booEnable);
    }

    /**
     * Retorna a definicao se deve ou nao tentar entrar em contato com um cliente
     * de depuracao que esta escutando no host e porta definidos em xdebug.remote_host
     * e xdebug.remote_port.
     *
     * @example \InepZend\Util\Library::getXdebugRemoteEnable()
     *
     * @return mix
     * @deprecated
     */
    public static function getXdebugRemoteEnable()
    {
        return PhpIni::getXdebugRemoteEnable();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nome do manipulador que eh
     * usado pelo xdebug para realizar a depuracao.
     * Seguem algumas opcoes: 'php3' (estilo PHP 3), 'gdb' (usa o GDB como interface
     * de depuracao) ou 'dbgp' (DBGp eh o unico protocolo suportado).
     *
     * @example \InepZend\Util\Library::setXdebugRemoteHandler('dbgp')
     *
     * @param string $strHandler
     * @return mix
     * @deprecated
     */
    public static function setXdebugRemoteHandler($strHandler = 'dbgp')
    {
        return PhpIni::setXdebugRemoteHandler($strHandler);
    }

    /**
     * Retorna o nome do manipulador que eh usado pelo xdebug para realizar a depuracao.
     *
     * @example \InepZend\Util\Library::getXdebugRemoteHandler()
     *
     * @return mix
     * @deprecated
     */
    public static function getXdebugRemoteHandler()
    {
        return PhpIni::getXdebugRemoteHandler();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nome do host ou endereco IP
     * onde o cliente de depuracao estiver em execucao.
     * Esta definicao eh ignorada se xdebug.remote_connect_back estiver ativo.
     *
     * @example \InepZend\Util\Library::setXdebugRemoteHost('localhost') <br /> \InepZend\Util\Library::setXdebugRemoteHost('127.0.0.1')
     *
     * @param string $strHost
     * @return mix
     * @deprecated
     */
    public static function setXdebugRemoteHost($strHost = 'localhost')
    {
        return PhpIni::setXdebugRemoteHost($strHost);
    }

    /**
     * Retorna o nome do host ou endereco IP onde o cliente de depuracao estiver
     * em execucao.
     *
     * @example \InepZend\Util\Library::getXdebugRemoteHost()
     *
     * @return mix
     * @deprecated
     */
    public static function getXdebugRemoteHost()
    {
        return PhpIni::getXdebugRemoteHost();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a porta de conexao com o cliente
     * de depuracao.
     *
     * @example \InepZend\Util\Library::setXdebugRemotePort(9000)
     *
     * @param integer $intPort
     * @return mix
     * @deprecated
     */
    public static function setXdebugRemotePort($intPort = 9000)
    {
        return PhpIni::setXdebugRemotePort($intPort);
    }

    /**
     * Retorna a porta de conexao com o cliente de depuracao.
     *
     * @example \InepZend\Util\Library::getXdebugRemotePort()
     *
     * @return mix
     * @deprecated
     */
    public static function getXdebugRemotePort()
    {
        return PhpIni::getXdebugRemotePort();
    }

    /**
     * Define o valor de uma opcao de configuracao/diretiva do PHP caso seja possivel.
     *
     * @example \InepZend\Util\Library::iniSet('xdebug.remote_port', 9000)
     *
     * @param string $strConfigVarName
     * @param mix $mixConfigValue
     * @param string $strOperation
     * @return mix
     * @deprecated
     */
    public static function iniSet($strConfigVarName = null, $mixConfigValue = null, $strOperation = 'EXACT')
    {
        return PhpIni::iniSet($strConfigVarName, $mixConfigValue, $strOperation);
    }

    /**
     * Retorna o valor de uma opcao de configuracao/diretiva do PHP.
     *
     * @example \InepZend\Util\Library::iniGet('xdebug.remote_port')
     *
     * @param string $strConfigVarName
     * @param string $strTypeParse
     * @return mix
     * @deprecated
     */
    public static function iniGet($strConfigVarName = null)
    {
        return PhpIni::iniGet($strConfigVarName);
    }

    /**
     * Metodo responsavel em retornar a reflexao de uma determinada classe a 
     * partir do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Reflection::getReflectionClass($mixEntity);
     *
     * @param mix $mixEntity
     * @param boolean $booSingleton
     * @return mix
     * @deprecated
     */
    public static function getReflectionClass($mixEntity, $booSingleton = true)
    {
        return Reflection::getReflectionClass($mixEntity, $booSingleton);
    }

    /**
     * Metodo responsavel em listar todos os atributos de uma clase usando 
     * reflexao a partir do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Library::listAttributesFromClass($mixEntity);
     *
     * @param mix $mixEntity (pode ser o nome da classe ou um objeto da mesma)
     * @return mix
     * @deprecated
     */
    public static function listAttributesFromClass($mixEntity)
    {
        return Reflection::listAttributesFromClass($mixEntity);
    }

    /**
     * Metodo responsavel em listar todos as constantes de uma classe usando 
     * reflexao caso a mesma a(s) tenha(m) a partir do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Library::listConstantsFromClass($mixEntity, $strConstant);
     *
     * @param mix $mixEntity
     * @param string $strConstant
     * @return mix
     * @deprecated
     */
    public static function listConstantsFromClass($mixEntity, $strConstant = null)
    {
        return Reflection::listConstantsFromClass($mixEntity, $strConstant);
    }

    /**
     * Metodo responsavel em listar todo(s) o(s) objeto(s) de metodo(s) de uma 
     * classe usando reflexao a partir do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Library::listMethods($mixEntity, $strMethod);
     *
     * @param mix $mixEntity
     * @param string $strMethod
     * @return mix
     * @deprecated
     */
    public static function listMethods($mixEntity, $strMethod = null)
    {
        return Reflection::listMethods($mixEntity, $strMethod);
    }

    /**
     * Metodo responsavel em listar todo(s) o(s) metodo(s) de uma classe usando 
     * reflexao a partir do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Library::listMethodsFromClass($mixEntity, $booRemoveMethodsFromParent, $strMethod);
     *
     * @param mix $mixEntity
     * @param string $booRemoveMethodsFromParent
     * @param string $strMethod
     * @param string $booRemoveMethodsFromTrait
     * @param string $booRemoveMethodsWithoutReturn
     * @return mix
     * @deprecated
     */
    public static function listMethodsFromClass($mixEntity, $booRemoveMethodsFromParent = false, $strMethod = null, $booRemoveMethodsFromTrait = false, $booRemoveMethodsWithoutReturn = false)
    {
        return Reflection::listMethodsFromClass($mixEntity, $booRemoveMethodsFromParent, $strMethod, $booRemoveMethodsFromTrait, $booRemoveMethodsWithoutReturn);
    }

    /**
     * Metodo responsavel em retornar o conteudo do metodo (assinatura e corpo).
     *
     * @example \InepZend\Util\Library::getMethodContent($strClass, $strMethod);
     *
     * @param string $strClass
     * @param string $strMethod
     * @return mix
     * @deprecated
     */
    public static function getMethodContent($strClass = null, $strMethod = null)
    {
        return Reflection::getMethodContent($strClass, $strMethod);
    }

    /**
     * Metodo responsavel em listar todo(s) o(s) annotation(s) de um metodo 
     * usando reflexao a partir do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Library::listMethodsFromClass($mixEntity, $strMethod);
     *
     * @param mix $mixEntity
     * @param string $strMethod
     * @return mix
     * @deprecated
     */
    public static function listAnnotationsFromMethod($mixEntity, $strMethod = null)
    {
        return Reflection::listAnnotationsFromMethod($mixEntity, $strMethod);
    }

    /**
     * Metodo responsavel em listar todo(s) o(s) annotation(s) de um atributo 
     * usando reflexao a partir do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Library::listAnnotationsFromAttribute($mixEntity, $strAttribute);
     *
     * @param mix $mixEntity
     * @param string $strAttribute
     * @return mi
     * @deprecated
     */
    public static function listAnnotationsFromAttribute($mixEntity, $strAttribute = null)
    {
        return Reflection::listAnnotationsFromAttribute($mixEntity, $strAttribute);
    }

    /**
     * Metodo responsavel em recuperar o valor do atributo de uma annotation.
     *
     * @example \InepZend\Util\Library::getAttributeValueFromAnnotationValue($strAnnotationValue, $srtAttribute)
     *
     * @param string $strAnnotationValue
     * @param string $srtAttribute
     * @return mix
     * @deprecated
     */
    public static function getAttributeValueFromAnnotationValue($strAnnotationValue = null, $srtAttribute = null)
    {
        return Reflection::getAttributeValueFromAnnotationValue($strAnnotationValue, $strAttribute);
    }

    /**
     * Metodo responsavel em retornar o real nome da classe (case sensitive) 
     * apartir do path da mesma, utilizando o require_once do arquivo da classe.
     *
     * @example \InepZend\Util\Library::getRealClassNameWithPath($strClassName, $strClassPath);
     *
     * @param string $strClassName
     * @param string $strClassPath
     * @return mix
     * @deprecated
     */
    public static function getRealClassNameWithPath($strClassName = null, $strClassPath = null)
    {
        return Reflection::getRealClassNameWithPath($strClassName, $strClassPath);
    }

    /**
     * Metodo responsavel em retorna o namespace de um objeto ou de um nome da 
     * classe (get_class).
     *
     * @example \InepZend\Util\Library::getNamespace($mixEntity, $booArray);
     *
     * @param mix $mixEntity
     * @param boolean $booArray
     * @return mix
     * @deprecated
     */
    public static function getNamespace($mixEntity, $booArray = null)
    {
        return Reflection::getNamespace($mixEntity, $booArray);
    }

    /**
     * Metodo responsavel em recuperar o path de uma classe (get_class) a partir 
     * do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Library::getFileNameFromClass($mixEntity)
     *
     * @param mix $mixEntity
     * @return mix
     * @deprecated
     */
    public static function getFileNameFromClass($mixEntity)
    {
        return Reflection::getFileNameFromClass($mixEntity);
    }

    /**
     * Metodo responsavel em recuperar o nome de uma classe a partir do path.
     *
     * @example \InepZend\Util\Library::getClassFromFileName('/vendor/InepZend/library/InepZend/Util/Reflection.php')
     *
     * @param string $strFileName
     * @return mix
     * @deprecated
     */
    public static function getClassFromFileName($strFileName)
    {
        return Reflection::getClassFromFileName($strFileName);
    }

    /**
     * Metodo responsavel em realizar reflexao e execucao no metodo invocado.
     *
     * @example \InepZend\Util\Library::invokeNotAccessibleMethod((new \stdClass()), 'method')
     *
     * @param mix $mixClass
     * @param string $strMethod
     * @return mix
     * @deprecated
     */
    public static function invokeNotAccessibleMethod($mixClass = null, $strMethod = null)
    {
        return Reflection::invokeNotAccessibleMethod($mixClass, $strMethod);
    }

    /**
     * Metodo responsavel em realizar reflexao e atribuicao de valores em atributos
     * privados.
     * 
     * @example \InepZend\Util\Library::setValueNotAccessibleProperty($mixClass, $strProperty, $mixValue);
     * 
     * @param mix $mixClass
     * @param string $strProperty
     * @param mix $mixValue
     * @return mix
     * @deprecated
     */
    public static function setValueNotAccessibleProperty($mixClass = null, $strProperty = null, $mixValue = null)
    {
        return Reflection::setValueNotAccessibleProperty($mixClass, $strProperty, $mixValue);
    }

    /**
     * Metodo responsavel em capturar o id da instancia.
     * 
     * @example \InepZend\Util\Reflection::getInstanceId($object);
     * 
     * @param object $object
     * @param boolean $booUseSpl
     * @return mix
     * @deprecated
     */
    public static function getInstanceId($object = null, $booUseSpl = true)
    {
        return Reflection::getInstanceId($object, $booUseSpl);
    }

    /**
     * Funcao que executa o regex para mudar as tag de arquivo rtf.
     *
     * @example \InepZend\Util\Library::replaceRegexTagRtf('<%NOMEFRAMEWORK%>', 'InepZend', '<%NOMEFRAMEWORK%>, utiliza o framework Zend 2.');
     *
     * @param string $strTag
     * @param string $strValor
     * @param string $strTexto
     * @return string
     * @deprecated
     */
    public static function replaceRegexTagRtf($strTag, $strValor, $strTexto)
    {
        return Rtf::replaceRegexTagRtf($strTag, $strValor, $strTexto);
    }

    /**
     * Funcao que reconhece tags do conteudo de um arquivo RTF e realiza seus 
     * tratamentos de limpeza.
     *
     * @example \InepZend\Util\Library::clearTagRtf("\t\n<%NOMESISTEMA%>");
     *
     * @param string $strText
     * @param string $strPrefix
     * @param string $strSufix
     * @return string
     * @deprecated
     */
    public static function clearTagRtf($strText, $strPrefix = '<%', $strSufix = '%>')
    {
        return Rtf::clearTagRtf($strText, $strPrefix, $strSufix);
    }

    /**
     * Funcao que limpa tags do conteudo de um arquivo RTF
     *
     * @example \InepZend\Util\Library::removeTagRtf("<$NOMESISTEMA$>", '<$', '$>');
     *
     * @param string $strText
     * @param string $strPrefix
     * @param string $strSufix
     * @param integer $intDeep
     * @param string $strTextResult
     * @return string
     * @deprecated
     */
    public static function removeTagRtf($strText, $strPrefix = '<%', $strSufix = '%>', $intDeep = 0, $strTextResult = '')
    {
        return Rtf::removeTagRtf($strText, $strPrefix, $strSufix, $intDeep, $strTextResult);
    }

    /**
     * Metodo responsavel em retornar o nome do browser e a sua versao a partir 
     * da variavel $_SERVER['HTTP_USER_AGENT'] do servidor web.
     *
     * @example \InepZend\Util\Library::getBrowser()
     *
     * @return array
     * @deprecated
     */
    public static function getBrowser()
    {
        return Server::getBrowser();
    }

    /**
     * Retorna o IP do usuario.
     *
     * @example \InepZend\Util\Library::getIp()
     *
     * @param boolean $booReplace
     * @return string
     * @deprecated
     */
    public static function getIp($booReplace = false)
    {
        return Server::getIp($booReplace);
    }

    /**
     * Retorna o IP do servidor.
     *
     * @example \InepZend\Util\Library::getIpServer()
     *
     * @param boolean $booReplace
     * @return string
     * @deprecated
     */
    public static function getIpServer($booReplace = false)
    {
        return Server::getIpServer($booReplace);
    }

    /**
     * Metodo responsavel pelo retorno do protocolo do servidor.
     *
     * @example \InepZend\Util\Library::getServerProtocol()
     *
     * @return string
     * @deprecated
     */
    public static function getServerProtocol()
    {
        return Server::getServerProtocol();
    }

    /**
     * Metodo responsavel pelo retorno da porta do servidor
     *
     * @example \InepZend\Util\Library::getPort()
     *
     * @param boolean $booServerPort
     * @return type
     * @deprecated
     */
    public static function getPort($booServerPort = true)
    {
        return Server::getPort($booServerPort);
    }

    /**
     * Metodo responsavel pelo retorno do host da aplicacao.
     *
     * @example \InepZend\Util\Library::getHost()
     *
     * @param boolean $booContext
     * @param boolean $booServerPort
     * @param boolean $booRequestUri
     * @return string
     * @deprecated
     */
    public static function getHost($booContext = null, $booServerPort = false, $booRequestUri = false)
    {
        return Server::getHost($booContext, $booServerPort, $booRequestUri);
    }

    /**
     * @return string
     * @deprecated
     */
    public static function getBaseUrl()
    {
        return Server::getBaseUrl();
    }

    /**
     * Metodo responsavel pela verificacao se eh uma execucao realizada via PhpUnit.
     *
     * @example \InepZend\Util\Library::isPhpUnit()
     *
     * @return boolean
     * @deprecated
     */
    public static function isPhpUnit()
    {
        return Server::isPhpUnit();
    }

    /**
     * @return mixed|string
     * @deprecated
     */
    public static function getBasePathApplication()
    {
        return Server::getBasePathApplication();
    }

    /**
     * @return mixed
     * @deprecated
     */
    public static function getBasePathVendor()
    {
        return Server::getBasePathVendor();
    }

    /**
     * @param null $strPath
     * @return mixed
     * @deprecated
     */
    public static function getReplacedBasePathApplication($strPath = null)
    {
        return Server::getReplacedBasePathApplication($strPath);
    }

    /**
     * @param null $strIp
     * @return mixed
     * @deprecated
     */
    public static function clearIp($strIp = null)
    {
        return Server::clearIp($strIp);
    }

    /**
     * Retorna uma expressao no formato de nome proprio.
     *
     * @example \InepZend\Util\Library::beautifulProperName('INSTITUTO NACIONAL DE ESTUDOS E PESQUISAS EDUCACIONAIS ANÍSIO TEIXEIRA') <br /> \InepZend\Util\String::beautifulProperName('instituto nacional de estudos e pesquisas educacionais anísio teixeira')
     *
     * @param string $strName
     * @param boolean $booSort
     * @return string
     * @deprecated
     */
    public static function beautifulProperName($strName, $booSort = false)
    {
        return String::beautifulProperName($strName, $booSort);
    }

    /**
     * Metodo responsavel em gerar uma expressao com elementos totalmente randomicos.
     *
     * @example \InepZend\Util\String::generateRandomExpression(9)
     *
     * @param integer $intLength
     * @param boolean $booNumber
     * @return string
     * @deprecated
     */
    public static function generateRandomExpression($intLength, $booNumber = true)
    {
        return String::generateRandomExpression($intLength, $booNumber);
    }

    /**
     * Verifica se a string parametrizada possui o encode utf8.
     *
     * @example \InepZend\Util\Library::isUTF8()
     *
     * @param string $strValue
     * @return boolean
     * @deprecated
     */
    public static function isUTF8($strValue)
    {
        return String::isUTF8($strValue);
    }

    /**
     * Remove os acentos, inclusive para um consulta LIKE ou ILIKE utilizando query SQL.
     *
     * @example \InepZend\Util\Library::clearWord('Ministério da Educação - Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira') <br /> \InepZend\Util\String::clearWord('Ministério da Educação - Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira', true)
     *
     * @param string $strWord
     * @param boolean $booPercent
     * @return string
     * @deprecated
     */
    public static function clearWord($strWord, $booPercent = false)
    {
        return String::clearWord($strWord, $booPercent);
    }

    /**
     * Serializa um elemento e converte para base64.
     *
     * @example \InepZend\Util\Library::serialize64('INEP')
     *
     * @param mix $mixElement
     * @return string
     * @deprecated
     */
    public static function serialize64($mixElement)
    {
        return String::serialize64($mixElement);
    }

    /**
     * Deserializa um elemento e desconverte da base64.
     *
     * @example \InepZend\Util\Library::unserialize64('czo0OiJJTkVQIjs')
     *
     * @param string $strBase64Element
     * @return string
     * @deprecated
     */
    public static function unserialize64($strBase64Element)
    {
        return String::unserialize64($strBase64Element);
    }

    /**
     * Deserializa um elemento e desconverte da base64.
     *
     * @example \InepZend\Util\Library::unserialize64('czo0OiJJTkVQIjs')
     *
     * @param string $strBase64Element
     * @return string
     * @deprecated
     */
    public static function get_base64_decode($strBase64Element)
    {
        return String::getBase64Decode($strBase64Element);
    }

    /**
     * Insere uma string ao final de deteminados numeros de caracteres.
     *
     * @example \InepZend\Util\Library::truncate('Ministerio da Educacao')
     *
     * @param string $strValue
     * @param integer $intLengthMaxCarac
     * @param string $strEtc
     * @param boolean $booBreakWords
     * @param boolean $booMiddle
     * @param boolean $booConvertHtml
     * @param boolean $booTitleFullValue
     * @return string
     * @deprecated
     */
    public static function truncate($strValue, $intLengthMaxCarac = 80, $strEtc = '...', $booBreakWords = false, $booMiddle = false, $booConvertHtml = false, $booTitleFullValue = false)
    {
        return String::truncate($strValue, $intLengthMaxCarac, $strEtc, $booBreakWords, $booMiddle, $booConvertHtml, $booTitleFullValue);
    }

    /**
     * Altera a string de um nome proprio inserindo o primeiro caracter maiusculo 
     * nos nomes e nos sobrenomes.
     *
     * @example \InepZend\Util\Library::maskName('instituto nacional de estudos e pesquisas educacionais anisio teixeira')
     *
     * @param string $strName
     * @return string
     * @deprecated
     */
    public static function maskName($strName)
    {
        return String::maskName($strName);
    }

    /**
     * Verifica se algum valor eh null ou vazio.
     *
     * @example \InepZend\Util\Library::isNullEmpty('') <br /> \InepZend\Util\String::isNullEmpty(array())
     *
     * @param mix $mixValue
     * @return boolean
     * @deprecated
     */
    public static function isNullEmpty($mixValue)
    {
        return String::isNullEmpty($mixValue);
    }

    /**
     * Trabalha com a quebra de linhas de uma string acrescidas de outras 
     * funcionalidades especiais.
     *
     * @example \InepZend\Util\Library::cleanBreakline('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira')
     *
     * @param string $strValue
     * @param boolean $booBr
     * @param boolean $booAspasDupla
     * @param boolean $booNoWrap
     * @param boolean $booHtmlDecode
     * @return string
     * @deprecated
     */
    public static function cleanBreakline($strValue = '', $booBr = true, $booAspasDupla = true, $booNoWrap = true, $booHtmlDecode = true)
    {
        return String::cleanBreakline($strValue, $booBr, $booAspasDupla, $booNoWrap, $booHtmlDecode);
    }

    /**
     * Quebra um texto em formato vertical.
     *
     * @example \InepZend\Util\Library::verticalText('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira') <br /> \InepZend\Util\String::verticalText('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira', true)
     *
     * @param string $strText
     * @param string $strWrap
     * @return string
     * @deprecated
     */
    public static function verticalText($strText = '', $strWrap = '<br />')
    {
        return String::verticalText($strText, $strWrap);
    }

    /**
     * Limpa determinado texto, retirando caracteres desnecessarios.
     *
     * @example \InepZend\Util\Library::clearText('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira')
     *
     * @param string $strText
     * @param string $strChars
     * @param boolean $booAcceptChar
     * @return string
     * @deprecated
     */
    public static function clearText($strText = null, $strChars = null, $booAcceptChar = null)
    {
        return String::clearText($strText, $strChars, $booAcceptChar);
    }

    /**
     * Funcao que converte caracteres de um array por outro caracter.
     *
     * @example \InepZend\Util\Library::replaceCharacterAndRemoveLast('MEC', array('M', 'E', 'C'), 'OAB') <br/ > \InepZend\Util\String::replaceCharacterAndRemoveLast('INEP')
     *
     * @param string $strTexto
     * @param array $arrCharacter
     * @param string $strCharacterReplace
     * @return string
     * @deprecated
     */
    public static function replaceCharacterAndRemoveLast($strTexto = '', $arrCharacter = array(), $strCharacterReplace = ',')
    {
        return String::replaceCharacterAndRemoveLast($strTexto, $arrCharacter, $strCharacterReplace);
    }

    /**
     * Faz o tratamento de parametros de consulta que precisam ser separados por ','
     * Substitui varios separadores na string por , para que o parametro da pesquisa
     * seja passado corretamente a query de consulta.
     *
     * @example \InepZend\Util\Library::treatingSeparatorParameter('INEP')
     *
     * @param string $strItemPesquisa
     * @return string
     * @deprecated
     */
    public static function treatingSeparatorParameter($strItemPesquisa)
    {
        return String::treatingSeparatorParameter($strItemPesquisa);
    }

    /**
     * Realiza o substr de tras para frente.
     *
     * @example \InepZend\Util\Library::substrReverse('INEP MEC', 4, 8)
     *
     * @param string $strText
     * @param integer $intStart
     * @param integer $intLenght
     * @return string
     * @deprecated
     */
    public static function substr_reverse($strText, $intStart, $intLenght)
    {
        return String::substrReverse($strText, $intStart, $intLenght);
    }

    /**
     * Edita uma string para o formato dasherize.
     *
     * @example \InepZend\Util\Library::dasherize('INEP MEC')
     *
     * @param string $strText
     * @param string $strSymbol
     * @return string
     * @deprecated
     */
    public static function dasherize($strText = '', $strSymbol = null)
    {
        return String::dasherize($strText, $strSymbol);
    }

    /**
     * Edita uma string para o formato camelize.
     *
     * @example \InepZend\Util\Library::camelize('INEP MEC')
     *
     * @param string $strText
     * @return string
     * @deprecated
     */
    public static function camelize($strText = '')
    {
        return String::camelize($strText);
    }

    /**
     * Realiza o mb_substr.
     *
     * @example \InepZend\Util\Library::substrEncode('Minstério da Educação', 5) <br /> \InepZend\Util\String::substrEncode('Minstério da Educação', 5, 21) <br /> \InepZend\Util\String::substrEncode('Minstério da Educação', 5, 'US-ASCII')
     *
     * @param string $strText
     * @param integer $intStart
     * @param integer $intLength
     * @param string $strEncoding
     * @return string
     * @deprecated
     */
    public static function substrEncode($strText, $intStart = 0, $intLength = null, $strEncoding = null)
    {
        return String::substrEncode($strText, $intStart, $intLength, $strEncoding);
    }

    /**
     * Converter uma determinada string para o formato de UTF-8.
     *
     * @example \InepZend\Util\Library::utf8Decode('&#233;rio da Educa&#231;&#227;o') <br />
     *
     * @param string $strText
     * @param boolean $booCheck
     * @return string
     * @deprecated
     */
    public static function utf8Decode($strText = '', $booCheck = null)
    {
        return String::utf8Decode($strText, $booCheck);
    }

    /**
     * Codifica uma determinada string para o formato de UTF-8.
     *
     * @example \InepZend\Util\Library::utf8Encode('')
     *
     * @param string $strText
     * @param boolean $booCheck
     * @return string
     * @deprecated
     */
    public static function utf8Encode($strText = '', $booCheck = null)
    {
        return String::utf8Encode($strText, $booCheck);
    }

    /**
     * Lista os valores de uma string usando aspas simples e duplas.
     *
     * @example \InepZend\Util\Library::listValueFromText('Inep', '<span class="Inep">Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira Legislação e Documentos.</span>')
     *
     * @param string $strValuePart
     * @param string $strText
     * @return mix
     * @deprecated
     */
    public static function listValueFromText($strValuePart = null, $strText = null)
    {
        return String::listValueFromText($strValuePart, $strText);
    }

    /**
     * Metodo responsavel em listar a ordem alfabetica.
     *
     * @example \InepZend\Util\Library::getAlphabeticOrder()
     *
     * @param integer $intOrder
     * @param boolean $booCapsLock
     * @return mix
     * @deprecated
     */
    public static function getAlphabeticOrder($intOrder = null, $booCapsLock = null)
    {
        return String::getAlphabeticOrder($intOrder, $booCapsLock);
    }

    /**
     * Metodo responsavel em executar determinada URL, apresentando seu retorno.
     *
     * @example \InepZend\Util\Library::execUrl('demandas.inep.gov.br') <br /> \InepZend\Util\Uri::execUrl('demandas.inep.gov.br', 'cadastrar_usuario.php') <br /> \InepZend\Util\Uri::execUrl('demandas.inep.gov.br', 'cadastrar_usuario.php', null, null, null, 'POST', 'usucpf=123.456.789-10&usuemail=teste@inep.gov.br')
     *
     * @param string $strHost
     * @param string $strSubHost
     * @param string $strQuerystring
     * @param integer $intPort
     * @param integer $intTimeout
     * @param string $strMethod
     * @param string $strQuerystringWithMethodPost
     * @return mix
     * @deprecated
     */
    public static function execUrl($strHost, $strSubHost = '', $strQuerystring = '', $intPort = 80, $intTimeout = 60, $strMethod = 'GET', $strQuerystringWithMethodPost = '')
    {
        return Uri::execUrl($strHost, $strSubHost, $strQuerystring, $intPort, $intTimeout, $strMethod, $strQuerystringWithMethodPost);
    }

    /**
     * Metodo responsavel em acessar determinada url e retorna seu conteudo.
     *
     * @example \InepZend\Util\Library::getBinaryContent('portal.inep.gov.br') <br /> \InepZend\Util\Uri::getBinaryContent('portal.inep.gov.br', 'data/testeUnit/portal.html')
     *
     * @param string $strUrl
     * @param string $strSaveTo
     * @param string $strProxyHost
     * @param string $strProxyPort
     * @return mix
     * @deprecated
     */
    public static function getBinaryContent($strUrl = null, $strSaveTo = null, $strProxyHost = null, $strProxyPort = null)
    {
        return Uri::getBinaryContent($strUrl, $strSaveTo, $strProxyHost, $strProxyPort);
    }

    /**
     * Metodo responsavel pelo retorno das configuracoes do proxy
     *
     * @example \InepZend\Util\Library::getProxyConfig()
     *
     * @return array
     * @deprecated
     */
    public static function getProxyConfig()
    {
        return Uri::getProxyConfig();
    }

    /**
     * Metodo responsavel em validar email, podendo verificar o dominio do mesmo 
     * caso necessario.
     *
     * @example \InepZend\Util\Library::validateEmail('arquitetura.php@inep.gov.br') <br /> \InepZend\Util\Validate::validateEmail('arquitetura.php@inep.gov.br', true)
     *
     * @param string $strEmail
     * @param boolean $booCheckDomain
     * @return boolean
     * @deprecated
     */
    public static function validateEmail($strEmail, $booCheckDomain = false)
    {
        return Validate::validateEmail($strEmail, $booCheckDomain);
    }

    /**
     * Metodo responsavel em validar PIS/PASEP.
     *
     * @example \InepZend\Util\Library::validatePisPasep('125.32227.36-4') <br /> \InepZend\Util\Validate::validatePisPasep('12532227364')
     *
     * @param string $strValue
     * @return boolean
     * @deprecated
     */
    public static function validatePisPasep($strValue)
    {
        return Validate::validatePisPasep($strValue);
    }

    /**
     * Metodo responsavel em validar o CPF.
     *
     * @example \InepZend\Util\Library::validateCpf('173.575.278-91') <br /> \InepZend\Util\Validate::validateCpf('17357527891')
     *
     * @param string $strNuCpf
     * @return boolean
     * @deprecated
     */
    public static function validateCpf($strNuCpf)
    {
        return Validate::validateCpf($strNuCpf);
    }

    /**
     * Metodo responsavel em validar o CNPJ.
     *
     * @example \InepZend\Util\Library::validateCnpj('56.167.101/0001-06') <br /> \InepZend\Util\Validate::validateCnpj('56167101000106')
     *
     * @param string $strNuCnpj
     * @return boolean
     * @deprecated
     */
    public static function validateCnpj($strNuCnpj)
    {
        return Validate::validateCnpj($strNuCnpj);
    }

    /**
     * Metodo responsavel em validar Host.
     *
     * @example \InepZend\Util\Library::validateHost('portal.inep.gov.br')
     *
     * @param string $strUri
     * @return boolean
     * @deprecated
     */
    public static function validateHost($strUri)
    {
        return Validate::validateHost($strUri);
    }

    /**
     * @param null $strXmlPath
     * @param null $strXmlContent
     * @param null $booClearXmlContent
     * @return \DOMDocument
     * @deprecated
     */
    public static function getDomDocument($strXmlPath = null, $strXmlContent = null, $booClearXmlContent = null)
    {
        return Xml::getDomDocument($strXmlPath, $strXmlContent, $booClearXmlContent);
    }

    /**
     * @param \DOMDocument|null $domDocument
     * @return \DOMXPath
     * @deprecated
     */
    public static function getDomXPath(\DOMDocument $domDocument = null)
    {
        return Xml::getDomXPath($domDocument);
    }

    /**
     * @param null $strXmlPath
     * @param null $strXmlSchemaPath
     * @param null $intMaxError
     * @param bool|true $booPhpIni
     * @return array|bool|mixed
     * @deprecated
     */
    public static function schemaValidate($strXmlPath = null, $strXmlSchemaPath = null, $intMaxError = null, $booPhpIni = true)
    {
        return Xml::schemaValidate($strXmlPath, $strXmlSchemaPath, $intMaxError, $booPhpIni);
    }

}
