<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\View\RenderTemplate;
use InepZend\Service\ServiceAngularTrait;
use InepZend\Util\ArrayCollection;
use InepZend\Exception\Exception;

class RelatorioDesempenho extends AbstractServiceManager
{
    use RenderTemplate,
        ServiceAngularTrait;

    public function gerarRelatorioAction($arrDataPost)
    {
        try {
            if (!$this->getService('OrdemServico\Service\Profile')->hasUsuarioPreposto()) {
                throw new Exception('Usuário sem permissão.');
            }
            ArrayCollection::clearEmptyParam($arrDataPost);
            $arrDemandaVinculadaOrdemServico = $this->getService('OrdemServico\Service\VwDemandaVinculadaOrdemServicoFile')
                ->gerarRelatorioDesempenho($arrDataPost);
            if (!$arrDemandaVinculadaOrdemServico) {
                throw new \Exception('Não foram encontrados resultados para a pesquisa informada.');
            }
            $arrRegistroRelatorio = $this->criarEstruturaRelatorioRegistro($arrDemandaVinculadaOrdemServico);
            $strBasePath = $this->createDocument($arrRegistroRelatorio['registroExecutor'], $arrRegistroRelatorio['registroOrdem']);
            return ['path' => $strBasePath];
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function gerarRelatorioPessoalAction($arrDataPost)
    {
        ArrayCollection::clearEmptyParam($arrDataPost);
        $arrDemandaPessoal = $this->getService('OrdemServico\Service\VwDemandaVinculadaOrdemServicoFile')
            ->gerarRelatorioPessoalDesempenho($arrDataPost);
        return $this->renderTemplate('ordem-servico/relatorio-pessoal/_resultado', [
            'arrRegistro' => $arrDemandaPessoal
        ]);
    }

    protected function createDocument($arrRegistroExecutor, $arrRegistroOrdem)
    {
        $strContent = "Codigo OS,Demanda,Atividade,Data de abertura,Data de fechamento,Quantidade MAT,Executor\n";
        foreach ($arrRegistroExecutor as $intNumeroOs => $arrRegistro) {
            foreach ($arrRegistro as $strNomeExecutor => $arrInforDemanda) {
                foreach ($arrInforDemanda as $arrDemanda) {
                    $arrInfoAtividade = $this->getAtividadesDemanda($arrDemanda);
                    $arrRegistroColuns = [
                        'no_codigo' => 'OS' . $intNumeroOs,
                        'no_demanda' => reset($arrDemanda)['no_demanda'],
                        'no_atividade' => $arrInfoAtividade['atividade'],
                        'dt_abertura' => $arrInfoAtividade['data'],
                        'dt_fechamento' => $arrRegistroOrdem[$intNumeroOs]['dt_prazo'],
                        'vl_mat' => $arrInfoAtividade['valor'],
                        'executor' => $strNomeExecutor,
                    ];
                    $strContent .= implode(',', $arrRegistroColuns) . "\n";
                }
            }
        }
        $strBasePath = getBasePathApplication() . '/data/' . date('YmdHis') .'-relatorio.csv';
        file_put_contents($strBasePath, $strContent);
        return str_replace(getBasePathApplication(), '', $strBasePath);
    }

    protected function getAtividadesDemanda($arrDemanda)
    {
        $strNomeAtividade = '';
        $intVlrQma = 0;
        foreach ($arrDemanda as $arrAtividade) {
            $strNomeAtividade .= str_replace(array(',', ';', "\n"), '-', $arrAtividade['co_atividade'] . ' ( ' . $arrAtividade['no_atividade'] . ')');
            $intVlrQma += floatval($arrAtividade['vl_qma']);
        }
        return ['atividade' => $strNomeAtividade, 'valor' => $intVlrQma, 'data' => $arrAtividade['dt_abertura']];
    }

    protected function criarEstruturaRelatorioRegistro($arrDemandaVinculadaOrdemServico)
    {
        $arrRegistroRelatorio = [];
        $arrInformacaoOs = [];
        foreach ($arrDemandaVinculadaOrdemServico as $demandaVinculada) {
            $intIdDemanda = $demandaVinculada->getIdDemanda();
            $arrRegistroRelatorio[$demandaVinculada->getNuOrdemServico()][$demandaVinculada->getNoExecutor()][$intIdDemanda][] = [
                'dt_abertura' => $demandaVinculada->getDtAbertura(),
                'co_atividade' => $demandaVinculada->getCoAtividade(),
                'no_atividade' => str_replace(';', ' - ', $demandaVinculada->getNoAtividade()),
                'vl_qma' => $demandaVinculada->getVlQma(),
                'no_demanda' => str_replace(array(',', ';', "\n"), '-', $demandaVinculada->getNoDemanda())
            ];

            $arrInformacaoOs[$demandaVinculada->getNuOrdemServico()] = [
                'numero_os' => $demandaVinculada->getNuOrdemServico(),
                'dt_prazo' => $demandaVinculada->getDtPrazo(),
            ];
        }
        return [
            'registroExecutor' => $arrRegistroRelatorio,
            'registroOrdem' => $arrInformacaoOs
        ];
    }
}
