<?php

namespace InepZend\WebService\Client\Corporative\Mpog;

use InepZend\WebService\Client\Soap;
use InepZend\Util\Format;
use InepZend\Util\Validate;
use InepZend\Util\ApplicationInfo;

/**
 * Class Mpog
 *
 * Definicao da classe para consumo dos servicos disponibilizados pelo MPOG
 * para consultas a dados funcionais de servidores executivos federais
 *
 * @package InepZend\WebService\Client\Corporative\Mpog
 */
class Mpog extends Soap
{

    const URL_WSDL = 'https://www1.siapenet.gov.br/WSSiapenet/services/ConsultaSIAPE?wsdl';
    const MSG_PARAM_CPF_INVALIDO = 'CPF inválido.';
    const MSG_PARAM_PASSWORD_EMPTY = 'Informar a senha da aplicação do MPOG.';

    private static $strSystemName;
    private static $strSystemAcronym;

    /**
     * Metodo para busca de dados pessoais do servidor
     *
     * As buscas sao realizadas atraves do cpf do servidor
     * Deve-se informar a senha para consumo do servico fornecida para a aplicacao
     *
     * Pode se passar como parametros opcionais o codigo do orgao ($intCodOrgao) de atuacao do servidor
     * e a definicao de existencia de pagamento ($strExistePagamento) e do tipo de vinculo ($strTipoVinculo) conforme legenda abaixo:
     *  4.1 Quanto a existencia de Pagamento
     *      a - vinculos ativos sem ocorrencia de exclusao
     *      b - todos os vinculos
     *  4.2 Quanto ao Tipo de Vinculo
     *      a- ativos em exercício no orgao
     *      b- ativos e aposentados
     *      c- ativos, aposentados e pensionistas
     *
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->consultaDadosPessoais('cpf', 'senha');
     *
     * @param integer $intNuCpf
     * @param string $strPasssword
     * @param integer $intCodOrgao
     * @param string $strExistePagamento
     * @param string $strTipoVinculo
     * @param bool $booDebug
     * @return mix
     */
    public function consultaDadosPessoais($intNuCpf, $strPasssword, $intCodOrgao = null, $strExistePagamento = null, $strTipoVinculo = null, $booDebug = null)
    {
        if (!Validate::validateCpf($intNuCpf))
            return self::MSG_PARAM_CPF_INVALIDO;
        if (!$strPasssword)
            return self::MSG_PARAM_PASSWORD_EMPTY;

        $arrParams = array(
            'senha' => $strPasssword,
            'cpf' => Format::clearCpfCnpj($intNuCpf),
            'codOrgao' => $intCodOrgao,
            'parmExistPag' => ($strExistePagamento) ? $strExistePagamento : 'a',
            'parmTipoVinculo' => ($strTipoVinculo) ? $strTipoVinculo : 'a'
        );

        return $this->runService(array_values($arrParams), __FUNCTION__, null, $booDebug);
    }

    /**
     * Metodo para busca de dados de documentos do servidor
     *
     * As buscas sao realizadas atraves do cpf do servidor
     * Deve-se informar a senha para consumo do servico fornecida para a aplicacao
     *
     * Pode se passar como parametros opcionais o codigo do orgao ($intCodOrgao) de atuacao do servidor
     * e a definicao de existencia de pagamento ($strExistePagamento) e do tipo de vinculo ($strTipoVinculo) conforme legenda abaixo:
     *  4.1 Quanto a existencia de Pagamento
     *      a - vinculos ativos sem ocorrencia de exclusao
     *      b - todos os vinculos
     *  4.2 Quanto ao Tipo de Vinculo
     *      a- ativos em exercício no orgao
     *      b- ativos e aposentados
     *      c- ativos, aposentados e pensionistas
     *
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->consultaDadosDocumentacao('cpf', 'senha');
     *
     * @param integer $intNuCpf
     * @param string $strPasssword
     * @param integer $intCodOrgao
     * @param string $strExistePagamento
     * @param string $strTipoVinculo
     * @param bool $booDebug
     * @return mix
     */
    public function consultaDadosDocumentacao($intNuCpf, $strPasssword, $intCodOrgao = null, $strExistePagamento = null, $strTipoVinculo = null, $booDebug = null)
    {
        if (!Validate::validateCpf($intNuCpf))
            return self::MSG_PARAM_CPF_INVALIDO;
        if (!$strPasssword)
            return self::MSG_PARAM_PASSWORD_EMPTY;

        $arrParams = array(
            'senha' => $strPasssword,
            'cpf' => Format::clearCpfCnpj($intNuCpf),
            'codOrgao' => $intCodOrgao,
            'parmExistPag' => ($strExistePagamento) ? $strExistePagamento : 'a',
            'parmTipoVinculo' => ($strTipoVinculo) ? $strTipoVinculo : 'a'
        );

        return $this->runService(array_values($arrParams), __FUNCTION__, null, $booDebug);
    }

