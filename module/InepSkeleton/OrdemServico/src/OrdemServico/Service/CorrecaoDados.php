<?php
/**
 * Created by PhpStorm.
 * User: ualiosn
 * Date: 17/08/16
 * Time: 18:59
 */

namespace OrdemServico\Service;

use InepZend\Mail\Mail;
use InepZend\Service\AbstractServiceManager;
use InepZend\Util\Date;
use OrdemServico\Entity\OrdemServico;
use OrdemServico\Entity\OrdemServicoAceite;
use OrdemServico\Entity\Usuario as UsuarioEntity;

class CorrecaoDados extends AbstractServiceManager
{
    public function correcaoDemandaDataAction()
    {
        $serviceDemanda = $this->getService('OrdemServico\Service\DemandaServicoFile');
        try {
            $serviceDemanda->begin();
            $this->validarValoresOrdemServico();
//            $this->correcaoAceiteFinal();
//            $this->correcaoDataOrdemServico();
//            $this->correcaoVinculoDemandaOrdemServico();
//            $this->correcaoDataDemanda();
            $serviceDemanda->commit();
            
        } catch (\Exception $exception) {
            $serviceDemanda->rollback();
            $mail = new Mail();
            $mail->sendMail(
                'Ocorreu o seguinte erro durante a execução: [' . date('d/m/Y H:i:s') . '] ' . $exception->getMessage(),
                '[Ordem de Serviço - Erro] Correção dos dados',
                'ualison.frota@datainfo.inf.br'
            );
            \InepZend\Util\Debug::debug($exception->getMessage(), true);
        }
    }

    protected function correcaoAceiteFinal()
    {
        $arrUsuarioNumeroOs = [
            31 => [990, 986, 966, 951, 931, 930, 917, 916, 905],
            27 => [993, 987, 978, 968, 965, 946, 935, 933]
        ];
        foreach ($arrUsuarioNumeroOs as $intIdUsuario => $arrOrdemServico) {
            $this->correcaoAceiteUsuario($intIdUsuario, $arrOrdemServico);
        }
    }

