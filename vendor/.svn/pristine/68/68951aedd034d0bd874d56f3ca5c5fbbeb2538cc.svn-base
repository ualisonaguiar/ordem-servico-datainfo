<?php

namespace InepZend\Module\Sqi;

use InepZend\ModuleConfig\ModuleConfig;
use InepZend\Module\Sqi\Service\Questionario;
use InepZend\Module\Sqi\Service\VwQuestaoItemDependencia;
use InepZend\Module\Sqi\Service\VwQuestionarioProjeto;
use InepZend\Module\Sqi\Service\VwSituacaoQuestionario;
use InepZend\Module\Sqi\Service\GrupoQuestao;
use InepZend\Module\Sqi\Service\Item;
use InepZend\Module\Sqi\Service\Questao;
use InepZend\Module\Sqi\Service\QuestaoItem;
use InepZend\Module\Sqi\Service\QuestaoItemConfiguracao;
use InepZend\Module\Sqi\Service\QuestaoItemDependencia;
use InepZend\Module\Sqi\Service\SituacaoQuestionario;
use InepZend\Module\Sqi\Service\TipoQuestao;
use InepZend\Module\Sqi\Service\TipoSituacaoQuestionario;
use InepZend\Module\Sqi\Service\QuestionarioProjeto;
use InepZend\Module\Sqi\Service\QuestionarioQuestaoItem;
use InepZend\Module\Sqi\Service\SubgrupoQuestao;
use InepZend\Module\Sqi\Service\HistGrupoQuestao;
use InepZend\Module\Sqi\Service\HistItem;
use InepZend\Module\Sqi\Service\HistQuestao;
use InepZend\Module\Sqi\Service\HistQuestaoItem;
use InepZend\Module\Sqi\Service\HistQuestaoItemConfig;
use InepZend\Module\Sqi\Service\HistQuestaoItemDep;
use InepZend\Module\Sqi\Service\HistQuestionario;
use InepZend\Module\Sqi\Service\HistQuestionarioProjeto;
use InepZend\Module\Sqi\Service\HistQuestQuestaoItem;
use InepZend\Module\Sqi\Service\HistSituacaoQuestionario;
use InepZend\Module\Sqi\Service\HistTipoQuestao;
use InepZend\Module\Sqi\Service\HistTipoSituacaoQuest;
use InepZend\Module\Sqi\Service\HistSubgrupoQuestao;
use InepZend\Module\Sqi\Service\Instrucao;
use InepZend\Module\Sqi\Service\HistInstrucao;
use InepZend\Module\Sqi\Service\InstrucaoGrupoQuestao;
use InepZend\Module\Sqi\Service\HistInstGrupoQuestao;
use InepZend\Module\Sqi\Service\InstrucaoSubgrupoQuestao;
use InepZend\Module\Sqi\Service\HistInstSubgrupoQuestao;
use InepZend\Module\Sqi\Service\RestQuestionario;

class Module extends ModuleConfig
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InepZend\Questionario\Service\Questionario' => function($serviceManager) {
                    return new Questionario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\Questionario' => function($serviceManager) {
                    return new Questionario($this->getEntityManager($serviceManager));
                },
                'InepZend\Questionario\Service\VwQuestionarioProjeto' => function($serviceManager) {
                    return new VwQuestionarioProjeto($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\VwQuestionarioProjeto' => function($serviceManager) {
                    return new VwQuestionarioProjeto($this->getEntityManager($serviceManager));
                },
                'InepZend\Questionario\Service\VwQuestaoItemDependencia' => function($serviceManager) {
                    return new VwQuestaoItemDependencia($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\VwQuestaoItemDependencia' => function($serviceManager) {
                    return new VwQuestaoItemDependencia($this->getEntityManager($serviceManager));
                },
                'InepZend\Questionario\Service\VwSituacaoQuestionario' => function($serviceManager) {
                    return new VwSituacaoQuestionario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\VwSituacaoQuestionario' => function($serviceManager) {
                    return new VwSituacaoQuestionario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\GrupoQuestao' => function($serviceManager) {
                    return new GrupoQuestao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\Item' => function($serviceManager) {
                    return new Item($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\Questao' => function($serviceManager) {
                    return new Questao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\QuestaoItem' => function($serviceManager) {
                    return new QuestaoItem($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\QuestaoItemConfiguracao' => function($serviceManager) {
                    return new QuestaoItemConfiguracao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\QuestaoItemDependencia' => function($serviceManager) {
                    return new QuestaoItemDependencia($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\SituacaoQuestionario' => function($serviceManager) {
                    return new SituacaoQuestionario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\TipoQuestao' => function($serviceManager) {
                    return new TipoQuestao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\TipoSituacaoQuestionario' => function($serviceManager) {
                    return new TipoSituacaoQuestionario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\QuestionarioProjeto' => function($serviceManager) {
                    return new QuestionarioProjeto($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\QuestionarioQuestaoItem' => function($serviceManager) {
                    return new QuestionarioQuestaoItem($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\SubgrupoQuestao' => function($serviceManager) {
                    return new SubgrupoQuestao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistGrupoQuestao' => function($serviceManager) {
                    return new HistGrupoQuestao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistItem' => function($serviceManager) {
                    return new HistItem($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistQuestao' => function($serviceManager) {
                    return new HistQuestao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistQuestaoItem' => function($serviceManager) {
                    return new HistQuestaoItem($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistQuestaoItemConfig' => function($serviceManager) {
                    return new HistQuestaoItemConfig($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistQuestaoItemDep' => function($serviceManager) {
                    return new HistQuestaoItemDep($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistQuestionario' => function($serviceManager) {
                    return new HistQuestionario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistQuestionarioProjeto' => function($serviceManager) {
                    return new HistQuestionarioProjeto($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistQuestQuestaoItem' => function($serviceManager) {
                    return new HistQuestQuestaoItem($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistSituacaoQuestionario' => function($serviceManager) {
                    return new HistSituacaoQuestionario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistTipoQuestao' => function($serviceManager) {
                    return new HistTipoQuestao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistTipoSituacaoQuest' => function($serviceManager) {
                    return new HistTipoSituacaoQuest($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistSubgrupoQuestao' => function($serviceManager) {
                    return new HistSubgrupoQuestao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\Instrucao' => function($serviceManager) {
                    return new Instrucao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistInstrucao' => function($serviceManager) {
                    return new HistInstrucao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\InstrucaoGrupoQuestao' => function($serviceManager) {
                    return new InstrucaoGrupoQuestao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistInstGrupoQuestao' => function($serviceManager) {
                    return new HistInstGrupoQuestao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\InstrucaoSubgrupoQuestao' => function($serviceManager) {
                    return new InstrucaoSubgrupoQuestao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\HistInstSubgrupoQuestao' => function($serviceManager) {
                    return new HistInstSubgrupoQuestao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Sqi\Service\RestQuestionario' => function($serviceManager) {
                    return new RestQuestionario();
                },
            ),
        );
    }

}
