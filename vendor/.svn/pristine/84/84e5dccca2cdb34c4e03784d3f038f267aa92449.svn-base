<?php

namespace InepZend\Module\Oauth\Service;

use InepZend\Exception\InvalidArgumentException;
use InepZend\Dto\ResultTrait;
use InepZend\Util\Curl;
use InepZend\Util\ArrayCollection;
use \Exception as ExceptionNative;

class FacebookService extends AbstractService implements InterfaceService
{
    
    use ResultTrait;

    public function __construct($serviceManager = null)
    {
        parent::__construct('2', str_replace(array(__NAMESPACE__, 'Service', '\\'), '', __CLASS__), $serviceManager);
    }

    public function getMe()
    {
        return $this->makeCall('me/');
    }

    public function getMePermissions($intId = null)
    {
        if (empty($intId))
            $intId = 'me';
        return $this->makeCall($intId . '/permissions');
    }
    
    public function authenticate()
    {
        $mixResult = null;
        $booResponse = false;
        try {
            $mixResult = $this->getMe();
            $booResponse = is_object($mixResult);
        } catch (ExceptionNative $exception) {
            
        }
        $mixResult = (object) array(
            'usuarioSistema' => (object) array(
                'id' => null,
                'dataSituacao' => null,
                'perfis' => array(
                    (object) array(
                        'id' => null,
                        'descricao' => null,
                        'nome' => 'Usuário autenticado',
                        'acoes' => array()
                    )
                ),
                'sistema' => (object) array(
                    'id' => null,
                    'descricao' => null,
                    'nome' => null,
                ),
                'usuario' => (object) array(
                    'id' => $mixResult->id,
                    'login' => null,
                    'nome' => $mixResult->name,
                    'senhaTemporaria' => false,
                ),
            )
        );
        return ArrayCollection::arrayToObject(['response' => ArrayCollection::arrayToObject(self::getResult((($booResponse) ? 'OK' : 'FALHA'), [(($booResponse) ? 'Usuário autenticado com sucesso!' : 'Ocorreu uma falha e a operação não pôde ser realizada!')], $mixResult))]);
    }

    public function callCode()
    {
        $oAuth = $this->getOAuth();
        $oAuth->getStorage()->clearRequestToken();
        $oAuth->getStorage()->clearAccessToken();
//        exit('limpo');
        return $this->getOAuth()->getAdapter()->callCode();
    }

    public function callAccessToken($mixCode)
    {
        return (empty($mixCode)) ? null : $this->getOAuth()->getAdapter()->callAccessToken($mixCode, $this->getConfig());
    }

    private function makeCall($strFunction, $arrParam = null, $strMethod = 'GET', $booAuth = true)
    {
        $arrConfig = $this->getConfig();
        if ($booAuth) {
            $mixAccessToken = $this->getToken();
            if (!empty($mixAccessToken))
                $strAuthMethod = '?access_token=' . $mixAccessToken;
            else {
                $this->setLastRouteIntoSession();
                return $this->callCode();
            }
        } else
            $strAuthMethod = '?client_id=' . $arrConfig['consumerKey'];
        $strParam = ((isset($arrParam)) && (is_array($arrParam))) ? '&' . http_build_query($arrParam) : null;
        $strUrl = 'https://graph.facebook.com/v2.6/' . $strFunction . $strAuthMethod . (($strMethod === 'GET') ? $strParam : null);
        $mixCurlResult = Curl::getCurl($strUrl, $arrParam, $strMethod, null, null, null, $arrConfig);
        if (!is_array($mixCurlResult))
            return false;
        $mixJsonData = $mixCurlResult[0];
//        $mixCurlError = $mixCurlResult[1];
        return json_decode($mixJsonData);
    }

}
