<?php

namespace InepZend\Module\Ssi\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Util\AttributeStaticTrait;
use InepZend\Util\stdClass;
use InepZend\Util\ArrayCollection;
use InepZend\Exception\RuntimeException;
use InepZend\WebService\Client\Corporative\Inep\RestCorp;
use InepZend\Util\Format;
use InepZend\Util\Date;
use InepZend\Exception\Exception;
use InepZend\Session\SessionTrait;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Pessoa;
use Zend\Json\Decoder;

class PersonalInfo extends AbstractServiceManager
{

    use AttributeStaticTrait,
        SessionTrait,
        Pessoa;

    const NAME_SESSION_DATA_PERSONAL = 'InepZend_Dados_Receita_';

    protected function getDataFromIdentity()
    {
        if (!is_object($this->getIdentity()))
            throw new RuntimeException('Usuário não autenticado.');
        $usuario = $this->getIdentity()->usuarioSistema->usuario;
        $arrContatoEmail = array();
        $arrContatoTelefone = array();
        if (is_array($usuario->contatos)) {
            foreach ($usuario->contatos as $contato) {
                if ($contato->ativo !== true)
                    continue;
                if (strtolower($contato->tipo) == 'email')
                    $arrContatoEmail[] = $contato;
                if (strtolower($contato->tipo) == 'telefone') {
                    $contato->txContatoFormated = '(' . $contato->ddd . ') ' . $contato->txContato;
                    $arrContatoTelefone[] = $contato;
                }
            }
        }
        return array(
            'nu_cpf' => $usuario->cpf,
            'no_pessoa_fisica' => $usuario->nome,
            'no_mae' => $usuario->nomeMae,
            'dt_nascimento' => $usuario->dataNascimento,
            'tp_sexo' => (strpos(strtolower(@$usuario->tipoSexo), 'f') === false) ? 'M' : 'F',
            'tx_email' => $arrContatoEmail,
            'nu_telefone' => $arrContatoTelefone,
        );
    }

    protected function editMyInfo($arrData = null)
    {
        if (!is_object($this->getIdentity()))
            throw new RuntimeException('Usuário não autenticado.');
        $arrContatoFinal = array();
        $arrContatoData = array_merge((array) @$arrData['tx_email'], (array) @$arrData['nu_telefone']);
        foreach ($arrContatoData as $mixContatoData)
            $arrContatoFinal[] = $this->decodeContact($mixContatoData);
        $arrContatoAtual = $this->getIdentity()->usuarioSistema->usuario->contatos;
        foreach ($arrContatoAtual as $mixContatoAtual) {
            $contatoAtual = $this->decodeContact($mixContatoAtual);
            if ($contatoAtual->ativo === false) {
                $arrContatoFinal[] = $contatoAtual;
                continue;
            }
            $strKeyAtual = $contatoAtual->tipo . $contatoAtual->nomeSubTipoContato . $contatoAtual->ddd . $contatoAtual->txContato;
            $booExists = false;
            foreach ($arrContatoFinal as $contatoFinal) {
                if (!empty($contatoFinal->id)) {
                    if ($contatoAtual->id == $contatoFinal->id) {
                        $booExists = true;
                        break;
                    }
                } else {
                    $strKeyFinal = $contatoFinal->tipo . $contatoFinal->nomeSubTipoContato . $contatoFinal->ddd . $contatoFinal->txContato;
                    if ($strKeyAtual == $strKeyFinal) {
                        $booExists = true;
                        break;
                    }
                }
            }
            if (!$booExists) {
                $contatoAtual->ativo = false;
                $arrContatoFinal[] = $contatoAtual;
            }
        }
        $arrContato = array();
        foreach ($arrContatoFinal as $contatoFinal) {
            $arrRegister = ArrayCollection::objectToArray($contatoFinal);
            unset($arrRegister['txContatoFormated']);
            $arrContato[] = $arrRegister;
        }
        $mixResult = $this->getService('InepZend\Module\Oauth\Service\SsiService')->cadastrarVariosContatos($this->getIdentity()->usuarioSistema->id, $arrContato);
        if ($mixResult->response->status == 'OK')
            $this->getIdentity()->usuarioSistema->usuario->contatos = $arrContatoFinal;
        return ArrayCollection::objectToArrayRecursive($mixResult->response);
    }

