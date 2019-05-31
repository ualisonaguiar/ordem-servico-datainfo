<?php

namespace OrdemServico;

use InepZend\ModuleConfig\ModuleConfig;
use OrdemServico\Service\ArquivoPontoUsuarioFile;
use OrdemServico\Service\FeriasFile;
use OrdemServico\Service\LogVerificacaoDados;
use OrdemServico\Service\LogVerificacaoDadosFile;
use Zend\Mvc\MvcEvent;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;

use OrdemServico\Service\AtividadeFile as AtividadeFileService;
use OrdemServico\Service\DemandaFile as DemandaFileService;
use OrdemServico\Service\OrdemServicoFile as OrdemServicoFileService;
use OrdemServico\Service\OrdemServicoDemandaFile as OrdemServicoDemandaFileService;
use OrdemServico\Service\DemandaServicoFile as DemandaServicoFile;
use OrdemServico\Form\Atividade as AtividadeForm;
use OrdemServico\Form\Demanda as DemandaForm;
use OrdemServico\Form\OrdemServico as OrdemServicoForm;
use OrdemServico\Form\CatalogoServico as CatalogoServicoForm;
use OrdemServico\Form\RelatorioPonto as RelatorioPontoForm;
use OrdemServico\Form\RelatorioPessoal as RelatorioPessoalForm;
use OrdemServico\Navigation\NavigationOrdemServico;
use OrdemServico\Service\Backup as BackupService;
use OrdemServico\Service\RelatorioFaturamento as RelatorioFaturamentoService;
use OrdemServico\Service\Profile as ProfileService;
use OrdemServico\Service\CatalogoServicoFile as CatalogoServicoFileService;
use OrdemServico\Service\CatalogoServicoAtividadeFile as CatalogoServicoAtividadeFileService;
use OrdemServico\Service\VwDemandaVinculadaOrdemServicoFile as VwDemandaVinculadaOrdemServicoFileService;
use OrdemServico\Service\RelatorioPonto as RelatorioPontoService;
use OrdemServico\Service\UsuarioFile as UsuarioFileService;
use OrdemServico\Service\FeriadoFile as FeriadoFileService;
use OrdemServico\Service\OrdemServicoSubversion as OrdemServicoSubversionService;
use OrdemServico\Service\CorrecaoDados as CorrecaoDadosService;
use OrdemServico\Service\OrdemServicoAceiteFile as OrdemServicoAceiteFileService;
use OrdemServico\Service\ArquivoPontoFile as ArquivoPontoFileService;
use OrdemServico\Service\JustificativaPontoFile as JustificativaPontoFileService;
use OrdemServico\Service\IntegracaoApex as IntegracaoApexService;
use OrdemServico\Service\CronLancamentoApex as CronLancamentoApexService;
use OrdemServico\Service\LogLancamentoFile as LogLancamentoFileService;
use OrdemServico\Service\RelogioPonto as RelogioPontoService;

