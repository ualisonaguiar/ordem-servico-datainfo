**<i class="icon-folder-open"></i> FormGenerator**
===

1. Índice
---
[TOC]

<i class="icon-th"></i> 2. Definição
---


___

###<i class="icon-pencil"></i> 2.1. Conceito

> O componente **FormGenerator** é responsável por reunir informações e pela interação com os usuários nas aplicações.  
> Os formulários coletam informações dos usuários e as enviam ao servidor para serem processadas, essa comunicação ocorre principalmente entre as camadas de Visão **(View)** e Controladora **(Controller)** do Design Pattern "**MVC**". Essa mesma pode também iteragir com a camada de Serviço **(Service)** quando necessário. 
> Os formulários podem conter vários objetos que possibilitam a interação com o usuário no qual incluem campos de texto, caixas de listagem, caixas de seleção, botões de opção, etc.</a>.

<a id="definicao"></a>
####**2.1.1 FormGenerator** 
 - FormGenerator  destina-se principalmente como uma ponte entre **Domain Models** e a **View Layer**. 
 - Compõe uma fina camada de objetos que representam elementos de:
	 -  FormGenerator, 
	 - InputFilter,
	 - Métodos para os **bindigns** de dados, 
	 - Ligação **(attached)** de objetos.

<a id="caracteristicas"></a>
####**2.1.2 Principais Características** 
- O componente FormGenerator consiste nos seguintes objetos:
	- **Elements**, que consistem em nome e atributos.
	- **Fieldsets**, que se estendem a partir de elementos, mas permitem compor outros fieldsets e elementos.
	- **FormGenerators**, que se estendem a partir fieldsets (e, assim, elementos).
- Para facilitar o uso com a camada View, o componente FormGenerator também agrega uma série de **Form-specific** e **View Helpers**, além de conter customizações em JS **(Javascripts)**.

###<a id="principais-caracteristicas"></a><i class="icon-info"></i> 2.2. Principais características


####2.2.1. Classes
			
>- Classes: 
 - InepZend\FormGenerator\FieldsetGenerator
 - InepZend\FormGenerator\FormGenerator
 - InepZend\FormGenerator\InputElement
 - InepZend\FormGenerator\Add\
	 - Banco     
	 - Cnpj          
	 - DadoPessoal  
	 - EstadoCivil  
	 - Html        
	 - Money          
	 - Pais      
	 - RegiaoUfMunicipio  
	 - Textarea
	 - Button    
	 - Contato       
	 - DateTime     
	 - File         
	 - Image       
	 - Nacionalidade  
	 - Password  
	 - Select             
	 - Text
	 - Captcha   
	 - CorRaca       
	 - Editor       
	 - Float        
	 - InputImage  
	 - Nascimento     
	 - Phone     
	 - Sexo               
	 - Transfer
	 - Cep       
	 - Cpf           
	 - Email        
	 - Group        
	 - Label       
	 - Number         
	 - PisPasep  
	 - Submit             
	 - Url
	 - Checkbox  
	 - DadoBancario  
	 - Endereco     
	 - Hidden       
	 - Link        
	 - OrgaoEmissor   
	 - Radio     
	 - Table
 - InepZend\FormGenerator\Element\
	 - Button   
	 - Checkbox  
	 - Email  
	 - Html   
	 - Number    
	 - Radio   
	 - Submit  
	 - Textarea  
	 - Url
	 - Captcha  
	 - Date      
	 - File   
	 - Image  
	 - Password  
	 - Select  
	 - Table   
	 - Text
 - InepZend\FormGenerator\View\Helper
	 - Form  
	 - FormRow

<a id="hierarquia"></a>
####2.2.2. Estrutura Principal
> 
- <i class="icon-folder-open"></i> Add/
	- <i class="icon-file"></i> ...
- <i class="icon-folder-open"></i> Element/
	- <i class="icon-file"></i> ...
- <i class="icon-file"></i> FormGenerator
- <i class="icon-file"></i> FormGenerator
- <i class="icon-file"></i> InputElement
- <i class="icon-folder-open"></i> View/
	- <i class="icon-file"></i> ...


#####2.2.2.1. O uso das classes \InepZend\FormGenerator

 <a id="41"></a>
