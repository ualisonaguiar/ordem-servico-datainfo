<?php

namespace InepZend\View\Helper;

interface InterfaceHtmlHeadHelper
{

    public function __invoke($renderer);

    public function meta();

    public function title($strTitle);

    public function link();

    public function script();

    public function complement();
}
