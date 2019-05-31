<?php

namespace DoctrineORMModule\Proxy\__CG__\OrdemServico\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Demanda extends \OrdemServico\Entity\Demanda implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'id_demanda', 'dt_abertura', 'no_demanda', 'ds_descricao', 'no_projeto', 'ds_ambiente', 'ds_solucao', 'id_atividade', 'id_demanda_superior', 'no_executor', 'tp_situacao', 'id_usuario_alteracao', 'id_usuario', 'dt_alteracao');
        }

        return array('__isInitialized__', 'id_demanda', 'dt_abertura', 'no_demanda', 'ds_descricao', 'no_projeto', 'ds_ambiente', 'ds_solucao', 'id_atividade', 'id_demanda_superior', 'no_executor', 'tp_situacao', 'id_usuario_alteracao', 'id_usuario', 'dt_alteracao');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Demanda $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getIdDemanda()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdDemanda', array());

        return parent::getIdDemanda();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdDemanda($intIdDemanda = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdDemanda', array($intIdDemanda));

        return parent::setIdDemanda($intIdDemanda);
    }

    /**
     * {@inheritDoc}
     */
    public function getDtAbertura()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDtAbertura', array());

        return parent::getDtAbertura();
    }

    /**
     * {@inheritDoc}
     */
    public function setDtAbertura($strDtAbertura = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDtAbertura', array($strDtAbertura));

        return parent::setDtAbertura($strDtAbertura);
    }

    /**
     * {@inheritDoc}
     */
    public function getNoDemanda()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNoDemanda', array());

        return parent::getNoDemanda();
    }

    /**
     * {@inheritDoc}
     */
    public function setNoDemanda($strNoDemanda = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNoDemanda', array($strNoDemanda));

        return parent::setNoDemanda($strNoDemanda);
    }

    /**
     * {@inheritDoc}
     */
    public function getDsDescricao()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDsDescricao', array());

        return parent::getDsDescricao();
    }

    /**
     * {@inheritDoc}
     */
    public function setDsDescricao($strDsDescricao = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDsDescricao', array($strDsDescricao));

        return parent::setDsDescricao($strDsDescricao);
    }

    /**
     * {@inheritDoc}
     */
    public function getDsSolucao()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDsSolucao', array());

        return parent::getDsSolucao();
    }

    /**
     * {@inheritDoc}
     */
    public function setDsSolucao($strDsSolucao = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDsSolucao', array($strDsSolucao));

        return parent::setDsSolucao($strDsSolucao);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdAtividade()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdAtividade', array());

        return parent::getIdAtividade();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdAtividade($intIdAtividade = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdAtividade', array($intIdAtividade));

        return parent::setIdAtividade($intIdAtividade);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdDemandaSuperior()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdDemandaSuperior', array());

        return parent::getIdDemandaSuperior();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdDemandaSuperior($intIdDemandaSuperior = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdDemandaSuperior', array($intIdDemandaSuperior));

        return parent::setIdDemandaSuperior($intIdDemandaSuperior);
    }

    /**
     * {@inheritDoc}
     */
    public function getNoExecutor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNoExecutor', array());

        return parent::getNoExecutor();
    }

    /**
     * {@inheritDoc}
     */
    public function setNoExecutor($strNoExecutor = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNoExecutor', array($strNoExecutor));

        return parent::setNoExecutor($strNoExecutor);
    }

    /**
     * {@inheritDoc}
     */
    public function getTpSituacao()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTpSituacao', array());

        return parent::getTpSituacao();
    }

    /**
     * {@inheritDoc}
     */
    public function setTpSituacao($intTpSituacao = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTpSituacao', array($intTpSituacao));

        return parent::setTpSituacao($intTpSituacao);
    }

    /**
     * {@inheritDoc}
     */
    public function getNoProjeto()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNoProjeto', array());

        return parent::getNoProjeto();
    }

    /**
     * {@inheritDoc}
     */
    public function setNoProjeto($strNoProjeto = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNoProjeto', array($strNoProjeto));

        return parent::setNoProjeto($strNoProjeto);
    }

    /**
     * {@inheritDoc}
     */
    public function getDsAmbiente()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDsAmbiente', array());

        return parent::getDsAmbiente();
    }

    /**
     * {@inheritDoc}
     */
    public function setDsAmbiente($strDsAmbiente = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDsAmbiente', array($strDsAmbiente));

        return parent::setDsAmbiente($strDsAmbiente);
    }

    /**
     * {@inheritDoc}
     */
    public function getSituacao()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSituacao', array());

        return parent::getSituacao();
    }

    /**
     * {@inheritDoc}
     */
    public function getIdUsuarioAlteracao()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdUsuarioAlteracao', array());

        return parent::getIdUsuarioAlteracao();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdUsuarioAlteracao($id_usuario_alteracao)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdUsuarioAlteracao', array($id_usuario_alteracao));

        return parent::setIdUsuarioAlteracao($id_usuario_alteracao);
    }

    /**
     * {@inheritDoc}
     */
    public function getDtAlteracao()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDtAlteracao', array());

        return parent::getDtAlteracao();
    }

    /**
     * {@inheritDoc}
     */
    public function setDtAlteracao($dt_alteracao)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDtAlteracao', array($dt_alteracao));

        return parent::setDtAlteracao($dt_alteracao);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdUsuario()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdUsuario', array());

        return parent::getIdUsuario();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdUsuario($id_usuario)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdUsuario', array($id_usuario));

        return parent::setIdUsuario($id_usuario);
    }

    /**
     * {@inheritDoc}
     */
    public function getAttribute($strAttribute = NULL, $strType = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAttribute', array($strAttribute, $strType));

        return parent::getAttribute($strAttribute, $strType);
    }

    /**
     * {@inheritDoc}
     */
    public function setAttribute($strAttribute = NULL, $mixValue = NULL, $strType = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAttribute', array($strAttribute, $mixValue, $strType));

        return parent::setAttribute($strAttribute, $mixValue, $strType);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', array());

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(array $arrAttributeNotIn = array (
), $mixEntity = NULL, $intDeep = 0, $intMaxDeep = 1)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toArray', array($arrAttributeNotIn, $mixEntity, $intDeep, $intMaxDeep));

        return parent::toArray($arrAttributeNotIn, $mixEntity, $intDeep, $intMaxDeep);
    }

    /**
     * {@inheritDoc}
     */
    public function convertToIndicator($mixValue = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'convertToIndicator', array($mixValue));

        return parent::convertToIndicator($mixValue);
    }

    /**
     * {@inheritDoc}
     */
    public function __call($strFunction, $arrArgument)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__call', array($strFunction, $arrArgument));

        return parent::__call($strFunction, $arrArgument);
    }

}
