<?php

namespace InepZend\Controller;

date_default_timezone_set('America/Sao_Paulo');

use InepZend\Authentication\AuthTrait;
use InepZend\View\RenderTemplate;
use InepZend\Http\RequestTrait;
use InepZend\Session\SessionTrait;
use InepZend\View\ThemeTrait;
use InepZend\Log\LogTrace;
use InepZend\Dto\ResultTrait;
use InepZend\Util\Format;

trait ControllerCoreTrait
{

    use AuthTrait,
        ResultTrait,
        RenderTemplate,
        RequestTrait,
        SessionTrait,
        ThemeTrait,
        LogTrace;

    /**
     * Metodo responsavel em retornar array preparado para ser utilizado na
     * manipulacao de banco de dados, removendo os dados como botao e formatando
     * dados como CPF, CNPJ, TELEFONE, CEP.
     *
     * @example $this->prepareRequest(true | false, array('key' => 'value')); <br /> $this->prepareRequest(true | false); <br /> $this->prepareRequest();
     *
     * @param boolean $booTemplateFormat
     * @param array $arrRequest
     * @return array
     */
    protected function prepareRequest($booTemplateFormat = false, $arrRequest = null)
    {
        $arrPost = Format::formatPrepareRequest((is_null($arrRequest)) ? $this->getPost() : $arrRequest, $booTemplateFormat);
        if (is_null($arrRequest))
            $this->setPost($arrPost);
        return $arrPost;
    }

    /**
     * Metodo responsavel em manipular atributos por referencia no escopo da
     * chamada do mesmo.
     *
     * @example $this->getAttributeValue('nameAtributte', 'strClass', 'valueDefault');
     *
     * @param mix $mixAttributeVar
     * @param string $strAttributeName
     * @param mix $mixDefaultValue
     * @return mix
     */
    protected function getAttributeValue(&$mixAttributeVar = null, $strAttributeName = null, $mixDefaultValue = null)
    {
        if ((!empty($strAttributeName)) && (is_null($mixAttributeVar)) && (isset($this->$strAttributeName)))
            $mixAttributeVar = $this->$strAttributeName;
        if ((is_null($mixAttributeVar)) && (!is_null($mixDefaultValue)))
            $mixAttributeVar = $mixDefaultValue;
        return $mixAttributeVar;
    }

}
