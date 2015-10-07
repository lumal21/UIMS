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
    public static $disable_show_view = false, $enable_default_action = false;

    /**
     * Init Template (Layout/Controller/View) Handler
     *
     * @param array $arguments
     */
    public function __construct($arguments = [])
    {
        $this->controller = $arguments['controller'];
        $this->action     = $arguments['action'];

        $this->setResources();
        $this->setController();
    }

    /**
     * Start the Controller Commander
     */
    private function setController()
    {
        (new Commander($this->controller, $this->action))->setAction($this->action);
    }

    /**
     * Enable Basic View/Layout (Only controller output Code)
     *
     * @return mixed|string|null
     */
    private function bView()
    {
        return (CONTROLLER_CONTENT);
    }

    /**
     * Start Abstract Layout (For Abstract Core)
     */
    private function aView()
    {
        /* get layout from the parser */
        DataHandler::getParserLayout($this->action);

        /* open the layout */
        return DataHandler::openParserLayout($this->action);
    }

    /**
     * Call View/Layout
     */
    public function show()
    {
        return ((!self::$disable_show_view) ? ((Indexer::viewExists($this->controller)) ? Indexer::getView($this->controller) : '') : ((!CIndexer::controllerExists($this->controller)) ? $this->aView() : $this->bView()));
    }

    /**
     * Register Resources
     */
    private function setResources()
    {
        Mapper::registerResources(((in_array($this->action, Urls::getLayouts())) ? $this->action : $this->controller), true);
    }
}