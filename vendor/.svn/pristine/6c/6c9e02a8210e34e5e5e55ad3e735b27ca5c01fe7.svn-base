**<i class="icon-folder-open"></i> Paginator**
===

1. Índice
---
[TOC]

<i class="icon-th"></i> 2. Definição
---


___

###<i class="icon-pencil"></i> 2.1. Conceito

> O componente **Paginator** tem como objetivo manipular as informações necessárias para a paginação de registros de diferentes elementos.

<a id="definicao"></a>
####**2.1.1 Paginação no InepZend** 

 - A paginação utilizada no InepZend segue o conceito do <a href="http://framework.zend.com/manual/current/en/modules/zend.paginator.introduction.html" target="_blank">Paginator</a> do ZendFramework2, na qual:
- Paginar dados arbitrários, não apenas os relacionados a bancos de dados, podendo ser um array por exemplo.
- Retorna somente os resultados que necessitam ser exibidos na tela, por exemplo, para uma consulta de **100** registros e necessita-se somente de **5** registros, serão buscados na base de dados somente estes **5** registros.
- Não força seus usuários a aderir a apenas uma maneira de exibir dados ou processamento, pode-se utilizar diversas formas para exibição dos dados de controles de paginação.
- Podem ser criados <a href="#adapters">Adapters</a> para interagir com o componente de paginação.

<a id="adapters"></a>
####**2.1.2 Adapters Utilizados ** 
- A fim de paginar itens, sendo esses de uma forma genérica de acesso aos dados, os acessos ocorrem através de utilização do *design pattern* <a href="http://pt.wikipedia.org/wiki/Adapter" target="_blank">Adapters</a>. O Adapter implementando é o <a href="http://framework.zend.com/manual/current/en/modules/zend.paginator.advanced.html" target="_blank">AdapterInterface</a> do ZendFramework2, os Adapters sao:
	- <a href="#42">NativeQueryPaginator</a>;
	- <a href="#43">StatementPaginator</a>;
	- <a href="http://framework.zend.com/apidoc/2.3/classes/Zend.Paginator.Adapter.ArrayAdapter.html" target="_blank">ArrayAdapter</a>
	> - Classe da ZendFramework responsável em converter os dados do tipo Array para ser utilizado pelo Paginator.
	
	- DoctrineAdapter
	> - Classe do Doctrine ORM responsável em receber dados do tipo <a href="http://doctrine-orm.readthedocs.org/en/latest/tutorials/pagination.html" target="_blank">Paginator do Doctrine</a> em seu contrutor e assim disponibiliza as informações para serem utilizadas nas respectivas paginações da aplicação.

###<a id="principais-caracteristicas"></a><i class="icon-info"></i> 2.2. Principais características


####2.2.1. Classes e arquivos do componente
			
>- Classes: 
	- \InepZend\Paginator\Paginator;
	- \InepZend\Paginator\Adapter\NativeQueryPaginator;
	- \InepZend\Paginator\Adapter\StatementPaginator;
>- Arquivos phtml auxiliares: 
	- _flexigrid-footer;
	- _paginator;

<a id="hierarquia"></a>
####2.2.2. Estrutura
> - <i class="icon-folder-open"></i> **Paginator**
	- <i class="icon-file"></i><a href="#41"> Paginator.php</a>
	- <i class="icon-folder-open"></i> Adapter
		- <i class="icon-file"></i> <a href="#42">NativeQueryPaginator.php</a>
		- <i class="icon-file"></i> <a href="#43">StatementPaginator.php</a>
	- <i class="icon-folder-open"></i> View
		- <i class="icon-file"></i> <a href="#44"> _flexigrid-footer.phtml</a>
		- <i class="icon-file"></i> <a href="#45"> _paginator.phtml</a>

#####2.2.2.1. Classe \InepZend\Paginator

 <a id="41"></a>
######**2.2.2.1.1. Paginator**

> - Classe responsável em manipular as informações necessárias para a paginação de registros de diferentes elementos.
	
