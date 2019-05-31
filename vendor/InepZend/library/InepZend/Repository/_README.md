**<i class="icon-folder-open"></i> Repository**
===

1. Índice
---
[TOC]

<i class="icon-th"></i> 2. Definição
---


___

###<i class="icon-pencil"></i> 2.1. Conceito

> O componente **Repository** é responsável pelos principais métodos utilizados na camada "**M**" (Model) do Design Pattern "**MVC**" que realiza iterações diretamente com o SGDB via <a href="http://www.doctrine-project.org/" target="_blank">Doctrine</a>.

<a id="definicao"></a>
####**2.1.1 Repository** 
 - Repository ou Repositório é um padrão de projeto definido por Martin Fowler e utilizado nas principais frameworks de desenvolvimento com as seguintes características:
	 - Realiza a mediação entre as camadas de domínio e mapeamento de dados, agindo como uma coleção de objetos do domínio *in-memory*;
	 - Encapsula o conjunto de objetos persistidos em um armazenamento de dados e as operações realizadas sobre eles, proporcionando uma visão mais orientada a objetos da camada de persistência;
	 - Apoia o objetivo de alcançar uma separação limpa de dependência de uma via entre as camadas de domínio e mapeamento de dados;
	 - [ http://martinfowler.com/eaaCatalog/repository.html ]

<a id="caracteristicas"></a>
####**2.1.2 Principais Características** 
- O componente Repository é responsável em realizar a transação entre a Service e o Banco de Dados disponibilizando classes e métodos específicos na qual realizam as principais operações como por exemplo:  
	- Para CRUD:
		- Insert, Update, Delete, Find, FindBy, FetchPairs, etc.
		- Retorno de dados passíveis de paginação do componente <a href="http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.Paginator.html" target="_blank">Paginator</a>:
			- FindByPaged;
	- Execução de Querys:
		- ExecuteQuery, ExecuteDQL, ExecuteSQL, etc.
	- Específicos para transações:
		- Begin, Commit, Rollback, etc.
- Ao estender uma das classes da Repository e definindo os métodos criados com a visibilidade de acesso protegidos (**protected**) os mesmos serão passíveis de **auditoria**. 

###<a id="principais-caracteristicas"></a><i class="icon-info"></i> 2.2. Principais características


####2.2.1. Classes
			
>- Classes: 
 - InepZend\Repository\AbstractRepositoryCore
 - InepZend\Repository\AbstractRepositoryEntityManager
 - InepZend\Repository\AbstractRepositoryQuery
 - InepZend\Repository\AbstractRepositoryCommand
 - InepZend\Repository\AbstractRepository
 - InepZend\Repository\Repository

<a id="hierarquia"></a>
####2.2.2. Estrutura hierárquica
> - <a href="#41"> AbstractRepositoryCore</a>
	- <a href="#42">AbstractRepositoryEntityManager</a>
		- <a href="#43">AbstractRepositoryQuery</a>
			- <a href="#44"> AbstractRepositoryCommand</a>
				- <a href="#45"> AbstractRepository</a>
					- <a href="#46"> Repository</a>

>>A classe abaixo herda a classe acima. 
Sendo assim, a classe *AbstractRepositoryCore* é a classe de primeiro nível, e a classe *AbstractRepositoryEntityManager* herda/estende a *AbstractRepositoryCore*


#####2.2.2.1. O uso das classes \InepZend\Repository

 <a id="41"></a>
######**2.2.2.1.1. AbstractRepositoryCore**

> - Classe abstrata responsável por métodos considerados essenciais a manipulação de dados dos repositórios via Doctrine.
	- A classe AbstractRepositoryCore estende a classe <a href="http://www.doctrine-project.org/api/orm/2.2/class-Doctrine.ORM.EntityRepository.html" target="_blanck">EntityRepository</a> do Doctrine
- A classe AbstractRepositoryCore tem em seu escopo o mapeamento a trait  <a href="http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.Log.html" target="_blanck">LogCall</a>
	- A trait LogCall é responsável em realizar a auditoria dos métodos que contenham a visibilidade protegida (**protect**).
- Os métodos podem ser vistos na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Repository.AbstractRepositoryCore.html ]

 <a id="42"></a>
