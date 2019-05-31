<?php

namespace InepZend\Module\Ssi\Service;

use InepZend\Module\Ssi\Service\AbstractService;
use InepZend\Permission\Permission;
use InepZend\Util\stdClass;
use InepZend\Util\Reflection;
use InepZend\Util\String;
use InepZend\Module\Ssi\Entity\VwPerfilAcao;

class AcaoAclRoute extends AbstractService
{

    public function findBy($arrCriteria = null, $booId = null)
    {
        return parent::findBy(array_merge((array) $arrCriteria, array('sg_acao' => Permission::CONST_KEY_PREFIXO_RESOURCE)), $booId);
    }

    /**
     * 
     * @param array $arrCriteria
     * @param array $arrRouteConfig
     * @param integer $intDeep
     * @return array
     * 
     * @cache true
     */
    protected function findByRoute($arrCriteria = null, $arrRouteConfig = null, $intDeep = 0)
    {
        $arrRoute = array();
        if (is_null($arrRouteConfig))
            $arrRouteConfig = (array) @$this->getService('Config')['router']['routes'];
        $arrReflection = array();
        foreach ($arrRouteConfig as $strIndex => $arrInfo) {
            if ((strpos($strIndex, 'doctrine') === 0 ) || (!array_key_exists('options', $arrInfo) ) || (!array_key_exists('route', $arrInfo['options'])))
                continue;
            $arrDefault = (array) @$arrInfo['options']['defaults'];
            if (array_key_exists('__NAMESPACE__', $arrDefault)) {
                $arrDefault['controller'] = $arrDefault['__NAMESPACE__'];
                unset($arrDefault['__NAMESPACE__']);
            }
            $strModule = reset($arrExplode = explode('\Controller\\', @$arrDefault['controller']));
            if (strpos($strModule, 'InepZend') !== false)
                continue;
            $strControllerNamespace = @$arrDefault['controller'];
            if (!class_exists($strControllerNamespace))
                $strControllerNamespace .= 'Controller';
            if (!class_exists($strControllerNamespace))
                continue;
            $strController = end($arrExplode = explode('\Controller\\', @$arrDefault['controller']));
            $strAction = @$arrDefault['action'] . 'Action';
            $strRoute = $arrInfo['options']['route'];
            $booReflection = ((stripos(@$arrInfo['type'], 'segment') !== false) && (stripos($strRoute, '/:action') !== false) && (stripos($strRoute, '/:controller') === false) && (@$arrReflection[$strIndex . $strControllerNamespace] !== true));
            $arrAction = array();
            $booExistsActionCriteria = false;
            if ($booReflection) {
                $arrAction = Reflection::listMethodsFromClass($strControllerNamespace, false, null, false, false);
                foreach ($arrAction as $intKey => $strActionReflection) {
                    if ((strpos($strActionReflection, 'Action') === false) || (in_array($strActionReflection, array('notFoundAction', 'getMethodFromAction'))))
                        unset($arrAction[$intKey]);
                }
                $arrAction = array_values($arrAction);
                $booExistsActionReflection = false;
            }
            if (is_array($arrCriteria)) {
                if ((array_key_exists('ds_module', $arrCriteria) ) && (!empty($arrCriteria['ds_module']) ) && ($arrCriteria['ds_module'] != $strModule))
                    continue;
                if ((array_key_exists('ds_controller', $arrCriteria) ) && (!empty($arrCriteria['ds_controller']))) {
                    $strModuleCriteria = reset($arrExplode = explode('::', $arrCriteria['ds_controller']));
                    $strControllerCriteria = end($arrExplode = explode('::', $arrCriteria['ds_controller']));
                    if (($strModuleCriteria != $strModule ) || ($strControllerCriteria != $strController))
                        continue;
                }
                if ((array_key_exists('ds_action', $arrCriteria) ) && (!empty($arrCriteria['ds_action']))) {
                    $strModuleCriteria = reset($arrExplode = explode('::', $arrCriteria['ds_action']));
                    $strControllerCriteria = reset($arrExplode = explode('->', end($arrExplode = explode('::', $arrCriteria['ds_action']))));
                    $strActionCriteria = end($arrExplode = explode('->', end($arrExplode = explode('::', $arrCriteria['ds_action']))));
                    if (($strModuleCriteria != $strModule ) || ($strControllerCriteria != $strController ))
                        continue;
                    if ($strActionCriteria != $strAction) {
                        if ($booReflection) {
                            foreach ($arrAction as $intKey => $strActionReflection) {
                                if ($strActionCriteria == $strActionReflection)
                                    $booExistsActionReflection = true;
                                else
                                    unset($arrAction[$intKey]);
                            }
                            if (!$booExistsActionReflection)
                                continue;
                        } else
                            continue;
                    } else
                        $booExistsActionCriteria = true;
                }
            }
            if ($booReflection) {
                $intCountAction = 0;
                foreach ($arrAction as $strActionReflection) {
                    if (($booExistsActionCriteria) && ($strActionReflection != $strActionCriteria))
                        continue;
                    $arrRoute[] = array('ds_index' => $strIndex . $intCountAction, 'ds_route' => str_replace('Action', '', str_replace(array('[/:action]', '/:action'), '/' . $strActionReflection, $strRoute)), 'info' => array_merge($arrDefault, array('action' => str_replace('Action', '', $strActionReflection))));
                    ++$intCountAction;
                }
                $arrReflection[$strIndex . $strControllerNamespace] = true;
                if ($booExistsActionReflection)
                    continue;
            }
            $arrRoute[] = array('ds_index' => $strIndex, 'ds_route' => $strRoute, 'info' => $arrDefault);
            if (array_key_exists('child_routes', $arrInfo))
                $arrRoute = array_merge($arrRoute, $this->findByRoute($arrCriteria, $arrInfo['child_routes'], ($intDeep + 1)));
        }
        $arrRoute = array_values($arrRoute);
        if (empty($intDeep))
            $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args()), array($arrRouteConfig), array($arrRoute)));
        return $arrRoute;
    }

    protected function fetchPairsControllerToXmlJson(array $arrCriteria = null)
    {
        $arrRegister = array();
        $arrTree = $this->getTree($arrCriteria);
        foreach ($arrTree as $strModule => $arrController)
            foreach ($arrController as $strController => $arrAction)
                $arrRegister[$strController] = array('value' => $strModule . '::' . $strController, 'text' => $strController);
        ksort($arrRegister);
        return array_values($arrRegister);
    }

    protected function fetchPairsActionToXmlJson(array $arrCriteria = null)
    {
        $arrRegister = array();
        $arrTree = $this->getTree($arrCriteria);
        foreach ($arrTree as $strModule => $arrController)
            foreach ($arrController as $strController => $arrAction)
                foreach ($arrAction as $strAction => $arrRoute)
                    $arrRegister[$strAction] = array('value' => $strModule . '::' . $strController . '->' . $strAction, 'text' => $strAction);
        ksort($arrRegister);
        return array_values($arrRegister);
    }

    protected function fetchPairsRouteToXmlJson(array $arrCriteria = null)
    {
        $arrRegister = array();
        $arrTree = $this->getTree($arrCriteria);
        foreach ($arrTree as $strModule => $arrController)
            foreach ($arrController as $strController => $arrAction)
                foreach ($arrAction as $strAction => $arrRoute)
                    foreach ($arrRoute as $strRoute)
                        $arrRegister[$strRoute] = array('value' => $strModule . '::' . $strController . '->' . $strAction . '=>' . $strRoute, 'text' => $strRoute);
        ksort($arrRegister);
        return array_values($arrRegister);
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
        $arrRouteConvert = $this->convertRoute($this->findByRoute($arrCriteria));
        $arrTree = array();
        foreach ($arrRouteConvert as $strRoute => $strInfo) {
            $arrInfo = explode('\Controller\\', $strInfo);
            if (count($arrInfo) != 2)
                continue;
            $strModule = reset($arrInfo);
            $arrControllerAction = explode('->', end($arrInfo));
            $strController = reset($arrControllerAction);
            $strAction = end($arrControllerAction);
            $arrTree[$strModule][$strController][$strAction][] = $strRoute;
        }
        ksort($arrTree);
        $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args()), array($arrRouteConvert), array($arrTree)));
        return $arrTree;
    }

    protected function renderTree($arrTree = null, $arrData = null, $intDeep = 0, $booIcon = true)
    {
        if (empty($arrTree))
            $arrTree = $this->getTree();
        $arrRegister = $this->findBy();
        $strTree = '<div class="divTree">';
        foreach ($arrTree as $strModule => $arrController) {
            $intDeep = 0;
            $strTree .= '<div class="divTreeItem divTreeItem' . $intDeep . '" data-level="' . $intDeep . '" title="' . $strModule . '">' . $strModule . '</div>';
            foreach ($arrController as $strController => $arrAction) {
                $intDeep = 1;
                $strTree .= '<div class="divTreeItem divTreeItem' . $intDeep . '" data-level="' . $intDeep . '" title="' . $strController . '">' . $strController . '</div>';
                foreach ($arrAction as $strAction => $arrRoute) {
                    $intDeep = 2;
                    $strTree .= '<div class="divTreeItem divTreeItem' . $intDeep . '" data-level="' . $intDeep . '" title="' . $strAction . '">' . $strAction . '</div>';
                    foreach ($arrRoute as $strRoute) {
                        $intDeep = 3;
                        $strColor = 'red';
                        $strSgAcao = strtoupper(Permission::CONST_KEY_PREFIXO_RESOURCE . $strController . '_' . str_replace('Action', '', $strAction));
                        foreach ($arrRegister as $acao) {
                            if ($acao->sg_acao == $strSgAcao) {
                                $strColor = 'blue';
                                break;
                            }
                        }
                        $strTree .= '<div class="divTreeItem divTreeItem' . $intDeep . '" data-level="' . $intDeep . '" title="' . $strRoute . '"><i class="fa fa-arrow-circle-o-right" style="color: ' . $strColor . ';"></i> ' . $strRoute . '</div>';
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
        if (!array_key_exists('ds_route', $arrData)) {
            if (!empty($arrData['ds_action'])) {
                $strController = end($arrExplode = explode('::', reset($arrExplode = explode('->', $arrData['ds_action']))));
                $strAction = str_replace('Action', '', end($arrExplode = explode('->', $arrData['ds_action'])));
                $strSgAcao = strtoupper(Permission::CONST_KEY_PREFIXO_RESOURCE . $strController . '_' . $strAction);
                unset($arrTree[$strSgAcao]);
            }
        } else {
            foreach ((array) $arrData['ds_route'] as $strRoute => $strInfo) {
                $strController = end($arrExplode = explode('::', reset($arrExplode = explode('->', $strInfo))));
                $strAction = str_replace('Action', '', reset($arrExplode = explode('=>', end($arrExplode = explode('->', $strInfo)))));
                $strSgAcao = strtoupper(Permission::CONST_KEY_PREFIXO_RESOURCE . $strController . '_' . $strAction);
                $strNoAcao = 'Acesso à ' . $strInfo;
                $arrTree[$strSgAcao] = new stdClass(array('no_acao' => $strNoAcao, 'sg_acao' => $strSgAcao, 'ds_acao' => $strNoAcao));
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
            $arrActioProfile = $this->getService('InepZend\Module\Ssi\Service\VwPerfilAcao')
                    ->findBy(
                    array(
                        'idSistema' => $this->getIdSystem(),
                        'inAtivoPerfilAcao' => true,
                        'tpAcao' => VwPerfilAcao::TP_ACAO_TELA
                    )
            );
            foreach ($arrAcao as $acao) {
                foreach ($arrActioProfile as $actioProfile)
                    if ($acao->sg_acao == $actioProfile->getSgAcao())
                        $acao->no_perfil = $actioProfile->getNoPerfil();
                $arrTree[$acao->sg_acao] = $acao;
            }
            ksort($arrTree);
        } else {
            $arrTreeMerge = array();
            foreach ((array) $arrData['ds_route'] as $strRoute => $strInfo) {
                $strController = end($arrExplode = explode('::', reset($arrExplode = explode('->', $strInfo))));
                $strAction = str_replace('Action', '', reset($arrExplode = explode('=>', end($arrExplode = explode('->', $strInfo)))));
                $strSgAcao = strtoupper(Permission::CONST_KEY_PREFIXO_RESOURCE . $strController . '_' . $strAction);
                $strNoAcao = 'Acesso à ' . $strInfo;
                $arrTreeMerge[$strSgAcao] = new stdClass(array('no_acao' => $strNoAcao, 'sg_acao' => $strSgAcao, 'ds_acao' => $strNoAcao, 'no_perfil' => $arrData['no_perfil']));
            }
            $arrTree = array_merge($arrTree, $arrTreeMerge);
        }
        $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args())));
        return parent::convertTreeToFormat($arrTree);
    }

    protected function renderForm($arrTree = null, $arrData = null)
    {
        $arrTreePost = array();
        $strRender = '<label class="block">Rotas de navegação da Action<small class="required" style="margin-left: 4px;" aria-label="Campo requerido"><div class="clearfix"></div>*</small></label>';
        if (count($arrTree) == 0)
            $strRender .= '<font style="color: red;">Rota não encontrada</font>';
        else {
            if (!array_key_exists('ds_route', $arrData))
                $arrData['ds_route'] = array();
            $arrTreePost = $this->convertPostToTree($arrData);
            foreach ($arrTree as $strModule => $arrController)
                foreach ($arrController as $strController => $arrAction)
                    foreach ($arrAction as $strAction => $arrRoute)
                        foreach ($arrRoute as $strRoute) {
                            $strName = 'ds_route[' . $strRoute . ']';
                            $strValue = $strModule . '::' . $strController . '->' . $strAction . '=>' . $strRoute;
                            $strSgAcao = strtoupper(Permission::CONST_KEY_PREFIXO_RESOURCE . $strController . '_' . str_replace('Action', '', $strAction));
                            $strChecked = ((is_array($arrTreePost)) && (array_key_exists($strSgAcao, $arrTreePost))) ? ' checked="checked"' : '';
                            $strRender .= '<input type="checkbox" name="' . $strName . '" id="' . $strName . '" value="' . $strValue . '"' . $strChecked . ' /> <label for="' . $strName . '" style="font-weight: normal;">' . $strRoute . '</label><br />';
                        }
        }
        $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args()), array($arrTreePost), array($strRender)));
        return $strRender;
    }

    /**
     * 
     * @param type $dataInfoSsi
     * @param type $domXmlAcronym
     * @param type $xmlRoot
     * @return type
     */
    protected function mountInfoSsiXml($dataInfoSsi, $domXmlAcronym, &$xmlRoot)
    {
        $arrActionProfile = array();
        foreach ($dataInfoSsi as $infoSsi)
            $arrActionProfile[$infoSsi->no_perfil][] = $infoSsi->no_acao;
        foreach ($arrActionProfile as $strProfile => $arrInfoAcronym) {
            $xmlInfoProfile = $domXmlAcronym->createElement('perfil');
            $xmlInfoProfile->appendChild($domXmlAcronym->createElement('nome', $strProfile));
            $xmlInfoProfile->appendChild($domXmlAcronym->createElement('descricao', 'Perfil ' . $strProfile));
            $xmlInfoAcronym = $domXmlAcronym->createElement('acoesVinculadas');
            foreach ($arrInfoAcronym as $strAcronym)
                $xmlInfoAcronym->appendChild($domXmlAcronym->createElement('nome', $strAcronym));
            $xmlInfoProfile->appendChild($xmlInfoAcronym);
            $xmlRoot->appendChild($xmlInfoProfile);
        }
    }

    private function convertRoute($arrRoute = null)
    {
        $arrRouteConvert = array();
        foreach ((array) $arrRoute as $arrInfo) {
            $strRoute = '';
            if (strlen($arrInfo['ds_route']) > 1)
                $strRoute = substr($arrInfo['ds_route'], 1);
            $strRoute = reset($arrExplode = explode('[', reset($arrExplode = explode(':', $strRoute))));
            if (empty($strRoute))
                continue;
            $strInfo = '';
            if (array_key_exists('controller', $arrInfo['info']))
                $strInfo .= $arrInfo['info']['controller'];
            if (array_key_exists('action', $arrInfo['info'])) {
                if (!empty($strInfo))
                    $strInfo .= '->';
                $strAction = $arrInfo['info']['action'];
                if (strpos($strAction, '-') !== false)
                    $strAction = lcfirst(String::camelize($strAction));
                $strInfo .= $strAction . 'Action';
            }
            if ($strRoute{(strlen($strRoute) - 1 ) } == '/')
                $strRoute = substr($strRoute, 0, (strlen($strRoute) - 1));
            if (empty($strRoute))
                continue;
            $arrRouteConvert[$strRoute . '-' . $strAction] = $strInfo;
        }
        return $arrRouteConvert;
    }

}
