<?php

namespace InepZend\Module\TrocaArquivo\Common\Service\File;

use InepZend\Module\TrocaArquivo\Common\Service\File\AbstractServiceFile;
use InepZend\Module\TrocaArquivo\Common\Entity\MassaTeste as MassaTesteEntity;
use InepZend\Paginator\Paginator;
use InepZend\Util\Xml;

class MassaTesteFile extends AbstractServiceFile
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('id_massa_teste');
    }

    /**
     * 
     * @param array $arrCriteria
     * @param type $strSortName
     * @param type $strSortOrder
     * @param type $intPage
     * @param type $intItemPerPage
     * @param type $mixDQL
     * @return Paginator
     */
    public function findByPaged(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQL = null)
    {
        $arrCriteriaResult = array();
        if (array_key_exists('id_layout', $arrCriteria)) {
            $arrCriteriaResult['id_layout'] = $arrCriteria['id_layout'];
            unset($arrCriteria['id_layout']);
        }
        $arrResultTestData = $this->findBy($arrCriteriaResult);
        if (count($arrResultTestData))
            $arrResultTestData = $this->getFilterResult($arrResultTestData, $arrCriteria);
        return new Paginator($arrResultTestData, $intPage, $intItemPerPage);
    }

    public function insert(array $arrData, array $arrSetterFk = array(), $strEntity = null, $booCheckSequence = false)
    {
        $arrData['nu_tipo_massa'] = implode('|', array($arrData['nu_tipo_massa_real'], $arrData['nu_tipo_massa_aleatoriamente']));
        $arrData['nu_status'] = MassaTesteEntity::STATUS_CO_AGUARDANDO_PROCESSAMENTO;
        $arrData['dt_criacao'] = date('Y-m-d H:i:s');
        $arrData['in_ativo'] = MassaTesteEntity::STATUS_ATIVO;
        $massaTeste = parent::insert($arrData, $arrSetterFk, $strEntity, $booCheckSequence);
//        $this->getService('InepZend\Module\TrocaArquivo\MassaTeste\Service\MassaTeste')->gerarFileMassa($massaTeste->getIdMassaTeste());
        $this->getService('InepZend\WebService\Server\Rest\Service\RestClient')->runServiceAsync('InepZend\Module\TrocaArquivo\MassaTeste\Service\MassaTeste', 'gerarFileMassa', array($massaTeste->getIdMassaTeste()), 'RSRC_GERAR_FILE');
        return true;
    }

    /**
     * 
     * @param type $arrResultTestData
     * @param type $arrCriteria
     * @return type
     */
    private function getFilterResult($arrResultTestData, $arrCriteria)
    {
        $arrResultPaginator = array();
        $serviceConfigureLayout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile');
        $serviceCorporativo = $this->getService('InepZend\Module\Corporative\Service\VwProjetoEvento');
        $serviceLayout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile');
        foreach ($arrResultTestData as $resultDataTest) {
            $arrConfigureLayout = $serviceConfigureLayout->find((int) $resultDataTest->getIdLayout())->toArray();
            if (!empty($arrCriteria['coProjeto']) && $arrCriteria['coProjeto'] != $arrConfigureLayout['co_projeto'])
                continue;
            if (!empty($arrCriteria['coEvento']) && $arrCriteria['coEvento'] != $arrConfigureLayout['co_evento'])
                continue;
            $projetoEvento = reset($serviceCorporativo->findBy(array('coProjeto' => $arrConfigureLayout['co_projeto'], 'coEvento' => $arrConfigureLayout['co_evento'])));
            $layout = $serviceLayout->find((int) $resultDataTest->getIdLayout());
            $arrResultPaginator[] = array(
                'NO_PROJETO' => (($projetoEvento) ? $projetoEvento->getNoProjeto() : ''),
                'NO_EVENTO' => (($projetoEvento) ? $projetoEvento->getNoEvento() : ''),
                'NO_LAYOUT' => $layout->getNoLayout(),
                'NO_STATUS' => MassaTesteEntity::$arrStatusProcessamento[$resultDataTest->getNuStatus()],
                'DT_CRIACAO' => $resultDataTest->getDtCriacao(),
                'ID_MASSA_TESTE' => $resultDataTest->getIdMassaTeste(),
                'NU_QUANTIDADE_LINHA' => $resultDataTest->getNuQuantidadeLinha()
            );
        }
        unset($serviceConfigureLayout, $serviceCorporativo, $serviceLayout);
        return $arrResultPaginator;
    }

    public function deleteGenerate($layout, $configuracaoFile, $configuracaoContatoFile, $interdependenciaFile, $responsavelFile, $tipo)
    {
        $estrutura = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\EstruturaFile')->findBy();
        if (!empty($estrutura)) {
            foreach ($estrutura as $value) {
                if (!empty($value)) {
                    $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\EstruturaFile')->deleteBy(array('id_estrutura' => $value->getIdEstrutura()));
                }
            }
        }
        $layout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy();
        if (!empty($layout)) {
            foreach ($layout as $value) {
                if (!empty($value)) {
                    $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->deleteBy(array('id_layout' => $value->getIdLayout()));
                }
            }
        }
        $configuracaoFile = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->findBy();
        if (!empty($configuracaoFile)) {
            foreach ($configuracaoFile as $value) {
                if (!empty($value)) {
                    $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->deleteBy(array('id_configuracao' => $value->getIdConfiguracao()));
                }
            }
        }
        $configuracaoContatoFile = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoContatoFile')->findBy();
        if (!empty($configuracaoContatoFile)) {
            foreach ($configuracaoContatoFile as $value) {
                if (!empty($value)) {
                    $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoContatoFile')->deleteBy(array('id_contato' => $value->getIdContato()));
                }
            }
        }
        $interdependenciaFile = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\InterdependenciaFile')->findBy();
        if (!empty($interdependenciaFile)) {
            foreach ($interdependenciaFile as $value) {
                if (!empty($value)) {
                    $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\InterdependenciaFile')->deleteBy(array('id_interdependencia' => $value->getIdInterdependencia()));
                }
            }
        }
        $responsavelFile = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile')->findBy();
        if (!empty($responsavelFile)) {
            foreach ($responsavelFile as $value) {
                if (!empty($value)) {
                    $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile')->deleteBy(array('id_responsavel' => $value->getIdResponsavel()));
                }
            }
        }
        $tipo = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->findBy();
        if (!empty($tipo)) {
            foreach ($tipo as $value) {
                if (!empty($value)) {
                    $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->deleteBy(array('id_tipo' => $value->getIdTipo()));
                }
            }
        }
    }

    /**
     * Metodo responsavel em gerar as estruturas/configuracao dos layouts
     */
    public function generateLayoutsEstructures()
    {
        $layout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy();

        foreach ($layout as $arrLayout) {
            $strNomeLayout = strtolower($arrLayout->getNoLayout());
            $arrXsd = Xml::convertToXsdToArray('public/xsd/' . $strNomeLayout . '.xsd', 'public/xsd/' . $strNomeLayout . '.xml')["element"]["complexType"]["sequence"]["element"]["complexType"]["sequence"];
            foreach ($arrXsd as $elements) {
                foreach ($elements as $element) {
                    $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\EstruturaFile')->insert($this->getEstrutura($element, $arrLayout));
                }
            }
        }
    }

    /**
     * Metodo responsavel em popular o array da estrutura a ser persistida.
     * 
     * @param mix $element
     * @return array
     */
    private function getEstrutura($element, $arrLayout)
    {
        $arrEstrutura = [];
        $arrEstrutura["id_layout"] = $arrLayout->getIdLayout();
        $arrEstrutura["no_campo"] = $element["@attributes"]["name"];
        $arrEstrutura["nu_ordem"] = null;

        if (array_key_exists("minLength", $element["simpleType"]["restriction"]) || array_key_exists("maxLength", $element["simpleType"]["restriction"])) {
            $arrEstrutura["ds_tamanho_max"] = @$element["simpleType"]["restriction"]["maxLength"]["@attributes"]["value"];
            $arrEstrutura["ds_tamanho_min"] = @$element["simpleType"]["restriction"]["minLength"]["@attributes"]["value"];
        }
        
        if (array_key_exists("length", $element["simpleType"]["restriction"])) {
            $arrEstrutura["ds_tamanho_max"] = @$element["simpleType"]["restriction"]["length"]["@attributes"]["value"];
            $arrEstrutura["ds_tamanho_min"] = @$element["simpleType"]["restriction"]["length"]["@attributes"]["value"];
        }

        if (array_key_exists("minInclusive", $element["simpleType"]["restriction"]) || array_key_exists("maxInclusive", $element["simpleType"]["restriction"])) {
            $arrEstrutura["ds_tamanho_max"] = @$element["simpleType"]["restriction"]["maxInclusive"]["@attributes"]["value"];
            $arrEstrutura["ds_tamanho_min"] = @$element["simpleType"]["restriction"]["minInclusive"]["@attributes"]["value"];
        }

        if (array_key_exists("nillable", $element["@attributes"])) {
            $arrEstrutura["in_obrigatoriedade"] = true;
        }
        if (array_key_exists("minOccurs", $element["@attributes"])) {
            $arrEstrutura["in_ocorrencia"] = true;
        }

        if (array_key_exists('pattern', $element["simpleType"]["restriction"])) {
            $arrEstrutura["ds_validacao"] = $element["simpleType"]["restriction"]["pattern"]["@attributes"]["value"];
        }

        $strTipo = '';
        if (array_key_exists("enumeration", $element["simpleType"]["restriction"]))
            $strTipo = "enumeration";
        else
            $strTipo = $element["simpleType"]["restriction"]["@attributes"]["base"];

        switch ($strTipo) {
            case 'integer':
                $arrEstrutura["id_tipo"] = reset($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->findBy(array('no_tipo' => 'Número')))->getIdTipo();

                break;
            case 'string':
                $arrEstrutura["id_tipo"] = reset($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->findBy(array('no_tipo' => 'Texto')))->getIdTipo();

                break;
            case 'date':
                $arrEstrutura["id_tipo"] = reset($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->findBy(array('no_tipo' => 'Data')))->getIdTipo();


                break;
            case 'time':
                $arrEstrutura["id_tipo"] = reset($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->findBy(array('no_tipo' => 'Hora')))->getIdTipo();

                break;
            case 'datetime':
                $arrEstrutura["id_tipo"] = reset($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->findBy(array('no_tipo' => 'Data Hora')))->getIdTipo();

                break;
            case 'enumeration':
                $strTipoFiltro = ($element["simpleType"]["restriction"]["@attributes"]["base"] == 'integer') ? "Lista Numérica" : "Lista Texto";
                $intIdTipo = reset($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->findBy(array('no_tipo' => $strTipoFiltro)))->getIdTipo();
                $arrEstrutura["id_tipo"] = $intIdTipo;
                $strLista = '';
                foreach ($element["simpleType"]["restriction"]["enumeration"] as $strListaValue) {
                    $strLista .= $strListaValue["@attributes"]["value"] . ';';
                }
                $arrEstrutura["ds_validacao"] = $strLista;

                break;
        }
        return $arrEstrutura;
    }

    /**
     * Nome dos layouts default mapeados pelo InepSkeleton
     * 
     * @return type
     */
    public function layoutNameDefault()
    {
        return array(
            '02' => array("\t", "\n"),
            '03' => array("\t", "\n"),
            '04' => array("\t", "\n"),
            '05' => array("\t", "\n"),
            '06' => array("\t", "\n"),
            '07' => array("\t", "\n"),
            '31' => array("\t", "\n"),
            '41' => array("\t", "\n"),
            '42' => array("\t", "\n"),
            '44' => array("\t", "\n"),
            '46' => array("\t", "\n"),
            '52' => array("\t", "\n"),
            '53' => array("\t", "\n"),
            '54' => array("\t", "\n"),
            '60' => array("\t", "\n"),
            '80' => array("\t", "\n"),
            '90' => array("|*|", "\n"),
            '91' => array("|*|", "\n"),
            '93' => array("\t", "\n"),
        );
    }

    /**
     * Criacao dos layouts
     * 
     * @param type $arrLayoutAll
     */
    public function createFileDefault($arrLayoutAll)
    {
        $intId = 0;
        foreach ($arrLayoutAll as $strKey => $arrInfo) {
            ++$intId;
            $arrLayout = array(
                'no_layout' => 'N' . $strKey,
                'ds_caminho' => 'public/xsd/n' . $strKey . '.xsd',
                'ds_url' => 'xsd/n' . $strKey . '.xsd',
                'ds_encode' => 'UTF-8',
                'ds_separador_coluna' => $arrInfo[0],
                'ds_separador_linha' => $arrInfo[1],
                'ds_procedure' => null,
                'ds_table' => null,
                'in_status' => 1,
            );
            $arrConfiguracao = array(
                'id_layout' => $intId,
                'co_projeto' => 13101,
                'co_evento' => 1,
                'sg_uf' => 'AP',
                'ds_destino' => 'data/TrocaArquivo/destino_n' . $strKey . '/',
                'ds_prioridade' => '0' . $strKey,
            );
            $arrConfiguracaoContato = array(
                'id_configuracao' => $intId,
                'ds_email' => 'victor.vitorino@inep.gov.br',
            );
            $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->save($arrLayout);
            $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->save($arrConfiguracao);
            $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoContatoFile')->save($arrConfiguracaoContato);
        }
    }

    /**
     * Iter dependencias dos layouts
     */
    public function interDependencia()
    {
        $arrInterdependencia = array(
            'id_interdependencia' => null,
            'id_layout' => 18,
            'id_layout_dependente' => 1,
        );
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\InterdependenciaFile')->save($arrInterdependencia);
    }

    /**
     * Inservao dos resposanveis pelos layouts
     */
    public function responsavel()
    {
        $arrResponsavel = array(
            'id_responsavel' => null,
            'id_usuario_sistema' => $this->getIdentity()->usuarioSistema->id,
            'co_projeto' => 13101,
            'sg_uf' => 'BR',
        );
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile')->save($arrResponsavel);
    }

    
    /**
     * Criacao dos tipos de dados dos campos (estrutura) de cada coluna dos layouts
     */
    public function createType()
    {
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'CPF', 'no_tipo_banco' => 'VARCHAR'));
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'CEP', 'no_tipo_banco' => 'VARCHAR'));
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Booleano', 'no_tipo_banco' => 'INTEGER'));
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Data', 'no_tipo_banco' => 'VARCHAR'));
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Hora', 'no_tipo_banco' => 'VARCHAR'));
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Data Hora', 'no_tipo_banco' => 'VARCHAR'));
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Número', 'no_tipo_banco' => 'NUMBER'));
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Lista Numérica', 'no_tipo_banco' => 'NUMBER'));
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Lista Texto', 'no_tipo_banco' => 'VARCHAR'));
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Texto', 'no_tipo_banco' => 'VARCHAR'));
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'UF', 'no_tipo_banco' => 'VARCHAR'));
    }

}
