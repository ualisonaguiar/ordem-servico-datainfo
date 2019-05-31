<?php

namespace InepZend\Util;

use InepZend\UnitTest\AbstractUnitTest;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2014-08-01 at 16:31:25.
 */
class StringTest extends AbstractUnitTest
{

    /**
     * Generated from @assert ('Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira') === true.
     *
     * @covers \InepZend\Util\String::isUTF8
     */
    public function testIsUTF8()
    {
        $this->assertSame(
                true
                , \InepZend\Util\String::isUTF8('Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira')
        );
    }

    /**
     * Generated from @assert ('Ministério da Educação - Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira') === 'Ministerio da Educacao - Instituto Nacional de Estudos E Pesquisas Educacionais Anisio Teixeira'.
     *
     * @covers \InepZend\Util\String::clearWord
     */
    public function testClearWord()
    {
        $this->assertSame(
                'Ministerio da Educacao - Instituto Nacional de Estudos E Pesquisas Educacionais Anisio Teixeira'
                , \InepZend\Util\String::clearWord('Ministério da Educação - Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira')
        );
    }

    /**
     * Generated from @assert ('Ministério da Educação - Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira', true) === 'Minist%rio da Educa%%o - Instituto Nacional de Estudos E Pesquisas Educacionais An%sio Teixeira'.
     *
     * @covers \InepZend\Util\String::clearWord
     */
    public function testClearWord2()
    {
        $this->assertSame(
                'Minist%rio da Educa%%o - Instituto Nacional de Estudos E Pesquisas Educacionais An%sio Teixeira'
                , \InepZend\Util\String::clearWord('Ministério da Educação - Instituto Nacional de Estudos E Pesquisas Educacionais Anísio Teixeira', true)
        );
    }

    /**
     * Generated from @assert ('Ministerio da Educacao - Instituto Nacional de Estudos E Pesquisas Educacionais Anisio Teixeira') === 'Ministerio da Educacao - Instituto Nacional de Estudos E Pesquisas Educacionais Anisio Teixeira'.
     *
     * @covers \InepZend\Util\String::clearWord
     */
    public function testClearWord3()
    {
        $this->assertSame(
                'Ministerio da Educacao - Instituto Nacional de Estudos E Pesquisas Educacionais Anisio Teixeira'
                , \InepZend\Util\String::clearWord('Ministerio da Educacao - Instituto Nacional de Estudos E Pesquisas Educacionais Anisio Teixeira')
        );
    }

    /**
     * Generated from @assert ('Minist%rio da Educa%%o - Instituto Nacional de Estudos E Pesquisas Educacionais An%sio Teixeira', true) === 'Minist%rio da Educa%%o - Instituto Nacional de Estudos E Pesquisas Educacionais An%sio Teixeira'.
     *
     * @covers \InepZend\Util\String::clearWord
     */
    public function testClearWord4()
    {
        $this->assertSame(
                'Minist%rio da Educa%%o - Instituto Nacional de Estudos E Pesquisas Educacionais An%sio Teixeira'
                , \InepZend\Util\String::clearWord('Minist%rio da Educa%%o - Instituto Nacional de Estudos E Pesquisas Educacionais An%sio Teixeira', true)
        );
    }

    /**
     * Generated from @assert ('INEP') == 'czo0OiJJTkVQIjs='.
     *
     * @covers \InepZend\Util\String::serialize64
     */
    public function testSerialize64()
    {
        $this->assertEquals(
                'czo0OiJJTkVQIjs='
                , \InepZend\Util\String::serialize64('INEP')
        );
    }

    /**
     * Generated from @assert ('Instituto Nacional de Estudos E Pesquisas Educacionais Anisio Teixeira') === 'czo3MDoiSW5zdGl0dXRvIE5hY2lvbmFsIGRlIEVzdHVkb3MgRSBQZXNxdWlzYXMgRWR1Y2FjaW9uYWlzIEFuaXNpbyBUZWl4ZWlyYSI7'.
     *
     * @covers \InepZend\Util\String::serialize64
     */
    public function testSerialize642()
    {
        $this->assertSame(
                'czo3MDoiSW5zdGl0dXRvIE5hY2lvbmFsIGRlIEVzdHVkb3MgRSBQZXNxdWlzYXMgRWR1Y2FjaW9uYWlzIEFuaXNpbyBUZWl4ZWlyYSI7'
                , \InepZend\Util\String::serialize64('Instituto Nacional de Estudos E Pesquisas Educacionais Anisio Teixeira')
        );
    }

