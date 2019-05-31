<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractService;
use InepZend\Service\ServiceAngularTrait;

class VwDemandaVinculadaOrdemServicoFile extends AbstractService
{
    use ServiceAngularTrait;

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_ordem_servico', 'id_demanda', 'nu_ordem_servico');
    }

    protected function gerarRelatorioPessoalDesempenho($arrDataPost)
    {
        unset ($arrDataPost['no_executor_first'], $arrDataPost['no_executor_last']);
        if (!$this->getService('OrdemServico\Service\Profile')->hasUsuarioPreposto()) {
            $arrDataPost['no_executor'][] = $this->getIdentity()->usuarioSistema->usuario->nome;
        }
        return $this->getRepositoryEntity()->gerarRelatorioPessoalDesempenho($arrDataPost);
    }

    protected function gerarRelatorioDesempenho($arrDataPost)
    {
        return $this->getRepositoryEntity()->gerarRelatorioDesempenho($arrDataPost);
    }

    /**
     * @cache true
     * @param $arrDataPost
     * @return mixed
     */
    protected function relatorioOrdemServicoAcetei($arrDataPost)
    {
        return $this->getRepositoryEntity()->relatorioOrdemServicoAcetei($arrDataPost);
    }
}
