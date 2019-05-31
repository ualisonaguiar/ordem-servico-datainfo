<?php

namespace OrdemServico\Form;

use InepZend\FormGenerator\FormGenerator;
use OrdemServico\Entity\OrdemServicoAceite as OrdemServicoAceiteEntity;

class OrdemServicoAceite extends FormGenerator
{
    public function prepareElementsFilter()
    {
        $serviceProfile = $this->getService('OrdemServico\Service\Profile');
        $arrGestao = OrdemServicoAceiteEntity::$arrGestao;
        $arrCheckBox = [];
        if ($serviceProfile->hasUsuarioPreposto()) {
            $arrCheckBox[OrdemServicoAceiteEntity::CO_ACEITE_PREPOSTO] = $arrGestao[OrdemServicoAceiteEntity::CO_ACEITE_PREPOSTO];
        }
        if ($serviceProfile->hasUsuarioServidor()) {
            $arrCheckBox[OrdemServicoAceiteEntity::CO_ACEITE_FISCAL_TECNICO] = $arrGestao[OrdemServicoAceiteEntity::CO_ACEITE_FISCAL_TECNICO];
            $arrCheckBox[OrdemServicoAceiteEntity::CO_ACEITE_FISCAL_REQUISITANTE] = $arrGestao[OrdemServicoAceiteEntity::CO_ACEITE_FISCAL_REQUISITANTE];
        }
        if ($serviceProfile->hasUsuarioGestorContrato()) {
            $arrCheckBox[OrdemServicoAceiteEntity::CO_ACEITE_GESTOR_CONTRATO] = $arrGestao[OrdemServicoAceiteEntity::CO_ACEITE_GESTOR_CONTRATO];
        }
        $this->addMultiCheckbox([
            'name' => 'in_gestao',
            'value_options' => $arrCheckBox
        ]);
        $this->addButton([
            'name' => 'btnCancelar',
            'value' => 'Cancelar'
        ]);
        $this->addButton([
            'name' => 'btnConfirmarLote',
            'value' => 'Aceite de OS em lote'
        ]);
    }

}