    /**
     * Generated from @assert ('Ministério da Educação') === 'czoyNToiTWluaXN0w6lyaW8gZGEgRWR1Y2HDp8OjbyI7'.
     *
     * @covers \InepZend\Util\String::serialize64
     */
    public function testSerialize643()
    {
        $this->assertSame(
                'czoyNToiTWluaXN0w6lyaW8gZGEgRWR1Y2HDp8OjbyI7'
                , \InepZend\Util\String::serialize64('Ministério da Educação')
        );
    }

    /**
     * Generated from @assert ('czo0OiJJTkVQIjs') === 'czoxNToiY3pvME9pSkpUa1ZRSWpzIjs='.
     *
     * @covers \InepZend\Util\String::serialize64
     */
    public function testSerialize644()
    {
        $this->assertSame(
                'czoxNToiY3pvME9pSkpUa1ZRSWpzIjs='
                , \InepZend\Util\String::serialize64('czo0OiJJTkVQIjs')
        );
    }

    /**
     * Generated from @assert ('czo3MDoiSW5zdGl0dXRvIE5hY2lvbmFsIGRlIEVzdHVkb3MgRSBQZXNxdWlzYXMgRWR1Y2FjaW9uYWlzIEFuaXNpbyBUZWl4ZWlyYSI7') === 'czoxMDQ6ImN6bzNNRG9pU1c1emRHbDBkWFJ2SUU1aFkybHZibUZzSUdSbElFVnpkSFZrYjNNZ1JTQlFaWE54ZFdsellYTWdSV1IxWTJGamFXOXVZV2x6SUVGdWFYTnBieUJVWldsNFpXbHlZU0k3Ijs='.
     *
     * @covers \InepZend\Util\String::serialize64
     */
    public function testSerialize645()
    {
        $this->assertSame(
                'czoxMDQ6ImN6bzNNRG9pU1c1emRHbDBkWFJ2SUU1aFkybHZibUZzSUdSbElFVnpkSFZrYjNNZ1JTQlFaWE54ZFdsellYTWdSV1IxWTJGamFXOXVZV2x6SUVGdWFYTnBieUJVWldsNFpXbHlZU0k3Ijs='
                , \InepZend\Util\String::serialize64('czo3MDoiSW5zdGl0dXRvIE5hY2lvbmFsIGRlIEVzdHVkb3MgRSBQZXNxdWlzYXMgRWR1Y2FjaW9uYWlzIEFuaXNpbyBUZWl4ZWlyYSI7')
        );
    }

    /**
     * Generated from @assert ('czo0OiJJTkVQIjs') === 'INEP'.
     *
     * @covers \InepZend\Util\String::unserialize64
     */
    public function testUnserialize64()
    {
        $this->assertSame(
                'INEP'
                , \InepZend\Util\String::unserialize64('czo0OiJJTkVQIjs')
        );
    }

    /**
     * Generated from @assert ('czo3MDoiSW5zdGl0dXRvIE5hY2lvbmFsIGRlIEVzdHVkb3MgRSBQZXNxdWlzYXMgRWR1Y2FjaW9uYWlzIEFuaXNpbyBUZWl4ZWlyYSI7') == 'Instituto Nacional de Estudos E Pesquisas Educacionais Anisio Teixeira'.
     *
     * @covers \InepZend\Util\String::unserialize64
     */
    public function testUnserialize642()
    {
        $this->assertEquals(
                'Instituto Nacional de Estudos E Pesquisas Educacionais Anisio Teixeira'
                , \InepZend\Util\String::unserialize64('czo3MDoiSW5zdGl0dXRvIE5hY2lvbmFsIGRlIEVzdHVkb3MgRSBQZXNxdWlzYXMgRWR1Y2FjaW9uYWlzIEFuaXNpbyBUZWl4ZWlyYSI7')
        );
    }

