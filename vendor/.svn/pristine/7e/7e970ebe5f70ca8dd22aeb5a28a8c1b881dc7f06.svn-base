<?php

namespace InepZend\Module\Ssi\Service;

use InepZend\Module\Ssi\Service\AbstractService;
use InepZend\Permission\Permission;
use InepZend\FormGenerator\FormGenerator;
use InepZend\Util\stdClass;
use InepZend\Util\Reflection;
use InepZend\Util\String;
use InepZend\Util\FileSystem;
use InepZend\Util\Server;

class AcaoAclFormElement extends AbstractService
{

    public function findBy($arrCriteria = null, $booId = null)
    {
        return parent::findBy(array_merge((array) $arrCriteria, array('sg_acao' => Permission::CONST_KEY_PREFIXO_RESOURCE_FORM_ELEMENT)), $booId);
    }

    /**
     * 
     * @param array $arrCriteria
     * @return array
     * 
     * @cache true
     */
    protected function findByFormElement($arrCriteria = null)
    {
        $arrFormElement = array();
        $arrForm = $this->findByForm($arrCriteria, Server::getReplacedBasePathApplication('/../../../../../../../module/'));
        $arrForm = array_unique(array_merge($arrForm, $this->findByForm($arrCriteria, __DIR__ . '/../../../../')));
        foreach ($arrForm as $strForm) {
            if (!class_exists($strForm))
                continue;
            $arrPrepareElements = Reflection::listMethodsFromClass($strForm, true, null, true);
            foreach ($arrPrepareElements as $intKey => $strPrepareElements) {
                if (strpos($strPrepareElements, 'prepareElements') === false)
                    unset($arrPrepareElements[$intKey]);
            }
            $arrPrepareElements = array_values($arrPrepareElements);
            $strModule = reset($arrExplode = explode('\Form\\', $strForm));
            if (is_array($arrCriteria)) {
                if ((array_key_exists('ds_module', $arrCriteria) ) && (!empty($arrCriteria['ds_module']) ) && ($arrCriteria['ds_module'] != $strModule))
                    continue;
                if ((array_key_exists('ds_form', $arrCriteria) ) && (!empty($arrCriteria['ds_form']))) {
                    $strModuleCriteria = reset($arrExplode = explode('::', $arrCriteria['ds_form']));
                    $strFormCriteria = end($arrExplode = explode('::', $arrCriteria['ds_form']));
                    if (($strModuleCriteria != $strModule ) || ($strFormCriteria != $strForm))
                        continue;
                }
                if ((array_key_exists('ds_prepare_elements', $arrCriteria) ) && (!empty($arrCriteria['ds_prepare_elements']))) {
                    $strModuleCriteria = reset($arrExplode = explode('::', $arrCriteria['ds_prepare_elements']));
                    $strFormCriteria = reset($arrExplode = explode('->', end($arrExplode = explode('::', $arrCriteria['ds_prepare_elements']))));
                    $strPrepareElementsCriteria = end($arrExplode = explode('->', end($arrExplode = explode('::', $arrCriteria['ds_prepare_elements']))));
                    if (($strModuleCriteria != $strModule ) || ($strFormCriteria != $strForm ))
                        continue;
                }
            }
            foreach ($arrPrepareElements as $strPrepareElements) {
                if (is_array($arrCriteria))
                    if ((array_key_exists('ds_prepare_elements', $arrCriteria) ) && (!empty($arrCriteria['ds_prepare_elements'])))
                        if ($strPrepareElementsCriteria != $strPrepareElements)
                            continue;
                $arrFormElement[] = array('ds_index' => $strForm, 'info' => array('form' => $strForm, 'prepare_elements' => $strPrepareElements));
            }
        }
        $arrFormElement = array_values($arrFormElement);
        $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args()), array($arrForm), array($arrFormElement)));
        return $arrFormElement;
    }

    /**
     * 
     * @param array $arrCriteria
     * @param string $strPath
     * @return array
     * 
     * @cache true
     */
    protected function findByForm($arrCriteria = null, $strPath = null)
    {
        if (empty($strPath))
            $strPath = __DIR__ . '/../../../../';
        $strExtension = 'php';
        $arrForm = FileSystem::globRecursive($strPath, $strExtension);
        foreach ($arrForm as $intKey => &$strForm) {
            $strForm = str_replace($strPath, '', $strForm);
            if ((strpos($strForm, '/Form/') === false) || (strpos($strForm, 'Filter') !== false)) {
                unset($arrForm[$intKey]);
                continue;
            }
            $strForm = str_replace(array('.' . $strExtension, '/'), array('', '\\'), end($arrExplode = explode('/src/', $strForm)));
            $strModule = reset($arrExplode = explode('\Form\\', $strForm));
            if (is_array($arrCriteria))
                if ((array_key_exists('ds_module', $arrCriteria) ) && (!empty($arrCriteria['ds_module']) ) && ($arrCriteria['ds_module'] != $strModule))
                    unset($arrForm[$intKey]);
        }
        $arrForm = array_values($arrForm);
        $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args()), array($arrForm)));
        return $arrForm;
    }

    protected function fetchPairsFormToXmlJson(array $arrCriteria = null)
    {
        $arrRegister = array();
        $arrTree = $this->getTree($arrCriteria);
        foreach ($arrTree as $strModule => $arrForm)
            foreach ($arrForm as $strForm => $arrPrepareElements)
                $arrRegister[$strForm] = array('value' => $strModule . '::' . $strForm, 'text' => $strForm);
        ksort($arrRegister);
        return array_values($arrRegister);
    }

    protected function fetchPairsPrepareElementsToXmlJson(array $arrCriteria = null)
    {
        $arrRegister = array();
        $arrTree = $this->getTree($arrCriteria);
        foreach ($arrTree as $strModule => $arrForm)
            foreach ($arrForm as $strForm => $arrPrepareElements)
                foreach ($arrPrepareElements as $strPrepareElements => $arrFormElement)
                    $arrRegister[$strPrepareElements] = array('value' => $strModule . '::' . $strForm . '->' . $strPrepareElements, 'text' => $strPrepareElements);
        ksort($arrRegister);
        return array_values($arrRegister);
    }

    protected function fetchPairsFormElementToXmlJson(array $arrCriteria = null)
    {
        $arrRegister = array();
        $arrTree = $this->getTree($arrCriteria);
        foreach ($arrTree as $strModule => $arrForm)
            foreach ($arrForm as $strForm => $strPrepareElements)
                foreach ($arrPrepareElements as $strPrepareElements => $arrFormElement)
                    foreach ($arrFormElement as $strFormElement)
                        $arrRegister[$strFormElement] = array('value' => $strModule . '::' . $strForm . '->' . $strPrepareElements . '=>' . $strFormElement, 'text' => $strFormElement);
        ksort($arrRegister);
        return array_values($arrRegister);
    }

    protected function fetchPairsActionToResourceNotAllowedToXmlJson(array $arrCriteria = null)
    {
        return array(
            array('value' => FormGenerator::ACTION_RESOURCE_NOT_ALLOWED_HIDDEN, 'text' => FormGenerator::ACTION_RESOURCE_NOT_ALLOWED_HIDDEN),
            array('value' => FormGenerator::ACTION_RESOURCE_NOT_ALLOWED_DISABLED, 'text' => FormGenerator::ACTION_RESOURCE_NOT_ALLOWED_DISABLED),
            array('value' => FormGenerator::ACTION_RESOURCE_NOT_ALLOWED_READONLY, 'text' => FormGenerator::ACTION_RESOURCE_NOT_ALLOWED_READONLY),
        );
    }

    /**
     * 
     * @param array $arrCriteria
     * @return array
     * 
     * @cache true
     */
    protected function getTree($arrCriteria = null)
    {
        $arrFormElementConvert = $this->convertFormElement($this->findByFormElement($arrCriteria));
        $arrTree = array();
        foreach ($arrFormElementConvert as $strInfo) {
            $arrInfo = explode('\Form\\', $strInfo);
            if (count($arrInfo) != 2)
                continue;
            $strModule = reset($arrInfo);
            $arrFormPrepareElements = explode('->', $strInfo);
            $strForm = reset($arrFormPrepareElements);
            $strPrepareElements = end($arrFormPrepareElements);
            $arrMethodContent = explode('$this->add', str_replace(array("\n", "\t", '    ', '   ', '  '), ' ', Reflection::getMethodContent($strForm, $strPrepareElements)));
            $this->debugExec($arrMethodContent);
            foreach ($arrMethodContent as $intKey => $strMethodContent) {
                if ($intKey === 0)
                    continue;
                $strMethodContentEd = trim($strMethodContent);
                $strMethodContentEd = trim(reset($arrExplode = explode('$this->prepareElements', $strMethodContentEd)));
                if ($strMethodContentEd{0} == '(')
                    continue;
                $arrCharacEnd = array('}', ';', ')');
                foreach ($arrCharacEnd as $strCharacEnd)
                    if ($strMethodContentEd{strlen($strMethodContentEd) - 1} == $strCharacEnd)
                        $strMethodContentEd = trim(substr($strMethodContentEd, 0, strlen($strMethodContentEd) - 1));
                $arrNotAccept = array('Html', 'Hidden', 'Label', 'OpenDiv', 'Elements');
                foreach ($arrNotAccept as $strNotAccept)
                    if (strpos($strMethodContentEd, $strNotAccept) === 0)
                        continue(2);
                if (($intPos = strpos($strMethodContentEd, '(')) !== false)
                    $strMethodContentEd = substr($strMethodContentEd, 0, $intPos) . ' -> ' . substr($strMethodContentEd, $intPos + 1);
                $arrTree[$strModule][$strForm][$strPrepareElements][] = $strMethodContentEd;
            }
        }
        ksort($arrTree);
        $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args()), array($arrFormElementConvert), array($arrTree)));
        return $arrTree;
    }

    protected function renderTree($arrTree = null, $arrData = null, $intDeep = 0, $booIcon = true)
    {
        if (empty($arrTree))
            $arrTree = $this->getTree();
        $arrRegister = $this->findBy();
        $strTree = '<div class="divTree">';
        foreach ($arrTree as $strModule => $arrForm) {
            $intDeep = 0;
            $strTree .= '<div class="divTreeItem divTreeItem' . $intDeep . '" data-level="' . $intDeep . '" title="' . $strModule . '">' . $strModule . '</div>';
            foreach ($arrForm as $strForm => $arrPrepareElements) {
                $intDeep = 1;
                $strTree .= '<div class="divTreeItem divTreeItem' . $intDeep . '" data-level="' . $intDeep . '" title="' . $strForm . '">' . $strForm . '</div>';
                foreach ($arrPrepareElements as $strPrepareElements => $arrFormElement) {
                    $intDeep = 2;
                    $strTree .= '<div class="divTreeItem divTreeItem' . $intDeep . '" data-level="' . $intDeep . '" title="' . $strPrepareElements . '">' . $strPrepareElements . '</div>';
                    foreach ($arrFormElement as $strFormElement) {
                        $intDeep = 3;
                        $strPrepareElements = str_replace('prepareElements', '', $strPrepareElements);
                        $strType = reset($arrExplode = explode(' -> ', $strFormElement));
                        $strFormElementEd = str_replace(array(' =>', '=> ', '"name"'), array('=>', '=>', '\'name\''), $strFormElement);
                        $strFormElementEd = str_replace(array('"', '\'', ','), '', reset($arrExplode = explode(' ', end($arrExplode = explode('\'name\'=>', $strFormElementEd)))));
                        $strSgAcao = strtoupper(Permission::CONST_KEY_PREFIXO_RESOURCE_FORM_ELEMENT . end($arrExplode = explode('\\', $strForm)) . $strPrepareElements . '_' . $strType . '_' . $strFormElementEd);
                        $strColor = 'red';
                        $strActionResource = '';
                        if (is_array($arrRegister)) {
                            foreach ($arrRegister as $strSgAcaoRegister => $acao) {
                                if (strpos($strSgAcaoRegister, $strSgAcao) !== false) {
                                    $strColor = 'blue';
                                    $strActionResource = strtolower(str_replace(array($strSgAcao, '_'), array('', ''), $strSgAcaoRegister));
                                    break;
                                }
                            }
                        }
                        $strTree .= '<div class="divTreeItem divTreeItem' . $intDeep . '" data-level="' . $intDeep . '"><i class="fa fa-arrow-circle-o-right" style="color: ' . $strColor . ';"></i> ' . $strFormElement . '</div>';
                    }
                }
            }
        }
        $strTree .= '</div>';
        if (empty($intDeep))
            $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args()), array($arrRegister), array($strTree)));
        return $strTree;
    }

    protected function convertPostToTree($arrData = null)
    {
        $arrTree = parent::convertPostToTree($arrData);
        if (!array_key_exists('ds_form_element', $arrData)) {
            if (!empty($arrData['ds_prepare_elements'])) {
                $strForm = end($arrExplode = explode('::', reset($arrExplode = explode('->', $arrData['ds_prepare_elements']))));
                $strPrepareElements = str_replace('prepareElements', '', end($arrExplode = explode('->', $arrData['ds_prepare_elements'])));
                if (!empty($strPrepareElements))
                    $strPrepareElements = '_' . $strPrepareElements;
                $strSgAcao = strtoupper(Permission::CONST_KEY_PREFIXO_RESOURCE_FORM_ELEMENT . end($arrExplode = explode('\\', $strForm)) . $strPrepareElements . '_');
                if (is_array($arrTree))
                    foreach ($arrTree as $strSgAcaoRegister => $acao)
                        if (strpos($strSgAcaoRegister, $strSgAcao) !== false)
                            unset($arrTree[$strSgAcaoRegister]);
            }
        } else {
            foreach ((array) $arrData['ds_form_element'] as $strFormElement => $strInfo) {
                $strForm = end($arrExplode = explode('::', reset($arrExplode = explode('->', $arrData['ds_prepare_elements']))));
                $strPrepareElements = str_replace('prepareElements', '', end($arrExplode = explode('->', $arrData['ds_prepare_elements'])));
                if (!empty($strPrepareElements))
                    $strPrepareElements = '_' . $strPrepareElements;
                $strType = reset($arrExplode = explode(' -> ', $strFormElement));
                $strFormElementEd = str_replace(array(' =>', '=> ', '"name"'), array('=>', '=>', '\'name\''), $strFormElement);
                $strFormElementEd = str_replace(array('"', '\'', ','), '', reset($arrExplode = explode(' ', end($arrExplode = explode('\'name\'=>', $strFormElementEd)))));
                $strActionResource = @$arrData['ds_action_resource'][$strFormElement];
                if (!empty($strActionResource))
                    $strActionResource = '_' . $strActionResource;
                $strSgAcao = strtoupper(Permission::CONST_KEY_PREFIXO_RESOURCE_FORM_ELEMENT . end($arrExplode = explode('\\', $strForm)) . $strPrepareElements . '_' . $strType . '_' . $strFormElementEd . $strActionResource);
                $strNoAcao = 'Acesso à ' . reset($arrExplode = explode('=>', $strInfo)) . '_' . $strType . '_' . $strFormElementEd;
                $arrTree[$strSgAcao] = new stdClass(array('no_acao' => $strNoAcao, 'sg_acao' => $strSgAcao, 'ds_acao' => $strNoAcao));
                ++$intCount;
            }
        }
        $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args()), array($arrTree)));
        return $arrTree;
    }

    protected function convertTreeToFormat($arrTree = null, $arrData = null)
    {
        if (empty($arrData)) {
            $arrTree = array();
            $arrAcao = $this->findBy();
            foreach ($arrAcao as $acao)
                $arrTree[$acao->sg_acao] = $acao;
            ksort($arrTree);
        } else {
            $arrTreeMerge = array();
            foreach ((array) $arrData['ds_form_element'] as $strFormElement => $strInfo) {
                $strForm = end($arrExplode = explode('::', reset($arrExplode = explode('->', $arrData['ds_prepare_elements']))));
                $strPrepareElements = str_replace('prepareElements', '', end($arrExplode = explode('->', $arrData['ds_prepare_elements'])));
                if (!empty($strPrepareElements))
                    $strPrepareElements = '_' . $strPrepareElements;
                $strType = reset($arrExplode = explode(' -> ', $strFormElement));
                $strFormElementEd = str_replace(array(' =>', '=> ', '"name"'), array('=>', '=>', '\'name\''), $strFormElement);
                $strFormElementEd = str_replace(array('"', '\'', ','), '', reset($arrExplode = explode(' ', end($arrExplode = explode('\'name\'=>', $strFormElementEd)))));
                $strActionResource = @$arrData['ds_action_resource'][$strFormElement];
                if (!empty($strActionResource))
                    $strActionResource = '_' . $strActionResource;
                $strSgAcao = strtoupper(Permission::CONST_KEY_PREFIXO_RESOURCE_FORM_ELEMENT . end($arrExplode = explode('\\', $strForm)) . $strPrepareElements . '_' . $strType . '_' . $strFormElementEd . $strActionResource);
                $strNoAcao = 'Acesso à ' . reset($arrExplode = explode('=>', $strInfo)) . '_' . $strType . '_' . $strFormElementEd;
                $arrTreeMerge[$strSgAcao] = new stdClass(array('no_acao' => $strNoAcao, 'sg_acao' => $strSgAcao, 'ds_acao' => $strNoAcao));
            }
            $arrTree = array_merge($arrTree, $arrTreeMerge);
        }
        $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args())));
        return parent::convertTreeToFormat($arrTree);
    }

    protected function renderForm($arrTree = null, $arrData = null)
    {
        $arrTreePost = array();
        $strRender = '<label class="block">Elementos do formulário definidos no prepareElements<small class="required" style="margin-left: 4px;" aria-label="Campo requerido"><div class="clearfix"></div>*</small></label>';
        if (count($arrTree) == 0)
            $strRender .= '<font style="color: red;">Elemento do formulário não encontrado</font>';
        else {
            if (!array_key_exists('ds_form_element', $arrData))
                $arrData['ds_form_element'] = array();
            $arrTreePost = $this->convertPostToTree($arrData);
            $intCount = 0;
            foreach ($arrTree as $strModule => $arrForm)
                foreach ($arrForm as $strForm => $arrPrepareElements)
                    foreach ($arrPrepareElements as $strPrepareElements => $arrFormElement)
                        foreach ($arrFormElement as $strFormElement) {
                            ++$intCount;
                            $strName = 'ds_form_element[' . $strFormElement . ']';
                            $strNameSelect = 'ds_action_resource[' . $strFormElement . ']';
                            $strValue = $strModule . '::' . $strForm . '->' . $strPrepareElements . '=>' . $strFormElement;
                            $strPrepareElements = str_replace('prepareElements', '', $strPrepareElements);
                            $strType = reset($arrExplode = explode(' -> ', $strFormElement));
                            $strFormElementEd = str_replace(array(' =>', '=> ', '"name"'), array('=>', '=>', '\'name\''), $strFormElement);
                            $strFormElementEd = str_replace(array('"', '\'', ','), '', reset($arrExplode = explode(' ', end($arrExplode = explode('\'name\'=>', $strFormElementEd)))));
                            $strSgAcao = strtoupper(Permission::CONST_KEY_PREFIXO_RESOURCE_FORM_ELEMENT . end($arrExplode = explode('\\', $strForm)) . $strPrepareElements . '_' . $strType . '_' . $strFormElementEd);
                            $strChecked = '';
                            $strActionResource = '';
                            if (is_array($arrTreePost)) {
                                foreach ($arrTreePost as $strSgAcaoRegister => $acao) {
                                    if (strpos($strSgAcaoRegister, $strSgAcao) !== false) {
                                        $strChecked = ' checked="checked"';
                                        $strActionResource = strtolower(str_replace(array($strSgAcao, '_'), array('', ''), $strSgAcaoRegister));
                                        break;
                                    }
                                }
                            }
                            $strRender .= '<div class="caixaVazada" style="padding: 5px; margin-bottom: 10px;"><input type="checkbox" name="' . $strName . '" id="' . $strName . '" value="' . $strValue . '"' . $strChecked . ' /><label for="' . $strName . '" style="font-weight: normal;">' . $intCount . '. ' . reset($arrExplode = explode(' -> ', $strFormElement)) . '</label><select name="' . $strNameSelect . '" id="' . $strNameSelect . '">';
                            foreach ($this->fetchPairsActionToResourceNotAllowedToXmlJson() as $arrInfo) {
                                $strSelected = ($strActionResource == $arrInfo['value']) ? ' selected="selected"' : '';
                                $strRender .= '<option value="' . $arrInfo['value'] . '" title="' . $arrInfo['text'] . '"' . $strSelected . '>' . $arrInfo['text'] . '</option>';
                            }
                            $strRender .= '</select><pre class="prettyprint"><code class="hljs xml">' . end($arrExplode = explode(' -> ', $strFormElement)) . '</code></pre></div>';
                        }
        }
        $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args()), array($arrTreePost), array($strRender)));
        return $strRender;
    }

    private function convertFormElement($arrFormElement = null)
    {
        $arrFormElementConvert = array();
        foreach ((array) $arrFormElement as $arrInfo) {
            $strInfo = '';
            if (array_key_exists('form', $arrInfo['info']))
                $strInfo .= $arrInfo['info']['form'];
            if (array_key_exists('prepare_elements', $arrInfo['info'])) {
                if (!empty($strInfo))
                    $strInfo .= '->';
                $strPrepareElements = $arrInfo['info']['prepare_elements'];
                if (strpos($strPrepareElements, '-') !== false)
                    $strPrepareElements = lcfirst(String::camelize($strPrepareElements));
                $strInfo .= $strPrepareElements;
            }
            $arrFormElementConvert[] = $strInfo;
        }
        return $arrFormElementConvert;
    }

}
