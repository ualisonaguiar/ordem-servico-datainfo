<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class PessoaSpecificTest extends AbstractRestCorpTest
{

    const CO_PESSOA = 100;
    const STR_CPF = '94865353615';
    const CO_MUNICIPIO = 5300108;

    public function testPessoaFisica1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->pessoaFisica(self::CO_PESSOA));
    }

    public function testPessoaFisica2()
    {
        $this->assertObjectHasAttribute('cpf', self::getInstanceOf()->pessoaFisica(self::CO_PESSOA));
    }

    public function testPessoaFisicaCpf1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->pessoaFisicaCpf(self::STR_CPF));
    }

    public function testPessoaFisicaCpf2()
    {
        $this->assertObjectHasAttribute('cpf', self::getInstanceOf()->pessoaFisicaCpf(self::STR_CPF));
    }

    public function testPessoaFisicaMunicipio1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->pessoaFisicaMunicipio(self::CO_MUNICIPIO));
    }

    public function testPessoaFisicaMunicipio2()
    {
        $this->assertObjectHasAttribute('pessoas', self::getInstanceOf()->pessoaFisicaMunicipio(self::CO_MUNICIPIO));
    }

    public function testPessoaFisicaReceitaCpf1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->pessoaFisicaReceitaCpf(self::STR_CPF));
    }

//     public function testPessoaFisicaReceitaCpf2()
//     {
//         $this->assertObjectHasAttribute('cpf', self::getInstanceOf()->pessoaFisicaReceitaCpf(self::STR_CPF));
//     }

}
