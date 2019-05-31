<?php
/**
 * Created by PhpStorm.
 * User: ualison
 * Date: 15/03/17
 * Time: 18:07
 */

namespace OrdemServico\Service;

use InepZend\Service\AbstractServiceManager;
use OrdemServico\Entity\Usuario as UsuarioEntity;
use InepZend\Util\ArrayCollection;
use OrdemServico\Entity\OrdemServico as OrdemServicoEntity;
use InepZend\View\RenderTemplate;
use InepZend\Mail\Mail;
use InepZend\Util\PhpIni;
use InepZend\Util\Date;

class CronLancamentoApex extends AbstractServiceManager
{
    use RenderTemplate;

    protected function init()
    {
        PhpIni::setTimeLimit(0);
        PhpIni::allocatesMemory(-1);
        $arrDatas = $this->getDatasPonto();
        $arrUsuario = $this->getListagemUsuario();
        foreach ($arrUsuario as $usuario) {
            try {
                $arrDataUsario = $this->getPontosUsuario($arrDatas, $usuario);
                if ($arrDataUsario) {
                    $this->iniciarRegistro($arrDataUsario, $usuario);
                }
            } catch (\Exception $exception) {
                continue;
            }
        }
    }

    protected function lancamentoManual($intIdUsuario, $strDtInicial, $strDtFinal)
    {
        $usuario = $this->getService('OrdemServico\Service\UsuarioFile')->find($intIdUsuario);
        $arrDatas = [
            'dt_ponto_inicio' => Date::convertDateBase($strDtInicial),
            'dt_ponto_fim' => Date::convertDateBase($strDtFinal),
        ];
        $arrDataUsario = $this->getPontosUsuario($arrDatas, $usuario);
        if ($arrDataUsario) {
            $this->iniciarRegistro($arrDataUsario, $usuario);
        }
    }


    protected function lancamentoFerias($intIdUsuario, $strDataInicial, $strDataFinal)
    {
        $usuario = $this->getService('OrdemServico\Service\UsuarioFile')->find($intIdUsuario);
        $intDiff = Date::dateDiff($strDataInicial, $strDataFinal);
        $arrFeriado = $this->getService('OrdemServico\Service\FeriadoFile')->fetchPairs([], 'getDtFeriado', 'getNoFeriado');
        for ($intI = 0; $intI <= $intDiff; $intI++) {
            $strDate = date('d/m/Y', strtotime($strDataInicial . ' + ' . $intI . ' days'));
            $dateTime = new \DateTime(Date::convertDate($strDate));
            if (
                ($dateTime->format('w') % 6) != 0 &&
                !array_key_exists($dateTime->format('Y-m-d'), $arrFeriado)
            ) {
                try {
                    $serviceIntegracaoApex = $this->getService('OrdemServico\Service\IntegracaoApexService');
                    $serviceIntegracaoApex->getRequisicao(
                        [
                            "data" => $strDate,
                            "descricao" => "Férias",
                            "atividade" => "F0",
                            "horaInicio" => "08:00",
                            "horaFim" => "16:30",
                            "numeroOS" => "1",
                            //"PERCONCLUSAO" => "1"
                        ],
                        $usuario->getDsHashApex()
                    );
                } catch (\Exception $exception) {
                    continue;
                }
            }
        }
    }

