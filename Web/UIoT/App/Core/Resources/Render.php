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

namespace UIoT\App\Core\Resources;

use UIoT\App\Core\Assets\Register;
use UIoT\App\Core\Communication\Parsers\DataManager;
use UIoT\App\Core\Layouts\Factory;
use UIoT\App\Data\Interfaces\Parsers\RenderInterface;
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class Render
 * @package UIoT\App\Core\Templates
 */
final class Render implements RenderInterface
{
    /**
     * Controller Name
     *
     * @var string
     */
    private $controllerName;

    /**
     * Action Name
     *
     * @var string
     */
    private $controllerAction;

    /**
     * Controller Content
     *
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
        $this->setResources();
        $this->prepareRaise();
        $this->setControllerData();
    }

    /**
     * Set Arguments
     *
     * @param array $arguments
     *
     * @return void
     */
    public function setArguments($arguments = [])
    {
        $this->controllerName = Strings::toControllerName($arguments['resource']);

        $this->controllerAction = Strings::toActionName($arguments['action']);
    }

    /**
     * Start the Controller Commander
     */
    private function setControllerData()
    {
        $baseCollector = DataManager::getInstance($this->controllerAction);

        $baseCollector->parse($this->controllerAction);

        self::$controllerData = $baseCollector->getResponse();
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
    public function show()
    {
        return Factory::getLayout($this->controllerAction);
    }

    /**
     * Register Controller's Layout Assets
     */
    private function setResources()
    {
        Register::registerResources($this->controllerAction, true);
    }

    /**
     * Prepare Raise
     */
    private function prepareRaise()
    {
        /* prepare template */
        DataManager::setTemplate($this->controllerAction);
    }
}