######**2.2.2.1.1. FormGenerator**

> - Classe responsável pela geração de formulários no InepZend da qual herda da Form do ZF2.
	- A classe **FormGenerator** tem em seu escopo o mapeamento da trait *<a href="#42">InputElement</a>* que é responsável em manipular os elementos.
- Ao herdar a classe FormGenerator fica disponível em seu escopo todas as funções referentes a formulários, tai como:
	- getDataForm();
	- setData();
	- disableElement();
- Automaticamente todos os elementos do **Add**, como por exemplo os elementos **nativos** assim como os **customizados**, também ficam disponíveis, como por exemplo:
	- addText();
	- addCpf();
	- addContato();
> - **Todas** as classes do Form do InepZend deve **herdar da FormGenerator**, conforme abaixo: 
```
<?php

namespace Path\To\Form;

use InepZend\FormGenerator\FormGenerator;

class YourForm extends FormGenerator
{ ... }

```
> - Os métodos podem ser vistos na documentação do InepZend: 
	- [http://desenvphp.inep.gov.br/apidoc/class-InepZend.FormGenerator.FormGenerator.html ]

 <a id="42"></a>
######**2.2.2.1.2. InputElement**

> - A Trait **InputElement** é responsável pela manipulacão de elementos de formulários, da qual são inseridos nos formulários.
> - As suas chamadas são por default com a nomenclatura **add**, assim como ocorre no ZF2:
```
...
$this->addCpf('MyCpf');
...
```
> - Os **add's** conforme citado no itém <a href="#41">FormGenerator</a>, ao realizar sua instancialização fica disponível a trait **InputElement**, onde o mesmo contém suas respectivas customização como por exemplo o **addCpf** demonstrado acima. Ao chamar já é exibido a renderização do campo com a sua devida máscara e validações do dado informado.
> - Ao customizar o método **addCpf** o desenvolvedor não precisa mais se preocupar com a entrada de dados e suas validações, ficando assim algo transparente para o desenvolvimento.
> - Os métodos podem ser vistos na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.FormGenerator.InputElement.html ]


<a id="43"></a>
######**2.2.2.1.3. FieldsetGenerator**

> - FieldsetGenerator é a classe responsável em realizar o agrupamento dos formulários, ou seja, com essa classe é possível conter N formulários em somente um.
- Os métodos podem ser vistos na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.FormGenerator.FieldsetGenerator.html ]


<a id="44"></a>
######**2.2.2.1.4. Estrutura Add's**

> - A estrutura **Add** contém as principais trait referente aos elementos Html, como por exemplo: 
	 - Banco     
	 - Cnpj          
	 - DadoPessoal  	
	 - RegiaoUfMunicipio  	
	 - Image       
	 - Nacionalidade  	
	 - CorRaca       
	 - Editor       
	 - Float        	       
	 - Transfer
	 - Cep       
	 - Cpf           
	 - Email        
	 - Group     
	 - PisPasep  	
	 - DadoBancario  
	 - Endereco     	  
	 - OrgaoEmissor   	
	 - Table
- As trait acima são destacadas por conterem métodos customizados conforme os cenários mais utilizados em cadastros, como por exemplo o agrupamento de elementos ao utilizar a trait **DadoPessoal**.

```
...
$this->addDadoPessoal('MyData');
...
```
> - Ao realizar a chamada acima ficará disponível os campos de:
	- CPF, N° da identidade, Órgão expedidor, UF da Identidade, Nome, Nome da Mãe, Nascimento, Sexo, Estado Civil, Cor/Raça, Nacionalidade, País de Origem, UF de Nascimento e Município de Nascimento.
- Esses campos já terão suas validações default como do CPF por exemplo e conterão também suas próprias características conforme o tipo do campo, sendo ele **text** ou **combobox** e assim consequentimente.
>> ***Essas trait com seus respectivos elementos tem por maior finalidade agilizar o processo de desenvolvimento por parte da FSW.***

> - Os métodos podem ser vistos na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/class-InepZend.FormGenerator.FieldsetGenerator.html ]

> <a id="45"></a>
######**2.2.2.1.5. Estrutura Element's**

