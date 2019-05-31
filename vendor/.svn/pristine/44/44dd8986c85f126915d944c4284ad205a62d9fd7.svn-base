<?php

namespace InepZend\Module\Log\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Compression\ZipFile;
use InepZend\Util\FileSystem;
use InepZend\Util\Server;
use \ZipArchive;

/**
 * Classe responsavel pela manipulacao dos arquivos de log.
 *
 * @package Log
 */
class LogFile extends AbstractServiceManager
{

    protected $arrWordMask = array('password', 'senha');

    /**
     * Metodo responsavel por gerar o arquivo no formato zip para o download.
     *
     * @param array $arrPathFilePost
     */
    protected function generateZipFile($arrPathFilePost)
    {
        $zipFile = ZipFile::getInstance();
        $zipFile->openZip(Server::getReplacedBasePathApplication('/../../../../../../../data/tmp/log-application-' . date('YmdHis') . '.zip'), ZipArchive::CREATE);
        foreach ($arrPathFilePost as $strPathFile) {
            $strPathFileLog = Server::getReplacedBasePathApplication('/../../../../../../../' . base64_decode($strPathFile));
            if (FileSystem::filesize($strPathFileLog))
                $zipFile->addContentIntoZip($this->masksInformationLog($strPathFileLog), $this->getNameFile($strPathFile));
            else
                $zipFile->addFileIntoZip($strPathFileLog, $this->getNameFile($strPathFile));
        }
        $zipFile->closeZip(true, true);
    }
    
    /**
     * Metodo responsavel pelo realizamento de download do arquivo de log
     *
     * @param string $strPathFileLog
     */
    protected function downloadFile($strPathFileLog)
    {
        FileSystem::downloadContent($this->getNameFile($strPathFileLog), $this->masksInformationLog(base64_decode($strPathFileLog)));
    }
    
    /**
     * Metodo responsavel por recupear o nome do arquivo
     *
     * @param string $strPathFileLog
     * @return string
     */
    protected function getNameFile($strPathFileLog)
    {
        return $this->getService('InepZend\Module\Log\Service\LogModule')->getInformationFile(base64_decode($strPathFileLog))['noFile'];
    }

    /**
     * Metodo rsponsavel por mascara informacoes sigilosas no arquivo de log
     *
     * @param string $strPathFileLog
     * @return string
     */
    private function masksInformationLog($strPathFileLog)
    {
        $arrLineFile = file($strPathFileLog);
        foreach ($arrLineFile as $intLine => $strValueLine) {
            foreach ($this->arrWordMask as $strWork) {
                if (strpos($strValueLine, $strWork)) {
                    $strWordContent = explode('","', end($arrExplode = explode($strWork . '":"', $strValueLine)))[0];
                    $arrLineFile[$intLine] = str_replace($strWordContent, str_repeat('*', strlen($strWordContent)), $strValueLine);
                }
            }
        }
        return implode('', $arrLineFile);
    }

}