> - Principais métodos:
	- **__construct()**: Método construtor responsável em setar as informações principais da paginação.
		- Ao instancia a classe **Paginator** é necessário passar pelo menos o primeiro parâmetro para obter os dados, os parâmetros são:
			- $queryArray (Objeto *[NativeQuery, ou Statement ou Paginator]* ou Array): **Obrigatório** para obter a paginação;
			- $intPage: Pagina atual;
			- $intItemPerPage: Quantidade por página;
	- **getRegister()**: Método responsável em retornar os registros, apos a paginação ser realizada.
	- **getZendPaginator()**: Método responsável em retornar o objeto ZendPaginator, apos a paginação ser realizada.
	- **getRegisterToGrid()**: Método responsável em retornar os registros formatados para a Grid, apos a paginação ser realizada.		
	- **convertRegisterToGrid()**: Método responsável em converter os registros para a formatação exigida pela Grid, apos a paginação ser realizada.
		- Esse método é o **diferencial** da classe Paginator, pois é onde realiza o retorno da estrutura dos dados a serem utilizados em qualquer tipo de apresentação de Grid, como por exemplo a biblioteca JS FlexiGrid.

 <a id="42"></a>
######**2.2.2.1.2. NativeQueryPaginator**

> - Essa classe implementa o <a href="#adapters">AdapterInterface</a> com objetivo de manipular dados do tipo <a href="http://doctrine-orm.readthedocs.org/en/latest/reference/native-sql.html" target="_blank">NativeQuery</a> para o Paginator;
- Com NativeQuery você pode executar instruções nativas SQL SELECT e mapear os resultados para entidades Doctrine ou qualquer outro formato suportado pelo resultado Doctrine.
- A fim de fazer esse mapeamento possível, será necessário descrever/mapear ao Doctrine as entidades e colunas envolvidas. Esta descrição é representada por um objeto ResultSetMapping.
- Namespace
	- \InepZend\Paginator\Adapter\NativeQueryPaginator;

- Exemplo: 
```
# NativeQueryPaginator
$this->getService('Path\To\Service')
	 ->getEntityManager()
	 ->createNativeQuery(
		 'SELECT * FROM PUBLICACOES.TB_SUBCATEGORIA WHERE CO_SUBCATEGORIA = 1', 
		 (new ResultSetMapping())
);
```
<a id="43"></a>
######**2.2.2.1.3. StatementPaginator**

> - Essa classe implementa o <a href="#adapters">AdapterInterface</a> com objetivo de manipular dados do tipo dados <a href="http://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html" target="_blank">Statement</a> para o Paginator, ou seja, trabalha com instruções SQL puras.
> - Utiliza conexões abertas para realizar transações com o banco de dados.
> - Doctrine DBAL segue o mesmo padrão da API PDO;
> - A API fornecida pelo PDO contém varias funções de conveniência em Doctrine DBAL.
- Namespace
	- \InepZend\Paginator\Adapter\StatementPaginator;

- Exemplo:
```
# StateMentPaginator
$this->getService('Path\To\Service')
      ->getEntityManager()
      ->prepare('SELECT * FROM PUBLICACOES.TB_SUBCATEGORIA WHERE CO_SUBCATEGORIA = ?')
      ->bindValue(1, 'CO_SUBCATEGORIA');
```
___

####<i class="icon-sitemap"></i> 2.2.3. Namespace
> - \InepZend\Paginator

___

### <i class="icon-book"></i> 2.3. APIDoc/UnitTest

> - APIDoc
>> http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.Paginator.html

___


<i class="icon-terminal"></i> 3. Como usar
---

###3.1. Onde utilizar o componente
<a id="camadas"></a>
####3.1.1 Camadas

> - O componente oferece o serviço de paginação à classes das camadas:
>   - **Repository;**
>   - **Service;**
> - Somente estas camadas podem instanciar o objeto **new \InepZend\Paginator\Paginator())**;
>> - ***Indiretamente*** é oferecido o serviço de paginação à classes da camada de Controller.

<a id="utilizando"></a>
###3.2. Utilizando o componente
> - O uso do componente é muito simples, bastando somente a passagem de três parâmetros onde somente o primeiro é obrigatório: 
>  - O primeiro parâmetro é um objeto query ou registros de array a ser paginado;
>  - O segundo parâmetro é a página a ter seus registros listados;
>   - O terceiro parâmetro é o número de registros por página.
> - Ao instanciar a classe Paginator, as informações/dados acima são passados via __construct, ou seja, na instanciação da mesma são passados os dados conforme a necessidade.

####3.2.1 Instância com a passagem de parâmetros

