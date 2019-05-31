<?php

namespace InepZend\Paginator;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Paginator\Paginator;
use InepZend\Util\Reflection;
use Doctrine\ORM\Query\ResultSetMapping;

class PaginatorSpecificTest extends AbstractUnitTest
{

    const CO_SUBCATEGORIA = 6;
    const ARRAY_ADAPTER = 'ArrayAdapter';
    const DOCTRINE_ORM_DEFAULT = 'Doctrine\ORM\Query';
    const DOCTRINE_ORM_NATIVEQUERY = 'Doctrine\ORM\NativeQuery';
    const DOCTRINE_DBAL_STATEMENT = 'Doctrine\DBAL\Statement';
    const SERVICE = 'Publicacao\Service\Subcategoria';

    protected function setUp()
    {
        parent::setUp();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('InepZend\Paginator\Paginator', self::getInstanceTypeOrm());
    }

    public function testGetRegister()
    {
        $this->assertInternalType('array', self::getInstanceTypeOrm()->getRegister());
    }

    public function testGetZendPaginator()
    {
        $this->assertInstanceOf('Zend\Paginator\Paginator', self::getInstanceTypeOrm()->getZendPaginator());
    }

    public function testGetRegisterToGrid()
    {
        $this->assertInternalType('array', self::getInstanceTypeOrm()->getRegisterToGrid());
    }

    public function testConvertRegisterToGrid()
    {
        $this->assertInternalType('array', self::getInstanceTypeOrm(self::ARRAY_ADAPTER)->convertRegisterToGrid(array(0 => 'getNuPublicacao'), array(0 => 'getIdPublicacao')));
    }

    public function testPaginate()
    {
        # O metodo deve retornar null, pois sua chamada deve ser via __construct().
        $this->assertNull(Reflection::invokeNotAccessibleMethod(self::getInstanceTypeOrm(), 'paginate', $this->getInstanceForTestOrm(self::ARRAY_ADAPTER)));
    }

    public function testRegisterArray()
    {
        $paginator = self::getInstanceTypeOrm();
        $this->assertNull(Reflection::invokeNotAccessibleMethod($paginator, 'registerArray', $paginator->getZendPaginator()));
    }

    public function testGetTypeAdapter()
    {
        $this->assertInstanceOf('Zend\Paginator\Adapter\ArrayAdapter', Reflection::invokeNotAccessibleMethod(self::getInstanceTypeOrm(), 'getTypeAdapter', $this->getInstanceForTestOrm(self::ARRAY_ADAPTER)));
    }

    public function testGetTypeAdapter2()
    {
        $this->assertInstanceOf('DoctrineORMModule\Paginator\Adapter\DoctrinePaginator', Reflection::invokeNotAccessibleMethod(self::getInstanceTypeOrm(), 'getTypeAdapter', $this->getInstanceForTestOrm(self::DOCTRINE_ORM_DEFAULT)));
    }

    public function testGetTypeAdapter3()
    {
        $this->assertInstanceOf('InepZend\Paginator\Adapter\NativeQueryPaginator', Reflection::invokeNotAccessibleMethod(self::getInstanceTypeOrm(), 'getTypeAdapter', $this->getInstanceForTestOrm(self::DOCTRINE_ORM_NATIVEQUERY)));
    }

    public function testGetTypeAdapter4()
    {
        $this->assertInstanceOf('InepZend\Paginator\Adapter\StatementPaginator', Reflection::invokeNotAccessibleMethod(self::getInstanceTypeOrm(), 'getTypeAdapter', $this->getInstanceForTestOrm(self::DOCTRINE_DBAL_STATEMENT)));
    }

//    public function testRegisterToGrid()
//    {
//        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceTypeOrm(), 'registerToGrid', self::getInstanceTypeOrm()->getRegister(), array(0 => 'getNuPublicacao'), array(0 => 'getIdPublicacao')));
//    }
//
//    public function testGetValueCol()
//    {
//        $this->assertInternalType('integer', Reflection::invokeNotAccessibleMethod(self::getInstanceTypeOrm(), 'getValueCol', self::getInstanceTypeOrm()->getRegister()[0], 'getCoSubcategoria', 1));
//    }
//
//    public function testResultTypeToGrid()
//    {
//        # O metodo deve retornar null, pois sua chamada exige parametro referenciado.
//        $this->assertNull(Reflection::invokeNotAccessibleMethod(self::getInstanceTypeOrm(), 'resultTypeToGrid', 'text', null, array('id' => 'paginatorText[0]', 'name' => 'paginatorText[0]', 'class' => 'paginatorText'), self::getInstanceTypeOrm()->getRegister()[0]));
//    }
//
//    public function testGetPathFromValueColType()
//    {
//        # Nao foi implementado o teste por se tratar de arquivo.
//        return true;
//    }

    private function getInstanceTypeOrm($instanceOf = null)
    {
        if (is_null($instanceOf)) {
            if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof Paginator))
                self::setInstanceOf(new Paginator($this->getInstanceForTestOrm(self::ARRAY_ADAPTER)));
        } else
            self::setInstanceOf(new Paginator($this->getInstanceForTestOrm($instanceOf)));
        return parent::getInstanceOf();
    }

    private function getInstanceForTestOrm($strType)
    {
        if ($strType == 'Doctrine\ORM\Query')
            return $this->getService(self::SERVICE)->getEntityManager()->createQuery('select subcategoria from InepZend\Module\UnitTest\Entity\Subcategoria subcategoria where subcategoria = ?1')->setParameter(1, 5);
        if ($strType == 'ArrayAdapter')
            return $this->getService(self::SERVICE)->findBy(array('co_subcategoria' => self::CO_SUBCATEGORIA));
        if ($strType == 'Doctrine\ORM\NativeQuery')
            return $this->getService(self::SERVICE)->getEntityManager()->createNativeQuery('SELECT * FROM INEPSKELETON.TB_SUBCATEGORIA', (new ResultSetMapping()));
        if ($strType == 'Doctrine\DBAL\Statement') {
            $stmt = $this->getService(self::SERVICE)->getEntityManager()->getConnection()->prepare('SELECT * FROM INEPSKELETON.TB_SUBCATEGORIA WHERE CO_SUBCATEGORIA = ?');
            $stmt->bindValue(1, 'CO_SUBCATEGORIA');
            return $stmt;
        }
    }

}
