<?php
namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class SqiSpecificTest extends AbstractRestCorpTest
{
    const C0_QUESTIONARIO_CORRETO = 15;
    const C0_QUESTIONARIO_INCORRETO = 1;
    const C0_PROJETO_CORRETO = 1510701;
    const C0_PROJETO_INCORRETO = 15;

    public function testSituacoes1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->situacoes());
    }

    public function testSituacoes2()
    {
        $this->assertObjectHasAttribute('listaSituacoes', self::getInstanceOf()->situacoes());
    }

    public function testQuestionariosProjeto1()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->questionariosProjeto());
    }

    public function testQuestionariosProjeto2()
    {
        $this->assertNotEmpty(self::getInstanceOf()->questionariosProjeto(self::C0_QUESTIONARIO_CORRETO, self::C0_PROJETO_CORRETO));
    }

    public function testQuestionariosProjeto3()
    {
        $this->assertObjectHasAttribute('grupos', self::getInstanceOf()->questionariosProjeto(self::C0_QUESTIONARIO_CORRETO, self::C0_PROJETO_CORRETO));
    }

    public function testQuestionariosProjeto4()
    {
        $this->assertEmpty(self::getInstanceOf()->questionariosProjeto(self::C0_QUESTIONARIO_INCORRETO, self::C0_PROJETO_CORRETO));
    }

    public function testQuestionariosProjeto5()
    {
        $this->assertEmpty(self::getInstanceOf()->questionariosProjeto(self::C0_QUESTIONARIO_CORRETO, self::C0_PROJETO_INCORRETO));
    }

    public function testQuestionariosProjeto6()
    {
        $this->assertEmpty(self::getInstanceOf()->questionariosProjeto(self::C0_QUESTIONARIO_INCORRETO, self::C0_PROJETO_INCORRETO));
    }

    public function testQuestionariosProjeto7()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->questionariosProjeto(self::C0_QUESTIONARIO_CORRETO));
    }

    public function testQuestionariosProjeto8()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->questionariosProjeto(null, self::C0_PROJETO_CORRETO));
    }

}