    /**
     * Metodo para busca de dados escolares do servidor
     *
     * As buscas sao realizadas atraves do cpf do servidor
     * Deve-se informar a senha para consumo do servico fornecida para a aplicacao
     *
     * Pode se passar como parametros opcionais o codigo do orgao ($intCodOrgao) de atuacao do servidor
     * e a definicao de existencia de pagamento ($strExistePagamento) e do tipo de vinculo ($strTipoVinculo) conforme legenda abaixo:
     *  4.1 Quanto a existencia de Pagamento
     *      a - vinculos ativos sem ocorrencia de exclusao
     *      b - todos os vinculos
     *  4.2 Quanto ao Tipo de Vinculo
     *      a- ativos em exercício no orgao
     *      b- ativos e aposentados
     *      c- ativos, aposentados e pensionistas
     *
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->consultaDadosEscolares('cpf', 'senha');
     *
     * @param integer $intNuCpf
     * @param string $strPasssword
     * @param integer $intCodOrgao
     * @param string $strExistePagamento
     * @param string $strTipoVinculo
     * @param bool $booDebug
     * @return mix
     */
    public function consultaDadosEscolares($intNuCpf, $strPasssword, $intCodOrgao = null, $strExistePagamento = null, $strTipoVinculo = null, $booDebug = null)
    {
        if (!Validate::validateCpf($intNuCpf))
            return self::MSG_PARAM_CPF_INVALIDO;
        if (!$strPasssword)
            return self::MSG_PARAM_PASSWORD_EMPTY;

        $arrParams = array(
            'senha' => $strPasssword,
            'cpf' => Format::clearCpfCnpj($intNuCpf),
            'codOrgao' => $intCodOrgao,
            'parmExistPag' => ($strExistePagamento) ? $strExistePagamento : 'a',
            'parmTipoVinculo' => ($strTipoVinculo) ? $strTipoVinculo : 'a'
        );

        return $this->runService(array_values($arrParams), __FUNCTION__, null, $booDebug);
    }

    /**
     * Metodo para busca de dados da unidade organizacional do servidor
     *
     * As buscas sao realizadas atraves do cpf do servidor
     * Deve-se informar a senha para consumo do servico fornecida para a aplicacao
     *
     * Pode se passar como parametros opcionais o codigo do orgao ($intCodOrgao) de atuacao do servidor
     * e a definicao de existencia de pagamento ($strExistePagamento) e do tipo de vinculo ($strTipoVinculo) conforme legenda abaixo:
     *  4.1 Quanto a existencia de Pagamento
     *      a - vinculos ativos sem ocorrencia de exclusao
     *      b - todos os vinculos
     *  4.2 Quanto ao Tipo de Vinculo
     *      a- ativos em exercício no orgao
     *      b- ativos e aposentados
     *      c- ativos, aposentados e pensionistas
     *
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->consultaDadosUorg('cpf', 'senha');
     *
     * @param integer $intNuCpf
     * @param string $strPasssword
     * @param integer $intCodOrgao
     * @param string $strExistePagamento
     * @param string $strTipoVinculo
     * @param bool $booDebug
     * @return mix
     */
    public function consultaDadosUorg($intNuCpf, $strPasssword, $intCodOrgao = null, $strExistePagamento = null, $strTipoVinculo = null, $booDebug = null)
    {
        if (!Validate::validateCpf($intNuCpf))
            return self::MSG_PARAM_CPF_INVALIDO;
        if (!$strPasssword)
            return self::MSG_PARAM_PASSWORD_EMPTY;

        $arrParams = array(
            'senha' => $strPasssword,
            'cpf' => Format::clearCpfCnpj($intNuCpf),
            'codOrgao' => $intCodOrgao,
            'parmExistPag' => ($strExistePagamento) ? $strExistePagamento : 'a',
            'parmTipoVinculo' => ($strTipoVinculo) ? $strTipoVinculo : 'a'
        );

        return $this->runService(array_values($arrParams), __FUNCTION__, null, $booDebug);
    }

