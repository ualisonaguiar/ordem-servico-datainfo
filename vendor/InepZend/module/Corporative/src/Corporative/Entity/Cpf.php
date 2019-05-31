<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Cpf
 *
 * @ORM\Table(name="CORP.VW_CPF")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\CpfRepository")
 */
class Cpf extends Entity
{

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CPF", type="string", length=11, nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $nuCpf;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PESSOA", type="string", length=60, nullable=true)
     */
    protected $noPessoa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_NASCIMENTO", type="string", nullable=true)
     */
    protected $dtNascimento;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_SEXO", type="string", length=1, nullable=true)
     */
    protected $sgSexo;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_MAE", type="string", length=60, nullable=false)
     */
    protected $noMae;

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
     * @@__toString
     *
     * @return string 
     */
    public function getNoPessoa()
    {
        return $this->noPessoa;
    }

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
        return \InepZend\Util\Date::convertDate($this->dtNascimento, 'd/m/Y');
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

}
