<?php

namespace InepZend\Util;

class Rtf
{

    /**
     * Metodo responsavel em executar o regex para mudar as tag de arquivo rtf.
     *
     * @example \InepZend\Util\Rtf::replaceRegexTagRtf('<%NOMEFRAMEWORK%>', 'InepZend', '<%NOMEFRAMEWORK%>, utiliza o framework Zend 2.');
     *
     * @param string $strTag
     * @param string $strValor
     * @param string $strTexto
     * @return string
     */
    public static function replaceRegexTagRtf($strTag, $strValor, $strTexto)
    {
        $strRegexBarras = '(\\\\([a-zA-Z0-9]*))*(|' . chr(13) . chr(10) . ')'; // Verifica se possui barra(\) + qualquer coisa + varias vezes ou nao + espaço ()
        $strRegexEspecial = '({|}|()|(' . chr(13) . chr(10) . ')|(' . $strRegexBarras . '))*'; // Verifica se comeca com '{' , '}' ou ' ' repetidas
        $strTag = strtolower($strTag);
        $strCaracter = 'abcdefghijklmnopqrstuvwxyz';
        $arrPalavra = array();
        for ($intLetra = 0; $intLetra < strlen($strTag); ++$intLetra)
            $arrPalavra[] = (stripos($strCaracter, $strTag[$intLetra]) === false) ? '(' . $strTag[$intLetra] . ')' : '(' . $strTag[$intLetra] . '|' . strtoupper($strTag[$intLetra]) . ')';
        return preg_replace('/' . implode($strRegexEspecial, $arrPalavra) . '/', $strValor, $strTexto);
    }

    /**
     * Metodo responsavel em reconhecer tags do conteudo de um arquivo RTF e 
     * realiza seus tratamentos de limpeza.
     *
     * @example \InepZend\Util\Rtf::clearTagRtf("\t\n<%NOMESISTEMA%>");
     *
     * @param string $strText
     * @param string $strPrefix
     * @param string $strSufix
     * @return string
     */
    public static function clearTagRtf($strText, $strPrefix = '<%', $strSufix = '%>')
    {
        $booDebug = false;
        if ($booDebug)
            Debug::debug($strText);
        if (empty($strText))
            return $strText;
        if (empty($strPrefix))
            $strPrefix = '<%';
        if (empty($strSufix))
            $strSufix = '%>';
        $strPrefixSufix = $strPrefix . $strSufix;
        $strTextResult = '';
        while ((strpos($strText, $strPrefix) !== false) && (strpos($strText, $strSufix) !== false)) {
            $strTextPart1 = substr($strText, 0, strpos($strText, $strPrefix));
            $strTextPart2 = substr($strText, strpos($strText, $strPrefix), (strpos($strText, $strSufix) - strpos($strText, $strPrefix) + strlen($strSufix)));
            $strTextPart3 = substr($strText, strpos($strText, $strSufix) + strlen($strSufix));
            if ($booDebug)
                Debug::debug($strTextPart1);
            if ($booDebug)
                Debug::debug($strTextPart2);
            $strTextPart2 = self::removeTagRtf($strTextPart2, $strPrefix, $strSufix);
            if ($booDebug)
                Debug::debug($strTextPart2);
            if ($booDebug)
                Debug::debug($strTextPart3);
            $strTextResult .= $strTextPart1 . $strTextPart2;
            $strText = $strTextPart3;
        }
        if (empty($strTextResult))
            $strTextResult = $strText;
        if (!empty($strTextPart3))
            $strTextResult .= $strTextPart3;
        return $strTextResult;
    }

