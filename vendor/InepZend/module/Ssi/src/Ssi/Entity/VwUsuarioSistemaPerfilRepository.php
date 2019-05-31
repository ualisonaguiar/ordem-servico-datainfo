<?php

namespace InepZend\Module\Ssi\Entity;

use InepZend\Repository\Repository;

class VwUsuarioSistemaPerfilRepository extends Repository
{

    protected function findByUserAdminFromSystem($strClientId = null, $booExecute = null)
    {
        if (empty($strClientId))
            $strClientId = @$GLOBALS['authServiceAdapter']['paramHeaderRequest']['client-id'];
        if (empty($strClientId))
            return array();
        $strAlias = 'usp';
        $strSQL = 'SELECT DISTINCT 
                ' . $strAlias . '.ID_USUARIO_SISTEMA_PERFIL, 
                ' . $strAlias . '.ID_USUARIO_SISTEMA, 
                ' . $strAlias . '.ID_PERFIL,
                ' . $strAlias . '.IN_ATIVO
            FROM SSI.VW_SISTEMA s
            INNER JOIN SSI.VW_PERFIL p ON
                s.ID_SISTEMA = p.ID_SISTEMA AND
                p.IN_ATIVO_PERFIL = :in_ativo_perfil
            INNER JOIN SSI.VW_USUARIO_SISTEMA_PERFIL ' . $strAlias . ' ON
                p.ID_PERFIL = ' . $strAlias . '.ID_PERFIL AND
                ' . $strAlias . '.IN_ATIVO = :in_ativo_usp
            WHERE 
                s.IN_ATIVO = :in_ativo_sistema AND
                s.CO_CLIENTE = :co_cliente AND
                LOWER(p.NO_PERFIL) LIKE :no_perfil
            ORDER BY
                ' . $strAlias . '.ID_USUARIO_SISTEMA_PERFIL';
        $arrParameter = array(
            'in_ativo_perfil' => 1,
            'in_ativo_usp' => 1,
            'in_ativo_sistema' => 1,
            'co_cliente' => $strClientId,
            'no_perfil' => 'admin%',
        );
        $arrMapping = array(
            $strAlias => array(
                'from' => array(
                    'entity' => 'InepZend\Module\Ssi\Entity\VwUsuarioSistemaPerfil',
                ),
                'field' => array(array('ID_USUARIO_SISTEMA_PERFIL', 'idUsuarioSistemaPerfil'), array('ID_USUARIO_SISTEMA', 'idUsuarioSistema'), array('ID_PERFIL', 'idPerfil'), array('IN_ATIVO', 'inAtivo')),
            )
        );
        return $this->executeSQLMapping($strSQL, $arrParameter, $this->constructMapping($arrMapping), $booExecute);
    }

}
