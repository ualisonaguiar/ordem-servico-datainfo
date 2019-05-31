<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Compression\ZipFile;
use \ZipArchive;
use InepZend\Util\FileSystem;

class Backup extends AbstractServiceManager
{
    protected function initDataBase($strUsername, $strPassword)
    {
        $arrDirectory = FileSystem::globRecursive(getReplacedBasePathApplication('/database'));
        $zipFile = ZipFile::getInstance();
        $strPathFileZip = getReplacedBasePathApplication('/data/database') . '.zip';
        $zipFile->openZip($strPathFileZip, ZipArchive::CREATE);
        foreach ($arrDirectory as $strDirectory) {
            # separa arquivos .db
            if (substr($strDirectory, -2) == 'db') {
                # ler arquivo md5
                $md5Path = substr($strDirectory, 0, -2) . 'md5';
                $md5File = fopen($md5Path, 'r');
                $md5Content = fread($md5File, filesize($md5Path));
                fclose($md5File);
                # gerar md5 do novo arquivo
                $strMd5 = md5_file($strDirectory);
                # comparar
                if ($md5Content != $strMd5) {
                    # gravar novo md5
                    $md5File = fopen($md5Path, 'w+');
                    fwrite($md5File,$strMd5);
                    fclose($md5File);                    
                    # adiciona no zip
                    $arrInfoDirectory = explode('/', $strDirectory);
                    $strPathFile  = $arrInfoDirectory[count($arrInfoDirectory) - 3];
                    $strPathFile .= '/' . $arrInfoDirectory[count($arrInfoDirectory) - 2];
                    $strPathFile .= '/' . end($arrInfoDirectory);
                    $zipFile->addContentIntoZip(FileSystem::getContentFromFile($strDirectory), $strPathFile);
                }
            }
        }
        $zipFile->closeZip();
        if (is_file($strPathFileZip)) {
            $strSvnUrl = 'http://ic.inep.gov.br/svn/inepskeleton-docs/ordem-servico/backup/Backup.zip';
//             $strSvnUrl = 'http://ic.inep.gov.br/svn/inepskeleton-docs/Banco%20de%20Dados/ordem-servico/backup/Backup.zip';
            # 1 removendo o antigo backup
            $strCommandDelete = 'svn rm -m "[' . $strUsername . '_' .date('Ymd_His') .'] Removendo Backup Antigo" --no-auth-cache --username ' . $strUsername .' --password ' . $strPassword .' ' . $strSvnUrl;
            exec($strCommandDelete);
            # 2 adicionando arquivo
            $strCommandAdd = 'svn import -m "[' . $strUsername . '_' .date('Ymd_His') .'] Backup Database" --no-auth-cache --username ' . $strUsername .' --password ' . $strPassword .' '. $strPathFileZip .' ' . $strSvnUrl;
            exec($strCommandAdd);
            unlink($strPathFileZip);
        }
    }    
}
