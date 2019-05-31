#!/bin/bash

# Para qualquer duvida referente ao ApiGen devera consultar o manual do ApiGen, localizado em: http://svn.inep.gov.br/svn/DESENV/INEP/ARQUITETURA_PHP/INEPSKELETON/trunk/Docs/Analise/Manual/
# Devera ser passado como parametro o local onde devera ser gerado os HTMLs: 
# Exemplo: geradorApidoc.sh "/home/Documentos/ApiDoc/"

apigen --source ../library/InepZend/ --destination $1
