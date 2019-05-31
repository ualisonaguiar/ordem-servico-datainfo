<?php

namespace InepZend\Generator\Structure;


class StructureGenerator
{
    
    private $arrTemplateStruc = array(
            'config',
            'src' => array(
                'Module' => array(
                    'Controller',
                    'Entity',
                    'Form',
                    'Service',
                ),
            ),
            'test',
            'view' => array(
                'module'
            )
    );
    
    private $strModuleName = '';
    
    public function writeStructure($strDirBase, array $arrStructure = array())
    {
        if (!$arrStructure) {
            $arrStructure = $this->arrTemplateStruc;
        }
        if (!$this->strModuleName) {
            $this->strModuleName = $this->getModuleName($strDirBase);
        }
        
        foreach ($arrStructure as $strKey => $mixStructure) {
            if (is_array($mixStructure)) {
                 if ($strKey === 'Module') {
                    $strKey = $this->strModuleName;
                } elseif($strKey == 'module') {
                    $strKey = strtolower($this->strModuleName);
                }
                $strSubDirBase = $strDirBase . DIRECTORY_SEPARATOR . $strKey;
                $this->createDir($strSubDirBase);
                $this->writeStructure($strSubDirBase, $mixStructure);
            } else {
                if ($mixStructure === 'Module') {
                    $mixStructure = $this->strModuleName;
                } elseif($mixStructure == 'module') {
                    $mixStructure = strtolower($this->strModuleName);
                }
                $this->createDir($strDirBase . DIRECTORY_SEPARATOR . $mixStructure);
            }
        }
        
    }
    
    protected function createDir($strDir)
    {
        if ( ! is_dir($strDir)) {
            mkdir($strDir, 0777, true);
        }
    }
    
    private function getModuleName($strDir)
    {
        $namespace = substr($strDir, strrpos($strDir, '/') + 1, strlen($strDir));
        
        return $namespace ? $namespace : '';
    }
}

