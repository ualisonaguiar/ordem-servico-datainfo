<?php

namespace OrdemServico\Controller;

use OrdemServico\Controller\AbstractController;
use OrdemServico\Entity\Usuario;
use OrdemServico\Service\RelogioPonto;

class RelatorioPontoController extends AbstractController
{
    public function __construct($strController = null, $arrVariableMerge = null)
    {
        parent::__construct($strController, $arrVariableMerge);
    }

    public function ajaxListaDemandaAction()
    {
        $arrDataPost = $this->getPost();
        $intIdUsuario = $this->getService('OrdemServico\Service\Profile')->getIdUsuarioLogado();
        $arrPairs = $this->getService('OrdemServico\Service\VwDemandaVinculadaOrdemServicoFile')->fetchPairs(
            [
                'id_usuario' => $intIdUsuario,
                'id_ordem_servico' => $arrDataPost['id_ordem_servico']
            ],
            'getIdDemanda',
            'getNoDemanda'
        );
        return $this->getViewClearContent(json_encode($arrPairs));
    }

    public function ajaxListaDemandaAtividadeAction()
    {
        $arrDataPost = $this->getPost();
        $intIdUsuario = $this->getService('OrdemServico\Service\Profile')->getIdUsuarioLogado();
        $arrPairs = $this->getService('OrdemServico\Service\VwDemandaVinculadaOrdemServicoFile')->fetchPairs(
            [
                'id_usuario' => $intIdUsuario,
                'id_demanda' => $arrDataPost['id_demanda']
            ],
            'getIdCatalogoServicoAtividade',
            'getCodigoNomeAtividade'
        );
        return $this->getViewClearContent(json_encode($arrPairs));
    }

    /**
     * @auth no
     */
    public function cronLancamentoApexAction()
    {
//        $this->getService('OrdemServico\Service\CronLancamentoApex')->lancamentoFerias(20, '2017-04-10', '2017-04-19');
        $this->getService('OrdemServico\Service\CronLancamentoApex')->init();
        return $this->getViewClearContent(json_encode(['message' => 'Lançamento finalizado']));
    }

    /**
     * @auth no
     */
    public function lancamentoManualAction()
    {
        $strMessage = '';
        try {
            $arrData = $this->getPost();
            $arrUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->findBy([
                'ds_login' => $arrData['usuario'],
                'in_ativo' => true,
                'tp_vinculo' => [
                    Usuario::CO_PERFIL_FUNCIONARIO,
                    Usuario::CO_PERFIL_PREPOSTO,
                ]
            ]);
            if (!$arrUsuario) {
                throw new \Exception('Usuário não encontrado');
            }
            $this->getService('OrdemServico\Service\RelatorioPonto')->justificarPonto([
                'dt_ponto' => $arrData['data'],
                'hr_ponto' => $arrData['hora'],
            ], $arrUsuario[0]->getIdUsuario());
            $strMessage = 'Ponto lançado';
        } catch (\Exception $exception) {
            $strMessage = $exception->getMessage();
        }
        return $this->getViewClearContent(json_encode(['message' => $strMessage]));
    }

    /**
     * @auth no
     */
    public function obterPontoAction()
    {
        $this->getService('OrdemServico\Service\RelogioPonto')->obterPonto();
        return $this->getViewClearContent(json_encode(['message' => 'ponto carregado']));
    }
}
