<?php

namespace InepZend\Grid\Flexigrid\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\View\Helper\AbstractHtmlHeadHelper;
use InepZend\Paginator\Paginator;
use InepZend\Permission\Permission;
use InepZend\FormGenerator\View\Helper\FormRow;
use InepZend\Util\stdClass;
use Zend\Json\Encoder;

class FlexigridHelper extends AbstractHelper
{

    const WIDTH_ICON = 20;

    private $strId;
    private $strCssClass;
    private $strSortName;
    private $strSortOrder;
    private $strRoute;
    private $strUrlPaging;
    private $strUrlInsert;
    private $strUrlUpdate;
    private $strUrlDelete;
    private $booColInsert = false;
    private $booColUpdate = false;
    private $booColDelete = false;
    private $booInsert = true;
    private $booUpdate = true;
    private $booDelete = true;
    private $booDefineUrl = true;
    private $strConfirmDelete = '';
    private $intHeight = 310;
    private $intWidth;
    private $strResource;
    private $strCallback;
    private $strJsFunctionAccordion;
    private $arrReloadOnLoad = array();
    private $arrCol;
    private $arrButton;
    private static $booFlexigrid = false;
    private $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT;
    private $arrAccesskey = array();

    public function __invoke()
    {
        return clone $this;
    }

    public function setId($strId = null)
    {
        $this->strId = $strId;
        return $this;
    }

    public function getId()
    {
        return $this->strId;
    }

    public function setCssClass($strCssClass = null)
    {
        $this->strCssClass = $strCssClass;
        return $this;
    }

    public function getCssClass()
    {
        return $this->strCssClass;
    }

    public function setSortName($strSortName = null)
    {
        $this->strSortName = $strSortName;
        return $this;
    }

    public function getSortName()
    {
        return $this->strSortName;
    }

    public function setSortOrder($strSortOrder = null)
    {
        $this->strSortOrder = $strSortOrder;
        return $this;
    }

    public function getSortOrder()
    {
        return $this->strSortOrder;
    }

    public function setRoute($strRoute = null)
    {
        $this->strRoute = $strRoute;
        return $this;
    }

    public function getRoute()
    {
        return $this->strRoute;
    }

    public function setUrlPaging($strUrlPaging = null)
    {
        $this->strUrlPaging = $strUrlPaging;
        return $this;
    }

    public function getUrlPaging()
    {
        return $this->strUrlPaging;
    }

    public function setUrlInsert($strUrlInsert = null)
    {
        $this->strUrlInsert = $strUrlInsert;
        return $this;
    }

    public function getUrlInsert()
    {
        return $this->strUrlInsert;
    }

    public function setUrlUpdate($strUrlUpdate = null)
    {
        $this->strUrlUpdate = $strUrlUpdate;
        return $this;
    }

    public function getUrlUpdate()
    {
        return $this->strUrlUpdate;
    }

    public function setUrlDelete($strUrlDelete = null)
    {
        $this->strUrlDelete = $strUrlDelete;
        return $this;
    }

    public function getUrlDelete()
    {
        return $this->strUrlDelete;
    }

    public function setColInsert($booColInsert = false)
    {
        $this->booColInsert = (bool) $booColInsert;
        return $this;
    }

    public function getColInsert()
    {
        return $this->booColInsert;
    }

    public function setColUpdate($booColUpdate = false)
    {
        $this->booColUpdate = (bool) $booColUpdate;
        return $this;
    }

    public function getColUpdate()
    {
        return $this->booColUpdate;
    }

    public function setColDelete($booColDelete = false)
    {
        $this->booColDelete = (bool) $booColDelete;
        return $this;
    }

    public function getColDelete()
    {
        return $this->booColDelete;
    }

    public function setShowInsert($booInsert = true)
    {
        $this->booInsert = (bool) $booInsert;
        return $this;
    }

    public function getShowInsert()
    {
        return $this->booInsert;
    }

    public function setShowUpdate($booUpdate = true)
    {
        $this->booUpdate = (bool) $booUpdate;
        return $this;
    }

    public function getShowUpdate()
    {
        return $this->booUpdate;
    }

    public function setShowDelete($booDelete = true)
    {
        $this->booDelete = (bool) $booDelete;
        return $this;
    }

    public function getShowDelete()
    {
        return $this->booDelete;
    }