    /**
     * Generated from @assert ('czoyNToiTWluaXN0w6lyaW8gZGEgRWR1Y2HDp8OjbyI7') === 'Ministério da Educação'.
     *
     * @covers \InepZend\Util\String::unserialize64
     */
    public function testUnserialize643()
    {
        $this->assertSame(
                'Ministério da Educação'
                , \InepZend\Util\String::unserialize64('czoyNToiTWluaXN0w6lyaW8gZGEgRWR1Y2HDp8OjbyI7')
        );
    }

    /**
     * Generated from @assert ('czoxNToiY3pvME9pSkpUa1ZRSWpzIjs==') === 'czo0OiJJTkVQIjs'.
     *
     * @covers \InepZend\Util\String::unserialize64
     */
    public function testUnserialize644()
    {
        $this->assertSame(
                'czo0OiJJTkVQIjs'
                , \InepZend\Util\String::unserialize64('czoxNToiY3pvME9pSkpUa1ZRSWpzIjs==')
        );
    }

    /**
     * Generated from @assert ('czoxMDQ6ImN6bzNNRG9pU1c1emRHbDBkWFJ2SUU1aFkybHZibUZzSUdSbElFVnpkSFZrYjNNZ1JTQlFaWE54ZFdsellYTWdSV1IxWTJGamFXOXVZV2x6SUVGdWFYTnBieUJVWldsNFpXbHlZU0k3Ijs=') === 'czo3MDoiSW5zdGl0dXRvIE5hY2lvbmFsIGRlIEVzdHVkb3MgRSBQZXNxdWlzYXMgRWR1Y2FjaW9uYWlzIEFuaXNpbyBUZWl4ZWlyYSI7'.
     *
     * @covers \InepZend\Util\String::unserialize64
     */
    public function testUnserialize645()
    {
        $this->assertSame(
                'czo3MDoiSW5zdGl0dXRvIE5hY2lvbmFsIGRlIEVzdHVkb3MgRSBQZXNxdWlzYXMgRWR1Y2FjaW9uYWlzIEFuaXNpbyBUZWl4ZWlyYSI7'
                , \InepZend\Util\String::unserialize64('czoxMDQ6ImN6bzNNRG9pU1c1emRHbDBkWFJ2SUU1aFkybHZibUZzSUdSbElFVnpkSFZrYjNNZ1JTQlFaWE54ZFdsellYTWdSV1IxWTJGamFXOXVZV2x6SUVGdWFYTnBieUJVWldsNFpXbHlZU0k3Ijs=')
        );
    }

    /**
     * Generated from @assert ('Ministerio da Educacao') === 'Ministerio da Educacao'.
     *
     * @covers \InepZend\Util\String::truncate
     */
    public function testTruncate()
    {
        $this->assertSame(
                'Ministerio da Educacao'
                , \InepZend\Util\String::truncate('Ministerio da Educacao')
        );
    }

    /**
     * Generated from @assert ('Ministerio da Educacao', 13) === 'Ministerio...'.
     *
     * @covers \InepZend\Util\String::truncate
     */
    public function testTruncate2()
    {
        $this->assertSame(
                'Ministerio...'
                , \InepZend\Util\String::truncate('Ministerio da Educacao', 13)
        );
    }

    /**
     * Generated from @assert ('Ministerio da Educacao', 13, '***') === 'Ministerio***'.
     *
     * @covers \InepZend\Util\String::truncate
     */
    public function testTruncate3()
    {
        $this->assertSame(
                'Ministerio***'
                , \InepZend\Util\String::truncate('Ministerio da Educacao', 13, '***')
        );
    }

    /**
     * Generated from @assert ('Ministerio da Educacao', 20, '***', true) === 'Ministerio da Edu***'.
     *
     * @covers \InepZend\Util\String::truncate
     */
    public function testTruncate4()
    {
        $this->assertSame(
                'Ministerio da Edu***'
                , \InepZend\Util\String::truncate('Ministerio da Educacao', 20, '***', true)
        );
    }

    /**
     * Generated from @assert ('Ministerio da Educacao', 20, '_._', true, true) === 'Minister_._Educacao'.
     *
     * @covers \InepZend\Util\String::truncate
     */
    public function testTruncate5()
    {
        $this->assertSame(
                'Minister_._Educacao'
                , \InepZend\Util\String::truncate('Ministerio da Educacao', 20, '_._', true, true)
        );
    }

