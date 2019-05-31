<?php

namespace InepZend\Util;

date_default_timezone_set('America/Sao_Paulo');

use InepZend\Util\Server;
use \Exception as ExceptionNative;

/**
 * Classe responsavel em realizar debug personalizado.
 *
 * @package InepZend
 * @subpackage Util
 */
class Debug
{

    public static $intContadorDebug = 0;
    public static $booShow = true;

    /**
     * Metodo responsavel em exibr informacoes relacionadas a expressao. 
     * Se o segundo parametro for true a execucao e interrompida. 
     * Utiliza o var_export e nao o var_dump.
     *
     * @example \InepZend\Util\Debug::simpleDebug('PHPUnit') <br /> \InepZend\Util\Debug::simpleDebug('PHPUnit', 1) <br /> \InepZend\Util\Debug::simpleDebug('PHPUnit', false, 5)
     *
     * @param mix $mixVar
     * @param boolean $booExit
     * @param integer $intBacktrace
     * @return string
     *
     * @TODO nao retorna a linha que chamou o metodo
     */
    public static function simpleDebug($mixVar, $booExit = false, $intBacktrace = 0)
    {
        return self::debug($mixVar, $booExit, null, true, $intBacktrace);
    }

    /**
     * Metodo responsavel em exibr informacoes relacionadas a expressao. Se o 
     * segundo parametro for true a execucao e interrompida.
     *
     * @example \InepZend\Util\Debug::debug('PHPUnit') <br /> \InepZend\Util\Debug::debug('PHPUnit', 1) <br /> \InepZend\Util\Debug::debug('PHPUnit', 1 , true) <br /> \InepZend\Util\Debug::debug('PHPUnit', 1 , false) <br /> \InepZend\Util\Debug::debug('PHPUnit', 1, true, false, 5)
     *
     * @param mix $mixVar
     * @param boolean $booExit
     * @param boolean $booStartCount
     * @param boolean $booVarExport
     * @param integer $intBacktrace
     * @return string
     */
    public static function debug($mixVar, $booExit = false, $booStartCount = null, $booVarExport = false, $intBacktrace = 0)
    {
        if ((!is_null($booStartCount)) && ($booStartCount))
            self::startCount();
        $strMessage = self::getDebugMessage(debug_backtrace(), $intBacktrace, $mixVar, $booStartCount, $booVarExport, false, false);
        self::showContent($strMessage);
        if ($booExit) {
            self::showContent('<br /><font color="#700000" size="4"><b>D I E</b></font>');
            die();
        }
        return $strMessage;
    }

    /**
     * Metodo responsavel em escrever informacoes de debug em um arquivo. 
     * Util para debug em WebServices.
     *
     * @example \InepZend\Util\Debug::debugWS('PHPUnit') <br /> \InepZend\Util\Debug::debugWS('PHPUnit', 1) <br /> \InepZend\Util\Debug::debugWS('PHPUnit', 1, true) <br /> \InepZend\Util\Debug::debugWS('PHPUnit', 1 , true, true) <br /> \InepZend\Util\Debug::debugWS('PHPUnit', 1 , true, true, 'data\teste\debug.html') <br /> \InepZend\Util\Debug::debugWS('PHPUnit', 1 , true, true, 'data\teste\debug.html', 5)
     *
     * @param mix $mixVar
     * @param boolean $booExit
     * @param boolean $booClear
     * @param boolean $booStartCount
     * @param string $strPathFile
     * @param integer $intBacktrace
     * @param boolean $booVarExport
     * @param boolean $booHtmlEntities
     * @return void
     */
    public static function debugWS($mixVar, $booExit = false, $booClear = false, $booStartCount = null, $strPathFile = null, $intBacktrace = 0, $booVarExport = true, $booHtmlEntities = true)
    {
        if ((!is_null($booStartCount)) && ($booStartCount))
            self::startCount();
        if (empty($strPathFile))
            $strPathFile = \InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../public/debug.htm');
        $strMessage = self::getDebugMessage(debug_backtrace(), $intBacktrace, $mixVar, $booStartCount, $booVarExport, $booHtmlEntities, true);
        if ($booExit)
            $strMessage .= '<br /><font color="#700000" size="4"><b>D I E</b></font>';
        $strMode = ($booClear) ? 'w+' : 'a+';
        if ($resFile = fopen($strPathFile, $strMode)) {
            fwrite($resFile, $strMessage);
            fclose($resFile);
        }
//        static $resFile;
//        if ($booClear) {
//            if (isset($resFile))
//                fclose($resFile);
//            $resFile = fopen($strPathFile, 'w+');
//        }
//        if (!isset($resFile))
//            $resFile = fopen($strPathFile, 'a+');
//        fwrite($resFile, $strMessage);
        if ($booExit)
            die();
    }

    /**
     * Metodo responsavel em calcular o tempo de execucao de um determinado 
     * trecho de codigo, setando o momento inicial.
     *
     * @example \InepZend\Util\Debug::startCount() <br /> \InepZend\Util\Debug::startCount(true)
     *
     * @param boolean $booKeep
     * @return void
     */
    public static function startCount($booKeep = false)
    {
        if ($booKeep !== true)
            self::$intContadorDebug = microtime(true);
    }

