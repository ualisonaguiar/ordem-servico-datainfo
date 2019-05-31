<?php

namespace InepZend\Module\TrocaArquivo\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * @ORM\Entity(repositoryClass="InepZend\Module\TrocaArquivo\Common\Entity\MassaTesteRepository")
 * @ORM\Table(name="tb_massa_teste")
 */
class MassaTeste extends Entity
{

    const STATUS_CO_AGUARDANDO_PROCESSAMENTO = 1;
    const STATUS_CO_EM_PROCESSAMENTO = 2;
    const STATUS_CO_CONCLUIDO = 3;
    const STATUS_CO_FALHA = 4;
    const STATUS_INATIVO = 0;
    const STATUS_ATIVO = 1;

    public static $arrStatusProcessamento = array(
        self::STATUS_CO_AGUARDANDO_PROCESSAMENTO => 'Aguardando Processamento',
        self::STATUS_CO_EM_PROCESSAMENTO => 'Em Processamento',
        self::STATUS_CO_CONCLUIDO => 'Concluído',
        self::STATUS_CO_FALHA => 'Falha'
    );
    public static $arrTipoMassa = array(
//        'R' => 'Dados de Massa Real',
        'A' => 'Dados de Massa Aleatória'
    );
    public static $arrStatus = array(
        self::STATUS_ATIVO => 'Ativo',
        self::STATUS_INATIVO => 'Inativo'
    );

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     * @@__toString
     */
    protected $id_massa_teste;

    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER")
     */
    protected $id_layout;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $nu_tipo_massa;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $nu_quantidade_linha;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $nu_status;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @var string
     */
    protected $in_ativo;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $dt_criacao;

    /**
     * Get id_massa_teste
     *
     * @return int
     */
    public function getIdMassaTeste()
    {
        return $this->id_massa_teste;
    }

    /**
     * Get id_layout
     *
     * @return object
     */
    public function getIdLayout()
    {
        return $this->id_layout;
    }

    /**
     * Get nu_tipo_massa
     *
     * @return string
     */
    public function getNuTipoMassa()
    {
        return $this->nu_tipo_massa;
    }

    /**
     * Get nu_quantidade_linha
     *
     * @return integer
     */
    public function getNuQuantidadeLinha()
    {
        return $this->nu_quantidade_linha;
    }

    /**
     * Get nu_status
     *
     * @return integer
     */
    public function getNuStatus()
    {
        return $this->nu_status;
    }

    /**
     * Get in_ativo
     *
     * @return integer
     */
    public function getInAtivo()
    {
        return $this->in_ativo;
    }

    /**
     * Get dt_criacao
     *
     * @return string
     */
    public function getDtCriacao()
    {
        return Date::convertDate($this->dt_criacao, 'd/m/Y H:i:s');
    }

    /**
     * Set id_massa_teste
     *
     * @param object
     */
    public function setIdMassaTeste($idMassaTeste)
    {
        $this->id_massa_teste = $idMassaTeste;
        return $this;
    }

    /**
     * Set id_layout
     *
     * @param \InepZend\Module\TrocaArquivo\Entity\Layout $idLayout
     * @return object
     */
    public function setIdLayout($idLayout)
    {
        $this->id_layout = $idLayout;
        return $this;
    }

    /**
     * Set nu_tipo_massa
     *
     * @param integer $nuTipoMassa
     * @return object
     */
    public function setNuTipoMassa($nuTipoMassa)
    {
        $this->nu_tipo_massa = $nuTipoMassa;
        return $this;
    }

    /**
     * Set nu_quantidade_linha
     *
     * @param type $nuQuantidadeLinha
     * @return \InepZend\Module\TrocaArquivo\Entity\MassaTeste
     */
    public function setNuQuantidadeLinha($nuQuantidadeLinha)
    {
        $this->nu_quantidade_linha = $nuQuantidadeLinha;
        return $this;
    }

    /**
     * Set nu_status
     *
     * @param type $nuStatutus
     * @return \InepZend\Module\TrocaArquivo\Entity\MassaTeste
     */
    public function setNuStatus($nuStatutus)
    {
        $this->nu_status = $nuStatutus;
        return $this;
    }

    /**
     * Set dt_criacao
     *
     * @param string $dtCriacao
     * @return \InepZend\Module\TrocaArquivo\Entity\MassaTeste
     */
    public function setDtCriacao($dtCriacao)
    {
        $this->dt_criacao = $dtCriacao;
        return $this;
    }

    /**
     * Set in_ativo
     *
     * @param string $inAtivo
     * @return \InepZend\Module\TrocaArquivo\Entity\MassaTeste
     */
    public function setInAtivo($inAtivo)
    {
        $this->in_ativo = $inAtivo;
        return $this;
    }

}
