<?php

namespace InepZend\Encryption\Util;

use Phar;
use InepZend\Exception\Exception;
use InepZend\Util\PhpIni;
use InepZend\Util\String;
use InepZend\Util\FileSystem;

/**
 * Gerar .phar
 * 
 * @package Encrypts
 */
class GenerateFilePhar
{

    const PATH_DATA_PHAR = '/../../../../data/phar/';

    /**
     * Realiza a operacao de gerar arquivos .phar caso os parametros estejam validos
     * 
     * @param string $strPathFileName, caminho de um diretorio ou juntamente como o nome do arquivo
     * @param string $strFileNamePhar
     * @param boolean $booCompressFiles
     * @return void
     */
    public static function generatePhar($strPathFileName, $strFileNamePhar, $booCompressFiles = true)
    {
        self::validate($strPathFileName);
        return self::generateFilePhar($strPathFileName, $strFileNamePhar, $booCompressFiles);
    }

    /**
     * Realiza as devidas operacoes de include de um arquivo .phar
     * 
     * @param string $strPhar
     * @param boolean $booCrypted
     * @return boolean
     */
    public static function requirePhar($strPhar, $booCrypted = true)
    {
        if (empty($strPhar))
            return false;
        $strPhar = str_ireplace('.phar', '', $strPhar);
        $strPharDasherize = String::dasherize($strPhar);
        $strPath = __DIR__ . self::PATH_DATA_PHAR . $strPharDasherize;
        $strFileNamePhar = $strPharDasherize . '.phar';
        $strPathFileNamePhar = $strPath . '/' . $strFileNamePhar;
//        \InepZend\Util\Debug::debug(self::constructInepZendPhar(), 1);
        if (is_file($strPathFileNamePhar)) {
            if ($booCrypted) {
                self::requireEncryptionGenerator();
                EncryptionGenerator::executeEncryptedFile($strPath, $strFileNamePhar);
            } else
                require_once $strPathFileNamePhar;
            return true;
        }
        return false;
    }

    /**
     * Constroi (ou reconstroi) todos os arquivos .phar do InepZend
     * 
     * @return array
     */
    public static function constructInepZendPhar()
    {
        $arrResult = array();
        $strPathDataPhar = __DIR__ . self::PATH_DATA_PHAR;
        $strSuffixCrypted = 'Crypti.php';
        $strClass = 'EncryptionGenerator';
        if (is_file(__DIR__ . '/' . $strClass . '.php'))
            $arrResult[$strClass]['GenerateFilePhar::generatePhar'] = self::generatePhar(__DIR__ . '/' . $strClass . '.php', $strPathDataPhar . String::dasherize($strClass) . '/' . String::dasherize($strClass) . '.phar');
        self::requireEncryptionGenerator();
        $arrFileContainer = FileSystem::scandirRecursive(__DIR__ . '/../Container', 'php');
        foreach ($arrFileContainer as $strFileContainer) {
            if ((strpos($strFileContainer, $strSuffixCrypted) !== false) || (stripos($strFileContainer, '.php') === false))
                continue;
            $strFileNameOriginal = end($arrExplode = explode('/', $strFileContainer));
            $strPathOriginal = str_replace($strFileNameOriginal, '', $strFileContainer);
            $strClass = reset($arrExplode = explode('.php', $strFileNameOriginal));
            $strFileNameNew = $strClass . $strSuffixCrypted;
            $strDasherize = String::dasherize($strClass);
            if (($arrResult[$strClass]['EncryptionGenerator::createEncryptedFile'] = EncryptionGenerator::createEncryptedFile($strFileNameOriginal, $strPathOriginal, $strFileNameNew, $strPathOriginal)) === true)
                $arrResult[$strClass]['GenerateFilePhar::generatePhar'] = self::generatePhar($strPathOriginal . $strFileNameNew, $strPathDataPhar . $strDasherize . '/' . $strDasherize . '.phar');
        }
        return $arrResult;
    }

    /**
     * Realiza todas as devidas validacoes nos parametros necessarios para se gerar arquivos .phar
     * 
     * @param string $strPath, caminho juntamente como o nome do arquivo
     * @return boolean
     */
    private static function validate($strPath)
    {
        if ((!is_file($strPath)) && (!is_dir($strPath))) {
            throw new Exception('Arquivo ou diretório não identificado ou inexistente.');
        }
        return true;
    }

    /**
     * Realiza as operacoes da extensao PHAR para a criacao do arquivo .phar
     * 
     * @param string $strPathFileName, caminho de um diretorio ou juntamente como o nome do arquivo
     * @param string $strFileNamePhar
     * @param boolean $booCompressFiles
     * @return boolean
     */
    private static function generateFilePhar($strPathFileName, $strFileNamePhar, $booCompressFiles = true)
    {
        PhpIni::setPharReadOnly(false);
        if (!Phar::canWrite())
            throw new Exception('O ambiente não está preparado para gerar arquivo PHAR.');
        if (is_file($strFileNamePhar))
            unlink($strFileNamePhar);
        $booFile = (is_file($strPathFileName));
        $strAlias = end($arrExplode = explode('/', $strFileNamePhar));
        if (is_file($strAlias))
            unlink($strAlias);
        $phar = new Phar($strAlias, 0, $strAlias);
        try {
            $phar->startBuffering();
            if ($booFile) {
                $strPathFileNameAdd = end($arrExplode = explode('/', $strPathFileName));
                copy($strPathFileName, $strPathFileNameAdd);
                $phar->addFile($strPathFileNameAdd);
                $phar->setStub($phar->createDefaultStub($strPathFileNameAdd));
                unlink($strPathFileNameAdd);
            } else {
                $phar->buildFromDirectory($strPathFileName);
                $phar->setStub($phar->createDefaultStub($strPathFileName));
            }
            $phar->setSignatureAlgorithm(Phar::SHA512);
//            $phar->compress(Phar::BZ2);
            if ($booCompressFiles)
                $phar->compressFiles(Phar::BZ2);
            $phar->stopBuffering();
            unset($phar);
            copy($strAlias, $strFileNamePhar);
            unlink($strAlias);
            return true;
        } catch (Exception $exception) {
            throw new Exception('Erro ao gerar arquivo PHAR. Erro: ' . $exception->getMessage());
        } catch (\Exception $exception) {
            throw new Exception('Erro ao gerar arquivo PHAR. Erro: ' . $exception->getMessage());
        }
    }

    private static function requireEncryptionGenerator()
    {
        require_once 'phar://' . __DIR__ . self::PATH_DATA_PHAR . 'encryption-generator/encryption-generator.phar/EncryptionGenerator.php';
        return true;
    }

}
