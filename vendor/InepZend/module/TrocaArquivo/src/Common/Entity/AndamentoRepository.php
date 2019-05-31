<?php

namespace InepZend\Module\TrocaArquivo\Common\Entity;

use InepZend\Repository\AbstractRepository;

class AndamentoRepository extends AbstractRepository
{

    protected $arrMethodFetchPairs = array('getIdAndamento', 'getTpAndamento');

}