<a id="tipos-passagem"></a>
#####3.2.1.1 Passando Doctrine\ORM\Query
```
$query = $this->getService()
			  ->getEntityManager()
			  ->createQuery('
			select subcategoria 
				from InepZend\Module\UnitTest\Entity\Subcategoria subcategoria 
			where subcategoria = ?1')
			 ->setParameter(1, 5);

$paginator = new Paginator($query, $intPage, $intItemPerPage);
```
#####3.2.1.2 Passando ArrayAdapter
```
# O retorno do FindBy é um array().
$arrDados = $this->getService()->findBy(
	array(
		'campo' => 'valor'
		)
);
$paginator = new Paginator($arrDados, $intPage, $intItemPerPage);

# O Paginator aceita um array, conforme o codigo abaixo
$arrDados = array(0 =>
            array(
                'NO_FILE' => 'AcaoMenu1421956943.json',
                'DS_PATH' => 'data/ssi/AcaoMenu1421956943.json',
                'DS_SIZE' => '1.78 KB(s)',
                'DT_CREATE' => '22/01/2015 18:02:23'),
            1 =>
            array(
                'NO_FILE' => 'AcaoMenu1421956927.json',
                'DS_PATH' => 'data/ssi/AcaoMenu1421956927.json',
                'DS_SIZE' => '1.78 KB(s)',
                'DT_CREATE' => '22/01/2015 18:02:07'));
$paginator = new Paginator($arrDados, $intPage, $intItemPerPage);
```
#####3.2.1.3 Passando Doctrine\ORM\NativeQuery
```
protected function getQueryCustom(array $arrCriteria = null)
{
    $strAlias = $this->getAlias();
    $strSQL = 'SELECT
                      TO_CHAR(' . $strAlias . '.id_arquivo) id_arquivo,
                      publicacao.id_publicacao,
                      publicacao.id_usuario_inclusao,
                      publicacao.no_publicacao,
                      publicacao.no_autor_publicacao,
                      publicacao.nu_volume_publicacao,
                      publicacao.nu_ano_publicacao,
                      publicacao.ds_sinopse_publicacao,
                      publicacao.in_destaque_publicacao,
                      publicacao.nu_publicacao,
                      publicacao.dt_publicacao,
                      publicacao.tp_situacao_publicacao,
                      ' . $strAlias . '.no_arquivo,
                      ' . $strAlias . '.ds_caminho_arquivo,
                      ' . $strAlias . '.tp_arquivo,
                      ' . $strAlias . '.dt_inclusao
              FROM publicacoes.tb_arquivo ' . $strAlias . '
              INNER JOIN publicacoes.tb_publicacao publicacao ON
                      ' . $strAlias . '.id_publicacao = publicacao.id_publicacao';

      $arrWhereParameter = $this->constructWhereParameter($strAlias, $arrCriteria, array('no_arquivo'), array('id_arquivo', 'tp_arquivo'));
      $arrWhere = $arrWhereParameter[0];
      $arrParameter = $arrWhereParameter[1];
      if (count($arrWhere) > 0)
          $strSQL .= ' WHERE ' . implode(' AND ', $arrWhere);
      $arrMapping = array(
              $strAlias => array(
                      'from' => array(
                          'entity' => 'Publicacao\Entity\Arquivo',
                      ),
                      'field' => array('id_arquivo', 'no_arquivo', 'ds_caminho_arquivo', 'tp_arquivo', 'dt_inclusao'),

               ),
              'publicacao' => array(
                        'join' => array(
                            'entity' => 'Publicacao\Entity\Publicacao',
                            'parent_alias' => $strAlias,
                            'parent_attribute' => 'publicacao',
                        ),
                        'field' => array(
                                          'id_publicacao', 
                                          'id_usuario_inclusao', 
                                          'no_publicacao', 
                                          'no_autor_publicacao', 
                                          'nu_volume_publicacao', 
                                          'nu_ano_publicacao', 
                                          'ds_sinopse_publicacao', 
                                          'in_destaque_publicacao', 
                                          'nu_publicacao', 
                                          'dt_publicacao', 
                                          'tp_situacao_publicacao'),
                )
        );
        return $this->executeSQLMapping($strSQL, $arrParameter, $this->constructMapping($arrMapping));

}

 

public function getPaginator($intPage = 1, $intItemPerPage = 10)
{
    $paginator = new Paginator($this->getQueryCustom(), $intPage, $intItemPerPage);
    return $paginator;
}
```
#####3.2.1.4 Passando Doctrine\DBAL\Statement
```
...
$stmt = $this->getService()
			 ->getEntityManager()
			 ->getConnection()
			 ->prepare('SELECT * FROM PUBLICACOES.TB_SUBCATEGORIA WHERE CO_SUBCATEGORIA = ?');
$stmt->bindValue(1, 'CO_SUBCATEGORIA');

$paginator = new Paginator($stmt, $intPage, $intItemPerPage);
```
<a id="repository"></a>
###3.3. Repository - Utilizando o componente
####3.3.1 findByPaged()
> - Para facilitar a utilização do componente no InepZend foi realizado o mapeamento da Paginator dentro da camada **Model** a partir do componente <a href="http://desenvphp.inep.gov.br/apidoc/source-class-InepZend.Repository.Repository.html" target="_blank">\InepZend\Repository</a>.
>  - Conforme o padrão adotado no InepZend, ao criar uma classe repository, se faz necessário utilizar o componente <a href="http://desenvphp.inep.gov.br/apidoc/source-class-InepZend.Repository.Repository.html" target="_blank">Repository</a>.
> - No componente Repository há o método **findByPaged()** responsável em retornar um Paginator.
>  - Os tipos esperados, objeto query/array/string DQL, no último parâmetro do método findByPaged(), ***$mixDQLQuery***,  podem ser identificado no item <a href="#tipos-passagem">3.2.1.1</a>.

