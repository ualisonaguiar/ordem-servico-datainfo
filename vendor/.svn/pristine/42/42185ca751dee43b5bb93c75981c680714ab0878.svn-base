<?php

namespace InepZend\Util;

use InepZend\Util\ArrayCollection;
use InepZend\Util\FileSystem;
use InepZend\Util\String;
use InepZend\Util\Environment;
use InepZend\Util\Uri;
use InepZend\Util\Server;

/**
 * Classe responsavel por exibir informacoes de configuracao da Aplicacao
 * na qual estao definidas em formato XML no arquivo application.info.xml.
 *
 * @package InepZend
 * @subpackage Util
 */
class ApplicationInfo
{

    const CACHE = true;
    const PATH_FILE_XML = '/../../../../../config/complement/application.info.xml';
    const PATH_MODIFICATION_TIME = '/../../../../../data/tmp/config/complement/application.info.time';
    const PATH_CACHE_PHP = '/../../../../../data/tmp/config/complement/application.info.php';

    private static $arrApplicationInfoData;
    private static $strNameEdited;
    private static $strServerInstance;
    private static $arrInepZendVersion;
    private static $arrRevision;
    private static $strInepZendLastVersion;
    private static $arrTheme;

    /**
     * Metodo responsavel em retornar as
     * informacao da Aplicacao retornado em formato de array
     * na qual esta no arquivo XML (application.info.xml).
     *
     * @example \InepZend\Util\ApplicationInfo::getApplicationInfo()
     *
     * @return array
     *
     * @assert () == array('NAME' => 'InepSkeleton', 'CLASS_CSS_BACKGROUND' => '', 'CLASS_CSS_LOGO' => '', 'CLASS_CSS_BAR' => '', 'TEXT_BAR' => '', 'LINK' => '', 'ID_ACOMPANHAMENTO' => '', 'URL_PADRAO' => '', 'VERSION' => '@VERSION@', 'BUILD_NUMBER' => '@BUILD_NUMBER@', 'REVISION' => '@REVISION@', 'BUILD_TAG' => '@BUILD_TAG@', 'BUILD_DATE' => '@BUILD_DATE@', 'RESPONSIBLE' => array('ARCHITECTURE' => 'arquitetura.php@inep.gov.br', 'PRODUCT_OWNER' => '',), 'ACRONYM' => '',)
     */
    public static function getApplicationInfo()
    {
        $strPathFileXml = Server::getReplacedBasePathApplication(self::PATH_FILE_XML);
        if ((empty(self::$arrApplicationInfoData)) && (is_file($strPathFileXml))) {
            if (self::CACHE === false)
                self::$arrApplicationInfoData = ArrayCollection::convertXmlToArray('/SYSTEM/*', FileSystem::getContentFromFile($strPathFileXml));
            else {
                $strPathModificationTime = Server::getReplacedBasePathApplication(self::PATH_MODIFICATION_TIME);
                $strPathCachePhp = Server::getReplacedBasePathApplication(self::PATH_CACHE_PHP);
                $strModificationTime = FileSystem::getModificationTime($strPathFileXml);
                if ((!is_file($strPathModificationTime)) || (!is_file($strPathCachePhp)) || (FileSystem::getContentFromFile($strPathModificationTime) != $strModificationTime)) {
                    self::$arrApplicationInfoData = ArrayCollection::convertXmlToArray('/SYSTEM/*', FileSystem::getContentFromFile($strPathFileXml));
                    FileSystem::insertContentIntoFile($strPathCachePhp, '<?php return unserialize(\'' . serialize(self::$arrApplicationInfoData) . '\'); ');
                    FileSystem::insertContentIntoFile($strPathModificationTime, $strModificationTime);
                } else
                    self::$arrApplicationInfoData = require $strPathCachePhp;
            }
        }
        return self::$arrApplicationInfoData;
    }