    /**
     * Metodo para busca de dados do endereco residencial do servidor
     *
     * As buscas sao realizadas atraves do cpf do servidor
     * Deve-se informar a senha para consumo do servico fornecida para a aplicacao
     *
     * Pode se passar como parametros opcionais o codigo do orgao ($intCodOrgao) de atuacao do servidor
     * e a definicao de existencia de pagamento ($strExistePagamento) e do tipo de vinculo ($strTipoVinculo) conforme legenda abaixo:
     *  4.1 Quanto a existencia de Pagamento
     *      a - vinculos ativos sem ocorrencia de exclusao
     *      b - todos os vinculos
     *  4.2 Quanto ao Tipo de Vinculo
     *      a- ativos em exercício no orgao
     *      b- ativos e aposentados
     *      c- ativos, aposentados e pensionistas
     *
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->consultaDadosEnderecoResidencial('cpf', 'senha');
     *
     * @param integer $intNuCpf
     * @param string $strPasssword
     * @param integer $intCodOrgao
     * @param string $strExistePagamento
     * @param string $strTipoVinculo
     * @param bool $booDebug
     * @return mix
     */
    public function consultaDadosEnderecoResidencial($intNuCpf, $strPasssword, $intCodOrgao = null, $strExistePagamento = null, $strTipoVinculo = null, $booDebug = null)
    {
        if (!Validate::validateCpf($intNuCpf))
            return self::MSG_PARAM_CPF_INVALIDO;
        if (!$strPasssword)
            return self::MSG_PARAM_PASSWORD_EMPTY;

        $arrParams = array(
            'senha' => $strPasssword,
            'cpf' => Format::clearCpfCnpj($intNuCpf),
            'codOrgao' => $intCodOrgao,
            'parmExistPag' => ($strExistePagamento) ? $strExistePagamento : 'a',
            'parmTipoVinculo' => ($strTipoVinculo) ? $strTipoVinculo : 'a'
        );

        return $this->runService(array_values($arrParams), __FUNCTION__, null, $booDebug);
    }

    /**
     * Metodo para busca de dados dos dependentes do servidor
     *
     * As buscas sao realizadas atraves do cpf do servidor
     * Deve-se informar a senha para consumo do servico fornecida para a aplicacao
     *
     * Pode se passar como parametros opcionais o codigo do orgao ($intCodOrgao) de atuacao do servidor
     * e a definicao de existencia de pagamento ($strExistePagamento) e do tipo de vinculo ($strTipoVinculo) conforme legenda abaixo:
     *  4.1 Quanto a existencia de Pagamento
     *      a - vinculos ativos sem ocorrencia de exclusao
     *      b - todos os vinculos
     *  4.2 Quanto ao Tipo de Vinculo
     *      a- ativos em exercício no orgao
     *      b- ativos e aposentados
     *      c- ativos, aposentados e pensionistas
     *
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->consultaDadosDependentes('cpf', 'senha');
     *
     * @param integer $intNuCpf
     * @param string $strPasssword
     * @param integer $intCodOrgao
     * @param string $strExistePagamento
     * @param string $strTipoVinculo
     * @param bool $booDebug
     * @return mix
     */
    public function consultaDadosDependentes($intNuCpf, $strPasssword, $intCodOrgao = null, $strExistePagamento = null, $strTipoVinculo = null, $booDebug = null)
    {
        if (!Validate::validateCpf($intNuCpf))
            return self::MSG_PARAM_CPF_INVALIDO;
        if (!$strPasssword)
            return self::MSG_PARAM_PASSWORD_EMPTY;

        $arrParams = array(
            'senha' => $strPasssword,
            'cpf' => Format::clearCpfCnpj($intNuCpf),
            'codOrgao' => $intCodOrgao,
            'parmExistPag' => ($strExistePagamento) ? $strExistePagamento : 'a',
            'parmTipoVinculo' => ($strTipoVinculo) ? $strTipoVinculo : 'a'
        );

        return $this->runService(array_values($arrParams), __FUNCTION__, null, $booDebug);
    }