```
use InepZend\Repository\Repository;

class MinhaReository extends Repository
{
	public function meuMetodoNaRepository()
	{
		// Logica
		$paginator = $this->findByPaged($arrCriteria, $strSortName, $strSortOrder, $intPage, $intItemPerPage, $mixDQLQuery);
	}
}
```
> - A engenharia implementada no componente Repository por parte da Arquitetura para se obter os dados do tipo Paginator se torna transparente ao se utilizar o método  **findByPaged()**, bastando somente chamar o método e passar os dados definidos na assinatura do método conforme exemplo acima.


 <a id="service"></a>
###3.4. Service - Utilizando o componente
> - A engenharia implementada na Service, mais especificamente no componente <a href="http://desenvphp.inep.gov.br/apidoc/source-class-InepZend.Service.AbstractServiceRepository.html" target="_blank">\InepZend\Service</a>, segue a mesma do item <a href="#repository">Repository</a>.
####3.4.1 findByPaged()
> - No componente  <a href="http://desenvphp.inep.gov.br/apidoc/source-class-InepZend.Service.AbstractServiceRepository.html" target="_blank">Service</a>, mais especificamente na classe *AbstractServiceRepository()*, há o método **findByPaged()** responsável em retornar um Paginator.
>  - Ele invoca o **findByPaged()** do componente <a href="#repository">Repository</a>.

```
$query = $this->getService()
			  ->getEntityManager()
			  ->createQuery('select subcategoria from InepZend\Module\UnitTest\Entity\Subcategoria subcategoria where subcategoria = ?1')
			  ->setParameter(1, 5);
$this->findByPaged(array('co_subcategoria' => self::CO_SUBCATEGORIA), 'no_subcategoria', 'ASC', 1, 10, $query);
```

<a id="controller"></a>
###3.5. Controller - Utilizando o componente
> - Na camada Controller contém o componente <a href="http://desenvphp.inep.gov.br/apidoc/source-class-InepZend.Controller.AbstractControllerPaginator.html" target="_blank">\InepZend\Controller</a> que realiza o mapeamento do Paginator através da classe AbstractControllerPaginator().
> - Na classe AbstractControllerPaginator() existe a possibilidade de utilizar dois métodos, sendo esses:
>  - indexPaginatorAction()
>  - ajaxPaginatorAction()
> - Ao se utilizar esses dois métodos é realizado a chamada o método **findByPaged()** da <a href="http://desenvphp.inep.gov.br/apidoc/source-class-InepZend.Service.AbstractServiceRepository.html" target="_blank">Service</a> por padrão.
####3.5.1 indexPaginatorAction()
> - Método responsável em realizar a paginação dos registros via método **findByPaged**, por padrão, e retornar uma View parametrizada com as informações da paginação.
```
$this->indexPaginatorAction($arrCriteria, 
						    $strSortName, 
						    $strSortOrder, 
						    $intItemPerPage, 
						    $strService, 
						    $strMethodService);

$this->indexPaginatorAction(array('campo' => 'valor') , 'nome_do_campo', 'ASC', 10, 'Path\To\Service', 'seuMetodoNaService');
```

