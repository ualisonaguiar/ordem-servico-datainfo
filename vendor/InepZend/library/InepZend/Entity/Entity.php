<?php

namespace InepZend\Entity;

use InepZend\Configurator\Configurator;
use InepZend\Util\DebugExec;
use InepZend\Util\Date;
use InepZend\Util\Reflection;
use InepZend\Util\Format;
use InepZend\Util\String;

class Entity
{

    use DebugExec;

    const DEBUG = false;

    public function __construct($mixOptions = null)
    {
        if (!empty($mixOptions))
            Configurator::configure($this, $mixOptions);
    }

    public function getAttribute($strAttribute = null, $strType = null)
    {
        if ((empty($strAttribute)) || (!property_exists($this, $strAttribute)))
            return;
        $mixValue = null;
        if (empty($strType))
            $strType = $this->getTypeFromAttributeName($strAttribute);
        $strType = trim(strtolower((string) $strType));
        $this->debugExec($strAttribute);
        $this->debugExec($strType);
        switch ($strType) {
            case 'date':
            case 'datetime':
                $mixValue = Date::convertDate($this->$strAttribute, ($strType == 'date') ? 'd/m/Y' : 'd/m/Y H:i:s');
                break;
            case 'array':
            case 'arraycollection':
                $mixValue = (empty($this->$strAttribute)) ? $this->$strAttribute : $this->$strAttribute->toArray();
                break;
            default:
                $mixValue = $this->$strAttribute;
                break;
        }
        $this->debugExec($mixValue);
        return $mixValue;
    }

    public function setAttribute($strAttribute = null, $mixValue = null, $strType = null)
    {
        if ((!empty($strAttribute)) && (property_exists($this, $strAttribute))) {
            if (empty($strType))
                $strType = $this->getTypeFromAttributeName($strAttribute);
            $strType = trim(strtolower((string) $strType));
            $this->debugExec($strAttribute);
            $this->debugExec($strType);
            switch (strtolower($strType)) {
                case 'integer':
                    $this->$strAttribute = (is_numeric($mixValue)) ? (integer) $mixValue : $mixValue;
                    break;
                case 'indicator':
                    $this->$strAttribute = $this->convertToIndicator($mixValue);
                    break;
                default:
                    $this->$strAttribute = $mixValue;
                    break;
            }
            $this->debugExec($mixValue);
        }
        return $this;
    }

    public function __toString()
    {
        $arrResult = array();
        $strAnnotationName = '__TOSTRING';
        $arrAnnotationValue = array(null, '1', 'true', 'yes', 'sim');
        $arrMethod = (strpos(get_class($this), 'DoctrineORMModule') === false) ? Reflection::listMethodsFromClass($this, true) : array();
        $this->debugExec($arrMethod);
        foreach ($arrMethod as $strMethod) {
            if (strpos($strMethod, 'get') === 0) {
                $this->debugExec($strMethod);
                $arrAnnotation = Reflection::listAnnotationsFromMethod($this, $strMethod);
                $this->debugExec($arrAnnotation);
                $booToString = false;
                if ((is_array($arrAnnotation)) && (array_key_exists($strAnnotationName, $arrAnnotation)))
                    $booToString = (in_array(strtolower($arrAnnotation[$strAnnotationName]), $arrAnnotationValue));
                $this->debugExec($booToString);
                if ($booToString)
                    $arrResult[] = $this->$strMethod();
            }
        }
        $this->debugExec($arrResult);
        if (count($arrResult) == 0) {
            $arrAttribute = Reflection::listAttributesFromClass($this);
            $this->debugExec($arrAttribute);
            foreach ($arrAttribute as $strAttribute => $mixValue) {
                $this->debugExec($strAttribute);
                $arrAnnotation = Reflection::listAnnotationsFromAttribute($this, $strAttribute);
                $this->debugExec($arrAnnotation);
                $booToString = false;
                if ((is_array($arrAnnotation)) && (array_key_exists('@' . $strAnnotationName, $arrAnnotation)))
                    $booToString = (in_array(strtolower($arrAnnotation['@' . $strAnnotationName]), $arrAnnotationValue));
                $this->debugExec($booToString);
                if ($booToString)
                    $arrResult[] = $this->$strAttribute;
            }
            $this->debugExec($arrResult);
        }
        return (string) implode(' ', $arrResult);
    }

