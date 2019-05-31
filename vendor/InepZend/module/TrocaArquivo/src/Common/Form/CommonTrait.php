<?php

namespace InepZend\Module\TrocaArquivo\Common\Form;

trait CommonTrait
{

    /**
     * Metodo responsavel por retornar a listagem de projeto.
     * 
     * @return array
     */
    protected function getListProjeto($arrCritetira = array())
    {
        return $this->getService('InepZend\Module\Corporative\Service\VwProjetoEvento')->fetchPairs($arrCritetira, 'getCoProjeto', 'getNoProjeto');
    }

    /**
     * Metodo responsavel retornar a listagem de evento.
     * 
     * @return array
     */
    protected function getListEvento($arrCritetira = array())
    {
        return $this->getService('InepZend\Module\Corporative\Service\VwProjetoEvento')->fetchPairs($arrCritetira, 'getCoEvento', 'getNoEvento');
    }

    /**
     * Metodo responsavel retornar a listagem de evento com data.
     * 
     * @return array
     */
    protected function getListEventData($arrCritetira = array())
    {
        return $this->getService('InepZend\Module\Corporative\Service\VwProjetoEvento')->fetchPairs($arrCritetira, 'getCoEvento', 'getNomeEventoDataInicioFim');
    }

    /**
     * Metodo responsavel retornar a listagem de layout cadastrado.
     * 
     * @return array
     */
    protected function getListLayout($intIdLayout = null)
    {
        $layout = array();
        if ($intIdLayout != null)
            $layout = array('id_layout' => (int) $intIdLayout);
        return $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->fetchPairs($layout, 'getIdLayout', 'getNoLayout');
    }

    /**
     * Metodo responsavel retornar a listagem de tipo de campos.
     * 
     * @return array
     */
    protected function getListTipo()
    {
        return $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->fetchPairs(array(), 'getIdTipo', 'getNoTipo');
    }

}
