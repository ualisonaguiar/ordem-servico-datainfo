<?php

namespace InepZend\OpenSsl;

class OpenSsl
{

    const ALGO_CRYPT = OPENSSL_ALGO_SHA1;
//    const ALGO_CRYPT = OPENSSL_ALGO_MD5;
    const OPENSSL = 'C:/OpenSSL/bin/openssl.exe';
    const DIR_APACHE_SSL = 'C:/Arquivos de programas/Apache Software Foundation/Apache2.2/conf/ssl/';
    const APACHE_SSL_CERT = 'C:/Arquivos de programas/Apache Software Foundation/Apache2.2/conf/ssl/my-server.cert';
    const APACHE_SSL_KEY = 'C:/Arquivos de programas/Apache Software Foundation/Apache2.2/conf/ssl/my-server.key';
    const DIR_PRIVATE_KEYS = '/data/openssl/privkeys/';
    const DIR_OLD_PRIVATE_KEYS = '/data/openssl/privkeys/repository/';
    const DIR_PUBLIC_KEYS = '/data/openssl/pubkeys/';
    const DIR_OLD_PUBLIC_KEYS = '/data/openssl/pubkeys/repository/';

    private static $intPrivateKeyId = null;
    private static $intPublicKeyId = null;

    public function deletePrivateKey($intUserId)
    {
        $strKeyFile = self::DIR_PRIVATE_KEYS . md5($intUserId) . '.pem';
        $strOldKeyFile = self::DIR_OLD_PRIVATE_KEYS . md5($intUserId) . '-';
        $i = 1;
        while (file_exists($strOldKeyFile . $i . '.pem'))
            $i++;
        $strOldKeyFile .= $i . '.pem';
        rename($strKeyFile, $strOldKeyFile);
    }

    public function deletePublicKey($intUserId)
    {
        $strKeyFile = self::DIR_PUBLIC_KEYS . md5($intUserId) . '.pem';
        $strOldKeyFile = self::DIR_OLD_PUBLIC_KEYS . md5($intUserId) . '-';
        $i = 1;
        while (file_exists($strOldKeyFile . $i . '.pem'))
            $i++;
        $strOldKeyFile .= $i . '.pem';
        rename($strKeyFile, $strOldKeyFile);
    }

    public function generatePrivateKey($intUserId, $strPassword)
    {
        if ((empty($intUserId)) || (empty($strPassword)))
            return false;
        $strKeyFile = self::DIR_PRIVATE_KEYS . md5($intUserId) . '.pem';
        $strTempPassFile = self::DIR_PRIVATE_KEYS . md5(rand(0, 9999)) . '.pass';
        $resTempPassFile = fopen($strTempPassFile, 'w+');
        fwrite($resTempPassFile, $strPassword);
        fclose($resTempPassFile);
        $arrOutput = array();
        $strCommand = self::OPENSSL . ' genrsa -des3 -out "' . $strKeyFile . '" -passout file:"' . $strTempPassFile . '" 2048';
        exec($strCommand, $arrOutput);
        unlink($strTempPassFile);
        return true;
    }

    public function generatePublicKey($intUserId, $strPassword)
    {
        if ((empty($intUserId)) || (empty($strPassword)))
            return false;
        $strKeyFile = self::DIR_PRIVATE_KEYS . md5($intUserId) . '.pem';
        $strTempPassFile = self::DIR_PRIVATE_KEYS . md5(rand(0, 9999)) . '.pass';
        $strPubKey = self::DIR_PUBLIC_KEYS . md5($intUserId) . '.pem';
        $resTempPassFile = fopen($strTempPassFile, 'w+');
        fwrite($resTempPassFile, $strPassword);
        fclose($resTempPassFile);
        $arrOutput = array();
        $strCommand = self::OPENSSL . ' rsa -in "' . $strKeyFile . '" -passin file:"' . $strTempPassFile . '" -pubout -out "' . $strPubKey . '"';
        exec($strCommand, $arrOutput);
        unlink($strTempPassFile);
        return true;
    }

    public function getIntPrivateKeyId($intUserId, $strPassword, $booApacheSSLKey = false)
    {
        $strPrivateKeyPath = (!$booApacheSSLKey) ? self::DIR_PRIVATE_KEYS . md5($intUserId) . '.pem' : self::APACHE_SSL_KEY;
        if (empty(self::$intPrivateKeyId)) {
            if ((!empty($intUserId)) && (file_exists($strPrivateKeyPath))) {
                $resPrivateKey = fopen($strPrivateKeyPath, 'r');
                $strPrivateKey = fread($resPrivateKey, 99999);
                fclose($resPrivateKey);
                self::$intPrivateKeyId = openssl_get_privatekey($strPrivateKey, $strPassword);
                if (self::$intPrivateKeyId == false)
                    return false;
            } else
                return false;
        }
        return self::$intPrivateKeyId;
    }