    /**
     * Generated from @assert ('Ministerio da Educacao', 20, '_._', true, true, true) === 'Minister_._Educacao'.
     *
     * @covers \InepZend\Util\String::truncate
     */
    public function testTruncate6()
    {
        $this->assertSame(
                'Minister_._Educacao'
                , \InepZend\Util\String::truncate('Ministerio da Educacao', 20, '_._', true, true, true)
        );
    }

    /**
     * Generated from @assert ('<b>Ministério da Educação</b>', 20, '...', true, true, true) === '&lt;b&gt;Minis...&sect;&Atilde;&pound;o&lt;/b&gt;'.
     *
     * @covers \InepZend\Util\String::truncate
     */
    public function testTruncate7()
    {
        $this->assertSame(
                '&lt;b&gt;Minis...acao&lt;/b&gt;'
                , \InepZend\Util\String::truncate('<b>Ministerio da Educacao</b>', 20, '...', true, true, true)
        );
    }

    /**
     * Generated from @assert ('') === true.
     *
     * @covers \InepZend\Util\String::isNullEmpty
     */
    public function testIsNullEmpty()
    {
        $this->assertSame(
                true
                , \InepZend\Util\String::isNullEmpty('')
        );
    }

    /**
     * Generated from @assert (array()) === true.
     *
     * @covers \InepZend\Util\String::isNullEmpty
     */
    public function testIsNullEmpty2()
    {
        $this->assertSame(
                true
                , \InepZend\Util\String::isNullEmpty(array())
        );
    }

    /**
     * Generated from @assert ('INEP') !== true.
     *
     * @covers \InepZend\Util\String::isNullEmpty
     */
    public function testIsNullEmpty3()
    {
        $this->assertNotSame(
                true
                , \InepZend\Util\String::isNullEmpty('INEP')
        );
    }

    /**
     * Generated from @assert (array('MEC' => 'INEP')) !== true.
     *
     * @covers \InepZend\Util\String::isNullEmpty
     */
    public function testIsNullEmpty4()
    {
        $this->assertNotSame(
                true
                , \InepZend\Util\String::isNullEmpty(array('MEC' => 'INEP'))
        );
    }

    /**
     * Generated from @assert ('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira') === 'Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira'.
     *
     * @covers \InepZend\Util\String::cleanBreakline
     */
    public function testCleanBreakline()
    {
        $this->assertSame(
                'Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira'
                , \InepZend\Util\String::cleanBreakline('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira')
        );
    }

    /**
     * Generated from @assert ('"Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira"') === '\"Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira\"'.
     *
     * @covers \InepZend\Util\String::cleanBreakline
     */
    public function testCleanBreakline2()
    {
        $this->assertSame(
                '\"Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira\"'
                , \InepZend\Util\String::cleanBreakline('"Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira"')
        );
    }

    /**
     * Generated from @assert ('"Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira"', true, false) === '"Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira"'.
     *
     * @covers \InepZend\Util\String::cleanBreakline
     */
    public function testCleanBreakline3()
    {
        $this->assertSame(
                '"Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira"'
                , \InepZend\Util\String::cleanBreakline('"Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira"', true, false)
        );
    }

    /**
     * Generated from @assert ('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira') === 'I<br />n<br />s<br />t<br />i<br />t<br />u<br />t<br />o<br /> <br />N<br />a<br />c<br />i<br />o<br />n<br />a<br />l<br /> <br />d<br />e<br /> <br />E<br />s<br />t<br />u<br />d<br />o<br />s<br /> <br />e<br /> <br />P<br />e<br />s<br />q<br />u<br />i<br />s<br />a<br />s<br /> <br />E<br />d<br />u<br />c<br />a<br />c<br />i<br />o<br />n<br />a<br />i<br />s<br /> <br />A<br />n<br />i<br />s<br />i<br />o<br /> <br />T<br />e<br />i<br />x<br />e<br />i<br />r<br />a'.
     *
     * @covers \InepZend\Util\String::verticalText
     */
    public function testVerticalText()
    {
        $this->assertSame(
                'I<br />n<br />s<br />t<br />i<br />t<br />u<br />t<br />o<br /> <br />N<br />a<br />c<br />i<br />o<br />n<br />a<br />l<br /> <br />d<br />e<br /> <br />E<br />s<br />t<br />u<br />d<br />o<br />s<br /> <br />e<br /> <br />P<br />e<br />s<br />q<br />u<br />i<br />s<br />a<br />s<br /> <br />E<br />d<br />u<br />c<br />a<br />c<br />i<br />o<br />n<br />a<br />i<br />s<br /> <br />A<br />n<br />i<br />s<br />i<br />o<br /> <br />T<br />e<br />i<br />x<br />e<br />i<br />r<br />a'
                , \InepZend\Util\String::verticalText('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira')
        );
    }

