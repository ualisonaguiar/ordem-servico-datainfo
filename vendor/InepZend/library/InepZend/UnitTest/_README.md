**<i class="icon-folder-open"></i> UnitTest**
===

1. Índice
---
[TOC]

<i class="icon-th"></i> 2. Definição
---


___

###<i class="icon-pencil"></i> 2.1. Conceito

> Testes unitários ou popularmente conhecidos como *Unit Test*, são os primeiros passos/testes que o desenvolvedor implementa, no qual é criado durante a fase de desenvolvimento ou preferencialmente antes do seu inicio.
O objetivo dos testes unitário é verificar a menor funcionalidade (unidade) implementada em um software, na qual isola partes dos códigos e métodos analisando se essas funcionalidades retornam o esperado mediando a um valor informado.
O componente **UnitTest** do **InepZend** utiliza em sua concepção a biblioteca PHPUnit <<https://phpunit.de/>>, sendo essa uma das mais difundidas para a linguagem PHP.

<a id="definicao-service"></a>
####**2.1.1 TDD (Test Driven Development)** 

 - Test Driven Development (TDD) ou Desenvolvimento Orientado a Testes é uma técnica de desenvolvimento de software que baseia-se em um <a href=#ciclo>ciclo</a> curto de repetições.
 - O TDD transforma a tradicional forma de desenvolvimento que é desenvolver e depois testar, passando  a ser o inverso, primeiramente implementados os testes unitários e depois desenvolvendo a solução proposta. 
 - Os testes unitários são utilizados para facilitar a abstração do projeto, pois segundo Freeman os testes são usados para clarear a ideia em relação ao que se deseja em relação ao código. 
	 - Segundo Kent Beck Apud Freeman, diz que: “finalmente, consegui separar o projeto lógico do físico. Sempre me disseram para fazer isso, mas nunca ninguém tinha explicado como”, o TDD é a forma de se fazer isso. 
 - A criação de testes unitários ou de componentes é o núcleo da concepção do TDD. 
	 - Segundo Presmann, “Os componentes individuais são testados para garantir que operem corretamente. Cada componente é testado independentemente, sem os outros componentes de sistema. Os componentes podem ser entidades simples, tais como funções ou classes de objetos, ou podem ser grupos coerentes dessas entidades”. 

<a id="ciclo"></a>
####**2.1.2 Ciclo de desenvolvimento ** 
- O ciclo baseia-se em 3 passos básicos:
	- Criar o teste;
	- Implementar a solução para passar no teste;
	-  Refatorar o teste e solução para funcionar corretamente.


###<a id="principais-caracteristicas"></a><i class="icon-info"></i> 2.2. Principais características


####2.2.1. Classes do componente
			
>- \InepZend\UnitTest\AbstractUnitTest;
> - \InepZend\UnitTest\AbstractServiceCrudUnitTest;
> \InepZend\UnitTest\AbstractServiceUnitTest;
>- \InepZend\UnitTest\AbstractRouteUnitTest;
>- \InepZend\UnitTest\AbstractCrudUnitTest;
>- \InepZend\UnitTest\AbstractCrudControllerUnitTest;

- Todos as classes do componente do UnitTest do *InepZend* **são abstratas**.

<a id="hierarquia"></a>
####2.2.2. Estrutura hierárquica

> * <a href="#41">AbstractUnitTest</a> 
	* <a title="extend AbstractUnitTest" href="#42">AbstractServiceCrudUnitTest<a/>
		* <a title="extend AbstractServiceCrudUnitTest" href="#43">AbstractServiceUnitTest<a/>
	* <a title="extend AbstractUnitTest" href="#44">AbstractRouteUnitTest</a>
		* <a title="extend AbstractRouteUnitTest" href="#45">AbstractCrudUnitTest</a>
			*  <a title="extend AbstractCrudUnitTest" href="#46">AbstractCrudControllerUnitTest</a>						

>> A classe  abaixo herda a classe acima.

#####2.2.2.1. Classes \InepZend\UnitTest

 <a id="41"></a>
######**2.2.2.1.1. AbstractUnitTest**

