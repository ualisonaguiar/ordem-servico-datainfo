<?php

namespace InepZend\Module\Executor\Service;

use InepZend\Service\AbstractServiceFile as AbstractServiceFileInepZend;
use InepZend\Module\Executor\Entity\Email as EmailEntity;
use InepZend\Dto\ResultDto;
use InepZend\Paginator\Paginator;
use InepZend\Module\Executor\Entity\HistoricoExecucao as HistoricoExecucaoEntity;
use InepZend\Util\Server;
use InepZend\Util\FileSystem;
use InepZend\Mail\Mail;
use InepZend\Module\Executor\Message\Message;
use InepZend\View\RenderTemplate;

class EmailHistoricoQuery extends AbstractServiceFileInepZend
{
    use Message, RenderTemplate;

    public function __construct()
    {
        parent::__construct();
        $this->arrPk = array('idEmailHistoricoQuery');
    }

    /**
     * Metodo responsavel pela listagem dos historicos no email
     *
     * @param array $arrCriteria
     * @param string $strSortName
     * @param string $strSortOrder
     * @param integer $intPage
     * @param integer $intItemPerPage
     * @param mix $mixDQL
     * @return Paginator
     */
    public function findByPaged(array $arrCriteria = null, $strSortName = 'dtExecucao', $strSortOrder = 'desc', $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQL = null)
    {
        $arrHistoryOperation = $this->getInformation(
            $arrCriteria['idEmail'],
            array($strSortName => $strSortOrder)
        );
        $arrDataResult = array();
        if ($arrHistoryOperation['hitorico']) {
            $serviceHistory = $this->getService('InepZend\Module\Executor\Service\HistoricoExecucao');
            foreach ($arrHistoryOperation['hitorico'] as $emailHistory) {
                $historicoExecucao = $serviceHistory->find((int) $emailHistory->getIdHistoricoExecucao());
                $arrDataResult[] = array(
                    'DS_USUARIO' => $historicoExecucao->getDsUsuarioExecucao(),
                    'DT_EXECUCAO' => $historicoExecucao->getDtExecucao(),
                    'TP_SITUACAO' => HistoricoExecucaoEntity::$arrSituacao[$historicoExecucao->getCoSituacao()],
                    'ID_HISTORICO_EXECUCAO' => $emailHistory->getIdHistoricoExecucao()
                );
            }
        }
        return new Paginator($arrDataResult, $intPage, $intItemPerPage);
    }

    /**
     * Metodo responsavel por registrar email no historico
     *
     * @param integer $intIdHistoricoQuery
     * @return null
     * @throws \Exception
     */
    protected function registrarEmailHistorico($intIdHistoricoQuery)
    {
        try {
            $strStatus = ResultDto::STATUS_OK;
            $strMessage = $this->strMsgSucesso04;
            $strLogin = $this->getLoginUser();
            $serviceEmail = $this->getService('InepZend\Module\Executor\Service\Email');
            $arrConfigEmail = $this->getConfigEmail();
            if (!$arrConfigEmail) {
                $email = $serviceEmail->insert(array('dsUsuario' => $strLogin, 'inAtivo' => EmailEntity::SITUACAO_NAO_ENVIADO));
            } else {
                $email = $arrConfigEmail[0];
            }
            $arrHistoricoEmail = $this->findBy(
                array('idEmail' => (int) $email->getIdEmail(), 'idHistoricoExecucao' => (int) $intIdHistoricoQuery)
            );
            if ($arrHistoricoEmail) {
                throw new \Exception($this->strMsgError05);
            }
            $this->insert(array('idEmail' => $email->getIdEmail(), 'idHistoricoExecucao' => (int) $intIdHistoricoQuery));
        } catch (\Exception $exectpion) {
            $strStatus = ResultDto::STATUS_FAIL;
            $strMessage = $exectpion->getMessage();
        }
        return self::getResult($strStatus, $strMessage, $this->getCountQueryEmail());
    }

    /**
     * Metodo responsavel por retornar a quantidade de operacoes inserida no email.
     *
     * @return int
     */
    protected function getCountQueryEmail()
    {
        $arrConfigEmail = $this->getConfigEmail();
        if (!$arrConfigEmail) {
            return 0;
        }
        $arrHistoricoEmail = $this->findBy(array('idEmail' => (int) $arrConfigEmail[0]->getIdEmail()));
        return count($arrHistoricoEmail);
    }