    protected function correcaoAceiteUsuario($intIdUsuario, $arrOrdemServico)
    {
        $arrOrdemServico = $this->getService('OrdemServico\Service\OrdemServicoFile')->findBy(['nu_ordem_servico' => $arrOrdemServico]);
        foreach ($arrOrdemServico as $ordemServico) {
            $arrAceites = [
                OrdemServicoAceite::CO_ACEITE_FISCAL_REQUISITANTE => [OrdemServicoAceite::CO_NIVEL_ACEITE_INICIAL, OrdemServicoAceite::CO_NIVEL_ACEITE_FINAL],
                OrdemServicoAceite::CO_ACEITE_FISCAL_TECNICO => [OrdemServicoAceite::CO_NIVEL_ACEITE_INICIAL, OrdemServicoAceite::CO_NIVEL_ACEITE_FINAL],
            ];
            foreach ($arrAceites as $intGestao => $arrSituacao) {
                foreach ($arrSituacao as $intSituacao) {
                    if (!$this->validarDuplicacaoAceite(
                        $ordemServico->getIdOrdemServico(),
                        $intGestao,
                        $intSituacao)
                    ) {
                        $this->getService('OrdemServico\Service\OrdemServicoAceiteFile')->save([
                            'idOrdemServico' => $ordemServico->getIdOrdemServico(),
                            'idUsuarioGestao' => $intIdUsuario,
                            'inGestao' => $intGestao,
                            'inSituacao' => $intSituacao,
                            'idUsuarioAlteracao' => $intIdUsuario,
                            'dtAlteracao' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
            }
        }
    }

    public function correcaoNomeExecutor()
    {
        $arrNomeErrado = [
            [
                'errado' => 'Thiago Lenin Souza Silva Batista',
                'certo' => 'Thiago Lenin Sousa Silva Batista',
            ]
        ];
        try {
            $serviceDemanda = $this->getService('OrdemServico\Service\DemandaFile');
            $serviceDemanda->begin();
            foreach ($arrNomeErrado as $arrNomeExecutor) {
                $arrDemandaExecutor = $serviceDemanda->findBy(['no_executor' => $arrNomeExecutor['errado']]);
                if ($arrDemandaExecutor) {
                    foreach ($arrDemandaExecutor as $demanda) {
                        $demanda->setNoExecutor($arrNomeExecutor['certo']);
                        $arrDemanda = $demanda->toArray();
                        $arrDemanda['dt_abertura'] = Date::convertDate($arrDemanda['dt_abertura'], 'Y-m-d');
                        $arrDemanda['dt_alteracao'] = date('Y-m-d H:i:s');
                        $arrDemanda['id_usuario_alteracao'] = 1;
                        $serviceDemanda->save($arrDemanda);
                    }
                }
            }
            $serviceDemanda->commit();
        } catch (\Exception $exception) {
            $serviceDemanda->rollback();
            var_dump($exception->getMessage());
            die;
        }
    }

    protected function correcaoDataOrdemServico()
    {
        $arrOrdemServico = $this->getService('OrdemServico\Service\OrdemServicoFile')->findBy();
        foreach ($arrOrdemServico as $ordemServico) {
            $arrInfoOrdemServico = $ordemServico->toArray();
            if (Date::isDateTemplate($arrInfoOrdemServico['dt_prazo'])) {
                $arrInfoOrdemServico['dt_prazo'] = Date::convertDate($arrInfoOrdemServico['dt_prazo'], 'Y-m-d H:i:s');
            }
            if (Date::isDateTemplate($arrInfoOrdemServico['dt_emissao'])) {
                $arrInfoOrdemServico['dt_emissao'] = Date::convertDate($arrInfoOrdemServico['dt_emissao'], 'Y-m-d H:i:s');
            }
            if (Date::isDateTemplate($arrInfoOrdemServico['dt_recepcao'])) {
                $arrInfoOrdemServico['dt_recepcao'] = Date::convertDate($arrInfoOrdemServico['dt_recepcao'], 'Y-m-d H:i:s');
            }
            $this->getService('OrdemServico\Service\OrdemServicoFile')->update($arrInfoOrdemServico);
        }
    }

    protected function correcaoVinculoDemandaOrdemServico()
    {
        $arrOrdemServico = $this->getService('OrdemServico\Service\OrdemServicoDemandaFile')->findBy();
        $arrOrdemServicoBkp = [];
        foreach ($arrOrdemServico as $ordemServicoDemanda) {
            $arrOrdemServicoBkp[$ordemServicoDemanda->getIdOrdemServico() . '-' . $ordemServicoDemanda->getIdDemanda()] = [
                'id_ordem_servico' => $ordemServicoDemanda->getIdOrdemServico(),
                'id_demanda' => $ordemServicoDemanda->getIdDemanda(),
            ];
            $this->getService('OrdemServico\Service\OrdemServicoDemandaFile')->delete($ordemServicoDemanda->toArray());
        }
        foreach ($arrOrdemServicoBkp as $arrOrdemServico) {
            $this->getService('OrdemServico\Service\OrdemServicoDemandaFile')->insert($arrOrdemServico);
        }
    }

    protected function correcaoDataDemanda()
    {
        $arrOrdemServico = $this->getService('OrdemServico\Service\OrdemServicoFile')->findBy([
            'tp_situacao' => [
                OrdemServico::CO_SITUACAO_ABERTA,
                OrdemServico::CO_SITUACAO_ANALISE,
                OrdemServico::CO_SITUACAO_SUSPENSO
            ]
        ]);
        $ordemServicoDemandaService = $this->getService('OrdemServico\Service\OrdemServicoDemandaFile');
        $demandaFile = $this->getService('OrdemServico\Service\DemandaFile');
        foreach ($arrOrdemServico as $ordemServico) {
            $arrOrdemDemandaServico = $ordemServicoDemandaService->findBy(['id_ordem_servico' => $ordemServico->getIdOrdemServico()]);
            foreach ($arrOrdemDemandaServico as $ordemDemandaServico) {
                $demanda = $demandaFile->find($ordemDemandaServico->getIdDemanda());
                $arrDemanda = $demanda->toArray();
                $arrDemanda['dt_abertura'] = Date::convertDate($demanda->getDtAlteracao());
                $arrDemanda['dt_alteracao'] = Date::convertDate($demanda->getDtAlteracao(), 'Y-m-d H:i:s');
                $demandaFile->save($arrDemanda);
            }
        }
    }

    protected function validarValoresOrdemServico()
    {
        $strDtInicioProcessamento = date('Y-m-d H:i:s');
        $demandaServiceFile = $this->getService('OrdemServico\Service\DemandaServicoFile');
        $catalogoServicoAtividade = $this->getService('OrdemServico\Service\CatalogoServicoAtividadeFile');
        $demanda = $this->getService('OrdemServico\Service\DemandaFile');
        $arrVlrFacim = $demanda::$arrGraupFP;
        $arrOrdemServicoVinculadoDemanda = $this->getService('OrdemServico\Service\OrdemServicoDemandaFile')->fetchPairs([], 'getIdDemanda', 'getIdOrdemServico');
        $arrOrdemServico = $this->getService('OrdemServico\Service\OrdemServicoFile')->fetchPairs(
            [
                'tp_situacao' => [OrdemServico::CO_SITUACAO_ABERTA, OrdemServico::CO_SITUACAO_ANALISE, OrdemServico::CO_SITUACAO_SUSPENSO]
            ],
            'getIdOrdemServico',
            'getNuOrdemServico'
        );
        foreach ($arrOrdemServicoVinculadoDemanda as $intIdDemanda => $intIdOrdemServico) {
            if (!array_key_exists($intIdOrdemServico, $arrOrdemServico)) {
                unset($arrOrdemServicoVinculadoDemanda[$intIdDemanda]);
            }
        }
        $arrDemandaServico = $demandaServiceFile->findBy(['id_demanda' => array_keys($arrOrdemServicoVinculadoDemanda)]);
        foreach ($arrDemandaServico as $demandaServico) {
            $arrCatalogoAtividade = $catalogoServicoAtividade
                ->findBy([
                    'id_catalogo_servico_atividade' => $demandaServico->getIdCatalogoServicoAtividade()
                ]);
            $strFatorPonderacao = $arrVlrFacim[$demandaServico->getVlComplexidade() . $demandaServico->getVlImpacto() . $demandaServico->getVlCriticidade()];
            $intVlrQma = $demanda->calcularValorMathAction([
                'id_atividade' => $arrCatalogoAtividade[0]->getIdAtividade(),
                'vl_fator_ponderacao' => $strFatorPonderacao,
                'vl_facim' => $demandaServico->getVlFacim()
            ]);
            $arrDemandaServicoBd = $demandaServico->toArray();
            $arrDemandaServicoBd['vl_fator_ponderacao'] = $strFatorPonderacao;
            $arrDemandaServicoBd['vl_qma'] = $intVlrQma;
            $demandaServiceFile->update($arrDemandaServicoBd);
        }
        $this->getService('OrdemServico\Service\LogVerificacaoDadosFile')->save([
            'dt_incio' => $strDtInicioProcessamento,
            'dt_fim' => date('Y-m-d H:i:s'),
            'nu_quantidade_demandas' => count($arrDemandaServico),
            'ds_demanda_corrigidas' => implode(',', array_keys($arrOrdemServicoVinculadoDemanda))
        ]);
    }

    /**
     * Metodo responsavel por migrar os dados do antigo formato do nome executor para o id da tabela usuario
     */
    protected function migrarDados()
    {
        $serviceDemanda = $this->getService('OrdemServico\Service\DemandaFile');
        try {
            $serviceDemanda->begin();
            $arrUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->fetchPairs([], 'getNoUsuario', 'getIdUsuario');
            $OrdemSevicoSevice = $this->getService('OrdemServico\Service\OrdemServicoDemandaFile');
            $arrDemanda = $serviceDemanda->findBy([], ['id_demanda' => 'asc']);
            $serviceDemanda::setFlush(false);
            foreach ($arrDemanda as $demanda) {
                $intIdUsuario = $arrUsuario[$demanda->getNoExecutor()];
                if ($intIdUsuario) {
                    $demanda->setVlComplexidade(null)
                        ->setVlImpacto(null)
                        ->setVlCriticidade(null)
                        ->setVlFatorPonderacao(null)
                        ->setVlFacim(null)
                        ->setVlQma(null)
                        ->setIdUsuario($intIdUsuario);
                    $serviceDemanda->getEntityManager()->persist($demanda);
                    $arrDemandaServico = $OrdemSevicoSevice->findBy(['id_demanda' => $demanda->getIdDemanda()]);
                    if ($arrDemandaServico) {
                        $ordemServicoDemanda = reset($arrDemandaServico);
                        $ordemServicoDemanda->setIdUsuarioAlteracao($demanda->getIdUsuario())
                            ->setDtAlteracao(Date::convertDateTemplate($demanda->getDtAbertura()));
                        $OrdemSevicoSevice->getEntityManager()->persist($demanda);
                    }
                }
            }
            $serviceDemanda::setFlush(true);
            $serviceDemanda->commit();
        } catch (\Exception $exception) {
            $serviceDemanda->rollback();
            var_dump($exception->getMessage());
            die;
        }
    }

    protected function cadastrarFiscal()
    {
        $arrResponsaveis = $this->getService('config')['responsavel-ordem-servico'];
        $ldaprdn = 'inep\ualison.frota';
        $ldappass = 'Uapf004*';
        $ldapconn = ldap_connect('172.29.0.21') or die('Não foi possível estabelecer conexão ao ldap\n');
        ldap_bind($ldapconn, $ldaprdn, $ldappass) or die('Não foi possível estabelecer conexão ao ldap - usuario e senha errada\n');
        $arrErro = [];
        $serviceUsuario = $this->getService('OrdemServico\Service\UsuarioFile');
        $serviceUsuario->begin();
        foreach ($arrResponsaveis as $arrResponsavel) {
            foreach ($arrResponsavel as $strResponsavel) {
                try {
                    $this->registrarFiscal($ldapconn, $strResponsavel);
                } catch (\Exception $exception) {
                    $arrErro[] = $exception->getMessage();
                    continue;
                }
            }
        }
        if ($arrErro) {
            $serviceUsuario->rollback();
            d($arrErro, 1);
        }
        $serviceUsuario->commit();
    }

    protected function registrarFiscal($ldapconn, $strNome)
    {
        $strNome = \InepZend\Util\String::clearWord($strNome);
        $result = ldap_search($ldapconn, 'OU=INEP,DC=inep,DC=gov,DC=br', "(CN=$strNome)");
        $arrData = ldap_get_entries($ldapconn, $result);
        if (!$arrData['count']) {
            throw new \Exception('Usuario nao encontrado no ldap: ' . $strNome);
        }
        $arrData = $arrData[0];
        $serviceUsuario = $this->getService('OrdemServico\Service\UsuarioFile');
        $strLogin = utf8_encode(strtolower(trim($arrData['samaccountname'][0])));
        if (!$strLogin) {
            throw new \Exception('Login não encontrado do usuário: ' . $strNome);
        }
        $arrUsuario = $serviceUsuario->findBy(['ds_login' => $strLogin]);
        if (!$arrUsuario) {
            $serviceUsuario->save([
                'no_usuario' => utf8_encode($arrData['cn'][0]),
                'ds_email' => $arrData['mail'][0],
                'ds_login' => $strLogin,
                'tp_vinculo' => UsuarioEntity::CO_PERFIL_SERVIDOR,
                'in_ativo' => UsuarioEntity::CO_SITUACAO_ATIVO,
            ]);
        }
    }

    private function validarDuplicacaoAceite($intIdOrdemServio, $intGestao, $intSituacao)
    {
        $arrOrdemAceite = $this->getService('OrdemServico\Service\OrdemServicoAceiteFile')->findBy([
            'idOrdemServico' => $intIdOrdemServio,
            'inGestao' => $intGestao,
            'inSituacao' => $intSituacao
        ]);
        return ($arrOrdemAceite) ? true : false;
    }
}