######**2.2.2.1.2. AbstractRepositoryEntityManager**

> - Classe abstrata responsável por métodos relacionados a instancias e configurações do <a href="https://github.com/doctrine/doctrine2/blob/master/lib/Doctrine/ORM/EntityManager.php" target="_blank">EntityManager</a>.
> - Os métodos podem ser vistos na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Repository.AbstractRepositoryEntityManager.html ]


<a id="43"></a>
######**2.2.2.1.3. AbstractRepositoryQuery**

> - Classe abstrata responsável por métodos relacionados a instancias/execução de **Query**.
> - Os tipos de execuções e retornos são referentes aos objetos dos tipos:
 - Doctrine\ORM\QueryBuilder;
 - Doctrine\ORM\Query;
 - Doctrine\DBAL\Statement;
 - Doctrine\ORM\NativeQuery;
> - Os métodos podem ser vistos na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Repository.AbstractRepositoryQuery.html ]

<a id="44"></a>
######**2.2.2.1.4. AbstractRepositoryCommand**

> - Classe abstrata responsável por métodos de execução de alguns **comandos SQL**, principalmente o controle de transação como:
 - Begin TransAction;
 - Commit;
 - Rollback;
- Além dos métodos de controle de transação a classe disponibiliza métodos que requerem condicional para deletar ou alterar uma coleção de entidades, sendo elas:
	- deleteBy;
	- updateBy;
> - Os métodos podem ser vistos na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Repository.AbstractRepositoryCommand.html ]

> <a id="45"></a>
######**2.2.2.1.5. AbstractRepository**

> - Classe abstrata responsável por métodos finais ou de grande uso pelos serviços.
 - Uma das utilidades principais dessa classe é a possibilidade de comunicação com o componente  <a href="http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.Paginator.html" target="_blank">\InepZend\Paginator\Pagiantor</a> através do método findByPaged.
	 - Método **findByPaged** é responsável em retornar os dados da entidade parametrizada, o mesmo é utilizado em paginação podendo ser também utilizado para pesquisas mais refinadas.
	 - Esse método é consumido pelos componentes **\InepZend\Service** através do método <a href="desenvphp.inep.gov.br/apidoc/source-class-InepZend.Service.AbstractServiceRepository.html" target="_blank">AbstractServiceRepository</a> e **\InepZend\Controller** através do método <a href="http://desenvphp.inep.gov.br/apidoc/class-InepZend.Controller.AbstractControllerPaginator.html" target="_blank">AbstractControllerPaginator</a> de forma indiretamente.
> - Os métodos podem ser vistos na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Repository.AbstractRepository.html ]	 

> <a id="46"></a>
######**2.2.2.1.6. Repository**

> - Classe responsável pelos principais métodos utilizados na camada Repository que interage diretamente com o SGDB via Doctrine.
- Os métodos podem ser vistos na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.Repository.Repository.html ]	 
___

####<i class="icon-sitemap"></i> 2.2.3. Namespace
> - \InepZend\Repository

___

### <i class="icon-book"></i> 2.3. APIDoc/UnitTest
> - APIDoc
>> http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.Repository.html


___


<i class="icon-terminal"></i> 3. Como usar
---

###3.1. Onde utilizar o componente
<a id="camadas"></a>
####3.1.1 Camadas

> - Todas as classes referentes a Repository deve estender a classe InepZend\Repository\Repository.

