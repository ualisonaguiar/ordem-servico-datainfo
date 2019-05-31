<?php

namespace InepZend\Util;

use InepZend\Util\FileSystem;

/**
 * Classe responsavel em utilizar reflexao.
 *
 * @package InepZend
 * @subpackage Util
 */
class Reflection
{

    /**
     *
     * @var array
     */
    private static $arrReflectionClass = array();

    /**
     * Metodo responsavel em retornar a reflexao de uma determinada classe a 
     * partir do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Reflection::getReflectionClass($mixEntity);
     *
     * @param mix $mixEntity
     * @param boolean $booSingleton
     * @return mix
     *
     * @assert ('ConsultaPublica\Controller\IndexController') == (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))
     * @assert ('ConsultaPublica\Controller\IndexController', true) == (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))
     * @assert ('ConsultaPublica\Controller\IndexController', false) == (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))
     * @assert (array('ConsultaPublica\Controller\IndexController'), false) !== (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))
     * @assert (new \ConsultaPublica\Controller\IndexController()) == (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))
     * @assert (array('key')) == false
     */
    public static function getReflectionClass($mixEntity, $booSingleton = true)
    {
        if ((empty($mixEntity)) || (is_null($mixEntity)))
            return false;
        if (is_string($mixEntity))
            $strClass = $mixEntity;
        elseif (is_object($mixEntity))
            $strClass = get_class($mixEntity);
        else
            return false;
        if ($booSingleton === false)
            return new \ReflectionClass($strClass);
        else {
            if (!array_key_exists($strClass, self::$arrReflectionClass))
                self::$arrReflectionClass[$strClass] = new \ReflectionClass($strClass);
            return self::$arrReflectionClass[$strClass];
        }
    }

    /**
     * Metodo responsavel em listar todos os atributos de uma clase usando 
     * reflexao a partir do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Reflection::listAttributesFromClass($mixEntity);
     *
     * @param mix $mixEntity (pode ser o nome da classe ou um objeto da mesma)
     * @return mix
     *
     * @assert ('ConsultaPublica\Controller\IndexController') == (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties()
     * @assert ('ConsultaPublica\Controller\IndexController') == (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties()
     * @assert ('ConsultaPublica\Controller\IndexController') == (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties()
     * @assert (array('ConsultaPublica\Controller\IndexController')) !== (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties()
     * @assert (new \ConsultaPublica\Controller\IndexController()) == (new \ReflectionClass('ConsultaPublica\Controller\IndexController'))->getDefaultProperties()
     * @assert (array('key' => 'value')) == null
     */
    public static function listAttributesFromClass($mixEntity)
    {
        $class = self::getReflectionClass($mixEntity);
        return (is_object($class)) ? $class->getDefaultProperties() : null;
    }

    /**
     * Metodo responsavel em listar todos as constantes de uma classe usando 
     * reflexao caso a mesma a(s) tenha(m) a partir do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Reflection::listConstantsFromClass($mixEntity, $strConstant);
     *
     * @param mix $mixEntity
     * @param string $strConstant
     * @return mix
     *
     * @assert ('\InepZend\Util\Date') == array('TYPE_DATE_BASE' => 'base', 'TYPE_DATE_TEMPLATE' => 'template', 'TYPE_DATE_WS' => 'ws')
     * @assert ('\InepZend\Util\Date', 'TYPE_DATE_BASE') == 'base'
     * @assert (new \InepZend\Util\Date(), 'TYPE_DATE_BASE') == (new \ReflectionClass('\InepZend\Util\Date'))->getConstant('TYPE_DATE_BASE')
     * @assert (new \InepZend\Util\Date()) == (new \ReflectionClass('\InepZend\Util\Date'))->getConstants()
     */
    public static function listConstantsFromClass($mixEntity, $strConstant = null)
    {
        $class = self::getReflectionClass($mixEntity);
        if (!is_object($class))
            return false;
        return ((is_null($strConstant)) || (empty($strConstant))) ? $class->getConstants() : $class->getConstant($strConstant);
    }

