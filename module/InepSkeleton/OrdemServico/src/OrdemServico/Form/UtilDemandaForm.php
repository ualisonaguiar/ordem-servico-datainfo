<?php

namespace OrdemServico\Form;

use InepZend\Util\String;
use OrdemServico\Entity\OrdemServico as OrdemServicoEntity;

trait UtilDemandaForm
{

    /**
     * @deprecated
     * Metodo responsavel por retornar a listagem dos usuario vinculados ao sistema.
     *
     * @return type
     */
    public function getListUser($arrCriteria = [])
    {
        $arrUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->findBy($arrCriteria, array('no_usuario' => 'asc'));
        $arrUsuarioList = [];
        foreach ($arrUsuario as $usuario) {
            $arrUsuarioList[$usuario->getNoUsuario()] = String::beautifulProperName($usuario->getNoUsuario());
        }
        return $arrUsuarioList;
    }

    /**
     * Metodo responsavel por retornar a listagem dos usuario vinculados ao sistema.
     *
     * @return type
     */
    public function getListagemUsuario($arrCriteria = [])
    {
        $arrUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->findBy($arrCriteria, array('no_usuario' => 'asc'));
        $arrUsuarioList = [];
        foreach ($arrUsuario as $usuario) {
            $arrUsuarioList[$usuario->getIdUsuario()] = String::beautifulProperName($usuario->getNoUsuario());
        }
        return $arrUsuarioList;
    }

    /**
     * Metodo responsavel por retornar a listagem das atividade cadastrada.
     *
     * @return array
     */
    protected function getListActivity()
    {
        $arrAtividade = $this->getService('OrdemServico\Service\AtividadeFile')
            ->fetchPairs(array(), 'getIdAtividade', 'getCodigoAtividadeDescricao', array('co_atividade' => 'asc'));
        natcasesort($arrAtividade);
        return $arrAtividade;
    }

    protected function getListOrdemServicoAtivo($arrCriteria = null)
    {
        $arrOrdemServico = $this->getService('OrdemServico\Service\OrdemServicoFile')
            ->fetchPairs(
                $arrCriteria,
                'getIdOrdemServico',
                'getDescricaoOrdemServico',
                ['nu_ordem_servico' => 'desc']
            );
        return $arrOrdemServico;
    }

    protected function getListListOrdemServicoVinculadoUsario()
    {
        return $this->getService('OrdemServico\Service\VwDemandaVinculadaOrdemServicoFile')
            ->fetchPairs(
                [
                    'tp_situacao' => OrdemServicoEntity::CO_SITUACAO_ABERTA,
                    'id_usuario' => $this->getService('OrdemServico\Service\Profile')->getIdUsuarioLogado()
                ],
                'getIdOrdemServico',
                'getNumeroDescricaoOrdemServico',
                ['nu_ordem_servico' => 'desc']
            );
    }

    /**
     * retornar o comentario das descricoes de complexidade, impacto, criticidade e impacto.
     *
     * @return array
     */
    protected function getTextHelp()
    {
        return array(
            'complexidade' => 'O Nível de Complexidade está relacionado diretamente com a natureza da atividade e o esforço necessário para a sua execução ou solução de incidente. Por esforço entende-se tempo que será gasto para execução ou nível de dificuldade da demanda.',
            'impacto' => 'O Nível de Impacto está relacionado ao efeito nos processos de negócio do Inep ou da DTDIE, o quanto os serviços serão afetados com falha, necessidade de evolução ou adaptação e qual será o transtorno, interno ou externo, pela não realização ou falha na execução da atividade.',
            'criticidade' => 'O nível de criticidade está relacionado ao tempo de execução considerando que atrasos, na execução das atividades ou na entrega dos artefatos, podem afetar um processo de negócio do Inep ou da DTDIE.',
            'facim' => 'O Fator de Conhecimento Interno e Maturidade- FACIM- é um indicador que baliza a perspectiva de definição do conhecimento interno e da maturidade para a execução das atividades. Este indicador tem o objetivo de criar um parâmetro que avalia o nível de maturidade e conhecimento do Inep que é transferido para o contexto da necessidade em que a atividade será inserida.'
        );
    }
}
