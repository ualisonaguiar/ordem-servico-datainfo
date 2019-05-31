<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractService;
use InepZend\Util\ApplicationProperties;

class RelogioPonto extends AbstractService
{
    public function obterPonto()
    {
        try {
            $arrInfoSession = $this->getSession();
            $strUrl = ApplicationProperties::get('ponto.relogio.endereco') . '/get_afd.fcgi?session=' . $arrInfoSession->session;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $strUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_SSL_VERIFYPEER => false
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            $arrInfo = curl_getinfo($curl);
            curl_close($curl);
            if ($err && (!curl_errno($curl) || $arrInfo['http_code'] != 200)) {
                $response = json_decode($response);
                $strErro = (!empty($response)) ? $response->error : $err;
                throw new \Exception('Erro ao obter o ponto. Erro: ' . $strErro);
            } else {
                $this->getService('OrdemServico\Service\RelatorioPonto')->uploadArquivoAction([
                    'arquivo' => $response
                ]);
            }
        } catch (\Exception $exception) {
            \InepZend\Util\Debug::debug($exception->getMessage(), 1);
        }
    }

    protected function getSession()
    {
        $curl = curl_init();
        $arrData = [
            'login' => ApplicationProperties::get('ponto.relogio.usuario'),
            'password' => ApplicationProperties::get('ponto.relogio.senha')
        ];
        curl_setopt_array($curl, array(
            CURLOPT_URL => ApplicationProperties::get('ponto.relogio.endereco') . "/login.fcgi",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($arrData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
            CURLOPT_SSL_VERIFYPEER => false
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            throw new \Exception('Erro ao obter sessão. Erro: ' . $err->error);
        }
        return json_decode($response);
    }
}