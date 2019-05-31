<?php

namespace InepZend\Module\Sqi\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Util\Format;
use InepZend\WebService\Client\Corporative\Inep\RestCorp;

class RestQuestionario extends AbstractServiceManager
{
    protected function getQuestionario($intCoProjeto, $intCoEvento)
    {
        $arrInfoQuestionario = [
            'status' => true
        ];
        try {
            $restCorp = new RestCorp();
            $arrQuestionario = $restCorp->questionarioProjetoEvento($intCoProjeto, $intCoEvento);
            if (!$arrQuestionario) {
                throw new \Exception('Questionário não encontrado');
            }
            $arrInfoQuestionario['hash'] = md5(serialize(($arrQuestionario)));
            $arrInfoQuestionario['questionario'] = $arrQuestionario;
        } catch (\Exception $exception) {
            $arrInfoQuestionario['status'] = false;
            $arrInfoQuestionario['message'] = $exception->getMessage();
        }
        return $arrInfoQuestionario;
    }

    protected function codigoQuestionarioProjetoEvento($intcoQuestionario, $intCoEvento, $intCoProjeto)
    {
        $arrInfoQuestionario = [
            'status' => true
        ];
        try {
            $restCorp = new RestCorp();
            $arrQuestionario = $restCorp->codigoQuestionarioProjetoEvento($intcoQuestionario, $intCoEvento, $intCoProjeto);
            if (!$arrQuestionario) {
                throw new \Exception('Questionário não encontrado');
            }
            $arrInfoQuestionario['hash'] = md5(serialize(($arrQuestionario)));
            $arrInfoQuestionario['questionario'] = $arrQuestionario;
        } catch (\Exception $exception) {
            $arrInfoQuestionario['status'] = false;
            $arrInfoQuestionario['message'] = $exception->getMessage();
        }
        return $arrInfoQuestionario;
    }
}