**<i class="icon-folder-open"></i> Service**
===

1. Índice
---
[TOC]

<i class="icon-th"></i> 2. Definição
---


___

###<i class="icon-pencil"></i> 2.1. Conceito

> *Service* é uma biblioteca disponibilizada no **InepZend** na qual contém classe e trait que facilitam o desenvolvimento de funcionalidades, podendo ser utilizadas em camadas onde sejam necessárias a suas utilizações.
> 
> Visando a facilidade do uso da biblioteca, a mesma foi desenvolvida aplicando o conceito de Trait [http://br1.php.net/trait ].

<a id="definicao-service"></a>
####**2.1.1 Service (Service Layer)** 

 - Camada de Serviço é um padrão de projeto aplicado dentro do <a href="http://serviceorientation.com/serviceorientation/the_service_orientation_design_paradigm" target="_blank">paradigma *service-orientation</a>*, que tem como objetivo organizar os serviços utilizados pela aplicação. 
 - Dentro do modelo arquitetural ***<a href="http://en.wikipedia.org/wiki/Hierarchical_model%E2%80%93view%E2%80%93controller" target="_blank">HMVC</a>***, a *Service* é implementada na camada de *Modelo*.
 - Uma das principais responsabilidades é a transação de dados entre a *controller* e a *repository*, mas não se limita somente a esse escopo, pois uma Service pode ser chamada por outra Service ou mesmo dentro de um Form ou uma Navigation.
> **Obs.:** As regras de negócio devem ser implementadas na camada de serviço, onde a controladora envia os dados, a service as valida e envia para o modelo persistir na base de dados caso seja necessário.

####**2.1.2 Service Locator e Service Manager ** 
- O ServiceLocator é uma *interface*. 
- O ZF2 foi desenvolvido com *design* por contrato, o que significa que se pode confiar em interfaces ao invés vez de classes. Nesse cenário, o ServiceManager é uma implementação padrão do ServiceLocator.
- O ServiceManager é basicamente a implementação da interface ServiceLocator. 
- Quando é solicitado o *getServiceManager()*, seu retorno é a explícita implementação ServiceManager. 
- Quando é solicitado o  *getServiceLocator()*, está solicitando qualquer implementação de interface do ServiceLocator que pode ser a implementação pelo ServiceManager ou a sua própria. 

> **Obs.:** O retorno de ambos é o mesmo objeto.


###<a id="principais-caracteristicas"></a><i class="icon-info"></i> 2.2. Principais características


####2.2.1. Classes do componente
			
>- \InepZend\Service\AbstractServiceCore; 
-  \InepZend\Service\AbstractServiceCoreCache;
-  \InepZend\Service\AbstractServiceManager;
-  \InepZend\Service\AbstractServiceRepository;
-  \InepZend\Service\AbstractService;
-  \InepZend\Service\AbstractServiceControlCache;
-  \InepZend\Service\AbstractServiceCache;
-  \InepZend\Service\AbstractServiceFile;

- Todos as classes do componente da Service do *InepZend* **são abstratas**.

<a id="hierarquia"></a>
####2.2.2. Estrutura hierárquica

> * <a href="#41">AbstractServiceCore</a> 
	 * <a title="extend AbstractServiceCore" href="#42">AbstractServiceCoreCache<a/>
		 * <a title="extend AbstractServiceCoreCache" href="#43">AbstractServiceManager</a>
			 * <a title="extend AbstractServiceManager" href="#44">AbstractServiceRepository</a>
				 * <a title="extend AbstractServiceRepository" href="#45">AbstractService</a>
					 * <a title="extend AbstractService" href="#46">AbstractServiceControlCache</a>
						 * <a title="extend AbstractServiceControlCache" href="#47">AbstractServiceCache</a>
						 * <a title="extend AbstractServiceControlCache" href="#48">AbstractServiceFile</a>

>> A classe  abaixo herda a classe acima.
>> Sendo assim, a classe *AbstractServiceCore* é a classe de primeiro nível, e a classe *AbstractServiceCoreCache* herda/estende a *AbstractServiceCore*.



#####2.2.2.1. Classes \InepZend\Service

 <a id="41"></a>
######**2.2.2.1.1. AbstractServiceCore**

> - Classe abstrata responsável pelos métodos considerados essenciais aos serviços.

> - Na <a href="#hierarquia">hierarquia</a>, ela é estendida por todas as classes do componente Service.
  
> - Utiliza em seu escopo a Trait *\InepZend\Util\DebugExec*: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Util.DebugExec.html ]
  
> - Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Service.AbstractServiceCore.html ]

<a id="42"></a>
######**2.2.2.1.2. AbstractServiceCoreCache**

> - Classe abstrata responsável pelos métodos considerados essenciais aos serviços que utilizam algum tipo de cache, como por exemplo o *<a href="http://memcached.org/" target="_blank">memcache</a>*.

> - Na <a href="#hierarquia">hierarquia</a>, ela estende a classe <a href="#41">*AbstractServiceCore*</a>.

> - Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Service.AbstractServiceCoreCache.html ]

<a id="43"></a>
######**2.2.2.1.3. AbstractServiceManager**

> - Classe abstrata responsável pelos métodos invocadores do *<a href="#definicao-service">ServiceManager</a>*, sobretudo para acionar outros serviços.

> - Em seu escopo a classe utiliza as traits *ServiceManagerTrait* e *LogCall*.
>> - A Trait **ServiceManagerTrait** é responsável em manipular o <a href="#definicao-service">*ServiceManager*</a>. A trait pode ser utilizada onde seja necessário a manipulação do ServiceManager, como por exemplo *Navigation*.
>>     - http://desenvphp.inep.gov.br/apidoc/class-InepZend.Service.ServiceManagerTrait.html
>> - A Trait *LogCall* é responsável em manipular o método mágico <a href="http://php.net/manual/pt_BR/language.oop5.overloading.php#object.call" target="_blank">__call()</a>.
>>     - http://desenvphp.inep.gov.br/apidoc/class-InepZend.Log.LogCall.html

> - Ao estender a classe *AbstractServiceManager* os métodos da trait *ServiceManagerTrait* ficam disponíveis.
> - Na <a href="#hierarquia">hierarquia</a>, ela estende a classe <a href="#42">*AbstractServiceCoreCache*</a>.

> - Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Service.AbstractServiceManager.html ]


<a id="44"></a>
######**2.2.2.1.4. AbstractServiceRepository**

> - Classe abstrata responsável pelos métodos invocadores do *Repository*, incluindo o <a href="#definicao-service">*EntityManager*</a>, para acionar interações com o banco de dados.

> - Ao estender a classe *AbstractServiceRepository* ficam disponíveis os principais métodos utilizados no desenvolvimento do dia a dia como:
>> - find()
>> - findBy()
>> - insert()
>> - update()
>> - delete()
>> - deleteBy()
>> - fetchPairs()
>> - fetchPairsToXmlJson()
>> - findByPaged() e **outros**
 
> - Na <a href="#hierarquia">hierarquia</a>, ela estende a classe <a href="#43">*AbstractServiceManager*</a>.

> - Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Service.AbstractServiceRepository.html ]


<a id="45"></a>
######**2.2.2.1.5. AbstractService**

> - Classe abstrata responsável pelos métodos básicos para a implementação de um CRUD.

> - Apesar da classe não ter em seu escopo métodos implementados, ela herda a <a href="#44">*AbstractServiceRepository*</a>.

> - A **AbstractService** foi a primeira classe a ser implementada no componente Service do InepZend. Ao surgirem necessidades específicas foi necessário criar as demais classes no componente.

> - Na <a href="#hierarquia">hierarquia</a>, ela estende a classe *<a href="#44">AbstractServiceRepository</a>*.

> - Os métodos herdados podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Service.AbstractService.html ]

<a id="46"></a>
######**2.2.2.1.6. AbstractServiceControlCache**

> - Classe abstrata responsável pelos métodos controladores do uso de cache, como por exemplo <a href="http://memcached.org/" target="_blank">memcache</a>, nos resultados dos demais métodos da classe.