> - O primeiro parâmetro é responsável pela filtragem condicional das informações;
> - O segundo parâmetro é responsável por definir o nome do atributo a ser ordenado;
> - O terceiro parâmetro é responsável por definir a ordem crescente ou decrescente em relação ao nome do atributo a ser ordenado;
> - O quarto parâmetro é responsável por definir o número de registros por página. 
	- Caso não seja parametrizado haverá uma busca no **GET** para verificar se existe a sua parametrização, ou ainda será assumido o valor padrão de **10** registros;
> - O quinto parâmetro é responsável por definir o **namespace da Service** a ser acionada. 
	- Caso não seja parametrizado será assumido o valor padrão da Service correspondente à Controller;
- O sexto parâmetro é responsável por definir o método da Service (por padrão é o findByPaged) a ser utilizada.


> > **Obs.:** O número da página a ter seus registros listados terá também uma busca no **GET** para verificar se existe a sua parametrização, ou ainda será assumido o valor padrão de **1**;

####3.5.2 ajaxPaginatorAction()
> - Método responsável em realizar por ajax a paginação dos registros via algum método da Service (por padrão é o findByPaged) e retornar as devidas informações relacionadas à paginação.
> - Caso seja uma paginação para uso da biblioteca ***JS Flexigrid***, será retornada uma View contendo um XML específico para seu uso, caso contrário será retornado o próprio <a href="#41">InepZend\Paginator\Paginator</a>.
> - As necessárias parametrizações de paginação e o invocamento do método de Serviço que instancia o <a href="#41">InepZend\Paginator\Paginator</a> ou que acessa o método da Repository que manipulará o <a href="#41">InepZend\Paginator\Paginator</a> é realizado pelo método <a href="#getPaginator">getPaginator</a> da <a href="http://desenvphp.inep.gov.br/apidoc/source-class-InepZend.Controller.AbstractControllerPaginator.html" target="_blank">AbstractControllerPaginator</a>;

```
# Forma de chamada do metodo ajaxPaginatorAction()
$this->ajaxPaginatorAction($mixDQLQuery, 
						   $strService, 
						   $arrMethodPaging, 
						   $arrMethodPk, 
						   $intItemPerPage, 
						   $booFlexigrid, 
						   $arrCriteria, 
						   $strMethodService)

# Exemplo 1
$arrCriteria = $this->getInfoAjaxPaginator('arrCriteria');
$this->ajaxPaginatorAction($this->getService()->getDQLCustom($arrCriteria));

# Exemplo 2
public function ajaxHistoryPaginatorAction()
{
	return parent::ajaxPaginatorAction(null, 'InepZend\Module\Application\Service\AutoloadConfig', array('no_autor', 'no_file', 'dt_ocorrencia'), array('no_file'), 10, true, array('tp_file' => AutoloadConfig::TYPE_FILE_HISTORY));
}
    
# Exemplo 3
public function ajaxPaginatorAction()
{
        $arrCriteria = $this->getInfoAjaxPaginator('arrCriteria');
        if (empty($arrCriteria)) {
            $arrIdPublicacao = $this->getService()->listLastId(0);
            if ((!is_array($arrIdPublicacao)) || (count($arrIdPublicacao) == 0)) {
                $flexigrid = new \InepZend\Grid\Flexigrid\Flexigrid();
                $strXml = $flexigrid->getXml();
                return $this->getViewClearContent($strXml);
            }
            $arrCriteria = array('id_publicacao' => $arrIdPublicacao);
        } elseif (array_key_exists('id_publicacao', $arrCriteria))
            unset($arrCriteria['id_publicacao']);
        return parent::ajaxPaginatorAction($this->getService()->getDQLCustom($arrCriteria));
}
```
> - O primeiro parâmetro é um objeto **query, registros de array ou string DQL** a ser paginado;
- O segundo parâmetro é responsável por definir o namespace da Service a ser acionada. 
	- Caso não seja parametrizado será assumido o valor padrão da Service correspondente à Controller;
