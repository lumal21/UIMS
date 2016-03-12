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

namespace UIoT\App\Core\Templates;

use UIoT\App\Core\Communication\Parsers\DataHandler;
use UIoT\App\Core\Controllers\Commander;
use UIoT\App\Core\Controllers\Indexer as ControllerIndexer;
use UIoT\App\Core\Helpers\Manipulation\Strings;
use UIoT\App\Core\Layouts\Factory as LayoutIndexer;
use UIoT\App\Core\Resources\Indexer as ResourceIndexer;
use UIoT\App\Data\Interfaces\RenderInterface;

/**
 * Class Render
 * @package UIoT\App\Core\Templates
 */
final class Render implements RenderInterface
{
    /**
     * Disable Render the View's and View's Layout
     *
     * @var bool
     */
    private static $show_layout = true;

    /**
     * Enable to show Default Action
     *
     * @var bool
     */
    private static $enable_default_action = false;

    /**
     * Controller Name
     *
     * @var string
     */
    private $controller_name;

    /**
     * Action Name
     *
     * @var string
     */
    private $controller_action_name;

    /**
     * Init Template (Layout/Controller/View) Handler
     *
     * @param array $arguments
     */
    public function __construct($arguments = [])
    {
        $this->setArguments($arguments);
        $this->setResources();
        $this->setController();
    }

    /**
     * Set Arguments
     *
     * @param array $arguments
     */
    public function setArguments($arguments = [])
    {
        $this->controller_name = Strings::toControllerName($arguments['controller']);
        $this->controller_action_name = Strings::toActionName($arguments['action']);
    }

    /**
     * Start the Controller Commander
     */
    private function setController()
    {
        /* Start Controller Commander, and set Action to Execute */
        (new Commander($this->controller_name, $this->controller_action_name))->setAction($this->controller_action_name);
    }

    /**
     * Check if Need to Enable Default Controller Action
     *
     * @param bool $boolean
     * @return bool
     */
    public static function enableControllerDefaultAction($boolean = null)
    {
        /* check if need change boolean value */
        !(self::$enable_default_action === $boolean && is_bool($boolean)) || self::$enable_default_action = $boolean;

        return self::$enable_default_action;
    }

    /**
     * Check if need to Show Controller View
     *
     * @param bool $boolean
     * @return bool
     */
    public static function showControllerLayout($boolean = null)
    {
        /* check if need change boolean value */
        !(self::$show_layout === $boolean && is_bool($boolean)) || self::$show_layout = $boolean;

        return self::$show_layout;
    }

    /**
     * Return Controller Content if the Controller Exists,
     * If not Return the Abstract Controller Handler (DataHandler) Content
     * Also DataHandler view Enable the Abstract Controller Layout
     *
     * @return mixed
     */
    private function returnControllerContent()
    {
        return ControllerIndexer::controllerExists($this->controller_name) ? Commander::getControllerContent() : DataHandler::openParserLayout($this->controller_action_name);
    }

    /**
     * Return Controller View Content if View Exists,
     * If not, return Controller Content
     *
     * @return mixed
     */
    private function returnControllerLayout()
    {
        return LayoutIndexer::layoutExists($this->controller_name) ? LayoutIndexer::getLayout($this->controller_name) : $this->returnControllerContent();
    }

    /**
     * Show Template Content
     * If is to show the View, echoes the View Content with Controller Content, if not Only echoes Controller Content
     */
    public function show()
    {
        return self::showControllerLayout() ? $this->returnControllerLayout() : $this->returnControllerContent();
    }

    /**
     * Set Dynamic/Abstract Resources
     */
    private function setDynamicResources()
    {
        !(!LayoutIndexer::layoutExists($this->controller_name) && LayoutIndexer::layoutExists($this->controller_action_name)) || ResourceIndexer::registerResources($this->controller_action_name, true);
    }

    /**
     * Register Controller's Layout Resources
     */
    private function setResources()
    {
        if (ControllerIndexer::controllerExists($this->controller_name))
            $this->setStaticResources();
        else
            $this->setDynamicResources();
    }

    /**
     * Set Static Resources
     */
    private function setStaticResources()
    {
        !(LayoutIndexer::layoutExists($this->controller_name) && !LayoutIndexer::layoutExists($this->controller_action_name)) || ResourceIndexer::registerResources($this->controller_name, true);
    }
}
