<?php

namespace InepZend\Module\Application\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\View\RenderTemplate;
use InepZend\View\RenderTemplateGoogle;
use InepZend\Util\ApplicationInfo;
use InepZend\Util\FileSystem;
use InepZend\Util\AttributeStaticTrait;

class Readme extends AbstractServiceManager
{

    use RenderTemplate,
        RenderTemplateGoogle,
        AttributeStaticTrait;

    const NAME = 'NAME';
    const INEPZEND_LAST_VERSION = 'INEPZEND_LAST_VERSION';

    protected function listMarkdownPhp()
    {
        return $this->listMarkdownPath('vendor/InepZend/');
    }

    protected function listMarkdownJs()
    {
        return $this->listMarkdownPath('public/vendor/InepZend/js/');
    }

    protected function listMarkdownCss()
    {
        return $this->listMarkdownPath('public/vendor/InepZend/css/');
    }

    protected function listMarkdownImages()
    {
        return $this->listMarkdownPath('public/vendor/InepZend/images/');
    }

    protected function listMarkdownPath($strPath = null)
    {
        $arrFile = array();
        foreach ($this->listMarkdown() as $strFile)
            if (strpos($strFile, (string) $strPath) === 0)
                $arrFile[] = $strFile;
        return $arrFile;
    }

    protected function listMarkdown()
    {
        if (!is_null($arrFile = self::getAttributeStatic('arrMarkdown')))
            return $arrFile;
        foreach ($arrFile = $this->globFromInepZend('md') as $intKey => $strFile)
            if (strpos($strFile, '/_README.md') === false)
                unset($arrFile[$intKey]);
        $arrFile = array_values($arrFile);
        self::setAttributeStatic('arrMarkdown', $arrFile);
        return $arrFile;
    }

    private function globFromInepZend($strExtension = null)
    {
        if (empty($strExtension))
            return array();
        $strBasePath = __DIR__ . '/../../../../../../../';
        $arrFile = array_merge(FileSystem::globRecursive($strBasePath . '/public/vendor/InepZend', $strExtension), FileSystem::globRecursive($strBasePath . '/vendor/InepZend', $strExtension));
        foreach ($arrFile as &$strFile)
            $strFile = str_replace($strBasePath, '', $strFile);
        return $arrFile;
    }

    protected function getRevisionToGrid()
    {
        if (!is_null($arrRevision = self::getAttributeSession('arrRevision')))
            return $arrRevision;
        $arrRevision = ApplicationInfo::getRevision(true);
        if (array_key_exists(self::NAME, $arrRevision))
            $arrRevision[self::NAME] = '<font style="font-weight: bold; bold; color: red;">' . $arrRevision[self::NAME] . '</font>';
        if (array_key_exists(self::INEPZEND_LAST_VERSION, $arrRevision))
            $arrRevision[self::INEPZEND_LAST_VERSION] = '<font style="font-weight: bold; color: red;">' . $arrRevision[self::INEPZEND_LAST_VERSION] . '</font>';
        $intKey = 1;
        foreach ($arrRevision as $strInfo => $mixValue) {
            $arrRevision[$intKey] = array($strInfo, $mixValue);
            unset($arrRevision[$strInfo]);
            ++$intKey;
        }
        self::setAttributeSession('arrRevision', $arrRevision);
        return $arrRevision;
    }

    protected function getHtmlGrid()
    {
        return $this->renderTable(array('arrOption' => array(array('allowHtml', true), array('cssClassNames', '{headerCell: \'google-visualization-table-th gradient google-visualization-table-sorthdr cellHeader\'}')), 'arrData' => array_merge(array(0 => array('Informação', 'Valor')), self::getRevisionToGrid())));
    }

    protected function getContentFromMarkdown($strPath = null)
    {
        return (empty($strPath)) ? false : (string) FileSystem::getContentFromFile(__DIR__ . '/../../../../../../../' . str_replace('.md', '.html', $strPath));
    }

}
