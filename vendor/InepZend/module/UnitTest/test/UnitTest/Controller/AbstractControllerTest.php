<?php

namespace InepZend\Module\UnitTest\Controller;

use InepZend\UnitTest\AbstractRouteUnitTest;
use InepZend\Util\Format;
use Zend\Json\Decoder;

abstract class AbstractControllerTest extends AbstractRouteUnitTest
{

    public function __construct()
    {
        $this->setLogin('09723347776');
        $this->setPassword('Vctr0005@');
        parent::__construct('InepZend\Module\UnitTest\Controller\IndexController');
    }

    protected function createAllDataProvider()
    {
        return array();
    }

    protected function evalCheckAssert($strEval = null, $mixAssertValue = null, $strAssertMethod = null, $arrOrderParam = null, $arrParamRoute = null)
    {
        $this->execIntoController($strEval, $arrParamRoute);
        $strAssertMethod = (empty($strAssertMethod)) ? 'assertSame' : $strAssertMethod;
        if (empty($arrOrderParam))
            $arrOrderParam = array('result', 'value');
        return $this->execAssert($strAssertMethod, $this->editDispatchResult($arrOrderParam, $mixAssertValue));
    }

    protected function execIntoController($strEval = null, $arrParamRoute = null)
    {
        return $this->checkActionCanBeAccessed($this->getControllerNamespace(), 'index', $arrParamRoute, $this->serialize($strEval), true, true, false);
    }

    private function execAssert($strAssertMethod, $arrOrderParam)
    {
        $arrArgument = array();
        foreach ((array) $arrOrderParam as $intKey => $mixParam)
            $arrArgument[] = '$arrOrderParam[' . $intKey . ']';
        eval('$mixResult = $this->' . $strAssertMethod . '(' . implode(', ', $arrArgument) . ');');
        return $mixResult;
    }

    private function serialize($strEval)
    {
        return array('eval' =>
            'try {
                echo @serialize(' . $strEval . ');
            } catch (\Exception $exception) {
                $mixResult = ' . $strEval . ';
                if (is_object($mixResult))
                    echo @serialize(\Zend\Json\Encoder::encode($mixResult, true, array(\'silenceCyclicalExceptions\' => true)));
                else
                    echo $mixResult;
            }'
        );
    }

    private function editDispatchResult($arrOrderParam, $mixAssertValue)
    {
        foreach ($arrOrderParam as $intKey => $strTypeParam) {
            if (!in_array($strTypeParam, array('result', 'value')))
                continue;
            $arrOrderParam[$intKey] = ($strTypeParam == 'result') ? unserialize($this->getControllerInstance()->getDispatchResult()) : $mixAssertValue;
            if (Format::isJson($arrOrderParam[$intKey])) {
                $arrOrderParam[$intKey] = Decoder::decode($arrOrderParam[$intKey]);
                $strAttribute = '__className';
                $strClass = $arrOrderParam[$intKey]->$strAttribute;
                $arrClassInstance = array('InepZend\View\View');
                if ((is_object($arrOrderParam[$intKey])) && ($arrOrderParam[$intKey] instanceof \stdClass) && (in_array($strClass, $arrClassInstance))) {
                    try {
                        $arrOrderParam[$intKey] = new $strClass();
                    } catch (\Exception $exception) {
                        
                    }
                }
            }
        }
        return $arrOrderParam;
    }

}
