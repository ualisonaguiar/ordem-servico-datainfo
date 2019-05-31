<?php

namespace InepZend\Generator\Service;

class ServiceGenerator
{

    protected static $_template = '<?php

<namespace>

use InepZend\Service\AbstractServiceRepository;

class <className> extends AbstractServiceRepository
{
    
}
';

    /**
     * @param string $fullClassName
     *
     * @return string
     */
    public function generateServiceClass($fullClassName)
    {
        $className = substr($fullClassName, strrpos($fullClassName, '\\') + 1, strlen($fullClassName));

        $variables = array(
            '<namespace>' => $this->generateServiceNamespace($fullClassName),
            '<className>' => $className
        );

        return str_replace(array_keys($variables), array_values($variables), self::$_template);
    }

    /**
     * Generates the namespace statement, if class do not have namespace, return empty string instead.
     * 
     * @param string $fullClassName The full repository class name.
     *
     * @return string $namespace
     */
    private function generateServiceNamespace($fullClassName)
    {
        $namespace = substr($fullClassName, 0, strrpos($fullClassName, '\\'));
        return $namespace ? 'namespace ' . $namespace . ';' : '';
    }

    /**
     * @param string $fullClassName
     * @param string $outputDirectory
     *
     * @return void
     */
    public function writeServiceClass($fullClassName, $outputDirectory)
    {
        $code = $this->generateServiceClass($fullClassName);

        $path = $outputDirectory . DIRECTORY_SEPARATOR
                . str_replace('\\', \DIRECTORY_SEPARATOR, $fullClassName) . '.php';
        $dir = dirname($path);

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        if (!file_exists($path)) {
            file_put_contents($path, $code);
        }
    }

}