> - A principal característica da classe é a manipulação de cache, pois ao utiliza-lo há um ganho de desempenho na aplicação. Como exemplificação é o cacheamento de resultado de banco de dados ficando disponível sem ser necessário realizar nova busca na base de dados.

>> - Ao executar um método que faz uma pesquisa no banco de dados é possível através da *annotation*  **"@cache"** com parâmetro **"true, 1, sim ou yes** cachear os dados da filtragem.

Exemplo da utilização ***@cache true***:
```
/**
 * @cache true
 */
 protected function findBySubcategoriaAnnotationCache($intCoSubcategoria = null)
    {
        return $this->findBy(array('co_subcategoria' => $intCoSubcategoria));
    }
```

>> - Ao ser executado novamente o mesmo método, não alterando a assinatura do método e os parâmetros passados, a aplicação vai no cache e retorna o valor armazenado, assim evita um consumo de rede e banco gerando performance.

> - Na <a href="#hierarquia">hierarquia</a>, ela estende a classe <a href="#45">*AbstractService*</a>.

> - Os métodos herdados podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Service.AbstractServiceControlCache.html ]

<a id="47"></a>
######**2.2.2.1.7. AbstractServiceCache**

> - Classe abstrata responsável pelos métodos invocadores do *Repository*, incluindo o *<a href="#<a href="#definicao-service">EntityManager</a>*, para acionar interações com o banco de dados com uso controlado de cache, como por exemplo o <a href="http://memcached.org/" target="_blank">memcache</a>, nos seus resultados.

> - Todos os metodos são manipulações no cache. 

> - Caso a chamada do método não esteja cacheado, o mesmo será cacheado e ficara disponível para uma outra chamada, evitando assim o custo da utilização do banco de dados.

> - Apesar da nomenclatura dos métodos serem semelhantes a *<a href="#44">AbstractServiceRepository</a>*, os métodos fazem a execução dos métodos contidos na *AbstractServiceRepository* e os cacheia, e de forma transparente são executados os métodos da *<a href="#46">AbstractServiceControlCache</a>*, como por exemplo o método *controlCache()* que é responsável em inserir os dados, método e resultado no cache.

> - Na <a href="#hierarquia">hierarquia</a>, ela estende a classe <a href="#46">*AbstractServiceControlCache*</a>.

> - Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Service.AbstractServiceCache.html ]

<a id="48"></a>
######**2.2.2.1.8. AbstractServiceFile**

> - Classe abstrata responsável pelos métodos invocadores do *Repository*, incluindo  o *EntityManager*, para acionar interações com o banco de dados persistido internamente em arquivos de sistema (**FileSystem**).

> - A classe segue a mesma implementação do item anterior *<a href="#47">AbstractServiceCache</a>*, a diferença principal é que ao invés de manipular um banco de dados, como por exemplo Oracle, a manipulação é em arquivos.

> - Na <a href="#hierarquia">hierarquia</a>, ela estende a classe <a href="#46">*AbstractServiceControlCache*</a>.

> - Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Service.AbstractServiceFile.html]


___

####<i class="icon-sitemap"></i> 2.2.3. Namespace
> - \InepZend\Service

___

### <i class="icon-book"></i> 2.3. APIDoc/UnitTest

> - APIDoc
>> http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.Service.html

> - UnitTest
>> - Diretório no InepZend: /vendor/InepZend/module/UnitTest/test/UnitTest/Service/.
>> - http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.Module.UnitTest.Service.html


___


<i class="icon-terminal"></i> 3. Como usar
---

###3.1. Registrando uma Service - Module.php
- É necessário observar que no item um, <a href="#definicao-service">Conceito de Service</a>, a mesma deve conter as regras de negócio especializadas no contexto do desenvolvimento. Nesse sentido o exemplo a seguir o contexto adotado será o serviço responsável pela manipulação da entidade Pessoa.

- Toda Service precisa ser mapeada no projeto, e o mapeamento é realizado no arquivo **Module.php** contido na raiz do módulo.
> - <i class="icon-folder-open"></i> SeuModulo
		- <i class="icon-folder"></i> config
		- <i class="icon-folder"></i> src
		- <i class="icon-folder"></i> test
		- <i class="icon-folder"></i> view
		- <i class="icon-file"></i> **Module.php**

