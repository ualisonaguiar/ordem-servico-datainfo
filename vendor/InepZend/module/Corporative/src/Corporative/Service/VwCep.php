<?php

namespace InepZend\Module\Corporative\Service;

use InepZend\Service\AbstractServiceCache;

class VwCep extends AbstractServiceCache
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('coCep');
    }

    /**
     * @param integer $intNuCep
     * @return mix
     * 
     * @cache true
     */
    protected function solicitarDadosPorCep($intNuCep = null)
    {
        if (empty($intNuCep))
            return false;
        $cep = $this->find($intNuCep);
        if (!is_object($cep))
            return $cep;
        $arrResult = array(
            'RESPOSTA' => array(
                'NODELIST' => array(
                    'co_logradouro' => '',
                    'co_municipio' => (string) $cep->getCoMunicipio(),
                    'sg_uf' => $cep->getCoUf(),
                    'no_bairro' => $cep->getNoBairro(),
                    'tipo_logradouro' => $cep->getDsTipo(),
                    'no_logradouro' => $cep->getNoLogradouro(),
                    'no_logradouro_abrev' => '',
                    'no_complemento_logradouro' => '',
                    'nu_cep' => $cep->getCoCep(),
                    'co_ibge' => (string) $cep->getCoMunicipio(),
                    'co_uf' => '',
                    'no_municipio' => $cep->getNoCidade(),
                ),
            ),
        );
        return $arrResult;
    }

}