    /**
     * Metodo responsavel por recuperar os dados da pessoa na receita federal
     * 
     * @param type $intNuCpf
     * return mix
     */
    protected function getDataReceitaFederal($intNuCpf)
    {
        if ($mixPessoaFisica = $this->getAttributeSession(self::NAME_SESSION_DATA_PERSONAL . $intNuCpf))
            return $mixPessoaFisica;
        $restCorp = new RestCorp();
        $mixPessoaFisica = $restCorp->pessoaFisicaReceitaCpf(Format::clearCpfCnpj($intNuCpf));
        if (!is_object($mixPessoaFisica))
            throw new Exception($mixPessoaFisica);
        $mixPessoaFisica->cpf = Format::formatCpfCnpj($mixPessoaFisica->cpf);
        $mixPessoaFisica->dataNascimento = Date::convertDateBase($mixPessoaFisica->dataNascimento);
        $this->setAttributeSession('InepZend_Dados_Receita_' . $intNuCpf, $mixPessoaFisica);
        return $mixPessoaFisica;
    }

    /**
     * 
     * @param type $intNuCpf
     */
    protected function setDataPessoaFisicaReceitaFederal($intNuCpf)
    {
        try {
            $mixPessoaFisica = $this->getDataReceitaFederal($intNuCpf);
            $infoUserSession = $this->getIdentity()->usuarioSistema->usuario;
            $arrFieldKey = array_keys((array) $mixPessoaFisica);
            foreach ($arrFieldKey as $strNameKey)
                $infoUserSession->$strNameKey = $mixPessoaFisica->$strNameKey;
            $infoUserSession->cpf = Format::clearCpfCnpj($infoUserSession->cpf);
            $this->pessoaFisicaCpf($intNuCpf, $this->getIdentity()->usuarioSistema->id);
            $this->getIdentity()->usuarioSistema->usuario = $infoUserSession;
            return $mixPessoaFisica;
        } catch (Exception $exception) {
            d($exception->getMessage(), 1);
            throw new Exception($exception);
        }
    }

    private function decodeContact($mixContato = null)
    {
        if (empty($mixContato))
            return false;
        if (is_object($mixContato))
            return $mixContato;
        $contato = Decoder::decode($mixContato);
        if (!property_exists($contato, 'txContato')) {
            $strTipo = (property_exists($contato, 'nuTelefone')) ? 'TELEFONE' : 'EMAIL';
            $intDdd = null;
            if ($strTipo == 'EMAIL') {
                $strContato = $contato->txEmail;
                $strSubTipoContato = $this->getContactSubType($contato->coTipoEmail, $strTipo);
            } else {
                $intDdd = $contato->nu_ddd_nuTelefone;
                $strContato = $contato->nuTelefone;
                $strSubTipoContato = $this->getContactSubType($contato->coTipoTelefone, $strTipo);
            }
            $arrContato = array(
                'id' => null,
                'ativo' => true,
                'ddd' => $intDdd,
                'tipo' => $strTipo,
                'txContato' => $strContato,
                'usuarioId' => (is_object($this->getIdentity())) ? $this->getIdentity()->usuarioSistema->usuario->id : null,
                'nomeSubTipoContato' => $strSubTipoContato,
            );
            if ($strTipo == 'EMAIL')
                unset($arrContato['ddd']);
            $contato = new stdClass($arrContato);
        }
        if (property_exists($contato, '__className'))
            unset($contato->__className);
        return $contato;
    }

    private function getContactSubType($intCoSubTipo = null, $strTipo = null)
    {
        if ((empty($intCoSubTipo)) || (empty($strTipo)))
            throw new RuntimeException('Parâmetros não informados.');
        if (!is_null($strSubTipoContato = self::getAttributeStatic('arrSubTipoContato[' . $intCoSubTipo . ']')))
            return $strSubTipoContato;
        $strMethod = 'obterSubtipoContato' . ucfirst($strTipo);
        $arrSubTipoContato = $this->getService('InepZend\Module\Oauth\Service\SsiService')->$strMethod($intCoSubTipo);
        $strSubTipoContato = (!empty($arrSubTipoContato)) ? $arrSubTipoContato[0]->nome : null;
        self::setAttributeStatic('arrSubTipoContato[' . $intCoSubTipo . ']', $strSubTipoContato);
        return $strSubTipoContato;
    }

}
