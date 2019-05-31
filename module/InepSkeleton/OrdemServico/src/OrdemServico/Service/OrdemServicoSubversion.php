<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Util\ArrayCollection;
use OrdemServico\Entity\Usuario as UsuarioEntity;
use InepZend\Util\String;
use OrdemServico\Entity\OrdemServico as OrdemServicoEntity;

class OrdemServicoSubversion extends AbstractServiceManager
{

    protected function getNumeroSequencial()
    {
        $arrInformationSvn = $this->getService('config')['informacao-svn'];
        $strPathSvn = $arrInformationSvn['path'];
        $hasNumeroSequencial = $this->getNumero($strPathSvn);
        if (!$hasNumeroSequencial) {
            $hasNumeroSequencial = $this->getNumero(str_replace(date('Y'), date('Y') - 1, $strPathSvn));
            if (!$hasNumeroSequencial) {
                return str_pad(1, 4, '0', STR_PAD_LEFT);
            }
        }
        return $hasNumeroSequencial;
    }

    protected function movePaste($strNome, $intNumeroOs, $strPathOld, UsuarioEntity $usuarioAlteracao)
    {
        $arrInformationPaste = $this->getInformation($strPathOld);
        if (!$arrInformationPaste) {
            return $this->createPaste($strNome, $usuarioAlteracao);
        } else {
            $strPaste = $this->generateNamePaste($intNumeroOs, $strNome);
            $strMessage = '"' . $usuarioAlteracao->getNoUsuario() . ' (' . $usuarioAlteracao->getDsEmail() . ')' . ' -- Alteração da OS: ' . $strPaste . '"';
            $strMessage = String::clearWord($strMessage);
            $arrInformationSvn = $this->getService('config')['informacao-svn'];
            $strCommand = $this->commandSvnDefault();
            $strCommand .= ' move -m %s %s %s';
            $strCommand = sprintf($strCommand, $strMessage, $strPathOld, $arrInformationSvn['path'] . '/' . $strPaste);
            shell_exec(trim($strCommand));
            return $arrInformationSvn['path'] . '/' . $strPaste;
        }
    }

    protected function getInformation($strPaste)
    {
        $strCommand = $this->commandSvnDefault() . ' info %s';
        $strCommand = sprintf($strCommand, $strPaste);
        $strReturnExecute = trim(shell_exec($strCommand));
        return (empty($strReturnExecute)) ? [] : explode("\n", $strReturnExecute);
    }

    protected function createPaste($strPaste, UsuarioEntity $usuarioAlteracao, $intNumeroOs = null)
    {
        if (!$intNumeroOs) {
            $intNumeroOs = $this->getNumeroSequencial();
        }
        $strPaste = $this->generateNamePaste($intNumeroOs, $strPaste);
        $arrInformationSvn = $this->getService('config')['informacao-svn'];
        $strMessage = '"' . $usuarioAlteracao->getNoUsuario() . ' (' . $usuarioAlteracao->getDsEmail() . ')' . ' -- Criando a OS: ' . $strPaste . '"';
        $strMessage = String::clearWord($strMessage);
        $strCommand = $this->commandSvnDefault();
        $strCommand .= ' mkdir -m %s %s';
        $strCommand = sprintf($strCommand, $strMessage, $arrInformationSvn['path'] . '/' . $strPaste);
        $strReturnExecute = trim(shell_exec($strCommand));
        if (strpos($strReturnExecute, 'Committed revision') === false) {
            throw new \Exception('Não possível cria a pasta no svn. Erro: ' . $strReturnExecute);
        }
        return $arrInformationSvn['path'] . '/' . $strPaste;
    }