    /**
     * Metodo responsavel em retornar o nome da aplicacao de forma editada.
     *
     * @example \InepZend\Util\ApplicationInfo::getNameEdited()
     *
     * @return string
     *
     * @assert () == 'InepSkeleton_'
     */
    public static function getNameEdited()
    {
        if (empty(self::$strNameEdited)) {
            $arrApplicationInfo = self::getApplicationInfo();
            if ((is_array($arrApplicationInfo)) && (array_key_exists('NAME', $arrApplicationInfo)))
                self::$strNameEdited = str_replace(array(' ', '-', '/', '\\', '.', ',', ':', ';', '(', ')', '[', ']', '{', '}'), '', String::clearWord($arrApplicationInfo['NAME'])) . '_';
        }
        return self::$strNameEdited;
    }

    /**
     * Metodo responsavel em retornar a instancia do servidor.
     *
     * @example \InepZend\Util\ApplicationInfo::getServerInstance()
     *
     * @return string
     *
     * @TODO implementar asserts
     */
    public static function getServerInstance()
    {
        if (empty(self::$strServerInstance)) {
            $strIpServer = Server::getIpServer();
            self::$strServerInstance = (Environment::isLocal()) ? 'localhost' : substr($strIpServer, strrpos($strIpServer, '.'));
        }
        return self::$strServerInstance;
    }

    /**
     * Metodo responsavel em retornar a versao do InepZend.
     *
     * @example \InepZend\Util\ApplicationInfo::getInepZendVersion()
     *
     * @return array
     *
     * @TODO implementar asserts
     */
    public static function getInepZendVersion()
    {
        if (empty(self::$arrInepZendVersion)) {
            $strContent = FileSystem::getContentFromFile(Server::getReplacedBasePathApplication('/../../../../../composer.json'));
            if ((is_string($strContent)) && (is_object($stdClassComposer = json_decode($strContent)))) {
                if ((isset($stdClassComposer->require)) && (is_object($stdClassComposer->require))) {
                    $arrUnset = array(
                        'php',
                        array('../public/vendor', 'public/vendor'),
                        array('../vendor', 'vendor'),
                    );
                    foreach ($arrUnset as $mixValue) {
                        if (!is_array($mixValue)) {
                            if (isset($stdClassComposer->require->$mixValue))
                                unset($stdClassComposer->require->$mixValue);
                        } else {
                            if (isset($stdClassComposer->require->$mixValue[0])) {
                                $stdClassComposer->require->$mixValue[1] = $stdClassComposer->require->$mixValue[0];
                                unset($stdClassComposer->require->$mixValue[0]);
                            }
                        }
                    }
                    self::$arrInepZendVersion = (array) $stdClassComposer->require;
                }
            }
        }
        return self::$arrInepZendVersion;
    }

    /**
     * Metodo responsavel em retornar as informacoes de revisao da aplicacao.
     *
     * @example \InepZend\Util\ApplicationInfo::getNameEdited()
     *
     * @param boolean $booInepZendLastVersion
     * @return array
     *
     * @TODO implementar asserts
     */
    public static function getRevision($booInepZendLastVersion = false)
    {
        if (empty(self::$arrRevision)) {
            $arrApplicationInfo = self::getApplicationInfo();
            $arrUnset = array('CLASS_CSS_BACKGROUND', 'CLASS_CSS_LOGO', 'CLASS_CSS_BAR', 'TEXT_BAR', 'LINK', 'ID_ACOMPANHAMENTO', 'URL_PADRAO', 'RESPONSIBLE');
            foreach ($arrUnset as $strUnset)
                if (array_key_exists($strUnset, $arrApplicationInfo))
                    unset($arrApplicationInfo[$strUnset]);
            foreach ($arrApplicationInfo as $strInfo => $mixValue) {
                if (strpos($mixValue, '@') === 0) {
                    $arrApplicationInfo[$strInfo] = null;
                    continue;
                }
                switch (strtoupper($strInfo)) {
                    case 'BUILD_NUMBER':
                        $arrApplicationInfo[$strInfo] = '#' . $arrApplicationInfo[$strInfo];
                        break;
                    case 'REVISION':
                        $arrApplicationInfo[$strInfo] = 'r' . $arrApplicationInfo[$strInfo];
                        break;
                }
            }
            $arrApplicationInfo['SERVER_INSTANCE'] = self::getServerInstance();
            if (is_array($arrInepZendVersion = self::getInepZendVersion()))
                foreach ($arrInepZendVersion as $strPath => $strVersion)
                    $arrApplicationInfo[((in_array(strtolower($strPath), array('public/vendor', 'vendor'))) ? 'INEPZEND_VERSION' : 'VENDOR_VERSION') . ' (' . $strPath . ')'] = $strVersion;
            if ($booInepZendLastVersion)
                $arrApplicationInfo['INEPZEND_LAST_VERSION'] = self::getInepZendLastVersion();
            self::$arrRevision = $arrApplicationInfo;
        }
        return self::$arrRevision;
    }

