<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Util\String;
use OrdemServico\Entity\OrdemServico as OrdemServicoEntity;
use OrdemServico\Entity\LogLancamento as LogLancamentoEntity;
use InepZend\Util\Date;

class IntegracaoApex extends AbstractServiceManager
{
    private $usuario;

    protected function registrarPonto($arrDataPost, $intIdUsuario = null)
    {
        try {
            $this->setDadosUsuario($intIdUsuario);
            $arrHorario = $this->prepareHorarioPonto($arrDataPost['hr_ponto'], $arrDataPost['dt_ponto']);
            if (!$arrHorario) {
                return false;
            }
            $informacaoDemanda = $this->getInformacao($arrDataPost);
            if ($this->usuario->getDsHashApex()) {
                $arrDataPost['login'] = $this->usuario->getDsHashApex();
            }
            $arrDataRest = $this->prepareDadosParcialEnvioApex($informacaoDemanda, $arrDataPost);
            foreach ($arrHorario as $arrInfoHorario) {
                if (count($arrInfoHorario) < 2) {
                    throw new \Exception('Não existe horário de entrada/saída para lançar no APEX');
                }
                $arrDataRest['horaInicio'] = str_replace('*', '', trim($arrInfoHorario[0]));
                $arrDataRest['horaFim'] = str_replace('*', '', trim($arrInfoHorario[1]));
                if ($arrDataRest['horaInicio'] != 'Justificar') {
                    $this->getRequisicao($arrDataRest, $arrDataPost['login']);
                    $this->registrarLancamento([
                        'id_demanda' => $informacaoDemanda->getIdDemanda(),
                        'id_catalogo_servico_atividade' => $informacaoDemanda->getIdCatalogoServicoAtividade(),
                        'id_usuario' => $this->usuario->getIdUsuario(),
                        'dt_ponto' => Date::convertDateAction($arrDataRest['data']),
                        'hr_inicio' => $arrDataRest['horaInicio'],
                        'hr_fim' => $arrDataRest['horaFim'],
                    ]);
                }
            }
            $this->saveDadosAcessoApex($arrDataPost['login']);
            return true;
        } catch (\Exception $exception) {
            throw new \Exception(
                'Erro ao tentar realizar o registro do dia ' . $arrDataPost['dt_ponto'] . '. Erro: ' . $exception->getMessage()
            );
        }
    }

    /**
     * Metodo responsavel por retornar as informacoes da demanda e atividade.
     *
     * @param $arrDataPost
     * @return mixed
     * @throws \Exception
     */
    protected function getInformacao($arrDataPost)
    {
        $arrDemanda = $this->getService('OrdemServico\Service\VwDemandaVinculadaOrdemServicoFile')->findBy(
            [
                'id_usuario' => $this->usuario->getIdUsuario(),
                'id_demanda' => $arrDataPost['id_demanda'],
                'id_catalogo_servico_atividade' => $arrDataPost['id_catalogo_servico_atividade'],
                'tp_situacao' => OrdemServicoEntity::CO_SITUACAO_ABERTA
            ]
        );
        if (!$arrDemanda) {
            throw new \Exception('A Demanda informada não foi encontrada no sistema');
        }
        return reset($arrDemanda);
    }

    /**
     * Metodo responsavel por setar os horarios no formato de inicio e fim
     *
     * @param $strHorario
     * @return array
     * @throws \Exception
     */
    protected function prepareHorarioPonto($strHorario, $strDtPonto)
    {
        $arrHorario = explode(',', $strHorario);
        $arrHorarioPonto = [];
        if (count($arrHorario) < 2) {
            throw new \Exception('Não existe horário de entrada/saída para lançar no APEX');
        }
        $arrDadosLogEnvio = $this->getLogEnvioPonto($strDtPonto);
        sort($arrHorario);
        $arrHorarioPonto[] = array_slice($arrHorario, 0, 2);
        $arrHorarioPonto[] = array_slice($arrHorario, 2, 2);
        $arrHorarioPonto[] = array_slice($arrHorario, 4, 4);

        foreach ($arrHorarioPonto as $intIndice => $arrInfoHorario) {
            if (!$arrInfoHorario || count($arrInfoHorario) < 2) {
                unset($arrHorarioPonto[$intIndice]);
            } else {
                $arrDataRest[0] = str_replace('*', '', trim($arrInfoHorario[0]));
                $arrDataRest[1] = str_replace('*', '', trim($arrInfoHorario[1]));
                $strKey = $arrDataRest[0] . '_' . $arrDataRest[1];
                if (array_key_exists($strKey, $arrDadosLogEnvio)) {
                    unset($arrHorarioPonto[$intIndice]);
                }
            }
        }
        sort($arrHorarioPonto);
        return $arrHorarioPonto;
    }