    public function getIntPublicKeyId($intUserId, $booApacheSSLCert = false)
    {
        $strPublicKeyPath = (!$booApacheSSLCert) ? self::DIR_PUBLIC_KEYS . md5($intUserId) . '.pem' : self::APACHE_SSL_CERT;
        if (empty(self::$intPublicKeyId)) {
            if ((!empty($intUserId)) && (file_exists($strPublicKeyPath))) {
                $resPublicKey = fopen($strPublicKeyPath, 'r');
                $strPublicKey = fread($resPublicKey, 99999);
                fclose($resPublicKey);
                self::$intPublicKeyId = openssl_get_publickey($strPublicKey);
                if (self::$intPublicKeyId == false)
                    return false;
            } else
                return false;
        }
        return self::$intPublicKeyId;
    }

    public function detailKey($intKeyId)
    {
        if (empty($intKeyId))
            return false;
        return openssl_pkey_get_details($intKeyId);
    }

    public function sign($strData, $intUserId, $strPassword)
    {
        $strSignature = null;
        $intPrivateKeyId = self::getIntPrivateKeyId($intUserId, $strPassword);
        if ((!empty($strData)) && ($intPrivateKeyId))
            openssl_sign($strData, $strSignature, $intPrivateKeyId, self::ALGO_CRYPT);
        return $strSignature;
    }

    public function verify($strData, $intUserId, $strSignature)
    {
        $intPublicKeyId = self::getIntPublicKeyId($intUserId);
        if ($intPublicKeyId == false)
            return false;
        $intResult = openssl_verify($strData, $strSignature, $intPublicKeyId, self::ALGO_CRYPT);
        return ($intResult == 1);
    }

    public function encryptPrivate($strData, $intUserId, $strPassword)
    {
        $intPrivateKeyId = self::getIntPrivateKeyId($intUserId, $strPassword);
        if ($intPrivateKeyId == false)
            return false;
        $strDataCrypted = null;
        if (openssl_private_encrypt($strData, $strDataCrypted, $intPrivateKeyId) === false)
            return false;
        else
            return $strDataCrypted;
    }

    public function decryptPublic($strDataCrypted, $intUserId)
    {
        $intPublicKeyId = self::getIntPublicKeyId($intUserId);
        if ($intPublicKeyId == false)
            return false;
        $strDataDecrypted = null;
        if (openssl_public_decrypt($strDataCrypted, $strDataDecrypted, $intPublicKeyId) === false)
            return false;
        else
            return $strDataDecrypted;
    }

    public function encryptPublic($strData, $intUserId)
    {
        $intPublicKeyId = self::getIntPublicKeyId($intUserId);
        if ($intPublicKeyId == false)
            return false;
        $strDataCrypted = null;
        if (openssl_public_encrypt($strData, $strDataCrypted, $intPublicKeyId) === false)
            return false;
        else
            return $strDataCrypted;
    }

    public function decryptPrivate($strDataCrypted, $intUserId, $strPassword)
    {
        $intPrivateKeyId = self::getIntPrivateKeyId($intUserId, $strPassword);
        if ($intPrivateKeyId == false)
            return false;
        $strDataDecrypted = null;
        if (openssl_private_decrypt($strDataCrypted, $strDataDecrypted, $intPrivateKeyId) === false)
            return false;
        else
            return $strDataDecrypted;
    }

    public function changePrivateKeyPassword($intUserId, $strOldPassword, $strNewPassword)
    {
        if ((empty($intUserId)) || (empty($strOldPassword)) || (empty($strNewPassword)))
            return false;
        $strTempNewPassFile = self::DIR_PRIVATE_KEYS . 'tnp-' . md5(rand(0, 9999)) . '.tmp';
        $strTempOldPassFile = self::DIR_PRIVATE_KEYS . 'top-' . md5(rand(0, 9999)) . '.tmp';
        $strKeyFile = self::DIR_PRIVATE_KEYS . md5($intUserId) . '.pem';
        $strKeyFileNoDes3 = $strKeyFile . 'NoDes3';
        $resTempOldPassFile = fopen($strTempOldPassFile, 'w+');
        fwrite($resTempOldPassFile, $strOldPassword);
        fclose($resTempOldPassFile);
        $strCommand = self::OPENSSL . ' rsa -in "' . $strKeyFile . '" -passin file:"' . $strTempOldPassFile . '" -out "' . $strKeyFileNoDes3 . '"';
        exec($strCommand);
        unlink($strTempOldPassFile);
        unlink($strKeyFile);
        $resTempNewPassFile = fopen($strTempNewPassFile, 'w+');
        fwrite($resTempNewPassFile, $strNewPassword);
        fclose($resTempNewPassFile);
        $strCommand = self::OPENSSL . ' rsa -in "' . $strKeyFileNoDes3 . '" -des3 -out "' . $strKeyFile . '" -passout file:"' . $strTempNewPassFile . '"';
        exec($strCommand);
        unlink($strKeyFileNoDes3);
        unlink($strTempNewPassFile);
        return true;
    }

}
