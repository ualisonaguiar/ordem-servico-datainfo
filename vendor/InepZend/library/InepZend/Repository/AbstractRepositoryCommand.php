<?php

namespace InepZend\Repository;

use InepZend\Repository\AbstractRepositoryQuery;

/**
 * Classe abstrata responsavel por metodos de execucao de alguns comandos SQL.
 * 
 * [-] AbstractRepositoryCore
 *      [-] AbstractRepositoryEntityManager
 *          [-] AbstractRepositoryQuery
 *              [+] AbstractRepositoryCommand
 *                  [-] AbstractRepository
 *
 * @package InepZend
 * @subpackage Repository
 */
abstract class AbstractRepositoryCommand extends AbstractRepositoryQuery
{

    /**
     * Metodo responsavel em remover entidades filtradas por uma condicao.
     * 
     * @example $this->deleteBy(array('name_column1' => 'value1', 'name_column2' => 'value2'), array('name_column1' => 'value'));
     * 
     * @param array $arrCriteria
     * @param array $arrNotIn
     * @return mix
     */
    public function deleteBy(array $arrCriteria = array(), array $arrNotIn = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        $strDQL = 'DELETE FROM ' . $this->getEntityName() . ' ' . $this->getAlias();
        $arrIn = array();
        foreach ((array) $arrCriteria as $strKey => $mixValue) {
            if (in_array($strKey, (array) $arrNotIn))
                continue;
            if (is_array($mixValue))
                $arrIn[] = $strKey;
        }
        $arrWhereParameter = $this->constructWhereParameter(null, $arrCriteria, null, $arrIn, null, $arrNotIn, $strDQL, 'WHERE');
        return $this->executeDQL($strDQL, $arrWhereParameter[1])->getResult();
    }

    /**
     * Metodo responsavel em alterar entidades filtradas por uma condicao.
     * 
     * @example $this->updateBy(array('name_column1' => 'value1', 'name_column2' => 'value2'), array('name_column1' => 'value'));
     * 
     * @param array $arrData
     * @param array $arrSetterFk
     * @return mix
     */
    public function updateBy(array $arrData = array(), array $arrCriteria = array(), array $arrNotIn = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        $strSet = '';
        foreach ((array) $arrData as $strKey => $mixValue) {
            if (!empty($strSet))
                $strSet .= ',';
            if (!is_numeric($mixValue))
                $mixValue = '\'' . $mixValue . '\'';
            $strSet .= ' ' . $this->getAlias() . '.' . $strKey . ' = ' . $mixValue . '';
        }
        $strDQL = 'UPDATE ' . $this->getEntityName() . ' ' . $this->getAlias() . ' SET' . $strSet;
        $arrIn = array();
        foreach ((array) $arrCriteria as $strKey => $mixValue) {
            if (in_array($strKey, $arrNotIn))
                continue;
            if (is_array($mixValue))
                $arrIn[] = $strKey;
        }
        $arrWhereParameter = $this->constructWhereParameter(null, $arrCriteria, null, $arrIn, null, $arrNotIn, $strDQL, 'WHERE');
        return $this->executeDQL($strDQL, $arrWhereParameter[1])->getResult();
    }

    /**
     * Metodo responsavel em abrir transacao no banco de dados.
     * 
     * @example $this->begin();
     * 
     * @return mix
     */
    public function begin()
    {
        return $this->getEntityManager()->beginTransaction();
    }

    /**
     * Metodo responsavel em salvar/executar a transacao ja realizada no banco de
     * dados.
     * 
     * @example $this->commit();
     * 
     * @return mix
     */
    public function commit()
    {
        return $this->getEntityManager()->commit();
    }

    /**
     * Metodo responsavel em desfazer a transacao aberta no banco de dados.
     * 
     * @example $this->rollback();
     * 
     * @return mix
     */
    public function rollback()
    {
        return $this->getEntityManager()->rollback();
    }

}
