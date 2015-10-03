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

namespace UIoT\App\Core\Renders;

use UIoT\App\Core\Communication\Parsers\DataHandler;
use UIoT\App\Core\Controllers\Commander;
use UIoT\App\Core\Controllers\Indexer as CIndexer;
use UIoT\App\Core\Helpers\Manipulators\Urls;
use UIoT\App\Core\Resources\Mapper;
use UIoT\App\Core\Views\Indexer;

/**
 * Class Template
 * @property string template
 * @package UIoT\App\Core\Views
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
        $this->__resources($controller, $action);
        $this->__show($controller, $action);
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->template;
    }

    /**
     * Start the Controller Commander
     *
     * @param $controller
     * @param $action
     */
    private function __controller($controller, $action)
    {
        (new Commander($controller, $action))->__action($action);
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
     * Start Abstract Layout (For Abstract Core)
     *
     * @param $action
     * @return mixed|null|string
     */
    private function __abstractView($action)
    {
        /* get layout from the parser */
        DataHandler::getParserLayout($action);

        /* open the layout */
        return DataHandler::openParserLayout($action);
    }

    /**
     * Call View/Layout
     *
     * @param $controller
     * @param $action
     */
    private function __view($controller, $action)
    {
        $this->template = ((!self::$disable_show_view) ? ((Indexer::viewExists($controller)) ? Indexer::getView($controller) : '') : ((!CIndexer::controllerExists($controller)) ? $this->__abstractView($action) : $this->__basicView()));
    }

    /**
     * Call Controller and show View Code
     *
     * @param $controller
     * @param $action
     */
    private function __show($controller, $action)
    {
        $this->__controller($controller, $action);
        $this->__view($controller, $action);
    }

    /**
     * Register Resources
     *
     * @param $controller
     * @param $action
     */
    private function __resources($controller, $action)
    {
        /* register resources */
        Mapper::registerResources(((in_array($action, Urls::getLayouts())) ? $action : $controller), true);
    }
}