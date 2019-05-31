<?php

namespace InepZend\Module\Ssi;

use InepZend\ModuleConfig\ModuleConfig;
use InepZend\Module\Ssi\Service\AcaoMenu;
use InepZend\Module\Ssi\Service\AcaoAclRoute;
use InepZend\Module\Ssi\Service\AcaoAclFormElement;
use InepZend\Module\Ssi\Form\AcaoMenu as AcaoMenuForm;
use InepZend\Module\Ssi\Form\AcaoAclRoute as AcaoAclRouteForm;
use InepZend\Module\Ssi\Form\AcaoAclFormElement as AcaoAclFormElementForm;
use InepZend\Module\Ssi\Service\UsuarioSistemaPerfilLog;
use InepZend\Module\Ssi\Service\SubtipoContato;
use InepZend\Module\Ssi\Service\Acao;
use InepZend\Module\Ssi\Service\ConfiguracaoSistema;
use InepZend\Module\Ssi\Service\Contato;
use InepZend\Module\Ssi\Service\Perfil;
use InepZend\Module\Ssi\Service\PerfilAcao;
use InepZend\Module\Ssi\Service\PerguntaSecreta;
use InepZend\Module\Ssi\Service\Sistema;
use InepZend\Module\Ssi\Service\TipoConfiguracao;
use InepZend\Module\Ssi\Service\TipoSituacaoUsuario;
use InepZend\Module\Ssi\Service\Usuario;
use InepZend\Module\Ssi\Service\UsuarioSistema;
use InepZend\Module\Ssi\Service\UsuarioSistemaPerfil;
use InepZend\Module\Ssi\Service\HistoricoAcesso;
use InepZend\Module\Ssi\Service\LogErro;
use InepZend\Module\Ssi\Service\TipoAmbiente;
use InepZend\Module\Ssi\Service\SistemaAmbiente;
use InepZend\Module\Ssi\Service\TipoUsuario;
use InepZend\Module\Ssi\Service\HistoricoContato;
use InepZend\Module\Ssi\Service\HistoricoPerfilAcao;
use InepZend\Module\Ssi\Service\HistoricoUsuario;
use InepZend\Module\Ssi\Service\HistUsuarioSistemaPerfil;
use InepZend\Module\Ssi\Service\Servico;
use InepZend\Module\Ssi\Service\ServicoAmbienteSistema;
use InepZend\Module\Ssi\Service\ServicoAmbiente;
use InepZend\Module\Ssi\Service\HistServico;
use InepZend\Module\Ssi\Service\HistServicoAmbienteSist;
use InepZend\Module\Ssi\Service\HistServicoAmbiente;
use InepZend\Module\Ssi\Service\LogAcao;
use InepZend\Module\Ssi\Service\LogConfiguracaoSistema;
use InepZend\Module\Ssi\Service\LogContato;
use InepZend\Module\Ssi\Service\LogPerfil;
use InepZend\Module\Ssi\Service\LogPerfilAcao;
use InepZend\Module\Ssi\Service\LogPerguntaSecreta;
use InepZend\Module\Ssi\Service\LogServico;
use InepZend\Module\Ssi\Service\LogServicoAmbiente;
use InepZend\Module\Ssi\Service\LogServicoAmbienteSist;
use InepZend\Module\Ssi\Service\LogSistema;
use InepZend\Module\Ssi\Service\LogSistemaAmbiente;
use InepZend\Module\Ssi\Service\LogSubtipoContato;
use InepZend\Module\Ssi\Service\LogTipoAmbiente;
use InepZend\Module\Ssi\Service\LogTipoConfiguracao;
use InepZend\Module\Ssi\Service\LogTipoSituacaoUsuario;
use InepZend\Module\Ssi\Service\LogTipoUsuario;
use InepZend\Module\Ssi\Service\LogUsuario;
use InepZend\Module\Ssi\Service\LogUsuarioSistema;
use InepZend\Module\Ssi\Service\LogUsuarioSistemaPerfil;
use InepZend\Module\Ssi\Service\PerfilDependencia;
use InepZend\Module\Ssi\Service\LogPerfilDependencia;
use InepZend\Module\Ssi\Service\ServicoSistema;
use InepZend\Module\Ssi\Service\LogServicoSistema;
use InepZend\Module\Ssi\Service\VwContato;
use InepZend\Module\Ssi\Service\VwPerfilDependencia;
use InepZend\Module\Ssi\Service\VwHistoricoAcesso;
use InepZend\Module\Ssi\Service\VwPerfil;
use InepZend\Module\Ssi\Service\VwPerfilAcao;
use InepZend\Module\Ssi\Service\VwSistema;
use InepZend\Module\Ssi\Service\VwUsuario;
use InepZend\Module\Ssi\Service\VwUsuarioSemSistema;
use InepZend\Module\Ssi\Service\VwUsuarioSistemaPerfil;
use InepZend\Ssi\Service\Perfil as PerfilLibrary;
use InepZend\Ssi\Service\PerfilAcao as PerfilAcaoLibrary;
use InepZend\Ssi\Service\Usuario as UsuarioLibrary;
use InepZend\Ssi\Service\UsuarioSistemaPerfil as UsuarioSistemaPerfilLibrary;
use InepZend\Module\Ssi\Form\PersonalInfo as PersonalInfoForm;
use InepZend\Module\Ssi\Service\PersonalInfo;

