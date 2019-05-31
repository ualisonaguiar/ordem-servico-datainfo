<?php

namespace InepZend\Util;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Util\String;

class StringSpecificTest extends AbstractUnitTest
{

    /**
     * Generated from @assert ('INSTITUTO NACIONAL DE ESTUDOS E PESQUISAS EDUCACIONAIS ANÍSIO TEIXEIRA') === 'Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira'.
     *
     * @covers \InepZend\Util\String::beautifulProperName
     */
    public function testBeautifulProperName()
    {
        $this->assertSame(
                $this->convertEncoding('Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira')
                , \InepZend\Util\String::beautifulProperName($this->convertEncoding('INSTITUTO NACIONAL DE ESTUDOS E PESQUISAS EDUCACIONAIS ANÍSIO TEIXEIRA'))
        );
    }

    /**
     * Generated from @assert ('instituto nacional de estudos e pesquisas educacionais anísio teixeira') === 'Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira'.
     *
     * @covers \InepZend\Util\String::beautifulProperName
     */
    public function testBeautifulProperName2()
    {
        $this->assertSame(
                $this->convertEncoding('Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira')
                , \InepZend\Util\String::beautifulProperName($this->convertEncoding('instituto nacional de estudos e pesquisas educacionais anísio teixeira'))
        );
    }

    /**
     * Generated from @assert ('instituto nacional de estudos e pesquisas educacionais anísio teixeira', true) === 'Instituto Nacional'.
     *
     * @covers \InepZend\Util\String::beautifulProperName
     */
    public function testBeautifulProperName3()
    {
        $this->assertSame(
                'Instituto Nacional'
                , \InepZend\Util\String::beautifulProperName('instituto nacional de estudos e pesquisas educacionais anísio teixeira', true)
        );
    }

    /**
     * Generated from @assert ('estudos de pesquisas educacionais anísio teixeira', true) === 'Estudos de Pesquisas'.
     *
     * @covers \InepZend\Util\String::beautifulProperName
     */
    public function testBeautifulProperName4()
    {
        $this->assertSame(
                'Estudos de Pesquisas'
                , \InepZend\Util\String::beautifulProperName('estudos de pesquisas educacionais anísio teixeira', true)
        );
    }

    /**
     * Generated from @assert ('Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira') === 'Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira'.
     *
     * @covers \InepZend\Util\String::beautifulProperName
     */
    public function testBeautifulProperName5()
    {
        $this->assertSame(
                $this->convertEncoding('Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira')
                , \InepZend\Util\String::beautifulProperName($this->convertEncoding('Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira'))
        );
    }

    /**
     * Generated from @assert ('Estudos de Pesquisas', true) === 'Estudos de Pesquisas'.
     *
     * @covers \InepZend\Util\String::beautifulProperName
     */
    public function testBeautifulProperName6()
    {
        $this->assertSame(
                'Estudos de Pesquisas'
                , \InepZend\Util\String::beautifulProperName('Estudos de Pesquisas', true)
        );
    }

    /**
     * Generated from @assert ('instituto nacional de estudos e pesquisas educacionais anisio teixeira') === 'Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira'.
     *
     * @covers \InepZend\Util\String::maskName
     */
    public function testMaskName()
    {
        $this->assertSame(
                'Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira'
                , \InepZend\Util\String::maskName('instituto nacional de estudos e pesquisas educacionais anisio teixeira')
        );
    }

    /**
     * Generated from @assert ('josé da silva') === 'José da Silva'.
     *
     * @covers \InepZend\Util\String::maskName
     */
    public function testMaskName2()
    {
        $this->assertSame(
                $this->convertEncoding('José da Silva')
                , \InepZend\Util\String::maskName($this->convertEncoding('josé da silva'))
        );
    }

    /**
     * Generated from @assert ('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira') === 'Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira'.
     *
     * @covers \InepZend\Util\String::maskName
     */
    public function testMaskName3()
    {
        $this->assertSame(
                'Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira'
                , \InepZend\Util\String::maskName('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira')
        );
    }

    /**
     * Generated from @assert ('José da Silva') === 'José da Silva'.
     *
     * @covers \InepZend\Util\String::maskName
     */
    public function testMaskName4()
    {
        $this->assertSame(
                $this->convertEncoding('José da Silva')
                , \InepZend\Util\String::maskName($this->convertEncoding('José da Silva'))
        );
    }

    /**
     * @covers String::generateRandomExpression
     */
    public function testGenerateRandomExpression()
    {
        $this->assertSame(7, strlen(String::generateRandomExpression(7)));
    }

    /**
     * @covers String::generateRandomExpression
     */
    public function testGenerateRandomExpression1()
    {
        $this->assertSame(15, strlen(String::generateRandomExpression(15)));
    }

    /**
     * @covers String::generateRandomExpression
     */
    public function testGenerateRandomExpression2()
    {
        $this->assertSame(36, strlen(String::generateRandomExpression(36)));
    }

    /**
     * @covers String::generateRandomExpression
     */
    public function testGenerateRandomExpression3()
    {
        $this->assertSame(40, strlen(String::generateRandomExpression(40)));
    }

    /**
     * @covers String::generateRandomExpression
     */
    public function testGenerateRandomExpression4()
    {
        $this->assertSame(1, preg_match('/[A-Za-z0-9]/', String::generateRandomExpression(9)));
    }

    /**
     * @covers String::generateRandomExpression
     */
    public function testGenerateRandomExpression5()
    {
        $this->assertSame(7, strlen(String::generateRandomExpression(7, false)));
    }

    /**
     * @covers String::generateRandomExpression
     */
    public function testGenerateRandomExpression6()
    {
        $this->assertSame(15, strlen(String::generateRandomExpression(15, false)));
    }

    /**
     * @covers String::generateRandomExpression
     */
    public function testGenerateRandomExpression7()
    {
        $this->assertSame(36, strlen(String::generateRandomExpression(36, false)));
    }

    /**
     * @covers String::generateRandomExpression
     */
    public function testGenerateRandomExpression8()
    {
        $this->assertSame(40, strlen(String::generateRandomExpression(40, false)));
    }

    /**
     * @covers String::generateRandomExpression
     */
    public function testGenerateRandomExpression9()
    {
        $this->assertSame(1, preg_match('/[A-Za-z0-9]/', String::generateRandomExpression(9, false)));
    }

    /**
     * @covers String::getBase64Decode
     * @dataProvider getDataSuperGlobalGet
     */
    public function testGetBase64Decode($strValue)
    {
        $_GET[md5($strValue)] = 'null';
        $this->assertSame(null, String::getBase64Decode($strValue));
    }

    /**
     * @covers String::getBase64Decode
     * @dataProvider getDataSuperGlobalGet
     */
    public function testGetBase64Decode1($strValue)
    {
        $_GET[md5($strValue)] = $strValue;
        $_GET[$strValue] = $strValue;
        $this->assertSame(base64_decode($strValue), String::getBase64Decode($strValue));
    }

    /**
     * Metodo responsavel pelos dados
     *
     * @return array
     */
    public function getDataSuperGlobalGet()
    {
        $arrDataSuperGlobal = array();
        $strValue = 'Test_Component_Util';
        for ($intCount = 0; $intCount < 11; ++$intCount)
            $arrDataSuperGlobal[] = array($strValue . $intCount, $strValue . $intCount);
        return $arrDataSuperGlobal;
    }

}