    public function setDefineUrl($booDefineUrl = true)
    {
        $this->booDefineUrl = (bool) $booDefineUrl;
        return $this;
    }

    public function getDefineUrl()
    {
        return $this->booDefineUrl;
    }

    public function setConfirmDelete($strConfirmDelete = '')
    {
        $this->strConfirmDelete = $strConfirmDelete;
        return $this;
    }

    public function getConfirmDelete()
    {
        return $this->strConfirmDelete;
    }

    public function getHeight()
    {
        return $this->intHeight;
    }

    public function setHeight($intHeight = 310)
    {
        $this->intHeight = $intHeight;
        return $this;
    }

    public function getWidth()
    {
        return $this->intWidth;
    }

    public function setWidth($intWidth = null)
    {
        $this->intWidth = $intWidth;
        return $this;
    }

    public function setResource($strResource = null)
    {
        $this->strResource = $strResource;
        return $this;
    }

    public function getResource()
    {
        return $this->strResource;
    }

    public function setCallback($strCallback = null)
    {
        $this->strCallback = $strCallback;
        return $this;
    }

    public function getCallback()
    {
        return $this->strCallback;
    }

    public function setJsFunctionAccordion($strJsFunctionAccordion = null)
    {
        $this->strJsFunctionAccordion = $strJsFunctionAccordion;
        return $this;
    }

    public function getJsFunctionAccordion()
    {
        return $this->strJsFunctionAccordion;
    }

    public function setReloadOnLoad($booReloadOnLoad = false, $strUrl = null, $strJsOptions = null)
    {
        $this->arrReloadOnLoad = array($booReloadOnLoad, $strUrl, $strJsOptions);
        return $this;
    }

    public function getReloadOnLoad()
    {
        return $this->arrReloadOnLoad;
    }

    public function setItemPerPage($intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT)
    {
        $this->intItemPerPage = $intItemPerPage;
        return $this;
    }

    public function getItemPerPage()
    {
        return $this->intItemPerPage;
    }

    public function setCol($strName = null, $strLabel = null, $intWidth = 40, $strAlign = 'left', $booSortAble = true, $booSearch = false, $booDefaultSearch = false, $strClass = null, $strStyle = null)
    {
        if ((empty($strName)) || (is_null($strLabel)))
            return $this;
        $this->addAttributeColName($strName)
                ->addAttributeColLabel($strName, $strLabel)
                ->addAttributeColWidth($strName, $intWidth)
                ->addAttributeColAlign($strName, $strAlign)
                ->addAttributeColSortAble($strName, $booSortAble)
                ->addAttributeColSearch($strName, $booSearch)
                ->addAttributeColDefaultSearch($strName, $booDefaultSearch)
                ->addAttributeColClass($strName, $strClass)
                ->addAttributeColStyle($strName, $strStyle);
        return $this;
    }

    public function getCol($strName = null)
    {
        return (!empty($strName)) ? @$this->arrCol[$strName] : $this->arrCol;
    }

    public function addAttributeColName($strName = null)
    {
        return $this->addAttributeCol($strName, 'strName', $strName);
    }

    public function addAttributeColLabel($strName = null, $strLabel = null)
    {
        return $this->addAttributeCol($strName, 'strLabel', $strLabel);
    }

    public function addAttributeColWidth($strName = null, $intWidth = 40)
    {
        return $this->addAttributeCol($strName, 'intWidth', $intWidth);
    }

    public function addAttributeColAlign($strName = null, $strAlign = 'left')
    {
        return $this->addAttributeCol($strName, 'strAlign', $strAlign);
    }

    public function addAttributeColSortAble($strName = null, $booSortAble = true)
    {
        return $this->addAttributeCol($strName, 'booSortAble', $booSortAble);
    }

    public function addAttributeColSearch($strName = null, $booSearch = false)
    {
        return $this->addAttributeCol($strName, 'booSearch', $booSearch);
    }

    public function addAttributeColDefaultSearch($strName = null, $booDefaultSearch = false)
    {
        return $this->addAttributeCol($strName, 'booDefaultSearch', $booDefaultSearch);
    }

    public function addAttributeColClass($strName = null, $strClass = null)
    {
        return $this->addAttributeCol($strName, 'strClass', $strClass);
    }

    public function addAttributeColStyle($strName = null, $strStyle = null)
    {
        return $this->addAttributeCol($strName, 'strStyle', $strStyle);
    }

