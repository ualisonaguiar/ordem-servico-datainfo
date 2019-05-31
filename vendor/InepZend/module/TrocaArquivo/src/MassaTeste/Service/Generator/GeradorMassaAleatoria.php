<?php

namespace InepZend\Module\TrocaArquivo\MassaTeste\Service\Generator;

use InepZend\Util\String;
use InepZend\Module\TrocaArquivo\MassaTeste\Service\ArquivoTeste;

class GeradorMassaAleatoria extends AbstractGeradorMassa
{

    protected $intCount = 0;

    /**
     * Metodo responsavel por gerar massa aleatoriamente.
     * 
     * @param array $arrCampoLayout
     * @param integer $intQtdLinha
     * @param string $strNameFile
     * @param integer $intIdMassaTest
     * @return void
     */
    protected function gerarMassa($arrCampoLayout, $intQtdLinha, $strNameFile, $intIdMassaTest)
    {
        $this->debugExecFile(func_get_args());
        $arrValueFieldLayout = array();
        $strNameFile = date('YmdHis') . $strNameFile;
        for ($intLinha = 1; $intLinha <= $intQtdLinha; $intLinha ++) {
            foreach ($arrCampoLayout as $arrCampo)
                $arrValueFieldLayout[$intLinha][$arrCampo['name']] = $this->getValuesMassa($arrCampo['tipo'], $arrCampo['size'], $arrCampo['domain']);
            if (($intLinha % self::MAX_REGISTER_XML) == 0) {
                $this->debugExecFile('Chamada do InepZend\WebService\Server\Rest\Service\RestClient');
                ArquivoTeste::getInstance()->insertContent($arrValueFieldLayout, $strNameFile . '-' . $this->intCount, $intIdMassaTest);
                unset($arrValueFieldLayout);
                $this->intCount += 1;
            }
        }
        if ($arrValueFieldLayout)
            ArquivoTeste::getInstance()->insertContent($arrValueFieldLayout, $strNameFile . '-' . ($this->intCount + 1), $intIdMassaTest);
    }

    protected function getTypeMethodData($strType, $strName = null)
    {
        $strName = strtolower($strName);
        return $this->arrFieldMethod[String::clearWord(strtolower($strType))];
    }

}
