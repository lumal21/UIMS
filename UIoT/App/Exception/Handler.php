<?php

/**
 * UIoT CMS
 * @version dev-alpha
 *                          88
 *                          ""              ,d
 *                                          88
 *              88       88 88  ,adPPYba, MM88MMM
 *              88       88 88 a8"     "8a  88
 *              88       88 88 8b       d8  88
 *              "8a,   ,a88 88 "8a,   ,a8"  88,
 *               `"YbbdP'Y8 88  `"YbbdP"'   "Y888
 *
 * @project Uniform Internet of Things
 * @app UIoT Content Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @copyright University of Bras�lia
 */

namespace UIoT\App\Exception;

use ErrorException;
use UIoT\App\Core\Helpers\Manipulators\Arrays;
use Whoops\Exception\Formatter;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Util\Misc;
use Whoops\Util\TemplateHelper;

/*
 * Create A PrettyPageHandler Instance
 * (Little Edited)
 */

/**
 * Class Handler
 * @package UIoT\App\Exception
 */
class Handler extends PrettyPageHandler
{
    /**
     * This Function Override PrettyPageHandler Handler
     * Override @parent handle();
     * This void makes a good Pretty Handling ;)
     *
     * @return int
     */
    public function handle()
    {
        /* call template helper */
        $helper = new TemplateHelper;

        /* get error code */
        $error_code = $this->getInspector()->getException()->getCode();

        /* get error frames */
        $frames = (($error_code >= 9000) ? [] : $this->getInspector()->getFrames());

        /* try to get exception error type */
        if ($this->getInspector()->getException() instanceof ErrorException) $error_code = Misc::translateErrorCode($this->getInspector()->getException()->getSeverity());

        /* set all variables */
        $vars = [
            'page_title' => $this->getPageTitle(), 'Stylesheet' => file_get_contents($this->getResource('Stylesheet/whoops.base.css')), 'zepto' => file_get_contents($this->getResource('Scripts/zepto.min.js')), 'javascript' => file_get_contents($this->getResource('Scripts/whoops.base.js')), 'header' => $this->getResource('Layouts/header.html.php'), 'frame_list' => $this->getResource('Layouts/frame_list.html.php'), 'frame_code' => $this->getResource('Layouts/frame_code.html.php'), 'env_details' => $this->getResource('Layouts/env_details.html.php'), 'title' => $this->getPageTitle(), 'name' => explode("\\", $this->getInspector()->getExceptionName()), 'message' => $this->getInspector()->getException()->getMessage(), 'code' => $error_code, 'plain_exception' => Formatter::formatExceptionPlain($this->getInspector()), 'frames' => $frames, 'has_frames' => !!count($frames), 'handler' => $this, 'handlers' => $this->getRun()->getHandlers(),
            'tables' => ['GET Data' => $_GET, 'POST Data' => $_POST, 'Files' => $_FILES, 'Cookies' => $_COOKIE, 'Session' => isset($_SESSION) ? $_SESSION : [], 'Server/Request Data' => $_SERVER, 'Environment Variables' => $_ENV,
            ],
        ];

        if ($error_code >= 9000):
            $vars['tables'] = [];
            $vars['code'] -= 9000;
        endif;

        /* merge the data tables */
        $vars['tables'] = array_merge(array_map('self::isInstanceOfClosure', $this->getDataTables()), $vars['tables']);

        /* prepare handler */
        $helper->setVariables($vars);
        $helper->render($this->getResource('Layouts/layout.html.php'));

        return Handler::QUIT;
    }

    /**
     * Is a Reference to Arrays::isInstanceOfClosure()
     *
     * @param string $x
     * @return mixed
     */
    protected static function isInstanceOfClosure($x)
    {
        return Arrays::isInstanceOfClosure($x);
    }
}