    /**
     * Metodo responsavel em listar todo(s) o(s) objeto(s) de metodo(s) de uma 
     * classe usando reflexao a partir do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Reflection::listMethods($mixEntity, $strMethod);
     *
     * @param mix $mixEntity
     * @param string $strMethod
     * @return mix
     *
     * @assert ('\InepZend\Util\Date') == (new \ReflectionClass('\InepZend\Util\Date'))->getMethods()
     * @assert (new \InepZend\Util\Date()) == (new \ReflectionClass('\InepZend\Util\Date'))->getMethods()
     * @assert ('\InepZend\Util\Date', 'isDateBase') == (new \ReflectionClass('\InepZend\Util\Date'))->getMethod('isDateBase')
     * @assert (array('key' => 'value')) == false
     */
    public static function listMethods($mixEntity, $strMethod = null)
    {
        $class = self::getReflectionClass($mixEntity);
        if (!is_object($class))
            return false;
        return ((is_null($strMethod)) || (empty($strMethod))) ? $class->getMethods() : $class->getMethod($strMethod);
    }

    /**
     * Metodo responsavel em listar todo(s) o(s) metodo(s) de uma classe usando 
     * reflexao a partir do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Reflection::listMethodsFromClass($mixEntity, $booRemoveMethodsFromParent, $strMethod);
     *
     * @param mix $mixEntity
     * @param string $booRemoveMethodsFromParent
     * @param string $strMethod
     * @param string $booRemoveMethodsFromTrait
     * @param string $booRemoveMethodsWithoutReturn
     * @return mix
     *
     * @assert ('\InepZend\Util\ApplicationInfo') == array('getApplicationInfo', 'getNameEdited', 'getServerInstance', 'getInepZendVersion', 'getRevision', 'getInepZendLastVersion', 'getThemeType', 'getTheme', 'getThemeLayout', 'getThemeFromLayout')
     * @assert ('\InepZend\Util\ApplicationInfo', true) == array('getApplicationInfo', 'getNameEdited', 'getServerInstance', 'getInepZendVersion', 'getRevision', 'getInepZendLastVersion', 'getThemeType', 'getTheme', 'getThemeLayout', 'getThemeFromLayout')
     * @assert ('\InepZend\Util\ApplicationInfo', true, 'getApplicationInfo') == (new \ReflectionClass('\InepZend\Util\ApplicationInfo'))->getMethod('getApplicationInfo')->name
     * @assert ('\InepZend\Util\ApplicationInfo', true, 'getApplicationInfo') == 'getApplicationInfo'
     */
    public static function listMethodsFromClass($mixEntity, $booRemoveMethodsFromParent = false, $strMethod = null, $booRemoveMethodsFromTrait = false, $booRemoveMethodsWithoutReturn = false)
    {
        $reflection = self::getReflectionClass($mixEntity);
        if (!is_object($reflection))
            return false;
        if ($booRemoveMethodsFromTrait === true) {
            $arrMethodTrait = array();
            foreach ($reflection->getTraits() as $reflectionTrait) {
                foreach ($reflectionTrait->getMethods() as $reflectionMethod) {
//                    $arrMethodTrait[] = $reflectionMethod->class . '::' . $reflectionMethod->name;
                    $arrMethodTrait[] = $reflectionMethod->name;
                }
            }
        }
        $arrMethod = array();
        foreach ($reflection->getMethods() as $reflectionMethod) {
            if (($booRemoveMethodsFromTrait === true) && (in_array($reflectionMethod->name, $arrMethodTrait)))
                continue;
            $arrMethod[] = $reflectionMethod->class . '::' . $reflectionMethod->name;
        }
        if (($booRemoveMethodsFromParent === true) || ($booRemoveMethodsWithoutReturn === true)) {
            $arrMethod = array_values($arrMethod);
            foreach ($arrMethod as $intKey => $strMethodIntern) {
                $arrMethodIntern = explode('::', $strMethodIntern);
                if (($booRemoveMethodsFromParent === true) && ($arrMethodIntern[0] != $reflection->name)) {
                    unset($arrMethod[$intKey]);
                    continue;
                }
                $strContent = self::getMethodContent($arrMethodIntern[0], $arrMethodIntern[1]);
                if (($booRemoveMethodsWithoutReturn === true) && (stripos($strContent, 'return') === false)) {
                    unset($arrMethod[$intKey]);
                    continue;
                }
            }
        }
        foreach ($arrMethod as &$strMethodIntern)
            $strMethodIntern = end($arrExplode = explode('::', $strMethodIntern));
        if (empty($strMethod))
            return array_values($arrMethod);
        foreach ($arrMethod as $strMethodIntern)
            if (trim(strtolower($strMethodIntern)) == trim(strtolower($strMethod)))
                return $strMethodIntern;
        return;
    }

