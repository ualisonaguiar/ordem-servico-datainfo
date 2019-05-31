<?php

namespace InepZend\Module\TrocaArquivo\Common\Entity;

use InepZend\Repository\AbstractRepository;

class ResponsavelRepository extends AbstractRepository
{

    protected $arrMethodFetchPairs = array('getIdResponsavel', 'getIdUsuarioSistema');

}