    /**
     * Generated from @assert ('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira', '_') === 'I_n_s_t_i_t_u_t_o_ _N_a_c_i_o_n_a_l_ _d_e_ _E_s_t_u_d_o_s_ _e_ _P_e_s_q_u_i_s_a_s_ _E_d_u_c_a_c_i_o_n_a_i_s_ _A_n_i_s_i_o_ _T_e_i_x_e_i_r_a'.
     *
     * @covers \InepZend\Util\String::verticalText
     */
    public function testVerticalText2()
    {
        $this->assertSame(
                'I_n_s_t_i_t_u_t_o_ _N_a_c_i_o_n_a_l_ _d_e_ _E_s_t_u_d_o_s_ _e_ _P_e_s_q_u_i_s_a_s_ _E_d_u_c_a_c_i_o_n_a_i_s_ _A_n_i_s_i_o_ _T_e_i_x_e_i_r_a'
                , \InepZend\Util\String::verticalText('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira', '_')
        );
    }

    /**
     * Generated from @assert ('Ministerio da Educacao') !== 'Mi<br>n<br>i<br>s<br>t<br>e<br>r<br>i<br>o<br> <br>da<br> <br>E<br>d<br>u<br>c<br>a<br>c<br>a<br>o'.
     *
     * @covers \InepZend\Util\String::verticalText
     */
    public function testVerticalText3()
    {
        $this->assertNotSame(
                'Mi<br>n<br>i<br>s<br>t<br>e<br>r<br>i<br>o<br> <br>da<br> <br>E<br>d<br>u<br>c<br>a<br>c<br>a<br>o'
                , \InepZend\Util\String::verticalText('Ministerio da Educacao')
        );
    }

    /**
     * Generated from @assert ('Ministerio da Educacao', "\n") !== 'Mi n i s t e r i o d a E d u c a cao'.
     *
     * @covers \InepZend\Util\String::verticalText
     */
    public function testVerticalText4()
    {
        $this->assertNotSame(
                'Mi n i s t e r i o d a E d u c a cao'
                , \InepZend\Util\String::verticalText('Ministerio da Educacao', "\n")
        );
    }

    /**
     * Generated from @assert ('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira') === 'Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira'.
     *
     * @covers \InepZend\Util\String::clearText
     */
    public function testClearText()
    {
        $this->assertSame(
                'Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira'
                , \InepZend\Util\String::clearText('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira')
        );
    }

    /**
     * Generated from @assert ('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira', 'i') === 'iiiiiiiii'.
     *
     * @covers \InepZend\Util\String::clearText
     */
    public function testClearText2()
    {
        $this->assertSame(
                'iiiiiiiii'
                , \InepZend\Util\String::clearText('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira', 'i')
        );
    }

    /**
     * Generated from @assert ('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira', 'i', false) === 'Insttuto Naconal de Estudos e Pesqusas Educaconas Anso Texera'.
     *
     * @covers \InepZend\Util\String::clearText
     */
    public function testClearText3()
    {
        $this->assertSame(
                'Insttuto Naconal de Estudos e Pesqusas Educaconas Anso Texera'
                , \InepZend\Util\String::clearText('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira', 'i', false)
        );
    }

    /**
     * Generated from @assert ('INEP', array('N', 'E', 'A'), 'MFB') === 'IMFBP'.
     *
     * @covers \InepZend\Util\String::replaceCharacterAndRemoveLast
     */
    public function testReplaceCharacterAndRemoveLast()
    {
        $this->assertSame(
                'IMFBP'
                , \InepZend\Util\String::replaceCharacterAndRemoveLast('INEP', array('N', 'E', 'A'), 'MFB')
        );
    }