    private function addAttributeCol($strName = null, $strAttribute = null, $mixValue = null)
    {
        if (empty($strName))
            return;
        $col = (is_object($this->getCol($strName))) ? $this->getCol($strName) : new stdClass();
        $this->addAttribute($col, $strAttribute, $mixValue);
        $this->arrCol[$strName] = $col;
        return $this;
    }

    public function setButton($strName = null, $strCssClass = null, $strJsFunction = null, $strResource = null, $booCol = false, $strJsFunctionCondition = null)
    {
        if (empty($strName))
            return $this;
        $this->addAttributeButtonName($strName)
                ->addAttributeButtonCssClass($strName, $strCssClass)
                ->addAttributeButtonJsFunction($strName, $strJsFunction)
                ->addAttributeButtonResource($strName, $strResource)
                ->addAttributeButtonCol($strName, $booCol)
                ->addAttributeButtonJsFunctionCondition($strName, $strJsFunctionCondition);
        return $this;
    }

    public function getButton($strName = null)
    {
        return (!empty($strName)) ? @$this->arrButton[$strName] : $this->arrButton;
    }

    public function addAttributeButtonName($strName = null)
    {
        return $this->addAttributeButton($strName, 'strName', $strName);
    }

    public function addAttributeButtonCssClass($strName = null, $strCssClass = null)
    {
        $this->arrAccesskey[$strCssClass] = FormRow::getAccesskey();
        return $this->addAttributeButton($strName, 'strCssClass', $strCssClass);
    }

    public function addAttributeButtonJsFunction($strName = null, $strJsFunction = null)
    {
        return $this->addAttributeButton($strName, 'strJsFunction', $strJsFunction);
    }

    public function addAttributeButtonResource($strName = null, $strResource = null)
    {
        return $this->addAttributeButton($strName, 'strResource', $strResource);
    }

    public function addAttributeButtonCol($strName = null, $booCol = null)
    {
        return $this->addAttributeButton($strName, 'booCol', $booCol);
    }

    public function addAttributeButtonJsFunctionCondition($strName = null, $strJsFunctionCondition = null)
    {
        return $this->addAttributeButton($strName, 'strJsFunctionCondition', $strJsFunctionCondition);
    }

    private function addAttributeButton($strName = null, $strAttribute = null, $mixValue = null)
    {
        if (empty($strName))
            return;
        $button = (is_object($this->getButton($strName))) ? $this->getButton($strName) : new \stdClass();
        $this->addAttribute($button, $strAttribute, $mixValue);
        $this->arrButton[$strName] = $button;
        return $this;
    }

    private function addAttribute($stdClass = null, $strAttribute = null, $mixValue = null)
    {
        if (!is_object($stdClass))
            return;
        if ((empty($stdClass->$strAttribute)) || ($stdClass->$strAttribute <> $mixValue))
            $stdClass->$strAttribute = $mixValue;
    }

    private function isAllowedCrud(&$booOperation = true, &$strUrl = null, $strRoute = null, $strAction = 'add')
    {
        $booRoute = false;
        if ((!empty($strRoute)) && (empty($strUrl))) {
            $booRoute = true;
            $strUrl = '/' . $strRoute . '/' . $strAction;
        }
        if (($booOperation) && (!empty($strUrl))) {
            $strResource = null;
            if ($booRoute) {
                if (is_object(self::hasServiceManager())) {
                    $arrConfig = $this->getService('Config');
                    $strController = @$arrConfig['router']['routes'][$strRoute]['options']['defaults']['controller'];
                    if (!empty($strController))
                        $strController = end($arrExplode = explode('\\', $strController));
                }
                if (empty($strController))
                    $strController = $strRoute;
                $strResource = $strController . '_' . end($arrExplode = explode('/', $strUrl));
            } else {
                $arrUrl = array_filter(explode('/', $strUrl));
                if (count($arrUrl) == 1)
                    $strResource = $arrUrl[0];
                elseif (count($arrUrl) == 2)
                    $strResource = reset($arrUrl) . '_' . end($arrUrl);
            }
            if (!empty($strResource)) {
                $strResource = strtoupper(Permission::CONST_KEY_PREFIXO_RESOURCE . $strResource);
                $booOperation = $this->isAllowedIdentityIfExists($strResource);
            }
        }
    }

