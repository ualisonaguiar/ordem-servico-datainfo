<?php

namespace InepZend\Module\Sqi\Service;

use InepZend\Service\AbstractServiceControlCache;
use InepZend\Exception\Exception as InepZendException;
use InepZend\Module\Sqi\Form\Questionario as QuestionarioForm;
use InepZend\Module\Sqi\Entity\VwSituacaoQuestionario as VwSituacaoQuestionarioEntity;
use InepZend\View\RenderTemplate;

class Questionario extends AbstractServiceControlCache
{
    use RenderTemplate;
    
    protected function getQuestionario($intCoProjeto, $intCoEvento, $arrRespostas = array(), $intIdQuestionario = null, $intCoQuestionario = null)
    {
        $vwSituacaoQuestionarioService = $this->getService('InepZend\Module\Sqi\Service\VwSituacaoQuestionario');
        $vwSituacaoQuestionario = $vwSituacaoQuestionarioService->getSituacaoQuestionario($intCoProjeto, $intCoEvento);
        if (($vwSituacaoQuestionario) && ($vwSituacaoQuestionario->getNoIdentificador() == VwSituacaoQuestionarioEntity::NO_IDENTIFICADOR_FINALIZADO))
            $strHtmlQuestionario = $this->controlCache('constructQuestionario', func_get_args());
        else
            $strHtmlQuestionario = $this->constructQuestionario($intCoProjeto, $intCoEvento, $intIdQuestionario, $intCoQuestionario);
        if ($arrRespostas) {
             $strHtmlQuestionario = $this->renderTemplate(
                'inep-zend-questionario/form-answer', array(
                    'form' => $strHtmlQuestionario,
                    'respostas' => json_encode($arrRespostas)
                )
            );
        }
        return $strHtmlQuestionario;
    }

    protected function constructQuestionario($intCoProjeto, $intCoEvento, $intIdQuestionario = null, $intCoQuestionario = null)
    {
        try {
            if ((!$intCoProjeto) || (!$intCoEvento))
                throw new InepZendException('É necessário informar um Código de Projeto e um Código de Evento.');
            $strHtmlQuestionario = null;
            $vwQuestionarioProjetoservice = $this->getService('InepZend\Module\Sqi\Service\VwQuestionarioProjeto');
            $arrQuestionarioProjeto = $vwQuestionarioProjetoservice->getQuestionarioProjeto($intCoProjeto, $intCoEvento, $intIdQuestionario, $intCoQuestionario);
            if ($arrQuestionarioProjeto) {
                $questionarioForm = new QuestionarioForm($arrQuestionarioProjeto, $intCoProjeto, $intCoEvento);
                $questionarioForm->prepareElements();
                $strHtmlQuestionario = $this->renderTemplate(
                    'inep-zend-questionario/form', array(
                        'form' => $questionarioForm
                    )
                );
            }
            return $strHtmlQuestionario;
        } catch (InepZendException $inepZendException) {
            return $inepZendException->getMessage();
        }
    }

    protected function clearCacheQuestionario()
    {
        return $this->removeAllItemCache();
    }

}