<a id="utilizando"></a>
###3.2. Utilizando o componente
> - As classes do componente são utilizadas a partir de necessidades de iterações com informações que estejam armazenados em um Banco de Dados.
> - O fluxo inicia-se na camada controladora até a chegada na de repositório, por exemplo:
```
# Requisicao na Controller
$this->getService()->saveUser(array('id' => 1));

# Requisicao na Service
protected function saveUser($arrParam)
{
	return $this->getRepositoryEntity->saveUser($arrParam);
}

# Requisicao na Repositry
protected function saveUser($arrParam)
{
	$mixResult = null;
	...
	// Implementacao
	return $mixResult;
}
```
####3.2.1 Executando os métodos da Repository
```
# Metodo executado nos exemplos.
private function queryDQL()
{
	$queryBuilder = $this->createQueryBuilder();
	$query = $queryBuilder->select('Path\To\Entity' . '.no_subcategoria')
                ->from('Path\To\Entity', 'alias');
	return $query;
}
```

#####3.2.1.1 Retornando Doctrine\ORM\QueryBuilder;
> - QueryBuilder fornece um conjunto de classes e métodos que é capaz de construir programaticamente consultas, e também fornece uma API fluente. Isso significa que você pode mudar entre uma metodologia para o outro conforme a necessidade.
	- A API fornecida é projetada para que condicionalmente  seja implementado uma consulta DQL em várias etapas.
	- São fornecidos 3 tipos principais de retornos:
		- QueryBuilder::SELECT;
		- QueryBuilder::DELETE;
		- QueryBuilder::UPDATE;
> - Um objeto do tipo Doctrine\ORM\QueryBuilder sempre é criado a partir do método createQueryBuilder().
> - O objeto QueryBuilder é obtido a partir da EntityManager na qual a Repository estende.
```
public function methodReturnQueryBuilder()
{
	return $this->createQueryBuilder()
		->select('Path\To\Entity' . '.no_subcategoria')
		->from('Path\To\Entity', 'alias');
}
```
> - A partir do createQueryBuilder() pode-se obter um objeto preparado para ser chamado pelo Doctrine\ORM\Query, onde o mesmo é responsável em executar um objeto QueryBuilder.
>> O QueryBuilder é apenas um **objeto construtor**, ele não tem meios de realmente **executar uma consulta**. Por este fato é sempre necessário converter uma instância QueryBuilder em um objeto de consulta.

> - Internamente o QueryBuilder trabalha com um **cache DQL** para aumentar o desempenho. Um QueryBuilder pode estar em dois estados diferentes:
	- QueryBuilder::STATE_CLEAN 
		- O que significa DQL não foram alterados desde a última recuperação ou nada foram adicionados desde a sua instanciação;
	- QueryBuilder::STATE_DIRTY 
		- O que significa que a consulta DQL deve (e vai) ser processado na próxima recuperação;


#####3.2.1.2 Retornando Doctrine\ORM\Query
> - O objeto Doctrine\ORM\Query pode ser obtido a partir de um objeto QueryBuilder, na qual a execução do DQL ocorre através dos métodos exemplificados abaixo:
 - \$result = $query->**getResult**();
 - \$single = $query->**getSingleResult**();
 - \$array = $query->**getArrayResult**();
 - \$scalar = $query->**getScalarResult**();
 - \$singleScalar = $query->**getSingleScalarResult**();
- Na Repository há métodos responsáveis em executar/manipular objetos do tipo QueryBuilder na qual retornam um objeto do tipo **Query**, como por exemplo o método **executeDQL()** que é responsável em executar um DQL e o método **queryFactory()** responsável em preparar os parâmetros em objetos **Query** para serem executadas.
>> O método **queryFactory()** não somente manipula DQL, mas também manipula outros tipos de Objetos.
```
# Executando um DQL(QueryBuilder)
public function methodReturnQuery()
{
	$this->executeDQL($this->methodReturnQueryBuilder());
}

# Manipulando um DQL(QueryBuilder)
public function methodPrepareQuery()
{
	$this->queryFactory(null, $this->methodReturnQueryBuilder());
}
```
#####3.2.1.3 Retornando Doctrine\ORM\NativeQuery
> 
- NativeQuery são as instruções **SQL SELECT** nativas e a realização do mapeamento dos resultados em entidades Doctrine.
	- É necessário descrever as colunas no mapeamento de resultados para que a propriedade da entidade possa ser alimentada. Esta descrição é representada por um objeto **ResultSetMapping**.
