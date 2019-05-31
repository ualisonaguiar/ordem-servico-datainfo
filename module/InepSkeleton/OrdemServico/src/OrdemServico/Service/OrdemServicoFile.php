<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractService;
use InepZend\Paginator\Paginator;
use OrdemServico\Entity\OrdemServico as OrdemServicoEntity;
use InepZend\View\RenderTemplate;
use InepZend\Pdf\Vendor\mpdf\Mpdf;
use InepZend\Exception\Exception;
use OrdemServico\Message\Message;
use OrdemServico\Entity\Demanda as DemandaEntity;
use InepZend\Util\String;
use InepZend\Service\ServiceAngularTrait;
use InepZend\Util\ArrayCollection;
use InepZend\Compression\ZipFile;
use InepZend\Util\FileSystem;
use OrdemServico\Entity\OrdemServicoAceite as OrdemServicoAceiteEntity;

class OrdemServicoFile extends AbstractService
{

    use RenderTemplate,
        Message,
        ServiceAngularTrait;

    protected $intNumeroAtual = 634;
    protected $strNameFile = 'OS_%s_%s.pdf';

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_ordem_servico');
    }

    public function saveAction(array $arrData, array $arrSetterFk = array())
    {
        try {
            $this->begin();
            if (!array_key_exists('tp_situacao', $arrData)) {
                $arrData['tp_situacao'] = OrdemServicoEntity::CO_SITUACAO_ABERTA;
            }
            $arrData['dt_alteracao'] = date('Y-m-d H:i:s');
            $usuarioAlteracao = reset($this->getService('OrdemServico\Service\UsuarioFile')->findBy([
                'ds_login' => strtolower($this->getIdentity()->usuarioSistema->usuario->login)
            ]));
            $arrData['id_usuario_alteracao'] = $usuarioAlteracao->getIdUsuario();
            $ordemServico = $this->save($arrData, $arrSetterFk);
            if (!empty($arrData['id_demanda_vinculada'])) {
                $this->vincularDemandaOrdemServio($arrData, $ordemServico->getIdOrdemServico());
            }
            $this->commit();
            if (empty($arrData['id_ordem_servico'])) {
                $serviceOrdemSubversion = $this->getService('OrdemServico\Form\OrdemServicoSubversion');
                $arrData['ds_svn'] = $serviceOrdemSubversion->createPaste($arrData['ds_nome'], $usuarioAlteracao);
                $arrInformationSvn = $this->getService('config')['informacao-svn'];
                $intNumeroOs = intval(str_replace($arrInformationSvn['path'] . '/OS', '', $arrData['ds_svn']));
                $ordemServico->setNuOrdemServico($intNumeroOs);
                $ordemServico = $this->save($ordemServico->toArray());
            }
            return $ordemServico;
        } catch (\Exception $exception) {
            $this->rollback();
            throw new \Exception($exception->getMessage());
        }
    }

    public function findByPaged(
        array $arrCriteria = null,
        $strSortName = null,
        $strSortOrder = null,
        $intPage = 1,
        $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQLQuery = null
    ) {
        if (isset($arrCriteria['tp_gestao_first'])) {
            unset($arrCriteria['tp_gestao_first']);
        }
        if (isset($arrCriteria['tp_gestao_last'])) {
            unset($arrCriteria['tp_gestao_last']);
        }
        $arrOrdemSevicoList = $this->getRepositoryEntity()->getListagem($arrCriteria);
        $serviceOrdemServicoAceite = $this->getService('OrdemServico\Service\OrdemServicoAceiteFile');
        foreach ($arrOrdemSevicoList as $intPosicao => $ordemServico) {
            $arrOrdemSevicoList[$intPosicao] = $ordemServico->toArray();
            $arrOrdemSevicoList[$intPosicao]['situacao'] = OrdemServicoEntity::$arrSituacaoDemanda[$ordemServico->getTpSituacao()];
            foreach (array_keys(OrdemServicoAceiteEntity::$arrGestao) as $intGestao) {
                $arrOrdemSevicoList[$intPosicao]['aceite_' . $intGestao] = '';
            }
            $arrAceites = $serviceOrdemServicoAceite->findBy([
                'idOrdemServico' => $ordemServico->getIdOrdemServico(),
                'inSituacao' => OrdemServicoAceiteEntity::CO_NIVEL_ACEITE_FINAL
            ]);
            if ($arrAceites) {
                foreach ($arrAceites as $aceite)
                    $arrOrdemSevicoList[$intPosicao]['aceite_' . $aceite->getInGestao()] = 'check';
            }
        }
        return new Paginator($arrOrdemSevicoList, $intPage, $intItemPerPage);
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_DELETE
     */
    protected function deleteAction(array $arrData, $entity = null)
    {
        try {
            $ordemServico = $this->find($arrData['id_ordem_servico']);
            if (
                $ordemServico->getTpSituacao() === OrdemServicoEntity::CO_SITUACAO_FINALIZADA ||
                $ordemServico->getTpSituacao() === OrdemServicoEntity::CO_SITUACAO_ANALISE
            )
                throw new Exception($this->strMsgE2);
            $serviceOrdemServicoDemanda = $this->getService('OrdemServico\Service\OrdemServicoDemandaFile');
            $arrOrdemServicoDemanda = $serviceOrdemServicoDemanda->findBy(array('id_ordem_servico' => $arrData['id_ordem_servico']));
            $demandaService = $this->getService('OrdemServico\Service\DemandaFile');
            if ($arrOrdemServicoDemanda) {
                foreach ($arrOrdemServicoDemanda as $ordemServicoDemanda)
                    $demandaService->save(array('id_demanda' => $ordemServicoDemanda->getIdDemanda(), 'tp_situacao' => DemandaEntity::SITUACAO_ATIVO));
            }
            $ordemServico = $this->find($arrData['id_ordem_servico']);
            return $this->delete($ordemServico->toArray());
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_IMPRIMIR_ORDEM_SERVICO
     */
    protected function imprimirOrdemServicoAction(array $arrData)
    {
        $ordemServico = $this->find($arrData['id_ordem_servico']);
        $booPdf = true;
        if (array_key_exists('type', $arrData))
            $booPdf = false;
        return $this->createDocument($ordemServico, $arrData, $booPdf);
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_EMITIR_ORDEM_SERVICO
     */
    protected function emitirOrdemServicoAction(array $arrData)
    {
        try {
            $arrOrdemSerivoceAceite = $this->getService('OrdemServico\Service\OrdemServicoAceiteFile')->findBy([
                'idOrdemServico' => $arrData['id_ordem_servico']
            ]);
            if (count($arrOrdemSerivoceAceite) < 8) {
                throw new Exception('Esta OS não está com todos os aceites necessários para ser finalizados.');
            }
            $ordemServico = $this->alterarSituacao($arrData, OrdemServicoEntity::CO_SITUACAO_FINALIZADA);
            return $this->createDocument($ordemServico);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_ANALISE_ORDEM_SERVICO
     */
    protected function analiseOrdemServicoAction(array $arrData)
    {
        return $this->alterarSituacao(reset($arrData), $arrData['tp_situacao']);
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_ORDEM_SERVICO_SUSPENDER
     */
    protected function suspenderOrdemServicoAction(array $arrData)
    {
        return $this->alterarSituacao(reset($arrData), $arrData['tp_situacao']);
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_ORDEM_SERVICO_INFORMACAO_ALTERACAO
     */
    protected function getInformacaoAlteracaoAction($arrDataPost)
    {
        $ordemServico = $this->find($arrDataPost['id_ordem_servico']);
        if (!$ordemServico->getIdUsuarioAlteracao()) {
            return [];
        }
        $usuario = $this->getService('OrdemServico\Service\UsuarioFile')->find($ordemServico->getIdUsuarioAlteracao());
        return [
            'dt_alteracao' => $ordemServico->getDtAlteracao(),
            'no_usuario' => $usuario->getNoUsuario()
        ];
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_ORDEM_SERVICO_SEQUENCIAL
     */
    protected function getNumeroSequencialOrdemServicoAction()
    {
        return $this->getService('OrdemServico\Service\OrdemServicoSubversion')->getNumeroSequencial();
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_IMPRIMIR_ORDEM_SERVICO_SELECIONADA
     */
    protected function imprimirOrdemServicoSelecionadoAction(array $arrDataPost)
    {
        $arrTypesDocuments = OrdemServicoEntity::$arrTypeDocuments;
        unset ($arrTypesDocuments[4]);
        $arrNameDocuments = [
            1 => 'OS%s',
            2 => 'RE-OS%s',
            3 => 'RT-OS%s',
        ];
        $zipFile = ZipFile::getInstance();
        $strPathFileZip = getBasePathApplication() . '/data/ordem_servico.zip';
        if (is_file($strPathFileZip)) {
            unlink($strPathFileZip);
        }
        $zipFile->openZip($strPathFileZip, 1);
        foreach ($arrDataPost as $arrData) {
            $ordemServico = $this->find($arrData['id_ordem_servico']);
            foreach (array_keys($arrTypesDocuments) as $intTypeRelatorio) {
                $intNumeroOs = str_pad($ordemServico->getNuOrdemServico(), 4, '0', STR_PAD_LEFT);
                $strNameFile = sprintf($arrNameDocuments[$intTypeRelatorio], $intNumeroOs . '-' . $ordemServico->getDsNome()) . '.pdf';
                $strPathFile = getBasePathApplication() . '/data/OrdemServico/documento/' . String::clearWord($strNameFile);
                $strPath = $this->createDocument($ordemServico, ['type_print' => [$intTypeRelatorio]]);
                rename(getBasePathApplication() . $strPath, $strPathFile);
                $arrPathFile = explode('/', $strPathFile);
                $zipFile->addContentIntoZip(FileSystem::getContentFromFile($strPathFile), end($arrPathFile));
            }
        }
        $zipFile->closeZip();
        return str_replace(getBasePathApplication(), '', $strPathFileZip);
    }

    /**
     * Metodo responsavel por alterar a situacao da ordem de servico
     *
     * @param $arrData
     * @param $intSituacao
     * @return \InepZend\Service\mix
     * @throws \Exception
     */
    protected function alterarSituacao($arrData, $intSituacao)
    {
        $arrData['tp_situacao'] = $intSituacao;
        $arrUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->findBy([
            'ds_login' => strtolower($this->getIdentity()->usuarioSistema->usuario->login)
        ]);
        if ($arrUsuario) {
            $usuarioAlteracao = reset($arrUsuario);
            $arrData['dt_alteracao'] = date('Y-m-d H:i:s');
            $arrData['id_usuario_alteracao'] = $usuarioAlteracao->getIdUsuario();
        }
        return $this->save($arrData);
    }

    /**
     * Metodo responsavel por criar o documento da ordem de servico.
     *
     * @param object $ordemServico
     * @return string
     */
    protected function createDocument(OrdemServicoEntity $ordemServico, $arrData = Array(), $booPdf = true)
    {
        $arrPathTemplate = array(
            1 => 'ordem-servico/ordem-servico/_ordem-servico',
            2 => 'ordem-servico/ordem-servico/_relatorio-execucao',
            3 => 'ordem-servico/ordem-servico/_relatorio-tecnico',
        );
        if (empty($arrData['type_print']))
            $arrTemplate = $arrPathTemplate;
        else {
            $arrPathTemplate[4] = 'ordem-servico/ordem-servico/_relatorio-tecnico-fiscal';
            foreach ($arrData['type_print'] as $intTypeTemplate)
                $arrTemplate[$intTypeTemplate] = $arrPathTemplate[$intTypeTemplate];
        }
        $strHtml = $this->getContentDocumentPartial($ordemServico, $arrTemplate);
        $strBasePath = $this->createStructure($ordemServico->getDsContrato()) . '/';
        $strBasePath .= sprintf($this->strNameFile, $ordemServico->getNuOrdemServico() . '_' . $ordemServico->getDsNome(), date('Ymd_His'));
        $strBasePath = String::clearWord(str_replace(' ', '-', $strBasePath));
        if ($booPdf) {
            $strNameRodape = 'OS' . $ordemServico->getNuOrdemServico() . ' - ' . $ordemServico->getDsNome();
            $strBasePath = $this->createDocumentPdf($strNameRodape, $strHtml, $strBasePath);
        } else
            $strBasePath = $this->createDocumentHtml($strHtml, $strBasePath);
        return str_replace(getBasePathApplication(), '', $strBasePath);
    }

    protected function getContentDocumentPartial($ordemServico, $arrTemplate)
    {
        $arrInfoDemanda = $this->getDemandasVinculadaOrdemServicoImpressao($ordemServico->getIdOrdemServico());
        $strHtml = '';
        $booQuebraPagina = (count($arrTemplate) > 1) ? true : false;
        foreach ($arrTemplate as $strTemplate)
            $strHtml .= trim($this->createDocumentTemplate(
                $strTemplate,
                $ordemServico,
                $arrInfoDemanda['demanda'],
                $arrInfoDemanda['superior'],
                $booQuebraPagina
            )
            );
        return $strHtml;
    }

    /**
     * Metodo responsavel por retonar um array contendo informacoes das demandas vinculadas na ordem de servico para impressao.
     *
     * @param $intIdOrdemServico
     */
    protected function getDemandasVinculadaOrdemServicoImpressao($intIdOrdemServico)
    {
        $arrDemandaVinculada = $this->getService('OrdemServico\Service\OrdemServicoDemandaFile')
            ->findByAction(array('id_ordem_servico' => $intIdOrdemServico), array('id_demanda' => 'asc'));
        $demandaService = $this->getService('OrdemServico\Service\DemandaFile');
        $arrDemandas = [];
        $arrDemandaSuperior = [];
        $arrDemandaVinculoSequencia = [];
        foreach ($arrDemandaVinculada as $demandaVinculada) {
            $demanda = $demandaService->find($demandaVinculada->getIdDemanda());
            $intSequencia = null;
            if ($demanda->getIdDemandaSuperior()) {
                $arrDemandaSuperior[$demanda->getIdDemandaSuperior()]['descricao'] = $demandaService->find($demanda->getIdDemandaSuperior());
                $arrDemandaSuperior[$demanda->getIdDemandaSuperior()]['vinculo'][] = $demandaVinculada->getIdDemanda();
                if (array_key_exists($demanda->getIdDemandaSuperior(), $arrDemandaVinculoSequencia)) {
                    $arrDemandaVinculoSequencia[$demanda->getIdDemandaSuperior()] += 1;
                } else {
                    $arrDemandaVinculoSequencia[$demanda->getIdDemandaSuperior()] = 1;
                }
                $intSequencia = $arrDemandaVinculoSequencia[$demanda->getIdDemandaSuperior()];
            }
            $arrAtividadesAssessoria = $this->getAtividadesVinculadaDemanda($demanda, $intSequencia);
            $demanda->hora_execucao = $arrAtividadesAssessoria['hora_execucao'];
            $arrDemandas[$demandaVinculada->getIdDemanda()] = array(
                'demanda' => $demanda,
                'atividade' => $arrAtividadesAssessoria['atividade'],
                'assessoria' => $arrAtividadesAssessoria['assessoria'],
            );
        }
        ksort($arrDemandas);
        $arrDemandas = $this->numeraSequenciaAtiviades($arrDemandas, $arrDemandaSuperior);
        return ['demanda' => $arrDemandas, 'superior' => $arrDemandaSuperior];
    }

    protected function createDocumentPdf($strRodape, $strContent, $strBasePath)
    {
        $mpdf = new Mpdf('c');
        $mpdf->SetFooter($strRodape);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($strContent);
        $mpdf->mirrorMargins = 1;
        $mpdf->Output($strBasePath);
        return $strBasePath;
    }

    protected function createDocumentHtml($strContent, $strBasePath)
    {
        $strBasePath = str_replace('.pdf', '.html', $strBasePath);
        if (is_file($strBasePath)) {
            unlink($strBasePath);
        }
        file_put_contents($strBasePath, '<div style="background-color: #CCCCCC;" align="center">' . $strContent . '</div>');
        return $strBasePath;
    }

    /**
     * Metodo responsavel por criar a estrutura de pasta que sera salva os documentos.
     *
     * @param string $strContato
     * @return string
     */
    protected function createStructure($strContato)
    {
        $strBasePath = getBasePathApplication() . '/data/OrdemServico';
        $arrPaste = array('documento', str_replace('/', '', $strContato));
        foreach ($arrPaste as $strPaste) {
            $strBasePath .= '/' . $strPaste;
            if (!is_dir($strBasePath))
                mkdir($strBasePath, 0755, true);
        }
        return $strBasePath;
    }

    /**
     * Metodo responsavel por criar os documentos da ordem de servico.
     *
     * @param string $strPathTemplate
     * @param object $ordemServico
     * @param array $arrDemandas
     * @return string
     */
    protected function createDocumentTemplate($strPathTemplate, $ordemServico, $arrDemandas, $arrDemandaSuperior, $booQuebraPagina = true)
    {
        return $this->renderTemplate(
            $strPathTemplate,
            [
                'ordem_servico' => $ordemServico,
                'arrDemandas' => $arrDemandas,
                'arrDemandaSuperior' => $arrDemandaSuperior,
                'booQuedraPagaina' => $booQuebraPagina
            ]
        );
    }

    protected function numeraSequenciaAtiviades($arrDemandas, $arrDemandasSuperior)
    {
        $intPosicao = 0;
        $arrPosicao = array();
        foreach ($arrDemandas as $intIdDemanda => $arrInfoDemanda) {
            $intIdDemandaSuperior = $arrInfoDemanda['demanda']->getIdDemandaSuperior();
            $intIndiceContagem = ($intIdDemandaSuperior) ? $intIdDemandaSuperior : $arrInfoDemanda['demanda']->getIdDemanda();
            if (array_key_exists($intIndiceContagem, $arrPosicao)) {
                $intPosicao = $arrPosicao[$intIndiceContagem];
            } else {
                $intPosicao += 1;
                $arrPosicao[$intIndiceContagem] = $intPosicao;
            }
            $arrDemandas[$intIdDemanda]['demanda']->sequencia = $arrPosicao[$intIndiceContagem];
        }
        return $arrDemandas;
    }

    protected function getAtividadesVinculadaDemanda($demanda, $intSequencia)
    {
        $atividadeService = $this->getService('OrdemServico\Service\AtividadeFile');
        $arrAtividadeDemanda = [];
        $arrAssessoria = [];
        $intHoraExecucao = 0;
        # demanda sem vinculo
        if ($demanda->getIdAtividade()) {
            $atividade = $atividadeService->find($demanda->getIdAtividade());
            $intQma = number_format($demanda->getVlQma(), 2);
            $arrAtividadeDemanda[] = [
                'vl_complexidade' => $demanda->getVlComplexidade(),
                'vl_impacto' => $demanda->getVlImpacto(),
                'vl_criticidade' => $demanda->getVlCriticidade(),
                'vl_fator_ponderacao' => $demanda->getVlFatorPonderacao(),
                'vl_facim' => $demanda->getVlFacim(),
                'vl_qma' => $intQma,
                'co_atividade' => $atividade->getCoAtividade(),
                'no_atividade' => $atividade->getNoAtividade(),
                'nu_sequencia' => $intSequencia
            ];
            $arrAssessoria[] = $atividade->getDsAreaAssessoria();
            $intHoraExecucao = $intQma;
        } else {
            $demandaServicoService = $this->getService('OrdemServico\Service\DemandaServicoFile');
            $arrAtividadeDemandaBd = $demandaServicoService->findBy(array('id_demanda' => $demanda->getIdDemanda()));
            $catalogoServicoAtividadeService = $this->getService('OrdemServico\Service\CatalogoServicoAtividadeFile');
            $intSequencia = 1;
            $intQtdAtividadeServico = count($arrAtividadeDemandaBd);
            foreach ($arrAtividadeDemandaBd as $atividadeDemanda) {
                $catalogoServicoAtividade = $catalogoServicoAtividadeService->find($atividadeDemanda->getIdCatalogoServicoAtividade());
                $atividade = $atividadeService->find($catalogoServicoAtividade->getIdAtividade());
                $intQma = number_format($atividadeDemanda->getVlQma(), 2);
                $arrAtividadeDemanda[] = [
                    'vl_complexidade' => $atividadeDemanda->getVlComplexidade(),
                    'vl_impacto' => $atividadeDemanda->getVlImpacto(),
                    'vl_criticidade' => $atividadeDemanda->getVlCriticidade(),
                    'vl_fator_ponderacao' => $atividadeDemanda->getVlFatorPonderacao(),
                    'vl_facim' => $atividadeDemanda->getVlFacim(),
                    'vl_qma' => $intQma,
                    'co_atividade' => $atividade->getCoAtividade(),
                    'no_atividade' => $atividade->getNoAtividade(),
                    'nu_sequencia' => ($intQtdAtividadeServico > 1) ? $intSequencia : ''
                ];
                $intSequencia += 1;
                $arrAssessoria[] = $atividade->getDsAreaAssessoria();
                $intHoraExecucao += $intQma;
            }
        }
        $intHoraExecucao = number_format($intHoraExecucao / 1.5);
        return ['atividade' => $arrAtividadeDemanda, 'assessoria' => array_unique($arrAssessoria), 'hora_execucao' => $intHoraExecucao];
    }

    protected function getListagemOrdemServicoRelatorio($arrData)
    {
        return $this->getRepositoryEntity()->getListagemOrdemServicoRelatorio($arrData);
    }

    protected function vincularDemandaOrdemServio($arrData, $intIdOrdemServico)
    {
        try {
            $this->begin();
            $serviceOrdemServicoDemanda = $this->getService('OrdemServico\Service\OrdemServicoDemandaFile');
            $demandaService = $this->getService('OrdemServico\Service\DemandaFile');
            $arrData['id_demanda_vinculada'] = array_unique($arrData['id_demanda_vinculada']);
            ArrayCollection::clearEmptyParam($arrData['id_demanda_vinculada']);
            $arrOrdemServicoDemanda = $serviceOrdemServicoDemanda->findBy(array('id_ordem_servico' => $intIdOrdemServico));
            if ($arrOrdemServicoDemanda) {
                foreach ($arrOrdemServicoDemanda as $ordemServicoDemanda) {
                    $demandaService->save(array('id_demanda' => $ordemServicoDemanda->getIdDemanda(), 'tp_situacao' => DemandaEntity::SITUACAO_ATIVO));
                    $serviceOrdemServicoDemanda->delete($ordemServicoDemanda->toArray());
                }
            }
            foreach ($arrData['id_demanda_vinculada'] as $intIdDemanda) {
                $serviceOrdemServicoDemanda->vincularDemandaOrdemServico($intIdOrdemServico, $intIdDemanda);
            }
            $this->commit();
        } catch (\Exception $execption) {
            $this->rollback();
            throw new \Exception($execption);
        }
    }
}
