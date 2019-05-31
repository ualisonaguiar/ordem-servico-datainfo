<?php

namespace InepZend\Module\TrocaArquivo\EnvioDado\Controller;

use InepZend\Controller\AbstractControllerForm;
use InepZend\Module\TrocaArquivo\Common\Service\FileFlow;
use Exception as ExceptionNative;

class EnvioDadoController extends AbstractControllerForm
{

    public function indexAction()
    {
//         exit(microtime());
//         d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\FileFlow')->load(1, 'data/TrocaArquivo/container/201603241051421n02_novo_robo_2mi_XML.zip'), 1);
//         sd(end($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ErroFile')->findBy()), 1);
/*        \InepZend\Util\PhpIni::setTimeLimit(0);
        \InepZend\Util\PhpIni::allocatesMemory(-1);
        
        $MAX_REGISTER_XML = 12500;
        $strPath = 'C:/Program Files (x86)/Zend/Apache2/htdocs/Novo SVN/INEP/ARQUITETURA_PHP/INEPSKELETON/trunk/Fontes/data/TrocaArquivo/n02_novo_robo.txt';
        $intXml = 0;
        $arrNode = explode('|*|', trim(\InepZend\Util\FileSystem::getContentFromFileChunk($strPath)));
        d($arrNode);
        $arrRegister = explode("\n", \InepZend\Util\FileSystem::getContentFromFileChunk($strPath, $MAX_REGISTER_XML, (($intXml * $MAX_REGISTER_XML) + 1)));
        d($arrRegister);
        
        $strPathXml = str_replace('.txt', '.xml', $strPath);
        if (!is_file($strPathXml)) {
            $strXml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $strXml .= '<registers xmlns="' . \InepZend\Util\Server::getHost() . 'xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="' . \InepZend\Util\Server::getHost() . 'xsd n02.xsd">' . "\n";
            $mixResult = \InepZend\Util\FileSystem::insertContentIntoFile($strPathXml, $strXml);
            if (!$mixResult)
                d($mixResult,1);
            $strXml = '';
            $arrColDate = array();
            $booUtf8 = (stripos('UTF-8', 'utf') !== false);
            $strRegister = null;
            foreach ($arrRegister as $intLine => $strLine) {
                $arrLine = explode('|*|', trim($strLine));
                if ((empty($arrLine)) || (count($arrNode) != count($arrLine)))
                    continue;
                $strRegister = '<register>';
                foreach ($arrLine as $intCol => $mixCol) {
                    $mixValue = $mixCol;
                    if ((in_array($intCol, $arrColDate)) || ((strpos($mixCol, '/') !== false) && (\InepZend\Util\Date::isDateTemplate($mixCol)))) {
                        $mixValue = \InepZend\Util\Date::convertDate($mixCol);
                        $arrColDate[$intCol] = $intCol;
                    }
                    $strRegister .= '<' . $arrNode[$intCol] . '' . (((is_null($mixCol)) || ($mixCol == '')) ? ' xsi:nil="true"' : '') . '>' . trim(($booUtf8) ? utf8_encode($mixValue) : $mixValue) . '</' . $arrNode[$intCol] . '>';
                }
                $strRegister .= '</register>' . "\n";
                $strXml .= $strRegister;
                if (($intLine % 500) == 0) {
                    \InepZend\Util\FileSystem::insertContentIntoFile($strPathXml, $strXml, 'a+');
                    $strXml = '';
                }
            }
            $strXml .= '</registers>';
            \InepZend\Util\FileSystem::insertContentIntoFile($strPathXml, $strXml, 'a+');
        }
        d($strPathXml,1);*/
        
//         http:\/\/inepskeleton.local\/xsd\/n02.xsd): " {"strXmlPath":"data/TrocaArquivo/container/201603211229061n02_novo_robo/201603211229061n02_novo_robo-4.xml","strXmlSchemaPath":"http://inepskeleton.local/xsd/n02.xsd
//         $mixResult = \InepZend\Util\Xml::schemaValidate('C:\Program Files (x86)\Zend\Apache2\htdocs\Novo SVN\INEP\ARQUITETURA_PHP\INEPSKELETON\trunk\Fontes\data\TrocaArquivo\201603211229061n02_novo_robo-8.xml', 'http://inepskeleton.local/xsd/n02.xsd');
//         $mixResult = \InepZend\Util\Xml::schemaValidate('C:\Program Files (x86)\Zend\Apache2\htdocs\Novo SVN\INEP\ARQUITETURA_PHP\INEPSKELETON\trunk\Fontes\data\TrocaArquivo\upload\201603230930481n02_novo_robo\201603230930481n02_novo_robo-0.xml', 'http://inepskeleton.local/xsd/n02.xsd');
//         sd($mixResult,1);
        
//         $arrLayout = array(
//             'id_layout' => 1,
//             'no_layout' => 'N02',
//             'ds_caminho' => 'public/xsd/n02.xsd',
//             'ds_url' => 'xsd/n02.xsd',
//             'ds_encode' => 'UTF-8',
// //             'ds_separador_coluna' => '|*|',
//             'ds_separador_coluna' => "\t",
//             'ds_separador_linha' => "\n",
//             'ds_procedure' => null,
//             'ds_table' => 'robo_enem.tb_n02_carga_ensalamento',
//             'in_status' => 1,
//         );
//         $mixResult = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->save($arrLayout);
//         d($mixResult,1);
        
        # Passo 1: Gerar Layout Default e Configuracao
//        d($this->generate(), 1);
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy());
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\InterdependenciaFile')->findBy());
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->findBy());
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoContatoFile')->findBy());
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile')->findBy(), 1);
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\EstruturaFile')->findBy(array('id_layout' => 1)), 1);
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\EstruturaFile')->save([
//             'id_estrutura' => 60,
//             'id_layout' => 1,
//             'no_campo' => 'NO_LINGUA_ESTRANGEIRA',
//             'id_tipo' => 7,
//             'in_obrigatoriedade' => '1',
//             'in_ocorrencia' => '1',
//             'ds_tamanho_max' => '9',
//             'ds_tamanho_min' => '1',
//             'ds_validacao' => 'INGLÊS|ESPANHOL',
//             'nu_ordem' => '11',
//        ]), 1);
//         d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ErroFile')->findBy(), 1);
//         sd(end($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ErroFile')->findBy()), 1);

        # Passo 2: Upload em tela
        try {
            $form = $this->getForm()->prepareElementsEnvio();
        } catch (ExceptionNative $exception) {
//            d($exception,1);
            $this->getServiceMessage()->addMessageError($exception->getMessage());
            return $this->redirect()->toRoute((@$GLOBALS['authServiceAdapter']['callback']['route']) ? $GLOBALS['authServiceAdapter']['callback']['route'] : 'inicial');
        }
        return $this->controlAfterSubmit($form, $this->prepareRequest(false, array_merge($this->getPost(), $this->getFiles())), FileFlow::UPLOAD, null, 'enviodado');

        # Passo 3: Verificacao do andamento do Layout, sendo necessario esperar o fim da execucao
        # "container" => "preprocess" => "preprocess-running" => "preprocess-completed" => "process" => "process-running" => "process-completed" => "load" => "load-completed"
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ArquivoFile')->findBy());
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\AndamentoFile')->findBy());
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResultadoValidacaoFile')->findBy());
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ErroFile')->findBy(), 1);

        # Passo 4: Cadatro de Tipo de Layout
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'CPF', 'no_tipo_banco' => 'VARCHAR')));
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'CEP', 'no_tipo_banco' => 'VARCHAR')));
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Booleano', 'no_tipo_banco' => 'INTEGER')));
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Data', 'no_tipo_banco' => 'VARCHAR')));
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Hora', 'no_tipo_banco' => 'VARCHAR')));
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Data Hora', 'no_tipo_banco' => 'VARCHAR')));
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Número', 'no_tipo_banco' => 'NUMBER')));
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Lista Numérica', 'no_tipo_banco' => 'NUMBER')));
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Lista Texto', 'no_tipo_banco' => 'VARCHAR')));
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Texto', 'no_tipo_banco' => 'VARCHAR')));
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'UF', 'no_tipo_banco' => 'VARCHAR')));
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->findBy(),1);

        # Passo 5: Verificacao dos dados no container apos upload
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\FileFlow')->container('data/TrocaArquivo/container/20150813180733ENEM1510401_N02_AP_013_G190_EDITADO501480.zip', 'ENEM1510401_N02_AP_013_G190_EDITADO501480BEST.zip'), 1);
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\FileFlow')->validateStructure('data/TrocaArquivo/container/20150821190812ENEM1510401_N91_BR_23072015_002_I006_194396/20150821190812ENEM1510401_N91_BR_23072015_002_I006_194396-0.xml', 'http://inepskeleton.local/xsd/n91.xsd'), 1);
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\FileFlow')->validateSemantics('C:\Program Files (x86)\Zend\Apache2\htdocs\Novo SVN\INEP\ARQUITETURA_PHP\INEPSKELETON\trunk\Fontes\data\TrocaArquivo\destino_n02\20151013124305ENEM1510401_N02_AP_013_G190_199-0.xml', 1), 1);
//         d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\FileFlow')->process(1, 'data/TrocaArquivo/container/201603240946151n02_novo_robo_2mi_XML.zip'), 1);

        d('fim', 1);
    }

    public function generate()
    {
        $arrLayoutAll = array(
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
        $intId = 0;
        foreach ($arrLayoutAll as $strKey => $arrInfo) {
            ++$intId;
            switch ($strKey) {
                case '02':
                    $strTable = 'robo_enem.tb_n02_carga_ensalamento';
                    break;
                case '91':
                    $strTable = 'robo_enem.tb_n91_atendimentos';
                    break;
                default:
                    $strTable = null;
                    break;
            }
            $arrLayout = array(
                'id_layout' => null,
                'no_layout' => 'N' . $strKey,
                'ds_caminho' => 'public/xsd/n' . $strKey . '.xsd',
                'ds_url' => 'xsd/n' . $strKey . '.xsd',
                'ds_encode' => 'UTF-8',
                'ds_separador_coluna' => $arrInfo[0],
                'ds_separador_linha' => $arrInfo[1],
                'ds_procedure' => null,
                'ds_table' => $strTable,
                'in_status' => 1,
            );
            $arrConfiguracao = array(
                'id_configuracao' => null,
                'id_layout' => $intId,
                'co_projeto' => 13101,
                'co_evento' => 1,
                'sg_uf' => 'AP',
                'ds_destino' => 'data/TrocaArquivo/destino_n' . $strKey . '/',
                'ds_prioridade' => '0' . $strKey,
                'in_validacao_impeditiva' => true,
            );
            $arrConfiguracaoContato = array(
                'id_contato' => null,
                'id_configuracao' => $intId,
                'ds_email' => 'victor.vitorino@inep.gov.br',
            );
            $mixResult = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->save($arrLayout);
            d($mixResult);
            $mixResult = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->save($arrConfiguracao);
            d($mixResult);
            $mixResult = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoContatoFile')->save($arrConfiguracaoContato);
            d($mixResult);
        }
        $arrInterdependencia = array(
            'id_interdependencia' => null,
            'id_layout' => 18,
            'id_layout_dependente' => 1,
        );
        $arrResponsavel = array(
            'id_responsavel' => null,
            'id_usuario_sistema' => $this->getIdentity()->usuarioSistema->id,
            'co_projeto' => 13101,
            'sg_uf' => 'BR',
        );
        $mixResult = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\InterdependenciaFile')->save($arrInterdependencia);
        d($mixResult);
        $mixResult = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile')->save($arrResponsavel);
        d($mixResult);
        
        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'CPF', 'no_tipo_banco' => 'VARCHAR')));
        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'CEP', 'no_tipo_banco' => 'VARCHAR')));
        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Data', 'no_tipo_banco' => 'VARCHAR')));
        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Hora', 'no_tipo_banco' => 'VARCHAR')));
        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Data Hora', 'no_tipo_banco' => 'VARCHAR')));
        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Número', 'no_tipo_banco' => 'NUMBER')));
        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Lista', 'no_tipo_banco' => 'VARCHAR')));
        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'Texto', 'no_tipo_banco' => 'VARCHAR')));
        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->save(array('no_tipo' => 'UF', 'no_tipo_banco' => 'VARCHAR')));
