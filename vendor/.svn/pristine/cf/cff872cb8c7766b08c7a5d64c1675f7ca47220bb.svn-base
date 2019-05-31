<?php

namespace InepZend\Module\Ssi\Controller;

use InepZend\Controller\AbstractControllerForm;
use InepZend\Module\Ssi\Form\PersonalInfo;
use InepZend\View\View;
use InepZend\Module\Ssi\Form\PersonalInfoCompare;

class PersonalInfoController extends AbstractControllerForm
{

    public function indexAction()
    {
        $form = new PersonalInfo();
        $form->prepareElementsEditMyInfo();
        $arrPost = $this->getPostOauth();
        if (!empty($arrPost)) {
            $form->setData($arrPost);
            if ($form->isValid()) {
                $arrResult = $this->getService()->editMyInfo($form->getData());
                if (strtoupper(@$arrResult['status']) === 'OK')
                    $this->getServiceMessage()->addMessageSuccess(self::MESSAGE_SUCCESS);
                else
                    $this->getServiceMessage()->addMessageValidate($arrResult['messages']);
            } else
                $this->getServiceMessage()->addMessageValidate(self::MESSAGE_VALIDATE, $form);
        }
        $arrDataFromIdentity = $this->getService()->getDataFromIdentity();
        $form->setData($arrDataFromIdentity);
        $formPersonalInfoCompare = new PersonalInfoCompare();
        $formPersonalInfoCompare->prepareElementsCompareInfo();
        $formPersonalInfoCompare->setData($arrDataFromIdentity);
        return new View(array('form' => $form, 'formPersonalInfoCompare' => $formPersonalInfoCompare));
    }

    public function ajaxGetDataReceitaFederalAction()
    {
        return $this->getViewClearContent($this->keepDataPersonalReceita('getDataReceitaFederal'));
    }

    public function ajaxSaveDataAction()
    {
        return $this->getViewClearContent($this->keepDataPersonalReceita('setDataPessoaFisicaReceitaFederal'));
    }

    protected function keepDataPersonalReceita($strMethod)
    {
        try {
            $arrDataPersonal = array('status' => true);
            if ($this->isPost())
                $arrDataPersonal['data'] = $this->getService()->$strMethod($this->getIdentity()->usuarioSistema->usuario->cpf);
        } catch (Exception $exception) {
            $arrDataPersonal['status'] = false;
            $arrDataPersonal['message'] = $exception->getMessage();
        }
        return json_encode($arrDataPersonal);
    }

}
