<?php

namespace InepZend\Module\Ssi\Service;

use InepZend\Service\AbstractServiceControlCache;
use InepZend\Ssi\Entity\PerfilAcao;
use InepZend\Paginator\Paginator;
use InepZend\Util\stdClass;
use InepZend\Util\FileSystem;
use InepZend\Util\String;
use InepZend\Util\Date;
use InepZend\Util\Server;
use Zend\Json\Json;
use Zend\Json\Encoder;
use Zend\Json\Decoder;

abstract class AbstractService extends AbstractServiceControlCache
{

    const PATH_CONTAINER = 'data/ssi/';
    const ENTITY_ACTION = 'Acao';
    const ENTITY_PROFILE = 'Perfil';
    const ID_SYSTEM = null; /* 585, 14900 */
    const DEBUG = false;

    public function findBy($arrCriteria = null, $booId = null, $strEntity = null)
    {
        $arrRegister = array();
        $arrPerfilAcao = $this->findByPerfilAcao();
        if (is_array($arrPerfilAcao)) {
            if (empty($strEntity))
                $strEntity = self::ENTITY_ACTION;
            foreach ($arrPerfilAcao as $perfilAcao) {
                $intId = null;
                if ($strEntity == self::ENTITY_ACTION)
                    $intId = $perfilAcao->getIdAcao();
                elseif ($strEntity == self::ENTITY_PROFILE)
                    $intId = $perfilAcao->getIdPerfil();
                if (($perfilAcao->getSgAcao() == PerfilAcao::ACAO_DEFAUT_SSI) || (array_key_exists($intId, $arrRegister)))
                    continue;
                if (is_array($arrCriteria)) {
                    if ((array_key_exists('id_acao', $arrCriteria)) && (!empty($arrCriteria['id_acao'])) && ($arrCriteria['id_acao'] != $perfilAcao->getIdAcao()))
                        continue;
                    if ((array_key_exists('id_perfil', $arrCriteria)) && (!empty($arrCriteria['id_perfil'])) && ($arrCriteria['id_perfil'] != $perfilAcao->getIdPerfil()))
                        continue;
                    if ((array_key_exists('sg_acao', $arrCriteria)) && (!empty($arrCriteria['sg_acao'])) && (stripos($perfilAcao->getSgAcao(), $arrCriteria['sg_acao']) !== 0))
                        continue;
                    if ((array_key_exists('sg_acao_remove', $arrCriteria)) && (!empty($arrCriteria['sg_acao_remove'])) && (stripos($perfilAcao->getSgAcao(), $arrCriteria['sg_acao_remove']) === 0))
                        continue;
                }
                $arrAttribute = array();
                if ($strEntity == self::ENTITY_ACTION) {
                    $arrAttribute = array(
                        'no_acao' => $perfilAcao->getNoAcao(),
                        'sg_acao' => $perfilAcao->getSgAcao(),
                        'ds_acao' => $perfilAcao->getDsAcao(),
                    );
                    if ($booId === true)
                        $arrAttribute['id_acao'] = $intId;
                } elseif ($strEntity == self::ENTITY_PROFILE) {
                    $arrAttribute = array(
                        'no_perfil' => $perfilAcao->getNoPerfil(),
                        'ds_perfil' => $perfilAcao->getDsPerfil(),
                    );
                    if ($booId === true)
                        $arrAttribute['id_perfil'] = $intId;
                }
                $arrRegister[$intId] = new stdClass($arrAttribute);
            }
        }
        $arrRegister = array_values($arrRegister);
        $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args()), array($arrPerfilAcao), array($arrRegister)));
        return $arrRegister;
    }

    protected function findByAcao($arrCriteria = null, $booId = null)
    {
        return self::findBy($arrCriteria, $booId, self::ENTITY_ACTION);
    }

    protected function findByPerfil($arrCriteria = null, $booId = null)
    {
        return self::findBy($arrCriteria, $booId, self::ENTITY_PROFILE);
    }

    protected function findByPerfilAcao()
    {
        return $this->getService('InepZend\Ssi\Service\PerfilAcao')->findBy(array('id_sistema' => $this->getIdSystem(), 'in_ativo_perfil_acao' => 1));
    }

    protected function fetchPairsAcao()
    {
        $arrResult = array();
        foreach ($this->findByAcao() as $acao)
            $arrResult[$acao->id_acao] = $acao->no_acao;
        return $arrResult;
    }

    protected function fetchPairsPerfil()
    {
        $arrResult = array();
        foreach ($this->findByPerfil(null, true) as $perfil)
            $arrResult[$perfil->id_perfil] = $perfil->no_perfil;
        return $arrResult;
    }

    abstract protected function getTree($arrCriteria = null);

    abstract protected function renderTree($arrTree = null, $arrData = null, $intDeep = 0, $booIcon = true);

    protected function convertPostToTree($arrData = null)
    {
        $arrTree = (!array_key_exists('ds_tree', $arrData)) ? false : $this->removeClassName((array) Decoder::decode($arrData['ds_tree']));
        $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args()), array($arrTree)));
        return $arrTree;
    }

    protected function convertTreeToFormat($arrTree = null, $arrData = null)
    {
        $this->debugExec(array_merge(array(__CLASS__, __FUNCTION__, 'Line ' . __LINE__), array(func_get_args())));
        ob_start();
        echo trim(Json::prettyPrint(Encoder::encode($arrTree)));
        return ob_get_clean();
    }

    protected function saveData($arrData = null)
    {
        return FileSystem::insertContentIntoFile(Server::getReplacedBasePathApplication('/../../../../../../../' . self::PATH_CONTAINER . $this->getServiceName() . time() . '.json'), @$arrData['ds_tree']);
    }

    protected function removeClassName($arrTree = null, $intDeep = 0)
    {
        if (is_array($arrTree))
            foreach ($arrTree as $strSgAcao => $acaoTree) {
                if (isset($acaoTree->__className))
                    unset($acaoTree->__className);
                if ((isset($acaoTree->children)) && (is_array($acaoTree->children)))
                    $acaoTree->children = $this->removeClassName($acaoTree->children, ($intDeep + 1));
            }
        return $arrTree;
    }

    protected function findByPagedHistory(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQL = null)
    {
        $arrHistory = array();
        $strPathHistory = self::PATH_CONTAINER;
        $arrFile = FileSystem::globRecursive(Server::getReplacedBasePathApplication('/../../../../../../../' . $strPathHistory), 'json');
        $strService = $this->getServiceName();
        foreach ($arrFile as $strFile) {
            if (!String::isUTF8($strFile))
                $strFile = utf8_encode($strFile);
            if (strpos($strFile, $strService) === false)
                continue;
            $arrInfFile = $this->getInformationFile($strFile);
            $strNoFile = $arrInfFile['noFile'];
            $strDtCreate = $arrInfFile['dtCreate'];
            $strDtCreateBase = $arrInfFile['dtCreate'];
            if ((is_array($arrCriteria)) && (count($arrCriteria) > 0)) {
                $strDtCreateStart = (array_key_exists('dt_create_inicio', $arrCriteria)) ? $arrCriteria['dt_create_inicio'] : null;
                $strDtCreateEnd = (array_key_exists('dt_create_fim', $arrCriteria)) ? $arrCriteria['dt_create_fim'] : null;
                if ((!empty($strDtCreateStart)) && ($strDtCreateBase < $strDtCreateStart))
                    continue;
                if ((!empty($strDtCreateEnd)) && ($strDtCreateBase > $strDtCreateEnd))
                    continue;
            }
            $arrHistory[$strNoFile] = array('NO_FILE' => $strNoFile, 'DS_PATH' => $strPathHistory . end($arrExplode = explode($strPathHistory, $strFile)), 'DS_SIZE' => FileSystem::filesizeFormated($strFile), 'DT_CREATE' => Date::convertDate($strDtCreate, 'd/m/Y H:i:s'));
        }
        unset($arrFile);
        if (empty($strSortOrder))
            $strSortOrder = 'desc';
        if (strtolower($strSortOrder) == 'asc')
            ksort($arrHistory);
        else
            krsort($arrHistory);
        $arrHistory = array_values($arrHistory);
        return new Paginator($arrHistory, $intPage, $intItemPerPage);
    }

    private function getServiceName()
    {
        return end($arrExplode = explode('\\', get_class($this)));
    }

    private function getInformationFile($strFile = null)
    {
        if (!String::isUTF8($strFile))
            $strFile = utf8_encode($strFile);
        $strNameFile = trim(end($arrExplode = explode('/', $strFile)));
        return array(
            'noFile' => $strNameFile,
            'dtCreate' => date('Y-m-d H:i:s', (integer) str_replace(array($this->getServiceName(), '.json'), '', $strNameFile)),
        );
    }

    protected function getIdSystem()
    {
        $intIdSystem = self::ID_SYSTEM;
        return (!empty($intIdSystem)) ? $intIdSystem : $this->getSystem()->id;
    }

    /**
     * 
     * @param type $strPathFile
     * @return type
     */
    protected function exportInformationSsi($strPathFile, $strNameRoot)
    {
        $domXmlSsi = new \DOMDocument('1.0', 'UTF-8');
        $domXmlSsi->standalone = true;
        $domXmlSsi->preserveWhiteSpace = false;
        $domXmlSsi->formatOutput = true;
        $xmlRoot = $domXmlSsi->createElement($strNameRoot);
        $this->mountInfoSsiXml(json_decode(FileSystem::getContentFromFile($strPathFile)), $domXmlSsi, $xmlRoot);
        $domXmlSsi->appendChild($xmlRoot);
        $domXmlSsi->normalize();
        return $domXmlSsi->saveXML(null, LIBXML_NOEMPTYTAG);
    }

}