    /**
     * Metodo para busca de dados bancarios do servidor
     *
     * As buscas sao realizadas atraves do cpf do servidor
     * Deve-se informar a senha para consumo do servico fornecida para a aplicacao
     *
     * Pode se passar como parametros opcionais o codigo do orgao ($intCodOrgao) de atuacao do servidor
     * e a definicao de existencia de pagamento ($strExistePagamento) e do tipo de vinculo ($strTipoVinculo) conforme legenda abaixo:
     *  4.1 Quanto a existencia de Pagamento
     *      a - vinculos ativos sem ocorrencia de exclusao
     *      b - todos os vinculos
     *  4.2 Quanto ao Tipo de Vinculo
     *      a- ativos em exercício no orgao
     *      b- ativos e aposentados
     *      c- ativos, aposentados e pensionistas
     *
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->consultaDadosBancarios('cpf', 'senha');
     *
     * @param integer $intNuCpf
     * @param string $strPasssword
     * @param integer $intCodOrgao
     * @param string $strExistePagamento
     * @param string $strTipoVinculo
     * @param bool $booDebug
     * @return mix
     */
    public function consultaDadosBancarios($intNuCpf, $strPasssword, $intCodOrgao = null, $strExistePagamento = null, $strTipoVinculo = null, $booDebug = null)
    {
        if (!Validate::validateCpf($intNuCpf))
            return self::MSG_PARAM_CPF_INVALIDO;
        if (!$strPasssword)
            return self::MSG_PARAM_PASSWORD_EMPTY;

        $arrParams = array(
            'senha' => $strPasssword,
            'cpf' => Format::clearCpfCnpj($intNuCpf),
            'codOrgao' => $intCodOrgao,
            'parmExistPag' => ($strExistePagamento) ? $strExistePagamento : 'a',
            'parmTipoVinculo' => ($strTipoVinculo) ? $strTipoVinculo : 'a'
        );

        return $this->runService(array_values($arrParams), __FUNCTION__, null, $booDebug);
    }

    /**
     * Metodo para busca de dados financeiros do servidor
     *
     * As buscas sao realizadas atraves do cpf do servidor
     * Deve-se informar a senha para consumo do servico fornecida para a aplicacao
     *
     * Pode se passar como parametros opcionais o codigo do orgao ($intCodOrgao) de atuacao do servidor
     * e a definicao de existencia de pagamento ($strExistePagamento) e do tipo de vinculo ($strTipoVinculo) conforme legenda abaixo:
     *  4.1 Quanto a existencia de Pagamento
     *      a - vinculos ativos sem ocorrencia de exclusao
     *      b - todos os vinculos
     *  4.2 Quanto ao Tipo de Vinculo
     *      a- ativos em exercício no orgao
     *      b- ativos e aposentados
     *      c- ativos, aposentados e pensionistas
     *
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->consultaDadosFinanceiros('cpf', 'senha');
     *
     * @param integer $intNuCpf
     * @param string $strPasssword
     * @param integer $intCodOrgao
     * @param string $strExistePagamento
     * @param string $strTipoVinculo
     * @param bool $booDebug
     * @return mix
     */
    public function consultaDadosFinanceiros($intNuCpf, $strPasssword, $intCodOrgao = null, $strExistePagamento = null, $strTipoVinculo = null, $booDebug = null)
    {
        if (!Validate::validateCpf($intNuCpf))
            return self::MSG_PARAM_CPF_INVALIDO;
        if (!$strPasssword)
            return self::MSG_PARAM_PASSWORD_EMPTY;

        $arrParams = array(
            'senha' => $strPasssword,
            'cpf' => Format::clearCpfCnpj($intNuCpf),
            'codOrgao' => $intCodOrgao,
            'parmExistPag' => ($strExistePagamento) ? $strExistePagamento : 'a',
            'parmTipoVinculo' => ($strTipoVinculo) ? $strTipoVinculo : 'a'
        );

        return $this->runService(array_values($arrParams), __FUNCTION__, null, $booDebug);
    }

