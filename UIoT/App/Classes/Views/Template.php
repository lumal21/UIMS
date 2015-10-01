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
 * @copyright University of Brasília
 */

namespace UIoT\App\Classes\Views;

use UIoT\App\Classes\Communication\Parsers\DataHandler;
use UIoT\App\Classes\Controllers\Commander;
use UIoT\App\Classes\Controllers\Indexer as CIndexer;

/**
 * Class Template
 * @property string view_name
 * @property string action_name
 * @property string controller_name
 * @property string template
 * @package UIoT\App\Classes\Views
 */
final class Template
{
    static $disable_show_view = false, $enable_default_action = false;

    /**
     * Init Template (Layout/Controller/View) Handler
     *
     * @param string $controller
     * @param string $action
     */
    function __construct($controller, $action)
    {
        $this->__name($controller, $action);
        $this->__show();
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->template;
    }

    /**
     * Save Controller and Action Name
     *
     * @param string $controller
     * @param string $action
     */
    private function __name($controller, $action)
    {
        $this->controller_name = $controller;
        $this->action_name     = $action;
    }

    /**
     * Start the Controller Commander
     */
    private function __controller()
    {
        (new Commander($this->controller_name, $this->action_name))->__action($this->action_name);
    }

    /**
     * Enable Basic View/Layout (Only controller output Code)
     *
     * @return mixed|string|null
     */
    private function __basicView()
    {
        return (CONTROLLER_CONTENT);
    }

    /**
     * Start Abstract Layout (For Abstract Classes)
     *
     * @return mixed|string|null
     */
    private function __abstractView()
    {
        /* get layout from the parser */
        DataHandler::getParserLayout($this->action_name);

        /* open the layout */
        return DataHandler::openParserLayout($this->action_name);
    }

    /**
     * Call View/Layout
     */
    private function __view()
    {
        $this->template = ((!self::$disable_show_view) ? ((Indexer::viewExists($this->controller_name)) ? Indexer::getView($this->controller_name) : '') : ((!CIndexer::controllerExists($this->controller_name)) ? $this->__abstractView() : $this->__basicView()));
    }

    /**
     * Call Controller and show View Code
     */
    private function __show()
    {
        $this->__controller();
        $this->__view();
    }
}