<?php

namespace InepZend\Module\Crontab\VarreduraCron\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Module\Crontab\Common\Service\File\AndamentoFile;
use InepZend\Dto\ResultDto;
use InepZend\Util\Uri;
use InepZend\Util\Curl;
use InepZend\Util\Environment;
use Zend\Json\Json;

class VarreduraCron extends AbstractServiceManager
{

    protected function runCron($booForceExec = false)
    {
        $arrCron = $this->getService('InepZend\Module\Crontab\Common\Service\File\CronFile')->findBy(array('in_ativo' => 1));
        if (!is_array($arrCron))
            return self::getResult(ResultDto::STATUS_ERROR, 'Erro ao capturar as crons ativas.');
        $arrError = array();
        $arrAndamentoInitial = array(
            'id_andamento' => null,
            'id_periodo' => null,
            'ds_complemento' => null,
            'tp_andamento' => AndamentoFile::RUNNING,
            'dt_andamento' => null,
        );
        $strMethod = 'GET';
        $intTimeout = 1;
        $periodoService = $this->getService('InepZend\Module\Crontab\Common\Service\File\PeriodoFile');
        $andamentoService = $this->getService('InepZend\Module\Crontab\Common\Service\File\AndamentoFile');
        foreach ($arrCron as $cron) {
            $arrPeriodo = $periodoService->findBy(array('id_cron' => $cron->getIdCron(), 'in_ativo' => 1));
            if (!is_array($arrPeriodo)) {
                $arrError[] = 'Erro ao capturar as periodicidades ativas da cron (' . Json::encode($cron) . ').';
                continue;
            }
            $arrInfoUrl = parse_url($cron->getDsUrl());
            $strIp = gethostbyname($arrInfoUrl['host']);
            foreach ($arrPeriodo as $periodo) {
                if (!$booForceExec) {
                    if ((is_null($periodo->getNuMes())) || (($periodo->getNuMes() != '*') && ($periodo->getNuMes() != date('m'))))
                        continue;
                    if ((is_null($periodo->getNuDiaSemana())) || (($periodo->getNuDiaSemana() != '*') && ($periodo->getNuDiaSemana() != date('w'))))
                        continue;
                    if ((is_null($periodo->getNuDia())) || (($periodo->getNuDia() != '*') && ($periodo->getNuDia() != date('d'))))
                        continue;
                    if ((is_null($periodo->getNuHora())) || (($periodo->getNuHora() != '*') && ($periodo->getNuHora() != date('H'))))
                        continue;
                    if ((is_null($periodo->getNuMinuto())) || (($periodo->getNuMinuto() != '*') && ($periodo->getNuMinuto() != date('i'))))
                        continue;
                }
                $arrAndamento = $arrAndamentoInitial;
                $arrAndamento['id_periodo'] = $periodo->getIdPeriodo();
                $arrAndamento['dt_andamento'] = date('Y-m-d H:i:s');
                $andamento = $andamentoService->insert($arrAndamento);
                if (!is_object($andamento)) {
                    $arrError[] = 'Erro ao inserir o primeiro andamento da periodicidade da cron (' . Json::encode($periodo) . ').';
                    continue;
                }
                $booOk = true;
                if ((($strIp == Environment::IP_LOCAL) && (!is_string(Uri::execUrl($arrInfoUrl['host'], $arrInfoUrl['path'], $arrInfoUrl['query'], $arrInfoUrl['port'], $intTimeout, $strMethod, '', true)))) || (!is_array(Curl::getCurl($cron->getDsUrl(), array(), $strMethod, array(CURLOPT_TIMEOUT => $intTimeout))))) {
                    $arrError[] = 'Erro ao requisitar a URL da cron ativa (' . Json::encode($cron) . ').';
                    $booOk = false;
                }
                $arrAndamento['tp_andamento'] = ($booOk) ? AndamentoFile::COMPLETED : AndamentoFile::FAILURE;
                $arrAndamento['dt_andamento'] = date('Y-m-d H:i:s');
                $andamento = $andamentoService->insert($arrAndamento);
                if (!is_object($andamento)) {
                    $arrError[] = 'Erro ao inserir o último andamento da periodicidade da cron (' . Json::encode($periodo) . ').';
                    continue;
                }
            }
        }
        return (empty($arrError)) ? self::getResult(ResultDto::STATUS_OK, 'Varredura de Crons realizada com SUCESSO!') : self::getResult(ResultDto::STATUS_ERROR, 'Varredura de Crons realizada com ERRO!', $arrError);
    }

}
