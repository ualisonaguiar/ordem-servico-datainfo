<?php

namespace InepZend\Module\UnitTest\Controller;

use InepZend\Controller\AbstractCrudController;
use InepZend\Module\UnitTest\Controller\ControllerTrait;

class IndexController extends AbstractCrudController
{

    use ControllerTrait;

    /**
     * Atributo para testes que utilizam referencia, pois NAO esta mapeado no
     * __construct().
     */
    protected $strAtributteTest = 'test';

    const CO_CATEGORIA = 6;
    const CO_SUBCATEGORIA = 6;
    const CO_SUBCATEGORIA_TESTE = 999;

    public function __construct()
    {
        parent::__construct();
        /**
         * Atributos para testes que utilizam referencia no qual ja estejam
         * referenciados no __contruct().
         */
        $this->strService = 'InepZend\Module\UnitTest\Service\Subcategoria';
        $this->strEntity = '\InepZend\Module\UnitTest\Entity\Subcategoria';
        $this->strForm = 'InepZend\Module\UnitTest\Form\SubcategoriaForm';
        $this->arrPk = array('co_subcategoria');
        $this->arrMethodPk = array('getCoSubcategoria');
        $this->strRoute = 'unittest_controller';
    }

    private function dataSubcategoriaToArray($intCoSubCategoria = self::CO_SUBCATEGORIA, $booArray = false, $booReference = false)
    {
        $subcategoria = (new $this->strEntity())
                ->setCategoria(self::CO_CATEGORIA)
                ->setNoSubcategoria('UnitTest')
                ->setCoSubcategoria($intCoSubCategoria);
        if (!$booArray)
            return $subcategoria;
        else {
            if ($booReference)
                $arrSubCategoria['categoria'] = $this->getReferenceEntity(array('co_categoria' => self::CO_CATEGORIA), 'InepZend\Module\UnitTest\Entity\Categoria');
            return $subcategoria->toArray();
        }
    }

    private function dataFormPopulate($intCoSubCategoria = self::CO_SUBCATEGORIA)
    {
        $arrData = $this->dataSubcategoriaToArray($intCoSubCategoria, true);
        $form = $this->getService($this->strForm);
        $form->prepareElementsFilter();
        $form->setData($arrData);
        return $form;
    }

}
