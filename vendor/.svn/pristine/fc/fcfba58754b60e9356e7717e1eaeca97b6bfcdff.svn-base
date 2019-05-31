<?php

namespace InepZend\Module\Corporative;

use InepZend\Module\Corporative\Service\VwPessoaFisicaDocumento;
use InepZend\ModuleConfig\ModuleConfig;
use InepZend\Module\Corporative\Service\CorRaca;
use InepZend\Module\Corporative\Service\Cpf;
use InepZend\Module\Corporative\Service\EstadoCivil;
use InepZend\Module\Corporative\Service\Municipio;
use InepZend\Module\Corporative\Service\OrgaoEmissor;
use InepZend\Module\Corporative\Service\Pais;
use InepZend\Module\Corporative\Service\Uf;
use InepZend\Module\Corporative\Service\Etnia;
use InepZend\Module\Corporative\Service\Cep;
use InepZend\Module\Corporative\Service\Entrancia;
use InepZend\Module\Corporative\Service\GrupoSanguineo;
use InepZend\Module\Corporative\Service\HistoricoPessoaFisica;
use InepZend\Module\Corporative\Service\HistoricoPfContato;
use InepZend\Module\Corporative\Service\HistoricoPfDocumento;
use InepZend\Module\Corporative\Service\HistoricoPfEndereco;
use InepZend\Module\Corporative\Service\HistPessoaNecessidadeEsp;
use InepZend\Module\Corporative\Service\PessoaNecessidadeEspecial;
use InepZend\Module\Corporative\Service\TipoAtribuicaoCartorio;
use InepZend\Module\Corporative\Service\TipoContato;
use InepZend\Module\Corporative\Service\TipoEndereco;
use InepZend\Module\Corporative\Service\Cartorio;
use InepZend\Module\Corporative\Service\NecessidadeEspecial;
use InepZend\Module\Corporative\Service\TipoNecessidadeEspecial;
use InepZend\Module\Corporative\Service\PessoaFisica;
use InepZend\Module\Corporative\Service\PessoaFisicaContato;
use InepZend\Module\Corporative\Service\PessoaFisicaDocumento;
use InepZend\Module\Corporative\Service\PessoaFisicaEndereco;
use InepZend\Module\Corporative\Service\Idioma;
use InepZend\Module\Corporative\Service\HistIdioma;
use InepZend\Module\Corporative\Service\Ocupacao;
use InepZend\Module\Corporative\Service\HistOcupacao;
use InepZend\Module\Corporative\Service\Evento;
use InepZend\Module\Corporative\Service\ProjetoPerfil;
use InepZend\Module\Corporative\Service\Regiao;
use InepZend\Module\Corporative\Service\HistProjeto;
use InepZend\Module\Corporative\Service\HistPrograma;
use InepZend\Module\Corporative\Service\Acao;
use InepZend\Module\Corporative\Service\Distrito;
use InepZend\Module\Corporative\Service\DocumentoPessoaFisicaLog;
use InepZend\Module\Corporative\Service\PessoaFisicaLog;
use InepZend\Module\Corporative\Service\TipoDocumento;
use InepZend\Module\Corporative\Service\HistComponenteOrg;
use InepZend\Module\Corporative\Service\PessoaJuridicaLog;
use InepZend\Module\Corporative\Service\Moeda;
use InepZend\Module\Corporative\Service\Usuario;
use InepZend\Module\Corporative\Service\TipoFeriado;
use InepZend\Module\Corporative\Service\ConselhoProfissional;
use InepZend\Module\Corporative\Service\PessoaEndereco;
use InepZend\Module\Corporative\Service\PessoaJuridica;
use InepZend\Module\Corporative\Service\PessoaEnderecoLog;
use InepZend\Module\Corporative\Service\CartorioEndereco;
use InepZend\Module\Corporative\Service\Banco;
use InepZend\Module\Corporative\Service\AtendimentoEspecial;
use InepZend\Module\Corporative\Service\CepNew;
use InepZend\Module\Corporative\Service\ComponenteOrganizacional;
use InepZend\Module\Corporative\Service\CartorioBkp;
use InepZend\Module\Corporative\Service\CartorioContato;
use InepZend\Module\Corporative\Service\PessoaContatoLog;
use InepZend\Module\Corporative\Service\HistEvento;
use InepZend\Module\Corporative\Service\DocumentoPessoaFisica;
use InepZend\Module\Corporative\Service\HistProjetoEvento;
use InepZend\Module\Corporative\Service\AgenciaBancaria;
use InepZend\Module\Corporative\Service\HistoricoLogin;
use InepZend\Module\Corporative\Service\ProjetoEvento;
use InepZend\Module\Corporative\Service\Projeto;
use InepZend\Module\Corporative\Service\Programa;
use InepZend\Module\Corporative\Service\GrauEscolaridade;
use InepZend\Module\Corporative\Service\Perfil;
use InepZend\Module\Corporative\Service\Feriado;
use InepZend\Module\Corporative\Service\Sistema;
use InepZend\Module\Corporative\Service\UsuarioSistema;
use InepZend\Module\Corporative\Service\PessoaContato;
use InepZend\Module\Corporative\Service\VwAgenciaBancaria;
use InepZend\Module\Corporative\Service\VwBanco;
use InepZend\Module\Corporative\Service\VwCartorio;
use InepZend\Module\Corporative\Service\VwCep;
use InepZend\Module\Corporative\Service\VwCpf;
use InepZend\Module\Corporative\Service\VwDistrito;
use InepZend\Module\Corporative\Service\VwEstadoCivil;
use InepZend\Module\Corporative\Service\VwEtnia;
use InepZend\Module\Corporative\Service\VwGrupoSanguineo;
use InepZend\Module\Corporative\Service\VwIdioma;
use InepZend\Module\Corporative\Service\VwMunicipio;
use InepZend\Module\Corporative\Service\VwMunicipioDdd;
use InepZend\Module\Corporative\Service\VwNecessidadeEspecial;
use InepZend\Module\Corporative\Service\VwOcupacao;
use InepZend\Module\Corporative\Service\VwOrgaoEmissor;
use InepZend\Module\Corporative\Service\VwPais;
use InepZend\Module\Corporative\Service\VwPessoaFisica;
use InepZend\Module\Corporative\Service\VwPessoaFisicaEndereco;
use InepZend\Module\Corporative\Service\VwPrograma;
use InepZend\Module\Corporative\Service\VwProjeto;
use InepZend\Module\Corporative\Service\VwProjetoEvento;
use InepZend\Module\Corporative\Service\VwProjetoPerfil;
use InepZend\Module\Corporative\Service\VwRegiao;
use InepZend\Module\Corporative\Service\VwSubdistrito;
use InepZend\Module\Corporative\Service\VwUf;
use InepZend\Module\Corporative\Service\VwPessoaFisicaContato;
use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;