- O terceiro parâmetro é responsável por definir os métodos ou índices de array que serão utilizados na montagem da Grid. 
	- Caso não seja parametrizado, será utilizado o valor definido no atributo **arrMethodPaging** da classe. 
	- É recomendado que o atributo **arrMethodPaging** da classe seja sempre definido no método construtor;
- O quarto parâmetro é responsável por definir os métodos ou índices de array referentes à(s) chave(s) primária(s) da listagem paginada. 
	- Caso não seja parametrizado, será utilizado o valor definido no atributo **arrMethodPk** da classe. 
	- É recomendado que o atributo **arrMethodPk** da classe seja sempre definido no método construtor;
- O quinto parâmetro é responsável por definir o número de registros por página. 
	- Caso não seja parametrizado haverá uma busca no **POST** para verificar se existe a sua parametrização, ou ainda será assumido o valor padrão de 10 registros;
- O sexto parâmetro é responsável por definir o retorno da View contendo um XML específico para uso da FlexiGrid (valor padrão true);
- O sétimo parâmetro é responsável pela filtragem condicional das informações além daquelas definidas no **POST**;
- O oitavo parâmetro é responsável por definir o método da Service (por padrão é o findByPaged) a ser utilizada.
>> **Obs.:** O número da página a ter seus registros listados terá também uma busca no **POST** para verificar se existe a sua parametrização, ou ainda será assumido o valor padrão de **1**;

 <a id="getPaginator"></a>
###3.6. getPaginator()
> - Manipula as informações de paginação buscando o(s) valor(es) do(s) parâmetro(s) do método ou do **POST** conforme cada contexto.
- Invoca o método **findByPaged** por padrão de Serviço que instancia o <a href="#41">InepZend\Paginator\Paginator</a> ou que acessa o método da <a href="#repository">Repository</a> que manipulará o <a href="#41">InepZend\Paginator\Paginator</a>.

 <a id="fluxo"></a>
###3.7. Fluxo - Passando pelas camadas utilizando FlexiGrid
####3.7.2 Definindo a paginação no **__construct** do Controller

```
public function __construct()
    {
        parent::__construct(__CLASS__);
        $this->arrPk = array('id_publicacao');
        $this->arrMethodPk = array('getIdPublicacao');
        $this->arrMethodPaging = array('getNuPublicacao', 'getNuVolumePublicacao', 'getNoPublicacao', 'getCategoria', 'getSubcategoria', 'getNuAnoPublicacao', 'getDsSituacaoPublicacao');
    }
```
> - Com os atributos definidos conforme o código aciama, a Helper irá identificar que existe uma paginação a ser exibida no PHTML onde que por default irá realizar as chamadas aos métodos ajaxPaginatorAction do componente <a href="#controller">Controller</a> que subsequentemente irá chamar os métodos findByPaged das camadas <a href="#service">Service</a> e <a href="#repository">Repository</a>.
> - Para se obter a paginação (paginator) na Controller é preciso estender a classe *AbstractControllerPaginator* ou estender alguma que herde ou a estenda em sua hierarquia, como por exemplo *AbstractController*.
>> De forma transparente a arquitetura criou o componente **\InepZend\Grid\FlexiGrid** que identifica através de sua **Helper** juntamente com o **ajax.js**, que também faz parte dos componentes JS do InepZend,  os atributos ***arrMethodPk*** e ***arrMethodPaging*** definidos no construtor da Controller. Esses dois componentes são responsáveis de verificar a Rota e estarta a construção da paginação que será exibida no PHTML.

> - Após as devidas definições basta somente realizar a chamada da FlexiGrid no PHTML conforme o exemplo abaixo:
<a id="form-grid"></a>
```
<?php
$flexigrid = $this->flexigrid();
$flexigrid->setRoute('publicacao');
$flexigrid->setSortName('id_publicacao');
$flexigrid->setSortOrder('desc');
$flexigrid->setShowDelete(false);
$flexigrid->setCol('nu_publicacao', 'N°', 70, 'center');
$flexigrid->setCol('nu_volume_publicacao', 'Volume', 120, 'center');
$flexigrid->setCol('no_publicacao', 'Título da Publicação', 350, 'left', true, false, true);
$flexigrid->setCol('c.no_categoria', 'Categoria', 160, 'left');
$flexigrid->setCol('sc.no_subcategoria', 'Subcategoria', 160, 'left');
$flexigrid->setCol('nu_ano_publicacao', 'Ano', 50, 'center');
$flexigrid->setCol('tp_situacao_publicacao', 'Situação da Publicação', 130, 'left');
$flexigrid->setButton('Inativar', 'delete', 'inactivatePublication');
$flexigrid->setItemPerPage(20);
echo $flexigrid->showGrid();
?>
```

