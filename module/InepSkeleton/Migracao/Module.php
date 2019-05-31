<?php

namespace Migracao;

use InepZend\ModuleConfig\ModuleConfig;
use Migracao\Service\AtividadeFile as AtividadeFileService;
use Migracao\Service\DemandaFile as DemandaFileService;
use Migracao\Service\MigracaoFile as MigracaoFileService;
use Migracao\Service\MigracaoDemandaFile as MigracaoDemandaFileService;
use Migracao\Service\DemandaServicoFile as DemandaServicoFile;
use Migracao\Service\CatalogoServicoFile as CatalogoServicoFileService;
use Migracao\Service\CatalogoServicoAtividadeFile as CatalogoServicoAtividadeFileService;
use Migracao\Service\Migracao as MigracaoService;
use Migracao\Service\OrdemServicoFile as OrdemServicoFileService;
use Migracao\Service\OrdemServicoDemandaFile as OrdemServicoDemandaFileService;

class Module extends ModuleConfig
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Migracao\Service\AtividadeFile' => function($serviceManager) {
                    return new AtividadeFileService($this->getEntityManager($serviceManager));
                },
                'Migracao\Service\DemandaFile' => function($serviceManager) {
                    return new DemandaFileService($this->getEntityManager($serviceManager));
                },
                'Migracao\Service\MigracaoFile' => function($serviceManager) {
                    return new MigracaoFileService($this->getEntityManager($serviceManager));
                },
                'Migracao\Service\MigracaoDemandaFile' => function($serviceManager) {
                    return new MigracaoDemandaFileService($this->getEntityManager($serviceManager));
                },
                'Migracao\Service\CatalogoServicoFile' => function($serviceManager) {
                    return new CatalogoServicoFileService($this->getEntityManager($serviceManager));
                },
                'Migracao\Service\CatalogoServicoAtividadeFile' => function($serviceManager) {
                    return new CatalogoServicoAtividadeFileService($this->getEntityManager($serviceManager));
                },
                'Migracao\Service\DemandaServicoFile' => function($serviceManager) {
                    return new DemandaServicoFile($this->getEntityManager($serviceManager));
                },
                'Migracao\Service\Migracao' => function($serviceManager) {
                    return new MigracaoService($this->getEntityManager($serviceManager));
                },
                'Migracao\Service\OrdemServicoFile' => function($serviceManager) {
                    return new OrdemServicoFileService($this->getEntityManager($serviceManager));
                },
                'Migracao\Service\OrdemServicoDemandaFile' => function($serviceManager) {
                    return new OrdemServicoDemandaFileService($this->getEntityManager($serviceManager));
                },
            )
        );
    }

}