    protected function excludeFolder($strNameDirecotry, $strMessage, UsuarioEntity $usuarioAlteracao)
    {
        try {
            $strMessage = '"' . $usuarioAlteracao->getNoUsuario() . ' (' . $usuarioAlteracao->getDsEmail() . ')' . ' -- Excluindo a pasta pelo erro:' . $strMessage . '"';
            $strMessage = String::clearWord($strMessage);
            $arrInformationSvn = $this->getService('config')['informacao-svn'];
            return $this->excluideFolderFile($arrInformationSvn['path'] . '/' . $strNameDirecotry, $strMessage);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    protected function excluideFolderFile($strBasePath, $strMessage)
    {
        $arrInformationDirectory = $this->getInformation($strBasePath);
        if (empty($arrInformationDirectory)) {
            return true;
        }
        $strCommand = $this->commandSvnDefault();
        $strCommand .= ' rm -m %s %s';
        $strMessage = String::clearWord($strMessage);
        $strCommand = sprintf($strCommand, $strMessage, $strBasePath);
        $strReturnExecute = trim(shell_exec($strCommand));
        if (strpos($strReturnExecute, 'Committed revision') === false) {
            throw new \Exception('Não possível excluir a pasta/arquivo no svn. Erro: ' . $strReturnExecute);
        }
        return true;
    }

    protected function versionarArquivos(OrdemServicoEntity $ordemServico, UsuarioEntity $usuarioAlteracao)
    {
        $arrTypesDocuments = OrdemServicoEntity::$arrTypeDocuments;
        $arrNameDocuments = [
            1 => '%s',
            2 => 'RE-%s',
            3 => 'RT-%s',
        ];
        # removendo o relatorio tecnico do fiscal (padronizado)
        unset ($arrTypesDocuments[4]);
        $serviceOrdemServicoFile = $this->getService('OrdemServico\Service\OrdemServicoFile');
        $strNameFile = $this->generateNamePaste($ordemServico->getNuOrdemServico(), $ordemServico->getDsNome()) . '.pdf';
        $strMessage = '"' . $usuarioAlteracao->getNoUsuario() . ' (' . $usuarioAlteracao->getDsEmail() . ')' . ' -- Versionando novos arquivos da Ordem de Serviço"';
        $strMessage = String::clearWord($strMessage);
        $arrPathFileSvn = [];
        foreach (array_keys($arrTypesDocuments) as $intTypeRelatorio) {
            $strNameFile = sprintf($arrNameDocuments[$intTypeRelatorio], $strNameFile);
            $strPathFile = getBasePathApplication() . '/data/' .$strNameFile;
            if (is_file($strPathFile)) {
                unlink($strPathFile);
            }
            $strPath = $serviceOrdemServicoFile->createDocument($ordemServico, ['type_print' => [$intTypeRelatorio]]);
            $strPathSvnFile = $ordemServico->getDsSvn() . '/' . $strNameFile;
            # removendo o arquivo presente
            # @TODO verificar porque nao esta excluindo
//            $this->excluideFolderFile($strPathSvnFile, $strMessage, $usuarioAlteracao);
            # versionando novo arquivo
            $strCommand = $this->commandSvnDefault();
            $strCommand .= ' import -m %s %s %s';
            $strPath = getBasePathApplication() . $strPath;
            $strCommand = sprintf($strCommand, $strMessage, $strPath, $strPathSvnFile);
            # @TODO verificar porque nao esta adicionando
//            $strReturnExecute = shell_exec(trim($strCommand));
//            if (strpos($strReturnExecute, 'Committed revision') === false) {
//                throw new \Exception('Não possível excluir a pasta/arquivo no svn.');
//            }
            copy($strPath, $strPathFile);
            unlink($strPath);
            $arrPathFileSvn[] = $strPathFile;
        }
        return $arrPathFileSvn;
    }

    private function generateNamePaste($intNumeroOs, $strName)
    {
        return 'OS' . str_pad($intNumeroOs, 4, '0', STR_PAD_LEFT) . '-' . String::clearWord($strName);
    }

    private function commandSvnDefault()
    {
        $strCommand = 'svn --no-auth-cache --non-interactive --trust-server-cert --username=%s --password=%s ';
        $infouser = $this->getIdentity()->usuarioSistema->usuario;
        return trim(sprintf($strCommand, strtolower($infouser->login), $infouser->pass));
    }

    private function getNumero($strPath) {
        $strCommand = $this->commandSvnDefault() . ' list %s';
        $arrExecute = explode("\n", shell_exec(sprintf($strCommand, $strPath)));
        ArrayCollection::clearEmptyParam($arrExecute);
        if (empty($arrExecute)) {
            return false;
        }
        $intSequencial = intval(str_replace('OS', '', reset(explode('-', end($arrExecute))))) + 1;
        return str_pad($intSequencial, 4, '0', STR_PAD_LEFT);
    }
}