> - Classe abstrata responsável pelos métodos básicos para a implementação de qualquer tipo de método de teste unitário. 
	- É a classe núcleo (core) e estende a classe nativa de *TestCase* do PHPUnit.
> - Na <a href="#hierarquia">hierarquia</a>, ela é estendida por todas as classes do componente UnitTest.  
> - Utiliza em seu escopo as Traits *\InepZend\Util\DebugExec* [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Util.DebugExec.html ], *\InepZend\Service\ServiceManagerTrait* [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Service.ServiceManagerTrait.html ]  e InepZend\Util\AttributeStaticTrait [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Util.AttributeStaticTrait.html ].
> - Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.UnitTest.AbstractUnitTest.html ]

<a id="42"></a>
######**2.2.2.1.2. AbstractServiceCrudUnitTest**

> - Classe abstrata responsável pelos métodos específicos para aplicação de testes unitários em métodos de uma classe de serviço.
> - É acionado sempre antes da invocação de um método de teste unitário.
> - Na <a href="#hierarquia">hierarquia</a>, ela estende a classe <a href="#41">*AbstractUnitTest*</a>.
> - Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.UnitTest.AbstractServiceCrudUnitTest.html ]

<a id="43"></a>
######**2.2.2.1.3. AbstractServiceUnitTest**

> - Classe abstrata responsável pelos métodos específicos para aplicação de testes unitários em métodos de uma classe de serviço.
> - Ao criar uma classe de teste de serviço deverá ser herdada preferencialmente esta classe.
> -  Na <a href="#hierarquia">hierarquia</a>, ela estende a classe <a href="#42">*AbstractServiceCrudUnitTest*</a>.
> - Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.UniotTest.AbstractServiceUnitTest.html ]

<a id="44"></a>
######**2.2.2.1.4. AbstractRouteUnitTest**

> - Classe abstrata responsável pelos métodos específicos para aplicação de testes unitários em métodos de uma classe de controller, enviando requisições para rotas/actions e verificando o status das respostas caso seja necessário.
> -  Na <a href="#hierarquia">hierarquia</a>, ela estende a classe <a href="#41">*AbstractUnitTest*</a>.
> - Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.UnitTest.AbstractRouteUnitTest.html ]


<a id="45"></a>
######**2.2.2.1.5. AbstractCrudUnitTest**
> - Classe abstrata responsável pelos métodos específicos para aplicação de testes unitários em métodos de uma classe de controller que herda a <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractCrudController.html" target="_blank">InepZend\Controller\AbstractCrudController</a>, enviando requisições para rotas e verificando o status das respostas caso seja necessário.
> - Nessa classe são mapeados os testes de alguns métodos utilizados nas classes que herdam da <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractCrudController.html" target="_blank">AbstractCrudController</a>, como por exemplo:
	- Index: public function testIndexActionCanBeAccessed() { ... }
	- add: public function testAddActionCanBeAccessed() { ... }
	- edit: public function testEditActionCanBeAccessed() { ... }
> - Na <a href="#hierarquia">hierarquia</a>, ela estende a classe <a href="#44">*AbstractRouteUnitTest*</a>.
> - Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.UnitTest.AbstractCrudUnitTest.html ]


<a id="46"></a>
######**2.2.2.1.6. AbstractCrudControllerUnitTest**
> - Classe abstrata responsável pelos métodos específicos para aplicação de testes unitários em métodos de uma classe de controller que herda a <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractCrudController.html" target="_blank">InepZend\Controller\AbstractCrudController</a>, enviando requisições para rotas e verificando o status das respostas caso seja necessário.
> - Todas as actions das classes <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractCrudController.html" target="_blank">InepZend\Controller\AbstractCrudController</a> e <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractControllerPaginator.html" target="_blank">InepZend\Controller\AbstractControllerPaginator</a> possuem algum teste unitário implementado.
> - Ao criar uma classe de teste de rota deverá ser herdada preferencialmente esta classe.
> - Na <a href="#hierarquia">hierarquia</a>, ela estende a classe <a href="#45">*AbstractCrudUnitTest*</a>.
> - Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.UnitTest.AbstractCrudControllerUnitTest.html ]