    /**
     * Metodo responsavel por enviar as informacoes para o apex
     *
     * @param $arrDataPost
     * @param $strHashAuth
     * @return mixed
     * @throws \Exception
     */
    protected function getRequisicao($arrDataPost, $strHashAuth)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_PORT => "8081",
            CURLOPT_URL => "http://172.30.1.72:8081/apex/lancamento",
//             CURLOPT_URL => "http://172.30.7.203:8081/apex/lancamento",
//            CURLOPT_URL => "http://172.30.7.178:8081/apex/lancamento",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($arrDataPost),
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic " . $strHashAuth,
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $strErro = curl_error($curl);
        $arrInfoCurl = curl_getinfo($curl);
        curl_close($curl);
        if ($arrInfoCurl['http_code'] !== 200) {
            $strErro = ($strErro) ? $strErro : $response;
            if (String::clearWord(strtolower($strErro)) != 'horas ja informadas') {
                throw new \Exception('Erro ao lançar no Apex. Informação do Erro: ' . $strErro);
            }
        }
        return $response;
    }

    /**
     * Metodo responsavel por salvar os dados enviados para o apex
     *
     * @param $arrDadosLancamento
     * @return mixed
     */
    protected function registrarLancamento($arrDadosLancamento)
    {
        $arrDadosLancamento['tp_operacao'] = ($this->getIdentity())
            ? LogLancamentoEntity::CO_TIPO_OPERACAO_USUARIO
            : LogLancamentoEntity::CO_TIPO_OPERACAO_CRONTAB;
        $arrDadosLancamento['dt_operacao'] = date('Y-m-d H:i:s');
        return $this->getService('OrdemServico\Service\LogLancamentoFile')->save($arrDadosLancamento);
    }

    /**
     * Busca os dados do usuario
     *
     * @return mixed
     */
    protected function setDadosUsuario($intIdUsuario = null)
    {
        if (!$intIdUsuario) {
            $intIdUsuario = $this->getService('OrdemServico\Service\Profile')->getIdUsuarioLogado();
        }
        $serviceUsuario = $this->getService('OrdemServico\Service\UsuarioFile');
        $usuario = $serviceUsuario->find($intIdUsuario);
        if (!$usuario) {
            throw new \Exception('Usuário não encontrado no sistema');
        }
        $this->usuario = $usuario;
        return $usuario;
    }

    /**
     * Salva as credenciais de acesso ao apex
     *
     * @param $strHash
     */
    protected function saveDadosAcessoApex($strHash)
    {
        if (!$this->usuario->getDsHashApex()) {
            $this->usuario->setDsHashApex($strHash);
            $serviceUsuario = $this->getService('OrdemServico\Service\UsuarioFile');
            $serviceUsuario->save($this->usuario->toArray());
        }
    }

    /**
     * Metodo responsavel por retornar os logs de envio do usuario ao apex.
     */
    protected function getLogEnvioPonto($strDtPonto)
    {
        $arrDadosPonto = [];
        $arrLogLancamento = $this->getService('OrdemServico\Service\LogLancamentoFile')->findBy([
            'dt_ponto' => Date::convertDateAction($strDtPonto),
            'id_usuario' => $this->usuario->getIdUsuario()
        ]);
        if ($arrLogLancamento) {
            foreach ($arrLogLancamento as $logLancamento) {
                $arrDadosPonto[$logLancamento->getHrInicio() . '_' . $logLancamento->getHrFim()] = $strDtPonto;
            }
        }
        return $arrDadosPonto;
    }

    /**
     * Metodo responsavel por preparar os dados do envio parcial ao apex
     *
     * @param $informacaoDemanda
     * @param $arrDataPost
     * @return array
     */
    protected function prepareDadosParcialEnvioApex($informacaoDemanda, $arrDataPost)
    {
        return [
            'data' => $arrDataPost['dt_ponto'],
            'descricao' => trim($arrDataPost['ds_descricao']),
            'atividade' => $informacaoDemanda->getCoAtividade(),
            'numeroOS' => (string)$informacaoDemanda->getNuOrdemServico(),
        ];
    }
}