> - A Estrutura **Element** tem como principal característica realizar a herança dos principais elementos do ZF2, para que os mesmos fiquem disponíveis para serem instanciados através do InepZend ao invés de serem instanciados diretamente do ZF2, visto que por motivos de segutrança e de critérios avaliativos, **TODAS** as classes herdadas deverão ser do InepZend e não do ZF2.
> - Os elementos mapeados são:
	- **Button,   Checkbox,  Email,  Html,   Number,    Radio,   Submit,  Textarea,  Url, Captcha,  Date,      File,   Image,  Password,  Select,  Table e  Text**.
> - Os métodos podem ser vistos na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.FormGenerator.Element.html ]

> <a id="46"></a>
######**2.2.2.1.6. Estrutura View Helper**

>  - A estrutura View contém classes referente a **FormRow**, da qual se refere diretamente a **View Helper** que é utilizada nos **Form** para auxiliar a visualização e processamento de cada linha de um formulário, no entanto, ele pode ser usado em **stand-alone** (autônomo). 
	 - De forma simples, um FormRow geralmente consiste de saídas produzidas pelo helper a uma entrada.
>  - FormRow lida com diferentes opções de renderização que possuam elementos envolvidos pelo elemento **label** do **HTML** por padrão, mas também é possível torná-los em blocos separados quando o elemento tem um **ID** de atributo especificado, preservando assim os recursos de uso do browser conforme sua usabilidade.
>  - As classes disponíveis são:
	 - Form
		 - Classe responsável em realizar as devidas validações através do JS Validate. Após realizar as devidas verificações é inseridos os elementos na view renderizadas.
	 - FormRow
		 - Classe responsável em disponibilizar já renderizados os elementos contidos no Form que serão necessários conter validações. Através do método **renderJs** por exemplo, é possṕivel carregar as validações de máscara. Muitos de seus métodos são transparente para o desenvolvimento como também a utilização do Editor de Texto, que já realiza todas as configurações básicas a serem exibidos.
> - Os métodos podem ser vistos na documentação do InepZend: [ http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.FormGenerator.View.Helper.html ]

___

####<i class="icon-sitemap"></i> 2.2.3. Namespace
> - \InepZend\FormGenerator

___

### <i class="icon-book"></i> 2.3. APIDoc/UnitTest
> - APIDoc
>> http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.FormGenerator.html


___


<i class="icon-terminal"></i> 3. Como usar
---

###3.1. Onde utilizar o componente
<a id="camadas"></a>
####3.1.1 Camadas

> - Todas as classes referentes a FormGenerator deve estender a classe InepZend\FormGenerator\FormGenerator.

<a id="utilizando"></a>
###3.2. Utilizando o componente
> - As classes do componente são utilizadas a partir de necessidades de iterações com informações que iteragem com usuários na camada de Visão (View).
> - O fluxo inicia-se na camada controladora até a chegada na View, por exemplo:

##### - Form
```
namespace Publicacao\Form;

use InepZend\FormGenerator\FormGenerator;
use Publicacao\Entity\Publicacao as PublicacaoEntity;

class Publicacao extends FormGenerator
{
	public function prepareElementsFilter()
	{
            $this->addDadoPessoal();
	        $this->setAttribute('onsubmit', 'javascript:filterPaginator("/publicacao/ajaxFilter", undefined, undefined, false, new Array(new Array("tp_situacao_publicacao", "' . PublicacaoEntity::CONST_TP_SITUACAO_PUBLICACAO_TODAS . '")), "no_publicacao"); return false;');
	        $this->addText(array('name' => 'no_publicacao', 'label' => 'Título da Publicação', 'placeholder' => 'Entre com o Título da Publicação'));
	        $this->addSelect(array('name' => 'co_categoria', 'label' => 'Categoria', 'placeholder' => 'Selecione a Categoria', 'value_options' => $this->arrCategoria, 'empty_option' => 'Selecione a Categoria', 'onchange' => 'feedSelect(\'co_categoria\', \'subcategoria\', \'/subcategoria/ajaxFetchPairs\');'));
	        $this->addSelect(array('name' => 'subcategoria', 'label' => 'Subcategoria', 'placeholder' => 'Selecione a Subcategoria', 'value_options' => array(), 'empty_option' => 'Selecione a Subcategoria'));
	        $this->addSelect(array('name' => 'nu_ano_publicacao', 'label' => 'Ano', 'placeholder' => 'Selecione o Ano', 'value_options' => $this->constructArrNuAnoPublicacao(), 'empty_option' => 'Selecione o Ano'));
	        $this->addRadio(array('name' => 'tp_situacao_publicacao', 'label' => 'Status da Publicação', 'value_options' => $this->constructArrTpSituacaoPublicacao(), 'title_options' => $this->constructArrTpSituacaoPublicacao(), 'value' => PublicacaoEntity::CONST_TP_SITUACAO_PUBLICACAO_TODAS));
	        $this->addButtonSearch('filterPaginator(\'/publicacao/ajaxFilter\', undefined, undefined, false, new Array(new Array(\'tp_situacao_publicacao\', \'' . PublicacaoEntity::CONST_TP_SITUACAO_PUBLICACAO_TODAS . '\')), \'no_publicacao\');');
	        $this->addButtonClear('clearValuesFromFieldsForm(); feedSelect(\'co_categoria\', \'subcategoria\');');
	        # O filter sempre ao fim do metodo.
	        $this->setInputFilter(new PublicacaoFilter());
	}
}
```
>> *A execução dos **Filter** por padrão deverá ser ao final dos métodos dos formulários conforme o exemplo acima.*
##### - Controller
```
public function indexAction()
{
	$form = $this->getForm();
	$form->prepareElementsFilter();
	return new View(array('form' => $form));
}
```

