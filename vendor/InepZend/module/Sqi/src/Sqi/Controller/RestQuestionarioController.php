<?php

namespace InepZend\Module\Sqi\Controller;

use InepZend\Controller\AbstractController;
use Zend\View\Model\JsonModel;

class RestQuestionarioController extends AbstractController
{
    /**
     * @Auth No
     * @return JsonModel
     */
    public function indexAction()
    {
        $arrInfoQuestionario = $this->getService('InepZend\Module\Sqi\Service\RestQuestionario')->getQuestionario(
            $this->params()->fromRoute('coProjeto'),
            $this->params()->fromRoute('coEvento')
        );
        return new JsonModel($arrInfoQuestionario);
    }

    /**
     * @Auth No
     * @return JsonModel
     */
    public function questionarioAction()
    {
        $arrInfoQuestionario = $this->getService('InepZend\Module\Sqi\Service\RestQuestionario')->codigoQuestionarioProjetoEvento(
            $this->params()->fromRoute('coQuestionario'),
            $this->params()->fromRoute('coEvento'),
            $this->params()->fromRoute('coProjeto')
        );
        return new JsonModel($arrInfoQuestionario);
    }
}