    /**
     * Metodo responsavel em retornar o conteudo do metodo (assinatura e corpo).
     *
     * @example \InepZend\Util\Reflection::getMethodContent($strClass, $strMethod);
     *
     * @param string $strClass
     * @param string $strMethod
     * @return mix
     *
     * @TODO implementar asserts
     */
    public static function getMethodContent($strClass = null, $strMethod = null)
    {
        if ((empty($strClass)) || (!class_exists($strClass)) || (empty($strMethod)))
            return false;
        if (!is_object($method = self::listMethods($strClass, $strMethod)))
            return false;
        $strContent = '';
        $arrContent = file($method->getFileName());
        $intCount = $method->getStartLine();
        if ($intCount > 0)
            --$intCount;
        while ($intCount < $method->getEndLine()) {
            $strContent .= $arrContent[$intCount];
            ++$intCount;
        }
        return trim($strContent);
    }

    /**
     * Metodo responsavel em listar todo(s) o(s) annotation(s) de um metodo 
     * usando reflexao a partir do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Reflection::listMethodsFromClass($mixEntity, $strMethod);
     *
     * @param mix $mixEntity
     * @param string $strMethod
     * @return mix
     *
     * @assert () == false
     * @assert ('ConsultaPublica\Controller\IndexController') == false
     * @assert ('ConsultaPublica\Controller\IndexController', 'indexAction') == array('AUTH' => 'no')
     */
    public static function listAnnotationsFromMethod($mixEntity = null, $strMethod = null)
    {
        if (empty($strMethod) || is_null($strMethod) || empty($mixEntity) || is_null($mixEntity))
            return false;
        $reflection = self::getReflectionClass($mixEntity);
        if (!is_object($reflection))
            return false;
        return ($reflection->hasMethod($strMethod)) ? self::listAnnotations($reflection->getMethod($strMethod)) : null;
    }

    /**
     * Metodo responsavel em listar todo(s) o(s) annotation(s) de um atributo 
     * usando reflexao a partir do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Reflection::listAnnotationsFromAttribute($mixEntity, $strAttribute);
     *
     * @param mix $mixEntity
     * @param string $strAttribute
     * @return mix
     *
     * @assert ('InepZend\Util\Reflection') == false
     * @assert ('InepZend\Util\Reflection', 'arrReflectionClass') == array('VAR' => 'array')
     */
    public static function listAnnotationsFromAttribute($mixEntity, $strAttribute = null)
    {
        if (empty($strAttribute) || !is_string($strAttribute) || is_null($strAttribute))
            return false;
        $reflection = self::getReflectionClass($mixEntity);
        if (!is_object($reflection))
            return false;
        return ($reflection->hasProperty($strAttribute)) ? self::listAnnotations($reflection->getProperty($strAttribute)) : null;
    }

    /**
     * Metodo responsavel em listar todo(s) o(s) annotation(s) de um 
     * atributo/metodo usando reflexao.
     *
     * @example self::listAnnotations($reflection);
     *
     * @param object $reflection
     * @return mix
     */
    private static function listAnnotations($reflection)
    {
        if (!is_object($reflection))
            return false;
        $arrDocComment = array();
        preg_match_all("#@(.*?)\n#s", $reflection->getDocComment(), $arrDocComment);
        if ((!is_array($arrDocComment)) || (!array_key_exists(0, $arrDocComment)))
            return false;
        $arrAnnotation = array();
        foreach ($arrDocComment[0] as $strDocComment) {
            $strDocComment = trim($strDocComment);
            if (strpos($strDocComment, '@') !== 0)
                continue;
            $strDocComment = substr($strDocComment, 1);
            $strAnnotation = null;
            $strAnnotationValue = null;
            $intPosEspaco = strpos($strDocComment, ' ');
            $intPosParentese = strpos($strDocComment, '(');
            if (($intPosEspaco !== false) || ($intPosParentese !== false)) {
                if ($intPosEspaco === false)
                    $intPos = $intPosParentese;
                elseif ($intPosParentese === false)
                    $intPos = $intPosEspaco;
                else
                    $intPos = ($intPosEspaco > $intPosParentese) ? $intPosParentese : $intPosEspaco;
                $strAnnotation = trim(substr($strDocComment, 0, $intPos));
                $strAnnotationValue = trim(substr($strDocComment, $intPos));
            } else
                $strAnnotation = trim($strDocComment);
            $arrAnnotation[strtoupper($strAnnotation)] = $strAnnotationValue;
        }
        return $arrAnnotation;
    }

