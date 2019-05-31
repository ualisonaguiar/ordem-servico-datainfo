<?php

namespace InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Service;

use InepZend\Module\TrocaArquivo\Common\Service\AbstractService;
use InepZend\Module\Ssi\Service\VwUsuario;
use InepZend\Module\Corporative\Service\VwProjeto;
use InepZend\Module\Corporative\Service\VwProjetoEvento;
use InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile;
use InepZend\Util\ArrayCollection;
use InepZend\Util\Format;
use InepZend\Util\FileSystem;
use InepZend\Util\Server;
use InepZend\Util\Date;
use InepZend\Exception\DomainException;

class MonitoramentoEnvio extends AbstractService
{

    protected function getDataToShow($intIdArquivo = null, $booPersonalInfo = false)
    {
        $arrData = array();
        $arrDataComplement = array();
        $arrCriteria = array(
            'id_arquivo' => (integer) $intIdArquivo,
        );
        $configuracao = null;
        $arrData['arquivo'] = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ArquivoFile')->findBy($arrCriteria);
        if (!empty($arrData['arquivo'])) {
            $arrDataArquivo = array();
            foreach ((array) $arrData['arquivo'] as $arquivo)
                $arrDataArquivo['arquivo'][] = array('ds_filesize' => $arquivo->getDsFilesize(), 'dt_envio' => $arquivo->getDtEnvio());
            $arrDataComplement = ArrayCollection::merge($arrDataComplement, $arrDataArquivo, true);
            unset($arrDataArquivo);
            $arquivo = end($arrData['arquivo']);
            if (is_object($arquivo)) {
                $arrData['configuracao'] = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->findBy(array('id_configuracao' => $arquivo->getIdConfiguracao()));
                if (!empty($arrData['configuracao'])) {
                    $arrDataConfiguracao = array();
                    foreach ((array) $arrData['configuracao'] as $configuracao)
                        $arrDataConfiguracao['configuracao'][] = array('no_projeto' => VwProjeto::getNameFromCoProjeto($configuracao->getCoProjeto()), 'no_configuracao' => VwProjetoEvento::getNameFromCoProjetoEvento($configuracao->getCoProjeto(), $configuracao->getCoEvento()), 'ds_validacao_impeditiva' => $configuracao->getDsValidacaoImpeditiva());
                    $arrDataComplement = ArrayCollection::merge($arrDataComplement, $arrDataConfiguracao, true);
                    unset($arrDataConfiguracao);
                    $configuracao = end($arrData['configuracao']);
                    if (is_object($configuracao)) {
                        $arrData['configuracaoContato'] = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoContatoFile')->findBy(array('id_configuracao' => $configuracao->getIdConfiguracao()), array('id_contato' => 'asc'));
                        $arrData['layout'] = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy(array('id_layout' => $configuracao->getIdLayout()));
                        $arrDataLayout = array();
                        foreach ((array) $arrData['layout'] as $layout)
                            $arrDataLayout['layout'][] = array('no_status_layout' => Format::convertToStatus($layout->getInStatus()));
                        $arrDataComplement = ArrayCollection::merge($arrDataComplement, $arrDataLayout, true);
                        unset($arrDataLayout);
                        $arrData['interdependencia'] = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\InterdependenciaFile')->findBy(array('id_layout' => $configuracao->getIdLayout()));
                        $arrDataInterdependencia = array();
                        foreach ((array) $arrData['interdependencia'] as $interdependencia)
                            $arrDataInterdependencia['interdependencia'][] = array('no_layout' => LayoutFile::getNameFromIdLayout($interdependencia->getIdLayoutDependente()), 'no_status_layout' => LayoutFile::getStatusFromIdLayout($interdependencia->getIdLayoutDependente()));
                        $arrDataComplement = ArrayCollection::merge($arrDataComplement, $arrDataInterdependencia, true);
                        unset($arrDataInterdependencia);
                    }
                }
                $arrData['responsavel'] = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile')->findBy(array('id_responsavel' => $arquivo->getIdResponsavel()));
                $arrDataResponsavel = array();
                foreach ((array) $arrData['responsavel'] as $responsavel)
                    $arrDataResponsavel['responsavel'][] = array('no_usuario' => VwUsuario::getNameFromIdUsuarioSistema($responsavel->getIdUsuarioSistema()));
                $arrDataComplement = ArrayCollection::merge($arrDataComplement, $arrDataResponsavel, true);
                unset($arrDataResponsavel);
            }
        }
        if ($booPersonalInfo) {
            if (!is_object($configuracao))
                throw new DomainException('Configuração inexistente/inválida.');
            $booOk = false;
            $arrConfiguracao = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->findByPersonal();
            foreach ($arrConfiguracao as $configuracaoFile) {
                if ($configuracaoFile->getIdConfiguracao() == $configuracao->getIdConfiguracao()) {
                    $booOk = true;
                    break;
                }
            }
            if (!$booOk)
                throw new DomainException('Arquivo não pertencente à alguma configuração de envio compatível com suas informações pessoais.');
        }
        $arrData['andamento'] = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\AndamentoFile')->findBy($arrCriteria, array('id_andamento' => 'asc'));
        $arrDataAndamento = array();
        foreach ((array) $arrData['andamento'] as $andamento)
            $arrDataAndamento['andamento'][] = array('tp_andamento_html' => $andamento->getTpAndamentoHtml(), 'dt_andamento' => $andamento->getDtAndamento());
        $arrDataComplement = ArrayCollection::merge($arrDataComplement, $arrDataAndamento, true);
        unset($arrDataAndamento);
        if ((is_object($arquivo)) && (is_object($configuracao)))
            $arrData['arquivoProcesso'] = $this->findByArquivoProcesso($intIdArquivo, $arquivo->getDsCaminho(), $configuracao->getDsDestino(), true);
        $arrData['resultadoValidacao'] = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResultadoValidacaoFile')->findBy($arrCriteria, array('id_resultado' => 'asc'));
        $arrDataResultadoValidacao = array();
        foreach ((array) $arrData['resultadoValidacao'] as $resultadoValidacao)
            $arrDataResultadoValidacao['resultadoValidacao'][] = array('no_arquivo' => $resultadoValidacao->getNoArquivo(), 'no_status_html' => $resultadoValidacao->getNoStatusHtml(), 'dt_inicio' => $resultadoValidacao->getDtInicio(), 'dt_fim' => $resultadoValidacao->getDtFim());
        $arrDataComplement = ArrayCollection::merge($arrDataComplement, $arrDataResultadoValidacao, true);
        unset($arrDataResultadoValidacao);
        $arrData['erro'] = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ErroFile')->findBy($arrCriteria, array('id_erro' => 'asc'));
        $arrDataErro = array();
        foreach ((array) $arrData['erro'] as $erro)
            $arrDataErro['erro'][] = array('ds_resultado_html' => $erro->getDsResultadoHtml());
        $arrDataComplement = ArrayCollection::merge($arrDataComplement, $arrDataErro, true);
        unset($arrDataErro);
        return ArrayCollection::merge(ArrayCollection::objectToArrayRecursive($arrData), $arrDataComplement, true);
    }
    
