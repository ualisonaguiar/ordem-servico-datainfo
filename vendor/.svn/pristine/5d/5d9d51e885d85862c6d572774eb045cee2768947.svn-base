<?php

namespace InepZend\Mail;

use Zend\Mail\Message,
    Zend\Mail\Transport\Smtp as SmtpTransport,
    Zend\Mail\Transport\SmtpOptions,
    Zend\Mail\AddressList;
use Zend\Mime\Message as MimeMessage,
    Zend\Mime\Part as MimePart,
    Zend\Mime\Mime;
use InepZend\Util\DebugExec;
use InepZend\Util\Environment;
use InepZend\Util\FileSystem;
use InepZend\Util\Validate;
use InepZend\Util\Reflection;
use InepZend\Log\Log;
use \Exception as ExceptionNative;

class Mail extends Message
{

    use DebugExec;

    const DEBUG = false;
    const SMTP_DESENV = '172.29.0.42';
    const SMTP_ENTREGA = '172.29.0.42';
    const SMTP_TQS = '172.29.0.42';
    const SMTP_HOMOLOGA = '172.29.0.42';
    const SMTP = '172.29.2.11';

    private $booCheckDomain = false;

    public function sendMail($strContent = null, $strSubject = null, $mixTo = null, $mixCc = null, $mixBcc = null, $mixFrom = null, $mixPathFile = null, $mixReplyTo = null, $strEncoding = 'UTF-8')
    {
        $htmlPart = new MimePart($strContent);
        $htmlPart->type = Mime::TYPE_HTML;
        $textPart = new MimePart(strip_tags($strContent));
        $textPart->type = Mime::TYPE_TEXT;
        $arrPart = array($textPart, $htmlPart);
        if (!empty($mixPathFile)) {
            if (!is_array($mixPathFile))
                $mixPathFile = array($mixPathFile);
            foreach ($mixPathFile as $strPathFile) {
                $this->debugExec($strPathFile);
                $this->debugExec(is_file($strPathFile));
                if (!is_file($strPathFile))
                    continue;
//                $attachPart = new MimePart(fopen($strPathFile, 'r'));
                $attachPart = new MimePart(file_get_contents($strPathFile));
                $attachPart->type = FileSystem::getMimeContentFromFile($strPathFile);
                $attachPart->filename = FileSystem::getFileNameFromPath($strPathFile);
                $attachPart->disposition = Mime::DISPOSITION_ATTACHMENT;
                $arrPart[] = $attachPart;
            }
        }
        $body = new MimeMessage();
        $body->setParts($arrPart);
        if (!empty($strSubject))
            $this->setSubject($strSubject);
        if (!empty($mixTo))
            $this->addTo($mixTo);
        if (!empty($mixCc))
            $this->addCc($mixCc);
        if (!empty($mixBcc))
            $this->addBcc($mixBcc);
        if (!empty($mixFrom))
            $this->addFrom($mixFrom);
        if (!empty($mixReplyTo))
            $this->addReplyTo($mixReplyTo);
        if (!empty($strEncoding))
            $this->setEncoding($strEncoding);
        $this->setBody($body);
        $this->getHeaders()->get('content-type')->setType('multipart/alternative');
        try {
            $mixResult = $this->send();
        } catch (ExceptionNative $exception) {
            $this->logException($exception, array($this, func_get_args()));
            $mixResult = $exception;
            $this->debugExec($exception->getMessage());
        }
        $this->debugExec($mixResult);
        return $mixResult;
    }

    public function send()
    {
        $smtpTransport = new SmtpTransport();
        $smtpOptions = new SmtpOptions(array(
            'name' => 'smtp.inep.gov.br',
            'host' => $this->getHost(),
            'port' => $this->getPort(),
        ));
        $smtpTransport->setOptions($smtpOptions);
        $this->checkFrom();
        $this->debugExec($this, null, true);
        $this->debugExec($smtpTransport);
        return $smtpTransport->send($this);
    }

    public function setCheckDomain($booCheckDomain = true)
    {
        $this->booCheckDomain = (bool) $booCheckDomain;
    }

    public function getCheckDomain()
    {
        return (bool) $this->booCheckDomain;
    }

    /**
     *
     * @param mix $mixEmailOrAddressOrList
     * @param string $strName
     * @return object
     */
    public function addTo($mixEmailOrAddressOrList, $strName = null)
    {
        return $this->addEmail(__FUNCTION__, func_get_args());
    }