    /**
     * Metodo responsavel em retornar a ultima versao do InepZend.
     *
     * @example \InepZend\Util\ApplicationInfo::getInepZendLastVersion()
     *
     * @return string
     *
     * @TODO implementar asserts
     */
    public static function getInepZendLastVersion()
    {
        if (empty(self::$strInepZendLastVersion)) {
            $strContent = Uri::getBinaryContent('http://desenvphp.inep.gov.br/outros/command-svn.php?path=inepvendor');
            if (is_string($strContent)) {
                $arrVersion = unserialize($strContent);
                if (is_array($arrVersion)) {
                    foreach ($arrVersion as &$strVersion)
                        $strVersion = str_replace('/', '', $strVersion);
                    natsort($arrVersion);
                    self::$strInepZendLastVersion = end($arrVersion);
                }
            }
        }
        return self::$strInepZendLastVersion;
    }

    /**
     * Metodo responsavel em retornar o tipo de theme do modulo da rota atual.
     *
     * @example \InepZend\Util\ApplicationInfo::getThemeType($strNamespace)
     *
     * @param string $strNamespace
     * @return string
     *
     * @TODO implementar asserts
     */
    public static function getThemeType($strNamespace = null)
    {
        $arrTheme = (array) @$GLOBALS['module_theme_type'];
        foreach ($arrTheme as $strNamespaceModule => $strThemeType) {
            if (strpos($strNamespace, $strNamespaceModule) === 0)
                return $strThemeType;
        }
        $strThemeType = 'administrative';
        $strNamespace = strtolower($strNamespace);
        if (in_array($strNamespace, array('portal')))
            $strThemeType = 'portal';
        elseif (in_array($strNamespace, array('ideb')))
            $strThemeType = 'publicConsultation';
        return $strThemeType;
    }

    /**
     * Metodo responsavel em retornar os themes por tipo de layout.
     *
     * @example \InepZend\Util\ApplicationInfo::getTheme()
     *
     * @param string $strType
     * @param string $strNamespace
     * @param boolean $booOnlyString
     * @return mix
     *
     * @TODO implementar asserts
     */
    public static function getTheme($strType = null, $strNamespace = null, $booOnlyString = null)
    {
        if (empty(self::$arrTheme))
            self::$arrTheme = (array) @$GLOBALS['theme'];
        if ((empty($strType)) && (!empty($strNamespace)))
            $strType = self::getThemeType($strNamespace);
        if (empty($strType))
            return self::$arrTheme;
        $mixTheme = @self::$arrTheme[$strType];
        if (!is_bool($booOnlyString))
            $booOnlyString = true;
        if (($booOnlyString) && (is_array($mixTheme)))
            $mixTheme = reset($mixTheme);
        return $mixTheme;
    }

    /**
     * Metodo responsavel em retornar o layout padrao de determinado theme.
     *
     * @example \InepZend\Util\ApplicationInfo::getThemeLayout('AdministrativeResponsible')
     *
     * @param string $strTheme
     * @return string
     *
     * @TODO implementar asserts
     */
    public static function getThemeLayout($strTheme = null)
    {
        return 'layout/layout' . ((empty($strTheme)) ? '' : '-' . String::dasherize($strTheme));
    }

    /**
     * Metodo responsavel em retornar o theme a partir do layout.
     *
     * @example \InepZend\Util\ApplicationInfo::getThemeFromLayout('layout/layout-administrative')
     *
     * @param string $strLayout
     * @return string
     *
     * @TODO implementar asserts
     */
    public static function getThemeFromLayout($strLayout = null)
    {
        return String::camelize(str_replace('layout/layout', '', $strLayout));
    }

}