    /**
     * Metodo para busca de dados funcionais do servidor
     *
     * As buscas sao realizadas atraves do cpf do servidor
     * Deve-se informar a senha para consumo do servico fornecida para a aplicacao
     *
     * Pode se passar como parametros opcionais o codigo do orgao ($intCodOrgao) de atuacao do servidor
     * e a definicao de existencia de pagamento ($strExistePagamento) e do tipo de vinculo ($strTipoVinculo) conforme legenda abaixo:
     *  4.1 Quanto a existencia de Pagamento
     *      a - vinculos ativos sem ocorrencia de exclusao
     *      b - todos os vinculos
     *  4.2 Quanto ao Tipo de Vinculo
     *      a- ativos em exercício no orgao
     *      b- ativos e aposentados
     *      c- ativos, aposentados e pensionistas
     *
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->consultaDadosFuncionais('cpf', 'senha');
     *
     * @param integer $intNuCpf
     * @param string $strPasssword
     * @param integer $intCodOrgao
     * @param string $strExistePagamento
     * @param string $strTipoVinculo
     * @param bool $booDebug
     * @return mix
     */
    public function consultaDadosFuncionais($intNuCpf, $strPasssword, $intCodOrgao = null, $strExistePagamento = null, $strTipoVinculo = null, $booDebug = null)
    {
        if (!Validate::validateCpf($intNuCpf))
            return self::MSG_PARAM_CPF_INVALIDO;
        if (!$strPasssword)
            return self::MSG_PARAM_PASSWORD_EMPTY;

        $arrParams = array(
            'senha' => $strPasssword,
            'cpf' => Format::clearCpfCnpj($intNuCpf),
            'codOrgao' => $intCodOrgao,
            'parmExistPag' => ($strExistePagamento) ? $strExistePagamento : 'a',
            'parmTipoVinculo' => ($strTipoVinculo) ? $strTipoVinculo : 'b'
        );

        return $this->runService(array_values($arrParams), __FUNCTION__, null, $booDebug);
    }

    /**
     * Metodo para execucao do servico
     *
     * As execucoes da chamada ao servico sao feitas atraves da colecao de parametros ($mixParam)
     * e metodo a ser executado no servico ($strMethod)
     *
     * @param array $mixParam
     * @param string $strMethod
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return mix
     */
    public function runService($mixParam = null, $strMethod = null, $strUrlWsdl = null, $booDebug = null)
    {
        if (empty($mixParam))
            return self::MSG_PARAM_NOT_FOUND;
        if (is_array($mixParam)) {
            $strSystemName = self::getSystemName();
            $strSystemAcronym = self::getSystemAcronym();
            if (empty($strSystemName))
                $strSystemName = ApplicationInfo::getApplicationInfo()['NAME'];
            if (empty($strSystemAcronym))
                $strSystemAcronym = ApplicationInfo::getApplicationInfo()['ACRONYM'];
            $mixParam = array_values(array_merge(array($strSystemAcronym, $strSystemName), $mixParam));
        }
        return parent::runService(__CLASS__, $strMethod, $strUrlWsdl, $booDebug, $mixParam);
    }

    public static function setSystemName($strSystemName = null)
    {
        return (self::$strSystemName = $strSystemName);
    }

    private static function getSystemName()
    {
        return self::$strSystemName;
    }

    public static function setSystemAcronym($strSystemAcronym = null)
    {
        return (self::$strSystemAcronym = $strSystemAcronym);
    }

    private static function getSystemAcronym()
    {
        return self::$strSystemAcronym;
    }

}
