<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\Util\Server;
use InepZend\Util\FileSystem;
use Zend\Barcode\Barcode;

class BarcodeHelper extends AbstractHelper
{

    public function __invoke($strText = null, $arrConfigBarcode = null, $arrConfigRenderer = null, $strBarcode = null, $strRenderer = null, $booCreateFile = false)
    {
        return $this->render($strText, $arrConfigBarcode, $arrConfigRenderer, $strBarcode, $strRenderer, $booCreateFile);
    }

    public function render($strText = null, $arrConfigBarcode = null, $arrConfigRenderer = null, $strBarcode = null, $strRenderer = null, $booCreateFile = false)
    {
        if (empty($strText))
            return;
        if (empty($strBarcode))
            $strBarcode = 'code128';
        if (empty($strRenderer))
            $strRenderer = 'image';
        $arrConfigBarcode = (array) $arrConfigBarcode;
        $arrConfigBarcode['text'] = str_replace(array(' ', '-', '/'), '', $strText);
        $strMethod = ($booCreateFile) ? 'renderBarcodeCreateFile' : 'renderBarcode';
        return '<img src="' . $this->$strMethod($arrConfigBarcode, $arrConfigRenderer, $strBarcode, $strRenderer) . '" name="imgBarcode[]" class="imgBarcode" title="Código de barras" />';
    }

    /**
     * Metodo responsavel pela renderizacao do barcode.
     * 
     * @param array $arrConfigBarcode
     * @param array $arrConfigRenderer
     * @param string $strBarcode
     * @param string $strRenderer
     * @return string
     */
    protected function renderBarcode($arrConfigBarcode = null, $arrConfigRenderer = null, $strBarcode = null, $strRenderer = null)
    {
        return Server::getHost(true) . 'barcode/' . base64_encode(serialize(array($strBarcode, $strRenderer, (array) $arrConfigBarcode, (array) $arrConfigRenderer)));
    }

    /**
     * Metodo responsavel pela criacao do barcode em arquivo.
     * 
     * @param array $arrConfigBarcode
     * @param array $arrConfigRenderer
     * @param string $strBarcode
     * @param string $strRenderer
     * @return string
     */
    protected function renderBarcodeCreateFile($arrConfigBarcode = null, $arrConfigRenderer = null, $strBarcode = null, $strRenderer = null)
    {
        $strPathFile = Server::getReplacedBasePathApplication('/../../../../../../data/barcode');
        if (!is_dir($strPathFile))
            mkdir($strPathFile, 0755, true);
        $strPathFile .= '/' . str_replace(' ', '', $arrConfigBarcode['text']) . '_' . str_replace('.', '', microtime(true)) . '.png';
        $barcode = Barcode::factory($strBarcode, $strRenderer, $arrConfigBarcode, $arrConfigRenderer);
        imagepng($barcode->draw(), $strPathFile);
        return 'data:image/png;base64,' . base64_encode(FileSystem::getContentFromFile($strPathFile));
    }

}
