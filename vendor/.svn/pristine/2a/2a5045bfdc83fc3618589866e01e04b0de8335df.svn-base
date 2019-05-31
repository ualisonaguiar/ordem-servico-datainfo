<?php

namespace InepZend\Module\Application\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Paginator\Paginator;
use InepZend\Util\FileSystem;
use InepZend\Util\Format;
use InepZend\Util\Server;

class AutoloadConfig extends AbstractServiceManager
{

    const PATH = 'config/complement/autoload-config.php';
    const ATTRIBUTE = 'dsAutoloadConfig';
    const TYPE_FILE_CURRENT = 'current';
    const TYPE_FILE_HISTORY = 'history';

    private static $intTimestamp;

    public static function getAutoloadConfig($strPath = null)
    {
        if (empty($strPath))
            $strPath = self::getPath();
        $arrAutoloadConfig = file_exists($strPath) ? include $strPath : array();
        return (!is_array($arrAutoloadConfig)) ? array() : $arrAutoloadConfig;
    }

    public function findByPaged(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT)
    {
        $arrFileAutoloaderConfig = array();
        if ((is_array($arrCriteria)) && (array_key_exists('tp_file', $arrCriteria)) && ($arrCriteria['tp_file'] == self::TYPE_FILE_HISTORY)) {
            $arrFile = FileSystem::scandirRecursive('./data/config/complement');
            foreach ($arrFile as $strFile) {
                $strNameFile = end($arrExplode = explode('/', $strFile));
                $strContent = self::getContentAutoloadConfig(false, $strFile);
                $arrAnnotationInfo = array(
                    'author' => null,
                    'since' => null,
                );
                foreach ($arrAnnotationInfo as $strAnnotation => &$mixReference) {
                    if (($intPos = strpos($strContent, $strPart = ' * @' . $strAnnotation . ' ')) !== false) {
                        $mixReference = substr($strContent, $intPos + strlen($strPart));
                        if (($intPos = strpos($mixReference, "\n")) !== false)
                             $mixReference = substr($mixReference, 0, $intPos);   
                    }
                }
                $arrFileAutoloaderConfig[$strNameFile] = array('NO_AUTOR' => $arrAnnotationInfo['author'], 'NO_FILE' => $strNameFile, 'DT_OCORRENCIA' => $arrAnnotationInfo['since']);
            }
        } else {
            $arrFile = FileSystem::scandirRecursive('./config/autoload', 'php');
            foreach ($arrFile as $strFile) {
                $strNameFile = end($arrExplode = explode('/', $strFile));
                if (in_array(strtolower($strNameFile), array('global.php', 'local.php')))
                    continue;
                $arrFileAutoloaderConfig[$strNameFile] = array('NO_FILE' => $strNameFile, 'DS_PATH' => base64_encode($strFile));
            }
        }
        krsort($arrFileAutoloaderConfig);
        return new Paginator($arrFileAutoloaderConfig, $intPage, $intItemPerPage);
    }

    protected function insertContentAutoloadConfig($mixContent = null, $strPath = null)
    {
        if (is_array($mixContent)) {
            if (!array_key_exists(self::ATTRIBUTE, $mixContent))
                return false;
            $mixContent = $mixContent[self::ATTRIBUTE];
        }
        if (empty($mixContent))
            return false;
        if (empty($strPath))
            $strPath = self::getPath();
        $mixResult = FileSystem::insertContentIntoFile($strPath, $mixContent);
        if ($mixResult !== false)
            $this->insertContentAutoloadConfigHistory($mixContent);
        return $mixResult;
    }

    protected function getContentAutoloadConfig($booToForm = null, $strPath = null)
    {
        if (empty($strPath))
            $strPath = self::getPath();
        $mixResult = FileSystem::getContentFromFile($strPath);
        if ($booToForm === true)
            $mixResult = array(self::ATTRIBUTE => $mixResult);
        return $mixResult;
    }

    protected function insertContentAutoloadConfigHistory($mixContent = null)
    {
        if (empty($mixContent))
            return false;
        $strOpen = "<?php
/**
 * @author " . $this->getIdentity()->usuarioSistema->usuario->nome . " " . Format::formatCpfCnpj($this->getIdentity()->usuarioSistema->usuario->cpf) . "
 * @since " . date('d/m/Y H:i:s') . "
 */";
        $mixContent = str_replace('<?php', $strOpen, $mixContent);
        return FileSystem::insertContentIntoFile(self::getPathHistory(), $mixContent);
    }

    protected function mergeAutoloadConfig($arrAutoloadConfig = null)
    {
        $strContent = "<?php\nreturn " . var_export(array_merge(AutoloadConfig::getAutoloadConfig(), (array) $arrAutoloadConfig), true) . ';';
        return $this->insertContentAutoloadConfig($strContent);
    }

    private static function getPath()
    {
        return self::getBasePath() . self::PATH;
    }

    private static function getPathHistory()
    {
        return self::getBasePath() . 'data/' . str_replace('.php', '.' . self::getTimestamp() . '.php', self::PATH);
    }

    private static function getBasePath()
    {
        return Server::getReplacedBasePathApplication('/../../../../../../../');
    }

    private static function getTimestamp()
    {
        if (empty(self::$intTimestamp))
            self::$intTimestamp = time();
        return self::$intTimestamp;
    }

}
