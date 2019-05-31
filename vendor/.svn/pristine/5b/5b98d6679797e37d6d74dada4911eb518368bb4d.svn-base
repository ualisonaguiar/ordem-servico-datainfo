<?php

namespace InepZend\Module\TrocaArquivo;

use InepZend\ModuleConfig\ModuleConfig;
use InepZend\Module\TrocaArquivo\Common\Service\File\ErroFile;
use InepZend\Module\TrocaArquivo\Common\Service\File\ResultadoValidacaoFile;
use InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile;
use InepZend\Module\TrocaArquivo\Common\Service\File\InterdependenciaFile;
use InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile;
use InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoContatoFile;
use InepZend\Module\TrocaArquivo\Common\Service\File\ArquivoFile;
use InepZend\Module\TrocaArquivo\Common\Service\File\AndamentoFile;
use InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile;
use InepZend\Module\TrocaArquivo\Common\Service\File\EstruturaFile;
use InepZend\Module\TrocaArquivo\Common\Service\File\Tipo;
use InepZend\Module\TrocaArquivo\Common\Service\File\MassaTesteFile;
use InepZend\Module\TrocaArquivo\Common\Service\FileFlow;
use InepZend\Module\TrocaArquivo\EnvioDado\Service\EnvioDado;
use InepZend\Module\TrocaArquivo\EnvioDado\Form\EnvioDado as EnvioDadoForm;
use InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Service\MonitoramentoEnvio;
use InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Service\AcompanhamentoEnvio;
use InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Form\MonitoramentoEnvio as MonitoramentoEnvioForm;
use InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Form\AcompanhamentoEnvio as AcompanhamentoEnvioForm;
use InepZend\Module\TrocaArquivo\ConfigEnvio\Service\ConfigEnvio;
use InepZend\Module\TrocaArquivo\ConfigEnvio\Form\ConfigEnvio as ConfigEnvioForm;
use InepZend\Module\TrocaArquivo\MassaTeste\Service\MassaTeste;
use InepZend\Module\TrocaArquivo\MassaTeste\Service\ArquivoTeste;
use InepZend\Module\TrocaArquivo\LayoutEstrutural\Form\LayoutEstrutural as LayoutEstruturalForm;
use InepZend\Module\TrocaArquivo\LayoutEstrutural\Form\LayoutFile as LayoutFileForm;
use InepZend\Module\TrocaArquivo\ResponsavelEnvio\Service\ResponsavelEnvio;
use InepZend\Module\TrocaArquivo\ResponsavelEnvio\Form\ResponsavelEnvio as ResponsavelEnvioForm;
use InepZend\Module\TrocaArquivo\MassaTeste\Service\GeradorMassa;
use InepZend\Module\TrocaArquivo\Common\Service\File\IlhaDadoFile;
use InepZend\Module\TrocaArquivo\Common\Service\File\RegraValidacaoFile;
use InepZend\Module\TrocaArquivo\IlhaDado\Service\IlhaDado;
use InepZend\Module\TrocaArquivo\IlhaDado\Form\IlhaDado as IlhaDadoForm;
use InepZend\Module\TrocaArquivo\LayoutValidacao\Service\RegraValidacao;
use InepZend\Module\TrocaArquivo\LayoutValidacao\Form\RegraValidacao as RegraValidacaoForm;
use InepZend\Module\TrocaArquivo\Cliente\Service\Cliente;
use InepZend\Module\TrocaArquivo\Cliente\Form\Cliente as ClienteForm;

