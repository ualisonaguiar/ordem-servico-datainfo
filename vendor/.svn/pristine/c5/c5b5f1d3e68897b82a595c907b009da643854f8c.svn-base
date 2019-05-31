<?php

namespace InepZend\Module\Log\Adapter\Container;

use InepZend\Util\String;
use InepZend\Util\FileSystem;

class FileAdapter implements InterfaceAdapter
{

    const USE_GZCOMPRESS = true;

    protected $strPathDirectory = './data/container';

    public function __construct()
    {
        $this->createDirectory();
    }

    /**
     * Metodo responsavel pela leitura dos dados que estao no container.
     *
     * @param string $strIndentityContainer
     */
    public function read($strIndentityContainer)
    {
        $strContextInformationLog = FileSystem::getContentFromFile($this->getPathFile($strIndentityContainer));
        if (self::USE_GZCOMPRESS && function_exists('gzuncompress'))
            $strContextInformationLog = gzuncompress($strContextInformationLog);
        return unserialize($strContextInformationLog);
    }

    /**
     * Metodo responsavel pela escrita dos dados no container.
     *
     * @param array $arrInformationLog
     * @param string $strIndentityContainer
     */
    public function write($arrInformationLog, $strIndentityContainer)
    {
        $strInformationLog = serialize($arrInformationLog);
        if (self::USE_GZCOMPRESS && function_exists('gzcompress'))
            $strInformationLog = gzcompress($strInformationLog, 9);
        FileSystem::insertContentIntoFile($this->getPathFile($strIndentityContainer), $strInformationLog);
    }

    /**
     * Metodo responsavel pela exclusao dos dados no container.
     *
     * @param string $strIndentityContainer
     */
    public function delete($strIndentityContainer = null)
    {
        if (!String::isNullEmpty($strIndentityContainer))
            unlink($this->strPathDirectory . '/' . $strIndentityContainer);
        else
            FileSystem::undir($this->strPathDirectory);
    }

    /**
     * Metodo responsavel pela criacao do diretorio que armazenara as informacoes do log.
     */
    protected function createDirectory()
    {
        if (!is_dir($this->strPathDirectory))
            mkdir($this->strPathDirectory, 0777, true);
    }

    /**
     * Metodo responsavel pelo retorno do caminho do arquivo.
     *
     * @param string $strIndentityContainer
     * @return string
     */
    private function getPathFile($strIndentityContainer)
    {
        return $this->strPathDirectory . '/' . base64_encode($strIndentityContainer);
    }

}
