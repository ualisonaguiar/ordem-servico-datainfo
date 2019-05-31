<?php

namespace InepZend\Module\TrocaArquivo\MassaTeste\Service;

use InepZend\Module\TrocaArquivo\Common\Service\AbstractService;
use InepZend\Module\TrocaArquivo\Common\Service\AbstractServiceFileFlow;
use InepZend\Module\TrocaArquivo\Common\Entity\MassaTeste as MassaTesteEntity;
use InepZend\Util\AttributeStaticTrait;
use InepZend\Exception\Exception;

class MassaTeste extends AbstractService
{

    use AttributeStaticTrait;

    const CLASS_TYPE_MASSA_GENERATOR_ALEATORIA = 'InepZend\Module\TrocaArquivo\MassaTeste\Service\Generator\GeradorMassaAleatoria';

    public function __construct()
    {
        AbstractServiceFileFlow::configPhpIni();
    }

    /**
     * Metodo responsavel por retornar a instancia da class sera responsavel pela geracao do dados.
     * 
     * @param string $strNamespace
     * @return object
     */
    public static function getInstance($strNamespace = null)
    {
        if (empty($strNamespace))
            $strNamespace = self::CLASS_TYPE_MASSA_GENERATOR_ALEATORIA;
        return self::getAttributeStaticInstance($strNamespace, 'instanceTypeGeneratorData', $strNamespace);
    }

    /**
     * Metodo responsavel por gerar o(s) arquivo(s) contendo a massa de dados.
     * 
     * @rest true
     * @rest_resource RSRC_GERAR_FILE
     * @rest_auth false
     * 
     * @param integer $intMassaTeste
     */
    protected function gerarFileMassa($intMassaTeste)
    {
        $this->debugExecFile(__FUNCTION__);
        $this->debugExecFile(func_get_args());
        $massaTeste = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\MassaTesteFile')->find((int) $intMassaTeste);
        $this->updateStatus($massaTeste, MassaTesteEntity::STATUS_CO_EM_PROCESSAMENTO);
        try {
            $strNameFile = $this->makeNameFile($massaTeste);
            $this->debugExecFile('Nome do arquivo a ser criado: ' . $strNameFile);
            self::getInstance()->gerarMassa($this->getFieldLayout($massaTeste->getIdLayout()), $massaTeste->getNuQuantidadeLinha(), $strNameFile, $massaTeste->getIdMassaTeste());
            $this->updateStatus($massaTeste, MassaTesteEntity::STATUS_CO_CONCLUIDO);
        } catch (Exception $exception) {
            $this->updateStatus($massaTeste, MassaTesteEntity::STATUS_CO_FALHA);
            $this->debugExecFile('Erro ao gerar o arquivo.');
            $this->debugExecFile($exception);
        }
    }

    /**
     * Metodo responsavel por montar a nomenclatura do arquivo criado.
     * 
     * @param MassaTesteEntity $massaTeste
     * @return string
     */
    protected function makeNameFile(MassaTesteEntity $massaTeste)
    {
        $configureLayout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->find((int) $massaTeste->getIdLayout());
        $infoCorporativo = reset($this->getService('InepZend\Module\Corporative\Service\VwProjetoEvento')->findBy(array('coEvento' => $configureLayout->getCoEvento(), 'coProjeto' => $configureLayout->getCoProjeto())));
        $layout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->find((int) $massaTeste->getIdLayout());
        $strNameFile = $infoCorporativo->getNoProjeto() . $configureLayout->getCoProjeto() . '_';
        $strNameFile .= $configureLayout->getCoEvento() . '_' . $layout->getNoLayout() . '_' . $configureLayout->getSgUf();
        return $strNameFile;
    }

    /**
     * Metodo responsavel por retornar informacoes dos campos do layout.
     * 
     * @param intger $intIdLayout
     * @return array
     */
    protected function getFieldLayout($intIdLayout)
    {
        $arrFieldLayout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\EstruturaFile')
                ->findBy(array('id_layout' => (int) $intIdLayout), array('nu_ordem' => 'asc'));
        $arrFieldTest = array();
        $arrTipoLayout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->fetchPairs(null, 'getIdTipo', 'getNoTipo');
        if (empty($arrFieldLayout))
            throw new Exception('Layout sem estrutura definida.');
        foreach ($arrFieldLayout as $intPosicao => $fieldLayout) {
            $arrFieldTest[$intPosicao]['name'] = $fieldLayout->getNoCampo();
            $arrFieldTest[$intPosicao]['size'] = $fieldLayout->getDsTamanhoMax();
            $arrFieldTest[$intPosicao]['domain'] = (($fieldLayout->getDsValidacao())) ? explode(';', $fieldLayout->getDsValidacao()) : '';
            $arrFieldTest[$intPosicao]['required'] = $fieldLayout->getInObrigatoridade();
            $arrFieldTest[$intPosicao]['tipo'] = $arrTipoLayout[$fieldLayout->getIdTipo()];
        }
        return $arrFieldTest;
    }

    /**
     * Metodo responsavel por alterar o satus da massa durante o processamento de geracao de dados.
     * 
     * @param MassaTesteEntity $massaTeste
     * @param integer $intCoStatus
     */
    protected function updateStatus(MassaTesteEntity $massaTeste, $intCoStatus)
    {
        $massaTeste->setNuStatus((int) $intCoStatus);
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\MassaTesteFile')->update($massaTeste->toArray());
    }
}
