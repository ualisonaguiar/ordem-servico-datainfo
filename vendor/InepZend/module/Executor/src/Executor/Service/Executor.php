<?php

namespace InepZend\Module\Executor\Service;

use InepZend\Service\AbstractService;
use InepZend\Module\Executor\Service\QueryTrait;
use InepZend\Util\Server;
use InepZend\Util\FileSystem;
use InepZend\Util\Date;

class Executor extends AbstractService
{

    use QueryTrait;

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('id');
    }

    protected function run($intQuery, $arrParameter = array())
    {
        $dataQuery = $this->getService('InepZend\Module\Executor\Service\Query')->find((int) $intQuery);
        $strSql = $dataQuery->getDsQuery();
        $arrBind = $this->getBindFromSql($strSql);
        $serviceUser = $this->getService('InepZend\Module\Executor\Service\Usuario');
        if ($arrBind) {
            if (
                $serviceUser->hasAdministrador() == false &&
                in_array('cpfUsuarioLogado', $arrBind) !== false
            ) {
                $arrParameter['cpfUsuarioLogado'] = $serviceUser->getCpfUsuarioLogado();
            }
//             $arrParameter = array_combine($arrBind, $arrParameter);
        }
        $strDataExecucao = date('Y-m-d H:i:s');
        $mixResult = $this->getRepositoryEntity()->runExecuteQuery($strSql, $arrParameter);
        $strPath = $this->createDirectoryExecute($intQuery);
        $strPath .= '/' .  Date::convertDate($strDataExecucao, 'YmdHis') . '.txt';
        FileSystem::insertContentIntoFile($strPath, serialize($mixResult));
        $historicoExecucao = $this->getService('InepZend\Module\Executor\Service\HistoricoExecucao')->save(
            array(
                'idHistoricoExecucao' => null,
                'dsQuery' => $strSql,
                'dsResultado' => $strPath,
                'dsParametro' => serialize($arrParameter),
                'dtExecucao' => $strDataExecucao,
                'dsUsuarioExecucao' => $this->getNameUserUpdate(),
                'idQuery' => (int) $intQuery,
                'coSituacao' => $mixResult['status']
            )
        );
        $mixResult['idHistoricoExecucao'] = $historicoExecucao->getIdHistoricoExecucao();
        return $mixResult;
    }

    protected function createDirectoryExecute($intIdQuery)
    {
        $strPath = Server::getReplacedBasePathApplication() . '/data/';
        $arrPaste = array('ExecuteQuery', 'Result', $intIdQuery);
        foreach ($arrPaste as $strPaste) {
            $strPath .= '/' . $strPaste;
            if (!is_dir($strPath))
                mkdir($strPath, 0755, true);
        }
        return $strPath;
    }
}
