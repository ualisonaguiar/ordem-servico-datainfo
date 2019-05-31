<?php

namespace InepZend\Ssi\Entity;

use InepZend\Repository\Repository;

class PerfilAcaoRepository extends Repository
{

    protected $arrMethodFetchPairs = array('getIdAcao', 'getNoAcao');

    public function getDQLCustom(array $arrCriteria = null)
    {
        $strAlias = $this->getAlias();
        $strDQL = 'SELECT ' . $strAlias . ' FROM ' . $this->getEntityName() . ' ' . $strAlias;
        $strDQL .= ' JOIN ' . $strAlias . '.perfil p ';
        $strDQL .= ' JOIN p.usuarioSistemaPerfis usp ';
        $strDQL .= ' JOIN usp.usuario u ';

        # Passar valores default para buscar apenas perfil_acao ativos, dever ser default na consulta
        # este parametro eh responsavel por filtrar os itens de menu ativos no SSI
        $arrWhere = array("$strAlias.in_ativo_perfil_acao = :in_ativo_perfil_acao");
        $arrParameter = array('in_ativo_perfil_acao' => 1);

        foreach ((array) $arrCriteria as $strKey => $mixValue) {
            switch (strtolower($strKey)) {
                case 'id_usuario': {
                        $arrWhere[] = 'u.' . $strKey . ' = :' . $strKey;
                        $arrParameter[$strKey] = $mixValue;
                        break;
                    }
                case 'id_sistema': {
                        $arrWhere[] = 'p.' . $strKey . ' = :' . $strKey;
                        $arrParameter[$strKey] = $mixValue;
                        break;
                    }
                case 'in_ativo': {
                        $arrWhere[] = 'usp.' . $strKey . ' = :' . $strKey;
                        $arrParameter[$strKey] = $mixValue;
                        break;
                    }
                default: {
                        $arrWhere[] = $strAlias . '.' . $strKey . ' = :' . $strKey;
                        $arrParameter[$strKey] = $mixValue;
                        break;
                    }
            }
        }
        if (count($arrWhere) > 0)
            $strDQL .= ' WHERE ' . implode(' AND ', $arrWhere);
        $strDQL .= ' ORDER BY ' . $strAlias . '.sg_acao ASC , ' . $strAlias . '.no_acao ASC';
        return array($strDQL, $arrParameter);
    }

    public function getPerfilAcaoUsuario()
    {
        $arrCriteria = array(
            'id_usuario' => $this->getUser()->id,
            'id_sistema' => $this->getSystem()->id,
            'in_ativo' => 1,
        );
        $arrDQL = $this->getDQLCustom($arrCriteria);
        $query = $this->_em->createQuery($arrDQL[0]);
        if (!empty($arrDQL[1]))
            $query->setParameters($arrDQL[1]);
        return $query->getResult();
    }

}
