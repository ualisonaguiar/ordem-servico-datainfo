<?php

namespace InepZend\Module\Executor\Service;

trait QueryTrait
{

    /**
     * Metodo responsavel por retornar o bind.
     *
     * @param string $strSql
     * @return array
     */
    protected function getBindFromSql($strSql = '')
    {
        $arrBind = array();
        if (($intPos = strpos($strSql, '@@')) !== false) {
            $strBind = substr($strSql, $intPos + 2);
            $arrBind = explode('@@', $strBind);
            foreach ($arrBind as $intBind => $strBind)
                $arrBind[$intBind] = str_replace(
                        array('(', ')', ';', '[', ']', '{', '}', ','), '', reset(explode(' ', $strBind))
                );
        }
        return $arrBind;
    }

    /**
     * Metodo responsavel por retorna o nome do usuario logado.
     *
     * @return string
     */
    protected function getNameUserUpdate()
    {
        return $this->getIdentity()->usuarioSistema->usuario->nome;
    }

}
