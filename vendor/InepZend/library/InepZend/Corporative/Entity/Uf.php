<?php

namespace InepZend\Corporative\Entity;

use InepZend\Module\Corporative\Entity\Uf as UfCorporativeModule;
use Doctrine\ORM\Mapping as ORM;

/**
 * Uf
 *
 * @ORM\Table(name="CORP.TC_UF")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\UfRepository")
 */
class Uf extends UfCorporativeModule
{

}
