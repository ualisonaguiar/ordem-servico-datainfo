<?php

namespace InepZend\Util;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Util\Rtf;

class RtfSpecificTest extends AbstractUnitTest
{

    public static $strContentFile = '﻿<%NOMEFRAMEWORK%>
Framework usado nas aplicações do Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira.
﻿<%NOMEFRAMEWORK%>, utiliza o framework Zend 2.

	Aplicações que utilizam:
	<%NOMESISTEMA%>';

    /**
     * @test
     */
    public function replaceRegexTagRtf()
    {
        $this->assertContains('InepZend', Rtf::replaceRegexTagRtf('<%NOMEFRAMEWORK%>', 'InepZend', self::$strContentFile));
    }

    /**
     * @test
     */
    public function replaceRegexTagRtf2()
    {
        $this->assertContains('Premio Inovacao', Rtf::replaceRegexTagRtf('<%NOMESISTEMA%>', 'Premio Inovacao', self::$strContentFile));
    }

    /**
     * @test
     */
    public function clearTagRtf()
    {
        $this->assertNotContains('\t', Rtf::clearTagRtf(self::$strContentFile));
    }

    /**
     * @test
     */
    public function removeTagRtf()
    {
        $this->assertNotContains("\n", Rtf::removeTagRtf(self::$strContentFile));
    }

    /**
     * @test
     */
    public function removeTagRtf2()
    {
        $this->assertNotContains("\t", Rtf::removeTagRtf(self::$strContentFile));
    }

    /**
     * @test
     */
    public function removeTagRtf3()
    {
        $this->assertNotContains('<$', Rtf::removeTagRtf(self::$strContentFile), '<$', '$>');
    }

    /**
     * @test
     */
    public function removeTagRtf4()
    {
        $this->assertNotContains("\n", Rtf::removeTagRtf(self::$strContentFile));
    }

}