    /**
     * Metodo responsavel em recuperar o valor do atributo de uma annotation.
     *
     * @example \InepZend\Util\Reflection::getAttributeValueFromAnnotationValue($strAnnotationValue, $srtAttribute)
     *
     * @param string $strAnnotationValue
     * @param string $srtAttribute
     * @return mix
     *
     * @assert ('@ORM\SequenceGenerator(sequenceName="inep_skeleton.seq_arquivo", initialValue=1, allocationSize=1)', 'allocationSize') == "1"
     * @assert ('@annotation', null) == false
     * @assert (null, 'value') == false
     * @assert ('@ORM\GeneratedValue', 'id_arquivo') == ""
     */
    public static function getAttributeValueFromAnnotationValue($strAnnotationValue = null, $srtAttribute = null)
    {
        if ((empty($strAnnotationValue)) || (empty($srtAttribute)))
            return false;
        $strResult = '';
        if (($intPos = stripos($strAnnotationValue, $srtAttribute)) !== false)
            $strResult = trim(reset($arrExplode = explode(' ', str_replace(array('=', '"', "'", ')', ','), array('', '', '', '', ' '), substr($strAnnotationValue, $intPos + strlen($srtAttribute))))));
        return $strResult;
    }

    /**
     * Metodo responsavel em retornar o real nome da classe (case sensitive) 
     * apartir do path da mesma, utilizando o require_once do arquivo da classe.
     *
     * @example \InepZend\Util\Reflection::getRealClassNameWithPath($strClassName, $strClassPath);
     *
     * @param string $strClassName
     * @param string $strClassPath
     * @return mix
     *
     * @assert ('Publicacao\Controller\ArquivoController', \InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../module/InepSkeleton/Publicacao/src/Publicacao/Controller/ArquivoController.php')) == "Publicacao\Controller\ArquivoController"
     * @assert ('ArquivoController.php', \InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../module/InepSkeleton/Publicacao/src/Publicacao/Controller/ArquivoController.php')) == false
     * @assert ('ArquivoController.php', './module/InepSkeleton/Publicacao/src/Publicacao/Controller/ArquivoController') == false
     * @assert ('Publicacao\Controller\ArquivoController', './Publicacao/src/Publicacao/Controller/ArquivoController.php') == false
     */
    public static function getRealClassNameWithPath($strClassName = null, $strClassPath = null)
    {
        if ((empty($strClassName)) || (empty($strClassPath)))
            return false;
        if (!is_file($strClassPath))
            return false;
        require_once($strClassPath);
        $arrDeclaredClass = get_declared_classes();
        foreach ($arrDeclaredClass as $strDeclaredClassName) {
            if (trim(strtolower($strClassName)) == trim(strtolower($strDeclaredClassName)))
                return $strDeclaredClassName;
        }
        return false;
    }

    /**
     * Metodo responsavel em retornar o namespace de um objeto ou de um nome da 
     * classe (get_class).
     *
     * @example \InepZend\Util\Reflection::getNamespace($mixEntity, $booArray);
     *
     * @param mix $mixEntity
     * @param boolean $booArray
     * @return mix
     *
     * @assert (new \InepZend\Util\Reflection) == 'InepZend\Util'
     * @assert (new \InepZend\Util\Reflection, true) == array('InepZend', 'Util')
     * @assert ('\InepZend\Util\Reflection') == '\InepZend\Util'
     * @assert ('\InepZend\Util\Reflection', true) == array('', 'InepZend', 'Util')
     * @assert ('string') == ''
     * @assert ('string', true) == array()
     */
    public static function getNamespace($mixEntity, $booArray = null)
    {
        if (is_object($mixEntity))
            $strClass = get_class($mixEntity);
        elseif ((is_string($mixEntity)) && (!empty($mixEntity)))
            $strClass = $mixEntity;
        else
            return false;
        if (!is_bool($booArray))
            $booArray = false;
        $arrNamespace = array_slice(explode('\\', $strClass), 0, -1);
        return ($booArray) ? $arrNamespace : implode('\\', $arrNamespace);
    }

    /**
     * Metodo responsavel em recuperar o path de uma classe (get_class) a partir 
     * do namespace ou de um objeto.
     *
     * @example \InepZend\Util\Reflection::getFileNameFromClass($mixEntity)
     *
     * @param mix $mixEntity
     * @return mix
     *
     * @assert (new \InepZend\Util\Reflection) == dirname((new \ReflectionClass('\InepZend\Util\Reflection'))->getFileName())
     * @assert ('\InepZend\Util\Reflection') == dirname((new \ReflectionClass('\InepZend\Util\Reflection'))->getFileName())
     */
    public static function getFileNameFromClass($mixEntity)
    {
        $reflection = self::getReflectionClass($mixEntity);
        if (!is_object($reflection))
            return false;
        return dirname($reflection->getFileName());
    }

