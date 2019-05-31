<?php

namespace InepZend\Generator\Module;


class ModuleGenerator
{
    protected static $_templateModuleClass =
'<?php

<namespace>

use InepZend\ModuleConfig\ModuleConfig;

class Module extends ModuleConfig
{
    
    public function getServiceConfig()
    {
        return array(
            
        );
    }
}
';
    
    protected static $_templateModuleConfig =
"<?php

<namespace>

return array(
    'router' => array(
        'routes' => array(
        ),
    ),
    'controllers' => array(
        'invokables' => array(
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            <dirview> => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
);
";
    
    public function generateModuleClass($strDir)
    {
        $variables = array(
            '<namespace>' => $this->getModuleNamespace($strDir),
        );

        return str_replace(array_keys($variables), array_values($variables), self::$_templateModuleClass);
    }
    
    public function generateModuleConfig($strDir)
    {
        $variables = array(
            '<namespace>' => $this->getModuleNamespace($strDir),
            '<dirview>' => $this->getDirViewNamespace($strDir),
        );

        return str_replace(array_keys($variables), array_values($variables), self::$_templateModuleConfig);
    }
    
    private function getModuleNamespace($strDir)
    {
        $namespace = substr($strDir, strrpos($strDir, '/') + 1, strlen($strDir));
        
        return $namespace ? 'namespace ' . $namespace . ';' : '';
    }
    
    private function getDirViewNamespace($strDir)
    {
        $dirview = strtolower(substr($strDir, strrpos($strDir, '/') + 1, strlen($strDir)));
        
        return $dirview ? "'$dirview'" : '';
    }
    
    public function writeModuleClass($outputDirectory)
    {
        $strCode = $this->generateModuleClass($outputDirectory);

        $strPath = $outputDirectory . DIRECTORY_SEPARATOR . 'Module.php';
        
        $this->writer($strPath, $strCode);
    }
    
    
    public function writeModuleConfig($outputDirectory)
    {
        $strCode = $this->generateModuleConfig($outputDirectory);

        $strPath = $outputDirectory . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'module.config.php';
        
        $this->writer($strPath, $strCode);
        
    }
    
    private function writer($strPath, $strCode)
    {
        $dir = dirname($strPath);

        if ( ! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        if ( ! file_exists($strPath)) {
            file_put_contents($strPath, $strCode);
        }
    }


}

