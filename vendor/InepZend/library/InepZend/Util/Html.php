<?php

namespace InepZend\Util;

/**
 * Classe responsavel no tratamento de strings HTMLs.
 *
 * @package InepZend
 * @subpackage Util
 */
class Html
{

    const TAG_TYPE_BASIC = 'básica';
    const TAG_TYPE_LINK = 'link';
    const TAG_TYPE_FORMATTING = 'formatação';
    const TAG_TYPE_PROGRAMMING = 'programação';
    const TAG_TYPE_IMAGE = 'imagem';
    const TAG_TYPE_META_DATA = 'meta dados';
    const TAG_TYPE_FORM = 'formulários';
    const TAG_TYPE_TABLE = 'tabela';
    const TAG_TYPE_LIST = 'listas';
    const TAG_TYPE_STYLE = 'estilo';
    const TAG_TYPE_FRAME = 'frames';

    /**
     * Metodo responsavel em realizar algumas conversoes dos caracteres 
     * (inclusive dos especiais) de strings.
     *
     * @example \InepZend\Util\Html::convertCharacter('<©ç', false, false)
     *
     * @param string $strText
     * @param boolean $booManual
     * @param boolean $booInvert
     * @return string
     *
     * @assert ('<', false) === '<'
     * @assert ('©', false) === '&copy;'
     * @assert ('ç', false) === '&ccedil;'
     * @assert ('&lt;', false) === '&amp;lt;'
     * @assert ('&copy;', false) === '&amp;copy;'
     * @assert ('&ccedil;', false) === '&amp;ccedil;'
     * @assert ('ok', false) === 'ok'
     *
     * @assert ('<', true, false) === '&lt;'
     * @assert ('©', true, false) === '&copy;'
     * @assert ('ç', true, false) === '&ccedil;'
     * @assert ('&lt;', true, false) === '&amp;lt;'
     * @assert ('&copy;', true, false) === '&amp;copy;'
     * @assert ('&ccedil;', true, false) === '&amp;ccedil;'
     * @assert ('ok', true, false) === 'ok'
     *
     * @assert ('<', true, true) === '<'
     * @assert ('©', true, true) === '©'
     * @assert ('ç', true, true) === 'ç'
     * @assert ('&lt;', true, true) === '<'
     * @assert ('&copy;', true, true) === '©'
     * @assert ('&ccedil;', true, true) === 'ç'
     * @assert ('ok', true, true) === 'ok'
     */
    public static function convertCharacter($strText, $booManual = false, $booInvert = false)
    {
        if ($booManual === true) {
            if ($booInvert !== false)
                return self::convertHtmlToText($strText);
            $arrSpecialCharacter = array(
                '<', '>',
                "'", '"',
                'Ø',
                'ø', 'Þ',
                'Ð', 'þ',
                'ð', 'Æ',
                'ß', 'æ',
                '¼',
                '½', '¡',
                '¾', '£',
                '©', '¥',
                '®', '§',
                'ª', '¤',
                '²', '¦',
                '³', '«',
                '¹', '¬',
                '¯', '­',
                'µ', 'º',
                '¶', '´',
                '·', '¨',
                '°', '±',
                '¸', '»',
                '¿',
                '×', '¢',
                '÷', '€',
                '“', '™',
                '”', '‰',
                'Œ', 'ƒ',
                '‡', '†',
                '–'
            );
            $arrTransformedCharacter = array(
                '&lt;', '&gt;',
                '&apos;', '&quot;',
                '&Oslash;',
                '&oslash;', '&THORN;',
                '&ETH;', '&thorn;',
                '&eth;', '&AElig;',
                '&szlig;', '&aelig;',
                '&frac14;',
                '&frac12;', '&iexcl;',
                '&frac34;', '&pound;',
                '&copy;', '&yen;',
                '&reg;', '&sect;',
                '&ordf;', '&curren;',
                '&sup2;', '&brvbar;',
                '&sup3;', '&laquo;',
                '&sup1;', '&not;',
                '&macr;', '&shy;',
                '&micro;', '&ordm;',
                '&para;', '&acute;',
                '&middot;', '&uml;',
                '&deg;', '&plusmn;',
                '&cedil;', '&raquo;',
                '&iquest;',
                '&times;', '&cent;',
                '&divide;', '&euro;',
                '&#147;', '&#153;',
                '&#148;', '&#137;',
                '&#140;', '&#131;',
                '&#135;', '&#134;',
                '-'
            );
            $strText = str_replace($arrSpecialCharacter, $arrTransformedCharacter, self::convertAccent($strText));
        } else
            $strText = self::convertAccent($strText);
        return $strText;
    }