    /**
     * Metodo responsavel em recuperar o nome de uma classe a partir do path.
     *
     * @example \InepZend\Util\Reflection::getClassFromFileName('/vendor/InepZend/library/InepZend/Util/Reflection.php')
     *
     * @param string $strFileName
     * @return mix
     *
     * @TODO Realizar os asserts
     */
    public static function getClassFromFileName($strFileName)
    {
        $strContent = FileSystem::getContentFromFile($strFileName);
        if ((($intPosNamespace = strpos($strContent, $strNamespace = 'namespace ')) !== false) && (($intPosClass = strpos($strContent, $strClass = 'class ')) !== false)) {
            $strNamespace = substr($strContent, $intPosNamespace + strlen($strNamespace));
            $strNamespace = trim(substr($strNamespace, 0, strpos($strNamespace, ';')));
            $strClass = substr($strContent, $intPosClass + strlen($strClass));
            $intPos1 = strpos($strClass, ' ');
            $intPos2 = strpos($strClass, '{');
            if ((!is_numeric($intPos1)) && (!is_numeric($intPos2)))
                return false;
            $strClass = trim(substr($strClass, 0, ($intPos1 > $intPos2) ? $intPos2 : $intPos1));
            return $strNamespace . '\\' . $strClass;
        }
        return false;
    }

    /**
     * Metodo responsavel em realizar reflexao e execucao no metodo invocado.
     *
     * @example \InepZend\Util\Reflection::invokeNotAccessibleMethod((new \stdClass()), 'method')
     *
     * @param mix $mixClass
     * @param string $strMethod
     * @return mix
     *
     * @assert((new \InepZend\Util\stdClass()), 'setAllAttribute', array('param1' => 1, 'param2' => 2)) == true
     */
    public static function invokeNotAccessibleMethod($mixClass = null, $strMethod = null)
    {
        if ((empty($mixClass)) || (empty($strMethod)))
            return false;
        $class = (!is_object($mixClass)) ? new $mixClass() : $mixClass;
        $reflection = new \ReflectionMethod(get_class($class), $strMethod);
        $reflection->setAccessible(true);
        $arrParam = func_get_args();
        unset($arrParam[0], $arrParam[1]);
        $arrParam = array_values($arrParam);
        $arrArgument = array();
        foreach ($arrParam as $intKey => $strParam)
            $arrArgument[] = '$mixRef' . $intKey . ' = &$arrParam[' . $intKey . ']';
        $strParam = implode(", ", $arrArgument);
        if (empty($strParam))
            $strParam = 'null';
        try {
            $mixResult = null;
            eval('$mixResult = $reflection->invoke($class, ' . $strParam . ');');
            return $mixResult;
        } catch (\ReflectionException $exception) {
            return;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Metodo responsavel em realizar reflexao e atribuicao de valores em atributos
     * privados.
     * 
     * @example \InepZend\Util\Reflection::setValueNotAccessibleProperty($mixClass, $strProperty, $mixValue);
     * 
     * @param mix $mixClass
     * @param string $strProperty
     * @param mix $mixValue
     * @return mix
     * 
     * @TODO Criar asserts
     */
    public static function setValueNotAccessibleProperty($mixClass = null, $strProperty = null, $mixValue = null)
    {
        if ((empty($mixClass)) || (empty($strProperty)))
            return false;
        $class = (!is_object($mixClass)) ? new $mixClass() : $mixClass;
        $reflection = new \ReflectionProperty(get_class($class), $strProperty);
        $reflection->setAccessible(true);
        $reflection->setValue($class, $mixValue);
        return $reflection->getValue($class);
    }

    /**
     * Metodo responsavel em capturar o id da instancia.
     * 
     * @example \InepZend\Util\Reflection::getInstanceId($object);
     * 
     * @param object $object
     * @param boolean $booUseSpl
     * @return mix
     * 
     * @TODO Criar asserts
     */
    public static function getInstanceId($object = null, $booUseSpl = true)
    {
        if (!is_object($object))
            return false;
        if (($booUseSpl === true) && (function_exists('spl_object_hash')))
            return spl_object_hash($object);
        ob_start();
        var_dump($object);
        preg_match('[#(\d+)]', ob_get_clean(), $arrMatch);
        return @$arrMatch[1];
    }

}
