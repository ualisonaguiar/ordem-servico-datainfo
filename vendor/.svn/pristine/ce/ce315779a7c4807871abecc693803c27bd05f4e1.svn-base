**<i class="icon-folder-open"></i> WebService**
===

1. Índice
---
[TOC]

<i class="icon-th"></i> 2. Definição
---

###<i class="icon-pencil"></i> 2.1. Conceito

> O componente **WebService** é responsável por reunir diversos métodos para acesso e consumo de serviços.
> Toda troca de informações, seja ele interno ou externo, através de serviços deve estar mapeado no componente.

####2.1.1 WebService

####2.1.2 Principais Características

###<i class="icon-info"></i> 2.2. Principais características

- O componente WebService consiste nas classes com métodos para consumo de serviços.

####2.2.1. Classes

>- Classes:
	- InepZend\WebService\Client\Corporative
		- BancoDoBrasil
			- AgenciasBb
		- Correios
			- Dne
		- Febraban
			- Febraban
		- Inep
			- RestCorp
				- Cartorio
				- Cep
				- CodigoBarra
				- CodigoSeguranca
				- Cpf
				- Distrito
				- Email
				- EstadoCivil
				- Etnia
				- Municipio
				- OrgaoEmissor
				- Pais
				- Pessoa
				- Programa
				- Projeto
				- Regiao
				- Sms
				- Sqi
				- SubDistrito
				- Uf
		- Mec
		- Mpog
			- Mpog
		- ReceitaFederal
			- CertidaoConjunta
			- PessoaFisica
			- PessoaJuridica
		

####2.2.2. Estrutura Principal

> 
- <i class="icon-folder-open"></i> Client/
	- <i class="icon-folder-open"></i> Corporative/
		- <i class="icon-folder-open"></i> ...
			- <i class="icon-file"></i> ...
	- <i class="icon-folder-open"></i> Soap/
		- <i class="icon-folder-open"></i> ...
			- <i class="icon-file"></i> ...
	- <i class="icon-file"></i> AbstractWebService.php
	- <i class="icon-file"></i> Rest.php
	- <i class="icon-file"></i> Soap.php
- <i class="icon-folder-open"></i> Server/
	- <i class="icon-folder-open"></i> ...
		- <i class="icon-file"></i> ...

####<i class="icon-sitemap"></i> 2.2.3. Namespace

> - \InepZend\WebService

### <i class="icon-book"></i> 2.3. APIDoc/UnitTest

> - APIDoc
>> http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.WebService.html

<i class="icon-terminal"></i> 3. Como usar
---

###3.1. Onde utilizar o componente

####3.1.1 Camadas

> 
- Todas as classes referentes a WebService deve estender a classe InepZend\WebService\Client\Soap quando se tratar de serviços SOAP e InepZend\WebService\Client\Rest quando se tratar de serviços REST
- As classes são agrupadas nos grupo CLIENT e SERVER.
- Esses grupos são subdivididos em subgrupos de fornecedores dos serviços.
	- Banco do Brasil
	- Correios
	- Febraban
	- Inep
	- Mec
	- Mpog
	- Receita Federal

###3.2. Utilizando o componente

> As classes para consumo dos serviços são utilizadas de acordo com a necessidade da aplicação para obter/processar determinados dados.
> O fluxo deve ser iniciado na camada controladora.

####3.2.1 Executando os métodos do WebService

#####3.2.1.1 Chamada do método

> Para execução de um método deve primeiramente instanciar um objeto da classe do serviço a ser executado e a partir dele chamar o método.

```
$objWs = new Classe();

$result = $objWs->metodo($params);
```

###3.3. RestCorp

> Métodos mais utilizados como busca por CPF, endereços por CEP e listas para composição de combos UFs e Municípios estão mapeados no diretório RestCorp.
> Para execução desses métodos deve-se instanciar a classe RestCorp.

```
$objWs = new RestCorp();
```

####3.3.1 Exemplo

####3.3.1.1 Cpf

```
$result = $objWs->cpf($strCpf);
```

####3.3.1.2 Cep

```
$result = $objWs->cep($intCep);
```

####3.3.1.3 País

```
$result = $objWs->pais();
```

####3.3.1.4 UF

```
$result = $objWs->uf($strCoUf);
```

####3.3.1.5 Estado Civil

```
$result = $objWs->estadoCivil();
```

<i class="icon-link"></i> 4. Referência 
---

> http://desenvphp.inep.gov.br/apidoc/class-InepZend.WebService.WebService.html