    /**
     * Metodo responsavel em calcular o tempo de execucao de um determinado 
     * trecho de codigo, calculando o momento atual menos o inicial.
     *
     * @example \InepZend\Util\Debug::finishCount() <br /> \InepZend\Util\Debug::finishCount(true)
     *
     * @param boolean $booExit
     * @param boolean $booShow
     * @return float
     */
    public static function finishCount($booExit = false, $booShow = true)
    {
        $intContadorDebug = self::$intContadorDebug;
        $intContadorFim = microtime(true);
        self::$intContadorDebug = 0;
        $intTotal = $intContadorFim - $intContadorDebug;
        if ($booShow) {
            self::showContent("<fieldset><legend><font color=\"#007000\">Contador</font></legend>
                            <b>Tempo Inicial: </b> " . self::$intContadorDebug . " <br />
                            <b>Tempo Final: </b> $intContadorFim <br />
                            <b>Tempo Total: </b> $intTotal <br />
                    </fieldset>");
        }
        if ($booExit) {
            if ($booShow)
                self::showContent("<br /><font color=\"#700000\" size=\"4\"><b>D I E</b></font>");
            die();
        }
        return $intTotal;
    }

    /**
     * 
     * @param string $mixVar
     * @param string $booVarExport
     * @return mix
     */
    public static function varDumpExport($mixVar = null, $booVarExport = null)
    {
        $strMessage = '';
        if ($booVarExport === true) {
            try {
                $strMessage = var_export($mixVar, true);
            } catch (ExceptionNative $exception) {
                return false;
            }
        } else {
            ob_start();
            var_dump($mixVar);
            $strMessage = ob_get_clean();
        }
        return $strMessage;
    }

    /**
     * Metodo responsavel em definir se os metodos desta classe que "printam" 
     * algum tipo de conteudo terao este comportamento ativo ou inativo.
     *
     * @example \InepZend\Util\Debug::setShow(true) <br /> \InepZend\Util\Debug::setShow(false)
     *
     * @param boolean $booShow
     * @return boolean
     */
    public static function setShow($booShow = true)
    {
        return (self::$booShow = (boolean) $booShow);
    }

    /**
     * Metodo responsavel em informar se os metodos desta classe que "printam" 
     * algum tipo de conteudo terao este comportamento ativo ou inativo.
     *
     * @example \InepZend\Util\Debug::getShow()
     *
     * @return boolean
     */
    public static function getShow()
    {
        return self::$booShow;
    }

    /**
     * Metodo responsavel em "printar" algum tipo de conteudo caso este 
     * comportamento esteja ativo.
     *
     * @example \InepZend\Util\Debug::showContent('teste') <br /> \InepZend\Util\Debug::showContent(123456)
     *
     * @param string $strContent
     * @return boolean
     *
     * @TODO erro referente ao escrever o resultado do debug em arquivo.
     */
    public static function showContent($strContent = null)
    {
        if (self::getShow()) {
            print $strContent;
            return true;
        }
        return false;
    }

    /**
     * 
     * @param string $arrBacktrace
     * @param integer $intBacktrace
     * @param string $mixVar
     * @param string $booStartCount
     * @param string $booVarExport
     * @param string $booHtmlEntities
     * @param string $booSetShow
     * @return string
     */
    public static function getDebugMessage($arrBacktrace = null, $intBacktrace = 0, $mixVar = null, $booStartCount = null, $booVarExport = null, $booHtmlEntities = null, $booSetShow = null)
    {
        $strMessage = '<fieldset><legend><font color="#007000">debug</font></legend><pre style="text-align: left;">';
        if (is_array($arrBacktrace)) {
            if (empty($intBacktrace))
                $intBacktrace = 0;
            if ((array_key_exists($intBacktrace, $arrBacktrace)) && (array_key_exists('file', $arrBacktrace[$intBacktrace])) && (strpos($arrBacktrace[$intBacktrace]['file'], 'FunctionAutoloader.php') !== false) && (strpos($arrBacktrace[$intBacktrace]['file'], 'eval()') !== false))
                $intBacktrace++;
            foreach ($arrBacktrace[$intBacktrace] as $strAttribute => $mixValue) {
                if (($strAttribute != 'class') && ($strAttribute != 'object') && ($strAttribute != 'args')) {
                    if ($strAttribute == 'type')
                        $strMessage .= '<b>' . $strAttribute . '</b> ' . gettype($mixVar) . "\n";
                    else
                        $strMessage .= '<b>' . $strAttribute . '</b> ' . $mixValue . "\n";
                }
            }
        }
        $strVarContent = self::varDumpExport($mixVar, $booVarExport);
        if ($booHtmlEntities === true)
            $strVarContent = htmlentities($strVarContent);
        $strMessage .= '<b>time</b> ' . date('d/m/Y H:i:s') . "\n" . '<hr />' . $strVarContent . '</pre></fieldset>';
        if ((!is_null($booStartCount)) && (!$booStartCount)) {
            ob_start();
            if ($booSetShow === true)
                self::setShow(true);
            self::finishCount();
            $strMessage .= ob_get_clean();
        }
        return $strMessage;
    }

}