    /**
     * Metodo responsavel em converter todos os caracteres aplicaveis em 
     * caracteres especiais (entidades html).
     *
     * @example \InepZend\Util\Html::convertAccent('<©ç')
     *
     * @param string $strText
     * @return string
     *
     * @assert ('<') === '<'
     * @assert ('©') === '&copy;'
     * @assert ('ç') === '&ccedil;'
     * @assert ('&lt;') === '&amp;lt;'
     * @assert ('&copy;') === '&amp;copy;'
     * @assert ('&ccedil;') === '&amp;ccedil;'
     * @assert ('ok') === 'ok'
     */
    public static function convertAccent($strText)
    {
        return str_replace('&lt;', '<', str_replace('&gt;', '>', htmlentities($strText, ENT_NOQUOTES)));
    }

    /**
     * Metodo responsavel em converter todas a entidades html em caracteres.
     *
     * @example \InepZend\Util\Html::convertAccent('&lt;&copy;&ccedil;&amp;lt;')
     *
     * @param string $strText
     * @return string
     *
     * @assert ('<') === '<'
     * @assert ('©') === '©'
     * @assert ('ç') === 'ç'
     * @assert ('&lt;') === '<'
     * @assert ('&copy;') === '©'
     * @assert ('&ccedil;') === 'ç'
     * @assert ('ok') === 'ok'
     * @assert ('&amp;lt;') === '&lt;'
     */
    public static function convertHtmlToText($strText)
    {
        $strText = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $strText);
        $strText = preg_replace('~&#([0-9]+);~e', 'chr(\\1)', $strText);
        return strtr($strText, array_flip(get_html_translation_table(HTML_ENTITIES)));
    }

    /**
     * Metodo responsavel em listar a grande maioria das tags html, inclusive 
     * aquelas deprecated.
     *
     * @example \InepZend\Util\Html::listTagHtml()
     *
     * @return array
     */
    public static function listTagHtml()
    {
        # Tag HTML, strip_tag?, Tipo, Definicao
        $arrTagHtml = array(
            array('<!-- -->', 'N', self::TAG_TYPE_BASIC, 'Define um comentário'),
            array('<!DOCTYPE>', 'N', self::TAG_TYPE_BASIC, 'Define o document type'),
            array('<a>', 'S', self::TAG_TYPE_LINK, 'Define um link'),
            array('<abbr>', 'S', self::TAG_TYPE_FORMATTING, 'Define uma abreviação'),
            array('<acronym>', 'S', self::TAG_TYPE_FORMATTING, 'Define um acrônimo'),
            array('<address>', 'S', self::TAG_TYPE_FORMATTING, 'Define informações de contato do autor do documento'),
            array('<applet>', 'N', self::TAG_TYPE_PROGRAMMING, 'Define um applet embutido'),
            array('<area>', 'N', self::TAG_TYPE_IMAGE, 'Define uma área dentro de um mapa de imagem'),
            array('<article>', 'S', self::TAG_TYPE_FORMATTING, 'Define um artigo'),
            array('<aside>', 'N', self::TAG_TYPE_BASIC, 'Define o conteúdo, além do conteúdo da página'),
            array('<audio>', 'N', self::TAG_TYPE_PROGRAMMING, 'Define o conteúdo de som'),
            array('<b>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto em negrito'),
            array('<base>', 'N', self::TAG_TYPE_META_DATA, 'Especifica a URL base para todas as urls relativas de um documento'),
            array('<basefont>', 'N', self::TAG_TYPE_META_DATA, 'Especifica a cor, tamanho e fonte para todo o texto de um documento'),
            array('<bdi>', 'N', self::TAG_TYPE_FORMATTING, 'Isola uma parte do texto que pode ser formatado em uma direção diferente de outro texto fora dela'),
            array('<bdo>', 'N', self::TAG_TYPE_FORMATTING, 'Substitui a atual direção de texto'),
            array('<big>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto grande'),
            array('<bgsound>', 'N', self::TAG_TYPE_BASIC, 'Carrega musica de fundo'),
            array('<blink>', 'N', self::TAG_TYPE_FORMATTING, 'Pisca o texto entre as tags'),
            array('<blockquote>', 'S', self::TAG_TYPE_FORMATTING, 'Define uma citação longa'),
            array('<body>', 'N', self::TAG_TYPE_BASIC, 'Define o corpo do documento'),
            array('<br>', 'S', self::TAG_TYPE_BASIC, 'Define a quebra de linha'),
            array('<button>', 'N', self::TAG_TYPE_FORM, 'Define um botão clicável'),
            array('<canvas>', 'N', self::TAG_TYPE_PROGRAMMING, 'Usado para desenhar gráficos, em tempo real, através de scripting (normalmente JavaScript)'),
            array('<caption>', 'S', self::TAG_TYPE_TABLE, 'Define o título de uma tabela'),
            array('<center>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto centralizado'),
            array('<cite>', 'S', self::TAG_TYPE_FORMATTING, 'Define uma citação'),
            array('<code>', 'S', self::TAG_TYPE_FORMATTING, 'Define um trecho de código de computador'),
            array('<col>', 'S', self::TAG_TYPE_TABLE, 'Define valores de atributo para uma ou mais colunas em uma tabela'),
            array('<colgroup>', 'S', self::TAG_TYPE_TABLE, 'Especifica um grupo de uma ou mais colunas em uma tabela para formatação'),
            array('<command>', 'N', self::TAG_TYPE_FORM, 'Define um botão de comando que um usuário pode invocar'),
            array('<datalist>', 'N', self::TAG_TYPE_FORM, 'Especifica uma lista de opções pré-definidas para controles de entrada'),
            array('<dd>', 'S', self::TAG_TYPE_LIST, 'Define a descrição de um item em uma lista de definições'),
            array('<del>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto que foi retirado de um documento'),
            array('<details>', 'S', self::TAG_TYPE_FORMATTING, 'Define detalhes adicionais que o usuário pode exibir ou ocultar'),
            array('<dfn>', 'S', self::TAG_TYPE_FORMATTING, 'Define um termo de definição'),
            array('<dir>', 'S', self::TAG_TYPE_LIST, 'Define uma lista de diretório'),
            array('<div>', 'S', self::TAG_TYPE_STYLE, 'Define uma seção em um documento'),
            array('<dl>', 'S', self::TAG_TYPE_LIST, 'Define uma lista de definição'),
            array('<dt>', 'S', self::TAG_TYPE_LIST, 'Defines um termo em uma lista de definição'),
            array('<em>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto enfatizado'),
            array('<embed>', 'N', self::TAG_TYPE_BASIC, 'Define um recipiente para uma aplicação externa (não HTML)'),
            array('<fieldset>', 'S', self::TAG_TYPE_FORM, 'Agrupa elementos relacionados em um formulário'),
            array('<figcaption>', 'N', self::TAG_TYPE_IMAGE, 'Define uma legenda para um elemento <figure>'),
            array('<figure>', 'N', self::TAG_TYPE_IMAGE, 'Especifica auto-suficiente conteúdo'),
            array('<font>', 'S', self::TAG_TYPE_FORMATTING, 'Define fonte, cor, e tamanho do texto'),
            array('<footer>', 'N', self::TAG_TYPE_BASIC, 'Define um rodapé de um documento ou seção'),
            array('<form>', 'N', self::TAG_TYPE_FORM, 'Define e envolve um formulário'),
            array('<frame>', 'N', self::TAG_TYPE_FRAME, 'Define uma janela/frame em um frameset'),
            array('<frameset>', 'N', self::TAG_TYPE_FRAME, 'Define uma seção de frames'),
            array('<h1>', 'S', self::TAG_TYPE_BASIC, 'Define títulos de nivel 1'),
            array('<h2>', 'S', self::TAG_TYPE_BASIC, 'Define títulos de nivel 2'),
            array('<h3>', 'S', self::TAG_TYPE_BASIC, 'Define títulos de nivel 3'),
            array('<h4>', 'S', self::TAG_TYPE_BASIC, 'Define títulos de nivel 4'),
            array('<h5>', 'S', self::TAG_TYPE_BASIC, 'Define títulos de nivel 5'),
            array('<h6>', 'S', self::TAG_TYPE_BASIC, 'Define títulos de nivel 6'),
            array('<head>', 'N', self::TAG_TYPE_META_DATA, 'Define informações sobre um documento'),
            array('<header>', 'N', self::TAG_TYPE_BASIC, 'Define um cabeçalho para um documento ou seção'),
            array('<hgroup>', 'S', self::TAG_TYPE_BASIC, 'Agrupamento de elementos <h1> a <h6>'),
            array('<hr>', 'S', self::TAG_TYPE_BASIC, 'Define uma linha horizontal'),
            array('<html>', 'N', self::TAG_TYPE_BASIC, 'Define a raiz do documento HTML'),
            array('<i>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto em itálico'),
            array('<iframe>', 'S', self::TAG_TYPE_FRAME, 'Define um frame embutido'),
            array('<img>', 'S', self::TAG_TYPE_IMAGE, 'Define uma imagem'),
            array('<input>', 'N', self::TAG_TYPE_FORM, 'Define controles de entrada de dados'),
            array('<ins>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto que foi inserido em um documento'),
            array('<isindex>', 'N', self::TAG_TYPE_BASIC, 'Fornece uma única linha de controle de entrada de texto'),
            array('<kbd>', 'N', self::TAG_TYPE_FORMATTING, 'Define entrada de dados de teclado'),
            array('<keygen>', 'N', self::TAG_TYPE_FORM, 'Define um campo gerador de par de chaves (para formulários)'),
            array('<label>', 'S', self::TAG_TYPE_FORM, 'Define uma etiqueta para um elemento <input>'),
            array('<legend>', 'S', self::TAG_TYPE_FORM, 'Define o título para um elemento <fieldset>'),
            array('<li>', 'S', self::TAG_TYPE_LIST, 'Define um item de lista'),
            array('<link>', 'N', self::TAG_TYPE_LINK, 'Define a relação entre o documento e um recurso externo'),
            array('<map>', 'N', self::TAG_TYPE_IMAGE, 'Define um mapa de imagem'),
            array('<mark>', 'S', self::TAG_TYPE_FORMATTING, 'Define o texto marcado/destacado'),
            array('<marquee>', 'N', self::TAG_TYPE_FORMATTING, 'Define um texto rotativo'),
            array('<menu>', 'S', self::TAG_TYPE_LIST, 'Define uma lista de menu'),
            array('<meta>', 'N', self::TAG_TYPE_META_DATA, 'Define metadados sobre um documento HTML'),
            array('<meter>', 'N', self::TAG_TYPE_BASIC, 'Define uma medição escalar dentro de um intervalo conhecido (a gauge)'),
            array('<nav>', 'N', self::TAG_TYPE_LINK, 'Define links de navegação'),
            array('<noframes>', 'N', self::TAG_TYPE_FRAME, 'Define texto alternativo para aqueles que não podem ver frames'),
            array('<noscript>', 'N', self::TAG_TYPE_PROGRAMMING, 'Define conteúdo alternativo para aqueles que não rodam scripts no browser'),
            array('<object>', 'N', self::TAG_TYPE_PROGRAMMING, 'Define um objeto embutido'),
            array('<ol>', 'S', self::TAG_TYPE_LIST, 'Define uma lista ordenada'),
            array('<optgroup>', 'N', self::TAG_TYPE_FORM, 'Define um grupo de opções relacionadas em uma lista drop-down'),
            array('<option>', 'N', self::TAG_TYPE_FORM, 'Define uma opção em uma lista drop-down'),
            array('<output>', 'N', self::TAG_TYPE_FORM, 'Define o resultado de um cálculo'),
            array('<p>', 'S', self::TAG_TYPE_BASIC, 'Define um parágrafo'),
            array('<param>', 'N', self::TAG_TYPE_PROGRAMMING, 'Define um parâmetro para um objeto'),
            array('<pre>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto pré formatado'),
            array('<progress>', 'N', self::TAG_TYPE_BASIC, 'Representa o andamento de uma tarefa'),
            array('<q>', 'S', self::TAG_TYPE_FORMATTING, 'Define uma citação curta'),
            array('<rp>', 'N', self::TAG_TYPE_BASIC, 'Define o que mostrar em navegadores que não suportam anotações Ruby'),
            array('<rt>', 'N', self::TAG_TYPE_BASIC, 'Define uma explicação/pronúncia de caracteres (para o Leste da tipografia asiática)'),
            array('<ruby>', 'N', self::TAG_TYPE_BASIC, 'Define uma anotação de Ruby (para o Leste da tipografia asiática)'),
            array('<s>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto riscado'),
            array('<samp>', 'N', self::TAG_TYPE_FORMATTING, 'Define amostra de saida de um computador'),
            array('<script>', 'N', self::TAG_TYPE_PROGRAMMING, 'Define um script client-side'),
            array('<section>', 'N', self::TAG_TYPE_BASIC, 'Define uma seção em um documento'),
            array('<select>', 'N', self::TAG_TYPE_FORM, 'Define uma lista drop-down'),
            array('<small>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto menor'),
            array('<source>', 'N', self::TAG_TYPE_PROGRAMMING, 'Define vários recursos de mídia para elementos de mídia (<video> e <audio>)'),
            array('<span>', 'S', self::TAG_TYPE_STYLE, 'Define seção de um documento'),
            array('<strike>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto rasurado'),
            array('<strong>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto em negrito'),
            array('<style>', 'N', self::TAG_TYPE_STYLE, 'Define informações de estilo para um documento'),
            array('<sub>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto subscrito'),
            array('<summary>', 'S', self::TAG_TYPE_FORMATTING, 'Define um título visível de um elemento <details>'),
            array('<sup>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto sobrescrito'),
            array('<table>', 'S', self::TAG_TYPE_TABLE, 'Define uma tabela'),
            array('<tbody>', 'S', self::TAG_TYPE_TABLE, 'Agrupa o conteúdo do corpo de uma tabela'),
            array('<td>', 'S', self::TAG_TYPE_TABLE, 'Define uma célula de uma tabela'),
            array('<textarea>', 'N', self::TAG_TYPE_FORM, 'Define um controle de entrada de dados multi linha (text area)'),
            array('<tfoot>', 'S', self::TAG_TYPE_TABLE, 'Agrupa os conteúdos do rodapé de uma tabela'),
            array('<th>', 'S', self::TAG_TYPE_TABLE, 'Define uma célula do cabeçalho de uma tabela'),
            array('<thead>', 'S', self::TAG_TYPE_TABLE, 'Agrupa os conteúdos do cabeçalho de uma tabela'),
            array('<time>', 'N', self::TAG_TYPE_BASIC, 'Define uma data/hora'),
            array('<title>', 'N', self::TAG_TYPE_META_DATA, 'Define o título do documento'),
            array('<tr>', 'S', self::TAG_TYPE_TABLE, 'Define uma linha em uma tabela'),
            array('<track>', 'N', self::TAG_TYPE_PROGRAMMING, 'Define faixas de texto para os elementos de mídia (<video> e <audio>)'),
            array('<tt>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto de teletipo'),
            array('<u>', 'S', self::TAG_TYPE_FORMATTING, 'Define texto sublinhado'),
            array('<ul>', 'S', self::TAG_TYPE_LIST, 'Define uma lista não ordenada'),
            array('<var>', 'N', self::TAG_TYPE_FORMATTING, 'Define uma variável'),
            array('<video>', 'N', self::TAG_TYPE_PROGRAMMING, 'Define um vídeo ou filme'),
            array('<wbr>', 'N', self::TAG_TYPE_BASIC, 'Define uma possível quebra de linha'),
            array('<xmp>', 'N', self::TAG_TYPE_FORMATTING, 'Define texto pré formatado'),
            array('<>', 'S', self::TAG_TYPE_BASIC, 'Para sinal de diferente'),
        );
        return $arrTagHtml;
    }

    /**
     * Metodo responsavel em converter todos os caracteres aplicaveis em 
     * caracteres especiais (entidades html).
     *
     * @example \InepZend\Util\Html::convertAccent('<©ç')
     *
     * @param string $strText
     * @return string
     *
     * @assert (null) === array()
     * @assert ('') === array()
     *
     * @assert ('display') === array()
     * @assert ('display;') === array()
     * @assert ('display:') === array('display' => '')
     *
     * @assert ('display: none') === array('display' => 'none')
     * @assert ('display: none; float: left') === array('display' => 'none', 'float' => 'left')
     * @assert ('display:none') === array('display' => 'none')
     * @assert ('display:none; float:left') === array('display' => 'none', 'float' => 'left')
     * @assert ('display:none;float:left') === array('display' => 'none', 'float' => 'left')
     *
     * @assert ('display: none;') === array('display' => 'none')
     * @assert ('display: none; float: left;') === array('display' => 'none', 'float' => 'left')
     * @assert ('display:none;') === array('display' => 'none')
     * @assert ('display:none; float:left;') === array('display' => 'none', 'float' => 'left')
     * @assert ('display:none;float:left;') === array('display' => 'none', 'float' => 'left')

     * @assert ('display: none;', array('display' => 'block')) === array('display' => 'none')
     * @assert ('display: none; float: left;', array('display' => 'block')) === array('display' => 'none', 'float' => 'left')
     * @assert ('display:none;', array('display' => 'block')) === array('display' => 'none')
     * @assert ('display:none; float:left;', array('display' => 'block')) === array('display' => 'none', 'float' => 'left')
     * @assert ('display:none;float:left;', array('display' => 'block')) === array('display' => 'none', 'float' => 'left')

     * @assert ('display: none;', array('align' => 'center')) === array('align' => 'center', 'display' => 'none')
     * @assert ('display: none; float: left;', array('align' => 'center')) === array('align' => 'center', 'display' => 'none', 'float' => 'left')
     * @assert ('display:none;', array('align' => 'center')) === array('align' => 'center', 'display' => 'none')
     * @assert ('display:none; float:left;', array('align' => 'center')) === array('align' => 'center', 'display' => 'none', 'float' => 'left')
     * @assert ('display:none;float:left;', array('align' => 'center')) === array('align' => 'center', 'display' => 'none', 'float' => 'left')

     * @assert ('display: none;', array('display' => 'block', 'align' => 'center')) === array('display' => 'none', 'align' => 'center')
     * @assert ('display: none; float: left;', array('display' => 'block', 'align' => 'center')) === array('display' => 'none', 'align' => 'center', 'float' => 'left')
     * @assert ('display:none;', array('display' => 'block', 'align' => 'center')) === array('display' => 'none', 'align' => 'center')
     * @assert ('display:none; float:left;', array('display' => 'block', 'align' => 'center')) === array('display' => 'none', 'align' => 'center', 'float' => 'left')
     * @assert ('display:none;float:left;', array('display' => 'block', 'align' => 'center')) === array('display' => 'none', 'align' => 'center', 'float' => 'left')
     */
    public static function getCssTextArray($strCssText = null, array $arrDefault = array())
    {
        if (empty($strCssText))
            return (count($arrDefault) > 0) ? $arrDefault : array();
        if (strpos($strCssText, ';') === false) {
            if (strpos($strCssText, ':') === false)
                return (count($arrDefault) > 0) ? $arrDefault : array();
            $strCssText .= ';';
        }
        $arrResult = array();
        $arrCssText = explode(';', $strCssText);
        foreach ($arrCssText as $strCssTextItem) {
            if (strpos($strCssTextItem, ':') === false)
                continue;
            $arrCssTextItem = explode(':', $strCssTextItem);
            $strName = trim($arrCssTextItem[0]);
            $mixValue = trim($arrCssTextItem[1]);
            $arrResult[$strName] = $mixValue;
        }
        if (count($arrDefault) > 0)
            $arrResult = array_merge($arrDefault, $arrResult);
        return $arrResult;
    }

    /**
     * Metodo responsavel em converter todos os caracteres aplicaveis em 
     * caracteres especiais (entidades html).
     *
     * @example \InepZend\Util\Html::hasAttributeStyle('display: block; float: left;', 'float') <br /> \InepZend\Util\Html::hasAttributeStyle('display: block; float: left;', 'float:left')
     *
     * @param string $strStyle
     * @param string $strAttribute
     * @return mix
     * 
     * @TODO implementar asserts
     */
    public static function hasAttributeStyle($strStyle = null, $strAttribute = null)
    {
        if ((empty($strStyle)) || (empty($strAttribute)))
            return false;
        if (strpos($strAttribute, ':') === false)
            $strAttribute .= ':';
        return (stripos(str_replace(' ', '', $strStyle), $strAttribute) !== false);
    }

    public static function getHtmlAttributeData($arrAttributeData = null)
    {
        $strHtmlAttributeData = '';
        if (is_array($arrAttributeData))
            foreach ($arrAttributeData as $strAttribute => $mixValue)
                $strHtmlAttributeData .= ' data-' . $strAttribute . '="' . $mixValue . '"';
        return $strHtmlAttributeData;
    }

}
