<?php

namespace InepZend\Paginator\Adapter;

use Zend\Paginator\Adapter\AdapterInterface;
use InepZend\Paginator\Paginator;
use InepZend\Doctrine\DBAL\Logging\FileSQLLogger;

class NativeQueryPaginator implements AdapterInterface
{

    protected $query;
    protected $count;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function count()
    {
        if (!$this->count) {
            $connection = $this->query->getEntityManager()->getConnection();
            FileSQLLogger::editConfiguration($connection->getConfiguration());
            $this->count = (int) $connection->fetchColumn('SELECT COUNT(*) FROM ( ' . $this->query->getSQL() . ' )', $this->getParameterArray());
        }
        return $this->count;
    }

    public function getItems($intOffset = 0, $intItemCountPerPage = Paginator::ITENS_PER_PAGE_DEFAULT)
    {
        $cloneQuery = clone $this->query;
        $cloneQuery->setParameters($this->getParameterArray());
        foreach ($this->query->getHints() as $strName => $mixValue)
            $cloneQuery->setHint($strName, $mixValue);
        $strSQL = 'SELECT * FROM ( SELECT table_intern.* , ROWNUM nu_row FROM ( ' . $cloneQuery->getSQL() . ' ) table_intern ) WHERE nu_row BETWEEN ' . ($intOffset + 1) . ' AND ' . ($intOffset + $intItemCountPerPage);
        $cloneQuery->setSQL($strSQL);
        return $cloneQuery->getResult();
    }

    private function getParameterArray()
    {
        $arrParameter = array();
        $arrParam = $this->query->getParameters()->toArray();
        foreach ($arrParam as $parameter)
            $arrParameter[$parameter->getName()] = $parameter->getValue();
        return $arrParameter;
    }

}
