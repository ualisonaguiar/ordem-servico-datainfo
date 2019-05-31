<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistoricoLogin
 *
 * @ORM\Table(name="CORP.TC_HISTORICO_LOGIN")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\HistoricoLoginRepository")
 */
class HistoricoLogin extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_HISTORICO_LOGIN", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_HISTORICO_LOGIN_CO_HISTORIC", allocationSize=1, initialValue=1)
     */
    protected $coHistoricoLogin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_LOGIN", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtLogin;

    /**
     * @var \InepZend\Module\Corporative\Entity\Sistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Sistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_SISTEMA", referencedColumnName="CO_SISTEMA")
     * })
     */
    protected $coSistema;

    /**
     * @var \InepZend\Module\Corporative\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_USUARIO", referencedColumnName="CO_USUARIO")
     * })
     */
    protected $coUsuario;


    /**
     * Get coHistoricoLogin
     *
     * @return integer 
     */
    public function getCoHistoricoLogin()
    {
        return $this->coHistoricoLogin;
    }

    /**
     * Set dtLogin
     *
     * @param \DateTime $dtLogin
     *
     * @return HistoricoLogin
     */
    public function setDtLogin($dtLogin)
    {
        $this->dtLogin = $dtLogin;
        return $this;
    }

    /**
     * Get dtLogin
     *
     * @return \DateTime 
     */
    public function getDtLogin()
    {
        return Date::convertDate($this->dtLogin, "d/m/Y");
    }

    /**
     * Set coSistema
     *
     * @param \InepZend\Module\Corporative\Entity\Sistema $coSistema
     *
     * @return HistoricoLogin
     */
    public function setCoSistema(\InepZend\Module\Corporative\Entity\Sistema $coSistema = null)
    {
        $this->coSistema = $coSistema;
        return $this;
    }

    /**
     * Get coSistema
     *
     * @return \InepZend\Module\Corporative\Entity\Sistema 
     */
    public function getCoSistema()
    {
        return $this->coSistema;
    }

    /**
     * Set coUsuario
     *
     * @param \InepZend\Module\Corporative\Entity\Usuario $coUsuario
     *
     * @return HistoricoLogin
     */
    public function setCoUsuario(\InepZend\Module\Corporative\Entity\Usuario $coUsuario = null)
    {
        $this->coUsuario = $coUsuario;
        return $this;
    }

    /**
     * Get coUsuario
     *
     * @return \InepZend\Module\Corporative\Entity\Usuario 
     */
    public function getCoUsuario()
    {
        return $this->coUsuario;
    }
}