___

####<i class="icon-sitemap"></i> 2.2.3. Namespace
> - \InepZend\UnitTest

___

### <i class="icon-book"></i> 2.3. APIDoc/UnitTest

> - APIDoc
>> http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.UnitTest.html

___


<i class="icon-terminal"></i> 3. Como usar
---

###3.1. Estrutura de pastas
- Para a estrutura de pastas, o padrão deverá ser o mesmo do módulo onde o teste será desenvolvido, contendo as pastas da **Controller** e **Service**:

> - <i class="icon-folder-open"></i> SeuModulo
	- <i class="icon-folder"></i> config
	- <i class="icon-folder-open"></i> src
	- <i class="icon-folder-open"></i> SeuModulo
		- <i class="icon-folder-open"></i> Controller
			- <i class="icon-file"></i> **ArquivoController.php**
		- <i class="icon-folder-open"></i> Service
			- <i class="icon-file"></i> **Arquivo.php**
	- <i class="icon-folder-open"></i> test
		- <i class="icon-folder-open"></i> SeuModuloTest
			- <i class="icon-folder-open"></i> Controller
				- <i class="icon-file"></i> **ArquivoControllerTest.php**
			- <i class="icon-folder-open"></i> Service
				- <i class="icon-file"></i> **ArquivoTest.php**
	- <i class="icon-folder"></i> view
	- <i class="icon-file"></i> **Module.php**



