<?php

namespace InepZend\Encryption\Service;

use InepZend\Encryption\Util\GenerateFilePhar;

/**
 * Encryption
 *
 * @author Thiago Lenin
 * @package Encrypts
 */
class Encryption
{

    /**
     * 
     * @param string $strFileName 
     * @param string $strPath podendo ser null
     * @return string
     */
    public function encryptsFilePhp($strFileName, $strPath = null)
    {
        $this->requirePhar('encryption-generator', false);
        return EncryptionGenerator::encryptsFilePhp($strFileName, $strPath);
    }

    /**
     * 
     * @param string $strFileNameOriginal 
     * @param string $strPathOriginal
     * @param string $strNameFileNew
     * @param string $strPathNew
     * @return void
     */
    public function createEncryptedFile($strFileNameOriginal, $strPathOriginal, $strNameFileNew, $strPathNew)
    {
        $this->requirePhar('encryption-generator', false);
        return EncryptionGenerator::createEncryptedFile($strFileNameOriginal, $strPathOriginal, $strNameFileNew, $strPathNew);
    }

    /**
     * 
     * @param string $strPath 
     * @param string $strFileName
     * @return string
     */
    public function executeEncryptedFile($strPath, $strFileName)
    {
        $this->requirePhar('encryption-generator', false);
        return EncryptionGenerator::executeEncryptedFile($strPath, $strFileName);
    }

    /**
     * 
     * @param string $strPathFileName, caminho de um diretorio ou juntamente como o nome do arquivo
     * @param string $strFileNamePhar
     * @param boolean $booCompressFiles
     * @return string
     */
    public function generatePhar($strPathFileName, $strFileNamePhar, $booCompressFiles = true)
    {
        return GenerateFilePhar::generatePhar($strPathFileName, $strFileNamePhar, $booCompressFiles);
    }

    /**
     * 
     * @param string $strPhar
     * @param boolean $booCrypted
     * @return boolean
     */
    public function requirePhar($strPhar, $booCrypted = true)
    {
//        d(GenerateFilePhar::constructInepZendPhar(), 1);
        return GenerateFilePhar::requirePhar($strPhar, $booCrypted);
    }
    
}
