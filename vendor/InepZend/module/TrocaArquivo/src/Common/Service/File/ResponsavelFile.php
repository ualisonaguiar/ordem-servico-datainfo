<?php

namespace InepZend\Module\TrocaArquivo\Common\Service\File;

use InepZend\Module\TrocaArquivo\Common\Service\File\AbstractServiceFile;
use InepZend\Util\ArrayCollection;
use InepZend\Exception\DomainException;
use InepZend\Exception\RuntimeException;

class ResponsavelFile extends AbstractServiceFile
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('id_responsavel');
    }

    protected function getPersonalInfo(array $arrCriteria = array())
    {
        $identity = $this->getIdentity();
        if (!is_object($identity))
            throw new RuntimeException('Usuário não autenticado.');
        $arrCriteria = ArrayCollection::merge($arrCriteria, array('id_usuario_sistema' => $identity->usuarioSistema->id));
        $arrResponsavel = $this->findBy($arrCriteria);
        if ((empty($arrResponsavel)) && (array_key_exists('sg_uf', $arrCriteria))) {
            $arrCriteria['sg_uf'] = 'BR';
            $arrResponsavel = $this->findBy($arrCriteria);
        }
        if (empty($arrResponsavel))
            throw new DomainException('Usuário não é um responsável por envio de dados.');
        return $arrResponsavel;
    }

}
