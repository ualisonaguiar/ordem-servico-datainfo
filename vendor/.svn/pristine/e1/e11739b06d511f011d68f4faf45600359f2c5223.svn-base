<?php

namespace InepZend\Module\Log\Adapter\Container;

use InepZend\Util\String;
use InepZend\Session\Session;

class SessionAdapter implements InterfaceAdapter
{

    const USE_GZCOMPRESS = true;

    private $session;

    public function __construct()
    {
        $this->session = new Session('informationLogApplication');
    }

    /**
     * Metodo responsavel pela leitura dos dados que estao no container.
     *
     * @param string $strIndentityContainer
     */
    public function delete($strIndentityContainer = null)
    {
        (!String::isNullEmpty($strIndentityContainer)) ?
                        $this->session->destroyFromName(base64_encode($strIndentityContainer)) :
                        $this->session->offsetUnset('arrInformationLog');
    }

    /**
     * Metodo responsavel pela escrita dos dados no container.
     *
     * @param array $arrInformationLog
     * @param string $strIndentityContainer
     */
    public function read($strIndentityContainer)
    {
        $arrInformationLog = $this->session->offsetGet('arrInformationLog');
        $strInformationLog = $arrInformationLog[base64_encode($strIndentityContainer)];
        if (self::USE_GZCOMPRESS && function_exists('gzuncompress'))
            $strInformationLog = gzuncompress($strInformationLog);
        return unserialize($strInformationLog);
    }

    /**
     * Metodo responsavel pela exclusao dos dados no container.
     *
     * @param string $strIndentityContainer
     */
    public function write($arrInformationLog, $strIndentityContainer)
    {
        $strInformationLog = serialize($arrInformationLog);
        if (self::USE_GZCOMPRESS && function_exists('gzcompress'))
            $strInformationLog = gzcompress($strInformationLog, 9);
        $arrDataSession = $this->session->offsetGet('arrInformationLog');
        $arrDataSession[base64_encode($strIndentityContainer)] = $strInformationLog;
        $this->session->offsetSet('arrInformationLog', $arrDataSession);
    }

}
