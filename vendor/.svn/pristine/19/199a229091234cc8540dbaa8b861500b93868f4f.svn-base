<?php

namespace InepZend\Util;

use InepZend\Util\Server;
use InepZend\Util\ApplicationProperties;

/**
 * Classe responsavel pela identificacao do ambiente que esta executando a aplicacao.
 *
 * @package InepZend
 * @subpackage Util
 */
class Environment
{

    const LOCAL = 'local';
    const LOCALHOST = self::LOCAL;
    const DESENVOLVIMENTO = 'desenvolvimento';
    const ENTREGA = 'entrega';
    const TQS = 'tqs';
    const HOMOLOGACAO = 'homologação';
    const TREINAMENTO = 'treinamento';
    const CLONE_D1 = 'clone';
    const PRODUCAO = 'produção';
    const IP_LOCAL = '127.0.0.1';
    const IP_LOCALHOST = self::IP_LOCAL;
    const IP_DESENVOLVIMENTO = '172.29.9.215';
    const IP_DESENVOLVIMENTO2 = '172.29.9.94';
    const IP_ENTREGA = '172.29.9.131';
    const IP_TQS = '172.29.9.96';
    const IP_HOMOLOGACAO = '172.29.9.217';
    const IP_TREINAMENTO = '172.29.9.98';
    const IP_CLONE_D1 = '172.29.9.104';

    public static function getEnvironmentName()
    {
        return self::getEnvironmentFromIpServer(true);
    }

    public static function isLocal()
    {
        return (self::getEnvironmentName() == self::LOCAL);
    }

    public static function isDevelopment()
    {
        return (self::getEnvironmentName() == self::DESENVOLVIMENTO);
    }

    public static function isEntrega()
    {
        return (self::getEnvironmentName() == self::ENTREGA);
    }

    public static function isTqs()
    {
        return (self::getEnvironmentName() == self::TQS);
    }

    public static function isHomologation()
    {
        return (self::getEnvironmentName() == self::HOMOLOGACAO);
    }

    public static function isTraining()
    {
        return (self::getEnvironmentName() == self::TREINAMENTO);
    }

    public static function isClone()
    {
        return (self::getEnvironmentName() == self::CLONE_D1);
    }

    public static function isProduction()
    {
        return (self::getEnvironmentName() == self::PRODUCAO);
    }

    /**
     * Metodo responsavel em verificar o ambiente que o projeto esta executando.
     *
     * @example \InepZend\Util\Server::getEnvironmentFromIpServer()
     *
     * @param boolean $booApplicationProperties
     * @return string
     */
    public static function getEnvironmentFromIpServer($booApplicationProperties = true)
    {
        if ($booApplicationProperties) {
            $strEnvironment = self::getEnvironmentFromApplicationProperties();
            if (!is_bool($strEnvironment))
                return $strEnvironment;
        }
        switch (Server::getIpServer()) {
            case 'localhost':
            case '127.0.1.1':
            case '172.17.0.2':
            case self::IP_LOCAL:
                $strEnvironment = self::LOCAL;
                break;
            case self::IP_DESENVOLVIMENTO:
            case self::IP_DESENVOLVIMENTO2:
                $strEnvironment = self::DESENVOLVIMENTO;
                break;
            case self::IP_ENTREGA:
                $strEnvironment = self::ENTREGA;
                break;
            case self::IP_TQS:
                $strEnvironment = self::TQS;
                break;
            case self::IP_HOMOLOGACAO:
                $strEnvironment = self::HOMOLOGACAO;
                break;
            case self::IP_TREINAMENTO:
                $strEnvironment = self::TREINAMENTO;
                break;
            case self::IP_CLONE_D1:
                $strEnvironment = self::CLONE_D1;
                break;
            case '':
            case null:
            case false:
                return false;
            default:
                $strEnvironment = self::PRODUCAO;
                break;
        }
        return $strEnvironment;
    }

    public static function getEnvironmentFromApplicationProperties()
    {
        $strEnvironmentFromApplicationProperties = ApplicationProperties::get('application.env');
        if (!is_string($strEnvironmentFromApplicationProperties))
            return false;
        if (stripos($strEnvironmentFromApplicationProperties, 'loc') === 0)
            $strEnvironment = self::LOCAL;
        elseif ((stripos($strEnvironmentFromApplicationProperties, 'dev') === 0) || (stripos($strEnvironmentFromApplicationProperties, 'des') === 0))
            $strEnvironment = self::DESENVOLVIMENTO;
        elseif (stripos($strEnvironmentFromApplicationProperties, 'ent') === 0)
            $strEnvironment = self::ENTREGA;
        elseif ((stripos($strEnvironmentFromApplicationProperties, 'tqs') === 0) || (stripos($strEnvironmentFromApplicationProperties, 'tes') === 0))
            $strEnvironment = self::TQS;
        elseif ((stripos($strEnvironmentFromApplicationProperties, 'hom') === 0) || (stripos($strEnvironmentFromApplicationProperties, 'hmg') === 0))
            $strEnvironment = self::HOMOLOGACAO;
        elseif ((stripos($strEnvironmentFromApplicationProperties, 'tre') === 0) || (stripos($strEnvironmentFromApplicationProperties, 'tra') === 0))
            $strEnvironment = self::TREINAMENTO;
        elseif (stripos($strEnvironmentFromApplicationProperties, 'clo') === 0)
            $strEnvironment = self::CLONE_D1;
        elseif (stripos($strEnvironmentFromApplicationProperties, 'pro') === 0)
            $strEnvironment = self::PRODUCAO;
        else
            return false;
        return $strEnvironment;
    }

    /**
     * Metodo responsavel pelo retorno do sufixo do ambiente que esta executando 
     * o projeto
     *
     * @param boolean $booLocal
     * @return string
     */
    public static function getSufix($booLocal = null)
    {
        $strSufix = '';
        switch (self::getEnvironmentFromIpServer()) {
            case self::LOCAL:
            case self::DESENVOLVIMENTO:
                $strSufix = (($booLocal === true) && (self::getEnvironmentFromIpServer() == self::LOCAL)) ? '_LOCAL' : '_DESENV';
                break;
            case self::ENTREGA:
                $strSufix = '_ENTREGA';
                break;
            case self::TQS:
                $strSufix = '_TQS';
                break;
            case self::HOMOLOGACAO:
                $strSufix = '_HOMOLOGA';
                break;
            case self::TREINAMENTO:
                $strSufix = '_TREINAMENTO';
                break;
            case self::CLONE_D1:
                $strSufix = '_CLONE_D1';
                break;
        }
        return $strSufix;
    }

}
