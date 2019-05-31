<?php

namespace InepZend\Module\UnitTest\Service;

use InepZend\Service\AbstractServiceControlCache;

class Index extends AbstractServiceControlCache
{

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, (($strService == null) ? __CLASS__ : $strService));
        $this->arrPk = array('co_subcategoria');
        $this->strEntity = 'InepZend\Module\UnitTest\Entity\Subcategoria';
    }

    /**
     * Metodo utilizado na classe de teste \InepZend\Module\UnitTest\Service\IndexControlCacheTest.php.
     * O mesmo esta sendo chamado no metodo testControlCache().
     * 
     * @param interger $intCoSubcategoria
     * @return mix
     */
    public function findBySubcategoriaCache($intCoSubcategoria = null)
    {
        return $this->controlCache(__FUNCTION__ . 'FromDb', func_get_args());
    }

    /**
     * Metodo utilizado na classe de teste \InepZend\Module\UnitTest\Service\IndexControlCacheTest.php.
     * O mesmo esta sendo chamado no metodo testClearCacheAfterExec().
     * 
     * @param interger $intCoSubcategoria
     * @return mix
     */
    public function findBySubcategoriaCacheExec($intCoSubcategoria = null)
    {
        return $this->clearCacheAfterExec(__FUNCTION__ . 'FromDb', func_get_args());
    }

    /**
     * Metodo utilizado para ser cacheado e ser chamado pelo metodo acima, 
     * findBySubcategoriaCache.
     * 
     * @param interger $intCoSubcategoria
     * @return type
     */
    public function findBySubcategoriaFromDbCache($intCoSubcategoria = null)
    {
        return $this->findBy(array('co_subcategoria' => $intCoSubcategoria));
    }

    /**
     * Metodo utilizado na classe de teste \InepZend\Module\UnitTest\Service\IndexControlCacheTest.php.
     * A utilizacao do metodo e seu cacheamento eh via ANNOTATION. (cache true).
     * A sua chamada pode ser pelo metodo __call da classe 
     * \InepZend\Service\AbstractServiceControlCache.php.
     * O mesmo esta sendo chamado no metodo testCall().
     * 
     * @cache true
     */
    protected function findBySubcategoriaAnnotationCache($intCoSubcategoria = null)
    {
        return $this->findBy(array('co_subcategoria' => $intCoSubcategoria));
    }

}