    public function showGrid()
    {
        if ($this->isPermitted($this->getResource()) === false)
            return;
        static $intGrid;
        if (!is_integer($intGrid))
            $intGrid = 0;
        ++$intGrid;
        $strId = $this->getId();
        $strCssClass = $this->getCssClass();
        if ((empty($strId)) && (empty($strCssClass)))
            $strId = 'tableData' . (($intGrid > 1) ? $intGrid : '');
        $strReference = (empty($strId)) ? '.' . $strCssClass : '#' . $strId;
        $strSortName = $this->getSortName();
        $strSortOrder = $this->getSortOrder();
        if ((!empty($strSortName)) && (empty($strSortOrder)))
            $strSortOrder = 'asc';
        $strRoute = $this->getRoute();
        $strUrlPaging = $this->getUrlPaging();
        if ((!empty($strRoute)) && (empty($strUrlPaging)))
            $strUrlPaging = '/' . $strRoute . '/ajaxPaginator';
        $booInsert = $this->getShowInsert();
        $strUrlInsert = $this->getUrlInsert();
        $booColInsert = $this->getColInsert();
        $this->isAllowedCrud($booInsert, $strUrlInsert, $strRoute, 'add');
        $booUpdate = $this->getShowUpdate();
        $strUrlUpdate = $this->getUrlUpdate();
        $booColUpdate = $this->getColUpdate();
        $this->isAllowedCrud($booUpdate, $strUrlUpdate, $strRoute, 'edit');
        $booDelete = $this->getShowDelete();
        $strUrlDelete = $this->getUrlDelete();
        $booColDelete = $this->getColDelete();
        $strConfirmDelete = $this->getConfirmDelete();
        $this->isAllowedCrud($booDelete, $strUrlDelete, $strRoute, 'delete');
        $booDefineUrl = $this->getDefineUrl();
        $intHeight = $this->getHeight();
        $intWidth = $this->getWidth();
        $strCallback = $this->getCallback();
        $strJsFunctionAccordion = $this->getJsFunctionAccordion();
        if (!empty($strJsFunctionAccordion))
            $strJsFunctionAccordion = $this->editJsFunction($strJsFunctionAccordion);
        $arrReloadOnLoad = $this->getReloadOnLoad();
        $booReloadOnLoad = (boolean) @$arrReloadOnLoad[0];
        $strUrl = @$arrReloadOnLoad[1];
        $strJsOptions = @$arrReloadOnLoad[2];
        $arrCol = $this->getCol();
        $arrButton = $this->getButton();
        $strInclude = '';
        if (!self::$booFlexigrid) {
            $strInclude .= $this->getHtmlInclude();
            self::$booFlexigrid = true;
        }
        $strGrid = '<table summary="flexigridTable" ';
        if (!empty($strId))
            $strGrid .= 'id="' . $strId . '" ';
        if (!empty($strCssClass))
            $strGrid .= 'class="' . $strCssClass . '" ';
        $strGrid .= 'style="display: none;"></table>
' . $strInclude . '
<script type="text/javascript">';
        if (!empty($strInclude)) {
            $strGrid .= 'var booGlobalFlexigridCache = false;
var strGlobalFlexigridRequestName;
var arrGlobalFlexigridResult = new Array();';
        }
        $strGrid .= '
$("' . $strReference . '").flexigrid(
    {
        dataType: "xml",
        usepager: true,
        useRp: true,
        showTableToggleBtn: true,
        errormsg: "Ocorreu uma falha",
        pagestat: "Listando {from} até {to} de {total} registro(s)",
        pagetext: "Página",
        outof: "de",
        findtext: "Procurar",
        procmsg: "Processando, por favor aguarde...",
        nomsg: "Sem registro",
        rp: ' . $this->getItemPerPage() . ',
        referenceTable: "' . $strReference . '",
        height: ' . $intHeight . ',';
        if (!empty($intWidth))
            $strGrid .= 'width: ' . $intWidth . ',';
        $strGrid .= 'onError: flexOnError,
        onSubmit: flexOnSubmit,
        onSuccess: function (data) 
        {';
        if (is_array($arrCol)) {
            foreach ((array) $arrCol as $col) {
                if (!empty($col->strClass))
                    $strGrid .= 'setFlexigridColClass("' . $col->strName . '", "' . $col->strClass . '");';
                if (!empty($col->strStyle))
                    $strGrid .= 'setFlexigridColStyle("' . $col->strName . '", "' . $col->strStyle . '");';
            }
        }
        $strGrid .= 'return flexOnSuccess(data, "' . $strReference . '", \'' . $strCallback . '\', \'' . $strJsFunctionAccordion . '\');
        }, ';
        if ((!empty($strUrlPaging)) && ($booDefineUrl))
            $strGrid .= 'url: strGlobalBasePath + "' . $strUrlPaging . '", ';
        if (!empty($strSortName))
            $strGrid .= 'sortname: "' . $strSortName . '", ';
        if (!empty($strSortOrder))
            $strGrid .= 'sortorder: "' . $strSortOrder . '", ';
        $booButton = false;
        $arrInfoColAction = array();
        $strGrid .= 'buttons:
        [ ';
        if (($booInsert) && (!empty($strUrlInsert))) {
            $strButtonName = 'Inserir';
            if (!$booColInsert) {
                $this->arrAccesskey['add'] = FormRow::getAccesskey();
                $booButton = true;
                $strGrid .= '
                {
                    name: "' . $strButtonName . '",
                    bclass: "add",
                    onpress: delegateOperation
                }, ';
            } else
                $arrInfoColAction[] = array('strName' => $strButtonName, 'strCssClass' => 'add', 'strJsFunction' => 'delegateOperation');
        }
        if (($booUpdate) && (!empty($strUrlUpdate))) {
            $strButtonName = 'Alterar';
            if (!$booColUpdate) {
                $this->arrAccesskey['update'] = FormRow::getAccesskey();
                $booButton = true;
                $strGrid .= '
                {
                    name: "' . $strButtonName . '",
                    bclass: "update",
                    onpress: delegateOperation
                }, ';
            } else
                $arrInfoColAction[] = array('strName' => $strButtonName, 'strCssClass' => 'update', 'strJsFunction' => 'delegateOperation');
        }
        if (($booDelete) && (!empty($strUrlDelete))) {
            $strButtonName = 'Excluir';
            if (!$booColDelete) {
                $this->arrAccesskey['delete'] = FormRow::getAccesskey();
                $booButton = true;
                $strGrid .= '
                {
                    name: "' . $strButtonName . '",
                    bclass: "delete",
                    onpress: delegateOperation
                }, ';
            } else
                $arrInfoColAction[] = array('strName' => $strButtonName, 'strCssClass' => 'delete', 'strJsFunction' => 'delegateOperation');
        }
        foreach ((array) $arrButton as $button) {
            if ($this->isPermitted($button->strResource) === false)
                continue;
            if ($button->booCol) {
                $arrInfoColAction[] = array('strName' => $button->strName, 'strCssClass' => $button->strCssClass, 'strJsFunction' => $button->strJsFunction, 'strJsFunctionCondition' => $button->strJsFunctionCondition);
                continue;
            }
            $booButton = true;
            $strGrid .= '
            {
                name: "' . $button->strName . '",
                bclass: "' . $button->strCssClass . '",
                onpress: ' . $button->strJsFunction . '
            }, ';
        }
        if ($booButton)
            $strGrid .= '
                {
                    separator: true
                } ';
        $strGrid .= ' ], ';
        if ((is_array($arrCol)) || (count($arrInfoColAction) != 0) || (!empty($strJsFunctionAccordion))) {
            $strGrid .= 'colModel:
        [ ';
            $booSearch = false;
            $booColExists = false;
            foreach ((array) $arrCol as $col) {
                if ($booColExists)
                    $strGrid .= ', ';
                $strGrid .= '
            {
                hide: false,
                name: "' . $col->strName . '",
                display: "' . $col->strLabel . '", ';
                $strGrid .= 'width: ' . ((!empty($col->intWidth)) ? $col->intWidth : '40') . ', ';
                $strGrid .= 'align: "' . ((!empty($col->strAlign)) ? $col->strAlign : 'left') . '", ';
                $strGrid .= 'sortable: ' . ((is_bool($col->booSortAble)) ? (($col->booSortAble) ? 'true' : 'false') : 'true') . ' ';
                $strGrid .= '
            } ';
                if ((!$booSearch) && ($col->booSearch))
                    $booSearch = true;
                $booColExists = true;
            }
            if ((count($arrInfoColAction) != 0) || (!empty($strJsFunctionAccordion))) {
                if ($booColExists)
                    $strGrid .= ' , ';
                $intWidthColAction = (count($arrInfoColAction) * self::WIDTH_ICON) + 10;
                if (!empty($strJsFunctionAccordion))
                    $intWidthColAction += 30;
                if ($intWidthColAction < 55)
                    $intWidthColAction = 55;
                $strGrid .= '
                {
                    hide: false,
                    name: "colAction",
                    display: "Ações",
                    width: ' . $intWidthColAction . ',
                    align: "center",
                    sortable: false
                } ';
                $booColExists = true;
            }
            $strGrid .= '
        ], ';
            if ($booSearch) {
                $strGrid .= 'searchitems:
        [ ';
                $booSearchExists = false;
                foreach ($arrCol as $col) {
                    if (!$col->booSearch)
                        continue;
                    if ($booSearchExists)
                        $strGrid .= ', ';
                    $strGrid .= '
            {
                name: "' . $col->strName . '",
                display: "' . $col->strLabel . '", ';
                    $strGrid .= 'isdefault: ' . ((is_bool($col->booDefaultSearch)) ? (($col->booDefaultSearch) ? 'true' : 'false') : 'false') . ' ';
                    $strGrid .= '
            } ';
                    $booSearchExists = true;
                }
                $strGrid .= '
        ], ';
            }
        }
        $strGrid .= 'singleSelect: true
    }
);';
        if ((strpos($strGrid, 'delegateOperation') !== false) || (count($arrInfoColAction) != 0)) {
            $strGrid .= '
function delegateOperation(strOperation, grid) 
{
    return delegateOperationAction(strOperation, grid, "' . $strUrlInsert . '", "' . $strUrlUpdate . '", "' . $strUrlDelete . '", "' . $strConfirmDelete . '");
}';
        }
        if (count($arrInfoColAction) != 0) {
            $strGrid .= '
function showColButton' . str_replace('#', '', $strReference) . '() 
{
    if (document.all)
        var arrIcon = getElementsFromAttribute(document.body, "DIV", "name", "flexigridColButtonIcon[' . str_replace('#', '', $strReference) . ']");
    else
        var arrIcon = document.getElementsByName("flexigridColButtonIcon[' . str_replace('#', '', $strReference) . ']");
    if (arrIcon.length != 0)
        return false;
    var arrTable = $("' . $strReference . '").toArray();
    if (arrTable.length != 0) {
        var table = arrTable[0];
        var arrColAction = getElementsFromAttribute(table, "DIV", "name", "flexigridColButtonAction");
        for (var intCount = 0; intCount < arrColAction.length; ++intCount) {
            var colAction = arrColAction[intCount];
            if (colAction == undefined) continue;
            if (colAction.innerHTML != "")
                break; ';
            foreach ($arrInfoColAction as $arrColAction) {
                $strGrid .= 'var strDisplay = ""; ';
                $strJsFunctionCondition = (array_key_exists('strJsFunctionCondition', $arrColAction)) ? $arrColAction['strJsFunctionCondition'] : null;
                if (!empty($strJsFunctionCondition)) {
                    $strJsFunctionCondition = $this->editJsFunction($strJsFunctionCondition);
                    $strJsFunctionCondition = str_replace(')', ((strpos($strJsFunctionCondition, '()') === false) ? ', ' : '') . 'arrGlobalFlexigridResult["' . $strReference . '"][2][intCount], \\\'' . Encoder::encode($arrColAction) . '\\\')', $strJsFunctionCondition);
                    $strGrid .= 'eval(\'var booResult = ' . $strJsFunctionCondition . '\');
                        if (!booResult)
                            strDisplay = "none"; ';
                }
                if ((self::isThemeAdministrativeResponsible())) {
                    $arrClassColButton = explode(' ', $arrColAction['strCssClass']);
                    if (in_array('add', $arrClassColButton))
                        $arrColAction['strCssClass'] .= ' fa fa-plus-circle';
                    if (in_array('show', $arrClassColButton))
                        $arrColAction['strCssClass'] .= ' fa fa-list';
                    if (in_array('update', $arrClassColButton))
                        $arrColAction['strCssClass'] .= ' fa fa-pencil-square-o';
                    if (in_array('delete', $arrClassColButton))
                        $arrColAction['strCssClass'] .= ' fa fa-times';
                }
                $strGrid .= 'if (strDisplay != "none")
                    colAction.innerHTML += "<div name=\'flexigridColButtonIcon[' . str_replace('#', '', $strReference) . ']\' class=\'' . $arrColAction['strCssClass'] . '\' style=\'padding: 0px; float: left; height: ' . self::WIDTH_ICON . 'px; width: ' . self::WIDTH_ICON . 'px; cursor: pointer;\' title=\'' . $arrColAction['strName'] . '\' onclick=\"invokerGlobalButtonFlexigrid = this; setTimeout(\'' . $arrColAction['strJsFunction'] . '(\\\\\'' . $arrColAction['strName'] . '\\\\\', $(\\\\\'' . $strReference . '\\\\\'));\', 100);\"></div>"; ';
            }
            $strGrid .= '
        }
    }
    return true;
}
showColButtonInterval("' . str_replace('#', '', $strReference) . '");';
        }
        $strGrid .= '
setTimeout(\'setNameIntoInputPage(); editFlexigridButton(\\\'' . json_encode($this->arrAccesskey) . '\\\', ' . ((self::isThemeAdministrativeResponsible()) ? 'true' : 'false') . ');\', 100);';
        if ((self::isThemeAdministrativeResponsible())) {
            $strGrid .= '
                $(document).ready(function() {
                    $(".pGroup .pFirst").html("<i class=\'fa fa fa-fast-backward\'></i>&nbsp;" + $(".pGroup .pFirst").text());
                    $(".pGroup .pPrev").html("<i class=\'fa fa-step-backward\'></i>&nbsp;" + $(".pGroup .pPrev").text());
                    $(".pGroup .pNext").html("<i class=\'fa fa-step-forward\'></i>&nbsp;" + $(".pGroup .pNext").text());
                    $(".pGroup .pLast").html("<i class=\'fa fa-fast-forward\'></i>&nbsp;" + $(".pGroup .pLast").text());
                    $(".pGroup .pReload").html("<i class=\'fa fa-repeat\'></i>&nbsp;" + $(".pGroup .pReload").text());
                });
            ';
        }
        if ($booReloadOnLoad) {
            if (empty($strUrl))
                $strUrl = 'undefined';
            else
                $strUrl = '"' . $strUrl . '"';
            if (empty($strJsOptions))
                $strJsOptions = 'undefined';
            $strGrid .= '
                $(document).ready(function() {
                    reloadFlexigrid(' . $strUrl . ', ' . $strJsOptions . ', "' . $strReference . '");
                });
            ';
        }
        $strGrid .= '</script>';
        unset($this);
        return $strGrid;
    }

    public function getHtmlInclude()
    {
        $strHtmlInclude = '<link href="' . $this->getBaseUrl() . '/vendor/flexigrid/flexigrid-1.1/css/flexigrid.pack.css' . AbstractHtmlHeadHelper::getSufixCssGzip() . '" media="screen" rel="stylesheet" type="text/css">
                <link href="' . $this->getBaseUrl() . '/vendor/flexigrid/flexigrid-1.1/css/inep-zend' . AbstractHtmlHeadHelper::getSufixCss() . '" media="screen" rel="stylesheet" type="text/css">
                <script type="text/javascript">include_once("/vendor/flexigrid/flexigrid-1.1/js/flexigrid.min.js' . AbstractHtmlHeadHelper::getSufixJsGzip() . '");</script>
                <script type="text/javascript">include_once("/vendor/flexigrid/flexigrid-1.1/js/inep-zend' . AbstractHtmlHeadHelper::getSufixJs() . '");</script>'; 
        if (self::getTheme('portal') == 'PortalBackgroundCinza2014')
            $strHtmlInclude .= '<link href="' . $this->getBaseUrl() . '/vendor/InepZend/theme/portal-background-cinza-2014/css/style-flexigrid-container' . AbstractHtmlHeadHelper::getSufixCss() . '" media="screen" rel="stylesheet" type="text/css">';
        return $strHtmlInclude;
    }

    private function editJsFunction($strJsFunction = null)
    {
        if (!empty($strJsFunction)) {
            if (strpos($strJsFunction, '(') === false)
                $strJsFunction .= '()';
            if (strpos($strJsFunction, ';') === false)
                $strJsFunction .= ';';
        }
        return $strJsFunction;
    }

}
