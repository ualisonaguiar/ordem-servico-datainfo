<?php
namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class OrgaoEmissorSpecificTest extends AbstractRestCorpTest
{
    public function testOrgaoEmissor1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->orgaoEmissor());
    }

    public function testOrgaoEmissor2()
    {
        $this->assertObjectHasAttribute('listaOrgaoEmissor', self::getInstanceOf()->orgaoEmissor());
    }

    public function testOrgaoEmissorWithoutCache1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->orgaoEmissorWithoutCache());
    }

    public function testOrgaoEmissorWithoutCache2()
    {
        $this->assertObjectHasAttribute('listaOrgaoEmissor', self::getInstanceOf()->orgaoEmissorWithoutCache());
    }

}