    /**
     * Generated from @assert ('MEC', array('M', 'E', 'C'), 'OAB') === 'OAB'.
     *
     * @covers \InepZend\Util\String::replaceCharacterAndRemoveLast
     */
    public function testReplaceCharacterAndRemoveLast2()
    {
        $this->assertSame(
                'OAB'
                , \InepZend\Util\String::replaceCharacterAndRemoveLast('MEC', array('M', 'E', 'C'), 'OAB')
        );
    }

    /**
     * Generated from @assert ('INEP') == 'INEP'.
     *
     * @covers \InepZend\Util\String::treatingSeparatorParameter
     */
    public function testTreatingSeparatorParameter()
    {
        $this->assertEquals(
                'INEP'
                , \InepZend\Util\String::treatingSeparatorParameter('INEP')
        );
    }

    /**
     * Generated from @assert ('INEP MEC') === "'INEP','MEC'".
     *
     * @covers \InepZend\Util\String::treatingSeparatorParameter
     */
    public function testTreatingSeparatorParameter2()
    {
        $this->assertSame(
                "'INEP','MEC'"
                , \InepZend\Util\String::treatingSeparatorParameter('INEP MEC')
        );
    }

    /**
     * Generated from @assert ('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira') === "'Instituto','Nacional','de','Estudos','e','Pesquisas','Educacionais','Anisio','Teixeira'".
     *
     * @covers \InepZend\Util\String::treatingSeparatorParameter
     */
    public function testTreatingSeparatorParameter3()
    {
        $this->assertSame(
                "'Instituto','Nacional','de','Estudos','e','Pesquisas','Educacionais','Anisio','Teixeira'"
                , \InepZend\Util\String::treatingSeparatorParameter('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira')
        );
    }

    /**
     * Generated from @assert ('INEP MEC') === 'INEP MEC'.
     *
     * @covers \InepZend\Util\String::substrReverse
     */
    public function testSubstrReverse()
    {
        $this->assertSame(
                'INEP MEC'
                , \InepZend\Util\String::substrReverse('INEP MEC')
        );
    }

    /**
     * Generated from @assert ('INEP MEC', 4, 8) === 'INEP'.
     *
     * @covers \InepZend\Util\String::substrReverse
     */
    public function testSubstrReverse2()
    {
        $this->assertSame(
                'INEP'
                , \InepZend\Util\String::substrReverse('INEP MEC', 4, 8)
        );
    }

    /**
     * Generated from @assert ('INEP MEC') === 'i-n-e-p-m-e-c'.
     *
     * @covers \InepZend\Util\String::dasherize
     */
    public function testDasherize()
    {
        $this->assertSame(
                'i-n-e-p-m-e-c'
                , \InepZend\Util\String::dasherize('INEP MEC')
        );
    }

    /**
     * Generated from @assert ('INEP') === 'i-n-e-p'.
     *
     * @covers \InepZend\Util\String::dasherize
     */
    public function testDasherize2()
    {
        $this->assertSame(
                'i-n-e-p'
                , \InepZend\Util\String::dasherize('INEP')
        );
    }

    /**
     * Generated from @assert ('I') === 'i'.
     *
     * @covers \InepZend\Util\String::dasherize
     */
    public function testDasherize3()
    {
        $this->assertSame(
                'i'
                , \InepZend\Util\String::dasherize('I')
        );
    }

    /**
     * Generated from @assert ('i-n-e-p-m-e-c') === 'i-n-e-p-m-e-c'.
     *
     * @covers \InepZend\Util\String::dasherize
     */
    public function testDasherize4()
    {
        $this->assertSame(
                'i-n-e-p-m-e-c'
                , \InepZend\Util\String::dasherize('i-n-e-p-m-e-c')
        );
    }

    /**
     * Generated from @assert ('i-n-e-p') === 'i-n-e-p'.
     *
     * @covers \InepZend\Util\String::dasherize
     */
    public function testDasherize5()
    {
        $this->assertSame(
                'i-n-e-p'
                , \InepZend\Util\String::dasherize('i-n-e-p')
        );
    }

