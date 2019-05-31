<?php

namespace InepZend\Generator;

use InepZend\Doctrine\ORM\Tools\EntityGenerator;
use InepZend\Doctrine\ORM\Tools\EntityRepositoryGenerator;
use InepZend\Generator\Service\ServiceGenerator;
use InepZend\Generator\Structure\StructureGenerator;
use InepZend\Generator\Module\ModuleGenerator;
use InepZend\Entity\Entity;
use InepZend\Exception\Exception;

class Generator
{

    private $strBaseDir = '';
    private $arrMetadata = array();
    private $arrStructure = array();

    public function __construct($strBaseDir = null, array $arrMetadata = array(), array $arrStructure = array())
    {
        $this->strBaseDir = $strBaseDir;
        $this->arrMetadata = $arrMetadata;
        $this->arrStructure = $arrStructure;
    }

    public function setDir($strBaseDir)
    {
        $this->strBaseDir = $strBaseDir;
        return $this;
    }

    public function getDir()
    {
        return $this->strBaseDir;
    }

    public function getDirSrc()
    {
        return $this->strBaseDir . DIRECTORY_SEPARATOR . 'src';
    }

    public function getMetadata()
    {
        return $this->arrMetadata;
    }

    public function setMetadata($arrMetadata)
    {
        $this->arrMetadata = $arrMetadata;
        return $this;
    }

    public function setStructure($arrStructure)
    {
        $this->arrStructure = $arrStructure;
        return $this;
    }

    /**
     * Generates and writes entity, repository, service, module, config  classes for the given array of ClassMetadataInfo instances.
     *
     * @param array  $arrMetadatas
     *
     * @return void
     */
    public function generate($strUserSchema = null)
    {
        if (!$this->getMetadata()) {
            throw new Exception('Não existe nenhuma entidade no banco de dados informado : %s');
        }
        if (!$this->getDir()) {
            throw new Exception('É necessário informar um diretório base.');
        }

        $this->generateStructure();
        foreach ($this->getMetadata() as $metadata) {            
            $metadata->customRepositoryClassName = $this->getClassName($metadata->name) . 'Repository';
            $this->generateEntity($metadata, $strUserSchema);
            $this->generateRepository($metadata);
            $this->generateService($metadata);
        }
        die;
        $this->generateModuleClass();
        $this->generateModuleConfig();
    }

    public function generateEntity($mixMetadata, $strUserSchema = null)
    {
        $entityGenerator = new EntityGenerator();
        $entityGenerator->setGenerateAnnotations(true);
        $entityGenerator->setGenerateStubMethods(true);
        $entityGenerator->setRegenerateEntityIfExists(false);
        $entityGenerator->setUpdateEntityIfExists(false);
        $entityGenerator->setClassToExtend(new Entity());
        if ($strUserSchema)
            $mixMetadata->table['name'] = $strUserSchema . '.' . $mixMetadata->table['name'];
        if (is_array($mixMetadata)) {
            $entityGenerator->generate($mixMetadata, $this->getDirSrc());
        } else {
            $entityGenerator->writeEntityClass($mixMetadata, $this->getDirSrc());
        }
        echo 'Gerando ' . $this->getClassName($mixMetadata->name) . "\n";

    }

    public function generateRepository($metadata)
    {
        $entityRepositoryGenerator = new EntityRepositoryGenerator();

        $entityRepositoryGenerator->writeEntityRepositoryClass($metadata->customRepositoryClassName, $this->getDirSrc());

        echo 'Gerando ' . $metadata->customRepositoryClassName . "\n";
    }

    public function generateService($metadata)
    {
        $serviceGenerator = new ServiceGenerator();
        $strServiceName = str_replace('Entity', 'Service', $this->getClassName($metadata->name));
        $serviceGenerator->writeServiceClass($strServiceName, $this->getDirSrc());
        echo 'Gerando ' . $strServiceName . "\n";
    }

    public function generateModuleClass()
    {
        $moduleGenerator = new ModuleGenerator();
        $moduleGenerator->writeModuleClass($this->strBaseDir);
    }

    public function generateModuleConfig()
    {
        $moduleGenerator = new ModuleGenerator();
        $moduleGenerator->writeModuleConfig($this->strBaseDir);
    }

    public function generateStructure()
    {
        $structureGenerator = new StructureGenerator();
        $structureGenerator->writeStructure($this->strBaseDir, $this->arrStructure);
    }

    protected function getClassName($mixParam)
    {
        if ($mixParam instanceof ClassMetadataInfo)
            return ($pos = strrpos($mixParam->name, '\\')) ? substr($mixParam->name, $pos + 3, strlen($mixParam->name)) : $mixParam->name;
        return (is_string($mixParam)) ? str_replace(array('Tb', 'Tc'), '', $mixParam) : null;
    }

}
