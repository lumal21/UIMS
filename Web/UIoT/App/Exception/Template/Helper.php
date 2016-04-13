<?php

/**
 * UIoTuims
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
 * @app UIoT User-Friendly Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Exception\Template;

use UIoT\App\Exception\Manager;
use UIoT\App\Security\Manager as SecurityManager;
use Whoops\Util\TemplateHelper;

/**
 * Class Helper
 * Exception Template Helper
 *
 * @package UIoT\App\Exception\Template
 */
class Helper extends TemplateHelper
{
    /**
     *
     * Get File Content
     *
     * @param string $template
     * @return mixed|string
     */
    public function display($template = '')
    {
        /* return templates like css,js, etc */
        return file_get_contents($template);
    }

    /**
     *
     * Executes the Render
     *
     * @param Handler $handler
     * @return int
     */
    public function execute(Handler $handler)
    {
        /* set frames */
        $handler->setFrameList(Manager::checkDeveloperMode() && SecurityManager::checkWhiteListIp());

        /* set variables */
        $this->setVariables($handler->setSettings());

        /* render main layout */
        $this->render($handler->getResource('Layouts/layout.html.php'));

        /* return exit code */
        return Handler::QUIT;
    }

    /**
     *
     * Given a template path, render it within its own scope. This
     * method also accepts an array of additional variables to be
     * passed to the template.
     *
     * @param string $template
     * @param array $additionalVariables
     */
    public function render($template, array $additionalVariables = null)
    {
        /* extract variables */
        extract($this->getVariables());

        /* require file */
        require_once($template);
    }
}
