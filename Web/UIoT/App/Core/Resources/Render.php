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

use Httpful\Mime;
use UIoT\App\Core\Assets\Register;
use UIoT\App\Core\Communication\Parsers\DataHandler;
use UIoT\App\Core\Communication\Parsers\DataManager;
use UIoT\App\Core\Communication\Requesting\Brain;
use UIoT\App\Core\Layouts\Factory;
use UIoT\App\Data\Interfaces\Parsers\RenderInterface;


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
        $this->startResource();
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
        $this->controllerName = DataManager::setController($arguments['resource']);

        $this->controllerAction = DataManager::setAction($arguments['action']);
    }

    /**
     * Start the Controller Commander
     */
    private function setControllerData()
    {
        self::$controllerData = DataManager::getInstance($this->controllerAction);
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
        DataManager::prepareTemplate();

        /* prepare brain */
        Brain::setTemplate(DataHandler::getParserMethod($this->controllerAction), Mime::JSON);
    }

    /**
     * Start Resource Manipulation
     */
    private function startResource()
    {
        Manager::setRelatedResource($this->controllerName);

        Manager::getResource();
    }
}