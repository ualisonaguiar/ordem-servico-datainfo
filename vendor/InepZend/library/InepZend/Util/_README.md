**<i class="icon-folder-open"></i> Util**
===

<i class="icon-list"></i>1. Índice
---

[TOC]

<a id="definicao"></a>
<i class="icon-th"></i> 2. Definição
---
###<i class="icon-pencil"></i> 2.1. Conceito
> *Util* é uma biblioteca disponibilizada no **InepZend** na qual contém classes especializadas que facilitam o desenvolvimento de funcionalidades, podendo ser utilizadas em camadas onde sejam necessárias a suas utilizações.

___

<a id="principais-caracteristicas"></a>
###<i class="icon-info"></i>2.2. Principais características

- As chamadas dos métodos são sempre estáticas <kbd>::</kbd>:
 
```
\InepZend\Util\Date::isDate('18/07/2014', 'template');
```
- As classes são divididas e especializadas por assunto.
	- Ex.: ***\InepZend\Util\Data**, faz manipulação somente de datas.*

- A classe ***\InepZend\Util\Library*** referencia **todos** os métodos contidos nas classes especializadas da Util. Por questão de performance (memória) é sugerido o uso do método da classe especializada e não da \InepZend\Util\Library.

- Além de métodos de classe, também possui funções divididas por assunto e que podem ser utilizadas na aplicação:
 
```
// Funcao em InepZend/Util/Functions/FileSytem.php
showFile('data/arquivo.txt');
```

___
<a id="namespace"></a>
####<i class="icon-sitemap"></i> 2.2.1. Namespace
> - \InepZend\Util

___

<a id="apidoc"></a>
###<i class="icon-book"></i> 2.3. APIDoc/UnitTest
> - APIDoc
>> http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.Util.html

> - UnitTest
>> http://desenvphp.inep.gov.br/apidoc/namespace-InepZend.Util.html <br />
**Obs.:** Para cada classe da **Util** tem seu teste unitário com o sufixo "**test**" ou "**SpecificTest**".

___

<a id="como-usar"></a>
<i class="icon-terminal"></i> 3. Como usar
---

> Os exemplos da utilização de cada método estão contidos em seus comentários após a *annotation* **@example** e nas classes de teste:
> 
> ```
> // @example \InepZend\Util\ApplicationInfo::getApplicationInfo();
> ```    

---