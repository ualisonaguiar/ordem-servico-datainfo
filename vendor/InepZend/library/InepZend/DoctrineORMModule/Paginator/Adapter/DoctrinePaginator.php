<?php
namespace InepZend\DoctrineORMModule\Paginator\Adapter;

use Doctrine\ORM\Tools\Pagination\Paginator;
use InepZend\Paginator\Paginator as PaginatorInepZend;

class DoctrinePaginator
{
    
    protected $paginator;

    public function __construct(Paginator $paginator)
    {
        $this->setPaginator($paginator);
    }

    public function setPaginator(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    public function getPaginator()
    {
        return $this->paginator;
    }

    public function count()
    {
        return $this->getPaginator()->count();
    }

    public function getItems($intOffset = 0, $intItemCountPerPage = PaginatorInepZend::ITENS_PER_PAGE_DEFAULT)
    {
        $this->getPaginator()
            ->getQuery()
            ->setFirstResult($intOffset)
            ->setMaxResults($intItemCountPerPage);
        return $this->getPaginator()->getIterator();
    }
    
}
