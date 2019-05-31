<?php

namespace InepZend\Module\Ssi\Service;

use InepZend\Module\Ssi\Service\AbstractService;
use InepZend\Permission\Permission;
use InepZend\Util\stdClass;
use Zend\Json\Decoder;

class AcaoMenu extends AbstractService
{

    public function findBy($arrCriteria = null, $booId = null)
    {
        return parent::findBy(array_merge((array) $arrCriteria, array('sg_acao_remove' => Permission::CONST_KEY_PREFIXO_RESOURCE)), $booId);
    }

    protected function getTree($arrCriteria = null)
    {
        $arrTree = $this->findBy($arrCriteria);
        $arrInsereAcao = $this->addAcaoRoot($arrTree);
        $arrTree = $this->addAcaoChildren((count($arrInsereAcao) > 0 ? $arrInsereAcao : $arrTree), $arrTree);
        $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args()), array($arrTree)));
        return $arrTree;
    }

    protected function renderTree($arrTree = null, $arrData = null, $intDeep = 0, $booIcon = true)
    {
        $strTree = (empty($intDeep)) ? '<div class="divTree">' : '';
        if (is_array($arrTree)) {
            foreach ($arrTree as $strSgAcao => $acaoTree) {
                $booHasChildren = (count($acaoTree->children) > 0);
                $strTree .= '<div class="divTreeItem divTreeItem' . $intDeep . '" data-level="' . $intDeep . '" data-acronym="' . $strSgAcao . '" title="' . (empty($acaoTree->ds_acao) ? $acaoTree->no_acao : $acaoTree->ds_acao) . '">' . $acaoTree->no_acao;
                $strTree .= '<input type="hidden" name="acao[]" value=\'' . serialize($acaoTree) . '\' />';
                if ($booIcon) {
                    $strTree .= '<div class=\'pull-right\'><i class=\'fa fa-pencil-square-o\' title=\'Editar item\'></i>&nbsp;<i class=\'fa fa-trash-o\' title=\'Excluir item\'></i>';
                    $strTree .= (($booHasChildren) ? '&nbsp;<i class=\'fa fa fa-plus-circle\' title=\'Inserir Ação Filho\'></i>' : '') . '</div>';
                }
                $strTree .= '</div>';
                if ($booHasChildren)
                    $strTree .= $this->renderTree($acaoTree->children, $arrData, ($intDeep + 1), $booIcon);
            }
        }
        $strTree .= (empty($intDeep)) ? '</div>' : '';
        if (empty($intDeep))
            $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args()), array($strTree)));
        return $strTree;
    }

    protected function convertPostToTree($arrData = null)
    {
        if (!array_key_exists('from', $arrData))
            return false;
        $arrTree = array();
        if ((!empty($arrData['from'])) && ($arrData['from'] != 'Arvore'))
            return (!array_key_exists('ds_tree', $arrData)) ? false : $this->removeClassName($this->convertChildrenToArray((array) Decoder::decode($arrData['ds_tree'])));
        if (!array_key_exists('acao', $arrData))
            return false;
        $arrOrder = array();
        foreach ((array) $arrData['acao'] as $strAcao) {
            $acao = unserialize($strAcao);
            if (!is_object($acao))
                $acao = new stdClass($acao);
            $acao->children = array();
            $strSgAcao = str_replace(array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9), '', $acao->sg_acao);
            $strRoute = null;
            if (($intPos = strpos($strSgAcao, '__')) !== false)
                $strRoute = substr($strSgAcao, $intPos + 2);
            $arrSgAcaoPrefix = explode('_', reset($arrExplode = explode('__', $strSgAcao)));
            foreach ($arrSgAcaoPrefix as $intKey => $strSgAcaoPrefix) {
                if (!array_key_exists($intKey, $arrOrder))
                    $arrOrder[$intKey] = array();
                if (!in_array($strSgAcaoPrefix, $arrOrder[$intKey])) {
                    $intIndex = count($arrOrder[$intKey]);
                    $arrOrder[$intKey][] = $strSgAcaoPrefix;
                } else
                    $intIndex = array_search($strSgAcaoPrefix, $arrOrder[$intKey]);
                $arrSgAcaoPrefix[$intKey] = str_pad($intIndex, 3, '0', STR_PAD_LEFT) . $strSgAcaoPrefix;
            }
            $strSgAcao = implode('_', $arrSgAcaoPrefix) . (empty($strRoute) ? '' : '__' . $strRoute);
            $acao->sg_acao = $strSgAcao;
            $arrTree[] = $acao;
        }
        $arrTree = array_values($arrTree);
        if (!empty($arrTree))
            $arrTree = $this->addAcaoChildren($this->addAcaoRoot($arrTree), $arrTree);
        $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args()), array($arrTree)));
        return $arrTree;
    }

    /**
     * 
     * @param type $dataAcronym
     * @param type $domXmlAcronym
     * @param type $xmlRoot
     * @return type
     */
    protected function mountInfoSsiXml($dataAcronym, $domXmlAcronym, &$xmlRoot)
    {
        foreach ($dataAcronym as $acronym) {
            $xmlInfoAcronym = $domXmlAcronym->createElement('acao');
            $xmlInfoAcronym->appendChild($domXmlAcronym->createElement('nome', $acronym->no_acao));
            $xmlInfoAcronym->appendChild($domXmlAcronym->createElement('sigla', $acronym->sg_acao));
            $xmlInfoAcronym->appendChild($domXmlAcronym->createElement('descricao', $acronym->ds_acao));
            $xmlInfoAcronym->appendChild($domXmlAcronym->createElement('tipoAcao', 1)); # Verificar com SSI-Web
            $xmlInfoAcronym->appendChild($domXmlAcronym->createElement('segundoFator', 'false'));
            $xmlRoot->appendChild($xmlInfoAcronym);
            if (count($acronym->children) != 0)
                $this->mountInfoSsiXml($acronym->children, $domXmlAcronym, $xmlRoot);
        }
    }

    private function convertChildrenToArray($arrTree = null, $intDeep = 0)
    {
        if (is_array($arrTree))
            foreach ($arrTree as $strSgAcao => $acaoTree)
                if (is_object($acaoTree->children))
                    $acaoTree->children = (array) $this->convertChildrenToArray((array) $acaoTree->children, ($intDeep + 1));
        return $arrTree;
    }

    private function addAcaoRoot($arrAcao = null)
    {
        $arrTree = array();
        foreach ($arrAcao as $acao) {
            if (is_array($acao))
                $acao = new stdClass($acao);
            if (strpos($acao->sg_acao, '__') !== false)
                continue;
            if (strpos($acao->sg_acao, '_') === false) {
                $acao->children = array();
                $arrTree[$acao->sg_acao] = $acao;
            }
        }
        ksort($arrTree);
        return $arrTree;
    }

    private function addAcaoChildren($arrTree = null, $arrAcao = null, $intDeep = 0)
    {
        if ($intDeep > 20)
            return array();
        foreach ($arrTree as $strSgAcao => $acaoTree) {
            if (strpos($strSgAcao, '__') !== false)
                continue;
            foreach ($arrAcao as $acao) {
                if (is_array($acao))
                    $acao = new stdClass($acao);
                if (strpos($acao->sg_acao, '__') !== false) {
                    if (strpos($acao->sg_acao, $strSgAcao) === 0) {
                        $acao->children = array();
                        $acaoTree->children[$acao->sg_acao] = $acao;
                    }
                    continue;
                }
                if (($acaoTree->sg_acao == $acao->sg_acao) || ((count(explode('_', $acao->sg_acao)) - 1) != ($intDeep + 1)))
                    continue;
                if (strpos($acao->sg_acao, $strSgAcao) === 0) {
                    $acao->children = array();
                    $arrTree[$strSgAcao]->children[$acao->sg_acao] = $acao;
                }
            }
            if (count($arrTree[$strSgAcao]->children) > 0) {
                ksort($arrTree[$strSgAcao]->children);
                $arrTree[$strSgAcao]->children = $this->addAcaoChildren($arrTree[$strSgAcao]->children, $arrAcao, ($intDeep + 1));
            }
        }
        return $arrTree;
    }

}