    /**
     * Metodo responsavel por retornar informacao do email.
     *
     * @param integer $intIdEmail
     * @return array
     */
    protected function getInformation($intIdEmail = null)
    {
        if (!$intIdEmail) {
            $configEmail = reset($this->getConfigEmail());
        } else {
            $configEmail = $this->getService('InepZend\Module\Executor\Service\Email')->find((int) $intIdEmail);
        }
        if ($configEmail) {
            $arrDataEmail = array(
                'info' => $configEmail,
                'hitorico' => $this->findBy(
                    array('idEmail' => $configEmail->getIdEmail())
                )
            );
        }
        return $arrDataEmail;
    }

    /**
     * Metodo responsavel por retorar a configuracao do email ativa no usuario.
     *
     * @return array
     */
    protected function getConfigEmail()
    {
        $arrConfigEmail = $this->getService('InepZend\Module\Executor\Service\Email')
            ->findBy(
                array(
                    'inAtivo' => EmailEntity::SITUACAO_NAO_ENVIADO,
                    'dsUsuario' => $this->getLoginUser()
                )
            );
        return $arrConfigEmail;
    }

    /**
     * Metodo responsavel por salvar a configuracao do email.
     *
     * @param array $arrDataPost
     * @throws \Exception
     */
    protected function saveEmail($arrDataPost)
    {
        $arrInfoEmail = $this->getInformation($arrDataPost['idEmail']);
        $strBasePath = $this->prepareAnexo($arrInfoEmail['hitorico']);
        $arrStatus = $this->enviarEmail($arrDataPost, $strBasePath);
        $email = $arrInfoEmail['info'];
        $email->setDsDestinatario($arrDataPost['dsDestinatario'])
            ->setDsDestinatarioCopia($arrDataPost['dsDestinatarioCopia'])
            ->setDsAssunto($arrDataPost['dsAssunto'])
            ->setDsTexto($arrDataPost['dsTexto'])
            ->setDtEnvio(date('Y-m-d H:i:s'))
            ->setDsPathAnexo($strBasePath)
            ->setInAtivo(($arrStatus['status'] == ResultDto::STATUS_OK) ? EmailEntity::SITUACAO_ENVIADO : EmailEntity::SITUACAO_FALHA);
        $this->getService('InepZend\Module\Executor\Service\Email')->save($email->toArray());
        if ($arrStatus['status'] == ResultDto::STATUS_FAIL) {
            throw new \Exception($arrStatus['messages']);
        }
    }

    /**
     * Metodo responsavel por remover o item historico no email.
     *
     * @param integer $intIdHistorico
     * @return array
     */
    protected function removeItemListaEnvio($intIdHistorico)
    {
        $arrInfoEmail = $this->getConfigEmail();
        $this->deleteBy(array('idEmail' => $arrInfoEmail[0]->getIdEmail(), 'idHistoricoExecucao' => (int) $intIdHistorico));
        return self::getResult(ResultDto::STATUS_OK, $this->strMsgSucesso05);
    }

    /**
     * Metodo responsavel pelo reenvio do email.
     *
     * @param integer $intIdEmail
     * @return array
     */
    protected function reenviarEmail($intIdEmail)
    {
        try {
            $arrInfoEmail = $this->getInformation($intIdEmail);
            $arrEmailNew = $arrInfoEmail['info']->toArray();
            unset ($arrEmailNew['idEmail']);
            $arrEmailNew['inAtivo'] = EmailEntity::SITUACAO_NAO_ENVIADO;
            $serviceEmail = $this->getService('InepZend\Module\Executor\Service\Email');
            $emailNew = $serviceEmail->insert($arrEmailNew);
            if ($arrInfoEmail['hitorico']) {
                foreach ($arrInfoEmail['hitorico'] as $historico) {
                    $this->insert(
                        array(
                            'idEmail' => $emailNew->getIdEmail(),
                            'idHistoricoExecucao' => $historico->getIdHistoricoExecucao(),
                            'idEmailHistoricoQuery' => null
                        )
                    );
                }
            }
            $this->saveEmail($emailNew->toArray());
            return self::getResult(ResultDto::STATUS_OK, 'E-mail reenviado com sucesso.');
        } catch (\Exception $exception) {
            return self::getResult(ResultDto::STATUS_OK, $exception->getMessage());
        }
    }

