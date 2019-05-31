<?php

namespace OrdemServico\View\Helper;

use InepZend\View\Helper\AbstractHelper;

class RenderDescricaoDemandaHelper extends AbstractHelper
{
    public $arrResponsavel = [];

    protected $arrAssessoria = [];

    public function renderDescricaoDemanda($arrDemandasDescricao, $arrVinculo)
    {
        $arrDemandaPrint = array();
        $strRender = '';
        foreach ($arrDemandasDescricao as $intIdDemanda => $mixDemanda) {
            foreach ($mixDemanda['assessoria'] as $strAreaAssessoria) {
                $this->arrAssessoria[$strAreaAssessoria] = $strAreaAssessoria;
            }
            $demanda = $mixDemanda['demanda'];
            $arrResponsavel[] = $demanda->getNoExecutor();
            if (array_key_exists($intIdDemanda, $arrDemandaPrint)) {
                continue;
            }
            if (array_key_exists($demanda->getIdDemandaSuperior(), $arrVinculo)) {
                $arrInfoDemandaSuperior = $arrVinculo[$demanda->getIdDemandaSuperior()];
                $strRender .= '<li><span>' . $arrInfoDemandaSuperior['descricao']->getNoDemanda() . '</span></li>';
                $strRender .= '<ol>';
                foreach ($arrInfoDemandaSuperior['vinculo'] as $intPosicao => $intIdDemandaVinculo) {
                    $infoDemandaVinculada = $arrDemandasDescricao[$intIdDemandaVinculo]['demanda'];
                    $strRender .= '<li><span>' . $infoDemandaVinculada->getNoDemanda() . '</span></li>';
                    $arrDemandaPrint[$intIdDemandaVinculo] = $intIdDemandaVinculo;
                    unset(
                            $arrVinculo[$demanda->getIdDemandaSuperior()]['vinculo'][$intPosicao],
                            $arrDemandasDescricao[$intDemandaVinculada],
                            $arrVinculo[$demanda->getIdDemandaSuperior()]
                    );
                }
                $strRender .= '</ol>';
            } else {
                $strRender .= '<li><span>' . $mixDemanda['demanda']->getNoDemanda() . '</span></li>';
            }
            $arrDemandaPrint[$intIdDemanda] = $intIdDemanda;
        }
        natcasesort($arrResponsavel);
        $this->arrAssessoria = array_unique($this->arrAssessoria);
        $arrResponsavel = array_unique($arrResponsavel);
        $this->arrResponsavel = $arrResponsavel;
        return $strRender;
    }

    public function renderAreaAssessoria()
    {
        ksort($this->arrAssessoria);
        $strRender = '';
        foreach ($this->arrAssessoria as $strAreaAssessoria) {
            $strRender = '<tr>
                <td class="sem-borda" style="width: 10px; height: 10px; background-color: #000000;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="sem-borda">' . $strAreaAssessoria . '</td>
            </tr>';
        }
        return $strRender;
    }

    public function renderizaDescricaoImpressao($strTexto)
    {
        if (strpos($strTexto, '<br') !== false) {
            return $strTexto;
        }
        return nl2br($strTexto);
    }

    public function montarRelatorioTecnico($demanda, $arrAtividades, $intNumeroDemanda, $renderDescricaoDemanda)
    {
        $arrDetalhesAtividade = [];
        foreach ($arrAtividades as $arrInfoAtividade) {
            $arrDetalhesAtividade[] = $arrInfoAtividade['co_atividade'] . ' - ' . $arrInfoAtividade['no_atividade'];
        }
        $strHtml = '<p></p>';
        $strHtml .= '
        <li>
            <p>
                <p><strong>' . $intNumeroDemanda .'. ' . $demanda->getNoDemanda() . '</strong></p>
                <br />
                <p>
                    Atividade:
                    <ul>';
        foreach ($arrAtividades as $arrInfoAtividade)
            $strHtml .= '<li>' . $arrInfoAtividade['co_atividade'] . ' - ' . $arrInfoAtividade['no_atividade'] . '</li>';
        $strHtml .= '
                    </ul>
                </p>
                <br />
                <p>Executor: ' . $demanda->getNoExecutor() . '</p>
                <br />
                <p>Data Abertura: '. $demanda->getDtAbertura() . '</p>
                <br />
                <p>Projeto: '. (($demanda->getNoProjeto()) ? $demanda->getNoProjeto() : ' - ') . '</p>
                <br />
                <p>Ambiente: ' . (($demanda->getNoProjeto()) ? $demanda->getDsAmbiente() : ' - ') . '</p>
                <br />
                <ul>
                    <li>
                        <strong>Solicitação</strong>
                        <br />
                        '. $renderDescricaoDemanda->renderizaDescricaoImpressao(trim($demanda->getDsDescricao())) . '
                        <br />
                    </li>
                    <li>
                        <strong>Solução aplicada</strong>
                        <br />
                        ' . ($demanda->getDsSolucao()) ? $renderDescricaoDemanda->renderizaDescricaoImpressao(trim($demanda->getDsSolucao())) : ' - ' . '
                    </li>
                </ul>
            </p>
        </li>';
        echo $strHtml;die;
        return $strHtml;
    }
}
