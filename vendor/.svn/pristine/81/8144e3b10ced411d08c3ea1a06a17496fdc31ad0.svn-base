<?php

namespace InepZend\Module\TrocaArquivo\ConfigEnvio\Service;

use InepZend\Module\TrocaArquivo\Common\Service\AbstractService;

class ConfigEnvio extends AbstractService
{

    public function getConfigEnvio($arrPost)
    {
        if (array_key_exists("id_configuracao", $arrPost))
            $arrConfiguracao['id_configuracao'] = (int) $arrPost["id_configuracao"];
        else
            $arrConfiguracao = [
                'co_projeto' => $arrData['co_projeto'],
                'co_evento' => $arrData['co_evento'],
                'ds_destino' => $arrData['ds_destino'],
                'ds_prioridade' => $arrData['ds_prioridade'],
                'id_layout' => (int) $arrData['id_layout'],
                'sg_uf' => $arrData['sg_uf']
            ];
        $configuracao = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->findBy($arrConfiguracao);
        if (is_array($configuracao))
            return (reset($configuracao)->toArray());
        else
            return $configuracao;
    }

    public function save($intIdLayout = null, $arrData = null)
    {
        #entidade configuracao
        $arrConfiguracao = array(
            'co_projeto' => $arrData['co_projeto'],
            'co_evento' => $arrData['co_evento'],
            'ds_destino' => $arrData['ds_destino'],
            'ds_prioridade' => $arrData['ds_prioridade'],
            'sg_uf' => $arrData['sg_uf'],
            'in_validacao_impeditiva' => $arrData['in_validacao_impeditiva'],
            'id_layout' => $intIdLayout,
        );
        $arrConfiguracao['sg_uf'] = $arrData['sg_uf'];
        #verifica se ja existe a configuracao
        $mixValida = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->findBy($arrConfiguracao);
        #se ja existe configuracao para o mesmo layout/projeto/evento/destino/prioridade/uf 
        #adiciona o id_configuracao para o update
        if (!empty($mixValida)) 
            $arrConfiguracao['id_configuracao'] = reset($mixValida)->getIdConfiguracao();
        $mixResult = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->save($arrConfiguracao);
    }

    public function delete($arrConfiguracao)
    {
        return $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->delete($arrConfiguracao);
    }

}