    /**
     * Generated from @assert ('INEP MEC') === 'InepMec'.
     *
     * @covers \InepZend\Util\String::camelize
     */
    public function testCamelize()
    {
        $this->assertSame(
                'InepMec'
                , \InepZend\Util\String::camelize('INEP MEC')
        );
    }

    /**
     * Generated from @assert ('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira') === 'InstitutoNacionalDeEstudosEPesquisasEducacionaisAnisioTeixeira'.
     *
     * @covers \InepZend\Util\String::camelize
     */
    public function testCamelize2()
    {
        $this->assertSame(
                'InstitutoNacionalDeEstudosEPesquisasEducacionaisAnisioTeixeira'
                , \InepZend\Util\String::camelize('Instituto Nacional de Estudos e Pesquisas Educacionais Anisio Teixeira')
        );
    }

    /**
     * Generated from @assert ('InstitutoNacionalDeEstudosEPesquisasEducacionaisAnisioTeixeira') === 'InstitutoNacionalDeEstudosEPesquisasEducacionaisAnisioTeixeira'.
     *
     * @covers \InepZend\Util\String::camelize
     */
    public function testCamelize3()
    {
        $this->assertSame(
                'InstitutoNacionalDeEstudosEPesquisasEducacionaisAnisioTeixeira'
                , \InepZend\Util\String::camelize('InstitutoNacionalDeEstudosEPesquisasEducacionaisAnisioTeixeira')
        );
    }

    /**
     * Generated from @assert ('Minstério da Educação', 5) === 'ério da Educação'.
     *
     * @covers \InepZend\Util\String::substrEncode
     */
    public function testSubstrEncode()
    {
        $this->assertSame(
                'ério da Educação'
                , \InepZend\Util\String::substrEncode('Minstério da Educação', 5)
        );
    }

    /**
     * Generated from @assert ('Minstério da Educação', 12) === ' Educação'.
     *
     * @covers \InepZend\Util\String::substrEncode
     */
    public function testSubstrEncode2()
    {
        $this->assertSame(
                ' Educação'
                , \InepZend\Util\String::substrEncode('Minstério da Educação', 12)
        );
    }

    /**
     * Generated from @assert ('Minstério da Educação', 5, 21) === 'ério da Educação'.
     *
     * @covers \InepZend\Util\String::substrEncode
     */
    public function testSubstrEncode3()
    {
        $this->assertSame(
                'ério da Educação'
                , \InepZend\Util\String::substrEncode('Minstério da Educação', 5, 21)
        );
    }

    /**
     * Generated from @assert ('Minstério da Educação', 12, 21) === ' Educação'.
     *
     * @covers \InepZend\Util\String::substrEncode
     */
    public function testSubstrEncode4()
    {
        $this->assertSame(
                ' Educação'
                , \InepZend\Util\String::substrEncode('Minstério da Educação', 12, 21)
        );
    }

    /**
     * Generated from @assert ('Minstério da Educação', 5, 21) === 'ério da Educação'.
     *
     * @covers \InepZend\Util\String::substrEncode
     */
    public function testSubstrEncode5()
    {
        $this->assertSame(
                'ério da Educação'
                , \InepZend\Util\String::substrEncode('Minstério da Educação', 5, 21)
        );
    }

    /**
     * Generated from @assert ('MinistÃ©rio da EducaÃ§Ã£o') === 'Ministério da Educação'.
     *
     * @covers \InepZend\Util\String::utf8Decode
     */
    public function testUtf8Decode()
    {
        $this->assertSame(
                'Ministério da Educação'
                , \InepZend\Util\String::utf8Decode('MinistÃ©rio da EducaÃ§Ã£o')
        );
    }

    /**
     * Generated from @assert ('Ministério da Educação') === utf8_decode('Ministério da Educação').
     *
     * @covers \InepZend\Util\String::utf8Decode
     */
    public function testUtf8Decode2()
    {
        $this->assertSame(
                utf8_decode('Ministério da Educação')
                , \InepZend\Util\String::utf8Decode('Ministério da Educação')
        );
    }

    /**
     * Generated from @assert ('Minist&#233;rio da Educa&#231;&#227;o') !== 'Ministério da Educação'.
     *
     * @covers \InepZend\Util\String::utf8Decode
     */
    public function testUtf8Decode3()
    {
        $this->assertNotSame(
                'Ministério da Educação'
                , \InepZend\Util\String::utf8Decode('Minist&#233;rio da Educa&#231;&#227;o')
        );
    }

