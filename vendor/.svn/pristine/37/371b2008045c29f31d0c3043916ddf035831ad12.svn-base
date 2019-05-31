<?php

namespace InepZend\Upload;

use InepZend\Util\FileSystem;
use InepZend\Util\Server;

trait UploadGD
{

    private function editImgFile($strPathToUpload = null, $strFileName = null, $intWidthImg = null, $intHeightImg = null, $booProportionImg = true)
    {
        if ((empty($strPathToUpload)) || (empty($strFileName)) || (empty($intWidthImg)) || (empty($intHeightImg)))
            return false;
        $arrDsArquivo = explode('.', $strFileName);
        $strExtension = strtolower(end($arrDsArquivo));
        $arrExtensionNotEditable = array('ico');
        $this->debugExecFile($strFileName);
        $this->debugExecFile($arrDsArquivo);
        $this->debugExecFile($strExtension);
        if (in_array($strExtension, $arrExtensionNotEditable))
            return $strFileName;
        if ((!is_array($arrDsArquivo)) || (!in_array($strExtension, array('jpg', 'jpeg', 'gif', 'png', 'bmp'))))
            return false;
        $strFunctionNameGD = 'imagecreatefrom';
        switch ($strExtension) {
            case 'jpg':
                $strFunctionNameGD .= 'jpeg';
                break;
            case 'bmp':
                $strFunctionNameGD .= 'wbmp';
                break;
            default:
                $strFunctionNameGD .= $strExtension;
                break;
        }
        $this->debugExecFile($strFunctionNameGD);
        $strNewFileName = '';
        $intCount = 1;
        foreach ($arrDsArquivo as $strPartFileName) {
            if (count($arrDsArquivo) != $intCount)
                $strNewFileName .= $strPartFileName . '.';
            elseif ($intCount != 1)
                $strNewFileName = substr($strNewFileName, 0, (strlen($strNewFileName) - 1));
            ++$intCount;
        }
        if ($strPathToUpload{(strlen($strPathToUpload) - 1)} != '/')
            $strPathToUpload .= '/';
        $this->debugExecFile($strPathToUpload . $strFileName);
        $imageGD = @$strFunctionNameGD($strPathToUpload . $strFileName);
        $this->debugExecFile($imageGD);
        if ($imageGD === false)
            $strNewFileName = $strFileName;
        else {
            $intWidthImageGD = imagesx($imageGD);
            $intHeightImageGD = imagesy($imageGD);
            $intWidthEdicao = $intWidthImg;
            $intHeightEdicao = $intHeightImg;
            $this->debugExecFile($intWidthImageGD);
            $this->debugExecFile($intHeightImageGD);
            $this->debugExecFile($intWidthEdicao);
            $this->debugExecFile($intHeightEdicao);
            if (!$booProportionImg) {
                $intWidthFinal = $intWidthEdicao;
                $intHeightFinal = $intHeightEdicao;
            } else {
                if (($intWidthEdicao >= $intWidthImageGD) && ($intHeightEdicao >= $intHeightImageGD)) {
                    $intWidthFinal = $intWidthImageGD;
                    $intHeightFinal = $intHeightImageGD;
                } else {
                    $floScaleWidth = (($intWidthImageGD * 100) / $intWidthEdicao);
                    $floScaleHeight = (($intHeightImageGD * 100) / $intHeightEdicao);
                    $this->debugExecFile($floScaleWidth);
                    $this->debugExecFile($floScaleHeight);
                    if ($floScaleWidth > $floScaleHeight) {
                        $floNuScaleHeight = ($intWidthEdicao / $intWidthImageGD);
                        $intWidthFinal = floor($intWidthEdicao);
                        $intHeightFinal = floor(($intHeightImageGD * $floNuScaleHeight));
                    } elseif ($floScaleWidth == $floScaleHeight) {
                        $intWidthFinal = floor($intWidthEdicao);
                        $intHeightFinal = floor($intHeightEdicao);
                    } elseif ($floScaleWidth < $floScaleHeight) {
                        $floNuScaleHeight = ($intHeightEdicao / $intHeightImageGD);
                        $intHeightFinal = floor($intHeightEdicao);
                        $intWidthFinal = floor(($intWidthImageGD * $floNuScaleHeight));
                    }
                }
            }
            $this->debugExecFile($intWidthFinal);
            $this->debugExecFile($intHeightFinal);
            $imageGDTemp = imagecreatetruecolor($intWidthFinal, $intHeightFinal);
            imagecopyresized($imageGDTemp, $imageGD, 0, 0, 0, 0, $intWidthFinal, $intHeightFinal, $intWidthImageGD, $intHeightImageGD);
            imagedestroy($imageGD);
            $imageGD = $imageGDTemp;
            $strNewFileName .= $intWidthFinal . 'x' . $intHeightFinal . '.' . $strExtension;
            switch ($strExtension) {
                case 'jpg':
                case 'jpeg':
                    imagejpeg($imageGD, $strPathToUpload . $strNewFileName, 85);
                    break;
                case 'bmp':
                    imagewbmp($imageGD, $strPathToUpload . $strNewFileName);
                    break;
                default:
                    $strFunctionNameGD = 'image' . $strExtension;
                    $strFunctionNameGD($imageGD, $strPathToUpload . $strNewFileName);
                    break;
            }
            imagedestroy($imageGD);
        }
        if (is_file($strPathToUpload . $strFileName))
            unlink($strPathToUpload . $strFileName);
        $this->debugExecFile($strNewFileName);
        return $strNewFileName;
    }

    private function moveFileToPath($strFileAttribute = null, $strPathToUpload = null, $booClearPathToUpload = true, $intWidthImg = null, $intHeightImg = null, $booProportionImg = true)
    {
        if (empty($strFileAttribute))
            return false;
        if (empty($strPathToUpload))
            $strPathToUpload = 'data';
        $arrFileInfo = $this->getFile($strFileAttribute);
        $this->debugExecFile($strFileAttribute);
        $this->debugExecFile($arrFileInfo);
        if ($arrFileInfo === false)
            return false;
        if (!is_dir($strPathToUpload))
            mkdir($strPathToUpload, 0777, true);
        elseif ($booClearPathToUpload) {
            FileSystem::undir($strPathToUpload);
            mkdir($strPathToUpload, 0777);
        }
        $booIsUploadedFile = (!Server::isPhpUnit()) ? is_uploaded_file($arrFileInfo[self::TEMPORARY_NAME]) : true;
        $strFunction = (!Server::isPhpUnit()) ? 'move_uploaded_file' : 'rename';
        if (($booIsUploadedFile) && ($strFunction($arrFileInfo[self::TEMPORARY_NAME], $strPathToUpload . $arrFileInfo[self::NAME])))
            return ((!empty($intWidthImg)) && (!empty($intHeightImg))) ? $this->editImgFile($strPathToUpload, $arrFileInfo[self::NAME], $intWidthImg, $intHeightImg, $booProportionImg) : $arrFileInfo[self::NAME];
        return false;
    }

}