<a id="padra-nomenclatura"></a>
###3.2. Padrão de nomenclatura e Asserts (Annotation de teste)
- O padrão de nomenclatura a ser utilizado tanto para os comentários como para os *asserts* podem ser consultados no manual de nomenclatura localizado em: [ http://svn.inep.gov.br/svn/DESENV/INEP/ARQUITETURA_PHP/INEPSKELETON/trunk/Docs/Analise/Manual/Annotation/ ]
- Os *@assert* deverão seguir o padrão descrito acima, pois é passível da geração automática de classes e seus métodos serão a partir das *annotations* declaradas. Abaixo estão os annotations que são utilizadas pelo <a href="#skelgen">**skelgen**</a> para a geração dos arquivos:

> -  case '==': $assertion = 'Equals';
> - case '!=': $assertion = 'NotEquals';
> - case '===': $assertion = 'Same';
> - case '!==': $assertion = 'NotSame';
> - case '>': $assertion = 'GreaterThan';
> - case '>=': $assertion = 'GreaterThanOrEqual';
> - case '<': $assertion = 'LessThan';
> - case '<=': $assertion = 'LessThanOrEqual';
> - case 'throws': $assertion = 'exception';

<a id="padra-nomenclatura-specific"></a>

- Para os casos específicos onde os *@assert* acima não atendam ou para o cenário onde os métodos são protegidos ou privados, deverá ser criada outra classe de teste contendo os métodos específicos com sufixo **Spefic**, como por exemplo *PublicacaoSpecificTest*. 
- Umas das formas mais utilizadas é a verificação se o retorno é uma instância de um Objeto X (assertInstanceOf) ou se existe um Atributo X dentro do Objeto X (assertAttributeContains). Para esse cenário deverá seguir o manual disponibilizado pelo PHPUnit e seus apêndices [ https://phpunit.de/documentation.html. ]

```
* @assert ( 1 !== '1')
```

```
$this->assertNotSame(1, '1');
```

 <a id="skelgen"></a>
###3.3. Skelgen
 
- Skelgen é uma ferramenta de geração de esqueleto do PHPUnit a partir de classes com códigos implementadas utilizando <a href=#padra-nomenclatura>annotation</a>. Também é possível o inverso, gerar classes a partir de classes de teste.
 
####3.3.1 Instalação
- Para a instalação é necessário ter a extensão do PHP *PEAR* instalado, para instalação do pear acesse [ http://pear.php.net/manual/en/installation.php ].

```
pear install phpunit/PHPUnit_SkeletonGenerator
```
- Após a instalação é necessário criar os <a href=#padra-nomenclatura>@asserts</a> para as classes que serão geradas, observando que os <a href=#padra-nomenclatura>@asserts</a> criados na classe de teste são os especificados no item <a href=#padra-nomenclatura>annotation</a>, para os demais casos a implementação da lógica de teste deverá ser criada na própria classe de teste, como por exemplo o *assert* **assertInternalType**, na qual realiza a verificação do tipo primitivo. 
```
$this->assertInternalType('array', array('key' => 'value'));
```
####3.3.2 Gerando as classes de teste

- Após a instalação deveram ser implementados os <a href=#padra-nomenclatura>@asserts</a> nas classes passíveis de teste. 
	> As classes que contenham métodos **privados** e **protegidos** não são passíveis de geração das classes de teste, para esses cenários deveram seguir as informações do item <a href=#padra-nomenclatura-specific>nomenclatura</a> referente a criação de classe com o sufixo **Specific**.

- Exemplo de criação de  <a href=#padra-nomenclatura>@asserts</a> para os teste:

```
    /**
     * Metodo responsavel em verificar se a data passada como parametro esta na 
     * string dd/mm/aaaa.
     *
     * @example \InepZend\Util\Date::isDateTemplate('18/07/2014')
     *
     * @param string $strValue
     * @return boolean
     *
     * @assert ('18/07/2014') === true
     * @assert ('2014-07-18') !== true
     * @assert ('20140718') !== true
     */
    public static function isDateTemplate($strValue)
    {
        return self::isDate($strValue, self::TYPE_DATE_TEMPLATE);
    }
```
-  Com os  <a href=#padra-nomenclatura>@asserts</a> acima o código gerado será:
```
    /**
     * Generated from @assert ('18/07/2014') === true.
     *
     * @covers \InepZend\Util\Date::isDateTemplate
     */
    public function testIsDateTemplate()
    {
        $this->assertSame(
                true
                , \InepZend\Util\Date::isDateTemplate('18/07/2014')
        );
    }

    /**
     * Generated from @assert ('2014-07-18') !== true.
     *
     * @covers \InepZend\Util\Date::isDateTemplate
     */
    public function testIsDateTemplate2()
    {
        $this->assertNotSame(
                true
                , \InepZend\Util\Date::isDateTemplate('2014-07-18')
        );
    }

    /**
     * Generated from @assert ('20140718') !== true.
     *
     * @covers \InepZend\Util\Date::isDateTemplate
     */
    public function testIsDateTemplate3()
    {
        $this->assertNotSame(
                true
                , \InepZend\Util\Date::isDateTemplate('20140718')
        );
    }
```
- O comando para gerar deverá ser executado via linha de comando, visto que os testes unitários seguem o padrão <a href="http://pt.wikipedia.org/wiki/Interpretador_de_comandos" target="_blank">CLI</a> e não <a href="http://pt.wikipedia.org/wiki/Interface_gr%C3%A1fica_do_utilizador" target="_blank">GUI</a>.

- Exemplo de Comando no Linux:
```
phpunitskelgen generate-test --bootstrap="/Path/To/Bootstrap.php" "InepZend\Util\ArrayCollection" "/srv/www/htdocs/skeleton/Fontes/vendor/InepZend/library/InepZend/Util/ArrayCollection" "InepZend\Util\ArrayCollection" "UtilTest/ArrayCollectionTest.php"
```
- Comando no Windows:
```
phpunit-skelgen generate-test --bootstrap="C:\Path\To\Bootstrap.php" "InepZend\Util\PhpIni" "C:\Program Files (x86)\Zend\Apache2\htdocs\Novo SVN\INEP\ARQUITETURA_PHP\INEPSKELETON\trunk\Fontes\vendor\InepZend\library\InepZend\Util\PhpIni" "InepZend\Util\PhpIniTest" "PhpIniTest.php"
```
- Os comandos acima seguem a seguinte estrutura:
> **[COMANDO] **
**[BOOTSTRAP] **
**[PATH_DA_CLASSE_SEM_EXTENSAO] **
**[NAMESPACE_DA_CLASSE] **
> **[NOME_DA_CLASSE_DE_TESTE]**

#####3.3.2.1 Gerando as classes de teste a partir do InepZend
- O Skelgen encontra-se mapeado dentro do InepZend, bastando somente referenciar o arquivo, no caso a extensão .sh para o Linux e a extensão .bat para o Windows, localizado em: 
> Windows: path_windows/vendor/bin/**phpunit-skelgen.bat**
> Linux: path_linux/vendor/bin/**phpunit-skelgen.sh**

###3.4. Realizando os testes com o phpunit

####3.4.1 Instalação
- Os testes são executados com o PHPUnit, para a instalação do mesmo acesse [ https://phpunit.de/manual/current/en/installation.html ] e realize a instalação conforme o sistema operacional que esteja utilizando na estação de trabalho. 
```
# Comando para instalar no Linux
$ wget https://phar.phpunit.de/phpunit.phar
$ chmod +x phpunit.phar
$ sudo mv phpunit.phar /usr/local/bin/phpunit
```
####3.4.2 Configurações XML
- Após a geração ou implementação das classes de teste é necessário mapear o arquivo XML no diretório test do módulo.
> - <i class="icon-folder-open"></i> SeuModulo
	- <i class="icon-folder"></i> config
	- <i class="icon-folder-open"></i> src
		- <i class="icon-folder-open"></i> SeuModulo
	- <i class="icon-folder-open"></i> test
		- <i class="icon-folder-open"></i> SeuModuloTest
			- <i class="icon-folder"></i> Controller				
			- <i class="icon-folder"></i> Service
			- <i class="icon-file"></i> **phpunit.xml**
	- <i class="icon-folder"></i> view
	- <i class="icon-file"></i> **Module.php**

- No arquivo XML são definidos as *directivas* necessárias para o teste, segue o modelo:
```
<?xml version="1.0" encoding="UTF-8"?>

<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="http://phpunit.de/phpunit.xsd"
         bootstrap="../../../vendor/InepZend/library/InepZend/UnitTest/Bootstrap.php"
         backupGlobals="false"
         verbose="true">
    <testsuites>
        <testsuite name="PHPUnit">
            <directory>./</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

####3.4.3 Execução do comando phpunit
- Para executar os testes unitários é necessário acessar o diretório onde foi realizado o mapeamento do arquivo XML e executando o seguinte comando:
```
$ phpunit
```
- Assim como foi realizado o mapeamento do <a href=#skelgen>Skelgen</a> também foi mapeado no InepZend o PHPUnit, bastando executar referenciando os seus respectivos arquivos conforme o sistema operacional:

> Windows: path_windows/vendor/bin/**phpunit.bat**
> Linux: path_linux/vendor/bin/**phpunit.sh**

- O resultado após a execução será semelhante ao código abaixo:
> PHPUnit 4.2-dev by Sebastian Bergmann.
> 
Configuration read from /path/to/test/phpunit.xml

................................................................. 65 / 68 ( 95%)
....

> Time: 5.68 seconds, Memory: 76.50Mb

> OK (68 tests, 66 assertions)

####3.4.4 Código exemplo de teste de uma service
```
<?php

# Definicao do namespace

namespace Publicacao\Service;

# Mapeamento das classes que serao utilizadas

use InepZend\UnitTest\AbstractServiceCrudUnitTest;
use InepZend\Util\FileSystem;
use InepZend\Upload\UploadFile;

# Toda classe de servico devera herdar da 'AbstractServiceUnitTest'

class ArquivoTest extends AbstractServiceUnitTest
{
    # Definicao dos atributos a serem utilizados

    private static $intIdArquivo;

    # Definicao das constantes a serem utilizadas no teste

    const PATH_DIR = __DIR__;
    const PATH_UPLOAD_DEFINITIVE = self::PATH_DIR;
    const PATH_UPLOAD_TMP = self::PATH_UPLOAD_DEFINITIVE;
    const FILE_NAME = 'testFile.img';
    const ID_ARQUIVO_TESTE = 999;
    const LIMIT = 1;

    /**
     * Toda classe de teste tem que reescrever o metodo setUp passando como parametro
     * do construtor o servico a ser testado.
     * Na classe pai, AbstractServiceCrudUnitTest, foram mapeados os principais
     * metodos de set e get como o retorno do Service Manager.
     */
    protected function setUp()
    {
        # Passando o nome do servico a ser testado.
        parent::setUp();

        # Implementado toda a logica que sera feita a cada iteracao.
        if (is_null(self::$intIdArquivo))
            $this->setIdArquivo($this->getEntityArquivo()->getIdArquivo());

        # Cria o Entity Manager
        self::getServiceInstance()->createEntityManager();
    }

    /**
     * Toda classe de teste tem que verificar se o retorno eh realmente a classe
     * que sera testada, utilizando o metodo 'assertInstanceOf'.
     */
    public function testInstanceObject()
    {
        $this->assertInstanceOf('Publicacao\Service\Arquivo', self::getServiceInstance());
    }

    /**
     * Ao criar um teste eh necessario trabalhar com dados reais, sendo assim
     * devera ser criado um metodo que retorne uma entidade que possa ser utilizada
     * no teste.
     * 
     * @return object
     */
    private function getEntityArquivo()
    {
        return reset($this->getServiceManager()->get('Publicacao\Service\Arquivo')->getService('Publicacao\Service\Arquivo')->findBy(array(), array('id_arquivo' => 'ASC'), 1));
    }

    /**
     * Ao criar um teste eh necessario criar uma entidade a ser utilizada pelo
     * teste.
     * 
     * @return mix
     */
    private function getDataArquivoToArray($booObject = false, $intIdArquivo = self::ID_ARQUIVO_TESTE)
    {
        $strEntity = self::getServiceInstance()->getEntityName();
        $arquivo = (new $strEntity())
                ->setIdArquivo($intIdArquivo)
                ->setPublicacao($this->getEntityArquivo()->getPublicacao())
                ->setNoArquivo('no_arquivo_test')
                ->setDsCaminhoArquivo('./data')
                ->setTpArquivo('./data')
                ->setDtInclusao(date('d/m/Y'));
        if ($booObject)
            return $arquivo->toArray();
        return $arquivo;
    }

    private function setIdArquivo($intIdArquivo = null)
    {
        return (self::$intIdArquivo = $intIdArquivo);
    }

}
```

####3.4.5 Código exemplo de teste de uma rota (controller)
```
<?php
# Definicao do namespace
namespace Publicacao\Controller;

# Mapeamento das classes que serao utilizadas
use InepZend\UnitTest\AbstractCrudControllerUnitTest;
use Publicacao\Entity\Publicacao;

# Toda classe de controller devera herdar da 'AbstractCrudControllerUnitTest'
class PublicacaoControllerTest extends AbstractCrudControllerUnitTest
{

    # Definicao de atributos e constantes que serao necessarias no teste
    const LIMIT = 1;
    const ID_PUBLICACAO_TESTE = 999;
    const FORM_METHOD = 'POST';

    /**
     * Ao realizar o teste de rota, o desenvolvedor poderar realizar de duas formas,
     * sendo essas via '__construct()', para cenarios simples, ou especifica caso
     * haja a necessidade de uma validacao na passagem dos parametros.
     */
    public function __construct()
    {
        # No construtor devera setar os dados de acesso para a autenticacao.
        $this->setLogin('11122233378');
        $this->setPassword('**********');
        
        /**
     * No metodo __construct() da classe de teste faz a chamada ao metodo pai onde 
     * o mesmo realizando a chamada do metodo 'createAllDataProvider' no qual deve 
     * ser implementado em todas as classes de teste.
     */
        parent::__construct();
    }

   /**
    * Nas classes de teste de rota deverar ser implementado o metodo abstrato 'createAllDataProvider'
    * contido na classe pai 'AbstractRouteUnitTest', caso o mesmo nao seja implementado irar gerar
    * erro.
    * Segue abaixo um modelo de implementacao do metodo 'createAllDataProvider' que realiza o teste
    * de rota da classe 'PublicacaoController'.
    */
    protected function createAllDataProvider()
    {
        return array(
            # A chave 'add' eh o nome da action a ser testada e os arrays serao os cenarios a serem testados.
            'add' => array(
                /**
         * No array devera passar no primeiro parametro os dados a serem persistidos, 
         * no segundo o tipo de envio, POST ou GET e
         * no terceiro o parametro informando se eh pra ser realizado a autenticacao true ou false
         */
                array($this->getPublicacaoToArray(self::ID_PUBLICACAO_TESTE), self::FORM_METHOD, true),
                # Nos arrays subsequentes serao os testes para os cenarios passiveis de teste
                array(),
            ),
            'ajaxPaginator' => array(
                array(array('page' => 1, 'rp' => 20, 'sortname' => 'id_publicacao', 'sortorder' => 'desc', 'query' => '', 'qtype' => '')),
            ),
            'ajaxFilter' => array(
                array(array('tp_situacao_publicacao' => Publicacao::CONST_TP_SITUACAO_PUBLICACAO_TODAS), self::FORM_METHOD),
            ),
            'ajaxInactivate' => array(
                array(array('id_publicacao' => $this->getEntityPublicacao()->getIdPublicacao()), self::FORM_METHOD),
            ),
            'ajaxShowPreview' => array(
                array($this->getPublicacaoToArray($this->getEntityPublicacao()->getIdPublicacao()), self::FORM_METHOD),
            ),
        ));
    }

    /**
     * Para os cenarios especificos, ou seja, que necessitam algum tipo de validacao
     * os mesmos deveram ser criados conforme segue abaixo.
     */
    public function testEdit()
    {
        $publicacao = $this->getEntityPublicacao();
        $arrPublicacao = $this->getPublicacaoToArray($publicacao->getIdPublicacao());
        $this->checkActionCanBeAccessed($this->getControllerName(), 'edit', array('id_publicacao' => $publicacao->getIdPublicacao()), $arrPublicacao, true);
    }

    /**
     * Os dados (entidades) a serem utilizados nao poderam ser valores fixos, devendo
     * esses atribuidos a um atributo e/ou sendo chamado em um metodo.
     */
    private function getEntityPublicacao()
    {
        return reset($this->getService('Publicacao\Service\Publicacao')->findBy(array(), array('id_publicacao' => 'ASC'), self::LIMIT));
    }

    /**
     * Os dados referente a formularios e entidades deveram possuir metodos especializados
     * contendo as informacoes pertinentes ao cenario que sera testado.
     */
    private function getPublicacaoToArray($intIdPublicacao = self::ID_PUBLICACAO_TESTE, $booReturnObject = false)
    {
        $publicacao = $this->getEntityPublicacao();
        $publicacaoNew = (new Publicacao())
                ->setIdPublicacao($intIdPublicacao)
                ->setSubcategoria($publicacao->getSubcategoria())
                ->setIdUsuarioInclusao($publicacao->getIdUsuarioInclusao())
                ->setNoPublicacao($publicacao->getNoPublicacao())
                ->setNoAutorPublicacao($publicacao->getNoAutorPublicacao())
                ->setNuVolumePublicacao($publicacao->getNuVolumePublicacao())
                ->setNuAnoPublicacao($publicacao->getNuAnoPublicacao())
                ->setDsSinopsePublicacao($publicacao->getDsSinopsePublicacao())
                ->setInDestaquePublicacao($publicacao->getInDestaquePublicacao())
                ->setNuPublicacao($publicacao->getNuPublicacao())
                ->setDtPublicacao($publicacao->getDtPublicacao())
                ->setTpSituacaoPublicacao($publicacao->getTpSituacaoPublicacao())
                ->setPalavrasChave($publicacao->getPalavrasChave())
                ->setArquivos($publicacao->getArquivos())
                ->setInEnviada($publicacao->getInEnviada());
        if ($booReturnObject)
            return $publicacaoNew;
        return $publicacaoNew->toArray();
    }

}
```
<a id="referencia"></a> <i class="icon-unlink"></i> 4. Referência 
---

> http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.UnitTest.html
> https://phpunit.de/manual/3.7/en/skeleton-generator.html
> https://phpunit.de/manual/current/en/installation.html