//        d($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->findBy());        
        
        $arrFieldMock = array(
            # N91
            array(
                'id_layout' => 18,
                'no_campo' => 'CO_PROJETO',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 7,
                'ds_validacao' => null,
                'nu_ordem' => 1
            ),
            array(
                'id_layout' => 18,
                'no_campo' => 'TP_ORIGEM',
                'id_tipo' => 7,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 1,
                'ds_validacao' => implode('|', array('P', 'G','I', 'C', 'R')),
                'nu_ordem' => 2
            ),
            array(
                'id_layout' => 18,
                'no_campo' => 'CO_INSCRICAO',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 20,
                'ds_validacao' => null,
                'nu_ordem' => 3
            ),
            array(
                'id_layout' => 18,
                'no_campo' => 'ID_ITEM_ATENDIMENTO',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 4,
                'ds_validacao' => null,
                'nu_ordem' => 4
            ),
            array(
                'id_layout' => 18,
                'no_campo' => 'NO_ITEM_ATENDIMENTO',
                'id_tipo' => 8,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 100,
                'ds_validacao' => null,
                'nu_ordem' => 5
            ),            
            array(
                'id_layout' => 18,
                'no_campo' => 'TP_ITEM_ATENDIMENTO',
                'id_tipo' => 7,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 1,
                'ds_validacao' => implode('|', array(1, 2, 3, 4)),
                'nu_ordem' => 6
            ),
            array(
                'id_layout' => 18,
                'no_campo' => 'DS_ITEM_ATENDIMENTO',
                'id_tipo' => 8,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 500,
                'ds_validacao' => null,
                'nu_ordem' => 7
            ),
            array(
                'id_layout' => 18,
                'no_campo' => 'TX_OBSERVACAO_CID',
                'id_tipo' => 8,
                'in_obrigatoriedade' => false,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 1000,
                'ds_validacao' => null,
                'nu_ordem' => 8
            ),
            array(
                'id_layout' => 18,
                'no_campo' => 'IN_ATIVO',
                'id_tipo' => 7,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 1,
                'ds_validacao' => implode('|', array(0, 1)),
                'nu_ordem' => 9
            ),
            array(
                'id_layout' => 18,
                'no_campo' => 'SG_UF_MUNICIPIO_PROVA',
                'id_tipo' => 9,
                'in_obrigatoriedade' => false,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 2,
                'ds_validacao' => null,
                'nu_ordem' => 10
            ),
            array(
                'id_layout' => 18,
                'no_campo' => 'CO_JUSTIFICATIVA',
                'id_tipo' => 7,
                'in_obrigatoriedade' => false,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 2,
                'ds_validacao' => implode('|', array(100, 101, 102)),
                'nu_ordem' => 11
            ),
            
            # N02
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_PROJETO',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 7,
                'ds_validacao' => null,
                'nu_ordem' => 1
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'TP_ORIGEM',
                'id_tipo' => 7,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 1,
                'ds_validacao' => implode('|', array('P', 'G','I', 'C', 'R')),
                'nu_ordem' => 2
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_INSCRICAO',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 12,
                'ds_validacao' => null,
                'nu_ordem' => 3
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'NO_INSCRITO',
                'id_tipo' => 8,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 150,
                'ds_validacao' => null,
                'nu_ordem' => 4
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'NO_SOCIAL',
                'id_tipo' => 8,
                'in_obrigatoriedade' => false,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 100,
                'ds_validacao' => null,
                'nu_ordem' => 5
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'NU_CPF',
                'id_tipo' => 1,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 11,
                'ds_validacao' => null,
                'nu_ordem' => 6
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'NU_RG',
                'id_tipo' => 8,
                'in_obrigatoriedade' => false,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 40,
                'ds_validacao' => null,
                'nu_ordem' => 7
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'DT_NASCIMENTO',
                'id_tipo' => 3,
                'in_obrigatoriedade' => false,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 10,
                'ds_validacao' => null,
                'nu_ordem' => 8
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'TP_LINGUA_ESTRANGEIRA',
                'id_tipo' => 7,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 20,
                'ds_validacao' => implode('|', array('1', '2')),
                'nu_ordem' => 9
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'NO_LINGUA_ESTRANGEIRA',
                'id_tipo' => 7,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 7,
                'ds_validacao' => implode('|', array('INGLÊS', 'ESPANHOL')),
                'nu_ordem' => 10
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_ATENDIMENTO_LISTA_PRESENCA',
                'id_tipo' => 7,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 20,
                'ds_validacao' => implode('|', array('0', '1', '2', '3')),
                'nu_ordem' => 11
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'ID_KIT_PROVA',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 20,
                'ds_validacao' => null,
                'nu_ordem' => 12
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_COORDENACAO',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 5,
                'ds_validacao' => null,
                'nu_ordem' => 13
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'SG_UF_PROVA',
                'id_tipo' => 9,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 2,
                'ds_validacao' => null,
                'nu_ordem' => 14
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_MUNICIPIO_PROVA',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 12,
                'ds_validacao' => null,
                'nu_ordem' => 15
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'NO_MUNICIPIO_PROVA',
                'id_tipo' => 8,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 80,
                'ds_validacao' => null,
                'nu_ordem' => 16
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_LOCAL',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 20,
                'ds_validacao' => null,
                'nu_ordem' => 17
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'NO_LOCAL_PROVA',
                'id_tipo' => 8,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 250,
                'ds_validacao' => null,
                'nu_ordem' => 18
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_BLOCO',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 20,
                'ds_validacao' => null,
                'nu_ordem' => 19
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'NO_BLOCO',
                'id_tipo' => 8,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 20,
                'ds_validacao' => null,
                'nu_ordem' => 20
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'NO_ANDAR',
                'id_tipo' => 8,
                'in_obrigatoriedade' => false,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 20,
                'ds_validacao' => null,
                'nu_ordem' => 21
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'NO_SALA',
                'id_tipo' => 8,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 8,
                'ds_validacao' => null,
                'nu_ordem' => 22
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'NO_SALA_VIRTUAL',
                'id_tipo' => 8,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 8,
                'ds_validacao' => null,
                'nu_ordem' => 23
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'NU_SEQUENCIAL',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 3,
                'ds_validacao' => null,
                'nu_ordem' => 24
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'NU_SEQ_ENVELOPE',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 2,
                'ds_validacao' => null,
                'nu_ordem' => 25
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'NU_TOTAL_ENVELOPE',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 2,
                'ds_validacao' => null,
                'nu_ordem' => 26
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_BARRA_RESPOSTA_DIA1',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 20,
                'ds_validacao' => null,
                'nu_ordem' => 27
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_BARRA_RESPOSTA_DIA2',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 20,
                'ds_validacao' => null,
                'nu_ordem' => 28
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_BARRA_REDACAO',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 20,
                'ds_validacao' => null,
                'nu_ordem' => 29
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_BARRA_LISTAPRESENCA_DIA1',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 17,
                'ds_validacao' => null,
                'nu_ordem' => 30
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_BARRA_LISTAPRESENCA_DIA2',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 17,
                'ds_validacao' => null,
                'nu_ordem' => 31
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_BARRA_ATA_DIA1',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 17,
                'ds_validacao' => null,
                'nu_ordem' => 32
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_BARRA_ATA_DIA2',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 17,
                'ds_validacao' => null,
                'nu_ordem' => 33
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_BARRA_RASCUNHO',
                'id_tipo' => 6,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 20,
                'ds_validacao' => null,
                'nu_ordem' => 34
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_BARRA_QSC',
                'id_tipo' => 6,
                'in_obrigatoriedade' => false,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 20,
                'ds_validacao' => null,
                'nu_ordem' => 35
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'CO_JUSTIFICATIVA',
                'id_tipo' => 6,
                'in_obrigatoriedade' => false,
                'in_ocorrencia' => false,
                'ds_tamanho_max' => 2,
                'ds_validacao' => null,
                'nu_ordem' => 36
            ),
            array(
                'id_layout' => 1,
                'no_campo' => 'TP_IMPRIMIR',
                'id_tipo' => 7,
                'in_obrigatoriedade' => true,
                'in_ocorrencia' => false,
                'ds_tamanho_max_max' => 1,
                'ds_validacao' => implode('|', array('1', '2', '3')),
                'nu_ordem' => 37
            ),              
        );
        foreach ($arrFieldMock as $arrMock)
            $teste = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\EstruturaFile')->insert($arrMock);
        return true;
    }

}