    /**
     * Metodo responsavel por listar os historicos inserindo no email reenviado.
     *
     * @param array $arrCriteria
     * @param string $strSortName
     * @param string $strSortOrder
     * @param integer $intPage
     * @param integer $intItemPerPage
     * @param mix $mixDQL
     * @return Paginator]
     */
    protected function getListagemHistoricoEnvio(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQL = null)
    {
        $arrEnvio = $this->getService('InepZend\Module\Executor\Service\Email')->findBy(array('dsUsuario' => $this->getLoginUser()), array('dsAssunto' => 'desc'));
        $arrDataResult = array();
        if ($arrEnvio) {
            foreach ($arrEnvio as $envio) {
                if ($envio->getInAtivo() == EmailEntity::SITUACAO_NAO_ENVIADO)
                    continue;
                $arrDataResult[] = array(
                    'DS_DESTINATARIO' => $envio->getDsDestinatario(),
                    'DS_ASSUNTO' => $envio->getDsAssunto(),
                    'DT_ENVIO' => $envio->getDtEnvio(),
                    'TP_SITUACAO' => EmailEntity::$arrSituacao[$envio->getInAtivo()],
                    'ID_EMAIL' => $envio->getIdEmail(),
                );
            }
        }
        return new Paginator($arrDataResult, $intPage, $intItemPerPage);
    }

    /**
     * Metodo responsavel por retornar o login do usuario autenticado.
     *
     * @return string
     */
    protected function getLoginUser()
    {
        return strtolower($this->getIdentity()->usuarioSistema->usuario->login);
    }

    /**
     * Metodo responsavel por retonar a lisagem dos vinculos da query com email.
     *
     * @param type $intIdEmail
     * @return string
     */
    protected function getListagemOperacaoVinculada($intIdEmail)
    {
        $arrHistoricoEmail = $this->findBy(array('idEmail' => (int) $intIdEmail));
        $serviceHistoricoExecucao = $this->getService('InepZend\Module\Executor\Service\HistoricoExecucao');
        $serviceQuery = $this->getService('InepZend\Module\Executor\Service\Query');
        $arrOperacao = array();
        foreach ($arrHistoricoEmail as $historicoEmail) {
            $historicoExecucao = $serviceHistoricoExecucao->find($historicoEmail->getIdHistoricoExecucao());
            $query = $serviceQuery->find($historicoExecucao->getIdQuery());
            $arrOperacao[] = $query->getDsTitulo();
        }
        return $this->renderTemplate('inep-zend/email-historico/_listagem-operacao', array('listagem' => $arrOperacao));

    }

    /**
     * Metodo responsavel por enviar email.
     *
     * @param array $arrDataPost
     * @param string $strBasePath
     * @return mix
     */
    private function enviarEmail($arrDataPost, $strBasePath)
    {
        try {
            $mail = new Mail();
            $mail->sendMail(
                $arrDataPost['dsTexto'],
                $arrDataPost['dsAssunto'],
                $arrDataPost['dsDestinatario'],
                $arrDataPost['dsDestinatarioCopia'],
                null,
                null,
                array($strBasePath)
            );
            return self::getResult(ResultDto::STATUS_OK, '');
        } catch (\Exception $exception) {
            return self::getResult(ResultDto::STATUS_FAIL, $exception->getMessage());
        }
    }

    /**
     * Metodo responsavel por preparar o anexo antes do envio.
     *
     * @param array $arrHistoricoOperacao
     * @return string
     */
    private function prepareAnexo($arrHistoricoOperacao)
    {
        if ((!is_array($arrHistoricoOperacao)) || (empty($arrHistoricoOperacao)))
            return;
        $serviceHistory = $this->getService('InepZend\Module\Executor\Service\HistoricoExecucao');
        $strPath = Server::getReplacedBasePathApplication() . '/data/ExecuteQuery/Send';
        if (!is_dir($strPath))
            mkdir($strPath, 0755, true);
        $strPath .= '/anexo-email_' . $arrHistoricoOperacao[0]->getIdEmail() . '_' . date('YmdHis') . '.sql';
        foreach ($arrHistoricoOperacao as $intPosicao => $historicoOperacao) {
            $historico = $serviceHistory->find($historicoOperacao->getIdHistoricoExecucao());
            $strQuery = $historico->getDsQuery();
            $arrParametro = unserialize($historico->getDsParametro());
            if ($arrParametro) {
                foreach ($arrParametro as $strBind => $strValue) {
                    $strQuery = str_replace('@@' . $strBind, "'" . $strValue . "'", $strQuery);
                }
            }
            $strUserResp = '/* ' . $historico->getDtExecucao() . ' - Operação ' . ($intPosicao + 1) . ' ' . $historico->getDsUsuarioExecucao() ." */ \n";
            FileSystem::insertContentIntoFile($strPath, $strUserResp . $strQuery . "\n\n", 'a+');
        }
        return $strPath;
    }
}
