<?php
namespace InepZend\Paginator\Adapter;

use InepZend\Paginator\Paginator;

class ArrayPaginator
{

    protected $array;
    protected $count;

    public function __construct(array $arrData = array())
    {
        $this->array = $arrData;
        $this->count = count($arrData);
    }

    public function count()
    {
        return $this->count;
    }

    public function getItems($intOffset = 0, $intItemCountPerPage = Paginator::ITENS_PER_PAGE_DEFAULT)
    {
        return array_slice($this->array, $intOffset, $intItemCountPerPage);
    }

}
