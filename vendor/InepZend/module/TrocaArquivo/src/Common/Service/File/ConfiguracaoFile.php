<?php

namespace InepZend\Module\TrocaArquivo\Common\Service\File;

use InepZend\Module\TrocaArquivo\Common\Service\File\AbstractServiceFile;
use InepZend\Util\Date;
use InepZend\Util\ArrayCollection;
use InepZend\Exception\DomainException;

class ConfiguracaoFile extends AbstractServiceFile
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('id_configuracao');
    }

    public static function getNameFromIdConfiguracao($intIdConfiguracao = null)
    {
        if (empty($intIdConfiguracao))
            return false;
        $configuracaoService = self::getServiceManager()->get('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile');
        $configuracao = $configuracaoService->find(array('id_configuracao' => $intIdConfiguracao));
        if (!is_object($configuracao))
            return $intIdConfiguracao;
        return $configuracaoService->getNameFromConfiguracao($configuracao);
    }

    protected function listConfiguracao($booCheckDtEvento = true, $booPersonalInfo = true, $booCheckInStatus = true)
    {
        $arrConfiguracao = ($booPersonalInfo) ? $this->findByPersonal() : $this->findBy();
        if (empty($arrConfiguracao))
            throw new DomainException('Não existe alguma janela de envio dos dados.');
        $arrEntity = array();
        foreach ($arrConfiguracao as $configuracao) {
            $mixNoConfiguracao = $this->getNameFromConfiguracao($configuracao, $booCheckDtEvento, $booCheckInStatus);
            if (!is_bool($mixNoConfiguracao))
                $arrEntity[$configuracao->getIdConfiguracao()] = $mixNoConfiguracao;
        }
        if (empty($arrEntity))
            throw new DomainException('Não existe alguma janela de envio dos dados disponível.');
        return $arrEntity;
    }

    protected function getNameFromConfiguracao($configuracao = null, $booCheckDtEvento = false, $booCheckInStatus = false)
    {
        if (is_object($configuracao)) {
            $layout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->find($configuracao->getIdLayout());
            if (is_object($layout)) {
                if (($booCheckInStatus) && (((integer) $layout->getInStatus()) == 0))
                    return false;
                $strNoConfiguracao = $layout->getNoLayout() . '/' . $configuracao->getSgUf();
                $intCoProjeto = $configuracao->getCoProjeto();
                $intCoEvento = $configuracao->getCoEvento();
                if ((!empty($intCoProjeto)) && (!empty($intCoEvento))) {
                    $arrVwProjetoEvento = $this->getService('InepZend\Module\Corporative\Service\VwProjetoEvento')->findBy(array('coProjeto' => $intCoProjeto, 'coEvento' => $intCoEvento));
                    if ((is_array($arrVwProjetoEvento)) && (count($arrVwProjetoEvento) > 0)) {
                        $vwProjetoEvento = end($arrVwProjetoEvento);
                        if (($booCheckDtEvento) && (Date::convertDate($vwProjetoEvento->getDtFimEvento(), 'Y-m-d H:i:s') < date('Y-m-d H:i:s')))
                            return false;
                        $strNoConfiguracao .= ' - ' . $vwProjetoEvento->getNoEvento() . ' - ' . $vwProjetoEvento->getDtInicioEvento() . ' à ' . $vwProjetoEvento->getDtFimEvento();
                    }
                }
                return $strNoConfiguracao;
            }
        }
        return false;
    }

    protected function findByPersonal(array $arrCriteria = array())
    {
        $arrResponsavel = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile')->getPersonalInfo();
        $arrConfiguracao = array();
        foreach ($arrResponsavel as $responsavel) {
            $arrCriteriaConfiguracao = ArrayCollection::merge($arrCriteria, array('co_projeto' => $responsavel->getCoProjeto(), 'sg_uf' => $responsavel->getSgUf()));
            if (strtoupper($responsavel->getSgUf()) == 'BR')
                unset($arrCriteriaConfiguracao['sg_uf']);
            $arrConfiguracao = ArrayCollection::merge($arrConfiguracao, $this->findBy($arrCriteriaConfiguracao));
        }
        return $arrConfiguracao;
    }

}