    /**
     *
     * @param mix $mixEmailOrAddressOrList
     * @param string $strName
     * @return object
     */
    public function addCc($mixEmailOrAddressOrList, $strName = null)
    {
        return $this->addEmail(__FUNCTION__, func_get_args());
    }

    /**
     *
     * @param mix $mixEmailOrAddressOrList
     * @param string $strName
     * @return object
     */
    public function addBcc($mixEmailOrAddressOrList, $strName = null)
    {
        return $this->addEmail(__FUNCTION__, func_get_args());
    }

    /**
     *
     * @param mix $mixEmailOrAddressOrList
     * @param string $strName
     * @return object
     */
    public function addFrom($mixEmailOrAddressOrList, $strName = null)
    {
        return $this->addEmail(__FUNCTION__, func_get_args());
    }

    /**
     *
     * @param mix $mixEmailOrAddressOrList
     * @param string $strName
     * @return object
     */
    public function addReplyTo($mixEmailOrAddressOrList, $strName = null)
    {
        return $this->addEmail(__FUNCTION__, func_get_args());
    }

    protected function updateAddressList(AddressList $addressList, $emailOrAddressOrList, $name, $callingMethod)
    {
        $arrEmailOrAddressOrList = array();
        if (($emailOrAddressOrList instanceof Traversable) || (is_array($emailOrAddressOrList))) {
            foreach ($emailOrAddressOrList as $mixAddress) {
                if (is_string($mixAddress))
                    $this->addValidAddress(explode(';', $mixAddress), $arrEmailOrAddressOrList);
                else
                    $arrEmailOrAddressOrList[] = $mixAddress;
            }
            $emailOrAddressOrList = $arrEmailOrAddressOrList;
        } elseif (is_string($emailOrAddressOrList)) {
            $this->addValidAddress(explode(';', $emailOrAddressOrList), $arrEmailOrAddressOrList);
            $emailOrAddressOrList = implode(';', $arrEmailOrAddressOrList);
        }
        $this->debugExec($emailOrAddressOrList);
        return parent::updateAddressList($addressList, $emailOrAddressOrList, $name, $callingMethod);
    }

    private function addValidAddress(array $arrAddress = array(), array &$arrEmailOrAddressOrList = array())
    {
        foreach ($arrAddress as $strAddress) {
            $strAddress = trim(strtolower($strAddress));
            if (!Validate::validateEmail($strAddress, $this->getCheckDomain()))
                continue;
            $arrEmailOrAddressOrList[] = $strAddress;
        }
        return (count($arrEmailOrAddressOrList) > 0);
    }

    private function getSmtp()
    {
        return Reflection::listConstantsFromClass($this, 'SMTP' . Environment::getSufix());
    }

    private function getHost()
    {
        $strSmtp = $this->getSmtp();
        if (empty($strSmtp))
            return;
        $arrSmtp = explode(':', $strSmtp);
        return (count($arrSmtp) > 0) ? $arrSmtp[0] : '172.29.0.42';
    }

    private function getPort()
    {
        $strSmtp = $this->getSmtp();
        if (empty($strSmtp))
            return;
        $arrSmtp = explode(':', $strSmtp);
        return (count($arrSmtp) > 1) ? $arrSmtp[1] : 25;
    }

    private function checkFrom()
    {
        $mixFrom = $this->getFrom();
        if (((!is_object($mixFrom)) && (empty($mixFrom))) || ((is_object($mixFrom)) && ($mixFrom instanceof AddressList) && ($mixFrom->count() == 0)))
            $this->setFrom('nao-responder@inep.gov.br', 'Inep');
    }

    private function addEmail($strMethod, $arrParam = null)
    {
        return parent::$strMethod($this->adaptEmail($arrParam[0]), (array_key_exists(1, $arrParam)) ? $arrParam[1] : null);
    }

    private function adaptEmail($mixEmail)
    {
        if (is_string($mixEmail)) {
            $mixEmail = str_replace(' ', '', $mixEmail);
            if (strpos($mixEmail, ';') !== false)
                $mixEmail = explode(';', $mixEmail);
        }
        return $mixEmail;
    }

    private function logException($exception, $mixLogErrorContent)
    {
        $log = new Log();
        $log->critical($exception);
        $log->error($mixLogErrorContent);
    }

}