- Para instanciar um objeto NativeQuery é necessário utilizar o método **createNativeQuery ** que recebe uma instrução SQL (\$strSQL) e um objeto ResultSetMapping (\$resultSetMapping).
- Uma vez obtido uma instância de um NativeQuery, pode-se vincular parâmetros para ele com a mesma API disponibilizada pelo Doctrine\ORM\Query para que possa ser **executado** e assim obter o resultado.
- O componente Repository disponibiliza o método responsável em realizar a execução de objetos NativeQuery's, sendo esse o **executeSQLMapping()**.
	- Observando que é necessário passar como parâmetro o SQL e o array a ser mapeado, podendo esse último passado utilizando o método **constructMapping()** também disponibilizado pelo componente.
```
# Query nativa SQL
private function getSqlNative()
{
	return $strSQL = 'SELECT 
                          subcategoria.co_subcategoria,
                          subcategoria.no_subcategoria,
                          categoria.co_categoria
					FROM publicacoes.tb_subcategoria subcategoria
					INNER JOIN publicacoes.tb_categoria categoria ON
							categoria.co_categoria = subcategoria.co_categoria';
}

# Array a ser mapeado
private function getMapping()
{
        $arrMapping = array(
            'categoria' => array(
                'from' => array(
                    'entity' => 'Publicacao\Entity\Categoria',
                ),
                'field' => array('co_categoria', 'no_categoria'),
            ),
            'subcategoria' => array(
                'join' => array(
                    'entity' => self::ENTITY,
                    'parent_alias' => 'categoria',
                    'parent_attribute' => 'subcategoria',
                ),
                'field' => array('co_subcategoria', 'no_subcategoria'),
            )
        );
        return $arrMapping;
}

# Juncao dos metodos "executeSQLMapping()" e "constructMapping()"     
public function methodReturnNativeQuery()
{
	# Executando o "constructMapping()"
	$arrMapping = $this->constructMapping($this->getMapping());

	return $this->executeSQLMapping($this->getSqlNative(), array(), $arrMapping);
}
```
#####3.2.1.4 Retornando Doctrine\DBAL\Statement
> - Doctrine DBAL assemelha-se a API PDO.
- Doctrine DBAL é instanciado a partir do PDO (PHP Data Objects) e realiza a integração de extensões nativas do mesmo. No momento que há um conexão aberta através da Doctrine\DBAL\DriverManager::getConnection() os métodos que se desejam da API podem ser utilizados para a recuperação de dados facilmente.
```
# Simples demonstracao para se recuperar um Statement
$connection = DriverManager::getConnection($arrParam, $arrConfig);
$strSQL = "SELECT * FROM articles";
$statement = $connection->query($strSQL);
```
> - Assim como os demais tipos de retornos, o Repository disponibiliza o método responsável pela recuperação do objeto do tipo Statement, o **executeSQL()**.

```
private function getSql()
{
	return $strSQL = 'SELECT 
                          subcategoria.co_subcategoria,
                          subcategoria.no_subcategoria,
                          categoria.co_categoria
					FROM publicacoes.tb_subcategoria subcategoria
					INNER JOIN publicacoes.tb_categoria categoria ON
							categoria.co_categoria = subcategoria.co_categoria';
}

public function returnStatement()
{
	return $this->executeSQL($this->getSql());
}
```


<a id="referencia"></a> <i class="icon-unlink"></i> 4. Referência 
---

> http://desenvphp.inep.gov.br/apidoc/class-InepZend.Repository.Repository.html

