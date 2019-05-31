<?php

namespace InepZend\Module\Log\Adapter\Container;

interface InterfaceAdapter
{

    /**
     * Metodo responsavel pela leitura dos dados que estao no container.
     *
     * @param string $strIndentityContainer
     */
    public function read($strIndentityContainer);

    /**
     * Metodo responsavel pela escrita dos dados no container.
     *
     * @param array $arrInformationLog
     * @param string $strIndentityContainer
     */
    public function write($arrInformationLog, $strIndentityContainer);

    /**
     * Metodo responsavel pela exclusao dos dados no container.
     *
     * @param string $strIndentityContainer
     */
    public function delete($strIndentityContainer = null);
}
