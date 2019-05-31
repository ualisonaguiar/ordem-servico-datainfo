<?php
namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class ProjetoSpecificTest extends AbstractRestCorpTest
{
    const CO_PROJETO_CORRETO = 1510401;
    const CO_PROJETO_INCORRETO = 15;
    const CO_EVENTO_CORRETO = 20;
    const CO_EVENTO_INCORRETO = 20000;

    public function testProjeto1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->projetoEvento(self::CO_PROJETO_CORRETO, self::CO_EVENTO_CORRETO));
    }

    public function testProjeto2()
    {
        $this->assertObjectHasAttribute('idProjetoEvento', self::getInstanceOf()->projetoEvento(self::CO_PROJETO_CORRETO, self::CO_EVENTO_CORRETO));
    }

    public function testProjeto3()
    {
        $this->assertEmpty(self::getInstanceOf()->projetoEvento(self::CO_PROJETO_INCORRETO, self::CO_EVENTO_CORRETO));
    }

    public function testProjeto4()
    {
        $this->assertEmpty(self::getInstanceOf()->projetoEvento(self::CO_PROJETO_CORRETO, self::CO_EVENTO_INCORRETO));
    }

    public function testProjeto5()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->projetoEvento(self::CO_PROJETO_CORRETO));
    }

    public function testProjeto6()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->projetoEvento(null, self::CO_EVENTO_INCORRETO));
    }

}