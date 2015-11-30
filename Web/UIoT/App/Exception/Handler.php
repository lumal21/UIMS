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

use UIoT\App\Security\Handler as SHandler;
use Whoops\Exception\Formatter;
use Whoops\Handler\PrettyPageHandler;
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
        (!SHandler::checkDeveloperMode() && SHandler::checkWhiteListIp() && ($frames = $this->getInspector()->getFrames())) || $frames = [];

        $k = new TemplateHelper;
        $k->setVariables([
            'page_title' => $this->getPageTitle(),
            'Stylesheet' => file_get_contents($this->getResource('Stylesheet/whoops.base.css')),
            'zepto' => file_get_contents($this->getResource('Scripts/zepto.min.js')),
            'javascript' => file_get_contents($this->getResource('Scripts/whoops.base.js')),
            'header' => $this->getResource('Layouts/header.html.php'),
            'frame_list' => $this->getResource('Layouts/frame_list.html.php'),
            'frame_code' => $this->getResource('Layouts/frame_code.html.php'),
            'env_details' => $this->getResource('Layouts/env_details.html.php'),
            'title' => $this->getPageTitle(),
            'name' => explode('\\', $this->getInspector()->getExceptionName()),
            'message' => $this->getInspector()->getException()->getMessage(),
            'code' => $this->getInspector()->getException()->getCode(),
            'plain_exception' => Formatter::formatExceptionPlain($this->getInspector()),
            'frames' => $frames,
            'has_frames' => !!count($frames),
            'handler' => $this,
            'handlers' => $this->getRun()->getHandlers(),
            'tables' => array_map('UIoT\App\Core\Helpers\Manipulators\Json::isInstanceOfClosure', $this->getDataTables())]);
        $k->render($this->getResource('Layouts/layout.html.php'));

        return Handler::QUIT;
    }
}
