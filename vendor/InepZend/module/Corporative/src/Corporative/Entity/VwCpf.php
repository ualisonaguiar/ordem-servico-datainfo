<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Cpf
 *
 * @ORM\Table(name="CORP.VW_CPF")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwCpfRepository")
 */
class VwCpf extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_NASCIMENTO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtNascimento;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_MAE", type="string", length=60, nullable=true)
     */
    protected $noMae;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PESSOA", type="string", length=60, nullable=true)
     */
    protected $noPessoa;

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="NU_CPF", type="string", length=11, nullable=true)
     */
    protected $nuCpf;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_SEXO", type="string", length=1, nullable=true)
     */
    protected $sgSexo;


    /**
     * Set dtNascimento
     *
     * @param \DateTime $dtNascimento
     *
     * @return Cpf
     */
    public function setDtNascimento($dtNascimento)
    {
        $this->dtNascimento = $dtNascimento;
        return $this;
    }

    /**
     * Get dtNascimento
     *
     * @return \DateTime 
     */
    public function getDtNascimento()
    {
        return Date::convertDate($this->dtNascimento, "d/m/Y");
    }

    /**
     * Set noMae
     *
     * @param string $noMae
     *
     * @return Cpf
     */
    public function setNoMae($noMae)
    {
        $this->noMae = $noMae;
        return $this;
    }

    /**
     * Get noMae
     *
     * @return string 
     */
    public function getNoMae()
    {
        return $this->noMae;
    }

    /**
     * Set noPessoa
     *
     * @param string $noPessoa
     *
     * @return Cpf
     */
    public function setNoPessoa($noPessoa)
    {
        $this->noPessoa = $noPessoa;
        return $this;
    }

    /**
     * Get noPessoa
     *
     * @return string 
     */
    public function getNoPessoa()
    {
        return $this->noPessoa;
    }

    /**
     * Set nuCpf
     *
     * @param string $nuCpf
     *
     * @return Cpf
     */
    public function setNuCpf($nuCpf)
    {
        $this->nuCpf = $nuCpf;
        return $this;
    }

    /**
     * Get nuCpf
     *
     * @return string 
     */
    public function getNuCpf()
    {
        return $this->nuCpf;
    }

    /**
     * Set sgSexo
     *
     * @param string $sgSexo
     *
     * @return Cpf
     */
    public function setSgSexo($sgSexo)
    {
        $this->sgSexo = $sgSexo;
        return $this;
    }

    /**
     * Get sgSexo
     *
     * @return string 
     */
    public function getSgSexo()
    {
        return $this->sgSexo;
    }
}