    public function toArray(array $arrAttributeNotIn = array(), $mixEntity = null, $intDeep = 0, $intMaxDeep = 1)
    {
        if (($intDeep == 0) && (is_null($mixEntity)))
            $mixEntity = $this;
        if ((!is_object($mixEntity)) && (!is_array($mixEntity)))
            return $mixEntity;
        ++$intDeep;
        if ($intDeep > $intMaxDeep)
            return;
        $this->debugExec($mixEntity);
        $this->debugExec($intDeep);
        $this->debugExec($intMaxDeep);
        $this->debugExec($arrAttributeNotIn);
        $arrEntity = array();
        if (is_object($mixEntity)) {
            if (!$mixEntity instanceof Entity)
                return;
            $arrAttribute = Reflection::listAttributesFromClass($mixEntity);
            foreach ($arrAttribute as $strAttribute => $mixValue) {
                if (in_array($strAttribute, $arrAttributeNotIn))
                    continue;
                $strGetter = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $strAttribute)));
                $this->debugExec($strAttribute);
                $this->debugExec($strGetter);
                if (!method_exists($mixEntity, $strGetter))
                    continue;
                $mixValueGetter = $mixEntity->$strGetter();
                if ((!is_object($mixValueGetter)) && (!is_array($mixValueGetter)))
                    $arrEntity[$strAttribute] = $mixValueGetter;
                else
                    $arrEntity[$strAttribute] = self::toArray($arrAttributeNotIn, $mixValueGetter, $intDeep, $intMaxDeep);
            }
        } else {
            foreach ($mixEntity as $mixKey => $mixValue) {
                if (in_array($mixKey, $arrAttributeNotIn))
                    continue;
                if ((!is_object($mixValue)) && (!is_array($mixValue)))
                    $arrEntity[$mixKey] = $mixValue;
                else
                    $arrEntity[$mixKey] = self::toArray($arrAttributeNotIn, $mixValue, $intDeep, $intMaxDeep);
            }
        }
        $this->debugExec($arrEntity);
        return $arrEntity;
    }

    private function getTypeFromAttributeName($strAttribute = null, $strConcat = '_')
    {
        if (empty($strAttribute))
            return;
        $mixPos = strpos($strAttribute, $strConcat);
        if ($mixPos === false)
            return;
        $strPrefix = substr($strAttribute, 0, $mixPos);
        $arrType = array(
            'in' => 'indicator',
            'co' => 'code',
            'dt' => 'date',
            'hr' => 'hour',
            'ds' => 'description',
            'tx' => 'text',
            'id' => 'identifier',
            'md' => 'midia',
            'nu' => 'integer',
            'qt' => 'amount',
            'vl' => 'value',
            'no' => 'name',
            'tp' => 'type',
            'pc' => 'percent',
        );
        return ((array_key_exists($strPrefix, $arrType)) ? $arrType[$strPrefix] : null);
    }

    public function convertToIndicator($mixValue = null)
    {
        return Format::convertToIndicator($mixValue);
    }

    public function __call($strFunction, $arrArgument)
    {
        if (strpos($strFunction, 'get') === 0)
            return $this->getAttribute(trim(strtolower(substr(String::dasherize(substr($strFunction, 3)), 1))));
        elseif ((strpos($strFunction, 'set') === 0) && (count($arrArgument) > 0))
            return $this->setAttribute(trim(strtolower(substr(String::dasherize(substr($strFunction, 3)), 1))), $arrArgument[0]);
    }

}
