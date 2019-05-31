
**<i class="icon-folder-open"></i> Controller**
===

1. Índice
---
[TOC]

<i class="icon-th"></i> 2. Definição:
---

###<i class="icon-pencil"></i> 2.1. Conceito

> *Controller* é uma biblioteca disponibilizada no **InepZend** na qual contém classe e trait que facilitam o desenvolvimento de funcionalidades, podendo ser utilizadas em camadas onde sejam necessárias a suas utilizações.
> 
> Visando a facilidade do uso da biblioteca, a mesma foi desenvolvida aplicando o conceito de Trait [http://br1.php.net/trait ].

- Controller é a camada responsável em realizar a comunicação entre as camadas View e Model.

- No InepZend, assim como no ZF2, é utilizado o padrão HMVC na qual o Controller não é responsável em implementar as regras de negócio, ficando essa responsabilidade para a camada da *Service*[^service].

- Por não haver regra de negócio, alguns tratamentos de entrada de dados podem ser realizadas nela, como por exemplo a verificação de requisições oriundas de POST ou GET.

- Toda <a href="http://framework.zend.com/manual/2.0/en/modules/zend.view.quick-start.html" target="_blank">Action</a> de uma Controller deve estar mapeada em uma ou mais rotas.

- Basicamente uma action, ao ser invocada por uma rota, possui algumas operações padrões como:

	- Manipula dados de uma requisição.
	- Invoca métodos de classes da camada Model (Service e Form), passando os dados da requisição caso seja necessário.
	- Manipula o resultado da invocação dos métodos de classes da camada Model.
	- Envia os dados para a View como mensagens amigáveis ou informações a serem manipuladas pelo usuário.

- As classes de Controller devem ser implementadas dentro do diretório Controller, conforme abaixo:
	> - <i class="icon-folder-open"></i> SeuModulo
	- <i class="icon-folder"></i> config
	-  <i class="icon-folder-open"></i> src
		- <i class="icon-folder-open"></i> SeuModulo
			- <i class="icon-folder-open"></i> Controller
				- <i class="icon-file"></i> **ArquivoController.php**
	-  <i class="icon-folder"></i> test
	- <i class="icon-folder"></i> view	


			
___
<a id="principais-caracteristicas"></a>
###<i class="icon-info"></i> 2.2. Principais características:

#### 2.2.1. Classes do componente
			
>- \InepZend\Controller\AbstractControllerCore; 
-  \InepZend\Controller\AbstractControllerServiceManager;
-  \InepZend\Controller\AbstractControllerRepository;
-  \InepZend\Controller\AbstractController;
-  \InepZend\Controller\AbstractControllerPaginator;
-  \InepZend\Controller\AbstractCrudController;
-  \InepZend\Controller\AbstractRestfulController;

- Todos as classes do componente da Controller do *InepZend* **são abstratas**

<a id="hierarquia"></a>
#### 2.2.2. Estrutura hierárquica

>  - <a href="#41">AbstractControllerCore</a>
	 * <a title="extend AbstractControllerCore" href="#42">AbstractControllerServiceManager</a>
		 * <a title="extend AbstractControllerServiceManager" href="#43">AbstractControllerRepository</a>
			 * <a title="extend AbstractControllerRepository" href="#44">AbstractController</a>
				 * <a title="extend AbstractController" href="#45">AbstractControllerPaginator</a>
				 * <a title="extend AbstractController" href="#46">AbstractCrudController</a>
 * <a href="#47">AbstractRestfulController</a>

>> A classe  abaixo herda a classe acima.
>> Sendo assim, a classe *AbstractControllerCore* é a classe de primeiro nível, e a classe *AbstractControllerServiceManager* herda/estende a *AbstractControllerCore*.



##### 2.2.2.1. O uso das classes \InepZend\Controller:

<a id="41"></a>
###### 2.2.2.1.1 **AbstractControllerCore **

> - Classe abstrata responsável pelos métodos considerados essenciais aos controllers.
- A classe **AbstractControllerCore** tem em seu escopo o mapeamento a trait ControllerCoreTrait.
   - **<a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.ControllerCoreTrait.html">ControllerCoreTrait</a>**:  
		- Responsável pelos métodos que tratam os dados das requisição POST que foram submetidas de um formulário.
		- Os valores do formulário são tratados e preparados para serem utilizados, como por exemplo a remoção de mascaras.
		- No escopo da **ControllerCoreTrait** utiliza as traits: 
			- <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.View.RenderTemplate.html" target="_blank">RenderTemplate</a>
			- <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Http.RequestTrait.html" target="_blank">RequestTrait</a>
			- <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Session.SessionTrait.html" target="_blank">SessionTrait</a>
			- <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Log.LogTrace.html" target="_blank">LogTrace.</a>
- Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractControllerCore.html ]

 <a id="42"></a>
###### 2.2.2.1.2 **AbstractControllerServiceManager **

> - Classe abstrata responsável pelos métodos invocadores do *ServiceManager*[^service], sobretudo para acionar serviços.
- Na <a href="#hierarquia">hierarquia</a>, a **AbstractControllerServiceManager** herda da <a href="#41">AbstractControllerCore</a>.
- A classe **AbstractControllerServiceManager** tem em seu escopo o mapeamento trait ControllerServiceManagerTrait. 
	- <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractControllerServiceManager.html" target="_blank">**ControllerServiceManagerTrait**</a>:
		- Responsável em retornar os dados do serviço a ser consumido.
- Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractControllerServiceManager.html ]

<a id="43"></a>
###### 2.2.2.1.3 **AbstractControllerRepository **

> - Classe abstrata responsável pelos métodos relacionado ao Repository, incluindo o EntityManager[^service], para acionar interações com o banco de dados.
- Na <a href="#hierarquia">hierarquia</a>, a **AbstractControllerRepository** herda da <a href="#42">AbstractControllerServiceManager</a>.
- Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractControllerRepository.html ]

<a id="44"></a>
###### 2.2.2.1.4  **AbstractController **

> - Classe abstrata responsável pelos métodos básicos para um CRUD sem paginação.
- Na <a href="#hierarquia">hierarquia</a>, a **AbstractController** herda da <a href="#43">AbstractControllerRepository</a>.
- Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractController.html ]

<a id="45"></a>
###### 2.2.2.1.5 **AbstractControllerPaginator **

> - Classe abstrata responsável pelos métodos relacionados a paginação.
- Na <a href="#hierarquia">hierarquia</a>, a **AbstractControllerPaginator** herda da <a href="#44">AbstractController</a>.
- Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractControllerPaginator.html ]

<a id="46"></a>
###### 2.2.2.1.6  **AbstractCrudController **

> - A *AbstractCrudController* é a classe principal a ser utilizada do componente ao desenvolver um CRUD completo e com paginação, pois contém métodos os básicos para o mesmo.
- Na <a href="#hierarquia">hierarquia</a>, a **AbstractCrudController** herda da <a href="#45">AbstractControllerPaginator</a>.
- Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractCrudController.html ]



<a id="47"></a>
###### 2.2.2.1.7 **AbstractRestfulController **

> - Classe abstrata responsável pelas Actions utilizadas em <a href="http://pt.wikipedia.org/wiki/Web_service" target="_blank">Webservices</a> <a href="http://pt.wikipedia.org/wiki/RESTful" target="_blank">Restful</a>.
- A classe **AbstractRestfulController** tem em seu escopo o mapeamento das traits ControllerServiceManagerTrait e ControllerCoreTrait. 
- A classe AbstractRestfulController herda diretamente da <a href="http://framework.zend.com/apidoc/2.1/classes/Zend.Mvc.Controller.AbstractRestfulController.html" target="_blank">AbstractRestfulController</a> da ZF2.
	- <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractControllerServiceManager.html" target="_blank">**ControllerServiceManagerTrait**</a>:
		- Responsável em retornar os dados do serviço a ser consumido.
 - **<a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.ControllerCoreTrait.html">ControllerCoreTrait</a>**:  
		- Responsável pelos métodos que tratam os dados das requisição POST que foram submetidas de um formulário.
		- Os valores do formulário são tratados e preparados para serem utilizados, como por exemplo a remoção de mascaras.
		- No escopo da **ControllerCoreTrait** utiliza as traits: 
			- <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.View.RenderTemplate.html" target="_blank">RenderTemplate</a>
			- <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Http.RequestTrait.html" target="_blank">RequestTrait</a>
			- <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Session.SessionTrait.html" target="_blank">SessionTrait</a>
			- <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Log.LogTrace.html" target="_blank">LogTrace.</a>
- Os métodos podem ser visto na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractRestfulController.html ]


___

####<i class="icon-sitemap"></i> 2.2.1. Namespace
> - \InepZend\Controller


___

### <i class="icon-book"></i> 2.3. APIDoc/UnitTest
> - APIDoc
>> http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.Controller.html

> - UnitTest
>> - Diretório no InepZend: /vendor/InepZend/module/UnitTest/test/UnitTest/Controller/.
>> - http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.Module.UnitTest.Controller.html

___

<i class="icon-terminal"></i> 3. Como usar
---

<a id="rota"></a>
###3.1. Mapeamento de Rotas

- O InepZend herdou do ZF2 o acesso às  <a href="http://framework.zend.com/manual/2.0/en/modules/zend.view.quick-start.html" target="_blank">Action</a> de uma Controller via <a href="http://framework.zend.com/manual/2.0/en/modules/zend.mvc.routing.html" target="_blank">Rotas</a>.

- Rota é uma navegação que a aplicação possui para acessar determinada action.

- A rota é mapeada no arquivo **module.config.php** de cada módulo.
	> - <i class="icon-folder-open"></i> SeuModulo
	- <i class="icon-folder-open"></i> config
		- <i class="icon-file"></i> **module.config.php**
	-  <i class="icon-folder"></i> src
	-  <i class="icon-folder"></i> test
	- <i class="icon-folder"></i> view	

- Uma rota pode ser configurada em relação à:
	 - Parâmetros a serem recebidos;
	 - Regras de validação destes parâmetros (constraints);
	 - Classe de Controller e o método Action a ser acionado;
	 - <a href="http://framework.zend.com/manual/2.0/en/modules/zend.mvc.routing.html#router-types" target="_blank">Outras informações</a>.

```
<?php

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
);
.
.
.
```

###3.2. Exemplo de código - annotation @example

- Os exemplos da utilização de cada método estão contidos em seus comentários após a *annotation* **@example**:
> http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractCrudController.html


<a id="referencia"></a> <i class="icon-unlink"></i> 4. Referência
---

> http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.Controller.html
> 
[^service]: A documentação pode ser localizado em:  		*/InepZend/library/InepZend/Service/_READM.html*