class Module extends ModuleConfig
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InepZend\Corporative\Service\CorRaca' => function($serviceManager) {
                    return new CorRaca($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\CorRaca' => function($serviceManager) {
                    return new CorRaca($this->getEntityManager($serviceManager));
                },
                'InepZend\Corporative\Service\Cpf' => function($serviceManager) {
                    return new Cpf($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Cpf' => function($serviceManager) {
                    return new Cpf($this->getEntityManager($serviceManager));
                },
                'InepZend\Corporative\Service\EstadoCivil' => function($serviceManager) {
                    return new EstadoCivil($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\EstadoCivil' => function($serviceManager) {
                    return new EstadoCivil($this->getEntityManager($serviceManager));
                },
                'InepZend\Corporative\Service\Municipio' => function($serviceManager) {
                    return new Municipio($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Municipio' => function($serviceManager) {
                    return new Municipio($this->getEntityManager($serviceManager));
                },
                'InepZend\Corporative\Service\OrgaoEmissor' => function($serviceManager) {
                    return new OrgaoEmissor($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\OrgaoEmissor' => function($serviceManager) {
                    return new OrgaoEmissor($this->getEntityManager($serviceManager));
                },
                'InepZend\Corporative\Service\Pais' => function($serviceManager) {
                    return new Pais($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Pais' => function($serviceManager) {
                    return new Pais($this->getEntityManager($serviceManager));
                },
                'InepZend\Corporative\Service\Uf' => function($serviceManager) {
                    return new Uf($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Uf' => function($serviceManager) {
                    return new Uf($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Etnia' => function($serviceManager) {
                    return new Etnia($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Cep' => function($serviceManager) {
                    return new Cep($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Entrancia' => function($serviceManager) {
                    return new Entrancia($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\GrupoSanguineo' => function($serviceManager) {
                    return new GrupoSanguineo($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\HistoricoPessoaFisica' => function($serviceManager) {
                    return new HistoricoPessoaFisica($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\HistoricoPfContato' => function($serviceManager) {
                    return new HistoricoPfContato($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\HistoricoPfDocumento' => function($serviceManager) {
                    return new HistoricoPfDocumento($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\HistoricoPfEndereco' => function($serviceManager) {
                    return new HistoricoPfEndereco($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\HistPessoaNecessidadeEsp' => function($serviceManager) {
                    return new HistPessoaNecessidadeEsp($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\PessoaNecessidadeEspecial' => function($serviceManager) {
                    return new PessoaNecessidadeEspecial($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\TipoAtribuicaoCartorio' => function($serviceManager) {
                    return new TipoAtribuicaoCartorio($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\TipoContato' => function($serviceManager) {
                    return new TipoContato($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\TipoEndereco' => function($serviceManager) {
                    return new TipoEndereco($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Cartorio' => function($serviceManager) {
                    return new Cartorio($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\NecessidadeEspecial' => function($serviceManager) {
                    return new NecessidadeEspecial($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\TipoNecessidadeEspecial' => function($serviceManager) {
                    return new TipoNecessidadeEspecial($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\PessoaFisica' => function($serviceManager) {
                    return new PessoaFisica($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\PessoaFisicaContato' => function($serviceManager) {
                    return new PessoaFisicaContato($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\PessoaFisicaDocumento' => function($serviceManager) {
                    return new PessoaFisicaDocumento($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\PessoaFisicaEndereco' => function($serviceManager) {
                    return new PessoaFisicaEndereco($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Idioma' => function($serviceManager) {
                    return new Idioma($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\HistIdioma' => function($serviceManager) {
                    return new HistIdioma($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Ocupacao' => function($serviceManager) {
                    return new Ocupacao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\HistOcupacao' => function($serviceManager) {
                    return new HistOcupacao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Evento' => function($serviceManager) {
                    return new Evento($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\ProjetoPerfil' => function($serviceManager) {
                    return new ProjetoPerfil($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\OrgaoEmissor' => function($serviceManager) {
                    return new OrgaoEmissor($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Regiao' => function($serviceManager) {
                    return new Regiao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\HistProjeto' => function($serviceManager) {
                    return new HistProjeto($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\HistPrograma' => function($serviceManager) {
                    return new HistPrograma($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Acao' => function($serviceManager) {
                    return new Acao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Distrito' => function($serviceManager) {
                    return new Distrito($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\DocumentoPessoaFisicaLog' => function($serviceManager) {
                    return new DocumentoPessoaFisicaLog($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\PessoaFisicaLog' => function($serviceManager) {
                    return new PessoaFisicaLog($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\TipoDocumento' => function($serviceManager) {
                    return new TipoDocumento($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\HistComponenteOrg' => function($serviceManager) {
                    return new HistComponenteOrg($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\PessoaJuridicaLog' => function($serviceManager) {
                    return new PessoaJuridicaLog($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Moeda' => function($serviceManager) {
                    return new Moeda($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Usuario' => function($serviceManager) {
                    return new Usuario($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\TipoFeriado' => function($serviceManager) {
                    return new TipoFeriado($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\ConselhoProfissional' => function($serviceManager) {
                    return new ConselhoProfissional($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\PessoaEndereco' => function($serviceManager) {
                    return new PessoaEndereco($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\PessoaJuridica' => function($serviceManager) {
                    return new PessoaJuridica($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\PessoaEnderecoLog' => function($serviceManager) {
                    return new PessoaEnderecoLog($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\CartorioEndereco' => function($serviceManager) {
                    return new CartorioEndereco($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Banco' => function($serviceManager) {
                    return new Banco($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\AtendimentoEspecial' => function($serviceManager) {
                    return new AtendimentoEspecial($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\CepNew' => function($serviceManager) {
                    return new CepNew($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\EstadoCivil' => function($serviceManager) {
                    return new EstadoCivil($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\ComponenteOrganizacional' => function($serviceManager) {
                    return new ComponenteOrganizacional($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\CartorioBkp' => function($serviceManager) {
                    return new CartorioBkp($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\CartorioContato' => function($serviceManager) {
                    return new CartorioContato($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\PessoaContatoLog' => function($serviceManager) {
                    return new PessoaContatoLog($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\HistEvento' => function($serviceManager) {
                    return new HistEvento($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\DocumentoPessoaFisica' => function($serviceManager) {
                    return new DocumentoPessoaFisica($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\HistProjetoEvento' => function($serviceManager) {
                    return new HistProjetoEvento($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\AgenciaBancaria' => function($serviceManager) {
                    return new AgenciaBancaria($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\HistoricoLogin' => function($serviceManager) {
                    return new HistoricoLogin($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\ProjetoEvento' => function($serviceManager) {
                    return new ProjetoEvento($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Projeto' => function($serviceManager) {
                    return new Projeto($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Programa' => function($serviceManager) {
                    return new Programa($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\GrauEscolaridade' => function($serviceManager) {
                    return new GrauEscolaridade($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Perfil' => function($serviceManager) {
                    return new Perfil($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Feriado' => function($serviceManager) {
                    return new Feriado($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\Sistema' => function($serviceManager) {
                    return new Sistema($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\UsuarioSistema' => function($serviceManager) {
                    return new UsuarioSistema($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\PessoaContato' => function($serviceManager) {
                    return new PessoaContato($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwAgenciaBancaria' => function($serviceManager) {
                    return new VwAgenciaBancaria($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwBanco' => function($serviceManager) {
                    return new VwBanco($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwCartorio' => function($serviceManager) {
                    return new VwCartorio($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwCep' => function($serviceManager) {
                    return new VwCep($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwCpf' => function($serviceManager) {
                    return new VwCpf($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwDistrito' => function($serviceManager) {
                    return new VwDistrito($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwEstadoCivil' => function($serviceManager) {
                    return new VwEstadoCivil($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwEtnia' => function($serviceManager) {
                    return new VwEtnia($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwGrupoSanguineo' => function($serviceManager) {
                    return new VwGrupoSanguineo($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwIdioma' => function($serviceManager) {
                    return new VwIdioma($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwMunicipio' => function($serviceManager) {
                    return new VwMunicipio($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwMunicipioDdd' => function($serviceManager) {
                    return new VwMunicipioDdd($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwNecessidadeEspecial' => function($serviceManager) {
                    return new VwNecessidadeEspecial($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwOcupacao' => function($serviceManager) {
                    return new VwOcupacao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwOrgaoEmissor' => function($serviceManager) {
                    return new VwOrgaoEmissor($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwPais' => function($serviceManager) {
                    return new VwPais($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwPessoaFisica' => function($serviceManager) {
                    return new VwPessoaFisica($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwPessoaFisicaEndereco' => function($serviceManager) {
                    return new VwPessoaFisicaEndereco($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwPrograma' => function($serviceManager) {
                    return new VwPrograma($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwProjeto' => function($serviceManager) {
                    return new VwProjeto($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwProjetoEvento' => function($serviceManager) {
                    return new VwProjetoEvento($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwProjetoPerfil' => function($serviceManager) {
                    return new VwProjetoPerfil($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwRegiao' => function($serviceManager) {
                    return new VwRegiao($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwSubdistrito' => function($serviceManager) {
                    return new VwSubdistrito($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwUf' => function($serviceManager) {
                    return new VwUf($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwPessoaFisicaContato' => function($serviceManager) {
                    return new VwPessoaFisicaContato($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Corporative\Service\VwPessoaFisicaDocumento' => function($serviceManager) {
                    return new VwPessoaFisicaDocumento($this->getEntityManager($serviceManager));
                },
            )
        );
    }

    protected function getEntityManager($serviceManager = null, $strServiceEntityManager = null)
    {
        if (empty($strServiceEntityManager)) {
            foreach (debug_backtrace() as $intTrace => $arrTrace) {
                if (
                        (array_key_exists('object', $arrTrace)) &&
                        (
                            (strpos($arrTrace['class'], 'InepZend\Module\\') === 0) ||
                            (
                                (strpos($arrTrace['class'], 'Zend\\') === false) &&
                                (strpos($arrTrace['class'], 'Doctrine\\') === false) &&
                                (strpos($arrTrace['class'], 'InepZend\\') === false)
                            )
                        )
                ) {
                    $strOrmModule = null;
                    $entityManager = null;

                    if ($arrTrace['object'] instanceof EntityManager) {
                        if (
                            (!$arrTrace['object'] instanceof ModuleConfig) &&
                            (!$arrTrace['object'] instanceof AbstractActionController) &&
                            (
                                (
                                    (method_exists($arrTrace['object'], 'getEntityManager')) &&
                                    (get_class($arrTrace['object']->getEntityManager()->getConnection()->getDriver()) == 'Doctrine\DBAL\Driver\PDOSqlite\Driver')
                                ) ||
                                (strpos(get_class($arrTrace['object']), 'InepZend\Module\TrocaArquivo') === 0)
                            )
                        ) {
                            $strOrmModule = 'orm_default';
                            $arrDoctrineConnection = @$GLOBALS['doctrine_connection'][$strOrmModule];
                            if ((is_array($arrDoctrineConnection)) && (count($arrDoctrineConnection) > 0)) {
                                $entityManager = $serviceManager->get('doctrine.entitymanager.' . $strOrmModule);
                                if (is_object($entityManager)) {
                                    return $entityManager;
                                }
                            }
                        }
                        if ((!$arrTrace['object'] instanceof ModuleConfig) && (!$arrTrace['object'] instanceof AbstractActionController) && (method_exists($arrTrace['object'], 'getEntityManager'))) {
                            $entityManager = $arrTrace['object']->getEntityManager();
                        } else {
                            $strOrmModule = 'orm_' . strtolower(reset($arrExplode = explode('\\', str_replace('InepZend\Module\\', '', $arrTrace['class']))));
                            $arrDoctrineConnection = @$GLOBALS['doctrine_connection'][$strOrmModule];
                            if ((is_array($arrDoctrineConnection)) && (count($arrDoctrineConnection) > 0)) {
                                $entityManager = $serviceManager->get('doctrine.entitymanager.' . $strOrmModule);
                            }
                        }
                        if ((is_object($entityManager)) && (get_class($entityManager->getConnection()->getDriver()) != 'Doctrine\DBAL\Driver\PDOSqlite\Driver'))
                            return $entityManager;
                    }
                }
            }
        }
        $arrModules = @$GLOBALS['modules'];
        if (is_array($arrModules)) {
            foreach ($arrModules as $strModule) {
                if (!in_array($strModule, array('DoctrineModule', 'DoctrineORMModule', 'InepZend', 'ExampleRestful', 'Emec'))) {
                    $strOrmModule = 'orm_' . strtolower($strModule);
                    $arrDoctrineConnection = @$GLOBALS['doctrine_connection'][$strOrmModule];
                    if ((is_array($arrDoctrineConnection)) && (count($arrDoctrineConnection) > 0)) {
                        $entityManager = $serviceManager->get('doctrine.entitymanager.' . $strOrmModule);
                        if (get_class($entityManager->getConnection()->getDriver()) == 'Doctrine\DBAL\Driver\PDOSqlite\Driver')
                            continue;
                        $booAccess = false;
                        try {
                            $mixResult = $entityManager->find('InepZend\Module\Corporative\Entity\Municipio', 1);
                            $booAccess = true;
                        } catch (\Exception $exception) {
                            
                        }
                        if ($booAccess) {
                            return $entityManager;
                        }
                    }
                }
            }
        }
        return parent::getEntityManager($serviceManager, $strServiceEntityManager);
    }

}