class Module extends ModuleConfig
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InepZend\Module\Ssi\Service\AcaoMenu' => function() {
                    return new AcaoMenu();
                },
                'InepZend\Module\Ssi\Service\AcaoAclRoute' => function() {
                    return new AcaoAclRoute();
                },
                'InepZend\Module\Ssi\Service\AcaoAclFormElement' => function() {
                    return new AcaoAclFormElement();
                },
                'InepZend\Module\Ssi\Form\AcaoMenu' => function() {
                    return new AcaoMenuForm();
                },
                'InepZend\Module\Ssi\Form\AcaoAclRoute' => function() {
                    return new AcaoAclRouteForm();
                },
                'InepZend\Module\Ssi\Form\AcaoAclFormElement' => function() {
                    return new AcaoAclFormElementForm();
                },
                'InepZend\Module\Ssi\Service\UsuarioSistemaPerfilLog' => function($serviceManager) {
                    return new UsuarioSistemaPerfilLog($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\SubtipoContato' => function($serviceManager) {
                    return new SubtipoContato($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\Acao' => function($serviceManager) {
                    return new Acao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\ConfiguracaoSistema' => function($serviceManager) {
                    return new ConfiguracaoSistema($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\Contato' => function($serviceManager) {
                    return new Contato($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\Perfil' => function($serviceManager) {
                    return new Perfil($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\PerfilAcao' => function($serviceManager) {
                    return new PerfilAcao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\PerguntaSecreta' => function($serviceManager) {
                    return new PerguntaSecreta($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\Sistema' => function($serviceManager) {
                    return new Sistema($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\TipoConfiguracao' => function($serviceManager) {
                    return new TipoConfiguracao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\TipoSituacaoUsuario' => function($serviceManager) {
                    return new TipoSituacaoUsuario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\Usuario' => function($serviceManager) {
                    return new Usuario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\UsuarioSistema' => function($serviceManager) {
                    return new UsuarioSistema($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\UsuarioSistemaPerfil' => function($serviceManager) {
                    return new UsuarioSistemaPerfil($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\HistoricoAcesso' => function($serviceManager) {
                    return new HistoricoAcesso($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogErro' => function($serviceManager) {
                    return new LogErro($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\TipoAmbiente' => function($serviceManager) {
                    return new TipoAmbiente($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\SistemaAmbiente' => function($serviceManager) {
                    return new SistemaAmbiente($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\TipoUsuario' => function($serviceManager) {
                    return new TipoUsuario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\HistoricoContato' => function($serviceManager) {
                    return new HistoricoContato($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\HistoricoPerfilAcao' => function($serviceManager) {
                    return new HistoricoPerfilAcao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\HistoricoUsuario' => function($serviceManager) {
                    return new HistoricoUsuario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\HistUsuarioSistemaPerfil' => function($serviceManager) {
                    return new HistUsuarioSistemaPerfil($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\Servico' => function($serviceManager) {
                    return new Servico($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\ServicoAmbienteSistema' => function($serviceManager) {
                    return new ServicoAmbienteSistema($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\ServicoAmbiente' => function($serviceManager) {
                    return new ServicoAmbiente($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\HistServico' => function($serviceManager) {
                    return new HistServico($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\HistServicoAmbienteSist' => function($serviceManager) {
                    return new HistServicoAmbienteSist($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\HistServicoAmbiente' => function($serviceManager) {
                    return new HistServicoAmbiente($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogAcao' => function($serviceManager) {
                    return new LogAcao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogConfiguracaoSistema' => function($serviceManager) {
                    return new LogConfiguracaoSistema($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogContato' => function($serviceManager) {
                    return new LogContato($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogPerfil' => function($serviceManager) {
                    return new LogPerfil($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogPerfilAcao' => function($serviceManager) {
                    return new LogPerfilAcao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogPerguntaSecreta' => function($serviceManager) {
                    return new LogPerguntaSecreta($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogServico' => function($serviceManager) {
                    return new LogServico($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogServicoAmbiente' => function($serviceManager) {
                    return new LogServicoAmbiente($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogServicoAmbienteSist' => function($serviceManager) {
                    return new LogServicoAmbienteSist($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogSistema' => function($serviceManager) {
                    return new LogSistema($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogSistemaAmbiente' => function($serviceManager) {
                    return new LogSistemaAmbiente($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogSubtipoContato' => function($serviceManager) {
                    return new LogSubtipoContato($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogTipoAmbiente' => function($serviceManager) {
                    return new LogTipoAmbiente($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogTipoConfiguracao' => function($serviceManager) {
                    return new LogTipoConfiguracao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogTipoSituacaoUsuario' => function($serviceManager) {
                    return new LogTipoSituacaoUsuario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogTipoUsuario' => function($serviceManager) {
                    return new LogTipoUsuario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogUsuario' => function($serviceManager) {
                    return new LogUsuario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogUsuarioSistema' => function($serviceManager) {
                    return new LogUsuarioSistema($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogUsuarioSistemaPerfil' => function($serviceManager) {
                    return new LogUsuarioSistemaPerfil($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\PerfilDependencia' => function($serviceManager) {
                    return new PerfilDependencia($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogPerfilDependencia' => function($serviceManager) {
                    return new LogPerfilDependencia($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\ServicoSistema' => function($serviceManager) {
                    return new ServicoSistema($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\LogServicoSistema' => function($serviceManager) {
                    return new LogServicoSistema($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\VwContato' => function($serviceManager) {
                    return new VwContato($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\VwHistoricoAcesso' => function($serviceManager) {
                    return new VwHistoricoAcesso($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\VwPerfil' => function($serviceManager) {
                    return new VwPerfil($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\VwPerfilAcao' => function($serviceManager) {
                    return new VwPerfilAcao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\VwPerfilDependencia' => function($serviceManager) {
                    return new VwPerfilDependencia($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\VwSistema' => function($serviceManager) {
                    return new VwSistema($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\VwUsuario' => function($serviceManager) {
                    return new VwUsuario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\VwUsuarioSemSistema' => function($serviceManager) {
                    return new VwUsuarioSemSistema($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Service\VwUsuarioSistemaPerfil' => function($serviceManager) {
                    return new VwUsuarioSistemaPerfil($this->getEntityManager($serviceManager));
                },
                'InepZend\Ssi\Service\Perfil' => function($serviceManager) {
                    return new PerfilLibrary($this->getEntityManager($serviceManager));
                },
                'InepZend\Ssi\Service\PerfilAcao' => function($serviceManager) {
                    return new PerfilAcaoLibrary($this->getEntityManager($serviceManager));
                },
                'InepZend\Ssi\Service\Usuario' => function($serviceManager) {
                    return new UsuarioLibrary($this->getEntityManager($serviceManager));
                },
                'InepZend\Ssi\Service\UsuarioSistemaPerfil' => function($serviceManager) {
                    return new UsuarioSistemaPerfilLibrary($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Ssi\Form\PersonalInfo' => function() {
                    return new PersonalInfoForm();
                },
                'InepZend\Module\Ssi\Service\PersonalInfo' => function() {
                    return new PersonalInfo();
                },
            ),
        );
    }

}
