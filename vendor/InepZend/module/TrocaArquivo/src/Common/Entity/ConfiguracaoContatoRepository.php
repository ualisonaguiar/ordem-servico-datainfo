<?php

namespace InepZend\Module\TrocaArquivo\Common\Entity;

use InepZend\Repository\AbstractRepository;

class ConfiguracaoContatoRepository extends AbstractRepository
{

    protected $arrMethodFetchPairs = array('getIdContato', 'getDsEmail');

}
