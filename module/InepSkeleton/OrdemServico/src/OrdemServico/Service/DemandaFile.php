<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractService;
use InepZend\Service\ServiceAngularTrait;
use InepZend\Util\String;
use OrdemServico\Entity\Demanda as DemandaEntity;
use OrdemServico\Message\Message;
use InepZend\Exception\Exception;
use OrdemServico\Entity\OrdemServico as OrdemServicoEntity;
use InepZend\View\RenderTemplate;
use InepZend\Util\Date;
use InepZend\Paginator\Paginator;

class DemandaFile extends AbstractService
{

    use Message,
        RenderTemplate,
        ServiceAngularTrait;

    static $arrGraupFP = array(
        'BBN' => 'B',
        'BBC' => 'B',
        'BMN' => 'B',
        'BMC' => 'M',
        'BAN' => 'M',
        'BAC' => 'M',
        'MBN' => 'B',
        'MBC' => 'M',
        'MMN' => 'M',
        'MMC' => 'M',
        'MAN' => 'M',
        'MAC' => 'A',
        'ABN' => 'M',
        'ABC' => 'M',
        'AMN' => 'M',
        'AMC' => 'A',
        'AAN' => 'A',
        'AAC' => 'A',
    );
    static $arrVlrGraupFP = array(
        'B' => 1,
        'M' => 2,
        'A' => 3.33
    );
    static $arrVlrFacim = array(
        'D' => 0.5,
        'PD' => 1,
        'I' => 1.25
    );

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_demanda');
    }

    protected function hasDemandaVinculadaSituacao($demanda)
    {
        $arrDemandaVinculada = $this->findBy(array('id_demanda_superior' => $demanda->getIdDemanda()));
        if (!$arrDemandaVinculada) {
            return true;
        }
        $serviceDemandaVinculada = $this->getService('OrdemServico\Service\OrdemServicoDemandaFile');
        $booSituacao = true;
        foreach ($arrDemandaVinculada as $demandaVinculada) {
            $arrOrdemServicoDemanda = $serviceDemandaVinculada->findBy(array('id_demanda' => $demandaVinculada->getIdDemanda()));
            if ($arrOrdemServicoDemanda) {
                $booSituacao = false;
            }
        }
        return $booSituacao;
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_DEMANDA_VALOR_FATOR_PONDERACAO
     */
    protected function valorFatorPonderacaoAction()
    {
        return self::$arrGraupFP;
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_DEMANDA_VALOR_MATH
     */
    protected function calcularValorMathAction($arrData)
    {
        $atividade = $this->getService('OrdemServico\Service\AtividadeFile')->find($arrData['id_atividade']);
        return round($atividade->getVlBaixoDefinido() * self::$arrVlrGraupFP[$arrData['vl_fator_ponderacao']] * self::$arrVlrFacim[$arrData['vl_facim']] * 2, 2);
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_DEMANDA_SEM_ORDEM_SERVICO
     */
    protected function listDemandaSemOrdemServicoAction($arrData = array())
    {
        try {
            $arrDemanda = $this->getRepositoryEntity()->getListDemandaSemOrdemServico($arrData);
            $arrDemandaPairs = $this->fetchPairs(array(), 'getIdDemanda', 'getNoDemanda');
            $arrDemandaGruopForm = array();
            $arrDemandaGruop = array();
            $demandaServicoFile = $this->getService('OrdemServico\Service\DemandaServicoFile');
            $cataloServico = $this->getService('OrdemServico\Service\CatalogoServicoFile');
            $catalogoAtividadeServico = $this->getService('OrdemServico\Service\CatalogoServicoAtividadeFile');
            foreach ($arrDemanda as $demanda) {
                if ($demanda->getIdDemandaSuperior()) {
                    $arrDemandaGruopForm[$demanda->getIdDemandaSuperior()][$demanda->getIdDemanda()] = array(
                        'label' => $this->mountLabelCombo($demanda),
                        'value' => $demanda->getIdDemanda(),
                        'group' => $arrDemandaPairs[$demanda->getIdDemandaSuperior()]
                    );
                } else {
                    if ($demanda->getIdAtividade()) {
                        $arrDemandaGruopForm[$demanda->getIdDemanda()][] = array(
                            'label' => $this->mountLabelCombo($demanda),
                            'value' => $demanda->getIdDemanda(),
                        );
                    } else {
                        $arrDemandaServicoFile = $demandaServicoFile->findBy(array('id_demanda' => $demanda->getIdDemanda()), [], 1);
                        if ($arrDemandaServicoFile) {
                            $arrCatologoAtividade = $catalogoAtividadeServico->findBy(array('id_catalogo_servico_atividade' => $arrDemandaServicoFile[0]->getIdCatalogoServicoAtividade()));
                            if (!$arrCatologoAtividade) {
                                continue;
                            }
                            $cataloServico->find($arrCatologoAtividade[0]->getIdCatalogoServico());
                            $arrDemandaGruopForm[$demanda->getIdDemanda()][] = array(
                                'label' => $this->mountLabelCombo($demanda),
                                'value' => $demanda->getIdDemanda(),
                            );
                        }
                    }
                }
            }
            foreach ($arrDemandaGruopForm as $intPosicao => $arrDemandaForm) {
                foreach ($arrDemandaForm as $arrDemanda) {
                    $arrDemandaGruop[] = $arrDemanda;
                }
            }
            return $arrDemandaGruop;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_DEMANDA_INFORMACAO
     */
    protected function getInforDemandaAtividadeAction($arrData)
    {
        $arrInfoAtividade = array();
        $atividadeService = $this->getService('OrdemServico\Service\AtividadeFile');
        $arrDemanda = $this->find($arrData['id_demanda'])->toArray();
        if ($arrDemanda['id_atividade']) {
            $atividade = $atividadeService->find($arrDemanda['id_atividade']);
            $arrDemanda['no_atividade'] = $atividade->getNoAtividade();
            $arrDemanda['co_atividade'] = $atividade->getCoAtividade();
            $arrInfoAtividade[] = $arrDemanda;
        } else {
            $demandaServicoFile = $this->getService('OrdemServico\Service\DemandaServicoFile');
            $arrDemandaServicoFile = $demandaServicoFile->findBy(array('id_demanda' => $arrData['id_demanda']));
            $catalogoAtividadeServico = $this->getService('OrdemServico\Service\CatalogoServicoAtividadeFile');
            foreach ($arrDemandaServicoFile as $intPosicao => $demandaServico) {
                $arrInfoAtividade[$intPosicao] = array_merge($arrDemanda, $demandaServico->toArray());
                $catalogoAtividade = $catalogoAtividadeServico->find($demandaServico->getIdCatalogoServicoAtividade());
                $atividade = $atividadeService->find($catalogoAtividade->getIdAtividade());
                $arrInfoAtividade[$intPosicao]['no_atividade'] = $atividade->getNoAtividade();
                $arrInfoAtividade[$intPosicao]['co_atividade'] = $atividade->getCoAtividade();
                $arrInfoAtividade[$intPosicao]['id_servico'] = $catalogoAtividade->getIdCatalogoServico();
            }
        }
        return $arrInfoAtividade;
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_DEMANDA_INFORMACAO_GRUPO
     */
    protected function getInformationGrupoAction($arrData)
    {
        $demanda = $this->find($arrData['id_demanda']);
        $arrDemanda = $demanda->toArray();
        if ($arrDemanda['id_demanda_superior']) {
            $demandaSuperior = $this->find($arrDemanda['id_demanda_superior']);
            $arrDemanda['group'] = $demandaSuperior->getNoDemanda();
        }
        $arrDemanda['label'] = $this->mountLabelCombo($demanda);
        return $arrDemanda;
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_DELETE
     */
    protected function deleteAction(array $arrData, $entity = null)
    {
        try {
            $this->begin();
            $demanda = $this->find($arrData['id_demanda']);
            $this->hasDemandaUsuarioLogadoPreposto($demanda->getNoExecutor());
            similar_text($this->getIdentity()->usuarioSistema->usuario->nome, $demanda->getNoExecutor(), $intPercent);
            if ($intPercent <= 90) {
                throw new Exception($this->strMsgE3);
            }
            $arrOrdemDemandaFile = $this->getService('OrdemServico\Service\OrdemServicoDemandaFile')
                ->findBy(array('id_demanda' => $arrData['id_demanda']));
            if ($arrOrdemDemandaFile) {
                throw new Exception($this->strMsgE1);
            }
            if ($demanda->getTpSituacao() != DemandaEntity::SITUACAO_ATIVO) {
                throw new Exception($this->strMsgE2);
            }
            $this->delete($demanda->toArray());
            $this->commit();
            return $demanda;
        } catch (\Exception $exception) {
            $this->rollback();
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_SITUACAO_DEMANDA_VINCULADA
     */
    protected function hasSituacaoDemandaVinculadaAction(array $arrData)
    {
        $arrDemandaOrdem = $this->getService('OrdemServico\Service\OrdemServicoDemandaFile')->findBy($arrData);
        if (!$arrDemandaOrdem)
            return false;
        $ordemServico = $this->getService('OrdemServico\Service\OrdemServicoFile')->find($arrDemandaOrdem[0]->getIdOrdemServico());
        if (OrdemServicoEntity::CO_SITUACAO_FINALIZADA == $ordemServico->getTpSituacao())
            return true;
        if (OrdemServicoEntity::CO_SITUACAO_ANALISE == $ordemServico->getTpSituacao() && $ordemServico->getNoFiscalTecnico() != $this->getIdentity()->usuarioSistema->usuario->nome)
            return true;
        return false;
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_SAVE
     */
    protected function saveAction(array $arrData)
    {
        try {
            $this->begin();
            # verificando se existe demanda cadastrada
            if (!$this->hasDemandaExistente($arrData)) {
                throw new \Exception('Demanda já cadastrada no sistema.');
            }
            $this->validarSituaacaoOrdemServicoAntesVinculo($arrData);
            if (empty($arrData['tp_situacao'])) {
                $arrData['tp_situacao'] = DemandaEntity::SITUACAO_ATIVO;
            }
            $arrCartalogoServico = $arrData['catalogo_servico_vinculo'];
            unset($arrData['catalogo_servico_vinculo']);
            $arrData['dt_abertura'] = Date::convertDate($arrData['dt_abertura']);
            $intIdUsuarioAlteracao = $this->getIdUsuarioLogado();
            $arrData['id_usuario_alteracao'] = $intIdUsuarioAlteracao;
            $arrData['dt_alteracao'] = date('Y-m-d H:i:s');
            $usuario = $this->getService('OrdemServico\Service\UsuarioFile')->find($arrData['id_usuario']);
            $arrData['no_executor'] = $usuario->getNoUsuario();
            $this->hasDemandaUsuarioLogadoPreposto($arrData['no_executor']);
            $arrData['no_projeto'] = String::beautifulProperName($arrData['no_projeto']);
            $demanda = $this->save($arrData);
            $this->verificarIntervaloDataOrdemServico($demanda, $arrData['id_ordem_servico']);
            $this->vincularAtividadeDemandaServico($arrCartalogoServico, $demanda->getIdDemanda(), $intIdUsuarioAlteracao);
            $this->getService('OrdemServico\Service\OrdemServicoDemandaFile')->vincularDemandaOrdemServico(
                $arrData['id_ordem_servico'],
                $demanda->getIdDemanda()
            );
            $this->commit();
            return $demanda;
        } catch (\Exception $exeption) {
            $this->rollback();
            throw $exeption;
        }
    }

    /**
     * Metodo responsavel por verificar o inervalo de data.
     *
     * @param DemandaEntity $demanda
     * @param $intIdOrdemServico
     * @throws \Exception
     */
    protected function verificarIntervaloDataOrdemServico(DemandaEntity $demanda, $intIdOrdemServico)
    {
        $strDateDemanda = Date::convertDate($demanda->getDtAbertura());
        if ($strDateDemanda > date('Y-m-d')) {
            throw new \Exception('Data de abertura da Demanda maior que a Data Atual.');
        }
//        $ordemServico = $this->getService('OrdemServico\Service\OrdemServicoFile')->find($intIdOrdemServico);
//        $strDateEmissao = Date::convertDate($ordemServico->getDtEmissao());
//        $strDatePrazo = Date::convertDate($ordemServico->getDtPrazo());
//        if ((($strDateDemanda >= $strDateEmissao) && ($strDateDemanda <= $strDatePrazo)) == false) {
//            throw new \Exception('Data de abertura da demanda fora do prazo estabelecido na Ordem de Servico.');
//        }
    }

    /**
     * Metodo responsavel por validar a situacao da ordem de servico antes de vincular.
     *
     * @param $arrData
     * @throws \Exception
     */
    protected function validarSituaacaoOrdemServicoAntesVinculo($arrData)
    {
        $serviceOrdemServico = $this->getService('OrdemServico\Service\OrdemServicoFile');
        $arrOrdemServicoFile = $serviceOrdemServico->findBy([
            'id_ordem_servico' => $arrData['id_ordem_servico'],
            'tp_situacao' => OrdemServicoEntity::CO_SITUACAO_ABERTA
        ]);
        if (!$arrOrdemServicoFile) {
            throw new \Exception('A OS: ' . $arrOrdemServicoFile[0]->getDescricaoOrdemServico() . ' não encontra-se aberta.');
        }
    }

    protected function vincularAtividadeDemandaServico($arrCatalogoServico, $intIdDemanda, $intIdUsuarioAlteracao)
    {
        try {
            if (!$arrCatalogoServico) {
                throw new \Exception('Não foi encontrada atividades vinculadas a demanda.');
            }
            $demandaCatalogoService = $this->getService('OrdemServico\Service\DemandaServicoFile');
            $arrDemandaServico = $demandaCatalogoService->findBy(array('id_demanda' => $intIdDemanda));
            if ($arrDemandaServico) {
                foreach ($arrDemandaServico as $demandaServico) {
                    $demandaCatalogoService->delete($demandaServico->toArray());
                }
            }
            $strDateAlteracao = date('Y-m-d H:i:s');
            foreach ($arrCatalogoServico as $arrInfoCatalogoSercice) {
                $arrInfoCatalogoSercice['id_demanda'] = $intIdDemanda;
                $arrInfoCatalogoSercice = $this->recalcularFatorPonderacao($arrInfoCatalogoSercice);
                $arrInfoCatalogoSercice['id_usuario_alteracao'] = $intIdUsuarioAlteracao;
                $arrInfoCatalogoSercice['dt_alteracao'] = $strDateAlteracao;
                $demandaCatalogoService->insert($arrInfoCatalogoSercice);
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_SAVE_ATIVIDADE_VINCULADA
     */
    protected function saveAtividadeVinculadaAction($arrData)
    {
        try {
            $this->begin();
            $demanda = $this->find($arrData['id_demanda']);
            # demanda que nao tem servico
            if ($demanda->getIdAtividade()) {
                $arrDemanda = array_merge($demanda->toArray(), $arrData);
                $demanda = $this->saveAction($arrDemanda);
                $arrDemanda = $demanda->toArray();
                $arrDemanda['tipo'] = 'atividade';
                $intIdAtividade = $arrDemanda['id_atividade'];
            } else {
                # demanda que contem catalogo servico
                $intIdAtividade = $arrData['id_atividade'];
                unset ($arrData['id_atividade']);
                $demanda = $this->getService('OrdemServico\Service\DemandaServicoFile')->save($arrData);
                $arrDemanda = $demanda->toArray();
            }
            $serviceAtividade = $this->getService('OrdemServico\Service\AtividadeFile');
            $arrDemanda['atividade'] = $serviceAtividade->find($intIdAtividade);
            $this->commit();
            return array('status' => true, 'demanda' => $arrDemanda);
        } catch (\Exception $exeption) {
            $this->rollback();
            throw $exeption;
        }
    }

    /**
     * Metodo responsavel por retornar o conteudo das atividades vinculadas.
     *
     * @param type $arrData
     */
    protected function atividadeVinculadoDemandaContent($arrData)
    {
        $formAtividadeVinculada = $this->getService('OrdemServico\Form\Demanda');
        $formAtividadeVinculada->prepareElementsAtividadeVinculada(
            array_key_exists('acao', $arrData),
            array_key_exists('id_catalogo_servico_atividade', $arrData)
        );
        $formAtividadeVinculada->setData($arrData);

        return $this->renderTemplate(
            'ordem-servico/catalogo-servico/_atividade-vinculada',
            array('form' => $formAtividadeVinculada)
        );
    }

    /**
     * Retorna informacoes do usuario logado
     *
     * @return mixed
     * @throws \Exception
     */
    protected function getIdUsuarioLogado()
    {
        $arrUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->findBy([
            'ds_login' => strtolower($this->getIdentity()->usuarioSistema->usuario->login)
        ]);
        if (!$arrUsuario) {
            throw new \Exception('Usuário não cadastrado no sistema.');
        }
        return $arrUsuario[0]->getIdUsuario();
    }

    /**
     * Metodo responsavel em retornar os dados da entidade parametrizada, o mesmo
     * eh utilizado em paginacao, podendo ser tambem utilizado para pesquisas
     * mais refinadas, seu retorno eh uma chamada do metodo controlCache da
     * AbstractServiceControlCache.
     *
     * @example $this->findByPaged(array('name_column' => 'value'), 'name_column_sort_name', 'ASC | DESC', $intPage, $intItemPerPage, $objectEntity->createQuery('select subcategoria from InepZend\Module\UnitTest\Entity\Subcategoria subcategoria where subcategoria = ?1')->setParameter(1, 5))));
     *
     * @param array $arrCriteria
     * @param string $strSortName
     * @param string $strSortOrder
     * @param integer $intPage
     * @param integer $intItemPerPage
     * @param mix $mixDQL
     * @return mix
     */
    public function findByPaged(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQL = null)
    {
        if (!$this->getService('OrdemServico\Service\Profile')->hasUsuarioPreposto()) {
            $arrUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->findBy([
                'ds_login' => strtolower($this->getIdentity()->usuarioSistema->usuario->login)
            ]);
            $arrCriteria['id_usuario'] = $arrUsuario[0]->getIdUsuario();
        }
        return parent::findByPaged($arrCriteria, $strSortName, $strSortOrder, $intPage, $intItemPerPage, $mixDQL);
    }

    private function mountLabelCombo($demanda)
    {
        return $demanda->getDtAbertura() . ' - [' . $demanda->getIdDemanda() . '] ' . $demanda->getNoDemanda() . ' - ' . $demanda->getNoExecutor();
    }

    /**
     * Metodo responsavel por recalcular o fator de ponderecao
     *
     * @param $arrInfoCatalogoSercice
     * @return mixed
     */
    private function recalcularFatorPonderacao($arrInfoCatalogoSercice)
    {
        $catalogoAtividadeServico = $this->getService('OrdemServico\Service\CatalogoServicoAtividadeFile')
            ->find($arrInfoCatalogoSercice['id_catalogo_servico_atividade']);
        $arrInfoCatalogoSercice['vl_qma'] = $this->calcularValorMathAction([
            'id_atividade' => $catalogoAtividadeServico->getIdAtividade(),
            'vl_fator_ponderacao' => $arrInfoCatalogoSercice['vl_fator_ponderacao'],
            'vl_facim' => $arrInfoCatalogoSercice['vl_facim'],
        ]);
        return $arrInfoCatalogoSercice;
    }

    /**
     * Metodo resposnavel por conferir se a usuario logado e preposto
     *
     * @param $strUsuarioExecutor
     * @return bool
     * @throws \Exception
     */
    private function hasDemandaUsuarioLogadoPreposto($strUsuarioExecutor)
    {
        if (!$this->getService('OrdemServico\Service\Profile')->hasUsuarioPreposto()) {
            $arrUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->findBy([
                'ds_login' => strtolower($this->getIdentity()->usuarioSistema->usuario->login)
            ]);
            if ($arrUsuario[0]->getNoUsuario() != $strUsuarioExecutor) {
                throw new \Exception('Ação não permitida.');
            }
        }
        return true;
    }

    /**
     * Metodo responsavel por impedir de duplicar demandas
     *
     * @param $arrData
     * @return bool
     */
    private function hasDemandaExistente($arrData)
    {
        $arrDemanda = [];
        if (empty($arrData['id_demanda'])) {
            $arrDemanda = $this->findBy([
                'no_demanda' => $arrData['no_demanda'],
                'dt_abertura' => Date::convertDateTemplate($arrData['dt_abertura']),
                'id_usuario' => $arrData['id_usuario'],
                'ds_descricao' => $arrData['ds_descricao'],
                'ds_solucao' => $arrData['ds_solucao'],
                'ds_ambiente' => $arrData['ds_ambiente'],
            ]);
        }
        return ($arrDemanda) ? false : true;
    }
}
