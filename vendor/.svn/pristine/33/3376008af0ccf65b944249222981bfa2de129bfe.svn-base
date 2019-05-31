<?php

namespace InepZend\Module\Crontab\AdminCron\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Util\ArrayCollection;
use InepZend\Util\Date;

class AdminCron extends AbstractServiceManager
{

    protected function insert(array $arrData = array())
    {
        return $this->save($arrData, __FUNCTION__);
    }

    protected function update(array $arrData = array())
    {
        return $this->save($arrData, __FUNCTION__);
    }

    protected function save(array $arrData = array(), $strMethod = 'insert')
    {
        $this->trace(__FUNCTION__, func_get_args());
        $arrDataCron = array(
            'id_cron' => @$arrData['id_cron'],
            'no_cron' => @$arrData['no_cron'],
            'ds_url' => @$arrData['ds_url'],
            'in_ativo' => @$arrData['in_ativo'],
            'dt_cadastro' => @$arrData['dt_cadastro'],
        );
        $arrDataCron['dt_cadastro'] = (empty($arrDataCron['dt_cadastro'])) ? date('Y-m-d H:i:s') : Date::convertDate($arrDataCron['dt_cadastro'], 'Y-m-d H:i:s');
        if (!empty($arrDataCron['id_cron']))
            $arrDataCron['id_cron'] = (integer) $arrDataCron['id_cron'];
        $cron = $this->getService('InepZend\Module\Crontab\Common\Service\File\CronFile')->$strMethod($arrDataCron);
        if (!is_object($cron))
            return false;
        $arrResult = ArrayCollection::objectToArray($cron);
        $arrPeriodoFinal = array();
        $arrPeriodoData = @$arrData['periodicidade'];
        if (is_array($arrPeriodoData)) {
            foreach ($arrPeriodoData as $mixPeriodicidade) {
                if (is_string($mixPeriodicidade))
                    $mixPeriodicidade = json_decode($mixPeriodicidade);
                if (is_object($mixPeriodicidade))
                    $mixPeriodicidade = ArrayCollection::objectToArray($mixPeriodicidade);
                if (in_array(null, $mixPeriodicidade))
                    continue;
                $mixPeriodicidade['id_cron'] = $cron->getIdCron();
                if (@empty($mixPeriodicidade['id_periodo']))
                    $mixPeriodicidade['id_periodo'] = '';
                $mixPeriodicidade['in_ativo'] = 1;
                $arrPeriodoFinal[] = $mixPeriodicidade;
            }
        }
        $periodoService = $this->getService('InepZend\Module\Crontab\Common\Service\File\PeriodoFile');
        $arrPeriodoAtual = $periodoService->findBy(array('id_cron' => $cron->getIdCron()));
        foreach ($arrPeriodoAtual as $periodoAtual) {
            $arrRegisterAtual = $periodoAtual->toArray();
            if ((@empty($arrRegisterAtual['in_ativo'])) || (!@$arrRegisterAtual['in_ativo'])) {
                $arrPeriodoFinal[] = $arrRegisterAtual;
                continue;
            }
            $strKeyAtual = @$arrRegisterAtual['nu_mes'] . @$arrRegisterAtual['nu_dia_semana'] . @$arrRegisterAtual['nu_dia'] . @$arrRegisterAtual['nu_hora'] . @$arrRegisterAtual['nu_minuto'];
            $booExists = false;
            foreach ($arrPeriodoFinal as $arrRegisterFinal) {
                if (!@empty($arrRegisterFinal['id_periodo'])) {
                    if ($arrRegisterAtual['id_periodo'] == $arrRegisterFinal['id_periodo']) {
                        $booExists = true;
                        break;
                    }
                } else {
                    $strKeyFinal = @$arrRegisterFinal['nu_mes'] . @$arrRegisterFinal['nu_dia_semana'] . @$arrRegisterFinal['nu_dia'] . @$arrRegisterFinal['nu_hora'] . @$arrRegisterFinal['nu_minuto'];
                    if ($strKeyAtual == $strKeyFinal) {
                        $booExists = true;
                        break;
                    }
                }
            }
            if (!$booExists) {
                $arrRegisterAtual['in_ativo'] = 0;
                $arrPeriodoFinal[] = $arrRegisterAtual;
            }
        }
        if (!empty($arrPeriodoFinal)) {
            foreach ($arrPeriodoFinal as $arrRegisterFinal) {
                $periodoFinal = $periodoService->save($arrRegisterFinal);
                if (!is_object($periodoFinal))
                    return false;
            }
            $arrResult['periodicidade'] = $arrPeriodoFinal;
        }
        return $arrResult;
    }

    protected function getDataToSave($intIdCron = null)
    {
        $cron = $this->getService('InepZend\Module\Crontab\Common\Service\File\CronFile')->find((integer) $intIdCron);
        if (!is_object($cron))
            return array();
        $arrData = ArrayCollection::objectToArray($cron);
        $arrData['periodicidade'] = array();
        $arrPeriodo = $this->getService('InepZend\Module\Crontab\Common\Service\File\PeriodoFile')->findBy(array('id_cron' => $cron->getIdCron(), 'in_ativo' => 1));
        foreach ((array) $arrPeriodo as $periodo)
            $arrData['periodicidade'][] = ArrayCollection::objectToArray($periodo);
        return $arrData;
    }

}