    protected function findByArquivoProcesso($intIdArquivo = null, $strDsCaminho = null, $strDsDestino = null, $booConvertToArquivoProcessoTable = null) 
    {
        $arrRegister =  array();
        $arrFlow = array('upload' => 'orange', 'container' => 'blue', 'failure' => 'red', 'destino' => 'green');
        foreach ($arrFlow as $strFlow => $strColor) {
            if (strpos($strDsCaminho, '/') === false) {
                $strPartFile = $intIdArquivo . reset(explode('.',  $strDsCaminho));
                $intPos = 14;
            } else {
                $strPartFile = reset(explode('.',  end(explode('/', $strDsCaminho))));
                $intPos = 0;
            }
            $arrRegisterFile = array();
            $arrFile = FileSystem::scandirRecursive(($strFlow == 'destino') ? $strDsDestino : 'data/TrocaArquivo/' . $strFlow . '/', null, array(), false, false);
            foreach ($arrFile as $intKey => $strFile) {
                if ($strFlow == 'destino') {
                    if (strpos($strFile, $strPartFile) === false)
                        continue;
                } elseif (strpos(end(explode('/' . $strFlow . '/', $strFile)), $strPartFile) !== $intPos)
                    continue;
                $strDtModificacao = FileSystem::getModificationTime($strFile);
                $arrRegisterFile[Date::convertDate($strDtModificacao, 'YmdHis') . str_pad($intKey, 4, '0', STR_PAD_LEFT)] = array(
                    'ds_flow' => $strFlow,
                    'ds_caminho' => $strFile,
                    'ds_caminho_editado' => str_replace('/' . $strFlow . '/', '/<font style="color: ' . $strColor . '; font-weight: bold;">' . $strFlow . '</font>/', end(explode('data/TrocaArquivo' , $strFile))),
                    'ds_size' => FileSystem::filesizeFormated($strFile),
                    'ds_conteudo' => ((stripos($strFile, '.control') !== false) ? nl2br(FileSystem::getContentFromFile($strFile)) : null),
                    'dt_modificacao' => $strDtModificacao,
                );
            }
            ksort($arrRegisterFile);
            $arrRegister = ArrayCollection::merge($arrRegister, array_values($arrRegisterFile));
        }
        $arrRegister = array_values($arrRegister);
        return ($booConvertToArquivoProcessoTable !== true) ? $arrRegister : $this->convertToArquivoProcessoTable($arrRegister);
    }
    
    private function convertToArquivoProcessoTable($arrArquivoProcesso = null)
    {
        $arrRegister = array();
        foreach ($arrArquivoProcesso as $arrInfo) {
            $booEnd = (!in_array(@$arrInfo['ds_flow'], array('upload', 'container')));
            $arrRegister[] = array(
                'ds_arquivo' => '<div style="margin-top: 5px; margin-bottom: 5px; min-height: 28px;">
                    <div style="overflow: hidden;">
                        <div style="float: left; width: 83%;' . (($booEnd) ? ' font-weight: bold; color: ' . ((@$arrInfo['ds_flow'] == 'failure') ? 'red' : 'green') . ';' : '') . '">' . @$arrInfo['ds_caminho_editado'] . '</div>
                        <div style="float: left; width: 10%; font-size: 10px;">' . @$arrInfo['dt_modificacao'] . '</div>
                        <div style="font-size: 10px;">' . @$arrInfo['ds_size'] . '</div>
                    </div>
                    <div style="font-size: 10px; overflow: hidden;">' . @$arrInfo['ds_conteudo'] . '</div>
                    ' . (($booEnd) ? '<div><a href="' . Server::getBaseUrl() . getShowFileUrl(@$arrInfo['ds_caminho']) . '" target="_self">download</a></div>' : '') . '
                </div>',
            );
        }
        return $arrRegister;
    }

}
