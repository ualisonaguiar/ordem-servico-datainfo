<?php

namespace InepZend\Module\UnitTest;

use InepZend\ModuleConfig\ModuleConfig;
use InepZend\Module\UnitTest\Service\Index;
use InepZend\Module\UnitTest\Service\IndexCache;
use InepZend\Module\UnitTest\Service\IndexCore;
use InepZend\Module\UnitTest\Service\IndexFile;
use InepZend\Module\UnitTest\Service\Categoria;
use InepZend\Module\UnitTest\Service\CategoriaFile;
use InepZend\Module\UnitTest\Service\Subcategoria;
use InepZend\Module\UnitTest\Service\SubcategoriaFile;
use InepZend\Module\UnitTest\Form\SubcategoriaForm;

class Module extends ModuleConfig
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InepZend\Module\UnitTest\Service\Index' => function($serviceManager) {
                    return new Index($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\UnitTest\Service\IndexCache' => function($serviceManager) {
                    return new IndexCache($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\UnitTest\Service\IndexCore' => function() {
                    return new IndexCore();
                },
                'InepZend\Module\UnitTest\Service\IndexFile' => function($serviceManager) {
                    return new IndexFile($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\UnitTest\Service\Categoria' => function($serviceManager) {
                    return new Categoria($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\UnitTest\Service\CategoriaFile' => function() {
                    return new CategoriaFile();
                },
                'InepZend\Module\UnitTest\Service\Subcategoria' => function($serviceManager) {
                    return new Subcategoria($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\UnitTest\Service\SubcategoriaFile' => function() {
                    return new SubcategoriaFile();
                },
                'InepZend\Module\UnitTest\Form\SubcategoriaForm' => function($serviceManager) {
                    return new SubcategoriaForm(null, $serviceManager);
                },
            )
        );
    }

}
