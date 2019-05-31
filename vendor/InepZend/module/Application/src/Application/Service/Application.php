<?php

namespace InepZend\Module\Application\Service;

use InepZend\Service\AbstractService;
use InepZend\Upload\UploadFile;
use InepZend\Util\Server;
use InepZend\Dto\ResultDto;

class Application extends AbstractService
{

    const PATH_UPLOAD = 'data/tmp/FormGenerator/Upload';

    /**
     * Metodo responsavel em realizar o upload dos arquivos.
     *
     * @param array $arrParam
     * @return mix
     */
    public function uploadFile(&$arrParam = null)
    {
        $arrParamUpload = array();
        $arrParamUpload[UploadFile::PARAM_FILE_ATTRIBUTE] = @$arrParam['name'];
        $arrParamUpload[UploadFile::PARAM_PATH_UPLOAD] = (@empty($arrParam['path'])) ? self::PATH_UPLOAD : $arrParam['path'];
        $arrParamUpload[UploadFile::PARAM_EXTENSION_PERMITED] = @$arrParam['permited'];
        $arrParamUpload[UploadFile::PARAM_OBRIGATORY] = (!is_bool(@$arrParam['required'])) ? false : $arrParam['required'];
        $arrParamUpload[UploadFile::PARAM_BYTE_MAX_FILE_SIZE] = @$arrParam['max_filesize'];
        $arrParamUpload[UploadFile::PARAM_CLEAR_PATH_UPLOAD] = (!is_bool(@$arrParam['clear_path'])) ? false : $arrParam['clear_path'];
        $arrParamUpload[UploadFile::PARAM_WIDTH_IMG] = @$arrParam['width'];
        $arrParamUpload[UploadFile::PARAM_HEIGHT_IMG] = @$arrParam['height'];
        $arrParamUpload[UploadFile::PARAM_PROPORTION_IMG] = (!is_bool(@$arrParam['proportion'])) ? true : $arrParam['proportion'];
        $arrParamUpload[UploadFile::PARAM_EXTRACT_ZIP] = (!is_bool(@$arrParam['zip'])) ? false : $arrParam['zip'];
        $arrParamUpload[UploadFile::PARAM_EXTENSION_PERMITED_ZIP] = @$arrParam['zip_permited'];
        $arrParamUpload[UploadFile::PARAM_PREFIX_FILE_NAME] = (@empty($arrParam['prefix'])) ? time() : $arrParam['prefix'];
        $arrParamUpload[UploadFile::PARAM_SUFIX_FILE_NAME] = @$arrParam['sufix'];
        $arrParamUpload[UploadFile::PARAM_NEW_FILE_NAME] = @$arrParam['new_name'];
        $arrParamUpload[UploadFile::PARAM_FILES] = @$arrParam['files'];
        $arrResult = (new UploadFile())->realizarUpload($arrParamUpload);
        if ($arrResult[0] == 'ok') {
            $arrFileInfo = $arrResult[2][UploadFile::KEY_FILE_INFO];
            $mixResult = $arrFileInfo[UploadFile::UPLOADED_PATH];
            $arrParam['info'] = $arrFileInfo;
        } else
            $mixResult = $arrResult;
        return $mixResult;
    }

    /**
     * Metodo responsavel pela exclusao do arquivo.
     *
     * @param string $strFile
     * @return boolean
     */
    protected function removeFile($strFile = null)
    {
        if (!is_file($strPath = Server::getReplacedBasePathApplication('/' . $strFile)))
            return false;
        return unlink($strPath);
    }

    /**
     * Metodo responsavel por fazer o crop da imagem.
     *
     * @param array $arrParam
     * @return mixed
     */
    protected function cropImageFile($arrParam)
    {
        if (!extension_loaded('imagick'))
            return array(ResultDto::STATUS_FAIL, 'E necessario a instalacao da extensao: imagick');
        $strPathImage = Server::getReplacedBasePathApplication('/' . $arrParam['tmp_name']);
        if(!array_key_exists('coordinate', $arrParam)) {
            return $arrParam['tmp_name'];
        }
        $arrCoordinate = explode('|', $arrParam['coordinate']);
        $image = new \Imagick($strPathImage);
        $image->cropimage($arrCoordinate[0], $arrCoordinate[1], $arrCoordinate[2], $arrCoordinate[3]);
        $image->writeimage($strPathImage . '-crop');
        unlink($strPathImage);
        rename($strPathImage . '-crop', $strPathImage);
        return $arrParam['tmp_name'];
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_IDENTITY
     */
    public function getIdentity()
    {
        return parent::getIdentity();
    }

}
