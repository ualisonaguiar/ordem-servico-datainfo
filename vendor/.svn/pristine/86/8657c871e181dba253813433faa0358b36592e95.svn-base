<?php

namespace InepZend\Doctrine\ORM\Tools;

use Doctrine\ORM\Tools\EntityGenerator as EntityGeneratorDefault;
use InepZend\Doctrine\ORM\Tools\EntityRepositoryGenerator;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\Common\Util\Inflector;
use Doctrine\DBAL\Types\Type;
use InepZend\Service\ServiceGenerator;

class EntityGenerator extends EntityGeneratorDefault
{
    /**
     * @var string
     */
    protected static $getDateMethodTemplate =
'/**
 * <description>
 *
 * @return <variableType>
 */
public function <methodName>()
{
<spaces>return \InepZend\Util\Date::convertDate($this-><fieldName>, "d/m/Y");
}';
    
    /**
     * @var string
     */
    protected static $setMethodTemplate =
'/**
 * <description>
 *
 * @param <variableType>$<variableName>
 *
 * @return <entity>
 */
public function <methodName>(<methodTypeHint>$<variableName><variableDefault>)
{
<spaces>$this-><fieldName> = $<variableName>;
<spaces>return $this;
}';
    
    /**
     * Generates and writes entity classes for the given array of ClassMetadataInfo instances.
     *
     * @param array  $metadatas
     * @param string $outputDirectory
     *
     * @return void
     */
    public function generate(array $metadatas, $outputDirectory)
    {
        $entityRepositoryGenerator = new EntityRepositoryGenerator();
        $serviceGenerator = new ServiceGenerator();
        
        foreach ($metadatas as $metadata) {
            $metadata->customRepositoryClassName = $this->getClassName($metadata->name) . 'Repository';
            $this->writeEntityClass($metadata, $outputDirectory);
            $entityRepositoryGenerator->writeEntityRepositoryClass( $metadata->customRepositoryClassName,$outputDirectory);
            $serviceGenerator->writeServiceClass(str_replace('Entity', 'Service', $this->getClassName($metadata->name)), $outputDirectory);
        }
    }
    
    /**
     * Generates and writes entity class to disk for the given ClassMetadataInfo instance.
     *
     * @param ClassMetadataInfo $metadata
     * @param string            $outputDirectory
     *
     * @return void
     *
     * @throws \RuntimeException
     */
    public function writeEntityClass(ClassMetadataInfo $metadata, $outputDirectory)
    {
        $path = $outputDirectory . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $this->getClassName($metadata->name)) . $this->extension;
        $dir = dirname($path);

        if ( ! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $this->isNew = !file_exists($path) || (file_exists($path) && $this->regenerateEntityIfExists);

        if ( ! $this->isNew) {
            $this->parseTokensInEntityFile(file_get_contents($path));
        } else {
            $this->staticReflection[$metadata->name] = array('properties' => array(), 'methods' => array());
        }

        if ($this->backupExisting && file_exists($path)) {
            $backupPath = dirname($path) . DIRECTORY_SEPARATOR . basename($path) . "~";
            if (!copy($path, $backupPath)) {
                throw new \RuntimeException("Attempt to backup overwritten entity file but copy operation failed.");
            }
        }

        // If entity doesn't exist or we're re-generating the entities entirely
        if ($this->isNew) {
            file_put_contents($path, $this->generateEntityClass($metadata));
        // If entity exists and we're allowed to update the entity class
        } elseif ( ! $this->isNew && $this->updateEntityIfExists) {
            file_put_contents($path, $this->generateUpdatedEntityClass($metadata, $path));
        }
    }
    
    
    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function getClassName($mixParam)
    {
        if ($mixParam instanceof ClassMetadataInfo) {
            return ($pos = strrpos($mixParam->name, '\\'))
                ? substr($mixParam->name, $pos + 3, strlen($mixParam->name)) : $mixParam->name;
        }
        
        return (is_string($mixParam)) ? str_replace(array('Tb', 'Tc'), '', $mixParam) : null;
    }
    
    protected function generateEntityUse()
    {
        if ($this->generateAnnotations) {
            return "\n".'use Doctrine\ORM\Mapping as ORM;'."\n" . "use InepZend\Entity\Entity;" . "\n";
        } else {
            return "";
        }
    }
    
    /**
     * @return string
     */
    protected function getClassToExtendName()
    {
        $reflection = new \ReflectionClass($this->getClassToExtend());
         return ($pos = strrpos($reflection->getName(), '\\'))
                ? substr($reflection->getName(), $pos + 1, strlen($reflection->getName())) : $reflection->getName();
    }
    
     /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityAssociationMappingProperties(ClassMetadataInfo $metadata)
    {
        $lines = array();

        foreach ($metadata->associationMappings as $associationMapping) {
            if ($this->hasProperty($associationMapping['fieldName'], $metadata)) {
                continue;
            }
            
            $associationMapping['targetEntity'] = ($associationMapping['targetEntity']) ? $this->getClassName($associationMapping['targetEntity']) : $associationMapping['targetEntity'];
            $lines[] = $this->generateAssociationMappingPropertyDocBlock($associationMapping, $metadata);
            $lines[] = $this->spaces . $this->fieldVisibility . ' $' . $associationMapping['fieldName']
                     . ($associationMapping['type'] == 'manyToMany' ? ' = array()' : null) . ";\n";
        }

        return implode("\n", $lines);
    }
    
     /**
     * @param ClassMetadataInfo $metadata
     * @param string            $type
     * @param string            $fieldName
     * @param string|null       $typeHint
     * @param string|null       $defaultValue
     *
     * @return string
     */
    protected function generateEntityStubMethod(ClassMetadataInfo $metadata, $type, $fieldName, $typeHint = null,  $defaultValue = null)
    {
        $methodName = $type . Inflector::classify($fieldName);
        
        if (in_array($type, array("add", "remove"))) {
            $methodName = Inflector::singularize($methodName);
        }
        
        if ($this->hasMethod($methodName, $metadata)) {
            return '';
        }
        $this->staticReflection[$metadata->name]['methods'][] = $methodName;
        $var = ($type === 'get' && $typeHint === 'datetime') ? 'getDateMethodTemplate' : sprintf('%sMethodTemplate', $type);
        
        $template = static::$$var;

        $methodTypeHint = null;
        $types          = Type::getTypesMap();
        $variableType   = $typeHint ? $this->getType($typeHint) . ' ' : null;

        if ($typeHint && ! isset($types[$typeHint])) {
            $variableType   =  '\\' . ltrim($variableType, '\\');
            $methodTypeHint =  '\\' . $typeHint . ' ';
        }

        $replacements = array(
          '<description>'       => ucfirst($type) . ' ' . $fieldName,
          '<methodTypeHint>'    => $this->getClassName($methodTypeHint),
          '<variableType>'      => $this->getClassName($variableType),
          '<variableName>'      => Inflector::camelize($fieldName),
          '<methodName>'        => $methodName,
          '<fieldName>'         => $fieldName,
          '<variableDefault>'   => ($defaultValue !== null ) ? (' = '.$defaultValue) : '',
          '<entity>'            => $this->getClassName($metadata)
        );

        $method = str_replace(
            array_keys($replacements),
            array_values($replacements),
            $template
        );
        return $this->prefixCodeWithSpaces($method);
    }
    
}