    private function iniciarRegistro($arrHorario, $usuario)
    {
        try {
            $arrMensagemErro = [];
            $arrDemandas = $this->getDemandasAtividades($usuario->getIdUsuario());
            if (!$arrDemandas) {
                throw new \Exception('Não existem demandas para serem lançadas no APEX.');
            }
            $intTotalKeys = count(array_keys($arrDemandas));
            foreach ($arrHorario as $arrInfoHorario) {
                try {
                    $arrHorarioPonto = [
                        str_replace(['-', '*'], '', trim($arrInfoHorario['hora_0'])),
                        str_replace(['-', '*'], '', trim($arrInfoHorario['hora_1'])),
                        str_replace(['-', '*'], '', trim($arrInfoHorario['hora_2'])),
                        str_replace(['-', '*'], '', trim($arrInfoHorario['hora_3'])),
                        str_replace(['-', '*'], '', trim($arrInfoHorario['hora_4'])),
                        str_replace(['-', '*'], '', trim($arrInfoHorario['hora_5'])),
                    ];
                    ArrayCollection::clearEmptyParam($arrHorarioPonto);
                    $informacaoDemanda = $arrDemandas[rand(1, $intTotalKeys) - 1];
                    $serviceIntegracaoApex = $this->getService('OrdemServico\Service\IntegracaoApexService');
                    $serviceIntegracaoApex->registrarPonto([
                        'id_catalogo_servico_atividade' => $informacaoDemanda->getIdCatalogoServicoAtividade(),
                        'id_demanda' => $informacaoDemanda->getIdDemanda(),
                        'dt_ponto' => $arrInfoHorario['data'],
                        'hr_ponto' => implode(',', $arrHorarioPonto),
                        'ds_descricao' => $informacaoDemanda->getNoDemanda(),
                    ], $usuario->getIdUsuario());
                } catch (\Exception $exception) {
                    $arrMensagemErro[] = $exception->getMessage();
                    continue;
                }
            }
        } catch (\Exception $exception) {
            $arrMensagemErro[] = $exception->getMessage();
        }
        if ($arrMensagemErro) {
            $this->enviarEmailErro($arrMensagemErro, $usuario);
        }
    }

    private function getListagemUsuario()
    {
        $arrUsuarioList = [
            14, # Rafael
            19, # Thiago
            20, # Victor,
            6, # Gilvan
            16, # Rebert
//            5, # Maeda,
            8, # Jonathan
            22, # Molina
            1, # Ualison
        ];
        $arrUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->findBy([
            'in_ativo' => true,
            'tp_vinculo' => [
                UsuarioEntity::CO_PERFIL_FUNCIONARIO,
                UsuarioEntity::CO_PERFIL_PREPOSTO,
                UsuarioEntity::CO_PERFIL_CE,
            ],
            'id_usuario' => $arrUsuarioList
        ]);
        foreach ($arrUsuario as $intIndice => $usuario) {
            if (!$usuario->getDsHashApex()) {
                unset($arrUsuario[$intIndice]);
            }
        }
        return $arrUsuario;
    }

    private function getDatasPonto()
    {
        $strDataFim = date('d/m/Y', strtotime('-1 days'));
        $strDataInicio = date('d/m/Y', strtotime('-4 days', strtotime(date('d-m-Y', strtotime('-1 days')))));
        //@TODO remover
        $strDataInicio = date('d/m/Y', strtotime('-15 days', strtotime(date('d-m-Y', strtotime('-1 days')))));
        return ['dt_ponto_inicio' => $strDataInicio, 'dt_ponto_fim' => $strDataFim];
    }

    private function getPontosUsuario($arrDatas, $usuario)
    {
        $arrPontos = $this->getService('OrdemServico\Service\RelatorioPonto')->pesquisarPontoAction($arrDatas, $usuario);
        if ($arrPontos) {
            $arrPontos = reset($arrPontos);
            $arrKeys = [
                'hora_0',
                'hora_1',
                'hora_2',
                'hora_3',
                'hora_4',
                'hora_5',
            ];
            foreach ($arrPontos as $intIndice => $arrInfoPonto) {
                foreach ($arrInfoPonto as $strKey => $strPonto) {
                    if (in_array($strKey, $arrKeys)) {
                        if ($strPonto == 'Justificar' || substr($strPonto, 0, 1) == '*' || $strPonto == '-') {
                            $arrPontos[$intIndice][$strKey] = '';
                        }
                    }
                }
            }
        }
        return $arrPontos;
    }

    private function getDemandasAtividades($intIdUsuario)
    {
        $arrDemanda = $this->getService('OrdemServico\Service\VwDemandaVinculadaOrdemServicoFile')->findBy(
            [
                'id_usuario' => $intIdUsuario,
                'tp_situacao' => OrdemServicoEntity::CO_SITUACAO_ABERTA
            ]
        );
        return $arrDemanda;
    }

    private function enviarEmailErro($arrMensagemErro, $usuario)
    {
        $strContent = $this->renderTemplate(
            'ordem-servico/relatorio-ponto/_partial/_email-erro',
            [
                'noUsuario' => $usuario->getNoUsuario(),
                'arrErro' => $arrMensagemErro
            ]
        );
        $mail = new Mail();
        $mail->sendMail(
            $strContent,
            '[Ordem de Serviço] Lançamento Automático no APEX',
            $usuario->getDsEmail()
        );
    }
}
