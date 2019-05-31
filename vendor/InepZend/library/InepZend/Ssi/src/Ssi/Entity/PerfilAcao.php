<?php

namespace InepZend\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="InepZend\Ssi\Entity\PerfilAcaoRepository")
 * @ORM\Table(name="ssi.vw_perfil_acao")
 */
class PerfilAcao extends Entity
{

    const ACAO_DEFAUT_SSI = 'ACAO_PADRAO_CRIACAO_SISTEMA';

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="InepZend\Ssi\Entity\Perfil", inversedBy="perfisAcao")
     * @ORM\JoinColumn(name="id_perfil", referencedColumnName="id_perfil")
     */
    protected $perfil;

//    /**
//     * @ORM\Id
//     * @ORM\Column(type="integer", columnDefinition="NUMBER(14)")
//     * @var int
//     */
//    protected $id_perfil;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(120)")
     * @var string
     */
    protected $no_perfil;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(512)")
     * @var string
     */
    protected $ds_perfil;

    /**
     * @ORM\Column(type="integer", columnDefinition="NUMBER(14)")
     * @var int
     */
    protected $id_perfil_pai;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(50)")
     * @var string
     */
    protected $no_tipo_perfil;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", columnDefinition="NUMBER(14)")
     * @var int
     */
    protected $id_acao;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(120)")
     * @var string
     */
    protected $no_acao;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(50)")
     * @var string
     */
    protected $sg_acao;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(512)")
     * @var string
     */
    protected $ds_acao;

    /**
     * @ORM\Column(type="integer", columnDefinition="NUMBER(5)")
     * @var int
     */
    protected $id_sistema;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR2(20)")
     * @var string
     */
    protected $no_sistema;

    /**
     * @ORM\Column(type="integer", columnDefinition="NUMBER(1)")
     * @var int
     */
    protected $in_ativo_perfil_acao;

    public function getPerfil()
    {
        return $this->perfil;
    }

    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
        return $this;
    }

    public function getIdPerfil()
    {
//        return $this->id_perfil;
        return $this->getPerfil()->getIdPerfil();
    }

//    public function setIdPerfil($id_perfil)
//    {
//        $this->id_perfil = (integer) $id_perfil;
//        return $this;
//    }

    public function getNoPerfil()
    {
        return $this->no_perfil;
    }

    public function setNoPerfil($no_perfil)
    {
        $this->no_perfil = $no_perfil;
        return $this;
    }

    public function getDsPerfil()
    {
        return $this->ds_perfil;
    }

    public function setDsPerfil($ds_perfil)
    {
        $this->ds_perfil = $ds_perfil;
        return $this;
    }

    public function getIdPerfilPai()
    {
        return $this->id_perfil_pai;
    }

    public function setIdPerfilPai($id_perfil_pai)
    {
        $this->id_perfil_pai = (integer) $id_perfil_pai;
        return $this;
    }

    public function getNoTipoPerfil()
    {
        return $this->no_tipo_perfil;
    }

    public function setNoTipoPerfil($no_tipo_perfil)
    {
        $this->no_tipo_perfil = $no_tipo_perfil;
        return $this;
    }

    public function getIdAcao()
    {
        return $this->id_acao;
    }

    public function setIdAcao($id_acao)
    {
        $this->id_acao = (integer) $id_acao;
        return $this;
    }

    public function getNoAcao()
    {
        return $this->no_acao;
    }

    public function setNoAcao($no_acao)
    {
        $this->no_acao = $no_acao;
        return $this;
    }

    public function getSgAcao()
    {
        return $this->sg_acao;
    }

    public function setSgAcao($sg_acao)
    {
        $this->sg_acao = strtolower($sg_acao);
        return $this;
    }

    public function getDsAcao()
    {
        return $this->ds_acao;
    }

    public function setDsAcao($ds_acao)
    {
        $this->ds_acao = $ds_acao;
        return $this;
    }

    public function getIdSistema()
    {
        return $this->id_sistema;
    }

    public function setIdSistema($id_sistema)
    {
        $this->id_sistema = (integer) $id_sistema;
        return $this;
    }

    public function getNoSistema()
    {
        return $this->no_sistema;
    }

    public function setNoSistema($no_sistema)
    {
        $this->no_sistema = $no_sistema;
        return $this;
    }

    public function getInAtivoPerfilAcao()
    {
        return $this->in_ativo_perfil_acao;
    }

    public function setInAtivoPerfilAcao($in_ativo_perfil_acao)
    {
        $this->in_ativo_perfil_acao = $in_ativo_perfil_acao;
        return $this;
    }

    public function __toString()
    {
        return $this->no_acao;
    }

    public function toArray()
    {
        return array(
            'perfil' => $this->getPerfil()->getIdPerfil(),
//            'id_perfil' => $this->getIdPerfil(),
            'no_perfil' => $this->getNoPerfil(),
            'ds_perfil' => $this->getDsPerfil(),
            'id_perfil_pai' => $this->getIdPerfilPai(),
            'no_tipo_perfil' => $this->getNoTipoPerfil(),
            'id_acao' => $this->getIdAcao(),
            'no_acao' => $this->getNoAcao(),
            'sg_acao' => $this->getSgAcao(),
            'ds_acao' => $this->getDsAcao(),
            'id_sistema' => $this->getIdSistema(),
            'no_sistema' => $this->getNoSistema(),
            'in_ativo_perfil_acao' => $this->getInAtivoPerfilAcao(),
        );
    }

}
