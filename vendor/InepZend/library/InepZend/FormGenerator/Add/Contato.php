<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular Elemens para Contato.
 */
trait Contato
{

    /**
     * Metodo responsavel em inserir os Elements para Contato, sendo esses 
     * TELEFONE FIXO, CELULAR 1, CONFIRME O CELULAR, CELULAR 2, EMAIL e CONFIRME
     * O EMAIL.
     * 
     * @param string $strLabel
     * @param array $arrPlaceHolder
     * @param array $arrRequired
     * @param string $strTypeValidateMessage
     * @param array $arrDisabled
     * @param array $arrResource
     * @param string $strActionToResourceNotAllowed
     * @param array $arrReadonly
     * @param array $arrNotShow
     * @param array $arrAttributeData
     */
    public function addContato($strLabel = null, $arrPlaceHolder = null, $arrRequired = null, $strTypeValidateMessage = null, $arrDisabled = null, $arrResource = null, $strActionToResourceNotAllowed = null, $arrReadonly = null, $arrNotShow = null, $arrAttributeData = null)
    {
        $arrParamExtra = array(
            array('readonly', 'strReadonly'),
            array('not_show', 'arrNotShow'),
            array('attr_data', 'arrAttributeData'),
        );
        $arrParam = $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false, $this->removeParamDefault(array(0, 1, 2, 6, 7, 8, 9, 10, 11, 16, 17, 18, 19)));
        $arrParam['type'] = 'Contato';
        $strLabel = @$arrParam['label'];
        if (empty($strLabel))
            $strLabel = 'Contato';
        $arrNotShow = @$arrParam['not_show'];
        if (!is_array($arrNotShow))
            $arrNotShow = array();
        if (!is_bool(@$arrNotShow['nu_telefone_movel2']))
            $arrNotShow['nu_telefone_movel2'] = true;
        $arrParam['not_show'] = $arrNotShow;
        return $this->addGroup($arrParam, self::getElementToContato(), $strLabel);
    }

    /**
     * Metodo responsavel em retornar um array com os Elements que serao utilizados
     * para o Contato.
     * 
     * @return array
     */
    public static function getElementToContato()
    {
        return array(
            'nu_telefone_fixo' => array(
                'type' => 'Phone',
                'label' => 'Telefone Fixo',
                'placeholder' => 'Entre com o Telefone Fixo',
                'ddd' => true,
            ),
            'nu_telefone_movel' => array(
                'type' => 'Phone',
                'label' => 'Celular',
                'placeholder' => 'Entre com o Celular',
                'ddd' => true,
            ),
            'nu_telefone_movel_confirmacao' => array(
                'type' => 'Phone',
                'label' => 'Confirme o Celular',
                'placeholder' => 'Confirme o Celular',
                'ddd' => true,
                'attr_data' => ['validate-confirmacao-telefone' => 'nu_telefone_movel']
            ),
            'nu_telefone_movel2' => array(
                'type' => 'Phone',
                'label' => 'Celular 2',
                'placeholder' => 'Entre com o Celular 2',
                'ddd' => true,
            ),
            'ds_email' => array(
                'type' => 'Email',
                'maxlength' => 255,
                'style' => 'float: left;',
                'group_style' => 'width: 50.5%;',
            ),
            'ds_email_confirmacao' => array(
                'type' => 'Email',
                'label' => 'Confirme o E-mail',
                'placeholder' => 'Entre com a Confirmação do E-mail',
                'maxlength' => 255,
                'attr_data' => ['validate-confirmacao-email' => 'ds_email']
            ),
        );
    }

    public function editGroupContato($arrParam = null, &$arrElement = null)
    {
        if ((@$arrParam['type'] == 'Contato') && ($this->getParamValue($arrParam, 'not_show', 'nu_telefone_movel') !== true) && ($this->getParamValue($arrParam, 'not_show', 'nu_telefone_movel2') !== true)) {
            $arrElement['nu_telefone_movel']['label'] .= ' 1';
            $arrElement['nu_telefone_movel']['placeholder'] .= ' 1';
        }
        return $this;
    }

}