    /**
     * Generated from @assert ('Ministério da Educação') === 'MinistÃ©rio da EducaÃ§Ã£o'.
     *
     * @covers \InepZend\Util\String::utf8Encode
     */
    public function testUtf8Encode()
    {
        $this->assertSame(
                'MinistÃ©rio da EducaÃ§Ã£o'
                , \InepZend\Util\String::utf8Encode('Ministério da Educação')
        );
    }

    /**
     * Generated from @assert ('MinistÃ©rio da EducaÃ§Ã£o') === 'MinistÃÂ©rio da EducaÃÂ§ÃÂ£o'.
     *
     * @covers \InepZend\Util\String::utf8Encode
     */
    public function testUtf8Encode2()
    {
        $this->assertSame(
                'MinistÃÂ©rio da EducaÃÂ§ÃÂ£o'
                , \InepZend\Util\String::utf8Encode('MinistÃ©rio da EducaÃ§Ã£o')
        );
    }

    /**
     * Generated from @assert ('Inep', '<span class="Inep">Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira Legislação e Documentos.</span>') === array('Inep').
     *
     * @covers \InepZend\Util\String::listValueFromText
     */
    public function testListValueFromText()
    {
        $this->assertSame(
                array('Inep')
                , \InepZend\Util\String::listValueFromText('Inep', '<span class="Inep">Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira Legislação e Documentos.</span>')
        );
    }

    /**
     * Generated from @assert ('Inep', 'Instituto=\'Inep\'') === array('Inep').
     *
     * @covers \InepZend\Util\String::listValueFromText
     */
    public function testListValueFromText2()
    {
        $this->assertSame(
                array('Inep')
                , \InepZend\Util\String::listValueFromText('Inep', 'Instituto=\'Inep\'')
        );
    }

    /**
     * Generated from @assert ('INEP', 'Instituto=\'Inep\'') === array('Inep').
     *
     * @covers \InepZend\Util\String::listValueFromText
     */
    public function testListValueFromText3()
    {
        $this->assertSame(
                array('Inep')
                , \InepZend\Util\String::listValueFromText('INEP', 'Instituto=\'Inep\'')
        );
    }

    /**
     * Generated from @assert ('INEP', 'O Censo Escolar, realizado anualmente pelo Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira - "Inep", é o mais relevante e abrangente levantamento estatístico sobre a Educação Básica no País') === array('Inep').
     *
     * @covers \InepZend\Util\String::listValueFromText
     */
    public function testListValueFromText4()
    {
        $this->assertSame(
                array('Inep')
                , \InepZend\Util\String::listValueFromText('INEP', 'O Censo Escolar, realizado anualmente pelo Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira - "Inep", é o mais relevante e abrangente levantamento estatístico sobre a Educação Básica no País')
        );
    }

    /**
     * Generated from @assert ('Educação Básica no País', 'O Censo Escolar, realizado anualmente pelo Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira - Inep, é o mais relevante e abrangente levantamento estatístico sobre a "Educação Básica no País"') === array('Educação Básica no País').
     *
     * @covers \InepZend\Util\String::listValueFromText
     */
    public function testListValueFromText5()
    {
        $this->assertSame(
                array('Educação Básica no País')
                , \InepZend\Util\String::listValueFromText('Educação Básica no País', 'O Censo Escolar, realizado anualmente pelo Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira - Inep, é o mais relevante e abrangente levantamento estatístico sobre a "Educação Básica no País"')
        );
    }

    /**
     * Generated from @assert ('Educação Básica no País', 'O Censo Escolar, realizado anualmente pelo Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira - Inep, é o mais relevante e abrangente levantamento estatístico sobre a "Educação Básica" no País') !== array('Educação Básica no País').
     *
     * @covers \InepZend\Util\String::listValueFromText
     */
    public function testListValueFromText6()
    {
        $this->assertNotSame(
                array('Educação Básica no País')
                , \InepZend\Util\String::listValueFromText('Educação Básica no País', 'O Censo Escolar, realizado anualmente pelo Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira - Inep, é o mais relevante e abrangente levantamento estatístico sobre a "Educação Básica" no País')
        );
    }

}
