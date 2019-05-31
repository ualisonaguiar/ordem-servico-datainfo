<?php

namespace InepZend\Util;

use InepZend\Util\String;
use InepZend\Util\Format;

/**
 * Classe responsavel no tratamento das principais diretivas de configuracao do
 * PHP que podem ser alteradas em tempo de execucao (PHP_INI_ALL, PHP_INI_USER, PHP_INI_SYSTEM).
 *
 * @package InepZend
 * @subpackage Util
 */
class PhpIni
{

    const OPERATION_EXACT = 'EXACT';
    const OPERATION_PLUS = 'PLUS';
    const TYPE_METHOD_SET = 'set';
    const TYPE_METHOD_GET = 'get';

    /**
     * Metodo com permissao PHP_INI_ALL que define a quantidade maxima de memoria
     * que um script esta permitido alocar.
     * Isto ajuda a previnir que scripts mal escritos consumam toda memoria disponivel
     * no servidor.
     * Para nao ter limite de memoria, defina esta diretiva para -1.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::allocatesMemory(128, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::allocatesMemory('128M', \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intMegabyte ex.: 34M ou 34
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @assert () === 128
     * @assert (null) === false
     * 
     * @assert (1024) === 1024
     * @assert ('1025M') === 1025
     * @assert ('1026Mb') === 1026
     * 
     * @assert (1027, \InepZend\Util\PhpIni::OPERATION_EXACT) === 1027
     * @assert ('1028M', \InepZend\Util\PhpIni::OPERATION_EXACT) === 1028
     * @assert ('1029Mb', \InepZend\Util\PhpIni::OPERATION_EXACT) === 1029
     * @assert ('1030DefaultUnit', \InepZend\Util\PhpIni::OPERATION_EXACT) === 1030
     *  
     * @assert (1031, \InepZend\Util\PhpIni::OPERATION_PLUS) === 2061
     * @assert ('1032M', \InepZend\Util\PhpIni::OPERATION_PLUS) === 3093
     * @assert ('1033Mb', \InepZend\Util\PhpIni::OPERATION_PLUS) === 4126
     * @assert ('1034DefaultUnit', \InepZend\Util\PhpIni::OPERATION_PLUS) === 5160
     *  
     * @assert (-1) === -1
     * @assert ('-1') === -1
     * @assert ('-1', \InepZend\Util\PhpIni::OPERATION_EXACT) === -1
     * @assert ('-1', \InepZend\Util\PhpIni::OPERATION_PLUS) === -1
     */
    public static function allocatesMemory($intMegabyte = 128, $strOperation = null)
    {
        return self::iniSet('memory_limit', $intMegabyte, $strOperation);
    }

