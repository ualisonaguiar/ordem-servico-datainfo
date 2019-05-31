<?php

namespace OrdemServico\Message;

trait Message
{
    # Mensagens de alerta
    /**
     * <b>Mensagem:</b><i> Alteracao da demanda sequencia: </i>
     * @var string
     */
    protected $strMsgA1 = 'Alteração da demanda sequencia: ';

    /**
     * <b>Mensagem:</b><i> Deseja realmente suspender esta Ordem de Serviço?</i>
     * @var string
     */
    protected $strMsgA2 = 'Deseja realmente suspender esta Ordem de Serviço?';

    /**
     * <b>Mensagem:</b><i> Deseja realmente reativar esta Ordem de Serviço?</i>
     * @var string
     */
    protected $strMsgA3 = 'Deseja realmente reativar esta Ordem de Serviço?';

    /**
     * <b>Mensagem:</b><i> Deseja realmente excluir este vinculo?</i>
     * @var string
     */
    protected $strMsgA4 = 'Deseja realmente excluir este vínculo?';

    # Mensagens de excecao
    /**
     * <b>Mensagem:</b><i> Esta demanda nao pode ser excluida encontra-se atribuida a uma ordem de servico.</i>
     * @var string
     */
    protected $strMsgE1 = 'Esta demanda não pode ser excluída encontra-se atribuída a uma ordem de serviço.';

    /**
     * <b>Mensagem:</b><i> Esta ordem servico nao pode ser excluida encontra-se emitida.</i>
     * @var string
     */
    protected $strMsgE2 = 'Esta ordem serviço não pode ser excluída, encontra-se emitida/análise.';

    /**
     * <b>Mensagem:</b><i> Esta demanda so pode ser excluida pelo proprio executor que atendeu.</i>
     * @var string
     */
    protected $strMsgE3 = 'Esta demanda só pode ser excluída pelo proprio executor.';

    /**
     * <b>Mensagem:</b><i> Devera ser vinculada a uma Ordem de Servico na Demanda.</i>
     * @var string
     */
    protected $strMsgE4 = 'Deverá ser vinculada a uma Ordem de Serviço na Demanda.';

    /**
     * <b>Mensagem:</b><i> Acao Não Permitida</i>
     * @var string
     */
    protected $strMsgE5 = 'Ação Não Permitida';

    /**
     * <b>Mensagem:</b><i> Favor vincular a demanda na ordem de serviço.</i>
     * @var string
     */
    protected $strMsgE6 = 'Favor vincular a demanda na ordem de serviço.';

    /**
     * <b>Mensagem:</b><i> Devera ser vinculado na Ordem de Serviço as Demandas.</i>
     * @var string
     */
    protected $strMsgE7 = 'Deverá ser vinculado na Ordem de Serviço as Demandas.';

    /**
     * <b>Mensagem:</b><i> Devera ser justificado as demandas que possui complexidade e impacto: medio/alto, Criticidade: critíco e FACIM: Parcialmente Definido e Indefinido.</i>
     * @var string
     */
    protected $strMsgE8 = 'Deverá ser justificado as demandas que possui complexidade e impacto: médio/alto, Criticidade: critíco e FACIM: Parcialmente Definido e Indefinido.';

    /**
     * <b>Mensagem:</b><i> Operação realizada com sucesso!</i>
     * @var string
     */
    protected $strMsgE9 = 'Operação realizada com sucesso!';

    /**
     * <b>Mensagem:</b><i> Nao foi possível excluir este usuário. Encontra-se demandas vinculadas.</i>
     * @var string
     */
    protected $strMsgE10 = 'Não foi possível excluir este usuário. Encontra-se demandas vinculadas.';

    # Mensagens de sucesso

    /**
     * <b>Mensagem:</b><i> Operacao realizada com sucesso!</i>
     * @var string
     */
    protected $strMsgS1 = 'Operação realizada com sucesso!';
}