class Module extends ModuleConfig
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InepZend\Module\TrocaArquivo\Common\Service\File\ErroFile' => function($serviceManager = null) {
                    return new ErroFile($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\Common\Service\File\ResultadoValidacaoFile' => function($serviceManager = null) {
                    return new ResultadoValidacaoFile($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile' => function($serviceManager = null) {
                    return new LayoutFile($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\Common\Service\File\InterdependenciaFile' => function($serviceManager = null) {
                    return new InterdependenciaFile($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile' => function($serviceManager = null) {
                    return new ConfiguracaoFile($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoContatoFile' => function($serviceManager = null) {
                    return new ConfiguracaoContatoFile($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\Common\Service\File\ArquivoFile' => function($serviceManager = null) {
                    return new ArquivoFile($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\Common\Service\File\AndamentoFile' => function($serviceManager = null) {
                    return new AndamentoFile($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile' => function($serviceManager = null) {
                    return new ResponsavelFile($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\Common\Service\File\EstruturaFile' => function($serviceManager = null) {
                    return new EstruturaFile($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\Common\Service\File\Tipo' => function($serviceManager = null) {
                    return new Tipo($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\Common\Service\File\MassaTesteFile' => function($serviceManager = null) {
                    return new MassaTesteFile($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\Common\Service\File\ArquivoTeste' => function($serviceManager = null) {
                    return new ArquivoTeste($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\Common\Service\FileFlow' => function() {
                    return new FileFlow();
                },
                'InepZend\Module\TrocaArquivo\EnvioDado\Service\EnvioDado' => function() {
                    return new EnvioDado();
                },
                'InepZend\Module\TrocaArquivo\EnvioDado\Form\EnvioDado' => function() {
                    return new EnvioDadoForm();
                },
                'InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Service\MonitoramentoEnvio' => function() {
                    return new MonitoramentoEnvio();
                },
                'InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Service\AcompanhamentoEnvio' => function() {
                    return new AcompanhamentoEnvio();
                },
                'InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Form\MonitoramentoEnvio' => function() {
                    return new MonitoramentoEnvioForm();
                },
                'InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Form\AcompanhamentoEnvio' => function() {
                    return new AcompanhamentoEnvioForm();
                },
                'InepZend\Module\TrocaArquivo\ConfigEnvio\Service\ConfigEnvio' => function() {
                    return new ConfigEnvio();
                },
                'InepZend\Module\TrocaArquivo\ConfigEnvio\Form\ConfigEnvio' => function() {
                    return new ConfigEnvioForm();
                },
                'InepZend\Module\TrocaArquivo\MassaTeste\Service\MassaTeste' => function() {
                    return new MassaTeste();
                },
                'InepZend\Module\TrocaArquivo\LayoutEstrutural\Form\LayoutEstrutural' => function() {
                    return new LayoutEstruturalForm();
                },
                'InepZend\Module\TrocaArquivo\LayoutEstrutural\Form\LayoutFile' => function() {
                    return new LayoutFileForm();
                },
                'InepZend\Module\TrocaArquivo\ResponsavelEnvio\Service\ResponsavelEnvio' => function() {
                    return new ResponsavelEnvio();
                },
                'InepZend\Module\TrocaArquivo\ResponsavelEnvio\Form\ResponsavelEnvio' => function() {
                    return new ResponsavelEnvioForm();
                },
                'InepZend\Module\TrocaArquivo\MassaTeste\Service\GeradorMassa' => function () {
                    return new GeradorMassa();
                },
                'InepZend\Module\TrocaArquivo\Common\Service\File\IlhaDadoFile' => function($serviceManager = null) {
                    return new IlhaDadoFile($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\Common\Service\File\RegraValidacaoFile' => function($serviceManager = null) {
                    return new RegraValidacaoFile($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\TrocaArquivo\IlhaDado\Service\IlhaDado' => function() {
                    return new IlhaDado();
                },
                'InepZend\Module\TrocaArquivo\IlhaDado\Form\IlhaDado' => function() {
                    return new IlhaDadoForm();
                },
                'InepZend\Module\TrocaArquivo\LayoutValidacao\Service\RegraValidacao' => function() {
                    return new RegraValidacao();
                },
                'InepZend\Module\TrocaArquivo\LayoutValidacao\Form\RegraValidacao' => function() {
                    return new RegraValidacaoForm();
                },
                'InepZend\Module\TrocaArquivo\Cliente\Service\Cliente' => function() {
                    return new Cliente();
                },
                'InepZend\Module\TrocaArquivo\Cliente\Form\Cliente' => function() {
                    return new ClienteForm();
                },
            ),
        );
    }

}
