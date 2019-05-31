<?php
namespace InepZend\Module\TrocaArquivo\Common\Service;

use InepZend\Dto\ResultDto;
use InepZend\Util\FileSystem;
use InepZend\Util\Xml;
use InepZend\Util\Server;

trait ValidateStructureTrait
{

    /**
     * Metodo responsavel em realizar a validacao estrutural via XmlSchema (XSD).
     *
     * @param string $strPathXml            
     * @param string $strPathXmlSchema            
     * @param boolean $booControl            
     * @return mix
     */
    protected function validateStructure($strPathXml = null, $strPathXmlSchema = null, $booControl = true)
    {
        $this->debugExecFile(func_get_args());
        if ((empty($strPathXml)) || (empty($strPathXmlSchema)))
            return self::getResult(ResultDto::STATUS_ERROR, 'Informações obrigatórias não informadas para a validação estrutural.');
        if (strpos($strPathXmlSchema, 'http') === false) {
            $strHost = Server::getHost();
            if (strpos($strPathXmlSchema, $strHost) === false)
                $strPathXmlSchema = $strHost . $strPathXmlSchema;
        }
        $this->debugExecFile($strPathXmlSchema);
        if ($booControl) {
            $arrPathXml = explode('/', str_replace('\\', '/', $strPathXml));
            $strNameXml = array_pop($arrPathXml);
            $strPathControl = implode('/', $arrPathXml) . '/' . __FUNCTION__ . '/' . str_ireplace('.xml', '.control', $strNameXml);
            $this->debugExecFile($strPathControl);
            FileSystem::insertContentIntoFile($strPathControl, '');
            $intMicrotime = microtime(true);
        }
        $mixResult = Xml::schemaValidate($strPathXml, $strPathXmlSchema, self::MAX_ERROR);
        if ($booControl)
            FileSystem::insertContentIntoFile($strPathControl, microtime(true) - $intMicrotime);
        return $mixResult;
    }
}
