<?php

namespace InepZend\Module\Executor\Service;

use InepZend\Service\AbstractServiceFile;
use InepZend\Paginator\Paginator;
use InepZend\Util\String;
use InepZend\Module\Executor\Entity\HistoricoExecucao as HistoricoExecucaoEntity;
use InepZend\Util\FileSystem;
use InepZend\SpreedSheet\SpreedSheetFactory;
use InepZend\Util\Server;

class HistoricoExecucao extends AbstractServiceFile
{

    public function __construct()
    {
        parent::__construct();
        $this->arrPk = array('idHistoricoExecucao');
    }

    /**
     * Metodo responsavel por listagem o historico de execucao da operacao
     *
     * @param array $arrCriteria
     * @param string $strSortName
     * @param string $strSortOrder
     * @param integer $intPage
     * @param integer $intItemPerPage
     * @param mix $mixDQL
     */
    public function findByPaged(array $arrCriteria = null, $strSortName = 'dtExecucao', $strSortOrder = 'desc', $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQL = null)
    {
        $arrDataQuery = $this->findBy(array('idQuery' => (int) $arrCriteria['idQuery']), array('dtExecucao' => 'desc'));
        $arrDataResult = array();
        if ($arrDataQuery) {
            foreach ($arrDataQuery as $dataQuery) {
                $arrDataResult[] = array(
                    'ID_HISTORICO_EXECUCAO' => $dataQuery->getIdHistoricoExecucao(),
                    'DS_USUARIO' => String::beautifulProperName($dataQuery->getDsUsuarioExecucao()),
                    'DT_EXECUCAO' => $dataQuery->getDtExecucao(),
                    'TP_SITUACAO' => HistoricoExecucaoEntity::$arrSituacao[$dataQuery->getCoSituacao()],
                );
            }
        }
        return new Paginator($arrDataResult, $intPage, $intItemPerPage);
    }

    /**
     * Metodo responsavel por retornar informacoes da execucao.
     *
     * @param type $intIdHistory
     */
    protected function getDataHistoryExecute($intIdHistory)
    {
        $historyExecute = $this->find((int) $intIdHistory);
        $query = $this->getService('InepZend\Module\Executor\Service\Query')->find($historyExecute->getIdQuery());
        return array(
            'parametro' => unserialize($historyExecute->getDsParametro()),
            'query' => $historyExecute->getDsQuery(),
            'result' => unserialize(FileSystem::getContentFromFile($historyExecute->getDsResultado())),
            'noUsuario' => $historyExecute->getDsUsuarioExecucao(),
            'datExecucao' => $historyExecute->getDtExecucao(),
            'infoQuery' => $query
        );
    }

    /**
     * Metodo responsavel pelo download do resultado da execucao.
     *
     * @param integer $intIdHistory
     */
    protected function exportarExecucao($intIdHistory)
    {
        $strBasePath = Server::getReplacedBasePathApplication() . '/data/';
        $strBasePath .= date('YmdHis') . '_' . $intIdHistory . '.xlsx';
        $arrDataHistorico = $this->getDataHistoryExecute($intIdHistory);
        $strNameFile = str_replace(array('[', ']'), '', $arrDataHistorico['infoQuery']->getDsTitulo()). '.xlsx';
        $spreedSheet = (new SpreedSheetFactory())->make();
        $spreedSheet->getProperties()->setCreator($this->getIdentity()->usuarioSistema->usuario->nome)
            ->setTitle($arrDataHistorico['infoQuery']->getDsTitulo())
            ->setSubject($arrDataHistorico['infoQuery']->getDsTitulo())
            ->setDescription($arrDataHistorico['infoQuery']->getDsDescricao())
            ->setCompany('Inep - Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira');
        $arrData = array_merge(array(array_keys($arrDataHistorico['result']['data'][0])), $arrDataHistorico['result']['data']);
        $spreedSheet->getActiveSheet()->fromArray($arrData);
        $excelWriter = new \PHPExcel_Writer_Excel2007($spreedSheet);
        $excelWriter->save($strBasePath);
        $strContent = FileSystem::getContentFromFile($strBasePath);
        unlink($strBasePath);
        FileSystem::headerContent(
            $strNameFile,
            $strContent,
            reset(FileSystem::getMimeContentStructure()['xlsx'])
        );
        exit();
    }
}
