<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use \Exception as ExceptionNative;

class ExceptionHelper extends AbstractHelper
{

    private $renderer;
    private $booTranslate = true;

    public function __invoke($renderer = null, $booTranslate = null, $booInverse = null)
    {
        if (!is_object($renderer))
            return;
        $this->renderer = $renderer;
        if (is_bool($booTranslate))
            $this->booTranslate = $booTranslate;
        $strMessage = $this->translate($this->renderer->message);
        if ($strMessage == 'An error occurred during execution; please try again later.')
            $strMessage = 'Ocorreu um erro durante a execução; por favor, tente novamente mais tarde.';
        $arrException = array();
        $exception = $this->renderer->exception;
        while ((isset($exception)) && ($exception instanceof ExceptionNative)) {
            $arrException[] = $exception;
            $exception = $exception->getPrevious();
        }
        if (!is_bool($booInverse))
            $booInverse = true;
        if ($booInverse) {
            krsort($arrException);
            $arrException = array_values($arrException);
        }
        $strResult = '<h1>' . $this->translate('An error occurred') . '</h1><h2>' . $strMessage . '</h2>';
        if (count($arrException) > 0) {
            foreach ($arrException as $intKey => $exception) {
                if ($intKey == 0)
                    $strResult .= '<hr/><h2>' . $this->translate('Additional information') . ':</h2>' . $this->renderInfoException($exception);
                else {
                    if ($intKey == 1)
                        $strResult .= '<hr/><h2>' . $this->translate((($booInverse) ? 'Exceções posteriores' : 'Previous exceptions')) . ':</h2><ul class="unstyled">';
                    $strResult .= '<li>' . $this->renderInfoException($exception) . '</li>';
                }
            }
            if (count($arrException) >= 2)
                $strResult .= '</ul>';
        } else
            $strResult .= '<h3>' . $this->translate('No Exception available') . '</h3>';
        return $strResult;
    }

    private function translate($strText = null)
    {
        return ((!is_object($this->renderer)) || (!$this->booTranslate)) ? $strText : $this->renderer->translate($strText);
    }

    private function renderInfoException($exception = null)
    {
        if ((!is_object($exception)) || (!$exception instanceof ExceptionNative))
            return;
        $strInfo = '<h3>' . get_class($exception) . '</h3>
<dl>
    <dt>' . $this->translate('File') . ':</dt>
    <dd>
        <pre class="prettyprint linenums">' . $exception->getFile() . ':' . $exception->getLine() . '</pre>
    </dd>
    <dt>' . $this->translate('Message') . ':</dt>
    <dd>
        <pre class="prettyprint linenums">' . $this->translate($exception->getMessage()) . '</pre>
    </dd>';
        if (SHOW_ERROR) {
            $strInfo .= '<dt>' . $this->translate('Stack trace') . ':</dt>
    <dd>
        <pre class="prettyprint linenums">' . $exception->getTraceAsString() . '</pre>
    </dd>';
        }
        $strInfo .= '</dl>';
        return $strInfo;
    }

}
