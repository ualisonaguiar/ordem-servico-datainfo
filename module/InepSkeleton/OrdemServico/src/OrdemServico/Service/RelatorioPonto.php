<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractService;
use InepZend\View\RenderTemplate;
use InepZend\Service\ServiceAngularTrait;
use InepZend\Util\Date;
use InepZend\Util\ArrayCollection;
use InepZend\Exception\Exception;
use OrdemServico\Entity\Usuario;

class RelatorioPonto extends AbstractService
{
    const QTD_GRADE_HORARIO = 6;

    protected $strPathFile = '/data/ponto/AFD00014003750066549.txt';

    use RenderTemplate,
        ServiceAngularTrait,
        InformacaoHoraPonto;

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_PONTO_PESQUISA
     */
    public function pesquisarPontoAction($arrCriteria, $infoUsuario = null)
    {
        try {
            if (!$infoUsuario) {
                $infoUsuario = $this->getInformationUsuario($arrCriteria);
            }
            $arrDataPaginator = [];
            $intPosicao = 0;
            $arrInformationPonto = $this->getInformacaoPonto($infoUsuario, $arrCriteria);
            $intTotalHoraTrabalhada = 0;
            foreach ($arrInformationPonto as $strDate => $arrInformation) {
                $arrDataPaginator[$intPosicao]['data'] = $strDate;
                $arrDataPaginator[$intPosicao]['horas_trabalhada'] = $arrInformation['soma'];
                $arrDataPaginator[$intPosicao]['total'] = $arrInformation['total'];
                for ($intKey = 0; $intKey < self::QTD_GRADE_HORARIO; $intKey++) {
                    if (array_key_exists($intKey, $arrInformation['horario']))
                        $arrDataPaginator[$intPosicao]['hora_' . $intKey] = $arrInformation['horario'][$intKey];
                    elseif ($intKey == 4 || $intKey == 5)
                        $arrDataPaginator[$intPosicao]['hora_' . $intKey] = '-';
                    else
                        $arrDataPaginator[$intPosicao]['hora_' . $intKey] = 'Justificar';
                }
                $intPosicao++;
                list($intHour, $intMinute) = explode(':', $arrInformation['soma']);
                $intTotalHoraTrabalhada += $intHour * 60 + $intMinute;
            }
            $intHours = floor($intTotalHoraTrabalhada / 60);
            $intTotalHoraTrabalhada -= $intHours * 60;
            $arrDataPaginator = $this->calculaHoraSugerida($arrDataPaginator);
            return [
                'ponto' => $arrDataPaginator,
                'horaTrabalhada' => sprintf('%02d:%02d', $intHours, $intTotalHoraTrabalhada),
                'horaTrabalhar' => $this->getHorasTrabalhar($arrCriteria),
            ];
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_PONTO_INFORMACAO_ARQUIVO
     */
    public function getInformationArquivoAction()
    {
        try {
            date_default_timezone_set('America/Sao_Paulo');
            $infoFile = $this->getService('OrdemServico\Service\ArquivoPontoFile')->findBy([], ['dt_alteracao' => 'desc'], 1);
            $usuario = $this->getService('OrdemServico\Service\UsuarioFile')->find($infoFile[0]->getIdUsuarioAlteracao());
            return json_encode([
                'date_file' => Date::convertDateBase($infoFile[0]->getDtAlteracao(), 'd/m/Y H:i:s'),
                'usuario' => $usuario->getNoUsuario()
            ]);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_PONTO_UPLOAD
     */
    public function uploadArquivoAction($arrDataPost)
    {
        try {
            if (!is_dir(getBasePathApplication() . '/data/ponto')) {
                mkdir(getBasePathApplication() . '/data/ponto', 0755, true);
            }
            file_put_contents(getBasePathApplication() . $this->strPathFile, $arrDataPost['arquivo']);
            $arrLinhaArquivo = file($this->getPathArquivo(), FILE_SKIP_EMPTY_LINES);
            $serviceArquivoPonto = $this->getService('OrdemServico\Service\ArquivoPontoFile');
            $serviceArquivoPonto->begin();
            $serviceArquivoPonto->setFlush(false);
            $arrArquivoPontoFecht = $serviceArquivoPonto->fetchPairs([], 'getDsLinha', 'getIdArquivoPonto');
            $intIdUsuarioLogado = $this->getService('OrdemServico\Service\Profile')->getIdUsuarioLogado();
            foreach ($arrLinhaArquivo as $intLinha => $strLinha) {
                $strLinha = trim($strLinha);
                if (!array_key_exists($strLinha, $arrArquivoPontoFecht)) {
                    $serviceArquivoPonto->save([
                        'in_linha' => ($intLinha + 1),
                        'ds_linha' => $strLinha,
                        'id_usuario_alteracao' => $intIdUsuarioLogado,
                        'dt_alteracao' => date('Y-m-d H:i:s'),
                        'tp_migracao' => 1
                    ]);
                }
            }
            $serviceArquivoPonto->setFlush(true);
            $serviceArquivoPonto->commit();
            $this->getService('OrdemServico\Service\ArquivoPontoUsuarioFile')->getMigracaoFileBanco();
//            $this->getService('OrdemServico\Service\CronLancamentoApex')->init();
            return true;
        } catch (\Exception $exception) {
            $serviceArquivoPonto->rollback();
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_PONTO_JUSTIFICAR
     */
    protected function justificarPontoAction($arrDataPost)
    {
        $intIdUsuario = $this->getService('OrdemServico\Service\Profile')->getIdUsuarioLogado();
        return $this->justificarPonto($arrDataPost, $intIdUsuario);
    }

    protected function justificarPonto($arrDataPost, $intIdUsuario)
    {
        try {
            if (!preg_match('/^[0-9]{2}:[0-9]{2}$/', $arrDataPost['hr_ponto'])) {
                throw new \Exception('Hora informada inválida');
            }
            $serviceJustificaPonto = $this->getService('OrdemServico\Service\JustificativaPontoFile');
            $arrDataPost['dt_ponto'] = Date::convertDate($arrDataPost['dt_ponto'], 'Y-m-d');
            $arrJustificativa = $serviceJustificaPonto->findBy([
                'id_usuario' => $intIdUsuario,
                'dt_justificativa' => $arrDataPost['dt_ponto'],
                'hr_justificada' => $arrDataPost['hr_ponto'],
            ]);
            if ($arrJustificativa) {
                throw new \Exception('Já encontra-se justificado o ponto para esta data e horário.');
            }
            return $serviceJustificaPonto->save([
                'id_usuario' => $intIdUsuario,
                'dt_justificativa' => $arrDataPost['dt_ponto'],
                'hr_justificada' => $arrDataPost['hr_ponto'],
                'id_usuario_alteracao' => $intIdUsuario,
                'dt_alteracao' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }


    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_PONTO_ENVIAR_APEX
     */
    protected function enviarInformacaoApexAction($arrDadosPost)
    {
        try {
            $this->getService('OrdemServico\Service\IntegracaoApexService')->registrarPonto($arrDadosPost);
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_PONTO_LACAR_FERIAS
     */
    protected function lancarFeriaAction($arrDataPost)
    {
        try {
            $serviceFerias = $this->getService('OrdemServico\Service\Ferias');
            $serviceFerias->begin();
            if ($arrDataPost['dt_ponto_feria_inicio'] == '' || $arrDataPost['dt_ponto_feria_fim'] == '') {
                throw new \Exception('Não foi informado o período de férias');
            }
            $arrDataPost['dt_ponto_feria_inicio'] = Date::convertDateTemplate($arrDataPost['dt_ponto_feria_inicio']);
            $arrDataPost['dt_ponto_feria_fim'] = Date::convertDateTemplate($arrDataPost['dt_ponto_feria_fim']);
            $intIdUsuarioLogado = $this->getService('OrdemServico\Service\Profile')->getIdUsuarioLogado();
            $arrInfoFerias = $serviceFerias->findBy([
                'id_usuario' => $intIdUsuarioLogado,
                'dt_inicio' => $arrDataPost['dt_ponto_feria_inicio'],
                'dt_fim' => $arrDataPost['dt_ponto_feria_fim'],
            ]);
            if ($arrInfoFerias) {
                throw new \Exception('Este período encontra-se já lançado.');
            }
            $this->getService('OrdemServico\Service\CronLancamentoApex')->lancamentoFerias(
                $intIdUsuarioLogado,
                $arrDataPost['dt_ponto_feria_inicio'],
                $arrDataPost['dt_ponto_feria_fim']
            );
            $serviceFerias->insert([
                'id_usuario' => $intIdUsuarioLogado,
                'dt_inicio' => $arrDataPost['dt_ponto_feria_inicio'],
                'dt_fim' => $arrDataPost['dt_ponto_feria_fim'],
                'id_usuario_alteracao' => $intIdUsuarioLogado,
                'dt_alteracao' => date('Y-m-d H:i:s')
            ]);
            $serviceFerias->commit();
            return true;
        } catch (\Exception $exception) {
            $serviceFerias->rollback();
            throw new Exception($exception->getMessage());
        }
    }

    protected function getHorasTrabalhar($arrCriteria)
    {
        $arrCriteria['dt_ponto_inicio'] = Date::convertDateTemplate($arrCriteria['dt_ponto_inicio']);
        $arrCriteria['dt_ponto_fim'] = Date::convertDateTemplate($arrCriteria['dt_ponto_fim']);
        $arrDatasRange = $this->getRangeDates($arrCriteria['dt_ponto_inicio'], $arrCriteria['dt_ponto_fim']);
        $arrFeriado = $this->getService('OrdemServico\Service\FeriadoFile')->getListaFeriadoIntervaloFetchPairs(
            $arrCriteria['dt_ponto_inicio'],
            $arrCriteria['dt_ponto_fim']
        );
        foreach ($arrDatasRange as $intIndice => $strData) {
            $dateRange = new \DateTime($strData);
            $intDiaSemana = intval($dateRange->format('w'));
            if (($intDiaSemana == 0 || $intDiaSemana == 6) || (array_key_exists($strData, $arrFeriado))) {
                unset($arrDatasRange[$intIndice]);
            }
        }
        $intSeconds = ((8 * 3600) + (30 * 60)) * count($arrDatasRange);
        $horas = floor($intSeconds / 3600);
        $minutos = floor(($intSeconds - ($horas * 3600)) / 60);
        return $horas . (($minutos) ? (':' . $minutos) : '');
    }

    /**
     * Retorna informacoes do arquivo.
     *
     * @param $arrInfoUsuario
     * @param $arrCriteria
     * @return array|mixed
     * @throws \Exception
     */
    protected function getInformacaoPonto($infoUsuario, $arrCriteria)
    {
        $arrPontoUsuarioBD = $this->getService('OrdemServico\Service\ArquivoPontoUsuarioFile')->getListagem([
            'idUsuario' => $infoUsuario->getIdUsuario(),
            'dtInicio' => Date::convertDateTemplate($arrCriteria['dt_ponto_inicio']),
            'dtFim' => Date::convertDateTemplate($arrCriteria['dt_ponto_fim']),
        ]);
        if (!$arrPontoUsuarioBD) {
            throw new \Exception('Erro: Não foi encontrado seus horários no arquivo de ponto');
        }
        $arrInformationPonto = [];
        foreach ($arrPontoUsuarioBD as $arrPontoUsuario) {
            $arrInformationPonto[Date::convertDateBase($arrPontoUsuario['dt_ponto'])]['horario'][] = $arrPontoUsuario['hr_ponto'];
        }
        $arrInformationPonto = $this->calculaIntervaloHoraPonto($arrInformationPonto);
        return $arrInformationPonto;
    }

    /**
     * Retorna o caminho do arquivo do ponto
     *
     * @return string
     * @throws \Exception
     */
    protected function getPathArquivo()
    {
        $strFile = getBasePathApplication() . $this->strPathFile;
        if (!is_file($strFile)) {
            throw new \Exception('Arquivo não encontrado.');
        }
        return $strFile;
    }

    protected function calculaHoraSugerida($arrDataPaginator)
    {
        if ($arrDataPaginator) {
            foreach ($arrDataPaginator as $intPosicao => $arrInforHorario) {
                if ($arrInforHorario['hora_2'] !== 'Justificar' && $arrInforHorario['hora_3'] === 'Justificar') {
                    $strCalculoData = $this->calcularDiferencaHora(
                        $arrInforHorario['hora_1'],
                        $arrInforHorario['hora_0']
                    );
                    $strCalculoData = $this->calcularDiferencaHora($strCalculoData, '08:30');
                    $inicioDate = \DateTime::createFromFormat('H:i', $strCalculoData);
                    $fimDate = \DateTime::createFromFormat('H:i', $arrInforHorario['hora_2']);
                    if (!is_object($inicioDate) || !is_object($fimDate)) {
                        d($strCalculoData);
                        d($fimDate, 1);
                        continue;
                    }
                    $intCalculo = mktime(
                        $inicioDate->format('H') + $fimDate->format('H'),
                        $inicioDate->format('i') + $fimDate->format('i')
                    );
                    $arrDataPaginator[$intPosicao]['hora_3'] = '* ' . date('H:i', $intCalculo);
                }
            }
        }
        return $arrDataPaginator;
    }

    protected function calcularDiferencaHora($strHoraInicio, $strHoraFinal)
    {
        $inicio = new \DateTime($strHoraInicio);
        $fim = new \DateTime($strHoraFinal);
        return $fim->diff($inicio)->format('%H:%I');
    }

    /**
     * Retorna a justifica do usuario de acordo com o formato do ponto
     *
     * @param $intIdUsuario
     * @return array
     */
    protected function getListJustificativa($infoUsuario)
    {
        $arrListJustificativa = $this->getService('OrdemServico\Service\JustificativaPontoFile')
            ->findBy(['id_usuario' => $infoUsuario->getIdUsuario()]);
        $arrPontoJustificado = [];
        if ($arrListJustificativa) {
            foreach ($arrListJustificativa as $justificativa) {
                # complemetando o formato do ponto
                $strHorario = str_repeat('0', 10);
                $strHorario .= Date::convertDate($justificativa->getDtJustificativa(), 'dmY');
                $strHorario .= str_replace(':', '', $justificativa->getHrJustificada());
                $strHorario .= str_pad($infoUsuario->getNuPis(), 14, '0', STR_PAD_LEFT);
                $arrPontoJustificado[] = $strHorario;
            }
        }
        return $arrPontoJustificado;
    }

    protected function getInformationUsuario($arrCriteria)
    {
        ArrayCollection::clearEmptyParam($arrCriteria);
        if ($this->getService('OrdemServico\Service\Profile')->hasUsuarioPreposto() && isset($arrCriteria['no_executor'])) {
            $infoUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->find($arrCriteria['no_executor']);
        } else {
            $strLogin = strtolower($this->getIdentity()->usuarioSistema->usuario->login);
            $infoUsuario = reset($this->getService('OrdemServico\Service\UsuarioFile')->findBy([
                'ds_login' => $strLogin
            ]));
        }
        if (!$infoUsuario) {
            throw new \Exception('Usuário não cadastrado no sistema.');
        }
        return $infoUsuario;
    }
    
    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_PONTO_LANCAR
     */
    protected function lancarPontoAction($arrDataPost)
    {
        try {
            if ($this->getService('OrdemServico\Service\Profile')->getTipoVinculo() != Usuario::CO_PERFIL_CE ) {
                throw new \Exception('Usuário se permissão a funcionalidade.');
            }
            if ($arrDataPost['dt_ponto_ce'] == '') {
                throw new \Exception('Não foi informado a data do ponto');
            }
            if ($arrDataPost['periodo'] == '') {
                throw new \Exception('Não foi informado o turno do ponto');
            }
            $turnos = explode("|", $arrDataPost['periodo']);
            foreach ($turnos as $turno) {
                $arrPonto1 = null;
                $arrPonto2 = null;
                switch ($turno) {
                    case 'manha': 
                        $arrPonto1 = [
                            'dt_ponto' => $arrDataPost['dt_ponto_ce'],
                            'hr_ponto' => "08:00",
                        ];
                        $arrPonto2 = [
                            'dt_ponto' => $arrDataPost['dt_ponto_ce'],
                            'hr_ponto' => "12:00",
                        ];
                        break;
                    case 'tarde':
                        $arrPonto1 = [
                            'dt_ponto' => $arrDataPost['dt_ponto_ce'],
                            'hr_ponto' => "14:00",
                        ];
                        $arrPonto2 = [
                            'dt_ponto' => $arrDataPost['dt_ponto_ce'],
                            'hr_ponto' => "18:30",
                        ];
                        break;
                    case 'noite':
                        $arrPonto1 = [
                            'dt_ponto' => $arrDataPost['dt_ponto_ce'],
                            'hr_ponto' => "19:00",
                        ];
                        $arrPonto2 = [
                            'dt_ponto' => $arrDataPost['dt_ponto_ce'],
                            'hr_ponto' => "23:00",
                        ];
                        break;
                }
                if (!is_null($arrPonto1) && !is_null($arrPonto2)) {
                    $this->justificarPontoAction($arrPonto1);
                    $this->justificarPontoAction($arrPonto2);
                }
            }            
            return true;
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
