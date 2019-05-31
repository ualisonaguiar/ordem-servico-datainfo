<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * PessoaJuridica
 *
 * @ORM\Table(name="CORP.TC_PESSOA_JURIDICA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\PessoaJuridicaRepository")
 */
class PessoaJuridica extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_PESSOA_JURIDICA", type="string", length=250, nullable=true)
     */
    protected $dsPessoaJuridica;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_JURIDICA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_PESSOA_JURIDICA_ID_PESSOA_J", allocationSize=1, initialValue=1)
     */
    protected $idPessoaJuridica;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_FANTASIA", type="string", length=150, nullable=true)
     */
    protected $noFantasia;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_RAZAO_SOCIAL", type="string", length=150, nullable=false)
     */
    protected $noRazaoSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CNPJ", type="string", length=14, nullable=false)
     */
    protected $nuCnpj;


    /**
     * Set dsPessoaJuridica
     *
     * @param string $dsPessoaJuridica
     *
     * @return PessoaJuridica
     */
    public function setDsPessoaJuridica($dsPessoaJuridica)
    {
        $this->dsPessoaJuridica = $dsPessoaJuridica;
        return $this;
    }

    /**
     * Get dsPessoaJuridica
     *
     * @return string 
     */
    public function getDsPessoaJuridica()
    {
        return $this->dsPessoaJuridica;
    }

    /**
     * Get idPessoaJuridica
     *
     * @return integer 
     */
    public function getIdPessoaJuridica()
    {
        return $this->idPessoaJuridica;
    }

    /**
     * Set noFantasia
     *
     * @param string $noFantasia
     *
     * @return PessoaJuridica
     */
    public function setNoFantasia($noFantasia)
    {
        $this->noFantasia = $noFantasia;
        return $this;
    }

    /**
     * Get noFantasia
     *
     * @return string 
     */
    public function getNoFantasia()
    {
        return $this->noFantasia;
    }

    /**
     * Set noRazaoSocial
     *
     * @param string $noRazaoSocial
     *
     * @return PessoaJuridica
     */
    public function setNoRazaoSocial($noRazaoSocial)
    {
        $this->noRazaoSocial = $noRazaoSocial;
        return $this;
    }

    /**
     * Get noRazaoSocial
     *
     * @return string 
     */
    public function getNoRazaoSocial()
    {
        return $this->noRazaoSocial;
    }

    /**
     * Set nuCnpj
     *
     * @param string $nuCnpj
     *
     * @return PessoaJuridica
     */
    public function setNuCnpj($nuCnpj)
    {
        $this->nuCnpj = $nuCnpj;
        return $this;
    }

    /**
     * Get nuCnpj
     *
     * @return string 
     */
    public function getNuCnpj()
    {
        return $this->nuCnpj;
    }
}

