<?php
namespace InepZend\Module\TrocaArquivo\Common\Service\File;

use InepZend\Module\TrocaArquivo\Common\Service\File\AbstractServiceFile;
use InepZend\Paginator\Paginator;
use InepZend\Util\Format;
use InepZend\Exception\Exception;
use InepZend\Exception\DomainException;

class LayoutFile extends AbstractServiceFile
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array(
            'id_layout'
        );
    }

    public static function getNameFromIdLayout($intIdLayout = null)
    {
        return self::getInfoFromIdLayout($intIdLayout, 'getNoLayout');
    }

    public static function getStatusFromIdLayout($intIdLayout = null)
    {
        return Format::convertToStatus(self::getInfoFromIdLayout($intIdLayout, 'getInStatus'));
    }

    private static function getInfoFromIdLayout($intIdLayout = null, $strMethod = null)
    {
        if ((empty($intIdLayout)) || (empty($strMethod)))
            return false;
        $layout = self::getServiceManager()->get('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->find((integer) $intIdLayout);
        if (! is_object($layout))
            return $intIdLayout;
        return $layout->$strMethod();
    }

    public function getLayoutFile($arrPost)
    {
        if (array_key_exists("id_layout", $arrPost))
            $arrLayoutFile['id_layout'] = (int) $arrPost["id_layout"];
        else
            $arrLayoutFile = [
                'no_layout' => $arrData['no_layout'],
                'ds_caminho' => $arrData['ds_caminho'],
                'ds_url' => $arrData['ds_url'],
                'ds_encode' => $arrData['ds_encode'],
                'ds_separador_coluna' => $arrData['ds_separador_coluna'],
                'ds_separador_linha' => $arrData['ds_separador_linha'],
                'ds_procedure' => $arrData['ds_procedure'],
                'ds_table' => $arrData['ds_table'],
                'in_status' => $arrData['in_status']
            ];
        $layoutfile = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy($arrLayoutFile);
        if (is_array($layoutfile))
            return (reset($layoutfile)->toArray());
        else
            return $layoutfile;
    }

    public function add($arrData = null)
    {
        // valida se já existe o layout com mesmo nome
        $mixLayout = $this->findBy(array(
            'no_layout' => strtoupper($arrData['no_layout'])
        ));
        if (! empty($mixLayout))
            throw new Exception('Layout já cadastrado');
            
            // entidade layout
        $arrLayout = array(
            'no_layout' => strtoupper($arrData['no_layout']),
            'ds_caminho' => $arrData['ds_caminho'],
            'ds_url' => $arrData['ds_url'],
            'ds_encode' => $arrData['ds_encode'],
            'ds_separador_coluna' => $arrData['ds_separador_coluna'],
            'ds_separador_linha' => $arrData['ds_separador_linha'],
            'ds_procedure' => $arrData['ds_procedure'],
            'ds_table' => $arrData['ds_table'],
            'in_status' => true
        );
        $mixResult = $this->save($arrLayout);
        if (is_object($mixResult)) {
            // entidade interdependencia
            if (! empty($arrData['id_layout_dependente'])) {
                foreach ($arrData['id_layout_dependente'] as $layout) {
                    $arrInterdependencia = array(
                        'id_layout' => $mixResult->getIdLayout(),
                        'id_layout_dependente' => $layout
                    );
                    $mixResult = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\InterdependenciaFile')->save($arrInterdependencia);
                }
            }
            return true;
        }
        return false;
    }

    public function status($arrLayoutFile)
    {
        $arrLayoutFile['in_status'] = ($arrLayoutFile['in_status'] == 1) ? 0 : 1;
        return $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->update($arrLayoutFile);
    }

    public function findByPaged(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQL = null)
    {
        $arrCriteriaResult = array();
        $arrCriteria = array();
        
        if (array_key_exists('id_layout', $arrCriteria))
            $arrCriteria['id_layout'] = $arrCriteria['id_layout'];
        $serviceLayout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile');
        $arrResultLayoutData = $serviceLayout->findBy($arrCriteria);
        
        if ($arrResultLayoutData) {
            $arrCriteriaResult = $this->getFilterResult($arrResultLayoutData, $arrCriteria);
        }
        return new Paginator($arrCriteriaResult, $intPage, $intItemPerPage);
    }

    protected function listLayout($booCheckInStatus = true)
    {
        $arrCriteria = ($booCheckInStatus) ? array(
            'in_status' => 1
        ) : array();
        $arrLayout = $this->fetchPairs($arrCriteria, 'getIdLayout', 'getNoLayout');
        if (empty($arrLayout))
            throw new DomainException('Não existe algum layout para realizar a validação estrutural.');
        return $arrLayout;
    }

    private function getFilterResult($arrResultLayoutData, $arrCriteria)
    {
        $arrResultPaginator = array();
        $serviceConfigureLayout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile');
        $serviceCorporativo = $this->getService('InepZend\Module\Corporative\Service\VwProjetoEvento');
        
        foreach ($arrResultLayoutData as $resultDataLayout) {
            $entityEvento = null;
            $entityConfiguracao = null;
            if (array_key_exists('co_evento', $arrCriteria)) {
                // caso nao exista o filtro de layout pego do loop
                if (! array_key_exists('id_layout', $arrCriteria)) {
                    $arrCriteria['id_layout'] = $resultDataLayout->getIdLayout();
                }
                $entityConfiguracao = reset($serviceConfigureLayout->findBy($arrCriteria));
                unset($arrCriteria['id_layout']);
            } else {
                $entityConfiguracao = reset($serviceConfigureLayout->findBy(array(
                    'id_layout' => $resultDataLayout->getIdLayout()
                )));
            }
            
            // pesquisando os eventos do layout
            if ($entityConfiguracao) {
                $entityEvento = reset($serviceCorporativo->findBy(array(
                    'coProjeto' => $entityConfiguracao->getCoProjeto(),
                    'coEvento' => $entityConfiguracao->getCoEvento()
                )));
            }
            
            if (! (array_key_exists('co_evento', $arrCriteria) && is_null($entityEvento))) {
                $arrResultPaginator[$resultDataLayout->getIdLayout()] = array(
                    'NO_EVENTO' => ! is_null($entityEvento) ? $entityEvento->getNoEvento() : null,
                    'NO_LAYOUT' => $resultDataLayout->getNoLayout(),
                    'ID_LAYOUT' => $resultDataLayout->getIdLayout(),
                    'IN_STATUS' => $resultDataLayout->getInStatus()
                );
            }
        }
        unset($serviceLayout);
        return $arrResultPaginator;
    }
}
