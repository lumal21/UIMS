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

namespace UIoT\App\Core\Controllers;

use Exception;
use UIoT\App\Core\Layouts\Factory as LayoutFactory;
use UIoT\App\Data\Interfaces\Parsers\RenderInterface;

/**
 * Class Render
 * @package UIoT\App\Core\Templates
 */
final class Render implements RenderInterface
{
    /**
     * @var string
     */
    private $controllerName;

    /**
     * @var string
     */
    private $controllerAction;

    /**
     * @var string
     */
    private static $controllerData;

    /**
     * Init Template (Layout/Controller/View) Handler
     *
     * @param array $arguments
     */
    public function __construct($arguments = [])
    {
        $this->setArguments($arguments);
        $this->setControllerData();
    }

    /**
     * Set Arguments
     *
     * @param array $arguments
     * @return void
     */
    public function setArguments($arguments = [])
    {
        $this->controllerName = $arguments['controller'];
        $this->controllerAction = $arguments['action'];
    }

    /**
     * Start the Controller Commander
     */
    private function setControllerData()
    {
        if(!Factory::controllerActionExists($this->controllerName, $this->controllerAction)) {
            throw new Exception("The requested Action doesn't exists.", '404');
        }

        self::$controllerData = Factory::executeControllerAction($this->controllerName, $this->controllerAction);
    }

    /**
     * Return Controller Data
     *
     * @return string
     */
    public static function getControllerData()
    {
        return self::$controllerData;
    }

    /**
     * Show Template Content
     * If is to show the View, echoes the View Content with Controller Content, if not Only echoes Controller Content
     */
    public function showContent()
    {
        return LayoutFactory::getLayout($this->controllerName);
    }
}
