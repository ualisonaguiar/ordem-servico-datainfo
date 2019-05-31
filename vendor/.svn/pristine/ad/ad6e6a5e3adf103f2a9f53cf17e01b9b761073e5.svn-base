<?php

namespace InepZend\Module\Sqi\Controller;

use InepZend\Controller\AbstractController;
use InepZend\View\View;

class ExemploController extends AbstractController
{

    public function indexAction()
    {
        $intCoProjeto = $this->params()->fromRoute('coProjeto', 1416101);
        $intCoEvento = $this->params()->fromRoute('coEvento', 14);
        $questionarioService = $this->getService('InepZend\Module\Sqi\Service\Questionario');
        $arrRespostas = array('respostaRadio[3400]' => '2820', 'respostaRadio[3428]' => '2975','1744' => 'Teste', '3126' => '1', '1758' => '1', '1759' => 'Teste 2');
        return new View(array('questionario' => $questionarioService->getQuestionario($intCoProjeto, $intCoEvento, $arrRespostas)));
    }

}
