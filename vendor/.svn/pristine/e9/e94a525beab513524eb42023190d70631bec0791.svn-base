<?php

namespace InepZend\Paginator;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Zend\Paginator\Adapter\ArrayAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator as ZendPaginator;
use InepZend\Grid\Flexigrid\View\Helper\GridHelper;

/**
 * Classe responsavel em manipular as informacoes necessarias para a paginacao de
 * registros de diferentes elementos.
 */
class Paginator
{

    private $intPage;
    private $intItemPerPage;
    private $intTotal;
    private $zendPaginator;
    private $arrRegister;
    private $arrRegisterToGrid;

    const ITENS_PER_PAGE_DEFAULT = 10;
    const TYPE_TEXT = GridHelper::TYPE_TEXT;
    const TYPE_LINK = GridHelper::TYPE_LINK;
    const TYPE_LINK_DATA = GridHelper::TYPE_LINK_DATA;
    const TYPE_IMG = GridHelper::TYPE_IMG;
    const TYPE_IMG_DATA = GridHelper::TYPE_IMG_DATA;
    const TYPE_INPUT_HIDDEN = GridHelper::TYPE_INPUT_HIDDEN;
    const TYPE_INPUT_HIDDEN_TEXT = GridHelper::TYPE_INPUT_HIDDEN_TEXT;
    const TYPE_INPUT_TEXT = GridHelper::TYPE_INPUT_TEXT;
    const TYPE_INPUT_RADIO = GridHelper::TYPE_INPUT_RADIO;
    const TYPE_INPUT_CHECKBOX = GridHelper::TYPE_INPUT_CHECKBOX;
    const TYPE_INPUT_SELECT = GridHelper::TYPE_INPUT_SELECT;
    const TYPE_ROUTE = GridHelper::TYPE_ROUTE;

    /**
     * Metodo construtor responsavel em setar as informacoes principais da paginacao.
     * 
     * @param mix $queryArray
     * @param integer $intPage
     * @param integer $intItemPerPage
     * @return void
     */
    public function __construct($queryArray = null, $intPage = 1, $intItemPerPage = self::ITENS_PER_PAGE_DEFAULT)
    {
        $this->intPage = (int) $intPage;
        $this->intItemPerPage = (int) $intItemPerPage;
        if (!is_null($queryArray))
            $this->paginate($queryArray);
    }

    /**
     * Metodo responsavel em retornar os registros, apos a paginacao ser realizada.
     * 
     * @return array
     */
    public function getRegister()
    {
        return (array) $this->arrRegister;
    }

    /**
     * Metodo responsavel em definir os registros.
     * 
     * @return object
     */
    public function setRegister($arrRegister = null)
    {
        $this->arrRegister = $arrRegister;
        return $this;
    }

    /**
     * Metodo responsavel em retornar o objeto ZendPaginator, apos a paginacao ser realizada.
     * 
     * @return object
     */
    public function getZendPaginator()
    {
        return $this->zendPaginator;
    }

    /**
     * Metodo responsavel em definir o objeto ZendPaginator.
     *
     * @return object
     */
    public function setZendPaginator($zendPaginator = null)
    {
        $this->zendPaginator = $zendPaginator;
        return $this;
    }

    /**
     * Metodo responsavel em retornar o total de registros, apos a paginacao ser realizada.
     * 
     * @return integer
     */
    public function getTotal()
    {
        return $this->intTotal;
    }

    /**
     * Metodo responsavel em definir o total de registros.
     *
     * @return object
     */
    public function setTotal($intTotal = null)
    {
        $this->intTotal = $intTotal;
        return $this;
    }
    
    /**
     * Metodo responsavel em executar o totalizador de registros (sem a paginacao). 
     */
    public function count()
    {
        return $this->setTotal($this->getPaginator()->count());
    }

    /**
     * Metodo responsavel em retornar os registros formatados para a Grid, apos a
     * paginacao ser realizada.
     * 
     * @return array
     */
    public function getRegisterToGrid()
    {
        return (array) $this->arrRegisterToGrid;
    }

    /**
     * Metodo responsavel em converter os registros para a formatacao exigida pela
     * Grid, apos a paginacao ser realizada.
     * 
     * @param mix $mixMethodCol
     * @param mix $mixMethodPk
     * @return array
     */
    public function convertRegisterToGrid($mixMethodCol = null, $mixMethodPk = null)
    {
        return $this->arrRegisterToGrid = (new GridHelper())->convertRegisterToGrid($this->getRegister(), $mixMethodCol, $mixMethodPk);
    }

    /**
     * Metodo responsavel em parametrizar todas as informacoes necessarias e realizar
     * a paginacao, com atribuicao do resultado nos atributos da classe.
     * 
     * @param mix $queryArray
     * @return void
     */
    private function paginate($queryArray = null)
    {
        $zendPaginator = new ZendPaginator($this->getTypeAdapter($queryArray));
        $zendPaginator->setCurrentPageNumber($this->intPage);
        $zendPaginator->setDefaultItemCountPerPage($this->intItemPerPage);
        $this->zendPaginator = $zendPaginator;
        $this->registerArray($zendPaginator);
    }

    /**
     * Metodo responsavel em popular os registros com o resultado da paginacao.
     * 
     * @param object $zendPaginator
     * @return void
     */
    private function registerArray($zendPaginator = null)
    {
        $arrRegister = array();
//        $zendPaginator->getIterator();
        if (!empty($zendPaginator))
            foreach ($zendPaginator as $mixRegister)
                $arrRegister[] = $mixRegister;
        $this->arrRegister = $arrRegister;
    }

    /**
     * Metodo responsavel em verificar qual o tipo de Adapter a ser utilizado nas
     * operacoes relacionadas a paginacao.
     * 
     * @param mix $queryArray
     * @return object
     */
    private function getTypeAdapter($queryArray = null)
    {
        if (is_array($queryArray))
            return (new ArrayAdapter($queryArray));
        switch (get_class($queryArray)) {
            case 'Doctrine\ORM\NativeQuery':
                return (new Adapter\NativeQueryPaginator($queryArray));
            case 'Doctrine\DBAL\Statement':
                return (new Adapter\StatementPaginator($queryArray));
            default:
                return (new DoctrineAdapter(new ORMPaginator($queryArray, false)));
        }
    }

}
