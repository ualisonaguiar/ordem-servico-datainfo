<?php

namespace InepZend\Module\Corporative\Entity;

use InepZend\Repository\Repository;

class CpfRepository extends Repository
{

    protected $arrMethodFetchPairs = array('getNuCpf', 'getNoPessoa');

}
