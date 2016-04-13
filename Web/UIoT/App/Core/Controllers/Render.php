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

use UIoT\App\Core\Assets\Register as AssetIndexer;
use UIoT\App\Core\Layouts\Factory as LayoutIndexer;
use UIoT\App\Data\Interfaces\Parsers\RenderInterface;
use UIoT\App\Exception\Collector;
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
        $this->controllerName = Strings::toControllerName($arguments['controller']);

        $this->controllerAction = Strings::toActionName($arguments['action']);
    }

    /**
     * Start the Controller Commander
     */
    private function setControllerData()
    {
        if (!Factory::controllerActionExists($this->controllerName, $this->controllerAction))
            $this->throwNonExistentActionError();

        // Set Controller Data
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
    public function show()
    {
        return LayoutIndexer::getLayout($this->controllerName);
    }

    /**
     * Throw non Existent Action Exception
     */
    private function throwNonExistentActionError()
    {
        Collector::errorMessage(902,
            "Stop! That Action Doesn't Exists!",
            'Details: ',
            [
                'What Happened?' => "You're trying to call an nonexistent Action",
                'What Action?' => "Action with name: $this->controllerAction",
                'From the Controller:' => $this->controllerName,
                'Resolution:' => "Stop trying to call nonexistent actions.",
                'What Actions can i Call?' => "You can Call UIoT's Abstract Actions (Handlers), and the Built-In Controllers Actions",
                'Are you the developer?' => 'You can open this same error Page with Developer Code, only need put ?de on the Url'
            ]
        );
    }

    /**
     * Register Controller's Layout Assets
     */
    private function setResources()
    {
        AssetIndexer::registerResources($this->controllerName, true);
    }
}
