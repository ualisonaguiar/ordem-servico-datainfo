<?php

namespace InepZend\Module\Oauth\Service;

use InepZend\Exception\InvalidArgumentException;
use InepZend\Util\Curl;

class InstagramService extends AbstractService implements InterfaceService
{

    public function __construct($serviceManager = null)
    {
        parent::__construct('2', str_replace(array(__NAMESPACE__, 'Service', '\\'), '', __CLASS__), $serviceManager);
    }

    public function getUser($intUserId = 'self')
    {
        return $this->makeCall('users/' . $intUserId);
    }

    public function getUserMedia($intUserId = 'self', $intLimit = 10, $intMinMediaId = null, $intMaxMediaId = null)
    {
        return $this->makeCall('users/' . $intUserId . '/media/recent', array('count' => $intLimit, 'min_id' => $intMinMediaId, 'max_id' => $intMaxMediaId));
    }

    public function getUserLikes($intLimit = 10, $intMaxLikeId = null)
    {
        return $this->makeCall('users/self/media/liked', array('count' => $intLimit, 'max_like_id' => $intMaxLikeId));
    }

    public function searchUser($strUserName = null, $intLimit = 10)
    {
        return $this->makeCall('users/search', array('q' => $strUserName, 'count' => $intLimit));
    }
    
    public function getUserFollows()
    {
        return $this->makeCall('users/self/follows');
    }
    
    public function getUserFollower()
    {
        return $this->makeCall('users/self/followed-by');
    }
    
    public function getUserRequesterToFollow()
    {
        return $this->makeCall('users/self/requested-by');
    }
    
    public function getUserRelationship($intUserId = 'self')
    {
        return $this->makeCall('users/' . $intUserId . '/relationship');
    }
    
    public function modifyRelationship($strAction = null, $intUserId = 'self')
    {
        if ((in_array($strAction, array('follow', 'unfollow', 'block', 'unblock', 'approve', 'deny'))) && (isset($intUserId)))
            return $this->makeCall('users/' . $intUserId . '/relationship', array('action' => $strAction), 'POST');
        throw new InvalidArgumentException(sprintf('É necessário a ação e o id do usuário, em %s: ', get_class($this)));
    }

    public function getMedia($intMediaId = null)
    {
        return $this->makeCall('media/' . $intMediaId);
    }
    
    public function getShortCode($strShortCode = null)
    {
        return $this->makeCall('media/shortcode/' . $strShortCode);
    }

    public function searchMedia($floLatitude = null, $floLongitude = null, $intDistance = 1000)
    {
        return $this->makeCall('media/search', array('lat' => $floLatitude, 'lng' => $floLongitude, 'distance' => $intDistance));
    }

    public function getMediaComments($intMediaId = null)
    {
        return $this->makeCall('media/' . $intMediaId . '/comments');
    }

    public function createMediaComment($intMediaId = null, $strComment = null)
    {
        return $this->makeCall('media/' . $intMediaId . '/comments', array('text' => $strComment), 'POST');
    }

    public function deleteMediaComment($intMediaId = null, $intCommentId = null)
    {
        return $this->makeCall('media/' . $intMediaId . '/comments/' . $intCommentId, null, 'DELETE');
    }

    public function getMediaLikes($intMediaId = null)
    {
        return $this->makeCall('media/' . $intMediaId . '/likes');
    }

    public function likeMedia($intMediaId = null)
    {
        return $this->makeCall('media/' . $intMediaId . '/likes', null, 'POST');
    }

    public function deleteLikedMedia($intMediaId = null)
    {
        return $this->makeCall('media/' . $intMediaId . '/likes', null, 'DELETE');
    }

    public function getTag($strTag = null)
    {
        return $this->makeCall('tags/' . $strTag);
    }

    public function getTagMedia($strTag = null, $intMinMediaId = null, $intMaxMediaId = null, $intLimit = 20)
    {
        return $this->makeCall('tags/' . $strTag . '/media/recent', array('count' => $intLimit, 'min_tag_id' => $intMinMediaId, 'max_tag_id' => $intMaxMediaId));
    }

    public function searchTags($strTag = null)
    {
        return $this->makeCall('tags/search', array('q' => $strTag));
    }

    public function getLocation($intLocationId = null)
    {
        return $this->makeCall('locations/' . $intLocationId);
    }

    public function getLocationMedia($intLocationId = null, $intMinMediaId = null, $intMaxMediaId = null)
    {
        return $this->makeCall('locations/' . $intLocationId . '/media/recent', array('min_id' => $intMinMediaId, 'max_id' => $intMaxMediaId));
    }

    public function searchLocation($floLatitude = null, $floLongitude = null, $intDistance = 1000, $intFoursquareV2Id = null, $intFoursquareId = null)
    {
        return $this->makeCall('locations/search', array('lat' => $floLatitude, 'lng' => $floLongitude, 'distance' => $intDistance, 'foursquare_v2_id' => $intFoursquareV2Id, 'foursquare_id' => $intFoursquareId));
    }

    public function callCode()
    {
        $oAuth = $this->getOAuth();
        $oAuth->getStorage()->clearRequestToken();
        $oAuth->getStorage()->clearAccessToken();
//         exit('limpo');
        return $this->getOAuth()->getAdapter()->callCode();
    }

    public function callAccessToken($mixCode = null)
    {
        return (empty($mixCode)) ? null : $this->getOAuth()->getAdapter()->callAccessToken($mixCode, $this->getConfig());
    }

    private function makeCall($strFunction = null, $arrParam = null, $strMethod = 'GET', $booAuth = true)
    {
//         $this->callCode();
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
        $strUrl = 'https://api.instagram.com/v1/' . $strFunction . $strAuthMethod . (($strMethod === 'GET') ? $strParam : null);
        $mixCurlResult = Curl::getCurl($strUrl, $arrParam, $strMethod, null, null, null, $arrConfig);
        if (!is_array($mixCurlResult))
            return false;
        $mixJsonData = $mixCurlResult[0];
//        $mixCurlError = $mixCurlResult[1];
        return json_decode($mixJsonData);
    }

}
