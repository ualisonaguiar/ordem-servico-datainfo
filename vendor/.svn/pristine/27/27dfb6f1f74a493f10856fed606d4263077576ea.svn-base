<?php

namespace InepZend\Dto;

use InepZend\Dto\AbstractDto;

/**
 * Classe responsavel por encapsular informacoes de retorno (saida) em um objeto
 * de transferencia de dados.
 * 
 * @package InepZend
 * @subpackage Dto
 */
class ResultDto extends AbstractDto
{

    const STATUS_OK = 'ok';
    const STATUS_ERROR = 'error';
    const STATUS_FAIL = 'fail';
    const STATUS_VALIDATE = 'validate';
    const STATUS_EMPTY = 'empty';

    private $strStatus = self::STATUS_OK;
    private $arrMessage = array();
    private $arrError = array();

    /**
     * Metodo responsavel por setar (atribuir) um status ao objeto de retorno.
     * 
     * @param string $strStatus
     * @return object
     */
    public function setStatus($strStatus = null)
    {
        $this->strStatus = (string) $strStatus;
        return $this;
    }

    /**
     * Metodo responsavel por capturar o status atribuido ao objeto de retorno.
     * 
     * @return string
     */
    public function getStatus()
    {
        return $this->strStatus;
    }

    /**
     * Metodo responsavel em inserir um array com as mensagens especificas no objeto
     * de retorno.
     * 
     * @param array $arrMessage
     * @return object
     */
    public function addMessage($arrMessage = null)
    {
        foreach ((array) $arrMessage as $strMessage)
            if (!in_array($strMessage, $this->arrMessage))
                array_push($this->arrMessage, $strMessage);
        return $this;
    }

    /**
     * Metodo responsavel por capturar uma ou todas as mensagens contidas no objeto.
     * 
     * @param string $strMessage
     * @return mix
     */
    public function getMessage($strMessage = null)
    {
        if ($strMessage == null)
            return ((is_array($this->arrMessage)) && (count($this->arrMessage) == 1)) ? $this->arrMessage[0] : $this->arrMessage;
        elseif (!array_key_exists($strMessage, $this->arrMessage))
            return;
        return $this->arrMessage[$strMessage];
    }

    /**
     * Metodo responsavel por limpar as mensagem contidas no objeto de retorno.
     * 
     * @return object
     */
    public function clearMessage()
    {
        $this->arrMessage = array();
        return $this;
    }

    /**
     * Metodo responsavel em inserir um determinado erro no objeto de retorno.
     * 
     * @param mix $mixError
     * @return object
     */
    public function addError($mixError = null)
    {
        $arrError = (array) $mixError;
        foreach ($arrError as $strError)
            if (!in_array($strError, $this->arrError))
                array_push($this->arrError, $strError);
        return $this;
    }

    /**
     * Metodo responsavel por capturar um ou todos os erro contidos no objeto.
     * 
     * @param string $strError
     * @return mix
     */
    public function getError($strError = null)
    {
        if ($strError == null)
            return ((is_array($this->arrError)) && (count($this->arrError) == 1)) ? $this->arrError[0] : $this->arrError;
        elseif (!array_key_exists($strError, $this->arrError))
            return;
        return $this->arrError[$strError];
    }

    /**
     * Metodo responsavel por limpar os erros contidos no objeto de retorno.
     * 
     * @return object
     */
    public function clearError()
    {
        $this->arrError = array();
        return $this;
    }

}
