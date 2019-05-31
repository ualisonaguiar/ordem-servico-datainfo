<?php

namespace InepZend\Module\Log\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Module\Log\Service\LogModule as LogModuleService;
use InepZend\Util\FileSystem;
use InepZend\View\RenderTemplate;
use InepZend\Mail\Mail;
use InepZend\Util\ApplicationInfo;
use InepZend\Util\Date;

class LogCron extends AbstractServiceManager
{

    use RenderTemplate;

    const ACRONYM_PO = 'PRODUCT_OWNER';

    protected $arrTypeNivelLogCheck = array(
        LogModuleService::CO_LEVEL_ERROR,
    );

    /**
     * Metodo responsavel pela verificacao de arquivo existente de log.
     */
    public function checkLogExistingDateYesterday()
    {
        $strDateLog = Date::alterDate(date('Ymd'), 1, '-');
        foreach ($this->arrTypeNivelLogCheck as $strTypeNivelLogCheck) {
            $strPathLog = LogModuleService::PATH_LOG . $strDateLog . '-' . $strTypeNivelLogCheck . '.' . LogModuleService::TYPE_FILE;
            if (FileSystem::filesize($strPathLog))
                $this->sendMailResponsible($strDateLog, $strPathLog);
        }
    }

    /**
     * Metodo responsavel pelo envio do e-mail contendo as informacoes sobre o erro.
     *
     * @param string $strDateLog
     * @param string $strPathLog
     */
    private function sendMailResponsible($strDateLog, $strPathLog)
    {
        $arrApplicationInfo = ApplicationInfo::getApplicationInfo();
        if (array_key_exists('RESPONSIBLE', $arrApplicationInfo)) {
            $arrTemplateParam = array(
                'strNameApplication' => $arrApplicationInfo['NAME'],
                'strDateLogErro' => $strDateLog,
                'strPathLog' => $strPathLog,
            );
            $strContextEmailResponsible = $this->renderTemplate('inep-zend/log-cron/email-responsible', $arrTemplateParam);
            $mailer = new Mail();
            $mailer->setSubject('Erro no sistema: ' . $arrApplicationInfo['NAME']);
            foreach (array_keys($arrApplicationInfo['RESPONSIBLE']) as $strTypeResponsible) {
                $strEmail = $arrApplicationInfo['RESPONSIBLE'][$strTypeResponsible];
                if (empty($strEmail))
                    continue;
                $strAddMethod = 'add' . (($strTypeResponsible == self::ACRONYM_PO) ? 'To' : 'Cc');
                $mailer->$strAddMethod($strEmail);
            }
            $mailer->sendMail($strContextEmailResponsible);
        }
    }

}
