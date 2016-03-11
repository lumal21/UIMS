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

use Httpful\Mime;
use UIoT\App\Core\Communication\Parsers\DataHandler;
use UIoT\App\Core\Communication\Parsers\DataManager;
use UIoT\App\Core\Communication\Requesting\Brain;
use UIoT\App\Core\Helpers\Manipulation\Arrays;
use UIoT\App\Exception\Collector;

/**
 * Class Controllable
 * @package UIoT\App\Core\Controllers
 */
final class Controllable extends IControllable
{
    /**
     * Create an IControllable Instance
     * @param string $controller_name
     * @param string $action_name
     */
    public function __construct($controller_name, $action_name)
    {
        /* put abstract controller name */
        $this->controller_name = DataManager::setController($controller_name);

        /* set abstract action name */
        $this->controller_action = DataManager::setAction($action_name);

        /* prepare template */
        DataManager::prepareTemplate();

        /* do all data */
        $this->receiveBrainData();

        /* go check all */
        $this->executeAbstractController();
    }

    /**
     * Go do All Data Functions
     */
    private function receiveBrainData()
    {
        /* configure brain to a GET template */
        $this->setBrainTemplate();

        /* get brain resource items */
        $this->getBrainResourceItems();
    }

    /**
     * Check all The Steps
     */
    private function executeAbstractController()
    {
        /* get brain resource item actions */
        !$this->checkData() || $this->getBrainResourceItemActions();

        /* execute controller */
        !$this->checkData() || $this->enableController($this->controller_actions);

        /* if not valid finish */
        $this->checkData() || Collector::errorMessage(901,
            "Stop! That Controller Doesn't Exists!",
            'Details: ',
            [
                'What Happened?' => "You're trying to Call an nonexistent Controller",
                'What Controller?' => "Controller with name: {$this->controller_name}",
                'Resolution:' => "Stop trying to call nonexistent controllers.",
                'What Controllers can i Call?' => "You can Call UIoT's Abstract Controllers, and the Built-In Controllers",
                'Are you the developer?' => 'You can open this same error Page with Developer Code, only need put ?de on the Url'
            ]
        );
    }

    /**
     * Get IController Actions (Methods)
     */
    private function getBrainResourceItemActions()
    {
        $this->controller_actions = DataHandler::getParserArray();
    }

    /**
     * Get Possible IControllers
     */
    private function getBrainResourceItems()
    {
        $this->abstract_controllers_array = Arrays::toControllerArray(Brain::getItems());
    }

    /**
     * Check if is in Array
     * That means, check if the Controller Name exists on IController Array
     */
    private function checkData()
    {
        return in_array($this->controller_name, $this->abstract_controllers_array);
    }

    /**
     * Call the IController And Create his Instance
     * @param array $array
     */
    protected function enableController($array = [])
    {
        parent::enableController($array);
    }

    /**
     * Set Brain Template Type
     */
    private function setBrainTemplate()
    {
        Brain::setTemplate(DataHandler::getParserMethod($this->controller_action), Mime::JSON);
    }
}
