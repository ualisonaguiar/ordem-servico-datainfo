<?php

namespace InepZend\Theme\Administrative\View\Helper;

use InepZend\Theme\Administrative\View\Helper\MenuHelper;

/**
 * Helper Menu
 *
 * @package View
 * @subpackage Helper
 */
class MenuHelperWithoutSession extends MenuHelper
{

    protected $booSessionToRender = false;

}