- Mapeando o seu serviço:
> Ao desenvolver o serviço na qual será realizado manipulação com a base de dados deverá ser estendido as classes a partir da *<a href="#44">\InepZend\Service\AbstractServiceRepository()</a>*, respeitando a <a href="#hierarquia">hierarquia</a> do componente. Nesse cenário deverá passar como parâmetro a *entityManager*.
> 
>  Caso no contexto da <a href="#criando-o-servico">criação da service</a> não haja manipulação de banco de dados, não é necessário passar como parâmetro a *entityManager*.

```
# Quando ha manipulacao de dados.
return new Pessoa($this->getEntityManager($serviceManager));
```

```
# Quando nao ha manipulacao de dados.
return new Pessoa();
```

```
namespace Pessoa;

# Eh necessario extender ModuleConfig.
use InepZend\ModuleConfig\ModuleConfig;
use SeuModulo\Service\Pessoa;

class Module extends ModuleConfig
{
	public function getServiceConfig()
	{
		return array(
            'factories' => array(
                'SeuModulo\Service\Pessoa' => function($serviceManager) {
                    return new Pessoa($this->getEntityManager($serviceManager));
                },
                )
        );
	}
}
```

<a id="criando-o-servico"></a>
###3.2. Criando uma Service
- O arquivo service deverá ser criado dentro do diretório Service: 

	> - <i class="icon-folder-open"></i> SeuModulo
		- <i class="icon-folder-open"> src
			- <i class="icon-folder-open"> SeuModulo
				- <i class="icon-folder-open"> Service
					- <i class="icon-file"> ServiceName.php
 
 	 - Toda classe Service de um módulo deve estender alguma classe abstrata do componente **Service**, na qual será explicada com maiores detalhes no item **<a href="#principais-caracteristicas">Principais Características</a>**.

		> **Obs.:** As classes do componente Service contém métodos como **insert(), update(), delete(), findBy(), deleteBy(), fetchPairs(), findByPaged(), begin(), commit(), rollback(), getIdentity(), getService()** e outros que realizam a manipulação de dados e objetos, não sendo necessário criar novamente esses métodos, a não ser que seja necessário realizar uma reescrita, polimorfismo, do método.
 	
 	 - Todo método de uma classe de serviço deve possuir a visibilidade **protected** para que o **InepZend** audite automaticamente em arquivo de logs, exceto o método mágico <a href="http://php.net/manual/pt_BR/language.oop5.decon.php" target="_blank">*__construct()*</a>.

```	
namespace SeuModulo\Service;

use InepZend\Service\AbstractService;

class Pessoa extends AbstractService
{
	public function __construct($entityManager = null)
    {
	    # Passagem da Entity Manager via contrutor
        parent::__construct($entityManager, __CLASS__);
        # Definindo a(s) PK da entidade
        $this->arrPk = array('id_pessoa');
    }

	# Visibilidade protegida
	protected function seuMetodo($parametros)
	{
		# Suas regras
	}
}
```
 
###3.3. Consumindo um serviço
 
- A partir de uma Controller,  Service, Helper, Form, Navigation ou qualquer outra classe que seja necessário a utilização da trait *InepZend\Service\ServiceManagerTrait*, pode-se utilizar as seguintes formas de chamadas:

```
# Passando o nome do nameSpace como parametro.
$this->getService('SeuModulo\Service\Pessoa')->method();
```

```
 # Via nameSpace da Controller, para maiores detalhes consultar o _README.md do componente Controller.
 # ESPECIFICO para classes de Controller
$this->getService()->method();
```

###3.4. Exemplo de código - *annotation @example*

- Os exemplos da utilização de cada método estão contidos em seus comentários após a *annotation* **@example**:
>http://desenvphp.inep.gov.br/apidoc/class-InepZend.Service.AbstractServiceControlCache.html


<a id="referencia"></a> <i class="icon-unlink"></i> 4. Referência 
---

> http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.Service.html