    /**
     * Metodo responsavel em limpar tags do conteudo de um arquivo RTF.
     *
     * @example \InepZend\Util\Rtf::removeTagRtf("<$NOMESISTEMA$>", '<$', '$>');
     *
     * @param string $strText
     * @param string $strPrefix
     * @param string $strSufix
     * @param integer $intDeep
     * @param string $strTextResult
     * @return string
     */
    public static function removeTagRtf($strText, $strPrefix = '<%', $strSufix = '%>', $intDeep = 0, $strTextResult = '')
    {
        $booDebug = false;
        if ($booDebug)
            Debug::debug($strText);
        if (empty($strText))
            return $strText;
        if (empty($strPrefix))
            $strPrefix = '<%';
        if (empty($strSufix))
            $strSufix = '%>';
        if (empty($intDeep))
            $intDeep = 0;
        $strPrefixSufix = $strPrefix . $strSufix;
        $arrAlfabetoMaiusculo = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z', 'K', 'W', 'Y');
        $arrAlfabetoMinusculo = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'x', 'y', 'z', 'k', 'w', 'y');
        $strTextOriginal = $strText;
        $strText = str_replace(array("\n", "\r", "\t", ' ', '{', '}'), '', $strText);
        for ($intKey = 0; $intKey < strlen($strPrefixSufix); ++$intKey)
            $strText = str_replace($strPrefixSufix{$intKey}, '', $strText);
        if ($booDebug)
            Debug::debug($strText);
        if (strpos($strText, '\\') === false) {
            $booMaiusculo = false;
            foreach ($arrAlfabetoMaiusculo as $strAlfabeto) {
                if (strpos($strText, $strAlfabeto) !== false) {
                    $booMaiusculo = true;
                    break;
                }
            }
            if ($booMaiusculo === false)
                return (strpos($strText, $strPrefix) === false) ? ($strPrefix . $strText . $strSufix) : $strText;
            $strTextPart1 = $strTextResult;
            $intCount = 0;
            for ($intKey = 0; $intKey < strlen($strText); ++$intKey) {
                if (in_array($strText{$intKey}, $arrAlfabetoMaiusculo)) {
                    $intCount = $intKey;
                    break;
                }
            }
            $strTextPart1 .= ($intCount != 0) ? substr($strText, $intCount) : $strText;
            if ($booDebug)
                Debug::debug($strTextPart1);
            return (strpos($strTextPart1, $strPrefix) === false) ? ($strPrefix . $strTextPart1 . $strSufix) : $strTextPart1;
        }
        $strTextPart1 = substr($strText, 0, strpos($strText, '\\'));
        $strTextPart2 = substr($strText, strpos($strText, '\\') + 1);
        $booMaiusculo = false;
        foreach ($arrAlfabetoMaiusculo as $strAlfabeto) {
            if (strpos($strTextPart1, $strAlfabeto) !== false) {
                $booMaiusculo = true;
                break;
            }
        }
        if ($booDebug) {
            Debug::debug($strTextPart1);
            if ($intDeep == 15)
                Debug::debug($strTextPart2, 1);
            else
                Debug::debug($strTextPart2);
        }
        if ($booMaiusculo === false) {
            $booMaiusculo = false;
            foreach ($arrAlfabetoMaiusculo as $strAlfabeto) {
                if (strpos($strTextPart2, $strAlfabeto) !== false) {
                    $booMaiusculo = true;
                    break;
                }
            }
            if (($booMaiusculo === false) && (strpos($strTextPart2, '\\') === false))
                return '';
            return self::removeTagRtf($strTextPart2, $strPrefix, $strSufix, ++$intDeep, $strTextResult);
        } else {
            $intCount = 0;
            for ($intKey = 0; $intKey < strlen($strTextPart1); ++$intKey) {
                if (in_array($strTextPart1{$intKey}, $arrAlfabetoMaiusculo)) {
                    $intCount = $intKey;
                    break;
                }
            }
            $strTextPart3 = ($intCount != 0) ? substr($strTextPart1, $intCount) : $strTextPart1;
            if ($booDebug)
                Debug::debug($strTextPart3);
            $intCount = 0;
            for ($intKey = 0; $intKey < strlen($strTextPart3); ++$intKey) {
                if (in_array($strTextPart3{$intKey}, $arrAlfabetoMinusculo)) {
                    $intCount = $intKey;
                    break;
                }
            }
            $strTextPart4 = ($intCount != 0) ? substr($strTextPart3, 0, $intCount) : $strTextPart3;
            if ($booDebug)
                Debug::debug($strTextPart4);
            $strTextPart5 = $strTextResult;
            for ($intKey = 0; $intKey < strlen($strTextPart4); ++$intKey) {
                if (!in_array($strTextPart4{$intKey}, $arrAlfabetoMinusculo))
                    $strTextPart5 .= $strTextPart4{$intKey};
            }
            if ($booDebug)
                Debug::debug($strTextPart5);
            if ((!empty($strTextPart2)) && (strpos($strTextPart2, '\\') !== false)) {
                $booMaiusculo = false;
                foreach ($arrAlfabetoMaiusculo as $strAlfabeto) {
                    if (strpos($strTextPart2, $strAlfabeto) !== false) {
                        $booMaiusculo = true;
                        break;
                    }
                }
                if ($booMaiusculo === true) {
                    $strTextPart5 = self::removeTagRtf($strTextPart2, $strPrefix, $strSufix, ++$intDeep, $strTextPart5);
                    if ($booDebug)
                        Debug::debug($strTextPart5);
                }
            }
            return (strpos($strTextPart5, $strPrefix) === false) ? ($strPrefix . $strTextPart5 . $strSufix) : $strTextPart5;
        }
    }

}
