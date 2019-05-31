<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractService;
use InepZend\Service\ServiceAngularTrait;
use InepZend\Exception\Exception;
use OrdemServico\Entity\OrdemServico as OrdemServicoEntity;
use OrdemServico\Entity\OrdemServicoAceite as OrdemServicoAceiteEntity;
use OrdemServico\Entity\Usuario as UsuarioEntity;

class OrdemServicoAceiteFile extends AbstractService
{
    use ServiceAngularTrait;

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = ['idOrdemServicoAceite'];
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_ACEITE_REMOVE
     */
    protected function removerAceiteAction(array $arrData)
    {
        try {
            $this->validarAcesso();
            $aceiteOrdemServico = $this->preDelete($arrData);
            $this->arrPk = ['idOrdemServico', 'idUsuarioGestao', 'inGestao', 'inSituacao'];
            $this->delete($aceiteOrdemServico->toArray());
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_ACEITE_INSERIR
     */
    protected function inserirAction(array $arrData)
    {
        try {
            $this->validarAcesso();
            $arrData = $this->preSave($arrData);
            $intIdUsuarioLogado = $this->getservice('ordemservico\Service\Demandafile')->getidusuariologado();
            return $this->save([
                'idOrdemServico' => $arrData['id_ordem_servico'],
                'idUsuarioGestao' => $intIdUsuarioLogado,
                'inGestao' => $arrData['tp_gestao'],
                'inSituacao' => $arrData['inSituacao'],
                'idUsuarioAlteracao' => $intIdUsuarioLogado,
                'dtAlteracao' => date('Y-m-d H:i:s')
            ]);
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_ACEITE_LISTAGEM_ACEITE_GESTAO
     */
    protected function getListaAceiteGestaoAction(array $arrData)
    {
        $arrAceiteOrdemServico = $this->findBy(['idOrdemServico' => $arrData['id_ordem_servico']]);
        $arrListagemAceiteGestao = [];
        if ($arrAceiteOrdemServico) {
            $arrNivelAceite = OrdemServicoAceiteEntity::$arrNivelAceite;
            $usuarioService = $this->getService('OrdemServico\Service\UsuarioFile');
            foreach ($arrAceiteOrdemServico as $intPosicao => $aceiteOrdemServico) {
                $usuario = $usuarioService->find($aceiteOrdemServico->getIdUsuarioGestao());
                $arrListagemAceiteGestao[$intPosicao]['inGestao'] = $aceiteOrdemServico->getInGestao();
                $arrListagemAceiteGestao[$intPosicao]['situacao'] = strtolower($arrNivelAceite[$aceiteOrdemServico->getInSituacao()]);
                $arrListagemAceiteGestao[$intPosicao]['inSituacao'] = $aceiteOrdemServico->getInSituacao();
                $arrListagemAceiteGestao[$intPosicao]['usuario'] = $usuario->getNoUsuario() . ' (' . $usuario->getDsLogin() . ')';
            }
        }
        return $arrListagemAceiteGestao;
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_ACEITE_LOTE
     */
    protected function aceiteLoteAction(array $arrData)
    {
        try {
            $this->begin();
            $this->validarAcesso();
            $arrData = $this->validarAceiteLote($arrData);
            foreach ($arrData['gestao'] as $intIdGestao) {
                foreach ($arrData['ordem_servico'] as $intIdOrdemServico) {
                    $this->inserirAction([
                        'id_ordem_servico' => $intIdOrdemServico,
                        'tp_gestao' => $intIdGestao,
                    ]);
                    $this->inserirAction([
                        'id_ordem_servico' => $intIdOrdemServico,
                        'tp_gestao' => $intIdGestao,
                    ]);
                }
            }
            $this->commit();
        } catch (\Exception $exception) {
            $this->rollback();
            throw new Exception($exception->getMessage());
        }
    }

    protected function preSave($arrData)
    {
        $arrAceiteOrdem = $this->findBy([
            'idOrdemServico' => $arrData['id_ordem_servico'],
            'inGestao' => $arrData['tp_gestao'],
        ]);
        if (!$arrAceiteOrdem) {
            $arrData['inSituacao'] = OrdemServicoAceiteEntity::CO_NIVEL_ACEITE_INICIAL;
        } elseif (count($arrAceiteOrdem) > 1) {
            $usuario = $this->getService('OrdemServico\Service\UsuarioFile')->find($arrAceiteOrdem[1]->getIdUsuarioAlteracao());
            $ordemServico = $this->getService('OrdemServico\Service\OrdemServicoFile')->find($arrData['id_ordem_servico']);
            $strMessage = 'A OS ' . $ordemServico->getNuOrdemServico() .' já esta com aceite final pelo: ' . $usuario->getNoUsuario() . ' (' . $usuario->getDsLogin() . ')';
            throw new \Exception($strMessage);
        } else {
            $arrData['inSituacao'] = OrdemServicoAceiteEntity::CO_NIVEL_ACEITE_FINAL;
        }
        if (
            $arrData['tp_gestao'] == OrdemServicoAceiteEntity::CO_ACEITE_GESTOR_CONTRATO &&
            $this->getService('OrdemServico\Service\Profile')->hasUsuarioGestorContrato() === false
        ) {
            throw new \Exception('Ação não permitida.');
        }
        return $arrData;
    }

    protected function preDelete($arrData)
    {
        $arrAceiteOrdem = $this->findBy([
            'idOrdemServico' => $arrData['id_ordem_servico'],
            'inGestao' => $arrData['tp_gestao']
        ]);
        if (!$arrAceiteOrdem) {
            throw new \Exception('Ação não permitida.');
        }
        $aceiteOrdemServico = end($arrAceiteOrdem);
        $this->hasUsuarioAcessoRemover($aceiteOrdemServico);
        $ordemServico = $this->getService('OrdemServico\Service\OrdemServicoFile')->find($arrData['id_ordem_servico']);
        $arrSituacaoOrdemServicoLock = [
            OrdemServicoEntity::CO_SITUACAO_SUSPENSO,
            OrdemServicoEntity::CO_SITUACAO_FINALIZADA
        ];
        if (in_array($ordemServico->getTpSituacao(), $arrSituacaoOrdemServicoLock)) {
            throw new \Exception(
                'Ação não permitida. Esta OS encontra-se ' . OrdemServicoEntity::$arrSituacaoDemanda[$ordemServico->getTpSituacao()]
            );
        }
        return $aceiteOrdemServico;
    }

    protected function validarAceiteLote($arrData)
    {
        $arrData['ordem_servico'] = array_unique($arrData['ordem_servico']);
        $arrData['gestao'] = array_unique($arrData['gestao']);
        $serviceProfile = $this->getService('OrdemServico\Service\Profile');
        $arrGestao = [
            UsuarioEntity::CO_PERFIL_SERVIDOR => [
                OrdemServicoAceiteEntity::CO_ACEITE_FISCAL_REQUISITANTE,
                OrdemServicoAceiteEntity::CO_ACEITE_FISCAL_TECNICO,
                OrdemServicoAceiteEntity::CO_ACEITE_GESTOR_CONTRATO
            ],
            UsuarioEntity::CO_PERFIL_PREPOSTO => [
                OrdemServicoAceiteEntity::CO_ACEITE_PREPOSTO
            ]
        ];
        $arrGestao = $arrGestao[$serviceProfile->getTipoVinculo()];
        # verificando o perfil do usuario
        foreach ($arrData['gestao'] as $intIdGestao) {
            if (
                (!in_array($intIdGestao, $arrGestao)) &&
                ($intIdGestao == OrdemServicoAceiteEntity::CO_ACEITE_GESTOR_CONTRATO && $serviceProfile->hasUsuarioGestorContrato() == false)
            ) {
                throw new \Exception('Ação não permitida.');
            }
        }

        # verificando se alguma os esta finalizada
        $serviceOrdemServico = $this->getService('OrdemServico\Service\OrdemServicoFile');
        foreach ($arrData['ordem_servico'] as $intIdOrdemServico) {
            $ordemServico = $serviceOrdemServico->find($intIdOrdemServico);
            if ($ordemServico->getTpSituacao() == OrdemServicoEntity::CO_SITUACAO_FINALIZADA) {
                throw new \Exception('A OS:' . $ordemServico->getNuOrdemServico() . ' encontra-se finalizada.');
            }
        }
        return $arrData;
    }

    private function validarAcesso()
    {
        $serviceProfile = $this->getService('OrdemServico\Service\Profile');
        if ($serviceProfile->hasUsuarioPreposto() == false &&
            $serviceProfile->hasUsuarioServidor() == false &&
            $serviceProfile->hasUsuarioGestorContrato() == false
        ) {
            throw new \Exception('Ação não permitida.');
        }
    }

    private function hasUsuarioAcessoRemover($aceiteOrdemServico)
    {
        $serviceProfile = $this->getService('OrdemServico\Service\Profile');
        if (
            $aceiteOrdemServico->getIdUsuarioGestao() != $this->getservice('ordemservico\Service\Demandafile')->getidusuariologado() &&
            $serviceProfile->hasUsuarioPreposto() == false &&
            $serviceProfile->hasUsuarioGestorContrato() == false
        ) {
            throw new \Exception('Ação não permitida.');
        }
    }
}
