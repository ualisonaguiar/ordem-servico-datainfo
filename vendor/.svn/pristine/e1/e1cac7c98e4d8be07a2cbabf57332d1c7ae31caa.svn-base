<?php

namespace InepZend\Doctrine\ORM\Query\AST\Functions;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

class ReplaceFunction extends FunctionNode
{

    public $field;
    public $expressionFind;
    public $expressionReplace;

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'REPLACE(' . $this->field->dispatch($sqlWalker) . ', ' . $this->expressionFind->dispatch($sqlWalker) . ', ' . $this->expressionReplace->dispatch($sqlWalker) . ')';
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->field = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->expressionFind = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->expressionReplace = $parser->StringPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

}
