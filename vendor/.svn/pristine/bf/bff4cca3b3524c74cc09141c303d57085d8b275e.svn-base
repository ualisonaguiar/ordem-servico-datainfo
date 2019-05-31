<?php

namespace InepZend\Module\TrocaArquivo\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\TrocaArquivo\Common\Entity\ConfiguracaoContatoRepository")
 * @ORM\Table(name="tb_configuracao_contato")
 */
class ConfiguracaoContato extends Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     * @@__toString
     */
    protected $id_contato;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @var int
     */
    protected $id_configuracao;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(255)")
     * @var string
     */
    protected $ds_email;

    public function getIdContato()
    {
        return $this->id_contato;
    }

    public function setIdContato($intIdContato = null)
    {
        $this->id_contato = (is_numeric($intIdContato)) ? (integer) $intIdContato : $intIdContato;
        return $this;
    }

    public function getIdConfiguracao()
    {
        return $this->id_configuracao;
    }

    public function setIdConfiguracao($intIdConfiguracao = null)
    {
        $this->id_configuracao = (is_numeric($intIdConfiguracao)) ? (integer) $intIdConfiguracao : $intIdConfiguracao;
        return $this;
    }

    public function getDsEmail()
    {
        return $this->ds_email;
    }

    public function setDsEmail($strDsEmail = null)
    {
        $this->ds_email = $strDsEmail;
        return $this;
    }

}
