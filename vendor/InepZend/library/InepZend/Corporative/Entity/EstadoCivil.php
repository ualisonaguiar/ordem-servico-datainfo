<?php

namespace InepZend\Corporative\Entity;

use InepZend\Module\Corporative\Entity\EstadoCivil as EstadoCivilCorporativeModule;
use Doctrine\ORM\Mapping as ORM;

/**
 * EstadoCivil
 *
 * @ORM\Table(name="CORP.TC_ESTADO_CIVIL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\EstadoCivilRepository")
 */
class EstadoCivil extends EstadoCivilCorporativeModule
{


}