    /**
     * Retorna a quantidade maxima de memoria que um script esta permitido alocar.
     * 
     * @example \InepZend\Util\PhpIni::getMemoryAllocated()
     *
     * @return mix
     * 
     * @assert () === -1
     */
    public static function getMemoryAllocated()
    {
        return self::iniGet('memory_limit', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o tempo maximo em segundos que
     * eh permitido para executar antes de ser finalizado pelo interpretador.
     * Isso ajuda a evitar que scripts mal escritos de prender o servidor. 
     * Para nao ter limite de tempo, defina esta diretiva para 0.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::setTimeLimit(60, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setTimeLimit(40, \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intSecond
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @assert () === 60
     * @assert (null) === false
     * 
     * @assert (60) === 60
     * @assert (61, \InepZend\Util\PhpIni::OPERATION_EXACT) === 61
     * @assert (62, \InepZend\Util\PhpIni::OPERATION_PLUS) === 123
     * 
     * @assert (0) === 0
     * @assert (0, \InepZend\Util\PhpIni::OPERATION_EXACT) === 0
     * @assert (0, \InepZend\Util\PhpIni::OPERATION_PLUS) === 0
     */
    public static function setTimeLimit($intSecond = 60, $strOperation = null)
    {
        return self::iniSet('max_execution_time', $intSecond, $strOperation);
    }

    /**
     * Retorna o tempo maximo em segundos que eh permitido para executar antes de
     * ser finalizado pelo interpretador.
     * 
     * @example \InepZend\Util\PhpIni::getTimeLimit()
     *
     * @return mix
     * 
     * @assert () === 0
     */
    public static function getTimeLimit()
    {
        return self::iniGet('max_execution_time', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que permite o uso de URL em funcoes como
     * include, include_once, require, require_once.
     * 
     * @example \InepZend\Util\PhpIni::setAllowUrlInclude(true) <br /> \InepZend\Util\PhpIni::setAllowUrlInclude(false)
     *
     * @param boolean $booAllow
     * @return mix
     * 
     * @assert () === false
     * @assert (null) === false
     * @assert (false) === false
     * @TODO assert (true) === true
     */
    public static function setAllowUrlInclude($booAllow = false)
    {
        return self::iniSet('allow_url_include', (integer) $booAllow);
    }

    /**
     * Retorna a permissao do uso de URL em funcoes como include, include_once, 
     * require, require_once.
     * 
     * @example \InepZend\Util\PhpIni::getAllowUrlInclude()
     *
     * @return mix
     * 
     * @assert () === false
     */
    public static function getAllowUrlInclude()
    {
        return self::iniGet('allow_url_include', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a latitude padrao do sistema.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::setDateDefaultLatitude(32.7667, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setDateDefaultLatitude(1.0000, \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param float $floLatitude
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @assert () === 0.0
     * @assert (null) === false
     * @assert (32.0000) === 32.0000
     * @assert (35.0000, \InepZend\Util\PhpIni::OPERATION_EXACT) === 35.0
     * @assert (1.0000, \InepZend\Util\PhpIni::OPERATION_PLUS) === 36.0
     */
    public static function setDateDefaultLatitude($floLatitude = 0.0000, $strOperation = null)
    {
        return self::iniSet('date.default_latitude', $floLatitude, $strOperation);
    }

    /**
     * Retorna a latitude padrao do sistema.
     * 
     * @example \InepZend\Util\PhpIni::getDateDefaultLatitude()
     *
     * @return mix
     * 
     * @assert () === 36.0
     */
    public static function getDateDefaultLatitude()
    {
        return self::iniGet('date.default_latitude', 'float');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a longitude padrao do sistema.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::setDateDefaultLongitude(36.2333, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setDateDefaultLongitude(1.0000, \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param float $floLongitude
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @assert () === 0.0
     * @assert (null) === false
     * @assert (36.0000) === 36.0000
     * @assert (39.0000, \InepZend\Util\PhpIni::OPERATION_EXACT) === 39.0
     * @assert (1.0000, \InepZend\Util\PhpIni::OPERATION_PLUS) === 40.0
     */
    public static function setDateDefaultLongitude($floLongitude = 0.0000, $strOperation = null)
    {
        return self::iniSet('date.default_longitude', $floLongitude, $strOperation);
    }

    /**
     * Retorna a longitude padrao do sistema.
     * 
     * @example \InepZend\Util\PhpIni::getDateDefaultLongitude()
     *
     * @return mix
     * 
     * @assert () === 40.0
     */
    public static function getDateDefaultLongitude()
    {
        return self::iniGet('date.default_longitude', 'float');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a zona horaria padrao usada por
     * todas as funcoes de data/hora.
     * 
     * @example \InepZend\Util\PhpIni::setDateTimezone('America/Sao_Paulo')
     *
     * @param string $strTimezone
     * @return mix
     * 
     * @TODO assert () === ''
     * @TODO assert (null) === null
     * @TODO assert ('') === ''
     * @TODO assert ('America/Sao_Paulo') === 'America/Sao_Paulo'
     */
    public static function setDateTimezone($strTimezone = '')
    {
        return self::iniSet('date.timezone', $strTimezone);
    }

    /**
     * Retorna a zona horaria padrao usada por todas as funcoes de data/hora.
     * 
     * @example \InepZend\Util\PhpIni::getDateTimezone()
     *
     * @return mix
     * 
     * @TODO assert () === 'America/Sao_Paulo'
     */
    public static function getDateTimezone()
    {
        return self::iniGet('date.timezone', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que envia uma codificacao de caracteres
     * por padrao no Content-type: header. 
     * Para nao ter o envio do codigo, defina esta diretiva para vazio.
     * 
     * @example \InepZend\Util\PhpIni::setDefaultCharset('UTF-8') <br /> \InepZend\Util\PhpIni::setDefaultCharset('')
     *
     * @param string $strCharset
     * @return mix
     * 
     * @assert () === 'UTF-8'
     * @assert (null) === false
     * @assert ('UTF-8') === 'UTF-8'
     * @assert ('') === false
     */
    public static function setDefaultCharset($strCharset = 'UTF-8')
    {
        return self::iniSet('default_charset', $strCharset);
    }

    /**
     * Retorna a codificacao de caracteres por padrao no Content-type: header.
     * 
     * @example \InepZend\Util\PhpIni::getDefaultCharset()
     *
     * @return mix
     * 
     * @assert () === 'UTF-8'
     */
    public static function getDefaultCharset()
    {
        return self::iniGet('default_charset', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o padrao de classificacao dos
     * tipos de arquivos na Internet.
     * 
     * @example \InepZend\Util\PhpIni::setDefaultMimetype('text/html') <br /> \InepZend\Util\PhpIni::setDefaultMimetype('text/plain') <br /> \InepZend\Util\PhpIni::setDefaultMimetype('image/gif')
     *
     * @param string $strMimetype
     * @return mix
     * 
     * @assert () === false
     * @assert (null) === false
     * @assert ('text/html') === false
     * @assert ('text/plain') === 'text/plain'
     */
    public static function setDefaultMimetype($strMimetype = 'text/html')
    {
        return self::iniSet('default_mimetype', $strMimetype);
    }

    /**
     * Retorna o padrao de classificacao dos tipos de arquivos na Internet.
     * 
     * @example \InepZend\Util\PhpIni::getDefaultMimetype()
     *
     * @return mix
     * 
     * @assert () === 'text/plain'
     */
    public static function getDefaultMimetype()
    {
        return self::iniGet('default_mimetype', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o timeout padrao (em segundos)
     * para streams baseados em socket.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::setDefaultSocketTimeout(60, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setDefaultSocketTimeout(10, \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intSecond
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @assert () === 60
     * @assert (null) === false
     * @assert (70) === 70
     * @assert (75, \InepZend\Util\PhpIni::OPERATION_EXACT) === 75
     * @assert (1, \InepZend\Util\PhpIni::OPERATION_PLUS) === 76
     */
    public static function setDefaultSocketTimeout($intSecond = 60, $strOperation = null)
    {
        return self::iniSet('default_socket_timeout', $intSecond, $strOperation);
    }

    /**
     * Retorna o timeout padrao (em segundos) para streams baseados em socket.
     * 
     * @example \InepZend\Util\PhpIni::getDefaultSocketTimeout()
     *
     * @return mix
     * 
     * @assert () === 76
     */
    public static function getDefaultSocketTimeout()
    {
        return self::iniGet('default_socket_timeout', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que determina se os erros devem ser
     * impressos na tela como parte da saida ou se devem ser escondidos do usuario.
     * Valor "stderr" envia os erros para stderr em vez de stdout. 
     * Em versões anteriores a 5.2.4, esta diretiva era do tipo boolean.
     * 
     * @example \InepZend\Util\PhpIni::setDisplayErrors(1) <br /> \InepZend\Util\PhpIni::setDisplayErrors(0) <br /> \InepZend\Util\PhpIni::setDisplayErrors('stderr')
     *
     * @param mix $mixDisplay
     * @return mix
     * 
     * @assert () === '1'
     * @assert (null) === false
     * @assert (1) === '1'
     * @assert (true) === '1'
     * @assert (0) === '0'
     * @assert (false) === ''
     * @assert ('stderr') === 'stderr'
     */
    public static function setDisplayErrors($mixDisplay = 1)
    {
        return self::iniSet('display_errors', $mixDisplay);
    }

    /**
     * Retorna a determinacao se os erros devem ser impressos na tela como parte
     * da saida ou se devem ser escondidos do usuario.
     * 
     * @example \InepZend\Util\PhpIni::getDisplayErrors()
     *
     * @return mix
     * 
     * @assert () === '0'
     */
    public static function getDisplayErrors()
    {
        return self::iniGet('display_errors');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define se os erros que ocorrem durante
     * a inicializacao do PHP serao mostrados mesmo quando display_errors esta ligado.
     * Eh fortemente recomendado manter display_startup_errors off, exceto para debug.
     * 
     * @example \InepZend\Util\PhpIni::setDisplayStartupErrors(false) <br /> \InepZend\Util\PhpIni::setDisplayStartupErrors(true)
     *
     * @param boolean $booDisplay
     * @return mix
     * 
     * @assert () === false
     * @assert (null) === false
     * @assert (false) === false
     * @assert (true) === true
     */
    public static function setDisplayStartupErrors($booDisplay = false)
    {
        return self::iniSet('display_startup_errors', (integer) $booDisplay);
    }

    /**
     * Retorna a definicao se os erros que ocorrem durante a inicializacao do PHP
     * serao mostrados mesmo quando display_errors esta ligado.
     * 
     * @example \InepZend\Util\PhpIni::getDisplayStartupErrors()
     *
     * @return mix
     * 
     * @assert () === false
     */
    public static function getDisplayStartupErrors()
    {
        return self::iniGet('display_startup_errors', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define uma string para saida apos uma
     * mensagem de erro.
     * 
     * @example \InepZend\Util\PhpIni::setErrorAppendString('End')
     *
     * @param string $strErrorAppend
     * @return mix
     * 
     * @assert () === ''
     * @assert (null) === ''
     * @assert ('') === ''
     * @assert ('End') === 'End'
     */
    public static function setErrorAppendString($strErrorAppend = null)
    {
        return self::iniSet('error_append_string', $strErrorAppend);
    }

    /**
     * Retorna a definicao da string para saida apos uma mensagem de erro.
     * 
     * @example \InepZend\Util\PhpIni::getErrorAppendString()
     *
     * @return mix
     * 
     * @assert () === 'End'
     */
    public static function getErrorAppendString()
    {
        return self::iniGet('error_append_string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nome do arquivo onde os erros
     * do script serao logados. 
     * Se o valor especial syslog eh usado, os erros sao enviados para o log do
     * sistema.
     * 
     * @example \InepZend\Util\PhpIni::setErrorLog('error') <br /> \InepZend\Util\PhpIni::setErrorLog('syslog')
     *
     * @param string $strErrorLog
     * @return mix
     * 
     * @TODO assert () === false
     * @TODO assert (null) === false
     * @assert ('error') === 'error'
     * @assert ('syslog') === 'syslog'
     */
    public static function setErrorLog($strErrorLog = null)
    {
        return self::iniSet('error_log', $strErrorLog);
    }

    /**
     * Retorna a definicao do nome do arquivo onde os erros do script serao logados.
     * 
     * @example \InepZend\Util\PhpIni::getErrorLog()
     *
     * @return mix
     * 
     * @assert () === 'syslog'
     */
    public static function getErrorLog()
    {
        return self::iniGet('error_log');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define uma string para saida antes de uma
     * mensagem de erro.
     * 
     * @example \InepZend\Util\PhpIni::setErrorPrependString('Error: ')
     *
     * @param string $strErrorPrepend
     * @return mix
     * 
     * @assert () === ''
     * @assert (null) === ''
     * @assert ('') === ''
     * @assert ('Error: ') === 'Error: '
     */
    public static function setErrorPrependString($strErrorPrepend = null)
    {
        return self::iniSet('error_prepend_string', $strErrorPrepend);
    }

    /**
     * Retorna a definicao da string para saida antes de uma mensagem de erro.
     * 
     * @example \InepZend\Util\PhpIni::getErrorPrependString()
     *
     * @return mix
     * 
     * @assert () === 'Error: '
     */
    public static function getErrorPrependString()
    {
        return self::iniGet('error_prepend_string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nivel de relatorio de erros.
     * O parametro eh um inteiro que representa um campo de bits, ou uma constante.
     * Para definir em tempo de execucao, use a funcao error_reporting().
     * 
     * @example \InepZend\Util\PhpIni::setErrorReporting(E_ALL) <br /> \InepZend\Util\PhpIni::setErrorReporting(E_ALL & ~E_NOTICE) <br /> \InepZend\Util\PhpIni::setErrorReporting(E_ALL | E_STRICT)
     *
     * @param string $intErrorReporting
     * @return mix
     * 
     * @TODO assert () === false
     * @TODO assert (null) === false
     * @TODO assert (E_ALL) === E_ALL
     * @TODO assert (E_ALL & ~E_NOTICE) === false
     * @TODO assert (E_ALL | E_STRICT) === E_ALL | E_STRICT
     */
    public static function setErrorReporting($intErrorReporting = null)
    {
        return self::iniSet('error_reporting', $intErrorReporting);
    }

    /**
     * Retorna a definicao do nivel de relatorio de erros.
     * 
     * @example \InepZend\Util\PhpIni::getErrorReporting()
     *
     * @return mix
     * 
     * @TODO assert () === E_ALL | E_STRICT
     */
    public static function getErrorReporting()
    {
        return self::iniGet('error_reporting', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_SYSTEM que define se deve ou nao permitir o
     * upload de arquivos HTTP.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     * 
     * @example \InepZend\Util\PhpIni::setFileUploads(true) <br /> \InepZend\Util\PhpIni::setFileUploads(false)
     *
     * @param boolean $booEnable
     * @return mix
     * 
     * @assert () === true
     * @assert (null) === true
     * @assert (true) === true
     * @TODO assert (false) === false
     */
    public static function setFileUploads($booEnable = true)
    {
        return self::iniSet('file_uploads', (integer) $booEnable);
    }

    /**
     * Retorna a definicao se deve ou nao permitir o upload de arquivos HTTP.
     * 
     * @example \InepZend\Util\PhpIni::getFileUploads()
     *
     * @return mix
     * 
     * @assert () === true
     */
    public static function getFileUploads()
    {
        return self::iniGet('file_uploads', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o endereco de e-mail do remetente.
     * 
     * @example \InepZend\Util\PhpIni::setFrom('test')
     *
     * @param string $strFrom
     * @return mix
     * 
     * @assert () === ''
     * @assert ('') === ''
     * @assert ('test') === 'test'
     */
    public static function setFrom($strFrom = '')
    {
        return self::iniSet('from', $strFrom);
    }

    /**
     * Retorna a definicao do endereco de e-mail do remetente.
     * 
     * @example \InepZend\Util\PhpIni::getFrom()
     *
     * @return mix
     * 
     * @assert () === 'test'
     */
    public static function getFrom()
    {
        return self::iniGet('from', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que desliga tags HTML em mensagens de erro.
     * O novo formato de erro em HTML produz mensagens clicaveis ​​que direcionam
     * o usuario para uma pagina descrevendo o erro ou a funcao que causou o erro.
     * Essas referencias sao afetados por docref_root e docref_ext.
     * 
     * @example \InepZend\Util\PhpIni::setHtmlErrors(true) <br /> \InepZend\Util\PhpIni::setHtmlErrors(false)
     *
     * @param boolean $booEnable
     * @return mix
     * 
     * @assert () === true
     * @assert (null) === false
     * @assert (true) === true
     * @assert (false) === false
     */
    public static function setHtmlErrors($booEnable = true)
    {
        return self::iniSet('html_errors', (integer) $booEnable);
    }

    /**
     * Retorna a identificacao se as tags HTML em mensagens de erro estao desligadas.
     * 
     * @example \InepZend\Util\PhpIni::getHtmlErrors()
     *
     * @return mix
     * 
     * @assert () === true
     */
    public static function getHtmlErrors()
    {
        return self::iniGet('html_errors', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que nao loga mensagens repetidas.
     * Erros repetidos devem acontecer no mesmo arquivo na mesma linha enquanto
     * ignore_repeated_source estiver ativo.
     * 
     * @example \InepZend\Util\PhpIni::setIgnoreRepeatedErrors(true) <br /> \InepZend\Util\PhpIni::setIgnoreRepeatedErrors(false)
     *
     * @param boolean $booIgnore
     * @return mix
     * 
     * @assert () === false
     * @assert (null) === false
     * @assert (false) === false
     * @assert (true) === true
     */
    public static function setIgnoreRepeatedErrors($booIgnore = false)
    {
        return self::iniSet('ignore_repeated_errors', (integer) $booIgnore);
    }

    /**
     * Retorna a identificacao se nao loga mensagens repetidas.
     * 
     * @example \InepZend\Util\PhpIni::getIgnoreRepeatedErrors()
     *
     * @return mix
     * 
     * @assert () === false
     */
    public static function getIgnoreRepeatedErrors()
    {
        return self::iniGet('ignore_repeated_errors', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que ignora a fonte da mensagem quando estiver
     * ignorando mensagens repetidas.
     * Quando esta diretiva estiver ativa, nao ira registrar erros com mensagens
     * repetidas de arquivos diferentes ou linhas.
     * 
     * @example \InepZend\Util\PhpIni::setIgnoreRepeatedSource(false) <br /> \InepZend\Util\PhpIni::setIgnoreRepeatedSource(true)
     *
     * @param boolean $booIgnore
     * @return mix
     * 
     * @assert () === false
     * @assert (null) === false
     * @assert (false) === false
     * @assert (true) === true
     */
    public static function setIgnoreRepeatedSource($booIgnore = false)
    {
        return self::iniSet('ignore_repeated_source', (integer) $booIgnore);
    }

    /**
     * Retorna a identificacao se ignora a fonte da mensagem quando estiver ignorando
     * mensagens repetidas.
     * 
     * @example \InepZend\Util\PhpIni::getIgnoreRepeatedSource()
     *
     * @return mix
     * 
     * @assert () === true
     */
    public static function getIgnoreRepeatedSource()
    {
        return self::iniGet('ignore_repeated_source', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que termina os scripts assim que o cliente
     * abortar sua conexao.
     * 
     * @example \InepZend\Util\PhpIni::setIgnoreUserAbort(false) <br /> \InepZend\Util\PhpIni::setIgnoreUserAbort(true)
     *
     * @param boolean $booIgnore
     * @return mix
     * 
     * @assert () === false
     * @assert (null) === false
     * @assert (false) === false
     * @assert (true) === true
     */
    public static function setIgnoreUserAbort($booIgnore = false)
    {
        return self::iniSet('ignore_user_abort', (integer) $booIgnore);
    }

    /**
     * Retorna a identificacao se termina os scripts assim que o cliente abortar
     * sua conexao.
     * 
     * @example \InepZend\Util\PhpIni::getIgnoreUserAbort()
     *
     * @return mix
     * 
     * @assert () === false
     */
    public static function getIgnoreUserAbort()
    {
        return self::iniGet('ignore_user_abort', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o descarregamento automatico
     * a cada bloco de saida. 
     * Isto eh equivalente a utilizar a funcao do PHP flush() a cada print ou echo
     * e a cada bloco de HTML. 
     * Quando estiver usando o PHP em um ambiente web, ativando esta opcao tem uma
     * seria implicacao na performance e geralmente eh recomendada apenas para debug.
     * 
     * @example \InepZend\Util\PhpIni::setImplicitFlush(false) <br /> \InepZend\Util\PhpIni::setImplicitFlush(true)
     *
     * @param boolean $booEnable
     * @return mix
     * 
     * @assert () === false
     * @assert (null) === false
     * @assert (false) === false
     * @assert (true) === true
     */
    public static function setImplicitFlush($booEnable = false)
    {
        return self::iniSet('implicit_flush', (integer) $booEnable);
    }

    /**
     * Retorna a definicao do descarregamento automatico a cada bloco de saida.
     * 
     * @example \InepZend\Util\PhpIni::getImplicitFlush()
     *
     * @return mix
     * 
     * @assert () === false
     */
    public static function getImplicitFlush()
    {
        return self::iniGet('implicit_flush', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica uma lista de diretorios que
     * podem ser utilizados por funcoes que procuram por arquivos, como fopen(),
     * file(), readfile() e file_get_contents().
     * A lista de diretorios eh uma string separada por dois pontos no Unix ou ponto
     * e virgula no Windows (usar a constante PATH_SEPARATOR).
     * A ordem das partes influencia na procura dos arquivos.
     * 
     * @example \InepZend\Util\PhpIni::setIncludePath('.;') <br /> \InepZend\Util\PhpIni::setIncludePath('.;c:\;')
     *
     * @param string $strPath
     * @return mix
     * 
     * @assert () === '\\'
     * @assert (null) === false
     * @assert ('\\') === '\\'
     * @assert ('\\;c:\;') === '\\;c:\;'
     */
    public static function setIncludePath($strPath = '\\')
    {
        return self::iniSet('include_path', $strPath);
    }

    /**
     * Retorna uma lista de diretorios que podem ser utilizados por funcoes que
     * procuram por arquivos, como fopen(), file(), readfile() e file_get_contents().
     * 
     * @example \InepZend\Util\PhpIni::getIncludePath()
     *
     * @return mix
     * 
     * @assert () === '\\;c:\;'
     */
    public static function getIncludePath()
    {
        return self::iniGet('include_path', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que indica se as mensagens de erro devem
     * ser registradas no log de erro do servidor ou error_log.
     * 
     * @example \InepZend\Util\PhpIni::setLogErrors(false) <br /> \InepZend\Util\PhpIni::setLogErrors(true)
     *
     * @param boolean $booEnable
     * @return mix
     * 
     * @assert () === false
     * @assert (null) === false
     * @assert (false) === false
     * @assert (true) === true
     */
    public static function setLogErrors($booEnable = false)
    {
        return self::iniSet('log_errors', (integer) $booEnable);
    }

    /**
     * Retorna a indicacao se as mensagens de erro devem ser registradas no log
     * de erro do servidor ou error_log.
     * 
     * @example \InepZend\Util\PhpIni::getLogErrors()
     *
     * @return mix
     * 
     * @assert () === false
     */
    public static function getLogErrors()
    {
        return self::iniGet('log_errors', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o comprimento maximo de log_errors
     * em bytes.
     * Para nao ter o comprimento maximo de log_errors, defina esta diretiva para
     * zero.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::setLogErrorsMaxLen(1024, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setLogErrorsMaxLen(10, \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intLength
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @assert () === 1024
     * @assert (null) === false
     * @assert (1024) === 1024
     * @assert (1024, \InepZend\Util\PhpIni::OPERATION_EXACT) === 1024
     * @assert (10, \InepZend\Util\PhpIni::OPERATION_PLUS) === 1034
     * @assert (0) === 0
     */
    public static function setLogErrorsMaxLen($intLength = 1024, $strOperation = null)
    {
        return self::iniSet('log_errors_max_len', $intLength, $strOperation);
    }

    /**
     * Retorna a definicao do comprimento maximo de log_errors em bytes.
     * 
     * @example \InepZend\Util\PhpIni::getLogErrorsMaxLen()
     *
     * @return mix
     * 
     * @assert () === 1034
     */
    public static function getLogErrorsMaxLen()
    {
        return self::iniGet('log_errors_max_len', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o tempo maximo em segundos
     * que eh permitido para executar antes de ser finalizado pelo interpretador.
     * Isso ajuda a evitar que scripts mal escritos de prender o servidor. 
     * Para nao ter limite de tempo, defina esta diretiva para 0.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::setMaxExecutionTime(30, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setMaxExecutionTime(40, \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intSecond
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @assert () === 30
     * @assert (null) === false
     * 
     * @assert (60) === 60
     * @assert (61, \InepZend\Util\PhpIni::OPERATION_EXACT) === 61
     * @assert (62, \InepZend\Util\PhpIni::OPERATION_PLUS) === 123
     * 
     * @assert (0) === 0
     * @assert (0, \InepZend\Util\PhpIni::OPERATION_EXACT) === 0
     * @assert (0, \InepZend\Util\PhpIni::OPERATION_PLUS) === 0
     */
    public static function setMaxExecutionTime($intSecond = 30, $strOperation = null)
    {
        return self::setTimeLimit($intSecond, $strOperation);
    }

    /**
     * Retorna o tempo maximo em segundos que eh permitido para executar antes de
     * ser finalizado pelo interpretador.
     * 
     * @example \InepZend\Util\PhpIni::getMaxExecutionTime()
     *
     * @return mix
     * 
     * @assert () === 0
     */
    public static function getMaxExecutionTime()
    {
        return self::getTimeLimit();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que deixa os erros do memcached transparentes
     * a outros servidores.
     * 
     * @example \InepZend\Util\PhpIni::setMemcacheAllowFailover(true) <br /> \InepZend\Util\PhpIni::setMemcacheAllowFailover(false)
     *
     * @param boolean $booAllow
     * @return mix
     * 
     * @assert () === true
     * @assert (null) === false
     * @assert (true) === true
     * @assert (false) === false
     */
    public static function setMemcacheAllowFailover($booAllow = true)
    {
        return self::iniSet('memcache.allow_failover', (integer) $booAllow);
    }

    /**
     * Retorna a definicao que deixa os erros do memcached transparentes a outros
     * servidores.
     * 
     * @example \InepZend\Util\PhpIni::getMemcacheAllowFailover()
     *
     * @return mix
     * 
     * @assert () === true
     */
    public static function getMemcacheAllowFailover()
    {
        return self::iniGet('memcache.allow_failover', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o tamanho dos blocos a serem
     * transferidos pelo memcached.
     * A definicao de valor mais baixo requer mais rede.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::setMemcacheChunkSize(33000, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setMemcacheChunkSize(24576, \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intSize
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @assert () === 33000
     * @assert (null) === false
     * @assert (33500) === 33500
     * @assert (34000, \InepZend\Util\PhpIni::OPERATION_EXACT) === 34000
     * @assert (24576, \InepZend\Util\PhpIni::OPERATION_PLUS) === 58576
     */
    public static function setMemcacheChunkSize($intSize = 33000, $strOperation = null)
    {
        return self::iniSet('memcache.chunk_size', $intSize, $strOperation);
    }

    /**
     * Retorna o tamanho dos blocos a serem transferidos pelo memcached.
     * 
     * @example \InepZend\Util\PhpIni::getMemcacheChunkSize()
     *
     * @return mix
     * 
     * @assert () === 58576
     */
    public static function getMemcacheChunkSize()
    {
        return self::iniGet('memcache.chunk_size', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a porta TCP padrao para conectar
     * ao servidor de memcached se nenhuma outra porta for especificada.
     * 
     * @example \InepZend\Util\PhpIni::setMemcacheDefaultPort(11211)
     *
     * @param integer $intPort
     * @return mix
     * 
     * @assert () === 11211
     * @assert (null) === false
     * @assert (11211) === 11211
     */
    public static function setMemcacheDefaultPort($intPort = 11211)
    {
        return self::iniSet('memcache.default_port', $intPort);
    }

    /**
     * Retorna a porta TCP padrao para conectar ao servidor de memcached se nenhuma
     * outra porta for especificada.
     * 
     * @example \InepZend\Util\PhpIni::getMemcacheDefaultPort()
     *
     * @return mix
     * 
     * @assert () === 11211
     */
    public static function getMemcacheDefaultPort()
    {
        return self::iniGet('memcache.default_port', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que controla qual funcao hash deve ser aplicada
     * ao mapear chaves em servidores de memcached.
     * 
     * @example \InepZend\Util\PhpIni::setMemcacheHashFunction('crc32')
     *
     * @param string $strFunction
     * @return mix
     * 
     * @assert () === 'crc32'
     * @assert (null) === false
     * @assert ('crc32') === 'crc32'
     */
    public static function setMemcacheHashFunction($strFunction = 'crc32')
    {
        return self::iniSet('memcache.hash_function', $strFunction);
    }

    /**
     * Retorna qual funcao hash deve ser aplicada ao mapear chaves em servidores
     * de memcached.
     * 
     * @example \InepZend\Util\PhpIni::getMemcacheHashFunction()
     *
     * @return mix
     * 
     * @assert () === 'crc32'
     */
    public static function getMemcacheHashFunction()
    {
        return self::iniGet('memcache.hash_function', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que controla qual estrategia deve ser utilizada
     * ao mapear chaves para servidores de memcached.
     * 
     * @example \InepZend\Util\PhpIni::setMemcacheHashStrategy('standard')
     *
     * @param string $strStrategy
     * @return mix
     * 
     * @assert () === 'standard'
     * @assert (null) === false
     * @assert ('standard') === 'standard'
     */
    public static function setMemcacheHashStrategy($strStrategy = 'standard')
    {
        return self::iniSet('memcache.hash_strategy', $strStrategy);
    }

    /**
     * Retorna qual estrategia deve ser utilizada ao mapear chaves para servidores
     * de memcached.
     * 
     * @example \InepZend\Util\PhpIni::getMemcacheHashStrategy()
     *
     * @return mix
     * 
     * @assert () === 'standard'
     */
    public static function getMemcacheHashStrategy()
    {
        return self::iniGet('memcache.hash_strategy', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define quantos servidores memcached
     * serao utilizados para inserir e extrair dados.
     * Usado apenas em conjunto com memcache.allow_failover.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::setMemcacheMaxFailoverAttempts(128, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setMemcacheMaxFailoverAttempts('128M', \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intAttempt
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @assert () === 20
     * @assert (null) === false
     * @assert (20) === 20
     * @assert (20, \InepZend\Util\PhpIni::OPERATION_EXACT) === 20
     * @assert (5, \InepZend\Util\PhpIni::OPERATION_PLUS) === 25
     */
    public static function setMemcacheMaxFailoverAttempts($intAttempt = 20, $strOperation = null)
    {
        return self::iniSet('memcache.max_failover_attempts', $intAttempt, $strOperation);
    }

    /**
     * Retorna quantos servidores memcached serao utilizados para inserir e extrair
     * dados.
     * 
     * @example \InepZend\Util\PhpIni::getMemcacheMaxFailoverAttempts()
     *
     * @return mix
     * 
     * @assert () === 25
     */
    public static function getMemcacheMaxFailoverAttempts()
    {
        return self::iniGet('memcache.max_failover_attempts', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a quantidade maxima de memoria
     * que um script esta permitido alocar.
     * Isto ajuda a previnir que scripts mal escritos consumam toda memoria disponivel
     * no servidor.
     * Para nao ter limite de memoria, defina esta diretiva para -1.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::setMemoryLimit(128, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setMemoryLimit('128M', \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intMegabyte ex.: 34M ou 34
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @assert () === 128
     * @assert (null) === false
     * 
     * @assert (1024) === 1024
     * @assert ('1025M') === 1025
     * @assert ('1026Mb') === 1026
     * 
     * @assert (1027, \InepZend\Util\PhpIni::OPERATION_EXACT) === 1027
     * @assert ('1028M', \InepZend\Util\PhpIni::OPERATION_EXACT) === 1028
     * @assert ('1029Mb', \InepZend\Util\PhpIni::OPERATION_EXACT) === 1029
     * @assert ('1030DefaultUnit', \InepZend\Util\PhpIni::OPERATION_EXACT) === 1030
     *  
     * @assert (1031, \InepZend\Util\PhpIni::OPERATION_PLUS) === 2061
     * @assert ('1032M', \InepZend\Util\PhpIni::OPERATION_PLUS) === 3093
     * @assert ('1033Mb', \InepZend\Util\PhpIni::OPERATION_PLUS) === 4126
     * @assert ('1034DefaultUnit', \InepZend\Util\PhpIni::OPERATION_PLUS) === 5160
     *  
     * @assert (-1) === -1
     * @assert ('-1') === -1
     * @assert ('-1', \InepZend\Util\PhpIni::OPERATION_EXACT) === -1
     * @assert ('-1', \InepZend\Util\PhpIni::OPERATION_PLUS) === -1
     */
    public static function setMemoryLimit($intMegabyte = 128, $strOperation = null)
    {
        return self::allocatesMemory($intMegabyte, $strOperation);
    }

    /**
     * Retorna a quantidade maxima de memoria que um script esta permitido alocar.
     * 
     * @example \InepZend\Util\PhpIni::getMemoryLimit()
     *
     * @return mix
     * 
     * @assert () === -1
     */
    public static function getMemoryLimit()
    {
        return self::getMemoryAllocated();
    }

    /**
     * Metodo com permissao PHP_INI_ALL que limita os arquivos que podem ser abertos
     * pelo PHP para uma lista de diretorios especificados, incluindo o arquivo
     * em si.
     * A lista de diretorios eh uma string separada por dois pontos no Unix ou ponto
     * e virgula no Windows (usar a constante PATH_SEPARATOR).
     * A ordem das partes influencia na procura dos arquivos.
     * 
     * @example \InepZend\Util\PhpIni::setOpenBasedir('/www/') <br /> \InepZend\Util\PhpIni::setOpenBasedir('/www/;/dir/include;')
     *
     * @param string $strBasedir
     * @return mix
     * 
     * @assert () === ''
     * @assert (null) === ''
     * @TODO assert ('/www/') === '/www/'
     * @TODO assert ('/www/;/dir/include;') === '/www/;/dir/include;'
     */
    public static function setOpenBasedir($strBasedir = null)
    {
        return self::iniSet('open_basedir', $strBasedir);
    }

    /**
     * Retorna uma lista de diretorios especificados, incluindo o arquivo em si,
     * que limita os arquivos que podem ser abertos pelo PHP.
     * 
     * @example \InepZend\Util\PhpIni::getOpenBasedir()
     *
     * @return mix
     * 
     * @assert () === ''
     */
    public static function getOpenBasedir()
    {
        return self::iniGet('open_basedir');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define uma lista de arquivos phar para
     * a localizacao de seus arquivos PHP extraidos.
     * O formato do parametro eh alias=pharFile, alias2=pharFile2.
     * Isso geralmente eh feito por motivos de desempenho, ou para ajudar na depuracao
     * de um phar.
     * 
     * @example \InepZend\Util\PhpIni::setPharExtractList('') <br /> \InepZend\Util\PhpIni::setPharExtractList('archive=/full/path/to/archive/,arch2=/full/path/to/arch2')
     *
     * @param string $strExtractList
     * @return mix
     * 
     * @assert () === ''
     * @assert (null) === ''
     * @assert ('') === ''
     * @TODO assert ('archive=/full/path/to/archive/') === 'archive=/full/path/to/archive/'
     * @TODO assert ('archive=/full/path/to/archive/,arch2=/full/path/to/arch2') === 'archive=/full/path/to/archive/,arch2=/full/path/to/arch2'
     */
    public static function setPharExtractList($strExtractList = '')
    {
        return self::iniSet('phar.extract_list', $strExtractList);
    }

    /**
     * Retorna a definicao da lista de arquivos phar para a localizacao de seus
     * arquivos PHP extraidos.
     * 
     * @example \InepZend\Util\PhpIni::getPharExtractList()
     *
     * @return mix
     * 
     * @assert () === ''
     */
    public static function getPharExtractList()
    {
        return self::iniGet('phar.extract_list', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que desabilita a criacao ou modificacao
     * de arquivos phar utilizando o fluxo de phar ou suporte de gravacao de objeto
     * Phar.
     * 
     * @example \InepZend\Util\PhpIni::setPharReadOnly(true) <br /> \InepZend\Util\PhpIni::setPharReadOnly(false)
     *
     * @param boolean $booEnable
     * @return mix
     * 
     * @assert () === true
     * @TODO assert (null) === false
     * @assert (true) === true
     * @TODO assert (false) === false
     */
    public static function setPharReadOnly($booEnable = true)
    {
        return self::iniSet('phar.readonly', (integer) $booEnable);
    }

    /**
     * Retorna a identificacao se desabilita a criacao ou modificacao de arquivos
     * phar utilizando o fluxo de phar ou suporte de gravacao de objeto Phar.
     * 
     * @example \InepZend\Util\PhpIni::getPharReadOnly()
     *
     * @return mix
     * 
     * @assert () === true
     */
    public static function getPharReadOnly()
    {
        return self::iniGet('phar.readonly', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que forca todos os arquivos phar abertos
     * para conter algum tipo de assinatura (atualmente MD5, SHA1, SHA256 e SHA512
     * sao suportados), e se recusa a processar qualquer arquivo phar que nao contem
     * uma assinatura.
     * 
     * @example \InepZend\Util\PhpIni::setPharRequireHash(true) <br /> \InepZend\Util\PhpIni::setPharRequireHash(false)
     *
     * @param boolean $booEnable
     * @return mix
     * 
     * @assert () === true
     * @assert (null) === true
     * @assert (true) === true
     * @assert (false) === true
     */
    public static function setPharRequireHash($booEnable = true)
    {
        return self::iniSet('phar.require_hash', (integer) $booEnable);
    }

    /**
     * Retorna a identificacao se forca todos os arquivos phar abertos para conter
     * algum tipo de assinatura (atualmente MD5, SHA1, SHA256 e SHA512 sao suportados),
     * e se recusa a processar qualquer arquivo phar que nao contem uma assinatura.
     * 
     * @example \InepZend\Util\PhpIni::getPharRequireHash()
     *
     * @return mix
     * 
     * @assert () === true
     */
    public static function getPharRequireHash()
    {
        return self::iniGet('phar.require_hash', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define o tamanho maximo dos dados
     * postados.
     * Essa configuracao tambem afeta o upload de arquivos. Para enviar arquivos
     * grandes, esse valor deve ser maior que upload_max_filesize.
     * Se o limite de memoria eh ativada por seu script de configuracao, memory_limit
     * tambem afeta o upload de arquivos. 
     * De um modo geral, memory_limit deve ser maior que post_max_size.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     * 
     * @example \InepZend\Util\PhpIni::setPostMaxSize(8, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setPostMaxSize(12, \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intMegabyte
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @TODO assert () === 8
     * @TODO assert (null) === false
     * @TODO assert (0) === 0
     * @TODO assert (8) === 8
     * @TODO assert (8, \InepZend\Util\PhpIni::OPERATION_EXACT) === 8
     * @TODO assert (12, \InepZend\Util\PhpIni::OPERATION_PLUS) === 20
     */
    public static function setPostMaxSize($intMegabyte = 8, $strOperation = null)
    {
        return self::iniSet('post_max_size', $intMegabyte, $strOperation);
    }

    /**
     * Retorna a definicao do tamanho maximo dos dados postados.
     * 
     * @example \InepZend\Util\PhpIni::getPostMaxSize()
     *
     * @return mix
     * 
     * @TODO assert () === 8
     */
    public static function getPostMaxSize()
    {
        return self::iniGet('post_max_size', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o endereco de e-mail do remetente
     * no Windows.
     * Esta diretiva tambem define o "Return-Path:" no header.
     * 
     * @example \InepZend\Util\PhpIni::setSendmailFrom('test')
     *
     * @param string $strFrom
     * @return mix
     * 
     * @assert () === ''
     * @assert ('') === ''
     * @assert ('test') === 'test'
     */
    public static function setSendmailFrom($strFrom = null)
    {
        return self::iniSet('sendmail_from', $strFrom);
    }

    /**
     * Retorna a definicao do endereco de e-mail do remetente no Windows.
     * 
     * @example \InepZend\Util\PhpIni::getSendmailFrom()
     *
     * @return mix
     * 
     * @assert () === 'test'
     */
    public static function getSendmailFrom()
    {
        return self::iniGet('sendmail_from');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica o tempo de vida para paginas
     * de sessao, em minutos.
     * Nao tem efeito na limitacao de nocache.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::setSessionCacheExpire(180, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setSessionCacheExpire(20, \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intSecond
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @assert () === 180
     * @assert (null) === false
     * @assert (0) === 0
     * @assert (180) === 180
     * @assert (180, \InepZend\Util\PhpIni::OPERATION_EXACT) === 180
     * @assert (20, \InepZend\Util\PhpIni::OPERATION_PLUS) === 200
     */
    public static function setSessionCacheExpire($intSecond = 180, $strOperation = null)
    {
        return self::iniSet('session.cache_expire', $intSecond, $strOperation);
    }

    /**
     * Retorna o tempo de vida para paginas de sessao, em minutos.
     * 
     * @example \InepZend\Util\PhpIni::getSessionCacheExpire()
     *
     * @return mix
     * 
     * @assert () === 200
     */
    public static function getSessionCacheExpire()
    {
        return self::iniGet('session.cache_expire', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica o metodo de controle do cache
     * para usar em paginas de sessao.
     * Pode ter um dos valores: nocache, private, private_no_expire ou public.
     * 
     * @example \InepZend\Util\PhpIni::setSessionCacheLimiter('nocache') <br /> \InepZend\Util\PhpIni::setSessionCacheLimiter('private')
     *
     * @param string $strLimiter
     * @return mix
     * 
     * @assert () === 'nocache'
     * @assert (null) === false
     * @assert ('nocache') === 'nocache'
     * @assert ('private') === 'private'
     */
    public static function setSessionCacheLimiter($strLimiter = 'nocache')
    {
        return self::iniSet('session.cache_limiter', $strLimiter);
    }

    /**
     * Retorna o metodo de controle do cache para usar em paginas de sessao.
     * 
     * @example \InepZend\Util\PhpIni::getSessionCacheLimiter()
     *
     * @return mix
     * 
     * @assert () === 'private'
     */
    public static function getSessionCacheLimiter()
    {
        return self::iniGet('session.cache_limiter');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica o algoritimo de hash usado
     * para gerar os IDs de sessao.
     * Utiliza a chave dos algoritmos listados em hash_algos(), como '0' para MD5
     * (128 bits) e '1' para SHA-1 (160 bits).
     * 
     * @example \InepZend\Util\PhpIni::setSessionHashFunction(0) <br /> \InepZend\Util\PhpIni::setSessionHashFunction(1)
     *
     * @param integer $intKeyHashAlgos
     * @return mix
     * 
     * @assert () === 0
     * @assert (null) === 0
     * @assert (0) === 0
     * @assert (1) === 1
     */
    public static function setSessionHashFunction($intKeyHashAlgos = 0)
    {
        return self::iniSet('session.hash_function', $intKeyHashAlgos);
    }

    /**
     * Retorna a especificacao do algoritimo de hash usado para gerar os IDs de
     * sessao.
     * 
     * @example \InepZend\Util\PhpIni::getSessionHashFunction()
     *
     * @return mix
     * 
     * @assert () === 0
     */
    public static function getSessionHashFunction()
    {
        return self::iniGet('session.hash_function', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica o nome da sessao que eh usada
     * como um nome de cookie.
     * Deve conter apenas caracteres alfanumericos.
     * 
     * @example \InepZend\Util\PhpIni::setSessionName('PHPSESSID') <br /> \InepZend\Util\PhpIni::setSessionName('PHPSESSIONID')
     *
     * @param string $strName
     * @return mix
     * 
     * @assert () === 'PHPSESSID'
     * @assert (null) === false
     * @assert ('PHPSESSID') === 'PHPSESSID'
     * @assert ('PHPSESSIONID') === 'PHPSESSIONID'
     */
    public static function setSessionName($strName = 'PHPSESSID')
    {
        return self::iniSet('session.name', $strName);
    }

    /**
     * Retorna o nome da sessao que eh usada como um nome de cookie.
     * 
     * @example \InepZend\Util\PhpIni::getSessionName()
     *
     * @return mix
     * 
     * @assert () === 'PHPSESSIONID'
     */
    public static function getSessionName()
    {
        return self::iniGet('session.name', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nome do manipulador que sera
     * utilizado para armazenar e recuperar dados associados a sessao.
     * 
     * @example \InepZend\Util\PhpIni::setSessionSaveHandler('files')
     *
     * @param string $strHandler
     * @return mix
     * 
     * @assert () === 'files'
     * @assert (null) === false
     * @assert ('files') === 'files'
     */
    public static function setSessionSaveHandler($strHandler = 'files')
    {
        return self::iniSet('session.save_handler', $strHandler);
    }

    /**
     * Retorna o nome do manipulador que sera utilizado para armazenar e recuperar
     * dados associados a sessao.
     * 
     * @example \InepZend\Util\PhpIni::getSessionSaveHandler()
     *
     * @return mix
     * 
     * @assert () === 'files'
     */
    public static function getSessionSaveHandler()
    {
        return self::iniGet('session.save_handler', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o argumento que eh passado para
     * o manipulador de gravacao.
     * Se escolher o manipulador files, este eh o caminho onde os arquivos serao
     * criados.
     * 
     * @example \InepZend\Util\PhpIni::setSessionSavePath('/tmp')
     *
     * @param string $strPath
     * @return mix
     * 
     * @assert () === false
     * @assert (null) === false
     * @assert ('\\') === '\\'
     */
    public static function setSessionSavePath($strPath = '')
    {
        return self::iniSet('session.save_path', $strPath);
    }

    /**
     * Retorna o argumento que eh passado para o manipulador de gravacao.
     * Se escolher o manipulador files, este eh o caminho onde os arquivos serao
     * criados.
     * 
     * @example \InepZend\Util\PhpIni::getSessionSavePath()
     *
     * @return mix
     * 
     * @assert () === '\\'
     */
    public static function getSessionSavePath()
    {
        return self::iniGet('session.save_path', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nome do manipulador que eh
     * usado para serializar/desserializar dados.
     * Disponibilizado o formato interno do PHP (nome php ou php_binary) e WDDX
     * (nome wddx).
     * 
     * @example \InepZend\Util\PhpIni::setSessionSerializeHandler('php') <br /> \InepZend\Util\PhpIni::setSessionSerializeHandler('wddx')
     *
     * @param string $strHandler
     * @return mix
     * 
     * @assert () === 'php'
     * @assert (null) === false
     * @assert ('php') === 'php'
     */
    public static function setSessionSerializeHandler($strHandler = 'php')
    {
        return self::iniSet('session.serialize_handler', $strHandler);
    }

    /**
     * Retorna o nome do manipulador que eh usado para serializar/desserializar
     * dados.
     * 
     * @example \InepZend\Util\PhpIni::getSessionSerializeHandler()
     *
     * @return mix
     * 
     * @assert () === 'php'
     */
    public static function getSessionSerializeHandler()
    {
        return self::iniGet('session.serialize_handler', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica o uso do modo estrito do
     * ID da sessao.
     * Se este modo estiver ativado, nao se aceita nao inicializar o ID da sessao.
     * Se o ID da sessao nao inicializado for enviado a partir do navegador, o novo
     * ID de sessao eh enviado para o navegador.
     * 
     * @example \InepZend\Util\PhpIni::setSessionUseStrictMode(false) <br /> \InepZend\Util\PhpIni::setSessionUseStrictMode(true)
     *
     * @param boolean $booUse
     * @return mix
     * 
     * @assert () === false
     * @assert (null) === false
     * @assert (false) === false
     * @TODO assert (true) === true
     */
    public static function setSessionUseStrictMode($booUse = false)
    {
        return self::iniSet('session.use_strict_mode', (integer) $booUse);
    }

    /**
     * Retorna o uso do modo estrito do ID da sessao.
     * 
     * @example \InepZend\Util\PhpIni::getSessionUseStrictMode()
     *
     * @return mix
     * 
     * @assert () === false
     */
    public static function getSessionUseStrictMode()
    {
        return self::iniGet('session.use_strict_mode', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica se usara cookies para guardar
     * o ID no lado do cliente.
     * 
     * @example \InepZend\Util\PhpIni::setSessionUseCookies(true) <br /> \InepZend\Util\PhpIni::setSessionUseCookies(false)
     *
     * @param boolean $booUse
     * @return mix
     * 
     * @assert () === true
     * @assert (null) === false
     * @assert (true) === true
     * @assert (false) === false
     */
    public static function setSessionUseCookies($booUse = true)
    {
        return self::iniSet('session.use_cookies', (integer) $booUse);
    }

    /**
     * Retorna a identificacao se usara cookies para guardar o ID no lado do cliente.
     * 
     * @example \InepZend\Util\PhpIni::getSessionUseCookies()
     *
     * @return mix
     * 
     * @assert () === true
     */
    public static function getSessionUseCookies()
    {
        return self::iniGet('session.use_cookies', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que especifica se usara somente cookies
     * para guardar o ID no lado do cliente.
     * Habilitando esta configuracao previne ataques envolvendo passagem de ids
     * de sessao nas URLs.
     * 
     * @example \InepZend\Util\PhpIni::setSessionUseOnlyCookies(true) <br /> \InepZend\Util\PhpIni::setSessionUseOnlyCookies(false)
     *
     * @param boolean $booUse
     * @return mix
     * 
     * @assert () === true
     * @assert (null) === false
     * @assert (true) === true
     * @assert (false) === false
     */
    public static function setSessionUseOnlyCookies($booUse = true)
    {
        return self::iniSet('session.use_only_cookies', (integer) $booUse);
    }

    /**
     * Retorna a identificacao se usara somente cookies para guardar o ID no lado
     * do cliente.
     * 
     * @example \InepZend\Util\PhpIni::getSessionUseOnlyCookies()
     *
     * @return mix
     * 
     * @assert () === true
     */
    public static function getSessionUseOnlyCookies()
    {
        return self::iniGet('session.use_only_cookies', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define se o suporte a sid transparente
     * esta habilitado ou nao.
     * 
     * @example \InepZend\Util\PhpIni::setSessionUseTransSid(false) <br /> \InepZend\Util\PhpIni::setSessionUseTransSid(true)
     *
     * @param boolean $booUse
     * @return mix
     * 
     * @assert () === false
     * @assert (null) === false
     * @assert (false) === false
     * @assert (true) === true
     */
    public static function setSessionUseTransSid($booUse = false)
    {
        return self::iniSet('session.use_trans_sid', (integer) $booUse);
    }

    /**
     * Retorna a definecao se o suporte a sid transparente esta habilitado ou nao.
     * 
     * @example \InepZend\Util\PhpIni::getSessionUseTransSid()
     *
     * @return mix
     * 
     * @assert () === false
     */
    public static function getSessionUseTransSid()
    {
        return self::iniGet('session.use_trans_sid', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nome do host ou endereco IP
     * do servidor SMTP a ser usado em emails enviados com a funcao mail().
     * Usado apenas sob o Windows.
     * 
     * @example \InepZend\Util\PhpIni::setSmtp('localhost') <br /> \InepZend\Util\PhpIni::setSmtp('172.29.0.42')
     *
     * @param string $strSmtp
     * @return mix
     * 
     * @assert () === 'localhost'
     * @assert (null) === false
     * @assert ('localhost') === 'localhost'
     */
    public static function setSmtp($strSmtp = 'localhost')
    {
        return self::iniSet('SMTP', $strSmtp);
    }

    /**
     * Retorna o nome do host ou endereco IP do servidor SMTP a ser usado em emails
     * enviados com a funcao mail().
     * Usado apenas sob o Windows.
     * 
     * @example \InepZend\Util\PhpIni::getSmtp()
     *
     * @return mix
     * 
     * @assert () === 'localhost'
     */
    public static function getSmtp()
    {
        return self::iniGet('SMTP', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a porta de conexao com o servidor
     * especificado na diretiva SMTP a ser usado em emails enviados com a funcao
     * mail().
     * Usado apenas sob o Windows.
     * 
     * @example \InepZend\Util\PhpIni::setSmtpPort(25)
     *
     * @param integer $intPort
     * @return mix
     * 
     * @assert () === 25
     * @assert (null) === false
     * @assert (25) === 25
     */
    public static function setSmtpPort($intPort = 25)
    {
        return self::iniSet('smtp_port', $intPort);
    }

    /**
     * Retorna a porta de conexao com o servidor especificado na diretiva SMTP a
     * ser usado em emails enviados com a funcao mail().
     * 
     * @example \InepZend\Util\PhpIni::getSmtpPort()
     *
     * @return mix
     * 
     * @assert () === 25
     */
    public static function getSmtpPort()
    {
        return self::iniGet('smtp_port', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que determina o tipo de cache, se soap.wsdl_cache_enabled
     * estiver ligado.
     * Ele pode ser qualquer um de: WSDL_CACHE_NONE (0), WSDL_CACHE_DISK (1), 
     * WSDL_CACHE_MEMORY (2) ou WSDL_CACHE_BOTH (3).
     * 
     * @example \InepZend\Util\PhpIni::setSoapWsdlCache(0) <br /> \InepZend\Util\PhpIni::setSoapWsdlCache(1) <br /> \InepZend\Util\PhpIni::setSoapWsdlCache(2)
     *
     * @param integer $intType
     * @return mix
     * 
     * @assert () === 1
     * @assert (null) === false
     * @assert (0) === 0
     * @assert (1) === 1
     * @assert (2) === 2
     * @assert (3) === 3
     */
    public static function setSoapWsdlCache($intType = 1)
    {
        return self::iniSet('soap.wsdl_cache', $intType);
    }

    /**
     * Retorna o tipo de cache, se soap.wsdl_cache_enabled estiver ligado.
     * 
     * @example \InepZend\Util\PhpIni::getSoapWsdlCache()
     *
     * @return mix
     * 
     * @assert () === 3
     */
    public static function getSoapWsdlCache()
    {
        return self::iniGet('soap.wsdl_cache', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nome do diretorio onde a extensao
     * SOAP ira colocar os arquivos de cache.
     * 
     * @example \InepZend\Util\PhpIni::setSoapWsdlCacheDir('/tmp')
     *
     * @param string $strDir
     * @return mix
     * 
     * @assert () === '\\'
     * @assert (null) === false
     * @assert ('\\') === '\\'
     */
    public static function setSoapWsdlCacheDir($strDir = '\\')
    {
        return self::iniSet('soap.wsdl_cache_dir', $strDir);
    }

    /**
     * Retorna o nome do diretorio onde a extensao SOAP ira colocar os arquivos
     * de cache.
     * 
     * @example \InepZend\Util\PhpIni::getSoapWsdlCacheDir()
     *
     * @return mix
     * 
     * @assert () === '\\'
     */
    public static function getSoapWsdlCacheDir()
    {
        return self::iniGet('soap.wsdl_cache_dir', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que ativa ou desativa o recurso de cache de WSDL.
     * 
     * @example \InepZend\Util\PhpIni::setSoapWsdlCacheEnabled(true) <br /> \InepZend\Util\PhpIni::setSoapWsdlCacheEnabled(false)
     *
     * @param boolean $booEnable
     * @return mix
     * 
     * @assert () === true
     * @assert (null) === false
     * @assert (true) === true
     * @assert (false) === false
     */
    public static function setSoapWsdlCacheEnabled($booEnable = true)
    {
        return self::iniSet('soap.wsdl_cache_enabled', (integer) $booEnable);
    }

    /**
     * Retorna a identificacao do recurso de cache de WSDL.
     * 
     * @example \InepZend\Util\PhpIni::getSoapWsdlCacheEnabled()
     *
     * @return mix
     * 
     * @assert () === true
     */
    public static function getSoapWsdlCacheEnabled()
    {
        return self::iniGet('soap.wsdl_cache_enabled', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o numero maximo de arquivos WSDL
     * em cache.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::setSoapWsdlCacheLimit(5, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setSoapWsdlCacheLimit(1, \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intMaxFile
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @assert () === 5
     * @assert (null) === false
     * @assert (5) === 5
     * @assert (5, \InepZend\Util\PhpIni::OPERATION_EXACT) === 5
     * @assert (1, \InepZend\Util\PhpIni::OPERATION_PLUS) === 6
     */
    public static function setSoapWsdlCacheLimit($intMaxFile = 5, $strOperation = null)
    {
        return self::iniSet('soap.wsdl_cache_limit', $intMaxFile, $strOperation);
    }

    /**
     * Retorna o numero maximo de arquivos WSDL em cache.
     * 
     * @example \InepZend\Util\PhpIni::getSoapWsdlCacheLimit()
     *
     * @return mix
     * 
     * @assert () === 6
     */
    public static function getSoapWsdlCacheLimit()
    {
        return self::iniGet('soap.wsdl_cache_limit', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o numero de segundos (tempo de
     * vida) que o cache de arquivos sera usado em vez dos originais.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::setSoapWsdlCacheTtl(86400, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setSoapWsdlCacheTtl(600, \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intSecond
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @assert () === 86400
     * @assert (null) === false
     * @assert (86400) === 86400
     * @assert (86400, \InepZend\Util\PhpIni::OPERATION_EXACT) === 86400
     * @assert (600, \InepZend\Util\PhpIni::OPERATION_PLUS) === 87000
     */
    public static function setSoapWsdlCacheTtl($intSecond = 86400, $strOperation = null)
    {
        return self::iniSet('soap.wsdl_cache_ttl', $intSecond, $strOperation);
    }

    /**
     * Retorna o numero de segundos (tempo de vida) que o cache de arquivos sera
     * usado em vez dos originais.
     * 
     * @example \InepZend\Util\PhpIni::getSoapWsdlCacheTtl()
     *
     * @return mix
     * 
     * @assert () === 87000
     */
    public static function getSoapWsdlCacheTtl()
    {
        return self::iniGet('soap.wsdl_cache_ttl', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define se a ultima mensagem de erro
     * sempre estara presente na variavel $php_errormsg.
     * 
     * @example \InepZend\Util\PhpIni::setTrackErrors(false) <br /> \InepZend\Util\PhpIni::setTrackErrors(true)
     *
     * @param boolean $booEnable
     * @return mix
     * 
     * @assert () === false
     * @assert (null) === false
     * @assert (false) === false
     * @assert (true) === true
     */
    public static function setTrackErrors($booEnable = false)
    {
        return self::iniSet('track_errors', (integer) $booEnable);
    }

    /**
     * Retorna a definicao se a ultima mensagem de erro sempre estara presente na
     * variavel $php_errormsg.
     * 
     * @example \InepZend\Util\PhpIni::getTrackErrors()
     *
     * @return mix
     * 
     * @assert () === false
     */
    public static function getTrackErrors()
    {
        return self::iniGet('track_errors', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define o tamanho maximo de um arquivo
     * enviado.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     * 
     * @example \InepZend\Util\PhpIni::setUploadMaxFilesize(2, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setUploadMaxFilesize(1, \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intMegabyte
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @TODO assert () === 2
     * @TODO assert (null) === 0
     * @TODO assert (2) === 2
     * @TODO assert (2, \InepZend\Util\PhpIni::OPERATION_EXACT) === 2
     * @TODO assert (1, \InepZend\Util\PhpIni::OPERATION_PLUS) === 3
     */
    public static function setUploadMaxFilesize($intMegabyte = 2, $strOperation = null)
    {
        return self::iniSet('upload_max_filesize', $intMegabyte, $strOperation);
    }

    /**
     * Retorna o tamanho maximo de um arquivo enviado.
     * 
     * @example \InepZend\Util\PhpIni::getUploadMaxFilesize()
     *
     * @return mix
     * 
     * @TODO assert () === 3
     */
    public static function getUploadMaxFilesize()
    {
        return self::iniGet('upload_max_filesize', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_SYSTEM que define o numero maximo de arquivos que
     * pode ser enviado simultaneamente.
     * Campos de upload deixado em branco nao contam para este limite.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::setMaxFileUploads(20, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setMaxFileUploads(2, \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intMaxFile
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @TODO assert () === 20
     * @TODO assert (null) === false
     * @TODO assert (21) === 21
     * @TODO assert (22, \InepZend\Util\PhpIni::OPERATION_EXACT) === 22
     * @TODO assert (2, \InepZend\Util\PhpIni::OPERATION_PLUS) === 24
     */
    public static function setMaxFileUploads($intMaxFile = 20, $strOperation = null)
    {
        return self::iniSet('max_file_uploads', $intMaxFile, $strOperation);
    }

    /**
     * Retorna o numero maximo de arquivos que pode ser enviado simultaneamente.
     * 
     * @example \InepZend\Util\PhpIni::getMaxFileUploads()
     *
     * @return mix
     * 
     * @TODO assert () === 24
     */
    public static function getMaxFileUploads()
    {
        return self::iniGet('max_file_uploads', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_SYSTEM que define o diretorio temporario usado
     * para armazenar arquivos durante o upload.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     * 
     * @example \InepZend\Util\PhpIni::setUploadTmpDir('/tmp')
     *
     * @param string $strDir
     * @return mix
     * 
     * @TODO assert () === null
     * @TODO assert (null) === null
     * @TODO assert ('\\') === '\\'
     */
    public static function setUploadTmpDir($strDir = null)
    {
        return self::iniSet('upload_tmp_dir', $strDir);
    }

    /**
     * Retorna o diretorio temporario usado para armazenar arquivos durante o upload.
     * 
     * @example \InepZend\Util\PhpIni::getUploadTmpDir()
     *
     * @return mix
     * 
     * @TODO assert () === null
     */
    public static function getUploadTmpDir()
    {
        return self::iniGet('upload_tmp_dir');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o user agent que o PHP ira enviar.
     * 
     * @example \InepZend\Util\PhpIni::setUserAgent('Mozilla/5.0 Gecko/20071025 Firefox/2.0.0.9')
     *
     * @param string $strAgent
     * @return mix
     * 
     * @assert () === false
     * @assert (null) === false
     * @assert ('test') === 'test'
     */
    public static function setUserAgent($strAgent = null)
    {
        return self::iniSet('user_agent', $strAgent);
    }

    /**
     * Retorna o user agent que o PHP ira enviar.
     * 
     * @example \InepZend\Util\PhpIni::getUserAgent()
     *
     * @return mix
     * 
     * @assert () === 'test'
     */
    public static function getUserAgent()
    {
        return self::iniGet('user_agent');
    }

    /**
     * Metodo com permissao PHP_INI_SYSTEM que define o nome base do diretorio usado
     * na home do usuario para arquivos PHP.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     * 
     * @example \InepZend\Util\PhpIni::setUserDir('/public')
     *
     * @param string $strDir
     * @return mix
     * 
     * @TODO assert () === null
     * @TODO assert (null) === null
     * @TODO assert ('/public') === '/public'
     */
    public static function setUserDir($strDir = null)
    {
        return self::iniSet('user_dir', $strDir);
    }

    /**
     * Retorna o nome base do diretorio usado na home do usuario para arquivos PHP.
     * 
     * @example \InepZend\Util\PhpIni::getUserDir()
     *
     * @return mix
     * 
     * @TODO assert () === null
     */
    public static function getUserDir()
    {
        return self::iniGet('user_dir');
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define a ordem de interpretacao das
     * variaveis EGPCS (Environment, Get, Post, Cookie, e Server).
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     * 
     * @example \InepZend\Util\PhpIni::setVariablesOrder('EGPCS') <br /> \InepZend\Util\PhpIni::setVariablesOrder('GEPSC')
     *
     * @param string $strOrder
     * @return mix
     * 
     * @TODO assert () === 'EGPCS'
     * @TODO assert (null) === null
     * @TODO assert ('EGPCS') === 'EGPCS'
     * @TODO assert ('GEPSC') === 'GEPSC'
     */
    public static function setVariablesOrder($strOrder = 'EGPCS')
    {
        return self::iniSet('variables_order', $strOrder);
    }

    /**
     * Retorna a ordem de interpretacao das variaveis EGPCS (Environment, Get, Post,
     * Cookie, e Server).
     * 
     * @example \InepZend\Util\PhpIni::getVariablesOrder()
     *
     * @return mix
     * 
     * @TODO assert () === 'EGPCS'
     */
    public static function getVariablesOrder()
    {
        return self::iniGet('variables_order', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nivel maximo de funcoes aninhadas
     * que sao permitidos antes que o script seja abortado.
     * Controla o mecanismo de protecao para a recursao infinita.
     * OBS.: A alocacao sera realizada caso o valor requisitado seja maior que o
     * alocado atualmente.
     * 
     * @example \InepZend\Util\PhpIni::setXdebugMaxNestingLevel(100, \InepZend\Util\PhpIni::OPERATION_EXACT) <br /> \InepZend\Util\PhpIni::setXdebugMaxNestingLevel(50, \InepZend\Util\PhpIni::OPERATION_PLUS)
     *
     * @param integer $intMaxNestingLevel
     * @param string $strOperation ex.: \InepZend\Util\PhpIni::OPERATION_EXACT ou \InepZend\Util\PhpIni::OPERATION_PLUS
     * @return mix
     * 
     * @assert () === 100
     * @assert (null) === false
     * @assert (100) === 100
     * @assert (100, \InepZend\Util\PhpIni::OPERATION_EXACT) === 100
     * @assert (50, \InepZend\Util\PhpIni::OPERATION_PLUS) === 150
     */
    public static function setXdebugMaxNestingLevel($intMaxNestingLevel = 100, $strOperation = null)
    {
        return self::iniSet('xdebug.max_nesting_level', $intMaxNestingLevel, $strOperation);
    }

    /**
     * Retorna o nivel maximo de funcoes aninhadas que sao permitidos antes que
     * o script seja abortado.
     * 
     * @example \InepZend\Util\PhpIni::getXdebugMaxNestingLevel()
     *
     * @return mix
     * 
     * @assert () === 150
     */
    public static function getXdebugMaxNestingLevel()
    {
        return self::iniGet('xdebug.max_nesting_level', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define se deve ou nao permitir o
     * xdebug de escrever os arquivos no diretorio de saida.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     * 
     * @example \InepZend\Util\PhpIni::setXdebugProfilerEnable(false) <br /> \InepZend\Util\PhpIni::setXdebugProfilerEnable(true)
     *
     * @param boolean $booEnable
     * @return mix
     * 
     * @TODO assert () === false
     * @TODO assert (null) === false
     * @TODO assert (false) === false
     * @TODO assert (true) === true
     */
    public static function setXdebugProfilerEnable($booEnable = false)
    {
        return self::iniSet('xdebug.profiler_enable', (integer) $booEnable);
    }

    /**
     * Retorna a definicao se deve ou nao permitir o xdebug de escrever os arquivos
     * no diretorio de saida.
     * 
     * @example \InepZend\Util\PhpIni::getXdebugProfilerEnable()
     *
     * @return mix
     * 
     * @TODO assert () === false
     */
    public static function getXdebugProfilerEnable()
    {
        return self::iniGet('xdebug.profiler_enable', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define se deve ou nao permitir o
     * xdebug de acionar a geracao de arquivos usando a XDEBUG_PROFILE como parametro
     * GET/POST, ou definir um cookie com o nome XDEBUG_PROFILE.
     * Deve-se inativar o xdebug.profiler_enable.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     * 
     * @example \InepZend\Util\PhpIni::setXdebugProfilerEnableTrigger(false) <br /> \InepZend\Util\PhpIni::setXdebugProfilerEnableTrigger(true)
     *
     * @param boolean $booEnable
     * @return mix
     * 
     * @TODO assert () === false
     * @TODO assert (null) === false
     * @TODO assert (false) === false
     * @TODO assert (true) === true
     */
    public static function setXdebugProfilerEnableTrigger($booEnable = false)
    {
        return self::iniSet('xdebug.profiler_enable_trigger', (integer) $booEnable);
    }

    /**
     * Retorna a definicao se deve ou nao permitir o xdebug de acionar a geracao
     * de arquivos usando a XDEBUG_PROFILE como parametro GET/POST, ou definir um
     * cookie com o nome XDEBUG_PROFILE.
     * 
     * @example \InepZend\Util\PhpIni::getXdebugProfilerEnableTrigger()
     *
     * @return mix
     * 
     * @TODO assert () === false
     */
    public static function getXdebugProfilerEnableTrigger()
    {
        return self::iniGet('xdebug.profiler_enable_trigger', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define o diretorio de saida onde
     * os arquivos serao escritos.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     * 
     * @example \InepZend\Util\PhpIni::setXdebugProfilerOutputDir('/tmp')
     *
     * @param string $strDir
     * @return mix
     * 
     * @TODO assert () === '\\'
     * @TODO assert (null) === false
     * @TODO assert ('\\') === '\\'
     */
    public static function setXdebugProfilerOutputDir($strDir = '\\')
    {
        return self::iniSet('xdebug.profiler_output_dir', $strDir);
    }

    /**
     * Retorna o diretorio de saida onde os arquivos serao escritos.
     * 
     * @example \InepZend\Util\PhpIni::getXdebugProfilerOutputDir()
     *
     * @return mix
     * 
     * @TODO assert () === '\\'
     */
    public static function getXdebugProfilerOutputDir()
    {
        return self::iniGet('xdebug.profiler_output_dir', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define o formato do nome do arquivo
     * gerado pelo xdebug.
     * Trabalha com especificadores de formato muito semelhante ao sprintf() e strftime().
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     * 
     * @example \InepZend\Util\PhpIni::setXdebugProfilerOutputName('cachegrind.out.%p')
     *
     * @param string $strName
     * @return mix
     * 
     * @TODO assert () === 'cachegrind.out.%p'
     * @TODO assert (null) === false
     * @TODO assert ('cachegrind.out.%p') === 'cachegrind.out.%p'
     */
    public static function setXdebugProfilerOutputName($strName = 'cachegrind.out.%p')
    {
        return self::iniSet('xdebug.profiler_output_name', $strName);
    }

    /**
     * Retorna o formato do nome do arquivo gerado pelo xdebug.
     * 
     * @example \InepZend\Util\PhpIni::getXdebugProfilerOutputName()
     *
     * @return mix
     * 
     * @TODO assert () === 'cachegrind.out.%p'
     */
    public static function getXdebugProfilerOutputName()
    {
        return self::iniGet('xdebug.profiler_output_name', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_PERDIR que define se deve ou nao tentar entrar
     * em contato com um cliente de depuracao que esta escutando no host e porta
     * definidos em xdebug.remote_host e xdebug.remote_port.
     * <b>Esta diretiva nao pode ser alterada em tempo de execucao.</b>
     * 
     * @example \InepZend\Util\PhpIni::setXdebugRemoteEnable(false) <br /> \InepZend\Util\PhpIni::setXdebugRemoteEnable(true)
     *
     * @param boolean $booEnable
     * @return mix
     * 
     * @TODO assert () === false
     * @TODO assert (null) === false
     * @TODO assert (false) === false
     * @TODO assert (true) === true
     */
    public static function setXdebugRemoteEnable($booEnable = false)
    {
        return self::iniSet('xdebug.remote_enable', (integer) $booEnable);
    }

    /**
     * Retorna a definicao se deve ou nao tentar entrar em contato com um cliente
     * de depuracao que esta escutando no host e porta definidos em xdebug.remote_host
     * e xdebug.remote_port.
     * 
     * @example \InepZend\Util\PhpIni::getXdebugRemoteEnable()
     *
     * @return mix
     * 
     * @TODO assert () === false
     */
    public static function getXdebugRemoteEnable()
    {
        return self::iniGet('xdebug.remote_enable', 'bool');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nome do manipulador que eh
     * usado pelo xdebug para realizar a depuracao.
     * Seguem algumas opcoes: 'php3' (estilo PHP 3), 'gdb' (usa o GDB como interface
     * de depuracao) ou 'dbgp' (DBGp eh o unico protocolo suportado).
     * 
     * @example \InepZend\Util\PhpIni::setXdebugRemoteHandler('dbgp')
     *
     * @param string $strHandler
     * @return mix
     * 
     * @assert () === 'dbgp'
     * @assert (null) === false
     * @assert ('dbgp') === 'dbgp'
     */
    public static function setXdebugRemoteHandler($strHandler = 'dbgp')
    {
        return self::iniSet('xdebug.remote_handler', $strHandler);
    }

    /**
     * Retorna o nome do manipulador que eh usado pelo xdebug para realizar a depuracao.
     * 
     * @example \InepZend\Util\PhpIni::getXdebugRemoteHandler()
     *
     * @return mix
     * 
     * @assert () === 'dbgp'
     */
    public static function getXdebugRemoteHandler()
    {
        return self::iniGet('xdebug.remote_handler', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define o nome do host ou endereco IP
     * onde o cliente de depuracao estiver em execucao.
     * Esta definicao eh ignorada se xdebug.remote_connect_back estiver ativo.
     * 
     * @example \InepZend\Util\PhpIni::setXdebugRemoteHost('localhost') <br /> \InepZend\Util\PhpIni::setXdebugRemoteHost('127.0.0.1')
     *
     * @param string $strHost
     * @return mix
     * 
     * @assert () === 'localhost'
     * @assert (null) === false
     * @assert ('localhost') === 'localhost'
     */
    public static function setXdebugRemoteHost($strHost = 'localhost')
    {
        return self::iniSet('xdebug.remote_host', $strHost);
    }

    /**
     * Retorna o nome do host ou endereco IP onde o cliente de depuracao estiver
     * em execucao.
     * 
     * @example \InepZend\Util\PhpIni::getXdebugRemoteHost()
     *
     * @return mix
     * 
     * @assert () === 'localhost'
     */
    public static function getXdebugRemoteHost()
    {
        return self::iniGet('xdebug.remote_host', 'string');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que define a porta de conexao com o cliente
     * de depuracao.
     * 
     * @example \InepZend\Util\PhpIni::setXdebugRemotePort(9000)
     *
     * @param integer $intPort
     * @return mix
     * 
     * @assert () === 9000
     * @assert (null) === false
     * @assert (9000) === 9000
     */
    public static function setXdebugRemotePort($intPort = 9000)
    {
        return self::iniSet('xdebug.remote_port', $intPort);
    }

    /**
     * Retorna a porta de conexao com o cliente de depuracao.
     * 
     * @example \InepZend\Util\PhpIni::getXdebugRemotePort()
     *
     * @return mix
     * 
     * @assert () === 9000
     */
    public static function getXdebugRemotePort()
    {
        return self::iniGet('xdebug.remote_port', 'integer');
    }

    /**
     * Metodo com permissao PHP_INI_ALL que serve para comprimir paginas de modo
     * transparente.
     * 
     * @example \InepZend\Util\PhpIni::setZlibOutputCompression(false) <br /> \InepZend\Util\PhpIni::setZlibOutputCompression(true)
     *
     * @param boolean $booEnable
     * @return mix
     * 
     * @TODO assert () === false
     * @TODO assert (null) === false
     * @TODO assert (false) === false
     * @TODO assert (true) === true
     */
    public static function setZlibOutputCompression($booEnable = false)
    {
        return self::iniSet('zlib.output_compression', (integer) $booEnable);
    }

    /**
     * Retorna a definicao se deve ou nao comprimir paginas de modo transparente.
     * 
     * @example \InepZend\Util\PhpIni::getZlibOutputCompression()
     *
     * @return mix
     * 
     * @TODO assert () === false
     */
    public static function getZlibOutputCompression()
    {
        return self::iniGet('zlib.output_compression', 'bool');
    }

    /**
     * Define o valor de uma opcao de configuracao/diretiva do PHP caso seja possivel.
     * 
     * @example \InepZend\Util\PhpIni::iniSet('xdebug.remote_port', 9000)
     * 
     * @param string $strConfigVarName
     * @param mix $mixConfigValue
     * @param string $strOperation
     * @return mix
     * 
     * @assert () === false
     * @assert ('memory_limit', -1) === -1
     * @assert ('max_execution_time', 0) === 0
     * @assert ('memory_limit', 180, \InepZend\Util\PhpIni::OPERATION_EXACT) === 180
     * @assert ('memory_limit', 10, \InepZend\Util\PhpIni::OPERATION_PLUS) === 190
     * @assert ('memory_limit', 10, 'operacao_inexistente') === false
     */
    public static function iniSet($strConfigVarName = null, $mixConfigValue = null, $strOperation = self::OPERATION_EXACT)
    {
        if (empty($strConfigVarName))
            return false;
        $strConfigVarName = trim(strtolower($strConfigVarName));
        if ($strConfigVarName == 'smtp')
            $strConfigVarName = strtoupper($strConfigVarName);
        if (Format::hasString($mixConfigValue))
            $mixConfigValue = str_ireplace(array('Mb', 'M'), '', $mixConfigValue);
        if (is_numeric($mixConfigValue))
            $mixConfigValue = (integer) $mixConfigValue;
        if (($mixConfigValue === -1) || ($mixConfigValue === - 1) || ($mixConfigValue === 0)) {
            ini_set($strConfigVarName, $mixConfigValue);
            return self::iniGetFromConfigVarName($strConfigVarName);
        }
        $mixConfigValueAllocated = self::iniGetFromConfigVarName($strConfigVarName);
        $strSufix = (in_array($strConfigVarName, array('memory_limit', 'post_max_size', 'upload_max_filesize'))) ? 'M' : '';
        $strOperation = (empty($strOperation)) ? self::OPERATION_EXACT : strtoupper($strOperation);
        if ($strOperation == self::OPERATION_EXACT) {
            if ($mixConfigValue >= $mixConfigValueAllocated) {
                ini_set($strConfigVarName, $mixConfigValue . $strSufix);
                return self::iniGetFromConfigVarName($strConfigVarName);
            }
        } elseif ($strOperation == self::OPERATION_PLUS) {
            ini_set($strConfigVarName, ($mixConfigValue + $mixConfigValueAllocated) . $strSufix);
            return self::iniGetFromConfigVarName($strConfigVarName);
        }
        return false;
    }

    /**
     * Retorna o valor de uma opcao de configuracao/diretiva do PHP.
     * 
     * @example \InepZend\Util\PhpIni::iniGet('xdebug.remote_port')
     * 
     * @param string $strConfigVarName
     * @param string $strTypeParse
     * @return mix
     * 
     * @assert () === false
     * @assert ('memory_limit') === '190M'
     * @assert ('max_execution_time') === '0'
     * @assert ('max_execution_time', 'string') === '0'
     * @assert ('max_execution_time', 'float') === 0.00
     */
    public static function iniGet($strConfigVarName = null, $strTypeParse = null)
    {
        if (empty($strConfigVarName))
            return false;
        $mixConfigValue = ini_get($strConfigVarName);
        if (!empty($strTypeParse))
            eval('$mixConfigValue = (' . $strTypeParse . ') $mixConfigValue;');
        return $mixConfigValue;
    }

    /**
     * Retorna o valor de uma opcao de configuracao/diretiva do PHP atraves dos
     * metodos "get" da classe \InepZend\Util\PhpIni.
     * 
     * @example \InepZend\Util\PhpIni::iniGetFromConfigVarName('xdebug.remote_port')
     * 
     * @param string $strConfigVarName
     * @return mix
     */
    private static function iniGetFromConfigVarName($strConfigVarName = null)
    {
        $mixMethod = self::buildMethodName($strConfigVarName);
        return (is_bool($mixMethod)) ? $mixMethod : self::$mixMethod($strConfigVarName);
    }

    /**
     * Constroi o nome do metodo "get" da classe \InepZend\Util\PhpIni que eh derivado
     * de diretiva PHP.
     * 
     * @example \InepZend\Util\PhpIni::buildMethodName('xdebug.remote_port', self::TYPE_METHOD_SET) <br /> \InepZend\Util\PhpIni::buildMethodName('xdebug.remote_port', self::TYPE_METHOD_GET)
     * 
     * @param string $strConfigVarName
     * @param string $strTypeMethod
     * @return mix
     */
    private static function buildMethodName($strConfigVarName = null, $strTypeMethod = null)
    {
        if (empty($strConfigVarName))
            return false;
        if (!in_array($strTypeMethod, array(self::TYPE_METHOD_SET, self::TYPE_METHOD_GET)))
            $strTypeMethod = self::TYPE_METHOD_GET;
        return $strTypeMethod . String::camelize(str_replace('.', '_', $strConfigVarName));
    }

}