####3.7.2 Utilizando a chamada do ajaxPaginatorAction()
#####3.7.2.1 Quando há filtro no PHTML
> - Quando há necessidade de haver um filtro juntamente com a paginação deve-se definir em um Form referente ao filtro e a paginação, que no caso será uma FlexiGrid conforme o código <a href="#form-grid">acima</a>.
#####3.7.2.2 Quando não há filtro PHTML
> - Quando não há filtro no arquivo PHTML é necessário utilizar o flexReload() para atualizar os dados da Grid.
>  - **Por boas práticas é sugerido que as Grids sejam montadas no Form ao invés de ser colocado nos arquivos PHTML**.
 
```
# Quando a for uma rota diferente de ajaxPaginator() eh preciso inserir na chamada a rota.
$('#tableData').flexOptions({url: strGlobalBasePath + '/ssi-menu/ajaxHistoryPaginator'});
# Apos a atualizacao eh necessario executar o refresh da FlexiGrid. 
$('#tableData').flexReload();
```


 <a id="iterator"></a>
###3.8. Erro de Iterator
> Durante o desenvolvimento para se obter uma paginação que utiliza a FlexiGrid ocorre exceções referente ao Iterator, no entanto o erro não é exatamente no Iterator e sim um erro referente a execução por exemplo de um banco de dados, sendo assim o erro de **Itarator** é a última exceção a ser exibida durante o fluxo da paginação.
> Observe os erros abaixo e veja que o erro foi durante a execução de uma query incorreta que ocasionalmente gerou erro de Itarator:

>> #### Erro 1
>> - Zend\Paginator\Exception\RuntimeException
- Arquivo:
  - /home/Guerreiro777/www/InepSkeleton/vendor/zendframework/zendframework/library/Zend/Paginator/Paginator.php:637
- Mensagem:
 - Error producing an **iterator**

>> #### Erro 2
 - Doctrine\DBAL\Exception\DriverException
 - Arquivo:
  - **/home/Guerreiro777/www/InepSkeleton/vendor/doctrine/dbal/lib/Doctrine/DBAL/Driver/AbstractOracleDriver.php:74**
 - Mensagem:
  - An exception occurred while executing 'SELECT COUNT(*) AS dctrn_count FROM (SELECT DISTINCT ID_PUBLICACAO0 FROM (SELECT p0_.id_publicacao AS ID_PUBLICACAO0, p0_.id_usuario_inclusao AS ID_USUARIO_INCLUSAO1, p0_.no_publicacao AS NO_PUBLICACAO2, p0_.no_autor_publicacao AS NO_AUTOR_PUBLICACAO3, p0_.nu_volume_publicacao AS NU_VOLUME_PUBLICACAO4, p0_.nu_ano_publicacao AS NU_ANO_PUBLICACAO5, p0_.ds_sinopse_publicacao AS DS_SINOPSE_PUBLICACAO6, p0_.in_destaque_publicacao AS IN_DESTAQUE_PUBLICACAO7, p0_.nu_publicacao AS NU_PUBLICACAO8, p0_.dt_publicacao AS DT_PUBLICACAO9, p0_.tp_situacao_publicacao AS TP_SITUACAO_PUBLICACAO10, p0_.in_enviada AS IN_ENVIADA11 FROM publicacoes.tb_publicacao p0_ INNER JOIN publicacoes.tb_subcategoria p1_ ON p0_.co_subcategoria = p1_.co_subcategoria INNER JOIN publicacoes.tb_categoria p2_ ON p1_.co_categoria = p2_.co_categoria WHERE p0_.id_publicacao IN (?) ORDER BY p0_.id_publicacao DESC) dctrn_result) dctrn_table' with params [11353]:ORA-01795: maximum number of expressions in a list is 1000

<a id="referencia"></a> <i class="icon-unlink"></i> 4. Referência 
---

> http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.Paginator.html