##### - View (phtml)
```
<?php echo $this->form()->render($this->form); ?>
```
####3.2.1 Executando os métodos da FormGenerator

#####3.2.1.1 Assinatura do método
```
# addText()
public function addText(
		$strName, 
		$strId = null, 
		$strLabel = null, 
		$strPlaceHolder = null, 
		$booRequired = false, 
		$strTitle = null, 
		$strClass = null, 
		$strStyle = null, 
		$strLabelClass = null, 
		$strLabelStyle = null, 
		$strHelpText = null, 
		$strTypeValidateMessage = null, 
		$strDisabled = null, 
		$strResource = null, 
		$strActionToResourceNotAllowed = null, 
		$intTabindex = null, 
		$arrAttributeData = null, 
		$strGroupClass = null, 
		$strGroupStyle = null, 
		$strMask = null, 
		$intMaxlength = null, 
		$strOnKeyUp = null, 
		$strReadonly = null, 
		$strPattern = null, 
		$arrSuggestion = null) 
{
	...
}
```
#####3.2.1.2 Parametrizado via array()
```
$this->addText(
         array(
              'name' => 'no_publicacao',
              'label' => 'Título da Publicação',
              'placeholder' => 'Texto de exibição.',
              'maxlength' => 100,
              'required' => true,
              'readonly' => 'readonly',
              'class' => 'onlynumbers',
              'disabled' => 'disabled'
          )
  );
```

#####3.2.1.3 Parametrizado via parâmetros
```
# Chamada do metodo
$this->addText(
		'Text', 
		'strValue', 
		'strId', 
		'strLabel', 
		true, 
		'strTitle', 
		'strClass', 
		'strStyle', 
		'strLabelClass', 
		'strLabelStyle', 
		'strHelpText', 
		'strTypeValidateMessage', 
		'strDisabled', 
		'strResource', 
		'strActionToResourceNotAllowed', 
		10, 
		array('strName', 'strId'), 
		'strGroupClass', 
		'strGroupStyle', 
		'9.9.9.9.9.9.9.9', 
		10, 
		'onKeyUp()', 
		'readonly', 
		'[A-Za-z]{3}', 
		array('Sugestion', 'Sugestion2');
```
####3.2.2 Métodos customizados

- Banco     
- Cnpj          
- DadoPessoal  	
- RegiaoUfMunicipio  	
- Image       
- Nacionalidade  	
- CorRaca       
- Editor       
- Float        	       
- Transfer
- Cep       
- Cpf           
- Email        
- Group     
- PisPasep  	
- DadoBancario  
- Endereco     	  
- OrgaoEmissor   	
- Table


<a id="referencia"></a> <i class="icon-unlink"></i> 4. Referência 
---

> http://desenvphp.inep.gov.br/apidoc/class-InepZend.FormGenerator.FormGenerator.html