class Module extends ModuleConfig
{
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'OrdemServico\Service\AtividadeFile' => function ($serviceManager) {
                    return new AtividadeFileService($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\DemandaFile' => function ($serviceManager) {
                    return new DemandaFileService($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\OrdemServicoFile' => function ($serviceManager) {
                    return new OrdemServicoFileService($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\OrdemServicoDemandaFile' => function ($serviceManager) {
                    return new OrdemServicoDemandaFileService($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\VwDemandaVinculadaOrdemServicoFile' => function ($serviceManager) {
                    return new VwDemandaVinculadaOrdemServicoFileService($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\Backup' => function () {
                    return new BackupService();
                },
                'OrdemServico\Service\RelatorioFaturamento' => function () {
                    return new RelatorioFaturamentoService();
                },
                'OrdemServico\Service\RelatorioPonto' => function () {
                    return new RelatorioPontoService();
                },
                'OrdemServico\Service\CatalogoServicoFile' => function ($serviceManager) {
                    return new CatalogoServicoFileService($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\CatalogoServicoAtividadeFile' => function ($serviceManager) {
                    return new CatalogoServicoAtividadeFileService($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\UsuarioFile' => function ($serviceManager) {
                    return new UsuarioFileService($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\DemandaServicoFile' => function ($serviceManager) {
                    return new DemandaServicoFile($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\FeriadoFile' => function ($serviceManager) {
                    return new FeriadoFileService($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\OrdemServicoAceiteFile' => function ($serviceManager) {
                    return new OrdemServicoAceiteFileService($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\ArquivoPontoFile' => function ($serviceManager) {
                    return new ArquivoPontoFileService($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\JustificativaPontoFile' => function ($serviceManager) {
                    return new JustificativaPontoFileService($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\LogLancamentoFile' => function ($serviceManager) {
                    return new LogLancamentoFileService($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\LogVerificacaoDadosFile' => function ($serviceManager) {
                    return new LogVerificacaoDadosFile($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\Ferias' => function ($serviceManager) {
                    return new FeriasFile($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\ArquivoPontoUsuarioFile' => function ($serviceManager) {
                    return new ArquivoPontoUsuarioFile($this->getEntityManager($serviceManager));
                },
                'OrdemServico\Service\Profile' => function () {
                    return new ProfileService();
                },
                'OrdemServico\Service\CorrecaoDados' => function () {
                    return new CorrecaoDadosService();
                },
                'OrdemServico\Service\IntegracaoApexService' => function () {
                    return new IntegracaoApexService();
                },
                'OrdemServico\Service\CronLancamentoApex' => function () {
                    return new CronLancamentoApexService();
                },
                'OrdemServico\Service\RelogioPonto' => function () {
                    return new RelogioPontoService();
                },
                'OrdemServico\Form\Atividade' => function () {
                    return new AtividadeForm();
                },
                'OrdemServico\Form\Demanda' => function () {
                    return new DemandaForm();
                },
                'OrdemServico\Form\OrdemServico' => function () {
                    return new OrdemServicoForm();
                },
                'OrdemServico\Form\CatologoServico' => function () {
                    return new CatalogoServicoForm();
                },
                'OrdemServico\Form\RelatorioPonto' => function () {
                    return new RelatorioPontoForm();
                },
                'OrdemServico\Form\RelatorioPessoal' => function () {
                    return new RelatorioPessoalForm();
                },
                'OrdemServico\Form\OrdemServicoSubversion' => function () {
                    return new OrdemServicoSubversionService();
                },
                'OrdemServico\Navigation\NavigationOrdemServico' => function ($serviceManager) {
                    return (new NavigationOrdemServico())->createService($serviceManager);
                },
            )
        );
    }

    public function onBootstrap(MvcEvent $event)
    {
        parent::onBootstrap($event);
        //Iniciamos la lista de control de acceso
        $this->initAcl($event);
        //Comprobamos la lista de control de acceso
        $event->getApplication()->getEventManager()->attach('route', array($this, 'checkAcl'));
    }

    public function initAcl(MvcEvent $event)
    {
        $acl = new Acl();
        $arrRoles = require_once 'config/autoload/acl.roles.php';
        foreach ($arrRoles as $strRole => $resources) {
            $role = new GenericRole($strRole);
            $acl->addRole($role);
            foreach ($resources as $strType => $arrResource) {
                foreach ($arrResource as $strResource) {
                    if (!$acl->hasResource($strResource))
                        $acl->addResource(new GenericResource($strResource));
                    $acl->$strType($role, $strResource);
                }
            }
        }
        $event->getViewModel()->acl = $acl;
    }

    public function checkAcl(MvcEvent $event)
    {
        $serviceUser = $event->getApplication()
            ->getServiceManager()
            ->get('OrdemServico\Service\UsuarioFile');
        $route = $event->getRouteMatch()->getMatchedRouteName();
        if ($serviceUser->getIdentity()) {
            $strUserLogado = strtolower($serviceUser->getIdentity()->usuarioSistema->usuario->login);
            $arrUser = $serviceUser->findBy(['ds_login' => $strUserLogado]);
            if ($arrUser) {
                if ($event->getViewModel()->acl->hasResource($route)) {
                    if (!$event->getViewModel()->acl->isAllowed($arrUser[0]->getTpVinculo(), $route)) {
                        echo "<strong>Usuário sem acesso a rota: " . $route ."</strong>";
                        die;
                    }
                }
            }
        }
    }
}