<?php

namespace InepZend\View\Helper;

trait RendererTrait
{

    private static $renderer;

    public function __invoke($renderer = null)
    {
        if (is_object($renderer))
            self::setRenderer($renderer);
        return $this;
    }

    public static function setRenderer($renderer = null)
    {
        return (self::$renderer = $renderer);
    }

    public static function getRenderer()
    {
        return self::$renderer;
    }

}
