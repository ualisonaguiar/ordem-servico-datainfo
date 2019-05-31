<?php

namespace InepZend\Tag;

use InepZend\Util\Library;

class Tag
{

    protected $arrTag;

    public function __construct($strPathXml)
    {
        $arrTagXml = Library::convertXmlToArray('/*', Library::getContentFromFile($strPathXml));
        $arrTag = array();
        if (@is_array($arrTagXml['RELEASE']['TAG'])) {
            foreach ($arrTagXml['RELEASE']['TAG'] as $arrTagInfo) {
                if (is_array($arrTagInfo['COMMENT']['ITEM'])) {
                    foreach ($arrTagInfo['COMMENT']['ITEM'] as $strItem) {
                        $arrTag[$arrTagInfo['VERSION']][] = $strItem;
                    }
                }
                else
                    $arrTag[$arrTagInfo['VERSION']][] = $arrTagInfo['COMMENT']['ITEM'];
            }
        }
        $this->arrTag = $arrTag;
    }

    public function getLastTag()
    {
        return reset($this->arrTag);
    }

    public function getLastVersion()
    {
        return reset(array_keys($this->arrTag));
    }

}
